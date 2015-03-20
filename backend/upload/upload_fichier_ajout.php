<?php

/**
 * Permet d'envoyer un fichier
 * @author Antoine Marcadet
 * @date 20070827
 */

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
	
    if(isset($_POST['submit'])) {
    	
    	try {
    		// récupère le répertoire du type de fichier uploadé
    		$repertoire = modelUploadFolder::getObject($_POST['id_repertoire']);
    		$uploadedFiles = new UploadedFiles($_FILES);
    		foreach ($uploadedFiles['files'] as $key => $files) {
    			upload($files, $repertoire);
    		}
    		$monster->setMessage('The file has been sent to the server', Message::INFO);
    		redirect("upload_fichier");
    	} catch (Exception $e) {
    		$monster->setMessage($e->getMessage(), Message::ERROR);
    	}
    	
    } /* / .submit */
	
	$upload_fichier_ajout = new flyLayout(REP_TPL . 'upload/upload_fichier_ajout.tpl');	
	$upload_fichier_ajout->start();
	
	$upload_fichier_ajout->setVariable('root_ajax', REP_AJAX . 'upload/');
    	
	$listRepertoire = modelUploadFolder::getList();
	foreach($listRepertoire as $key => $repertoire) {
		$upload_fichier_ajout->setVariable('id_repertoire', $repertoire->id_repertoire);
		$upload_fichier_ajout->setVariable('nom_repertoire', $repertoire->nom_repertoire);
		$upload_fichier_ajout->parseList('repertoire');
	}		
	
	$upload_fichier_ajout->stop();
    $monster->setIncBody($upload_fichier_ajout);  
}

$monster->display();

function upload($files, $repertoire) {

	$id_repertoire = $repertoire->id_repertoire;
	$url_repertoire = REP_FRONT . $repertoire->url_repertoire;
	 
	extract($files);
	$path = pathinfo($name);
	$key_unique = time() . rand(10000000, 99999999);
	$nom_initial = $name;
	$nom_serveur = normalise($path['filename'].'-'.$key_unique.'.'.$path['extension'],'fichier');
	$nom_telechargement = normalise($path['filename'].'.'.$path['extension'],'fichier');
	 
	// vérification des autorisations d'upload dans le répertoire
	if(!modelUploadFolder::isAuthorizedTypeMime($id_repertoire, $type)) {
		throw new Exception('The file you attempted to send is not part of the formats allowed for this directory');
	}
	 
	// enregistrement du fichier sur le serveur
	fileManager::uploadFile($files, $nom_serveur, $url_repertoire);
	 
	// enregistrement du fichier en base de données
	$id_upload = modelUploadFile::insert($nom_initial, $nom_telechargement, $nom_serveur, $id_repertoire, $type, $size, '', $key_unique);
	 
	// traitement des images
	if(preg_match('!image!', $type)) {
		// redimensionnement des images
		$listFormat = modelUploadFolder::getListFormat($id_repertoire);
		foreach($listFormat as $key => $format) {
			if (!file_exists($url_repertoire)) {
				mkdir($url_repertoire, 0777);
			}
			if (!file_exists($url_repertoire.$format->url_format)) {
				mkdir($url_repertoire.$format->url_format, 0777);
			}
			imageManager::resizeImageTo($url_repertoire.$nom_serveur, $url_repertoire.$format->url_format.$nom_serveur, $format->largeur, $format->hauteur);
		}
		 
		// redimensionnement du fichier dans le cas ou un format max a été spécifié
		if( $repertoire->id_format_max != 0 ) {
			if (!file_exists($url_repertoire.REP_ARCHIVE)) {
				mkdir($url_repertoire.REP_ARCHIVE, 0777);
			}
			if (!file_exists($url_repertoire.REP_ORIGINAL)) {
				mkdir($url_repertoire.REP_ORIGINAL, 0777);
			}
			fileManager::copyFile($url_repertoire.$nom_serveur, $url_repertoire.REP_ORIGINAL.$nom_serveur);
		}
	}
} /* / .function */

?>
