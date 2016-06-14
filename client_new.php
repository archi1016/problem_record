<?php

if (empty($THIS_STAFF_RINGS[RING_CLIENT_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('新增客戶');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_CLIENT');
	FORM_INPUT_TEXT('名稱', 'client_name', 48, '');
	FORM_INPUT_TEXT('連絡電話', 'client_telephone', 32, '');
	FORM_INPUT_TEXT('營業地址', 'client_address', 64, '');
	FORM_INPUT_TEXT('標籤', 'client_tag', 40, '');
	FORM_TEXTAREA('屬性', 'client_property', 24, '');
FORM_FOOTER(TRUE, '新增');

HTML_OUTPUT();

?>