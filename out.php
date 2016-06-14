<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(OUT_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(OUT_FILE_ID);

LOAD_DB_STAFF();
LOAD_DB_CLIENT();

if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'view':
			require('out_view.php');
			break;

		case 'edit':
			require('out_edit.php');
			break;

		case 'save':
			require('out_save.php');
			break;

		case 'new':
			require('out_new.php');
			break;

		case 'insert': 
			require('out_insert.php');
			break;

		case 'delete':
			require('out_delete.php');
			break;

		case 'attachments':
			require('out_attachments.php');
			break;

		case 'attachments_download':
			require('out_attachments_download.php');
			break;

		case 'attachments_delete':
			require('out_attachments_delete.php');
			break;

		default:
			require('out_list.php');
			break;
	}
} else {
	require('out_list.php');
}

?>