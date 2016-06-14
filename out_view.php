<?php

if (empty($_GET['out_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['out_id'] = stripslashes($_GET['out_id']);
}

$out_id = RETURN_ID_FROM($_GET['out_id']);
CHECK_ID_EXIST($out_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('�~�� #'.$out_id.': '.$row[OUT_REASON]);
MENU_BAR();

VIEW_HEADER('�~�� #'.$out_id);
	VIEW_ROW('�ƥ�', $row[OUT_REASON]);
	VIEW_ROW('�Ȥ�', RETURN_CLIENT_NAME_BY_CLIENT_ID($row[OUT_CLIENT_ID], TRUE));
	VIEW_ROW('�H��', RETURN_STAFF_NAME_BY_STAFF_ID($row[OUT_STAFF_ID], TRUE));
	VIEW_ROW('�ɶ�', $row[OUT_TIME].'<span class="more">('.RETURN_FRIENDLY_TIME_STR($row[OUT_TIME]).')</span>');
	VIEW_ROWS('����', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_OUT_ATTACHMENTS], OUT_FILE_ID, 'out_id', $out_id));
VIEW_FOOTER();

if (!empty($THIS_STAFF_RINGS[RING_OUT_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&out_id='.$out_id);
}

HTML_OUTPUT();

?>