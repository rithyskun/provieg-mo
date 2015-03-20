<?php
ini_set('memory_limit', '64M');

require('config_db.php');
require('config_spe.php');

// SET STATUS_EMAIL TO SEND EMAIL ONLY IF WE DON'T DEFINE
if(!defined('STATUS_EMAIL')) define('STATUS_EMAIL', 1);

session_start();

/* User define constant*/
// archives des fichiers uploadés sur le serveur
define('REP_ARCHIVE',  '.archive/');
define('REP_ORIGINAL', '.original/');
define('FORMAT_PREVIEW_ADMIN', 'preview-admin/');
define('FORMAT_MINI_ADMIN', 'mini-admin/');
define('VISIBLE', 'Visible');
define('INVISIBLE', 'Invisible');
define('YES', 'Yes');
define('NO', 'No');
define('ID_REPERTOIRE_PHOTOS', 1);
define('ID_REPERTOIRE_SLIDER', 2);

// repertoires de l'application
define('REP_AJAX',   REP_ROOT . '_ajax/');
define('REP_CACHE',  REP_ROOT . '_cache/');
define('REP_CLASS',  REP_ROOT . '_class/');
define('REP_FCT',    REP_ROOT . '_fonctions/');
define('REP_IMG',    REP_ROOT . '_images/');
define('REP_LANG',   REP_ROOT . '_lang/');
define('REP_MAIL',   REP_ROOT . '_mail/');
define('REP_SCRIPT', REP_ROOT . '_script/');
define('REP_STYLE',  REP_ROOT . '_style/');
define('REP_TPL',    REP_ROOT . '_templates/');
define('REP_LAYOUT', REP_ROOT . '_layout/');
define('REP_TPL_AJAX',    REP_ROOT.'_templates/_ajax/');

define('REP_FRONT', '../' . REP_ROOT);
define('REP_FRONT_STYLE', 	REP_FRONT . 'style/');
define('REP_FRONT_SCRIPT', 	REP_FRONT . 'script/');
define('REP_FRONT_DESIGN', 	REP_FRONT . 'design/');
define('REP_FRONT_PHOTOS', 	REP_FRONT . 'photos/');

define('HTTP_HOST',  'http://'.$_SERVER['HTTP_HOST'].'/');

// déclaration des packages nécessaires
require(REP_CLASS . 'Package.class.php');
Package::setClassRoot(REP_CLASS);
Package::import('model');
Package::import('sql');
Package::import('sql.mysql');
Package::import('layout');
Package::import('layout.root');
Package::import('fly');
Package::import('utils');

function __autoload($class_name) {
    require Package::load($class_name);
}

// inclusion des fichiers de fonction
$rep = opendir(REP_FCT);
while($sub = readdir($rep)) {
    $path_parts = pathinfo($sub);
	if($path_parts['extension'] == 'php')
		require(REP_FCT . $sub);
}
closedir($rep);

// nom de la page accédée par l'utilisateur sans le chemin ni l'extension
define('PAGE', getCurrentPage());
define('PAGINATION_MAX', 25);

// code langue de la session
$_SESSION['locale'] = (isset($_SESSION['locale']))?$_SESSION['locale']:Format::LOCALE_EN;

// CLES DES OBJETS PUBLIES DANS L'ANNUAIRE
define('KEY_DATABASE', 'database'); // clé de l'acces à la base de données dans l'annuaire
define('KEY_FORMAT',   'format');   // clé de l'objet de formatage des données

Annuaire::register(KEY_DATABASE, new mySQL(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE));
Annuaire::register(KEY_FORMAT,   new Format($_SESSION['locale']));

?>