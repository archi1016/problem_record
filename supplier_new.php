<?php

if (empty($THIS_STAFF_RINGS[RING_SUPPLIER_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('�s�W�t��');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_SUPPLIER');
	FORM_INPUT_TEXT('�W��', 'supplier_name', 48, '');
	FORM_INPUT_TEXT('�s���q��', 'supplier_telephone', 32, '');
	FORM_INPUT_TEXT('��~�a�}', 'supplier_address', 64, '');
FORM_FOOTER(TRUE, '�s�W');

HTML_OUTPUT();

?>