<?php

class rootLayoutMonster extends rootLayout {

	protected $incHeader;
    protected $incMenu;
    protected $incMenuAction;
	protected $incBody;
	protected $incFooter;
	
	public function setIncHeader($incHeader) {
		$this->incHeader = $incHeader;
	}
	
    public function setIncMenu($incMenu) {
		$this->incMenu = $incMenu;
	}
	
    public function setIncMenuAction($incMenuAction) {
		$this->incMenuAction = $incMenuAction;
	}
	
	public function setIncBody($incBody) {
		$this->incBody = $incBody;
	}
    
	public function setIncFooter($incFooter) {
		$this->incFooter = $incFooter;
	}
     
    public function init(){
        parent::init();
        
        if(!isset($_SESSION['id_user'])) {
            $this->setMessage('You must be logged in to access this page', Message::AVERT);
            redirect('index');
        }
        else {
            modelReportingOnline::registerOnline();
        }
        
        $this->fly->setFile('content', REP_LAYOUT.'rootLayoutMonster.tpl');
        $this->setTitle('Administration ' . MAIL_SITENAME);

		$this->incHeader = new layoutHeader();
		$this->incMenu = new layoutMenu();
		$this->incMenuAction = new layoutMenuAction();
		$this->incFooter = new layoutFooter();
    }


	public function parse() {
        parent::parse();
        $this->fly->includeFile('header', $this->incHeader);  
        $this->fly->includeFile('menu', $this->incMenu);
        $this->fly->includeFile('action', $this->incMenuAction);  
        $this->fly->includeFile('body', $this->incBody);  
        $this->fly->includeFile('footer', $this->incFooter);  
	}

}

?>