<?php

/**
 * Classe de gestion d'une base de données MySQL.
 * @author antoine marcadet <antoine.marcadet@gmail.com>
 * @version 20070525
 * Grandement inspiré de classe de Motion Twin
 */
class mySQL extends aSQL {
	
	public function __construct($host, $user, $pass, $database) {
		$this->link = mysql_connect($host, $user, $pass);
		//echo $this->link.'<br />';
        if(!$this->link) { // si le lien avec la BDD n'as pu se faire on leve un exception
			throw new SQLException("Unable to connect to '$user:<pass>@$host'");
		}

		$this->db = mysql_select_db($database, $this->link);
		if(!$this->db) { // on a pas réussit à selectionner la BDD donc on leve une exception
			mysql_close($this->link);
			$this->link = false;
			throw new SQLException("Unable to select database '{$database}'");
		}

	//	echo mysql_client_encoding($this->link),'<br />';
		mysql_query("SET NAMES 'utf8'");
	//	echo mysql_client_encoding($this->link),'<br />';
		mysql_query("SET CHARACTER SET utf8");
	//	echo mysql_client_encoding($this->link);
		
		$this->autoCommit(false); // autocommit a false par défaut
		$this->queries = array();
        $this->key_prepared = array();
        $this->val_prepared = array();
	}
	
	public function __destruct() {
		if($this->link) // fermeture de la connexion
			@mysql_close($this->link);
	}

	public function executeLimit($sql) {
	
	}
	
	public function prepareQuery($key, $value) {
        if(get_magic_quotes_gpc()) {
            if(ini_get('magic_quotes_sybase'))
                $value = str_replace("''", "'", $value);
            else
                $value = stripslashes($value);
        }
        $this->key_prepared[] = '!{'.$key.'}!';
        $this->val_prepared[] = mysql_real_escape_string($value, $this->link);
    }
    
    public function flushVariable() {
        $this->key_prepared = array();
        $this->val_prepared = array();
    }
	
	public function executeQuery($sql) {
        $sql = preg_replace($this->key_prepared, $this->val_prepared, $sql);

		$this->queries[] = $sql; // ajout de la requete dans le tableau des requetes executées
		
		$res = @mysql_query($sql);
		if(!$res) // pas de résultat, on leve une exception car il y a eu une erreur
			throw new SQLException($sql.' <br /> '.mysql_errno($this->link).':'.mysql_error($this->link)); 
		
		return new SQLResultSet($res, $this);
	}
        
	public function lastInsertId() { 
        return mysql_insert_id($this->link); 
    }
    
    public function numRows($result) {
        return @mysql_num_rows($result);
    }
    
    public function numFields($result) { 
        return @mysql_num_fields($result); 
    }
	
    public function freeResult($result) { 
        return @mysql_free_result($result); 
    }

    public function fetchObject($result) { 
        return @mysql_fetch_object($result); 
    }
    
    public function fetchArray($result) { 
        return @mysql_fetch_array($result); 
    }
    
    public function fetchHash($result) { 
        return @mysql_fetch_assoc($result); 
    }
	
	public function rewind($result) {
		return $this->dataSeek($result, 0);
	}
	
	public function dataSeek($result, $pos) {
	    if(mysql_num_rows($result) > 0)
		    return mysql_data_seek($result, $pos);
	    return false;
	}
	

    public function affectedRows($result) {
        return @mysql_affected_rows($this->db);
    }
	
	// autocommit n'est valable que pour les tables de InnoDB
	// permet de faire passer la BDD d'un état cohérent à un autre important dans le cas d'INSERT ou d'UPDATE liés
	public function autoCommit($auto_commit = true) {
		$this->auto_commit = $auto_commit;
		if($this->auto_commit)
			mysql_query("SET AUTOCOMMIT=1");
		else 
			mysql_query("SET AUTOCOMMIT=0");
	}
	
	// création du point de démarrage de la transaction
	public function beginTransaction() {
	    $this->autoCommit(false);
		if(!@mysql_query("BEGIN")) {
			throw new SQLException(mysql_error($this->link));
		}
	}
	
	// validation de la transaction
	public function commitTransaction() {
		if(!@mysql_query("COMMIT")) {
			throw new SQLException(mysql_error($this->link));
		}
	}
	
	// annulation de la transaction
	public function rollbackTransaction() {
		if(!@mysql_query("ROLLBACK")) {
			throw new SQLException(mysql_error($this->link));
		}
	}
}

?>