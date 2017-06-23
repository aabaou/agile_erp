#!/bin/bash

# Set up some variables.
SECONDS=0
export CURRENTPATH=${PWD}
export BACKUPFILE=$CURRENTPATH/../scripts/drupal/backup.yml
export POSTBUILDFILE=$CURRENTPATH/../scripts/drupal/post-build.yml
export DEPLOYFILE=$CURRENTPATH/../scripts/drupal/deploy.yml
export POSTDEPLOYFILE=$CURRENTPATH/../scripts/drupal/post-deploy.yml
export ROLLBACKFILE=$CURRENTPATH/../scripts/drupal/rollback.yml

# Functions definition.
function displayNotice {
  echo -e "\e[7;49;37m$1\e[0m"
}

function displayOperation {
  echo -e "\e[7;49;32m$1\e[0m"
}

function displayWarning {
  echo -e "\e[7;49;33m$1\e[0m"
}

function displayError {
  echo -e "\e[7;49;31m$1\e[0m"
}

function displaySuccess {
  echo -e "\e[5;49;32m$1\e[0m"
}

function displayFailure {
  echo -e "\e[5;49;31m$1\e[0m"
}

function changeDir {
  cd $1
  echo "Now in ${PWD}"
}

# Before any process check that we are in Drupal root folder.
if [[ ! -f index.php && ! -d core ]]; then
  displayError "Please run this script from Drupal root folder !"
  echo "No index.php file or core folder could be found."
  echo "Either you're in the wrong folder or your project is not initialized."
  read -p "Are you sure you want to continue (y/n)? " -n 1 -r
  echo
  if [[ ! $REPLY =~ ^[Yy]$ ]]
  then
    exit 1;
  fi
fi

# Require settings file to process the build.
if [[ ! -f ../config/drupal/settings.local.php && ! -f ../config/drupal/settings.travis.php ]]; then
  displayError "Please setup settings file before proceeding !"
  echo "Here is a hash salt example for you to initialize your settings:"
  drush ev '$hash = Drupal\Component\Utility\Crypt::randomBytesBase64(55); print $hash . "\n";' $verbose
  exit 1;
fi

# Initialize available options.
noComposer=0
noConsole=0
noBackup=0
dump=0;
conf="sync"
verbose=""

# Retrieve all available options.
optspec=":hv-:"
while getopts "$optspec" optchar; do
  case "${optchar}" in
    -)
      case "${OPTARG}" in
        fast)
          noComposer=1
          noConsole=1
          noBackup=1
          ;;
        nc)
          noComposer=1
          ;;
        nb)
          noBackup=1
          ;;
        ndc)
          noConsole=1
          ;;
        conf=*)
          conf=${OPTARG#*=}
          ;;
        dump=*)
          dump=${OPTARG#*=}
          ;;
        verb|verbose)
          verbose="-vvv"
          ;;
      esac;;
    v|vv|vvv)
      verbose="-vvv"
      ;;
  esac
done

if [ ! $verbose = "" ]; then
  displayNotice "Running commands in verbose mode"
fi
  
# Composer operations.
if [ $noComposer = 0 ]; then
  cd ..

  # Update the autoload classes, this is sometimes required
  # if the project has been installed and some files has been deleted.
  displayOperation "Updating autoload classes"
  composer dump-autoload $verbose
  
  # Installing composer packages.
  displayOperation "Starting composer update"
  composer update $verbose
  
  cd web
  
else
  displayWarning "Skipping composer operations (fast mode)"
fi

# Init Drupal console.
if [ $noConsole = 0 ]; then
  displayOperation "Initialize Drupal console"
  ../vendor/bin/drupal init --override --no-interaction $verbose

  source "$HOME/.console/console.rc" 2>/dev/null
else
  displayWarning "Skipping drupal console operations (fast mode)"
fi

# If backup is not skipped, process it.
if [ $noBackup = 0 ]; then
  displayOperation "Starting database and configurations backup"

  # Only backup things if there is a previous working instance.
  date=$(date +%Y%m%d%H%M%S)
  if ../vendor/bin/drupal database:dump --gz --file="../data/db/local-$date.sql" | grep -q "is not a valid command name"; then
    displayWarning "Skipping backup (nothing to dump)"
  else
    displaySuccess " The database was dumped at \"../data/db/local-$date.sql.gz\""
    ../vendor/bin/drupal config:export --directory=../config/drupal/local $verbose
  fi
else
  displayWarning "Skipping backup (fast/noBackup mode)"
fi

# If a dump is passed as option, install the website with it.
if [ $dump != 0 ]; then
  displayOperation "Building site from \"../data/db/$dump\""
  #./vendor/bin/drupal site:install --db-file=../data/db/$dump --no-interaction --force $verbose
  drush sql-drop
  #../vendor/bin/drush sql-cli < ../data/db/$dump
  zcat ../data/db/$dump | ../vendor/bin/drush sql-cli
else
  # Test of the config_installer profile. Not working, leaving code for history.
  #./../vendor/bin/drupal site:install config_installer --account-name="admin" --account-mail="admin@actency.fr" --no-interaction --force $verbose

  # Installing the site.
  displayOperation "Building site"

  # IDK why but install via drupal console still bug with Travis, perfoming it with drush, leaving code for history.
  #  ./../vendor/bin/drupal site:install standard --no-interaction --force $verbose
  ../vendor/bin/drush site-install --yes $verbose

  # Clear cache
  ../vendor/bin/drupal cr all $verbose

  # If no configuration files are available in the folder, stop the process here.
  if [[ ! $(ls -A ../config/drupal/$conf) ]]; then
    displayWarning "No configuration files found in \"$conf\", skipping configuration importation"
  # Else continue with configuration importation
  else
    displayOperation "Starting configuration importation from \"$conf\""
    # Retrieving stored UUID.
    siteId=$(grep 'uuid:' ../config/drupal/$conf/system.site.yml | tail -n1); siteId=${siteId//*uuid: /};
    if [ ! -z $siteId ]; then
      displaySuccess " Site UUID retrieved successfully: $siteId"
    else
      displayFailure " No configuration could be imported, please check that the UUID is well defined in system.site.yml."
      displayError "Site UUID could not be retrieved for \"$conf\" folder !"
      exit 1
    fi

    # Pushing UUID into the current instance.
    displaySuccess " Pushing site UUID into the current instance."
    ../vendor/bin/drupal config:override system.site uuid "$siteId" $verbose

    # Removing default shortcut links, this is mandatory for the importation to be done.
    # More details here: https://www.drupal.org/node/2583113
    # @todo: Remove this when the issue is fixed on drupal.org.
    displaySuccess " Removing default shortcut links to ensure a proper importation."
    displaySuccess " This is a community fix, see https://www.drupal.org/node/2583113)."
    ../vendor/bin/drupal entity:delete shortcut_set default $verbose

    displaySuccess " Importing configuration from \"$conf\""
    ../vendor/bin/drupal config:import --directory=../config/drupal/$conf --no-interaction $verbose
  fi
fi

# Rebuild site.
displayOperation "Performing post-build operations"
../vendor/bin/drupal chain --file=$POSTBUILDFILE -y $verbose

# Display execution time.
duration=$SECONDS
displayNotice

# Adds the writing permission to the sites/default folder
displayOperation "Adds the writing permission to the sites/default folder"
chmod u+w sites/default