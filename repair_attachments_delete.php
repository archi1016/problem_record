<?php

if (empty($THIS_STAFF_RINGS[RING_REPAIR_ATTACHMENTS])) SHOW_ERROR(ERROR_ARGUMENTS);
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

DELETE_ATTACHMENTS(REPAIR_FILE_ID, $repair_id, $_GET['attachments_id']);
if (isset($_GET['archive'])) {
	GOTO($THIS_PHP_FILE.'&op=archive_view&repair_id='.$repair_id);
} else {
	GOTO($THIS_PHP_FILE.'&op=view&repair_id='.$repair_id);
}

?>