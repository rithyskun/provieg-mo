<?php
 
if(acces(__FILE__)) {
	
	if(isset($_GET['id'])) {
		$product_id = $_GET['id'];
		if (isset ( $_POST ['add_photos'] )) {
			$product_id = $_POST ['product_id'];
			$file_id = $_POST ['id_fichier'];
			if (!modelProduct::hasLinkPhoto($product_id, $file_id)) {
				modelProduct::linkPhoto($product_id, $file_id );
				rootLayoutMonster::setMessage('The photo has been linked to this product');
				redirect ('proviva_product_detail', 'id=' . $product_id . '&choix=photo' );
			} else {
				rootLayoutMonster::setMessage ('This photo was previusly link to this product' );
			}
		}
	}
	
	$proviva_product_photo_create = new flyLayout(REP_TPL . 'proviva/proviva_product_photo_create.tpl');
    $proviva_product_photo_create->start();
    $proviva_product_photo_create->setVariable('product_id', $product_id);
	$proviva_product_photo_create->setVariable('ajax_file', REP_AJAX . 'proviva/proviva_product_photo_list.php');
	$proviva_product_photo_create->setVariable('url_action', 'proviva_product_detail.php?id=' . $product_id . '&choix=photo');	
    $proviva_product_photo_create->setVariable('ajax_file_image', REP_AJAX . 'proviva/proviva_product_photo.php');
	$proviva_product_photo_create->stop();
	
}

?>