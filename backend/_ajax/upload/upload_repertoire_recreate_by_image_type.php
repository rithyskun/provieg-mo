<?php

/**
 * list pictures for recreating by type 
 * @author Rithy Khin
 * @version 20090522
 */

define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

    $id_repertoire = $_POST['id'];
    
	list($jpeg, $png, $gif) = explode(',', $_POST['imageType'],3);			
	$list_type = ($jpeg?'jpeg,jpg':'').','.$png.','.$gif;
    //-- Section affichage ---------------------------------------------------//
	$upload_repertoire_recreate = new flyLayout(REP_TPL_AJAX.'upload/upload_repertoire_recreate_by_image_type.tpl');
	$upload_repertoire_recreate->start();
	
	$repertoire = modelUploadFolder::getObject($id_repertoire);
	$url_repertoire = REP_FRONT.$repertoire->url_repertoire;
	$i = 0;	
    $rep = opendir($url_repertoire);    
     
    while($filename = readdir($rep)) {
        // solution brutale pour déterminer si il s'agit d'une image et la redimensionner
    	if(@getimagesize($url_repertoire.$filename)) {
    		$path = pathinfo($url_repertoire.$filename);    		
    		preg_match('/'.strtolower($path['extension']).'/',$list_type , $matches);
    		//if(strtolower($path['extension'])=='jpeg')echo($matches[0].'?'.strtolower($path['extension']).' in '.$list_type.'<br/>');
    		if($matches[0]!=""){
    			//if(strtolower($path['extension'])=='jpeg')echo($matches[0].'?'.$filename.' in '.$list_type.'<br/>');
			    $upload_repertoire_recreate->setVariable('nom_fichier', $filename);
			    $upload_repertoire_recreate->setVariable('i_fichier', $i);
			    $upload_repertoire_recreate->parseList('input_hidden');
				$i++;
			}
		}
    	
    }
    closedir($rep);
    $upload_repertoire_recreate->setVariable('nb_fichier', $i);	
	
	$upload_repertoire_recreate->stop();
	echo $upload_repertoire_recreate;
?>