<?php

function RETURN_STATUS_OPTIONS($v) {
	$oa = array('停用', '正常', '報廢', '遺失');
	$v = (int) $v;
	$rt = '';
	$c = count($oa);
	$i = 0;
	while ($i < $c) {
		if ($i != $v) {
			$s = '';
		} else {
			$s = ' selected="selected"';
		}
		$rt .= '<option value="'.$i.'"'.$s.'>'.$oa[$i].'</option>';
		++$i;
	}
	return $rt;
}

if (empty($_GET['standby_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['standby_id'] = stripslashes($_GET['standby_id']);
}

$standby_id = RETURN_ID_FROM($_GET['standby_id']);
CHECK_ID_EXIST($standby_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('編輯備品');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&standby_id='.$standby_id, 'CHECK_SAVE_STANDBY');
	FORM_SELECT('狀態', 'standby_status', RETURN_STATUS_OPTIONS($row[STANDBY_STATUS]));
	FORM_INPUT_TEXT('名稱', 'standby_name', 48, $row[STANDBY_NAME]);
	FORM_INPUT_TEXT('存放位置', 'standby_location', 32, $row[STANDBY_LOCATION]);
	FORM_TEXTAREA('識別資料', 'standby_serial_ids', 12, $row[STANDBY_SERIAL_IDS]);
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_STANDBY_SAVE]), '儲存');

HTML_OUTPUT();

?>