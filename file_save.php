<?php

if (empty($THIS_STAFF_RINGS[RING_FILE_SAVE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['file_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['file_name'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['file_id'] = stripslashes($_GET['file_id']);
	$_POST['file_name'] = stripslashes($_POST['file_name']);
}

$file_id = RETURN_ID_FROM($_GET['file_id']);
CHECK_ID_EXIST($file_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$row[FILE_NAME] = $_POST['file_name'];

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>