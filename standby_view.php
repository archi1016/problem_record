<?php

if (empty($_GET['standby_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['standby_id'] = stripslashes($_GET['standby_id']);
}

$standby_id = RETURN_ID_FROM($_GET['standby_id']);
CHECK_ID_EXIST($standby_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('備品 #'.$standby_id.': '.$row[STANDBY_NAME]);
MENU_BAR();

VIEW_HEADER('備品 #'.$standby_id);
	VIEW_ROW('名稱', $row[STANDBY_NAME]);
	VIEW_ROW('狀態', RETURN_STANDBY_STATUS($row[STANDBY_STATUS]));
	VIEW_ROW('存放位置', $row[STANDBY_LOCATION]);
	VIEW_ROWS('識別資料', $row[STANDBY_SERIAL_IDS]);
	VIEW_ROWS('附件', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_STANDBY_ATTACHMENTS], STANDBY_FILE_ID, 'standby_id', $standby_id));
VIEW_FOOTER();

if (!empty($THIS_STAFF_RINGS[RING_STANDBY_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&standby_id='.$standby_id);
}

HTML_OUTPUT();

?>