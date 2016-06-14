<?php

if (empty($_GET['file_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['attachments_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['file_id'] = stripslashes($_GET['file_id']);
	$_GET['attachments_id'] = stripslashes($_GET['attachments_id']);
}

$file_id = RETURN_ID_FROM($_GET['file_id']);
CHECK_ID_EXIST($file_id, $ROWS, $ri);
SEND_ATTACHMENTS(FILE_FILE_ID, $file_id, $_GET['attachments_id']);

?>