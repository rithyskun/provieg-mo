<?php 

/**
 * Permet de visualiser l'ensemble des privileges
 * @author Léang Stéphanie
 * @date 20070620
 */
 
define('REP_ROOT', '../'); 
require('../config.php');

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
	$admin_privilege = new flyLayout(REP_TPL . 'admin/admin_privilege.tpl');
	$admin_privilege->start();
    $admin_privilege->setVariable('rep_img', REP_IMG . 'tableFilter/');
    $listPrivilege = modelAccessRight::getList();
	foreach($listPrivilege as $key => $privilege) {
		$admin_privilege->setVariable('intitule_privilege', $privilege->intitule_privilege);
		//$admin_privilege->setVariable('description_privilege', affiche($privilege->description_privilege));
		$admin_privilege->setVariable('lib_type_privilege', $privilege->lib_type_privilege);
		$admin_privilege->setVariable('url_privilege', 'admin_privilege_detail.php?id=' . $privilege->id_privilege);
		$admin_privilege->parseList('privilege', 'BLOCK_PRIVILEGE', true);
	}
    $admin_privilege->stop();
	$monster->setIncBody($admin_privilege);
}

$monster->display();

?>