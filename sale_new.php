<?php

if (empty($THIS_STAFF_RINGS[RING_SALE_INSERT])) SHOW_ERROR(ERROR_NO_RING);

HTML_HEADER('�s�W�X�f');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=insert', 'CHECK_NEW_SALE');
	FORM_SELECT('�Ȥ�', 'sale_client_id', RETURN_CLIENT_OPTIONS(-1));
	FORM_INPUT_TEXT('²�z', 'sale_title', 64, '');
	FORM_DATE_TIME('�X�f�ɶ�', 'sale', NULL);
	$tr = '<tr valign="top"><td>�X�f���e:</td><td>';
	$i = 0;
	while ($i < 12) {
		$tr .= RETURN_INPUT_TEXT('sale_item_name[]', 48, '').'&nbsp;x&nbsp;'.RETURN_INPUT_TEXT('sale_item_count[]', 4, '').'&nbsp;('.($i+1).')<br>';
		++$i;
	}
	$tr .= '</td></tr>';
	HTML_ADD($tr);
FORM_FOOTER(TRUE, '�s�W');

HTML_OUTPUT();

?>