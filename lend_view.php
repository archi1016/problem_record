<?php

if (empty($_GET['standby_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['standby_id'] = stripslashes($_GET['standby_id']);
}

$FILE_DB = RETURN_DB_FILE_PATH(STANDBY_FILE_ID);

$standby_id = RETURN_ID_FROM($_GET['standby_id']);
CHECK_ID_EXIST($standby_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$THIS_PHP_FILE .= '&standby_id='.$standby_id;

HTML_HEADER('出借: '.$row[STANDBY_NAME].' #'.$standby_id);
MENU_BAR();

VIEW_HEADER('出借');
	VIEW_ROW('備品', $row[STANDBY_NAME].' #'.$standby_id);
	if (!empty($row[STANDBY_CLIENT_ID])) {
		VIEW_ROW('出借客戶', RETURN_CLIENT_NAME_BY_CLIENT_ID($row[STANDBY_CLIENT_ID], TRUE));
		VIEW_ROW('出借時間', $row[STANDBY_LEND_TIME].'<span class="more">('.RETURN_FRIENDLY_TIME_STR($row[STANDBY_LEND_TIME]).')</span>');
	}
	VIEW_ROWS('識別資料', $row[STANDBY_SERIAL_IDS]);
	if (!empty($row[STANDBY_LEND_ID])) {
		VIEW_ROWS('附件', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_LEND_ATTACHMENTS], LEND_FILE_ID, 'lend_id', $row[STANDBY_LEND_ID]));
	}
VIEW_FOOTER();

if (!empty($row[STANDBY_LEND_ID])) {
	if (!empty($THIS_STAFF_RINGS[RING_LEND_ATTACHMENTS])) {
		FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&lend_id='.$row[STANDBY_LEND_ID]);
	}
}

HTML_OUTPUT();

?>