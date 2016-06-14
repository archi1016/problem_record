<?php

if (empty($THIS_STAFF_RINGS[RING_OUT_ATTACHMENTS])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['out_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_FILES['attachments'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_FILES['attachments']['error'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['out_id'] = stripslashes($_GET['out_id']);
}

$out_id = RETURN_ID_FROM($_GET['out_id']);

CHECK_ID_EXIST($out_id, $ROWS, $ri);

INSERT_ATTACHMENTS(OUT_FILE_ID, $out_id);
GOTO($THIS_PHP_FILE.'&op=view&out_id='.$out_id);

?>