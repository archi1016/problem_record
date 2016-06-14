<?php

if (empty($_GET['sale_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['attachments_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['sale_id'] = stripslashes($_GET['sale_id']);
	$_GET['attachments_id'] = stripslashes($_GET['attachments_id']);
}

$sale_id = RETURN_ID_FROM($_GET['sale_id']);
CHECK_ID_EXIST($sale_id, $ROWS, $ri);
SEND_ATTACHMENTS(SALE_FILE_ID, $sale_id, $_GET['attachments_id']);

?>