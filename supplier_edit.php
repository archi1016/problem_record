<?php

if (empty($_GET['supplier_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['supplier_id'] = stripslashes($_GET['supplier_id']);
}

$supplier_id = RETURN_ID_FROM($_GET['supplier_id']);
CHECK_ID_EXIST($supplier_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('�s��t��');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&supplier_id='.$supplier_id, 'CHECK_SAVE_SUPPLIER');
	FORM_INPUT_TEXT('�W��', 'supplier_name', 48, $row[SUPPLIER_NAME]);
	FORM_INPUT_TEXT('�s���q��', 'supplier_telephone', 32, $row[SUPPLIER_TELEPHONE]);
	FORM_INPUT_TEXT('��~�a�}', 'supplier_address', 64, $row[SUPPLIER_ADDRESS]);
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_SUPPLIER_SAVE]), '�x�s');

HTML_OUTPUT();

?>