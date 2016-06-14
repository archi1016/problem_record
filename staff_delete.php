<?php

if (empty($THIS_STAFF_RINGS[RING_STAFF_DELETE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['staff_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['staff_id'] = stripslashes($_GET['staff_id']);
}

$staff_id = RETURN_ID_FROM($_GET['staff_id']);
CHECK_ID_EXIST($staff_id, $ROWS, $ri);

if ($staff_id == 1) SHOW_ERROR(ERROR_MUST_EXIST);

unset($ROWS[$ri]);

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>