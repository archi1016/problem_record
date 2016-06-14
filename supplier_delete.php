<?php

if (empty($THIS_STAFF_RINGS[RING_SUPPLIER_DELETE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['supplier_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['supplier_id'] = stripslashes($_GET['supplier_id']);
}

$supplier_id = RETURN_ID_FROM($_GET['supplier_id']);
CHECK_ID_EXIST($supplier_id, $ROWS, $ri);

unset($ROWS[$ri]);

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>