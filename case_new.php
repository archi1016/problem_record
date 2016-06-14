<?php

function RETURN_CASE_STAFF_OPTIONS($staff_id) {
	global $STAFF_INFORMATION;

	$rt = '<option value="0">(�����w)</option>';
	foreach ($STAFF_INFORMATION as $ID => $VALUE) {
		if (!empty($VALUE['status'])) {
			if ($ID != $staff_id) {
				$s = '';
			} else {
				$s = ' selected="selected"';
			}
			$rt .= '<option value="'.$ID.'"'.$s.'>'.$VALUE['name'].'</option>';
		}
	}
	return $rt;
}

if (empty($THIS_STAFF_RINGS[RING_CASE_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('�s�W�ר�');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_CASE');
	FORM_SELECT('�Ȥ�', 'case_client_id', RETURN_CLIENT_OPTIONS(-1));
	FORM_INPUT_TEXT('���D', 'case_title', 64, '');
	FORM_TEXTAREA('�ԲӤ��e', 'case_content', 12, '');
	FORM_INPUT_TEXT('����', 'case_tag', 48, '');
	FORM_SELECT('���w�H��', 'case_staff_id', RETURN_CASE_STAFF_OPTIONS(-1));
	FORM_DATE_TIME('�ͮĮɶ�', 'case', NULL);
FORM_FOOTER(TRUE, '�s�W');

HTML_OUTPUT();

?>