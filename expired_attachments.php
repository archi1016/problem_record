<?php

if (empty($THIS_STAFF_RINGS[RING_EXPIRED_ATTACHMENTS])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['expired_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_FILES['attachments'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_FILES['attachments']['error'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['expired_id'] = stripslashes($_GET['expired_id']);
}

$expired_id = RETURN_ID_FROM($_GET['expired_id']);

CHECK_ID_EXIST($expired_id, $ROWS, $ri);

INSERT_ATTACHMENTS(EXPIRED_FILE_ID, $expired_id);
GOTO($THIS_PHP_FILE.'&op=view&expired_id='.$expired_id);

?>