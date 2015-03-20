<?php

/**
 * Classe de gestion des discussions avec les membres
 * @version 20071108
 * @author Antoine Marcadet
 */
 
class modelReportingDiscussion {

    const ETAT_EN_ATTENTE = 1;
    const ETAT_CORRIGE    = 2;
    const ETAT_ABANDONNE  = 3;
    const ETAT_EFFECTUE   = 4;
    const ETAT_RETOUR     = 5;
    const ETAT_IMPOSSIBLE = 6;
    const ETAT_ENVOYE     = 7;
    const ETAT_ARCHIVE    = 8;

    const PRIORITE_FAIBLE = 1;
    const PRIORITE_MOYEN  = 2;
    const PRIORITE_ELEVE  = 3;

    static public function newDiscussion($titre, $message, $id_destinataire, $etat = null) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->flushVariable();
            $db->beginTransaction();
            $time =	time();
            $etat = ($etat == null)?modelReportingDiscussion::ETAT_ENVOYE:$etat;
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $id_user = (isset($_SESSION['id_user']))?$_SESSION['id_user']:1;
        	$sql = "INSERT INTO report_discussion (id_discussion, date_creation, id_createur, date_modification, id_modificateur, etat_doc, titre, user_agent, id_priorite, id_user)
        			VALUES ('','$time','$id_user','$time','$id_user',1,'{titre}','$user_agent',".self::PRIORITE_FAIBLE.",'$id_destinataire')";
            $db->prepareQuery('titre', $titre);
        	$db->prepareQuery('message', $message);
            $db->executeQuery($sql);

