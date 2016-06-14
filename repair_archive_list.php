<?php

function RETURN_REPAIR_ARCHIVE_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_print.png', '列印', $link_url.'archive_view&print');
	$LS[] = RETURN_ICON_LINK('op_edit.png', '編輯', $link_url.'archive_edit');
	if (!empty($THIS_STAFF_RINGS[RING_REPAIR_ARCHIVE_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '刪除', $link_url.'archive_delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	return implode('', $LS);
}

HTML_HEADER('送修記錄');
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th class="key">已取回</th>';
$TR .= '<th class="last">時間</th>';
$TR .= '</tr>';
HTML_ADD($TR);

$FILE_DB = RETURN_DB_FILE_PATH(REPAIR_ARCHIVE_FILE_ID);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$page_info = RETURN_PAGE_INFO(ROWS_OF_PAGE_REPAIR, count($ROWS));
	$ri = $page_info[PAGE_BEGIN_ROW_N];
	while ($ri > $page_info[PAGE_LIMIT_ROW_N]) {
		$row = &$ROWS[$ri];
		$link_url = $THIS_PHP_FILE.'&repair_id='.$row[REPAIR_ARCHIVE_UID].'&op=';
		$rp = $row[REPAIR_ARCHIVE_REPORT];
		if (!empty($row[REPAIR_ARCHIVE_COST])) $rp .= ' <span class="cost">+$'.$row[REPAIR_ARCHIVE_COST].'</span>';
		$TR = '<tr><td>'.$row[REPAIR_ARCHIVE_UID].'</td><td>'.RETURN_REPAIR_ARCHIVE_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$link_url.'archive_view">'.$row[REPAIR_ARCHIVE_NAME].'</a><div class="sub">'.$row[REPAIR_ARCHIVE_REASON].'<br><b>'.$rp.'</b></div></td>';
		$TR .= '<td>'.$row[REPAIR_ARCHIVE_TIME_RETURN].'<div class="sub">'.RETURN_FRIENDLY_TIME_STR($row[REPAIR_ARCHIVE_TIME_RETURN]).'<br>'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[REPAIR_ARCHIVE_CLIENT_ID], FALSE).'</div></td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		--$ri;
	}
}
HTML_ADD('</table>');
PAGE_BAR($page_info, $THIS_PHP_FILE.'&op='.$_GET['op']);

HTML_OUTPUT();

?>