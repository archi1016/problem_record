<?php

if (empty($THIS_STAFF_RINGS[RING_EXPIRED_SAVE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['expired_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['expired_client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['expired_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['expired_location'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['expired_year'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['expired_month'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['expired_day'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['expired_hour'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['expired_minute'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['expired_id'] = stripslashes($_GET['expired_id']);
	$_POST['expired_client_id'] = stripslashes($_POST['expired_client_id']);
	$_POST['expired_name'] = stripslashes($_POST['expired_name']);
	$_POST['expired_location'] = stripslashes($_POST['expired_location']);
	$_POST['expired_year'] = stripslashes($_POST['expired_year']);
	$_POST['expired_month'] = stripslashes($_POST['expired_month']);
	$_POST['expired_day'] = stripslashes($_POST['expired_day']);
	$_POST['expired_hour'] = stripslashes($_POST['expired_hour']);
	$_POST['expired_minute'] = stripslashes($_POST['expired_minute']);
}

$expired_id = RETURN_ID_FROM($_GET['expired_id']);
CHECK_ID_EXIST($expired_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$row[EXPIRED_CLIENT_ID] = $_POST['expired_client_id'];
$row[EXPIRED_NAME] = $_POST['expired_name'];
$row[EXPIRED_LOCATION] = $_POST['expired_location'];
$row[EXPIRED_TIME] = $_POST['expired_year'].'-'.$_POST['expired_month'].'-'.$_POST['expired_day'].' '.$_POST['expired_hour'].':'.$_POST['expired_minute'];

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>