<?php

/**
* Vérifie si l'utilisateur est logué
* @author Marcadet Antoine & Leang Stephanie
* @date 07/06/06
*/

function est_logue() {
	return isset($_SESSION['id_user']);
}

function number_pad($number) {
  	return number_format($number, 2, '.', '');
}
function number_weight($number) {
  	return number_format($number, 1, '.', '');
}

/**
 * @param string $language_code
 * @return string if the $language_code equal default language return empty string otherwise $language_code + '/'
 */
function set_seperate_lang($language_code) {
	return (strcmp($language_code, modelLanguage::DEFAULT_EN) == 0 ? '' : ($language_code . '/'));
}


/**
 * @param string $language_code
 */
function set_priority_lang($language_code) {
	if(match_lang($language_code)) {
		$_SESSION['language_code'] = $language_code;
	}else {
		$_SESSION['language_code'] = modelLanguage::DEFAULT_EN;
	}
}

function set_browser_lang() {
	if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
		$language_code = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		if(match_lang($language_code)) {
			$_SESSION['language_code'] = $language_code;
		}else {
			$_SESSION['language_code'] = modelLanguage::DEFAULT_EN;
		}
	}else {
		$_SESSION['language_code'] = modelLanguage::DEFAULT_EN;
	}
}

function match_lang($language_code) {
	$pattern = modelLanguage::getPatternSupportLanguageCode();
	return preg_match("/$pattern/", $language_code);
}

/**
 * @param string $title title of the product
 * @param string $id id of the product
 * @return string url
 */
function getURL($title, $id) {
	$title = preg_replace('/\s+/', '-', preg_replace('/(\/|\(|\))/', '', $title));
	return mb_strtolower(($title . '-provieg-' . $id . '.html'), 'utf-8');
}
  
/**
* Affiche la date au format FR
* @author Marcadet Antoine
* @date 08/06/06
*/
function datefr($date) {
	$jour["Monday"] = "lundi";
	$jour["Tuesday"] = "mardi";
	$jour["Wednesday"] = "mercredi";
	$jour["Thursday"] = "jeudi";
	$jour["Friday"] = "vendredi";
	$jour["Saturday"] = "samedi";
	$jour["Sunday"] = "dimanche";
	$mois["January"] = "janvier";
	$mois["February"] = "février";
	$mois["March"] = "mars";
	$mois["April"] = "avril";
	$mois["May"] = "mai";
	$mois["June"] = "juin";
	$mois["July"] = "juillet";
	$mois["August"] = "août";
	$mois["September"] = "septembre";
	$mois["October"] = "octobre";
	$mois["November"] = "novembre";
	$mois["December"] = "décembre";

	return $jour[date("l", $date)] . date(" j ", $date) . $mois[date("F", $date)] . date(" Y", $date);
}

/**
* Normalise une variable avant son insertion en base de données (convertit entité HTML, supprime les espaces, etc..)
* @param $type type du champ d'ou provient la variable (text, textarea, ...)
* @author Marcadet Antoine
* @date 11/06/06
*/
function normalise($valeur, $type = 'text') {
	switch($type) {
		case 'text':
			return addslashes(trim($valeur));
		case 'first':
			return ucfirst(strtolower(trim($valeur)));
		case 'words':
			return ucwords(strtolower(trim($valeur)));
		case 'pass':
			//return md5($valeur);
			return trim($valeur);
		case 'login':
			return strtolower(trim($valeur));
		case 'min':
			return strtolower(trim($valeur));
		case 'date': // convertir une date 28/01/1986 en son timestamp
			$date = explode('/', $valeur);
			if(count($date) == 3) {
				return mktime(0, 0, 0, $date[1], $date[0], $date[2]);
			}
			return 'NULL';
		case 'id':
			return (int)$valeur;
		case 'decimal':
			return preg_replace('!,!', '.', $valeur);
		case 'fichier':		    
            return enlever_accents($valeur);
        case 'url':		    
            return enlever_accents($valeur);
		default:
			return addslashes(trim($valeur));
	}
}

