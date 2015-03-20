<?php

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if(isset($_POST['lang'])) {
	list($language_code, $country_code) = split('_', $_POST['lang']);
	// 2nd priority
	$_SESSION['language_code'] = $language_code;
	echo json_encode(array('status' => true, 'lang' => "$language_code"));
}else {
	echo json_encode(array('status' => false, 'lang' => ''));
}

?>