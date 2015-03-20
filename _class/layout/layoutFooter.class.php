<?php

class layoutFooter extends flyLayout {
	
	protected $fly;

	public function __construct($tpl_file = 'layoutFooter.tpl') {
		parent::__construct(REP_LAYOUT.$tpl_file);
	}

	public function parse() {
		try {
			$this->start();
			$this->setVariable('site_version', SITE_VERSION);
	       	$this->stop();
		}catch(flyException $e) {
			echo $e;
		}
    }
    
	public function display(){
		try{
			$this->fly->start();
			$this->parse ();
			$this->fly->stop();
		}
		catch(flyException $e) {
			echo $e;
		}
		echo $this->fly;
	}
    
}

?>