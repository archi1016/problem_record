<?php

if (empty($THIS_STAFF_RINGS[RING_GROUP_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('新增族群');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_GROUP');
	FORM_INPUT_TEXT('名稱', 'group_name', 32, '');
	FORM_INPUT_ANY('案例', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_CASE));
	FORM_INPUT_ANY('送修', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_REPAIR));
	FORM_INPUT_ANY('標記', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_MARK));
	FORM_INPUT_ANY('出借', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_LEND));
	FORM_INPUT_ANY('出貨', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_SALE));
	FORM_INPUT_ANY('外派', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_OUT));
	FORM_INPUT_ANY('檔案', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_FILE));
	FORM_INPUT_ANY('過期', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_EXPIRED));
	FORM_INPUT_ANY('客戶', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_CLIENT));
	FORM_INPUT_ANY('廠商', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_SUPPLIER));
	FORM_INPUT_ANY('備品', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_STANDBY));
	FORM_INPUT_ANY('歸類', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_CATEGORY));
	FORM_INPUT_ANY('員工', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_STAFF));
	FORM_INPUT_ANY('族群', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_GROUP));
FORM_FOOTER(TRUE, '新增');


HTML_OUTPUT();

?>