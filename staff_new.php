<?php

if (empty($THIS_STAFF_RINGS[RING_STAFF_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('�s�W���u');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_STAFF');
	FORM_INPUT_TEXT('�n�J�b��', 'staff_acc', 32, '');
	FORM_INPUT_PASSWORD('�n�J�K�X', 'staff_pwd', 32, '');
	FORM_INPUT_PASSWORD('�T�{�K�X', 'staff_pwd2', 32, '');
	FORM_INPUT_TEXT('�m�W', 'staff_name', 32, '');
	FORM_INPUT_TEXT('�s���q��', 'staff_telephone', 32, '');
FORM_FOOTER(TRUE, '�s�W');


HTML_OUTPUT();

?>