<?php

/**
 * Permet de visionner les privileges d'un fichier
 * @author L�ang St�phanie
 * @version 20070621
 */


if(acces(__FILE__)) {
	$id_file = $_GET['id'];
	
	$upload_fichier_photo = new flyLayout(REP_TPL . 'upload/upload_fichier_photo.tpl');
	$upload_fichier_photo->start();
	
	
	$listFile = modelUploadFile::getImage($id_file);
		if($listFile->size() > 0){// for photos-artisanat folder
			foreach($listFile as $key => $file) {
				$url_image = '../../'.$file->url_fichier.$file->nom_serveur;
				$upload_fichier_photo->setVariable('src_image', $url_image);
				$upload_fichier_photo->setVariable('link', $url_image);
				$upload_fichier_photo->setVariable('location', $file->url_fichier.$file->nom_serveur);
				//$upload_fichier_photo->setVariable('src_image', 'hello');
				$upload_fichier_photo->parseList('list');
    		}
    		
			
		}else {// for logo folder
			$fichier = modelUploadFile::getImageDetail($id_file);
			if($fichier != null){
				if($fichier->url_repertoire == 'logo/'){
				$url_image = '../../'.$fichier->url_repertoire.$fichier->nom_serveur;
				$upload_fichier_photo->setVariable('src_image1', $url_image);
				$upload_fichier_photo->setVariable('link', $url_image);
				$upload_fichier_photo->setVariable('location1', $fichier->url_repertoire.$fichier->nom_serveur);
				$upload_fichier_photo->showBlock('image1');
				}
				elseif($fichier->url_repertoire == 'pdf/'){
	
				$url_image = '../../'.$fichier->url_repertoire.$fichier->nom_serveur;
				$upload_fichier_photo->setVariable('url_pdf', $url_image);
				$upload_fichier_photo->setVariable('link', $url_image);
				$upload_fichier_photo->setVariable('location2', $fichier->url_repertoire.$fichier->nom_serveur);
				$upload_fichier_photo->showBlock('pdf');	
				}
			}
			else{
				$upload_fichier_photo->showBlock('block_nothing');
			}
		}
			
    
	$upload_fichier_photo->stop();
}

?>