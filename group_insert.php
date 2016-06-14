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


if (empty($THIS_STAFF_RINGS[RING_GROUP_INSERT])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_POST['group_name'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_POST['group_name'] = stripslashes($_POST['group_name']);
}

LOAD_DB_AND_NEXT_ID($ROWS, $rc, $ni);

$ROWS[$rc][GROUP_UID] = $ni;
$row = &$ROWS[$rc];
$row[GROUP_NAME] = $_POST['group_name'];
$row[GROUP_RING] = RETURN_POST_RINGS();

DUMP_DB_AND_NEXT_ID($ROWS, $ni);
GOTO($THIS_PHP_FILE);

?>