<?php

date_default_timezone_set(TIME_ZONE);

$HTML = '';
$THIS_PHP_FILE = basename($_SERVER['SCRIPT_NAME']);
$CURRENT_PHP_FILE = $THIS_PHP_FILE;
$ACCOUNT_KEY = '';

function GOTO($NEW_URL) {
	header('Location: '.$NEW_URL);
	exit();
}

function SHOW_ERROR($ERROR_ID) {
	global $THIS_PHP_FILE;

	GOTO($THIS_PHP_FILE.'&error='.$ERROR_ID);
}

function HTML_HEADER($TITLE) {
	global $HTML;

	$HTML = '';
	HTML_ADD('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">');
	HTML_ADD('<html>');
	HTML_ADD('<head>');
	HTML_ADD('<meta http-equiv="content-type" content="text/html; charset='.TEXT_CHARSET.'">');
	HTML_ADD('<title>'.$TITLE.'</title>');
	HTML_ADD('<link rel="apple-touch-icon-precomposed" href="logo.png">');
	HTML_ADD('<link rel="stylesheet" type="text/css" href="theme.css">');
	HTML_ADD('<script type="text/javascript" src="theme.js"></script>');
	HTML_ADD('</head>');
	HTML_ADD('<body>');
	if (!empty($_GET['error'])) {
		require('error.php');
		$ri = (int) $_GET['error'];
		HTML_ADD('<div class="error">'.$error_msg[$ri].'</div>');
	}
}

function HTML_ADD($H) {
	global $HTML;

	$HTML .= $H."\n";
}

function HTML_OUTPUT() {
	global $HTML;
	
	HTML_ADD('</body>');
	HTML_ADD('</html>');
	header('Content-Length: '.strlen($HTML));
	echo $HTML;
}

function MENU_BAR() {
	global $CURRENT_PHP_FILE;

	if (isset($_GET['print'])) return;

	$sid = '?sid='.session_id();
	$LS = array(
		array('case.php'	,'案例'),
		array('repair.php'	,'送修'),
		array('mark.php'	,'標記'),
		array('lend.php'	,'出借'),
		array('sale.php'	,'出貨'),
		array('out.php'		,'外派'),
		array('file.php'	,'檔案'),
		array('expired.php'	,'過期'),
		array('client.php'	,'客戶'),
		array('supplier.php'	,'廠商'),
		array('standby.php'	,'備品'),
		array('category.php'	,'歸類'),
		array('staff.php'	,'員工'),
		array('group.php'	,'族群')
	);
	$c = count($LS);
	$i = 0;
	$t = '<div class="menu"><h1>'.COMPANY_NAME.'</h1><table cellspacing="0" cellpadding="0"><tr><td width="12">&nbsp;</td>';
	while ($i < $c) {
		if ($LS[$i][0] != $CURRENT_PHP_FILE) {
			$cas = 'tab';
		} else {
			$cas = 'current';
		}
		$t .= '<td class="'.$cas.'"><a href="'.$LS[$i][0].$sid.'">'.$LS[$i][1].'</a></td>';
		++$i;
	}
	$t .= '<td><a href="logoff.php'.$sid.'">登出'.$_SESSION['NAME'].'</a>&nbsp;</td></tr></table></div>';
	HTML_ADD($t);
}

function CHECK_LOGON() {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	if (isset($_GET['sid'])) {
		session_id($_GET['sid']);
		session_start();
		if (isset($_SESSION['ACCOUNT'])) {
			if (!empty($_SESSION['ACCOUNT'])) {
				$t = strtotime('now');
				if (($t - $_SESSION['TIME']) < SESSION_TIMEOUT) {
					$_SESSION['TIME'] = $t;
					$THIS_PHP_FILE .= '?sid='.session_id();
					$THIS_STAFF_RINGS = explode(',', $_SESSION['RING']);
				} else {
					session_unset();
					session_destroy();
					GOTO('index.php');
				}
			} else {
				session_unset();
				session_destroy();
				GOTO('index.php');
			}
		} else {
			session_unset();
			session_destroy();
			GOTO('index.php');
		}
	} else {
		GOTO('index.php');
	}
}

