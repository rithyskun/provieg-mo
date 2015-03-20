<?php

/**
 * Classe de gestion d'un upload
 * @version 20070613
 * @author Antoine Marcadet
 * @author Stéphanie Léang  
 *  
 */
 define('FOLDER_PDF', 2);
 define('ID_FORMAT', 2);
class modelUploadFile {

	const ETAT_ATTENTE  = 1;
	const ETAT_VALIDE   = 2;
	const ETAT_N_VALIDE = 3;
	
    
    static public function insert($nom_initial, $nom_telechargement, $nom_serveur, $id_repertoire, $format_fichier, $taille_fichier, $balise_alt = null, $key_unique) {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO upload_fichier(id_fichier, id_createur, date_creation, id_modificateur, date_modification, etat_doc, nom_initial, nom_serveur, nom_telechargement, id_repertoire, type_mime, taille_fichier, balise_alt, key_unique, id_etat_fichier)
            		VALUES('', {$_SESSION['id_user']}, '".time()."', {$_SESSION['id_user']},'".time()."', '1',
								'$nom_initial',
								'$nom_serveur',
								'$nom_telechargement',
								'$id_repertoire',
								'$format_fichier',
								'$taille_fichier',                                
                                '$balise_alt',
                                '$key_unique',
								'".self::ETAT_ATTENTE."')";
			$db->executeQuery($sql);
            return $db->lastInsertId();
        }
        catch(SQLException $e) { echo $e;
            throw new Exception('fichier non inséré');       
        }
    }
    
    /////////////function get from chefmartial
    static public function getBaliseAlt($nom_serveur) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT balise_alt 
                    FROM upload_fichier 
                    WHERE nom_serveur = '$nom_serveur'
                    AND etat_doc = 1";
            return $db->executeQuery($sql)->nextObject()->balise_alt;
        }
        catch(SQLException $e) {
            throw new Exception('Erreur lors de la récupération de la balise alt');
        }
    }
    ////////////////////////////////
    
    static public function update($id_fichier,$nom_initial, $nom_telechargement, $nom_serveur, $id_repertoire, $format_fichier, $taille_fichier, $balise_alt) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE upload_fichier 
                    SET id_modificateur = {$_SESSION['id_user']}, 
                        date_modification = '".time()."', 
                        nom_initial = '$nom_initial', 
                        nom_serveur = '$nom_serveur', 
                        nom_telechargement = '$nom_telechargement', 
                        id_repertoire = $id_repertoire, 
                        format_fichier = '$format_fichier', 
                        taille_fichier = $taille_fichier,                                                
                        balise_alt = '$balise_alt'
                    WHERE id_fichier = $id_fichier";
            		
			$db->executeQuery($sql);
		}
        catch(SQLException $e) {
            throw new Exception('fichier non mis à jour');
        }
    }
    
    static public function updateTitreDescription($id_fichier, $titre, $balise_alt, $description) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $db->flushVariable();
            $sql = "UPDATE upload_fichier
                    SET date_modification = ".time().",
                        id_modificateur = {$_SESSION['id_user']},
                        titre = '$titre',
                        balise_alt= '$balise_alt',
                        description = '$description'
                    WHERE id_fichier = $id_fichier";
            $db->prepareQuery('titre', $titre);
            $db->prepareQuery('description', $description);
            $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur lors de la modification du titre et de la description');
        }
    }
    
    
    static public function validerFichier($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "UPDATE upload_fichier
					SET id_etat_fichier = ".self::ETAT_VALIDE."
					WHERE id_fichier = $id_fichier";
			$db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur lors de la validation d\'une photo');
        }
    }

    static public function refuserFichier($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "UPDATE upload_fichier
					SET id_etat_fichier = ".self::ETAT_N_VALIDE."
					WHERE id_fichier = $id_fichier";
			$db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur lors du refus d\'une photo');
        }
    }
    
    
    
    static public function linkTag($id_fichier, $id_tag){
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO referencement_tag_fichier(id, date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_fichier, id_tag)
                    VALUES ('','".time()."','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','1','$id_fichier','$id_tag')";
            $res = $db->executeQuery($sql);
        }
        catch(SQLException $e){
            echo $e;
            throw new Exception('Tag non mis à jour'); 
        }
    
    }
    
    static public function unlinkTag($id){
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE referencement_tag_fichier SET etat_doc = 0, date_modification = " . time() . ", id_modificateur = {$_SESSION['id_user']} WHERE id = $id";
            $res = $db->executeQuery($sql);
        }
        catch(SQLException $e){
            echo $e;
            throw new Exception('Tag non mis à jour'); 
        }
    
    }
    
    static public function linkRecette($id_recette_meta, $id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "INSERT INTO recette_meta_fichier(id_rmf, date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_recette_meta, id_fichier)
                    VALUES('','".time()."','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','1',$id_recette_meta,$id_fichier)";
            $db->executeQuery($sql);
            return $db->lastInsertId();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur lors de l\'association entre une recette et un fichier');
        }
    }
    
    static public function unlinkRecette($id_rmf) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "UPDATE recette_meta_fichier
                    SET date_modification = ".time().",
                        id_modificateur = {$_SESSION['id_user']},
                        etat_doc = 0
                    WHERE id_rmf = $id_rmf";
            $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur lors de la suppression du lien entre un fichier et une recette');
        }
    }
    
 
    static public function delete($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "UPDATE upload_fichier
                    SET date_modification = ".time().",
                        id_modificateur = {$_SESSION['id_user']},
                        etat_doc = 0
                    WHERE id_fichier = $id_fichier";
            $db->executeQuery($sql);
            return true;
       }
       catch(SQLException $e) {
            throw new Exception('fichier non supprimé');
       }
    }
    
    static public function getList() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT up.*, ur.url_repertoire, au.login AS login_createur
                    FROM upload_fichier AS up, upload_repertoire AS ur, _adm_user AS au
                    WHERE up.etat_doc = 1
        			AND up.id_repertoire = ur.id_repertoire
    				AND up.id_repertoire = ur.id_repertoire
                    AND up.id_createur = au.id_user
                    AND au.etat_doc = 1
					ORDER BY up.date_creation DESC";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e){           
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getListBanner() {
    	try {
    		$db = Annuaire::lookup(KEY_DATABASE);
    		$sql = "SELECT up.*, ur.url_repertoire, au.login AS login_createur
                    FROM upload_fichier AS up, upload_repertoire AS ur, _adm_user AS au
                    WHERE up.etat_doc = 1
        			AND up.id_repertoire = " . ID_REPERTOIRE_SLIDER . "
    				AND up.id_repertoire = ur.id_repertoire
                    AND up.id_createur = au.id_user
                    AND au.etat_doc = 1
					ORDER BY up.date_creation DESC";
    		return $db->executeQuery($sql);
    	}
    	catch(SQLException $e){
    		throw new Exception('Erreur d\'accès à la base de données');
    	}
    }

    static public function getListAttente() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT up.*, ur.url_repertoire,
							au.login AS login_createur, ui.pseudo AS pseudo_createur,
							r.titre_recette, r.id_recette
                    FROM upload_fichier AS up
                    INNER JOIN upload_repertoire AS ur ON (ur.id_repertoire = up.id_repertoire AND ur.etat_doc = 1)
                    INNER JOIN _adm_user AS au ON (au.id_user = up.id_createur AND au.etat_doc = 1)
                    INNER JOIN recette_meta_fichier AS rmf ON (rmf.id_fichier = up.id_fichier)
                    INNER JOIN recette AS r ON (
						r.id_recette = (
										SELECT rh.id_recette
                                        FROM recette_histo AS rh
                                        WHERE rh.id_recette_meta = rmf.id_recette_meta
                                        AND rh.date_modification = (
                                                                    SELECT MAX(rh2.date_modification)
                                                                    FROM recette_histo AS rh2
                                                                    WHERE rh2.id_recette_meta = rmf.id_recette_meta
                                                                )
									)
					)
                    LEFT JOIN user_infos AS ui ON (au.id_user = ui.id_user AND ui.etat_doc = 1)
                    WHERE up.etat_doc = 1
					AND up.id_etat_fichier = ".modelUploadFile::ETAT_ATTENTE;
            return $db->executeQuery($sql);
        }
        catch(SQLException $e){
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getListTag($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * 
                    FROM referencement_tag_fichier AS f, referencement_tag AS t
                    WHERE f.id_tag = t.id_tag
                    AND f.id_fichier = $id_fichier
                    AND f.etat_doc = 1";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e){           
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function getObject($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT up.*, 
						   ur.url_repertoire, au.login AS login_createur,
						   def.id_etat_fichier, def.lib_etat_fichier AS etat_fichier
                    FROM upload_fichier AS up,
						 upload_repertoire AS ur,
						 _adm_user AS au,
						 zz_data_etat_fichier AS def
                    WHERE up.id_fichier = $id_fichier
                    AND up.id_repertoire = ur.id_repertoire
                    AND up.id_createur = au.id_user
                    AND up.id_etat_fichier = def.id_etat_fichier
                    AND up.etat_doc = 1
        			AND au.etat_doc = 1";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getFichierName($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT nom_serveur
                    FROM upload_fichier
                    WHERE id_fichier = $id_fichier
                    AND etat_doc = 1";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getImage($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
				            $sql = "SELECT up.*,uf.largeur,def.lib_etat_fichier AS etat_fichier, CONCAT( ur.url_repertoire, uf.url_format ) AS url_fichier
							FROM upload_fichier AS up, upload_repertoire AS ur, upload_format_image AS uf,
							upload_repertoire_format AS urf,
								 zz_data_etat_fichier AS def
							WHERE up.id_fichier =$id_fichier
							AND up.id_repertoire = ur.id_repertoire
							AND urf.id_format = uf.id_format
							AND up.id_etat_fichier = def.id_etat_fichier
							AND up.etat_doc =1
							AND urf.id_repertoire = ur.id_repertoire
							order by uf.largeur desc
							";//
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
       
    static public function getObjectMiniature($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT up.*, uf.largeur, uf.hauteur,
						   ur.url_repertoire, au.login AS login_createur,
						   def.id_etat_fichier, def.lib_etat_fichier AS etat_fichier,
						   CONCAT(ur.url_repertoire, uf.url_format) AS url_fichier
                    FROM upload_fichier AS up,
						 upload_repertoire AS ur,
						 upload_format_image AS uf,
						 upload_repertoire_format AS urf,
						 _adm_user AS au,
						 zz_data_etat_fichier AS def
                    WHERE up.id_fichier = $id_fichier 
                    AND up.id_repertoire = ur.id_repertoire
                    AND up.id_createur = au.id_user
                    AND up.id_etat_fichier = def.id_etat_fichier
                    AND urf.id_repertoire = ur.id_repertoire
                    AND urf.id_format = uf.id_format
                    AND up.etat_doc = 1
        			AND au.etat_doc = 1
                    AND uf.id_format = '" . ID_FORMAT . "'";//
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
	
	static public function getImageDetail($id_fichier) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT uf.*,ur.url_repertoire,def.lib_etat_fichier AS etat_fichier  
			FROM upload_fichier as uf,upload_repertoire as ur,zz_data_etat_fichier AS def
			 
			WHERE  uf.id_etat_fichier = def.id_etat_fichier 
			AND uf.id_repertoire = ur.id_repertoire AND id_fichier=$id_fichier
				";
 			return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getObjectKeyunique($key_unique) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT up.*, ur.url_repertoire, au.login AS login_createur
                    FROM upload_fichier AS up, upload_repertoire AS ur, _adm_user AS au
                    WHERE up.key_unique = $key_unique 
                    AND up.etat_doc = 1
        			AND up.id_repertoire = ur.id_repertoire
                    AND up.id_createur = au.id_user
                    AND au.etat_doc = 1";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
        
    static public function exist($id_fichier) {
    	try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * FROM upload_fichier WHERE id_fichier = $id_fichier AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
    	}
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }        
    }
    static public function existTag($id_tag, $id_fichier){
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT id FROM referencement_tag_fichier WHERE id_fichier = '$id_fichier' AND id_tag = '$id_tage' AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e){
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function makeUrl($nom_serveur){
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT up.*, ur.url_repertoire
            FROM upload_fichier AS up, upload_repertoire AS ur 
            WHERE nom_serveur LIKE '$nom_serveur%' 
            AND up.id_repertoire = 1
            AND up.etat_doc = 1";
            $fichier = $db->executeQuery($sql)->nextObject();
            return $fichier->nom_serveur;
        }
        catch(SQLException $e){ 
            throw new Exception('Erreur d\'accès à la base de données');
        }        
    }
     
}

?>