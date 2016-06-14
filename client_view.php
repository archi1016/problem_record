<?php

require('func_ext.php');

if (empty($_GET['client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['client_id'] = stripslashes($_GET['client_id']);
}

$client_id = RETURN_ID_FROM($_GET['client_id']);
CHECK_ID_EXIST($client_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('客戶 #'.$client_id.': '.$row[CLIENT_NAME]);
MENU_BAR();

VIEW_HEADER('客戶 #'.$client_id);
	VIEW_ROW('名稱', $row[CLIENT_NAME]);
	if (CLIENT_COOPERATION_NORMAL == $row[CLIENT_COOPERATION]) {
		VIEW_ROW('回報IP', EXT_QUERY_REPORT_IP($row[CLIENT_NAME]));
	} else {
		VIEW_ROW('狀態', RETURN_CLIENT_COOPERATION($row[CLIENT_COOPERATION]));
	}
	VIEW_ROW('連絡電話', RETURN_TELEPHONE($row[CLIENT_TELEPHONE]));
	VIEW_ROW('營業地址', RETURN_ADDRESS($row[CLIENT_ADDRESS]));
	VIEW_ROW('標籤', $row[CLIENT_TAG]);
	VIEW_ROWS('屬性', $row[CLIENT_PROPERTY]);
	VIEW_ROWS('附件', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_CLIENT_ATTACHMENTS], CLIENT_FILE_ID, 'client_id', $client_id));
VIEW_FOOTER();

if (!empty($THIS_STAFF_RINGS[RING_CLIENT_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&client_id='.$client_id);
}

HTML_OUTPUT();

?>