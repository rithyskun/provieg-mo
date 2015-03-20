<?php

/**
 * Ajout d'une rubrique à une arborescence
 * @author Antoine Marcadet
 * @version 20080205
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_famille = normalise($_POST['id_famille'], 'id');
$id_famille_arbo = normalise($_POST['id_famille_arbo'], 'id');

$id = modelCategory::append($id_famille, $id_famille_arbo);
echo $id;

?>