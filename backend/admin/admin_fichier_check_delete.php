<?php

/**
 * Permet de supprimer un fichier pour un privilege donné
 * @author Marcadet Antoine
 * @date 12/06/06
 */
 
define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if (acces(__FILE__)) { 
	
	$id_fichier = $_GET['id'];
	$idpf = $_GET['idpf'];
	
	if($id_fichier) {
		$obj = modelFile::getObject($id_fichier);
		$file = $obj->nom_fichier;
		$folder = $obj->dossier;
		// delete php file ( *.php )
 		if($idpf == 1) {
			$res = unlink(REP_ROOT.$folder.$file.'.php');
		}
		else if($idpf == 2) { //delete tpl file ( *.tpl )
			$res = unlink(REP_TPL.$folder.$file.'.tpl');
		}
		else if($idpf == 3) {
			$res = unlink($_SESSION['resource-'.$id_fichier]);
		}
	}
	
	rootLayoutMonster::setMessage('The file has been deleted.');
    redirect('admin_fichier_check');
    
}	

?>