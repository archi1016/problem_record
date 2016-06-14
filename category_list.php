<?php

function RETURN_CATEGORY_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	
	$LS[] = RETURN_ICON_LINK('op_edit.png', '編輯', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_CATEGORY_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '刪除', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	return implode('', $LS);
}

function RETURN_CATEGORY_MORE_LINKS() {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$link_url = $THIS_PHP_FILE.'&op=';
	if (!empty($THIS_STAFF_RINGS[RING_CATEGORY_INSERT])) $LS[] = '<a href="'.$link_url.'new">新增歸類</a>';
	if (isset($LS)) {
		return implode(LINKS_SPLIT_CHAR, $LS);
	} else {
		return '';
	}
}


HTML_HEADER('歸類');
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th class="value">名稱</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$rc = count($ROWS);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$ri];
		$link_url = $THIS_PHP_FILE.'&category_id='.$row[CATEGORY_UID].'&op=';
		$TR = '<tr><td>'.$row[CATEGORY_UID].'</td><td>'.RETURN_CATEGORY_OP_LINKS($link_url).'</td>';
		$TR .= '<td>'.$row[CATEGORY_NAME].'</td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');
HTML_ADD('<div class="more">其他: '.RETURN_CATEGORY_MORE_LINKS().'</div>');

HTML_OUTPUT();

?>