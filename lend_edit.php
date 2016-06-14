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
	HTML_HEADER('�X��');
	MENU_BAR();

	FORM_HEADER($THIS_PHP_FILE.'&op=save&standby_id='.$standby_id, 'CHECK_SAVE_LEND');
		FORM_INPUT_ANY('�W��', $row[STANDBY_NAME]);
		FORM_SELECT('�Ȥ�', 'standby_client_id', RETURN_CLIENT_OPTIONS($row[STANDBY_CLIENT_ID]));
	FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_LEND_INSERT]), '�s�W');

	HTML_OUTPUT();
} else {
	HTML_HEADER('�s��');
	MENU_BAR();

	FORM_HEADER($THIS_PHP_FILE.'&op=save&standby_id='.$standby_id, 'CHECK_SAVE_LEND');
		FORM_INPUT_ANY('�W��', $row[STANDBY_NAME]);
		FORM_SELECT('�Ȥ�', 'standby_client_id', RETURN_CLIENT_OPTIONS($row[STANDBY_CLIENT_ID]));
	FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_LEND_SAVE]), '�x�s');

	HTML_OUTPUT();
}

?>