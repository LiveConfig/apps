#!/usr/bin/php
<?php
/** _    _          ___           __ _     (R)
 * | |  (_)_ _____ / __|___ _ _  / _(_)__ _
 * | |__| \ V / -_) (__/ _ \ ' \|  _| / _` |
 * |____|_|\_/\___|\___\___/_||_|_| |_\__, |
 *                                    |___/
 * LiveConfig Web Application Installer (LC WAI)
 * Web-App-Name: WordPress
 * Web-App-Version: 6.8.2
 * @author Christoph Russow
 * @copyright Copyright (c) 2009-2025 LiveConfig GmbH.
 * @version 1.0
 * --------------------------------------------------------------------------
 */

define('WAI_INCLUDE', 'yes');
require_once("installer.inc.php");
if (!version_compare(WAI_API_VERSION, "1.0.1", ">=")) { die("ERROR Wrong API version in installer library - please update your LiveConfig installation!\n"); }
$installer = new Installer();

/*
 * Configuration starts here
 */

$LCWAI_APPINFOS = array(
  'name' => "WordPress",
  'icon' => "ico-wordpress.svg",
  'version' => "6.8.2",
  'version_major' => 6,
  'version_minor' => 8,
  'version_patch' => 2,
  'version_extra' => 0,
  'inst_name' => "wai-wordpress-6.8.2-1.php",
  'inst_version' => 1,
  'release_date' => "2025-07-15 00:00:00",
  'rq_mysql_min' => "8.0",
  'rq_mysql_max' => null,
  'rq_php_min' => "7.4",
  'rq_php_max' => null,
  'title' => array(
    'de' => "WordPress",
    'en' => "WordPress",
  ),
  'desc_short' => array(
    'de' => "Blog/CMS",
    'en' => "Blog/CMS",
  ),
  'desc_long' => array(
    'de' => "WordPress ist eine sehr leicht zu bedienende aber gleichzeitig flexible und erweiterbare Software zur Verwaltung der Inhalte einer Website. Häufig wird WordPress für Weblogs (Blogs) eingesetzt, aber auch \"normale\" Websites lassen sich damit einfach und schnell realisieren.",
    'en' => "WordPress is a simple to use and flexible software to manage website contents. Mostly it is used for weblogs (blogs), but also \"normal\" websites can be built with WordPress fast and easily.",
  ),
  'vendor_url' => array(
    'de' => "http://www.wordpress.org",
    'en' => "http://www.wordpress.org",
  ),
);

