<?php

if (empty($THIS_STAFF_RINGS[RING_REPAIR_ATTACHMENTS])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['repair_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_FILES['attachments'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_FILES['attachments']['error'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['repair_id'] = stripslashes($_GET['repair_id']);
}

if (isset($_GET['archive'])) {
	$FILE_DB = RETURN_DB_FILE_PATH(REPAIR_ARCHIVE_FILE_ID);
}
$repair_id = RETURN_ID_FROM($_GET['repair_id']);

CHECK_ID_EXIST($repair_id, $ROWS, $ri);

INSERT_ATTACHMENTS(REPAIR_FILE_ID, $repair_id);
if (isset($_GET['archive'])) {
	GOTO($THIS_PHP_FILE.'&op=archive_view&repair_id='.$repair_id);
} else {
	GOTO($THIS_PHP_FILE.'&op=view&repair_id='.$repair_id);
}

?>