<?php

if (empty($_GET['expired_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['expired_id'] = stripslashes($_GET['expired_id']);
}

$expired_id = RETURN_ID_FROM($_GET['expired_id']);
CHECK_ID_EXIST($expired_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('�s��L��');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&expired_id='.$expired_id, 'CHECK_SAVE_EXPIRED');
	FORM_INPUT_TEXT('�W��', 'expired_name', 32, $row[EXPIRED_NAME]);
	FORM_SELECT('�֦�', 'expired_client_id', RETURN_CLIENT_OPTIONS($row[EXPIRED_CLIENT_ID]));
	FORM_INPUT_TEXT('��m', 'expired_location', 32, $row[EXPIRED_LOCATION]);
	FORM_DATE_TIME('�L����', 'expired', $row[EXPIRED_TIME]);
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_EXPIRED_SAVE]), '�x�s');

HTML_OUTPUT();
?>