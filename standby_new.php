<?php

if (empty($THIS_STAFF_RINGS[RING_STANDBY_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('�s�W�ƫ~');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_STANDBY');
	FORM_INPUT_TEXT('�W��', 'standby_name', 48, '');
	FORM_INPUT_TEXT('�s���m', 'standby_location', 32, '');
	FORM_TEXTAREA('�ѧO���', 'standby_serial_ids', 12, '');
FORM_FOOTER(TRUE, '�s�W');

HTML_OUTPUT();

?>