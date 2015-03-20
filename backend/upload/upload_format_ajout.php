<?php

/**
 * Permet de créer un type d'upload (répertoire d'upload)
 * @author Marcadet Antoine
 * @date 20070926
 */

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    /** TRAITEMENT
    ***********************************************************************************************/
    if(isset($_POST['submit'])) {        
        $nom_format = normalise($_POST['nom_format']);
    	$url_format = normalise($_POST['url_format']);
    	$largeur = normalise($_POST['largeur']);
    	$hauteur = normalise($_POST['hauteur']);
    	
    	if(!preg_match('!/!', $url_format))
    	   $url_format .= '/';
    	
    	if(preg_match('!^[a-z0-9-]*/$!', $url_format)) {
            if(!modelUploadFormat::existNom($nom_format)) {
                $id_format = modelUploadFormat::insert($nom_format, $url_format, $largeur, $hauteur);
                rootLayoutMonster::setMessage('Le format a bien été créé', Message::INFO);
                redirect('upload_format_detail','id=' . $id_format);
        	} 
            else {
        		rootLayoutMonster::setMessage('Ce nom de format existe déjà', Message::ERROR);
        	}
        }
        else {
    		rootLayoutMonster::setMessage('Le répertoire que vous avez indiqué n\'est pas conforme, il ne peut contenir que des lettres et des chiffres (exemple: "abc-123/")', Message::ERROR);
        }
    }

    /** AFFICHAGE
    ***********************************************************************************************/
	$upload_format_ajout = new flyLayout(REP_TPL . 'upload/upload_format_ajout.tpl');	
	$upload_format_ajout->start();
	
    $upload_format_ajout->setVariable('nom_format', (isset($nom_format))?$nom_format:'');
    $upload_format_ajout->setVariable('url_format', (isset($url_format))?$url_format:'');
    $upload_format_ajout->setVariable('largeur', (isset($largeur))?$largeur:'');
    $upload_format_ajout->setVariable('hauteur', (isset($hauteur))?$hauteur:'');
	
	$upload_format_ajout->stop();
    $monster->setIncBody($upload_format_ajout);  
}

$monster->display();

?>
