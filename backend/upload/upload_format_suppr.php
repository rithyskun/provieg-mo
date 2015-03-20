<?php

/**
 * Permet de supprimer un répertoire d'upload
 * @version 20071219
 * @author Marcadet Antoine
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    //-- Section vérifications -----------------------------------------------//
    if(!isset($_GET['id'])) {
        rootLayoutMonster::setMessage('Vous avez été redirigé sur cette page car l\'identifiant du format est non défini', Message::AVERT);
		redirect('upload_format');
    }
    $id_format = $_GET['id'];
    
    if(!modelUploadFormat::exist($id_format)) {
        rootLayoutMonster::setMessage('Le détail que vous demandez n\'existe pas ', Message::ERROR);
        redirect('upload_format');
    }
    
    rootLayoutMonster::setMessage('La suppression d\'un format est interdite pour le moment', Message::AVERT);
    redirect('upload_format_detail', 'id='.$id_format);

}

$monster->display();

?>
