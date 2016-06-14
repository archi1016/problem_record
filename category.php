<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(CATEGORY_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(CATEGORY_FILE_ID);

if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'edit':
			require('category_edit.php');
			break;

		case 'save':
			require('category_save.php');
			break;

		case 'new':
			require('category_new.php');
			break;

		case 'insert': 
			require('category_insert.php');
			break;

		case 'delete':
			require('category_delete.php');
			break;

		default:
			require('category_list.php');
			break;
	}
} else {
	require('category_list.php');
}

?>