<?php

class layoutPagination extends flyLayout {

    private $nb_element;
    private $list;
	private $urlPage;
	private $numPage;
	private $nbPage;
	
	public function __construct($tpl_file = 'layoutPagination.tpl') {
		parent::__construct(REP_LAYOUT.$tpl_file);
		$this->urlPage = '';
	}
	
	public function setList(&$list) {
	    $this->list = $list;
        $this->nb_element = $list->size();
    }
    
	public function setDisplay($nb_display) {
        $this->nbPage = ceil($this->nb_element / $nb_display);
    	$this->numPage = (isset($_GET['page']))?(($_GET['page'] > $this->nbPage)?$this->nbPage:$_GET['page']):1;
        $this->list->setLimit($nb_display*($this->numPage-1), $nb_display);
    }
    
    public function parse() {
		try {
			$this->start();
            
            if($_SERVER['QUERY_STRING']) {
                $query_string = preg_replace('!&page=[0-9]+!', '', $_SERVER['QUERY_STRING']);
                $this->urlPage = $query_string.'&'.$this->urlPage;
            }
            
            $url = '?'.$this->urlPage.'page=%d';
            
            
            if($this->nbPage > 1) {
            
                if($this->numPage > 1) {
                    $this->setVariable('url_page', sprintf($url, 1));
                    $this->setVariable('lien_page', '<<');
                    $this->parseList('list_page');    
                    $this->setVariable('url_page', sprintf($url, $this->numPage-1));
                    $this->setVariable('lien_page', '<');
                    $this->parseList('list_page');
                }
                
                for($i = 1 ; $i <= $this->nbPage ; $i++) {
                    $this->setVariable('url_page', sprintf($url, $i));
                    $this->setVariable('lien_page', $i);
                    $this->setVariable('type_lien', ($this->numPage==$i)?'current':'');
                    $this->parseList('list_page');
                }
    
                if($this->numPage < $this->nbPage) {
                    $this->setVariable('url_page', sprintf($url, $this->numPage+1));
                    $this->setVariable('lien_page', '>');
                    $this->parseList('list_page');    
                    $this->setVariable('url_page', sprintf($url, $this->nbPage));
                    $this->setVariable('lien_page', '>>');
                    $this->parseList('list_page');
                }

                $this->showBlock('pagination');
            }

			$this->stop();
		}
		catch(flyException $e) {
			echo $e;
		}
    }    
}

?>