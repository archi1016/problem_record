<?php

if (empty($_GET['expired_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['attachments_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['expired_id'] = stripslashes($_GET['expired_id']);
	$_GET['attachments_id'] = stripslashes($_GET['attachments_id']);
}

$expired_id = RETURN_ID_FROM($_GET['expired_id']);
CHECK_ID_EXIST($expired_id, $ROWS, $ri);
SEND_ATTACHMENTS(EXPIRED_FILE_ID, $expired_id, $_GET['attachments_id']);

?>