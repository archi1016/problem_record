<?php

require('../config.php');
require('../define.php');
require('../func.php');

HTML_HEADER(base64_decode($_GET['name']));

HTML_ADD('<div id="settingspanel"><form action="#" onsubmit="return ConnectRemoteDesktop(this);"><table cellspacing="0" cellpadding="0" class="settings">');
HTML_ADD('<tr><td class="item">IP:</td><td><input type="text" name="ip" size="20" value="'.$_GET['ip'].'"></td></tr>');
HTML_ADD('<tr><td class="item">大小:</td><td><select name="resolution" size="1"><option value="1">800 x 600</option><option value="2">1027 x 768</option></select></td></tr>');
HTML_ADD('<tr><td class="item">色深:</td><td><select name="color" size="1"><option value="8">8bit</option><option value="16">16bit</option></select></td></tr>');
HTML_ADD('<tr><td class="item">&nbsp;</td><td><input id="connectbutton" type="submit" value="連線" disabled="disabled"></td></tr>');
HTML_ADD('</table></form></div>');

HTML_ADD('<div id="controlpanel" style="display:none;"><object language="javascript" id="MSTSC" onerror="OnControlLoadError();" onreadystatechange="OnControlLoad();" classid="CLSID:9059f30f-4eb1-4bd2-9fdc-36f43a218f4a" codebase="msrdp.cab#version=5,1,2600,2180" width="1024" height="768"></object></div>');

HTML_OUTPUT();

?>