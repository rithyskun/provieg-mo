<?php

/**
 * @author 
 * @copyright 2008
 */

if(acces(__FILE__)) {
    /** TRAITEMENT
    ***********************************************************************************************/
    if(isset($_POST['upload_file'])) {
        try {
            extract($_FILES['file']);
            $path = pathinfo($name);
            
            $key_unique = time() . rand(10000000, 99999999);
            $nom_initial = $name;
            $nom_serveur = normalise($_POST['nom_serveur'].'.'.$path['extension'],'fichier');
            if($_POST['nom_telechargement'] != "")
                $nom_telechargement = normalise($_POST['nom_telechargement'].'.'.$path['extension'],'fichier'); 
            else
                $nom_telechargement = normalise($_POST['nom_serveur'].'.'.$path['extension'],'fichier');
                              
            $id_repertoire = $_POST['id_repertoire'];
            $balise_alt = $_POST['balise_alt'];
            
            // récupére le répertoire du type de fichier uploadé
            $repertoire = modelUploadFolder::getObject($id_repertoire);
            $filepath = REP_ROOT . '../' . $repertoire->url_repertoire;
            $filename = $nom_serveur;
            
            // vérification des autorisations d'upload dans le répertoire
            if(!modelUploadFolder::isAuthorizedTypeMime($id_repertoire, $type)) {
                throw new Exception('Le fichier que vous avez tenté d\'envoyer ne fait pas parti des formats autorisés pour ce répertoire');
            }
            
            // enregistrement du fichier sur le serveur
            fileManager::uploadFile($_FILES['file'], $filename, $filepath);
            
            // enregistrement du fichier en base de données
            $id_upload = modelUploadFile::insert($nom_initial, $nom_telechargement, $nom_serveur, $id_repertoire, $type, $size, $balise_alt, $key_unique);
            
            // traitement des images 
            if(preg_match('!image!', $type)) {
                // redimensionnement des images
                $listFormat = modelUploadFolder::getListFormat($id_repertoire);
                foreach($listFormat as $key => $format) {
                    imageManager::resizeImageTo($filepath.$filename, $filepath.$format->url_format.$filename, $format->largeur, $format->hauteur);  
                }
                
                // redimensionnement du fichier dans le cas ou un format max a été spécifié
                if( $format->id_format != 0 ) {
                    fileManager::copyFile($filepath.$filename, $filepath.REP_ORIGINAL.$filename);
                    $formatMax = modelUploadFormat::getObject($format->id_format);
                    imageManager::resizeImage($filepath.$filename, $formatMax->largeur, $formatMax->hauteur);
                }
            }
            
            rootLayoutMonster::setMessage('The file has been sent to the server', Message::INFO);
           
        }
        catch(Exception $e) {
            rootLayoutMonster::setMessage($e->getMessage(), Message::ERROR);
        }
    }

    /** AFFICHAGE
    ***********************************************************************************************/
	$upload_file_create_module = new flyLayout(REP_TPL . 'upload/upload_file_create_module.tpl');	
	$upload_file_create_module->start();
	
	$upload_file_create_module->setVariable('root_ajax', REP_AJAX . 'upload/');
    $upload_file_create_module->setVariable('nom_serveur', (isset($nom_serveur))?$nom_serveur:'');
    $upload_file_create_module->setVariable('nom_telechargement', (isset($nom_telechargement))?$nom_telechargement:'');
    $upload_file_create_module->setVariable('balise_alt', (isset($balise_alt))?$balise_alt:''); 	
    	
    //Get folder photo to combo box/ chandy
	    	
	$listRepertoire = modelUploadFolder::getRepertoireImage();
	foreach($listRepertoire as $key => $repertoire) {
	    $upload_file_create_module->setVariable('selected', (isset($id_repertoire) and $id_repertoire == $repertoire->id_repertoire)?'selected=selected':'');
		$upload_file_create_module->setVariable('id_repertoire', $repertoire->id_repertoire);
		$upload_file_create_module->setVariable('nom_repertoire', $repertoire->nom_repertoire);
		$upload_file_create_module->parseList('repertoire');
	}		
	
	$upload_file_create_module->stop();
}

?>