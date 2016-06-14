<?php

if (empty($THIS_STAFF_RINGS[RING_GROUP_DEFAULT])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['group_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['group_id'] = stripslashes($_GET['group_id']);
}

$group_id = RETURN_ID_FROM($_GET['group_id']);
CHECK_ID_EXIST($group_id, $ROWS, $ri);

if ($group_id == 1) SHOW_ERROR(ERROR_NO_RING);

if (DUMP_DEFAULT_ID($FILE_DEFAULT_ID, $group_id)) {
	GOTO($THIS_PHP_FILE);
} else {
	SHOW_ERROR(ERROR_DUMP_FILE);
}

?>