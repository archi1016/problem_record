<?php

if (empty($THIS_STAFF_RINGS[RING_CASE_DELETE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['case_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['case_id'] = stripslashes($_GET['case_id']);
}

$case_id = RETURN_ID_FROM($_GET['case_id']);
CHECK_ID_EXIST($case_id, $ROWS, $ri);

if (empty($ROWS[$ri][CASE_STAFF_ID])) {
	unset($ROWS[$ri]);

	if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
		GOTO($THIS_PHP_FILE);
	} else {
		SHOW_ERROR(ERROR_DUMP_FILE);
	}
} else {
	SHOW_ERROR(ERROR_IN_USE);
}

?>