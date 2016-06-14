<?php

function RETURN_SUPPLIER_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_print.png', '列印', $link_url.'view&print');
	$LS[] = RETURN_ICON_LINK('op_edit.png', '編輯', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_SUPPLIER_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '刪除', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	return implode('', $LS);
}

function RETURN_SUPPLIER_MORE_LINKS() {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$link_url = $THIS_PHP_FILE.'&op=';
	if (!empty($THIS_STAFF_RINGS[RING_SUPPLIER_INSERT])) $LS[] = '<a href="'.$link_url.'new">新增廠商</a>';
	if (isset($LS)) {
		return implode(LINKS_SPLIT_CHAR, $LS);
	} else {
		return '';
	}
}


HTML_HEADER('廠商');
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th width="160">名稱</th>';
$TR .= '<th class="value">電話</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$page_info = RETURN_PAGE_INFO(ROWS_OF_PAGE_SUPPLIER, count($ROWS));
	$ri = $page_info[PAGE_BEGIN_ROW];
	while ($ri < $page_info[PAGE_LIMIT_ROW]) {
		$row = &$ROWS[$ri];
		$link_url = $THIS_PHP_FILE.'&supplier_id='.$row[SUPPLIER_UID].'&op=';
		$TR = '<tr><td>'.$row[SUPPLIER_UID].'</td><td>'.RETURN_SUPPLIER_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$link_url.'view">'.$row[SUPPLIER_NAME].'</a></td>';
		$TR .= '<td>'.$row[SUPPLIER_TELEPHONE].'</td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');
PAGE_BAR($page_info, $THIS_PHP_FILE);
HTML_ADD('<div class="more">其他: '.RETURN_SUPPLIER_MORE_LINKS().'</div>');

HTML_OUTPUT();

?>