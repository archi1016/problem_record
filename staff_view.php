<?php

if (empty($_GET['staff_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['staff_id'] = stripslashes($_GET['staff_id']);
}

$staff_id = RETURN_ID_FROM($_GET['staff_id']);
CHECK_ID_EXIST($staff_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('���u #'.$staff_id.': '.$row[STAFF_NAME]);
MENU_BAR();

VIEW_HEADER('���u #'.$staff_id);
	VIEW_ROW('�m�W', $row[STAFF_NAME]);
	if (empty($row[STAFF_STATUS])) {
		VIEW_ROW('���A', '�w��¾');
	}
	VIEW_ROW('�ڸs', RETURN_GROUP_NAME_BY_GROUP_ID($row[STAFF_GROUP_ID]));
	VIEW_ROW('�n�J�b��', $row[STAFF_ACCOUNT]);
	VIEW_ROW('�s���q��', RETURN_TELEPHONE($row[STAFF_TELEPHONE]));
VIEW_FOOTER();

HTML_OUTPUT();

?>