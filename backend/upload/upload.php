<?php 

/**
 * Page d'accueil du module du centre de ressources
 * @author Léang Stéphanie
 * @date 20070628
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

$upload = new flyLayout(REP_TPL . 'upload/upload.tpl');

$upload->start();

// construction du sous menu
$sql = 'SELECT af.*, ad.url_dossier, dtf.lib_type_fichier, dtf.id_type_fichier
        FROM _adm_fichier AS af, _adm_fichier_recursif AS afr, _adm_fichier AS pere, _adm_dossier AS ad, zz_data_type_fichier AS dtf
        WHERE af.id_type_fichier = 2
        AND afr.id_fichier_fils = af.id_fichier
        AND afr.id_fichier_pere = pere.id_fichier
        AND pere.nom_fichier = "'.PAGE.'"
        AND af.id_fichier = afr.id_fichier_fils
        AND af.id_dossier = ad.id_dossier
        AND af.id_type_fichier = dtf.id_type_fichier
        AND afr.etat_doc = 1
        ORDER BY afr.numero';

$db = Annuaire::lookup(KEY_DATABASE);
$result = $db->executeQuery($sql);
foreach($result as $key => $submenu) {
	if(acces($submenu->nom_fichier)) {
		$upload->setVariable('url_sousmenu', REP_ROOT . $submenu->url_dossier . $submenu->nom_fichier . '.php');
		$upload->setVariable('intitule_sousmenu', $submenu->intitule_fichier);
		$upload->parseList('onglet_menu');
	}
}

$upload->stop();

$monster->setIncBody($upload);

$monster->display();

?>
