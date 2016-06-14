<?php

function RETURN_CLIENT_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_print.png', '列印', $link_url.'view&print');
	$LS[] = RETURN_ICON_LINK('op_edit.png', '編輯', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_CLIENT_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '刪除', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	return implode('', $LS);
}

function RETURN_CLIENT_MORE_LINKS() {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$link_url = $THIS_PHP_FILE.'&op=';
	if (!empty($THIS_STAFF_RINGS[RING_CLIENT_INSERT])) $LS[] = '<a href="'.$link_url.'new">新增客戶</a>';
	if (isset($LS)) {
		return implode(LINKS_SPLIT_CHAR, $LS);
	} else {
		return '';
	}
}


HTML_HEADER('客戶');
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th width="160">名稱</th>';
$TR .= '<th class="value">標籤</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$page_info = RETURN_PAGE_INFO(ROWS_OF_PAGE_CLIENT, count($ROWS));
	$ri = $page_info[PAGE_BEGIN_ROW];
	while ($ri < $page_info[PAGE_LIMIT_ROW]) {
		$row = &$ROWS[$ri];
		if ($row[CLIENT_TAG] == '') $row[CLIENT_TAG] = '&nbsp;';
		$link_url = $THIS_PHP_FILE.'&client_id='.$row[CLIENT_UID].'&op=';
		$TR = '<tr><td>'.$row[CLIENT_UID].'</td><td>'.RETURN_CLIENT_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$link_url.'view">'.$row[CLIENT_NAME].'</a><div class="sub">'.RETURN_CLIENT_COOPERATION($row[CLIENT_COOPERATION]).'</div></td>';
		$TR .= '<td>'.$row[CLIENT_TELEPHONE].'<div class="sub">'.$row[CLIENT_TAG].'</div></td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');
PAGE_BAR($page_info, $THIS_PHP_FILE);
HTML_ADD('<div class="more">其他: '.RETURN_CLIENT_MORE_LINKS().'</div>');

HTML_OUTPUT();

?>