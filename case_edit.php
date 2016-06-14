<?php

if (empty($_GET['case_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['case_id'] = stripslashes($_GET['case_id']);
}

$case_id = RETURN_ID_FROM($_GET['case_id']);
CHECK_ID_EXIST($case_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('編輯案例');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&case_id='.$case_id, 'CHECK_SAVE_CASE');
	FORM_SELECT('客戶', 'case_client_id', RETURN_CLIENT_OPTIONS($row[CASE_CLIENT_ID]));
	FORM_INPUT_TEXT('標題', 'case_title', 64, $row[CASE_TITLE]);
	FORM_TEXTAREA('詳細內容', 'case_content', 12, $row[CASE_CONTENT]);
	FORM_INPUT_TEXT('標籤', 'case_tag', 48, '');
	FORM_DATE_TIME('生效時間', 'case', $row[CASE_PREDESTINATE_TIME]);
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_CASE_SAVE]), '儲存');

HTML_OUTPUT();

?>