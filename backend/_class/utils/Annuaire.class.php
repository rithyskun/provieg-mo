<?php

/**
 * Classe statique permettant de référencer des objets afin qu'ils soient accessibles dans toute l'application.
 * @version 20070613
 * @author Antoine Marcadet
 * @author Stéphanie Léang  
 */
class Annuaire {

    private static $annuaire = array();
    
    /**
     * Permet d'enregistrer un objet dans l'annuaire.
     * @param key : clef associée à l'objet
     * @param object : l'objet référencé dans l'annuaire          
     */
    public static function register($key, $object) {
        self::$annuaire[$key] = $object;    
    }
    
    /**
     * Retourne l'objet correspondant à la clef passée en paramètre.
     * @param key : clef associée à l'objet     
     */
    public static function lookup($key) {
        return self::$annuaire[$key];
    }    
}

?>