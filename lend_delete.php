<?php

if (empty($THIS_STAFF_RINGS[RING_LEND_DELETE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['lend_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['lend_id'] = stripslashes($_GET['lend_id']);
}

$lend_id = RETURN_ID_FROM($_GET['lend_id']);
CHECK_ID_EXIST($lend_id, $ROWS, $ri);

unset($ROWS[$ri]);

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE.'&op=log');
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>