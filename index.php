<?php

require('config.php');
require('define.php');
require('func.php');


if (isset($_GET['sid'])) {
	session_id($_GET['sid']);
	session_start();
	if (isset($_SESSION['ACCOUNT'])) {
		if (!empty($_SESSION['ACCOUNT'])) {
			GOTO('case.php?sid='.session_id());
		}
	}
	session_unset();
	session_destroy();
}

if (!empty($_POST['acc'])) {
if (!empty($_POST['pwd'])) {
	if (get_magic_quotes_gpc()) {
		$_POST['acc'] = stripslashes($_POST['acc']);
		$_POST['pwd'] = stripslashes($_POST['pwd']);
	}

	if (LOAD_TEXT_TABLE(RETURN_DB_FILE_PATH(GROUP_FILE_ID), $GROUP_ROWS)) {
	if (LOAD_TEXT_TABLE(RETURN_DB_FILE_PATH(STAFF_FILE_ID), $STAFF_ROWS)) {
		$pwd = md5('EF_'.$_POST['pwd']);
		$sc = count($STAFF_ROWS);
		$si = 0;
		while ($si < $sc) {
			if (!empty($STAFF_ROWS[$si][STAFF_STATUS])) {
				if ($_POST['acc'] == $STAFF_ROWS[$si][STAFF_ACCOUNT]) {
				if ($pwd == $STAFF_ROWS[$si][STAFF_PASSWORD]) {
					$gc = count($GROUP_ROWS);
					$gi = 0;
					while ($gi < $gc) {
						if ($STAFF_ROWS[$si][STAFF_GROUP_ID] == $GROUP_ROWS[$gi][GROUP_UID]) {
							session_start();
							$_SESSION['UID'] = $STAFF_ROWS[$si][STAFF_UID];
							$_SESSION['ACCOUNT'] = $STAFF_ROWS[$si][STAFF_ACCOUNT];
							$_SESSION['NAME'] = $STAFF_ROWS[$si][STAFF_NAME];
							$_SESSION['GROUP'] = $GROUP_ROWS[$gi][GROUP_NAME];
							$_SESSION['RING'] = $GROUP_ROWS[$gi][GROUP_RING];
							$_SESSION['TIME'] = strtotime('now');
							GOTO('case.php?sid='.session_id());
						}
						++$gi;
					}
					break;
				}
				}
			}
			++$si;
		}
		GOTO($THIS_PHP_FILE.'?error='.ERROR_UNKNOWN_STAFF);
	}
	}
}
}


HTML_HEADER('PR登入');

HTML_ADD('<div class="menu"><h1>'.COMPANY_NAME.'</h1><table cellspacing="0" cellpadding="0"><tr><td width="12">&nbsp;</td><td class="current">登入</td><td>&nbsp;</td></tr></table></div>');

FORM_HEADER($THIS_PHP_FILE, 'CHECK_LOGON');
	FORM_INPUT_TEXT('帳號', 'acc', 32, '');
	FORM_INPUT_PASSWORD('密碼', 'pwd', 32, '');
FORM_FOOTER(TRUE, '登入');

HTML_OUTPUT();


?>