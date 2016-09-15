<?php
$ua = $_SERVER['HTTP_USER_AGENT'];
$ip = $_SERVER['REMOTE_ADDR'];

if (preg_match("#ia_archiver#", $ua)
   || preg_match('#IEAutoDiscovery#', $ua)
   || preg_match('#larbin_#', $ua)
   || preg_match('#crawler/1#', $ua)
   || preg_match('#findlinks#', $ua)
   || preg_match('#picsearch#', $ua)
   || preg_match('#vig-spider#', $ua)
   || preg_match('#Gigabot#', $ua)
   || preg_match('#sproose#', $ua)
   || preg_match('#deltaSCAN#', $ua)
   || preg_match('#Java/1\.#', $ua)
   || preg_match('#Python-urllib/1\.16#', $ua)
   || preg_match('#Lorkyll#', $ua)
   || preg_match('#ia_archiver#', $ua)
   || preg_match('#WinkySpider#', $ua)
   || preg_match('#Speedy Spider#', $ua)
   || preg_match('#@krugle\.com#', $ua)
   || preg_match('#www.monit24.pl#', $ua)
   || preg_match('#DTS Agent#', $ua)
   || preg_match('#WebAlta#', $ua)
   || preg_match('#libwww-perl#', $ua)

 // powielamy preg_match
   || $ip == "64.208.172.173"
   || $ip == "83.25.229.80" //Java/1.5.0
   || $ip == "66.34.204.26" //www.keywordspy.com
   || $ip == "78.41.240.125" // spam przylazil
   || $ip == "165.139.190.15" // spam
 // powielamy IP
 ) {
// wysyłamy podejrzanego robota w kosmos np. za pomocą
    header("location: http://antyspam.pl/"); exit;
}
/**
 * This file acts as the "front controller" to your application. You can
 * configure your application, modules, and system directories here.
 * PHP error_reporting level may also be changed.
 *
 * @see http://kohanaphp.com
 */

/**
 * Define the website environment status. When this flag is set to TRUE, some
 * module demonstration controllers will result in 404 errors. For more information
 * about this option, read the documentation about deploying Kohana.
 *
 * @see http://docs.kohanaphp.com/installation/deployment
 */
define('IN_PRODUCTION', FALSE);

/**
 * Website application directory. This directory should contain your application
 * configuration, controllers, models, views, and other resources.
 *
 * This path can be absolute or relative to this file.
 */
$kohana_application = 'application';

/**
 * Kohana modules directory. This directory should contain all the modules used
 * by your application. Modules are enabled and disabled by the application
 * configuration file.
 *
 * This path can be absolute or relative to this file.
 */
$kohana_modules = 'modules';

/**
 * Kohana system directory. This directory should contain the core/ directory,
 * and the resources you included in your download of Kohana.
 *
 * This path can be absolute or relative to this file.
 */
$kohana_system = 'system';

/**
 * Test to make sure that Kohana is running on PHP 5.2 or newer. Once you are
 * sure that your environment is compatible with Kohana, you can comment this
 * line out. When running an application on a new server, uncomment this line
 * to check the PHP version quickly.
 */
version_compare(PHP_VERSION, '5.2', '<') and exit('Kohana requires PHP 5.2 or newer.');

/**
 * Set the error reporting level. Unless you have a special need, E_ALL is a
 * good level for error reporting.
 */
error_reporting(E_ALL & ~E_STRICT);

/**
 * Turning off display_errors will effectively disable Kohana error display
 * and logging. You can turn off Kohana errors in application/config/config.php
 */
ini_set('display_errors', TRUE);

/**
 * If you rename all of your .php files to a different extension, set the new
 * extension here. This option can left to .php, even if this file has a
 * different extension.
 */
define('EXT', '.php');
/**
 * Definiuje stałą TIME do wykorzystania w skryptach
 */
define('TIME', time());

/**
 * Definiuje ścieżkę do folderu z backupami
 * 
 * Ścieżka musi być względna!
 */
$backup_path = 'backups';

/**
 * Definiuje ścieżki do folderów dla modułu backupów
 * 
 * Ścieżki muszą być względne!
 */
$backup_dirs = array(
    $kohana_application,
    $kohana_modules,
    'css',
    'js',
    'img',
    'files',
    );

//
// DO NOT EDIT BELOW THIS LINE, UNLESS YOU FULLY UNDERSTAND THE IMPLICATIONS.
// ----------------------------------------------------------------------------
// $Id: index.php 3915 2009-01-20 20:52:20Z zombor $
//

$kohana_pathinfo = pathinfo(__FILE__);
// Define the front controller name and docroot
define('DOCROOT', $kohana_pathinfo['dirname'].DIRECTORY_SEPARATOR);
define('KOHANA',  $kohana_pathinfo['basename']);

// If the front controller is a symlink, change to the real docroot
is_link(KOHANA) and chdir(dirname(realpath(__FILE__)));

// If kohana folders are relative paths, make them absolute.
$kohana_application = file_exists($kohana_application) ? $kohana_application : DOCROOT.$kohana_application;
$kohana_modules = file_exists($kohana_modules) ? $kohana_modules : DOCROOT.$kohana_modules;
$kohana_system = file_exists($kohana_system) ? $kohana_system : DOCROOT.$kohana_system;

// Define application and system paths
define('APPPATH', str_replace('\\', '/', realpath($kohana_application)).'/');
define('MODPATH', str_replace('\\', '/', realpath($kohana_modules)).'/');
define('SYSPATH', str_replace('\\', '/', realpath($kohana_system)).'/');
define('BACKPATH', str_replace('\\', '/', $backup_path).'/');
define('BACKDIRS', implode(';', $backup_dirs));

// Clean up
unset($kohana_application, $kohana_modules, $kohana_system);

if (file_exists(DOCROOT.'install'.EXT))
{
	// Load the installation tests
	include DOCROOT.'install'.EXT;
}
else
{
	// Initialize Kohana
	require SYSPATH.'core/Bootstrap'.EXT;
}