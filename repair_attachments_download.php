<?php

if (empty($_GET['repair_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['attachments_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['repair_id'] = stripslashes($_GET['repair_id']);
	$_GET['attachments_id'] = stripslashes($_GET['attachments_id']);
}

if (isset($_GET['archive'])) {
	$FILE_DB = RETURN_DB_FILE_PATH(REPAIR_ARCHIVE_FILE_ID);
}

$repair_id = RETURN_ID_FROM($_GET['repair_id']);
CHECK_ID_EXIST($repair_id, $ROWS, $ri);
SEND_ATTACHMENTS(REPAIR_FILE_ID, $repair_id, $_GET['attachments_id']);

?>