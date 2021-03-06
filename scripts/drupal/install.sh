#!/bin/bash

function displayWarning {
  echo -e "\e[7;49;33m$1\e[0m"
}

function displayOperation {
  echo -e "\e[7;49;32m$1\e[0m"
}

function displayError {
  echo -e "\e[7;49;31m$1\e[0m"
}

# Checking memory
displayOperation "Checking memory"
cd /usr/local/etc/php

tmp=$(grep memory_limit php.ini | head -1)
memory_limit=$(echo $tmp | cut -d'=' -f2)
	
if [ $memory_limit != -1 ]
then
  echo "The current limit memory : $tmp"
  read -p "In order for Composer to install or update all libraries, the limit memory must be equal to -1. If this value is different from -1, the install.sh script may not execute correctly and display the 'PHP Fatal error: Allowed memory size of XXXXXX bytes exhausted ...' error message. Do you want to change this value to -1?? (y/n)? " -n 1 -r
  echo
  
  if [[  $REPLY =~ ^[Yy]$ ]]
  then
    displayOperation "Modifying the memory_limit value in the php.ini file"
	sed -ie "s/$tmp/memory_limit = -1/g" php.ini
  fi
  if [ -f php.inie ];then
	rm php.inie
  fi
   
fi

cd /var/www/html

# Composer operations.
displayOperation "Composer operations"

  # Update the autoload classes, this is sometimes required
  # if the project has been installed and some files has been deleted.
  displayOperation "Updating autoload classes"
  composer dump-autoload 
  
  # Installing composer packages.
  displayOperation "Starting composer update"
  composer update 
  
cd web


# Generating the settings.local.php file with the right information
if [[ ! -f ../config/drupal/settings.local.php && -f ../config/drupal/example.settings.local.php ]];then
	displayWarning "The settings.local.php file is created"
	cp ../config/drupal/example.settings.local.php ../config/drupal/settings.local.php

	
    
	
	# Database name	
    # The default value is the value in the file docker-compose.yml
	databasetmp=$(grep MYSQL_DATABASE ../docker-compose.yml | head -1)
	databaseDocker=$(echo $databasetmp | cut -d'=' -f2)			
	database=$databaseDocker
	read -e -i "$database" -p "What is the name of the database ? " input
	database="${input:-$database}"
	sed -ie "s/\*\*\*DATABASE\*\*\*/${database}/g" ../config/drupal/settings.local.php
	

	
	# User name 
	# The default value is the value in the file docker-compose.yml  
	usertmp=$(grep MYSQL_USER ../docker-compose.yml | head -1)
	userDocker=$(echo $usertmp | cut -d'=' -f2)			
	user=$userDocker
	read -e -i "$user" -p "What is the user name of the database ? " input
	user="${input:-$user}"
	sed -ie "s/\*\*\*USERNAME\*\*\*/${user}/g" ../config/drupal/settings.local.php
    
	# Password user 
	# The default value is the value in the file docker-compose.yml 
	passtmp=$(grep MYSQL_PASSWORD ../docker-compose.yml | head -1)
	passDocker=$(echo $passtmp | cut -d'=' -f2)			
	pass=$passDocker
	read -e -i "$pass" -p "Login password  ? " input
	pass="${input:-$pass}"
	sed -ie "s/\*\*\*PASSWORD\*\*\*/${pass}/g" ../config/drupal/settings.local.php

	# Domain name
	# The default value is the value in the file docker-compose.yml  
	domaintmp=$(grep SERVERNAME ../docker-compose.yml | head -1)
	domainDocker=$(echo $domaintmp | cut -d'=' -f2)			
	domain=$domainDocker
	read -e -i "$domain" -p "Give the domain name of the site (example: drup8cy.loc)  ? " input
	domain="${input:-$domain}"
	sed -ie "s/\*\*\*DOMAIN\*\*\*/${domain}/g" ../config/drupal/settings.local.php
	domainsub=$(echo $domain | cut -d'.' -f1)
	# You must replace '^priob\.loc$', line 116 with '^***PRIOB***\.***LOC***$', in example.settings.local.php
	sed -ie "s/\*\*\*PRIOB\*\*\*/${domainsub}/g" ../config/drupal/settings.local.php
	domaintld=$(echo $domain | cut -d'.' -f2)
	sed -ie "s/\*\*\*LOC\*\*\*/${domaintld}/g" ../config/drupal/settings.local.php
	
	# drushrc.php
	sed -ie "s/\*\*\*URI\*\*\*/${domain}/g" sites/default/drushrc.php
	
	echo "Here is the hash salt use to initialize your settings:" 
	drush ev '${hash1} = Drupal\Component\Utility\Crypt::randomBytesBase64(55); print ${hash1} . "\n"; print file_put_contents("../scripts/drupal/hash1temp.txt", ${hash1});'
	hash2=$(cat ../scripts/drupal/hash1temp.txt)
	sed -ie "s/\*\*\*GENERATE SALT\*\*\*/${hash2}/g" ../config/drupal/settings.local.php
	rm ../scripts/drupal/hash1temp.txt
	
	# Generating the settings.travis.php file with the right information
	if [[ ! -f ../config/drupal/settings.travis.php && -f ../config/drupal/example.settings.travis.php ]];then
		displayWarning "The settings.travis.php file will be created"
		cp ../config/drupal/example.settings.travis.php ../config/drupal/settings.travis.php
		
		sed -ie "s/\*\*\*PRIOB\*\*\*/${domainsub}/g" ../config/drupal/settings.travis.php
		sed -ie "s/\*\*\*LOC\*\*\*/${domaintld}/g" ../config/drupal/settings.travis.php
		sed -ie "s/\*\*\*DATABASE\*\*\*/${database}/g" ../config/drupal/settings.travis.php
		sed -ie "s/\*\*\*GENERATE SALT\*\*\*/${hash2}/g" ../config/drupal/settings.travis.php
		
		# The modification of the settings.travis.php file by the install.sh script changed the file rights(the right to write has been deleted).
		# Write permission is given back to the user
		chmod u+w ../config/drupal/settings.travis.php
		
	fi
	
	# The modification of the settings.local.php file by the install.sh script changed the file rights (the right to write has been deleted).
	# Write permission is given back to the user
	chmod u+w ../config/drupal/settings.local.php 
	
		# Deleting the temp file generated by sed
		if [ -f ../config/drupal/settings.local.phpe ];then
			rm ../config/drupal/settings.local.phpe
		fi
		if [ -f sites/default/drushrc.phpe ];then
			rm sites/default/drushrc.phpe
		fi
		if [ -f ../config/drupal/settings.travis.phpe ];then
			rm ../config/drupal/settings.travis.phpe
		fi

