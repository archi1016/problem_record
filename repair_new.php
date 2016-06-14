<?php

if (empty($THIS_STAFF_RINGS[RING_REPAIR_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('新增送修');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_REPAIR');
	FORM_SELECT('客戶', 'repair_client_id', RETURN_CLIENT_OPTIONS(-1));
	FORM_INPUT_TEXT('名稱', 'repair_name', 64, '');
	FORM_INPUT_TEXT('原因', 'repair_reason', 64, '');
	FORM_TEXTAREA('識別資料', 'repair_serial_ids', 6, '');
	FORM_SELECT('送修人', 'repair_staff_id', RETURN_STAFF_OPTIONS(-1));
	FORM_SELECT('送修廠商', 'repair_supplier_id', RETURN_SUPPLIER_OPTIONS(-1));
	FORM_DATE_TIME('送修時間', 'repair', NULL);
FORM_FOOTER(TRUE, '新增');

HTML_OUTPUT();

?>