<?php

if (empty($THIS_STAFF_RINGS[RING_REPAIR_ARCHIVE_DELETE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['repair_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['repair_id'] = stripslashes($_GET['repair_id']);
}

$FILE_DB = RETURN_DB_FILE_PATH(REPAIR_ARCHIVE_FILE_ID);

$repair_id = RETURN_ID_FROM($_GET['repair_id']);
CHECK_ID_EXIST($repair_id, $ROWS, $ri);

unset($ROWS[$ri]);

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE.'&op=archive_list');
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>