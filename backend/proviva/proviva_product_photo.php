<?php
	
 if(acces(__FILE__)) {
 	
 	$product_id = $_GET['id'];
 	
 	if(isset($_POST['main_photo'])){
 		modelProduct::setMainPhoto($_POST['id'], $product_id);
 	}
 	
	$proviva_product_photo = new flyLayout(REP_TPL . 'proviva/proviva_product_photo.tpl');
	$proviva_product_photo->start();
	
	if(acces('proviva_product_photo_create')) {
		include(REP_ROOT . 'proviva/proviva_product_photo_create.php');
		$proviva_product_photo->includeFile('include_proviva_product_photo_create', $proviva_product_photo_create);
	}
	
	if(acces('proviva_product_photo_upload')) {
		include(REP_ROOT.'proviva/proviva_product_photo_upload.php');
		$proviva_product_photo->includeFile('include_proviva_product_photo_upload', $proviva_product_photo_upload);
	}
	
	$listPhotos = modelProduct::getListPhoto($product_id);
    if($listPhotos->size() > 0) {
        foreach($listPhotos as $key => $photo){
	    	$min_admin = REP_FRONT . $photo->url_repertoire . FORMAT_MINI_ADMIN . $photo->nom_serveur;	
			$preview_admin = REP_FRONT . $photo->url_repertoire . FORMAT_PREVIEW_ADMIN . $photo->nom_serveur;		
			$proviva_product_photo->setVariable('mini_admin', $min_admin);
			$proviva_product_photo->setVariable('preview_admin', $preview_admin);
    		$proviva_product_photo->setVariable('type_ligne', ($listPhotos->index()%2==1)?'impair':'pair');
    		$proviva_product_photo->setVariable('nom_serveur', $photo->nom_initial);
    		$proviva_product_photo->setVariable('status', ($photo->main_photo ? 'Validate' : 'None validation'));
    		$proviva_product_photo->setVariable('id', $photo->id);
    		!$photo->main_photo ? $proviva_product_photo->showBlock('button_main') : $proviva_product_photo->hideBlock('button_main');
    		
    		$proviva_product_photo->setVariable('url_fichier', REP_ROOT . 'upload/upload_fichier_detail.php?id=' . $photo->id_fichier);
    		if(acces('proviva_product_photo_delete')){
    			$proviva_product_photo->setVariable('delete', 'proviva_product_photo_delete.php?product_id=' . $product_id . '&file_id=' . $photo->file_id);	
    		}
    		$proviva_product_photo->parseList('listPhotos');
    	}
       $proviva_product_photo->showBlock('list');
    }else {
        $proviva_product_photo->showBlock('nothing');
    }
	
	$proviva_product_photo->stop();
	
}

?>