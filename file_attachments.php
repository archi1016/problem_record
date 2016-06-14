<?php

if (empty($THIS_STAFF_RINGS[RING_FILE_ATTACHMENTS])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['file_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_FILES['attachments'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_FILES['attachments']['error'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['file_id'] = stripslashes($_GET['file_id']);
}

$file_id = RETURN_ID_FROM($_GET['file_id']);

CHECK_ID_EXIST($file_id, $ROWS, $ri);

INSERT_ATTACHMENTS(FILE_FILE_ID, $file_id);
GOTO($THIS_PHP_FILE.'&op=view&file_id='.$file_id);

?>