function LOAD_TEXT_FILE($FP, &$T) {
	if (file_exists($FP)) {
		$T = file_get_contents($FP);
	} else {
		$T = '';
	}
	return ($T != '');
}

function LOAD_TEXT_TABLE($FP, &$T) {
	$T = NULL;
	$C = '';
	if (LOAD_TEXT_FILE($FP, $C)) {
		return LOAD_TEXT_TABLE_CORE($C, $T);
	} else {
		return FALSE;
	}
}

function LOAD_TEXT_TABLE_CORE(&$C, &$T) {
	$B = 0;
	$C = str_replace("\r", '', $C);
	$L = split("\n", $C);
	$Ls = count($L);
	$i = 0;
	while ($i < $Ls) {
		if ($L[$i] != '') {
			$r = split("\t", $L[$i]);
			$rs = count($r);
			$j = 0;
			while ($j < $rs) {
				$T[$B][$j] = $r[$j];
				++$j;
			}
			++$B;
		}
		++$i;
	}
	return is_array($T);
}

function DUMP_TEXT_TABLE($FP, &$A) {
	$T = '';
	foreach ($A as $ary) {
		if (is_array($ary)) {
			$ary2 = $ary;
			$T .= join("\t", $ary2)."\r\n";
		} else {
			$T .= $ary."\r\n";
		}	
	}
	if (file_put_contents($FP, $T, LOCK_EX) !== FALSE) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function LOAD_NEXT_ID($FP) {
	if (file_exists($FP)) {
		$id = (int) file_get_contents($FP);
		if ($id == 0) ++$id;
	} else {
		$id = 1;
	}
	return $id;
}

function DUMP_NEXT_ID($FP, &$ID) {
	++$ID;
	if (file_put_contents($FP, $ID, LOCK_EX) !== FALSE) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function LOAD_DEFAULT_ID($FP) {
	if (file_exists($FP)) {
		$id = (int) file_get_contents($FP);
	} else {
		$id = 0;
	}
	return $id;
}

function DUMP_DEFAULT_ID($FP, &$ID) {
	if (file_put_contents($FP, $ID, LOCK_EX) !== FALSE) {
		return TRUE;
	} else {
		return FALSE;
	}
}


function RETURN_ID_FROM($ID) {
	$rt = (int) $ID;
	$rt &= 0x7ffff;
	return $rt;
}

function RETURN_DB_FILE_PATH($DN) {
	return DB_LOCATION.'/'.$DN.'.inc';
}

function RETURN_NEXT_ID_FILE_PATH($DN) {
	return DB_LOCATION.'/'.$DN.'_next_id.inc';
}

function RETURN_DEFAULT_ID_FILE_PATH($DN) {
	return DB_LOCATION.'/'.$DN.'_default_id.inc';
}

function RETURN_ROW_INDEX_BY_ID($ID, &$ROWS) {
	$rc = count($ROWS);
	$ri = $rc - 1;
	while ($ri >= 0) {
		if ($ID == $ROWS[$ri][0]) {
			break;
		}
		--$ri;
	}
	return $ri;
}

function RETURN_NUMBERS_OPTIONS($NB, $NS, $CN) {
	$rt = '';
	while ($NB <= $NS) {
		$t = substr('0000'.$NB, -2);
		if ($t == $CN) {
			$s = ' selected="selected"';
		} else {
			$s = '';
		}
		$rt .= '<option value="'.$t.'"'.$s.'>'.$t.'</option>';
		++$NB;
	}
	return $rt;
}

function RETURN_FRIENDLY_TIME_STR($TS) {
	$wd = array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
	$ot = strtotime($TS.':00');
	$sec = strtotime(date('Y-m-d H:i:00')) - $ot;
	if ($sec < 3600) {
		return floor($sec / 60).' 分鐘前';
	} else {
		if ($sec < 86400) {
			return floor($sec / 3600).' 小時前';
		} else {
			if ($sec < 172800) {
				return '昨天 '.date('H:i', $ot);
			} else {
				if ($sec < 259200) {
					return '前天 '.date('H:i', $ot);
				} else {
					if ($sec < 604800) {
						return $wd[date('w', $ot)].' '.date('H:i', $ot);
					} else {
						if ($sec < 2592000) {
							return floor($sec / 86400).' 天前';
						} else {
							return $TS;
						}
					}
				}
			}
		}
	}
}


function RETURN_FRIENDLY_SIZE_STR($FS) {
	if ($FS < 1024) {
		return $FS;
	} else {
		if ($FS < 1048576) {
			$FS = $FS / 1024;
			return (floor($FS * 100) / 100).'K';
		} else {
			$FS = $FS / 1048576;
			return (floor($FS * 100) / 100).'M';
		}
	}
}

function FORM_HEADER($AC, $JSN) {
	HTML_ADD('<form action="'.$AC.'" method="post" class="single" onsubmit="return '.$JSN.'(this);"><table cellspacing="0" cellpadding="0">');
	HTML_ADD('<tr><th class="item">項目</th><th class="value">內容</th></tr>');
}

function FORM_FOOTER($SB, $NA) {
	if ($SB) {
		HTML_ADD('<tr><td>確認:</td><td><input type="checkbox" name="confirmed"></td></tr>');
		HTML_ADD('<tr><td>&nbsp;</td><td align="right"><input type="submit" value="'.$NA.'"></td></tr>');
	}
	HTML_ADD('</table></form>');
}

function FORM_INPUT_ANY($LB, $ANY) {
	HTML_ADD('<tr valign="top"><td>'.$LB.':</td><td>'.$ANY.'</td></tr>');
}

function FORM_INPUT_TEXT($LB, $NA, $SZ, $VL) {
	HTML_ADD('<tr><td>'.$LB.':</td><td><input type="text" name="'.$NA.'" size="'.$SZ.'" value="'.str_replace('"','&quot;', $VL).'" onkeydown="CHECK_ESC_KEY();"></td></tr>');
}

function FORM_INPUT_PASSWORD($LB, $NA, $SZ) {
	HTML_ADD('<tr><td>'.$LB.':</td><td><input type="password" name="'.$NA.'" size="'.$SZ.'" value=""></td></tr>');
}

function FORM_SELECT($LB, $NA, $OTS) {
	HTML_ADD('<tr><td>'.$LB.':</td><td><select name="'.$NA.'" size="1" class="l">'.$OTS.'</select></td></tr>');
}

function FORM_TEXTAREA($LB, $NA, $RW, $CT) {
	HTML_ADD('<tr valign="top"><td>'.$LB.':</td><td><textarea name="'.$NA.'" rows="'.$RW.'" class="w" onkeydown="CHECK_ESC_KEY();">'.str_replace('\n', "\n", $CT).'</textarea></td></tr>');
}

function FORM_DATE_TIME($LB, $PN, $DT) {
	HTML_ADD('<tr><td>'.$LB.':</td><td>'.RETURN_SELECT_DATE_TIME($PN, $DT).'</td></tr>');
}

function RETURN_INPUT_TEXT($NA, $SZ, $VL) {
	return '<input type="text" name="'.$NA.'" size="'.$SZ.'" value="'.str_replace('"','&quot;', $VL).'" onkeydown="CHECK_ESC_KEY();">';
}

function RETURN_ICON_LINK($IMG, $TITLE, $URL) {
	return '<a href="'.$URL.'" title="'.$TITLE.'" class="op"><img src="icon/op/'.$IMG.'"></a>';
}

function RETURN_ICON_LINK_WITH_CONFIRM($IMG, $TITLE, $URL, $JS, $PARENT) {
	return '<a href="#" onclick="return '.$JS.'('.$PARENT.', \''.addslashes($URL).'\');" title="'.$TITLE.'" class="op"><img src="icon/op/'.$IMG.'"></a>';
}

function RETURN_MIME_ICON_FILE($ext) {
	global $MIME;

	$ext = strtolower($ext);
	if (isset($MIME[$ext])) {
		return '<img src="icon/mime/'.$MIME[$ext].'">';
	} else {
		return '<img src="icon/mime/default.png">';
		
	}
}


function RETURN_ADDRESS($ADDR) {
	return '<table cellspacing="0" cellpadding="0" class="linked"><tr><td>'.$ADDR.'</td><td class="icon"><a href="http://maps.google.com.tw/maps?hl=zh-TW&ie=Big5&q='.$ADDR.'" title="Google Map" target="_blank"><img src="icon/misc/misc_google_map.png"></td></tr></table>';
}

function RETURN_TELEPHONE($PN) {
	return '<div class="phone">'.$PN.'</div>';
}

function LIST_FILES_FORM_FOLDER($FP, &$RFS) {
	$dh = @opendir($FP);
	if ($dh) {
		while (FALSE !== ($f = readdir($dh))) {
			$pi = pathinfo($f);
			if ($pi['extension'] != '') $fl[] = $f;
		}
		closedir($dh);
		if (isset($fl)) {
			$RFS = $fl;
			sort($RFS, SORT_STRING);
			return TRUE;
		}
	}
	return FALSE;
}


function VIEW_HEADER($TITLE) {
	HTML_ADD('<table cellspacing="0" cellpadding="0">');
	HTML_ADD('<tr><th colspan="2" class="title">'.$TITLE.'</th></tr>');
}

function VIEW_FOOTER() {
	HTML_ADD('</table>');
}

function VIEW_ROW($LB, $STR) {
	if ($STR == '') $STR = '&nbsp;';
	HTML_ADD('<tr><td class="lab">'.$LB.':</td><td class="content">'.$STR.'</td></tr>');
}

function VIEW_ROWS($LB, $TXT) {
	if ($TXT == '') $TXT = '&nbsp;';
	HTML_ADD('<tr valign="top"><td class="lab">'.$LB.':</td><td class="content">'.str_replace('\n', '<br>', $TXT).'</td></tr>');
}

function FORM_ATTACHMENTS($AC) {
	if (isset($_GET['print'])) return;
	$u = '<input type="file" name="attachments[]" class="w"><input type="hidden" name="attachments_fn[]" value="">';
	HTML_ADD('<form action="'.$AC.'" method="post" class="single" enctype="multipart/form-data" onsubmit="return CHECK_ATTACHMENTS(this);"><table cellspacing="0" cellpadding="0">');
	HTML_ADD('<tr><th class="item">上傳</th><th class="value">檔案 (檔名請先改好, 上傳後無法更名)</th></tr>');
	HTML_ADD('<tr><td>附件一:</td><td>'.$u.'</td></tr>');
	HTML_ADD('<tr><td>附件二:</td><td>'.$u.'</td></tr>');
	HTML_ADD('<tr><td>附件三:</td><td>'.$u.'</td></tr>');
	HTML_ADD('<tr><td>確認:</td><td><input type="checkbox" name="confirmed"></td></tr>');
	HTML_ADD('<tr><td>&nbsp;</td><td align="right"><input type="submit" value="上傳"></td></tr>');
	HTML_ADD('</table></form>');
}

function SEND_FILE(&$row) {
	header('Content-Type: '.$row[ATTACHMENTS_TYPE]);
	if (substr($row[ATTACHMENTS_TYPE], 0, 5) != 'image') {
		header('Content-Disposition: attachment; filename="'.$row[ATTACHMENTS_NAME].'"');
	}
	header('Content-Length: '.$row[ATTACHMENTS_SIZE]);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, no-cache');
	header('Pragma: no-cache');
	readfile($row[ATTACHMENTS_FILE_NAME]);
}

function CHECK_AND_CREATE_FOLDER($FP) {
	if (!is_dir($FP)) @mkdir($FP, 0, TRUE);
}

function LOAD_DB_STAFF() {
	global $STAFF_INFORMATION;

	if (LOAD_TEXT_TABLE(RETURN_DB_FILE_PATH(STAFF_FILE_ID), $ROWS)) {
		$rc = count($ROWS);
		$ri = 0;
		while ($ri < $rc) {
			$STAFF_INFORMATION[$ROWS[$ri][STAFF_UID]]['name'] = $ROWS[$ri][STAFF_NAME];
			$STAFF_INFORMATION[$ROWS[$ri][STAFF_UID]]['status'] = $ROWS[$ri][STAFF_STATUS];
			++$ri;
		}
	} else {
		SHOW_ERROR(ERROR_LOAD_FILE);
	}
}

function LOAD_DB_CLIENT() {
	global $CLIENT_INFORMATION;

	if (LOAD_TEXT_TABLE(RETURN_DB_FILE_PATH(CLIENT_FILE_ID), $ROWS)) {
		$rc = count($ROWS);
		$ri = 0;
		while ($ri < $rc) {
			$CLIENT_INFORMATION[$ROWS[$ri][CLIENT_UID]]['name'] = $ROWS[$ri][CLIENT_NAME];
			$CLIENT_INFORMATION[$ROWS[$ri][CLIENT_UID]]['cooperation'] = $ROWS[$ri][CLIENT_COOPERATION];
			++$ri;
		}
	}
}

function RETURN_STAFF_NAME_BY_STAFF_ID($staff_id, $is_linked) {
	global $STAFF_INFORMATION;

	if (isset($STAFF_INFORMATION[$staff_id])) {
		if ($is_linked) {
			return '<a href="staff.php?sid='.session_id().'&staff_id='.$staff_id.'&op=view" target="_blank">'.$STAFF_INFORMATION[$staff_id]['name'].'</a>';
		} else {
			return $STAFF_INFORMATION[$staff_id]['name'];
		}
	} else {
		return '(未指定)';
	}
}

function RETURN_CLIENT_NAME_BY_CLIENT_ID($client_id, $is_linked) {
	global $CLIENT_INFORMATION;

	if (isset($CLIENT_INFORMATION[$client_id])) {
		if ($is_linked) {
			return '<a href="client.php?sid='.session_id().'&client_id='.$client_id.'&op=view" target="_blank">'.$CLIENT_INFORMATION[$client_id]['name'].'</a>';
		} else {
			return $CLIENT_INFORMATION[$client_id]['name'];
		}
	} else {
		return '(異常值)';
	}
}

function RETURN_STAFF_OPTIONS($staff_id) {
	global $STAFF_INFORMATION;

	$rt = '';
	foreach ($STAFF_INFORMATION as $ID => $VALUE) {
		if (!empty($VALUE['status'])) {
			if ($ID != $staff_id) {
				$s = '';
			} else {
				$s = ' selected="selected"';
			}
			$rt .= '<option value="'.$ID.'"'.$s.'>'.$VALUE['name'].'</option>';
		}
	}
	return $rt;
}

function RETURN_CLIENT_OPTIONS($client_id) {
	global $CLIENT_INFORMATION;

	$rt = '';
	foreach ($CLIENT_INFORMATION as $ID => $VALUE) {
		if (CLIENT_COOPERATION_NORMAL == $VALUE['cooperation']) {
			if ($ID != $client_id) {
				$s = '';
			} else {
				$s = ' selected="selected"';
			}
			$rt .= '<option value="'.$ID.'"'.$s.'>'.$ID.': '.$VALUE['name'].'</option>';
		}
	}
	return $rt;
}

function RETURN_SELECT_DATE_TIME($prefix, $from_time) {
	if (empty($from_time)) {
		$nt = time();
	} else {
		$nt = strtotime($from_time);
	}
	$cy = (int) date('Y');
	$yer = (int) date('Y', $nt);
	$mon = date('m', $nt);
	$day = date('d', $nt);
	$hur = date('H', $nt);
	$min = date('i', $nt);
	$rt = '<select name="'.$prefix.'_year" size="1">';
	$yb = $cy - 1;
	$ye = $cy + 1;
	for ($i=$yb; $i<=$ye; $i++) {
		if ($i != $yer) {
			$s = '';
		} else {
			$s = ' selected="selected"';
		}
		$rt .= '<option value="'.$i.'"'.$s.'>'.$i.'</option>';
	}
	$rt .= '</select>';
	$rt .= '&nbsp;-&nbsp;<select name="'.$prefix.'_month" size="1">'.RETURN_NUMBERS_OPTIONS(1, 12, $mon).'</select>';
	$rt .= '&nbsp;-&nbsp;<select name="'.$prefix.'_day" size="1">'.RETURN_NUMBERS_OPTIONS(1, 31, $day).'</select>';
	$rt .= '　　<select name="'.$prefix.'_hour" size="1">'.RETURN_NUMBERS_OPTIONS(0, 23, $hur).'</select>';
	$rt .= '&nbsp;:&nbsp;<select name="'.$prefix.'_minute" size="1">'.RETURN_NUMBERS_OPTIONS(0, 60, $min).'</select>';
	return $rt;
}

function RETURN_PAGE_INFO($rows_of_page, $total_rows) {
	$rt[PAGE_TOTAL_ROWS] = $total_rows;
	$rt[PAGE_LIST_ROWS] = $rows_of_page;
	if (isset($_GET['page'])) {
		$rt[PAGE_CURRENT] = (int) $_GET['page'];
		if (empty($rt[PAGE_CURRENT])) $rt[PAGE_CURRENT] = 1;
	} else {
		$rt[PAGE_CURRENT] = 1;
	}
	$rt[PAGE_COUNT] = (int) floor($rt[PAGE_TOTAL_ROWS] / $rt[PAGE_LIST_ROWS]);
	if (($rt[PAGE_TOTAL_ROWS] % $rt[PAGE_LIST_ROWS]) != 0) ++$rt[PAGE_COUNT];
	if ($rt[PAGE_CURRENT] > $rt[PAGE_COUNT]) $rt[PAGE_CURRENT] = $rt[PAGE_COUNT];
	$rt[PAGE_BEGIN_ROW] = ($rt[PAGE_CURRENT] - 1) * $rt[PAGE_LIST_ROWS];
	$rt[PAGE_LIMIT_ROW] = $rt[PAGE_BEGIN_ROW] + $rt[PAGE_LIST_ROWS];
	if ($rt[PAGE_LIMIT_ROW] > $rt[PAGE_TOTAL_ROWS]) $rt[PAGE_LIMIT_ROW] = $rt[PAGE_TOTAL_ROWS];
	$rt[PAGE_BEGIN_ROW_N] = $rt[PAGE_TOTAL_ROWS] - $rt[PAGE_BEGIN_ROW] - 1;
	$rt[PAGE_LIMIT_ROW_N] = $rt[PAGE_BEGIN_ROW_N] - $rt[PAGE_LIST_ROWS];
	if ($rt[PAGE_LIMIT_ROW_N] < -1) $rt[PAGE_LIMIT_ROW_N] = -1;
	return $rt;
}


function PAGE_BAR(&$pi, $link_url) {
	if ($pi[PAGE_TOTAL_ROWS] > 0) {
		if ($pi[PAGE_COUNT] > 1) {
			$rt = '<div class="pages">';
			$i = 1;
			while ($i <= $pi[PAGE_COUNT]) {
				if ($pi[PAGE_CURRENT] != $i) {
					$rt .= '<a href="'.$link_url.'&page='.$i.'">'.$i.'</a>';
				} else {
					$rt .= '<span>'.$i.'</span>';
				}
				++$i;
			}
			$rt .= '</div>';
			HTML_ADD($rt);

			$rt = '<div class="page_nav">';
			if ($pi[PAGE_CURRENT] > 1) {
				$rt .= '<a href="'.$link_url.'&page='.($pi[PAGE_CURRENT] - 1).'">前一頁</a>';
			} else {
				$rt .= '<span>前一頁</span>';
			}
			if ($pi[PAGE_CURRENT] < $pi[PAGE_COUNT]) {
				$rt .= '<a href="'.$link_url.'&page='.($pi[PAGE_CURRENT] + 1).'">下一頁</a>';
			} else {
				$rt .= '<span>下一頁</span>';
			}
			$rt .= '</div>';
			HTML_ADD($rt);
		}
	}
}

function RETURN_DB_SUB_FOLDER($FID, $ID) {
	return DB_LOCATION.'/'.$FID.'/'.substr('0000000'.$ID, -8);;
}

function GET_ATTACHMENTS_DB_FILES($FID, $ID, &$FILE_DB, &$FILE_ID) {
	$af = RETURN_DB_SUB_FOLDER($FID, $ID);
	$FILE_DB = $af.'/'.ATTACHMENTS_FILE_ID.'.inc';
	$FILE_ID = $af.'/'.ATTACHMENTS_FILE_ID.'_next_id.inc';
}

function RETURN_ATTACHMENTS_LIST($RING, $FID, $IDN, $ID) {
	global $THIS_PHP_FILE;

	$rt = '';
	$link_url = $THIS_PHP_FILE.'&'.$IDN.'='.$ID.'&attachments_id=';
	GET_ATTACHMENTS_DB_FILES($FID, $ID, $FILE_DB, $FILE_ID);
	if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
		$rc = count($ROWS);
		$ri = 0;
		while ($ri < $rc) {
			$row = &$ROWS[$ri];
			if ($ID == $row[ATTACHMENTS_FOLLOW_UID]) {
				if (!empty($RING)) {
					$dop = ' (<a href="#'.$row[ATTACHMENTS_UID].'" onclick="return CONFIRM_BEFORE_DELETE(this.parentNode.parentNode, \''.$link_url.$row[ATTACHMENTS_UID].'&op=attachments_delete'.'\');">刪除</a>)';
				} else {
					$dop = '';
				}
				$rt .= '<table cellspacing="0" cellpadding="0" class="attachments"><tr>';
				$rt .= '<td class="icon">'.RETURN_MIME_ICON_FILE($row[ATTACHMENTS_EXTENSION]).'</td>';
				$rt .= '<td><a href="'.$link_url.$row[ATTACHMENTS_UID].'&op=attachments_download" target="_blank">'.$row[ATTACHMENTS_NAME].'</a>'.$dop.'<div class="sub">'.RETURN_FRIENDLY_SIZE_STR($row[ATTACHMENTS_SIZE]).', '.RETURN_FRIENDLY_TIME_STR($row[ATTACHMENTS_TIME]).'</div></td>';
				$rt .= '</tr></table>';
			}
			++$ri;
		}
	}
	return $rt;
}

function DELETE_ATTACHMENTS($FID, $ID, $AID) {
	global $FILE_DB;

	GET_ATTACHMENTS_DB_FILES($FID, $ID, $FILE_DB, $FILE_ID);
	CHECK_ID_EXIST(RETURN_ID_FROM($AID), $ROWS, $ri);
	$row = &$ROWS[$ri];
	if ($ID == $row[ATTACHMENTS_FOLLOW_UID]) {
		if (file_exists($row[ATTACHMENTS_FILE_NAME])) {
			@unlink($row[ATTACHMENTS_FILE_NAME]);
		}
		unset($ROWS[$ri]);
		if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
		} else {
			SHOW_ERROR(ERROR_DUMP_FILE);
		}
	} else {
		SHOW_ERROR(ERROR_NO_RING);
	}
}

