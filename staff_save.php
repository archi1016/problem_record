<?php

if (empty($THIS_STAFF_RINGS[RING_STAFF_SAVE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['staff_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['staff_status'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['staff_group_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['staff_name'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['staff_telephone'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['staff_id'] = stripslashes($_GET['staff_id']);
	$_POST['staff_status'] = stripslashes($_POST['staff_status']);
	$_POST['staff_group_id'] = stripslashes($_POST['staff_group_id']);
	$_POST['staff_pwd'] = stripslashes($_POST['staff_pwd']);
	$_POST['staff_name'] = stripslashes($_POST['staff_name']);
	$_POST['staff_telephone'] = stripslashes($_POST['staff_telephone']);
}

$staff_id = RETURN_ID_FROM($_GET['staff_id']);
CHECK_ID_EXIST($staff_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$row[STAFF_STATUS] = $_POST['staff_status'];
$row[STAFF_NAME] = $_POST['staff_name'];
$row[STAFF_TELEPHONE] = $_POST['staff_telephone'];
if (!empty($THIS_STAFF_RINGS[RING_STAFF_CHANGE_GRP])) {
	$row[STAFF_GROUP_ID] = $_POST['staff_group_id'];
}
if (!empty($THIS_STAFF_RINGS[RING_STAFF_CHANGE_PWD])) {
	if (!empty($_POST['staff_pwd'])) {
		if ($_POST['staff_pwd'] == $_POST['staff_pwd2']) {
			$ROWS[$ri][STAFF_PASSWORD] = md5('EF_'.$_POST['staff_pwd']);
		}
	}
}
if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>