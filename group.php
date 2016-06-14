<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(GROUP_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(GROUP_FILE_ID);
$FILE_DEFAULT_ID = RETURN_DEFAULT_ID_FILE_PATH(GROUP_FILE_ID);

function RETURN_GROUP_FAMILY($rvs, $ris) {
	global $RING_NAME;

	$rt = '';
	foreach ($ris as $index) {
		$ck = '';
		$sy = 'unchecked';
		if (!empty($rvs)) {
			if (!empty($rvs[$index])) {
				$ck = ' checked="checked"';
				$sy = 'checked';
			}
		}
		$rt .= '<span class="'.$sy.'" onclick="CHECK_SELECT_BLOCK_FROM_SPAN(this.firstChild,this);"><input type="checkbox" name="group_ring['.$index.']"'.$ck.' onclick="CHECK_SELECT_BLOCK_FROM_CHECKBOX(this,this.parentNode);" /> '.$RING_NAME[$index].'</span>';
	}
	return $rt;
}

function RETURN_GROUP_FAMILY_VIEW($rvs, $ris) {
	global $RING_NAME;

	$rt = '';
	foreach ($ris as $index) {
		if (!empty($rvs)) {
			if (!empty($rvs[$index])) {
				$rt .= '<span class="checked">'.$RING_NAME[$index].'</span>';
			}
		}
	}
	if ($rt == '') $rt = '&nbsp;';
	return $rt;
}

if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'view':
			require('define_group.php');
			require('group_view.php');
			break;

		case 'edit':
			require('define_group.php');
			require('group_edit.php');
			break;

		case 'save':
			require('group_save.php');
			break;

		case 'new':
			require('define_group.php');
			require('group_new.php');
			break;

		case 'insert': 
			require('group_insert.php');
			break;

		case 'delete':
			require('group_delete.php');
			break;

		case 'default':
			require('group_default.php');
			break;

		default:
			require('group_list.php');
			break;
	}
} else {
	require('group_list.php');
}

?>