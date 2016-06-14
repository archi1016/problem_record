<?php

if (empty($_GET['lend_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['lend_id'] = stripslashes($_GET['lend_id']);
}

$lend_id = RETURN_ID_FROM($_GET['lend_id']);
CHECK_ID_EXIST($lend_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$sn = RETURN_STANDBY_NAME_BY_STANDBY_ID($row[LEND_STANDBY_ID], FALSE);

HTML_HEADER('出借記錄 #'.$lend_id.': '.$sn);
MENU_BAR();

VIEW_HEADER('出借記錄 #'.$lend_id);
	VIEW_ROW('備品', $sn);
	VIEW_ROW('出借客戶', RETURN_CLIENT_NAME_BY_CLIENT_ID($row[LEND_CLIENT_ID], TRUE));
	if (!empty($row[LEND_TIME])) {
		VIEW_ROW('出借時間', $row[LEND_TIME].'<span class="more">('.RETURN_FRIENDLY_TIME_STR($row[LEND_TIME]).')</span>');
		VIEW_ROW('歸還時間', $row[LEND_TIME_RETURN].'<span class="more">('.RETURN_FRIENDLY_TIME_STR($row[LEND_TIME_RETURN]).')</span>');
	}
	VIEW_ROWS('識別資料', RETURN_STANDBY_SERIAL_IDS_BY_STANDBY_ID($row[LEND_STANDBY_ID]));
	VIEW_ROWS('附件', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_LEND_ATTACHMENTS], LEND_FILE_ID, 'lend_id', $lend_id));
VIEW_FOOTER();

if (!empty($THIS_STAFF_RINGS[RING_LEND_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&lend_id='.$lend_id);
}

HTML_OUTPUT();

?>