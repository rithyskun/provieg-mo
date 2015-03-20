<?php 

/**
 * Permet de visualiser l'ensemble des fichiers
 * @date 20070620
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
	$admin_fichier = new flyLayout(REP_TPL . 'admin/admin_fichier.tpl');
    $admin_fichier->start();
    $admin_fichier->setVariable('rep_img', REP_IMG . 'tableFilter/');
    $listFichier = modelFile::getList();
    foreach($listFichier as $key => $fichier){
		$admin_fichier->setVariable('lib_type_fichier', $fichier->lib_type_fichier);
		$admin_fichier->setVariable('url_dossier', $fichier->url_dossier);
		$admin_fichier->setVariable('nom_fichier', $fichier->nom_fichier);
		$admin_fichier->setVariable('intitule_fichier', $fichier->intitule_fichier);
		$admin_fichier->setVariable('description_fichier', affiche($fichier->description_fichier));
		$admin_fichier->setVariable('url_fichier', 'admin_fichier_detail.php?id=' . $fichier->id_fichier);
		$admin_fichier->parseList('fichier');
	}
	$admin_fichier->stop();
	$monster->setIncBody($admin_fichier);
}

$monster->display();

?>