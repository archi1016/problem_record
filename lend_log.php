<?php

function RETURN_LEND_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_print.png', '列印', $link_url.'log_view&print');	
	if (!empty($THIS_STAFF_RINGS[RING_LEND_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '刪除', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	return implode('', $LS);
}

HTML_HEADER('出借記錄');
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th>出借記錄</th>';
$TR .= '<th class="last">時間</th>';
$TR .= '</tr>';
HTML_ADD($TR);

if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$page_info = RETURN_PAGE_INFO(ROWS_OF_PAGE_LEND, count($ROWS));
	$ri = $page_info[PAGE_BEGIN_ROW_N];
	while ($ri > $page_info[PAGE_LIMIT_ROW_N]) {
		$row = &$ROWS[$ri];
		$link_url = $THIS_PHP_FILE.'&lend_id='.$row[LEND_UID].'&op=';
		$TR = '<tr><td>'.$row[LEND_UID].'</td>';
		if (empty($row[LEND_TIME])) {
			$TR .= '<td>(出借中)</td>';
		} else {
			$TR .= '<td>'.RETURN_LEND_OP_LINKS($link_url).'</td>';
		}
		$TR .= '<td><a href="'.$link_url.'log_view">'.RETURN_STANDBY_NAME_BY_STANDBY_ID($row[LEND_STANDBY_ID], FALSE).'</a><div class="sub">'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[LEND_CLIENT_ID], TRUE).'</div></td>';
		if (empty($row[LEND_TIME])) {
			$TR .= '<td>&nbsp;</td>';
		} else {
			$TR .= '<td>'.$row[LEND_TIME].'<br />'.$row[LEND_TIME_RETURN].'</td>';
		}
		$TR .= '</tr>';
		HTML_ADD($TR);
		--$ri;
	}
}
HTML_ADD('</table>');
PAGE_BAR($page_info, $THIS_PHP_FILE.'&op='.$_GET['op']);

HTML_OUTPUT();

?>