<?php

if (empty($_GET['client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['attachments_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['client_id'] = stripslashes($_GET['client_id']);
	$_GET['attachments_id'] = stripslashes($_GET['attachments_id']);
}

$client_id = RETURN_ID_FROM($_GET['client_id']);
CHECK_ID_EXIST($client_id, $ROWS, $ri);
SEND_ATTACHMENTS(CLIENT_FILE_ID, $client_id, $_GET['attachments_id']);

?>