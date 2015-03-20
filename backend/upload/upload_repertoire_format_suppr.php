<?php

/**
 * Permet de supprimer un format d'un repertoire
 * @author Antoine Marcadet
 * @version 20060827
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if(acces(__FILE__)) { 
	modelUploadFolder::unlinkFormat($_GET['id_rf']);
	rootLayoutMonster::setMessage('Le format a bien été supprimé du répertoire');
    redirect('upload_repertoire_detail', 'id=' . $_GET['id'] . '&choix=format');
}

?>
