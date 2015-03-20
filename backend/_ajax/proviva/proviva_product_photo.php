<?php
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');
header('Content-type: text/html; charset=utf-8'); // 
$id_fichier = addslashes($_POST['id']);
$fichier = modelUploadFile::getObject($id_fichier);$url_image = REP_ROOT . $fichier->url_repertoire . FORMAT_PREVIEW_ADMIN . $fichier->nom_serveur;$image = "<img src='" . $url_image . "'/>";
echo $image;
?>