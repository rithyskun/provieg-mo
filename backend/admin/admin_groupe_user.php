<?php

/**
 * Permet de visionner tous les utilisateurs d'un groupe
 * @author Léang Stéphanie
 * @date 20070619
 */
 
/** SECTION AFFICHAGE**********************************************/
if(acces(__FILE__)) {
    $id_groupe = $_GET['id'];
	$admin_groupe_user = new flyLayout(REP_TPL . 'admin/admin_groupe_user.tpl');
    $admin_groupe_user->start();
   	
	if(acces('admin_groupe_user_ajout')) {
		include('admin_groupe_user_ajout.php');
		$admin_groupe_user->includeFile('include_groupe_user_ajout', $admin_groupe_user_ajout);
	}
	
	$listUser = modelGroupe::getListUser($id_groupe);
	if($listUser->size() > 0) {
    	$privilege_suppr = acces('admin_groupe_user_suppr');
    	foreach($listUser as $key => $user) {
    		$admin_groupe_user->setVariable('type_ligne', ($listUser->index()%2)?'impair':'pair');
    		$admin_groupe_user->setVariable('login', $user->login);
    		if($privilege_suppr)
    			$admin_groupe_user->setVariable('url_suppr', '<a href="admin_groupe_user_suppr.php?id=' . $id_groupe . '&id_gu=' . $user->id_gu . '">Delete</a>');
    		$admin_groupe_user->setVariable('url_user', 'admin_user_detail.php?id=' . $user->id_user);
    		$admin_groupe_user->parseList('user');        		
    	}
    	$admin_groupe_user->showBlock('liste');        	
	}
    else {
        $admin_groupe_user->showBlock('aucun');
    }

    $admin_groupe_user->stop();
}

?>