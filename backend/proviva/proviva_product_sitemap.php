<?php

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    if(isset($_POST['submit'])) {
    	try {
    		$domain = 'http://' . $_SERVER['SERVER_NAME'] . '/';
    		$sitemap = new Sitemap($domain);
    		$sitemap->setPath(REP_FRONT);
    		$sitemap->setFilename('sitemap');
    		
    		$sitemap->addItem('', '1.0', ChangeFrequency::NEVER, 'Today');
    		$sitemap->addItem('http://www.facebook.com/provieg', '1.0', ChangeFrequency::NEVER, 'Today', false);
    		
    		/* Navbar */
    		$navbars = array('how-it-works.html', 'products.html', 'testimonials.html', 'contact-us.html');
    		$langs = modelLanguage::getList();
    		foreach ($langs as $key => $lang) {
    			$lang_seperate = set_seperate_lang($lang->language_code);
    			foreach ($navbars as $key => $navbar) {
    				$sitemap->addItem($lang_seperate . $navbar, '0.8', ChangeFrequency::NEVER, 'Today');
    			}
    		}
    		
    		/* Products */
    		$products = modelProduct::getAllProductTranslate();
    		foreach ($products as $key => $product) {
    			$loc = set_seperate_lang($product->language_code) . getURL($product->title, $product->id);
    			$sitemap->addItem($loc, '0.5', ChangeFrequency::MONTHLY, 'Today');
    		}
    		$sitemap->createSitemapIndex($domain);
    		$monster->setMessage('The sitemap has been created');
    		redirect('proviva_product');
    	} catch (Exception $e) {
    		$monster->setMessage($e->getMessage());
    	}
    }
    
	$proviva_product_create = new flyLayout(REP_TPL . 'proviva/proviva_product_sitemap.tpl');	
	$proviva_product_create->start();
	
	$proviva_product_create->stop();
	
    $monster->setIncBody($proviva_product_create);  
}

$monster->display();

?>