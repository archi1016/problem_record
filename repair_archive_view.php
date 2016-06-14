<?php

function RETURN_ATTACHMENTS($repair_id) {
	global $THIS_PHP_FILE;
	global $THIS_STAFF_RINGS;

	$rt = '';
	$link_url = $THIS_PHP_FILE.'&repair_id='.$repair_id.'&attachments_id=';
	GET_ATTACHMENTS_DB_FILES(REPAIR_FILE_ID, $repair_id, $FILE_DB, $FILE_ID);
	if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
		$rc = count($ROWS);
		$ri = 0;
		while ($ri < $rc) {
			$row = &$ROWS[$ri];
			if ($repair_id == $row[ATTACHMENTS_FOLLOW_UID]) {
				if (!empty($THIS_STAFF_RINGS[RING_REPAIR_ATTACHMENTS])) {
					$dop = ' (<a href="#" onclick="return CONFIRM_BEFORE_DELETE(this.parentNode.parentNode, \''.$link_url.$row[ATTACHMENTS_UID].'&op=archive_attachments_delete'.'\');">�R��</a>)';
				} else {
					$dop = '';
				}
				$rt .= '<table cellspacing="0" cellpadding="0" class="attachments"><tr>';
				$rt .= '<td class="icon">'.RETURN_MIME_ICON_FILE($row[ATTACHMENTS_EXTENSION]).'</td>';
				$rt .= '<td><a href="'.$link_url.$row[ATTACHMENTS_UID].'&op=archive_attachments_download" target="_blank">'.$row[ATTACHMENTS_NAME].'</a>'.$dop.'<div class="sub">'.RETURN_FRIENDLY_SIZE_STR($row[ATTACHMENTS_SIZE]).', '.RETURN_FRIENDLY_TIME_STR($row[ATTACHMENTS_TIME]).'</div></td>';
				$rt .= '</tr></table>';
			}
			++$ri;
		}
	}
	return $rt;
}

if (empty($_GET['repair_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['repair_id'] = stripslashes($_GET['repair_id']);
}

$FILE_DB = RETURN_DB_FILE_PATH(REPAIR_ARCHIVE_FILE_ID);
$THIS_PHP_FILE .= '&archive';

$repair_id = RETURN_ID_FROM($_GET['repair_id']);
CHECK_ID_EXIST($repair_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('�e�װO�� #'.$repair_id.': '.$row[REPAIR_ARCHIVE_NAME]);
MENU_BAR();

VIEW_HEADER('�e�װO�� #'.$repair_id);
	VIEW_ROW('�W��', $row[REPAIR_ARCHIVE_NAME]);
	VIEW_ROW('�Ȥ�', RETURN_CLIENT_NAME_BY_CLIENT_ID($row[REPAIR_ARCHIVE_CLIENT_ID], TRUE));
	VIEW_ROW('��]', $row[REPAIR_ARCHIVE_REASON]);
	VIEW_ROWS('�ѧO���', $row[REPAIR_ARCHIVE_SERIAL_IDS]);
	VIEW_ROW('�e�פH', RETURN_STAFF_NAME_BY_STAFF_ID($row[REPAIR_ARCHIVE_STAFF_ID], TRUE));
	VIEW_ROW('�e�׼t��', RETURN_SUPPLIER_NAME_BY_SUPPLIER_ID($row[REPAIR_ARCHIVE_SUPPLIER_ID], TRUE));
	VIEW_ROW('�e�׮ɶ�', $row[REPAIR_ARCHIVE_TIME].'<span class="more">('.RETURN_FRIENDLY_TIME_STR($row[REPAIR_ARCHIVE_TIME]).')</span>');
	VIEW_ROW('���^�ɶ�', $row[REPAIR_ARCHIVE_TIME_RETURN].'<span class="more">('.RETURN_FRIENDLY_TIME_STR($row[REPAIR_ARCHIVE_TIME_RETURN]).')</span>');
	VIEW_ROW('�e�׵��G', '<b>'.$row[REPAIR_ARCHIVE_REPORT].'</b>');
	VIEW_ROW('���׶O��', '<span class="cost">'.$row[REPAIR_ARCHIVE_COST].'</span>');
	VIEW_ROWS('����', RETURN_ATTACHMENTS_LIST($THIS_STAFF_RINGS[RING_REPAIR_ATTACHMENTS], REPAIR_FILE_ID, 'repair_id', $repair_id));
VIEW_FOOTER();

if (!empty($THIS_STAFF_RINGS[RING_REPAIR_ATTACHMENTS])) {
	FORM_ATTACHMENTS($THIS_PHP_FILE.'&op=attachments&repair_id='.$repair_id);
}

HTML_OUTPUT();

?>