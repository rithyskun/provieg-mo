<?php

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if (acces(__FILE__)) { 
    modelProduct::unlinkTranslate($_GET['product_id'], $_GET['language_code']);
	rootLayoutMonster::setMessage('The translate has been deleted from the product');
    redirect('proviva_product_detail', 'id=' . $_GET['product_id'] . '&choix=translate');
}

?>