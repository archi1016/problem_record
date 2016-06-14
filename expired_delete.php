<?php

if (empty($THIS_STAFF_RINGS[RING_EXPIRED_DELETE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['expired_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['expired_id'] = stripslashes($_GET['expired_id']);
}

$expired_id = RETURN_ID_FROM($_GET['expired_id']);
CHECK_ID_EXIST($expired_id, $ROWS, $ri);

unset($ROWS[$ri]);

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>