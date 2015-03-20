<?php

/**
 * Affiche la liste des fichiers correspondant au filtre
 * @author Marcadet Antoine
 * @version 20070625
 */ 
 
	define('REP_ROOT', '../../');
	require(REP_ROOT . 'config.php');
	
	header('Content-type: text/html; charset=utf-8'); // en-tête HTTP
	$debut_fils = addslashes($_POST['debut_fils']);
	if($_POST['id_famille_arbo']=="") return;	
	
	$listCategoryNotLinked = modelCategoryProduct::noLinked($debut_fils);
	foreach($listCategoryNotLinked as $key => $category){
		echo '<option value="'.$category->id_famille.'">'.$category->nom_famille.'</option>';
	}
?>