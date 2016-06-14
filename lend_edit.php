<?php

if (empty($_GET['standby_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['standby_id'] = stripslashes($_GET['standby_id']);
}

$FILE_DB = RETURN_DB_FILE_PATH(STANDBY_FILE_ID);

$standby_id = RETURN_ID_FROM($_GET['standby_id']);
CHECK_ID_EXIST($standby_id, $ROWS, $ri);
$row = &$ROWS[$ri];

if (empty($row[STANDBY_CLIENT_ID])) {
	HTML_HEADER('出借');
	MENU_BAR();

	FORM_HEADER($THIS_PHP_FILE.'&op=save&standby_id='.$standby_id, 'CHECK_SAVE_LEND');
		FORM_INPUT_ANY('名稱', $row[STANDBY_NAME]);
		FORM_SELECT('客戶', 'standby_client_id', RETURN_CLIENT_OPTIONS($row[STANDBY_CLIENT_ID]));
	FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_LEND_INSERT]), '新增');

	HTML_OUTPUT();
} else {
	HTML_HEADER('編輯');
	MENU_BAR();

	FORM_HEADER($THIS_PHP_FILE.'&op=save&standby_id='.$standby_id, 'CHECK_SAVE_LEND');
		FORM_INPUT_ANY('名稱', $row[STANDBY_NAME]);
		FORM_SELECT('客戶', 'standby_client_id', RETURN_CLIENT_OPTIONS($row[STANDBY_CLIENT_ID]));
	FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_LEND_SAVE]), '儲存');

	HTML_OUTPUT();
}

?>