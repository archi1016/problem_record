<?php

if (empty($_GET['case_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_reply_content'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_reply_attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['case_id'] = stripslashes($_GET['case_id']);
	$_POST['case_reply_content'] = stripslashes($_POST['case_reply_content']);
}
$_POST['case_reply_content'] = str_replace("\r", '', $_POST['case_reply_content']);
$_POST['case_reply_content'] = str_replace("\n", '\n', $_POST['case_reply_content']);

$case_id = RETURN_ID_FROM($_GET['case_id']);

CHECK_ID_EXIST($case_id, $ROWS, $ri);

$row = &$ROWS[$ri];
$is_attachments = FALSE;
if (isset($_FILES['case_reply_attachments'])) {
	if (isset($_POST['case_reply_attachments_fn'])) {
		if (is_array($_FILES['case_reply_attachments']['error'])) {
			if (is_array($_POST['case_reply_attachments_fn'])) {
				$is_attachments = TRUE;
			}
		}
	}
}
WRITE_CASE_REPLY($row[CASE_ARCHIVE_FOLDER], CASE_REPLY_TYPE_STAFF, $_POST['case_reply_content'], $_SESSION['UID'], $is_attachments);
GOTO($THIS_PHP_FILE.'&case_id='.$case_id.'&op=thread');

?>