<?php

if (empty($_GET['file_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['file_id'] = stripslashes($_GET['file_id']);
}

$file_id = RETURN_ID_FROM($_GET['file_id']);
CHECK_ID_EXIST($file_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('½s¿èÀÉ®×');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&file_id='.$file_id, 'CHECK_SAVE_FILE');
	FORM_INPUT_TEXT('¦WºÙ', 'file_name', 64, $row[FILE_NAME]);
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_FILE_SAVE]), 'Àx¦s');

HTML_OUTPUT();
?>