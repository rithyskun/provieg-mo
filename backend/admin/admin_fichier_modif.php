<?php

/**
 * Permet de modifier un fichier
 * @author Léang Stéphanie
 * @version 20070621
 */

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) { 
    if(isset($_GET['id'])) {
		$id_fichier = $_GET['id'];
				
		/** SECTION TRAITEMENTS*****************************************/
        if(modelFile::exist($id_fichier)){
			if(isset($_POST['intitule_fichier'])) {
				$intitule_fichier = normalise($_POST['intitule_fichier']);
				$description_fichier = normalise($_POST['description_fichier']);
				$nom_fichier = normalise($_POST['nom_fichier']);
				$id_dossier = normalise($_POST['id_dossier'], 'int');
				$id_type_fichier = normalise($_POST['id_type_fichier'], 'int');
				
				modelFile::update($id_fichier, $intitule_fichier, $description_fichier, $nom_fichier, $id_dossier, $id_type_fichier);
				
				$monster->setMessage('Le fichier a bien été modifié');
				redirect('admin_fichier_detail', 'id=' . $id_fichier);
			}
		}
		else {
			$monster->setMessage('Le profil que vous demandez n\'existe pas', Message::ERROR);
			redirect('admin_fichier');
		}

        /** SECTION AFFICHAGE******************************************/		
		$admin_fichier_modif = new flyLayout(REP_TPL . 'admin/admin_fichier_modif.tpl');
		$admin_fichier_modif->start();
		
		$fichier = modelFile::getFichier($id_fichier);
		$admin_fichier_modif->setVariable('intitule_fichier_donnee', $fichier->intitule_fichier);
		$admin_fichier_modif->setVariable('description_fichier_donnee', $fichier->description_fichier);
		$admin_fichier_modif->setVariable('nom_fichier_donnee', $fichier->nom_fichier);
		$admin_fichier_modif->setVariable('id_fichier', $id_fichier);
		
		$listDossier = modelFolder::getList();
		foreach($listDossier as $key => $dossier) {
			$admin_fichier_modif->setVariable('id_dossier', $dossier->id_dossier);
			$admin_fichier_modif->setVariable('url_dossier', $dossier->url_dossier);
			$admin_fichier_modif->setVariable('selected_dossier', ($fichier->id_dossier==$dossier->id_dossier)?'selected="selected"':'');
			$admin_fichier_modif->parseList('dossier');
		}
		
		$listTypeFichier = modelFile::getListType();
		foreach($listTypeFichier as $key => $typeFichier) {
			$admin_fichier_modif->setVariable('id_type_fichier', $typeFichier->id_type_fichier);
			$admin_fichier_modif->setVariable('lib_type_fichier', $typeFichier->lib_type_fichier);
			$admin_fichier_modif->setVariable('selected_type_fichier', ($fichier->id_type_fichier==$typeFichier->id_type_fichier)?'selected="selected"':'');
			$admin_fichier_modif->parseList('type_fichier');
		}		
		$admin_fichier_modif->stop();
		
        $monster->setIncBody($admin_fichier_modif);
	}
	else {
		$monster->setMessage('Vous avez été redirigé sur cette page car l\'identifiant de l\'utilisateur est non défini', Message::AVERT);
		 redirect('admin_fichier');
	}
}

$monster->display();

?>