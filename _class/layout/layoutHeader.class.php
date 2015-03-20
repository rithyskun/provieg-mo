<?php

class layoutHeader extends flyLayout {
	
	public function __construct($tpl_file = 'layoutHeader.tpl') {				
		parent::__construct(REP_LAYOUT . $tpl_file);
	}
    
    public function parse() {
		try {
			$this->start();
			$language_code = $_SESSION['language_code'];
			// Note: set active lang (language_code+'_'+country_code) eg: en_US or km_KH
			$this->setVariable('default-lang', modelLanguage::getActivated($language_code));
			$this->setVariable('multi-lang', modelLanguage::getBootstrapFormHelperMultiLang());

			include(REP_LANG . 'layoutHeader-lang.php');
			$flyLang = $flyLang[$language_code];
			$lang = set_seperate_lang($language_code);
			$this->setVariable('language_code', $lang);
			$menu = array(
					'how-it-works.php' => array('nav_url' => $lang.'how-it-works.html', 'nav_title' => $flyLang['menu_how_it_works']),
					'products.php' => array('nav_url' => $lang.'products.html', 'nav_title' => $flyLang['menu_products']),
					'testimonials.php' => array('nav_url' => $lang.'testimonials.html', 'nav_title' => $flyLang['menu_testimonials']),
					'contact-us.php' => array('nav_url' => $lang.'contact-us.html', 'nav_title' => $flyLang['menu_contact_us'])
			);
			foreach ($menu as $key => $nav) {
				$this->setVariable('nav_active', $key == PAGE_EXT ? 'class="active"' : '');
				foreach ($nav as $key => $val) {
					$this->setVariable($key, $val);
				}
				$this->parseList('nav');
			}
			
			$this->stop();
		} catch(flyException $e) {
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