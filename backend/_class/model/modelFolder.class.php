<?php

/**
 * Classe de gestion des dossiers
 * @version 20070625
 * @author Antoine Marcadet 
 */
class modelFolder {

    static public function getList() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            return $db->executeQuery("SELECT * FROM _adm_dossier ORDER BY url_dossier");
        }
        catch(SQLException $e) {
            throw new Exception('Erreur d\'accès à la base de données');
        }   
    }
}

?>