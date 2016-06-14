<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(CLIENT_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(CLIENT_FILE_ID);

function RETURN_CLIENT_COOPERATION($v) {
	$v = (int) $v;
	switch ($v) {
		case CLIENT_COOPERATION_NORMAL:
			return '¥¿±`';
			break;

		case CLIENT_COOPERATION_PAUSE:
			return '¼È°±';
			break;

		default:
			return '²×¤î';
			break;
	}
}

if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'view':
			require('client_view.php');
			break;

		case 'edit':
			require('client_edit.php');
			break;

		case 'save':
			require('client_save.php');
			break;

		case 'new':
			require('client_new.php');
			break;

		case 'insert': 
			require('client_insert.php');
			break;

		case 'delete':
			require('client_delete.php');
			break;

		case 'attachments':
			require('client_attachments.php');
			break;

		case 'attachments_download':
			require('client_attachments_download.php');
			break;

		case 'attachments_delete':
			require('client_attachments_delete.php');
			break;

		default:
			require('client_list.php');
			break;
	}
} else {
	require('client_list.php');
}

?>