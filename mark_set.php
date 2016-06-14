<?php

if (empty($THIS_STAFF_RINGS[RING_MARK_DELETE])) SHOW_ERROR(ERROR_NO_RING);
if (empty($_GET['mark_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['mark_r'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_POST['mark_r'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['mark_do'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_POST['mark_readme'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (get_magic_quotes_gpc()) {
	$_GET['mark_id'] = stripslashes($_GET['mark_id']);
	$_POST['mark_do'] = stripslashes($_POST['mark_do']);
	$_POST['mark_readme'] = stripslashes($_POST['mark_readme']);
}

$mark_id = RETURN_ID_FROM($_GET['mark_id']);
CHECK_ID_EXIST($mark_id, $ROWS, $ri);
$row = &$ROWS[$ri];

GET_MARK_ITEM_FILE(MARK_FILE_ID, $row[MARK_UID], $FILE_DB);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	foreach ($_POST['mark_r'] as $key => $value) {
		if (isset($ROWS[$key])) {
			$row = &$ROWS[$key];
			switch ($_POST['mark_do']) {
				case 'set':
					$row[MARK_ITEM_STATUS] = '1';
					$row[MARK_ITEM_TIME] = date('Y-m-d H:i');
					$row[MARK_ITEM_README] = $_POST['mark_readme'];
					break;
				
				default:
					$row[MARK_ITEM_STATUS] = '0';
					$row[MARK_ITEM_TIME] = '';
					$row[MARK_ITEM_README] = '';
					break;
						
			}
		}
		++$i;
	}
	if (DUMP_TEXT_TABLE($FILE_DB, $ROWS)) {
		GOTO($THIS_PHP_FILE.'&mark_id='.$mark_id.'&op=view');
	} else {
		SHOW_ERROR(ERROR_DUMP_FILE);
	}		
} else {
	SHOW_ERROR(ERROR_LOAD_FILE);
}

?>