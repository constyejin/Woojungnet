function detailView(pic) {	
	window.open('../inc/img_view.php?img=../../data/'+pic,'imageWin','top=100,left=100,width=810,height=530');
}

function goUrl(href){
	location.href = href;
}




var please_wait = null;

function CallsubGubun(div,type,name,array,value,onscript,col,ret,write) {
	var qryString = "type="+type+"&name="+name+"&array="+array+"&value="+value;
		qryString += "&onscript="+onscript+"&col="+col+"&ret="+ret+"&write="+write;
	var url = "/manage/inc/searchAjax.php?"+qryString;
    if ( ! document.getElementById) {
          return false;
    }

	document.getElementById(div).innerText = "데이터를 로딩중입니다..";


    if (window.ActiveXObject) {
          link = new ActiveXObject("Microsoft.XMLHTTP");
    } else if (window.XMLHttpRequest) {
          link = new XMLHttpRequest();
    }

    if (link == undefined) {
          return false;
    }
    link.onreadystatechange = function() { response(div, url); }
    link.open("GET", url, true);
    link.send(null);
}

function response(div, url) {
    if (link.readyState == 4) {
         
		 if (link.status == 200)
		 {
			 var ReturnVal = link.responseText;
			 if (ReturnVal != "")
			 {		
				document.getElementById(div).innerHTML = ReturnVal;
			 }
		 }
    }
}



// 진행상황 메모 
function ChkMemo(){
	var obj = document.frmingMemo;
	if(!obj.caringMemo.value){
		alert("진행메모장 내용을 기입해 주세요. ");
		obj.caringMemo.focus();
		return false;
	}
	//obj.target = "ExeFrm"
	obj.action = "../inc/comment.exe.php";
}


function _AreaPrint(el) {
    var Url = '/admin/inc/printWin.php?pText=' + el;
    window.open(Url, 'printWin', 'width=600, height=600, scrollbars=yes');
}


function WinPrint()
  {
    ExeFrm.document.open();
	ExeFrm.document.writeln("<html><head><style>body,td,p,pre,input,textarea,select,option,a,a:hover {font-size:10pt; font-family:tahoma,굴림;}</style></head><body>"); //스타일등을 지정
	ExeFrm.document.writeln(window.document.all.PrintArea.innerHTML)
	ExeFrm.document.writeln("</body></html>");
    ExeFrm.document.close();
    ExeFrm.document.execCommand('Print');
  }



