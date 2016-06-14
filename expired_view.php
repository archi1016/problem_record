<?php

if (empty($_GET['expired_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['expired_id'] = stripslashes($_GET['expired_id']);
}

$expired_id = RETURN_ID_FROM($_GET['expired_id']);
CHECK_ID_EXIST($expired_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('�L�� #'.$expired_id.': '.$row[EXPIRED_NAME]);
MENU_BAR();

VIEW_HEADER('�L�� #'.$expired_id);
	VIEW_ROW('�W��', $row[EXPIRED_NAME]);
	VIEW_ROW('�֦�', RETURN_CLIENT_NAME_BY_CLIENT_ID($row[SALE_CLIENT_ID], TRUE));
	VIEW_ROW('��m', $row[EXPIRED_LOCATION]);
	if (strtotime(date('Y-m-d H:i')) >= strtotime($row[EXPIRED_TIME])) {
		VIEW_ROW('���A', '�w�L��<span class="more">('.RETURN_FRIENDLY_TIME_STR($row[EXPIRED_TIME]).')</span>');
	} else {
		VIEW_ROW('���A', '���L��<span class="more">('.RETURN_FRIENDLY_EXPIRED_TIME_STR($row[EXPIRED_TIME]).')</span>');
	}
	VIEW_ROWS('����', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_EXPIRED_ATTACHMENTS], EXPIRED_FILE_ID, 'expired_id', $expired_id));
VIEW_FOOTER();

if (!empty($THIS_STAFF_RINGS[RING_EXPIRED_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&expired_id='.$expired_id);
}

HTML_OUTPUT();

?>