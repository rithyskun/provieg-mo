<?php

/**
 * Affiche les catégories existantes 
 * @author Léang Stéphanie
 * @version 20070703
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$nom_serveur = $_POST['nom_serveur'];

$db = Annuaire::lookup(KEY_DATABASE);
$res = $db->executeQuery("SELECT balise_alt 
                            FROM upload_fichier 
                            WHERE nom_serveur = '$nom_serveur'
                            AND etat_doc = 1");                  		

echo $res->nextObject()->balise_alt;

?>