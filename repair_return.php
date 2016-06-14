<?php

if (empty($THIS_STAFF_RINGS[RING_REPAIR_RETURN])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['repair_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['repair_id'] = stripslashes($_GET['repair_id']);
}

$repair_id = RETURN_ID_FROM($_GET['repair_id']);
CHECK_ID_EXIST($repair_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('取回: '.$row[REPAIR_NAME]);
MENU_BAR();

VIEW_HEADER('取回');
	VIEW_ROW('名稱', $row[REPAIR_NAME]);
	VIEW_ROW('客戶', RETURN_CLIENT_NAME_BY_CLIENT_ID($row[REPAIR_CLIENT_ID], TRUE));
	VIEW_ROW('原因', $row[REPAIR_REASON]);
	VIEW_ROWS('識別資料', $row[REPAIR_SERIAL_IDS]);
	VIEW_ROW('送修人', RETURN_STAFF_NAME_BY_STAFF_ID($row[REPAIR_STAFF_ID], TRUE));
	VIEW_ROW('送修廠商', RETURN_SUPPLIER_NAME_BY_SUPPLIER_ID($row[REPAIR_SUPPLIER_ID], TRUE));
	VIEW_ROW('送修時間', $row[REPAIR_TIME].' ('.RETURN_FRIENDLY_TIME_STR($row[REPAIR_TIME]).')');
VIEW_FOOTER();

FORM_HEADER($THIS_PHP_FILE.'&op=close&repair_id='.$repair_id, 'CHECK_RETURN_REPAIR');
	FORM_INPUT_TEXT('送修結果', 'repair_report', 64, '');
	FORM_INPUT_TEXT('維修費用', 'repair_cost', 6, '0');
	FORM_DATE_TIME('取回時間', 'repair', NULL);
FORM_FOOTER(TRUE, '新增');

HTML_OUTPUT();

?>