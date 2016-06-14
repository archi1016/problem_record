<?php

if (empty($THIS_STAFF_RINGS[RING_MARK_SAVE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['mark_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['mark_client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['mark_name'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['mark_id'] = stripslashes($_GET['mark_id']);
	$_POST['mark_client_id'] = stripslashes($_POST['mark_client_id']);
	$_POST['mark_name'] = stripslashes($_POST['mark_name']);
}

$mark_id = RETURN_ID_FROM($_GET['mark_id']);
CHECK_ID_EXIST($mark_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$row[MARK_CLIENT_ID] = $_POST['mark_client_id'];
$row[MARK_NAME] = $_POST['mark_name'];

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>