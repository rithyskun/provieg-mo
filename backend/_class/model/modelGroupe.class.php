<?php

/**
 * Classe de gestion d'un groupe
 * @version 20070613
 * @author Antoine Marcadet
 * @author Stéphanie Léang  
 */
class modelGroupe {
    
    /**
     * Insert un groupe dans la base de donnée
     * @param $intitule_groupe : le nom du groupe
     * @param $description_groupe : la description du groupe          
     */         
    static public function insert($intitule_groupe, $description_groupe) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO _adm_groupe(id_groupe, date_creation, id_createur, date_modification, id_modificateur, etat_doc, intitule_groupe, description_groupe)
    				VALUES ('','".time()."','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','1','$intitule_groupe','$description_groupe')";
            $db->executeQuery($sql);
            return $db->lastInsertId();
        }
        catch(SQLException $e) {
            throw new Exception('Groupe non inséré');       
        }
    }

    /**
     * Mise à jour des informations d'un groupe
     * @param $id_groupe : l'identifiant du groupe
     * @param $intitule_groupe : le nom du groupe
     * @prama $description_groupe : la description du groupe
     */
    static public function update($id_groupe, $intitule_groupe, $description_groupe) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE _adm_groupe
    				SET date_modification = '".time()."' ,
    					id_modificateur = {$_SESSION['id_user']},
    					intitule_groupe = '$intitule_groupe',
    					description_groupe = '$description_groupe'
    			    WHERE id_groupe = $id_groupe";
            $db->executeQuery($sql);
		}
        catch(SQLException $e) {
            throw new Exception('Groupe non mis à jour');
        }
    }
    
    /**
     * Supprime le groupe en mettant son état doc à zero
     * @param id_groupe : L'identifiant du groupe
     */
    static public function delete($id_groupe) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();

            $db->executeQuery("UPDATE _adm_groupe SET etat_doc = 0, date_modification = '".time()."' , id_modificateur = '{$_SESSION['id_user']}' WHERE id_groupe = $id_groupe");
            $db->executeQuery("UPDATE _adm_groupe_privilege SET etat_doc = 0, date_modification = " . time() . ", id_modificateur = {$_SESSION['id_user']} WHERE id_groupe = $id_groupe");
        	$db->executeQuery("UPDATE _adm_user_groupe SET etat_doc = 0, date_modification = " . time() . ", id_modificateur = {$_SESSION['id_user']}	WHERE id_groupe = $id_groupe");

            $db->commitTransaction();
       }
       catch(SQLException $e) {
            $db->rollbackTransaction();
            throw new Exception('Groupe non supprimé');
       }
    }
    
    static public function linkUser($id_groupe, $id_user) {
         try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO _adm_user_groupe(id, date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_groupe, id_user)
					VALUES ('','".time()."','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}', '1','$id_groupe','$id_user')";
            $db->executeQuery($sql);
         }
         catch(SQLException $e) {
            throw new Exception('Utilisateur non associé au groupe'); 
         }
    }
    
    static public function unlinkUser($id) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE _adm_user_groupe
        			SET etat_doc = 0,
                        id_modificateur = {$_SESSION['id_user']},
                        date_modification = " . time() . "
        		 	WHERE id = $id";
	        $db->executeQuery($sql);
	    }
        catch(SQLException $e) {
            throw new Exception('Groupe non supprimé');
        }
    }
    
    static public function linkPrivilege($id_groupe, $id_privilege) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO _adm_groupe_privilege(id, date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_groupe, id_privilege )
					VALUES ('', '" . time() . "', {$_SESSION['id_user']}, '" . time() . "', {$_SESSION['id_user']}, '1', $id_groupe, $id_privilege)";
            $db->executeQuery($sql);
		}
        catch(SQLException $e) {
            throw new Exception('Privilège non associé au groupe'); 
        }
    }
    
    static public function linkGroup($id_groupe,$id_user){  
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO _adm_user_groupe (
						id, 
						date_creation, 
						id_createur, 
						date_modification, 
						id_modificateur, 
						etat_doc, 
						id_groupe, 
						id_user
						)
				    VALUES (
						'',
						'".time()."',
						{$_SESSION['id_user']},
						'".time()."',
						{$_SESSION['id_user']},
						'1', 
						$id_groupe, 
						$id_user)";
            $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Acces error to database');
        }    
    }  
    static public function unlinkPrivilege($id) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE _adm_groupe_privilege
                    SET etat_doc = 0,
                        id_modificateur = {$_SESSION['id_user']},
                        date_modification = " . time() . "
    			    WHERE id = $id";
	        $db->executeQuery($sql);
    	}
        catch(SQLException $e) {
            throw new Exception('Groupe non supprimé'); 
        }
    }
    
    /**
     * Retourne un objet groupe
     * @param $id_groupe : l'identifiant du groupe
     */              
    static public function getGroupe($id_groupe) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
                    FROM _adm_groupe
                    WHERE id_groupe = $id_groupe";
            $res = $db->executeQuery($sql);
            return $res->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');   
        }    
    }
    
    /**
     * Retourne la liste des groupes
     */         
    static public function getList() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            return $db->executeQuery("SELECT * FROM _adm_groupe WHERE etat_doc = 1 ORDER BY intitule_groupe");
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');   
        }  
    }
    
    static public function getListUser($id_groupe) {
         try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT u.*, ug.id AS id_gu
                    FROM _adm_groupe AS g, _adm_user_groupe AS ug, _adm_user AS u
                    WHERE ug.etat_doc = 1
                    AND g.id_groupe = ug.id_groupe
                    AND u.id_user = ug.id_user
                    AND g.id_groupe = $id_groupe";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');   
        }  
    }
    
    static public function getListPrivilege($id_groupe) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT p.*, zz.lib_type_privilege, gp.id AS id_gp
                    FROM _adm_groupe AS g, _adm_groupe_privilege AS gp, _adm_privilege AS p, zz_data_type_privilege AS zz
                    WHERE gp.etat_doc = 1
                    AND zz.id_type_privilege = p.id_type_privilege
                    AND g.id_groupe = gp.id_groupe
                    AND p.id_privilege = gp.id_privilege
                    AND g.id_groupe = $id_groupe
                    ORDER BY zz.lib_type_privilege,p.intitule_privilege";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }  
    }
    
    /**
     * Vérifie si l'intitulé du groupe existe
     * Retourne vrai si l'intitulé existe déjà Faux sinon
     * @param $intitulé_groupe : le nom du groupe         
     */              
    static public function existIntitule($intitule_groupe) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT intitule_groupe FROM _adm_groupe AS g WHERE intitule_groupe = '$intitule_groupe' AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');   
        }  
    }
               
    /**
     * Vérifie si le login de l'utilisateur existe pour la modification, elle doit etre différente de l'utilisateur donnée
     * Retourne vrai si le login existe déjà Faux sinon
     * @param $login : le login de l'utilisateur         
     */     
    static public function existIntituleModif($intitule_groupe, $id_groupe) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT intitule_groupe FROM _adm_groupe WHERE intitule_groupe = '$intitule_groupe' AND etat_doc = 1 AND id_groupe <> $id_groupe";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données'); 
        }   
    }
    
    /**
     * Vérifie si le groupe existe
     * Retourne vrai si le groupe existe déjà Faux sinon 
     * @param id_groupe : l'identifiant du groupe         
     */              
    static public function exist($id_groupe) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT id_groupe FROM _adm_groupe AS g WHERE id_groupe = $id_groupe AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');   
        }            
    }    
}

?>