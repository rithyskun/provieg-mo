<?php

/**
 * Remplacant le gestionnaire d'erreur natif PHP. IL permet de lever une exception capturable dans un bloc catch
 * pour les fonction/methode ne levant pas d'exception.
 * @param: $level as integer(PHPErrorConstant) -> Niveau de l'erreur PHP
 * @param: $string as string  -> Description de l'erreur
 * @param: $file as string -> Chemin d'accés au fichier dans lequel l'erreur s'est produite
 * @param: $line as integer -> Ligne de $file où l'erreur s'est produite
 * @param: $context as array -> Un contexte d'éxécution fournit par PHP
 * @access: system
 * @return: void
 */
function myErrorHandler($level, $string, $file, $line, $context) {
    echo $level,'<br />';
    echo $string,'<br />';
    echo $file,'<br />';
    echo $line,'<br />';
    echo $context,'<br />';
    
    throw new RuntimeException($level, $string, $file, $line, $context);
}
//set_error_handler('myErrorHandler');



/**
 * Remplace le gestionnaire d'exception natif PHP.
 * @param: $exception as object -> Exception attrapée 
 * @access: system
 * @return: void
 */ 
function myExceptionHandler($exception) {
    echo '<pre>';
    echo $exception;
    echo '</pre>';
}
set_exception_handler('myExceptionHandler');

?>