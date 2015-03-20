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

modelCategory::remove($id_famille_arbo);

echo 'Succès';

?>