<?php

/**
 * Permet de supprimer un privilège pour un groupe donné
 * @author Léang Stéphanie
 * @version 20060625
 */

define('REP_ROOT', '../');
require('../config.php');

if(acces(__FILE__)) {
    $monster = new rootLayoutMonster();
	modelGroupe::unlinkPrivilege($_GET['id_gp']);
	$monster->setMessage('Le privilège a bien été supprimé');
    redirect('admin_groupe_detail', 'id=' . $_GET['id'] . '&choix=privilege');	
}	

?>