/* Files to download */
$LCWAI_DOWNLOADS['ALL'] = array( // Downloads for ALL languages
);
$LCWAI_DOWNLOADS['de'] = array( // Downloads for 'de' (german) language
  'PACKAGE' => array('NAME' => 'wordpress-6.8.2-de_DE.tar.gz',
                     'SHA1' => '3f5c3462e67aaad2a3c916c75e85223059534a29',
                     'URL'  => 'http://download.liveconfig.com/cache/wordpress-6.8.2-de_DE.tar.gz',
                     'SRC'  => 'https://de.wordpress.org/wordpress-6.8.2-de_DE.tar.gz'),
);
$LCWAI_DOWNLOADS['en'] = array( // Downloads for 'en' (english) language
  'PACKAGE' => array('NAME' => 'wordpress-6.8.2.tar.gz',
                     'SHA1' => '03baad10b8f9a416a3e10b89010d811d9361e468',
                     'URL'  => 'http://download.liveconfig.com/cache/wordpress-6.8.2.tar.gz',
                     'SRC'  => 'https://wordpress.org/wordpress-6.8.2.tar.gz'),
);
$LCWAI_DOWNLOADS['es'] = array( // Downloads for 'es' (spanish) language
  'PACKAGE' => array('NAME' => 'wordpress-6.8.2-es_ES.tar.gz',
                     'SHA1' => '262fb41045aebb48c2cefea8252dbef6e044e896',
                     'URL'  => 'http://download.liveconfig.com/cache/wordpress-6.8.2-es_ES.tar.gz',
                     'SRC'  => 'https://es.wordpress.org/wordpress-6.8.2-es_ES.tar.gz'),
);
$LCWAI_DOWNLOADS['fr'] = array( // Downloads for 'fr' (french) language
  'PACKAGE' => array('NAME' => 'wordpress-6.8.2-fr_FR.tar.gz',
                     'SHA1' => '08a16b2bbff13e4915b134c355072d24319c2aa6',
                     'URL'  => 'http://download.liveconfig.com/cache/wordpress-6.8.2-fr_FR.tar.gz',
                     'SRC'  => 'https://fr.wordpress.org/wordpress-6.8.2-fr_FR.tar.gz'),
);
$LCWAI_DOWNLOADS['hr'] = array( // Downloads for 'hr' (croatian) language
  'PACKAGE' => array('NAME' => 'wordpress-6.8.2-hr.tar.gz',
                     'SHA1' => '411fe385fc059641ff376d1baa50db9f2287f86f',
                     'URL'  => 'http://download.liveconfig.com/cache/wordpress-6.8.2-hr.tar.gz',
                     'SRC'  => 'https://hr.wordpress.org/wordpress-6.8.2-hr.tar.gz'),
);
$LCWAI_DOWNLOADS['nl'] = array( // Downloads for 'nl' (dutch) language
  'PACKAGE' => array('NAME' => 'wordpress-6.8.2-nl_NL.tar.gz',
                     'SHA1' => '5fd3da05f58a7bdef7380c5923aa03cc2974afd9',
                     'URL'  => 'http://download.liveconfig.com/cache/wordpress-6.8.2-nl_NL.tar.gz',
                     'SRC'  => 'https://nl.wordpress.org/wordpress-6.8.2-nl_NL.tar.gz'),
);
$LCWAI_DOWNLOADS['sr'] = array( // Downloads for 'sr' (serbian) language
  'PACKAGE' => array('NAME' => 'wordpress-6.7.2-sr_RS.tar.gz',
                     'SHA1' => '90a17d68afc9e2656c79ad2ffbe8e26eb14d05b1',
                     'URL'  => 'http://download.liveconfig.com/cache/wordpress-6.7.2-sr_RS.tar.gz',
                     'SRC'  => 'https://sr.wordpress.org/wordpress-6.7.2-sr_RS.tar.gz'),
#  'PACKAGE' => array('NAME' => 'wordpress-6.6.1.tar.gz',
#                     'SHA1' => 'cd5544c85824e3cd8105018c63ccdba31883d881',
#                     'URL'  => 'http://download.liveconfig.com/cache/wordpress-6.6.1.tar.gz',
#                     'SRC'  => 'https://wordpress.org/wordpress-6.6.1.tar.gz'),
);
$LCWAI_DOWNLOADS['cz'] = array( // Downloads for 'cz' (czech) language
  'PACKAGE' => array('NAME' => 'wordpress-6.7.2-cs_CZ.tar.gz',
                     'SHA1' => '2b739f86a60e60a4b7d9a985a43c8292788abb47',
                     'URL'  => 'http://download.liveconfig.com/cache/wordpress-6.7.2-cs_CZ.tar.gz',
                     'SRC'  => 'https://cs.wordpress.org/wordpress-6.7.2-cs_CZ.tar.gz'),
);

/* Variables Liveconfig has to ask the user */
$LCWAI_USER_VARS = array();
/*
$LCWAI_USER_VARS[0] = array(
  'name' => 'LC_TABLE_PREFIX',
  'type' => 'text',
  'regex' => 'regex',
  'displaytext' => array(
    'de' => 'Tabellenpräfix',
    'en' => 'Tableprefix'
  ),
  'description' => array(
    'de' => 'Einen Tabellenpräfix vergeben oder den zufällig generierten belassen. Idealerweise besteht dieser aus 3 bis 4 Zeichen, enthält nur alphanumerische Zeichen und MUSS mit einem Unterstrich enden.',
    'en' => 'Choose a table prefix or use the randomly generated. Ideally, three or four characters long, contain only alphanumeric characters, and MUST end in an underscore.'
  ),
  'defaultvalue' => array(
    'de' => $installer->get_random_str(3).'_',
    'en' => $installer->get_random_str(3).'_',
  ),
);
*/

