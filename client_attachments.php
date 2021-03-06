<?php

if (empty($THIS_STAFF_RINGS[RING_CLIENT_ATTACHMENTS])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['client_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_FILES['attachments'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_FILES['attachments']['error'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['client_id'] = stripslashes($_GET['client_id']);
}

$client_id = RETURN_ID_FROM($_GET['client_id']);

CHECK_ID_EXIST($client_id, $ROWS, $ri);

INSERT_ATTACHMENTS(CLIENT_FILE_ID, $client_id);
GOTO($THIS_PHP_FILE.'&op=view&client_id='.$client_id);

?>