<?php

if (empty($_GET['sale_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['sale_id'] = stripslashes($_GET['sale_id']);
}

$sale_id = RETURN_ID_FROM($_GET['sale_id']);
CHECK_ID_EXIST($sale_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('�X�f #'.$sale_id.': '.$row[SALE_TITLE]);
MENU_BAR();

VIEW_HEADER('�X�f #'.$sale_id);
	VIEW_ROW('�Ȥ�', RETURN_CLIENT_NAME_BY_CLIENT_ID($row[SALE_CLIENT_ID], TRUE));
	VIEW_ROW('²�z', $row[SALE_TITLE]);
	VIEW_ROW('�X�f�ɶ�', $row[SALE_TIME].'<span class="more">('.RETURN_FRIENDLY_TIME_STR($row[SALE_TIME]).')</span>');
	if ($row[SALE_CONTENT] != '') {
		$items = explode('\n', $row[SALE_CONTENT]);
		$itc = count($items);
	} else {
		$itc = 0;
	}
	$tr = '<tr valign="top"><td class="lab">�X�f���e:</td><td>';
	$tr .= '<table cellspacing="0" cellpadding="0" class="sale"><tr><th>�W��</td><th class="last">�ƶq</th></tr>';
	$i = 0;
	while ($i < 12) {
		if ($i < $itc) {
			$ary = explode('<|>', $items[$i]);
			$tr .= '<tr><td>'.$ary[0].'</td><td>'.$ary[1].'</td></tr>';
		} else {
			break;
		}
		++$i;
	}
	$tr .= '</table></td></tr>';
	HTML_ADD($tr);
	VIEW_ROWS('����', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_SALE_ATTACHMENTS], SALE_FILE_ID, 'sale_id', $sale_id));
VIEW_FOOTER();

if (!empty($THIS_STAFF_RINGS[RING_SALE_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&sale_id='.$sale_id);
}

HTML_OUTPUT();

?>