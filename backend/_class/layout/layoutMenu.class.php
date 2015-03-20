<?php

class layoutMenu extends flyLayout {
	
	public function __construct($tpl_file = 'layoutMenu.tpl') {
		parent::__construct(REP_LAYOUT.$tpl_file);
		$this->parse();
	}
    
    public function parse() {
		try {
			$this->start();
			
			$db = Annuaire::lookup(KEY_DATABASE);
			
			// menu
    		$res_onglet = $db->executeQuery("SELECT af.*, ad.url_dossier, dtf.lib_type_fichier, dtf.id_type_fichier
                                            FROM _adm_fichier AS af, _adm_fichier_recursif AS afr, _adm_dossier AS ad, zz_data_type_fichier AS dtf 
                                            WHERE af.id_type_fichier = 1
                                            AND af.id_fichier = afr.id_fichier_fils
                                            AND afr.etat_doc = 1
                                            AND af.id_dossier = ad.id_dossier
                                            AND af.id_type_fichier = dtf.id_type_fichier
                                            ORDER BY afr.numero");
            foreach($res_onglet as $key_onglet => $onglet) {
                if(acces($onglet->nom_fichier)) {
                    $this->setVariable('url_onglet', REP_ROOT . $onglet->url_dossier . $onglet->nom_fichier . '.php');
                    $this->setVariable('intitule_onglet', $onglet->intitule_fichier);
                    //$this->setVariable('id_onglet', $res_onglet->index());
                    
                    // construction du sous menu
                    $res_sousmenu = $db->executeQuery("SELECT af.*, ad.url_dossier, dtf.lib_type_fichier, dtf.id_type_fichier
                                                        FROM _adm_fichier AS af, _adm_fichier_recursif AS afr, _adm_fichier AS pere, _adm_dossier AS ad, zz_data_type_fichier AS dtf
                                                        WHERE af.id_type_fichier = 2
                                                        AND afr.id_fichier_fils = af.id_fichier
                                                        AND afr.id_fichier_pere = pere.id_fichier
                                                        AND pere.intitule_fichier = '{$onglet->intitule_fichier}'
                                                        AND af.id_fichier = afr.id_fichier_fils
                                                        AND af.id_dossier = ad.id_dossier
                                                        AND af.id_type_fichier = dtf.id_type_fichier
                                                        AND afr.etat_doc = 1
                                                        ORDER BY afr.numero");
                    $this->resetList('list_sousmenu');                      
                    $this->hideBlock('sousmenu');
                    foreach($res_sousmenu as $key_sousmenu => $sousmenu) {
                        if(acces($sousmenu->nom_fichier)) {
                            $this->setVariable('url_sousmenu', REP_ROOT . $sousmenu->url_dossier . $sousmenu->nom_fichier . '.php');
                            $this->setVariable('intitule_sousmenu', $sousmenu->intitule_fichier);
                            $this->parseList('list_sousmenu');
                        }
                        $this->showBlock('sousmenu');
                    }
                    $this->parseList('list_onglet');
                }
            }

			$this->stop();
		}
		catch(flyException $e) {
			echo $e;
		}
    }
    
}

?>