function SEND_ATTACHMENTS($FID, $ID, $AID) {
	global $FILE_DB;

	GET_ATTACHMENTS_DB_FILES($FID, $ID, $FILE_DB, $FILE_ID);
	CHECK_ID_EXIST(RETURN_ID_FROM($AID), $ROWS, $ri);
	$row = &$ROWS[$ri];
	if ($ID == $row[ATTACHMENTS_FOLLOW_UID]) {
		if (file_exists($row[ATTACHMENTS_FILE_NAME])) {
			SEND_FILE($row);
		} else {
			SHOW_ERROR(ERROR_LOAD_FILE);
		}
	} else {
		SHOW_ERROR(ERROR_NO_RING);
	}
}

function INSERT_ATTACHMENTS($FID, $ID) {
	$af = RETURN_DB_SUB_FOLDER($FID, $ID);
	CHECK_AND_CREATE_FOLDER($af);

	GET_ATTACHMENTS_DB_FILES($FID, $ID, $FILE_DB, $FILE_ID);
	if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
		$rc = count($ROWS);
	} else {
		$rc = 0;
	}
	$ni = LOAD_NEXT_ID($FILE_ID);

	$rt = FALSE;
	$nt = date('Y-m-d H:i');

	foreach ($_FILES['attachments']['error'] as $KEY => $VALUE) {
		if (UPLOAD_ERR_OK == $VALUE) {
			$pi = pathinfo($_POST['attachments_fn'][$KEY]);
			$fn = $af.'/'.md5($nt.$_FILES['attachments']['tmp_name'][$KEY]).'.'.$pi['extension'];
			if (move_uploaded_file($_FILES['attachments']['tmp_name'][$KEY], $fn)) {
				$rt = TRUE;

				$ROWS[$rc][ATTACHMENTS_UID] = $ni;
				$row = &$ROWS[$rc];
				$row[ATTACHMENTS_FOLLOW_UID] = $ID;
				$row[ATTACHMENTS_TIME] = $nt;
				$row[ATTACHMENTS_NAME] = $_POST['attachments_fn'][$KEY];
				if (get_magic_quotes_gpc()) $row[ATTACHMENTS_NAME] = stripslashes($row[ATTACHMENTS_NAME]);
				$row[ATTACHMENTS_TYPE] = $_FILES['attachments']['type'][$KEY];
				$row[ATTACHMENTS_SIZE] = $_FILES['attachments']['size'][$KEY];
				$row[ATTACHMENTS_EXTENSION] = $pi['extension'];
				$row[ATTACHMENTS_FILE_NAME] = $fn;
				++$rc;
				++$ni;
			}
		}
	}

	if ($rt) {
		--$ni;
		if (DUMP_NEXT_ID($FILE_ID, $ni)) {
			if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
			} else {
				SHOW_ERROR(ERROR_DUMP_FILE);
			}
		} else {
			SHOW_ERROR(ERROR_DUMP_FILE);
		}
	}
}


