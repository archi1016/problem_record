<?php

if (empty($THIS_STAFF_RINGS[RING_STANDBY_SAVE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['standby_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['standby_status'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['standby_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['standby_location'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['standby_serial_ids'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['standby_id'] = stripslashes($_GET['standby_id']);
	$_POST['standby_name'] = stripslashes($_POST['standby_name']);
	$_POST['standby_status'] = stripslashes($_POST['standby_status']);
	$_POST['standby_location'] = stripslashes($_POST['standby_location']);
	$_POST['standby_serial_ids'] = stripslashes($_POST['standby_serial_ids']);
}
$_POST['standby_serial_ids'] = str_replace("\r", '', $_POST['standby_serial_ids']);
$_POST['standby_serial_ids'] = str_replace("\n", '\n', $_POST['standby_serial_ids']);

$standby_id = RETURN_ID_FROM($_GET['standby_id']);
CHECK_ID_EXIST($standby_id, $ROWS, $ri);
$row = &$ROWS[$ri];

if (empty($row[STANDBY_CLIENT_ID])) {
	$row[STANDBY_STATUS] = $_POST['standby_status'];
}
$row[STANDBY_NAME] = $_POST['standby_name'];
$row[STANDBY_LOCATION] = $_POST['standby_location'];
$row[STANDBY_SERIAL_IDS] = $_POST['standby_serial_ids'];

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>