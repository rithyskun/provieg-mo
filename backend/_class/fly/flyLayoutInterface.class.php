<?php

interface flyLayoutInterface {
	
	/**
	 * Permet de définir les propriétés du cache du template.
	 * @param cache_time : durée en seconde de la mise en cache
	 * @param cache_file : fichier où est stocké le cache
	 */
	//public function setCache($cache_file, $cache_time);
	public function setCache($cache_file,$resetCatch=null);
	
	public function updateCache();
	
	/**
	 * Permet de définir l'internationalisation du template à mettre en place.
	 * @param lang_file    : url du chemin de langue (fichier .php)
	 * @param lang_lang    : non définit pour prendre en compte la langue du navigateur sinon une chaine qui correspond à la clef de la langue
	 * @param lang_default : langue par défaut (utile en cas de robot)
	 * @pre cette fonction doit être appelée avant la fonction start()	 
	 */     	
	public function setLang($lang_file, $lang_lang = null, $lang_default = 'fr');
	
	public function setFile($include_name, $include_file);
	
    /**
	 * Démarre le travaille de traitement de la page.
	 * @pre cette fonction doit être appelé avant toute instruction de type setVariable et parseList
	 */          	
	public function start();
	
	/**
	 * Définit la valeur d'une variable.
	 * @param $var_name : nom de la variable ou tableau contenant des couples "var_name" => "value"
	 * @param $value : valeur de la variable     	 
	 */
	public function setVariable($var_name, $value = null);
	
	/**
	 * Répète une liste à chaque appel.
	 * Met en place les variables se trouvant dans la zone à répéter
	 * @param $list_name : nom de la liste à repeter	 
	 * @todo trouver un moyen de tirer partie de la recherche déjà faite sur les variables car la on double la recherche...
	 */
	public function parseList($list_name);
	
	/**
	 * Vide le contenu d'une liste
	 * @param $list_name : nom de la liste	 
	 */
	public function resetList($list_name);
	
	/**
	 * Définit le paramètre d'affichage d'un block à vrai (affiché)
	 * @param $block_name : nom du bloc	 
	 */
	public function showBlock($block_name);
	
	/**
	 * Définit le paramètre d'affichage d'un block à faux (pas affiché)
	 * @param $block_name : nom du bloc	
	 * (Note: par défaut les blocks sont cachés, cette méthode n'est utile qu'au cas où l'affichage s'avère changé)
	 */
	public function hideBlock($block_name);
	
	/**
	 * Permet d'inclure le résultat de l'execution d'un autre template
	 * @param $include_name : nom de la zone d'inclusion
	 * @param $fly_object : objet à inclure
	 */
	public function includeFile($include_name, $fly_object);

    /**
	 * Finalise l'execution du template.
	 */
	public function stop();
	
	public function parse();
    
	public function __toString();
	
}

?>