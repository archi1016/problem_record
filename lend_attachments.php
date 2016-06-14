<?php

if (empty($THIS_STAFF_RINGS[RING_LEND_ATTACHMENTS])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['lend_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_FILES['attachments'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_FILES['attachments']['error'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['lend_id'] = stripslashes($_GET['lend_id']);
}

$lend_id = RETURN_ID_FROM($_GET['lend_id']);

CHECK_ID_EXIST($lend_id, $ROWS, $ri);

INSERT_ATTACHMENTS(LEND_FILE_ID, $lend_id);
if (isset($_GET['standby_id'])) {
	GOTO($THIS_PHP_FILE.'&op=view&standby_id='.$_GET['standby_id']);
} else {
	GOTO($THIS_PHP_FILE.'&op=log_view&lend_id='.$lend_id);
}

?>