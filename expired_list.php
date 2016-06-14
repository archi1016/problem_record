<?php

function RETURN_EXPIRED_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_edit.png', '�s��', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_EXPIRED_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '�R��', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	return implode('', $LS);
}

function RETURN_EXPIRED_MORE_LINKS() {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$link_url = $THIS_PHP_FILE.'&op=';
	if (!empty($THIS_STAFF_RINGS[RING_EXPIRED_INSERT])) $LS[] = '<a href="'.$link_url.'new">�s�W�L��</a>';
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
	HTML_HEADER('�L�� ('.$cex.')');
} else {
	HTML_HEADER('�L��');
}
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">�ާ@</th>';
$TR .= '<th width="320" class="key">�w�L��</th>';
$TR .= '<th>�֪�</th>';
$TR .= '<th class="last">�ɶ�</th>';
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
$TR = '<tr><th class="id">ID</th><th class="op">�ާ@</th>';
$TR .= '<th width="320" class="key">���L��</th>';
$TR .= '<th>�֪�</th>';
$TR .= '<th class="last">�ɶ�</th>';
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


HTML_ADD('<div class="more">��L: '.RETURN_EXPIRED_MORE_LINKS().'</div>');

HTML_OUTPUT();

?>