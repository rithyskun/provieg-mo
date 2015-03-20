<?php

/**
 * Permet d'ajouter un fichier
 * @author Antoine Marcadet
 * @version 20070625
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
	
	$admin_fichier_ajout = new flyLayout(REP_TPL . 'admin/admin_fichier_ajout.tpl');
	$admin_fichier_ajout->start();
	
	//***création du fichier et assignation 
	if(isset($_GET['id_fichier'])) {
		$id_fichier = $_GET['id_fichier'];
        if(!modelFile::existEncours($id_fichier)) { // le fichier a déjà été passé à l'etat_doc 1, donc enregistré
        	$monster->setMessage('Ce fichier a déjà été saisi ou n\'existe pas', Message::AVERT);
			redirect('admin_fichier');
		}
	}
	else { // premier acces à la page, on insère le fichier si il n'y a pas de fichier en cours d'édition sinon on le récupère
	    $fichier = modelFile::getFichierUtilisateurEncours();
		if($fichier) { 
			$id_fichier = $fichier->id_fichier;
		    modelFile::updateDate($id_fichier);
		}
		else { // pas de fichier en cours de création
			$id_fichier = modelFile::insert();
		}
	}
	/**************************************************/

	
	$etape = isset($_GET['etape'])?$_GET['etape']:'1';
    switch($etape) {
        case 1:
            if(isset($_POST['etape2'])) {
            	$nom_fichier = normalise($_POST['nom_fichier'], 'min');
        		$description_fichier = normalise($_POST['description_fichier']);
        		$intitule_fichier = normalise($_POST['intitule_fichier']);
        		$id_dossier = normalise($_POST['id_dossier'], 'int');
        		$id_type_fichier = normalise($_POST['id_type_fichier'], 'int');
            	modelFile::update($id_fichier, $intitule_fichier, $description_fichier, $nom_fichier, $id_dossier, $id_type_fichier);
            	redirect('admin_fichier_ajout', 'etape=2');
        	}
        	
            $admin_fichier_ajout_etape_1 = new flyLayout(REP_TPL . 'admin/admin_fichier_ajout_etape_1.tpl');
        	$admin_fichier_ajout_etape_1->start();	
        	$fichier = modelFile::getFichier($id_fichier);
        	
        	$from_etape = (isset($_GET['from']))?$_GET['from']:'';	
        	$admin_fichier_ajout_etape_1->setVariable('url_action', 'admin_fichier_ajout.php?id_fichier='.$id_fichier.'&etape=1&from='.$from_etape);
        	$admin_fichier_ajout_etape_1->setVariable('nom_fichier', $fichier->nom_fichier);
        	$admin_fichier_ajout_etape_1->setVariable('description_fichier', $fichier->description_fichier);
        	$admin_fichier_ajout_etape_1->setVariable('intitule_fichier', $fichier->intitule_fichier);
        	
        	$listDossier = modelFolder::getList();
        	foreach($listDossier as $k => $dossier) {
        		$admin_fichier_ajout_etape_1->setVariable('id_dossier', $dossier->id_dossier);
        		$admin_fichier_ajout_etape_1->setVariable('url_dossier', $dossier->url_dossier);
        		$admin_fichier_ajout_etape_1->setVariable('selected_dossier', ($fichier->id_dossier==$dossier->id_dossier)?'selected="selected"':'');
        		$admin_fichier_ajout_etape_1->parseList('list_dossier');
        	}
        	
        	$resultat = modelFile::getListType();
        	foreach($resultat as $k => $type) {
        		$admin_fichier_ajout_etape_1->setVariable('id_type_fichier', $type->id_type_fichier);
        		$admin_fichier_ajout_etape_1->setVariable('lib_type_fichier', $type->lib_type_fichier);
        		$admin_fichier_ajout_etape_1->setVariable('selected_type_fichier', ($type->id_type_fichier==$type->id_type_fichier)?'selected="selected"':'');
        		$admin_fichier_ajout_etape_1->parseList('list_type_fichier');
        	}
        	
        	$admin_fichier_ajout_etape_1->stop();
        	
        	$admin_fichier_ajout->includeFile('include_etape', $admin_fichier_ajout_etape_1);
            break;
        
        case 2: // ETAPE 2
        
        	/** TRAITEMENT***************************************************************/        	
            // suppression d'un privilege du fichier
        	$id_pf = array_search('delete', $_POST);
			if(isset($id_pf) and $id_pf) {
        		
        	    $privilege = modelFile::getPrivilegeFichierEncours($id_pf);
        	    
                if($privilege)                	
                	modelAccessRight::deleteEncours($privilege->id_privilege);
                modelFile::unlinkPrivilege($id_pf);
                $monster->setMessage('Le lien entre le privilège et le fichier a été supprimé');
				
                
        	}
	
        	if(isset($_POST['new_privilege'])) { // nouveau privilège
        		$intitule_privilege = normalise($_POST['intitule_privilege']);
        		$description_privilege = normalise($_POST['description_privilege']);
        		$type_privilege = normalise($_POST['type_privilege_ajout'], 'int');
                
        		if(!modelAccessRight::existPrivilege($intitule_privilege, $type_privilege)) {
        			$id_privilege = modelAccessRight::insertEncours($intitule_privilege, $description_privilege, $type_privilege);
                    modelAccessRight::linkFichierEncours($id_privilege, $id_fichier);
                    $monster->setMessage('Le privilège a été créé et associé au fichier');
        		}
        		else {
        			$monster->setMessage('Un privilège de ce type et portant ce nom existe déjà');
        		}
        	}
        	if(isset($_POST['add_privilege'])) { // ajout d'un privilège déjà existant
        		$id_privilege = normalise($_POST['id_privilege'], 'int');
        	   if(!modelAccessRight::exist_linkFichierEncours($id_privilege,$id_fichier)){
        		modelAccessRight::linkFichierEncours($id_privilege, $id_fichier);
                $monster->setMessage('Le privilège a été associé au fichier');}
        	}
        	if(isset($_POST['etape3'])) { // passage à l'étape 3
        		if(!modelFile::existPrivilegeEncours($id_fichier))
        			$monster->setMessage('Vous devez associer au moins un privilège au fichier');
        		elseif(isset($_GET['from']) && $_GET['from'] != '') 
    				redirect('admin_fichier_ajout', 'etape='.$_GET['from']);
    			else 
    				redirect('admin_fichier_ajout', 'etape=3');
        	}
        	
            /** AFFICHAGE**************************************************/        	
            $admin_fichier_ajout_etape_2 = new flyLayout(REP_TPL . 'admin/admin_fichier_ajout_etape_2.tpl');
        	$admin_fichier_ajout_etape_2->start();	
        	
        	$from_etape = (isset($_GET['from']))?$_GET['from']:'';	
        	$admin_fichier_ajout_etape_2->setVariable('url_action', 'admin_fichier_ajout.php?id_fichier='.$id_fichier.'&etape=2&from='.$from_etape);
        	$admin_fichier_ajout_etape_2->setVariable('ajax_file', REP_AJAX . 'admin/admin_fichier_privilege_liste.php');
        	$admin_fichier_ajout_etape_2->setVariable('id_fichier', $id_fichier);
        	
        	// liste des privilèges du fichier
        	$list_privilege = modelFile::getPrivilegeEncours($id_fichier);
        	if($list_privilege->size() > 0) {
        		foreach($list_privilege as $k => $privilege) {
        			$admin_fichier_ajout_etape_2->setVariable('type_ligne', ($list_privilege->index()%2==1)?'impair':'pair');
        			$admin_fichier_ajout_etape_2->setVariable('type', $privilege->lib_type_privilege);
        			$admin_fichier_ajout_etape_2->setVariable('intitule_privilege', $privilege->intitule_privilege);
        			//$admin_fichier_ajout_etape_2->setVariable('description_privilege', $privilege->description_privilege);
        			$admin_fichier_ajout_etape_2->setVariable('input_suppr', $privilege->id);
        			$admin_fichier_ajout_etape_2->parseList('un_privilege');
        		}
        		$admin_fichier_ajout_etape_2->parseList('list_privilege');
        	}
        	else {
        		$admin_fichier_ajout_etape_2->showBlock('aucun_privilege');
        	}
        	
        	$liste_type = modelAccessRight::getListType();
        	foreach($liste_type as $k => $type) {
        		$admin_fichier_ajout_etape_2->setVariable('id_type_privilege', $type->id_type_privilege);
        		$admin_fichier_ajout_etape_2->setVariable('lib_type_privilege', $type->lib_type_privilege);		
        		$admin_fichier_ajout_etape_2->parseList('option_type_privilege');
        	}
                	
        	$admin_fichier_ajout_etape_2->stop();
        	
        	$admin_fichier_ajout->includeFile('include_etape', $admin_fichier_ajout_etape_2);
            break;
            
        case 3:
            /** TRAITEMENT**********************************************************/        	
            $id_fr = array_search('delete', $_POST);	
        	if(isset($id_fr) and $id_fr) {
        	    modelFile::unlinkFichier($id_fr);
        	}
        	
        	if(isset($_POST['add_pere']) && isset($_POST['id_fichier_pere'])) {
    			
				foreach($_POST['id_fichier_pere'] as $id_fichier_pere)
    			  if(!modelFile::exist_linkPere($id_fichier,$id_fichier_pere)){
    			    modelFile::linkPere($id_fichier, $id_fichier_pere);}
        	}
        	elseif(isset($_POST['add_fils']) && isset($_POST['id_fichier_fils'])) {
        		foreach($_POST['id_fichier_fils'] as $id_fichier_fils) {
        		  if(!modelFile::exist_linkFils($id_fichier,$id_fichier_fils)){	
					modelFile::linkFils($id_fichier, $id_fichier_fils);}
    			}
        	}
        	elseif(isset($_POST['etape4'])) {
        		if(isset($_GET['from']) && $_GET['from'] != '')
    				redirect('admin_fichier_ajout', 'etape=' .$_GET['from']);
    			else 
    				redirect('admin_fichier_ajout', 'etape=4');
        	}
        	
        	/** AFFICHAGE
        	************************************************************************************/        	
            $admin_fichier_ajout_etape_3 = new flyLayout(REP_TPL . 'admin/admin_fichier_ajout_etape_3.tpl');
        	$admin_fichier_ajout_etape_3->start();
        	$admin_fichier_ajout_etape_3->setVariable('ajax_file_pere', REP_AJAX . 'admin/admin_fichier_pere_liste.php');
        	$admin_fichier_ajout_etape_3->setVariable('ajax_file_fils', REP_AJAX . 'admin/admin_fichier_fils_liste.php');
        	
        	$admin_fichier_ajout_etape_3->setVariable('id_fichier', $id_fichier);		
        	
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
        	$admin_fichier_ajout_etape_3->setVariable('id_type_fichier_pere', 0);
        	$admin_fichier_ajout_etape_3->setVariable('lib_type_fichier_pere', '(tous)');
        	$admin_fichier_ajout_etape_3->parseList('option_type_fichier_pere');
        	foreach($listType as $k => $fichier) {
        		$admin_fichier_ajout_etape_3->setVariable('id_type_fichier_pere', $fichier->id_type_fichier);		
        		$admin_fichier_ajout_etape_3->setVariable('lib_type_fichier_pere', $fichier->lib_type_fichier);
        		$admin_fichier_ajout_etape_3->setVariable('selected_type_fichier_pere', ($fichier->id_type_fichier==$id_type_fichier_pere)?'selected="selected"':'');
        		$admin_fichier_ajout_etape_3->parseList('option_type_fichier_pere');
        	}
        	
        	// Liste des types de fichiers du fils
        	$admin_fichier_ajout_etape_3->setVariable('id_type_fichier_fils', 0);
        	$admin_fichier_ajout_etape_3->setVariable('lib_type_fichier_fils', '(tous)');
        	$admin_fichier_ajout_etape_3->parseList('option_type_fichier_fils');
        	foreach($listType as $k => $fichier) {
        		$admin_fichier_ajout_etape_3->setVariable('id_type_fichier_fils', $fichier->id_type_fichier);		
        		$admin_fichier_ajout_etape_3->setVariable('lib_type_fichier_fils', $fichier->lib_type_fichier);
        		$admin_fichier_ajout_etape_3->setVariable('selected_type_fichier_fils', ($fichier->id_type_fichier==$id_type_fichier_fils)?'selected="selected"':'');
        		$admin_fichier_ajout_etape_3->parseList('option_type_fichier_fils');
        	}
        	
        	// Liste des pères
        	$listPere = modelFile::getPereEncours($id_fichier);
        	if($listPere->size() != 0) {
        		foreach($listPere as $k => $pere) {
        			$admin_fichier_ajout_etape_3->setVariable('type_ligne_pere', ($listPere->index()%2==1)?'impair':'pair');
        			$admin_fichier_ajout_etape_3->setVariable('nom_fichier_pere', $pere->nom_fichier);
        			$admin_fichier_ajout_etape_3->setVariable('input_suppr_pere', $pere->id_fr);
        			$admin_fichier_ajout_etape_3->parseList('un_pere');
        		}
        		$admin_fichier_ajout_etape_3->parseList('list_pere');
        	}
        	else $admin_fichier_ajout_etape_3->showBlock('aucun_pere');
        	
        	// Liste des fichiers
        	$listFils = modelFile::getFilsEncours($id_fichier);
        	if($listFils->size() != 0) {
        		foreach($listFils as $k => $fils) {
        			$admin_fichier_ajout_etape_3->setVariable('type_ligne_fils', ($listFils->index()%2==1)?'impair':'pair');
        			$admin_fichier_ajout_etape_3->setVariable('nom_fichier_fils', $fils->nom_fichier);
        			$admin_fichier_ajout_etape_3->setVariable('input_suppr_fils', $fils->id_fr);
        			$admin_fichier_ajout_etape_3->parseList('un_fils');
        		}
        		$admin_fichier_ajout_etape_3->parseList('list_fils');
        	}
        	else $admin_fichier_ajout_etape_3->showBlock('aucun_fils');
        	
        	$admin_fichier_ajout_etape_3->stop();
        	$admin_fichier_ajout->includeFile('include_etape', $admin_fichier_ajout_etape_3);
        	break;

        case 4:
            if(isset($_POST['submit'])) {
            	
            			$file=modelFile::getFichier($id_fichier);
						$phpfile=$file->nom_fichier.'.php';
						$dossier=$file->url_dossier;
						$tplfile=$file->nom_fichier.'.tpl';
					
						if(!file_exists(REP_TPL.$dossier.$tplfile)){
							$txt=make_file(REP_TPL.$dossier.$tplfile);
						}
					
						if(!file_exists(REP_ROOT.$dossier.$phpfile)){
							modelFile::updateFichier($id_fichier);
    						$monster->setMessage('Votre fichier a bien été ajouté');
    						$txt=make_file(REP_ROOT.$dossier.$phpfile);
    						
        					redirect('admin_fichier_detail', 'id='.$id_fichier);
						}
						else{
							rootLayoutMonster::setMessage('The file you wished to create already exists on the server');
							redirect('admin_fichier');
						}
            }
           
            $admin_fichier_ajout_etape_4 = new flyLayout(REP_TPL . 'admin/admin_fichier_ajout_etape_4.tpl');
        	$admin_fichier_ajout_etape_4->start();
        	$admin_fichier_ajout_etape_4->stop();
            $admin_fichier_ajout->includeFile('include_etape', $admin_fichier_ajout_etape_4);
	}
	
	$admin_fichier_ajout->stop();
	
	$monster->setIncBody($admin_fichier_ajout);
}

$monster->display();

?>