/*
 * Program logic
 *   starts here
 */

switch($argv[1]) {
  case 'getvars':
    $installer->wai_getvars($LCWAI_USER_VARS);
    break;
  case 'install':
    wai_install();
    break;
  case 'uninstall':
    wai_uninstall();
    break;
  case 'update':
    $installer->wai_update();
    break;
  case 'upgrade':
    $installer->wai_upgrade();
    break;
  case 'download':
    $installer->wai_download($LCWAI_DOWNLOADS);
    break;
  case 'getversion':
    wai_getversion();
    break;
  case 'getrepo':
    print json_encode($LCWAI_APPINFOS);
    break;
  default:
    print "Usage ".$argv[0]." getvars|install|uninstall|update|upgrade|download|getversion\n";
    exit;
}

exit;

/*
 * Definition of package specific functions
 *  starts here
 */

/*
 * wai_install()
 *   installs the package
 */
function wai_install() {
  global $LCWAI_DOWNLOADS;
  global $installer;
  //entpacken
  //installations vorgang durchführen
  if(($vars = $installer->get_env_vars(array('LC_DST', 'LC_SRC', 'LC_LANG', 'LC_MYSQL_DB', 'LC_MYSQL_USER', 'LC_MYSQL_PW', 'LC_MYSQL_HOST', 'LC_RUN_AS_USER'), array('MYSQL_PORT'))) === false) {
    return;
  }

  if(!is_dir($vars['LC_DST'])) {
    print "ERROR destination '" . $vars['LC_DST'] . "' is not a directory\n";
    return;
  }

  if (!isset($LCWAI_DOWNLOADS[$vars['LC_LANG']]) || !isset($LCWAI_DOWNLOADS[$vars['LC_LANG']]['PACKAGE'])) {
    $vars['LC_LANG'] = 'en';
  }

  if($installer->package_extract($vars['LC_DST'], $vars['LC_SRC'].'/'.$LCWAI_DOWNLOADS[$vars['LC_LANG']]['PACKAGE']['NAME']) === false) {
    return;
  }

  if($installer->move($vars['LC_DST']."/wordpress/*", $vars['LC_DST']."/") === false) {
    return;
  }

  //create settings file
  $cfg_src_file = $vars['LC_DST'].'/wp-config-sample.php';
  $cfg_dst_file = $vars['LC_DST'].'/wp-config.php';

  if(($cfg_content = file_get_contents($cfg_src_file)) === false) {
    print "ERROR failed to read configfile template\n";
    return;
  }

  $mysql_db     = "define('DB_NAME', '".$vars['LC_MYSQL_DB']."');";
  $mysql_user   = "define('DB_USER', '".$vars['LC_MYSQL_USER']."');";
  $mysql_pw     = "define('DB_PASSWORD', '".$vars['LC_MYSQL_PW']."');";
  $mysql_host   = "define('DB_HOST', '".$vars['LC_MYSQL_HOST']."');";
  $mysql_prefix = "\\\$table_prefix  = 'wp_';";

  $cfg_content = preg_replace("/define\(\s*'DB_NAME',\s*'.*?'\s*\);/",      $mysql_db,      $cfg_content);
  $cfg_content = preg_replace("/define\(\s*'DB_USER',\s*'.*?'\s*\);/",      $mysql_user,    $cfg_content);
  $cfg_content = preg_replace("/define\(\s*'DB_PASSWORD',\s*'.*?'\s*\);/",  $mysql_pw,      $cfg_content);
  $cfg_content = preg_replace("/define\(\s*'DB_HOST',\s*'.*?'\s*\);/",      $mysql_host,    $cfg_content);
  $cfg_content = preg_replace("/\$table_prefix\s*=\s*'.*?';/",       $mysql_prefix,  $cfg_content);

  $auth_key         = "define('AUTH_KEY', '".$installer->get_random_str(60, true)."');";
  $secure_aut_key   = "define('SECURE_AUTH_KEY', '".$installer->get_random_str(60, true)."');";
  $logged_in_key    = "define('LOGGED_IN_KEY', '".$installer->get_random_str(60, true)."');";
  $nonce_key        = "define('NONCE_KEY', '".$installer->get_random_str(60, true)."');";
  $aut_salt         = "define('AUTH_SALT', '".$installer->get_random_str(60, true)."');";
  $secure_aut_salt  = "define('SECURE_AUTH_SALT', '".$installer->get_random_str(60, true)."');";
  $logged_in_salt   = "define('LOGGED_IN_SALT', '".$installer->get_random_str(60, true)."');";
  $nonce_salt       = "define('NONCE_SALT', '".$installer->get_random_str(60, true)."');";

  $cfg_content = preg_replace("/define\(\s*'AUTH_KEY',\s*'.*?'\s*\);/" , $auth_key , $cfg_content);
  $cfg_content = preg_replace("/define\(\s*'SECURE_AUTH_KEY',\s*'.*?'\s*\);/" , $secure_aut_key , $cfg_content);
  $cfg_content = preg_replace("/define\(\s*'LOGGED_IN_KEY',\s*'.*?'\s*\);/" , $logged_in_key , $cfg_content);
  $cfg_content = preg_replace("/define\(\s*'NONCE_KEY',\s*'.*?'\s*\);/" , $nonce_key , $cfg_content);
  $cfg_content = preg_replace("/define\(\s*'AUTH_SALT',\s*'.*?'\s*\);/" , $aut_salt , $cfg_content);
  $cfg_content = preg_replace("/define\(\s*'SECURE_AUTH_SALT',\s*'.*?'\s*\);/" , $secure_aut_salt , $cfg_content);
  $cfg_content = preg_replace("/define\(\s*'LOGGED_IN_SALT',\s*'.*?'\s*\);/" , $logged_in_salt , $cfg_content);
  $cfg_content = preg_replace("/define\(\s*'NONCE_SALT',\s*'.*?'\s*\);/" , $nonce_salt , $cfg_content);

  if (file_put_contents($cfg_dst_file, $cfg_content) === false) {
    print "ERROR failed to write config file\n";
    return;
  }

  if($vars['LC_RUN_AS_USER'] == "no") {
    //ToDo: chmod files directory o+w
    if($installer->chmod($vars['LC_DST'].'/wp-content', 0666, 0777, true) === false) {
      print "ERROR failed to chmod wp-content directory!\n";
      return;
    }
  }

  print "OK\n";

  //give liveconfig the url to present a link to the user where he/she can finish the installation
  print "forward_url\t/\n";
  print "admin_url\t/wp-admin/\n";
}

/*
 * wai_uninstall()
 *   deinstalls the package
 */
function wai_uninstall() {
  global $installer;
  if(($vars = $installer->get_env_vars(array('LC_DST'))) === false) {
    return;
  }

  if($installer->remove($vars['LC_DST']."/*") === false) {
    return;
  }

  print "OK\n";
}

/*
 * wai_getversion()
 *   returns the current installed package version
 */
function wai_getversion() {
  global $installer;

  if(($vars = $installer->get_env_vars(array('LC_DST'))) === false) {
    return;
  }

  if(!is_dir($vars['LC_DST'])) {
    print "ERROR destination '" . $vars['LC_DST'] . "' is not a directory\n";
    return;
  }

  include($vars['LC_DST']."/wp-includes/version.php");
  print "OK\n";
  print "version\t".$wp_version."\n";
}

?>
