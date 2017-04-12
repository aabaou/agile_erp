# drup8cy
Drupency for Drupal 8 starterkit

## Docker Box usage

Just copy the docker-compose.yml.dist file and paste as docker-compose.yml, then
- adapt local file parameters to match with your local setup
- run `docker-compose up`
- run `go [web-docker-container-id] bash`

## Local settings file

You can use your own local settings file to override any configuration available.
To do so just create a `settings.local.php` file in `config/drupal/` from `config/drupal/example.settings.local.php` with the wanted overrides you can use bash script **test4.sh**.
Here is an example :

```php
/**
 * System configurations.
 */
// If you run the build script before creating your local settings file,
// the script will generate an example hash salt for you.
// If you use test4 script it will ask you questions in order to automatically generate "settings.local.php". 
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
$settings['file_public_path'] = $app_ground . '/data/files/public';
$settings['file_private_path'] = $app_ground . '/data/files/private';

```