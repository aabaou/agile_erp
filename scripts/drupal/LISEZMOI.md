# Shell Scripts
1. [Lancement du starterkit avec install.sh](#install.sh)
2. [Utilisation du build.sh](#build.sh)

##Lancement du starterkit avec install.sh <a id="install.sh"></a>
Pour lancer l'installation d'un nouveau projet Drupal 8, procédez de la manière suivante :

1. Modifier le fichier docker-compose.yml qui se trouve à la racine de votre projet,
2. Lancer le script install.sh.

### Modification du fichier docker-compose.yml
Modifier le fichier docker-compose.yml qui se trouve à la racine de votre projet afin qu’il corresponde à votre configuration locale.

````
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
- remplacer `example` et `path` par votre configuration locale
- lancer la commande `docker-compose up`
- lancer la commande `go [nom_container_web_1] bash`


### Lancer le script install.sh


Placez-vous dans le dossier web de votre projet Drupal et lancer la commande  `bash ../scprits/drupal/install.sh`.

Suivez les instructions.

#### Que fait ce script?

Ce script s'occupe de :
- lancer l'installation des dépendances du projet
- Génèrer un salt
- Créer le fichier `settings.local.php` dans le dossier `config/drupal` avec les informations de la bases de données et le nom de domaine que l'utilisateur aura renseigné dans le terminal lors du lancement du script. 
- Modifier le fichier settings.php dans sites/default/settings.php afin qu’il inclus le fichier settings.local.php

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
- génèrer le fichier conf/services.local.yml
- Modifier le fichier sites/default/drushrc.php en remplaçant URI par le nom de domaine renseigné par l'utilisateur lors du lancement du starterkit.
```php
 <?php
$options['uri'] = "http://***URI***";
```

- Installer le site ou le construire à partir d'un fichier sql importé

## Utilisation du build.sh <a id="build.sh"></a>

Ce script est utilisé dans le script install.sh, mais peut également être utilisé séparément avec différentes options.

Sans paramètre, ce script  :
- Met à jour les dépendances du projet 
- Initialise drupal console
- Effectue une sauvegarde de la base de données
- Installe un Drupal vierge


###Exécution du script
Pour utiliser ce script, vous devez être dans le répertoire web de votre projet.

Pour exécuter le script, lancer la commande :
- `../scripts/drupal/build.sh` 
- `bash ../scripts/drupal/build.sh` (si le fichier ne s'exécute pas)

### Options du script
Il s'agit d'un script shell bash qui peut accepter plusieurs paramètres :
- --nc (n'effectue pas de composer update)
- --nb (n'effectue pas de sauvegarde de la base de données)
- --ndc (n'effectue pas d'initialisation de drupal console)
- --conf="dossier" (où `dossier` est le nom du dossier contenant les fichiers de configuration .yml). Par défaut conf="sync".
- --dump="dump.sql.gz" (importe la sauvegarde dump.sql.gz de la base de données qui se trouve dans le dossier data/db )
- --v, vv, vvv, verb, ou verbose pour le mode verbose
- --fast (--nc --nb --ndc)


Exemples:

**Version rapide :** ../scripts/drupal/build.sh --fast (pas de composer update, pas de sauvegarde de la base de données, pas d'initialisation de drupal console )

**Importer depuis un dump :** ../scripts/drupal/build.sh --dump="example.sql.gz"

**Combinaison de plusieurs options :** ../scripts/drupal/build.sh --fast --dump="example.sql.gz"

Si vous importez votre base de données depuis un dump, penser à faire un `drush config-import sync –y` pour ré-importer les dernières configs versionnées.
