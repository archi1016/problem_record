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

HTML_HEADER('�X��: '.$row[STANDBY_NAME].' #'.$standby_id);
MENU_BAR();

VIEW_HEADER('�X��');
	VIEW_ROW('�ƫ~', $row[STANDBY_NAME].' #'.$standby_id);
	if (!empty($row[STANDBY_CLIENT_ID])) {
		VIEW_ROW('�X�ɫȤ�', RETURN_CLIENT_NAME_BY_CLIENT_ID($row[STANDBY_CLIENT_ID], TRUE));
		VIEW_ROW('�X�ɮɶ�', $row[STANDBY_LEND_TIME].'<span class="more">('.RETURN_FRIENDLY_TIME_STR($row[STANDBY_LEND_TIME]).')</span>');
	}
	VIEW_ROWS('�ѧO���', $row[STANDBY_SERIAL_IDS]);
	if (!empty($row[STANDBY_LEND_ID])) {
		VIEW_ROWS('����', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_LEND_ATTACHMENTS], LEND_FILE_ID, 'lend_id', $row[STANDBY_LEND_ID]));
	}
VIEW_FOOTER();

if (!empty($row[STANDBY_LEND_ID])) {
	if (!empty($THIS_STAFF_RINGS[RING_LEND_ATTACHMENTS])) {
		FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&lend_id='.$row[STANDBY_LEND_ID]);
	}
}

HTML_OUTPUT();

?>