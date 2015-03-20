<?php

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if (acces(__FILE__)) { 
    modelProduct::unlinkPhoto($_GET['product_id'], $_GET['file_id']);
	rootLayoutMonster::setMessage('The photo has been deleted from the product');
    redirect('proviva_product_detail', 'id=' . $_GET['product_id'].'&choix=photo');
}

?>