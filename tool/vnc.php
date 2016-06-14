<?php

require('../config.php');
require('../define.php');
require('../func.php');

HTML_HEADER(base64_decode($_GET['name']));

HTML_ADD('<div id="settingspanel"><form action="#" onsubmit="return ConnectVNC(this);"><table cellspacing="0" cellpadding="0" class="settings">');
HTML_ADD('<tr><td class="item">IP:</td><td><input type="text" name="ip" size="28" value="'.$_GET['ip'].':5800"></td></tr>');
/*
HTML_ADD('<tr><td class="item">大小:</td><td><select name="resolution" size="1"><option value="1">800 x 600</option><option value="2">1027 x 768</option></select></td></tr>');
HTML_ADD('<tr><td class="item">色深:</td><td><select name="color" size="1"><option value="8">8bit</option><option value="16">16bit</option></select></td></tr>');
*/
HTML_ADD('<tr><td class="item">&nbsp;</td><td><input type="submit" value="連線"></td></tr>');
HTML_ADD('</table></form></div>');

HTML_OUTPUT();

?>