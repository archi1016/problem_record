<?php

function RETURN_COOPERATION_OPTIONS($v) {
	$oa = array('�פ�', '���`', '�Ȱ�');
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

if (empty($_GET['client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['client_id'] = stripslashes($_GET['client_id']);
}

$client_id = RETURN_ID_FROM($_GET['client_id']);
CHECK_ID_EXIST($client_id, $ROWS, $ri);
$row = &$ROWS[$ri];


HTML_HEADER('�s��Ȥ�');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&client_id='.$client_id, 'CHECK_SAVE_CLIENT');
	FORM_SELECT('�X�@���t', 'client_cooperation', RETURN_COOPERATION_OPTIONS($row[CLIENT_COOPERATION]));
	FORM_INPUT_TEXT('�W��', 'client_name', 48, $row[CLIENT_NAME]);
	FORM_INPUT_TEXT('�s���q��', 'client_telephone', 32, $row[CLIENT_TELEPHONE]);
	FORM_INPUT_TEXT('��~�a�}', 'client_address', 64, $row[CLIENT_ADDRESS]);
	FORM_INPUT_TEXT('����', 'client_tag', 40, $row[CLIENT_TAG]);
	FORM_TEXTAREA('�ݩ�', 'client_property', 24, $row[CLIENT_PROPERTY]);
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_CLIENT_SAVE]), '�x�s');

HTML_OUTPUT();

?>