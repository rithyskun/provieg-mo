<?php

/**
 * Permet de supprimer un pere ou un fils a un fichier
 * @author Marcadet Antoine
 * @date 13:42 02/08/2006
 */

define('REP_ROOT', '../');
require('../config.php');

if(acces(__FILE__)) {
    if(isset($_GET['id_fr'])) {
        $monster = new rootLayoutMonster();
    	modelFile::unlinkFichier($_GET['id_fr']);
    	$monster->setMessage('The file has been deleted');
        redirect('admin_fichier_detail', 'id=' . $_GET['id'] . '&choix=arborescence');
	}
}	

?>