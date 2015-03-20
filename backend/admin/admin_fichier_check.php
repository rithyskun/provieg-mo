<?php

/**
 * @author 
 * @copyright 2008
 */

define('REP_ROOT', '../');
require(REP_ROOT.'config.php');

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
	
	$admin_fichier_check = new flyLayout(REP_TPL.'admin/admin_fichier_check.tpl');
	$admin_fichier_check->start();
	$admin_fichier_check->setVariable('rep_img', REP_IMG . 'tableFilter/');
	
	$listFichier = modelFile::getListFichier();
	
	if($listFichier->size() > 0) {
        $fichierSuppr = acces('admin_fichier_check_delete');
		foreach($listFichier as $key => $fichier) {
			$admin_fichier_check->setVariable('type_ligne', ($listFichier->index()%2==1)?'impair':'pair');
			$admin_fichier_check->setVariable('nom_fichier', $fichier->nom_fichier);
			
			$phpfile = $fichier->nom_fichier.'.php';
			$tplfile = $fichier->nom_fichier.'.tpl';
			$folder = $fichier->dossier;
			
			if($fichierSuppr != null) {
			
				if(file_exists(REP_ROOT.$folder.$phpfile)) {
					$admin_fichier_check->setVariable('delete_phpfile', '<a href="admin_fichier_check_delete.php?id=' . $fichier->id_fichier . '&idpf=1">Delete</a>');
					$admin_fichier_check->showBlock('php');	
				}
				else {
					$admin_fichier_check->hideBlock('php');
				}
	    		
	    		if(file_exists(REP_TPL.$folder.$tplfile)) {
					$admin_fichier_check->setVariable('delete_tplfile', '<a href="admin_fichier_check_delete.php?id=' . $fichier->id_fichier . '&idpf=2">Delete</a>');
					$admin_fichier_check->showBlock('tpl');	
				}
				else {
					$admin_fichier_check->hideBlock('tpl');
				}
			
			}
    		
			$admin_fichier_check->parseList('lfichier');
			
		}
		
		//$admin_fichier_check->showBlock('liste');
		
	}
	
	$directory = array('admin', 'moderation', 'promo', 'recette', 'referencement', 'reporting', 'upload', '_templates', 'content', 'webrank');
	
	$x=0;
	
	for($x=0; $x<count($directory); $x++) {
	
		$listen_directory = traverse('../'.$directory[$x], 1);
		
		if(count($listen_directory) > 0) {
			for($i=0; $i<count($listen_directory); $i++) {
				$path_info = pathinfo($listen_directory[$i]);
				$dir = $path_info['dirname'];
				$filename = $path_info['filename'];
				$basename = $path_info['basename'];
				$extension = $path_info['extension'];
				
				if(preg_match('[tpl|php]', $extension)) {
					if(!modelFile::existName($filename)) {
						$_SESSION['resource-'.$i] = $listen_directory[$i];
						$admin_fichier_check->setVariable('filename', $basename);
						$admin_fichier_check->setVariable('directory', $dir);
						$admin_fichier_check->setVariable('url', $dir.'/'.$filename.'.php');
						$admin_fichier_check->setVariable('delete', '<a href="admin_fichier_check_delete.php?id=' . $i . '&idpf=3">Delete</a>');
						$admin_fichier_check->parseList('lfile');
					}
				}
			}
			$admin_fichier_check->showBlock('lphysical');
		}
//		else {
//			$admin_fichier_check->showBlock('nothing');
//		}
		
	}
	
	$admin_fichier_check->stop();
		
	$monster->setIncBody($admin_fichier_check);

}

$monster->display();

?>