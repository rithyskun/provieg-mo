<?php

/**
 * Affiche la liste des rubriques
 * @author Antoine Marcadet
 * @version 20080205
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_famille_arbo = normalise($_POST['id_famille_arbo'], 'id');
$language_code = $_POST['language_code'];

	$listFils = modelCategory::childrenCountry($id_famille_arbo,$language_code);


$tableau = array();
foreach($listFils as $key => $fils) {
    if(modelCategory::hasChild($fils->id_famille_arbo)) 
        $tableau[] = '{ name:"'.$fils->nom_famille.'", id:'.$fils->id_famille_arbo.', array: Array() }';
    else 
        $tableau[] = '{ name:"'.$fils->nom_famille.'", id:'.$fils->id_famille_arbo.', array: null }';
}

echo '['.join(',',$tableau).']';

?>