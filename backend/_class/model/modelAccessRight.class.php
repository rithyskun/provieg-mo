<?php

/**
 * Classe de gestion des privilèges
 * @version 20070620
 * @author Léang Stéphanie
 */
class modelAccessRight {
    
    static public function insert($intitule_privilege, $id_type_privilege) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO _adm_privilege(id_privilege,date_creation, id_createur, date_modification, id_modificateur, etat_doc, intitule_privilege, id_type_privilege)
				    VALUES ('','".time()."',{$_SESSION['id_user']}, '".time()."',{$_SESSION['id_user']}, '1', '$intitule_privilege','$id_type_privilege')";
            $db->executeQuery($sql);
    		return $db->lastInsertId();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function insertEncours($intitule_privilege, $description_privilege, $id_type_privilege) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO _adm_privilege(id_privilege,date_creation, id_createur, date_modification, id_modificateur, etat_doc, intitule_privilege, id_type_privilege, description_privilege)
				    VALUES ('','".time()."',{$_SESSION['id_user']}, '".time()."',{$_SESSION['id_user']}, '2', '$intitule_privilege','$id_type_privilege','$description_privilege')";
            $db->executeQuery($sql);
    		return $db->lastInsertId();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function update($id_privilege, $intitule_privilege, $id_type_privilege) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE _adm_privilege
					SET date_modification = '" . time() . "' ,
						id_modificateur = {$_SESSION['id_user']},
						intitule_privilege = '$intitule_privilege',						
						id_type_privilege = $id_type_privilege
					WHERE id_privilege =  $id_privilege";
            $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function delete($id_privilege) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();
            $db->executeQuery("UPDATE _adm_privilege
                               SET etat_doc = 0,
                                   date_modification = " . time() . ",
                                   id_modificateur = {$_SESSION['id_user']}
			                   WHERE id_privilege = $id_privilege");
            $db->executeQuery("UPDATE _adm_privilege_fichier
                               SET etat_doc = 0,
                                   date_modification = " . time() . ",
                                   id_modificateur = {$_SESSION['id_user']}
        		               WHERE id_privilege = $id_privilege");
            $db->commitTransaction();
        }
        catch(SQLException $e) {
            $db->rollbackTransaction();
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function deleteEncours($id_privilege) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $db->executeQuery("UPDATE _adm_privilege
                               SET etat_doc = 0,
                                   date_modification = " . time() . ",
                                   id_modificateur = {$_SESSION['id_user']}
			                   WHERE id_privilege = $id_privilege");
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function linkFichier($id_privilege, $id_fichier){
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO _adm_privilege_fichier(id, date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_privilege, id_fichier)
				    VALUES ('','".time()."',{$_SESSION['id_user']},'".time()."',{$_SESSION['id_user']},'1', $id_privilege, $id_fichier)";
            $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }    
    }
    
    static public function linkFichierEncours($id_privilege, $id_fichier){
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO _adm_privilege_fichier(id, date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_privilege, id_fichier)
				    VALUES ('','".time()."',{$_SESSION['id_user']},'".time()."',{$_SESSION['id_user']},'2', $id_privilege, $id_fichier)";
            $db->executeQuery($sql);    	
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }    
    }
    static public function exist_linkFichierEncours($id_privilege,$id_fichier){
		try{
			$db=Annuaire::lookup(KEY_DATABASE);
			$sql="select apf.* from _adm_privilege_fichier as apf
				  where apf.id_privilege=$id_privilege
				  and apf.id_fichier=$id_fichier
				  and etat_doc=2";
			return($db->executeQuery($sql)->nextObject()!=null);
		}
		catch(SQLException $e){
			throw new Exception('Access error to database');
		}
	}
    
    static public function unlinkFichier($id_pf){
    	try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $db->executeQuery("UPDATE _adm_privilege_fichier SET etat_doc = 0 , id_modificateur = {$_SESSION['id_user']}, date_modification = " . time() . " 
		  	                   WHERE id = $id_pf");
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   	
    }
    
    static public function getPrivilege($id_privilege){
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT ap.*, zz.lib_type_privilege
                    FROM _adm_privilege AS ap, zz_data_type_privilege AS zz
        			WHERE ap.id_privilege = $id_privilege
        			AND zz.id_type_privilege = ap.id_type_privilege";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getList() {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT ap.*, zz.lib_type_privilege
        			FROM _adm_privilege AS ap, zz_data_type_privilege AS zz
        			WHERE ap.id_type_privilege = zz.id_type_privilege
        			AND ap.etat_doc = 1
                    ORDER BY zz.lib_type_privilege, ap.intitule_privilege";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getListFichier($id_privilege) {
    	try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
        			FROM _adm_fichier AS f, _adm_privilege_fichier AS pf
        			WHERE pf.id_privilege = $id_privilege
                    AND pf.id_fichier = f.id_fichier
        			AND pf.etat_doc = 1
        			ORDER BY f.nom_fichier";
            return $db->executeQuery($sql);
		}
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }	
    
    }
    
