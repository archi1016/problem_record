<?php

if (empty($THIS_STAFF_RINGS[RING_EXPIRED_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('新增過期');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_EXPIRED');
	FORM_INPUT_TEXT('名稱', 'expired_name', 32, '');
	FORM_SELECT('擁有', 'expired_client_id', RETURN_CLIENT_OPTIONS(-1));
	FORM_INPUT_TEXT('位置', 'expired_location', 32, '');
	FORM_DATE_TIME('過期日', 'expired', NULL);
FORM_FOOTER(TRUE, '新增');

HTML_OUTPUT();

?>