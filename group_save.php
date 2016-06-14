<?php

function RETURN_POST_RINGS() {
	$i = 0;
	while ($i < RING_LENGTH) {
		if (empty($_POST['group_ring'][$i])) {
			$r[] = '0';
		} else {
			$r[] = '1';
		}
		++$i;
	}
	return implode(',', $r);
}


if (empty($THIS_STAFF_RINGS[RING_GROUP_SAVE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['group_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['group_name'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['group_id'] = stripslashes($_GET['group_id']);
	$_POST['group_name'] = stripslashes($_POST['group_name']);
}

$group_id = RETURN_ID_FROM($_GET['group_id']);
CHECK_ID_EXIST($group_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$row[GROUP_NAME] = $_POST['group_name'];
$row[GROUP_RING] = RETURN_POST_RINGS();

if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>