<?php

class layoutHeader extends flyLayout {
	
	public function __construct($tpl_file = 'layoutHeader.tpl') {
		parent::__construct(REP_LAYOUT.$tpl_file);
		$this->parse();
	}
    
    public function parse() {
		try {
			$this->start();
			$this->setVariable('login', $_SESSION['login']);
			$this->setVariable('logtime', $_SESSION['heure']);
            $this->setVariable('rep_root', REP_ROOT);            
            $id_fichier_courant = modelFile::getIdFichier(PAGE)->id_fichier;
            $pere = modelFile::getPere($id_fichier_courant)->nextObject();
			while($pere) {
				$id_item = $pere->id_type_fichier==modelFile::TYPE_DETAIL?'?id='.$_GET['id']:'';
                $this->setVariable('url_fichier', $pere->url_dossier . $pere->nom_fichier . '.php'.$id_item);
                $this->setVariable('intitule_fichier', $pere->intitule_fichier);
                $this->parseReverseList('fil');
                $pere = modelFile::getPere($pere->id_fichier)->nextObject();
            }
            $fichier_courant = modelFile::getFichier($id_fichier_courant);
            $this->setVariable('intitule_fichier_courant', $fichier_courant->intitule_fichier);
			$this->stop();
		}
		catch(flyException $e) {
			echo $e;
		}
    }
    
}

?>