<?php

if (empty($THIS_STAFF_RINGS[RING_STANDBY_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('新增備品');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_STANDBY');
	FORM_INPUT_TEXT('名稱', 'standby_name', 48, '');
	FORM_INPUT_TEXT('存放位置', 'standby_location', 32, '');
	FORM_TEXTAREA('識別資料', 'standby_serial_ids', 12, '');
FORM_FOOTER(TRUE, '新增');

HTML_OUTPUT();

?>