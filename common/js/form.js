/// �����޽��� ���� ���� ///
var NO_BLANK = "{name+����} �Է��Ͽ� �ֽʽÿ�.";
var NO_CHECK = "{name+����} �����Ͽ� �ֽʽÿ�.";
var NOT_VALID = "{name+�̰�} �ùٸ��� �ʽ��ϴ�.";
var TOO_LONG = "{name}�� ���̰� �ʰ��Ǿ����ϴ�. (�ִ� {maxbyte}����Ʈ)";
var SPACE = (navigator.appVersion.indexOf("MSIE")!=-1) ? "          " : "";

/// ��Ʈ�� ��ü�� �޼ҵ� �߰� ///
String.prototype.trim = function(str) { 
	str = this != window ? this : str; 
	return str.replace(/^\s+/g,'').replace(/\s+$/g,''); 
}

String.prototype.hasFinalConsonant = function(str) {
	str = this != window ? this : str; 
	var strTemp = str.substr(str.length-1);
	return ((strTemp.charCodeAt(0)-16)%28!=0);
}

String.prototype.bytes = function(str) {
	str = this != window ? this : str;
	var len = 0;
	for(var j=0; j<str.length; j++) {
		var chr = str.charAt(j);
		len += (chr.charCodeAt() > 128) ? 2 : 1
	}
	return len;
}

String.prototype.number_format=function(){
	return this.replace(/(\d)(?=(?:\d{3})+(?!\d))/g,'$1,');
}

Array.prototype.shuffle = function() { 
	return this.concat().sort(function() {
		return Math.random() - Math.random();
	});
}

function in_array(value, array, similar) {
	for(var i=0; i<array.length; i++) {
		if(similar==true) {
			if(value.indexOf(array[i]) != -1) return true; // ����� ��
		} else {
			if(array[i]==value) return true; // ������ ��
		}
	}
	return false;
} 

function validate(form, skip) {

	for (var i=0; i<form.elements.length; i++) {
		var el = form.elements[i];
		if (el.tagName == "FIELDSET") continue;
		if(skip && in_array(el.name, skip.split('|'), true) === true) continue;	// �߰�
		if(el.type.toLowerCase() != "file" && el.value) el.value = el.value.trim();		// ���� :: ���� ���� ����

		var PATTERN = el.getAttribute("PATTERN");
		var minbyte = el.getAttribute("MINBYTE");
		var maxbyte = el.getAttribute("MAXBYTE");
		var minval = el.getAttribute("MINVAL");
		var maxval = el.getAttribute("MAXVAL");
		var option = el.getAttribute("OPTION");
		var match = el.getAttribute("MATCHING"); // ���� :: Prototype JS �� �浹�Ͽ� 'MATCH' ���� 'MATCHING' ���� ����
		var glue = el.getAttribute("GLUE");
		var unit = el.getAttribute("UNIT");
		var or = el.getAttribute("OR");
		if(unit == null) unit = '';

		if (el.getAttribute("REQUIRED") != null) {
			var ERR_MSG = (el.getAttribute("MESSAGE") != null) ? el.getAttribute("MESSAGE") : null;
			if ((el.type.toLowerCase() == "radio" || el.type.toLowerCase() == "checkbox") && !checkMultiBox(el)) return (ERR_MSG) ? doError(el,ERR_MSG) : doError(el,NO_CHECK);
			if (el.tagName.toLowerCase() == "select" && (el.value == null || el.value == "")) return (ERR_MSG) ? doError(el,ERR_MSG) : doError(el,NO_CHECK);
			if (el.value == null || el.value == "" || el.value == "0") return (ERR_MSG) ? doError(el,ERR_MSG) : doError(el,NO_BLANK);
		}
		if (minbyte != null && el.value != "" && el.value.bytes() < parseInt(minbyte)) {
			if(unit=='') unit = "����Ʈ";
			return doError(el,"{name+����} �ּ� "+minbyte+" "+unit+" �̻� �Է��ؾ� �մϴ�.");
		}
		if (maxbyte != null && el.value != "" && el.value.bytes() > parseInt(maxbyte)) {
			if(unit=='') unit = "����Ʈ";
			return doError(el,"{name+����} �ִ� "+maxbyte+" "+unit+" ���Ϸ� �Է��ؾ� �մϴ�.");
		}
		if (minval != null && el.value != "" && el.value < parseInt(minval)) return doError(el,"{name+����} ���� "+minval+" "+unit+" �̻� �Է��ؾ� �մϴ�.");
		if (maxval != null && el.value != "" && el.value > parseInt(maxval)) return doError(el,"{name+����} �ְ� "+maxval+" "+unit+" ���Ϸ� �Է��ؾ� �մϴ�.");
		if (PATTERN != null && el.value != "" && !PATTERN(el,pattern)) return false;
		if (match != null && (el.value != form.elements[match].value)) return doError(el,"{name+�̰�} ��ġ���� �ʽ��ϴ�.");
		if (or != null && (el.value == null || el.value == "") && (form.elements[or].value==null || form.elements[or].value == "")) {
			var name2 = (hname = form.elements[or].getAttribute("HNAME")) ? hname : form.elements[or].getAttribute("NAME");
			return doError(el,"{name+} �Ǵ� "+name2+" �� �ϳ��� �Է��ؾ� �մϴ�.");
		}
		if (option != null && el.value != "") {
			if (el.getAttribute('SPAN') != null) {
				var _value = new Array();
				for (span=0; span<el.getAttribute('SPAN');span++ ) _value[span] = form.elements[i+span].value;
				var value = _value.join(glue == null ? '' : glue);
				if (!funcs[option](el,value)) return false;
			} else {
				try{
					if (!funcs[option](el)) return false;
				} catch(e) {
					//
				}
			}
		}
	}
	return true;
}

