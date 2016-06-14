<?php

function IS_STANDBY_ID_IN_USE($standby_id) {
	if (LOAD_TEXT_TABLE(RETURN_DB_FILE_PATH(LEND_FILE_ID), $ROWS)) {
		$rc = count($ROWS);
		$ri = $rc - 1;
		while ($ri >= 0) {
			if ($standby_id == $ROWS[$ri][LEND_STANDBY_ID]) {
				return TRUE;
			}
			--$ri;
		}	
	}
	return FALSE;
}

if (empty($THIS_STAFF_RINGS[RING_STANDBY_DELETE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['standby_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['standby_id'] = stripslashes($_GET['standby_id']);
}

$standby_id = RETURN_ID_FROM($_GET['standby_id']);
CHECK_ID_EXIST($standby_id, $ROWS, $ri);

if (IS_STANDBY_ID_IN_USE($standby_id)) {
	SHOW_ERROR(ERROR_IN_USE);
} else {
	unset($ROWS[$ri]);

	if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
		GOTO($THIS_PHP_FILE);
	} else {
		SHOW_ERROR(ERROR_DUMP_FILE);
	}
}

?>