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
	f.submit();
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
