<?php

class layoutBanner extends flyLayout {
	
	protected $fly;

	public function __construct($tpl_file = 'layoutBanner.tpl') {
		parent::__construct(REP_LAYOUT.$tpl_file);
	}

	public function parse() {
		try {
			$this->start();
			$listPhoto = modelUploadFile::getListBanner();
			foreach ($listPhoto as $photo) {
				$this->setVariable('url_image', ($photo->url_repertoire . $photo->nom_serveur));
				$this->setVariable('title', $photo->titre);
				$this->setVariable('description', $photo->description);
				$isTitle = !empty($photo->titre) ? true : false;
				$isDesc = !empty($photo->description) ? true : false;
				$isTitle ? $this->showBlock('b-title') : $this->hideBlock('b-title');
				$isDesc ? $this->showBlock('b-desc') : $this->hideBlock('b-desc');
				$this->parseList('list');
			}
	       	$this->stop();
		}catch(flyException $e) {
			echo $e;
		}
    }
    
	public function display(){
		try{
			$this->fly->start();
			$this->parse ();
			$this->fly->stop();
		}
		catch(flyException $e) {
			echo $e;
		}
		echo $this->fly;
	}
    
}

?>