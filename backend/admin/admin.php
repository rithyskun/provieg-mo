<?php 

/**
 * Page d'accueil du module administration
 * @author Marcadet Antoine
 * @date 20070615
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

$admin = new flyLayout(REP_TPL . 'admin/admin.tpl');
$admin->start();

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
$res_sousmenu = $db->executeQuery($sql);
foreach($res_sousmenu as $key_sousmenu => $sousmenu) {
    if(acces($sousmenu->nom_fichier)) {
        $admin->setVariable('url_sousmenu', REP_ROOT . $sousmenu->url_dossier . $sousmenu->nom_fichier . '.php');
        $admin->setVariable('intitule_sousmenu', $sousmenu->intitule_fichier);
        $admin->parseList('onglet_menu');
    }
}

$admin->stop();

$monster->setIncBody($admin);
$monster->display();

?>