#!/usr/bin/php
<?php
/** _    _          ___           __ _     (R)
 * | |  (_)_ _____ / __|___ _ _  / _(_)__ _
 * | |__| \ V / -_) (__/ _ \ ' \|  _| / _` |
 * |____|_|\_/\___|\___\___/_||_|_| |_\__, |
 *                                    |___/
 * LiveConfig Web Application Installer (LC WAI)
 * Web-App-Name: Roundcube
 * Web-App-Version: 1.6.12
 * $Id: wai-roundcube-1.6.12-1.php 781 2025-12-18 15:15:30Z kk $
 * @author Christoph Russow, Klaus Keppler
 * @copyright Copyright (c) 2009-2025 LiveConfig GmbH.
 * @version 1.0
 * --------------------------------------------------------------------------
 */

define('WAI_INCLUDE', 'yes');
require_once("installer.inc.php");
if (!version_compare(WAI_API_VERSION, "1.0.2", ">=")) { die("ERROR Wrong API version in installer library - please update your LiveConfig installation!\n"); }
if (!version_compare(PHP_VERSION, "5.3.0", ">=")) { die("ERROR PHP < 5.3.0 is not supported! (Current Version: ". PHP_VERSION .")"); }
if (!extension_loaded("mysqli")) { die("ERROR MySQLi Extension required but not loaded!"); }
$installer = new Installer();

/*
 * Configuration starts here
 */

$LCWAI_APPINFOS = array(
  'name' => "Roundcube",
  'icon' => "ico-roundcube.svg",
  'version' => "1.6.12",
  'version_major' => 1,
  'version_minor' => 6,
  'version_patch' => 12,
  'version_extra' => 0,
  'inst_name' => "wai-roundcube-1.6.12-2.php",
  'inst_version' => 3,
  'release_date' => "2025-12-13 00:00:00",
  'rq_mysql_min' => "5.0",
  'rq_mysql_max' => null,
  'rq_php_min' => "5.3",
  'rq_php_max' => null,
  'title' => array(
    'de' => "Roundcube",
    'en' => "Roundcube",
  ),
  'desc_short' => array(
    'de' => "E-Mail",
    'en' => "E-Mail",
  ),
  'desc_long' => array(
    'de' => "Roundcube Webmail ist ein Browser-basierter, mehrsprachiger IMAP-Client mit einer Programm-ähnlichen Benutzeroberfläche. Es bietet den vollen Funktionsumfang, den man von einem E-Mail-Programm erwartet, inklusive MIME-Unterstützung, Addressbuch, Ordnerverwaltung, Nachrichtensuche und Rechtschreibprüfung.",
    'en' => "Roundcube webmail is a browser-based multilingual IMAP client with an application-like user interface. It provides full functionality you expect from an e-mail client, including MIME support, address book, folder manipulation, message searching and spell checking.",
  ),
  'vendor_url' => array(
    'de' => "http://roundcube.net",
    'en' => "http://roundcube.net",
  ),
);

/* Files to download */
$LCWAI_DOWNLOADS['ALL'] = array( // Downloads for ALL languages
  'PACKAGE' => array('NAME' => 'roundcubemail-1.6.12-complete.tar.gz',
                     'SHA1' => '544bc6b91a19bf1cc4a1255c5106a732325e1ce7',
                     'URL'  => 'https://github.com/roundcube/roundcubemail/releases/download/1.6.12/roundcubemail-1.6.12-complete.tar.gz'),

  'PASSWORD_PLUGIN' => array('NAME' => 'liveconfig.php',
                             'SHA1' => '825f433af92c6b18089f557355145eba3f892b22',
                             'URL' => 'https://raw.githubusercontent.com/LiveConfig/roundcubemail/master/plugins/password/drivers/liveconfig.php'),
);

