<?php

class rootLayoutLogin extends rootLayout {
	
    public function init(){
        parent::init();
        $this->fly->setFile('content', REP_LAYOUT.'rootLayoutLogin.tpl');
        $this->setTitle(MAIL_SITENAME);
        $this->addStyleSheet('login.css');
    }
    
	public function parse() {
        parent::parse();
        $this->fly->setVariable('rep_img', REP_IMG);  
	}

}

?>