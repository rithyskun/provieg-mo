<?php

require('config.php');

if(isset($_GET['lang'])) {
	set_priority_lang($_GET['lang']);
}else {
	set_browser_lang();
}

$page = new rootLayoutHomePage();
$page->setIndex(true);
$page->setFollow(true);
$page->setTitle('How it works');
$page->setDescription('How it works');

$body = new flyLayout(REP_TPL . 'how-it-works.tpl');
$body->start();
$body->setLang(REP_LANG . 'how-it-works-lang.php', $_SESSION['language_code']);
$_SESSION['__PAGE__'] = PAGE_EXT;
$body->stop();
$page->setBody($body);
$page->display();

?>