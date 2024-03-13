$().ready(function(){
  function add_comma(){
	  const input=document.querySelector('#number');
	  const input2=document.querySelector('#number2');
	  input.addEventListener('keyup',function(e){
		  let value=e.target.value;
		  value=Number(value.replaceAll(',',''));
		  if(isNaN(value)){
			  input.value=0;
		  }else{
			  const formatValue=value.toLocaleString('ko-KR');
			  input.value=formatValue;
		  }
	  })
	  input2.addEventListener('keyup',function(e){
		  let value=e.target.value;
		  value=Number(value.replaceAll(',',''));
		  if(isNaN(value)){
			  input2.value=0;
		  }else{
			  const formatValue=value.toLocaleString('ko-KR');
			  input2.value=formatValue;
		  }
	  })
  }

  add_comma();
})

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

function board_del(idx){
	if(confirm('삭제 하시겠습니까?')){
		document.wform.del_idx.value=idx;
		document.wform.submit();
		document.wform.del_idx.value="";
	}
}

function board_del(idx){
	if(confirm('삭제 하시겠습니까?')){
		document.wform.del_idx.value=idx;
		document.wform.submit();
		document.wform.del_idx.value="";
	}
}

function ch_type(val,ty){
	if(ty=="1"){
		document.wform.action="/manage/menu02/sub01_type.php";
		document.wform.submit();
		document.wform.action="sub01_save.php";
	}else if(ty=="2"){
		document.wform.action="/manage/menu02/sub01_type.php";
		document.wform.submit();
		document.wform.action="sub02_save.php";
	}else if(ty=="3"){
		document.wform.action="/manage/menu02/sub01_type.php";
		document.wform.submit();
		document.wform.action="sub03_save.php";
	}else if(ty=="4"){
		document.wform.action="/manage/menu03/sub05_type.php";
		document.wform.submit();
		document.wform.action="sub05_save.php";
	}

	if(val=="화물차"){
		document.getElementById("choice1").style.display="block";
		document.getElementById("choice3").style.display="block";
		document.getElementById("choice2").style.display="none";
		document.getElementById("choice4").style.display="none";
		document.getElementById("color1").style.display="block";
		document.getElementById("color1_1").style.display="none";
		document.getElementById("color2").style.display="block";
		document.getElementById("color2_1").style.display="none";
	}else if(val=="캠핑카"){
		document.getElementById("choice1").style.display="none";
		document.getElementById("choice3").style.display="none";
		document.getElementById("choice2").style.display="block";
		document.getElementById("choice4").style.display="block";
		document.getElementById("color1_1").style.display="block";
		document.getElementById("color1").style.display="none";
		document.getElementById("color2_1").style.display="block";
		document.getElementById("color2").style.display="none";
	}else{
		document.getElementById("choice1").style.display="none";
		document.getElementById("choice3").style.display="none";
		document.getElementById("choice2").style.display="none";
		document.getElementById("choice4").style.display="none";
		document.getElementById("color1_1").style.display="none";
		document.getElementById("color1").style.display="none";
		document.getElementById("color2_1").style.display="none";
		document.getElementById("color2").style.display="none";
	}
}

function ch_type2(val,ty){
	if(ty=="1"){
		document.wform.action="/manage/menu02/sub01_type2.php";
		document.wform.submit();
		document.wform.action="sub01_save.php";
	}else if(ty=="2"){
		document.wform.action="/manage/menu02/sub01_type.php";
		document.wform.submit();
		document.wform.action="sub02_save.php";
	}else if(ty=="3"){
		document.wform.action="/manage/menu02/sub01_type2.php";
		document.wform.submit();
		document.wform.action="sub03_save.php";
	}else if(ty=="4"){
		document.wform.action="/manage/menu03/sub05_type.php";
		document.wform.submit();
		document.wform.action="sub05_save.php";
	}
}

function ch_trim(val){
		document.wform.action="/manage/menu02/sub01_trim.php";
		document.wform.submit();
		document.wform.action="sub01_save.php";
}

