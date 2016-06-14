<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(STANDBY_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(STANDBY_FILE_ID);

function RETURN_STANDBY_NAME_BY_STANDBY_ID($standby_id, $is_linked) {
	global $STANDBY_INFORMATION;

	if (isset($STANDBY_INFORMATION[$standby_id])) {
		if ($is_linked) {
			return '<a href="standby.php?sid='.session_id().'&standby_id='.$standby_id.'&op=view" target="_blank">'.$STANDBY_INFORMATION[$standby_id]['name'].'</a>';
		} else {
			return $STANDBY_INFORMATION[$standby_id]['name'];
		}
	} else {
		return '(²§±`­È)';
	}
}

function RETURN_STANDBY_SERIAL_IDS_BY_STANDBY_ID($standby_id) {
	global $STANDBY_INFORMATION;

	if (isset($STANDBY_INFORMATION[$standby_id])) {
		return $STANDBY_INFORMATION[$standby_id]['serial_ids'];
	} else {
		return '';
	}
}

LOAD_DB_CLIENT();

if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$rc = count($ROWS);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$ri];
		$STANDBY_INFORMATION[$row[STANDBY_UID]]['name'] = $row[STANDBY_NAME];
		$STANDBY_INFORMATION[$row[STANDBY_UID]]['serial_ids'] = $row[STANDBY_SERIAL_IDS];
		++$ri;
	}
}

$FILE_DB = RETURN_DB_FILE_PATH(LEND_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(LEND_FILE_ID);

if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'edit':
			require('lend_edit.php');
			break;

		case 'save':
			require('lend_save.php');
			break;

		case 'delete':
			require('lend_delete.php');
			break;

		case 'view':
			require('lend_view.php');
			break;

		case 'return':
			require('lend_return.php');
			break;

		case 'log':
			require('lend_log.php');
			break;

		case 'log_view':
			require('lend_log_view.php');
			break;

		case 'attachments':
			require('lend_attachments.php');
			break;

		case 'attachments_download':
			require('lend_attachments_download.php');
			break;

		case 'attachments_delete':
			require('lend_attachments_delete.php');
			break;

		default:
			require('lend_list.php');
			break;
	}
} else {
	require('lend_list.php');
}

?>