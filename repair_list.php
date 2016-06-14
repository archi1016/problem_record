<?php

function RETURN_REPAIR_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_print.png', '�C�L', $link_url.'view&print');
	$LS[] = RETURN_ICON_LINK('op_edit.png', '�s��', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_REPAIR_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '�R��', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	if (!empty($THIS_STAFF_RINGS[RING_REPAIR_RETURN])) $LS[] = RETURN_ICON_LINK('op_return.png', '���^', $link_url.'return');
	return implode('', $LS);
}

function RETURN_REPAIR_MORE_LINKS() {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$link_url = $THIS_PHP_FILE.'&op=';
	if (!empty($THIS_STAFF_RINGS[RING_REPAIR_INSERT])) $LS[] = '<a href="'.$link_url.'new">�s�W�e��</a>';
	$LS[] = '<a href="'.$link_url.'archive_list">��h�e�װO��</a>';
	if (isset($LS)) {
		return implode(LINKS_SPLIT_CHAR, $LS);
	} else {
		return '';
	}
}

if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$rc = count($ROWS);
} else {
	$rc = 0;
}

HTML_HEADER('�e�� ('.$rc.')');
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">�ާ@</th>';
$TR .= '<th class="key">�e�פ�</th>';
$TR .= '<th class="last">�ɶ�</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if ($rc > 0) {
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$ri];
		$link_url = $THIS_PHP_FILE.'&repair_id='.$row[REPAIR_UID].'&op=';
		$TR = '<tr><td>'.$row[REPAIR_UID].'</td><td>'.RETURN_REPAIR_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$link_url.'view">'.$row[REPAIR_NAME].'</a><div class="sub">'.$row[REPAIR_REASON].'<br>'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[REPAIR_CLIENT_ID], FALSE).'</div></td>';
		$TR .= '<td>'.$row[REPAIR_TIME].'<div class="sub">'.RETURN_FRIENDLY_TIME_STR($row[REPAIR_TIME]).'<br>'.RETURN_STAFF_NAME_BY_STAFF_ID($row[REPAIR_STAFF_ID], FALSE).'</div></td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');


$FILE_DB = RETURN_DB_FILE_PATH(REPAIR_ARCHIVE_FILE_ID);
HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">�ާ@</th>';
$TR .= '<th class="key">�w���^</th>';
$TR .= '<th class="last">�ɶ�</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$rc = count($ROWS);
	$ri = $rc - 1;
	$ra = 0;
	while ($ri >= 0) {
		$row = &$ROWS[$ri];
		$link_url = $THIS_PHP_FILE.'&repair_id='.$row[REPAIR_ARCHIVE_UID].'&op=';
		$rp = $row[REPAIR_ARCHIVE_REPORT];
		if (!empty($row[REPAIR_ARCHIVE_COST])) $rp .= ' <span class="cost">+$'.$row[REPAIR_ARCHIVE_COST].'</span>';
		$TR = '<tr><td>'.$row[REPAIR_ARCHIVE_UID].'</td><td>&nbsp;</td>';
		$TR .= '<td><a href="'.$link_url.'archive_view">'.$row[REPAIR_ARCHIVE_NAME].'</a><div class="sub">'.$row[REPAIR_ARCHIVE_REASON].'<br><b>'.$rp.'</b></div></td>';
		$TR .= '<td>'.$row[REPAIR_ARCHIVE_TIME_RETURN].'<div class="sub">'.RETURN_FRIENDLY_TIME_STR($row[REPAIR_ARCHIVE_TIME_RETURN]).'<br>'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[REPAIR_ARCHIVE_CLIENT_ID], FALSE).'</div></td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ra;
		if ($ra >= 6) break;
		--$ri;
	}
}
HTML_ADD('</table>');

HTML_ADD('<div class="more">��L: '.RETURN_REPAIR_MORE_LINKS().'</div>');

HTML_OUTPUT();

?>