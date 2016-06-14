<?php

if (empty($THIS_STAFF_RINGS[RING_CLIENT_INSERT])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_POST['client_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['client_telephone'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['client_address'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['client_tag'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['client_property'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_POST['client_name'] = stripslashes($_POST['client_name']);
	$_POST['client_telephone'] = stripslashes($_POST['client_telephone']);
	$_POST['client_address'] = stripslashes($_POST['client_address']);
	$_POST['client_tag'] = stripslashes($_POST['client_tag']);
	$_POST['client_property'] = stripslashes($_POST['client_property']);
}
$_POST['client_property'] = str_replace("\r", '', $_POST['client_property']);
$_POST['client_property'] = str_replace("\n", '\n', $_POST['client_property']);

LOAD_DB_AND_NEXT_ID($ROWS, $rc, $ni);

$ROWS[$rc][CLIENT_UID] = $ni;
$row = &$ROWS[$rc];
$row[CLIENT_COOPERATION] = '1';
$row[CLIENT_NAME] = $_POST['client_name'];
$row[CLIENT_TELEPHONE] = $_POST['client_telephone'];
$row[CLIENT_ADDRESS] = $_POST['client_address'];
$row[CLIENT_TAG] = $_POST['client_tag'];
$row[CLIENT_PROPERTY] = $_POST['client_property'];

DUMP_DB_AND_NEXT_ID($ROWS, $ni);
GOTO($THIS_PHP_FILE);

?>