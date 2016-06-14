<?php

if (empty($THIS_STAFF_RINGS[RING_SUPPLIER_ATTACHMENTS])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_GET['supplier_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (empty($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!isset($_FILES['attachments'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_POST['attachments_fn'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (!is_array($_FILES['attachments']['error'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['supplier_id'] = stripslashes($_GET['supplier_id']);
}

$supplier_id = RETURN_ID_FROM($_GET['supplier_id']);

CHECK_ID_EXIST($supplier_id, $ROWS, $ri);

INSERT_ATTACHMENTS(SUPPLIER_FILE_ID, $supplier_id);
GOTO($THIS_PHP_FILE.'&op=view&supplier_id='.$supplier_id);

?>