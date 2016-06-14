<?php

if (empty($_GET['supplier_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['attachments_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['supplier_id'] = stripslashes($_GET['supplier_id']);
	$_GET['attachments_id'] = stripslashes($_GET['attachments_id']);
}

$supplier_id = RETURN_ID_FROM($_GET['supplier_id']);
CHECK_ID_EXIST($supplier_id, $ROWS, $ri);
SEND_ATTACHMENTS(SUPPLIER_FILE_ID, $supplier_id, $_GET['attachments_id']);

?>