    static public function getListType() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            return $db->executeQuery("SELECT tp.* FROM zz_data_type_privilege as tp order by tp.lib_type_privilege");
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function exist($id_privilege) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * FROM _adm_privilege WHERE id_privilege = $id_privilege AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
    	}
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function existPrivilege($intitule_privilege, $id_type_privilege) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
                    FROM _adm_privilege
                    WHERE intitule_privilege = '$intitule_privilege'
                    AND id_type_privilege = $id_type_privilege
                    AND etat_doc = 2";
            return ($db->executeQuery($sql)->nextObject() != null);
    	}
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    /**
     * Vérifie en modification que le privilege n'existe pas encore
     */    
    static public function existPrivilegeModif($id_privilege, $intitule_privilege, $id_type_privilege){
        try {
        	$db  = Annuaire::lookup(KEY_DATABASE);
        	$sql = "SELECT * 
                    FROM _adm_privilege 
                    WHERE intitule_privilege = '$intitule_privilege' 
                    AND id_type_privilege = $id_type_privilege
                    AND id_privilege <> $id_privilege 
                    AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
    	}
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    static public function getGroupe($id_privilege){
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT g.*, gp.id as idgp
                    FROM _adm_groupe_privilege AS gp, _adm_groupe AS g
                    WHERE gp.id_groupe = g.id_groupe
                    
                    AND gp.id_privilege = $id_privilege
                    AND gp.etat_doc = 1";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
}

/**


function getObjectPrivilegeProfil($id_privilege) {
	$sql = "SELECT ap.*, ta.nom AS nom_type_privilege, au1.login AS login_createur, au2.login AS login_modificateur
			FROM _adm_privilege AS ap, _adm_user AS au1, _adm_user AS au2, zz_data_type_acces AS ta
			WHERE ap.id_privilege = $id_privilege
			AND ap.id_createur = au1.id_user
			AND ap.id_modificateur = au2.id_user
			AND ap.type_privilege = ta.id";
	return mysql_fetch_object(requete($sql));
}
function getObjectPrivilege($id_privilege) {
	$sql = "SELECT ap.*, ta.nom AS nom_type_privilege FROM _adm_privilege AS ap, zz_data_type_acces AS ta 
			WHERE id_privilege = " . $id_privilege . "
			AND type_privilege = id";
	return mysql_fetch_object(requete($sql));
}
function getListePrivilege($col, $ordre, $page, $nb_affiche, $filtre=array()) {
	switch($ordre) {
		case 1: $ordre = 'ASC'; break;
		case 2: $ordre = 'DESC'; break;
		default: $ordre = 'ASC'; break;	
	}	
	switch($col) {
		case 1: $col = 'type_privilege'; break;
		case 2: $col = 'intitule_privilege'; break;
		case 3: $col = 'description_privilege'; break;
		default: $col = 'intitule_privilege'; break;	
	}
	$premier = ($page - 1)*$nb_affiche;
	
	$sql = "SELECT ap.*, ta.nom AS nom_type_privilege
			FROM _adm_privilege AS ap, zz_data_type_acces AS ta 
			WHERE type_privilege = id
			AND ap.etat_doc = 1";
	foreach($filtre as $key => $value) {
		if($value and $key) {
			if(is_numeric($value))
				$sql .= " AND " . $key . " = '" . $value . "'";
			else
				$sql .= " AND " . $key . " LIKE '" . $value . "%'";
		}
	}
	$ret['nb'] = mysql_num_rows(requete($sql));
	$sql .= " ORDER BY " . $col . ", intitule_privilege " . $ordre ."
			LIMIT " . $premier . "," . $nb_affiche;
	$ret['dt'] = requete($sql);
	return $ret;
}
function getListePrivilegeGroupe($col, $ordre, $page, $nb_affiche, $id_groupe) {
	switch($ordre) {
		case 1: $ordre = 'ASC'; break;
		case 2: $ordre = 'DESC'; break;
		default: $ordre = 'ASC'; break;	
	}
	switch($col) {
		case 1: $col = 'type_privilege'; break;
		case 2: $col = 'intitule_privilege'; break;
		case 3: $col = 'description_privilege'; break;
		default: $col = 'intitule_privilege'; break;	
	}
	$premier = ($page - 1)*$nb_affiche;
	
	$sql = "SELECT ap.*, dta.nom AS nom_type_privilege, agp.id AS id_agp
			FROM _adm_privilege AS ap, zz_data_type_acces AS dta, _adm_groupe_privilege AS agp
			WHERE agp.id_groupe = '" . $id_groupe . "'
			AND agp.id_privilege = ap.id_privilege
			AND dta.id = ap.type_privilege
			AND agp.etat_doc = 1";
	$ret['nb'] = mysql_num_rows(requete($sql));
	$sql .= " ORDER BY " . $col . ",intitule_privilege " . $ordre . "
			LIMIT " . $premier . "," . $nb_affiche;
	$ret['dt'] = requete($sql);
	return $ret;
}
function supprPriv($id_privilege){
	requete("UPDATE _adm_privilege SET etat_doc = 0, date_modification = " . time() . ", id_modificateur = " . $_SESSION['id_user'] . "
			WHERE id_privilege = " . $id_privilege);
	requete("UPDATE _adm_privilege_fichier SET etat_doc = 0, date_modification = " . time() . ", id_modificateur = " . $_SESSION['id_user'] . "
			WHERE id_privilege = " . $id_privilege);

}

 
 
 
 */  



?>