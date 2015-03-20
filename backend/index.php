<?php 

define('REP_ROOT', '');
require(REP_ROOT . 'config.php');

if(isset($_POST['user'])) {
    try {
        modelUser::connexionMonster($_POST['user'], $_POST['pass']);
        rootLayout::setMessage('Welcome', Message::INFO);
    }
    catch(Exception $e) {
        rootLayout::setMessage($e->getMessage(), Message::ERROR);
    }
}

if($_SESSION['id_user'] > 0) { // connecté 
    $page = new rootLayoutMonster();
    
    $index = new flyLayout(REP_TPL . 'index.tpl');
    $index->start();
	$index->includeFile('submenu', new layoutMenubar());
    $index->stop();
	$page->setIncBody($index);
}
else
    $page = new rootLayoutLogin();
$page->display();

?>