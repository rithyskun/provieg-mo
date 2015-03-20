<?php

/**
 * RuntimeException encapsule une erreur (E_WARNING, E_NOTICE, ...) PHP dans un objet héritant de Exception
 * @version: 1.0.0
 * @Date:
 * @author: Frédéric LECOINTRE<frederic.lecointre@burnweb.net>
 * 
 * @TODO:
 */
class RuntimeException extends Exception {

    /**
     * ## SYSTEM METHODS ##
     */
     
    /**
     * Context d'éxécution fournit par PHP
     * @var: array
     * @access: protected
     * @since: 1.0.0
     */
    protected $_context = array();
    
    /**
     * Construit un objet RuntimeException
     * @param: $levelException as integer(PHP_ERRORS_CONSTANTS) -> Le niveau de l'exception
     * @param: $stringException as string -> La description de l'exception
     * @param: $file as string -> Le nom du fichier où l'erreur s'est produite
     * @param: $line as integer -> La ligne  du fichier où l'erreur s'est produite
     * @param: $context as array -> Le context d'éxécution fournit par le gestionnaire d'erreur
     * @access: system
     * @return: void 
     * @throws:
     * @since: 1.0.0
     */
    function __construct($level, $string, $file, $line, $context) {
        parent::__construct($string);
        // on modifie la ligne et le fichier pour ne pas avoir la ligne et le fichier d'où l'exception est levée
        $this->file = $file; 
        $this->line = $line;
        $this->_level = $level;
        $this->_context = $context;
    } // end function __construct($level, $string, $file, $line)

}//end class

?>