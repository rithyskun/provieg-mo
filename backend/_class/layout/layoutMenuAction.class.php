<?php

class layoutMenuAction extends flyLayout {

	public function __construct($tpl_file = 'layoutMenuAction.tpl') {
		parent::__construct(REP_LAYOUT.$tpl_file);
		$this->parse();
	}

    public function parse() {
		try {
			$this->start();

            $id_fichier = modelFile::getIdFichier(PAGE)->id_fichier;
            $res = modelFile::getFils($id_fichier, modelFile::TYPE_ACTION);

			if($res->size()) {
                foreach($res as $k => $fichier) {
                    if(acces($fichier->nom_fichier)) {
                    	$lang = (isset($_GET['language_code']) ? ('&language_code=' . $_GET['language_code']) : '');
                        $param = (isset($_GET['id']) ? ('?id=' . $_GET['id']) : '') . $lang;
                        $this->setVariable('url_action', REP_ROOT . $fichier->url_dossier . $fichier->nom_fichier . '.php' . $param);
                        $this->setVariable('lib_action', $fichier->intitule_fichier);
                        $this->setVariable('url_image_action', REP_IMG . $fichier->url_adm_image_fichier);
                        $this->parseList('action');
                    }
                }
                $this->showBlock('action');
            }
            
			$this->stop();
		}
		catch(flyException $e) {
			echo $e;
		}
    }

}

?>