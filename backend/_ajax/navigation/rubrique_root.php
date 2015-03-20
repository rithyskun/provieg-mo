<?php

/**
 * Affiche la liste des rubrique
 * @author Antoine Marcadet
 * @version 20080205
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

try{
	$root = modelCategory::root();
	if(!$root) {
			 echo '{name:"None",id:"None",array:null}';
			 return;
		};
	if(modelCategory::hasChild($root->id_famille_arbo))
	    echo '{name:"'.$root->nom_famille.'",id:'.$root->id_famille_arbo.',array:Array()}';
	else 
	    echo '{name:"'.$root->nom_famille.'",id:'.$root->id_famille_arbo.',array:null}';
}catch(SQLException $e){
	echo $e;
}
?>