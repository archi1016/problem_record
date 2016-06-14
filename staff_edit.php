<?php

function RETURN_GROUP_OPTIONS($staff_group_id) {
	global $GROUP_INFORMATION;

	$rt = '';
	foreach ($GROUP_INFORMATION as $ID => $VALUE) {
		if ($staff_group_id != $ID) {
			$s = '';
		} else {
			$s = ' selected="selected"';
		}
		$rt .= '<option value="'.$ID.'"'.$s.'>'.$VALUE['name'].'</option>';
	}
	return $rt;
}

function RETURN_STATUS_OPTIONS($v) {
	if (!empty($v)) {
		return '<option value="0">已離職</option><option value="1" selected="selected">在職</option>';
	} else {
		return '<option value="0" selected="selected">已離職</option><option value="1">在職</option>';
	}
}

if (empty($_GET['staff_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['staff_id'] = stripslashes($_GET['staff_id']);
}

$staff_id = RETURN_ID_FROM($_GET['staff_id']);
CHECK_ID_EXIST($staff_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('編輯員工');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&staff_id='.$staff_id, 'CHECK_SAVE_STAFF');
	FORM_INPUT_TEXT('登入帳號', 'staff_acc', 32, $row[STAFF_ACCOUNT]);
	FORM_SELECT('狀態', 'staff_status', RETURN_STATUS_OPTIONS($row[STAFF_STATUS]));
	if (empty($THIS_STAFF_RINGS[RING_STAFF_CHANGE_GRP])) {
		HTML_ADD('<tr><td>隸屬族群:</td><td>'.RETURN_GROUP_NAME_BY_GROUP_ID($row[STAFF_GROUP_ID]).'<input type="hidden" name="staff_group_id" value="'.$row[STAFF_GROUP_ID].'" /></td></tr>');
	} else {
		FORM_SELECT('隸屬族群', 'staff_group_id', RETURN_GROUP_OPTIONS($row[STAFF_GROUP_ID]));
	}
	FORM_INPUT_TEXT('姓名', 'staff_name', 32, $row[STAFF_NAME]);
	FORM_INPUT_TEXT('連絡電話', 'staff_telephone', 32, $row[STAFF_TELEPHONE]);
	if (empty($THIS_STAFF_RINGS[RING_STAFF_CHANGE_PWD])) {
		HTML_ADD('<tr><td>修改密碼:</td><td>&nbsp;<input type="hidden" name="staff_pwd" value="" /><input type="hidden" name="staff_pwd2" value="" /></td></tr>');
	} else {
		FORM_INPUT_PASSWORD('修改密碼', 'staff_pwd', 32, '');
		FORM_INPUT_PASSWORD('確認密碼', 'staff_pwd2', 32, '');
	}
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_STAFF_SAVE]), '儲存');


HTML_OUTPUT();

?>