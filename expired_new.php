<?php

if (empty($THIS_STAFF_RINGS[RING_EXPIRED_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('�s�W�L��');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_EXPIRED');
	FORM_INPUT_TEXT('�W��', 'expired_name', 32, '');
	FORM_SELECT('�֦�', 'expired_client_id', RETURN_CLIENT_OPTIONS(-1));
	FORM_INPUT_TEXT('��m', 'expired_location', 32, '');
	FORM_DATE_TIME('�L����', 'expired', NULL);
FORM_FOOTER(TRUE, '�s�W');

HTML_OUTPUT();

?>