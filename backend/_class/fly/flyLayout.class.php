<?php

class flyLayout implements flyLayoutInterface {
	
	private $filename = '';
	private $file = '';
	private $tab_var = array();
	private $tab_list = array();
	private $tab_block = array();
	private $tab_include = array();
	private $tab_file = array();
	private $tab_lang = array();
	
	private $debug = false;
	
	private $lang_file = null;
	private $lang_lang = null;
	
	private $cache_time     = null;
	private $cache_file     = null;
	//private $cache_status   = self::NO_CACHE;
	public $cache_status_fly   = self::NO_CACHE;
	const NO_CACHE    = 0;
	const CACHE_USE   = 1;
	const CACHE_WRITE = 2;
	
	// expressions régulières
	const PREG_CONSTANT  = '#<fly:constant(?: )+name=(?:"|\')([a-zA-Z0-9_-]+)(?:"|\')(?: )*/>#';
	const PREG_VARIABLE  = '#<fly:variable(?: )+name=(?:"|\')([a-zA-Z0-9_-]+)(?:"|\')(?: )*/>#';
	const PREG_INCLUDE   = '#<fly:include(?: )+name=(?:"|\')([a-zA-Z0-9_-]+)(?:"|\')(?: )*/>#';
	const PREG_WRITE     = '#<fly:write(?: )+name=(?:"|\')([a-zA-Z0-9_-]+)(?:"|\')(?: )*/>#';
	const PREG_BLOCK     = '#<fly:block(?: )+name=(?:"|\')([a-zA-Z0-9_-]+)(?:"|\')>#';
	const PREG_FILE      = '#<fly:file(?: )+name=(?:"|\')([a-zA-Z0-9_-]+)(?:"|\')(?: )*/>#';
	const PREG_REC_BLOCK = '#<fly:block(?: )+name=(?:"|\')([a-zA-Z0-9_-]+)(?:"|\')>((?:[^<]|<(?!/?fly:block|fly:block(?=name=(?:"|\')[a-zA-Z0-9_-]+(?:"|\')>))|(?R))+)</fly:block>#is';
	const PREG_REC_LIST  = '#<fly:list(?: )+name=(?:"|\')([a-zA-Z0-9_-]+)(?:"|\')>((?:[^<]|<(?!/?fly:list|fly:list(?=name=(?:"|\')[a-zA-Z0-9_-]+(?:"|\')>))|(?R))+)</fly:list>#is';
	
	// messages d'erreur
	const ERR_PARAM_INSUFF = 'Parametres insuffisants';
	
	// type d'include
	const INC_NONE = 0;
	const INC_OBJECT = 1;
	const INC_LAYOUT = 2;
	const INC_FILE = 3;
	
	/**
	 * Constructeur	
	 */
	public function __construct($filename) {
		$this->filename = $filename;
		if(!file_exists($this->filename))
			throw new flyException("Le fichier '<i>{$this->filename}</i>' n'existe pas");
	}
	
