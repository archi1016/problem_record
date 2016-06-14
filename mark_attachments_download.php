<?php

if (empty($_GET['mark_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['attachments_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['mark_id'] = stripslashes($_GET['mark_id']);
	$_GET['attachments_id'] = stripslashes($_GET['attachments_id']);
}

$mark_id = RETURN_ID_FROM($_GET['mark_id']);
CHECK_ID_EXIST($mark_id, $ROWS, $ri);
SEND_ATTACHMENTS(MARK_FILE_ID, $mark_id, $_GET['attachments_id']);

?>