fi



# Generating the services.local.yml file
displayOperation "Generating the services.local.yml file"
if [[ ! -f ../config/drupal/services.local.yml && -f ../config/drupal/example.services.local.yml ]];then
    cp ../config/drupal/example.services.local.yml ../config/drupal/services.local.yml
fi

# Generating the settings.php file in web/sites/default
displayOperation "Generating the settings.php file"
if [[ -f ./sites/default/example.settings.php && -f ./sites/default/settings.php ]];then
    rm ./sites/default/settings.php 
    cp ./sites/default/example.settings.php ./sites/default/settings.php
fi



# Generating the database
if [[ ! -d ../data/db ]];then
	mkdir ../data/db   
fi

read -p "Do you want to import a database (y/n)? " -n 1 -r
echo

if [[ $REPLY =~ ^[Yy]$ ]]; then
   displayWarning "Place your sql file in data/db."
   read -p "What is the name of the sql file (example: example.sql.gz)  ? " filesql


   if [[ ${filesql: -7} = '.sql.gz' ]]; then
       displayOperation "Importing the database"
       bash ../scripts/drupal/build.sh --nc --nb --dump="${filesql}"
 
   else
       displayError "Your file does not have the right extension"
   fi
   
else
    displayOperation "Generating a new database"
    bash ../scripts/drupal/build.sh --nc --nb    
fi 


# Generate sub theme
read -p "Do you want to create a bootstrap subtheme (y/n)? " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then

displayOperation "Downloading bactency"
    wget "https://github.com/Guicom/bactency/archive/master.zip"
            unzip "master.zip"
            rm "master.zip"
            mv bactency-master/theme.sh theme.sh
    bash theme.sh
fi