/**
* Renvoie une chaine tronquée en fonction de sa taille (limite 100 caractere) en gérant les retours chariots
* @author Marcadet Antoine
* @date 14/06/06
*/
function affiche($valeur, $type = 'extrait') {
	switch($type) {
		case 'list_product': // si le texte depasse les 100 car il est affiché tronqué
			return extrait($valeur, '107');		
		case 'extrait': // si le texte depasse les 100 car il est affiché tronqué
			return extrait($valeur, '100');			
		case 'list': // si le texte depasse les 100 car il est affiché tronqué
			return extrait($valeur, '36');
		case 'alt': // si le texte depasse les 100 car il est affiché tronqué
			return extrait($valeur, '40');
		case 'complet':
			return nl2br($valeur);
		case 'tcode':
			return tCode($valeur);
		case 'datefr': // date complet sous forme de "Mardi 28 Janvier 1986" à partir d'un timestamp
			if($valeur <= 0)
			return '(aucune)';
			return datefr($valeur);
		case 'date': // date sous forme 28/01/1986 à partir d'un timestamp
			if($valeur <= 0)
			return '';
			return date('Y-m-d', $valeur);
		case 'dateheure': // date et heure à partir d'un timestamp: 28/01/1986 17:25:00
			if($valeur < 0)
			$valeur = 0;
			return date('Y-m-d H:i s', $valeur);
		case 'dateheureuser': // date et heure à partir d'un timestamp: 28/01/1986 à 17:25:00
			if($valeur < 0)
			$valeur = 0;
			return date('Y-m-d \à H\hi', $valeur);
		case 'heure': // heure à partir d'un timestamp: 17:25:00
			if($valeur < 0)
			$valeur = 0;
			return date('H:i s', $valeur);
		case 'montant':
			return preg_replace('!\.!', ',', $valeur);
	}
}

function extrait($chaine, $taille) {
	if(strlen($chaine) > $taille+3) {
		$charactor = substr($chaine, $taille,1);
		$chaine = substr($chaine, 0, $taille);
		//cut last word
		$chaine = substr($chaine, 0, strrpos($chaine, " ")). '...';
	}
	return $chaine;
}


/**
 * This method will obfuscate the given text. The returnvalue of this method is a single quoted param string. Each
 * character of the given input String is converted to its numeric value. These characters are then comma separated.
 * 
 * @param text
 *            The text to obfuscate
 * @return The obfuscated input String, surrounded by single quotes
 */
function obfusc($text) {
	$length = strlen($text);
	if ($length == 0) {
		return "''";
	}

	$l = $length -1;
	$returnValue = "'";

	for ($i = 0; $i < $length; $i ++) {
		$char = $text {
			$i};
		$asciivalue = ord($char);

		$returnValue .= $asciivalue;

		if ($i !== $l) {
			$returnValue .= ",";
		}
	}

	$returnValue .= "'";
	return $returnValue;
}


/**
 * This method creates the javascript-call to the function <code>EOae</code>.
 * 
 * @param emailAddress
 *            The emailaddress to obfuscate
 * @param text
 *            The text to be used as linktext
 * @param subject
 *            The subject to be used for the email when the link is pressed.
 * @param title
 *            The title to be used as <code>title</code> attribute of the <code>&lt;a&gt;</code>-tag.
 * @param styleClass
 *            The styleclass to use for the <code>&lt;a&gt;</code>-tag.
 * @return The javascript-call to the function <code>EOae</code>.
 * @throws JspException
 * If the given <code>emailAddress</code> does not contain exactly one at-sign (<code>@</code>).
 */
 function obfuscate($emailAddress, $text, $subject, $body, $title, $styleClass, $noScript) {
	$returnValue = "";
	$linkText = "";
	$titleText = "";

	if (strlen($text) == 0) {
		$linkText = $emailAddress;
	} else {
		$linkText = $text;
	}

	if (strlen($title) == 0) {
		$titleText = $emailAddress;
	} else {
		$titleText = $title;
	}

	$returnValue .= "<script type=\"text/javascript\">\n// <![CDATA[ \n";
	$returnValue .= "EOae(";

	$tokenizer = explode("@", $emailAddress);
	if (count($tokenizer) != 2) {
		return "An emailaddress should contain exactly one 'at'-sign (@) instead of ".(count($tokenizer)-1)." ($emailAddress )";
	}

	/* Add the obfuscated email address in two parameters */
	$returnValue .= obfusc($tokenizer[0]);
	$returnValue .= ',';
	$returnValue .= obfusc($tokenizer[1]);

	/* Add the subject parameter */
	$returnValue .= ',';
	$returnValue .= obfusc($subject);

	/* Add the body parameter */
	$returnValue .= ',';
	$returnValue .= obfusc($body);
	
	/* Add the title parameter */
	$returnValue .= ',';
	$returnValue .= obfusc($titleText);

	/* Add the linkText parameter */
	$returnValue .= ',';
	$returnValue .= obfusc($linkText);

	/* Add the class parameter */
	$returnValue .= ',';
	if (strlen($styleClass) > 0) {
		$returnValue .= "'";
		$returnValue .= $styleClass;
		$returnValue .= "'";
	} else {
		$returnValue .= "null";
	}

	/* Close the JavaScript function */
	$returnValue .= ");\n// ]]>\n</script>";

	/* Add the noscript tag */
	if (strlen($noScript) > 0) {
		$returnValue .= "<noscript>";
		$returnValue .= $noScript;
		$returnValue .= "</noscript>";
	}

	/* Add some promotional text */
	$returnValue .= "\n<!-- Obfuscated by http://altum.be/products (Geert Van Aken) -->";

	return $returnValue;
}



