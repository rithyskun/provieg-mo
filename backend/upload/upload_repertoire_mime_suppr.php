<?php

/**
 * Permet de supprimer un type mime d'un repertoire
 * @author Antoine Marcadet
 * @version 20060827
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if(acces(__FILE__)) { 
	modelUploadFolder::unlinkTypeMime($_GET['id_rm']);
	rootLayoutMonster::setMessage('Le type MIME a bien été supprimé du répertoire');
    redirect('upload_repertoire_detail', 'id=' . $_GET['id'] . '&choix=mime');
	
}	
?>
