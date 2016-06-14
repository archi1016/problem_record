<?php

if (empty($_GET['mark_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['mark_id'] = stripslashes($_GET['mark_id']);
}

$mark_id = RETURN_ID_FROM($_GET['mark_id']);
CHECK_ID_EXIST($mark_id, $ROWS, $ri);
$row = &$ROWS[$ri];

$cmk = 0;
$cuk = 0;

GET_MARK_ITEM_FILE(MARK_FILE_ID, $row[MARK_UID], $FILE_DB);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	$rc = count($ROWS);
	$ri = 0;
	while ($ri < $rc) {
		$item = &$ROWS[$ri];
		if (empty($item[MARK_ITEM_STATUS])) {
			$luk[] = $ri;
			++$cuk;
		} else {
			$lmk[] = $ri;
			++$cmk;
		}
		++$ri;
	}
} else {
	SHOW_ERROR(ERROR_ARGUMENTS);
}
$percent = (int) floor(($cmk * 100) / $rc);
$percentf = floor(($cmk * 1000) / $rc) / 10;


HTML_HEADER('標記 #'.$mark_id.': '.$row[MARK_NAME]);
MENU_BAR();

VIEW_HEADER('標記 #'.$mark_id);
	VIEW_ROW('名稱', $row[MARK_NAME]);
	VIEW_ROW('百分比', $percentf.'%<span class="more">('.$cmk.'/'.$rc.')</span>');
	VIEW_ROWS('附件', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_MARK_ATTACHMENTS], MARK_FILE_ID, 'mark_id', $mark_id));
VIEW_FOOTER();



HTML_ADD('<form action="'.$THIS_PHP_FILE.'&mark_id='.$mark_id.'&op=set&" method="post"><table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="id">&nbsp;</th>';
$TR .= '<th width="580" class="key">已標記</th>';
$TR .= '<th class="last">時間</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (isset($lmk)) {
	$rc = count($lmk);
	$ri = 0;
	while ($ri < $rc) {
		$i = $lmk[$ri];
		$item = &$ROWS[$i];
		if ($item[MARK_ITEM_README] != '') $item[MARK_ITEM_README] = '<span class="more">('.$item[MARK_ITEM_README].')</span>';
		if ($item[MARK_ITEM_TIME] != '') {
			$item[MARK_ITEM_TIME] = RETURN_FRIENDLY_TIME_STR($item[MARK_ITEM_TIME]);
		} else {
			$item[MARK_ITEM_TIME] = '&nbsp;';
		}
		$TR = '<tr><td>'.$item[MARK_ITEM_UID].'</td><td onclick="CHECK_SELECT_BAR_FROM_TD(this.firstChild,this.parentNode);"><input type="checkbox" name="mark_r['.$i.']" value="'.$i.'" onclick="CHECK_SELECT_BAR_FROM_CHECKBOX(this,this.parentNode.parentNode);"></td>';
		$TR .= '<td>'.$item[MARK_ITEM_NAME].$item[MARK_ITEM_README].'</td>';
		$TR .= '<td>'.$item[MARK_ITEM_TIME].'</td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('<tr><td>&nbsp;</td><td>&nbsp;</td><td><input type="hidden" name="mark_do" value="cancel"><input type="hidden" name="mark_readme" value=""></td><td><input type="submit" value="取消標記"></td></tr>');
HTML_ADD('</table></form>');




HTML_ADD('<form action="'.$THIS_PHP_FILE.'&mark_id='.$mark_id.'&op=set&" method="post"><table cellspacing="0" cellpadding="0">');
$TR = '<tr><th class="id">ID</th><th class="id">&nbsp;</th>';
$TR .= '<th width="580" class="key">未標記</th>';
$TR .= '<th class="last">&nbsp;</th>';
$TR .= '</tr>';
HTML_ADD($TR);
if (isset($luk)) {
	$rc = count($luk);
	$ri = 0;
	while ($ri < $rc) {
		$i = $luk[$ri];
		$item = &$ROWS[$i];
		$TR = '<tr><td>'.$item[MARK_ITEM_UID].'</td><td onclick="CHECK_SELECT_BAR_FROM_TD(this.firstChild,this.parentNode);"><input type="checkbox" name="mark_r['.$i.']" value="'.$i.'" onclick="CHECK_SELECT_BAR_FROM_CHECKBOX(this,this.parentNode.parentNode);"></td>';
		$TR .= '<td>'.$item[MARK_ITEM_NAME].'</td>';
		$TR .= '<td>&nbsp;</td>';
		$TR .= '</tr>';
		HTML_ADD($TR);
		++$ri;
	}
}
HTML_ADD('<tr><td>&nbsp;</td><td>&nbsp;</td><td><input type="hidden" name="mark_do" value="set"><input type="text" name="mark_readme" size="48" value=""> (說明)</td><td><input type="submit" value="標記"></td></tr>');
HTML_ADD('</table></form>');



if (!empty($THIS_STAFF_RINGS[RING_MARK_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&mark_id='.$mark_id);
}

HTML_OUTPUT();

?>