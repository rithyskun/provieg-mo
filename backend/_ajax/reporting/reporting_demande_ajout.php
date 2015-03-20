<?php

define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

if(!isset($_SESSION['id_user'])) 
    die('Votre session a expiré veuillez vous reconnecter.');
    
try {
   modelReportingRequest::insert($_POST['request_uri'], $_POST['texte']);
}
catch(Exception $e) {
    die('Le serveur a rencontré un problème lors du traitement de votre demande, veuillez reessayer ultérieurement.');
}

echo 'Nous traiterons votre demande très prochainement, merci de votre confiance.';

?>
