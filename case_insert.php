<?php

if (empty($THIS_STAFF_RINGS[RING_CASE_INSERT])) SHOW_ERROR(ERROR_NO_RING);
if (!isset($_POST['case_tag'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_title'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['case_staff_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_year'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_month'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_day'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['case_hour'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['case_minute'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['case_content'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_POST['case_tag'] = stripslashes($_POST['case_tag']);
	$_POST['case_title'] = stripslashes($_POST['case_title']);
	$_POST['case_staff_id'] = stripslashes($_POST['case_staff_id']);
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

if (!empty($_POST['case_staff_id'])) {
	if (!isset($STAFF_INFORMATION[$_POST['case_staff_id']])) {
		SHOW_ERROR(ERROR_ARGUMENTS);
	}
}

if (!isset($CLIENT_INFORMATION[$_POST['case_client_id']])) {
	SHOW_ERROR(ERROR_ARGUMENTS);
}

LOAD_DB_AND_NEXT_ID($ROWS, $rc, $ni);


$nt = time();

$ROWS[$rc][CASE_UID] = $ni;
$row = &$ROWS[$rc];
$row[CASE_STAFF_ID] = $_POST['case_staff_id'];
$row[CASE_CLIENT_ID] = $_POST['case_client_id'];
$row[CASE_OPENED_TIME] = date('Y-m-d H:i', $nt);
$row[CASE_OPENED_STAFF_ID] = $_SESSION['UID'];
$row[CASE_PREDESTINATE_TIME] = $_POST['case_year'].'-'.$_POST['case_month'].'-'.$_POST['case_day'].' '.$_POST['case_hour'].':'.$_POST['case_minute'];
if (empty($_POST['case_staff_id'])) {
	$row[CASE_TAKING_TIME] = '';
} else {
	$row[CASE_TAKING_TIME] = $row[CASE_OPENED_TIME];
}
$row[CASE_ARCHIVE_FOLDER] = date('Y/m/').substr('0000000'.$ROWS[$rc][CASE_UID], -8);
$row[CASE_TAG] = $_POST['case_tag'];
$row[CASE_TITLE] = $_POST['case_title'];
$row[CASE_CONTENT] = $_POST['case_content'];

CHECK_AND_CREATE_FOLDER(RETURN_CASE_REPLY_FOLDER($row[CASE_ARCHIVE_FOLDER]));

DUMP_DB_AND_NEXT_ID($ROWS, $ni);
if (!empty($_POST['case_staff_id'])) {
	WRITE_CASE_LOG($row[CASE_ARCHIVE_FOLDER], '接手 (直接指派)', $_POST['case_staff_id']);
}
GOTO($THIS_PHP_FILE);

?>