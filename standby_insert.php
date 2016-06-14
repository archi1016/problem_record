<?php

if (empty($THIS_STAFF_RINGS[RING_STANDBY_INSERT])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_POST['standby_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['standby_location'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['standby_serial_ids'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_POST['standby_name'] = stripslashes($_POST['standby_name']);
	$_POST['standby_location'] = stripslashes($_POST['standby_location']);
	$_POST['standby_serial_ids'] = stripslashes($_POST['standby_serial_ids']);
}
$_POST['standby_serial_ids'] = str_replace("\r", '', $_POST['standby_serial_ids']);
$_POST['standby_serial_ids'] = str_replace("\n", '\n', $_POST['standby_serial_ids']);

LOAD_DB_AND_NEXT_ID($ROWS, $rc, $ni);

$ROWS[$rc][STANDBY_UID] = $ni;
$row = &$ROWS[$rc];
$row[STANDBY_STATUS] = STANDBY_STATUS_NORMAL;
$row[STANDBY_CLIENT_ID] = '0';
$row[STANDBY_LEND_ID] = '0';
$row[STANDBY_LEND_TIME] = '';
$row[STANDBY_NAME] = $_POST['standby_name'];
$row[STANDBY_LOCATION] = $_POST['standby_location'];
$row[STANDBY_SERIAL_IDS] = $_POST['standby_serial_ids'];

DUMP_DB_AND_NEXT_ID($ROWS, $ni);
GOTO($THIS_PHP_FILE);

?>