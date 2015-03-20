<?php

/**
 * Permet de supprimer un utilisateur pour un groupe donnée
 * @author Léang Stéphanie
 * @version 20060625
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if (acces(__FILE__)) { 
    $monster = new rootLayoutMonster();
	modelGroupe::unlinkUser($_GET['id_gu']);
	$monster->setMessage('L\'utilisateur a bien été supprimé du groupe');
    redirect('admin_groupe_detail', 'id=' . $_GET['id'] . '&choix=user');
	
}	
?>