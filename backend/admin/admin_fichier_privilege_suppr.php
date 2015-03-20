<?php

/**
 * Permet de supprimer un privilège pour un fichier donné
 * @author Léang Stéphanie
 * @version 20060626
 */

define('REP_ROOT', '../');
require(REP_ROOT. 'config.php');

if(acces(__FILE__)) {
	modelFile::unlinkPrivilege($_GET['idfp']);
	rootLayoutMonster::setMessage('Le privilège a bien été supprimé du fichier');
    redirect('admin_fichier_detail', 'id=' . $_GET['id'] . '&choix=privilege');	
}	

?>