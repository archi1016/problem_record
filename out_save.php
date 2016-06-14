<?php

if (empty($THIS_STAFF_RINGS[RING_OUT_SAVE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['out_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['out_client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['out_reason'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['out_staff_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['out_year'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['out_month'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['out_day'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['out_hour'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['out_minute'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['out_id'] = stripslashes($_GET['out_id']);
	$_POST['out_client_id'] = stripslashes($_POST['out_client_id']);
	$_POST['out_reason'] = stripslashes($_POST['out_reason']);
	$_POST['out_staff_id'] = stripslashes($_POST['out_staff_id']);
	$_POST['out_year'] = stripslashes($_POST['out_year']);
	$_POST['out_month'] = stripslashes($_POST['out_month']);
	$_POST['out_day'] = stripslashes($_POST['out_day']);
	$_POST['out_hour'] = stripslashes($_POST['out_hour']);
	$_POST['out_minute'] = stripslashes($_POST['out_minute']);
}

$out_id = RETURN_ID_FROM($_GET['out_id']);
CHECK_ID_EXIST($out_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$row[OUT_CLIENT_ID] = $_POST['out_client_id'];
$row[OUT_REASON] = $_POST['out_reason'];
$row[OUT_STAFF_ID] = $_POST['out_staff_id'];
$row[OUT_TIME] = $_POST['out_year'].'-'.$_POST['out_month'].'-'.$_POST['out_day'].' '.$_POST['out_hour'].':'.$_POST['out_minute'];

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>