        	// INSERTION EN MODE ATTENTE
        	$id_discussion = $db->lastInsertId();
        	$sql = "INSERT INTO report_discussion_msg (id_discussion_msg, date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_discussion, id_etat, message, lu)
        	        VALUES ('','$time','$id_user','$time','$id_user',1,$id_discussion,$etat,'{message}', 0)";
        	$db->prepareQuery('message', $message);
        	$db->executeQuery($sql);
            $db->commitTransaction();
            return $id_discussion;
        }
        catch(SQLException $e) {
            $db->rollbackTransaction();
            throw new Exception('Message de discussion non créé');
        }
    }
    
    static public function newReponse($id_discussion, $message, $etat = null) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->flushVariable();
            $db->beginTransaction();
            $etat = ($etat == null)?self::ETAT_RETOUR:$etat;
            $time =	time();
            $sql = "UPDATE report_discussion
                    SET id_modificateur = {$_SESSION['id_user']},
                        date_modification = $time
                    WHERE id_discussion = $id_discussion";
            $db->executeQuery($sql);
            $sql = "INSERT INTO report_discussion_msg (id_discussion_msg, date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_discussion, id_etat, message, lu)
        	        VALUES ('','$time','{$_SESSION['id_user']}','$time','{$_SESSION['id_user']}',1,$id_discussion,$etat,'{message}', 0)";
        	$db->prepareQuery('message', $message);
        	$db->executeQuery($sql);
            $db->commitTransaction();
        }
        catch(SQLException $e) {
            $db->rollbackTransaction();
            throw new Exception('Erreur lors de l\'enregistrement de la réponse');
        }
    }


    /*static public function update($id_discussion, $message, $id_etat) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $db->beginTransaction();
        	$sql ="INSERT INTO report_discussion_msg (id_discussion_msg, date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_report, id_etat, message, lu)
        	        VALUES ('','".time()."','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}',1,'$id_discussion','$id_etat','{message}','0');";
			$db->prepareQuery('message', $message);
        	$db->executeQuery($sql);
		}
        catch(SQLException $e) {
            throw new Exception('Message de discussion non créé');
        }
	}*/


    static public function getList($search = null){
        try{
            if($search != null)
                extract($search);
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT rc.*,
                           au.login AS login_destinataire,
                           der.lib_etat_report AS lib_etat,
                           rcm.lu,
                           dpr.id_priorite,
                           dpr.lib_priorite
        			FROM report_discussion AS rc
        			INNER JOIN _adm_user AS au ON au.id_user = rc.id_user
                    INNER JOIN zz_data_priorite_report AS dpr ON (dpr.id_priorite = rc.id_priorite)
                    LEFT JOIN report_discussion_msg AS rcm ON (
                            rcm.id_discussion = rc.id_discussion
                        AND rcm.id_discussion_msg = ( SELECT MAX(id_discussion_msg)
                                                         FROM report_discussion_msg
                                                         WHERE id_discussion = rc.id_discussion
                                                         AND etat_doc = 1
                        )
                    )
                    LEFT JOIN zz_data_etat_report AS der ON (der.id_etat_report = rcm.id_etat)
                    WHERE rc.etat_doc = 1";
            if($search != null) {
               	$sql .= " AND (
                				rcm.id_etat = $envoye
                                OR rcm.id_etat = $retour
                                OR rcm.id_etat = $archive
    		              )
                          AND (
                                rc.id_priorite = $faible
                                OR rc.id_priorite = $moyen
                                OR rc.id_priorite = $eleve
                          )";
    		}
            else {
                $sql .=" AND rcm.id_etat = ".self::ETAT_RETOUR;
            }

            $sql .=" ORDER BY dpr.id_priorite DESC, rc.date_modification ASC";
            return $db->executeQuery($sql);

        }catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function exist($id_discussion) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
                    FROM report_discussion
                    WHERE id_discussion = $id_discussion
                    AND etat_doc = 1";
			return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e) {
            throw new Exception('Impossible de vérifier l\'existence de la discussion');
        }
    }

    static public function getDiscussion($id_discussion) {
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT rc.titre,
                           rc.date_creation,
                           au1.login AS login_destinataire,
                           au2.login AS login_createur,
                           dpr.lib_priorite,
                           rc.id_priorite,
                           next.id_discussion AS id_next,
                           prev.id_discussion AS id_prev
					FROM report_discussion AS rc
                    INNER JOIN _adm_user AS au1 ON (au1.id_user = rc.id_user)
                    INNER JOIN _adm_user AS au2 ON (au2.id_user = rc.id_createur)
                    INNER JOIN zz_data_priorite_report AS dpr ON (rc.id_priorite = dpr.id_priorite)
                    LEFT JOIN report_discussion AS next ON (
                        next.date_modification = (
                                                SELECT MIN(date_modification)
                                                FROM report_discussion AS sub_next
                                                WHERE sub_next.id_user = rc.id_user
                                                AND sub_next.date_modification > rc.date_modification
                                            )
                    )
                    LEFT JOIN report_discussion AS prev ON (
                        prev.date_modification = (
                                                SELECT MAX(date_modification)
                                                FROM report_discussion AS sub_prev
                                                WHERE sub_prev.id_user = rc.id_user
                                                AND sub_prev.date_modification < rc.date_modification
                                            )
                    )
                    WHERE rc.id_discussion = $id_discussion";
			return($db->executeQuery($sql)->nextObject());
        }
        catch(SQLException $e) {
        	echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function getMessage($id_discussion_msg) {
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT rc.titre,
                           rcm.message,
                           rcm.date_modification,
                           rcm.date_creation,
                           au1.login AS login_createur,
                           au2.login AS login_modificateur,
                           dpr.lib_priorite,
                           rcm.lu
					FROM report_discussion AS rc,
                         report_discussion_msg AS rcm,
                         _adm_user AS au1,
                         _adm_user AS au2,
                         zz_data_priorite_report AS dpr
                    WHERE au1.id_user = rcm.id_createur
                    AND au2.id_user = rcm.id_modificateur
                    AND rcm.id_discussion = rc.id_discussion
                    AND rcm.id_discussion_msg = $id_discussion_msg
                    AND rc.id_priorite = dpr.id_priorite";
			return($db->executeQuery($sql)->nextObject());
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }


    static public function getListMessage($id_discussion) {
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT rcm.*,
                           au.login,
                           rcm.date_creation,
                           ui.pseudo,
                           etat.lib_etat_report
        			FROM report_discussion_msg AS rcm
                    INNER JOIN _adm_user AS au ON (au.id_user = rcm.id_createur AND au.etat_doc = 1)
                    INNER JOIN zz_data_etat_report AS etat ON (etat.id_etat_report = rcm.id_etat)
                    LEFT JOIN user_infos AS ui ON (ui.id_user = au.id_user AND ui.etat_doc = 1 AND ui.etat_pseudo = ".modelUser::PSEUDO_VALIDE.")
        			WHERE rcm.id_discussion = $id_discussion
        			ORDER BY rcm.date_creation ASC";
            return  $db->executeQuery($sql);
        }
        catch(SQLException $e) {
        	echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function markAsRead($id_discussion) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "UPDATE report_discussion_msg
                    SET lu = 1,
                        date_modification = ".time()."
                    WHERE id_discussion = $id_discussion
                    AND lu = 0";
            $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'écriture dans la base de données');
        }
    }
    
    static public function lockDiscussion($id_discussion) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "UPDATE report_discussion
                    SET locked = 1
                    WHERE id_discussion = $id_discussion";
			$db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur lors de la fermeture de la discussion');
        }
    }

    static public function unlockDiscussion($id_discussion) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "UPDATE report_discussion
                    SET locked = 0
                    WHERE id_discussion = $id_discussion";
			$db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur lors de la fermeture de la discussion');
        }
    }

    static public function isUnread($id_discussion) {
        try {
			$db = Annuaire::lookup(KEY_DATABASE);
			$sql = "SELECT *
					FROM report_discussion_msg AS rdm
					WHERE rdm.id_discussion = $id_discussion
					AND rdm.etat_doc = 1
					AND rdm.lu = 0";
			return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur de lecture sur la base de données');
        }
    }

	static public function updatePriorite($id_discussion, $id_priorite) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "UPDATE report_discussion
                    SET id_priorite = $id_priorite
                    WHERE id_discussion = $id_discussion";
            $db->executeQuery($sql);
        }
        catch(SQLException $e){
            throw new Exception('Erreur du changement de la priorité');
        }
    }
    static public function existMessage($id_message) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * 
					FROM report_discussion_msg 
					WHERE id_discussion = '$id_message'
					AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch (SQLException $e){
        	echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }
}

?>