function CHECK_ID_EXIST($ID, &$ROWS, &$ri) {
	global $FILE_DB;

	if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
		$ri = RETURN_ROW_INDEX_BY_ID($ID, $ROWS);
		if ($ri >= 0) {
		} else {
			SHOW_ERROR(ERROR_UNKNOWN_ID);
		}
	} else {
		SHOW_ERROR(ERROR_LOAD_FILE);
	}
}

function LOAD_DB_AND_NEXT_ID(&$ROWS, &$rc, &$ni) {
	global $FILE_DB;
	global $FILE_ID;

	if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
		$rc = count($ROWS);
	} else {
		$rc = 0;
	}
	$ni = LOAD_NEXT_ID($FILE_ID);
}

function DUMP_DB_AND_NEXT_ID(&$ROWS, &$ni) {
	global $FILE_DB;
	global $FILE_ID;

	if (DUMP_NEXT_ID($FILE_ID, $ni)) {
		if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
		} else {
			SHOW_ERROR(ERROR_DUMP_FILE);
		}
	} else {
		SHOW_ERROR(ERROR_DUMP_FILE);
	}
}

function GET_UDP_SOCKET() {
	$sk = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
	if ($sk != FALSE) socket_set_option($sk, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
	return $sk;
}

function FREE_UDP_SOCKET(&$sk) {
	if ($sk != FALSE) socket_close($sk);
}


?>