/* Variables Liveconfig has to ask the user */
$LCWAI_USER_VARS[0] = array(
  'name' => 'LC_MAILSERVER',
  'type' => 'text',
  'regex' => '^(((tls|ssl)://)?[a-zA-Z0-9]([a-zA-Z0-9-]*[a-zA-Z0-9])?(\.[a-zA-Z0-9]([a-zA-Z0-9-]*[a-zA-Z0-9])?)*(,((tls|ssl)://)?[a-zA-Z0-9]([a-zA-Z0-9-]*[a-zA-Z0-9])?(\.[a-zA-Z0-9]([a-zA-Z0-9-]*[a-zA-Z0-9])?)*)*)?$',
  'title' => array(
    'de' => 'Mailserver-Adresse',
    'en' => 'Mailserver address',
  ),
  'description' => array(
    'de' => 'Optional: geben Sie den Namen eines oder (Komma-getrennt) mehrerer IMAP-Server an, bei denen Anwender sich anmelden dürfen.',
    'en' => 'Optional: enter the names of one or more (comma-separated) IMAP servers where connections are allowed to.',
  ),
  'defaultvalue' => array(
    'de' => 'localhost',
    'en' => 'localhost',
  ),
);
$LCWAI_USER_VARS[1] = array(
  'name' => 'LC_PASSWORD_CHANGE_PLUGIN',
  'type' => 'checkbox',
  'regex' => '^1?$',
  'title' => array(
    'de' => 'Passwort-Plugin installieren',
    'en' => 'Install password plugin'
  ),
  'description' => array(
    'de' => 'Mit diesem Plugin können Benutzer ihr E-Mail-Passwort direkt aus Roundcube heraus ändern.',
    'en' => 'With this plugin users can change their e-mail account password directly within Roundcube.'
  ),
  'defaultvalue' => array(
    'de' => '1',
    'en' => '1',
  ),
);
$LCWAI_USER_VARS[2] = array(
  'name' => 'LC_SERVER_HOST',
  'type' => 'text',
  'regex' => '^([a-z0-9][a-z0-9-]*(\.[a-z0-9][a-z0-9-]*)+)?$',
  'title' => array(
    'de' => 'LiveConfig-Server',
    'en' => 'LiveConfig Server',
  ),
  'description' => array(
    'de' => 'Der Hostname unter dem der LiveConfig-Server erreichbar ist. Wird nur benötigt wenn das Passwort-Plugin installiert wird.',
    'en' => 'The host name of your LiveConfig server. Only required when installing the password plugin.',
  ),
  'defaultvalue' => array(
    'de' => '',
    'en' => '',
  ),
);
$LCWAI_USER_VARS[3] = array(
  'name' => 'LC_SERVER_PORT',
  'type' => 'text',
  'regex' => '^([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])?$',
  'title' => array(
    'de' => 'LiveConfig-Port',
    'en' => 'LiveConfig Port',
  ),
  'description' => array(
    'de' => 'Der Port unter dem der LiveConfig-Server erreichbar ist. Wird nur benötigt wenn das Passwort-Plugin installiert wird.',
    'en' => 'The port of your LiveConfig server. Only required when installing the password plugin.',
  ),
  'defaultvalue' => array(
    'de' => '8443',
    'en' => '8443',
  ),
);
$LCWAI_USER_VARS[4] = array(
  'name' => 'LC_SERVER_CERT_SELFSIGNED',
  'type' => 'checkbox',
  'regex' => '^1?$',
  'title' => array(
    'de' => 'selbstsigniertes LiveConfig-Zertifikat',
    'en' => 'self-signed LiveConfig certificate'
  ),
  'description' => array(
    'de' => 'Wenn Ihr LiveConfig ein selbstsigniertes SSL-Zertifikat verwendet muss dieser Haken gesetzt werden. Nur notwendig wenn das Passwort-Plugin installiert wird.',
    'en' => 'If your LiveConfig is using a self-signed SSL certificate you need to mark this checkbox. Only required when installing the password plugin.'
  ),
  'defaultvalue' => array(
    'de' => '1',
    'en' => '1',
  ),
);

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
    wai_update();
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
    print "Usage ".$argv[0]." getvars|install|uninstall|update|download|getversion\n";
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
  global $LCWAI_USER_VARS;

  $required = array('LC_DST', 'LC_SRC', 'LC_LANG', 'LC_MYSQL_DB', 'LC_MYSQL_USER', 'LC_MYSQL_PW', 'LC_MYSQL_HOST', 'LC_RUN_AS_USER');
  //, 'LC_MAILSERVER', 'LC_PASSWORD_CHANGE_PLUGIN', 'LC_SERVER_HOST', 'LC_SERVER_PORT', 'LC_SERVER_CERT_SELFSIGNED'
  $optional = array('LC_MYSQL_PORT');

  foreach($LCWAI_USER_VARS as $variable) { // add user variables
    array_push($required, $variable['name']);
    if ($variable['type']=='checkbox' && !getenv($variable['name'])) {
      putenv($variable['name'] . "=0");
    }
  }

  if(($vars = $installer->get_env_vars($required, $optional)) === false) {
    return;
  }

  if(!is_dir($vars['LC_DST'])) {
    print "ERROR destination not a directory\n";
    return;
  }

  //extract archive
  if($installer->package_extract($vars['LC_DST'], $vars['LC_SRC'].'/'.$LCWAI_DOWNLOADS['ALL']['PACKAGE']['NAME']) === false) {
    return;
  }

  //move files out of "root"-directory
  if($installer->move($vars['LC_DST']."/roundcubemail-1.6.12/*", $vars['LC_DST']."/") === false) {
    return;
  }

  //remove the "root"-directory
  if($installer->remove($vars['LC_DST']."/roundcubemail-1.6.12") === false) {
    return;
  }

  // patch .htaccess file (replace 'FollowSymLinks' with 'SymLinksIfOwnerMatch'
  exec("sed -i -e 's/^Options +FollowSymLinks/Options +SymLinksIfOwnerMatch/' '" . $vars['LC_DST'] . "/.htaccess'");

  date_default_timezone_set('Europe/Berlin');
  //create config files
  //main.inc.php
  if(($main_config = file_get_contents($vars['LC_DST']."/config/config.inc.php.sample")) === false) {
    return;
  }
  $server = explode(",", $vars['LC_MAILSERVER']);
  if(empty($server)) {
    $srv_string = "''";
  } elseif(count($server) == 1) {
    $srv_string = "'".$server[0]."'";
  } else {
    $srv_string = "array('".implode("','", $server)."')";
  }
  $main_config = str_replace("\$config['default_host'] = 'localhost';", "\$config['default_host'] = ".$srv_string.";", $main_config);

  $dsn_str = "mysqli://".$vars['LC_MYSQL_USER'].":".$vars['LC_MYSQL_PW']."@".$vars['LC_MYSQL_HOST']."/".$vars['LC_MYSQL_DB'];
  $main_config = str_replace("\$config['db_dsnw'] = 'mysql://roundcube:pass@localhost/roundcubemail';", "\$config['db_dsnw'] = '".$dsn_str."';", $main_config);
  $main_config = str_replace("\$config['des_key'] = 'rcmail-!24ByteDESkey*Str';", "\$config['des_key'] = '".$installer->get_random_str(24, true)."';", $main_config);

  if(isset($vars['LC_PASSWORD_CHANGE_PLUGIN']) && $vars['LC_PASSWORD_CHANGE_PLUGIN'] == "1") {
    $main_config = str_replace("\$config['plugins'] = array(\n", "\$config['plugins'] = array(\n    'password',\n", $main_config);
    $main_config .= "\$config['password_driver'] = 'liveconfig';\n"
                  . "\$config['password_liveconfig_host'] = '". $vars['LC_SERVER_HOST'] ."';\n"
                  . "\$config['password_liveconfig_port'] = '". (empty($vars['LC_SERVER_PORT']) ? "8443" : $vars['LC_SERVER_PORT']) ."';\n"
                  . "\$config['password_liveconfig_accept_selfsigned'] = ".($vars['LC_SERVER_CERT_SELFSIGNED'] == 1 ? "true" : "false").";\n";
  }

  if(file_put_contents($vars['LC_DST']."/config/config.inc.php", $main_config) === false) {
    print "ERROR while writing the roundcube config file!\n";
    return;
  }

  //populate database
  if(($queries = __split_sqlfile($vars['LC_DST']."/SQL/mysql.initial.sql", false, true, true)) === false) {
    print "ERROR while spliting the roundcube sql file!\n";
    return;
  }

  if(!empty($queries)) {

    $dbh = new mysqli($vars['LC_MYSQL_HOST'], $vars['LC_MYSQL_USER'], $vars['LC_MYSQL_PW'], $vars['LC_MYSQL_DB']);

    if($dbh->connect_error !== null) {
      print "ERROR while connecting to database: ". $dbh->connect_error ."\n";
      return;
    }

    if(!$dbh->set_charset("utf8")) {
      print "Error while selecting database connection charset: ". $dbh->error ."\n";
      return;
    }

    foreach($queries as $query) {
      if(!preg_match("/^CREATE DATABASE/", $query) && !preg_match("/^USE/", $query) && $query != "") {
        if($dbh->query($query) === false) {
          print "ERROR while executing query (".$query."): ". $dbh->error ."\n";
          $dbh->close();
          return;
        }
      }
    }

    $dbh->close();
  }

  // move Password plugin
  if($installer->copy($vars['LC_SRC']."/liveconfig.php", $vars['LC_DST']."/plugins/password/drivers/") === false) {
    print "ERROR Failed to move password plugin file!";
    return;
  }

  print "OK\n";
}

