<?php

/**
 * Permet d'ajouter un père ou un fils a un fichier
 * @author Léang Stéphanie
 * @version 20070626
 */

if(acces(__FILE__)) {
	if(isset($_POST['add_pere']) and isset($_POST['id_fichier_pere'])) {
		foreach($_POST['id_fichier_pere'] as $id_fichier_pere)
		 if(!modelFile::exist_linkPere($id_fichier,$id_fichier_pere,1)){
		    modelFile::linkPere($id_fichier, $id_fichier_pere, 1);
		rootLayoutMonster::setMessage('Le fichier père a bien été ajouté au fichier');}
	}
	else if(isset($_POST['add_fils']) and isset($_POST['id_fichier_fils'])) {
		foreach($_POST['id_fichier_fils'] as $id_fichier_fils) 
		  if(!modelFile::exist_linkFils($id_fichier,$id_fichier_fils,1)){
		    modelFile::linkFils($id_fichier, $id_fichier_fils, 1);
		rootLayoutMonster::setMessage('Le fichier fils a bien été ajouté au fichier');}
		
	}        	
	
	/** AFFICHAGE**************************************************/        	
    $admin_fichier_arborescence_ajout = new flyLayout(REP_TPL . 'admin/admin_fichier_arborescence_ajout.tpl');
	$admin_fichier_arborescence_ajout->start();
    $admin_fichier_arborescence_ajout->setVariable('ajax_file_pere', REP_AJAX . 'admin/admin_fichier_pere_liste.php');
    $admin_fichier_arborescence_ajout->setVariable('ajax_file_fils', REP_AJAX . 'admin/admin_fichier_fils_liste.php');
	$admin_fichier_arborescence_ajout->setVariable('id_fichier', $id_fichier);		
	
	$fichier = modelFile::getFichier($id_fichier);
	switch($fichier->id_type_fichier) {
		case modelFile::TYPE_ONGLET: // onglet
			$id_type_fichier_pere = modelFile::TYPE_NULL;
			$id_type_fichier_fils = modelFile::TYPE_MENU;
			break;
		case modelFile::TYPE_MENU: // sous menu
			$id_type_fichier_pere = modelFile::TYPE_ONGLET;
			$id_type_fichier_fils = modelFile::TYPE_ACTION;
			break;
		case modelFile::TYPE_ACTION: // action
			$id_type_fichier_pere = modelFile::TYPE_MENU;
			$id_type_fichier_fils = modelFile::TYPE_NULL;
			break;
		case modelFile::TYPE_DETAIL: // detail/profil
			$id_type_fichier_pere = modelFile::TYPE_MENU;
			$id_type_fichier_fils = modelFile::TYPE_MENUBAR;
			break;
		case modelFile::TYPE_MENUBAR: // menubar
			$id_type_fichier_pere = modelFile::TYPE_DETAIL;
			$id_type_fichier_fils = modelFile::TYPE_NULL;
			break;
		case modelFile::TYPE_AJAX: // ajax
		case modelFile::TYPE_BOUTON: // bouton
		case modelFile::TYPE_INCLUDE: // include
		default:
			$id_type_fichier_pere = modelFile::TYPE_NULL;
			$id_type_fichier_fils = modelFile::TYPE_NULL;
			break;
	}
	
	$listType = modelFile::getListType();
	
	// Liste des types de fichier du père
	$admin_fichier_arborescence_ajout->setVariable('id_type_fichier_pere', 0);
	$admin_fichier_arborescence_ajout->setVariable('lib_type_fichier_pere', '(tous)');
	$admin_fichier_arborescence_ajout->parseList('option_type_fichier_pere');
	foreach($listType as $k => $fichier) {
		$admin_fichier_arborescence_ajout->setVariable('id_type_fichier_pere', $fichier->id_type_fichier);		
		$admin_fichier_arborescence_ajout->setVariable('lib_type_fichier_pere', $fichier->lib_type_fichier);
		$admin_fichier_arborescence_ajout->setVariable('selected_type_fichier_pere', ($fichier->id_type_fichier==$id_type_fichier_pere)?'selected="selected"':'');
		$admin_fichier_arborescence_ajout->parseList('option_type_fichier_pere');
	}
	
	// Liste des types de fichiers du fils
	$admin_fichier_arborescence_ajout->setVariable('id_type_fichier_fils', 0);
	$admin_fichier_arborescence_ajout->setVariable('lib_type_fichier_fils', '(tous)');
	$admin_fichier_arborescence_ajout->parseList('option_type_fichier_fils');
	foreach($listType as $k => $fichier) {
		$admin_fichier_arborescence_ajout->setVariable('id_type_fichier_fils', $fichier->id_type_fichier);		
		$admin_fichier_arborescence_ajout->setVariable('lib_type_fichier_fils', $fichier->lib_type_fichier);
		$admin_fichier_arborescence_ajout->setVariable('selected_type_fichier_fils', ($fichier->id_type_fichier==$id_type_fichier_fils)?'selected="selected"':'');
		$admin_fichier_arborescence_ajout->parseList('option_type_fichier_fils');
	}
	$admin_fichier_arborescence_ajout->stop();
}
?>