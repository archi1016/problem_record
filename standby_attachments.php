<?php

if (empty($THIS_STAFF_RINGS[RING_STANDBY_ATTACHMENTS])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['standby_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_FILES['attachments'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_FILES['attachments']['error'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['standby_id'] = stripslashes($_GET['standby_id']);
}

$standby_id = RETURN_ID_FROM($_GET['standby_id']);

CHECK_ID_EXIST($standby_id, $ROWS, $ri);

INSERT_ATTACHMENTS(STANDBY_FILE_ID, $standby_id);
GOTO($THIS_PHP_FILE.'&op=view&standby_id='.$standby_id);

?>