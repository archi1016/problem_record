<?php

function RETURN_CASE_STAFF_OPTIONS($staff_id) {
	global $STAFF_INFORMATION;

	$rt = '<option value="0">(未指定)</option>';
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

HTML_HEADER('新增案例');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_CASE');
	FORM_SELECT('客戶', 'case_client_id', RETURN_CLIENT_OPTIONS(-1));
	FORM_INPUT_TEXT('標題', 'case_title', 64, '');
	FORM_TEXTAREA('詳細內容', 'case_content', 12, '');
	FORM_INPUT_TEXT('標籤', 'case_tag', 48, '');
	FORM_SELECT('指定人員', 'case_staff_id', RETURN_CASE_STAFF_OPTIONS(-1));
	FORM_DATE_TIME('生效時間', 'case', NULL);
FORM_FOOTER(TRUE, '新增');

HTML_OUTPUT();

?>