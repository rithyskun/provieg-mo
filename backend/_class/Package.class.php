<?php

/**
 * Classe statique permettant de référencer les packages de classes à utiliser
 * @version 20070705
 * @author Antoine Marcadet
 */
class Package {

    private static $class = array();
    private static $rep_class;
    
    public static function setClassRoot($rep_class) {
        self::$rep_class = $rep_class;
    }
    
    /**
     * Permet d'importer un package de les gestionnaire de package
     * @param package_name : nom du package où se trouvent les classes 
     */
    public static function import($package_name) {
        $open_rep = self::$rep_class . str_replace('.', '/', $package_name) . '/';
        //echo $open_rep;
        if(!is_dir($open_rep)) 
            throw new Exception('Le package "' . $package_name . '" spécifié n\'est pas un package valide');
        $rep = opendir($open_rep);
        while($sub = readdir($rep)) {
            $fichier = pathinfo($sub);
        	if(!is_dir($open_rep . $sub) && $fichier['extension'] == 'php') {
                $class_name = substr($fichier['filename'], 0, strrpos($fichier['filename'], '.'));
                if(!isset(self::$class[$class_name])) {
                    self::$class[$class_name] = $open_rep . $sub;
                }
            }
        }
        closedir($rep);
    }
    
    public static function load($class_name) {
        if(!isset(self::$class[$class_name]))
            throw new Exception('Impossible de charger la classe "' . $class_name . '"');
        return self::$class[$class_name];
    }    
}

?>