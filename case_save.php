<?php

if (empty($THIS_STAFF_RINGS[RING_CASE_SAVE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['case_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['case_tag'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_title'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_year'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_month'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_day'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['case_hour'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['case_minute'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_content'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['case_id'] = stripslashes($_GET['case_id']);
	$_POST['case_tag'] = stripslashes($_POST['case_tag']);
	$_POST['case_title'] = stripslashes($_POST['case_title']);
	$_POST['case_client_id'] = stripslashes($_POST['case_client_id']);
	$_POST['case_year'] = stripslashes($_POST['case_year']);
	$_POST['case_month'] = stripslashes($_POST['case_month']);
	$_POST['case_day'] = stripslashes($_POST['case_day']);
	$_POST['case_hour'] = stripslashes($_POST['case_hour']);
	$_POST['case_minute'] = stripslashes($_POST['case_minute']);
	$_POST['case_content'] = stripslashes($_POST['case_content']);
}
$_POST['case_content'] = str_replace("\r", '', $_POST['case_content']);
$_POST['case_content'] = str_replace("\n", '\n', $_POST['case_content']);

$case_id = RETURN_ID_FROM($_GET['case_id']);
CHECK_ID_EXIST($case_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$row[CASE_CLIENT_ID] = $_POST['case_client_id'];
$row[CASE_PREDESTINATE_TIME] = $_POST['case_year'].'-'.$_POST['case_month'].'-'.$_POST['case_day'].' '.$_POST['case_hour'].':'.$_POST['case_minute'];
$row[CASE_TAG] = $_POST['case_tag'];
$row[CASE_TITLE] = $_POST['case_title'];
$row[CASE_CONTENT] = $_POST['case_content'];

WRITE_CASE_LOG($row[CASE_ARCHIVE_FOLDER], 'н╫зя╣L', $_SESSION['UID']);

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>