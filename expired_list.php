<?php

function RETURN_EXPIRED_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_edit.png', '編輯', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_EXPIRED_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '刪除', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	return implode('', $LS);
}

function RETURN_EXPIRED_MORE_LINKS() {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$link_url = $THIS_PHP_FILE.'&op=';
	if (!empty($THIS_STAFF_RINGS[RING_EXPIRED_INSERT])) $LS[] = '<a href="'.$link_url.'new">新增過期</a>';
	if (isset($LS)) {
		return implode(LINKS_SPLIT_CHAR, $LS);
	} else {
		return '';
	}
}

$cex = 0;
$csf = 0;

$nt = strtotime(date('Y-m-d H:i'));
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$rc = count($ROWS);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$ri];
		$st = strtotime($row[EXPIRED_TIME]);
		if ($nt >= $st) {
			$lex[] = $ri;
			++$cex;
		} else {
			$lsf[] = $ri;
			++$csf;
		}
		++$ri;
	}
}

if ($cex > 0) {
	HTML_HEADER('過期 ('.$cex.')');
} else {
	HTML_HEADER('過期');
}
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th width="320" class="key">已過期</th>';
$TR .= '<th>誰的</th>';
$TR .= '<th class="last">時間</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (isset($lex)) {
	$rc = count($lex);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$lex[$ri]];
		$link_url = $THIS_PHP_FILE.'&expired_id='.$row[EXPIRED_UID].'&op=';
		$TR = '<tr><td>'.$row[EXPIRED_UID].'</td><td>'.RETURN_EXPIRED_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$link_url.'view">'.$row[EXPIRED_NAME].'</a></td>';
		$TR .= '<td>'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[EXPIRED_CLIENT_ID], FALSE).'</td>';
		$TR .= '<td>'.RETURN_FRIENDLY_TIME_STR($row[EXPIRED_TIME]).'</td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th width="320" class="key">未過期</th>';
$TR .= '<th>誰的</th>';
$TR .= '<th class="last">時間</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (isset($lsf)) {
	$rc = count($lsf);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$lsf[$ri]];
		$link_url = $THIS_PHP_FILE.'&expired_id='.$row[EXPIRED_UID].'&op=';
		$TR = '<tr><td>'.$row[EXPIRED_UID].'</td><td>'.RETURN_EXPIRED_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$link_url.'view">'.$row[EXPIRED_NAME].'</a></td>';
		$TR .= '<td>'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[EXPIRED_CLIENT_ID], FALSE).'</td>';
		$TR .= '<td>'.RETURN_FRIENDLY_EXPIRED_TIME_STR($row[EXPIRED_TIME]).'</td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');


HTML_ADD('<div class="more">其他: '.RETURN_EXPIRED_MORE_LINKS().'</div>');

HTML_OUTPUT();

?>