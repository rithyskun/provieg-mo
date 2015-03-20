<?php

class layoutMenubar extends flyLayout {
	
    public function __construct($tpl_file = 'layoutMenubar.tpl') {
		parent::__construct(REP_LAYOUT . $tpl_file);
		$this->parse();
	}
    
	public function parse() {
        try{ 
            $this->start();			
    		$db = Annuaire::lookup(KEY_DATABASE);
    		
            $donnee = $db->executeQuery("SELECT id_fichier FROM _adm_fichier WHERE nom_fichier = '".PAGE."' AND etat_doc = 1");
            $fichier = $donnee->nextObject();
            $id_menubar = modelFile::getIdFichier(PAGE)->id_fichier;
            
            $res = modelFile::getFils($id_menubar, modelFile::TYPE_MENUBAR);
            
            if($res){
                $arrayMenubar = array();
                foreach($res as $key_menubar => $menubar){
                    if(acces($menubar->nom_fichier)) {
                        $link = explode('_', $menubar->nom_fichier );
                        $link = end($link);
                        $lang = (isset($_GET['language_code']) ? ('&language_code=' . $_GET['language_code']) : '');
                        if(isset($_GET['id'])){
							$id_item=$_GET['id'] . $lang;
						}else{
							$id_item=0;
						}
						$this->setVariable('url_menubar', PAGE . '.php?id=' .$id_item.  '&amp;choix=' . $link);
                        $this->setVariable('lib_menubar', $menubar->intitule_fichier);
                        $choix = (!isset($_GET['choix']))?((isset($choix))?$choix:$link):$_GET['choix'];
                        $this->setVariable('selected', ($link==$choix)?'class="selected"':'');
                        $arrayMenubar[$link] = $menubar->nom_fichier;
                        $this->parseList('item_menubar');
                    }                    
                }
                
                if(!isset($_GET['choix'])){
                    $id_menubar = modelFile::getIdFichier(PAGE)->id_fichier;
            		$fils = modelFile::getFils($id_menubar, modelFile::TYPE_MENUBAR);
            		foreach($fils as $key =>$fichier){
                        if(acces($fichier->nom_fichier)){   
                            $choix = end(explode('_', $fichier->nom_fichier));
                            break;
                        }
                    }
                }else{
                    $choix = $_GET['choix'];
                }
                
                if(acces($arrayMenubar[$choix])){   
                    if(isset($arrayMenubar[$choix])) {           
                        include($arrayMenubar[$choix].'.php');  
                        $this->includeFile('include', ${$arrayMenubar[$choix]});
                        $this->showBlock('block_menubar');
                    }
                }else{
                    $this->hideBlock('block_menubar');
                    //rootLayoutMonster::setMessage("Menubar: Vous n'avez pas l'accès au menubar", Message::ERROR);
                    //redirect(PAGE,'id='.$_GET['id']);
                }
            }else{                
                $this->hideBlock('block_menubar');
                //rootLayoutMonster::setMessage("Menubar: La page n'a pas de menubar fils", Message::ERROR);
                //redirect(PAGE,'id='.$_GET['id']);                                  
            }     
            $this->stop();
        }
        catch(flyException $e){
			echo $e;
		}
	}

}

?>