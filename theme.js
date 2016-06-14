var SelectedBackgroundColor = '#FFE0E0';

function CHECK_ESC_KEY() {
	if (event.keyCode == 27) event.returnValue=false;
}

function TO_FOCUS(o) {
	o.style.backgroundColor = SelectedBackgroundColor;
}

function TO_BLUR(o) {
	o.style.backgroundColor = '';
}

function CHECK_ATTACHMENTS(f) {
	var i;
	var s;

	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	for (i=0; i<f.length; i++) {
		if (f.elements[i].name == 'attachments[]') {
			s = f.elements[i].value;
			if (s != '') {
				s = s.split('\\');
				f.elements[i+1].value = s[s.length-1];
			}
		}
	}
	return true;
}



function CHECK_NEW_MARK(f) {
	if (f.mark_name.value == '') {
		alert('�п�J�W�١I');
		f.mark_name.focus();
		return false;
	}
	if (f.mark_items.value == '') {
		alert('�п�J���ءI');
		f.mark_items.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_MARK(f) {
	if (f.mark_name.value == '') {
		alert('�п�J�W�١I');
		f.mark_name.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}


function CHECK_NEW_FILE(f) {
	if (f.file_name.value == '') {
		alert('�п�J�W�١I');
		f.file_name.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_FILE(f) {
	if (f.file_name.value == '') {
		alert('�п�J�W�١I');
		f.file_name.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}



function CHECK_EDIT_REPAIR_ARCHIVE(f) {
	if (f.repair_report.value == '') {
		alert('�п�J�e�׵��G�I');
		f.repair_report.focus();
		return false;
	}
	if (f.repair_cost.value == '') {
		alert('�п�J�����O�ΡI');
		f.repair_cost.focus();
		return false;
	}
	if (isNaN(f.repair_cost.value)) {
		alert('���׶O�νп�J�Ʀr�I');
		f.repair_cost.focus();
		return false;
	}
	if (f.repair_cost.value.length > 4) {
		alert('���׶O�Ϊ��B�L���I');
		f.repair_cost.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_RETURN_REPAIR(f) {
	if (f.repair_report.value == '') {
		alert('�п�J�e�׵��G�I');
		f.repair_report.focus();
		return false;
	}
	if (f.repair_cost.value == '') {
		alert('�п�J�����O�ΡI');
		f.repair_cost.focus();
		return false;
	}
	if (isNaN(f.repair_cost.value)) {
		alert('���׶O�νп�J�Ʀr�I');
		f.repair_cost.focus();
		return false;
	}
	if (f.repair_cost.value.length > 4) {
		alert('���׶O�Ϊ��B�L���I');
		f.repair_cost.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_REPAIR(f) {
	if (f.repair_name.value == '') {
		alert('�п�J�W�١I');
		f.repair_name.focus();
		return false;
	}
	if (f.repair_reason.value == '') {
		alert('�п�J�ƥѡI');
		f.repair_reason.focus();
		return false;
	}
	if (f.repair_serial_ids.value == '') {
		alert('�п�J�ѧO��ơI');
		f.repair_serial_ids.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_NEW_REPAIR(f) {
	if (f.repair_name.value == '') {
		alert('�п�J�W�١I');
		f.repair_name.focus();
		return false;
	}
	if (f.repair_reason.value == '') {
		alert('�п�J�ƥѡI');
		f.repair_reason.focus();
		return false;
	}
	if (f.repair_serial_ids.value == '') {
		alert('�п�J�ѧO��ơI');
		f.repair_serial_ids.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}


function CHECK_NEW_OUT(f) {
	if (f.out_reason.value == '') {
		alert('�п�J�ƥѡI');
		f.out_reason.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_OUT(f) {
	if (f.out_reason.value == '') {
		alert('�п�J�ƥѡI');
		f.out_reason.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}


function CONFIRM_RETURN_LEND(tr, url) {
	tr.bgColor = SelectedBackgroundColor;
	if (confirm('�k�٦��ƫ~�ܡH')) {
		window.location = url;
	} else {
		tr.bgColor = '';
		return false;
	}
}

function CHECK_SAVE_LEND(f) {
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_NEW_SALE(f) {
	if (f.sale_title.value == '') {
		alert('�п�J²�z�I');
		f.sale_title.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_SALE(f) {
	if (f.sale_title.value == '') {
		alert('�п�J²�z�I');
		f.sale_title.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_NEW_EXPIRED(f) {
	if (f.expired_name.value == '') {
		alert('�п�J���~�W�١I');
		f.expired_name.focus();
		return false;
	}
	if (f.expired_location.value == '') {
		alert('�п�J�\���m�I');
		f.expired_location.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_EXPIRED(f) {
	if (f.expired_name.value == '') {
		alert('�п�J���~�W�١I');
		f.expired_name.focus();
		return false;
	}
	if (f.expired_location.value == '') {
		alert('�п�J�\���m�I');
		f.expired_location.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}


function CHECK_NEW_STANDBY(f) {
	if (f.standby_name.value == '') {
		alert('�п�J�W�١I');
		f.standby_name.focus();
		return false;
	}
	if (f.standby_location.value == '') {
		alert('�п�J�s���m�I');
		f.standby_location.focus();
		return false;
	}
	if (f.standby_serial_ids.value == '') {
		alert('�п�J�ѧO��ơI');
		f.standby_serial_ids.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_STANDBY(f) {
	if (f.standby_name.value == '') {
		alert('�п�J�W�١I');
		f.standby_name.focus();
		return false;
	}
	if (f.standby_location.value == '') {
		alert('�п�J�s���m�I');
		f.standby_location.focus();
		return false;
	}
	if (f.standby_serial_ids.value == '') {
		alert('�п�J�ѧO��ơI');
		f.standby_serial_ids.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_NEW_SUPPLIER(f) {
	if (f.supplier_name.value == '') {
		alert('�п�J�W�١I');
		f.supplier_name.focus();
		return false;
	}
	if (f.supplier_telephone.value == '') {
		alert('�п�J�s���q�ܡI');
		f.supplier_telephone.focus();
		return false;
	}
	if (f.supplier_address.value == '') {
		alert('�п�J��~�a�}�I');
		f.supplier_address.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_SUPPLIER(f) {
	if (f.supplier_name.value == '') {
		alert('�п�J�W�١I');
		f.supplier_name.focus();
		return false;
	}
	if (f.supplier_telephone.value == '') {
		alert('�п�J�s���q�ܡI');
		f.supplier_telephone.focus();
		return false;
	}
	if (f.supplier_address.value == '') {
		alert('�п�J��~�a�}�I');
		f.supplier_address.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_NEW_CLIENT(f) {
	if (f.client_name.value == '') {
		alert('�п�J�W�١I');
		f.client_name.focus();
		return false;
	}
	if (f.client_telephone.value == '') {
		alert('�п�J�s���q�ܡI');
		f.client_telephone.focus();
		return false;
	}
	if (f.client_address.value == '') {
		alert('�п�J��~�a�}�I');
		f.client_address.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_CLIENT(f) {
	if (f.client_name.value == '') {
		alert('�п�J�W�١I');
		f.client_name.focus();
		return false;
	}
	if (f.client_telephone.value == '') {
		alert('�п�J�s���q�ܡI');
		f.client_telephone.focus();
		return false;
	}
	if (f.client_address.value == '') {
		alert('�п�J��~�a�}�I');
		f.client_address.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_REPLY_CASE(f) {
	var i;
	var s;

	if (f.case_reply_content.value == '') {
		alert('�п�J�^�Ф��e�I');
		f.case_reply_content.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	for (i=0; i<f.length; i++) {
		if (f.elements[i].name == 'case_reply_attachments[]') {
			s = f.elements[i].value;
			if (s != '') {
				s = s.split('\\');
				f.elements[i+1].value = s[s.length-1];
			}
		}
	}
	return true;
}

function CHECK_NEW_CASE(f) {
	if (f.case_title.value == '') {
		alert('�п�J���D�I');
		f.case_title.focus();
		return false;
	}
	if (f.case_content.value == '') {
		alert('�п�J�ԲӡI');
		f.case_content.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_CASE(f) {
	if (f.case_title.value == '') {
		alert('�п�J���D�I');
		f.case_title.focus();
		return false;
	}
	if (f.case_content.value == '') {
		alert('�п�J�ԲӡI');
		f.case_content.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}


function CHECK_NEW_CATEGORY(f) {
	if (f.category_name.value == '') {
		alert('�п�J�W�١I');
		f.category_name.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_CATEGORY(f) {
	if (f.category_name.value == '') {
		alert('�п�J�W�١I');
		f.category_name.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_STAFF(f) {
	if (f.staff_acc.value == '') {
		alert('�п�J�n�J�b���I');
		f.staff_acc.focus();
		return false;
	}
	if (f.staff_name.value == '') {
		alert('�п�J�m�W�I');
		f.staff_name.focus();
		return false;
	}
	if (f.staff_telephone.value == '') {
		alert('�п�J�s���q�ܡI');
		f.staff_telephone.focus();
		return false;
	}
	if (f.staff_pwd.value != '') {
		if (f.staff_pwd.value != f.staff_pwd2.value) {
			alert('�s���K�X��J���~�I');
			f.staff_pwd.value='';
			f.staff_pwd2.value='';
			f.staff_pwd.focus();
			return false;
		}
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_NEW_STAFF(f) {
	if (f.staff_acc.value == '') {
		alert('�п�J�n�J�b���I');
		f.staff_acc.focus();
		return false;
	}
	if (f.staff_pwd.value == '') {
		alert('�п�J�n�J�K�X�I');
		f.staff_pwd.focus();
		return false;
	}
	if (f.staff_pwd2.value == '') {
		alert('�п�J�T�{�K�X�I');
		f.staff_pwd2.focus();
		return false;
	}
	if (f.staff_pwd.value != f.staff_pwd2.value) {
		alert('�n�J�K�X��J���~�I');
		f.staff_pwd.value='';
		f.staff_pwd2.value='';
		f.staff_pwd.focus();
		return false;
	}
	if (f.staff_name.value == '') {
		alert('�п�J�m�W�I');
		f.staff_name.focus();
		return false;
	}
	if (f.staff_telephone.value == '') {
		alert('�п�J�s���q�ܡI');
		f.staff_telephone.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_NEW_GROUP(f) {
	if (f.group_name.value == '') {
		alert('�п�J�ڸs�W�١I');
		f.group_name.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_SAVE_GROUP(f) {
	if (f.group_name.value == '') {
		alert('�п�J�ڸs�W�١I');
		f.group_name.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CHECK_LOGON(f) {
	if (f.acc.value == '') {
		alert('�п�J�b���I');
		f.acc.focus();
		return false;
	}
	if (f.pwd.value == '') {
		alert('�п�J�K�X�I');
		f.pwd.focus();
		return false;
	}
	if (!f.confirmed.checked) {
		f.confirmed.focus();
		return false;
	}
	return true;
}

function CONFIRM_BEFORE_DELETE(tr, url) {
	tr.bgColor = SelectedBackgroundColor;
	if (confirm('�T�w�n�R���ܡH')) {
		window.location = url;
	} else {
		tr.bgColor = '';
		return false;
	}
}

function CONFIRM_SET_DEFAULT(tr, url) {
	tr.bgColor = SelectedBackgroundColor;
	if (confirm('�]���w�]�ȶܡH')) {
		window.location = url;
	} else {
		tr.bgColor = '';
		return false;
	}
}

function CONFIRM_TAKE_CASE(tr, url) {
	tr.bgColor = SelectedBackgroundColor;
	if (confirm('���⦹�׶ܡH')) {
		window.location = url;
	} else {
		tr.bgColor = '';
		return false;
	}
}

function CONFIRM_RETURN_CASE(tr, url) {
	tr.bgColor = SelectedBackgroundColor;
	if (confirm('�h�^���׶ܡH')) {
		window.location = url;
	} else {
		tr.bgColor = '';
		return false;
	}
}

function CONFIRM_CLOSE_CASE(tr, url) {
	if (confirm('�T�w�n�������׶ܡH')) {
		window.location = url;
	} else {
		tr.bgColor = '';
		return false;
	}
}

function CONFIRM_DELETE_CASE_REPLY(div, url) {
	var clr = div.style.backgroundColor;
	div.style.backgroundColor = SelectedBackgroundColor;
	if (confirm('�T�w�n�R�����^��(�]�t����)�ܡH')) {
		window.location = url;
	} else {
		div.style.backgroundColor = clr;
		return false;
	}
}

function CHECK_SELECT_BAR_FROM_CHECKBOX(cb, tr) {
	if (cb.checked) {
		tr.style.backgroundColor = SelectedBackgroundColor;
	} else {
		tr.style.backgroundColor = '';
	}
	event.cancelBubble = true;
}

function CHECK_SELECT_BAR_FROM_TD(cb, tr) {
	if (cb.checked) {
		cb.checked = false;
		tr.style.backgroundColor = '';
	} else {
		cb.checked = true;
		tr.style.backgroundColor = SelectedBackgroundColor;
	}
}

function CHECK_SELECT_BLOCK_FROM_CHECKBOX(cb, span) {
	if (cb.checked) {
		span.className = 'checked';
	} else {
		span.className = 'unchecked';
	}
	event.cancelBubble = true;
}

function CHECK_SELECT_BLOCK_FROM_SPAN(cb, span) {
	if (cb.checked) {
		cb.checked = false;
		span.className = 'unchecked';
	} else {
		cb.checked = true;
		span.className = 'checked';
	}
}