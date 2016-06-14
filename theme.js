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
		alert('請輸入名稱！');
		f.mark_name.focus();
		return false;
	}
	if (f.mark_items.value == '') {
		alert('請輸入項目！');
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
		alert('請輸入名稱！');
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
		alert('請輸入名稱！');
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
		alert('請輸入名稱！');
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
		alert('請輸入送修結果！');
		f.repair_report.focus();
		return false;
	}
	if (f.repair_cost.value == '') {
		alert('請輸入收取費用！');
		f.repair_cost.focus();
		return false;
	}
	if (isNaN(f.repair_cost.value)) {
		alert('維修費用請輸入數字！');
		f.repair_cost.focus();
		return false;
	}
	if (f.repair_cost.value.length > 4) {
		alert('維修費用金額過高！');
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
		alert('請輸入送修結果！');
		f.repair_report.focus();
		return false;
	}
	if (f.repair_cost.value == '') {
		alert('請輸入收取費用！');
		f.repair_cost.focus();
		return false;
	}
	if (isNaN(f.repair_cost.value)) {
		alert('維修費用請輸入數字！');
		f.repair_cost.focus();
		return false;
	}
	if (f.repair_cost.value.length > 4) {
		alert('維修費用金額過高！');
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
		alert('請輸入名稱！');
		f.repair_name.focus();
		return false;
	}
	if (f.repair_reason.value == '') {
		alert('請輸入事由！');
		f.repair_reason.focus();
		return false;
	}
	if (f.repair_serial_ids.value == '') {
		alert('請輸入識別資料！');
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
		alert('請輸入名稱！');
		f.repair_name.focus();
		return false;
	}
	if (f.repair_reason.value == '') {
		alert('請輸入事由！');
		f.repair_reason.focus();
		return false;
	}
	if (f.repair_serial_ids.value == '') {
		alert('請輸入識別資料！');
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
		alert('請輸入事由！');
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
		alert('請輸入事由！');
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
	if (confirm('歸還此備品嗎？')) {
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
		alert('請輸入簡述！');
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
		alert('請輸入簡述！');
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
		alert('請輸入物品名稱！');
		f.expired_name.focus();
		return false;
	}
	if (f.expired_location.value == '') {
		alert('請輸入擺放位置！');
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
		alert('請輸入物品名稱！');
		f.expired_name.focus();
		return false;
	}
	if (f.expired_location.value == '') {
		alert('請輸入擺放位置！');
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
		alert('請輸入名稱！');
		f.standby_name.focus();
		return false;
	}
	if (f.standby_location.value == '') {
		alert('請輸入存放位置！');
		f.standby_location.focus();
		return false;
	}
	if (f.standby_serial_ids.value == '') {
		alert('請輸入識別資料！');
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
		alert('請輸入名稱！');
		f.standby_name.focus();
		return false;
	}
	if (f.standby_location.value == '') {
		alert('請輸入存放位置！');
		f.standby_location.focus();
		return false;
	}
	if (f.standby_serial_ids.value == '') {
		alert('請輸入識別資料！');
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
		alert('請輸入名稱！');
		f.supplier_name.focus();
		return false;
	}
	if (f.supplier_telephone.value == '') {
		alert('請輸入連絡電話！');
		f.supplier_telephone.focus();
		return false;
	}
	if (f.supplier_address.value == '') {
		alert('請輸入營業地址！');
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
		alert('請輸入名稱！');
		f.supplier_name.focus();
		return false;
	}
	if (f.supplier_telephone.value == '') {
		alert('請輸入連絡電話！');
		f.supplier_telephone.focus();
		return false;
	}
	if (f.supplier_address.value == '') {
		alert('請輸入營業地址！');
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
		alert('請輸入名稱！');
		f.client_name.focus();
		return false;
	}
	if (f.client_telephone.value == '') {
		alert('請輸入連絡電話！');
		f.client_telephone.focus();
		return false;
	}
	if (f.client_address.value == '') {
		alert('請輸入營業地址！');
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
		alert('請輸入名稱！');
		f.client_name.focus();
		return false;
	}
	if (f.client_telephone.value == '') {
		alert('請輸入連絡電話！');
		f.client_telephone.focus();
		return false;
	}
	if (f.client_address.value == '') {
		alert('請輸入營業地址！');
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
		alert('請輸入回覆內容！');
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
		alert('請輸入標題！');
		f.case_title.focus();
		return false;
	}
	if (f.case_content.value == '') {
		alert('請輸入詳細！');
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
		alert('請輸入標題！');
		f.case_title.focus();
		return false;
	}
	if (f.case_content.value == '') {
		alert('請輸入詳細！');
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
		alert('請輸入名稱！');
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
		alert('請輸入名稱！');
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
		alert('請輸入登入帳號！');
		f.staff_acc.focus();
		return false;
	}
	if (f.staff_name.value == '') {
		alert('請輸入姓名！');
		f.staff_name.focus();
		return false;
	}
	if (f.staff_telephone.value == '') {
		alert('請輸入連絡電話！');
		f.staff_telephone.focus();
		return false;
	}
	if (f.staff_pwd.value != '') {
		if (f.staff_pwd.value != f.staff_pwd2.value) {
			alert('新的密碼輸入錯誤！');
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
		alert('請輸入登入帳號！');
		f.staff_acc.focus();
		return false;
	}
	if (f.staff_pwd.value == '') {
		alert('請輸入登入密碼！');
		f.staff_pwd.focus();
		return false;
	}
	if (f.staff_pwd2.value == '') {
		alert('請輸入確認密碼！');
		f.staff_pwd2.focus();
		return false;
	}
	if (f.staff_pwd.value != f.staff_pwd2.value) {
		alert('登入密碼輸入錯誤！');
		f.staff_pwd.value='';
		f.staff_pwd2.value='';
		f.staff_pwd.focus();
		return false;
	}
	if (f.staff_name.value == '') {
		alert('請輸入姓名！');
		f.staff_name.focus();
		return false;
	}
	if (f.staff_telephone.value == '') {
		alert('請輸入連絡電話！');
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
		alert('請輸入族群名稱！');
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
		alert('請輸入族群名稱！');
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
		alert('請輸入帳號！');
		f.acc.focus();
		return false;
	}
	if (f.pwd.value == '') {
		alert('請輸入密碼！');
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
	if (confirm('確定要刪除嗎？')) {
		window.location = url;
	} else {
		tr.bgColor = '';
		return false;
	}
}

function CONFIRM_SET_DEFAULT(tr, url) {
	tr.bgColor = SelectedBackgroundColor;
	if (confirm('設成預設值嗎？')) {
		window.location = url;
	} else {
		tr.bgColor = '';
		return false;
	}
}

function CONFIRM_TAKE_CASE(tr, url) {
	tr.bgColor = SelectedBackgroundColor;
	if (confirm('接手此案嗎？')) {
		window.location = url;
	} else {
		tr.bgColor = '';
		return false;
	}
}

function CONFIRM_RETURN_CASE(tr, url) {
	tr.bgColor = SelectedBackgroundColor;
	if (confirm('退回此案嗎？')) {
		window.location = url;
	} else {
		tr.bgColor = '';
		return false;
	}
}

function CONFIRM_CLOSE_CASE(tr, url) {
	if (confirm('確定要結束此案嗎？')) {
		window.location = url;
	} else {
		tr.bgColor = '';
		return false;
	}
}

function CONFIRM_DELETE_CASE_REPLY(div, url) {
	var clr = div.style.backgroundColor;
	div.style.backgroundColor = SelectedBackgroundColor;
	if (confirm('確定要刪除此回覆(包含附件)嗎？')) {
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