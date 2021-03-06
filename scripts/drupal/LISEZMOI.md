# Shell Scripts <a id="shellscripts"></a>
1. [Lancement du starterkit avec install.sh](#install.sh)
2. [Utilisation du script build.sh](#build.sh)
3. [Utilisation du script archive.sh](#archive.sh)
4. [Utilisation du script ckeditor.sh](#ckeditor.sh)

## Lancement du starterkit avec install.sh <a id="install.sh"></a>
Pour lancer l'installation d'un nouveau projet Drupal 8, procédez de la manière suivante :

1. Modifier le fichier docker-compose.yml qui se trouve à la racine de votre projet,
2. Lancer le script install.sh.

### Modification du fichier docker-compose.yml
Modifier le fichier docker-compose.yml qui se trouve à la racine de votre projet afin qu’il corresponde à votre configuration locale.

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
- remplacer `example` et `path` par votre configuration locale,
- lancer la commande `docker-compose up -d` ou son alias `dcup` pour lancer les containers.

Rq: En cas de modification d'une configuration avancée du fichier docker-compose.yml il est parfois nécessaire de recréer les containers pour que la modification soit prise en compte. Dans ce cas lancez la commande suivante : `dcup --force-recreate`
- lancer la commande `go [nom_container_web_1] bash`. Cette commande permet d'entrer dans le container `nom_container_web_1`.

Rq : Si vous avez un doute sur le nom du container, vous pouvez lancer la commande `docker ps`. Cette commande liste les containers.


### Lancer le script install.sh


Placez-vous dans le dossier web de votre projet Drupal et lancer la commande  `bash ../scripts/drupal/install.sh`.

Suivez les instructions.

#### Que fait ce script ?

Ce script s'occupe de :
- Modifier la valeur memory_limit du fichier php.ini à -1 (si l'utilisateur autorise cette modification). Dans usr/local/etc/php/php.ini la valeur memory_limit est par défaut à 512M. Sans cette modification Composer échouera l'installation ou la mise à jour des dépendances et affichera le message d'erreur `PHP Fatal error: Allowed memory size of XXXXXX bytes exhausted ...`.
- lancer l'installation des dépendances du projet
- Génèrer un hash salt utilisé par Drupal pour la génération d'uuid. La mécanique de génération est celle utilisée par Drupal de façon standard.
- Créer le fichier `settings.local.php` dans le dossier `config/drupal` avec les informations de la bases de données et le nom de domaine que l'utilisateur aura renseigné dans le terminal lors du lancement du script. 
- Modifier le fichier settings.php dans sites/default/settings.php afin qu’il inclut le fichier settings.local.php

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

[Retourner au sommaire de la page](#shellscripts) | [Retourner au sommaire du projet](../../LISEZMOI.md)
## Utilisation du script build.sh <a id="build.sh"></a>

Ce script est utilisé dans le script install.sh, mais peut également être utilisé séparément avec différentes options.

Sans paramètre, ce script  :
- Met à jour les dépendances du projet 
- Initialise drupal console
- Effectue une sauvegarde de la base de données
- Installe un Drupal vierge


### Exécution du script
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

[Retourner au sommaire de la page](#shellscripts) | [Retourner au sommaire du projet](../../LISEZMOI.md)

## Utilisation du script archive.sh <a id="archive.sh"></a>

Pour utiliser ce script, vous devez être dans le répertoire web de votre projet.

Pour exécuter le script, lancer la commande :
- `../scripts/drupal/archive.sh` 
- `bash ../scripts/drupal/archive.sh` (si le fichier ne s'exécute pas)

Ce script effectu :
- une sauvegarde de la base de données dans le dossier `data/db`. Le fichier généré se nomme `dump-[data].gz` où `date` est la date à laquelle le fichier a été généré.
- compresse tous les dossiers nécessaires au site. Les dossiers `data/db` et `config/drupal/local` sont exclus de l'archive à l'exeption du fichier `dump-[date].gz` généré par le script. Le fichier d'archive se nomme `archive-[date].tar.gz` où `date` est la date à laquelle le fichier a été généré.
Le fichier `archive-[date].tar.gz` est généré à la racine du projet.

[Retourner au sommaire de la page](#shellscripts) | [Retourner au sommaire du projet](../../LISEZMOI.md)

## Utilisation du script ckeditor.sh <a id="ckeditor.sh"></a>

Pour utiliser ce script, vous devez être dans le répertoire web de votre projet.

Pour exécuter le script, lancer la commande :
- `../scripts/drupal/ckeditor.sh`
- `bash ../scripts/drupal/ckeditor.sh` (si le fichier ne s'exécute pas)

Ce script installe des modules qui ajoutent des fonctionnalités à l’éditeur WYSIWYG CKEditor inclus dans Drupal 8 core.
Il s’agit des modules suivant :
- **act_ckeditor** : Le module custom  CKEditor Actency étend les fonctionnalités de base de CKEditor. Pour plus d'information [cliquez ici](../../web/modules/custom/act_ckeditor/LISEZMOI.md).
- **anchor_link** : Ce module ajoute une boîte de dialogue qui gère mieux les liens hypertexte et les ancres dans le CKEditor de Drupal 8.
- **file_browser** : Ce module fournit un Navigateur d’Entité qui vous permet de parcourir et de sélectionner vos fichiers dans une interface basée sur Masonry, et de télécharger des fichiers en utilisant le module Dropzonejs. Il requiert les modules suivant: entity, embed, dropzonejs, entity_embed, entity_browser, et les librairies dropzones ,imagesloaded and masonry.
- **Imce** : IMCE est un uploader d'image / fichier et un navigateur qui prend en charge les répertoires personnels et les quotas.
- **layouter** : Via une interface WYSIWYG, il permet de choisir un modèles de mise en page. Ce module doit être configuré (/admin/config/content/layouter) avant de pouvoir être utilisé une première fois.
- **Youtube** : Le module de champ YouTube fournit un champ simple qui vous permet d'ajouter une vidéo youtube à un type de contenu, à un utilisateur ou à toute autre entité Drupal.

[Retourner au sommaire de la page](#shellscripts) | [Retourner au sommaire du projet](../../LISEZMOI.md)