<?php

/**
 * Iterateur permettant de traiter le résultat d'une requête SQL de différentes manières.
 * @auhtor antoine marcadet <antoine.marcadet@gmail.com>
 * @version 20070525
 * Pour comprendre les itérateurs : http://frederic.bouchery.free.fr/?2004/11/01/30-Creer-Un-Iterateur-Avec-Php5
 */
class SQLResultSet implements Iterator {

	// type de "fetch" différents
	const FetchObject = 1;
	const FetchHash = 2;
	const FetchArray = 3;
	const FetchFactory = 4;
	const FetchInstance = 5;
	
	// messages d'erreurs
	//const NOT_VALID_RESOURCE = 'La ressource utilisée n\'est pas une ressource valide';
	const NOT_VALID_FETCH_TYPE = 'Type de "fetch" inconnu';
	const NOT_VALID_START_VALUE = 'La valeur de départ de la restriction ne peut être négative';
	const NOT_VALID_LIMIT_VALUE = 'Le nombre de lignes à restreindre ne peut être négatif';
	
    private $driver = null;  // classe du driver de BDD
	
    private $resource = null;
    private $value = null;
    private $index = -1;
    private $length = 0;
	
    private $fetchType = self::FetchObject;
    private $className = null;
	
	private $start = 0;
	private $limit = -1;

	
    public function __construct($resource, $driver) {
        $this->resource = $resource;
        $this->driver = $driver;
        if(is_resource($resource)) {
            $this->length = $this->driver->numRows($this->resource);
        }
    }
	
	public function __destruct() {
		$this->driver->freeResult($this->resource);
	}

	
    public function setFetchType($fetchType) {
		$this->fetchType = $fetchType;
	}
	
    public function setFetchFactory($className) {
		$this->fetchType = self::FetchFactory;
		$this->className = $className;
	}
	
    public function setFetchInstance($className) {
		$this->fetchType = self::FetchInstance;
		$this->className = $className;
	}
	
	public function setLimit($start, $limit) {
		if($start < 0) 
			throw new SQLException(NOT_VALID_START_VALUE);
		if($limit < 0) 
			throw new SQLException(NOT_VALID_LIMIT_VALUE);
		$this->start = $start;
		$this->limit = $limit;
	}
	
	public function clearLimit() {
		$this->start = 0;
		$this->limit = -1;
	}
	
	// positionne le curseur interne au début du résultat
    public function rewind() {
        $this->index = $this->start-1;
		// "-1" car on va faire une lecture tout de suite apres afin d'avancer sur un enregistrement viable
		$this->driver->dataSeek($this->resource, $this->start);
        if($this->length != 0)
            $this->next();
    }

    public function key() {
        return $this->index;
    }

    public function current() {
        return $this->value;
    }

    public function valid() {
		// test si l'enregistrement courant est valide (en fonction des LIMIT données)
		if($this->limit > -1 && $this->index == $this->start + $this->limit) 
			return false;
		
		return $this->value;
    }

    public function next() {
        switch($this->fetchType) {
            case self::FetchObject:
                $this->value = $this->nextObject();
				break;
                
            case self::FetchHash:
                $this->value = $this->nextHash();
				break;
                
            case self::FetchArray:
                $this->value = $this->nextArray();
				break;
                
            case self::FetchFactory:
                $this->value = $this->nextFactory();
				break;
                
            case self::FetchInstance:
                $this->value = $this->nextInstance();
				break;
				
            default:
                throw new SQLException(self::NOT_VALID_FETCH_TYPE.$this->fetchType);
        }
        return $this->value;
    }
	
	public function nextObject() {
        $this->index++;
        return $this->driver->fetchObject($this->resource);
    }

    public function nextArray() {
        $this->index++;
        return $this->driver->fetchArray($this->resource);
    }

    public function nextHash() {
        $this->index++;
        return $this->driver->fetchHash($this->resource);
    }

	// utilise une factory d'objet pour créer un objet ayant des méthodes personnalisés
    public function nextFactory() {
        $this->index++;
        $data = $this->driver->fetchHash($this->resource);
        return ($data)?Factory::instantiates($this->className, $data):false;
    }

    public function nextInstance() {
        $this->index++;
        $data = $this->driver->fetchHash($this->resource);
        if(!$data) {
            $this->value = false;
        }
        else {
            $result = Factory::instantiates($this->className);
            foreach($data as $key => $value) {
                $result->$key = $value;
            }
            $this->value = $result;
        }        
        return $this->value;
    }

    public function length() {
        return $this->length;
    }

    public function size() {
        return $this->length;
    }

    public function index() {
        return $this->index;
    }

}

?>