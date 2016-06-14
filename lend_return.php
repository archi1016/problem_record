<?php

function UPDATE_LEND_LOG(&$sr) {
	global $FILE_DB;

	$FILE_DB = RETURN_DB_FILE_PATH(LEND_FILE_ID);
	CHECK_ID_EXIST($sr[STANDBY_LEND_ID], $ROWS, $ri);

	$row = &$ROWS[$ri];
	$row[LEND_STANDBY_ID] = $sr[STANDBY_UID];
	$row[LEND_CLIENT_ID] = $sr[STANDBY_CLIENT_ID];
	$row[LEND_TIME] = $sr[STANDBY_LEND_TIME];
	$row[LEND_TIME_RETURN] = date('Y-m-d H:i');

	if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	} else {
		SHOW_ERROR(ERROR_DUMP_FILE);
	}
}

if (empty($THIS_STAFF_RINGS[RING_LEND_SAVE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['standby_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['standby_id'] = stripslashes($_GET['standby_id']);
}

$FILE_DB = RETURN_DB_FILE_PATH(STANDBY_FILE_ID);

$standby_id = RETURN_ID_FROM($_GET['standby_id']);
CHECK_ID_EXIST($standby_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$sr = $ROWS[$ri];

$row[STANDBY_CLIENT_ID] = '0';
$row[STANDBY_LEND_ID] = '0';
$row[STANDBY_LEND_TIME] = '';

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	UPDATE_LEND_LOG($sr);
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>