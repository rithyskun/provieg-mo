<?php 

/**
 * Permet de gérer l'ordre des menus
 * @author Léang Stéphanie
 * @version 20070626
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)){	
	if(isset($_POST['onglet'])){					
		$listOnglet = modelFile::getFichierType(modelFile::TYPE_ONGLET);
		foreach($listOnglet as $key => $onglet) {
	        if(isset($_POST[$onglet->id_fichier])){
	            $pos = $_POST[$onglet->id_fichier];
	            $cle = $onglet->id_fichier;
	            $order[$cle] = $pos;
	        }
	    }
	    modelFile::updatePositionLevelOne($order);
	    redirect('admin_menu');
	} 
	if(isset($_POST['sous_menu'])){		
		$listMenu = modelFile::getFils($_GET['id'], modelFile::TYPE_MENU);				
		
		foreach($listMenu as $key => $menu) {
	        if(isset($_POST[$menu->id_fichier])){
	            $pos = $_POST[$menu->id_fichier];
	            $cle = $menu->id_fichier;
	            $order[$cle] = $pos;
	        }
	    }
	    
	    modelFile::updatePositionLevelOne($order); 
	    redirect('admin_menu', 'id='.$_GET['id']);
	}
    if(isset($_POST['menubar'])){        		
		$listFichierDetail = modelFile::getFils($_GET['id_f'], modelFile::TYPE_DETAIL);            
        foreach($listFichierDetail as $key => $fichier){
	        $listMenubar = modelFile::getFils($fichier->id_fichier, modelFile::TYPE_MENUBAR);
        }
		foreach($listMenubar as $key => $menubar) {
	        if(isset($_POST[$menubar->id_fichier])){
	            $pos = $_POST[$menubar->id_fichier];
	            $cle = $menubar->id_fichier;
	            $order[$cle] = $pos;
	        }
	    }
	    modelFile::updatePositionLevelOne($order); 
	    redirect('admin_menu', 'id='.$_GET['id'].'&id_f='.$_GET['id_f']);
	}		
		
	$admin_menu = new flyLayout(REP_TPL . 'admin/admin_menu.tpl');
	$admin_menu->start();
    	
	if(isset($_GET['id']) and $_GET['id']!=''){
		$admin_menu->setVariable('id_onglet',$_GET['id']);
		$admin_menu->showBlock('sous_menu');
		$fic = modelFile::getFichier($_GET['id']);
		$admin_menu->setVariable('nom_onglet', $fic->intitule_fichier);		
		
		$listFichierMenu = modelFile::getFils($_GET['id'], modelFile::TYPE_MENU);
		
		// LISTE DES FICHIERS SOUS MENU
		foreach($listFichierMenu as $key => $fichier){
			$admin_menu->setVariable('type_ligne_s', ($listFichierMenu->index()%2)?'impair':'pair');
			$admin_menu->setVariable('ordre_donnee_s', $fichier->numero);
			$admin_menu->setVariable('url_lib_dossier_s', $fichier->url_dossier);
			$admin_menu->setVariable('intitule_fichier_s', $fichier->intitule_fichier);
			$admin_menu->setVariable('description_fichier_s', affiche($fichier->description_fichier));
			$admin_menu->setVariable('id_fic_s', $fichier->id_fichier);
			$admin_menu->setVariable('url_fichier', 'admin_menu.php?id='.$_GET['id'].'&id_f='.$fichier->id_fichier);
			$admin_menu->parseList('fichier_s');
		}
		
		if(isset($_GET['id_f']) and $_GET['id_f']!=''){
		    $admin_menu->setVariable('id_menu',$_GET['id_f']);
    		
    		$fic = modelFile::getFichier($_GET['id_f']);
    		$admin_menu->setVariable('nom_menu', $fic->intitule_fichier);		
		    
            $listFichierDetail = modelFile::getFils($_GET['id_f'], modelFile::TYPE_DETAIL);            
            if($listFichierDetail->size() > 0){
                foreach($listFichierDetail as $key => $fichier){
    		        $listFichierMenubar = modelFile::getFils($fichier->id_fichier, modelFile::TYPE_MENUBAR);
                }
                $admin_menu->showBlock('menubar');
            
            
                // LISTE DES FICHIERS MENUBAR
        		foreach($listFichierMenubar as $key => $fichier){
        			$admin_menu->setVariable('type_ligne_b', ($listFichierMenubar->index()%2)?'impair':'pair');
        			$admin_menu->setVariable('ordre_donnee_b', $fichier->numero);
        			$admin_menu->setVariable('url_lib_dossier_b', $fichier->url_dossier);
        			$admin_menu->setVariable('intitule_fichier_b', $fichier->intitule_fichier);
        			$admin_menu->setVariable('description_fichier_b', affiche($fichier->description_fichier));
        			$admin_menu->setVariable('id_fic_b', $fichier->id_fichier);
        			$admin_menu->setVariable('url_fichier', 'admin_menu.php?id='.$_GET['id'].'&id_f='.$fichier->id_fichier);
        			$admin_menu->parseList('fichier_b');
                 }
             }
        }	
	}
    	
	$listFichierOnglet = modelFile::getFichierType(modelFile::TYPE_ONGLET);
	
	// LISTE DES FICHIERS MENU
	foreach($listFichierOnglet as $key => $fichier){
		$admin_menu->setVariable('type_ligne', ($listFichierOnglet->index()%2)?'impair':'pair');
		$admin_menu->setVariable('ordre_donnee', $fichier->numero);
		$admin_menu->setVariable('url_lib_dossier', $fichier->url_dossier);
		$admin_menu->setVariable('intitule_fichier', $fichier->intitule_fichier);
		$admin_menu->setVariable('description_fichier', affiche($fichier->description_fichier));
		$admin_menu->setVariable('url_fichier', 'admin_menu.php?id='.$fichier->id_fichier);
		$admin_menu->setVariable('id_fic', $fichier->id_fichier);		
		$admin_menu->parseList('fichier');
	}
	
	$admin_menu->stop();
    $monster->setIncBody($admin_menu); 
}

$monster->display();

?>