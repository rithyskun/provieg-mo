<?php

class layoutProduct extends flyLayout {
	
	protected $fly;

	public function __construct($tpl_file = 'layoutProduct.tpl') {
		parent::__construct(REP_LAYOUT.$tpl_file);
	}

	public function parse() {
		try {
			$this->start();
			$language_code = $_SESSION['language_code'];
			$this->setLang(REP_LANG . 'products-lang.php', $language_code);
			$lang = set_seperate_lang($language_code);
			$list = modelProduct::getList();
			if($list->size() >0 ) {
				$i = 1;
				foreach ($list as $key => $product) {
					$s_image = (trim($product->nom_serveur) == '' ? 'design/no-image.png' : ($product->url_repertoire . REP_PHOTOS_LIST . $product->nom_serveur));
					$this->setVariable('style', ($i%2!=0) ? 'left' : 'right');
					$this->setVariable('s_image', $s_image);
					$this->setVariable('title', $product->title);
					$this->setVariable('desc', trim_text($product->desc, 250));
					$this->setVariable('product_id', $product->id);
					$this->setVariable('url_product', $lang . getURL($product->title, $product->id));
					$this->parseList('list');
					$i++;
				}
				$this->showBlock('product');
			}else {
				$this->showBlock('nothing');
			}
	       	$this->stop();
		}catch(flyException $e) {
			echo $e;
		}
    }
    
    public function display() {
		try {
    		$this->fly->start();
            $this->parse();
    		$this->fly->stop();
		}
		catch(flyException $e) {
			echo $e;
		}
        echo $this->fly;
    }
    
}

?>