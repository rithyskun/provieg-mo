<?php

/**
 * Permet de visualiser les groupes auxquels est relié un compte
 * @author Léang Stéphanie
 * @version 20070619
 */
 
/** SECTION AFFICHAGE
**********************************************************************************************/
if(acces(__FILE__)) {
	if(isset($_GET['id'])) {
	    $id_utilisateur = normalise($_GET['id'],'id');	
	    $admin_user_groupe = new flyLayout(REP_TPL . 'admin/admin_user_groupe.tpl');		
		$admin_user_groupe->start();
		
	if (acces('admin_user_groupe_add')){	
		include('admin_user_groupe_add.php');
		$admin_user_groupe->includeFile('include_link', $admin_user_groupe_add);
    }		
		$listGroupe = modelUser::getListGroupe($id_utilisateur);
		if($listGroupe->size() > 0) {
    		foreach($listGroupe as $key => $groupe){    			
    			$admin_user_groupe->setVariable('type_ligne', ($listGroupe->index()%2)?'impair':'pair');
    			$admin_user_groupe->setVariable('intitule_groupe', $groupe->intitule_groupe);
    			$admin_user_groupe->setVariable('description_groupe', $groupe->description_groupe);
    			$admin_user_groupe->setVariable('url_groupe', 'admin_groupe_detail.php?id=' . $groupe->id_groupe);
    			if(acces('admin_user_groupe_delete')) 
    			$admin_user_groupe->setVariable('delete', '<a href="admin_user_groupe_delete.php?id=' . $groupe->id. '&idg='.$id_utilisateur .'">Delete</a>');
    			$admin_user_groupe->parseList('groupe');
    		}
    		$admin_user_groupe->showBlock('liste');
		}
        else {
            $admin_user_groupe->showBlock('aucun');
        }
		$admin_user_groupe->stop();
	}
}

?>