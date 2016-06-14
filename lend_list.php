<?php

function RETURN_OUT_LEND_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_print.png', '�C�L', $link_url.'view&print');
	$LS[] = RETURN_ICON_LINK('op_edit.png', '�s��', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_LEND_RETURN])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_return.png', '�k��', $link_url.'return', 'CONFIRM_RETURN_LEND', 'this.parentNode.parentNode');
	return implode('', $LS);
}

function RETURN_IN_LEND_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;

	$LS[] = RETURN_ICON_LINK('op_print.png', '�C�L', $link_url.'view&print');
	$LS[] = RETURN_ICON_LINK('op_out.png', '�ɥX', $link_url.'edit');
	return implode('', $LS);
}

function RETURN_LEND_MORE_LINKS() {
	global $THIS_PHP_FILE;

	$link_url = $THIS_PHP_FILE.'&op=';
	$LS[] = '<a href="'.$link_url.'log">��h�X�ɰO��</a>';
	if (isset($LS)) {
		return implode(LINKS_SPLIT_CHAR, $LS);
	} else {
		return '';
	}
}

$cot = 0;
$cin = 0;

if (LOAD_TEXT_TABLE(RETURN_DB_FILE_PATH(STANDBY_FILE_ID), $ROWS)) {
	$rc = count($ROWS);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$ri];
		if (STANDBY_STATUS_NORMAL == (int) $row[STANDBY_STATUS]) {
			if (!empty($row[STANDBY_CLIENT_ID])) {
				$lot[] = $ri;
				++$cot;
			} else {
				$lin[] = $ri;
				++$cin;
			}
		}
		++$ri;
	}
}

HTML_HEADER('�X�� ('.$cot.') ('.$cin.')');
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">�ާ@</th>';
$TR .= '<th class="key">�X�ɤ�</th>';
$TR .= '<th class="last">�ɶ�</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (isset($lot)) {
	$rc = count($lot);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$lot[$ri]];
		$link_url = $THIS_PHP_FILE.'&standby_id='.$row[STANDBY_UID].'&op=';
		$TR = '<tr><td>'.$row[STANDBY_UID].'</td><td>'.RETURN_OUT_LEND_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$link_url.'view">'.$row[STANDBY_NAME].'</a><div class="sub">'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[STANDBY_CLIENT_ID], FALSE).'</div></td>';
		$TR .= '<td>'.$row[STANDBY_LEND_TIME].'<div class="sub">'.RETURN_FRIENDLY_TIME_STR($row[STANDBY_LEND_TIME]).'</div></td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');


HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">�ާ@</th>';
$TR .= '<th class="key">���Ԥ�</th>';
$TR .= '<th class="last">��m</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (isset($lin)) {
	$rc = count($lin);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$lin[$ri]];
		$link_url = $THIS_PHP_FILE.'&standby_id='.$row[STANDBY_UID].'&op=';
		$TR = '<tr><td>'.$row[STANDBY_UID].'</td><td>'.RETURN_IN_LEND_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$link_url.'view">'.$row[STANDBY_NAME].'</a></td>';
		$TR .= '<td>'.$row[STANDBY_LOCATION].'</td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');



HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">�ާ@</th>';
$TR .= '<th>�X�ɰO��</th>';
$TR .= '<th class="last">�ɶ�</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$rc = count($ROWS);
	$ri = $rc - 1;
	$ra = 0;
	while ($ri >= 0) {
		$row = &$ROWS[$ri];
		if (!empty($row[LEND_TIME])) {
			$link_url = $THIS_PHP_FILE.'&lend_id='.$row[LEND_UID].'&op=';
			$TR = '<tr><td>'.$row[LEND_UID].'</td><td>&nbsp;</td>';
			$TR .= '<td><a href="'.$link_url.'log_view">'.RETURN_STANDBY_NAME_BY_STANDBY_ID($row[LEND_STANDBY_ID], FALSE).'</a><div class="sub">'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[LEND_CLIENT_ID], FALSE).'</div></td>';
			$TR .= '<td>'.$row[LEND_TIME].'<br />'.$row[LEND_TIME_RETURN].'</td>';
			$TR .= '</tr>';
			HTML_ADD($TR);
			++$ra;
			if ($ra >= 6) break;
		}
		--$ri;
	}
}
HTML_ADD('</table>');

HTML_ADD('<div class="more">��L: '.RETURN_LEND_MORE_LINKS().'</div>');

HTML_OUTPUT();

?>