	/**
	 * Permet de définir les propriétés du cache du template.
	 * @param cache_time : durée en seconde de la mise en cache
	 * @param cache_file : fichier où est stocké le cache
	 */
	/*final public function setCache($cache_file, $cache_time) {
        if($cache_time && $cache_file) {
            $this->cache_time = $cache_time;
            $this->cache_file = $cache_file;
			if(file_exists($this->cache_file)) {
			    clearstatcache();
			    $modiftime = filemtime($this->cache_file);
			    $modif = time() - $modiftime; // temps depuis dernière modif
				$this->debug("Cache : {$this->cache_file} | {$this->cache_time} < $modif | " . date("H:i:s", $modiftime));
				if($modif < $this->cache_time) {
					// le fichier de cache est encore valable
					$this->debug('Utilisation du fichier de cache');
					$this->file = file_get_contents($this->cache_file);
					$this->cache_status = self::CACHE_USE;
					return true;
				}
				else { 
					// la date de dernière modif est dépassé, le fichier doit etre recréé
					$this->cache_status = self::CACHE_WRITE;
				}
			}
			else { 
				// le fichier de cache n'existe pas il faudra le créer 
				$this->cache_status = self::CACHE_WRITE;
			}
		}
		else {
            throw new Exception(self::ERR_PARAM_INSUFF);
        }
	}
	
	*//**
	 * Met à jour le cache
	 *//*
	public function updateCache() {
	    clearstatcache();
		$this->cache_status = self::CACHE_WRITE;
        $this->parse();
	}
	
	*//**
	 * Ecrit dans le fichier de cache.
	 *//*     	
	final private function writeCache() {
        $this->debug('Ecriture du fichier de cache');
		$fichier = fopen($this->cache_file, 'w+');
		fwrite($fichier, $this->file);
		fclose($fichier);
		$modiftime = filemtime($this->cache_file);
		$date = time();
        //$this->debug("FIN Ecriture du fichier de cache, modif = ".date("H:i:s",$modiftime).' | exec = '.date("H:i:s",$date));
    }*/
	///////////=====> Rithy 20090721; used in front only
	public function setCache($cache_file,$resetCatch=null) {
			//noted that the file has used cache from root
	        if($cache_file) {
	            $this->cache_file = REP_CACHE.($_SESSION['language_code']?$_SESSION['language_code']:language_default).'-'.str_replace('/','',$cache_file);
				//if(){$this->updateCache(); return;}
				if(isset($resetCatch)){
					$this->updateCache();
				}else{
					if(file_exists($this->cache_file)) {
						//date_default_timezone_set('Europe/Paris');
					    clearstatcache();
					    $this->cache_time = filemtime($this->cache_file);
					    $available_time = time()-CACHE_TIME_AVAILABLE; // temps depuis dernière modif
					    //echo(date('h-i-s,j, n, Y',time()).'<br>'.'>>'.date('h-i-s,j, n, Y',$available_time).'<br>'.'>>'.date('h-i-s,j, n, Y',$this->cache_time));
						//$this->debug("Cache : {$this->cache_file} | {$this->cache_time} < $available_time | " . date("H:i:s", $this->cache_time));				
						if($this->cache_time > $available_time) {
							$this->file = file_get_contents($this->cache_file);
							$this->cache_status_fly = CACHE_USE;
							//$this->displayFromCache();
						}
						else { 
							// la date de dernière modif est dépassé, le fichier doit etre recréé
							$this->cache_status_fly = CACHE_WRITE;
						}
					}
					else { 
						// le fichier de cache n'existe pas il faudra le créer 
						$this->cache_status_fly = CACHE_WRITE;
					}
				}
				
			}
			else {
	            throw new Exception(ERR_PARAM_INSUFF);
	        }
	}
	/**
	 * Met à jour le cache
	 */
	public function updateCache() {
	    clearstatcache();
		$this->cache_status_fly = CACHE_WRITE;
        //$this->parse();
	}
	
	/**
	 * Ecrit dans le fichier de cache.
	 */     	
	public function writeCache() {
		try {
		//remove login div's content		
			$fichier = fopen($this->cache_file, 'w+');
			fwrite($fichier, $this->file);
			fclose($fichier);
		} catch(flyException $e) {
			echo $e;
		}
    }
	/**
	 * Permet de définir l'internationalisation du template à mettre en place.
	 * @param lang_file    : url du chemin de langue (fichier .php)
	 * @param lang_lang    : non définit pour prendre en compte la langue du navigateur sinon une chaine qui correspond à la clef de la langue
	 * @param lang_default : langue par défaut (utile en cas de robot)
	 * @pre cette fonction doit être appelée avant la fonction start()	 
	 */     	
	final public function setLang($lang_file, $lang_lang = null, $lang_default = 'en') {
    	// déterminer la langue
		if(isset($lang_lang)) { // si une langue est passée en parametre elle est prioritaire
			$this->lang_lang = $lang_lang;
		}
		else {
			if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) { // langue du navigateur
				$this->lang_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
			}
			else { // langue par défaut
				if(isset($param['lang_default'])) {
					$this->lang_lang = $lang_default;
				}
			}
		}
		
