<?php

if (empty($THIS_STAFF_RINGS[RING_CLIENT_SAVE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['client_cooperation'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['client_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['client_telephone'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['client_address'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['client_tag'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['client_property'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['client_id'] = stripslashes($_GET['client_id']);
	$_POST['client_cooperation'] = stripslashes($_POST['client_cooperation']);
	$_POST['client_name'] = stripslashes($_POST['client_name']);
	$_POST['client_telephone'] = stripslashes($_POST['client_telephone']);
	$_POST['client_address'] = stripslashes($_POST['client_address']);
	$_POST['client_tag'] = stripslashes($_POST['client_tag']);
	$_POST['client_property'] = stripslashes($_POST['client_property']);
}
$_POST['client_property'] = str_replace("\r", '', $_POST['client_property']);
$_POST['client_property'] = str_replace("\n", '\n', $_POST['client_property']);

$client_id = RETURN_ID_FROM($_GET['client_id']);
CHECK_ID_EXIST($client_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$row[CLIENT_COOPERATION] = $_POST['client_cooperation'];
$row[CLIENT_NAME] = $_POST['client_name'];
$row[CLIENT_TELEPHONE] = $_POST['client_telephone'];
$row[CLIENT_ADDRESS] = $_POST['client_address'];
$row[CLIENT_TAG] = $_POST['client_tag'];
$row[CLIENT_PROPERTY] = $_POST['client_property'];

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>