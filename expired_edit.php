<?php

if (empty($_GET['expired_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['expired_id'] = stripslashes($_GET['expired_id']);
}

$expired_id = RETURN_ID_FROM($_GET['expired_id']);
CHECK_ID_EXIST($expired_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('編輯過期');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&expired_id='.$expired_id, 'CHECK_SAVE_EXPIRED');
	FORM_INPUT_TEXT('名稱', 'expired_name', 32, $row[EXPIRED_NAME]);
	FORM_SELECT('擁有', 'expired_client_id', RETURN_CLIENT_OPTIONS($row[EXPIRED_CLIENT_ID]));
	FORM_INPUT_TEXT('位置', 'expired_location', 32, $row[EXPIRED_LOCATION]);
	FORM_DATE_TIME('過期日', 'expired', $row[EXPIRED_TIME]);
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_EXPIRED_SAVE]), '儲存');

HTML_OUTPUT();
?>