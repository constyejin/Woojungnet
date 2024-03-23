function login_check(){
	f=document.wform;
	if(!f.login_id.value){
		alert('아이디를 입력해 주세요.');
	}else if(!f.login_pass.value){
		alert('아이디를 입력해 주세요.');
	}else{
		f.action='/inc/login_check.php';
		f.submit();
	}
}

function c_ch(num){
	var c=document.getElementsByName("car_check1[]");
	if(c[num].checked == true){
		c[num].checked = false;
	}else{
		c[num].checked = true;
	}
}
function c_ch2(num){
	var c=document.getElementsByName("car_check2[]");
	if(c[num].checked == true){
		c[num].checked = false;
	}else{
		c[num].checked = true;
	}
}

function board_save(){
	f=document.wform;
	submitContents();
	return true;
}

function all_del(){
	var j=0;
	var c=document.getElementsByName("checkidx[]");
	for(var i=0;i < c.length ; i++){
		if(c[i].checked == true){
			j++;
			break;
		}
	}

	if(j == 0){
		alert("선택된 자료가 없습니다.");
		return;
	}

	if(confirm('선택삭제 하시겠습니까?')){
		document.lform.submit();
	}
}

  function out_submit(){
    f=document.outForm;
      f.action="workStatus_save.php";
      submitContents();
      return true;
  }

function comma(obj) { 

		var num = obj.value;
        if (obj.value.length >= 4) {
            re = /^$|,/g; 
            num = num.replace(re, ""); 
            fl="" 
        if(isNaN(num)) { alert("문자는 사용할 수 없습니다.");return 0} 
        if(num==0) return num 
        if(num<0){ 
            num=num*(-1) 
            fl="-" 
        }
        else{ 
            num=num*1 //처음 입력값이 0부터 시작할때 이것을 제거한다. 
        } 
            num = new String(num) 
            temp="" 
            co=3 
            num_len=num.length 

    while (num_len > 0){ 
        num_len = num_len - co 
        if(num_len<0){co=num_len+co;num_len=0} 
			 temp=","+num.substr(num_len,co)+temp 
        } 
		obj.value =  fl+temp.substr(1);	
    }
} 

function estimate_submit(){
	f=document.con_form;
	if(f.agree_1.checked==false){
		alert('개인정보 수집에 동의해 주세요.');
		return false;
	}else if(f.spam_code.value!=f.spam_input.value){
		alert('스팸방지 숫자를 확인해 주세요.');
		f.spam_input.focus();
		return false;
	}else if(!f.con_name.value){
		alert('이름을 입력해 주세요.');
		f.con_name.focus();
		return false;
	}else if(!f.con_phone.value){
		alert('연락처를 입력해 주세요.');
		f.con_phone.focus();
		return false;
	}else{
		submitContents();
		return true;
	}
}
