<?php

class modelLanguage {
	
	const DEFAULT_EN = 'en';
	
	static public function insert($visible, $language_name, $language_code, $country_code) {
		try {
			$db = Annuaire::lookup ( KEY_DATABASE );
            $db->autoCommit(true);
            $sql = "INSERT INTO language (id_createur, date_creation, id_modificateur, date_modification, status, visible, language_name, language_code, country_code)
					VALUES ('{$_SESSION['id_user']}', '".time()."', '{$_SESSION['id_user']}', '".time()."', '1', $visible, '$language_name', '$language_code', '$country_code')";
            $db->executeQuery($sql);
            $id = $db->lastInsertId();
			return $id;
		} catch ( SQLException $e ) {
			throw new SQLException ( $e->getMessage () );
		}
	}
	
	static public function update($id, $visible, $language_name, $language_code, $country_code) {
		try {
			$db = Annuaire::lookup ( KEY_DATABASE );
			$db->autoCommit ( true );
			$sql = "UPDATE language
					SET date_modification = '" . time () . "',
					id_modificateur = '{$_SESSION['id_user']}',
					visible = $visible, 
					language_name = '$language_name',
					language_code = '$language_code',
					country_code = '$country_code'
					WHERE id = $id
					AND status = 1";
			$db->executeQuery ( $sql );
		} catch ( SQLException $e ) {
			throw new SQLException ( $e->getMessage () );
		}
	}
	
	static public function delete($id) {
		try {
			$db = Annuaire::lookup ( KEY_DATABASE );
			$db->autoCommit ( true );
			$sql = "UPDATE language
					SET date_modification = '" . time () . "',
						id_modificateur = '{$_SESSION['id_user']}',
						status = 0
					WHERE id = $id
					AND status = 1";
			$db->executeQuery ( $sql );
		} catch ( SQLException $e ) {
			throw new SQLException ( $e->getMessage () );
		}
	}
	
	static public function getList() {
		try {
			$db = Annuaire::lookup ( KEY_DATABASE );
			$sql = "SELECT *
					FROM language
					WHERE status = 1";
			return $db->executeQuery ( $sql );
		} catch ( SQLException $e ) {
			throw new SQLException ( $e->getMessage () );
		}
	}
	
	static public function get($id) {
		try {
			$db = Annuaire::lookup ( KEY_DATABASE );
			$sql = "SELECT *
					FROM language
					WHERE id = $id
					AND status = 1";
			return $db->executeQuery ( $sql )->nextObject();
		} catch ( SQLException $e ) {
			throw new SQLException ( $e->getMessage () );
		}
	}
	
	static public function has($id) {
		try {
			$db = Annuaire::lookup ( KEY_DATABASE );
			$sql = "SELECT *
					FROM language
					WHERE id = $id
					AND status = 1";
			return $db->executeQuery ( $sql )->nextObject() != null;
		} catch ( SQLException $e ) {
			throw new SQLException ( $e->getMessage () );
		}
	}
	
	static public function exist($language_name) {
		try {
			$db = Annuaire::lookup ( KEY_DATABASE );
			$sql = "SELECT *
					FROM language
					WHERE language_name = '$language_name'
					AND status = 1";
			return $db->executeQuery ( $sql )->nextObject() != null;
		} catch ( SQLException $e ) {
			throw new SQLException ( $e->getMessage () );
		}
	}
	
	static public function getAvaiableLanguage($product_id) {
		try {
			$db = Annuaire::lookup ( KEY_DATABASE );
			$sql = "SELECT l.*
					FROM language AS l
					WHERE l.language_code NOT IN(SELECT pt.language_code FROM product_translate AS pt WHERE pt.product_id = $product_id AND pt.status = 1)
					AND l.status = 1
					AND l.visible = 1";
			return $db->executeQuery ( $sql );
		} catch ( SQLException $e ) {
			throw new SQLException ( $e->getMessage () );
		}
	}
	
	static public function getBootstrapFormHelperMultiLang() {
		try {
			$db = Annuaire::lookup ( KEY_DATABASE );
			$sql = "SELECT GROUP_CONCAT(language_code, '_', country_code) AS multi_lang
					FROM language
					WHERE status = 1
					AND visible = 1";
			$res = $db->executeQuery($sql)->nextObject();
			return ($res != null ? $res->multi_lang : modelLanguage::DEFAULT_EN);
		} catch ( SQLException $e ) {
			throw new SQLException ( $e->getMessage () );
		}
	}
	
	static public function getPatternSupportLanguageCode() {
		try {
			$db = Annuaire::lookup ( KEY_DATABASE );
			$sql = "SELECT CONCAT('^(', REPLACE(GROUP_CONCAT(language_code), ',', '|'), ')$') AS pattern
					FROM language
					WHERE status = 1
					AND visible = 1";
			$res = $db->executeQuery($sql)->nextObject();
			return ($res != null ? $res->pattern : ('^'.modelLanguage::DEFAULT_EN.'$'));
		} catch ( SQLException $e ) {
			throw new SQLException($e->getMessage ());
		}
	}

	static public function getActivated($language_code) {
		try {
			$db = Annuaire::lookup ( KEY_DATABASE );
			$sql = "SELECT CONCAT(language_code, '_', country_code) AS lang
					FROM language
					WHERE language_code = '$language_code'
					AND status = 1
					AND visible = 1";
			return $db->executeQuery ( $sql )->nextObject ()->lang;
		} catch ( SQLException $e ) {
			throw new SQLException ( $e->getMessage () );
		}
	}
	
}

?>