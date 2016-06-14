<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(STAFF_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(STAFF_FILE_ID);

function RETURN_ROW_INDEX_BY_STAFF_ACCOUNT($staff_account, $ROWS) {
	$rc = count($ROWS);
	$ri = $rc - 1;
	while ($ri >= 0) {
		if ($staff_account == $ROWS[$ri][STAFF_ACCOUNT]) {
			break;
		}
		--$ri;
	}
	return $ri;
}

function RETURN_GROUP_NAME_BY_GROUP_ID($group_id) {
	global $GROUP_INFORMATION;

	if (isset($GROUP_INFORMATION[$group_id])) {
		return $GROUP_INFORMATION[$group_id]['name'];
	} else {
		return '(²§±`)';
	}
}

if (LOAD_TEXT_TABLE(RETURN_DB_FILE_PATH(GROUP_FILE_ID), $ROWS)) {
	$rc = count($ROWS);
	$ri = 0;
	while ($ri < $rc) {
		$GROUP_INFORMATION[$ROWS[$ri][GROUP_UID]]['name'] = $ROWS[$ri][GROUP_NAME];
		++$ri;
	}
} else {
	SHOW_ERROR(ERROR_LOAD_FILE);
}


if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'view':
			require('staff_view.php');
			break;

		case 'edit':
			require('staff_edit.php');
			break;

		case 'save':
			require('staff_save.php');
			break;

		case 'new':
			require('staff_new.php');
			break;

		case 'insert': 
			require('staff_insert.php');
			break;

		case 'delete':
			require('staff_delete.php');
			break;

		default:
			require('staff_list.php');
			break;
	}
} else {
	require('staff_list.php');
}

?>