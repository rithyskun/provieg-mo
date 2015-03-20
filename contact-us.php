<?php

require('config.php');

if(isset($_GET['lang'])) {
	set_priority_lang($_GET['lang']);
}else {
	set_browser_lang();
}

$page = new rootLayoutPage();
$page->setIndex(true);
$page->setFollow(true);
$page->setTitle('Contact us');
$page->setDescription('Contact us');

$page->addJavaScriptLive('http://maps.google.com/maps/api/js?sensor=true', '');
$page->addJavaScript('ui.map.init.js');

$body = new flyLayout(REP_TPL . 'contact-us.tpl');
$body->start();
$body->setLang(REP_LANG . 'contact-us-lang.php', $_SESSION['language_code']);
$_SESSION['__PAGE__'] = PAGE_EXT;
$body->setVariable('mail_contact', MAIL_CONTACT);
$body->setVariable('mail_info', MAIL_INFO);
$body->stop();
$page->setBody($body);
$page->display();

?>