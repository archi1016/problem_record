<?php

if (empty($THIS_STAFF_RINGS[RING_OUT_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('新增外派');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_OUT');
	FORM_SELECT('客戶', 'out_client_id', RETURN_CLIENT_OPTIONS(-1));
	FORM_INPUT_TEXT('事由', 'out_reason', 64, '');
	FORM_SELECT('人員', 'out_staff_id', RETURN_STAFF_OPTIONS(-1));
	FORM_DATE_TIME('外出時間', 'out', NULL);
FORM_FOOTER(TRUE, '新增');

HTML_OUTPUT();

?>