		// internationalisation
		if(isset($lang_file)) {
			$this->lang_file = $lang_file;
			$extension = strtolower(substr($this->lang_file, strrpos($this->lang_file, '.') + 1));
			if($extension == 'php') {
				if(file_exists($this->lang_file)) {
					include($this->lang_file);
					$this->tab_lang = $flyLang[$this->lang_lang];
				}
				else {
				    throw new flyException("Le fichier de langue '<i>{$this->lang_file}</i>' n'existe pas");
				}
			}
		}
	}
	
	public function setFile($include_name, $include_file) {
	    if(!file_exists($include_file))
			throw new flyException("Le fichier '<i>$include_file</i>' n'existe pas");
			
		$this->tab_file[$include_name] = file_get_contents($include_file);
    }
	
	/**
	 * Démarre le travaille de traitement de la page.
	 * @pre cette fonction doit être appelé avant toute instruction de type setVariable et parseList
	 */          	
	final public function start() {
		if($this->assert()) return true;
		// récupération du fichier TPL
		$this->file = $this->translate($this->filename);
		//$this->file = file_get_contents($this->filename);

		//echo strlen($this->file).'<br />';
		//$this->file = preg_replace('!\\r\\n|\\n|\\r!', '', $this->file);
		//echo strlen($this->file).'<br />';
		//$this->file = preg_replace('!\\s(\\s)*!', ' ', $this->file);
		//echo strlen($this->file).'<hr />';
		
		$this->file = $this->initFile();
		$this->initVariable();
		$this->initInclude(); // traitement des includes de fichier (prise de connaissance des includes)
		$this->initBlock();   // traitement des blocks cachés (initialisation à caché par défaut)
		$this->file = $this->initList(); // transformation des listes en variables (vive la récursivité ! ^^)
		
		return true;
	}
	
	final private function translate($filename) {
		$xml_file = REP_XLAT . preg_replace('/\.tpl$/', '.xml', $filename);
		if(REP_ROOT) $xml_file = REP_ROOT . str_replace(REP_ROOT, '', $xml_file);
		if(file_exists($xml_file)) {
			// istantiate new TMXResourceBundle objects
			$tmx = new TMXResourceBundle($xml_file, $_SESSION['language_code']);
			// get language arrays
			$listTranslate = $tmx->getResource();
			if(is_array($listTranslate)) {
				$content = file_get_contents($filename); 
				foreach($listTranslate as $key => $val) {
					$content = preg_replace('#<fly:translate(?: )+name=(?:"|\')('.$key.')(?:"|\')(?: )*/>#', trim($val), $content);
				}
			}
			
		}else {
			$content = file_get_contents($filename);
		}
		$content = $this->replaceConstant($content);
		return $content;
	}
	
	final private function replaceConstant($content) {
		preg_match_all(self::PREG_CONSTANT, $content, $matches);
		if($matches[1]) {
			foreach($matches[1] as $val) {
				$content = preg_replace('#<fly:constant(?: )+name=(?:"|\')('.$val.')(?:"|\')(?: )*/>#', trim(constant($val)), $content);
			}
		}
		return $content;
	}
	
	final private function initFile($input = null) {
        $input = ($input == null)?$this->file:$input; 
		return preg_replace_callback(self::PREG_FILE, array(&$this, 'initFileCallback'), $input);
    }
    
    final private function initFileCallback($input) {
        if(!isset($this->tab_file[$input[1]])) 
            throw new flyException("La clef {$this->tab_file[$input[1]]} n'a pas de valeur");
		return $this->tab_file[$input[1]];
    }
		
	final private function initVariable($input = null) {
        $input = ($input == null)?$this->file:$input;
		preg_match_all(self::PREG_VARIABLE, $input, $matches);
        $this->tab_var = array_unique($matches[1]); // dédoublonne
        $this->tab_var = array_fill_keys($this->tab_var, ''); // initialise à vide en inversant clef et valeur
        unset($matches);
        /**
         *   équivalent à en supprimant les anciennes clefs
         *   foreach($matches[1] as $key => $value) {
	   	 *      $this->tab_var[$value] = '';
         *   }
         *   @todo : étudier la rapidité 
         */
    }
	
	final private function initInclude($input = null) {
        $input = ($input == null)?$this->file:$input;
		preg_match_all(self::PREG_INCLUDE, $input, $matches);
		foreach($matches[1] as $key => $value) {
		    $this->tab_include[$value]['type'] = self::INC_NONE;
        }
        unset($matches);
    }
       	
	final private function initBlock($input = null) {
        $input = ($input == null)?$this->file:$input;
		preg_match_all(self::PREG_BLOCK, $input, $matches);
		foreach($matches[1] as $key => $value) {
		    $this->tab_block[$value] = false; // caché par défaut
        }
        unset($matches);
	}
	
	/**
	 * Traite le fichier afin de déterminer les "listes" présentes et leurs contenus
	 * @param $input : la chaîne à traiter	 
	 */
	final private function initList($input = null) {
		if(is_array($input)) {
			$list_name = $input[1];
			$list_contenu = $input[2];
			$input = $list_contenu;  // on repart sur ce qu'il y a l'intérieur du <fly:list></fly:list>
			//echo '<b>'.$list_name.'</b><br /><pre>'.htmlentities($list_contenu).'</pre><hr />';
		}
		else {
		    $input = $this->file;
        }
		$res = preg_replace_callback(self::PREG_REC_LIST, array(&$this, 'initList'), $input);
        
        //$tmp = $res;
		// on récupère le contenu du niveau inférieur pour savoir de quoi il est constitué
		// on renvoit au niveau supérieur le block list sous forme d'une variable pour lui cacher le vrai contenu
		if(isset($list_name)) {
		    if(isset($this->tab_var[$list_name]) && !isset($this->tab_list[$list_name])) 
		        throw new flyException("Une liste et une variable ne peuvent porter le même nom ($list_name)");
			$this->tab_list[$list_name] = $res;
			$this->tab_var[$list_name] = '';
			$res = '<fly:variable name="'.$list_name.'" />';
		}
        //echo '<b>'.$list_name.'</b><br /><pre>'.htmlentities($tmp).'</pre><hr /><pre>'.htmlentities($res).'</pre><hr/>';
		
        return $res;
	}
	
	
	/**
	 * Préréquis à l'execution de certaines fonctions
	 * Si la condition est remplie, les fonctions de traitement ne sont pas executées	 
	 */     	
	final private function assert() {
		return ($this->cache_status_fly == self::CACHE_USE);
	}
	
	/**
	 * Définit la valeur d'une variable.
	 * @param $var_name : nom de la variable ou tableau contenant des couples "var_name" => "value"
	 * @param $value : valeur de la variable    	 
	 */
	final public function setVariable($var_name, $value = null) {
		if($this->assert()) return true;
		if(is_array($var_name)) {
			$this->tab_var = array_merge($this->tab_var, $var_name);
		}
		else {
            if(!isset($this->tab_var[$var_name])) // variable inconnue même après traitement
			    throw new flyException("La variable '<i>$var_name</i>' est non définie");
			$this->tab_var[$var_name] = isset($value)?$value:"";
		}
	}
	
	/**
	 * Répète une liste à chaque appel en ajoutant à la suite
	 * @param $list_name : nom de la liste à repeter
	 */
	final public function parseList($list_name) {
		if($this->assert()) return true;
		if(!isset($this->tab_var[$list_name]))
			throw new flyException("La liste '<i>$list_name</i>' est non définie");
		
		$code_list = $this->tab_list[$list_name]; // ce que contient la liste (le code)
		$code_list = $this->parseVariable($code_list);
		$code_list = $this->parseInclude($code_list);
		$code_list = $this->parseBlock($code_list); // en dernier car cette méthode supprime des zones, évite des erreurs
		$this->tab_var[$list_name] .= $code_list;  // ajoute au block le résultat de la nouvelle itération
	}
	
	/**
	 * Répète une liste à chaque appel en ajoutant au début
	 * @param $list_name : nom de la liste à repeter
	 */
	final public function parseReverseList($list_name) {
		if($this->assert()) return true;
		if(!isset($this->tab_var[$list_name]))
			throw new flyException("La liste '<i>$list_name</i>' est non définie");
		
		$code_list = $this->tab_list[$list_name]; // ce que contient la liste (le code)
		$code_list = $this->parseVariable($code_list);
		$code_list = $this->parseInclude($code_list);
		$code_list = $this->parseBlock($code_list); // en dernier car cette méthode supprime des zones, évite des erreurs
		$this->tab_var[$list_name] = $code_list . $this->tab_var[$list_name];  // ajoute au block le résultat de la nouvelle itération
		$this->tab_const[$list_name] = $code_list . $this->tab_const[$list_name];
	}
	
	/**
	 * Vide le contenu d'une liste
	 * @param $list_name : nom de la liste	 
	 */
	final public function resetList($list_name) {
		if($this->assert()) return true;
		if(!isset($this->tab_var[$list_name]))
			throw new flyException("La liste '<i>$list_name</i>' est non définie");
		//echo '<h3>resetList</h3>AVANT<br/>'.htmlentities($this->tab_var[$list_name]).'<hr />';
        $this->tab_var[$list_name] = '';
	}
	
	
	/**
	 * Définit le paramètre d'affichage d'un block à vrai (affiché)
	 * @param $block_name : nom du bloc	 
	 */
	final public function showBlock($block_name) {
	    $this->setBlockStatus($block_name, true);
	}
	
	/**
	 * Définit le paramètre d'affichage d'un block à faux (pas affiché)
	 * @param $block_name : nom du bloc	
	 * (Note: par défaut les blocks sont cachés, cette méthode n'est utile qu'au cas où l'affichage s'avère changé)
	 */
	final public function hideBlock($block_name) {
	    $this->setBlockStatus($block_name, false);
	}
	
	final private function setBlockStatus($block_name, $status) {
		if($this->assert()) return true;
		if(!isset($this->tab_block[$block_name]))
	       	throw new flyException("Le block '<i>$block_name</i>' est non défini");
		$this->tab_block[$block_name] = $status;
    }
	
	/**
	 * Permet d'inclure le résultat de l'execution d'un autre template
	 * @param $include_name : nom de la zone d'inclusion
	 * @param $fly_object : objet à inclure
	 */
	final private function setInclude($include_name, $fly_object) {
        if($this->assert()) return true;
		if(!isset($this->tab_include[$include_name]))
			throw new flyException("La zone d'include '<i>$include_name</i>' est non définie");
		$this->tab_include[$include_name]['object'] = $fly_object;
    }
	final public function includeFile($include_name, $fly_object) {
	    $this->setInclude($include_name, $fly_object);
	    $this->tab_include[$include_name]['type'] = self::INC_OBJECT;
	}
	final public function includeLayout($include_name, $fly_layout) {
	    $this->setInclude($include_name, $fly_layout);
	    $this->tab_include[$include_name]['type'] = self::INC_LAYOUT;
	}
	

    /**
	 * Finalise l'execution du template.
	 * @todo ajouter un système "d'escape var" qui supprime du code les variables non définies
	 */
	final public function stop() {
	    // mise à jour de file si le cache n'est pas utilisé
        if($this->assert()) return true;
		$this->file = $this->clearHiddenBlock();    // clear hidden block
		$this->file = $this->parseBlock();    // Affichage des blocks cachés
        $this->file = $this->parseVariable(); // Remplacement de toutes les valeurs de variables
       	$this->file = $this->parseLang();     // Internationalisation des messages
		$this->file = $this->parseInclude();  // Inclusion des templates externes
        
        // écriture du fichier de cache
       	if($this->cache_status_fly == self::CACHE_WRITE)
			$this->writeCache();
    }
    
    /**
     * Remplace les variables par leur contenu dans la zone passée en paramètre.
     */         
    final private function parseVariable($input = null) {
        $input = ($input == null)?$this->file:$input;
		$res = preg_replace_callback(self::PREG_VARIABLE, array(&$this, 'parseVariableCallback'), $input);
    	return $res;
    }
    
    final private function parseVariableCallback($input) {
		return $this->tab_var[$input[1]];
    }
    
    /**
     * Remplace les messages internationalisés par leurs contenus dans la zone passée en paramètre.
     */         
    final private function parseLang($input = null) {
        $input = ($input == null)?$this->file:$input; 
		$res = preg_replace_callback(self::PREG_WRITE, array(&$this, 'parseLangCallback'), $input);
    	return $res;
	}
	
	final private function parseLangCallback($input) {
		return $this->tab_lang[$input[1]];
    }
    
	
	/**
	 * remove hidden block
	 */
	final private function clearHiddenBlock($input=null) {
		if(is_array($input)) {
			$block_name = $input[1];
			$block_contenu = $input[2];
			$input = $block_contenu;
		}
		else {
            $input = ($input == null)?$this->file:$input; 
        }
        preg_match_all(self::PREG_BLOCK,$input,$matches);
		foreach($matches[1] as $key => $value){
		    if($this->tab_block[$value] == false || !$this->tab_block[$value]){
		    	$preg_replace_block = '#<fly:block(?: )+name=(?:"|\')('.$value.')(?:"|\')>((?:[^<]|<(?!/?fly:block|fly:block(?=name=(?:"|\')'.$value.'(?:"|\')>))|(?R))+)</fly:block>#is';
		    	$this->file = preg_replace($preg_replace_block,'',$input);
		    }
        }
        unset($matches);
       return $this->file;
	}
	/**
	 * Renvoi la valeur d'affichage d'un block en fonction de son paramètre d'affichage (oui ou non)
	 */
	final private function parseBlock($input = null) {
		if(is_array($input)) {
			$block_name = $input[1];
			$block_contenu = $input[2];
			$input = $block_contenu;
		}
		else {
            $input = ($input == null)?$this->file:$input; 
        }
        
		if((isset($block_name) && !$this->tab_block[$block_name])){
			$res = '';
		}else{
			$res = preg_replace_callback(self::PREG_REC_BLOCK, array(&$this, 'parseBlock'), $input);
		}
		// si le block n'est pas à afficher on renvoie vide pour sa valeur
		return $res;
	}
	/**
	 * Renvoi la valeur d'affichage d'un block en fonction de son paramètre d'affichage (oui ou non)
	 */
	/*final private function parseBlock($input = null) {
		if(is_array($input)) {
			$block_name = $input[1];
			$block_contenu = $input[2];
			$input = $block_contenu;
		}
		else {
            $input = ($input == null)?$this->file:$input; 
        }
		$res = preg_replace_callback(self::PREG_REC_BLOCK, array(&$this, 'parseBlock'), $input);
		// si le block n'est pas à afficher on renvoie vide pour sa valeur
		if(isset($block_name) && !$this->tab_block[$block_name])
			$res = '';
		return $res;
	}*/
	
	final private function parseInclude($input = null) {
        $input = ($input == null)?$this->file:$input; 
		$res = preg_replace_callback(self::PREG_INCLUDE, array(&$this, 'parseIncludeCallback'), $input);
    	return $res;
    }
    
    final private function parseIncludeCallback($input) {
        switch($this->tab_include[$input[1]]['type']) {
            case self::INC_LAYOUT:
                $this->tab_include[$input[1]]['object']->parse();
                return $this->tab_include[$input[1]]['object'];
            case self::INC_OBJECT:
		        return $this->tab_include[$input[1]]['object'];
		    case self::INC_NONE:
		        return '';
        }
    }
	
	public function parse() {
        // à coder dans chaque vues implémentant flyLayout
    }
	
	public function __toString() {		
        return $this->file?$this->file:'';
	}
	
	final private function getDisplay() {
		return $this->file;
	}
	
	final public function debug($var) {
		if($this->debug)
			echo "<pre><b>[{$this->filename}] Debug:</b> $var</pre>";
	}
	
}

?>