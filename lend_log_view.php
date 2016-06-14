<?php

if (empty($_GET['lend_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['lend_id'] = stripslashes($_GET['lend_id']);
}

$lend_id = RETURN_ID_FROM($_GET['lend_id']);
CHECK_ID_EXIST($lend_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$sn = RETURN_STANDBY_NAME_BY_STANDBY_ID($row[LEND_STANDBY_ID], FALSE);

HTML_HEADER('�X�ɰO�� #'.$lend_id.': '.$sn);
MENU_BAR();

VIEW_HEADER('�X�ɰO�� #'.$lend_id);
	VIEW_ROW('�ƫ~', $sn);
	VIEW_ROW('�X�ɫȤ�', RETURN_CLIENT_NAME_BY_CLIENT_ID($row[LEND_CLIENT_ID], TRUE));
	if (!empty($row[LEND_TIME])) {
		VIEW_ROW('�X�ɮɶ�', $row[LEND_TIME].'<span class="more">('.RETURN_FRIENDLY_TIME_STR($row[LEND_TIME]).')</span>');
		VIEW_ROW('�k�ٮɶ�', $row[LEND_TIME_RETURN].'<span class="more">('.RETURN_FRIENDLY_TIME_STR($row[LEND_TIME_RETURN]).')</span>');
	}
	VIEW_ROWS('�ѧO���', RETURN_STANDBY_SERIAL_IDS_BY_STANDBY_ID($row[LEND_STANDBY_ID]));
	VIEW_ROWS('����', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_LEND_ATTACHMENTS], LEND_FILE_ID, 'lend_id', $lend_id));
VIEW_FOOTER();

if (!empty($THIS_STAFF_RINGS[RING_LEND_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&lend_id='.$lend_id);
}

HTML_OUTPUT();

?>