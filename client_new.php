<?php

if (empty($THIS_STAFF_RINGS[RING_CLIENT_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('�s�W�Ȥ�');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_CLIENT');
	FORM_INPUT_TEXT('�W��', 'client_name', 48, '');
	FORM_INPUT_TEXT('�s���q��', 'client_telephone', 32, '');
	FORM_INPUT_TEXT('��~�a�}', 'client_address', 64, '');
	FORM_INPUT_TEXT('����', 'client_tag', 40, '');
	FORM_TEXTAREA('�ݩ�', 'client_property', 24, '');
FORM_FOOTER(TRUE, '�s�W');

HTML_OUTPUT();

?>