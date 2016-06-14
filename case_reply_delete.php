<?php

function DELETE_REPLY_ATTACHMENTS($archive_folder, $reply_id) {
	GET_ATTACHMENTS_FILES($archive_folder, $FILE_DB, $FILE_ID);
	if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
		$rc = count($ROWS);
		if ($rc > 0) {
			$ri = $rc - 1;
			while ($ri >= 0) {
				$row = &$ROWS[$ri];
				if ($reply_id == $row[ATTACHMENTS_FOLLOW_UID]) {
					if (file_exists($row[ATTACHMENTS_FILE_NAME])) {
						@unlink($row[ATTACHMENTS_FILE_NAME]);
					}
					unset($ROWS[$ri]);
				}
				--$ri;
			}
			DUMP_TEXT_TABLE($FILE_DB, $ROWS);
		}
	}
}

if (empty($_GET['case_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['reply_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['case_id'] = stripslashes($_GET['case_id']);
	$_GET['reply_id'] = stripslashes($_GET['reply_id']);
}

$case_id = RETURN_ID_FROM($_GET['case_id']);
CHECK_ID_EXIST($case_id, $ROWS, $ri);

$row = &$ROWS[$ri];
GET_REPLY_FILES($row[CASE_ARCHIVE_FOLDER], $FILE_DB, $FILE_ID);

$reply_id = RETURN_ID_FROM($_GET['reply_id']);
CHECK_ID_EXIST($reply_id, $ROWS, $ri);
if ($_SESSION['UID'] == $ROWS[$ri][CASE_REPLY_STAFF_ID]) {
	DELETE_REPLY_ATTACHMENTS($row[CASE_ARCHIVE_FOLDER], $reply_id);

	unset($ROWS[$ri]);
	if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
		GOTO($THIS_PHP_FILE.'&case_id='.$case_id.'&op=thread');
	} else {
		SHOW_ERROR(ERROR_DUMP_FILE);
	}
} else {
	SHOW_ERROR(ERROR_NO_RING);
}

?>