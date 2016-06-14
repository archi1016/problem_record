<?php

if (empty($THIS_STAFF_RINGS[RING_SALE_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('新增出貨');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_SALE');
	FORM_SELECT('客戶', 'sale_client_id', RETURN_CLIENT_OPTIONS(-1));
	FORM_INPUT_TEXT('簡述', 'sale_title', 64, '');
	FORM_DATE_TIME('出貨時間', 'sale', NULL);
	$tr = '<tr valign="top"><td>出貨內容:</td><td>';
	$i = 0;
	while ($i < 12) {
		$tr .= RETURN_INPUT_TEXT('sale_item_name[]', 48, '').'&nbsp;x&nbsp;'.RETURN_INPUT_TEXT('sale_item_count[]', 4, '').'&nbsp;('.($i+1).')<br>';
		++$i;
	}
	$tr .= '</td></tr>';
	HTML_ADD($tr);
FORM_FOOTER(TRUE, '新增');

HTML_OUTPUT();

?>