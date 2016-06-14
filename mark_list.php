<?php

function RETURN_MARK_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_edit.png', '編輯', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_MARK_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '刪除', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	return implode('', $LS);
}

function RETURN_MARK_MORE_LINKS() {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$link_url = $THIS_PHP_FILE.'&op=';
	if (!empty($THIS_STAFF_RINGS[RING_MARK_INSERT])) $LS[] = '<a href="'.$link_url.'new">新增標記</a>';
	if (isset($LS)) {
		return implode(LINKS_SPLIT_CHAR, $LS);
	} else {
		return '';
	}
}

HTML_HEADER('標記');
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th>名稱</th>';
$TR .= '<th class="last">對象</th>';
$TR .= '</tr>';
HTML_ADD($TR);

if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$page_info = RETURN_PAGE_INFO(ROWS_OF_PAGE_FILE, count($ROWS));
	$ri = $page_info[PAGE_BEGIN_ROW_N];
	while ($ri > $page_info[PAGE_LIMIT_ROW_N]) {
		$row = &$ROWS[$ri];
		$link_url = $THIS_PHP_FILE.'&mark_id='.$row[MARK_UID].'&op=';
		$TR = '<tr><td>'.$row[MARK_UID].'</td><td>'.RETURN_MARK_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$link_url.'view">'.$row[MARK_NAME].'</a></td>';
		$TR .= '<td>'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[MARK_CLIENT_ID], FALSE).'</td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		--$ri;
	}
}

HTML_ADD('</table>');
PAGE_BAR($page_info, $THIS_PHP_FILE);
HTML_ADD('<div class="more">其他: '.RETURN_MARK_MORE_LINKS().'</div>');

HTML_OUTPUT();

?>