<?php

if (empty($_GET['file_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['file_id'] = stripslashes($_GET['file_id']);
}

$file_id = RETURN_ID_FROM($_GET['file_id']);
CHECK_ID_EXIST($file_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('�ɮ� #'.$file_id.': '.$row[FILE_NAME]);
MENU_BAR();

VIEW_HEADER('�ɮ� #'.$file_id);
	VIEW_ROW('�W��', $row[FILE_NAME]);
	VIEW_ROWS('����', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_FILE_ATTACHMENTS], FILE_FILE_ID, 'file_id', $file_id));
VIEW_FOOTER();

if (!empty($THIS_STAFF_RINGS[RING_FILE_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&file_id='.$file_id);
}

HTML_OUTPUT();

?>