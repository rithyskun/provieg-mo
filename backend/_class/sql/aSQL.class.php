<?php

abstract class aSQL {
	
	protected $link;
	protected $db;
	protected $auto_commit; // true ou false
	protected $queries;     // tableau des requètes executées
	protected $key_prepared;    // tableau des valeurs utilisées pour la requete
	protected $val_prepared;    // tableau des valeurs utilisées pour la requete
	
	protected abstract function executeQuery($sql);
	protected abstract function prepareQuery($key, $value);
	protected abstract function flushVariable();
	
	protected abstract function lastInsertId();
    
    protected abstract function numRows($result);
    protected abstract function numFields($result);

    protected abstract function freeResult($result); 
	
    protected abstract function fetchObject($result); 
    protected abstract function fetchArray($result);
    protected abstract function fetchHash($result);
	
    protected abstract function rewind($result);
    protected abstract function dataSeek($result, $pos);

    protected abstract function affectedRows($result);
	
	protected abstract function autoCommit($auto_commit = true);
	protected abstract function beginTransaction();
	protected abstract function commitTransaction();
	protected abstract function rollbackTransaction();
	
	
	public function __toString() {
		$str = '<pre width="100%">';
		$str.= '<b>Requetes</b> : <br />';
		foreach($this->queries as $key => $value) {
			$value = preg_replace('!(\t)|(\r\n)!', ' ', $value);
			$value = preg_replace('!(\s\s+)!', ' ', $value);
			$str.= '<b>'.($key+1).'</b>: '.$value.'<br />';
		}
		$str.= '</pre>';
		return $str;
	}	
}

?>