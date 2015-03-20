<?php

class modelProduct {
  
    static public function insert($visible, $price, $title, $desc) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();
            
            $sql = "INSERT INTO product (id_createur, date_creation, id_modificateur, date_modification, status, visible, price)
					VALUES ('{$_SESSION['id_user']}', '".time()."', '{$_SESSION['id_user']}', '".time()."', '1', $visible, $price)";
            $db->executeQuery($sql);
            $product_id = $db->lastInsertId();
            
            $sql = "INSERT INTO product_translate (id_createur, date_creation, id_modificateur, date_modification, product_id, language_code, title, `desc`)
            VALUES ('{$_SESSION['id_user']}', '".time()."', '{$_SESSION['id_user']}', '".time()."', $product_id, '".modelLanguage::DEFAULT_EN."', '$title', '$desc')";
            $db->executeQuery($sql);
            
			$db->commitTransaction();
			return $product_id;
        }
        catch(SQLException $e) {
        	$db->rollbackTransaction();
            throw new SQLException($e->getMessage());
        }
    }
   
   static public function update($product_id, $language_code, $visible, $price, $title, $desc) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();
            
            $sql = "UPDATE product
					SET date_modification = '" . time() . "' ,
						id_modificateur = {$_SESSION['id_user']},
						visible = $visible,
						price = '$price'
					WHERE id  = $product_id";	
            $db->executeQuery($sql);
            
            $sql = "UPDATE product_translate
					SET date_modification = '" . time() . "' ,
            		id_modificateur = {$_SESSION['id_user']},
            		title = '$title',
            		`desc` = '$desc'
           			WHERE product_id = $product_id
            		AND language_code = '$language_code'";
            $db->executeQuery($sql);
            
            $db->commitTransaction();
        }
        catch(SQLException $e) {
        	$db->rollbackTransaction();
            throw new SQLException($e->getMessage());
        }
    }

   static public function delete($product_id) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();
            
            $sql = "UPDATE product 
                    	SET status = 0,
                    	date_modification = ".time().",
                    	id_modificateur = {$_SESSION['id_user']}
                    WHERE id = $product_id";
            $db->executeQuery($sql);
            
            $sql = "UPDATE product_translate
                    	SET status = 0,
                    	date_modification = ".time().",
                        id_modificateur = {$_SESSION['id_user']}
            		WHERE product_id = $product_id";
            $db->executeQuery($sql);
            
            $db->commitTransaction();
        }
        catch(SQLException $e) {
        	$db->rollbackTransaction();
            throw new SQLException($e->getMessage());
        }
    }
    
    public function updatePosition($order){
    	try{
    		$db = Annuaire::lookup(KEY_DATABASE);
    		$db->autoCommit(false);
    		$db->beginTransaction();
    		asort($order);
    		$position = 10;
    		for(reset($order); $product_id = key($order); next($order)) {
    			$sql = "UPDATE product
    			SET number = $position
    			WHERE id = $product_id";
    			$db->executeQuery($sql);
    			$position = $position + 10;
    		}
    		$db->commitTransaction();
    	}
    	catch(SQLException $e){
    		$db->rollbackTransaction();
    		throw new SQLException($e->getMessage());
    	}
    }

    static public function exist($title, $language_code) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT title FROM product_translate
					WHERE title = '$title'
					AND language_code = '$language_code'
            		AND status = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e) {
            throw new SQLException($e->getMessage());   
        }  
    }
    
    static public function has($product_id) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT id FROM product
					WHERE id = $product_id
					AND status = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e) {
            throw new SQLException($e->getMessage());   
        }  
    }

    static public function hasLang($product_id, $language_code) {
    	try {
    		$db = Annuaire::lookup(KEY_DATABASE);
    		$sql = "SELECT id FROM product_translate
		    		WHERE product_id = $product_id
		    		AND language_code = '$language_code'
		    		AND status = 1";
    		return ($db->executeQuery($sql)->nextObject() != null);
    	}
    	catch(SQLException $e) {
    		throw new SQLException($e->getMessage());
    	}
    }
    
    static public function getAlphabetOrder(){
    	try {
    		$db = Annuaire::lookup(KEY_DATABASE);
    		$sql = "SELECT p.*, pt.title, pt.`desc`
            		FROM product AS p
    				INNER JOIN product_translate AS pt ON p.id = pt.product_id
    				INNER JOIN language AS l ON l.language_code = '".modelLanguage::DEFAULT_EN."'
            		WHERE p.status = 1
            		ORDER BY pt.title ASC";
    		return $db->executeQuery($sql);
    	}
    	catch(SQLException $e) {
    		throw new SQLException($e->getMessage());
    	}
    }
    
    /**
     * @param string $language_code The 1st priority language_code, 2nd $_SESSION['language_code'] and default modelLanguage::DEFAULT_EN
     * @throws SQLException
     */
    static public function getList($language_code=null){
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $language_code = ($language_code ? $language_code : ($_SESSION['language_code'] ? $_SESSION['language_code'] : modelLanguage::DEFAULT_EN));
            $sql = "SELECT p.*, pt.title, pt.`desc`, l.language_name, l.language_code,
            			(SELECT nom_serveur FROM upload_fichier AS uf, product_photo AS pp WHERE p.id = pp.product_id AND pp.main_photo = 1 AND uf.id_fichier = pp.file_id AND pp.status = 1 AND uf.etat_doc = 1) AS nom_serveur,
            			(SELECT url_repertoire FROM upload_repertoire WHERE id_repertoire = " . ID_REPERTOIRE_PHOTOS . " AND etat_doc = 1) AS url_repertoire
            		FROM product AS p
    				INNER JOIN product_translate AS pt ON p.id = pt.product_id AND pt.language_code = '$language_code' AND pt.status = 1
    				INNER JOIN language AS l ON l.language_code = pt.language_code
            		WHERE p.status = 1
            		ORDER BY number ASC";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new SQLException($e->getMessage());
        }
    }

    static public function getTranslate($product_id){
    	try {
    		$db = Annuaire::lookup(KEY_DATABASE);
    		$sql = "SELECT pt.*, l.*
            		FROM product_translate AS pt
    				INNER JOIN language AS l ON l.language_code = pt.language_code AND l.status = 1
            		WHERE pt.product_id = $product_id 
            		AND pt.status = 1";
    		return $db->executeQuery($sql);
    	}
    	catch(SQLException $e) {
    		throw new SQLException($e->getMessage());
    	}
    }
    
    static public function unlinkTranslate($product_id, $language_code){
    	try {
    		$db = Annuaire::lookup(KEY_DATABASE);
    		$db->autoCommit(true);
    		$sql = "UPDATE  product_translate
		    		SET status = 0
		    		WHERE product_id = $product_id
		    		AND language_code = '$language_code'
		    		AND status = 1";
    		$res = $db->executeQuery($sql);
    	}
    	catch(SQLException $e) {
    		throw new SQLException($e->getMessage());
    	}
    }
    
    static public function getAllProductTranslate(){
    	try {
    		$db = Annuaire::lookup(KEY_DATABASE);
    		$sql = "SELECT p.*, pt.title, pt.`desc`, l.language_code
            		FROM product AS p
            		INNER JOIN product_translate AS pt ON p.id = pt.product_id AND pt.status = 1
            		INNER JOIN language AS l ON l.language_code = pt.language_code AND l.status = 1
            		WHERE p.status = 1
            		ORDER BY number ASC";
    		return $db->executeQuery($sql);
    	}
    	catch(SQLException $e) {
    		throw new SQLException($e->getMessage());
    	}
    }
 
	static public function setMainPhoto($id, $product_id){
		try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();
            $sql = "UPDATE  product_photo
				    SET main_photo = 0,
				    	id_modificateur = {$_SESSION['id_user']},
						date_modification = " . time() .
				   	" WHERE product_id = $product_id";
            $db->executeQuery($sql);
            $sql = "UPDATE  product_photo 
					SET main_photo = 1, 
						id_modificateur = {$_SESSION['id_user']}, 
						date_modification = " . time() .
					" WHERE id = $id";
			$db->executeQuery($sql);
			$db->commitTransaction();
    	}
        catch(SQLException $e) {
        	$db->rollbackTransaction();
            throw new SQLException($e->getMessage());
        }        
	}
    
    static public function getListPhoto($product_id) {
    	try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT f.*, pp.*, 
            			(SELECT u.url_repertoire FROM upload_repertoire AS u WHERE u.id_repertoire = ".ID_REPERTOIRE_PHOTOS.") AS url_repertoire
					FROM upload_fichier AS f, product_photo AS pp
					WHERE f.etat_doc = 1
					AND pp.product_id = $product_id
					AND pp.file_id = f.id_fichier
					AND pp.status = 1        			
        			ORDER BY f.nom_serveur";
            return $db->executeQuery($sql);
		}
        catch(SQLException $e) {
            throw new SQLException($e->getMessage());
        }	
    
    }
    
    static public function updateMainPhoto($product_id){
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();
            $insertFirstTime = true;
            $sql = "SELECT f.*, pp.*
        			FROM upload_fichier AS f, product_photo AS pp
        			WHERE f.etat_doc = 1
        			AND pp.product_id = $product_id
					AND pp.file_id = f.id_fichier
        			AND pp.status = 1";
            $id = $db->executeQuery($sql)->nextObject()->id;
            if($id == '') $insertFirstTime = false;
			$sql = "UPDATE product_photo SET
							main_photo = 1,
							date_modification = " . time() . ",
							id_modificateur = {$_SESSION['id_user']}
						WHERE id = $id";
            if($insertFirstTime == true)
            	$db->executeQuery($sql);
            $db->commitTransaction();
        }
        catch(SQLException $e) {
        	$db->rollbackTransaction();
            throw new SQLException($e->getMessage());
        }    
    }
    
    static public function hasMainPhoto($product_id) {
    	try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT id
        			FROM product_photo
        			WHERE product_id = $product_id
        			AND status = 1   
					AND main_photo = 1";
            return $db->executeQuery($sql)->nextObject() != null;
		}
        catch(SQLException $e) {
            throw new SQLException($e->getMessage());
        }	
    
    }
    
   	static public function linkPhoto($product_id, $file_id){
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();
            $sql = "INSERT INTO product_photo(date_creation, id_createur, date_modification, id_modificateur, status, product_id, file_id)
				    VALUES ('".time()."', {$_SESSION['id_user']},'".time()."', {$_SESSION['id_user']}, 1, $product_id, $file_id)";
            $db->executeQuery($sql);
			$id = $db->lastInsertId();
			if(!self::hasMainPhoto($product_id)) {
				$sql = "UPDATE product_photo SET
							main_photo = 1,
							date_modification = " . time() . ",
							id_modificateur = {$_SESSION['id_user']}
						WHERE id = $id";
            	$db->executeQuery($sql);
			}
            $db->commitTransaction();
        }
        catch(SQLException $e) {
        	$db->rollbackTransaction();
            throw new SQLException($e->getMessage());
        }    
    }
    
    static public function hasLinkPhoto($product_id, $file_id){
    	try {
    		$db = Annuaire::lookup(KEY_DATABASE);
    		$sql = "SELECT *
		    		FROM product_photo
		    		WHERE product_id = $product_id
		    		AND file_id = $file_id
		    		AND status = 1";
    		return ($db->executeQuery($sql)->nextObject() != null);
    	}
    	catch(SQLException $e) {
    		throw new SQLException($e->getMessage());
    	}
    }
    
    static public function unlinkPhoto($product_id, $file_id){
    	try {
    		$db = Annuaire::lookup(KEY_DATABASE);
    		$db->autoCommit(false);
    		$db->beginTransaction();
    		$sql = "UPDATE  product_photo
    				SET status = 0
    				WHERE product_id = $product_id
    				AND file_id = $file_id
    				AND status = 1";
    		$db->executeQuery($sql);
    		if(!self::hasMainPhoto($product_id)) {
    			$sql = "SELECT id FROM product_photo WHERE product_id = $product_id AND status = 1 LIMIT 1";
    			$res = $db->executeQuery($sql);
    			if($res->size() > 0) {
    				$id = $res->nextObject()->id;
    				$sql = "UPDATE  product_photo
		    				SET main_photo = 1
		    				WHERE id = $id";
    				$db->executeQuery($sql);
    			}
    		}
    		$db->commitTransaction();
    	}
    	catch(SQLException $e) {
    		$db->rollbackTransaction();
	    	throw new SQLException($e->getMessage());
    	}
    }
    
    /**
     * @param string $filename filter photo by filename
     * @param integer $product_id filter the another photo not in this product_id
     * @throws SQLException
     */
    static public function filterPhoto($filename, $product_id){
    	try {
    		$db = Annuaire::lookup(KEY_DATABASE);
    		$db->autoCommit(true);
    		$sql = "SELECT f.*
				    FROM upload_fichier AS f
				    WHERE nom_initial LIKE '%$filename%'
				    AND f.etat_doc = 1
				    AND f.id_repertoire = 1
				    AND f.id_fichier NOT IN(
											    SELECT file_id
											    FROM product_photo
											    WHERE product_id = $product_id
											    AND status = 1
										    )
				    ORDER BY nom_serveur";
    		return $db->executeQuery($sql);
    	}
    	catch(SQLException $e) {
    		throw new SQLException($e->getMessage());
    	}
    }

	/**
 	* This function 	
 	* Remove Accents from string, replace space(" ") by hyphen("-") and convert string to lower letter 
	* e.g: convert string "Lanterne Ã©toile" to "lanterne-etoile"
	* Replace accented UTF-8 characters by unaccented ASCII-7 "equivalents".
	* The purpose of this function is to replace characters commonly found in Latin
	* alphabets with something more or less equivalent from the ASCII range. This can
	* be useful for converting a UTF-8 to something ready for a filename, for example.
	* Following the use of this function, you would probably also pass the string
	* through utf8_strip_non_ascii to clean out any other non-ASCII chars
	* Use the optional parameter to just deaccent lower ($case = -1) or upper ($case = 1)
	* letters. Default is to deaccent both cases ($case = 0)
	*
	* For a more complete implementation of transliteration, see the utf8_to_ascii package
	* available from the phputf8 project downloads:
	* http://prdownloads.sourceforge.net/phputf8
	*
	* @param string UTF-8 string
	* @param int (optional) -1 lowercase only, +1 uppercase only, 1 both cases
	* @param string UTF-8 with accented characters replaced by ASCII chars
	* @return string accented chars replaced with ascii equivalents
	* @author Andreas Gohr <andi@splitbrain.org>
	* @package utf8
	* @subpackage ascii
	*/
	static public function removeAccents( $str, $case=0 ){
	    try {
		    static $UTF8_LOWER_ACCENTS = NULL;
		    static $UTF8_UPPER_ACCENTS = NULL;
		    if($case <= 0){
		        if ( is_null($UTF8_LOWER_ACCENTS) ) {
		            $UTF8_LOWER_ACCENTS = array(
					  'Ã ' => 'a', 'Ã´' => 'o', 'Ä�' => 'd', 'á¸Ÿ' => 'f', 'Ã«' => 'e', 'Å¡' => 's', 'Æ¡' => 'o',
					  'ÃŸ' => 'ss', 'Äƒ' => 'a', 'Å™' => 'r', 'È›' => 't', 'Åˆ' => 'n', 'Ä�' => 'a', 'Ä·' => 'k',
					  'Å�' => 's', 'á»³' => 'y', 'Å†' => 'n', 'Äº' => 'l', 'Ä§' => 'h', 'á¹—' => 'p', 'Ã³' => 'o',
					  'Ãº' => 'u', 'Ä›' => 'e', 'Ã©' => 'e', 'Ã§' => 'c', 'áº�' => 'w', 'Ä‹' => 'c', 'Ãµ' => 'o',
					  'á¹¡' => 's', 'Ã¸' => 'o', 'Ä£' => 'g', 'Å§' => 't', 'È™' => 's', 'Ä—' => 'e', 'Ä‰' => 'c',
					  'Å›' => 's', 'Ã®' => 'i', 'Å±' => 'u', 'Ä‡' => 'c', 'Ä™' => 'e', 'Åµ' => 'w', 'á¹«' => 't',
					  'Å«' => 'u', 'Ä�' => 'c', 'Ã¶' => 'oe', 'Ã¨' => 'e', 'Å·' => 'y', 'Ä…' => 'a', 'Å‚' => 'l',
					  'Å³' => 'u', 'Å¯' => 'u', 'ÅŸ' => 's', 'ÄŸ' => 'g', 'Ä¼' => 'l', 'Æ’' => 'f', 'Å¾' => 'z',
					  'áºƒ' => 'w', 'á¸ƒ' => 'b', 'Ã¥' => 'a', 'Ã¬' => 'i', 'Ã¯' => 'i', 'á¸‹' => 'd', 'Å¥' => 't',
					  'Å—' => 'r', 'Ã¤' => 'ae', 'Ã­' => 'i', 'Å•' => 'r', 'Ãª' => 'e', 'Ã¼' => 'ue', 'Ã²' => 'o',
					  'Ä“' => 'e', 'Ã±' => 'n', 'Å„' => 'n', 'Ä¥' => 'h', 'Ä�' => 'g', 'Ä‘' => 'd', 'Äµ' => 'j',
					  'Ã¿' => 'y', 'Å©' => 'u', 'Å­' => 'u', 'Æ°' => 'u', 'Å£' => 't', 'Ã½' => 'y', 'Å‘' => 'o',
					  'Ã¢' => 'a', 'Ä¾' => 'l', 'áº…' => 'w', 'Å¼' => 'z', 'Ä«' => 'i', 'Ã£' => 'a', 'Ä¡' => 'g',
					  'á¹�' => 'm', 'Å�' => 'o', 'Ä©' => 'i', 'Ã¹' => 'u', 'Ä¯' => 'i', 'Åº' => 'z', 'Ã¡' => 'a',
					  'Ã»' => 'u', 'Ã¾' => 'th', 'Ã°' => 'dh', 'Ã¦' => 'ae', 'Âµ' => 'u', 'Ä•' => 'e', 
					            );
		        }
		        $str = str_replace(array_keys($UTF8_LOWER_ACCENTS), array_values($UTF8_LOWER_ACCENTS), $str);
		    }
		    
		    if($case >= 0){
		        if ( is_null($UTF8_UPPER_ACCENTS) ) {
		            $UTF8_UPPER_ACCENTS = array(
					  'Ã€' => 'A', 'Ã”' => 'O', 'ÄŽ' => 'D', 'á¸ž' => 'F', 'Ã‹' => 'E', 'Å ' => 'S', 'Æ ' => 'O',
					  'Ä‚' => 'A', 'Å˜' => 'R', 'Èš' => 'T', 'Å‡' => 'N', 'Ä€' => 'A', 'Ä¶' => 'K',
					  'Åœ' => 'S', 'á»²' => 'Y', 'Å…' => 'N', 'Ä¹' => 'L', 'Ä¦' => 'H', 'á¹–' => 'P', 'Ã“' => 'O',
					  'Ãš' => 'U', 'Äš' => 'E', 'Ã‰' => 'E', 'Ã‡' => 'C', 'áº€' => 'W', 'ÄŠ' => 'C', 'Ã•' => 'O',
					  'á¹ ' => 'S', 'Ã˜' => 'O', 'Ä¢' => 'G', 'Å¦' => 'T', 'È˜' => 'S', 'Ä–' => 'E', 'Äˆ' => 'C',
					  'Åš' => 'S', 'ÃŽ' => 'I', 'Å°' => 'U', 'Ä†' => 'C', 'Ä˜' => 'E', 'Å´' => 'W', 'á¹ª' => 'T',
					  'Åª' => 'U', 'ÄŒ' => 'C', 'Ã–' => 'Oe', 'Ãˆ' => 'E', 'Å¶' => 'Y', 'Ä„' => 'A', 'Å�' => 'L',
					  'Å²' => 'U', 'Å®' => 'U', 'Åž' => 'S', 'Äž' => 'G', 'Ä»' => 'L', 'Æ‘' => 'F', 'Å½' => 'Z',
					  'áº‚' => 'W', 'á¸‚' => 'B', 'Ã…' => 'A', 'ÃŒ' => 'I', 'Ã�' => 'I', 'á¸Š' => 'D', 'Å¤' => 'T',
					  'Å–' => 'R', 'Ã„' => 'Ae', 'Ã�' => 'I', 'Å”' => 'R', 'ÃŠ' => 'E', 'Ãœ' => 'Ue', 'Ã’' => 'O',
					  'Ä’' => 'E', 'Ã‘' => 'N', 'Åƒ' => 'N', 'Ä¤' => 'H', 'Äœ' => 'G', 'Ä�' => 'D', 'Ä´' => 'J',
					  'Å¸' => 'Y', 'Å¨' => 'U', 'Å¬' => 'U', 'Æ¯' => 'U', 'Å¢' => 'T', 'Ã�' => 'Y', 'Å�' => 'O',
					  'Ã‚' => 'A', 'Ä½' => 'L', 'áº„' => 'W', 'Å»' => 'Z', 'Äª' => 'I', 'Ãƒ' => 'A', 'Ä ' => 'G',
					  'á¹€' => 'M', 'ÅŒ' => 'O', 'Ä¨' => 'I', 'Ã™' => 'U', 'Ä®' => 'I', 'Å¹' => 'Z', 'Ã�' => 'A',
					  'Ã›' => 'U', 'Ãž' => 'Th', 'Ã�' => 'Dh', 'Ã†' => 'Ae', 'Ä”' => 'E',
		            );
		        }
		        $str = str_replace(array_keys($UTF8_UPPER_ACCENTS), array_values($UTF8_UPPER_ACCENTS), $str);
		    }
		    
		    return str_replace(' ', '-', strtolower($str));
		    
		}catch(SQLException $e) {
			throw new Exception($e->getMessage());
		}  
	}
	
    /**
     * @param integer $product_id 
     * @param string $language_code The 1st priority language_code, 2nd $_SESSION['language_code'] and default modelLanguage::DEFAULT_EN
     * @throws Exception
     */
    static public function get($product_id, $language_code=null) {
	    try {
	        $db = Annuaire::lookup(KEY_DATABASE);
	        $language_code = ($language_code ? $language_code : ($_SESSION['language_code'] ? $_SESSION['language_code'] : modelLanguage::DEFAULT_EN));
	        $sql = "SELECT p.*, pt.title, pt.`desc`, l.language_name, l.language_code,
            			(SELECT nom_serveur FROM upload_fichier AS uf, product_photo AS pp WHERE p.id = pp.product_id AND pp.main_photo = 1 AND uf.id_fichier = pp.file_id AND pp.status = 1 AND uf.etat_doc = 1 LIMIT 1) AS nom_serveur,
            			(SELECT url_repertoire FROM upload_repertoire WHERE id_repertoire = " . ID_REPERTOIRE_PHOTOS . " AND etat_doc = 1) AS url_repertoire
            		FROM product AS p
    				INNER JOIN product_translate AS pt ON p.id = pt.product_id AND pt.product_id = $product_id AND pt.language_code = '$language_code' AND pt.status = 1
    				INNER JOIN language AS l ON l.language_code = pt.language_code
            		WHERE p.status = 1";
	        return $db->executeQuery($sql)->nextObject();
	    }
	    catch(SQLException $e) {
	        throw new Exception($e->getMessage());   
	    }    
	}

	static public function insertNewLanguage($product_id, $language_code, $title, $desc) {
		try {
			$db = Annuaire::lookup(KEY_DATABASE);
			$sql = "INSERT INTO product_translate (id_createur, date_creation, id_modificateur, date_modification, product_id, language_code, title, `desc`)
            		VALUES ('{$_SESSION['id_user']}', '".time()."', '{$_SESSION['id_user']}', '".time()."', $product_id, '$language_code', '$title', '$desc')";
			$db->executeQuery($sql);
		}
		catch(SQLException $e) {
			throw new Exception($e->getMessage());
		}
	}

	static public function updateLanguage($product_id, $language_code, $title, $desc) {
		try {
			$db = Annuaire::lookup(KEY_DATABASE);
			$sql = "UPDATE product_translate
					SET id_modificateur = '{$_SESSION['id_user']}',
						date_modification = '".time()."',
						title = '$title',
						`desc` = '$desc'
					WHERE product_id = $product_id
					AND language_code = '$language_code'
					AND status = 1";
			$db->executeQuery($sql);
		}
		catch(SQLException $e) {
			throw new Exception($e->getMessage());
		}
	}

}  
  
?>