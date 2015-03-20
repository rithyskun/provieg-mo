<?php

/**
 * Permet de modifier un groupe
 * @author Léang Stéphanie
 * @version 20070618
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    /** SECTION VERIFICATIONS *************************************************/
	if(!isset($_GET['id'])) {
		rootLayoutMonster::setMessage('Vous avez été redirigé sur cette page car l\'identifiant de l\'utilisateur est non défini', Message::AVERT);
		redirect('admin_groupe');
	}              
	$id_groupe = $_GET['id'];
	if(!modelGroupe::exist($id_groupe)) {
		rootLayoutMonster::setMessage('Le groupe que vous demandez n\'existe pas', Message::ERROR);
		redirect('admin_groupe');
	}
	
	/** SECTION TRAITEMENTS ***************************************************/
	if(isset($_POST['intitule_groupe'])) {
		$intitule_groupe = normalise($_POST['intitule_groupe']);
		$description_groupe = normalise($_POST['description_groupe']);
	    
	    if(modelGroupe::existIntituleModif($intitule_groupe, $id_groupe)) {
			$monster->setMessage('Cet intitulé de groupe est déjà pris', Message::ERROR);		
			redirect('admin_groupe_modif','id=' . $id_groupe);
		}	               
        
        modelGroupe::update($id_groupe, $intitule_groupe, $description_groupe);
		$monster->setMessage('Votre groupe a bien été modifié');
		redirect('admin_groupe_detail', 'id=' . $id_groupe);
	}

    /** SECTION AFFICHAGE *****************************************************/
	$admin_groupe_modif = new flyLayout(REP_TPL . 'admin/admin_groupe_modif.tpl');
    $admin_groupe_modif->start();
	
	$groupe = modelGroupe::getGroupe($id_groupe);
	$admin_groupe_modif->setVariable('intitule_groupe_donnee', $groupe->intitule_groupe);
	$admin_groupe_modif->setVariable('description_groupe_donnee', $groupe->description_groupe);
	$admin_groupe_modif->setVariable('id_groupe', $id_groupe);
    
    $admin_groupe_modif->stop();
    $monster->setIncBody($admin_groupe_modif);
}

$monster->display();

?>