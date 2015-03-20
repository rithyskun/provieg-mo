<?php

/**
 * Permet de supprimer un fichier pour un privilege donné
 * @author Marcadet Antoine
 * @date 12/06/06
 */
 
define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if (acces(__FILE__)) { 
    modelAccessRight::unlinkFichier($_GET['idpf']);
	rootLayoutMonster::setMessage('The file has been deleted from the privilege');
    redirect('admin_privilege_detail', 'id=' . $_GET['id'] . '&choix=fichier');
}	
?>