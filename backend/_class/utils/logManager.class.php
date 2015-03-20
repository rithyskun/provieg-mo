<?php

class logManager {

	private $tabMessage = array();
	const SUBJECT = 'Erreur sur like a chef';
	const DELAY   = 3600;
	const LIMIT   = 10;

	public function __construct() {
	
	}
	
	public function write($message) {
	    $this->tabMessage[] = $message;
	}
	
	public function save() {
	    try {
	        $db = Annuaire::lookup(KEY_DATABASE);
	        $db->autoCommit();
	        $adresse_ip = get_ip_list();
	        $time = time();
			$time_limit = $time - self::DELAY;
	        $sql = "SELECT *
	                FROM _log
					WHERE date_creation > '$time_limit'
					AND adresse_ip = '$adresse_ip'";
			$res = $db->executeQuery($sql);
			if($res->size() < self::LIMIT) {
		        $save = '';
		        foreach($this->tabMessage as $key => $message) {
		            $save.= $message."\n";
		        }
	        	$sql = "INSERT INTO _log(id_log, date_creation, message, adresse_ip)
	            	    VALUES ('','".time()."','$save','$adresse_ip')";
				$db->executeQuery($sql);
			}
	    }
	    catch(SQLException $e) {
			throw $e;
	    }
	}

	public function mail($to, $subject = self::SUBJECT) {
		try {
	        $db = Annuaire::lookup(KEY_DATABASE);
	        $db->autoCommit();
	        $adresse_ip = get_ip_list();
	        $time = time();
			$time_limit = $time - self::DELAY;
	        $sql = "SELECT *
	                FROM _log
					WHERE date_creation > '$time_limit'
					AND adresse_ip = '$adresse_ip'";
			$res = $db->executeQuery($sql);
			if($res->size() < self::LIMIT) {
		        $message = '';
		        foreach($this->tabMessage as $key => $value) {
		            $message.= $value."\n";
		        }
		    	$headers = 'From: "like a chef" <contact@likeachef.com>'."\n";
		    	$headers.= 'Reply-To: "like a chef" <contact@likeachef.com>'."\n";
		    	$headers.= 'Content-Type: text/plain; charset="utf-8"'."\n";
		    	$headers.= 'Content-Transfer-Encoding: 8bit';
			    mail($to, $subject, $message, $headers);
			}
	    }
	    catch(SQLException $e) {
			throw $e;
	    }
	}
}

?>