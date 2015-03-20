<?php

/**
 * Affiche l'historique de connexions du compte
 * @author Léang Stéphanie
 * @version 20070620
 */
 
if(acces(__FILE__)) {
	if(isset($_GET['id'])) {
		$id_utilisateur = normalise($_GET['id'], 'id');		
		$admin_user_histo = new flyLayout(REP_TPL . 'admin/admin_user_histo.tpl');
	    $admin_user_histo->start();
		$admin_user_histo->setVariable('rep_img', REP_IMG . 'tableFilter/');
		
		$listHisto = modelUser::getListHisto($id_utilisateur);		
	    if($listHisto->size() > 0) {
    		foreach($listHisto as $key => $histo){
    			$admin_user_histo->setVariable('type_ligne', ($listHisto->index()%2)?'impair':'pair');
    			$admin_user_histo->setVariable('date_connection', affiche($histo->date_connection, 'dateheure'));
    			$admin_user_histo->setVariable('type_connection', $histo->type_connection);
    			$admin_user_histo->setVariable('ip_connection', $histo->ip_connection);
    			$admin_user_histo->parseList('histo');
    		}
    		$admin_user_histo->showBlock('liste');
    	}
        else {
            $admin_user_histo->showBlock('aucun');
		}
		$admin_user_histo->stop();
	}
}

?>