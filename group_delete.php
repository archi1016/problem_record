<?php

function IS_GROUP_ID_IN_USE($group_id) {
	if (LOAD_TEXT_TABLE(RETURN_DB_FILE_PATH(STAFF_FILE_ID), $ROWS)) {
		$rc = count($ROWS);
		$ri = $rc - 1;
		while ($ri >= 0) {
			if ($group_id == $ROWS[$ri][STAFF_GROUP_ID]) {
				return TRUE;
			}
			--$ri;
		}	
	}
	return FALSE;
}

if (empty($THIS_STAFF_RINGS[RING_GROUP_DELETE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['group_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['group_id'] = stripslashes($_GET['group_id']);
}

$group_id = RETURN_ID_FROM($_GET['group_id']);
CHECK_ID_EXIST($group_id, $ROWS, $ri);

if ($group_id == 1) SHOW_ERROR(ERROR_MUST_EXIST);

if (IS_GROUP_ID_IN_USE($group_id)) {
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