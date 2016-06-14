<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(STANDBY_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(STANDBY_FILE_ID);

function RETURN_STANDBY_STATUS($v) {
	$v = (int) $v;
	switch ($v) {
		case STANDBY_STATUS_NORMAL:
			return '���`';
			break;

		case STANDBY_STATUS_SCRAPPED:
			return '���o';
			break;

		case STANDBY_STATUS_LOST:
			return '��';
			break;

		default:
			return '����';
			break;
	}
}


if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'view':
			require('standby_view.php');
			break;

		case 'edit':
			require('standby_edit.php');
			break;

		case 'save':
			require('standby_save.php');
			break;

		case 'new':
			require('standby_new.php');
			break;

		case 'insert': 
			require('standby_insert.php');
			break;

		case 'delete':
			require('standby_delete.php');
			break;

		case 'attachments':
			require('standby_attachments.php');
			break;

		case 'attachments_download':
			require('standby_attachments_download.php');
			break;

		case 'attachments_delete':
			require('standby_attachments_delete.php');
			break;

		default:
			require('standby_list.php');
			break;
	}
} else {
	require('standby_list.php');
}

?>