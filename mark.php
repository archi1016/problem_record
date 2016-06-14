<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(MARK_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(MARK_FILE_ID);

function GET_MARK_ITEM_FILE($FID, $ID, &$FILE_DB) {
	$af = RETURN_DB_SUB_FOLDER($FID, $ID);
	$FILE_DB = $af.'/'.MARK_ITEM_FILE_ID.'.inc';
}

LOAD_DB_CLIENT();

if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'view':
			require('mark_view.php');
			break;

		case 'edit':
			require('mark_edit.php');
			break;

		case 'save':
			require('mark_save.php');
			break;

		case 'new':
			require('mark_new.php');
			break;

		case 'insert': 
			require('mark_insert.php');
			break;

		case 'delete':
			require('mark_delete.php');
			break;

		case 'attachments':
			require('mark_attachments.php');
			break;

		case 'attachments_download':
			require('mark_attachments_download.php');
			break;

		case 'attachments_delete':
			require('mark_attachments_delete.php');
			break;

		case 'set':
			require('mark_set.php');
			break;

		default:
			require('mark_list.php');
			break;
	}
} else {
	require('mark_list.php');
}

?>