//Enlever les accents
//*******************
function enlever_accents($dest_fichier){
	$dest_fichier = strtolower($dest_fichier);
    $dest_fichier = strtr($dest_fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ/', 
                                         'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy/');
    //remplacer les caracteres autres que lettres, chiffres et point par -
    $dest_fichier = preg_replace('/([^.a-z\/0-9]+)/i', '-', $dest_fichier);
return $dest_fichier;
}

function encodeToUrl($url) {
	$out_url = html_entity_decode($url, ENT_QUOTES);
	$out_url = enlever_accents($out_url);
	$out_url = strtr($out_url, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ/', 
                                         'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy/');
	return $out_url;
}


function tCode($texte) {
	$texte = nl2br($texte);
	$texte = preg_replace('!<title1>(.+)</title1>!iUs', '<h1><span>$1</span></h1>', $texte);
	$texte = preg_replace('!<title2>(.+)</title2>!iUs', '<h2>$1</h2>', $texte);
	$texte = preg_replace('!<title3>(.+)</title3>!iUs', '<h3>$1</h3>', $texte);
	$texte = preg_replace('!</h(1|2|3)><br />!iUs', '</h$1>', $texte);	
	$texte = preg_replace('!<bold>(.+)</bold>!iUs', '<b>$1</b>', $texte);
	$texte = preg_replace('!<underline>(.+)</underline>!iUs', '<u>$1</u>', $texte);
	$texte = preg_replace('!<italic>(.+)</italic>!iUs', '<i>$1</i>', $texte);
	$texte = preg_replace('!<left>(.+)</left>!iUs', '<div class="gauche">$1</div>', $texte);
	$texte = preg_replace('!<center>(.+)</center>!iUs', '<div class="centre">$1</div>', $texte);
	$texte = preg_replace('!<right>(.+)</right>!iUs', '<div class="droite">$1</div>', $texte);
	$texte = preg_replace('!<justify>(.+)</justify>!iUs', '<div class="justifie">$1</div>', $texte);
	$texte = preg_replace('!</div><br />!iUs', '</div>', $texte);
	
	$texte = preg_replace('!<image-left>(.+)</image-left>!iUs', '<div class="fgauche">$1</div>', $texte);
	$texte = preg_replace('!<image-right>(.+)</image-right>!iUs', '<div class="fdroite">$1</div>', $texte);
	
	$texte = preg_replace('!<bullet>!iUs', '<span class="puce">&#149;</span>', $texte);
	$Mailto='<a href="mailto:c&#111;&#110;ta&#99;&#116;&#64;&#108;&#97;&#110;te&#114;&#110;&#101;&#115;&#100;u&#109;&#111;&#110;&#100;&#101;.&#99;&#111;&#109;">&#99;&#111;n&#116;&#97;&#99;&#116;&#64;&#108;&#97;n&#116;&#101;rne&#115;&#100;&#117;&#109;&#111;&#110;&#100;&#101;&#46;&#99;o&#109;</a>
	';
	$texte = preg_replace('!<mailto>!iUs', $Mailto, $texte);
	
	$texte = preg_replace('!<url address="(.+)"(?: title="(.+)?")?( target="(?:.+)")?>(.+)</url>!iUs', '<a href="http://'.$_SERVER['SERVER_NAME'].'$1" title="$2" $3>$4</a>', $texte);

	$texte = preg_replace_callback('!<image>(.+)</image>!iUs', tCodeImage, $texte);
	$texte = preg_replace_callback('!<lien nom=&quot;(.+)&quot;>(.+)</lien>!iUs', tCodeLien, $texte);
	
	$texte = preg_replace('!<youtube>(.+)</youtube>!iUs', 
	       '<object width="425" height="350">
	            <param name="movie" value="http://www.youtube.com/v/$1"></param>
	            <param name="wmode" value="transparent"></param>
	            <embed src="http://www.youtube.com/v/$1" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed>
	        </object>', $texte);
	$texte = preg_replace('!<dailymotion>(.+)</dailymotion>!iUs', 
	       '<object width="425" height="335">
	            <param name="movie" value="http://www.dailymotion.com/swf/$1"></param>
	            <param name="allowfullscreen" value="true"></param>
	            <param name="wmode" value="transparent"></param>
	            <embed src="http://www.dailymotion.com/swf/$1" type="application/x-shockwave-flash" wmode="transparent" width="425" height="335" allowfullscreen="true"></embed>
	        </object>', $texte);

	return $texte.'<div style="clear:both; height: 1px;">&nbsp;</div>';
}

function tCodeLien($string) {
    $nom_document = $string[1];
    $texte = $string[2];
    $url = modelSitePage::makeUrl($nom_document);
    $title = modelSitePage::getBaliseTitle($nom_document);;
    return '<a href="'.$url.'" title="'.affiche($title, 'complet').'">'.$texte.'</a>';
}


function tCodeImage($string) {

    $nom_serveur = $string[1];
    $alt = modelUploadFile::getBaliseAlt($nom_serveur);
    //$url_photo = REP_PHOTOS_ARTISANAT_DETAIL.modelUploadFile::makeUrl($nom_serveur);
    $url_photo = REP_PHOTOS_ARTISANAT_DETAIL.modelUploadFile::makeUrl($nom_serveur);
    if(!file_exists($url_photo)) {$url_photo=NOIMAGE;}
	list($width, $height, $type, $attr) = getimagesize($url_photo);	
	return '<img src = "'.$url_photo.'" alt="'.affiche($alt, 'complet').'" title="'.affiche($alt, 'complet').'" width="'.$width.'" height="'.$height.'" />';
	}

function tCodeMailto($string) {
    $address = $string[1];
    $text = $string[3];
    $subject = html_entity_decode($string[2], ENT_QUOTES);
    $body = '';
    $title ='';// $string[1];
    $styleClass = 'ed_mailto';
    $noScript = '';
    return obfuscate($address, 
                     $text,
                     $subject,
                     $body, 
                     $title,
                     $styleClass, 
                     $noScript);
   
}

function removeAccents ($string) {
    $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $string = strtr(utf8_decode($string), utf8_decode($a), $b);
    $string = preg_replace('/([^.a-z0-9]+)/i', '-', strtolower($string));
    return utf8_encode($string);
}

/*** Retourne l'ip de connexion*/
function get_ip_list() {
	$tmp = array();
	if  (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && strpos($_SERVER['HTTP_X_FORWARDED_FOR'],',')) {
		$tmp +=  explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
	} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$tmp[] = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	$tmp[] = $_SERVER['REMOTE_ADDR'];
	return $tmp[0];
}
	
function traverse($path, $recursif=0) {
	$tab_content = array();
	if(strlen($path) > 0 && is_dir($path)) {
		if($pointer = opendir($path)) {
			while(false !== ($file = readdir($pointer))) {
				if($file != "." && $file != "..") {
					if(is_dir($path . "/" . $file) && $recursif == 1) {
						$tab_content = array_merge($tab_content, traverse($path . "/" . $file, 1));
					}
					else {
						$tab_content[] = $path . '/' . $file;
					}
				}
			}
			closedir($pointer);
		}
	}
	return $tab_content;
}
function make_file($file){
	$tb_info=pathinfo($file);
	if(preg_match('[tpl|php]',$tb_info['extension'])){
	if($pointeur=fopen($file,"w+")){		
		
		$fileName = $tb_info['basename'];
		$date = date('d-m-Y H:i:s');
		$fileInfo = "*** File creation information ***\n";
		$fileInfo .="File: ".$fileName."\n"."Date: ".$date."\n"; 
		
		fwrite($pointeur,'');
		fclose($pointeur);
	}
	}
	return $fileInfo;
}
  //gets a filenames extension

function filename_extension($filename) {
	$pos = strrpos($filename, '.');
	if($pos===false) {
		return false;
	} else {
		return substr($filename, $pos+1);
	}
}

/**
 * trims text to a space then adds ellipses if desired
 * @param string $string text to trim
 * @param int $length in characters to trim to
 * @param bool $ellipses if ellipses (...) are to be added
 * @param bool $strip_html if html tags are to be stripped
 * @return string
 */
function trim_text($string, $length, $ellipses = true, $strip_html = true) {
	
	//strip tags, if desired
	if ($strip_html) {
		$string = strip_tags($string);
	}

	//no need to trim, already shorter than trim length
	if (mb_strlen($string, 'utf-8') <= $length) {
		return $string;
	}

	//find last space within length
	$last_space = mb_strrpos(mb_substr($string, 0, $length, 'utf-8'), ' ', 1, 'utf-8');
	$trimmed_text = $last_space ? mb_substr($string, 0, $last_space, 'utf-8') : mb_substr($string, 0, $length, 'utf-8');

	//add ellipses (...)
	if ($ellipses) {
		$trimmed_text .= '...';
	}

	return $trimmed_text;
	
}
    
?>