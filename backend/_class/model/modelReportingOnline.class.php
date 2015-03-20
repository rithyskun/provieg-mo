<?php

/**
 * Classe de gestion des utilisateurs connectés
 * @author Antoine Marcadet
 * @version 20070625
 */
class modelReportingOnline {

    static public function registerOnline() {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);        	
            $sql = "SELECT * FROM report_online WHERE id_createur = {$_SESSION['id_user']}";
        	$res = $db->executeQuery($sql);
        	$db->autoCommit();
            if($res->size() != 0) {        	   
        		$sql = "UPDATE report_online
                    				SET date_modification = '".time()."', 
                                        page = '{$_SERVER['REQUEST_URI']}'
                    				WHERE id_createur = {$_SESSION['id_user']}";
        	}
        	else {
        		$sql = "INSERT INTO report_online(id, id_createur, date_creation, id_modificateur, date_modification, etat_doc, page)
        				VALUES ('','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','".time()."','1','{$_SERVER['REQUEST_URI']}')";
            }     
            $db->executeQuery($sql);   	
        }
        catch(SQLException $e) {
            throw new Exception('Impossible de mettre à jour la page visitée.');
        }
    }
    
    static public function listOnline() {
        try {
            $db  = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT au.id_user, au.login, ro.page, ro.date_modification AS date
                    FROM _adm_user AS au
                    INNER JOIN report_online AS ro ON (
                            ro.id_createur = au.id_user 
                        AND ro.date_modification > ".(time() - (20*60))."
                    )
                    WHERE au.etat_doc = 1";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            echo $e;
            throw new Exception('Erreur d\'acces au données');
        }
    }
}

?>