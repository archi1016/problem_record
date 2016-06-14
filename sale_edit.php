<?php

if (empty($_GET['sale_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['sale_id'] = stripslashes($_GET['sale_id']);
}

$sale_id = RETURN_ID_FROM($_GET['sale_id']);
CHECK_ID_EXIST($sale_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('編輯出貨');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&sale_id='.$sale_id, 'CHECK_SAVE_SALE');
	FORM_SELECT('客戶', 'sale_client_id', RETURN_CLIENT_OPTIONS($row[SALE_CLIENT_ID]));
	FORM_INPUT_TEXT('簡述', 'sale_title', 64, $row[SALE_TITLE]);
	FORM_DATE_TIME('出貨時間', 'repair', $row[SALE_TIME]);
	if ($row[SALE_CONTENT] != '') {
		$items = explode('\n', $row[SALE_CONTENT]);
		$itc = count($items);
	} else {
		$itc = 0;
	}
	$tr = '<tr valign="top"><td>出貨內容:</td><td>';
	$i = 0;
	while ($i < 12) {
		if ($i < $itc) {
			$ary = explode('<|>', $items[$i]);
			$in = $ary[0];
			$ic = $ary[1];
		} else {
			$in = '';
			$ic = '';
		}
		$tr .= RETURN_INPUT_TEXT('sale_item_name[]', 48, $in).'&nbsp;x&nbsp;'.RETURN_INPUT_TEXT('sale_item_count[]', 4, $ic).'&nbsp;('.($i+1).')<br>';
		++$i;
	}
	$tr .= '</td></tr>';
	HTML_ADD($tr);
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_SALE_SAVE]), '儲存');

HTML_OUTPUT();

?>