function josa(str,tail) {
	return (str.hasFinalConsonant()) ? tail.substring(0,1) : tail.substring(1,2);
}

function checkMultiBox(el) {
	var obj = document.getElementsByName(el.name);
	for (var i=0; i<obj.length; i++) if(obj[i].checked==true) return true;
	return false;
}

function doError(el,type,action) {
	var pattern = /{([a-zA-Z0-9_]+)\+?([��-��]{2})?}/;
	var name = (hname = el.getAttribute("HNAME")) ? hname : el.getAttribute("NAME");
	pattern.exec(type);
	var tail = (RegExp.$2) ? josa(eval(RegExp.$1),RegExp.$2) : "";
	alert(type.replace(pattern,eval(RegExp.$1) + tail) + SPACE);
	if (action == "sel") el.select();
	else if (action == "del")	el.value = "";
	if (el.getAttribute("NOFOCUS") == null) el.focus();
	if(el.getAttribute("SETFOCUS") != null && el.getAttribute("SETFOCUS") !='') el.form.elements[el.getAttribute("SETFOCUS")].focus();

	return false;
}

/// Ư�� ���� �˻� �Լ� ���� ///
var funcs = new Array();
funcs['domain'] = isValidDomain;
funcs['email'] = isValidEmail;
funcs['hp'] = isValidHPhone;
funcs['tel'] = isValidPhone;
funcs['id'] = isValidUserid;
funcs['pw'] = isValidUserpw;
//funcs['hangul'] = hasHangul;			// 2007-09-30 �ʼ� �ѱ����� ���� ���� by ��â��
funcs['number'] = isNumeric;
funcs['float'] = isFloat;
funcs['engonly'] = alphaOnly;
funcs['jumin'] = isValidJumin;
funcs['bizno'] = isValidBizNo;

/// ���� �˻� �Լ��� ///
function isValidDomain(el,value) {
	var value = value ? value : el.value;
	var pattern = /^[_a-zA-Z��-��0-9-]+\.[a-zA-Z��-��0-9-\.]+[a-zA-Z]+$/;
	return (pattern.test(value)) ? true : doError(el,NOT_VALID);
}

function isValidEmail(el,value) {
	var value = value ? value : el.value;
	var pattern = /^[_a-zA-Z0-9-\.]+@[\.a-zA-Z0-9-]+\.[a-zA-Z]+$/;
	return (pattern.test(value)) ? true : doError(el,'�߸��� �̸��������Դϴ�');
}

function isValidUserid(el) {
	var pattern = /^[a-z]{1}[a-z0-9]{3,14}$/;
	return (pattern.test(el.value)) ? true : doError(el,"\n�˼��մϴ�. �Է��Ͻ� ���̵�� �Է±�Ģ�� ��߳��Ƿ� ����Ͻ� �� �����ϴ�.\n\n{name+����} �����ڷ� �����ϴ� 4~15���� ���� �ҹ��ڿ� ������ ���ո� ����� �� �ֽ��ϴ�.");
}

function isValidUserpw(el) {
	var pattern = /^[a-zA-Z0-9]{4,12}$/;
	return (pattern.test(el.value)) ? true : doError(el,"\n�˼��մϴ�. �Է��Ͻ� ��й�ȣ�� �Է±�Ģ�� ��߳��Ƿ� ����Ͻ� �� �����ϴ�."+SPACE+"\n\n{name+����} 4~12���� ���� �ҹ��ڿ� ������ ���ո� ����� �� �ֽ��ϴ�.");
}

function hasHangul(el) {
	var pattern = /[��-��]/;
	return (pattern.test(el.value)) ? true : doError(el,"{name+����} �ݵ�� �ѱ��� �����ؾ� �մϴ�.");
}

