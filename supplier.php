<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(SUPPLIER_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(SUPPLIER_FILE_ID);

if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'view':
			require('supplier_view.php');
			break;

		case 'edit':
			require('supplier_edit.php');
			break;

		case 'save':
			require('supplier_save.php');
			break;

		case 'new':
			require('supplier_new.php');
			break;

		case 'insert': 
			require('supplier_insert.php');
			break;

		case 'delete':
			require('supplier_delete.php');
			break;

		case 'attachments':
			require('supplier_attachments.php');
			break;

		case 'attachments_download':
			require('supplier_attachments_download.php');
			break;

		case 'attachments_delete':
			require('supplier_attachments_delete.php');
			break;


		default:
			require('supplier_list.php');
			break;
	}
} else {
	require('supplier_list.php');
}

?>