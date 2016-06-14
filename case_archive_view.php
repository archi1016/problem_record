<?php

if (empty($_GET['case_id'])) SHOW_ERROR(ERROR_ARGUMENTS);

if (get_magic_quotes_gpc()) {
	$_GET['case_id'] = stripslashes($_GET['case_id']);
}

$FILE_DB = RETURN_DB_FILE_PATH(ARCHIVE_FILE_ID);

$case_id = RETURN_ID_FROM($_GET['case_id']);
CHECK_ID_EXIST($case_id, $ROWS, $ri);
$row = &$ROWS[$ri];

HTML_HEADER('歸檔案例 #'.$case_id.': '.$row[ARCHIVE_TITLE]);
MENU_BAR();

HTML_ADD('<table cellspacing="0" cellpadding="0">');
HTML_ADD('<tr><th colspan="2" class="title">'.$row[CASE_TITLE].'</th>');

$info = '<div class="id">#'.$case_id.'</div><dl>';
$info .= '<dt>客戶</dt><dd>'.RETURN_CLIENT_NAME_BY_CLIENT_ID($row[ARCHIVE_CLIENT_ID], TRUE).'</dd>';
$info .= '<dt>開案</dt><dd>'.RETURN_STAFF_NAME_BY_STAFF_ID($row[ARCHIVE_OPENED_STAFF_ID], TRUE).'<br />'.$row[ARCHIVE_OPENED_TIME].'</dd>';
$info .= '<dt>接手</dt><dd>'.RETURN_STAFF_NAME_BY_STAFF_ID($row[ARCHIVE_STAFF_ID], TRUE).'<br />'.$row[ARCHIVE_TAKING_TIME].'</dd>';
$info .= '<dt>結案</dt><dd>'.$row[ARCHIVE_CLOSED_TIME].'</dd>';
$info .= '</dl>';

$content = '<div class="content">'.$row[ARCHIVE_CONTENT].'</div>';
GET_REPLY_FILES($row[ARCHIVE_FOLDER], $FILE_DB, $FILE_ID);
if (LOAD_TEXT_TABLE($FILE_DB, $ROWS)) {
	LOAD_REPLAY_ATTACHMENTS($row[ARCHIVE_FOLDER]);
	$rc = count($ROWS);
	$ri = 0;
	while ($ri < $rc) {
			$row = &$ROWS[$ri];
			switch ($row[CASE_REPLY_TYPE]) {
				case CASE_REPLY_TYPE_SYSTEM:
					$content .= '<div class="reply">['.$row[CASE_REPLY_UID].'] 於 '.$row[CASE_REPLY_TIME].' 由 '.RETURN_STAFF_NAME_BY_STAFF_ID($row[CASE_REPLY_STAFF_ID], TRUE).' '.$row[CASE_REPLY_CONTENT].'</div>';
					break;

				default:
					$link_url = $THIS_PHP_FILE.'&case_id='.$case_id.'&reply_id='.$row[CASE_REPLY_UID].'&op=';
					$content .= '<div class="reply">['.$row[CASE_REPLY_UID].'] 於 '.$row[CASE_REPLY_TIME].' 由 '.RETURN_STAFF_NAME_BY_STAFF_ID($row[CASE_REPLY_STAFF_ID], TRUE).' 回覆';
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
$content .= '\n\n';


HTML_ADD('<tr valign="top"><td class="info">'.$info.'</td><td>'.str_replace('\n', '<br />', $content).'</td></tr>');
HTML_ADD('</table>');

HTML_OUTPUT();

?>