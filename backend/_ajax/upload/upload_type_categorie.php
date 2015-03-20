<?php

/**
 * Affiche les catégories existantes 
 * @author Léang Stéphanie
 * @version 20070703
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$debut = $_POST['debut_categorie'];

$db = Annuaire::lookup(KEY_DATABASE);
$res = $db->executeQuery("SELECT DISTINCT categorie 
                            FROM upload_type_fichier 
                            WHERE categorie LIKE '$debut%' ");
      		
foreach($res as $k => $categorie) {
	echo '<option value="'.$categorie->categorie.'">'.$categorie->categorie.'</option>';
}

?>