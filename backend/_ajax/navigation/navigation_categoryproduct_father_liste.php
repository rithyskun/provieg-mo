<?php

/**
 * Affiche la liste des fichiers correspondant au filtre
 * @author Marcadet Antoine
 * @version 20070625
 */ 
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_famille_arbo = $_POST['id_type_fichier_pere'];
$debut_pere = addslashes($_POST['debut_pere']);
$id_famille = $_POST['id_famille'];
if(modelCategoryProduct::hasFather($id_famille))return;
$root = modelCategoryProduct::root();
echo '<option value="'.$root->id_famille_arbo.'">'.$root->nom_famille.'</option>';
    $listCateg_1 = modelCategoryProduct::children($root->id_famille_arbo,null,$debut_pere);
    if($listCateg_1->size()>0) {
	    $nom_father = '';
	    foreach($listCateg_1 as $key1 => $categ_1) {
	    	$nom_father = $categ_1->nom_famille;
	    		echo '<option value="'.$categ_1->id_famille_arbo.'">'.$nom_father.'</option>';
	    	
	        if(modelCategoryProduct::hasChild($categ_1->id_famille_arbo)) {
	            $listCateg_2 = modelCategoryProduct::children($categ_1->id_famille_arbo);
	            foreach($listCateg_2 as $key2 => $categ_2) { 
	    			$nom_father = $categ_1->nom_famille. ' > '.$categ_2->nom_famille;
	    			echo '<option value="'.$categ_2->id_famille_arbo.'">'.$nom_father.'</option>';
	                if(modelCategoryProduct::hasChild($categ_2->id_famille_arbo)) {
	                    $listCateg_3 = modelCategoryProduct::children($categ_2->id_famille_arbo);
	                    foreach($listCateg_3 as $key3 => $categ_3) {
	    					$nom_father = $categ_1->nom_famille. ' > '.$categ_2->nom_famille.' > '.$categ_3->nom_famille;
	    					echo '<option value="'.$categ_3->id_famille_arbo.'">'.$nom_father.'</option>';
	                    }
	                }
	            }
	        }
	    }
    }
?>