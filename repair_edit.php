<?php

if (empty($_GET['repair_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['repair_id'] = stripslashes($_GET['repair_id']);
}

$repair_id = RETURN_ID_FROM($_GET['repair_id']);
CHECK_ID_EXIST($repair_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('�s��e��');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&repair_id='.$repair_id, 'CHECK_SAVE_REPAIR');
	FORM_SELECT('�Ȥ�', 'repair_client_id', RETURN_CLIENT_OPTIONS($row[REPAIR_CLIENT_ID]));
	FORM_INPUT_TEXT('�W��', 'repair_name', 64, $row[REPAIR_NAME]);
	FORM_INPUT_TEXT('��]', 'repair_reason', 64, $row[REPAIR_REASON]);
	FORM_TEXTAREA('�ѧO���', 'repair_serial_ids', 6, $row[REPAIR_SERIAL_IDS]);
	FORM_SELECT('�e�פH', 'repair_staff_id', RETURN_STAFF_OPTIONS($row[REPAIR_STAFF_ID]));
	FORM_SELECT('�e�׼t��', 'repair_supplier_id', RETURN_SUPPLIER_OPTIONS($row[REPAIR_SUPPLIER_ID]));
	FORM_DATE_TIME('�e�׮ɶ�', 'repair', $row[REPAIR_RETURN]);
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_REPAIR_SAVE]), '�x�s');

HTML_OUTPUT();

?>