function c_ch(num,t){
	var c=document.getElementsByName("car_check1[]");
	var c1=document.getElementsByName("car_color1[]");
	if(c1[num].checked == true){
		if(c[num].checked == true){
			c[num].checked = false;
		}else{
			c[num].checked = true;
		}
	}else{
		if(c[num].checked == false){
		}
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

function c_ch3(num){
	var c=document.getElementsByName("car_check3[]");
	if(c[num].checked == true){
		c[num].checked = false;
	}else{
		c[num].checked = true;
	}
}

function c_ch4(num){
	var c=document.getElementsByName("car_check4[]");
	if(c[num].checked == true){
		c[num].checked = false;
	}else{
		c[num].checked = true;
	}
}

var ch_price_sum=new Array();

function c_ch5(num,trim,ch_price){
	var c1=document.getElementsByName("car_choice1[]");
	if(c1[num].checked==true){
		var n=parseInt(numberNullChk(document.wform.car_price.value));
		if(!ch_price_sum[trim]) ch_price_sum[trim]=0;
		var c=document.getElementsByName("car_check5[]");
		if(c[num].checked == true){
			c[num].checked = false;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])-parseInt(ch_price);
		}else{
			c[num].checked = true;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])+parseInt(ch_price);
		}
		var nn=n+ch_price_sum[trim];
		document.wform.trim_price.value=nn;
		document.getElementById('c_price').innerHTML=addComma(nn)+' <em>원</em>';
		document.getElementById('float_write_3').innerHTML=addComma(nn);
	}
}

function c_ch6(num,trim,ch_price){
	var c1=document.getElementsByName("car_choice2[]");
	if(c1[num].checked==true){
		var n=parseInt(numberNullChk(document.wform.car_price.value));
		if(!ch_price_sum[trim]) ch_price_sum[trim]=0;
		var c=document.getElementsByName("car_check6[]");
		if(c[num].checked == true){
			c[num].checked = false;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])-parseInt(ch_price);
		}else{
			c[num].checked = true;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])+parseInt(ch_price);
		}
		var nn=n+ch_price_sum[trim];
		document.wform.trim_price.value=nn;
		document.getElementById('c_price').innerHTML=addComma(nn)+' <em>원</em>';
		document.getElementById('float_write_3').innerHTML=addComma(nn);
	}
}

function c_ch7(num,trim,ch_price){
	var c1=document.getElementsByName("car_choice3[]");
	if(c1[num].checked==true){
		var n=parseInt(numberNullChk(document.wform.car_price.value));
		if(!ch_price_sum[trim]) ch_price_sum[trim]=0;
		var c=document.getElementsByName("car_check7[]");
		if(c[num].checked == true){
			c[num].checked = false;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])-parseInt(ch_price);
		}else{
			c[num].checked = true;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])+parseInt(ch_price);
		}
		var nn=n+ch_price_sum[trim];
		document.wform.trim_price.value=nn;
		document.getElementById('c_price').innerHTML=addComma(nn)+' <em>원</em>';
		document.getElementById('float_write_3').innerHTML=addComma(nn);
	}
}

function c_ch8(num,trim,ch_price){
	var c1=document.getElementsByName("car_choice4[]");
	if(c1[num].checked==true){
		var n=parseInt(numberNullChk(document.wform.car_price.value));
		if(!ch_price_sum[trim]) ch_price_sum[trim]=0;
		var c=document.getElementsByName("car_check8[]");
		if(c[num].checked == true){
			c[num].checked = false;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])-parseInt(ch_price);
		}else{
			c[num].checked = true;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])+parseInt(ch_price);
		}
		var nn=n+ch_price_sum[trim];
		document.wform.trim_price.value=nn;
		document.getElementById('c_price').innerHTML=addComma(nn)+' <em>원</em>';
		document.getElementById('float_write_3').innerHTML=addComma(nn);
	}
}

function c_ch9(num,trim,ch_price,oc_id){
	var c1=document.getElementsByName("car_choice1[]");
	var c=document.getElementsByName("car_check5[]");
	if(c1[num].checked==false&&c[num].checked==true){
		var n=parseInt(numberNullChk(document.wform.car_price.value));
		if(!ch_price_sum[trim]) ch_price_sum[trim]=0;
		if(c[num].checked == true){
			c[num].checked = false;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])-parseInt(ch_price);
		}else{
			c[num].checked = true;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])+parseInt(ch_price);
		}
		var nn=n+ch_price_sum[trim];
		document.wform.trim_price.value=nn;
		document.getElementById('c_price').innerHTML=addComma(nn)+' <em>원</em>';
		document.getElementById('float_write_3').innerHTML=addComma(nn);
		document.getElementById(oc_id).classList.remove('selected');
	}
}

