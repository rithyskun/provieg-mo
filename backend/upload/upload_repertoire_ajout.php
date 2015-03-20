<?php

/**
 * Permet de créer un type d'upload (répertoire d'upload)
 * @author Marcadet Antoine
 * @date 20070926
 * Lors de la création d'un répertoire d'upload, le dossier est créé sur le serveur
 * Les dossiers de miniatures sont créés à la volée lorsque l'on ajoute des types de format au répertoire
 * Si une taille max a été définie un dossier ".original" est créé, ou seront stockées les images dans la version originale   
 */

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    //-- Section Traitement --------------------------------------------------//
    if(isset($_POST['submit'])) {
    	
        $nom_repertoire = normalise($_POST['nom_repertoire']);
    	$url_repertoire = normalise($_POST['url_repertoire']);
    	
        if(!modelUploadFolder::existNom($nom_repertoire)) {
            $arrayRepertoire = split('/', $url_repertoire);
            $directory = REP_FRONT;
            $url_repertoire = '';
            $creation = true;
            // création des répertoires de manière récursive
            for($i = 0; $i < count($arrayRepertoire) && $creation; $i++) {
                if($arrayRepertoire[$i] == '') continue;
                $directory .= $arrayRepertoire[$i].'/';
                $url_repertoire .= $arrayRepertoire[$i].'/';
                if(!is_dir($directory)) {
                    $creation = mkdir($directory, 0777);
                }
            }
            // création du répertoire des fichiers originaux
            if(!is_dir($directory.REP_ARCHIVE)) {
            	mkdir($directory.REP_ARCHIVE);
            }
            // création du répertoire des fichiers originaux
            if(!is_dir($directory.REP_ORIGINAL)) {
                mkdir($directory.REP_ORIGINAL);
            }
            if(!$creation) { // erreur de création de répertoire
                rootLayoutMonster::setMessage('An error occurred while creating the directory on the server, please try again', Message::ERROR);
            }
            else {
                $id_repertoire = modelUploadFolder::insert($nom_repertoire, $url_repertoire);
                rootLayoutMonster::setMessage('The directory was created', Message::INFO);
                redirect('upload_repertoire_detail','id=' . $id_repertoire);
            }
    	} 
        else {
    		rootLayoutMonster::setMessage('This directory name already exists', Message::ERROR);
    	}
    }

    //-- Section Affichage ---------------------------------------------------//
	$upload_repertoire_ajout = new flyLayout(REP_TPL . 'upload/upload_repertoire_ajout.tpl');	
	$upload_repertoire_ajout->start();
	
    $upload_repertoire_ajout->setVariable('nom_repertoire', (isset($nom_repertoire))?$nom_repertoire:'');
    $upload_repertoire_ajout->setVariable('url_repertoire', (isset($url_repertoire))?$url_repertoire:'');
	
	$upload_repertoire_ajout->stop();
    $monster->setIncBody($upload_repertoire_ajout);  
}

$monster->display();

?>
