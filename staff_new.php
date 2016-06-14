<?php

if (empty($THIS_STAFF_RINGS[RING_STAFF_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('新增員工');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_STAFF');
	FORM_INPUT_TEXT('登入帳號', 'staff_acc', 32, '');
	FORM_INPUT_PASSWORD('登入密碼', 'staff_pwd', 32, '');
	FORM_INPUT_PASSWORD('確認密碼', 'staff_pwd2', 32, '');
	FORM_INPUT_TEXT('姓名', 'staff_name', 32, '');
	FORM_INPUT_TEXT('連絡電話', 'staff_telephone', 32, '');
FORM_FOOTER(TRUE, '新增');


HTML_OUTPUT();

?>