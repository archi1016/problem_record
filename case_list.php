<?php

function RETURN_UNTREATED_CASE_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_edit.png', '編輯', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_CASE_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '刪除', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	if (!empty($THIS_STAFF_RINGS[RING_CASE_TAKE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_take.png', '接手', $link_url.'take', 'CONFIRM_TAKE_CASE', 'this.parentNode.parentNode');
	return implode('', $LS);
}

function RETURN_PROCESSING_CASE_OP_LINKS($link_url, $staff_id) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_edit.png', '編輯', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_CASE_RETURN])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_return.png', '退件', $link_url.'return', 'CONFIRM_RETURN_CASE', 'this.parentNode.parentNode');
	if (!empty($THIS_STAFF_RINGS[RING_CASE_TAKE])) {
		if ($staff_id != $_SESSION['UID']) {
			$LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_take.png', '接手', $link_url.'take', 'CONFIRM_TAKE_CASE', 'this.parentNode.parentNode');
		}
	}
	return implode('', $LS);
}

function RETURN_WAITING_CASE_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_edit.png', '編輯', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_CASE_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '刪除', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	return implode('', $LS);
}

function RETURN_CASE_MORE_LINKS() {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$link_url = $THIS_PHP_FILE.'&op=';
	if (!empty($THIS_STAFF_RINGS[RING_CASE_INSERT])) $LS[] = '<a href="'.$link_url.'new">新增案例</a>';
	$LS[] = '<a href="'.$link_url.'archive">更多歸檔案例</a>';
	if (isset($LS)) {
		return implode(LINKS_SPLIT_CHAR, $LS);
	} else {
		return '';
	}
}


$cun = 0;
$cps = 0;
$cwt = 0;
$cmyps = 0;
$cmywt = 0;

$nt = strtotime('now');
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$rc = count($ROWS);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$ri];
		$pt = strtotime($row[CASE_PREDESTINATE_TIME]);
		if ($nt >= $pt) {
			if (empty($row[CASE_STAFF_ID])) {
				$link_urln[] = $ri;
				++$cun;
			} else {
				$lps[] = $ri;
				++$cps;
				if ($_SESSION['UID'] == $row[CASE_STAFF_ID]) {
					++$cmyps;
				}
			}
		} else {
			$lwt[] = $ri;
			++$cwt;
			if ($_SESSION['UID'] == $row[CASE_STAFF_ID]) {
				++$cmywt;
			}
		}
		++$ri;
	}
}


HTML_HEADER('案例 ('.$cmyps.') ('.$cmywt.') / ('.$cun.') ('.$cps.') ('.$cwt.')');
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0" class="untreaded">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th class="key">未處理</th>';
$TR .= '<th class="last">開案</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (isset($link_urln)) {
	$rc = count($link_urln);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$link_urln[$ri]];
		$link_url = $THIS_PHP_FILE.'&case_id='.$row[CASE_UID].'&op=';
		$TR = '<tr><td>'.$row[CASE_UID].'</td><td>'.RETURN_UNTREATED_CASE_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$THIS_PHP_FILE.'&case_id='.$row[CASE_UID].'&op=thread">'.$row[CASE_TITLE].'</a><div class="sub">'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[CASE_CLIENT_ID], FALSE).'<br>'.$row[CASE_TAG].'<br></div></td>';
		$TR .= '<td>'.$row[CASE_OPENED_TIME].'<div class="sub">'.RETURN_FRIENDLY_TIME_STR($row[CASE_OPENED_TIME]).'<br>'.RETURN_STAFF_NAME_BY_STAFF_ID($row[CASE_OPENED_STAFF_ID], FALSE).'</div></td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');


HTML_ADD('<table cellspacing="0" cellpadding="0" class="processing">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th class="key">處理中</th>';
$TR .= '<th class="last">接手</th>';
HTML_ADD($TR);
if (isset($lps)) {
	$rc = count($lps);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$lps[$ri]];
		$link_url = $THIS_PHP_FILE.'&case_id='.$row[CASE_UID].'&op=';
		$TR = '<tr><td>'.$row[CASE_UID].'</td><td>'.RETURN_PROCESSING_CASE_OP_LINKS($link_url, $row[CASE_STAFF_ID]).'</td>';
		$TR .= '<td><a href="'.$THIS_PHP_FILE.'&case_id='.$row[CASE_UID].'&op=thread">'.$row[CASE_TITLE].'</a><div class="sub">'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[CASE_CLIENT_ID], FALSE).'<br>'.$row[CASE_TAG].'<br></div></td>';
		$TR .= '<td>'.$row[CASE_TAKING_TIME].'<div class="sub">'.RETURN_FRIENDLY_TIME_STR($row[CASE_TAKING_TIME]).'<br>'.RETURN_STAFF_NAME_BY_STAFF_ID($row[CASE_STAFF_ID], FALSE).'</div></td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');


HTML_ADD('<table cellspacing="0" cellpadding="0" class="waiting">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th class="key">預定</th>';
$TR .= '<th class="last">時間</th>';
HTML_ADD($TR);
if (isset($lwt)) {
	$rc = count($lwt);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$lwt[$ri]];
		$link_url = $THIS_PHP_FILE.'&case_id='.$row[CASE_UID].'&op=';
		$TR = '<tr><td>'.$row[CASE_UID].'</td><td>'.RETURN_WAITING_CASE_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$THIS_PHP_FILE.'&case_id='.$row[CASE_UID].'&op=thread">'.$row[CASE_TITLE].'</a><div class="sub">'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[CASE_CLIENT_ID], FALSE).'<br>'.$row[CASE_TAG].'<br></div></td>';
		$TR .= '<td>'.$row[CASE_PREDESTINATE_TIME].'<div class="sub">'.RETURN_FRIENDLY_PREDESTINATE_TIME_STR($row[CASE_PREDESTINATE_TIME]).'<br>'.RETURN_STAFF_NAME_BY_STAFF_ID($row[CASE_STAFF_ID], FALSE).'</div></td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');




$FILE_DB = RETURN_DB_FILE_PATH(ARCHIVE_FILE_ID);

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th class="key">已歸檔</th>';
$TR .= '<th class="last">時間</th>';
HTML_ADD($TR);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$rc = count($ROWS);
	$ri = $rc - 1;
	$ra = 0;
	while ($ri >= 0) {
		$row = &$ROWS[$ri];
		$TR = '<tr><td>'.$row[ARCHIVE_UID].'</td><td>&nbsp;</td>';
		$TR .= '<td><a href="'.$THIS_PHP_FILE.'&case_id='.$row[ARCHIVE_UID].'&op=archive_view">'.$row[ARCHIVE_TITLE].'</a><div class="sub">'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[CASE_CLIENT_ID], FALSE).'<br>'.$row[CASE_TAG].'<br></div></td>';
		$TR .= '<td>'.$row[ARCHIVE_CLOSED_TIME].'<div class="sub">'.RETURN_FRIENDLY_TIME_STR($row[ARCHIVE_CLOSED_TIME]).'<br>'.RETURN_STAFF_NAME_BY_STAFF_ID($row[CASE_STAFF_ID], FALSE).'</div></td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ra;
		if ($ra >= 6) break;
		--$ri;
	}
}
HTML_ADD('</table>');


HTML_ADD('<div class="more">其他: '.RETURN_CASE_MORE_LINKS().'</div>');

HTML_OUTPUT();

?>