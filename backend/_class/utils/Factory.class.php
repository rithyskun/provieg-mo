<?php

/**
 * Factory d'objet avec nombre de paramètres variables
 * @author antoine marcadet <antoine.marcadet@gmail.com>
 * @version 20070525
 * Grandement inspiré de : http://www.phpcs.com/codes/PHP5-FACTORY-PARAMETRES-CONSTRUCTEURS_40444.aspx
 */
class Factory {

	public static function instantiates($sClassName, $mArgs = null) {
		if(class_exists($sClassName)) {
			$oClass = new ReflectionClass($sClassName);
			if(is_array($mArgs)) {
				return $oClass->newInstanceArgs($mArgs);
			}
			else if($mArgs) {
				return $oClass->newInstance($mArgs);
			}
			else {
				return $oClass->newInstance();
			}
		}
		else {
			throw new Exception('La classe ' . $sClassName . ' n\'existe pas !');
		}
	}
	
}

?>