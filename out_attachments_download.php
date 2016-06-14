<?php

if (empty($_GET['out_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['attachments_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['out_id'] = stripslashes($_GET['out_id']);
	$_GET['attachments_id'] = stripslashes($_GET['attachments_id']);
}

$out_id = RETURN_ID_FROM($_GET['out_id']);
CHECK_ID_EXIST($out_id, $ROWS, $ri);
SEND_ATTACHMENTS(OUT_FILE_ID, $out_id, $_GET['attachments_id']);

?>