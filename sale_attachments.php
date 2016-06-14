<?php

if (empty($THIS_STAFF_RINGS[RING_SALE_ATTACHMENTS])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['sale_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_FILES['attachments'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_FILES['attachments']['error'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['sale_id'] = stripslashes($_GET['sale_id']);
}

$sale_id = RETURN_ID_FROM($_GET['sale_id']);

CHECK_ID_EXIST($sale_id, $ROWS, $ri);

INSERT_ATTACHMENTS(SALE_FILE_ID, $sale_id);
GOTO($THIS_PHP_FILE.'&op=view&sale_id='.$sale_id);

?>