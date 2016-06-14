<?php

function INSERT_ARCHIVE(&$case) {
	$FILE_DB = RETURN_DB_FILE_PATH(ARCHIVE_FILE_ID);

	if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
		$rc = count($ROWS);
	} else {
		$rc = 0;
	}

	$ROWS[$rc][ARCHIIVE_UID] = $case[CASE_UID];
	$row = &$ROWS[$rc];
	$row[ARCHIVE_STAFF_ID] = $case[CASE_STAFF_ID];
	$row[ARCHIVE_CLIENT_ID] = $case[CASE_CLIENT_ID];
	$row[ARCHIVE_OPENED_TIME] = $case[CASE_OPENED_TIME];
	$row[ARCHIVE_OPENED_STAFF_ID] = $case[CASE_OPENED_STAFF_ID];
	$row[ARCHIVE_TAKING_TIME] = $case[CASE_TAKING_TIME];
	$row[ARCHIVE_CLOSED_TIME] = date('Y-m-d H:i');
	$row[ARCHIVE_FOLDER] = $case[CASE_ARCHIVE_FOLDER];
	$row[ARCHIVE_TAG] = $case[CASE_TAG];
	$row[ARCHIVE_TITLE] = $case[CASE_TITLE];
	$row[ARCHIVE_CONTENT] = $case[CASE_CONTENT];

	if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
		WRITE_CASE_LOG($row[ARCHIVE_FOLDER], 'µ²®×ÂkÀÉ', $_SESSION['UID']);
	} else {
		SHOW_ERROR(ERROR_DUMP_FILE);
	}
}

if (empty($THIS_STAFF_RINGS[RING_CASE_CLOSE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['case_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['case_id'] = stripslashes($_GET['case_id']);
}

$case_id = RETURN_ID_FROM($_GET['case_id']);

CHECK_ID_EXIST($case_id, $ROWS, $ri);

INSERT_ARCHIVE($ROWS[$ri]);

unset($ROWS[$ri]);

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>