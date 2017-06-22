# Shell Scripts <a id="shellscripts"></a>
1. [Launch of starterkit with install.sh](#install.sh)
2. [Use of the build.sh script](#build.sh)
3. [Use of the archive.sh script](#archive.sh)
4. [Use of the ckeditor.sh script](#ckeditor.sh)

## Launch of starterkit with install.sh <a id="install.sh"></a>
To start the installation of a new Drupal 8 project, proceed as follows:

1. Modify the docker-compose.yml file that is located at the root of your project,
2. Launch the install.sh script.

### Change the docker-compose.yml file
Modify the docker-compose.yml file that is located at the root of your project to match your local configuration.

````php
version: '2'
services:
  # web with xdebug - actency images
  web:
    # @see https://github.com/Actency/docker-apache-php
    image: actency/docker-apache-php:7.0
    ports:
      - "80:80"
      - "9000:9000"
    environment:
      - SERVERNAME=/***EXAMPLE.LOC***/
      - SERVERALIAS=/***EXAMPLE.LOC***/
      - DOCUMENTROOT=web
    volumes:
      - /home/docker/projets/***PATH***/:/var/www/html/
      - /home/docker/.ssh/:/var/www/.ssh/
    links:
      - database:mysql
      - mailhog
    tty: true
    shm_size: 2G

  # database container - actency images
  database:
    # @see https://github.com/Actency/docker-mysql
    image: actency/docker-mysql:5.7
    ports:
      - "3306:3306"
    environment:
      - MYSQL_ROOT_PASSWORD=mysqlroot
      - MYSQL_DATABASE=/***EXAMPLE***/
      - MYSQL_USER=mysqlusr
      - MYSQL_PASSWORD=mysqlpwd

  # phpmyadmin container - actency images
  phpmyadmin:
    image: actency/docker-phpmyadmin
    ports:
      - "8010:80"
    environment:
      - MYSQL_ROOT_PASSWORD=mysqlroot
      - UPLOAD_SIZE=1G
    links:
      - database:mysql

  # mailhog container - official images
  mailhog:
    image: mailhog/mailhog
    ports:
      - "1025:1025"
      - "8025:8025"
````
- Replace `example` and` path` with your local configuration,
- run `docker-compose up -d` or this alias `dcup` to launch containers.

Note : When you modify the docker-compose.yml file, it is sometimes necessary to recreate the containers for the changes to taken effect. In this case run the command: `dcup --force-recreate`
- run `go [container_name_web_1] bash`. This command is used to enter in the container `container_name_web_1`.

Note : If you are unsure of the container name, you can run the `docker ps` command. This command lists the containers.

### Launch the install.sh script


Go to the web folder of your Drupal project and run the command  `bash ../scripts/drupal/install.sh`.

Follow the instructions.

#### What does this script do ?

This script :
- Change the memory_limit value of the php.ini file to -1 (If the user allows this change). In usr/local/etc/php/php.ini the default value of memory_limit is 512M. Without this change, Composer will fail to install or update dependencies and will display the error message `PHP Fatal error: Allowed memory size of XXXXXX bytes exhausted ...`.
- starts the installation of the project dependencies
- create a hash salt used by Drupal for the generation of uuid. The generation mechanics is the one used by Drupal in a standard way.
- create `settings.local.php` file in the `config/drupal` with the information of the database and the domain name that the user will have specified in the terminal when the script is launched.
- modify the `settings.php` file in `sites/default/settings.php` to include the `settings.local.php` file

```php
$app_ground = explode('/', $app_root);
array_pop($app_ground);
$app_ground = implode('/', $app_ground);

/**
 * Load custom services definition file.
 */
if (file_exists($app_ground . '/config/drupal/services.local.yml')) {
  $settings['container_yamls'][] = $app_ground . '/config/drupal/services.local.yml';
}

/**
 * Load local development override configuration, if available.
 *
 * Use settings.local.php to override variables on secondary (staging,
 * development, etc) installations of this site. Typically used to disable
 * caching, JavaScript/CSS compression, re-routing of outgoing emails, and
 * other things that should not happen on development and testing sites.
 *
 * Keep this code block at the end of this file to take full effect.
 */
if (file_exists($app_ground . '/config/drupal/settings.local.php')) {
  include $app_ground . '/config/drupal/settings.local.php';
} elseif (file_exists($app_ground . '/config/drupal/settings.travis.php')) {
  include $app_ground . '/config/drupal/settings.travis.php';
}
$settings['install_profile'] = 'standard';
```
- create `conf/services.local.yml` file
- modify the `sites/default/drushrc.php` file by replacing URI with the domain name specified by the user when the starterkit is launched.
```php
 <?php
$options['uri'] = "http://***URI***";
```

- Install the site or build it from an imported sql file

[Back to the top of the page](#shellscripts) | [Return to project summary](../../README.md)

## Use of the build.sh script <a id="build.sh"></a>

This script is used in the install.sh script, but can also be used separately with different options.

Without a parameter, this script  :
- Updates project dependencies
- Initialize drupal console
- Backs up the database
- Install Drupal


### Running the script
To use this script, you must be in the web directory of your project.

To run the script, run the command:
- `../scripts/drupal/build.sh` 
- `bash ../scripts/drupal/build.sh` (if the file does not run)

### Script options
This shell script can accept several parameters:
- --nc (no composer update)
- --nb (no backup database)
- --ndc (no initialization of drupal console)
- --conf="folder" (where `folder` is the name of the folder containing the .yml configuration files). By default conf="sync".
- --dump="dump.sql.gz" (imports dump.sql.gz from the database in the data / db folder )
- --v, vv, vvv, verb, or verbose for verbose mode
- --fast (--nc --nb --ndc)


Exemples:

**Fast mode :** ../scripts/drupal/build.sh --fast (no composer update, no backup database, no initialization of drupal console )

**Import a database :** ../scripts/drupal/build.sh --dump="example.sql.gz"

**Combination of several options :** ../scripts/drupal/build.sh --fast --dump="example.sql.gz"

If you are importing your database from a dump, do a `drush config-import sync -y` to re-import the latest versioned configs.

[Back to the top of the page](#shellscripts) | [Return to project summary](../../README.md)

## Use of the archive.sh script <a id="archive.sh"></a>

To use this script, you must be in the web directory of your project.

To run the script, run the command:
- `../scripts/drupal/archive.sh` 
- `bash ../scripts/drupal/archive.sh` (if the file does not run)

This script does :
- A backup of the database to the `data/db` folder. The name of the generated file is `dump-[data].gz` where `date` is the date the file was generated.
- Compresses all the necessary files for the site. The `data/db` and` config/drupal/local` folders are excluded from the archive except the `dump-[date].gz` file generated by the script. The name of the generated archive file is `archive-[date].tar.gz` where `date` is the date the file was generated.
The file `archive-[date].tar.gz` is generated at the root of the project.

[Back to the top of the page](#shellscripts) | [Return to project summary](../../README.md)

## Use of the ckeditor.sh script <a id="ckeditor.sh"></a>

To use this script, you must be in the web directory of your project.

To run the script, run the command:
- `../scripts/drupal/ckeditor.sh`
- `bash ../scripts/drupal/ckeditor.sh` (if the file does not run)

This script installs modules that add functionality to the WYSIWYG CKEditor editor included in Drupal 8 core.
These modules are:
- **act_ckeditor** : Actency CKEditor custom module extends functionality for the basic CKEditor. You must configure your WYSIWYG toolbar to include the new buttons. For more information, [click here](../../web/modules/custom/act_ckeditor/README.md).
- **anchor_link** : This plugin module adds the better link dialog and anchor link related features to CKEditor in Drupal 8.
- **file_browser** : This module provides a default Entity Browser that lets you browse and select your files in a nice-looking, mobile-ready Masonry based interface, and upload files using the Dropzonejs module. It requires the following modules : entity, embed, dropzonejs, entity_embed, entity_browser, dropzones ,imagesloaded and masonry.
- **imce** : IMCE is an image/file uploader and browser that supports personal directories and quota.
- **layouter** : WYSIWYG layout templates.
- **Youtube** : The YouTube field module provides a simple field that allows you to add a youtube video to a content type, user, or any other Drupal entity.

[Back to the top of the page](#shellscripts) | [Return to project summary](../../README.md)