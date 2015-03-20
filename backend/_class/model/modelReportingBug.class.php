<?php

/**
 * Classe de gestion des problèmes dans le reporting
 * @version 20070622
 * @author Antoine Marcadet & Stéphanie Léang
 */
class modelReportingBug {
    
    const ETAT_EN_ATTENTE = 1;
    const ETAT_CORRIGE    = 2;
    const ETAT_ABANDONNE  = 3;
    const ETAT_EFFECTUE   = 4;
    const ETAT_RETOUR     = 5;
    const ETAT_IMPOSSIBLE = 6;

    const PRIORITE_FAIBLE = 1;
    const PRIORITE_MOYEN  = 2;
    const PRIORITE_ELEVE  = 3;
        
    static public function insert($request_uri, $commentaire) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();
            $time =	time();
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
        	$sql = "INSERT INTO report_probleme (id_report, date_creation, id_createur, date_modification, id_modificateur, etat_doc, referer, commentaire, user_agent, id_priorite)
        			VALUES ('','$time','{$_SESSION['id_user']}','$time','{$_SESSION['id_user']}',1,'$request_uri','{commentaire}','$user_agent',".self::PRIORITE_FAIBLE.")";
            $db->prepareQuery('commentaire', $commentaire);
        	$db->executeQuery($sql);
        
        	// INSERTION probleme EN MODE ATTENTE
        	$id_report = $db->lastInsertId();
        	$sql = "INSERT INTO report_probleme_etat (id_probleme_etat, date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_report, id_etat, commentaire)
        	        VALUES ('','$time','{$_SESSION['id_user']}','$time','{$_SESSION['id_user']}',1,$id_report,".self::ETAT_EN_ATTENTE.",'')";
        	$db->executeQuery($sql);
            $db->commitTransaction();       
        }
        catch(SQLException $e) {
            //echo $e;
            $db->rollbackTransaction();
            throw new Exception('Problème non insérée');
        }
    }
    
    static public function update($id_probleme, $com, $id_etat){
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();
        	$sql =	"INSERT INTO report_probleme_etat ( id_probleme_etat , date_creation , id_createur,
					date_modification , id_modificateur , etat_doc , id_report , id_etat , commentaire )
					VALUES ('', '".time()."', '{$_SESSION['id_user']}', '".time()."', '{$_SESSION['id_user']}', 1, '$id_probleme', '$id_etat', '$com');";
			$db->executeQuery($sql);
			
			$sql = "UPDATE report_probleme
					SET date_modification = " . time() . ",
						id_modificateur = " . $_SESSION['id_user'] . "
					WHERE id_report = $id_probleme";
			$db->executeQuery($sql);
			$db->commitTransaction();
		}
        catch(SQLException $e) {
            //echo $e;
            $db->rollbackTransaction();
            throw new Exception('Problème non insérée');
        }	
	}
	
	
    /**
     * Retourne la liste des problèmes
     */         
    static public function getList($search = null){
        try{
            if($search != null)
                extract($search);
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT rp.*, au1.login AS login_createur, au2.login AS login_modificateur, der.lib_etat_report AS lib_etat, dpr.id_priorite, dpr.lib_priorite
        			FROM report_probleme AS rp
                    INNER JOIN _adm_user AS au1 ON au1.id_user = rp.id_createur
                    INNER JOIN _adm_user AS au2 ON au2.id_user = rp.id_modificateur
                    INNER JOIN zz_data_priorite_report AS dpr ON (dpr.id_priorite = rp.id_priorite)
        			LEFT JOIN report_probleme_etat AS rpe ON (rpe.id_report = rp.id_report AND rpe.id_probleme_etat = (SELECT MAX(id_probleme_etat)
                                                                                                                        FROM report_probleme_etat
                                                                                                                        WHERE id_report = rp.id_report
                                                                                                                        AND etat_doc = 1))
        			LEFT JOIN zz_data_etat_report AS der ON (der.id_etat_report = rpe.id_etat)
                     WHERE rp.etat_doc = 1";
            if($search != null){
               	$sql .= " AND (
                				rpe.id_etat = $corrige 
                				OR rpe.id_etat = $attente	
                				OR rpe.id_etat = $abandon
                                OR rpe.id_etat = $impossible
                                OR rpe.id_etat = $retour	
    		              )
                          AND (
                                rp.id_priorite = $faible
                                OR rp.id_priorite = $moyen
                                OR rp.id_priorite = $eleve
                          )";
    		}else{
                $sql .=" AND rpe.id_etat = 1 OR rpe.id_etat = 5";
            }

            $sql .=" ORDER BY dpr.id_priorite DESC, rp.date_modification ASC";
            return $db->executeQuery($sql);
        }catch(SQLException $e) {            
            throw new Exception('Erreur d\'accès à la base de données');
        }
    
    }
    
    static public function getProbleme($id_probleme){
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT rp.*, au1.login AS login_createur, au2.login AS login_modificateur, dpr.lib_priorite
                    FROM report_probleme AS rp, _adm_user AS au1, _adm_user AS au2, zz_data_priorite_report AS dpr
                    WHERE au1.id_user = rp.id_createur
                    AND au2.id_user = rp.id_modificateur
                    AND rp.id_report = $id_probleme
                    AND rp.id_priorite = dpr.id_priorite
                    ORDER BY rp.date_creation DESC";
            return($db->executeQuery($sql)->nextObject());
		}
        catch(SQLException $e) {
		  throw new Exception('Erreur d\'accès à la base de données');
		}
        				
	}
	
	static public function getListStatus($id_probleme){
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            return $db->executeQuery("SELECT rp.*, au1.login AS login_createur, au2.login AS login_modificateur, etat.lib_etat_report
					FROM report_probleme_etat AS rp, _adm_user AS au1, _adm_user AS au2, zz_data_etat_report AS etat
					WHERE (au1.id_user = rp.id_createur AND rp.id_report=$id_probleme)
					AND au2.id_user = rp.id_modificateur
					AND etat.id_etat_report=rp.id_etat
					ORDER BY rp.date_creation DESC");
        }
        catch(SQLException $e) {            
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

	static public function updatePriorite($id_report, $id_priorite) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "UPDATE report_probleme
                    SET id_priorite = $id_priorite
                    WHERE id_report = $id_report";
            $db->executeQuery($sql);
        }
        catch(SQLException $e){
            throw new Exception('Erreur du changement de la priorité');
        }
    }	
}

?>