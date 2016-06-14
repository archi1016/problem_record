<?php

if (empty($_GET['lend_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['attachments_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['lend_id'] = stripslashes($_GET['lend_id']);
	$_GET['attachments_id'] = stripslashes($_GET['attachments_id']);
}

$lend_id = RETURN_ID_FROM($_GET['lend_id']);
CHECK_ID_EXIST($lend_id, $ROWS, $ri);
SEND_ATTACHMENTS(LEND_FILE_ID, $lend_id, $_GET['attachments_id']);

?>