<?php

if (empty($_GET['repair_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['repair_id'] = stripslashes($_GET['repair_id']);
}

$FILE_DB = RETURN_DB_FILE_PATH(REPAIR_ARCHIVE_FILE_ID);

$repair_id = RETURN_ID_FROM($_GET['repair_id']);
CHECK_ID_EXIST($repair_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('���^: '.$row[REPAIR_ARCHIVE_NAME]);
MENU_BAR();

VIEW_HEADER('���^');
	VIEW_ROW('�W��', $row[REPAIR_ARCHIVE_NAME]);
	VIEW_ROW('�Ȥ�', RETURN_CLIENT_NAME_BY_CLIENT_ID($row[REPAIR_ARCHIVE_CLIENT_ID], TRUE));
	VIEW_ROW('��]', $row[REPAIR_ARCHIVE_REASON]);
	VIEW_ROWS('�ѧO���', $row[REPAIR_ARCHIVE_SERIAL_IDS]);
	VIEW_ROW('�e�פH', RETURN_STAFF_NAME_BY_STAFF_ID($row[REPAIR_ARCHIVE_STAFF_ID], TRUE));
	VIEW_ROW('�e�׼t��', RETURN_SUPPLIER_NAME_BY_SUPPLIER_ID($row[REPAIR_ARCHIVE_SUPPLIER_ID], TRUE));
	VIEW_ROW('�e�׮ɶ�', $row[REPAIR_ARCHIVE_TIME].' ('.RETURN_FRIENDLY_TIME_STR($row[REPAIR_ARCHIVE_TIME]).')');
VIEW_FOOTER();

FORM_HEADER($THIS_PHP_FILE.'&op=archive_save&repair_id='.$repair_id, 'CHECK_EDIT_REPAIR_ARCHIVE');
	FORM_INPUT_TEXT('�e�׵��G', 'repair_report', 64, $row[REPAIR_ARCHIVE_REPORT]);
	FORM_INPUT_TEXT('���׶O��', 'repair_cost', 6, $row[REPAIR_ARCHIVE_COST]);
	FORM_DATE_TIME('���^�ɶ�', 'repair', $row[REPAIR_ARCHIVE_TIME_RETURN]);
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_REPAIR_ARCHIVE_SAVE]), '�x�s');

HTML_OUTPUT();

?>