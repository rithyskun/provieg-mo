<?php

/**
 * Classe de gestion des fichiers
 * @version 20070619
 * @author Antoine Marcadet 
 */
class modelFile {

    const TYPE_NULL    = 0;
    const TYPE_ONGLET  = 1;
    const TYPE_MENU    = 2;
    const TYPE_ACTION  = 3;
    const TYPE_AJAX    = 4;
    const TYPE_BOUTON  = 5;
    const TYPE_INCLUDE = 6;
    const TYPE_DETAIL  = 7;
    const TYPE_MENUBAR = 8;
    
    static public function insert() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO _adm_fichier(id_fichier, id_createur, date_creation, id_modificateur, date_modification, etat_doc)
					VALUES ('','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','".time()."','2')";
            $db->executeQuery($sql);
			return $db->lastInsertId();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function update($id_fichier, $intitule_fichier, $description_fichier, $nom_fichier, $id_dossier, $id_type_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE _adm_fichier
					SET date_modification = '" . time() . "' , 
						id_modificateur = {$_SESSION['id_user']}, 
						intitule_fichier = '$intitule_fichier',
						description_fichier = '$description_fichier',
						nom_fichier = '$nom_fichier',
						id_dossier = '$id_dossier', 
						id_type_fichier = '$id_type_fichier'
					WHERE id_fichier = $id_fichier";
            $db->executeQuery($sql);
        }
        catch(SQLException $e) {
        	echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function updateFichier($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->beginTransaction();
    		$sql = "UPDATE _adm_fichier
    				SET etat_doc = 1
    				WHERE id_fichier = $id_fichier AND etat_doc = 2";
    		$db->executeQuery($sql);
    		$sql = "UPDATE _adm_privilege_fichier
    				SET etat_doc = 1
    				WHERE id_fichier = $id_fichier AND etat_doc = 2";
    		$db->executeQuery($sql);
    		$sql = "UPDATE _adm_fichier_recursif
    				SET etat_doc = 1
    				WHERE
                    (id_fichier_pere = $id_fichier OR id_fichier_fils = $id_fichier)
                    AND etat_doc = 2";
    		$db->executeQuery($sql);
    		$sql = "UPDATE _adm_privilege
    				SET etat_doc = 1
    				WHERE etat_doc = 2 AND id_privilege = (SELECT id_privilege FROM _adm_privilege_fichier WHERE id_fichier = $id_fichier AND etat_doc = 1)";
    		$db->executeQuery($sql);
    	    $db->commitTransaction();
    	}
    	catch(SQLException $e) {
    	    $db->rollbackTransaction();
    	    throw new Exception('La mise a jout de la base de données à échouée');
        }
    }
    
