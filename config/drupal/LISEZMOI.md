Ce repertoire contient toute la configuration du site :
- fichiers .yml
- fichiers settings

Pour Drupal 8, le repertoire `sync` contenant les fichiers de configuration du site se trouve désormais dans le dossier `config/drupal`.

Il est ainsi hors des fichiers servis par le serveur web en surchargeant le chemin dans le fichier settings.php afin d’éviter que n’importe qui puisse les récupérer en cas de mauvaise configuration du serveur.

## Création du fichier settings.local.php à partir du script install.sh

Le fichier settings.local.php contient les informations de la base de données, le nom de domaine et le hash salt. Ce fichier sera généré par le script install.sh à partir du fichier example.settings.local.php.

voir [lancement du starterkit](../../scripts/drupal/LISEZMOI.md).
## Création manuelle du fichier settings.local.php
1. Copier le fichier example.settings.local.php
2. Nommer la copie settings.local.php
3. Adapter le fichier à votre configuration locale.

````php
/**
 * System configurations.
 */
// If you run the build script before creating your local settings file,
// the script will generate an example hash salt for you.
$settings['hash_salt'] = '***GENERATE SALT***';
$settings['trusted_host_patterns'] = array(
  '^***PRIOB***\.***LOC***$',
);
$databases['default']['default'] = array (
  'database' => '***DATABASE***',
  'username' => '***USERNAME***',
  'password' => '***PASSWORD***',
  'prefix' => '',
  'host' => 'mysql',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$config_directories['sync'] = $app_ground . '/config/drupal/sync';
$config_directories['local'] = $app_ground . '/config/drupal/local';
/**
 * Files configurations.
 */
$settings['file_public_base_url'] = 'http://***DOMAIN***/files';
$settings['file_public_path'] = $app_ground . '/web/sites/default/files';
$settings['file_private_path'] = $app_ground . '/data/files/private';
````
Le fichier settings.travis.php sera utilisé pour les tests