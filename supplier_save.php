<?php

if (empty($THIS_STAFF_RINGS[RING_SUPPLIER_SAVE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['supplier_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['supplier_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['supplier_telephone'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['supplier_address'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['supplier_id'] = stripslashes($_GET['supplier_id']);
	$_POST['supplier_name'] = stripslashes($_POST['supplier_name']);
	$_POST['supplier_telephone'] = stripslashes($_POST['supplier_telephone']);
	$_POST['supplier_address'] = stripslashes($_POST['supplier_address']);
}

$supplier_id = RETURN_ID_FROM($_GET['supplier_id']);
CHECK_ID_EXIST($supplier_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$row[SUPPLIER_NAME] = $_POST['supplier_name'];
$row[SUPPLIER_TELEPHONE] = $_POST['supplier_telephone'];
$row[SUPPLIER_ADDRESS] = $_POST['supplier_address'];

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>