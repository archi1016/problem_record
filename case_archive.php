<?php

function RETURN_ARCHIVE_OP_LINKS($link_url) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$LS[] = RETURN_ICON_LINK('op_print.png', '列印', $link_url.'archive_view&print');
	if (!empty($THIS_STAFF_RINGS[RING_ARCHIVE_DELETE])) $LS[] = RETURN_ICON_LINK_WITH_CONFIRM('op_delete.png', '刪除', $link_url.'delete', 'CONFIRM_BEFORE_DELETE', 'this.parentNode.parentNode');
	return implode('', $LS);
}

HTML_HEADER('歸檔案例');
MENU_BAR();


$FILE_DB = RETURN_DB_FILE_PATH(ARCHIVE_FILE_ID);

HTML_ADD('<table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="op">操作</th>';
$TR .= '<th class="key">已歸檔</th>';
$TR .= '<th class="last">時間</th>';
HTML_ADD($TR);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$page_info = RETURN_PAGE_INFO(ROWS_OF_PAGE_ARCHIVE, count($ROWS));
	$ri = $page_info[PAGE_BEGIN_ROW_N];
	while ($ri > $page_info[PAGE_LIMIT_ROW_N]) {
		$row = &$ROWS[$ri];
		$link_url = $THIS_PHP_FILE.'&case_id='.$row[ARCHIVE_UID].'&op=';
		$TR = '<tr><td>'.$row[ARCHIVE_UID].'</td><td>'.RETURN_ARCHIVE_OP_LINKS($link_url).'</td>';
		$TR .= '<td><a href="'.$THIS_PHP_FILE.'&case_id='.$row[ARCHIVE_UID].'&op=archive_view">'.$row[ARCHIVE_TITLE].'</a><div class="sub">'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[CASE_CLIENT_ID], FALSE).'</div></td>';
		$TR .= '<td>'.$row[ARCHIVE_CLOSED_TIME].'<div class="sub">'.RETURN_STAFF_NAME_BY_STAFF_ID($row[CASE_STAFF_ID], FALSE).'</div></td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		--$ri;
	}
}
HTML_ADD('</table>');
PAGE_BAR($page_info, $THIS_PHP_FILE.'&op='.$_GET['op']);

HTML_OUTPUT();

?>