<?php

if (empty($THIS_STAFF_RINGS[RING_MARK_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('新增標記');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_MARK');
	FORM_INPUT_TEXT('名稱', 'mark_name', 48, '');
	FORM_SELECT('對象', 'mark_client_id', RETURN_CLIENT_OPTIONS(-1));
	FORM_TEXTAREA('項目(一行一組)', 'mark_items', 12, '');
FORM_FOOTER(TRUE, '新增');

HTML_OUTPUT();

?>