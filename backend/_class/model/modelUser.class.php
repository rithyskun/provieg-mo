<?php

/*
 * Classe de gestion d'un utilisateur
 * @version 20070613
 * @author Antoine Marcadet
 * @author Stéphanie Léang
 * @author Chandy modify 20081211
 */
class modelUser {

    const TYPE_HISTO_LOGIN  = 1;
    const TYPE_HISTO_ERROR  = 2;
    const TYPE_HISTO_LOGOUT = 3;
    const TYPE_HISTO_MAIL   = 4;

    const EMAIL_NON_VALIDE = 1;
    const EMAIL_VALIDE     = 2;

    const PSEUDO_NON_VALIDE = 1;
    const PSEUDO_VALIDE     = 2;

    const INVITATION_SEND   = 1;
	const INVITATION_OK     = 2;

	const ID_REPERTOIRE = 2;

    static public function insert($login, $mot_de_passe, $key_unique) {
        try {
        	$mot_de_passe = md5($mot_de_passe);
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO _adm_user(id_user, date_creation, id_createur, date_modification, id_modificateur, etat_doc,key_unique, login, mot_de_passe, etat_user)
                    VALUES ('','".time()."','{$_SESSION['id_user']}','".time()."','{$_SESSION['id_user']}','1','$key_unique','$login','$mot_de_passe',2)";
            $db->executeQuery($sql);
            return $db->lastInsertId();
        }
        catch(SQLException $e) {
            throw new Exception($e->getMessage());
        }
    }

