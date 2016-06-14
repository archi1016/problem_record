function OnControlLoadError() {
	alert('±±¥ó¸ü¤J¥¢±Ñ¡I');
}

function OnControlLoad() {
	var c = document.getElementById('MSTSC');
	if (c) {
		if (c.readyState == 4) {
			document.getElementById('connectbutton').disabled = false;
		}
	}
}

function ConnectRemoteDesktop(f) {
	var c = document.getElementById('MSTSC');

	c.server = f.ip.value;
	c.FullScreen = false;
	switch (f.resolution.value) {
		case '2':
			c.width = 1024;
			c.height = 768;
			c.DesktopWidth = 1024;
			c.DesktopHeight = 768;
			break;
		default:
			c.width = 800;
			c.height = 600;
			c.DesktopWidth = 800;
			c.DesktopHeight = 600;
			break;
	}
	c.ColorDepth = f.color.value;
	c.AdvancedSettings2.RedirectDrives = false;
	c.AdvancedSettings2.RedirectPrinters = false;
	c.AdvancedSettings2.RedirectPorts = false;
	c.AdvancedSettings2.RedirectSmartCards = false;

	document.getElementById('settingspanel').style.display = 'none';
	document.getElementById('controlpanel').style.display = 'block';

	c.Connect();

	return false;
}

function ConnectVNC(f) {
	location.href = 'http://'+f.ip.value+'/';
	return false;
}