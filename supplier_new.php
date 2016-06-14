<?php

if (empty($THIS_STAFF_RINGS[RING_SUPPLIER_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('新增廠商');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_SUPPLIER');
	FORM_INPUT_TEXT('名稱', 'supplier_name', 48, '');
	FORM_INPUT_TEXT('連絡電話', 'supplier_telephone', 32, '');
	FORM_INPUT_TEXT('營業地址', 'supplier_address', 64, '');
FORM_FOOTER(TRUE, '新增');

HTML_OUTPUT();

?>