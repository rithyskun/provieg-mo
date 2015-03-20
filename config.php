<?php

// empèche l'apparition du PHPSESSID dans l'url
ini_set('session.use_trans_sid', false);
ini_set('session.use_only_cookies', false);
ini_set('memory_limit', '64M');
session_start();

$_SITE['PROD'] = false;


if(!defined('REP_ROOT')) {
    define('REP_ROOT', '');
}

/* User define constant */

define('ID_REPERTOIRE_PHOTOS', 1);
define('ID_REPERTOIRE_SLIDER', 2);
define('ID_REPERTOIRE_HOME', 3);

define('REP_PHOTOS_LIST_AJAX', 'product-list/');
define('REP_PHOTOS_DETAIL_AJAX', 'product-detail/');
define('REP_PHOTOS_LIST', REP_ROOT . 'product-list/');
define('REP_PHOTOS_DETAIL', REP_ROOT . 'product-detail/');
define('REP_PHOTOS_SLIDER', REP_ROOT . 'photo-slider/');
define('REP_PHOTOS_HOME', REP_ROOT . 'right-sidebar-image/');

define('REP_MONSTER',			REP_ROOT.'backend/');
define('REP_MONSTER_CLASS',		REP_MONSTER.'_class/');
define('REP_MONSTER_FONCTION', 	REP_MONSTER.'_fonctions/');

define('REP_AJAX',   	REP_ROOT.'_ajax/');
define('REP_TPL_AJAX',	REP_ROOT.'templates/_ajax/');
define('REP_CLASS',  	REP_ROOT.'_class/');
define('REP_LAYOUT', 	REP_ROOT.'_layout/');
define('REP_TPL',    	REP_ROOT.'templates/');
define('REP_MAIL',   	REP_ROOT.'mail/');
define('REP_DESIGN', 	REP_ROOT.'design/');
define('REP_CSS',    	REP_ROOT.'style/');
define('REP_JS',     	REP_ROOT.'script/');
define('REP_LANG',     	REP_ROOT.'lang/');

define('HTTP_HOST',  'http://'.$_SERVER['HTTP_HOST'].'/');

// images for text editor
define('REP_IMG',	REP_ROOT . '/images/');

require(REP_MONSTER.'config_db.php');
require(REP_MONSTER.'config_spe.php');

// SET STATUS_EMAIL TO SEND EMAIL ONLY IF WE DON'T DEFINE
if(!defined('STATUS_EMAIL')) define('STATUS_EMAIL', 1);

require(REP_MONSTER_FONCTION.'upload.php');
require(REP_MONSTER_FONCTION.'exception.php');
require(REP_MONSTER_FONCTION.'fonction.php');
require(REP_MONSTER_FONCTION.'fonction_good.php');

// déclaration des packages nécessaires
require(REP_MONSTER_CLASS . 'Package.class.php');
Package::setClassRoot(REP_MONSTER_CLASS);
Package::import('model');
Package::import('sql');
Package::import('sql.mysql');
Package::import('fly');
Package::import('utils');
Package::setClassRoot(REP_CLASS);
Package::import('layout');
Package::import('layout.root');

function __autoload($class_name) {
    require Package::load($class_name);
}
// code langue de la session
$_SESSION['locale'] = isset($_SESSION['locale'])?$_SESSION['locale']:Format::LOCALE_EN;

// CLES DES OBJETS PUBLIES DANS L'ANNUAIRE
define('PAGE', getCurrentPage());
define('PAGE_EXT', PAGE . '.php');
define('KEY_DATABASE', 'database'); // clé de l'acces à la base de données dans l'annuaire
define('KEY_FORMAT',   'format');   // clé de l'objet de formatage des données

Annuaire::register(KEY_DATABASE, new mySQL(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE));
Annuaire::register(KEY_FORMAT,   new Format($_SESSION['locale']));

define('PERSIST_MESSAGE', 'message');

// default language from browser
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

?>