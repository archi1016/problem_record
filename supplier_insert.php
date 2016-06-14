<?php

if (empty($THIS_STAFF_RINGS[RING_SUPPLIER_INSERT])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_POST['supplier_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['supplier_telephone'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['supplier_address'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_POST['supplier_name'] = stripslashes($_POST['supplier_name']);
	$_POST['supplier_telephone'] = stripslashes($_POST['supplier_telephone']);
	$_POST['supplier_address'] = stripslashes($_POST['supplier_address']);
}

LOAD_DB_AND_NEXT_ID($ROWS, $rc, $ni);

$ROWS[$rc][SUPPLIER_UID] = $ni;
$row = &$ROWS[$rc];
$row[SUPPLIER_NAME] = $_POST['supplier_name'];
$row[SUPPLIER_TELEPHONE] = $_POST['supplier_telephone'];
$row[SUPPLIER_ADDRESS] = $_POST['supplier_address'];

DUMP_DB_AND_NEXT_ID($ROWS, $ni);
GOTO($THIS_PHP_FILE);

?>