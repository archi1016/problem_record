<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(EXPIRED_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(EXPIRED_FILE_ID);

function RETURN_FRIENDLY_EXPIRED_TIME_STR($TS) {
	$wd = array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
	$ot = strtotime($TS);
	$sec = $ot - strtotime(date('Y-m-d H:i'));
	if ($sec < 3600) {
		return floor($sec / 60).' 分鐘後';
	} else {
		if ($sec < 86400) {
			return floor($sec / 3600).' 小時後';
		} else {
			if ($sec < 172800) {
				return '明天 '.date('H:i', $ot);
			} else {
				if ($sec < 259200) {
					return '後天 '.date('H:i', $ot);
				} else {
					if ($sec < 604800) {
						return $wd[date('w', $ot)].' '.date('H:i', $ot);
					} else {
						if ($sec < 2592000) {
							return floor($sec / 86400).' 天後';
						} else {
							return $TS;
						}
					}
				}
			}
		}
	}
}

LOAD_DB_CLIENT();

if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'view':
			require('expired_view.php');
			break;

		case 'edit':
			require('expired_edit.php');
			break;

		case 'save':
			require('expired_save.php');
			break;

		case 'new':
			require('expired_new.php');
			break;

		case 'insert': 
			require('expired_insert.php');
			break;

		case 'delete':
			require('expired_delete.php');
			break;

		case 'attachments':
			require('expired_attachments.php');
			break;

		case 'attachments_download':
			require('expired_attachments_download.php');
			break;

		case 'attachments_delete':
			require('expired_attachments_delete.php');
			break;

		default:
			require('expired_list.php');
			break;
	}
} else {
	require('expired_list.php');
}

?>