<?php

if (empty($_GET['category_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['category_id'] = stripslashes($_GET['category_id']);
}

$category_id = RETURN_ID_FROM($_GET['category_id']);
CHECK_ID_EXIST($category_id, $ROWS, $ri);
$row = &$ROWS[$ri];


HTML_HEADER('ฝsฟ่ยkรþ');
MENU_BAR();

FORM_HEADER($THIS_PHP_FILE.'&op=save&category_id='.$category_id, 'CHECK_SAVE_CATEGORY');
	FORM_INPUT_TEXT('ฆWบู', 'category_name', 32, $row[CATEGORY_NAME]);
FORM_FOOTER(!empty($THIS_STAFF_RINGS[RING_CATEGORY_SAVE]), 'ภxฆs');

HTML_OUTPUT();
?>