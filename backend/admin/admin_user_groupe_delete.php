<?php

/**
 * Permet de supprimer un provider pour un privilege donn�
 * @author Marcadet Antoine
 * @date 12/06/06
 */
 
define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if (acces(__FILE__)) {     
    modelGroupe::unlinkUser($_GET['id']);
	rootLayoutMonster::setMessage('Group has been delete from this user');
    redirect('admin_user_detail', 'id=' . $_GET['idg'] . '&choix=groupe');
}	
?>