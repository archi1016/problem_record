<?php

if (empty($THIS_STAFF_RINGS[RING_MARK_INSERT])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_POST['mark_client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['mark_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['mark_items'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_POST['mark_client_id'] = stripslashes($_POST['mark_client_id']);
	$_POST['mark_name'] = stripslashes($_POST['mark_name']);
	$_POST['mark_items'] = stripslashes($_POST['mark_items']);
}
$_POST['mark_items'] = str_replace("\r", '', $_POST['mark_items']);

$items = explode("\n", $_POST['mark_items']);
$c = count($items);
$i = 0;
while ($i < $c) {
	$items[$i] = trim($items[$i]);
	if ($items[$i] != '') {
		$mark_items[] = $items[$i];
	}
	++$i;
}
if (!isset($mark_items)) SHOW_ERROR(ERROR_ARGUMENTS);


LOAD_DB_AND_NEXT_ID($ROWS, $rc, $ni);

$ROWS[$rc][MARK_UID] = $ni;
$row = &$ROWS[$rc];
$row[MARK_CLIENT_ID] = $_POST['mark_client_id'];
$row[MARK_NAME] = $_POST['mark_name'];

CHECK_AND_CREATE_FOLDER(RETURN_DB_SUB_FOLDER(MARK_FILE_ID, $row[MARK_UID]));

GET_MARK_ITEM_FILE(MARK_FILE_ID, $row[MARK_UID], $ITEM_DB);
$c = count($mark_items);
$i = 0;
while ($i < $c) {
	$item_rows[$i][MARK_ITEM_UID] = $i + 1;
	$item_row = &$item_rows[$i];
	$item_row[MARK_ITEM_NAME] = $mark_items[$i];
	$item_row[MARK_ITEM_STATUS] = '0';
	$item_row[MARK_ITEM_TIME] = '';
	$item_row[MARK_ITEM_README] = '';
	++$i;
}
if (DUMP_TEXT_TABLE($ITEM_DB, $item_rows)) {
	DUMP_DB_AND_NEXT_ID($ROWS, $ni);
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>