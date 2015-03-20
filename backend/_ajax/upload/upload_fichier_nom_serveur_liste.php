<?php

/**
 * Lit la table des uploads pour recupérer l'ensemble des chansons correspondant au filtre
 * @author Léang Stéphanie
 * @date 05/07/2007
 */

define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$debut_nom_serveur = normalise($_POST['debut_nom_serveur']);
if(isset($_POST['type_fichier'])){
$id_type_fichier = normalise($_POST['type_fichier']);
}else{
	$id_type_fichier = 0;
}
$db = Annuaire::lookup(KEY_DATABASE);
if($id_type_fichier != 0){
    $res = $db->executeQuery("SELECT * 
                              FROM upload_fichier AS up, upload_type_fichier AS t
                              WHERE nom_serveur LIKE '$debut_nom_serveur%'
                              AND up.id_type_fichier = t.id_type_fichier
                              AND up.id_type_fichier = $id_type_fichier
                              AND up.etat_doc = 1
                              ORDER BY nom_serveur");

}else{
    $res = $db->executeQuery("SELECT * 
                          FROM upload_fichier AS up
                          WHERE nom_serveur LIKE '$debut_nom_serveur%'
                          AND id_repertoire = 1
                          AND up.etat_doc = 1
                          ORDER BY nom_serveur");

}

foreach($res as $k => $fichier) {
	$fichier = modelUploadFile::getObject($fichier->id_fichier);
	$format = modelUploadFormat::getObject(2);
	$url_image = '/'.$fichier->url_repertoire.$format->url_format.$fichier->nom_serveur;
    echo '<option value="'.$url_image.'">'.$fichier->nom_serveur.'</option>';
}

?>