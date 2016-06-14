<?php

if (empty($THIS_STAFF_RINGS[RING_EXPIRED_ATTACHMENTS])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['expired_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['attachments_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['expired_id'] = stripslashes($_GET['expired_id']);
	$_GET['attachments_id'] = stripslashes($_GET['attachments_id']);
}

$expired_id = RETURN_ID_FROM($_GET['expired_id']);
CHECK_ID_EXIST($expired_id, $ROWS, $ri);

DELETE_ATTACHMENTS(EXPIRED_FILE_ID, $expired_id, $_GET['attachments_id']);
GOTO($THIS_PHP_FILE.'&op=view&expired_id='.$expired_id);

?>