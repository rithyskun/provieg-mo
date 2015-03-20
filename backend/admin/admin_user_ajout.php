<?php

/**
 * Permet d'inserer une user dans la base de donnée
 * @author Stephanie Léang
 * @version 20070618
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();
if(acces(__FILE__)) {
    /* Traitement*****************************************************************/
	if(isset($_POST['login_user'])) {
    	$login_utilisateur    = normalise($_POST['login_user'], 'login');
		$mot_de_passe = normalise($_POST['mot_de_passe'], 'pass');
		$key_unique   = time() . rand(10000000, 99999999);
        if(!modelUser::existLogin($login_utilisateur)) {
            $id_utilisateur = modelUser::insert($login_utilisateur, $mot_de_passe, $key_unique);
            $monster->setMessage('The account has been created', Message::INFO);
    		redirect('admin_user_detail', 'id=' . $id_utilisateur);		
    	}
    	else {		
    		$monster->setMessage('This login connection already exists', Message::ERROR);
    	}
    }
	
	/* Affichage*********************************************************************/
	$admin_user_ajout = new flyLayout(REP_TPL . 'admin/admin_user_ajout.tpl');
	$admin_user_ajout->start();
	$admin_user_ajout->stop();

    $monster->setIncBody($admin_user_ajout);
}

$monster->display();

?>