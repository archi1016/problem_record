<?php

if (empty($THIS_STAFF_RINGS[RING_FILE_INSERT])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_POST['file_name'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_POST['file_name'] = stripslashes($_POST['file_name']);
}

LOAD_DB_AND_NEXT_ID($ROWS, $rc, $ni);

$ROWS[$rc][FILE_UID] = $ni;
$row = &$ROWS[$rc];
$row[FILE_NAME] = $_POST['file_name'];

DUMP_DB_AND_NEXT_ID($ROWS, $ni);
GOTO($THIS_PHP_FILE);

?>