    static public function inscription($login) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->beginTransaction();
            $key_unique   = time().rand(10000000, 99999999);
            $mot_de_passe = md5('');
            $sql = "INSERT INTO _adm_user(id_user, date_creation, id_createur, date_modification, id_modificateur, etat_doc,key_unique, login, mot_de_passe, etat_user)
                    VALUES ('','".time()."', 1,'".time()."', 1, 1, '$key_unique', '$login', '$mot_de_passe', 1)";
            $db->executeQuery($sql);
            $id = $db->lastInsertId();
            $db->commitTransaction();
            return self::getUser($id);
        }
        catch(SQLException $e){
            $db->rollbackTransaction();
            throw new Exception('Utilisateur non inséré');
        }
    }
    
    static public function user_register($login,$password) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->beginTransaction();
            $key_unique   = time().rand(10000000, 99999999);
            $mot_de_passe = md5($password);
            $sql = "INSERT INTO _adm_user(id_user, date_creation, id_createur, date_modification, id_modificateur, etat_doc,key_unique, login, mot_de_passe, etat_user)
                    VALUES ('','".time()."', 1,'".time()."', 1, 1, '$key_unique', '$login', '$mot_de_passe', 2)";
            $db->executeQuery($sql);
            $id = $db->lastInsertId();
            $db->commitTransaction();
            return self::getUser($id);
        }
        catch(SQLException $e){
            $db->rollbackTransaction();
            throw new Exception('Utilisateur non inséré');
        }
    }

    static public function validation($id_user, $password) {
        try {
        	$password = md5($password);
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "UPDATE _adm_user
                    SET etat_user = ".self::EMAIL_VALIDE.",
                        mot_de_passe = '$password'
                    WHERE id_user = $id_user";
            $db->executeQuery($sql);
            return true;
        }
        catch(SQLException $e) {
            throw new Exception('Utilisateur non inséré');
        }
    }

    static public function update($id_utilisateur, $login) {
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);

            $sql = "UPDATE _adm_user
                    SET login = '$login',
                        date_modification = '" . time() . "',
                        id_modificateur = '" . $_SESSION['id_user'] . "'

                    WHERE id_user = $id_utilisateur";
            $res = $db->executeQuery($sql);

        }
        catch(SQLException $e) {
            throw new Exception('Utilisateur non mis à jour');
        }
    }
    static public function updateLoginStutus($id_utilisateur, $login,$status) {
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);

            $sql = "UPDATE _adm_user
                    SET login = '$login',
						etat_user = '$status',
                        date_modification = '" . time() . "',
                        id_modificateur = '" . $_SESSION['id_user'] . "'

                    WHERE id_user = $id_utilisateur";
            $res = $db->executeQuery($sql);

        }
        catch(SQLException $e) {
            throw new Exception('Utilisateur non mis à jour');
        }
    }
    

    static public function updatePass($id_user, $pass){
        try{
        	$pass = md5($pass);
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE _adm_user
                    SET date_modification = '".time()."',
                        mot_de_passe = '{pass}'
                    WHERE id_user = $id_user";
            $db->prepareQuery('pass', $pass);
            $res = $db->executeQuery($sql);
        }
        catch(SQLException $e){
            throw new Exception('Utilisateur non mis à jour');
        }
    }
    static public function updateUserPass($id_user, $pass){
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE _adm_user
                    SET mot_de_passe = '$pass'
                    WHERE id_user = $id_user";
            $res = $db->executeQuery($sql);
        }
        catch(SQLException $e){
        	echo $e;
            throw new Exception('Utilisateur non mis à jour');
        }
    }

    static public function updateEtatUser($id_utilisateur, $etat_user){
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE _adm_user
                    SET etat_user = $etat_user
                    WHERE id_user = $id_utilisateur";
            $res = $db->executeQuery($sql);
        }
        catch(SQLException $e){
        	echo $e;
            throw new Exception('Utilisateur non mis à jour');
        }
    }

    static public function setLoginModif($id_user, $login_modif) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE _adm_user
                    SET login_modif = '{login_modif}',
                        id_modificateur = '{$_SESSION['id_user']}',
                        date_modification = ".time()."
                    WHERE id_user = $id_user";
            $db->prepareQuery('login_modif', $login_modif);
            $db->executeQuery($sql);
        }
        catch(SQLException $e) {
        	echo $e;
            throw new Exception('Impossible de mettre a jour la nouvelle adresse');
        }
    }

    static public function validateLoginModif($id_user) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $db->prepareQuery('id_user', $id_user);
            $sql = "SELECT login_modif, login FROM _adm_user WHERE id_user = {id_user}";
            $user = $db->executeQuery($sql)->nextObject();
            $sql = "UPDATE _adm_user
                    SET login = '{$user->login_modif}',
                        id_modificateur = {id_user},
                        date_modification = ".time()."
                    WHERE id_user = {id_user}";
            $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            echo $e;
            throw new Exception('Impossible de mettre a jour la nouvelle adresse');
        }
    }

    static public function delete($id_utilisateur){
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(false);
            $db->beginTransaction();

            $db->executeQuery("UPDATE _adm_user SET etat_doc = 0, date_modification = " . time() . ", id_modificateur = {$_SESSION['id_user']}	WHERE id_user = $id_utilisateur");
    	    $db->executeQuery("UPDATE _adm_user_groupe SET etat_doc = 0, date_modification = " . time() . ", id_modificateur = {$_SESSION['id_user']} WHERE id_user = $id_utilisateur");

            $db->commitTransaction();
        }
        catch(SQLException $e){
	        $db->rollbackTransaction();
            throw new Exception('Utilisateur non supprimé');
        }
    }

    static public function initPass($id_utilisateur){
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $reset_pass = md5('');
            $sql = "UPDATE _adm_user
                    SET mot_de_passe= '$reset_pass',
                        date_modification = " . time() . ",
                        id_modificateur = {$_SESSION['id_user']}
                    WHERE id_user = $id_utilisateur";
            $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Mot de passe non réinitialisé');
        }
    }


    static public function getUser($id_user) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT au.*, ui.nickname, deu.lib_etat_user
        			FROM _adm_user AS au
					INNER JOIN zz_data_etat_user AS deu ON (deu.id_etat_user = au.etat_user)
					LEFT JOIN user_infos AS ui ON (ui.id_createur = au.id_user AND ui.etat_doc = 1)
        			WHERE au.etat_doc = 1
                    AND au.id_user = $id_user";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e){
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function getUserMail($mail) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT au.*, deu.lib_etat_user
        			FROM _adm_user AS au, zz_data_etat_user AS deu
        			WHERE au.etat_doc = 1
        			AND au.etat_user = deu.id_etat_user
                    AND au.login = '$mail'";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e){
        	echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function getUserIdKeyUnique($id_user, $key_unique) {
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
                    FROM _adm_user
                    WHERE id_user = '{id_user}'
                    AND key_unique = '{key_unique}'";
            $db->prepareQuery('id_user', $id_user);
            $db->prepareQuery('key_unique', $key_unique);
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur');
        }
    }
    static public function getUserKeyUnique($key_unique) {
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->flushVariable();
            $sql = "SELECT *
                    FROM _adm_user
                    WHERE key_unique = '{key_unique}'";
            $db->prepareQuery('key_unique', $key_unique);
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e) {
            throw new Exception('Erreur');
        }
    }

    static public function getLogin($id_utilisateur) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT login
        			FROM _adm_user
                    WHERE id_user = $id_utilisateur";
            return $db->executeQuery($sql)->nextObject()->login;
        }
        catch(SQLException $e){
            echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function getUtilisateur($login) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
        			FROM _adm_user
                    WHERE login = '$login'
                    AND etat_doc = 1";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e){
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function getList() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT au.*,
            		(SELECT lib_etat_user
            					FROM zz_data_etat_user AS zdeu
            					WHERE zdeu.id_etat_user = au.etat_user )
            						AS lib_etat_user,
            			(SELECT nickname
            					FROM user_infos as ui
            					WHERE ui.etat_doc = 1 AND ui.id_user = au.id_user )
            						AS nickname,
            			(SELECT MAX(hc.date_connection)
            					FROM _histo_connection as hc
            					WHERE hc.login_connection = au.login )
            					AS date_connexion
            		FROM _adm_user AS au WHERE etat_doc = 1 ORDER BY au.date_creation DESC";
            return $db->executeQuery($sql);
         }
         catch(SQLException $e){ echo $e;
            throw new Exception($e->getMessage());
         }
    }


    /**
     * Retourne la liste des groupes de l'utilisateur
     * @param $id_user : l'identifiant de l'utilisateur
     */
    static public function getListGroupe($id_utilisateur){
    	try {
            $db = Annuaire::lookup(KEY_DATABASE);

    		$sql = "SELECT ag.*,aug.* FROM _adm_groupe AS ag, _adm_user_groupe AS aug
    				WHERE aug.id_user = $id_utilisateur
    				AND aug.id_groupe = ag.id_groupe
    				AND aug.etat_doc = 1
    				AND ag.etat_doc = 1";
            return $db->executeQuery($sql);
		}
        catch(SQLException $e){
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function getStat() {
        try {
            $return = array();
            $db = Annuaire::lookup(KEY_DATABASE);
            $weekago = time() - 604800;
            $dayago  = time() - 86400;
            $sql = "SELECT *
                    FROM _adm_user
                    WHERE etat_user = ".self::EMAIL_NON_VALIDE."
                    AND etat_doc = 1
                    AND date_creation >= $weekago";
            $res = $db->executeQuery($sql);
            $return['nb_week_invalid'] = $res->size();

            $sql = "SELECT *
                    FROM _adm_user
                    WHERE etat_user = ".self::EMAIL_VALIDE."
                    AND etat_doc = 1
                    AND date_creation >= $weekago";
            $res = $db->executeQuery($sql);
            $return['nb_week_valid'] = $res->size();


            $sql = "SELECT *
                    FROM _adm_user
                    WHERE etat_user = ".self::EMAIL_NON_VALIDE."
                    AND etat_doc = 1
                    AND date_creation >= $dayago";
            $res = $db->executeQuery($sql);
            $return['nb_day_invalid'] = $res->size();

            $sql = "SELECT *
                    FROM _adm_user
                    WHERE etat_user = ".self::EMAIL_VALIDE."
                    AND etat_doc = 1
                    AND date_creation >= $dayago";
            $res = $db->executeQuery($sql);
            $return['nb_day_valid'] = $res->size();

            return $return;
        }
        catch(SQLException $e) {
            throw new Exception('Erreur stats');
        }
    }

    static public function insertHisto($type, $login, $mot_de_passe = ''){
        try {
        	$db = Annuaire::lookup(KEY_DATABASE);
        	switch($type) {
        		case self::TYPE_HISTO_ERROR: // erreur de connexion
        			$mot_de_passe = normalise($mot_de_passe, 'pass');
        			break;
        		case self::TYPE_HISTO_LOGIN: // connexion
        			$mot_de_passe = normalise($mot_de_passe, 'pass');
        			break;
        	}
        	$ip = get_ip_list();
        	$db->autoCommit();
        	$sql = "INSERT INTO _histo_connection (id_connection, date_connection, login_connection, mot_de_passe_connection, ip_connection, type_connection)
        		    VALUES('','".time()."','$login','$mot_de_passe','$ip','$type')";
            $db->executeQuery($sql);
        }
        catch(SQLException $e){
        	echo $e;
		    throw new Exception('Historique non mis à jour');
        }
    }

    static public function getListDiscussion($id_user) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT rd.*
                    FROM report_discussion AS rd
                    WHERE rd.id_user = $id_user
                    AND rd.etat_doc = 1
                    ORDER BY rd.date_modification DESC";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
        	echo $e;
            throw new Exception('Erreur lors de la récupération des messages de l\'utilisateur');
        }
    }
    
    static public function getListLimitDiscussion($id_user, $limit) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT rd.*
                    FROM report_discussion AS rd
                    WHERE rd.id_user = $id_user
                    AND rd.etat_doc = 1
                    ORDER BY rd.date_modification DESC
					LIMIT $limit";
            return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
        	echo $e;
            throw new Exception('Erreur lors de la récupération des messages de l\'utilisateur');
        }
    }

    static public function getListPseudoAttente() {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT ui.pseudo, au.login, au.id_user
                    FROM user_infos AS ui, _adm_user AS au
                    WHERE ui.etat_pseudo = ".self::PSEUDO_NON_VALIDE."
                    AND ui.id_user = au.id_user
                    AND ui.pseudo <> ''
                    AND ui.etat_doc = 1
					AND au.etat_doc = 1";
			return $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur de récupération de la liste des pseudos en attentes');
        }
    }


    static public function exist($id_utilisateur) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT id_user FROM _adm_user WHERE id_user = $id_utilisateur AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null); //Renvoi true si le user existe false sinon (renvoi le resultat du test)
        }
        catch(SQLException $e){
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }


    static public function existLogin($login, $etat_user = null) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT login FROM _adm_user AS u WHERE login = '$login' AND etat_doc = 1";
            if($etat_user != null)
                $sql .= " AND etat_user = $etat_user";
            return ($db->executeQuery($sql)->nextObject() != null); //Renvoi true si le user existe false sinon (renvoi le resultat du test)
        }
        catch (SQLException $e){
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function existLoginModif($login, $id_utilisateur) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT login FROM _adm_user WHERE login = '$login' AND etat_doc = 1 AND id_user <> $id_utilisateur";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e){
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function verifPass($pass){
        try {
        	$pass = md5($pass);
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT * FROM _adm_user WHERE id_user = {$_SESSION['id_user']} AND mot_de_passe = '$pass'";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e){
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function existUtilisateur($id_utilisateur, $key) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT login FROM _adm_user AS u WHERE id_user = '$id_utilisateur' AND etat_doc = 1 AND key_unique='$key'";
            return ($db->executeQuery($sql)->nextObject() != null); //Renvoi true si le user existe false sinon (renvoi le resultat du test)
        }
        catch (SQLException $e){ echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }

    static public function verifPassUtilisateur($login, $pass){
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT login FROM _adm_user AS u WHERE login = '$login' AND etat_doc = 1 AND etat_user = 2 AND mot_de_passe = '$pass'";
            return ($db->executeQuery($sql)->nextObject() != null); //Renvoi true si le user existe false sinon (renvoi le resultat du test)
        }
        catch (SQLException $e){ echo $e;
            throw new Exception('Erreur d\'accès à la base de données');
        }
    }


    /** Retourne le profil des utilisateurs **/
    static public function getProfil($id_user) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "SELECT ui.*, au.*, 
						(SELECT c.nom_pays_fr FROM zz_data_country AS c WHERE ui.id_pays = c.id_pays)AS nom_pays_fr,
						(SELECT c.nom_pays_en FROM zz_data_country AS c WHERE ui.id_pays = c.id_pays)AS nom_pays_en
                    FROM _adm_user AS au
                    LEFT JOIN user_infos AS ui ON (ui.id_user = $id_user AND ui.etat_doc = 1)
                    WHERE au.id_user = $id_user";
            return $db->executeQuery($sql)->nextObject();
         }
         catch(SQLException $e){
            throw new Exception('Erreur d\'accès à la base de données');
         }
    }

    static public function hasPseudo($id_user) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
                    FROM user_infos
                    WHERE id_user = $id_user
                    AND etat_pseudo = ".modelUser::PSEUDO_VALIDE;
            $res = $db->executeQuery($sql)->nextObject();
            return ($res->pseudo and $res->pseudo != null);
        }
        catch(SQLException $e) {
            throw new Exception('Impossible de vérifier si le membre a un pseudo');
        }
    }

    static public function validePseudo($id_user) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "UPDATE user_infos
                    SET etat_pseudo = ".self::PSEUDO_VALIDE.",
                        date_modification = ".time()."
					WHERE id_user = $id_user
					AND etat_doc = 1";
			$db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur lors de la validation du pseudo');
        }
    }
    static public function refusePseudo($id_user) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "UPDATE user_infos
                    SET etat_pseudo = '',
                        date_modification = ".time().",
                        pseudo = ''
					WHERE id_user = $id_user
					AND etat_doc = 1";
			$db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur lors de la validation du pseudo');
        }
    }



    static public function hasNewMessage($id_user) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT DISTINCT rd.id_discussion
                    FROM report_discussion_msg AS rdm, report_discussion AS rd
                    WHERE rd.id_user = $id_user
                    AND rdm.id_discussion = rd.id_discussion
                    AND rdm.lu = 0";
            return ($db->executeQuery($sql)->size());
        }
        catch(SQLException $e) {
        	echo $e;
            throw new Exception('Erreur lors de la mise a jour du nombre de messages non lus');
        }
    }


	static public function connexionMonster($login, $pass) {
	    self::connexion($login, $pass);
	    $_SESSION['__MONSTER__'] = true;
	}

    static public function connexion($login, $pass) {
    	try {
    		$pass = md5($pass);
            $db = Annuaire::lookup(KEY_DATABASE);
        	$sql = "SELECT au.id_user, login, etat_user, key_unique, ui.nickname
        			FROM _adm_user AS au
        			LEFT JOIN user_infos AS ui ON (ui.id_user = au.id_user AND ui.etat_doc = 1)
        			WHERE login = '{login}'
        			AND mot_de_passe = '{pass}'
        			AND au.etat_doc <> 0";
        	$db->prepareQuery('login', $login);
        	$db->prepareQuery('pass',  $pass);
        	$user = $db->executeQuery($sql)->nextObject();
        	if($user) {
        		$res = $db->executeQuery($sql)->nextObject();
        		if(isset($_SESSION['id_user'])) {
                    session_unset();
                	session_destroy();
                	session_start();
                }
                $_SESSION['id_user'] = $user->id_user;
        		$_SESSION['login'] = $user->login;
        		$_SESSION['pseudo'] = ($user->nickname)?$user->nickname:false;
        		$_SESSION['heure'] = date("H:i:s");
        		$_SESSION['new_message'] = self::hasNewMessage($user->id_user);
        		setPrivileges();
        		self::insertHisto(modelUser::TYPE_HISTO_LOGIN, $user->login, $pass);
        	}
        	else {
        		self::insertHisto(modelUser::TYPE_HISTO_ERROR, $login, $pass);
        	    throw new Exception('Unable to login , please try again');
        	}
        }
        catch(SQLException $e) {
            throw new Exception('Error when connecting');
        }
    }

    static public function connexionMail($login) {
    	try {
            if(isset($_SESSION['id_user'])) {
                session_unset();
            	session_destroy();
            	session_start();
            }
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT au.*, ui.pseudo, ui.etat_pseudo
                    FROM _adm_user AS au
                    LEFT JOIN user_infos AS ui ON (ui.id_user = au.id_user AND ui.etat_doc = 1)
                    WHERE au.login = '{login}'";
            $db->prepareQuery('login', $login);
            $user = $db->executeQuery($sql)->nextObject();
    		$_SESSION['id_user'] = $user->id_user;
    		$_SESSION['login'] = $user->login;
    		$_SESSION['pseudo'] = ($user->pseudo)?$user->pseudo:false;
    		$_SESSION['heure'] = date("H:i:s");
    		setPrivileges();
    		modelUser::insertHisto(self::TYPE_HISTO_MAIL, $user->login);
        }
        catch(SQLException $e) {
            throw new Exception('Erreur lors de la connexion');
        }
    }

    static public function newInvitation($id_user, $email) {
        try {
            if(self::getUserMail($email)) return false;
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit();
            $sql = "SELECT *
                    FROM user_invitation
                    WHERE email_invitation = '$email'
					AND etat_doc = 1";
			$res = $db->executeQuery($sql);
			if($res->size() != 0) {
			    return false;
			}
            $key_unique = time().rand(10000000, 99999999);
            $sql = "INSERT INTO user_invitation(id_invitation, date_creation, id_createur, date_modification, id_modificateur, etat_doc, email_invitation, key_unique, etat_invitation)
                    VALUES ('','".time()."','{$id_user}','".time()."','{$id_user}','1','{$email}','{$key_unique}','".self::INVITATION_SEND."')";
			$db->executeQuery($sql);
			return $key_unique;
        }
		catch(SQLException $e) {
		    throw new Exception('Erreur lors de la création de l\'invitation');
		}
    }

    static public function getInvitation($clef) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT email_invitation AS mail_invitation, au.login AS mail_parrain
                    FROM user_invitation AS inv, _adm_user AS au
                    WHERE inv.key_unique = '$clef'
					AND inv.etat_invitation = ".self::INVITATION_SEND."
					AND inv.id_createur = au.id_user
					AND inv.etat_doc = 1
					AND au.etat_doc = 1";
			return $db->executeQuery($sql)->nextObject();
        }
		catch(SQLException $e) {
		    throw new Exception('Erreur lors de la création de l\'invitation');
		}
    }

    static public function acceptInvitation($mail_inscription) {
		try {
		    $db = Annuaire::lookup(KEY_DATABASE);
		    $sql = "UPDATE user_invitation
		            SET etat_invitation = ".self::INVITATION_OK."
					WHERE email_invitation = '$mail_inscription'";
    		$db->executeQuery($sql);
            $sql = "SELECT email_invitation AS mail_invitation, au.login AS mail_parrain, au.id_user AS id_parrain
                    FROM user_invitation AS inv, _adm_user AS au
                    WHERE inv.email_invitation = '$mail_inscription'
					AND inv.id_createur = au.id_user
					AND inv.etat_doc = 1
					AND au.etat_doc = 1";
			$invitation = $db->executeQuery($sql)->nextObject();
			if($invitation) {
	            //-- création du message -----------------------------------------//
				$titre   = 'Votre ami(e) "'.$invitation->mail_invitation.'" a accepté votre invitation';
				$message = 'Bonjour,'."\n\n";
				$message.= 'Votre ami(e) "'.$invitation->mail_invitation.'" a accepté votre invitation.'."\n";
				$message.= 'Votre pourrez maintenant partager votre passion avec lui/elle.'."\n\n";
				$message.= "\n".'--'."\n";
				$message.= 'L\'équipe de www.likachef.com';
		        modelReportingDiscussion::newDiscussion($titre, $message, $invitation->id_parrain);
	   			//----------------------------------------------------------------//
   			}
		}
		catch(SQLException $e) {
		    throw new Exception('Erreur lors de l\'acceptation de la l\'invitation');
		}
    }

	static public function getListHisto($id_utilisateur) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT hc.*, dtc.lib_type_connection AS type_connection
        			FROM _histo_connection AS hc, _adm_user AS au, zz_data_type_connection AS dtc
        			WHERE au.id_user = $id_utilisateur
        			AND au.login = hc.login_connection
        			AND hc.type_connection = dtc.id_type_connection
                    ORDER BY hc.date_connection DESC";
            return $db->executeQuery($sql);
		}
        catch(SQLException $e){
		    throw new Exception('Erreur d\'accès à la base de données');
        }
    }
    
    static public function getUserInfo($id_user) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT ui.*, 
            				(SELECT z.country FROM zz_data_country AS z WHERE z.id_country = ui.id_country AND z.etat_doc = 1) AS country
					FROM user_infos AS ui
            		WHERE ui.id_user = $id_user
            		AND ui.etat_doc = 1";
            return $db->executeQuery($sql)->nextObject();
        }
        catch(SQLException $e){
        	throw new Exception($e->getMessage());
        }
    }

    static public function existUserInfo($id_user) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
            		FROM user_infos
        			WHERE etat_doc = 1
                    AND id_user = '$id_user'";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e){
            throw new Exception($e->getMessage());
        }
    }
    
    static public function hasNickname($nickname) {
        try {
            $db = Annuaire::lookup(KEY_DATABASE);
            $sql = "SELECT *
            		FROM user_infos
        			WHERE nickname = '$nickname'
                    AND etat_doc = 1";
            return ($db->executeQuery($sql)->nextObject() != null);
        }
        catch(SQLException $e){
            throw new Exception($e->getMessage());
        }
    }

    static public function updateUserInfos($id_user, $nickname, $first_name, $last_name, $city, $id_country, $zip_code, $address1, $address2) {
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "UPDATE user_infos
                    SET
                        date_modification = '" . time() . "',
                        id_modificateur = '" . $_SESSION['id_user'] . "',
                        nickname = '$nickname',
                        first_name = '$first_name',
                        last_name = '$last_name',
                        city = '$city',
                        id_country = '$id_country',
                        zip_code = '$zip_code',
                        address1 = '$address1',
                        address2 = '$address2'
                    WHERE id_user = $id_user";
            $res = $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    static public function insertUserinfos($id_user, $nickname, $first_name, $last_name, $city, $id_country, $zip_code, $address1, $address2){
        try{
            $db = Annuaire::lookup(KEY_DATABASE);
            $db->autoCommit(true);
            $sql = "INSERT INTO user_infos(date_creation, id_createur, date_modification, id_modificateur, etat_doc, id_user, nickname, first_name, last_name, city, id_country, zip_code, address1, address2)
						VALUES (
							'".time()."',
							'{$_SESSION['id_user']}',
							'".time()."',
							'{$_SESSION['id_user']}',
							'1',
							'$id_user',
							'$nickname',
							'$first_name',
							'$last_name',
							'$city',
							'$id_country',
							'$zip_code',
							'$address1',
							'$address2'
						)";
			$res = $db->executeQuery($sql);
        }
        catch(SQLException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
	static public function getLiStetatUser() {
	
	    try {
	        $db = Annuaire::lookup(KEY_DATABASE);
	        $sql = "SELECT *
	                FROM zz_data_etat_user
	                ORDER BY id_etat_user DESC";
	        return $db->executeQuery($sql);
	    }
	    catch(SQLException $e) {
	        throw new Exception($e->getMessage());
	    }   
	}
	
}
?>