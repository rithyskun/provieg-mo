<?php

class rootLayout {

    static protected $oMessage;
	protected $varTitle;
	protected $varKeywords;
	protected $varDescription;
	static protected $arrayJavascript = array();
	static protected $arrayJavascriptIE = array();
	static protected $arrayStyleSheet = array();
	private $fileContent;
	protected $fly;

	public function __construct() {
		$this->fly = new flyLayout(REP_LAYOUT.'rootLayout.tpl');
	    $this->init();
	}
	
	public function setTitle($varTitle) {
		$this->varTitle = $varTitle;
	}

	public function setKeywords($varKeywords) {
		$this->varKeywords = $varKeywords;
	}

	public function setDescription($varDescription) {
		$this->varDescription = $varDescription;
	}
    
    static public function addJavaScriptIE($nom_fichier, $url_repertoire = REP_SCRIPT) {
    	self::$arrayJavascriptIE[] = $url_repertoire . $nom_fichier;
    }
	
	static public function addJavaScript($nom_fichier, $url_repertoire = REP_SCRIPT) {
        self::$arrayJavascript[] = $url_repertoire . $nom_fichier;
    }
    
    static function addStyleSheet($nom_fichier, $url_repertoire = REP_STYLE) {
        self::$arrayStyleSheet[] = $url_repertoire . $nom_fichier;
    }
    
	static public function setMessage($message, $type = Message::INFO) {
	    self::$oMessage = new Message($message, $type);
	    $_SESSION['message'] = serialize(self::$oMessage);
    }
	
	public function init() {
		
		/* The front script */
		$this->addJavaScript('jquery-1.11.1.min.js', REP_FRONT_SCRIPT);
		/* The script for froala editor */
		$this->addJavaScript('froala_editor.min.js', REP_FRONT_SCRIPT);
		$this->addJavaScript('block_styles.min.js', REP_FRONT_SCRIPT);
		//$this->addJavaScript('char_counter.min.js', REP_FRONT_SCRIPT);
		$this->addJavaScript('colors.min.js', REP_FRONT_SCRIPT);
		//$this->addJavaScript('file_upload.min.js', REP_FRONT_SCRIPT);
		$this->addJavaScript('font_family.min.js', REP_FRONT_SCRIPT);
		$this->addJavaScript('font_size.min.js', REP_FRONT_SCRIPT);
		$this->addJavaScript('lists.min.js', REP_FRONT_SCRIPT);
		//$this->addJavaScript('media_manager.min.js', REP_FRONT_SCRIPT);
		//$this->addJavaScript('tables.min.js', REP_FRONT_SCRIPT);
		$this->addJavaScript('video.min.js', REP_FRONT_SCRIPT);
		
		/* The front script for browser IE */
		$this->addJavaScriptIE('froala_editor_ie8.min.js', REP_FRONT_SCRIPT);

		/* The front style */
		$this->addStyleSheet('common.css', REP_FRONT_STYLE);
		$this->addStyleSheet('font-awesome.min.css', REP_FRONT_STYLE);
		$this->addStyleSheet('froala_editor.min.css', REP_FRONT_STYLE);
		
		/* The backend script */
		//$this->addJavaScript('jQuery.Dimensions.pack.js');
		$this->addJavaScript('jQuery.AjaxForm.js');
		$this->addJavaScript('jQuery.AjaxSelect.js');
		$this->addJavaScript('jQuery.Infobulle.js');
		$this->addJavaScript('reporting.js');
		$this->addJavaScript('superfish.js');
		$this->addJavaScript('supersubs.js');

		/* The backend style */
        $this->addStyleSheet('monster.css');
        $this->addStyleSheet('superfish.css');
        
		if(isset($_SESSION['message'])) {
            self::$oMessage = unserialize($_SESSION['message']);
            unset($_SESSION['message']);
        }
    }
	
	public function parse() {
    	$this->fly->setVariable('rep_img',     REP_FRONT_DESIGN);
    	$this->fly->setVariable('title',       $this->varTitle);
		$this->fly->setVariable('keywords',    $this->varKeywords);
		$this->fly->setVariable('description', $this->varDescription);
		foreach(self::$arrayJavascriptIE as $k => $fichier) {
			$this->fly->setVariable('script-ie', $fichier);
			$this->fly->parseList('javascript-ie');
		}
        foreach(self::$arrayJavascript as $k => $fichier) {
            $this->fly->setVariable('script', $fichier);
        	$this->fly->parseList('javascript');
        }
        foreach(self::$arrayStyleSheet as $k => $fichier) {
            $this->fly->setVariable('style', $fichier);
        	$this->fly->parseList('stylesheet');
        }
        if(isset(self::$oMessage)) {
            $this->fly->setVariable('class_message', self::$oMessage->getClassMessage());
            $this->fly->setVariable('message', self::$oMessage->getMessage());
            $this->fly->showBlock('message');
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