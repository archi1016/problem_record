<?php

function RETURN_STANDBY_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_print.png', '列印', $link_url.'view&print');
	$LS[] = RETURN_ICON_LINK('op_edit.png', '編輯', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_STANDBY_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '刪除', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	return implode('', $LS);
}

function RETURN_STANDBY_MORE_LINKS() {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$link_url = $THIS_PHP_FILE.'&op=';
	if (!empty($THIS_STAFF_RINGS[RING_CLIENT_INSERT])) $LS[] = '<a href="'.$link_url.'new">新增備品</a>';
	if (isset($LS)) {
		return implode(LINKS_SPLIT_CHAR, $LS);
	} else {
		return '';
	}
}

HTML_HEADER('備品');
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th>名稱</th>';
$TR .= '<th class="last">狀態</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$page_info = RETURN_PAGE_INFO(ROWS_OF_PAGE_STANDBY, count($ROWS));
	$ri = $page_info[PAGE_BEGIN_ROW];
	while ($ri < $page_info[PAGE_LIMIT_ROW]) {
		$row = &$ROWS[$ri];
		$link_url = $THIS_PHP_FILE.'&standby_id='.$row[STANDBY_UID].'&op=';
		$TR = '<tr><td>'.$row[STANDBY_UID].'</td><td>'.RETURN_STANDBY_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$link_url.'view">'.$row[STANDBY_NAME].'</a></td>';
		$TR .= '<td>'.RETURN_STANDBY_STATUS($row[STANDBY_STATUS]).'</td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');
PAGE_BAR($page_info, $THIS_PHP_FILE);
HTML_ADD('<div class="more">其他: '.RETURN_STANDBY_MORE_LINKS().'</div>');

HTML_OUTPUT();

?>