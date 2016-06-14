<?php

require('mime.php');

if (empty($_GET['case_id'])) SHOW_ERROR(ERROR_ARGUMENTS);
if (get_magic_quotes_gpc()) {
	$_GET['case_id'] = stripslashes($_GET['case_id']);
}

$case_id = RETURN_ID_FROM($_GET['case_id']);

CHECK_ID_EXIST($case_id, $ROWS, $ri);

$row = &$ROWS[$ri];


$nt = strtotime(date('Y-m-d H:i'));
$IS_PREDESTINATE = ($nt < strtotime($row[CASE_PREDESTINATE_TIME]));
$IS_PROCESSING = ($row[CASE_STAFF_ID] > 0);



HTML_HEADER('�ר� #'.$row[CASE_UID].': '.$row[CASE_TITLE]);
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
HTML_ADD('<tr><th colspan="2" class="title">'.$row[CASE_TITLE].'</th>');

$info = '<div class="id"><a href="'.$THIS_PHP_FILE.'&case_id='.$row[CASE_UID].'&op=thread">#'.$row[CASE_UID].'</a></div><dl>';
$info .= '<dt>�Ȥ�</dt><dd>'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[CASE_CLIENT_ID], TRUE).'</dd>';
if ($IS_PREDESTINATE) {
	$info .= '<dt>�w�w</dt><dd>'.$row[CASE_PREDESTINATE_TIME].'</dd>';
} else {
	$info .= '<dt>�}��</dt><dd>'.RETURN_STAFF_NAME_BY_STAFF_ID($row[CASE_OPENED_STAFF_ID], TRUE).'<br />'.RETURN_FRIENDLY_TIME_STR($row[CASE_OPENED_TIME]).'</dd>';
	if (!empty($row[CASE_STAFF_ID])) {
		$info .= '<dt>����</dt><dd>'.RETURN_STAFF_NAME_BY_STAFF_ID($row[CASE_STAFF_ID], TRUE).'<br />'.RETURN_FRIENDLY_TIME_STR($row[CASE_TAKING_TIME]).'</dd>';
	}
}
if ($IS_PROCESSING) {
	if ($row[CASE_STAFF_ID] == $_SESSION['UID']) {
		$info .= '<dt>��L</dt><dd><a href="#" onclick="return CONFIRM_CLOSE_CASE(this.parentNode.parentNode, \''.$THIS_PHP_FILE.'&op=close&case_id='.$case_id.'\');">�����k��</a></dd>';
	}
}
$info .= '</dl>';

$content = '<div class="content">'.$row[CASE_CONTENT].'</div>';
if (!$IS_PREDESTINATE) {
	GET_REPLY_FILES($row[CASE_ARCHIVE_FOLDER], $FILE_DB, $FILE_ID);
	if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
		LOAD_REPLAY_ATTACHMENTS($row[CASE_ARCHIVE_FOLDER]);
		$rc = count($ROWS);
		$ri = 0;
		while ($ri < $rc) {
			$row = &$ROWS[$ri];
			switch ($row[CASE_REPLY_TYPE]) {
				case CASE_REPLY_TYPE_SYSTEM:
					$content .= '<div class="reply">['.$row[CASE_REPLY_UID].'] �� '.RETURN_FRIENDLY_TIME_STR($row[CASE_REPLY_TIME]).' �� '.RETURN_STAFF_NAME_BY_STAFF_ID($row[CASE_REPLY_STAFF_ID], TRUE).' '.$row[CASE_REPLY_CONTENT].'</div>';
					break;

				default:
					$link_url = $THIS_PHP_FILE.'&case_id='.$case_id.'&reply_id='.$row[CASE_REPLY_UID].'&op=';
					$content .= '<div class="reply">['.$row[CASE_REPLY_UID].'] �� '.RETURN_FRIENDLY_TIME_STR($row[CASE_REPLY_TIME]).' �� '.RETURN_STAFF_NAME_BY_STAFF_ID($row[CASE_REPLY_STAFF_ID], TRUE).' �^��';
					if ($_SESSION['UID'] == $row[CASE_REPLY_STAFF_ID]) {
						$content .= ' [<a href="#" onclick="return CONFIRM_DELETE_CASE_REPLY(this.parentNode, \''.addslashes($link_url.'reply_delete').'\');">�R��</a>]';
					}
					$content .= '<p>'.$row[CASE_REPLY_CONTENT];
					if ($row[CASE_REPLY_ATTACHMENTS_IDS] != '') {
						$ids = explode(',', $row[CASE_REPLY_ATTACHMENTS_IDS]);
						$ac = count($ids);
						$ai = 0;
						while ($ai < $ac) {
							if (isset($REPLAY_ATTACHMENTS_INFORMATION[$ids[$ai]])) {
								$ar = &$REPLAY_ATTACHMENTS_INFORMATION[$ids[$ai]];
								$content .= '<table cellspacing="0" cellpadding="0" class="attachments"><tr>';
								$content .= '<td class="icon">'.RETURN_MIME_ICON_FILE($ar['extension']).'</td>';
								$content .= '<td><a href="'.$link_url.'reply_attachments_download&attachments_id='.$ids[$ai].'" target="_blank">'.$ar['name'].'</a><div class="sub">'.RETURN_FRIENDLY_SIZE_STR($ar['size']).'</div></td>';
								$content .= '</tr></table>';
							}
							++$ai;
						}
					}
					$content .= '</p></div>';
					break;
			}
			++$ri;
		}
	}
	$content .= '<div class="reply"><form action="'.$THIS_PHP_FILE.'&op=reply&case_id='.$case_id.'" method="post" enctype="multipart/form-data" onsubmit="return CHECK_REPLY_CASE(this);">';
	$content .= $_SESSION['NAME'].'�^�Х���:\n<textarea name="case_reply_content" cols="64" rows="12" class="w" onkeydown="CHECK_ESC_KEY();"></textarea>\n';
	$u = '<input type="file" name="case_reply_attachments[]" size="48" class="w" /><input type="hidden" name="case_reply_attachments_fn[]" value="" />\n';
	$content .= '����:\n'.$u.$u.$u;
	$content .= '<input type="checkbox" name="confirmed" /> �T�{\n\n<input type="submit" value="�^��" />\n\n</form></div>';
}

HTML_ADD('<tr valign="top"><td class="info">'.$info.'</td><td>'.str_replace('\n', '<br />', $content).'</td></tr>');
HTML_ADD('</table>');

HTML_OUTPUT();

?>