<?php

if (empty($_GET['staff_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['staff_id'] = stripslashes($_GET['staff_id']);
}

$staff_id = RETURN_ID_FROM($_GET['staff_id']);
CHECK_ID_EXIST($staff_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('員工 #'.$staff_id.': '.$row[STAFF_NAME]);
MENU_BAR();

VIEW_HEADER('員工 #'.$staff_id);
	VIEW_ROW('姓名', $row[STAFF_NAME]);
	if (empty($row[STAFF_STATUS])) {
		VIEW_ROW('狀態', '已離職');
	}
	VIEW_ROW('族群', RETURN_GROUP_NAME_BY_GROUP_ID($row[STAFF_GROUP_ID]));
	VIEW_ROW('登入帳號', $row[STAFF_ACCOUNT]);
	VIEW_ROW('連絡電話', RETURN_TELEPHONE($row[STAFF_TELEPHONE]));
VIEW_FOOTER();

HTML_OUTPUT();

?>