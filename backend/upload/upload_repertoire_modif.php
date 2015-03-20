<?php

/**
 * Permet de modifier un répertoire d'upload
 * @version 20071219
 * @author Marcadet Antoine
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    //-- Section vérifications -----------------------------------------------//
    if(!isset($_GET['id'])) {
        rootLayoutMonster::setMessage('Vous avez été redirigé sur cette page car l\'identifiant du répertoire est non défini', Message::AVERT);
		redirect('upload_repertoire');
    }
    $id_repertoire = $_GET['id'];
    
    if(!modelUploadFolder::exist($id_repertoire)) {
        rootLayoutMonster::setMessage('Le détail que vous demandez n\'existe pas ', Message::ERROR);
        redirect('upload_repertoire');
    }

    rootLayoutMonster::setMessage('La modification de répertoire est interdite pour le moment', Message::AVERT);
    redirect('upload_repertoire_detail', 'id='.$id_repertoire);

}

$monster->display();

?>
