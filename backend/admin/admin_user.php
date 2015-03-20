<?php

/**
 * Page d'affichage de tous les utilisateurs
 * @date 20070713
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');
$format = Annuaire::lookup(KEY_FORMAT);
$monster = new rootLayoutMonster();

$monster->addJavaScript('tableFilter/jquery.cookies-packed.js');
$monster->addJavaScript('tableFilter/prototypes-packed.js');
$monster->addJavaScript('tableFilter/json-packed.js');
$monster->addJavaScript('tableFilter/jquery.truemouseout-packed.js');
$monster->addJavaScript('tableFilter/daemachTools-packed.js');
$monster->addJavaScript('tableFilter/jquery.tableFilter.js');
$monster->addJavaScript('tableFilter/jquery.tableFilter.aggregator-packed.js');
$monster->addJavaScript('tableFilter/jquery.tableFilter.columnStyle-packed.js');
$monster->addStyleSheet('tableFilter.aggregator.css');
$monster->addStyleSheet('tableFilter.css');

if(acces(__FILE__)) {
	$admin_user = new flyLayout(REP_TPL . 'admin/admin_user.tpl');
	$admin_user->start();
    $admin_user->setVariable('rep_img', REP_IMG . 'tableFilter/');
	$listUser = modelUser::getList();
	foreach($listUser as $key => $user) {
		$admin_user->setVariable('login', $user->login);
		$admin_user->setVariable('nickname', $user->nickname ? $user->nickname : '(No nickname)');
		$admin_user->setVariable('lib_etat_user', $user->lib_etat_user);
		$admin_user->setVariable('date_inscription',$format->out($user->date_creation, Format::DATE_TIME));
		$admin_user->setVariable('date_connexion', $user->date_connexion ?$format->out($user->date_connexion, Format::DATE_TIME) : '');
		$admin_user->setVariable('url_user', 'admin_user_detail.php?id=' . $user->id_user);
		$admin_user->parseList('user');
	}
	$admin_user->stop();
	$monster->setIncBody($admin_user);
}

$monster->display();

?>