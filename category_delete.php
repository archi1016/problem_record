<?php

if (empty($THIS_STAFF_RINGS[RING_CATEGORY_DELETE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['category_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['category_id'] = stripslashes($_GET['category_id']);
}

$category_id = RETURN_ID_FROM($_GET['category_id']);
CHECK_ID_EXIST($category_id, $ROWS, $ri);

unset($ROWS[$ri]);

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>