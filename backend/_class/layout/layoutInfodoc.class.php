<?php

class layoutInfodoc extends flyLayout {

    private $objet;	
	
	public function __construct($tpl_file = 'layoutInfodoc.tpl') {
		parent::__construct(REP_LAYOUT.$tpl_file);		
	}	
	public function setObjet($objet) {
	    $this->objet = $objet;
    }
        
    public function parse() {
		try {
			$this->start();
            $this->setVariable('date_creation', affiche($this->objet->date_creation,'date'));
            $this->setVariable('heure_creation', affiche($this->objet->date_creation,'heure'));
            $this->setVariable('date_modification', affiche($this->objet->date_modification,'date'));
            $this->setVariable('heure_modification', affiche($this->objet->date_modification,'heure'));
            $this->setVariable('login_createur', modelUser::getLogin($this->objet->id_createur));
            $this->setVariable('login_modificateur', modelUser::getLogin($this->objet->id_modificateur));
			$this->stop();
		}
		catch(flyException $e) {
			echo $e;
		}
    }
    
}

?>