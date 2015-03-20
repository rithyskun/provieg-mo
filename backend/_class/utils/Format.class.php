<?php

class Format {

    const LOCALE_FR = 1;
    const LOCALE_EN = 2;
    const LOCALE_US = 3;
    
    const TEXT = 1;
    
    const UCFIRST = 11;
    const UCWORDS = 12;
    const LCWORDS = 13;
    
    const DATE_TIME = 21; // date et heure 28/01/1986 17:25:00 à partir d'un timestamp
    const DATE      = 22; // date 28/01/1986 à partir d'un timestamp
    const TIME      = 23; // heure 17:25:00 à partir d'un timestamp
    const DATE_TEXT = 24; // date complet "Mardi 28 Janvier 1986" à partir d'un timestamp
    const TIMESTAMP = 25; 
    
    const ENTIER    = 31;
    const DECIMAL   = 32;
    const MONETAIRE = 33;
    
    const PASSWORD = 41;
    const LOGIN    = 42;
    const FILENAME = 43;
    const URL      = 44;
    
    
    private $locale;
    
    public function __construct($locale) {
        $this->setLocale($locale);
    }
    
    public function setLocale($locale) {
        $this->locale = $locale;
    }
    
    public function in($valeur, $type = self::TEXT, $extra = array()) {
    	switch($type) {
    		case self::TEXT:
    			return htmlentities(trim($valeur), ENT_QUOTES);
    			
    		case self::UCFIRST:
    			return htmlentities(ucfirst(strtolower(trim($valeur))), ENT_QUOTES);
    		case self::UCWORDS:
    			return htmlentities(ucwords(strtolower(trim($valeur))), ENT_QUOTES);
    		case self::LCWORDS:
    			return htmlentities(strtolower(trim($valeur)), ENT_QUOTES);
    		
    		case self::DATE:
        		return 'NULL';
    		case self::TIMESTAMP: // convertir une date 28/01/1986 en son timestamp
    		    switch($this->locale) {
                    case self::LOCALE_FR: // 28/01/1986
                        $date = explode('/', $valeur);
            			if(count($date) == 3) {
            				return mktime(0, 0, 0, $date[1], $date[0], $date[2]);
            			}
            			return 'NULL';
                    case self::LOCALE_EN: // 01/28/1986
                    case self::LOCALE_US:
            			if(count($date) == 3) {
            				return mktime(0, 0, 0, $date[0], $date[1], $date[2]);
            			}
            			return 'NULL';
                }
                break;
    			
    		case self::ENTIER:
    			return (int)$valeur;
    		case self::DECIMAL:
    		    switch($this->locale) {
                    case self::LOCALE_FR:
                        return number_format($valeur, 2, ',', ' ');
                        $valeur = preg_replace('!,!', ' ', $valeur);
                        return preg_replace('!\.!', ',', $valeur);
                    case self::LOCALE_EN:
                    case self::LOCALE_US:
                        return number_format($valeur, 2, '.', ',');
                        $valeur = preg_replace('!,!', '.', $valeur);
                        return preg_replace('! !', ',', $valeur);
                }
                break;
    		case self::MONETAIRE:
    		    switch($this->locale) {
                    case self::LOCALE_FR:
                        return number_format($valeur, 2, ',', ' ');
                        $valeur = preg_replace('!,!', ' ', $valeur);
                        return preg_replace('!\.!', ',', $valeur);
                    case self::LOCALE_EN:
                    case self::LOCALE_US:
                        return number_format($valeur, 2, '.', ',');
                        $valeur = preg_replace('!,!', '.', $valeur);
                        return preg_replace('! !', ',', $valeur);
                }
                break;
    			
    		case self::PASSWORD:
    			//return md5($valeur);
    			return htmlentities(trim($valeur), ENT_QUOTES);
    		case self::LOGIN:
    			return htmlentities(strtolower(trim($valeur)), ENT_QUOTES);
    		case self::FILENAME:		    
                return self::stripaccents($valeur);
            case self::URL:		    
                return self::stripaccents($valeur);
    	}
    }
    
    
    public function out($valeur, $type = 'extrait', $extra = array()) {
    	switch($type) {
    		case 'extrait': // si le texte depasse les 100 car il est affiché tronqué
    			return extrait($valeur, '100');
    			
    		case 'complet':
    			return nl2br($valeur);
    			
    		case self::DATE_TIME: // date et heure à partir d'un timestamp: 28/01/1986 17:25:00
    			if($valeur < 0)
                    $valeur = 0;
    			return date('Y-m-d H:i s', $valeur);
    		case self::DATE: // date sous forme 28/01/1986 à partir d'un timestamp
    			if($valeur <= 0)
    			     return '';
    			return date('Y-m-d', $valeur);
    		case self::TIME: // heure à partir d'un timestamp: 17:25:00
    			if($valeur <= 0)
    			     throw new Exception('La date spécifiée est incorrecte (négative ou nulle)');
    			switch($this->locale) {
                    case self::LOCALE_FR:
    			        return date('H:i s', $valeur);
                    case self::LOCALE_EN:
                    case self::LOCALE_US:
    			        return date('hai', $valeur);
                }
    		    break;
    		case self::DATE_TEXT: // date complet sous forme de "Mardi 28 Janvier 1986" à partir d'un timestamp
    			if($valeur <= 0)
    			     throw new Exception('La date spécifiée est incorrecte (négative ou nulle)');
                switch($this->locale) {
                    case self::LOCALE_FR:
    			        return self::date_FR($valeur);
                    case self::LOCALE_EN:
                    case self::LOCALE_US:
    			        return self::date_US($valeur);
                }
    		    break;

    		case self::DECIMAL:
    		    switch($this->locale) {
                    case self::LOCALE_FR:
                        return number_format($valeur, $extra['prec'], ',', ' ');
                        $valeur = preg_replace('!,!', ' ', $valeur);
                        return preg_replace('!\.!', ',', $valeur);
                    case self::LOCALE_EN:
                    case self::LOCALE_US:
                        return number_format($valeur, $extra['prec'], '.', ',');
                        $valeur = preg_replace('!,!', '.', $valeur);
                        return preg_replace('! !', ',', $valeur);
                }
                break;
    		case self::MONETAIRE:
    		    switch($this->locale) {
                    case self::LOCALE_FR:
                        $valeur = preg_replace('!,!', ' ', $valeur);
                        return preg_replace('!\.!', ',', $valeur);
                    case self::LOCALE_EN:
                    case self::LOCALE_US:
                        $valeur = preg_replace('!,!', '.', $valeur);
                        return preg_replace('! !', ',', $valeur);
                }
                break;
        }
    }
    
