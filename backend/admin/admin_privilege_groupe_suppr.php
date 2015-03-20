<?php

/**
 * Permet de supprimer un privilège pour un fichier donné
 * @author Léang Stéphanie
 * @version 20060626
 */

define('REP_ROOT', '../');
require(REP_ROOT. 'config.php');

if(acces(__FILE__)) {
	modelGroupe::unlinkPrivilege($_GET['idgp']);
	rootLayoutMonster::setMessage('Le privilège a bien été supprimé du fichier');
    redirect('admin_privilege_detail', 'id=' . $_GET['id'] . '&choix=groupe');	
}	

?>