<?php

/**
 * Classe de gestion des formats d'images uploadées
 * @version 20070926
 * @author Antoine Marcadet
 */
class modelUploadFormat {
    
    static public function insert($nom_format, $url_format, $largeur, $hauteur) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "INSERT INTO upload_format_image(id_format, date_creation, id_createur, date_modification, id_modificateur, etat_doc, nom_format, url_format, largeur, hauteur)
                    VALUES ('','".time()."','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','1','$nom_format','$url_format',$largeur, $hauteur)";
            $db->executeQuery($sql);
            return $db->lastInsertId();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }
    
    static public function update($id_format, $nom_format) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "UPDATE upload_format_image
                    SET date_modification = ".time().",
                        id_modificateur = {$_SESSION['id_user']},
                        nom_format = '$nom_format'                                                                       
                    WHERE id_format = $id_format";
            $db->executeQuery($sql);
            return true;
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }
    
    static public function delete($id_format) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();
            $sql = "UPDATE upload_format_image
                    SET etat_doc = 0,
                        date_modification = ".time().",
                        id_modificateur = {$_SESSION['id_user']}
                    WHERE id_format = $id_format";
            $db->executeQuery($sql);
            $db->beginTransaction();
            $sql = "UPDATE upload_format_repertoire
                    SET etat_doc = 0,
                        date_modification = ".time().",
                        id_modificateur = {$_SESSION['id_user']}
                    WHERE id_format = $id_format";
            $db->executeQuery($sql);
            $db->commitTransaction();
            return true;
        }
        catch(SQLException $e) {
            $db->rollbackTransaction();
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }
    
    static public function getList() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
                    FROM upload_format_image
                    WHERE etat_doc = 1";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }
    
    static public function getObject($id_format) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * 
                    FROM upload_format_image 
                    WHERE id_format = $id_format";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }

    static public function exist($id_format) {
    	try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * 
                    FROM upload_format_image 
                    WHERE id_format = $id_format 
                    AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
    	}
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function existNom($nom_format) {
    	try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * 
                    FROM upload_format_image 
                    WHERE nom_format = '$nom_format' 
                    AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
    	}
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function existNomModif($id_format, $nom_format) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT nom_format 
                    FROM upload_format_image 
                    WHERE nom_format = '$nom_format'
                    AND etat_doc = 1 
                    AND id_format <> $id_format";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données'); 
        }
    }
}

?>