<?php 

/**
 * Permet d'acceder a la page de la liste d'un groupe
 * @author Léang Stéphanie
 * @date 20070715
 */
 
define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

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
	$admin_groupe = new flyLayout(REP_TPL . 'admin/admin_groupe.tpl');
	$admin_groupe->start();
    $admin_groupe->setVariable('rep_img', REP_IMG . 'tableFilter/');
	$listGroupe = modelGroupe::getList();
	foreach($listGroupe as $key => $groupe){
		$admin_groupe->setVariable('intitule_groupe', $groupe->intitule_groupe);
		$admin_groupe->setVariable('description_groupe', $groupe->description_groupe);		
		$admin_groupe->setVariable('url_groupe', 'admin_groupe_detail.php?id=' . $groupe->id_groupe);		
		$admin_groupe->parseList('groupe');
	}
	$admin_groupe->stop();
	$monster->setIncBody($admin_groupe);
}

$monster->display();

?>