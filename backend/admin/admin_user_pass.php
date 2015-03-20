<?php

/**
 * Permet de réinitialisé le mot de passe de l'utilisateur
 * @author Léang Stéphanie 
 * @date 20060620
 */  

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if(acces(__FILE__)){
    if(isset($_GET['id']))	{
        $id_utilisateur = $_GET['id'];
    	modelUser::initPass($id_utilisateur);
    	rootLayoutMonster::setMessage('The password has been resetted');
    	redirect('admin_user_detail', 'id='.$id_utilisateur);		
	}
    else {
	    rootLayoutMonster::setMessage('You have been redirected to this page because the \n identifier of the user is undefined', Message::AVERT);
		redirect('admin_user');
    }
}

?>