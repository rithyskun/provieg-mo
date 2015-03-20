<?php

/**
 *
 * @author Ratanak
 * @version 20081222
 */

define('REP_ROOT','../../');
require(REP_ROOT . 'config.php');

	$id_father = $_POST['id_father'];
	$level = $_POST['level'];
    /** SECTION AFFICHAGE**************************************/
	$navigation_category_product_order_list = new flyLayout(REP_TPL_AJAX . 'navigation/navigation_category_product_order_list.tpl');
    $navigation_category_product_order_list->start();
    $father = modelCategoryProduct::getCategoryTreeById($id_father);
    if($father){
    	$navigation_category_product_order_list ->setVariable('father_name', $father->father_name);
    	$navigation_category_product_order_list ->setVariable('id_father', $father->id_famille_arbo);
	    if($father->niveau == 1){
	    	$navigation_category_product_order_list ->setVariable('id_parent', 'root');
	    	$navigation_category_product_order_list ->setVariable('parent_name', 'Root');
	    	$navigation_category_product_order_list ->setVariable('level', 1);
	    	$navigation_category_product_order_list ->showBlock('seperate');
	    	$navigation_category_product_order_list ->parseList('parent_list');
	    }
	    else{
	    	for($i = 0; $i < $father->niveau; $i++){
	    		if($i == 0){
	    			$navigation_category_product_order_list ->setVariable('id_parent', 'root');
	    			$navigation_category_product_order_list ->setVariable('parent_name', 'Root');
	    			$navigation_category_product_order_list ->setVariable('level', 1);
	    			$navigation_category_product_order_list ->showBlock('seperate');  			
	    		}else{	
	    		$all_father = modelCategoryProduct::getFatherTreeByLevel($father->borne_gauche,$father->borne_droite,$i);
		    	$navigation_category_product_order_list ->setVariable('id_parent', $all_father->id_famille_arbo);
		    	$navigation_category_product_order_list ->setVariable('parent_name', affiche($all_father->father_name, 'tree_page'));
		    	$navigation_category_product_order_list ->setVariable('level', $all_father->niveau);
		    	$i == $father->niveau?$navigation_category_product_order_list ->hideBlock('seperate'):$navigation_category_product_order_list ->showBlock('seperate');
	    		}
		    	$navigation_category_product_order_list ->parseList('parent_list');
	    	}
	    }
    }
    if($id_father == null or $id_father == 0) $listCategory = modelCategoryProduct::getCategoryLevelOne();
	else $listCategory = modelCategoryProduct::getSonAll($father->borne_gauche,$father->borne_droite,$level);
	
	if($listCategory->size() > 0) {
		$num = 10;
    	foreach($listCategory as $key => $category ){
    		$navigation_category_product_order_list->setVariable('type_ligne', ($listCategory->index()%2)?'impair':'pair');
    		$navigation_category_product_order_list->setVariable('id_category', $category ->id_famille);
    		$navigation_category_product_order_list->setVariable('id_category_tree', $category ->id_famille_arbo);
	    	
    		$navigation_category_product_order_list->setVariable('position', $num);		
    		$navigation_category_product_order_list->setVariable('title', $category ->nom_famille);
    		$navigation_category_product_order_list->setVariable('visible', $category ->visible==1?YES:NO);
    		$navigation_category_product_order_list->setVariable('level', $level);
    		
	    		$next_level = $category->niveau + 1;
		    	$son = modelCategoryProduct::getSonByLevel($category ->borne_gauche,$category ->borne_droite,$next_level);
	    		if($son){ 
	    		$navigation_category_product_order_list->showBlock('has_son');
	    		$navigation_category_product_order_list->hideBlock('no_son');
    			}
	    	
    		else {
    		$navigation_category_product_order_list->showBlock('no_son');
    		$navigation_category_product_order_list->hideBlock('has_son');
    		}
    		
    		$navigation_category_product_order_list ->parseList('list_page');
    		$num = $num + 10;
    	}
    	$navigation_category_product_order_list ->showBlock('block_list_page');
    }
    else {
        $navigation_category_product_order_list ->showBlock('block_nothing');
    }
	$navigation_category_product_order_list->stop();

	echo $navigation_category_product_order_list;


?>