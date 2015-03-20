<?php

/**
 * Permet de visionner le détail d'un groupe
 * @author Stephanie
 * @version 20070615
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    /** SECTION VERIFICATIONS *************************************************/
	if(!isset($_GET['id'])) {  
        rootLayoutMonster::setMessage('Vous avez été redirigé sur cette page car l\'identifiant du groupe est non défini', Message::AVERT);
		redirect('admin_groupe');
    }      
    $id_groupe = $_GET['id'];
    if(!modelGroupe::exist($id_groupe)) {
        rootLayoutMonster::setMessage('Le groupe que vous demandez n\'existe pas', Message::ERROR);
	    redirect('admin_groupe');
    }
    
    /** SECTION AFFICHAGE *****************************************************/
	$admin_groupe_detail = new flyLayout(REP_TPL . 'admin/admin_groupe_detail.tpl');
    $admin_groupe_detail->start();
    
    $groupe = modelGroupe::getGroupe($id_groupe);
    $admin_groupe_detail->setVariable('intitule_groupe', $groupe->intitule_groupe);
    $admin_groupe_detail->setVariable('description_groupe', $groupe->description_groupe);
    
    $infodoc = new layoutInfodoc();
    $infodoc->setObjet($groupe);    
    $admin_groupe_detail->includeLayout('infodoc', $infodoc);
            
    $admin_groupe_detail->includeFile('menubar', new layoutMenubar());		

    $admin_groupe_detail->stop();        
    $monster->setIncBody($admin_groupe_detail);
}

$monster->display();

?>