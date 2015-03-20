<?php

/**
 * Affiche le répertoire du type de fichier
 * @author Léang Stéphanie
 * @version 20070629
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_type_fichier = $_POST['type_fichier'];

$db = Annuaire::lookup(KEY_DATABASE);
$res = $db->executeQuery("SELECT * FROM upload_type_fichier WHERE etat_doc = 1");

echo '<option value="0">Tous</option>';
foreach($res as $k => $type) {
    echo '<option value="'.$type->id_type_fichier.'">'.$type->nom_type_fichier.'</option>';
}

?>