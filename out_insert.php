<?php

if (empty($THIS_STAFF_RINGS[RING_OUT_INSERT])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_POST['out_client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['out_reason'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['out_staff_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['out_year'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['out_month'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['out_day'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['out_hour'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['out_minute'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_POST['out_client_id'] = stripslashes($_POST['out_client_id']);
	$_POST['out_reason'] = stripslashes($_POST['out_reason']);
	$_POST['out_staff_id'] = stripslashes($_POST['out_staff_id']);
	$_POST['out_year'] = stripslashes($_POST['out_year']);
	$_POST['out_month'] = stripslashes($_POST['out_month']);
	$_POST['out_day'] = stripslashes($_POST['out_day']);
	$_POST['out_hour'] = stripslashes($_POST['out_hour']);
	$_POST['out_minute'] = stripslashes($_POST['out_minute']);
}

LOAD_DB_AND_NEXT_ID($ROWS, $rc, $ni);

$ROWS[$rc][OUT_UID] = $ni;
$row = &$ROWS[$rc];
$row[OUT_CLIENT_ID] = $_POST['out_client_id'];
$row[OUT_STAFF_ID] = $_POST['out_staff_id'];
$row[OUT_REASON] = $_POST['out_reason'];
$row[OUT_TIME] = $_POST['out_year'].'-'.$_POST['out_month'].'-'.$_POST['out_day'].' '.$_POST['out_hour'].':'.$_POST['out_minute'];

DUMP_DB_AND_NEXT_ID($ROWS, $ni);
GOTO($THIS_PHP_FILE);

?>