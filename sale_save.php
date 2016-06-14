<?php

if (empty($THIS_STAFF_RINGS[RING_SALE_SAVE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['sale_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['sale_client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['sale_title'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['sale_year'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['sale_month'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['sale_day'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['sale_hour'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['sale_minute'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['sale_item_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['sale_item_count'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_POST['sale_item_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_POST['sale_item_count'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['sale_id'] = stripslashes($_GET['sale_id']);
	$_POST['sale_client_id'] = stripslashes($_POST['sale_client_id']);
	$_POST['sale_title'] = stripslashes($_POST['sale_title']);
	$_POST['sale_year'] = stripslashes($_POST['sale_year']);
	$_POST['sale_month'] = stripslashes($_POST['sale_month']);
	$_POST['sale_day'] = stripslashes($_POST['sale_day']);
	$_POST['sale_hour'] = stripslashes($_POST['sale_hour']);
	$_POST['sale_minute'] = stripslashes($_POST['sale_minute']);
	$c = count($_POST['sale_item_name']);
	$i = 0;
	while ($i < $c) {
		$_POST['sale_item_name'][$i] = stripslashes($_POST['sale_item_name'][$i]);
		$_POST['sale_item_count'][$i] = stripslashes($_POST['sale_item_count'][$i]);
		++$i;
	}
}

$c = count($_POST['sale_item_name']);
$i = 0;
while ($i < $c) {
	if ($_POST['sale_item_name'][$i] == '') break;
	$items[] = $_POST['sale_item_name'][$i].'<|>'.$_POST['sale_item_count'][$i];
	++$i;
}
if (isset($items)) {
	$content = implode('\n', $items);
} else {
	$content = '';
}


$save_id = RETURN_ID_FROM($_GET['save_id']);
CHECK_ID_EXIST($save_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$row[SALE_CLIENT_ID] = $_POST['sale_client_id'];
$row[SALE_TIME] = $_POST['sale_year'].'-'.$_POST['sale_month'].'-'.$_POST['sale_day'].' '.$_POST['sale_hour'].':'.$_POST['sale_minute'];
$row[SALE_TITLE] = $_POST['sale_title'];
$row[SALE_CONTENT] = $content;

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>