    private function extract($chaine, $taille) {
    	$chaine = html_entity_decode($chaine, ENT_QUOTES);
    	if(strlen($chaine) > $taille+3) {
    		$chaine = substr($chaine, 0, $taille) . '...';
    	}
    	return htmlentities(trim($chaine), ENT_QUOTES);
    }
    
    private function stripaccents($dest_fichier){
        $dest_fichier = strtr($dest_fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ/', 
                                             'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy/');
        //remplacer les caracteres autres que lettres, chiffres et point par -
        $dest_fichier = preg_replace('/([^.a-z\/0-9]+)/i', '-', $dest_fichier);
        return strtolower($dest_fichier);
    }
    
    private function date_FR($date) {
    	$jour["Monday"] = "Lundi";
    	$jour["Tuesday"] = "Mardi";
    	$jour["Wednesday"] = "Mercredi";
    	$jour["Thursday"] = "Jeudi";
    	$jour["Friday"] = "Vendredi";
    	$jour["Saturday"] = "Samedi";
    	$jour["Sunday"] = "Dimanche";
    	$mois["January"] = "Janvier";
    	$mois["February"] = "Février";
    	$mois["March"] = "Mars";
    	$mois["April"] = "Avril";
    	$mois["May"] = "Mai";
    	$mois["June"] = "Juin";
    	$mois["July"] = "Juillet";
    	$mois["August"] = "Août";
    	$mois["September"] = "Septembre";
    	$mois["October"] = "Octobre";
    	$mois["November"] = "Novembre";
    	$mois["December"] = "Décembre";
    
    	return $jour[date("l", $date)] . date(" j ", $date) . $mois[date("F", $date)] . date(" Y", $date);
    }
    
    private function date_US($date) {    
    	return date("l",$date).', '.date("F",$date).date(" j",$date).date("S", $date).date(" Y", $date);
    }
}

?>