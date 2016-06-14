<?php

function RETURN_NEW_LEND_ID($standby_id, $client_id) {
	global $FILE_DB;
	global $FILE_ID;

	$FILE_DB_BACKUP = $FILE_DB;
	$FILE_ID_BACKUP = $FILE_ID;

	$FILE_DB = RETURN_DB_FILE_PATH(LEND_FILE_ID);
	$FILE_ID = RETURN_NEXT_ID_FILE_PATH(LEND_FILE_ID);
	LOAD_DB_AND_NEXT_ID($ROWS, $rc, $ni);

	$ROWS[$rc][LEND_UID] = $ni;
	$row = &$ROWS[$rc];
	$row[LEND_STANDBY_ID] = $standby_id;
	$row[LEND_CLIENT_ID] = $client_id;
	$row[LEND_TIME] = '';
	$row[LEND_TIME_RETURN] = '';

	DUMP_DB_AND_NEXT_ID($ROWS, $ni);

	$FILE_DB = $FILE_DB_BACKUP;
	$FILE_ID = $FILE_ID_BACKUP;
	return $row[LEND_UID];
}

if (empty($_GET['standby_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['standby_client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['standby_id'] = stripslashes($_GET['standby_id']);
	$_POST['standby_client_id'] = stripslashes($_POST['standby_client_id']);
}

$FILE_DB = RETURN_DB_FILE_PATH(STANDBY_FILE_ID);

$standby_id = RETURN_ID_FROM($_GET['standby_id']);
CHECK_ID_EXIST($standby_id, $ROWS, $ri);
$row = &$ROWS[$ri];

if (empty($row[STANDBY_CLIENT_ID])) {
	if (empty($THIS_STAFF_RINGS[RING_LEND_INSERT])) SHOW_ERROR(ERROR_NO_RING);
	$lend_id = RETURN_NEW_LEND_ID($standby_id, $_POST['standby_client_id']);
} else {
	if (empty($THIS_STAFF_RINGS[RING_LEND_SAVE])) SHOW_ERROR(ERROR_NO_RING);
	$lend_id = $row[STANDBY_LEND_ID]; 
}

$row[STANDBY_CLIENT_ID] = $_POST['standby_client_id'];
$row[STANDBY_LEND_ID] = $lend_id;
$row[STANDBY_LEND_TIME] = date('Y-m-d H:i');

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>