<?php

if (empty($THIS_STAFF_RINGS[RING_REPAIR_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('�s�W�e��');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_REPAIR');
	FORM_SELECT('�Ȥ�', 'repair_client_id', RETURN_CLIENT_OPTIONS(-1));
	FORM_INPUT_TEXT('�W��', 'repair_name', 64, '');
	FORM_INPUT_TEXT('��]', 'repair_reason', 64, '');
	FORM_TEXTAREA('�ѧO���', 'repair_serial_ids', 6, '');
	FORM_SELECT('�e�פH', 'repair_staff_id', RETURN_STAFF_OPTIONS(-1));
	FORM_SELECT('�e�׼t��', 'repair_supplier_id', RETURN_SUPPLIER_OPTIONS(-1));
	FORM_DATE_TIME('�e�׮ɶ�', 'repair', NULL);
FORM_FOOTER(TRUE, '�s�W');

HTML_OUTPUT();

?>