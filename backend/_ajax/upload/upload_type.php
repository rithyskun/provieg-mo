<?php

/**
 * Affiche le répertoire du type de fichier
 * @author Léang Stéphanie
 * @version 20070629
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_repertoire = $_POST['id_repertoire'];

if($id_repertoire != '') {
    $db = Annuaire::lookup(KEY_DATABASE);
    $res = $db->executeQuery("SELECT url_repertoire FROM upload_repertoire WHERE id_repertoire = $id_repertoire");
    
    echo $res->nextObject()->url_repertoire;
}
else {
    echo '(aucun)';
}

?>