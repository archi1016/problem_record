<?php

if (empty($THIS_STAFF_RINGS[RING_CATEGORY_INSERT])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_POST['category_name'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_POST['category_name'] = stripslashes($_POST['category_name']);
}

LOAD_DB_AND_NEXT_ID($ROWS, $rc, $ni);

$ROWS[$rc][CATEGORY_UID] = $ni;
$row = &$ROWS[$rc];
$row[CATEGORY_NAME] = $_POST['category_name'];

DUMP_DB_AND_NEXT_ID($ROWS, $ni);
GOTO($THIS_PHP_FILE);

?>