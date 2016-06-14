<?php

if (empty($_GET['repair_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['repair_id'] = stripslashes($_GET['repair_id']);
}

$repair_id = RETURN_ID_FROM($_GET['repair_id']);
CHECK_ID_EXIST($repair_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('�e�פ� #'.$repair_id.': '.$row[REPAIR_NAME]);
MENU_BAR();

VIEW_HEADER('�e�פ� #'.$repair_id);
	VIEW_ROW('�W��', $row[REPAIR_NAME]);
	VIEW_ROW('�Ȥ�', RETURN_CLIENT_NAME_BY_CLIENT_ID($row[REPAIR_CLIENT_ID], TRUE));
	VIEW_ROW('��]', $row[REPAIR_REASON]);
	VIEW_ROWS('�ѧO���', $row[REPAIR_SERIAL_IDS]);
	VIEW_ROW('�e�פH', RETURN_STAFF_NAME_BY_STAFF_ID($row[REPAIR_STAFF_ID], TRUE));
	VIEW_ROW('�e�׼t��', RETURN_SUPPLIER_NAME_BY_SUPPLIER_ID($row[REPAIR_SUPPLIER_ID], TRUE));
	VIEW_ROW('�e�׮ɶ�', $row[REPAIR_TIME].'<span class="more">('.RETURN_FRIENDLY_TIME_STR($row[REPAIR_TIME]).')</span>');
	VIEW_ROWS('����', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_REPAIR_ATTACHMENTS], REPAIR_FILE_ID, 'repair_id', $repair_id));
VIEW_FOOTER();

if (!empty($THIS_STAFF_RINGS[RING_REPAIR_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&repair_id='.$repair_id);
}

HTML_OUTPUT();

?>