function dataintComma(objext) {
  
    	var formnum = objext.value;	
    	var num1 = formnum.length; 	
		
        var FirstNum = formnum.substr(0,1);
        var FirstNum2 = formnum.substr(1,num1);
   
        if(FirstNum == "0"){
                //alert("입력숫자는 0 으로 시작할 수 없습니다.");
				objext.value  = "";
				//objext.value  = FirstNum2;
                formnum = FirstNum2;
        }

        loop = /^\$|,/g; 
    	formnum = formnum.replace(loop, ""); 

        //formnum.value=formnum;
        
        var fieldnum = '' + formnum;    

          if (isNaN(fieldnum)) {
				alert("숫자만 입력하실 수 있습니다.");        
				objext.value.value == "";
				//formnum.focus();
				objext.value =  "";
	      }else {
				var comma = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
				var data = fieldnum.split('.');
				   
				   data[0] += '.';
				   
				   do {
						data[0] = data[0].replace(comma, '$1,$2');
				   } while (comma.test(data[0]));
		
				   if (data.length > 1) {
						objext.value = data.join('');
				   }else {
						objext.value =  data[0].split('.')[0];
				   }

	        }
	      
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

// 계산해서 원하는 곳에 뿌려준다.
function calculation1( objext  ){
	dataintComma(objext);

	var S = document.getElementById('wc_accepted_priceS');
	var A = parseInt(numberNullChk(document.getElementById('wc_accepted_priceA').value));
	var B = parseInt(numberNullChk(document.getElementById('wc_accepted_priceB').value));
	var C = parseInt(numberNullChk(document.getElementById('wc_accepted_priceC').value));
	var D = parseInt(numberNullChk(document.getElementById('wc_accepted_priceD').value));
	var E = parseInt(numberNullChk(document.getElementById('wc_accepted_priceE').value));
	var F = parseInt(numberNullChk(document.getElementById('wc_accepted_priceF').value));
	var G = parseInt(numberNullChk(document.getElementById('wc_accepted_priceG').value));
	
	var value = A+B+C+D+E+F+G;
	S.value = value;
	comma(S);

}

// 폐차 지급
function calculation2( objext  ){
	//F= A-B-C-D+E
	dataintComma(objext);

	var F = document.getElementById('wc_scrap_rateF');
	var A = parseInt(numberNullChk(document.getElementById('wc_scrap_rateA').value));
	var B = parseInt(numberNullChk(document.getElementById('wc_scrap_rateB').value));
	var C = parseInt(numberNullChk(document.getElementById('wc_scrap_rateC').value));
	var D = parseInt(numberNullChk(document.getElementById('wc_scrap_rateD').value));
	var E = parseInt(numberNullChk(document.getElementById('wc_scrap_rateE').value));
	
	var value = A-B-C-D+E;
	F.value = value;
	comma(F);
	
}



// 폐차 입금액
function calculation3( objext  ){
	//실매도가 - 공제액 + 기타더함 = 임금액
	dataintComma(objext);

	var F = document.getElementById('wc_scrap_totprice');
	var A = parseInt(numberNullChk(document.getElementById('wc_scrap_totprice1').value));
	var B = parseInt(numberNullChk(document.getElementById('wc_scrap_totprice2').value));
	var C = parseInt(numberNullChk(document.getElementById('wc_scrap_totprice3').value));

	var value = A-B+C;
	F.value = value;
	comma(F);
	
}

// 폐차 발생비용
function calculation4( objext  ){
	//실매도가 - 공제액 + 기타더함 = 임금액
	dataintComma(objext);

	var F = document.getElementById('wc_scrap_cost');
	var A = parseInt(numberNullChk(document.getElementById('wc_scrap_cost1').value));
	var B = parseInt(numberNullChk(document.getElementById('wc_scrap_cost2').value));
	var C = parseInt(numberNullChk(document.getElementById('wc_scrap_cost3').value));

	var value = A+B+C;
	F.value = value;
	comma(F);
	
}

// 진행방식 비용정산
function calculation5(  objext ){
	//실매도가 - 공제액 + 기타더함 = 임금액
	dataintComma(objext);

	var F = document.getElementById('wc_go_cost');
	var A = parseInt(numberNullChk(document.getElementById('wc_go_cost1').value));
	var B = parseInt(numberNullChk(document.getElementById('wc_go_cost2').value));
	var C = parseInt(numberNullChk(document.getElementById('wc_go_cost3').value));

	var value = A+B+C;
	F.value = value;
	comma(F);
	
}



// 계산해서 원하는 곳에 뿌려준다.
function calculation( objext ){
	//K= A-(G+H+I)+J
	dataintComma(objext);

	var K = document.getElementById('wc_tot_priceK');
	var A = parseInt(numberNullChk(document.getElementById('wc_accepted_priceA').value));
//	var G = parseInt(numberNullChk(document.getElementById('wc_insure_priceG').value));
	var H = parseInt(numberNullChk(document.getElementById('wc_gale_priceH').value));
	var I = parseInt(numberNullChk(document.getElementById('wc_etc1_priceI').value));
	var J = parseInt(numberNullChk(document.getElementById('wc_etc2_priceJ').value));
	var G=0;

	var value = A-(G+H+I)+J;
	K.value = value;
	comma(K);
}

function numberNullChk(obj){
	if(!obj){
		var val = 0;
	}else{
		 var re = /^$|,/g; 
         var val = obj.replace(re, ""); 
	}
	return val;
}


function txtWrite(obj, value){
	document.getElementById(obj).innerText = value;
}



function addComma (str)
{
	 var input_str = str.toString();

	 if (input_str == '') return false;
	 input_str = parseInt(input_str.replace(/[^0-9]/g, '')).toString();
	 if (isNaN(input_str)) { return false; }

	 var sliceChar = ',';
	 var step = 3;
	 var step_increment = -1;
	 var tmp  = '';
	 var retval = '';
	 var str_len = input_str.length;

	 for (var i=str_len; i>=0; i--)
	 {
	  tmp = input_str.charAt(i);
	  if (tmp == sliceChar) continue;
	  if (step_increment%step == 0 && step_increment != 0) retval = tmp + sliceChar + retval;
	  else retval = tmp + retval;
	  step_increment++;
	 }

	 return retval;
}


function rs(str)
{
    str = str.replace(/,/g, "");
    return str;
}
//
function delete_list(str){
	var j=0;
	var form = document.cform;
	var obj = document.getElementsByName('check[]');
	for(var i=0;i < obj.length ; i++){
		if(obj[i].checked == true){
			j++;
			break;
		}
	}

	if(j == 0){
		alert("선택된것이 없습니다.");
		return;
	}
	result = confirm("한번 삭제하신것은 복구 불가능 합니다 \n\n정말 삭제 하시겠습니까??");
	if(result){
		document.cform.action = str;
		document.cform.submit();
	}
	
}
