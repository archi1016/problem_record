<?php

function MOVE_REPAIR_TO_ARCHIVE(&$sr) {
	$FILE_DB = RETURN_DB_FILE_PATH(REPAIR_ARCHIVE_FILE_ID);

	if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
		$rc = count($ROWS);
	} else {
		$rc = 0;
	}

	$ROWS[$rc][REPAIR_ARCHIVE_UID] = $sr[REPAIR_UID];
	$row = &$ROWS[$rc];
	$row[REPAIR_ARCHIVE_CLIENT_ID] = $sr[REPAIR_CLIENT_ID];
	$row[REPAIR_ARCHIVE_STAFF_ID] = $sr[REPAIR_STAFF_ID];
	$row[REPAIR_ARCHIVE_SUPPLIER_ID] = $sr[REPAIR_SUPPLIER_ID];
	$row[REPAIR_ARCHIVE_TIME] = $sr[REPAIR_TIME];
	$row[REPAIR_ARCHIVE_TIME_RETURN] = $_POST['repair_year'].'-'.$_POST['repair_month'].'-'.$_POST['repair_day'].' '.$_POST['repair_hour'].':'.$_POST['repair_minute'];
	$row[REPAIR_ARCHIVE_REPORT] = $_POST['repair_report'];
	$row[REPAIR_ARCHIVE_COST] = $_POST['repair_cost'];
	$row[REPAIR_ARCHIVE_NAME] = $sr[REPAIR_NAME];
	$row[REPAIR_ARCHIVE_REASON] = $sr[REPAIR_REASON];
	$row[REPAIR_ARCHIVE_SERIAL_IDS] = $sr[REPAIR_SERIAL_IDS];

	if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	} else {
		SHOW_ERROR(ERROR_DUMP_FILE);
	}
}

if (empty($THIS_STAFF_RINGS[RING_REPAIR_RETURN])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['repair_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['repair_report'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['repair_cost'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['repair_year'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['repair_month'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['repair_day'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['repair_hour'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['repair_minute'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['repair_id'] = stripslashes($_GET['repair_id']);
	$_POST['repair_report'] = stripslashes($_POST['repair_report']);
	$_POST['repair_cost'] = stripslashes($_POST['repair_cost']);
	$_POST['repair_year'] = stripslashes($_POST['repair_year']);
	$_POST['repair_month'] = stripslashes($_POST['repair_month']);
	$_POST['repair_day'] = stripslashes($_POST['repair_day']);
	$_POST['repair_hour'] = stripslashes($_POST['repair_hour']);
	$_POST['repair_minute'] = stripslashes($_POST['repair_minute']);
}

$repair_id = RETURN_ID_FROM($_GET['repair_id']);
CHECK_ID_EXIST($repair_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$sr = $ROWS[$ri];

unset($ROWS[$ri]);

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	MOVE_REPAIR_TO_ARCHIVE($sr);
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_LOAD_FILE);
}

?>