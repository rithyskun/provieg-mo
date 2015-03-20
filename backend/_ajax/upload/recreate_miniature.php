<?php

define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP


$filename = $_POST['filename'];
$overwrite = $_POST['overwrite'];
$id_repertoire = $_POST['idRepertoire'];
$id_format = $_POST['idFormat'];

$repertoire = modelUploadFolder::getObject($id_repertoire);
$format = modelUploadFormat::getObject($id_format);

$src  = $repertoire->url_repertoire.$filename;
$dest = $repertoire->url_repertoire.$format->url_format.$filename;

try {
    if(!is_dir(REP_FRONT.$repertoire->url_repertoire))
		die('{ error: true, msg: "Répertoire '.$repertoire->url_repertoire.' inexistant" }');
		
    if(!is_dir(REP_FRONT.$repertoire->url_repertoire.$format->url_format))
		die('{ error: true, msg: "Répertoire '.$repertoire->url_repertoire.$format->url_format.' inexistant" }');
		
	if(!file_exists(REP_FRONT.$src))
		die('{ error: true, msg: "Fichier '.$src.' inexistant" }');

	if(file_exists(REP_FRONT.$dest) and $overwrite == 0)
		die('{ error: false, msg: "'.$dest.' non écrasé" }');
	
	try{
		imageManager::resizeImageTo(REP_FRONT.$src, REP_FRONT.$dest, $format->largeur, $format->hauteur, true);
        $pic_info = @getimagesize(REP_FRONT.$src);
		if($_POST['putLogo']=="true" && $pic_info[2]==IMAGETYPE_JPEG){//currently working only with jpeg
			$printlogo = new printLogo();
			$printlogo->createImageAndLogo(REP_FRONT.$dest,LOGO);
			$printlogo->insertLogo(ALIGN_BOTTOM_CENTER,'0,0,4,0',true);
			$printlogo->showImage(REP_FRONT.$dest);
			unset($printlogo);
		}
		if(file_exists(REP_FRONT.$dest)) {
			echo '{ error: false, msg: "'.$dest.' créé" }';
		}else {
			echo '{ error: true, msg: "'.$dest.' écrasé" }';
		}
	}catch(Exception $e){echo '{ error: true, msg: "'.$dest.' écrasé" }';}
}
catch(Exception $e) {
	die('{ error: true, msg: "'.$dest.' exception" }');
}

?>