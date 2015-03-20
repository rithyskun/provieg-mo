<?php

class layoutFooter extends flyLayout {
	
	public function __construct($tpl_file = 'layoutFooter.tpl') {
		parent::__construct(REP_LAYOUT.$tpl_file);
		$this->parse();
	}
	
	public function parse() {
		try {
			$this->start();
			$this->setVariable('site_version', SITE_VERSION);
			$this->stop();
		}
		catch(flyException $e) {
			echo $e;
		}
    }

}

?>