function c_ch10(num,trim,ch_price,oc_id){
	var c1=document.getElementsByName("car_choice2[]");
	var c=document.getElementsByName("car_check6[]");
	if(c1[num].checked==false&&c[num].checked==true){
		var n=parseInt(numberNullChk(document.wform.car_price.value));
		if(!ch_price_sum[trim]) ch_price_sum[trim]=0;
		if(c[num].checked == true){
			c[num].checked = false;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])-parseInt(ch_price);
		}else{
			c[num].checked = true;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])+parseInt(ch_price);
		}
		var nn=n+ch_price_sum[trim];
		document.wform.trim_price.value=nn;
		document.getElementById('c_price').innerHTML=addComma(nn)+' <em>원</em>';
		document.getElementById('float_write_3').innerHTML=addComma(nn);
		document.getElementById(oc_id).classList.remove('selected');
	}
}

function c_ch11(num,trim,ch_price,oc_id){
	var c1=document.getElementsByName("car_choice3[]");
	var c=document.getElementsByName("car_check7[]");
	if(c1[num].checked==false&&c[num].checked==true){
		var n=parseInt(numberNullChk(document.wform.car_price.value));
		if(!ch_price_sum[trim]) ch_price_sum[trim]=0;
		if(c[num].checked == true){
			c[num].checked = false;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])-parseInt(ch_price);
		}else{
			c[num].checked = true;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])+parseInt(ch_price);
		}
		var nn=n+ch_price_sum[trim];
		document.wform.trim_price.value=nn;
		document.getElementById('c_price').innerHTML=addComma(nn)+' <em>원</em>';
		document.getElementById('float_write_3').innerHTML=addComma(nn);
		document.getElementById(oc_id).classList.remove('selected');
	}
}

function c_ch12(num,trim,ch_price,oc_id){
	var c1=document.getElementsByName("car_choice4[]");
	var c=document.getElementsByName("car_check8[]");
	if(c1[num].checked==false&&c[num].checked==true){
		var n=parseInt(numberNullChk(document.wform.car_price.value));
		if(!ch_price_sum[trim]) ch_price_sum[trim]=0;
		if(c[num].checked == true){
			c[num].checked = false;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])-parseInt(ch_price);
		}else{
			c[num].checked = true;
			ch_price_sum[trim]=parseInt(ch_price_sum[trim])+parseInt(ch_price);
		}
		var nn=n+ch_price_sum[trim];
		document.wform.trim_price.value=nn;
		document.getElementById('c_price').innerHTML=addComma(nn)+' <em>원</em>';
		document.getElementById('float_write_3').innerHTML=addComma(nn);
		document.getElementById(oc_id).classList.remove('selected');
	}
}

function est_state_change(idx,val){
	f=document.wform;
	f.idx.value=idx;
	f.val.value=val;
	f.submit();
}

function click_search(tar,val){
	f=document.sform;
	tar.value=val;
	f.submit();
}

function list_ch(num){
	f=document.cform;
	var c1=document.getElementsByName("car_idx[]");
	var c2=document.getElementsByName("car_list[]");
	f.idx.value=c1[num].value;
	f.car_list.value=c2[num].value;
	f.submit();
}

function c_color1(t,num,oc_id){
	var c1=document.getElementsByName("car_check1[]");
	if(t.checked==false){
		if(c1[num].checked==true){
			c1[num].checked=false;
			document.getElementById(oc_id).classList.remove('selected');
		}
	}
}

function c_color2(t,num,oc_id){
	var c1=document.getElementsByName("car_check2[]");
	if(t.checked==false){
		if(c1[num].checked==true){
			c1[num].checked=false;
			document.getElementById(oc_id).classList.remove('selected');
		}
	}
}

function c_color3(t,num,oc_id){
	var c1=document.getElementsByName("car_check3[]");
	if(t.checked==false){
		if(c1[num].checked==true){
			c1[num].checked=false;
			document.getElementById(oc_id).classList.remove('selected');
		}
	}
}

function c_color4(t,num,oc_id){
	var c1=document.getElementsByName("car_check4[]");
	if(t.checked==false){
		if(c1[num].checked==true){
			c1[num].checked=false;
			document.getElementById(oc_id).classList.remove('selected');
		}
	}
}