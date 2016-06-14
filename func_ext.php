<?php

/*

Public Const QUERY_REPORT_IP_HEADER = &H10148981
Public Const REPORT_IP_HEADER = &H37894562
Public Const ERROR_HEADER = &HFFFFFFFF

Public Type QUERY_REPORT_IP
    Header As Long
    UserID(15) As Byte
End Type

Public Type REPORT_IP_INFO
    Header As Long
    IpLen As Long
    IpStr(47) As Byte
End Type

*/

define('RIP_QUERY_SERVER_ADDR',		'192.168.0.50');
define('RIP_QUERY_SERVER_PORT',		3389);

define('QUERY_REPORT_IP_HEADER',	0x10148981);
define('REPORT_IP_HEADER',		0x37894562);
define('ERROR_HEADER',			0xFFFFFFFF);

function EXT_QUERY_REPORT_IP($N) {
	$rt = '&nbsp;';
	$sk = GET_UDP_SOCKET();
	if ($sk) {
		$SD = pack('V', QUERY_REPORT_IP_HEADER).md5($N, TRUE);
		socket_sendto($sk, $SD, strlen($SD), 0, RIP_QUERY_SERVER_ADDR, RIP_QUERY_SERVER_PORT);
		if (@socket_recvfrom($sk, $recvbuf, 1024, 0, $ret_ip, $ret_port) > 0) {
			$RD = unpack('Vheader', $recvbuf);
			if (REPORT_IP_HEADER == $RD['header']) {
				$RD = unpack('Vheader/Viplen/v24ipstr', $recvbuf);
				$ip = '';
				$i = 1;
				while ($i <= 24) {
					if (empty($RD['ipstr'.$i])) break;
					$ip .= pack('c', $RD['ipstr'.$i]);
					++$i;
				}
				if ($ip != '') {
					$rt = '<table cellspacing="0" cellpadding="0" class="linked"><tr><td><div class="ip">'.$ip.'</div></td><td class="icon">';
					if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
						$rt .= '<a href="tool/msrdp.php?name='.urlencode(base64_encode($N)).'&ip='.$ip.'" title="Remote Desktop Connection" target="_blank"><img src="icon/misc/misc_mstsc.png"></a>';
					}
					$rt .= '<a href="tool/vnc.php?name='.urlencode(base64_encode($N)).'&ip='.$ip.'" title="VNC" target="_blank"><img src="icon/misc/misc_vnc.png"></a>';
					$rt .= '</td></tr></table>';
				}
			}
		}
		FREE_UDP_SOCKET($sk);
	}
	return $rt;
}

?>