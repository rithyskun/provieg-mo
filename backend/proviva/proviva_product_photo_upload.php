<?php

if(acces(__FILE__)) {
	
    if(isset($_POST['upload_file'])) {
    	
        try {
        	// récupére le répertoire du type de fichier uploadé
        	$repertoire = modelUploadFolder::getObject($_POST['id_repertoire']);
        	$uploadedFiles = new UploadedFiles($_FILES);
        	foreach ($uploadedFiles['files'] as $key => $files) {
        		upload($files, $repertoire);
        	}
            rootLayoutMonster::setMessage('The photo has been link to the product', Message::INFO);
        	redirect('proviva_product_detail', 'id=' . $_GET['id'].'&choix=photo');
        	
        }
        catch(Exception $e) {
            rootLayoutMonster::setMessage($e->getMessage(), Message::ERROR);
        }
        
    }
    
	$proviva_product_photo_upload = new flyLayout(REP_TPL . 'proviva/proviva_product_photo_upload.tpl');	
	$proviva_product_photo_upload->start();
	
	$proviva_product_photo_upload->setVariable('root_ajax', REP_AJAX . 'upload/');
	$proviva_product_photo_upload->setVariable('id_repertoire', ID_REPERTOIRE_PHOTOS);
	
	$proviva_product_photo_upload->stop();
	
}

function upload($files, $repertoire) {
	
	$id_repertoire = $repertoire->id_repertoire;
	$url_dir = REP_FRONT . $repertoire->url_repertoire;
	extract($files);
	$path = pathinfo($name);
	
	$key_unique = time() . rand(10000, 99999);
	$nom_initial = $name;
	$nom_serveur = normalise($path['filename'].'-'.$key_unique.'.'.$path['extension'],'fichier');
	$nom_telechargement = normalise($path['filename'].'.'.$path['extension'],'fichier');
	
	// vérification des autorisations d'upload dans le répertoire
	if(!modelUploadFolder::isAuthorizedTypeMime($id_repertoire, $type)) {
		throw new Exception('The file you tried to send is not part of the allowed formats for this directory');
	}
	
	// enregistrement du fichier sur le serveur
	if (!is_dir($url_dir)) {
		 
		$url_repertoire = $repertoire->url_repertoire;
	
		$arrayRepertoire = split ( '/', $url_repertoire );
		$directory = '../../';
		$url_repertoire = '';
		$creation = true;
		// création des répertoires de manière récursive
		for($i = 0; $i < count ( $arrayRepertoire ) && $creation; $i ++) {
			if ($arrayRepertoire [$i] == '')
				continue;
			$directory .= $arrayRepertoire[$i]. '/';
			$url_repertoire .= $arrayRepertoire[$i] . '/';
			if (!is_dir($directory)) {
				$creation = mkdir($directory, 0777);
			}
		}
		// création du répertoire des fichiers originaux
		if (!is_dir( $directory . REP_ARCHIVE)) {
			mkdir ( $directory . REP_ARCHIVE);
		}
		// création du répertoire des fichiers originaux
		if (!is_dir( $directory . REP_ORIGINAL)) {
			mkdir ( $directory . REP_ORIGINAL);
		}
	}
		
	// enregistrement du fichier sur le serveur
	fileManager::uploadFile($files, $nom_serveur, $url_dir);
	
	// enregistrement du fichier en base de données
	$id_fichier = modelUploadFile::insert($nom_initial, $nom_telechargement, $nom_serveur, $id_repertoire, $type, $size, '', $key_unique);
	$id_product = $_GET['id'];
	modelProduct::linkPhoto($id_product, $id_fichier);
		
	// traitement des images
	if(preg_match('!image!', $type)) {
		// redimensionnement des images
		$listFormat = modelUploadFolder::getListFormat($id_repertoire);
		foreach($listFormat as $key => $format) {
			$repertoire_format = $url_dir . $format->url_format;
			if(!is_dir($repertoire_format))
				mkdir($repertoire_format, 0777);
			imageManager::resizeImageTo($url_dir . $nom_serveur, $url_dir . $format->url_format . $nom_serveur, $format->largeur, $format->hauteur);
		}
		// redimensionnement du fichier dans le cas ou un format max a été spécifié
		if( $format->id_format != 0 ) {
			fileManager::copyFile($url_dir . $nom_serveur, $url_dir . REP_ORIGINAL . $nom_serveur);
			$formatMax = modelUploadFormat::getObject($format->id_format);
			imageManager::resizeImage($url_dir . $nom_serveur, $formatMax->largeur, $formatMax->hauteur);
		}
	}
}

?>