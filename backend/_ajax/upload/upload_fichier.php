<?php

/**
 * Lit la table des uploads pour recupérer l'ensemble des chansons correspondant au filtre
 * @author Léang Stéphanie
 * @date 05/07/2007
 */

define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$debut_fichier = normalise($_POST['debut_fichier']);
if(isset($_POST['type_fichier']))
    $id_type_fichier = normalise($_POST['type_fichier'], 'id');
else
    $id_type_fichier = 0;

$db = Annuaire::lookup(KEY_DATABASE);

$res = $db->executeQuery("SELECT * 
                          FROM upload_fichier AS up, upload_type_fichier AS t
                          WHERE nom_telechargement LIKE '".$debut_fichier."%'
                          AND up.id_type_fichier = t.id_type_fichier
                          AND up.id_type_fichier = $id_type_fichier
                          AND up.etat_doc = 1                         
                          ORDER BY nom_telechargement");

echo '<option value="0"></option>';
foreach($res as $k => $fichier) {
    echo '<option value="'.$fichier->id_fichier.'">'.$fichier->nom_telechargement.'</option>';
}

?>