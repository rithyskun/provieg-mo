<?php

/**
 * Permet d'ajouter un groupe dans la base de donnée
 * @author Léang Stéphanie
 * @date 20070615
 */

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    /** TRAITEMENT*****************************************/
    if(isset($_POST['intitule_groupe'])) {        
        $intitule_groupe = normalise($_POST['intitule_groupe']);
    	$description_groupe = normalise($_POST['description_groupe']);
    	
    	if(!modelGroupe::existIntitule($intitule_groupe)) {
            $id_groupe = modelGroupe::insert($intitule_groupe, $description_groupe);
    		$monster->setMessage('Le groupe a bien été créé');
    		redirect('admin_groupe_detail','id=' . $id_groupe);    			
    	} 
        else {		
    		$monster->setMessage('Ce nom de groupe existe déjà', Message::ERROR);
    	}
    }

    /** AFFICHAGE*****************************************/
	$admin_groupe_ajout = new flyLayout(REP_TPL . 'admin/admin_groupe_ajout.tpl');	
	$admin_groupe_ajout->start();
	$admin_groupe_ajout->stop();
	
    $monster->setIncBody($admin_groupe_ajout);  
}

$monster->display();

?>