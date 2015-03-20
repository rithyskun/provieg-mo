<?php

class SQLException extends Exception {

	public function __construct($message = null, $code = 0) {
		parent::__construct($message, $code);
	}
	
	public function __toString() {
		$str = '<b>'.__CLASS__.'</b>: '.$this->message.'<br />';
		$str.= parent::getTraceAsString();
		return '<pre>'.$str.'</pre>';
	}
	
}

?>