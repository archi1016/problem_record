<?php

if (empty($THIS_STAFF_RINGS[RING_GROUP_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('�s�W�ڸs');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_GROUP');
	FORM_INPUT_TEXT('�W��', 'group_name', 32, '');
	FORM_INPUT_ANY('�ר�', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_CASE));
	FORM_INPUT_ANY('�e��', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_REPAIR));
	FORM_INPUT_ANY('�аO', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_MARK));
	FORM_INPUT_ANY('�X��', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_LEND));
	FORM_INPUT_ANY('�X�f', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_SALE));
	FORM_INPUT_ANY('�~��', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_OUT));
	FORM_INPUT_ANY('�ɮ�', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_FILE));
	FORM_INPUT_ANY('�L��', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_EXPIRED));
	FORM_INPUT_ANY('�Ȥ�', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_CLIENT));
	FORM_INPUT_ANY('�t��', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_SUPPLIER));
	FORM_INPUT_ANY('�ƫ~', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_STANDBY));
	FORM_INPUT_ANY('�k��', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_CATEGORY));
	FORM_INPUT_ANY('���u', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_STAFF));
	FORM_INPUT_ANY('�ڸs', RETURN_GROUP_FAMILY(NULL, $RING_FAMILY_GROUP));
FORM_FOOTER(TRUE, '�s�W');


HTML_OUTPUT();

?>