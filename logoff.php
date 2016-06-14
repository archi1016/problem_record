<?php

require('config.php');
require('define.php');
require('func.php');

CHECK_LOGON();

session_unset();
session_destroy();
GOTO('index.php');

?>