<?php

if (empty($_GET['supplier_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['supplier_id'] = stripslashes($_GET['supplier_id']);
}

$supplier_id = RETURN_ID_FROM($_GET['supplier_id']);
CHECK_ID_EXIST($supplier_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('�t�� #'.$supplier_id.': '.$row[SUPPLIER_NAME]);
MENU_BAR();

VIEW_HEADER('�t�� #'.$supplier_id);
	VIEW_ROW('�W��', $row[SUPPLIER_NAME]);
	VIEW_ROW('�s���q��', RETURN_TELEPHONE($row[SUPPLIER_TELEPHONE]));
	VIEW_ROW('��~�a�}', RETURN_ADDRESS($row[SUPPLIER_ADDRESS]));
	VIEW_ROWS('����', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_SUPPLIER_ATTACHMENTS], SUPPLIER_FILE_ID, 'supplier_id', $supplier_id));
VIEW_FOOTER();

if (!empty($THIS_STAFF_RINGS[RING_SUPPLIER_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&supplier_id='.$supplier_id);
}

HTML_OUTPUT();

?>