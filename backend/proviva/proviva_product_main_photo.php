<?php
 
define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if (acces(__FILE__)) {
	
   	modelProduct::unlinkPhoto($_GET['id_product'], $_GET['id_fichier']);
	rootLayoutMonster::setMessage('The photo has been deleted from product');
    redirect('proviva_product_detail', 'id=' . $_GET['id_product'].'&choix=photo');
    
}

?>