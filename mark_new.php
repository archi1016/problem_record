<?php

if (empty($THIS_STAFF_RINGS[RING_MARK_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('�s�W�аO');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_MARK');
	FORM_INPUT_TEXT('�W��', 'mark_name', 48, '');
	FORM_SELECT('��H', 'mark_client_id', RETURN_CLIENT_OPTIONS(-1));
	FORM_TEXTAREA('����(�@��@��)', 'mark_items', 12, '');
FORM_FOOTER(TRUE, '�s�W');

HTML_OUTPUT();

?>