<?php

/**
 * Affiche la liste des familles
 * @author Antoine Marcadet
 * @version 20071001
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

	$object = new flyLayout(REP_TPL_AJAX . 'navigation/navigation_category_product_search.tpl');	
	$object->start();
	
	$name_search = trim($_POST['name_search']);
	(isset($_SESSION['recherche']))?$listLevel1 = modelCategoryProduct::children_cat(modelCategoryProduct::root()->id_famille_arbo,null, $_SESSION['recherche']):$listLevel1 = modelCategoryProduct::children_cat(modelCategoryProduct::root()->id_famille_arbo);
	$level1_parsed = false;
	if($listLevel1->size() > 0){
		$index_all = 0;
	    foreach($listLevel1 as $key => $level1){
	    	$index_all++;
			
	        $object->setVariable('nom_famille_1', $level1->nom_famille);
			$object->setVariable('url_category_1', 'navigation_rubrique_detail.php?id=' . $level1->language_link);
			$object->setVariable('visible_1', $level1->visible == 1?VISIBLE:INVISIBLE);
			
			$listLanguage = modelLanguage::getListRemainLanguage($level1->language_link, 'navigation_rubrique');
			if($listLanguage->size()>0) {
				$object->resetList('list_image_flag_1');
				foreach($listLanguage as $key => $language) {
					$object->setVariable('flag_name_1', $language->name);
					$object->setVariable('url_flag_1', URL_FLAG . $language->flag);
				    $object->parseList('list_image_flag_1');
				}
			}else {
				$object->resetList('list_image_flag_1');
				$object->setVariable('flag_name_1', 'Ok');
				$object->setVariable('url_flag_1', REP_FRONT_DESIGN . 'accept.gif');
			    $object->parseList('list_image_flag_1');
			}
			
			
		    $object->setVariable('category_class_1','class="page_visible"');
		    
	    	(isset($_SESSION['recherche']))?$listLevel2 = modelCategoryProduct::children_cat($level1->id_famille_arbo,null, $_SESSION['recherche']):$listLevel2 = modelCategoryProduct::children_cat($level1->id_famille_arbo); 
	      
	        $object->resetList('niveau_2');
	        $level2_parsed = false;
	        foreach($listLevel2 as $key => $level2){
	    		$index_all++;
				
	            $object->setVariable('nom_famille_2', $level2->nom_famille);			
	
			    $object->setVariable('url_category_2', 'navigation_rubrique_detail.php?id=' . $level2->language_link);
	            $object->setVariable('visible_2', $level2->visible == 1?VISIBLE:INVISIBLE);
	            	$listLanguage = modelLanguage::getListRemainLanguage($level2->language_link, 'navigation_rubrique');
					if($listLanguage->size()>0) {
						$object->resetList('list_image_flag_2');
						foreach($listLanguage as $key => $language) {
							$object->setVariable('flag_name_2', $language->name);
							$object->setVariable('url_flag_2', URL_FLAG . $language->flag);
						    $object->parseList('list_image_flag_2');
						}
					}else {
						$object->resetList('list_image_flag_2');
						$object->setVariable('flag_name_2', 'Ok');
						$object->setVariable('url_flag_2', REP_FRONT_DESIGN . 'accept.gif');
					    $object->parseList('list_image_flag_2');
					}
	
	            $object->setVariable('category_class_2', $level2->visible == 1?'class="page_visible"':'class="page_invisible"'); 	            
	
	            (isset($_SESSION['recherche']))?$listLevel3 = modelCategoryProduct::children_cat($level2->id_famille_arbo,null, $_SESSION['recherche']):$listLevel3 = modelCategoryProduct::children_cat($level2->id_famille_arbo);    
	
	            $object->resetList('niveau_3');
				$level3_parsed = false;
	            foreach($listLevel3 as $key => $level3){
	    			$index_all++;
					
	                $object->setVariable('nom_famille_3', $level3->nom_famille);
	    		    $object->setVariable('url_category_3', 'navigation_rubrique_detail.php?id=' . $level3->language_link);
	                $object->setVariable('visible_3', $level3->visible == 1?VISIBLE:INVISIBLE);
	                	$listLanguage = modelLanguage::getListRemainLanguage($level3->language_link, 'navigation_rubrique');
						if($listLanguage->size()>0) {
							$object->resetList('list_image_flag_3');
							foreach($listLanguage as $key => $language) {
								$object->setVariable('flag_name_3', $language->name);
								$object->setVariable('url_flag_3', URL_FLAG . $language->flag);
							    $object->parseList('list_image_flag_3');
							}
						}else {
							$object->resetList('list_image_flag_3');
							$object->setVariable('flag_name_3', 'Ok');
							$object->setVariable('url_flag_3', REP_FRONT_DESIGN . 'accept.gif');
						    $object->parseList('list_image_flag_3');
						} 
	
	                $object->setVariable('category_class_3', $level3->visible == 1?'class="page_visible"':'class="page_invisible"');
	
	                $object->resetList('niveau_4');
	
	                (isset($_SESSION['recherche']))?$listLevel4 = modelCategoryProduct::children_cat($level3->id_famille_arbo,null, $_SESSION['recherche']):$listLevel4 = modelCategoryProduct::children_cat($level3->id_famille_arbo);
					//reset for next record
					$level4_parsed = false;
	                foreach($listLevel4 as $key => $level4){
	    				$index_all++;
						
	                    $object->setVariable('nom_famille_4', $level4->nom_famille);
	        		    $object->setVariable('url_category_4', 'navigation_rubrique_detail.php?id=' . $level4->language_link);
	        		    $object->setVariable('visible_4', $level4->visible == 1?VISIBLE:INVISIBLE);
	        		    	$listLanguage = modelLanguage::getListRemainLanguage($level4->language_link, 'navigation_rubrique');
							if($listLanguage->size()>0) {
								$object->resetList('list_image_flag_4');
								foreach($listLanguage as $key => $language) {
									$object->setVariable('flag_name_4', $language->name);
									$object->setVariable('url_flag_1', URL_FLAG . $language->flag);
								    $object->parseList('list_image_flag_4');
								}
							}else {
								$object->resetList('list_image_flag_4');
								$object->setVariable('flag_name_4', 'Ok');
								$object->setVariable('url_flag_4', REP_FRONT_DESIGN . 'accept.gif');
							    $object->parseList('list_image_flag_4');
							} 
	
	        		     $object->setVariable('category_class_4', $level4->visible == 1?'class="page_visible"':'class="page_invisible"'); 
	
				        preg_match('/'.strtolower(removeAccents($name_search)).'/', strtolower(removeAccents($level4->nom_famille)), $matches);
						if($matches[0] || $name_search==""){
		                    $object->parseList('niveau_4');
		                    $level4_parsed = true;
		                }
	                } 
			        preg_match('/'.strtolower(removeAccents($name_search)).'/', strtolower(removeAccents($level3->nom_famille)), $matches);
					if(($level4_parsed==true) || $matches[0] || $name_search==""){
		                $object->parseList('niveau_3');
		                $level3_parsed = true;
	                }
	            }
		        preg_match('/'.strtolower(removeAccents($name_search)).'/', strtolower(removeAccents($level2->nom_famille)), $matches);
				if(($level3_parsed==true) || $matches[0]!="" || $name_search==""){
		            $object->parseList('niveau_2');
		            $level2_parsed = true;
	            }
	        }
	        preg_match('/'.strtolower(removeAccents($name_search)).'/', strtolower(removeAccents($level1->nom_famille)), $matches);
			if($level2_parsed==true || $matches[0]!="" || $name_search==""){
				$object->parseList('niveau_1');
				$level1_parsed = true;
			}
	  	}
	  	if($level1_parsed==true)$object->showBlock('inTree');
	}
	
  	$listLevelNotLinked = modelCategoryProduct::noLinked_tree($_SESSION['recherche'],$_POST['name_search']);  	
  	if($listLevelNotLinked->size() > 0){
  		foreach($listLevelNotLinked as $key => $level){
  			
  			$object->setVariable('nom_famille', $level->nom_famille);
			$object->setVariable('url_category', 'navigation_rubrique_detail.php?id=' . $level->language_link);
		    $object->setVariable('category_class_1','class="page_visible"');
		    $object->setVariable('visible_out',$level->visible == 1?VISIBLE:INVISIBLE);
				$listLanguage = modelLanguage::getListRemainLanguage($level->language_link, 'navigation_rubrique');
				if($listLanguage->size()>0) {
					$object->resetList('list_image_flag_out');
					foreach($listLanguage as $key => $language) {
						$object->setVariable('flag_name_out', $language->name);
						$object->setVariable('url_flag_out', URL_FLAG . $language->flag);
					    $object->parseList('list_image_flag_out');
					}
				}else {
					$object->resetList('list_image_flag_out');
					$object->setVariable('flag_name_out', 'Ok');
					$object->setVariable('url_flag_out', REP_FRONT_DESIGN . 'accept.gif');
				    $object->parseList('list_image_flag_out');
				}
				
		    $object->parseList('no_father');
  		}
  		$object->showBlock('outTree');
  	}
		
	if(!$listLevelNotLinked->size()  && !$listLevel1->size()){	
		$language = modelLanguage::getLanguage(null,$_SESSION['language_code'])->name;
		$object->setVariable('langauge',$language);
		$object->showBlock('nothing');
	}
	$object->stop();
	echo $object;
?>