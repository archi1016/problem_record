<?php

if (empty($_GET['case_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['reply_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['attachments_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['case_id'] = stripslashes($_GET['case_id']);
	$_GET['reply_id'] = stripslashes($_GET['reply_id']);
	$_GET['attachments_id'] = stripslashes($_GET['attachments_id']);
}

$case_id = RETURN_ID_FROM($_GET['case_id']);
CHECK_ID_EXIST($case_id, $ROWS, $ri);

GET_ATTACHMENTS_FILES($ROWS[$ri][CASE_ARCHIVE_FOLDER], $FILE_DB, $FILE_ID);
$attachments_id = RETURN_ID_FROM($_GET['attachments_id']);
CHECK_ID_EXIST($attachments_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$reply_id = RETURN_ID_FROM($_GET['reply_id']);

if ($reply_id == $row[ATTACHMENTS_FOLLOW_UID]) {
	if (file_exists($row[ATTACHMENTS_FILE_NAME])) {
		SEND_FILE($row);
	} else {
		SHOW_ERROR(ERROR_LOAD_FILE);
	}
} else {
	SHOW_ERROR(ERROR_NO_RING);
}

?>