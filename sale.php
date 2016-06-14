<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(SALE_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(SALE_FILE_ID);

LOAD_DB_CLIENT();

if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'view':
			require('sale_view.php');
			break;

		case 'edit':
			require('sale_edit.php');
			break;

		case 'save':
			require('sale_save.php');
			break;

		case 'new':
			require('sale_new.php');
			break;

		case 'insert': 
			require('sale_insert.php');
			break;

		case 'delete':
			require('sale_delete.php');
			break;

		case 'attachments':
			require('sale_attachments.php');
			break;

		case 'attachments_download':
			require('sale_attachments_download.php');
			break;

		case 'attachments_delete':
			require('sale_attachments_delete.php');
			break;

		default:
			require('sale_list.php');
			break;
	}
} else {
	require('sale_list.php');
}

?>