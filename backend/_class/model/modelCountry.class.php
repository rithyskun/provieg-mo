<?php

class modelCountry {
	
	static public function getList() {
		try {
			$db = Annuaire::lookup ( KEY_DATABASE );
			$sql = "SELECT *
					FROM zz_data_country
					WHERE etat_doc = 1";
			return $db->executeQuery ( $sql );
		} catch ( SQLException $e ) {
			throw new Exception ( $e->getMessage () );
		}
	}
	
}

?>