    static public function updateDate($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE _adm_fichier
					SET date_modification = '" . time() . "' , 
						date_creation = '".time()."'
					WHERE id_fichier = $id_fichier";
            $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function updateOrdre($id_fichier, $numero){
            try {
                $db = Annuaire::lookup(KEY_DATABASE);
                $db->autoCommit(true);
                $db->executeQuery("UPDATE _adm_fichier_recursif 
                                    SET numero = " . $numero . " 
                    	            WHERE id_fichier_fils = ".$id_fichier);
            }
            catch(SQLException $e) {
                throw new Exception('Erreur d\'accès à la base de données');
            }
					
    
    }
    public function updatePositionLevelOne($tab){
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            asort($tab);
            $position = 10;
            for(reset($tab); $key = key($tab); next($tab)) {
            	$sql = "UPDATE _adm_fichier_recursif
                            SET numero = $position
                        WHERE id_fichier_fils = $key";
                $db->executeQuery($sql);
                $position = $position + 10;
            }
		}
        catch(SQLException $e){
            throw new Exception('Order have not modified');
        }
    }
    
    static public function delete($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();
            $db->executeQuery("UPDATE _adm_fichier 
                               SET etat_doc = 0,
                                   date_modification = ".time().",
                                   id_modificateur = {$_SESSION['id_user']}
                               WHERE id_fichier = $id_fichier");
            $db->executeQuery("UPDATE _adm_privilege_fichier 
                               SET etat_doc = 0,
                                   date_modification = ".time().",
                                   id_modificateur = {$_SESSION['id_user']}
                               WHERE id_fichier = $id_fichier");
            $db->executeQuery("UPDATE _adm_fichier_recursif
                               SET etat_doc = 0,
                                   date_modification = ".time().",
                                   id_modificateur = {$_SESSION['id_user']}
                               WHERE id_fichier_pere = $id_fichier OR id_fichier_fils = $id_fichier");
            $db->commitTransaction();
           
        }
        catch(SQLException $e) {
            $db->rollbackTransaction();
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getFichier($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT af.*, ad.url_dossier, dtf.lib_type_fichier, dtf.id_type_fichier
        			FROM _adm_fichier AS af
        			LEFT JOIN _adm_dossier AS ad ON af.id_dossier = ad.id_dossier
        			LEFT JOIN zz_data_type_fichier AS dtf ON af.id_type_fichier = dtf.id_type_fichier
        			WHERE af.id_fichier = $id_fichier";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) { 
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getFichierUtilisateurEncours() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
                    FROM _adm_fichier
                    WHERE id_createur = {$_SESSION['id_user']}
                    AND etat_doc = 2";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
   
    static public function getNomFichier($id_fichier) {
         try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT af.nom_fichier
        			FROM _adm_fichier AS af
        			WHERE af.id_fichier = $id_fichier";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getIdFichier($nom_fichier) {
         try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT af.id_fichier
        			FROM _adm_fichier AS af
        			WHERE af.nom_fichier = '$nom_fichier'";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
		
    /*static public function getList($search = null) {
        try {
            if($search != null)
                extract($search);
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT af.*, ad.url_dossier, dtf.lib_type_fichier
        			FROM _adm_fichier AS af
        			LEFT JOIN _adm_dossier AS ad ON af.id_dossier = ad.id_dossier
        			LEFT JOIN zz_data_type_fichier AS dtf ON af.id_type_fichier = dtf.id_type_fichier
        			WHERE af.etat_doc = 1";
            if(isset($nom_fichier))     $sql.= " AND af.nom_fichier LIKE '$nom_fichier%'";
            if(isset($id_type_fichier)) $sql.= " AND af.id_type_fichier = $id_type_fichier";
            if(isset($id_dossier))      $sql.= " AND af.id_dossier = $id_dossier";
            if(isset($_col)) {
                switch($_col) {
                    case 1:
                        $sql.= " ORDER BY dtf.lib_type_fichier $_ordre";
                        break;
                    case 2:
                        $sql.= " ORDER BY ad.url_dossier $_ordre";
                        break;
                    case 3:
                        $sql.= " ORDER BY af.nom_fichier $_ordre";
                        break;
                    case 4:
                        $sql.= " ORDER BY af.intitule_fichier $_ordre";
                        break;
                }
            }
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }*/
    static public function getList() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT af.*, ad.url_dossier, dtf.lib_type_fichier
        			FROM _adm_fichier AS af
        			LEFT JOIN _adm_dossier AS ad ON af.id_dossier = ad.id_dossier
        			LEFT JOIN zz_data_type_fichier AS dtf ON af.id_type_fichier = dtf.id_type_fichier
        			WHERE af.etat_doc = 1";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    
    
    static public function getListType(){
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            return $db->executeQuery("SELECT * FROM zz_data_type_fichier ORDER BY lib_type_fichier");
		}
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }
    
    static public function linkFils($id_fichier, $id_fichier_fils, $etat = 2) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "INSERT INTO _adm_fichier_recursif(id, id_createur, date_creation, id_modificateur, date_modification, etat_doc, id_fichier_pere, id_fichier_fils)
        		    VALUES ('','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','".time()."','$etat','$id_fichier','$id_fichier_fils')";
            return $db->executeQuery($sql);            
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    static public function exist_linkFils($id_fichier,$id_fichier_fils,$etat=2){
		try{
			$db=Annuaire::lookup(KEY_DATABASE);
			$sql="select afr.* from _adm_fichier_recursif as afr
				  where afr.id_fichier_pere=$id_fichier
				  and afr.id_fichier_fils=$id_fichier_fils
				  and afr.etat_doc=$etat";
			return($db->executeQuery($sql)->nextObject()!=null);
		}catch(SQLException $e){
			throw new Exception('Access error to database');
		}
	}
    
    static public function getFils($id_fichier, $type = null) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT rec.id AS id_fr, ffils.id_fichier,ffils.nom_fichier, ffils.intitule_fichier, ad.url_dossier, daif.url_adm_image_fichier, rec.numero, ffils.description_fichier
                    FROM _adm_fichier AS fpere
                    INNER JOIN _adm_fichier_recursif AS rec ON (fpere.id_fichier = rec.id_fichier_pere AND rec.etat_doc = 1)
                    INNER JOIN _adm_fichier AS ffils ON (rec.id_fichier_fils = ffils.id_fichier AND ffils.etat_doc = 1)
                    INNER JOIN _adm_dossier AS ad ON ffils.id_dossier = ad.id_dossier
                    LEFT JOIN zz_data_adm_image_fichier AS daif ON ffils.id_adm_image_fichier = daif.id_adm_image_fichier
                    WHERE fpere.id_fichier = '$id_fichier'
                    AND fpere.etat_doc = 1";
            $sql.= ($type != null)?" AND ffils.id_type_fichier = $type ":'';
            $sql.= " ORDER BY numero,fpere.id_adm_image_fichier";
            return $db->executeQuery($sql);            
        }
        catch(SQLException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    static public function getFilsEncours($id_fichier, $type = null) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT rec.id AS id_fr, ffils.id_fichier,ffils.nom_fichier, ffils.intitule_fichier, ad.url_dossier, daif.url_adm_image_fichier
                    FROM _adm_fichier AS fpere
                    INNER JOIN _adm_fichier_recursif AS rec ON (fpere.id_fichier = rec.id_fichier_pere AND rec.etat_doc = 2)
                    INNER JOIN _adm_fichier AS ffils ON (rec.id_fichier_fils = ffils.id_fichier AND ffils.etat_doc = 1)
                    INNER JOIN _adm_dossier AS ad ON ffils.id_dossier = ad.id_dossier
                    LEFT JOIN zz_data_adm_image_fichier AS daif ON ffils.id_adm_image_fichier = daif.id_adm_image_fichier
                    WHERE fpere.id_fichier = '$id_fichier'
                    AND fpere.etat_doc = 2";
            $sql.= ($type != null)?" AND ffils.id_type_fichier = $type ":'';
            $sql.= " ORDER BY rec.numero";
            return $db->executeQuery($sql);      
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getPere($id_fichier, $type = null) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT rec.id AS id_fr, fpere.id_fichier, fpere.nom_fichier, fpere.intitule_fichier, ad.url_dossier, daif.url_adm_image_fichier,fpere.id_type_fichier
                    FROM _adm_fichier AS fpere
                    INNER JOIN _adm_fichier_recursif AS rec ON (rec.id_fichier_pere = fpere.id_fichier AND rec.etat_doc = 1) 
                    INNER JOIN _adm_fichier AS ffils ON (ffils.id_fichier = rec.id_fichier_fils AND ffils.etat_doc = 1)
                    INNER JOIN _adm_dossier AS ad ON fpere.id_dossier = ad.id_dossier
                    LEFT JOIN zz_data_adm_image_fichier AS daif ON fpere.id_adm_image_fichier = daif.id_adm_image_fichier
                    WHERE ffils.id_fichier = '$id_fichier'
                    AND fpere.etat_doc = 1 ";
            $sql.= ($type != null)?" AND fpere.id_type_fichier = $type":'';
            $sql.= " ORDER BY rec.numero";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getPereEncours($id_fichier, $type = null) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT rec.id AS id_fr, fpere.id_fichier, fpere.nom_fichier, fpere.intitule_fichier, ad.url_dossier, daif.url_adm_image_fichier
                    FROM _adm_fichier AS fpere
                    INNER JOIN _adm_fichier_recursif AS rec ON (rec.id_fichier_pere = fpere.id_fichier AND rec.etat_doc = 2) 
                    INNER JOIN _adm_fichier AS ffils ON (ffils.id_fichier = rec.id_fichier_fils AND ffils.etat_doc = 2 AND ffils.id_fichier = '$id_fichier')
                    INNER JOIN _adm_dossier AS ad ON fpere.id_dossier = ad.id_dossier
                    LEFT JOIN zz_data_adm_image_fichier AS daif ON fpere.id_adm_image_fichier = daif.id_adm_image_fichier
                    WHERE fpere.etat_doc = 1";
            $sql.= ($type != null)?" AND fpere.id_type_fichier = $type":'';
            $sql.= " ORDER BY rec.numero";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getPrivilege($id_fichier){
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT p.*, zz.lib_type_privilege, fp.id AS idfp
                    FROM _adm_privilege_fichier AS fp, _adm_privilege AS p, zz_data_type_privilege AS zz
                    WHERE fp.id_privilege = p.id_privilege
                    AND p.id_type_privilege = zz.id_type_privilege
                    AND fp.id_fichier = $id_fichier
                    AND fp.etat_doc = 1";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getPrivilegeEncours($id_fichier){
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT p.*, fp.id, zz.lib_type_privilege
                    FROM _adm_privilege_fichier AS fp, _adm_privilege AS p, zz_data_type_privilege AS zz
                    WHERE fp.id_privilege = p.id_privilege
                    AND p.id_type_privilege = zz.id_type_privilege
                    AND fp.id_fichier = $id_fichier
                    AND fp.etat_doc = 2";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getPrivilegeFichierEncours($id){
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT ap.id_privilege
                    FROM _adm_privilege_fichier AS apf, _adm_privilege AS ap
                    WHERE ap.etat_doc = 2
                    AND apf.id = $id";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getFichierType($type) {        
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT f.*, d.url_dossier, fr.numero
        			FROM _adm_fichier_recursif AS fr, _adm_fichier AS f, _adm_dossier d
        			WHERE f.id_type_fichier = $type 
        			AND fr.id_fichier_fils = f.id_fichier
        			AND f.id_dossier = d.id_dossier
        			AND f.etat_doc = 1
        			AND fr.etat_doc = 1
        			ORDER BY fr.numero";        	
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function linkPere($id_fichier, $id_fichier_pere, $etat = 2) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "INSERT INTO _adm_fichier_recursif(id, id_createur, date_creation, id_modificateur, date_modification, etat_doc, id_fichier_pere, id_fichier_fils)
					VALUES ('','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','".time()."','$etat','$id_fichier_pere','$id_fichier')";
		
            return $db->executeQuery($sql);            
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    static public function exist_linkPere($id_fichier,$id_fichier_pere,$etat=2){
		try{
			$db=Annuaire::lookup(KEY_DATABASE);
			$sql="select afr.* from _adm_fichier_recursif as afr
				  where afr.id_fichier_pere=$id_fichier_pere
				  and afr.id_fichier_fils=$id_fichier
				  and afr.etat_doc=$etat
			";
			return($db->executeQuery($sql)->nextObject()!=null);
		}catch(SQLException $e){
			throw new Exception("Access error to database");
		}
	}
    
    static public function linkPrivilege($id_fichier, $id_privilege){
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO _adm_privilege_fichier(id, id_createur, date_creation, id_modificateur, date_modification, etat_doc, id_fichier, id_privilege)
					VALUES ('','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','".time()."','1','$id_fichier','$id_privilege')";
		    return $db->executeQuery($sql);            
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function unlinkPrivilege($id){
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);	
    		$sql = "UPDATE _adm_privilege_fichier
    				SET date_modification = ".time().",
    					id_modificateur = {$_SESSION['id_user']},
    					etat_doc = 0
    				WHERE id = $id";
    		$db->executeQuery($sql);
         }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }	
    
    }
    
    static public function unlinkFichier($id){        
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();	
    		$sql = "UPDATE _adm_fichier_recursif
    				SET date_modification = ".time().",
    					id_modificateur = {$_SESSION['id_user']},
    					etat_doc = 0
    				WHERE id = $id";
    		$db->executeQuery($sql);
         }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }	
    }
    
    static public function exist($id_fichier) {
    	try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * FROM _adm_fichier WHERE id_fichier = $id_fichier AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
    	}
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }        
    }
    
    static public function existEncours($id_fichier) {
    	try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * FROM _adm_fichier WHERE id_fichier = $id_fichier AND etat_doc = 2";
            return ($db->executeQuery($sql)->nextObject() != null);
    	}
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }        
    }
    
    static public function existPrivilegeEncours($id_fichier) {
    	try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * FROM _adm_privilege_fichier WHERE id_fichier = $id_fichier AND etat_doc = 2";
            return ($db->executeQuery($sql)->nextObject() != null);
    	}
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }        
    }
    static public function getObject($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
			$sql = "SELECT af.nom_fichier,
					(SELECT ad.url_dossier FROM _adm_dossier AS ad WHERE ad.id_dossier = af.id_dossier AND ad.etat_doc = 1) AS dossier
					FROM _adm_fichier AS af
					WHERE af.id_fichier = $id_fichier
					AND af.etat_doc = 0";
			return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function isDetail($fichier) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * FROM _adm_fichier WHERE nom_fichier = '$fichier'";
            $fic = $db->executeQuery($sql)->nextObject();
            return ($fic->id_type_fichier == self::TYPE_DETAIL);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    static public function getListFichier() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
			$sql = "SELECT af.nom_fichier, af.id_fichier, 
					(SELECT ad.url_dossier FROM _adm_dossier AS ad WHERE ad.id_dossier = af.id_dossier AND ad.etat_doc = 1) AS dossier
					FROM _adm_fichier AS af
					WHERE af.etat_doc = 0
					AND af.id_dossier <> 0
					AND af.nom_fichier NOT IN
					(SELECT adm.nom_fichier FROM _adm_fichier AS adm WHERE adm.etat_doc = 1)";
			return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    static public function existName($nom_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
			$sql = "SELECT *
					FROM _adm_fichier
					WHERE nom_fichier = '$nom_fichier'
					AND etat_doc = 1";
			return $db->executeQuery($sql)->nextObject()!=null;
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    /*
    function getObjectFichierProfil($id_fichier) {
    	$sql = "SELECT af.*, ad.url_dossier, dtf.lib_type_fichier, dtf.id_type_fichier, au1.login AS login_createur, au2.login AS login_modificateur
    			FROM _adm_fichier AS af, _adm_user AS au1, _adm_user AS au2
    			LEFT JOIN _adm_dossier AS ad ON af.id_dossier = ad.id_dossier
    			LEFT JOIN zz_data_type_fichier AS dtf ON af.id_type_fichier = dtf.id_type_fichier
    			WHERE af.id_fichier = $id_fichier
    			AND af.id_createur = au1.id_user
    			AND af.id_modificateur = au2.id_user";
    	return mysql_fetch_object(requete($sql));
    }
    function getObjectFichier($id_fichier) {
    	$sql = "SELECT af.*, ad.url_dossier, dtf.lib_type_fichier, dtf.id_type_fichier
    			FROM _adm_fichier AS af
    			LEFT JOIN _adm_dossier AS ad ON af.id_dossier = ad.id_dossier
    			LEFT JOIN zz_data_type_fichier AS dtf ON af.id_type_fichier = dtf.id_type_fichier
    			WHERE af.id_fichier = $id_fichier";
    	return mysql_fetch_object(requete($sql));
    }
    function getListeFichier($col, $ordre, $page, $nb_affiche, $filtre=array()) {
    	switch($ordre) {
    		case 1: $ordre = 'ASC'; break;
    		case 2: $ordre = 'DESC'; break;
    		default: $ordre = 'ASC'; break;	
    	}	
    	switch($col) {
    		case 1: $col = 'lib_type_fichier'; break;
    		case 2: $col = 'url_dossier'; break;
    		case 3: $col = 'intitule_fichier'; break;
    		case 4: $col = 'description_fichier'; break;
    		default: $col = 'url_dossier ASC, intitule_fichier'; break;	
    	}
    	$premier = ($page - 1)*$nb_affiche;
    	
    	$sql = "SELECT af.*, ad.url_dossier, dtf.lib_type_fichier
    			FROM _adm_fichier AS af
    			LEFT JOIN _adm_dossier AS ad ON af.id_dossier = ad.id_dossier
    			LEFT JOIN zz_data_type_fichier AS dtf ON af.id_type_fichier = dtf.id_type_fichier
    			WHERE af.etat_doc = 1";
    	
    	if(isset($filtre['intitule_fichier'])) $sql .= " AND af.intitule_fichier LIKE '" . $filtre['intitule_fichier'] . "%'";
    	if(isset($filtre['id_type_fichier']) and $filtre['id_type_fichier']) $sql .= " AND dtf.id_type_fichier = '" . $filtre['id_type_fichier'] . "'";
    	if(isset($filtre['id_dossier']) and $filtre['id_dossier']) $sql .= " AND ad.id_dossier = '" . $filtre['id_dossier'] . "'";
    	$ret['nb'] = mysql_num_rows(requete($sql));
    	$sql .= " ORDER BY " . $col . " " . $ordre ."
    			LIMIT " . $premier . "," . $nb_affiche;
    	$ret['dt'] = requete($sql);
    	return $ret;
    }
    function supprFichierPriv($idpf){
    	$sql = "UPDATE _adm_privilege_fichier SET etat_doc = 0 , id_modificateur = " . $_SESSION['id_user'] . ", date_modification = " . time() . " 
    			WHERE id = ". $idpf;
    	requete($sql);
    }
    
    
    */

}

?>