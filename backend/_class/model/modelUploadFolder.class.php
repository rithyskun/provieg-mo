<?php

/**
 * Classe de gestion des repertoires d'uploads
 * @version 20070926
 * @author Antoine Marcadet 
 */
class modelUploadFolder {
    
    static public function insert($nom_repertoire, $url_repertoire) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "INSERT INTO upload_repertoire(id_repertoire, date_creation, id_createur, date_modification, id_modificateur, etat_doc, nom_repertoire, url_repertoire)
                    VALUES ('','".time()."','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','1','$nom_repertoire','$url_repertoire')";
            $db->executeQuery($sql);
            return $db->lastInsertId();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }
    
    static public function update($id_repertoire, $nom_repertoire) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "UPDATE upload_repertoire
                    SET date_modification = ".time().",
                        id_modificateur = {$_SESSION['id_user']},
                        nom_repertoire = '$nom_repertoire'                                   
                    WHERE id_repertoire = $id_repertoire";
            $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }
    
    static public function delete($id_repertoire) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();
            $sql = "UPDATE upload_repertoire
                    SET etat_doc = 0,
                        date_modification = ".time().",
                        id_modificateur = {$_SESSION['id_user']}
                    WHERE id_repertoire = $id_repertoire";
            $db->executeQuery($sql);
            $sql = "UPDATE upload_repertoire_mime
                    SET etat_doc = 0,
                        date_modification = ".time().",
                        id_modificateur = {$_SESSION['id_user']}
                    WHERE id_repertoire = $id_repertoire";
            $db->executeQuery($sql);
            $sql = "UPDATE upload_repertoire_format
                    SET etat_doc = 0,
                        date_modification = ".time().",
                        id_modificateur = {$_SESSION['id_user']}
                    WHERE id_repertoire = $id_repertoire";
            $db->executeQuery($sql);
            $db->commitTransaction();
            return true;
        }
        catch(SQLException $e) {
            $db->rollbackTransaction();
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }
    
    /**
 	* 	modify
 	*/
    static public function getList() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
                    FROM upload_repertoire
                    WHERE etat_doc = 1
                    ORDER BY nom_repertoire";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }    
    
    static public function getRepertoireImage() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
                    FROM upload_repertoire
                    WHERE etat_doc = 1
                    ORDER BY nom_repertoire";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }
    //static public function getRepertoireImage($ID_REPERTOIRE) {
//        try {
//            $db = Annuaire::lookup(KEY_DATABASE);
//            $sql = "SELECT *
//                    FROM upload_repertoire
//                    WHERE id_repertoire = '$ID_REPERTOIRE'
//					AND etat_doc = 1
//                    ORDER BY nom_repertoire";
//            return $db->executeQuery($sql);
//        }
//        catch(SQLException $e) {
//            throw new Exception('Erreur d\'accès à la base de données');
//        }   
//    }
    
    static public function getListFormat($id_repertoire) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT ufi.*, urf.id_repertoire_format
                    FROM upload_repertoire_format AS urf, upload_format_image AS ufi
                    WHERE urf.etat_doc = 1
                    AND ufi.etat_doc = 1
                    AND urf.id_repertoire = $id_repertoire
                    AND urf.id_format = ufi.id_format
                    ORDER BY ufi.nom_format";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }
    
    
    
    static public function getListTypeMime($id_repertoire) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT zz.*, ur.id_repertoire_mime
                    FROM upload_repertoire_mime AS ur, zz_data_type_mime AS zz
                    WHERE ur.etat_doc = 1
                    AND ur.id_repertoire = $id_repertoire
                    AND ur.id_type_mime = zz.id_type_mime
                    ORDER BY zz.type_mime";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }
    
    static public function isAuthorizedTypeMime($id_repertoire, $type_mime) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT zz.*, ur.id_repertoire_mime
                    FROM upload_repertoire_mime AS ur, zz_data_type_mime AS zz
                    WHERE ur.etat_doc = 1
                    AND ur.id_repertoire = $id_repertoire
                    AND ur.id_type_mime = zz.id_type_mime
                    ORDER BY zz.type_mime";
            $res = $db->executeQuery($sql);
            $arrayTypeMime = array();
            foreach($res as $key => $type) {
                $arrayTemp = split(',', $type->type_mime);
                $arrayTypeMime = array_merge($arrayTypeMime, $arrayTemp);
            }
            return (in_array($type_mime, $arrayTypeMime));
        }
        catch(SQLException $e) {
            throw new Exception($e->getMessage());
        }  
    }
    
    static public function getObject($id_repertoire) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT ur.*,(SELECT id_format FROM upload_format_image WHERE etat_doc = 1 ORDER BY largeur DESC LIMIT 1 ) AS id_format_max
                    FROM upload_repertoire AS ur
                    WHERE ur.id_repertoire = $id_repertoire";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception($e->getMessage());
        }   
    }
    
    
    static public function linkTypeMime($id_repertoire, $id_type_mime) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "SELECT *
                    FROM upload_repertoire_mime
                    WHERE id_repertoire = $id_repertoire
                    AND id_type_mime = $id_type_mime
                    AND etat_doc = 1";
            $res = $db->executeQuery($sql);
            if($res->size() == 0) {
                $sql = "INSERT INTO upload_repertoire_mime(id_repertoire_mime, date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_repertoire, id_type_mime)
                        VALUES ('','".time()."','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','1','$id_repertoire','$id_type_mime')";
                $db->executeQuery($sql);
            }
            return true;
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function unlinkTypeMime($id_repertoire_mime) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "UPDATE upload_repertoire_mime
                    SET date_modification = ".time().", 
                        id_modificateur = {$_SESSION['id_user']}, 
                        etat_doc = 0
                    WHERE id_repertoire_mime = $id_repertoire_mime";
            $db->executeQuery($sql);
            return true;
        }
        catch(SQLException $e) {
            echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function linkFormat($id_repertoire, $id_format) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "SELECT *
                    FROM upload_repertoire_format
                    WHERE id_repertoire = $id_repertoire
                    AND id_format = $id_format
                    AND etat_doc = 1";
            $res = $db->executeQuery($sql);
            if($res->size() == 0) {
                $sql = "INSERT INTO upload_repertoire_format(id_repertoire_format, date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_repertoire, id_format)
                        VALUES ('','".time()."','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','1','$id_repertoire','$id_format')";
                $db->executeQuery($sql);
            }
            return true;
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function unlinkFormat($id_repertoire_format) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "UPDATE upload_repertoire_format
                    SET date_modification = ".time().", 
                        id_modificateur = {$_SESSION['id_user']}, 
                        etat_doc = 0
                    WHERE id_repertoire_format = $id_repertoire_format";
            $db->executeQuery($sql);
            return true;
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    

    static public function exist($id_repertoire) {
    	try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * 
                    FROM upload_repertoire 
                    WHERE id_repertoire = $id_repertoire 
                    AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
    	}
        catch(SQLException $e) {
            echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }        
    }
    
    static public function existNom($nom_repertoire) {
    	try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * 
                    FROM upload_repertoire 
                    WHERE nom_repertoire = '$nom_repertoire' 
                    AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
    	}
        catch(SQLException $e) {echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }        
    } 
    static public function existNomModif($nom_type_fichier, $id_type_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT nom_type_fichier 
                    FROM upload_type_fichier 
                    WHERE nom_type_fichier = '$nom_type_fichier' 
                    AND etat_doc = 1 
                    AND id_type_fichier <> $id_type_fichier";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données'); 
        }   
    }
}

?>