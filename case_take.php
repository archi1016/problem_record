<?php

if (empty($THIS_STAFF_RINGS[RING_CASE_TAKE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['case_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['case_id'] = stripslashes($_GET['case_id']);
}

$case_id = RETURN_ID_FROM($_GET['case_id']);

CHECK_ID_EXIST($case_id, $ROWS, $ri);

$row = &$ROWS[$ri];
$row[CASE_STAFF_ID] = $_SESSION['UID'];
$row[CASE_TAKING_TIME] = date('Y-m-d H:i');

WRITE_CASE_LOG($row[CASE_ARCHIVE_FOLDER], '����', $_SESSION['UID']);

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>