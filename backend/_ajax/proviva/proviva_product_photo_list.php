<?php
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$filename = normalise($_POST['debut_fichier']);
$product_id = $_POST['product_id'];

$res = modelProduct::filterPhoto($filename, $product_id);

foreach($res as $k => $fichier) {
	echo '<option value="'.$fichier->id_fichier.'">'.$fichier->nom_initial.'</option>';
}

?>