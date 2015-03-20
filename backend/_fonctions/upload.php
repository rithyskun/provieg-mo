<?php

//http://www.infos-du-net.com/forum/26486-21-maitrise-taille-memoire-engendree-script-fatal-error-allowe

function format_size($size) {
    if ($size < 1024) {
        return $size . ' bytes';
    }
    else {
        $size = round($size / 1024, 2);
        $suffix = 'KB';
        if ($size >= 1024) {
            $size = round($size / 1024, 2);
        $suffix = 'MB';
        }
        return $size . ' ' . $suffix;
    }
}

function neededMemoryImage($filename){
    $imageInfo = getimagesize($filename);
    $MB = 1048576;  // number of bytes in 1M
    $K64 = 65536;    // number of bytes in 64K
    $TWEAKFACTOR = 1.68;  // Or whatever works for you
    $memoryNeeded = round( ( $imageInfo[0] * $imageInfo[1]
                                           * $imageInfo['bits']
                                           * $imageInfo['channels'] / 8
                             + $K64
                           ) * $TWEAKFACTOR
                         );
    return $memoryNeeded;
}

function ajaxUploadImage($files, $id_repertoire, $root) {
    $res = array();
    extract($files);
    /*if($size > 6000000) {
        throw new Exception('La taille de votre fichier ne doit pas exceder 6Mo');
    }*/
    
    $path = pathinfo($name);
    
    $key_unique = time() . rand(10000000, 99999999);
    $nom_initial = $name;
    $nom_serveur = normalise($path['filename'].'-'.$key_unique.'.'.$path['extension'],'fichier');
    $nom_telechargement = $name;
    $balise_alt = '';
    
    // récupère le répertoire du type de fichier uploadé
    $oRepertoire = modelUploadFolder::getObject($id_repertoire);
    $url_repertoire = $oRepertoire->url_repertoire;
    $url_original = $root.$url_repertoire.REP_ORIGINAL;
    
    // vérification des autorisations d'upload dans le répertoire
    if(!modelUploadFolder::isAuthorizedTypeMime($id_repertoire, $type)) {
        throw new Exception('Le fichier que vous avez tenté d\'envoyer ne fait pas parti des formats autorisés pour ce répertoire');
    }
    
    // enregistrement du fichier sur le serveur
    fileManager::uploadFile($files, $nom_serveur, $url_original);
    
    // enregistrement du fichier en base de données
    $id_upload = modelUploadFile::insert($nom_initial, $nom_telechargement, $nom_serveur, $id_repertoire, $type, $size, $balise_alt, $key_unique);
    
    // traitement des images 
    if(preg_match('!image!', $type)) {
        // redimensionnement des images
        $listFormat = modelUploadFolder::getListFormat($id_repertoire);
        foreach($listFormat as $key => $format) {
            $url_format = $root.$url_repertoire.$format->url_format;
            imageManager::resizeImageTo($url_original.$nom_serveur, $url_format.$nom_serveur, $format->largeur, $format->hauteur);  
        }
    }
    
    $res['nom_original'] = $name;
    $res['nom_serveur'] = $nom_serveur;
    $res['repertoire'] = $url_repertoire;
    $res['id_upload'] = $id_upload;
    
    return $res;
}



function ajaxRemoveFile($id_fichier) {
    $fichier = modelUploadFile::getObject($id_fichier);
    $repertoire = modelUploadFolder::getObject($fichier->id_repertoire);
     
    // création du répertoire archive si il n'existe pas
    if(!is_dir(REP_ROOT.$repertoire->url_repertoire.REP_ARCHIVE))
        $creation = mkdir(REP_ROOT.$repertoire->url_repertoire.REP_ARCHIVE, 0777);
        
    $source = REP_ROOT.$repertoire->url_repertoire.REP_ORIGINAL.$fichier->nom_serveur;
    $dest   = REP_ROOT.$repertoire->url_repertoire.REP_ARCHIVE.$fichier->nom_serveur;
    fileManager::moveFile($source, $dest);
    
    // Supprime le fichier dans les différents formats
    $listFormat = modelUploadFolder::getListFormat($fichier->id_repertoire);
    foreach($listFormat as $key => $format) {
        fileManager::removeFile(REP_ROOT.$repertoire->url_repertoire.$format->url_format.$fichier->nom_serveur);
    }
    modelUploadFile::delete($id_fichier);
}

?>