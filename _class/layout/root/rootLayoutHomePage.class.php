<?php

class rootLayoutHomePage extends rootLayout {

    protected $incHeader;
    protected $incBanner;
	protected $incFooter;
	protected $incBody;
	
	public function setBody($incBody) {
       $this->incBody = $incBody;
    }

    public function setBanner($incBanner) {
    	$this->incBanner = $incBanner;
    }
    
	public function setHeader($incHeader) {
		$this->incHeader = $incHeader;
	}
	
	public function setFooter($incFooter) {
		$this->incFooter = $incFooter;
	}
	
    public function init() {
        parent::init();
        $this->addJavaScript('jquery.flexslider.js');
		$this->addStyleSheet('flexslider.css');
		$this->fly->setFile('content', REP_LAYOUT . 'rootLayoutHomePage.tpl');
		$this->incHeader = new layoutHeader();
		$this->incBanner = new layoutBanner();
		$this->incFooter = new layoutFooter();
    }

	public function parse() {
        parent::parse();
        $this->fly->includeLayout('header', $this->incHeader);
       	$this->fly->includeLayout('banner', $this->incBanner);
        $this->fly->includeFile('body', $this->incBody);
        $this->fly->includeLayout('footer', $this->incFooter);
        $message = Persistence::lookup(PERSIST_MESSAGE);
	}

}

?>