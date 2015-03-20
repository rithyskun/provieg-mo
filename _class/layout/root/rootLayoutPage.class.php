<?php

class rootLayoutPage extends rootLayout {

    protected $incHeader;
	protected $incFooter;
	protected $incBody;
	
	public function setBody($incBody) {
       $this->incBody = $incBody;
    }
    
	public function setHeader($incHeader) {
		$this->incHeader = $incHeader;
	}
	
	public function setFooter($incFooter) {
		$this->incFooter = $incFooter;
	}
	
    public function init() {
        parent::init();
		$this->fly->setFile('content', REP_LAYOUT . 'rootLayoutPage.tpl');
		$this->incHeader = new layoutHeader();
		$this->incFooter = new layoutFooter();
    }

	public function parse() {
        parent::parse();
        $this->fly->includeLayout('header', $this->incHeader);
        $this->fly->includeFile('body', $this->incBody);
        $this->fly->includeLayout('footer', $this->incFooter);
        $message = Persistence::lookup(PERSIST_MESSAGE);
	}

}

?>