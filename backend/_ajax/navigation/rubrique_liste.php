<?php

/**
 * Affiche la liste des rubriques
 * @author Antoine Marcadet
 * @version 20080205
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$debut = normalise($_POST['debut']);
$language_code = $_POST['language_code'];

$listCateg = modelCategory::search($debut, $language_code);

$tableau = array();            
foreach($listCateg as $key => $famille){
    if($famille->linked)
        array_push($tableau, '{ name: "'. $famille->nom_famille .'", id: '.$famille->id_famille .'}');
    else
        array_push($tableau, '{ name: "<strong>'. $famille->nom_famille .'</strong>", id: '.$famille->id_famille .'}');
}

$tableau = join(',',$tableau);

echo '['.$tableau.']'; 


?>