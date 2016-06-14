<?php

if (empty($THIS_STAFF_RINGS[RING_STAFF_INSERT])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_POST['staff_acc'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['staff_pwd'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['staff_pwd2'])) SHOW_ERROR(ERROR_ARGUMENTS);
if ($_POST['staff_pwd'] != $_POST['staff_pwd2']) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['staff_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['staff_telephone'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_POST['staff_acc'] = stripslashes($_POST['staff_acc']);
	$_POST['staff_pwd'] = stripslashes($_POST['staff_pwd']);
	$_POST['staff_name'] = stripslashes($_POST['staff_name']);
	$_POST['staff_telephone'] = stripslashes($_POST['staff_telephone']);
}

$dgi = LOAD_DEFAULT_ID(RETURN_DEFAULT_ID_FILE_PATH(GROUP_FILE_ID));
if (empty($dgi)) SHOW_ERROR(ERROR_NO_DEFAULT_GROUP);
if (!isset($GROUP_INFORMATION[$dgi])) SHOW_ERROR(ERROR_NO_DEFAULT_GROUP);

LOAD_DB_AND_NEXT_ID($ROWS, $rc, $ni);
if ($rc > 0) {
	if (RETURN_ROW_INDEX_BY_STAFF_ACCOUNT($_POST['staff_acc'], $ROWS) >= 0) SHOW_ERROR(ERROR_ACCOUNT_EXIST);
}

$ROWS[$rc][STAFF_UID] = $ni;
$row = &$ROWS[$rc];
$row[STAFF_STATUS] = '1';
$row[STAFF_GROUP_ID] = $dgi;
$row[STAFF_ACCOUNT] = $_POST['staff_acc'];
$row[STAFF_PASSWORD] = md5('EF_'.$_POST['staff_pwd']);
$row[STAFF_NAME] = $_POST['staff_name'];
$row[STAFF_TELEPHONE] = $_POST['staff_telephone'];

DUMP_DB_AND_NEXT_ID($ROWS, $ni);
GOTO($THIS_PHP_FILE);

?>