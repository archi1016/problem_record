<?php

if (empty($_GET['mark_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['mark_id'] = stripslashes($_GET['mark_id']);
}

$mark_id = RETURN_ID_FROM($_GET['mark_id']);
CHECK_ID_EXIST($mark_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('編輯標記');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&mark_id='.$mark_id, 'CHECK_SAVE_MARK');
	FORM_INPUT_TEXT('名稱', 'mark_name', 48, $row[MARK_NAME]);
	FORM_SELECT('對象', 'mark_client_id', RETURN_CLIENT_OPTIONS($row[MARK_CLIENT_ID]));
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_MARK_SAVE]), '儲存');

HTML_OUTPUT();

?>