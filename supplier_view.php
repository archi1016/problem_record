<?php

if (empty($_GET['supplier_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['supplier_id'] = stripslashes($_GET['supplier_id']);
}

$supplier_id = RETURN_ID_FROM($_GET['supplier_id']);
CHECK_ID_EXIST($supplier_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('廠商 #'.$supplier_id.': '.$row[SUPPLIER_NAME]);
MENU_BAR();

VIEW_HEADER('廠商 #'.$supplier_id);
	VIEW_ROW('名稱', $row[SUPPLIER_NAME]);
	VIEW_ROW('連絡電話', RETURN_TELEPHONE($row[SUPPLIER_TELEPHONE]));
	VIEW_ROW('營業地址', RETURN_ADDRESS($row[SUPPLIER_ADDRESS]));
	VIEW_ROWS('附件', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_SUPPLIER_ATTACHMENTS], SUPPLIER_FILE_ID, 'supplier_id', $supplier_id));
VIEW_FOOTER();

if (!empty($THIS_STAFF_RINGS[RING_SUPPLIER_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&supplier_id='.$supplier_id);
}

HTML_OUTPUT();

?>