<?php

if (empty($THIS_STAFF_RINGS[RING_REPAIR_INSERT])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_POST['repair_client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['repair_staff_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['repair_supplier_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['repair_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['repair_reason'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['repair_serial_ids'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['repair_year'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['repair_month'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['repair_day'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['repair_hour'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['repair_minute'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_POST['repair_client_id'] = stripslashes($_POST['repair_client_id']);
	$_POST['repair_staff_id'] = stripslashes($_POST['repair_staff_id']);
	$_POST['repair_supplier_id'] = stripslashes($_POST['repair_supplier_id']);
	$_POST['repair_name'] = stripslashes($_POST['repair_name']);
	$_POST['repair_reason'] = stripslashes($_POST['repair_reason']);
	$_POST['repair_serial_ids'] = stripslashes($_POST['repair_serial_ids']);
	$_POST['repair_year'] = stripslashes($_POST['repair_year']);
	$_POST['repair_month'] = stripslashes($_POST['repair_month']);
	$_POST['repair_day'] = stripslashes($_POST['repair_day']);
	$_POST['repair_hour'] = stripslashes($_POST['repair_hour']);
	$_POST['repair_minute'] = stripslashes($_POST['repair_minute']);
}
$_POST['repair_serial_ids'] = str_replace("\r", '', $_POST['repair_serial_ids']);
$_POST['repair_serial_ids'] = str_replace("\n", '\n', $_POST['repair_serial_ids']);


LOAD_DB_AND_NEXT_ID($ROWS, $rc, $ni);

$ROWS[$rc][REPAIR_UID] = $ni;
$row = &$ROWS[$rc];
$row[REPAIR_CLIENT_ID] = $_POST['repair_client_id'];
$row[REPAIR_STAFF_ID] = $_POST['repair_staff_id'];
$row[REPAIR_SUPPLIER_ID] = $_POST['repair_supplier_id'];
$row[REPAIR_TIME] = $_POST['repair_year'].'-'.$_POST['repair_month'].'-'.$_POST['repair_day'].' '.$_POST['repair_hour'].':'.$_POST['repair_minute'];
$row[REPAIR_NAME] = $_POST['repair_name'];
$row[REPAIR_REASON] = $_POST['repair_reason'];
$row[REPAIR_SERIAL_IDS] = $_POST['repair_serial_ids'];

DUMP_DB_AND_NEXT_ID($ROWS, $ni);
GOTO($THIS_PHP_FILE);

?>