<?php


/**
 * Met en place les privilèges de l'utilisateur
 * @author Marcadet Antoine
 * @date 13/06/06
 */
function setPrivileges() {
    $db = Annuaire::lookup(KEY_DATABASE); 
	$res = $db->executeQuery("SELECT ap.id_privilege
            			FROM _adm_privilege AS ap, _adm_groupe AS ag, _adm_groupe_privilege AS agp, _adm_user_groupe AS aug, _adm_user AS au
            			WHERE au.id_user = '{$_SESSION['id_user']}'
            			AND au.id_user = aug.id_user
            			AND aug.id_groupe = ag.id_groupe
            			AND ag.id_groupe = agp.id_groupe
            			AND agp.id_privilege = ap.id_privilege
            			AND ap.etat_doc = 1
            			AND ag.etat_doc = 1
            			AND agp.etat_doc = 1
            			AND aug.etat_doc = 1
            			AND au.etat_doc = 1");
	$_SESSION['privileges'] = array();
	foreach($res as $k => $donnees) {
		array_push($_SESSION['privileges'], $donnees->id_privilege);
	}
}

/**
 * Vérifie qu'un utilisateur a le droit d'acceder à une page, en fonction de ses privilèges
 * @author Marcadet Antoine & Leang Stephanie
 * @date 02/06/06
 * @TODO afficher un message quand l'utilisateur n'a pas le privilege
 */
function privilege_fichier($fichier) {
    if(isset($_SESSION['privileges'])) {
        $db = Annuaire::lookup(KEY_DATABASE);
		$resultat = $db->executeQuery("SELECT DISTINCT ap.id_privilege, af.intitule_fichier
                        				FROM _adm_fichier AS af, _adm_privilege AS ap, _adm_privilege_fichier AS apf
                        				WHERE af.nom_fichier = '$fichier'
                        				AND af.id_fichier = apf.id_fichier
                        				AND apf.id_privilege = ap.id_privilege
                        				AND af.etat_doc = 1
                        				AND apf.etat_doc = 1
                        				AND ap.etat_doc = 1"); 
		foreach($resultat as $k => $value) {
			if(in_array($value->id_privilege, $_SESSION['privileges'])) {
				return $value->intitule_fichier;
			}
		}
	}
	return '';
}

/**
 * Vérifie qu'un utilisateur a le droit d'acceder à une page, en fonction de ses privilèges
 * @author Marcadet Antoine & Leang Stephanie
 * @date 02/06/06
 */
function acces($fichier) {
    $path_parts = pathinfo($fichier);
    $fichier = $path_parts['filename'];
	if(!est_logue() or privilege_fichier($fichier) == '')
		return false;
	return true;
}



function getCurrentPage() {
	$path_parts = pathinfo($_SERVER['PHP_SELF']);
	return $path_parts['filename'];
}

/**
* Redirige la page en cours vers une autre page passée en parametre
* @author Stéphanie Léang
* @version 20070620
*/
function redirect($nom_fichier, $param = '') {
    $db = Annuaire::lookup(KEY_DATABASE);
    $res = $db->executeQuery("SELECT url_dossier 
                                FROM _adm_fichier AS f, _adm_dossier AS d 
                                WHERE f.nom_fichier = '$nom_fichier' 
                                AND f.id_dossier = d.id_dossier");
    $dossier = $res->nextObject()->url_dossier;
    
    $url = REP_ROOT . $dossier . $nom_fichier . '.php'; 
    if($param)
	   header('Location: ' .$url.'?'.$param);
	else
	   header('Location: ' .$url );
    
	exit();
}

/**
* Redirige la page en cours vers une autre page passée en parametre
* @author Antoine Marcadet
* @version 20070919
*/
function redirectFront($nom_fichier, $param = '') {
    /*$db = Annuaire::lookup(KEY_DATABASE);
    $res = $db->executeQuery("SELECT url_dossier 
                                FROM _adm_fichier AS f, _adm_dossier AS d 
                                WHERE f.nom_fichier = '$nom_fichier' 
                                AND f.id_dossier = d.id_dossier");
    $dossier = $res->nextObject()->url_dossier;*/
    $dossier = '';
    
    $url = REP_ROOT . $dossier . $nom_fichier . '.php'; 
    if($param)
	   header('Location: ' .$url.'?'.$param);
	else
	   header('Location: ' .$url );
    
	exit();
}

function reload($param = '') {
    redirect(PAGE, $param);
}


function isValidEmail($email) {
	return (eregi("(^[a-z])(\.|-)?([0-9a-z]){0,}(\.|-)?([a-z0-9]+)((\.|-)?(_)?([a-z0-9]+)){0,}@([a-z0-9\-]+)\.([a-z]{2,4}$)", $email));
}

function monsterMail($destinataire, $subject, $mail, 
                     $from_name = MAIL_NAMESENDER, $from_mail = MAIL_CONTACT, 
                     $reply_name = MAIL_NAMESENDER, $reply_mail = MAIL_CONTACT) {	
	
    // clé aléatoire de limite
    $boundary = '-----='.md5(uniqid(microtime(), TRUE));
    
    // headers 
    $headers = 'From: "'.$from_name.'" <'.$from_mail.'>'."\n";
    if($from_name != $reply_name or $from_mail != $reply_mail)
        $headers.= 'Reply-To: "'.$reply_name.'" <'.$reply_mail.'>'."\n";
    $headers.= 'Mime-Version: 1.0'."\n";
    $headers.= 'Content-Type: multipart/alternative; boundary="'.$boundary.'"'."\n";
    $headers.= "\n";
    
    // message
    $msg = 'This is a multipart/mixed message.'."\n\n";
    // Texte
    $msg.= '--'.$boundary."\n";
    $msg.= 'Content-transfer-encoding: 8bit'."\n";
    $msg.= 'Content-type: text/plain; charset=iso-8859-1'."\n\n";
    preg_match('!<body(.*)</body>!is', $mail, $match);
    $msg.= html_entity_decode(strip_tags($match[0]));
    
    $msg.= "\n\n";
    $msg.= '--'.$boundary."\n";
    $msg.= 'Content-transfer-encoding: 8bit'."\n";
    $msg.= 'Content-type: text/html; charset=iso-8859-1'."\n\n";
    $msg.= $mail;
    $msg.= "\r\n";
    $msg.= '--'.$boundary.'--'."\n";
        
    // envoi mail
    mail($destinataire, $subject, $msg, $headers);
}

function ischarnumberpseudo($pseudo){
// Test character---------(By:Chandy)------------------------------//
			for($i=0;$i<=(strlen($pseudo)-1);$i++){
				
			  	if(($pseudo{$i}>='a' && $pseudo{$i}<='z' || $pseudo{$i}>='A' && $pseudo{$i}<='Z' || $pseudo{$i}>='0' && $pseudo{$i}<='9'))
				  {}				
				else{   
					return(FALSE);
					break;
					}
			}
			return(TRUE);
}

//use only in back office
function removeCache($file_name){
    try {
        $file_name = ($_SESSION['language_code']?$_SESSION['language_code']:language_default).'-'.str_replace('/','',$file_name);
	    $rep = opendir(REP_FRONT_CACHE);
	    while($fn = readdir($rep)) {
	        // solution brutale pour déterminer si il s'agit d'une image et la redimensionner
	        preg_match('/'.$file_name.'/', $fn, $matches);
	    	if($matches[0]) {
	       		//echo $file_name.'  ==  '.$fn.'<br>';
	    		if(file_exists(REP_FRONT_CACHE.$fn)){
		    		unlink(REP_FRONT_CACHE.$fn);
		    	}
			}
	    }
	    closedir($rep);
    }
    catch(Exception $e){
    	echo($e);
    }
}
/*function html_substr($str, $start, $length = NULL) {
  if ($length === 0) return ""; //stop wasting our time ;)

  //check if we can simply use the built-in functions
  if (strpos($str, '&') === false) { //No entities. Use built-in functions
    if ($length === NULL)
      return substr($str, $start);
    else
      return substr($str, $start, $length);
  }
}*/
  
?>