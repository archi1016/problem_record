<?php

if (empty($_GET['out_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['out_id'] = stripslashes($_GET['out_id']);
}

$out_id = RETURN_ID_FROM($_GET['out_id']);
CHECK_ID_EXIST($out_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('編輯外派');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&out_id='.$out_id, 'CHECK_SAVE_OUT');
	FORM_SELECT('客戶', 'out_client_id', RETURN_CLIENT_OPTIONS($row[OUT_CLIENT_ID]));
	FORM_INPUT_TEXT('事由', 'out_reason', 64, $row[OUT_REASON]);
	FORM_SELECT('人員', 'out_staff_id', RETURN_STAFF_OPTIONS($row[OUT_STAFF_ID]));
	FORM_DATE_TIME('外出時間', 'out', $row[OUT_TIME]);
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_OUT_SAVE]), '儲存');

HTML_OUTPUT();

?>