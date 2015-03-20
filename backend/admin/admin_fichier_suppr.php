<?php

/**
 * Permet de supprimer un fichier
 * @author Léang Stéphanie
 * @version 09/06/06
 */

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {    
    /** SECTION TRAITEMENTS****************************************/
	if(isset($_GET['id'])) {
		$id_fichier = $_GET['id'];
		if(modelFile::exist($id_fichier)) {
			if(isset($_POST['pass'])) {
				if(modelUser::verifPass($_POST['pass'])) {
					modelFile::delete($id_fichier);
					$monster->setMessage('Votre fichier a bien été supprimé');
					redirect('admin_fichier');
				}
				else {
					$monster->setMessage('Erreur lors de la saisie de votre mot de passe', Message::ERROR);
					redirect('admin_fichier_suppr', 'id=' . $id_fichier);
				}
			}
		}
		else {
			$monster->setMessage('Le profil que vous demandez n\'existe pas', Message::ERROR);
			redirect('admin_fichier');
		}
    
        /** SECTION AFFICHAGE******************************************/
		$admin_fichier_detail = new flyLayout(REP_TPL . 'admin/admin_fichier_detail.tpl');
		$admin_fichier_detail->start();
		
        $fichier = modelFile::getFichier($id_fichier);		
		$admin_fichier_detail->setVariable('intitule_fichier', $fichier->intitule_fichier);
		$admin_fichier_detail->setVariable('description_fichier', nl2br($fichier->description_fichier));
		$admin_fichier_detail->setVariable('nom_fichier', $fichier->nom_fichier);
	    $admin_fichier_detail->setVariable('dossier_fichier', $fichier->url_dossier);
        $admin_fichier_detail->setVariable('lib_type_fichier', $fichier->lib_type_fichier);
		$admin_fichier_detail->stop();
		
		$admin_fichier_suppr = new flyLayout(REP_TPL . 'admin/admin_fichier_suppr.tpl');
        $admin_fichier_suppr->start();	
		$admin_fichier_suppr->setVariable('id_fichier', $id_fichier);
		$admin_fichier_suppr->includeFile('detail', $admin_fichier_detail);
		$admin_fichier_suppr->stop();
		
	    $monster->setIncBody($admin_fichier_suppr);
	}
	else {
		$monster->setMessage('Vous avez été redirigé sur cette page car l\'identifiant de l\'utilisateur est non défini', Message::AVERT);
		redirect('admin_fichier');
	}
}

$monster->display();

?>