function alphaNumOnly(el) {
	var pattern = /^[a-zA-Z0-9]+$/;
	return (pattern.test(el.value)) ? true : doError(el,"\n�˼��մϴ�. �Է��Ͻ� ���̵�� �Է±�Ģ�� ��߳��Ƿ� ����Ͻ� �� �����ϴ�.\n\n{name+����} �����ڿ� ������ ���ո� ����� �� �ֽ��ϴ�.");
}


function alphaOnly(el) {
	var pattern = /^[a-zA-Z]+$/;
	return (pattern.test(el.value)) ? true : doError(el,NOT_VALID);
}

function isNumeric(el) {
	var pattern = /^[0-9]+$/;
	return (pattern.test(el.value)) ? true : doError(el,"{name+����} �ݵ�� ���ڷθ� �Է��ؾ� �մϴ�.");
}

function isFloat(el) {
	var pattern = /^[0-9]+(\.[0-9]{1,4})?$/;
	return (pattern.test(el.value)) ? true : doError(el,"{name+����} �ݵ�� ���� �Ǵ� �Ҽ� ��° �ڸ������� �Է��ؾ� �մϴ�.");
}

function isValidJumin(el,value) {
    var pattern = /^([0-9]{6})-?([0-9]{7})$/; 
	var num = value ? value : el.value;
    if (!pattern.test(num)) return doError(el,NOT_VALID); 
    num = RegExp.$1 + RegExp.$2;

	var sum = 0;
	var last = num.charCodeAt(12) - 0x30;
	var bases = "234567892345";
	for (var i=0; i<12; i++) {
		if (isNaN(num.substring(i,i+1))) return doError(el,NOT_VALID);
		sum += (num.charCodeAt(i) - 0x30) * (bases.charCodeAt(i) - 0x30);
	}
	var mod = sum % 11;
	return ((11 - mod) % 10 == last) ? true : doError(el,NOT_VALID);

	/* ���� ����Ŀ� �ɸ��� �ֹε�Ϲ�ȣ�� ���� ��쿡 �Ʒ��� ���� ó��
	var num = value ? value : el.value;
	num = num.replace(/[^0-9]/g,'');
	num = num.substr(0,13);
	if(num.length<13) doError(el, NOT_VALID);
	else {
		num = num.replace(/([0-9]{6})([0-9]{7}$)/,"$1-$2"); 
		el.value = num;
		return true;
	}
	*/
}

function isValidBizNo(el, value) { 
    var pattern = /([0-9]{3})-?([0-9]{2})-?([0-9]{5})/; 
	var num = value ? value : el.value;
    if (!pattern.test(num)) return doError(el,NOT_VALID); 
    num = RegExp.$1 + RegExp.$2 + RegExp.$3;
    var cVal = 0; 
    for (var i=0; i<8; i++) { 
        var cKeyNum = parseInt(((_tmp = i % 3) == 0) ? 1 : ( _tmp  == 1 ) ? 3 : 7); 
        cVal += (parseFloat(num.substring(i,i+1)) * cKeyNum) % 10; 
    } 
    var li_temp = parseFloat(num.substring(i,i+1)) * 5 + '0'; 
    cVal += parseFloat(li_temp.substring(0,1)) + parseFloat(li_temp.substring(1,2)); 
    return (parseInt(num.substring(9,10)) == 10-(cVal % 10)%10) ? true : doError(el,NOT_VALID); 
}

function isValidPhone(el,value) {
	var pattern = /^([0]{1}[0-9]{1,2})-?([1-9]{1}[0-9]{2,3})-?([0-9]{4})$/;
	

	var num = value ? value : el.value;
	if (pattern.exec(num)) {				// 2007-09-30 ��ȭ��ȣ �߰�(03, 067) by ��â��
	
		
		var phones = new Array("02","03","031","032","033","041","042","043","051","052","053","054","055","061","062","063","064","067");
	 	
		if(in_array(RegExp.$1, phones, false)) {
			if(!el.getAttribute('SPAN'))
			el.value = RegExp.$1 + "-" + RegExp.$2 + "-" + RegExp.$3;
			return true;
		}
	
	return true;
	}
	return doError(el,NOT_VALID);
}

function isValidHPhone(el,value) {
	var pattern = /^([0]{1}[0-9]{1,2})-?([1-9]{1}[0-9]{2,3})-?([0-9]{4})$/;
	var num = value ? value : el.value;
	if (pattern.exec(num)) {
		var hphones = new Array("011","016","017","018","019","010");
		if(in_array(RegExp.$1, hphones, false)) {
			if(!el.getAttribute('SPAN')) el.value = RegExp.$1 + "-" + RegExp.$2 + "-" + RegExp.$3;
			return true;
		}
	return true;
	}
	return doError(el,NOT_VALID);
}
