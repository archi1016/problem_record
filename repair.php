<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(REPAIR_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(REPAIR_FILE_ID);

function RETURN_SUPPLIER_NAME_BY_SUPPLIER_ID($supplier_id, $is_linked) {
	global $SUPPLIER_INFORMATION;

	if (isset($SUPPLIER_INFORMATION[$supplier_id])) {
		if ($is_linked) {
			return '<a href="supplier.php?sid='.session_id().'&supplier_id='.$supplier_id.'&op=view" target="_blank">'.$SUPPLIER_INFORMATION[$supplier_id]['name'].'</a>';
		} else {
			return $SUPPLIER_INFORMATION[$supplier_id]['name'];
		}
	} else {
		return '(²§±`­È)';
	}
}

function RETURN_SUPPLIER_OPTIONS($supplier_id) {
	global $SUPPLIER_INFORMATION;

	$rt = '';
	foreach ($SUPPLIER_INFORMATION as $ID => $VALUE) {
		if ($ID != $supplier_id) {
			$s = '';
		} else {
			$s = ' selected="selected"';
		}
		$rt .= '<option value="'.$ID.'"'.$s.'>'.$ID.': '.$VALUE['name'].'</option>';
	}
	return $rt;
}


LOAD_DB_STAFF();
LOAD_DB_CLIENT();

if (LOAD_TEXT_TABLE(RETURN_DB_FILE_PATH(SUPPLIER_FILE_ID), $ROWS)) {
	$rc = count($ROWS);
	$ri = 0;
	while ($ri < $rc) {
		$SUPPLIER_INFORMATION[$ROWS[$ri][SUPPLIER_UID]]['name'] = $ROWS[$ri][SUPPLIER_NAME];
		++$ri;
	}
}


if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'view':
			require('repair_view.php');
			break;

		case 'return':
			require('repair_return.php');
			break;

		case 'close':
			require('repair_close.php');
			break;

		case 'edit':
			require('repair_edit.php');
			break;

		case 'save':
			require('repair_save.php');
			break;

		case 'new':
			require('repair_new.php');
			break;

		case 'insert': 
			require('repair_insert.php');
			break;

		case 'delete':
			require('repair_delete.php');
			break;

		case 'attachments':
			require('repair_attachments.php');
			break;

		case 'attachments_download':
			require('repair_attachments_download.php');
			break;

		case 'attachments_delete':
			require('repair_attachments_delete.php');
			break;

		case 'archive_list':
			require('repair_archive_list.php');
			break;

		case 'archive_view':
			require('repair_archive_view.php');
			break;

		case 'archive_edit':
			require('repair_archive_edit.php');
			break;

		case 'archive_save':
			require('repair_archive_save.php');
			break;

		case 'archive_delete':
			require('repair_archive_delete.php');
			break;

		default:
			require('repair_list.php');
			break;
	}
} else {
	require('repair_list.php');
}

?>