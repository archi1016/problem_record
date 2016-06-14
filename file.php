<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(FILE_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(FILE_FILE_ID);

if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'view':
			require('file_view.php');
			break;

		case 'edit':
			require('file_edit.php');
			break;

		case 'save':
			require('file_save.php');
			break;

		case 'new':
			require('file_new.php');
			break;

		case 'insert': 
			require('file_insert.php');
			break;

		case 'delete':
			require('file_delete.php');
			break;

		case 'attachments':
			require('file_attachments.php');
			break;

		case 'attachments_download':
			require('file_attachments_download.php');
			break;

		case 'attachments_delete':
			require('file_attachments_delete.php');
			break;

		default:
			require('file_list.php');
			break;
	}
} else {
	require('file_list.php');
}

?>