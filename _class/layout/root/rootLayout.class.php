<?php

class rootLayout {

	protected $varTitle;
	protected $varDescription;
	protected $varAuthor;
	protected $varCanonical;
	protected $index;
	protected $follow;
	protected $arrayJavascriptIE = array();
	protected $arrayJavascript = array();
	protected $arrayJavascriptLive = array();
	protected $arrayStyleSheet = array();
	protected $fly;

	public function __construct() {
		$this->fly = new flyLayout(REP_LAYOUT . 'rootLayout.tpl');
	    $this->init();
	}

	public function setTitle($varTitle) {
		$this->varTitle = $varTitle;
	}

	public function setDescription($varDescription) {
		$this->varDescription = $varDescription;
	}
	
	public function setAuthor($varAuthor) {
		$this->varAuthor = $varAuthor;
	}

	public function setCanonical($varCanonical) {
        $this->varCanonical = $varCanonical;
	}

	public function setIndex($index) {
		$this->index = $index;
	}

	public function setFollow($follow) {
		$this->follow = $follow;
	}

	public function addJavaScriptIE($filename, $url_repertoire = REP_JS) {
		$this->arrayJavascriptIE[] = $url_repertoire . $filename;
	}

	public function addJavaScript($filename, $url_repertoire = REP_JS) {
        $this->arrayJavascript[] = $url_repertoire . $filename;
    }

	public function addJavaScriptLive($filename, $url_repertoire = REP_JS) {
        $this->arrayJavascriptLive[] = $url_repertoire . $filename;
    }

    public function addStyleSheet($filename, $url_repertoire = REP_CSS) {
        $this->arrayStyleSheet[] = $url_repertoire . $filename;
    }

	public function init() {
		/* The script for IE, The HTML5 shim, for IE6-8 support of HTML5 elements */
		$this->addJavaScriptIE('html5shiv.min.js');
		$this->addJavaScriptIE('respond.min.js');
		/* The scripts */
		$this->addJavaScript('jquery-1.11.1.min.js');
        $this->addJavaScript('bootstrap.min.js');
        $this->addJavaScript('jquery.cookie.js');
        $this->addJavaScript('jquery.tabSlideOut.v1.3.js');
        $this->addJavaScript('jquery.history.js');
        $this->addJavaScript('detectmobilebrowser.js');
        $this->addJavaScript('bootstrap-formhelpers.js');
        $this->addJavaScript('scripts.js');
        /* The styles */
		$this->addStyleSheet('font-awesome.min.css');
		$this->addStyleSheet('web-fonts.css');
		$this->addStyleSheet('bootstrap.min.css');
		$this->addStyleSheet('bootstrap-theme.min.css');
		$this->addStyleSheet('bootstrap-formhelpers.css');
        $this->addStyleSheet('style.css');
	}

	public function parse() {
    	$this->fly->setVariable('title', $this->varTitle);
		$this->fly->setVariable('description', $this->varDescription);
		$this->fly->setVariable('author', $this->varAuthor);
		$this->fly->setVariable('canonical', $_SERVER["SERVER_NAME"] . '/' . $this->varCanonical);
		$this->fly->setVariable('index', $this->index ? 'index' : 'noindex');
		$this->fly->setVariable('follow', $this->follow ? 'follow' : 'nofollow');
		foreach($this->arrayJavascriptIE as $k => $file) {
			$this->fly->setVariable('script-ie', $file);
			$this->fly->parseList('javascript-ie');
		}
        foreach($this->arrayJavascript as $k => $file) {
	        $this->fly->setVariable('script', $file);
        	$this->fly->parseList('javascript');
        }
        foreach($this->arrayJavascriptLive as $k => $file) {
	        $this->fly->setVariable('script-live', $file);
        	$this->fly->parseList('javascript-live');
        }
        foreach($this->arrayStyleSheet as $k => $file) {
            $this->fly->setVariable('style', $file);
        	$this->fly->parseList('stylesheet');
        }
	}

	public function display() {
		try {
    		$this->fly->start();
            $this->parse();
    		$this->fly->stop();
		} catch(flyException $e) {
			echo $e;
		}
        echo $this->fly;
    }

}

?>