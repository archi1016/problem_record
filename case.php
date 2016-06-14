<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

$FILE_DB = RETURN_DB_FILE_PATH(CASE_FILE_ID);
$FILE_ID = RETURN_NEXT_ID_FILE_PATH(CASE_FILE_ID);

function RETURN_CASE_REPLY_FOLDER($FP) {
	return DB_LOCATION.'/'.CASE_FILE_ID.'/'.$FP;
}

function GET_REPLY_FILES($archive_folder, &$FILE_DB, &$FILE_ID) {
	$cf = RETURN_CASE_REPLY_FOLDER($archive_folder);
	$FILE_DB = $cf.'/'.CASE_REPLY_FILE_ID.'.inc';
	$FILE_ID = $cf.'/'.CASE_REPLY_FILE_ID.'_next_id.inc';
}


function GET_ATTACHMENTS_FILES($archive_folder, &$FILE_DB, &$FILE_ID) {
	$cf = RETURN_CASE_REPLY_FOLDER($archive_folder);
	$FILE_DB = $cf.'/'.ATTACHMENTS_FILE_ID.'.inc';
	$FILE_ID = $cf.'/'.ATTACHMENTS_FILE_ID.'_next_id.inc';
}

function RETURN_FRIENDLY_PREDESTINATE_TIME_STR($TS) {
	$wd = array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
	$ot = strtotime($TS.':00');
	$sec = $ot - strtotime(date('Y-m-d H:i:00'));
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

function RETURN_REPLY_ATTACHMENTS_IDS($archive_folder, $reply_id) {
	$rt = '';
	$cf = RETURN_CASE_REPLY_FOLDER($archive_folder);
	GET_ATTACHMENTS_FILES($archive_folder, $FILE_DB, $FILE_ID);
	if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
		$rc = count($ROWS);
	} else {
		$rc = 0;
	}
	$ni = LOAD_NEXT_ID($FILE_ID);
	$uploaded = FALSE;
	$nt = date('Y-m-d H:i');
	foreach ($_FILES['case_reply_attachments']['error'] as $KEY => $VALUE) {
		if (UPLOAD_ERR_OK == $VALUE) {
			$pi = pathinfo($_POST['case_reply_attachments_fn'][$KEY]);
			$fn = $cf.'/'.md5($nt.$_FILES['case_reply_attachments']['tmp_name'][$KEY]).'.'.$pi['extension'];
			if (move_uploaded_file($_FILES['case_reply_attachments']['tmp_name'][$KEY], $fn)) {
				$uploaded = TRUE;

				$ids[] = $ni;
				$ROWS[$rc][ATTACHMENTS_UID] = $ni;
				$row = &$ROWS[$rc];
				$row[ATTACHMENTS_FOLLOW_UID] = $reply_id;
				$row[ATTACHMENTS_TIME] = $nt;
				$row[ATTACHMENTS_NAME] = $_POST['case_reply_attachments_fn'][$KEY];
				if (get_magic_quotes_gpc()) $row[ATTACHMENTS_NAME] = stripslashes($row[ATTACHMENTS_NAME]);
				$row[ATTACHMENTS_TYPE] = $_FILES['case_reply_attachments']['type'][$KEY];
				$row[ATTACHMENTS_SIZE] = $_FILES['case_reply_attachments']['size'][$KEY];
				$row[ATTACHMENTS_EXTENSION] = $pi['extension'];
				$row[ATTACHMENTS_FILE_NAME] = $fn;

				++$rc;
				++$ni;
			}
		}
	}
	if ($uploaded) {
		--$ni;
		if (DUMP_NEXT_ID($FILE_ID, $ni)) {
			if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
				if (isset($ids)) $rt = implode(',', $ids);
			} else {
				SHOW_ERROR(ERROR_DUMP_FILE);
			}
		} else {
			SHOW_ERROR(ERROR_DUMP_FILE);
		}
	}
	return $rt;
}

function WRITE_CASE_LOG($archive_folder, $content, $who) {
	return WRITE_CASE_REPLY($archive_folder, CASE_REPLY_TYPE_SYSTEM, $content, $who, FALSE);
}

function WRITE_CASE_REPLY($archive_folder, $reply_type, $content, $who, $is_attachments) {
	GET_REPLY_FILES($archive_folder, $FILE_DB, $FILE_ID);
	if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
		$rc = count($ROWS);
	} else {
		$rc = 0;
	}
	$ni = LOAD_NEXT_ID($FILE_ID);

	$ROWS[$rc][UID] = $ni;
	$row = &$ROWS[$rc];
	$row[TYPE] = $reply_type;
	$row[STAFF_ID] = $who;
	$row[TIME] = date('Y-m-d H:i');
	if ($is_attachments) {
		$row[ATTACHMENTS_IDS] = RETURN_REPLY_ATTACHMENTS_IDS($archive_folder, $ni);
	} else {
		$row[ATTACHMENTS_IDS] = '';
	}
	$row[CONTENT] = $content;

	if (DUMP_NEXT_ID($FILE_ID, $ni)) {
		if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
			return $ni;
		} else {
			SHOW_ERROR(ERROR_DUMP_FILE);
		}
	} else {
		SHOW_ERROR(ERROR_DUMP_FILE);
	}
}

function LOAD_REPLAY_ATTACHMENTS($archive_folder) {
	global $REPLAY_ATTACHMENTS_INFORMATION;

	GET_ATTACHMENTS_FILES($archive_folder, $FILE_DB, $FILE_ID);
	if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
		$rc = count($ROWS);
		$ri = 0;
		while ($ri < $rc) {
			$row = &$ROWS[$ri];
			$REPLAY_ATTACHMENTS_INFORMATION[$row[ATTACHMENTS_UID]]['name'] = $row[ATTACHMENTS_NAME];
			$REPLAY_ATTACHMENTS_INFORMATION[$row[ATTACHMENTS_UID]]['size'] = $row[ATTACHMENTS_SIZE];
			$REPLAY_ATTACHMENTS_INFORMATION[$row[ATTACHMENTS_UID]]['extension'] = $row[ATTACHMENTS_EXTENSION];
			++$ri;
		}
	}
}


LOAD_DB_STAFF();
LOAD_DB_CLIENT();

if (isset($_GET['op'])) {
	switch ($_GET['op']) {
		case 'thread':
			require('case_thread.php');
			break;		

		case 'reply':
			require('case_reply.php');
			break;	

		case 'reply_delete':
			require('case_reply_delete.php');
			break;	

		case 'reply_attachments_download':
			require('case_reply_attachments_download.php');
			break;

		case 'edit':
			require('case_edit.php');
			break;

		case 'save':
			require('case_save.php');
			break;

		case 'new':
			require('case_new.php');
			break;

		case 'insert': 
			require('case_insert.php');
			break;

		case 'delete':
			require('case_delete.php');
			break;

		case 'take':
			require('case_take.php');
			break;

		case 'return':
			require('case_return.php');
			break;

		case 'close':
			require('case_close.php');
			break;

		case 'archive':
			require('case_archive.php');
			break;	

		case 'archive_view':
			require('case_archive_view.php');
			break;	

		default:
			require('case_list.php');
			break;
	}
} else {
	require('case_list.php');
}

?>