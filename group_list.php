<?php

function RETURN_GROUP_OP_LINKS($link_url, $is_default) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_edit.png', '編輯', $link_url.'edit');
	if (!empty($THIS_STAFF_RINGS[RING_GROUP_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '刪除', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	if (!empty($THIS_STAFF_RINGS[RING_GROUP_DEFAULT])) {
		if (!$is_default) {
			$LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_default.png', '預設', $link_url.'default', 'CONFIRM_SET_DEFAULT', 'this.parentNode.parentNode');
		}
	}
	return implode('', $LS);
}

function RETURN_GROUP_MORE_LINKS() {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$link_url = $THIS_PHP_FILE.'&op=';
	if (!empty($THIS_STAFF_RINGS[RING_GROUP_INSERT])) $LS[] = '<a href="'.$link_url.'new">新增族群</a>';
	if (isset($LS)) {
		return implode(LINKS_SPLIT_CHAR, $LS);
	} else {
		return '';
	}
}


$default_group_id = LOAD_DEFAULT_ID($FILE_DEFAULT_ID);

HTML_HEADER('族群');
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th>名稱</th>';
$TR .= '<th class="last">預設</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$rc = count($ROWS);
	$ri = 0;
	while ($ri < $rc) {
		$row = &$ROWS[$ri];
		$link_url = $THIS_PHP_FILE.'&group_id='.$row[GROUP_UID].'&op=';
		$TR = '<tr><td>'.$row[GROUP_UID].'</td><td>'.RETURN_GROUP_OP_LINKS($link_url, ($default_group_id == $row[GROUP_UID])).'</td>';
		$TR .= '<td><a href="'.$link_url.'view">'.$row[GROUP_NAME].'</a></td>';
		if ($default_group_id != $row[GROUP_UID]) {
			$TR .= '<td>&nbsp;</td>';
		} else {
			$TR .= '<td>預設</td>';
		}
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('</table>');
HTML_ADD('<div class="more">其他: '.RETURN_GROUP_MORE_LINKS().'</div>');

HTML_OUTPUT();

?>