/*
 * wai_update()
 *   updates the package
 */
function wai_update() {
  global $LCWAI_DOWNLOADS;
  global $installer;

  if(($vars = $installer->get_env_vars(array('LC_DST', 'LC_SRC', 'LC_LANG', 'LC_MYSQL_DB', 'LC_MYSQL_USER', 'LC_MYSQL_PW', 'LC_MYSQL_HOST', 'LC_RUN_AS_USER'))) === false) {
    return;
  }

  if(!is_dir($vars['LC_DST'])) {
    print "ERROR destination not a directory\n";
    return;
  }

  $old_version = wai_getversion(true);

  //since mediawiki is easy to update we don't need to check the current version here
  //extract archive
  if($installer->package_extract($vars['LC_DST'], $vars['LC_SRC'].'/'.$LCWAI_DOWNLOADS['ALL']['PACKAGE']['NAME']) === false) {
    return;
  }

  if($installer->copy($vars['LC_DST']."/roundcubemail-1.6.12/*", $vars['LC_DST']."/") === false) {
    return;
  }

  //remove the "root"-directory
  if($installer->remove($vars['LC_DST']."/roundcubemail-1.6.12") === false) {
    return;
  }

  $complete = file($vars['LC_DST']."/SQL/mysql.update.sql");
  $start = false;
  $required = array();
  foreach($complete as $line) {
    if(preg_match("/^-- Updates from version ".$old_version."/", $line)) {
      $start = true;
    }

    if($start) {
      $required[] = $line;
    }
  }

  if(!empty($required)) {
    //$queries = $installer->split_sqlarray($required, false, true);
    //populate database
    if(($queries = __split_sqlfile($vars['LC_DST']."/SQL/mysql.initial.sql", false, true, true)) === false) {
      print "ERROR while spliting the roundcube sql file!\n";
      return;
    }

    $dbh = new mysqli($vars['LC_MYSQL_HOST'], $vars['LC_MYSQL_USER'], $vars['LC_MYSQL_PW'], $vars['LC_MYSQL_DB']);

    if($dbh->connect_error !== null) {
      print "ERROR while connecting to database: ". $dbh->connect_error ."\n";
      return;
    }

    if(!$dbh->set_charset("utf8")) {
      print "Error while selecting database connection charset: ". $dbh->error ."\n";
      return;
    }

    foreach($queries as $query) {
      if(!preg_match("/^CREATE DATABASE/", $query) && !preg_match("/^USE/", $query) && $query != "") {
        if($dbh->query($query) === false) {
          print "ERROR while executing query (".$query."): ". $dbh->error ."\n";
          $dbh->close();
          return;
        }
      }
    }
    $dbh->close();
  }

  print "OK\n";
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
function wai_getversion($return_version = false) {
  global $installer;

  if(($vars = $installer->get_env_vars(array('LC_DST'))) === false) {
    return;
  }

  if(!is_dir($vars['LC_DST'])) {
    print "ERROR destination '" . $vars['LC_DST'] . "' is not a directory\n";
    return;
  }

  define('INSTALL_PATH', $vars['LC_DST']);
  include($vars['LC_DST']."/program/include/iniset.php");

  if($return_version) {
    return RCMAIL_VERSION;
  } else {
    print "OK\n";
    print "version\t".RCMAIL_VERSION."\n";
  }
}


/*
 * Temporary Help function to split up SQLs to be removed once installer got an update
 */

function __split_sqlfile($filename, $remove_non_ansi_comments = false, $support_mysql_statement_comments = false, $remove_inline_singleline_comments = false) {
  $lines = file($filename);

  if($lines === false) {
    /* empty file */
    return false;
  }
  return __split_sqlarray($lines, $remove_non_ansi_comments, $support_mysql_statement_comments, $remove_inline_singleline_comments);
}

/**
 * split array with sql file lines by query (one query per array element)
 */
function __split_sqlarray($sqldata, $remove_non_ansi_comments = false, $support_mysql_statement_comments = false, $remove_inline_singleline_comments = false) {

  /* Remove the -- comments and append all lines if $remove_non_ansi_comments is true also remove the non ansi # comments */
  $scriptfile = "";
  foreach($sqldata as $line) {
    $line = trim($line);
    if($remove_inline_singleline_comments) {
      // need to ignore inline comments on this two line adding blocks
      if($remove_non_ansi_comments) {
        if(!preg_match('/^--/', $line) && !preg_match('/^#/', $line) && !preg_match('/(.+)--.+/', $line)) {
          $scriptfile.=" ".$line;
        }
      } else {
        if(!preg_match('/^--/', $line) && !preg_match('/(.+)--.+/', $line)) {
          $scriptfile.=" ".$line;
        }
      }
      // now we remove inline comments and add the sql to the script
      if(preg_match('/(.+)--.+/', $line, $matches)) {
        $scriptfile .= " ".$matches[1];
      }
    } else {
      if($remove_non_ansi_comments) {
        if(!preg_match('/^--/', $line) && !preg_match('/^#/', $line)) {
          $scriptfile.=" ".$line;
        }
      } else {
        if(!preg_match('/^--/', $line)) {
          $scriptfile.=" ".$line;
        }
      }
    }
  }

  if(empty($scriptfile)) {
    return false;
  }

  // remove the /* */  comments
  if($support_mysql_statement_comments) {
    $scriptfile  = preg_replace("/\/\*[^!].+?\*\//", "", $scriptfile);
  } else {
    $scriptfile  = preg_replace("/\/\*.+?\*\//", "", $scriptfile);
  }

  /* split long line to one query per line array and return */
  $hochkomma = false;
  $anfuehrungszeichen = false;
  $backtick = false;
  $fronttick = false;
  $newstr = "";
  $query_array = array();

  for($i=0; $i < strlen($scriptfile); $i++) {
    switch($scriptfile[$i]) {
      case '\'':
        $hochkomma ? $hochkomma = false : $hochkomma = true;
        $newstr .= $scriptfile[$i];
        break;
      case '"':
        $anfuehrungszeichen ? $anfuehrungszeichen = false : $anfuehrungszeichen = true;
        $newstr .= $scriptfile[$i];
        break;
      case "`":
        $backtick ? $backtick = false : $backtick = true;
        $newstr .= $scriptfile[$i];
        break;
      case "´":
        $fronttick ? $fronttick = false : $fronttick = true;
        $newstr .= $scriptfile[$i];
        break;
      case "\\":
        $newstr .= $scriptfile[$i];
        $i++;
        $newstr .= $scriptfile[$i];
        break;
      case ";":
        if(!$hochkomma && !$anfuehrungszeichen && !$backtick && !$fronttick) {
          $query_array[] = $newstr;
          $newstr = "";
        } else {
          $newstr .= $scriptfile[$i];
        }
        break;
      default:
        $newstr .= $scriptfile[$i];
        break;
    }
  }
  /* trim leading whitespaces */
  array_walk($query_array, '__trim_value');
  return  $query_array;
}

function __trim_value(&$value) {
  /* Callback für array_walk to trim the array entries */
  $value = trim($value);
}
?>
