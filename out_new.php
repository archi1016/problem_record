<?php

if (empty($THIS_STAFF_RINGS[RING_OUT_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('�s�W�~��');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_OUT');
	FORM_SELECT('�Ȥ�', 'out_client_id', RETURN_CLIENT_OPTIONS(-1));
	FORM_INPUT_TEXT('�ƥ�', 'out_reason', 64, '');
	FORM_SELECT('�H��', 'out_staff_id', RETURN_STAFF_OPTIONS(-1));
	FORM_DATE_TIME('�~�X�ɶ�', 'out', NULL);
FORM_FOOTER(TRUE, '�s�W');

HTML_OUTPUT();

?>