<!-- 

var n4 = (document.layers)?true:false; 
var e4 = (document.all)?true:false; 

//숫자만입력(onKeypress='return keyCheckdot(event)') 
function keyCheck(e) { 
    if(n4) var keyValue = e.which 
    else if(e4) var keyValue = event.keyCode 
    if (((keyValue >= 48) && (keyValue <= 57))  || keyValue==13) return true; 
    else return false 
} 

//숫자및돗트입력(onKeypress='return keyCheckdot(event)') 
function keyCheckDot(e) { 
    if(n4) var keyValue = e.which 
    else if(e4) var keyValue = event.keyCode 
    if (((keyValue >= 48) && (keyValue <= 57)) || keyValue==13 || keyValue==46) return true; 
    else return false 
} 

//공백제거 
function Trim(string) { 
    for(;string.indexOf(" ")!= -1;){ 
        string=string.replace(" ","") 
    } 
    return string; 
} 

//입력검사 
function Exists(input,types) { 
    if(types) if(!Trim(input.value)) return false; 
    return true; 
} 

//영문검사+숫자검사(첫글자는 반드시영문) 
function EngNum(input,types) { 
    if(types) if(!Trim(input.value)) return false; 
    var error_c=0, i, val; 
    for(i=0;i<Byte(input.value);i++) { 
        val = input.value.charAt(i); 
        if(i == 0) if(!((val>='a' && val<='z') || (val>='A' && val<='Z'))) return false; 
        else if(!((val>=0 && val<=9) || (val>='a' && val<='z') || (val>='A' && val<='Z'))) return false; 
   } 
   return true; 
} 

//영문검사+숫자검사 
function EngNumAll(input,types) { 
    if(types) if(!Trim(input.value)) return false; 
    var error_c=0, i, val; 
    for(i=0;i<Byte(input.value);i++) { 
        val = input.value.charAt(i); 
        if(!((val>=0 && val<=9) || (val>='a' && val<='z') || (val>='A' && val<='Z'))) return false; 
   } 
   return true; 
} 

//영문검사+숫자검사+'_' 
function EngNumAll2(input,types) { 
    if(types) if(!Trim(input.value)) return false; 
    var error_c=0, i, val; 
    for(i=0;i<Byte(input.value);i++) { 
        val = input.value.charAt(i); 
        if(!((val>=0 && val<=9) || (val>='a' && val<='z') || (val>='A' && val<='Z') || val=='_')) return false; 
   } 
   return true; 
} 

//영문검사 
function Eng(input,types) { 
    if(types) if(!Trim(input.value)) return false; 
    var error_c=0, i, val; 
    for(i=0;i<Byte(input.value);i++) { 
        val = input.value.charAt(i); 
        if(!((val>='a' && val<='z') || (val>='A' && val<='Z'))) return false; 
   } 
   return true; 
} 

//숫자만입력 
/* 
function numberonlyinput() { 
    var ob = event.srcElement; 
    ob.value = noSplitAndNumberOnly(ob); 
    return false; 
} 
*/ 

//돈(3단위마다 컴마를 붙인다.) 
function checkNumber() { 
    var ob=event.srcElement; 
    ob.value = filterNum(ob.value); 
    ob.value = commaSplitAndNumberOnly(ob); 
    return false; 
} 

//한정액(일정금액 이상이 되면 올라기지 않게 한다.) 
function chkhando(money) { 
    var ob=event.srcElement; 
    ob.value = noSplitAndNumberOnly(ob); 
    if(ob.value > money) ob.value = money; 
    return false; 
} 

//이자율(소수점 사용가능) 
function checkNumberDot(llen,rlen) { 
    if(llen == "") llen = 8; 
    if(rlen == "") rlen = 2; 
    var ob=event.srcElement; 
    ob.value = filterNum(ob.value); 

    spnumber = ob.value.split('.'); 
    if( spnumber.length >= llen && (spnumber[0].length >llen || spnumber[1].length >llen)) { 
        ob.value = spnumber[0].substring(0,llen) + "." + spnumber[1].substring(0,rlen); 
        ob.focus(); 
        return false; 
    } 
    else if( spnumber[0].length > llen ) { 
        ob.value = spnumber[0].substring(0,llen) + "."; 
        ob.focus(); 
        return false; 
    } 
    else if(ob.value && spnumber[0].length == 0) { 
        ob.value = 0 + "." + spnumber[1].substring(0,rlen); 
        ob.focus(); 
        return false; 
    } 
    ob.value = commaSplitAndAllowDot(ob); 
    return false; 
} 

//참조함수 
function filterNum(str) { 
        re = /^\$|,/g; 
        return str.replace(re, ""); 
} 

//참조함수(컴마불가) 
function commaSplitAndNumberOnly(ob) { 
     
    var txtNumber = '' + ob.value; 
    if (isNaN(txtNumber) || txtNumber.indexOf('.') != -1 ) { 
        ob.value = ob.value.substring(0, ob.value.length-1 ); 
        ob.value = commaSplitAndNumberOnly(ob); 
        ob.focus(); 
        return ob.value; 
    } 
    else { 
        var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])'); 
        var arrNumber = txtNumber.split('.'); 
        arrNumber[0] += '.'; 
        do { 
            arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2'); 
        } 
        while (rxSplit.test(arrNumber[0])); 
         
        if (arrNumber.length > 1) { 
            return arrNumber.join(''); 
        } 
        else { 
            return arrNumber[0].split('.')[0]; 
        } 
   } 
} 

//참조함수(컴마가능) 
function commaSplitAndAllowDot(ob) { 
     
    var txtNumber = '' + ob.value; 
    if (isNaN(txtNumber) ) { 
        ob.value = ob.value.substring(0, ob.value.length-1 ); 
        ob.focus(); 
        return ob.value; 
    } 
    else { 
        var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])'); 
        var arrNumber = txtNumber.split('.'); 
        arrNumber[0] += '.'; 
        do { 
            arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2'); 
        } 
        while (rxSplit.test(arrNumber[0])); 
         
        if (arrNumber.length > 1) { 
            return arrNumber.join(''); 
        } 
        else { 
            return arrNumber[0].split('.')[0]; 
        } 
   } 
} 

//숫자만가능 
function noSplitAndNumberOnly(ob) { 
    var txtNumber = '' + ob.value; 
    if (isNaN(txtNumber) || txtNumber.indexOf('.') != -1 ) { 
        ob.value = ob.value.substring(0, ob.value.length-1 ); 
        ob.focus(); 
        return ob.value; 
    } 
    else return ob.value; 
} 


//바이트검사 
function Byte(input) { 
    var i, j=0; 
    for(i=0;i<input.length;i++) { 
        val=escape(input.charAt(i)).length; 
        if(val==  6) j++; 
        j++; 
    } 
    return j; 
} 

//팝업메뉴 
function popupmenu_show(layername, thislayer, thislayer2) { 
    thislayerfield.value = thislayer; 
    thislayerfield2.value = thislayer2; 
    var obj = document.all[layername]; 
    var _tmpx,_tmpy, marginx, marginy; 
    _tmpx = event.clientX + parseInt(obj.offsetWidth); 
    _tmpy = event.clientY + parseInt(obj.offsetHeight); 
    _marginx = document.body.clientWidth - _tmpx; 
    _marginy = document.body.clientHeight - _tmpy ; 
    if(_marginx < 0) _tmpx = event.clientX + document.body.scrollLeft + _marginx ; 
    else _tmpx = event.clientX + document.body.scrollLeft ; 
    if(_marginy < 0) _tmpy = event.clientY + document.body.scrollTop + _marginy + 20; 
    else _tmpy = event.clientY + document.body.scrollTop ; 
    obj.style.posLeft = _tmpx - 5; 
    obj.style.posTop  = _tmpy; 
     
    layer_set_visible(obj, true); 
    layer_set_pos(obj, event.clientX, event.clientY); 
} 
function layer_set_visible(obj, flag) { 
  if (navigator.appName.indexOf('Netscape', 0) != -1) obj.visibility = flag ? 'show' : 'hide'; 
  else obj.style.visibility = flag ? 'visible' : 'hidden'; 
} 
function layer_set_pos(obj, x, y) { 
  if (navigator.appName.indexOf('Netscape', 0) != -1) { 
    obj.left = x; 
    obj.top  = y; 
  } else { 
    obj.style.pixelLeft = x + document.body.scrollLeft; 
    obj.style.pixelTop  = y + document.body.scrollTop; 
  } 
} 


//페이지이동 
function move(url) { 
    location.href = url; 
} 

//닫기 
function toclose() { 
    self.close(); 
} 

//위치변경 
function winsize(w,h,l,t) { 
    if(window.opener) resizeTo(w,h); 
} 

//포커스위치 
function formfocus(form) { 
  var len = form.elements.length; 
  for(i=0;i<len;i++) { 
    if((form.elements[i].type == "text" || form.elements[i].type == "password") && Trim(form.elements[i].value) == "") { 
      form.elements[i].value = ""; 
      form.elements[i].focus(); 
      break; 
    } 
  } 
} 

// 날짜,시간 format 함수 = php의 date() 
function date(arg_format, arg_date) { 
       if(!arg_date) arg_date = new Date(); 

       var M = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"); 
       var F = new Array("January","February","March","April","May","June","July","August","September","October","November","December"); 
       var K = new Array("일","월","화","수","목","금","토"); 
       var k = new Array("日","月","火","水","木","金","土"); 
       var D = new Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat"); 
       var l = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"); 
       var o = new Array("전","후"); 
       var O = new Array("오전","오후"); 
       var a = new Array("am","pm"); 
       var A = new Array("AM","PM"); 

       var org_year = arg_date.getFullYear(); 
       var org_month = arg_date.getMonth(); 
       var org_date = arg_date.getDate(); 
       var org_wday = arg_date.getDay(); 
       var org_hour = arg_date.getHours(); 
       var org_minute = arg_date.getMinutes(); 
       var org_second = arg_date.getSeconds(); 
       var hour = org_hour % 12; hour = (hour) ? hour : 12; 
       var ampm = Math.floor(org_hour / 12); 

       var value = new Array(); 
       value["Y"] = org_year; 
       value["y"] = String(org_year).substr(2,2); 
       value["m"] = String(org_month+1).replace(/^([0-9])$/,"0$1"); 
       value["n"] = org_month+1; 
       value["d"] = String(org_date).replace(/^([0-9])$/,"0$1"); 
       value["j"] = org_date; 
       value["w"] = org_wday; 
       value["H"] = String(org_hour).replace(/^([0-9])$/,"0$1"); 
       value["G"] = org_hour; 
       value["h"] = String(hour).replace(/^([0-9])$/,"0$1"); 
       value["g"] = hour; 
       value["i"] = String(org_minute).replace(/^([0-9])$/,"0$1"); 
       value["s"] = String(org_second).replace(/^([0-9])$/,"0$1"); 
       value["t"] = (new Date(org_year, org_month+1, 1) - new Date(org_year, org_month, 1)) / 86400000; 
       value["z"] = (new Date(org_year, org_month, org_date) - new Date(org_year, 0, 1)) / 86400000; 
       value["L"] = ((new Date(org_year, 2, 1) - new Date(org_year, 1, 1)) / 86400000) - 28; 
       value["M"] = M[org_month]; 
       value["F"] = F[org_month]; 
       value["K"] = K[org_wday]; 
       value["k"] = k[org_wday]; 
       value["D"] = D[org_wday]; 
       value["l"] = l[org_wday]; 
       value["o"] = o[ampm]; 
       value["O"] = O[ampm]; 
       value["a"] = a[ampm]; 
       value["A"] = A[ampm]; 
       
       var str = ""; 
       var tag = 0; 
       for(i=0;i<arg_format.length;i++) { 
              var chr = arg_format.charAt(i); 
              switch(chr) { 
                     case "<" : tag++; break; 
                     case ">" : tag--; break; 
              } 
              if(tag || value[chr]==null) str += chr; else str += value[chr]; 
       } 

       return str; 
} 

// 해상도에 맞는 크기 사용 
function screensize() { 
    self.moveTo(0,0); 
    self.resizeTo(screen.availWidth,screen.availHeight); 
} 

// 주민등록번호체크( 입력폼 1개) 
function check_jumin(jumin) { 
    var weight = "234567892345"; // 자리수 weight 지정 
    var val = jumin.replace("-",""); // "-"(하이픈) 제거 
    var sum = 0; 

    if(val.length != 13) { return false; } 

    for(i=0;i<12;i++) { 
        sum += parseInt(val.charAt(i)) * parseInt(weight.charAt(i)); 
    } 

    var result = (11 - (sum % 11)) % 10; 
    var check_val = parseInt(val.charAt(12)); 

    if(result != check_val) { return false; } 
    return true; 
} 

// 주민등록번호체크( 입력폼 2개) 
function check_jumin2(input, input2) { 
    input.value=Trim(input.value); 
    input2.value=Trim(input2.value); 
    var left_j=input.value; 
    var right_j=input2.value; 
    if(input.value.length != 6) { 
        alert('주민등록번호를 정확히 입력하세요.'); 
        input.focus(); 
        return true; 
    } 
    if(right_j.length != 7) { 
        alert('주민등록번호를 정확히 입력하세요.'); 
        input2.focus(); 
        return true; 
    } 
    var i2=0; 
    for(var i=0;i<left_j.length;i++) { 
        var temp=left_j.substring(i,i+1); 
        if(temp<0 || temp>9)  i2++; 
    } 
    if((left_j==  '') || (i2 != 0)) { 
        alert('주민등록번호가 잘못 입력되었습니다.'); 
        j_left.focus(); 
        return true; 
    } 
    var i3=0; 
    for(var i=0;i<right_j.length;i++) { 
        var temp=right_j.substring(i,i+1); 
        if (temp<0 || temp>9) i3++; 
    } 
    if((right_j==  '') || (i3 != 0)) { 
        alert('주민등록번호가 잘못 입력되었습니다.'); 
        input2.focus(); 
        return true; 
    } 
    var l1=left_j.substring(0,1); 
    var l2=left_j.substring(1,2); 
    var l3=left_j.substring(2,3); 
    var l4=left_j.substring(3,4); 
    var l5=left_j.substring(4,5); 
    var l6=left_j.substring(5,6); 
    var hap=l1*2+l2*3+l3*4+l4*5+l5*6+l6*7; 
    var r1=right_j.substring(0,1); 
    var r2=right_j.substring(1,2); 
    var r3=right_j.substring(2,3); 
    var r4=right_j.substring(3,4); 
    var r5=right_j.substring(4,5); 
    var r6=right_j.substring(5,6); 
    var r7=right_j.substring(6,7); 
    hap=hap+r1*8+r2*9+r3*2+r4*3+r5*4+r6*5; 
    hap=hap%11; 
    hap=11-hap; 
    hap=hap%10; 
    if(hap != r7) { 
        alert('주민등록번호가 잘못 입력되었습니다.'); 
        input2.focus(); 
        return true; 
    } 
    return false; 
} 

// 비밀번호 체크 
function check_passwd(input, input2, min) { 
    if(!input.value) { 
        alert('비밀번호를 입력해 주십시오.'); 
        input.focus(); 
        return false; 
    } 
    else if(BYTE(input.value) < min) { 
        alert('비밀번호의 길이가 너무 짧습니다.'); 
        input.focus(); 
        input.value=''; 
        input2.value=''; 
        return false; 
    } 
    else if(!input2.value) { 
        alert('확인비밀번호를 입력해 주십시오.'); 
        input2.focus(); 
        return false; 
    } 
    else if(input.value != input2.value) { 
        alert('비밀번호가 서로 다르게 입력되었습니다.'); 
        input2.value=''; 
        input2.focus(); 
        return false; 
    } 
    else return true; 
} 

//콤마 넣기(정수만 해당) 
function comma(val) { 
    val = get_number(val); 
    if(val.length <= 3) return val; 

    var loop = Math.ceil(val.length / 3); 
    var offset = val.length % 3; 

    if(offset==0) offset = 3; 
    var ret = val.substring(0, offset); 

    for(i=1;i<loop;i++) { 
        ret += "," + val.substring(offset, offset+3); 
        offset += 3; 
    } 
    return ret; 
} 

//문자열에서 숫자만 가져가기 
function get_number(str) { 
    var val = str; 
    var temp = ""; 
    var num = ""; 

    for(i=0; i<val.length; i++) { 
        temp = val.charAt(i); 
        if(temp >= "0" && temp <= "9") num += temp; 
    } 
    return num; 
} 

//주민등록번호를 나이로 변환 
function agechange(lno,rno) { 
    var refArray = new Array(18,19,19,20,20,16,16,17,17,18); 
    var refyy = rno.substring(0,1); 
    var refno = lno.substring(0,2); 
    var biryear = refArray[refyy] * 100 + eval(refno); 
     
    var nowDate = new Date(); 
    var nowyear = nowDate.getYear(); 
    return nowyear - biryear + 1; 
} 

//레디오박스 체크검사 
function radio_chk(input, msg) { 
    var len = input.length; 
    for(var i=0;i<len;i++) if(input[i].checked == true && input[i].value) return true; 
    alert(msg); 
    return false; 
} 

//셀렉트박스 체크검사 
function select_chk(input, msg) { 
    if(input[0].selected == true) { 
        alert(msg); 
        return false; 
    } 
    return true; 
} 

//새창띄우기 
function open_window(url, target, w, h, s) { 
    if(s) s = 'yes'; 
    else s = 'no'; 
    var its = window.open(url,target,'width='+w+',height='+h+',top=0,left=0,scrollbars='+s); 
    its.focus(); 
} 
//--> 

 

 

<? 
//셀렉트 
function optionlist($optionlist, $getvalue="", $keyfield="key", $valuefield="value") { 
    foreach($optionlist as $key => $value) { 
        if($getvalue && $getvalue == ${$keyfield}) $chk = "selected"; 
        else $chk = ""; 
        echo "<option value='{${$keyfield}}' {$chk}>{${$valuefield}}</option>"; 
    } 
    echo "\n"; 
} 

//셀렉티드 
function selected($checkkey, $getvalue="") { 
    echo "value='$checkkey'"; 
    if($getvalue && $checkkey == $getvalue) echo " selected"; 
} 

//체크드 
function checked($checkkey, $getvalue="") { 
    echo "value='$getvalue'"; 
    if($getvalue && $checkkey == $getvalue) echo " checked"; 
} 

//주민번호 검사 
function RegiNum($reginum) { 
    $weight = '234567892345'; // 자리수 weight 지정 
    $len = strlen($reginum); 
    $sum = 0; 

    if ($len <> 13) { return false; } 

    for ($i = 0; $i < 12; $i++) { 
        $sum = $sum + (substr($reginum,$i,1) * substr($weight,$i,1)); 
    } 

    $rst = $sum%11; 
    $result = 11 - $rst; 

    if ($result == 10) {$result = 0;} 
    else if ($result == 11) {$result = 1;} 

    $jumin = substr($reginum,12,1); 

    if ($result <> $jumin) {return false;} 
    return true; 
} 

//사업자번호 검사 
function comRegiNum($reginum) { 
    $weight = '137137135'; // 자리수 weight 지정 
    $len = strlen($reginum); 
    $sum = 0; 

    if ($len <> 10) { return false; } 

    for ($i = 0; $i < 9; $i++) { 
        $sum = $sum + (substr($reginum,$i,1) * substr($weight,$i,1)); 
    } 
    $sum = $sum + ((substr($reginum,8,1)*5)/10); 
    $rst = $sum%10; 

    if ($rst == 0) {$result = 0;} 
    else {$result = 10 - $rst;} 

    $saub = substr($reginum,9,1); 

    if ($result <> $saub) {return false;} 
    return true; 
} 


//글자르기 
function cut_str($msg,$cut_size,$tail="...") { 
    if($cut_size <= 0) return $msg; 
    $msg = strip_tags($msg); 
    $msg = str_replace("&mp;quot;","\"",$msg); 
    if(strlen($msg) <= $cut_size) return $msg; 

    for($i=0;$i<$cut_size;$i++) if(ord($msg[$i])>127) $han++; else $eng++; 
    if($han%2) $han--; 

    $cut_size = $han + $eng; 

    $tmp = substr($msg,0,$cut_size); 
    $tmp .= $tail; 
    return $tmp; 
} 

// 모든한글의 글자를 출력 
function hangul_code() { 
   $count = 0; 
   for($i = 0x81; $i <= 0xC8; $i++) { 
      for($j = 0x00; $j <= 0xFE; $j++) { 
         if(($j >= 0x00 && $j <= 0x40) || ($j >= 0x5B && $j <= 0x60) || ($j >= 0x7B && $j <= 0x80) || ($j >= 0x00 && $j <= 0x40) || 
           (($i >= 0xA1 && $i <=0xAF) && ($j >= 0xA1 && $j <= 0xFE)) || ($i == 0xC6 && ($j >= 0x53 && $j <= 0xA0)) || 
           ($i >= 0xC7 && ($j >= 0x41 && $j <= 0xA0))) continue; 
         echo chr($i).chr($j)." "; 
         $count++; 
      } 
   } 
   echo $count; 
} 

// 한글검사 
function is_han($str) { 
   if(strlen($str) != 2) return false; 

   $i = ord ($str[0]); 
   $j = ord ($str[1]); 

   if($i < 0x81 || $i > 0xC8 || $j > 0xFE || ($j >= 0x00 && $j <= 0x40) || ($j >= 0x5B && $j <= 0x60) || ($j >= 0x7B && $j <= 0x80) || 
     ($j >= 0x00 && $j <= 0x40) || (($i >= 0xA1 && $i <=0xAF) && ($j >= 0xA1 && $j <= 0xFE)) || 
     ($i == 0xC6 && ($j >= 0x53 && $j <= 0xA0)) || ($i >= 0xC7 && ($j >= 0x41 && $j <= 0xA0))) return false; 
   else return true; 
} 


// 랜덤값 생성 
function random_string($length) { 
    $randomcode = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 
                        'A', 'B', 'C', 'd', 'E', 'F', 'G', 'H', 'x', 'J', 
                        'K', 'b', 'M', 'N', 'y', 'P', 'r', 'R', 'S', 'T', 
                        'u', 'V', 'W', 'X', 'Y', 'Z'); 
    mt_srand((double)microtime()*1000000); 
    for($i=1;$i<=$length;$i++) $Rstring .= $randomcode[mt_rand(1, 36)]; 
    return $Rstring; 
} 


// 디렉토리 리스트 
function DirList($path="./") { 
    $path = opendir($path); 
    while($list = readdir($path)) if($list != "." && $list != "..") $Arraydir[] = $list; 
    closedir($path); 
    return $Arraydir; 
} 

// 15자리의 유일한 숫자값 만들기 
function uniquenumber() { 
    $temparray = explode(" ", microtime()); 
    $temparray2 = substr($temparray[0],2,5); 
    $number =$temparray[1].$temparray2; 
    return $number; 
} 

// 파일이름과 확장자 분리 
function ExplodeFile($filename) { 
    $filename = strtolower($filename); 
    $elements = explode('.',$filename); 
    $elemcnt  = count($elements)-1; 
    if(count($elements)==1) $ext = ''; 
    else $ext = $elements[$elemcnt]; 
    unset($elements[$elemcnt]); 
    $fname = implode($elements,''); 

    $fileinfo["name"] = $fname; 
    $fileinfo["ext"] = $ext; 
    return $fileinfo; 
} 

// 그림확장자 
function ImageType($filename) { 
    $webimg = explodefile($filename); 

    $webext = $webimg["ext"]; 
    $defineexp = array("gif","jpg","png"); 

    $count = count($defineexp); 

    for($i=0;$i<$count;$i++) { 
        if($defineexp[$i] == $webext) return true; 
    } 
    return false; 
} 

// 유닉스날짜 포맷 
function date_format($unixtime,$format="Y.m.d",$empty=" ") { 
    if($unixtime) return date($format, $unixtime); 
    else return $empty; 
} 

//YYYY-MM-DD 형식을 유닉스 타임으로 
function unix_format($times, $operator="-", $type=true) { 
    if($type == true) { 
        $times = trim($times); 
        $arry = explode($operator,$times); 
        if(count($arry) != 3) return date_format(0); 
        $mktime = mktime(0,0,0,$arry[1],$arry[2],$arry[0]); 
        return date("U", $mktime); 
    } else { 
        $formats = "Y{$operator}m{$operator}d"; 
        return date($formats, $times); 
    } 
} 

// 주민등록번호 포맷 
function jumin_format($juminno, $cutno=3, $des="x", $empty=" ") { 
    $juminno = str_replace("-","",$juminno); 
    if(strlen($juminno) != 13) return $empty; 
    for($i=0;$i<$cutno;$i++) $x .= $des; 
    $juminno = substr($juminno,0,13-$cutno).$x; 
    $juminno = substr($juminno,0,6)."-".substr($juminno,6); 
    return $juminno; 
} 

// 홈페이지 포맷 
function url_format($url, $ltype=false, $title=false, $other="", $htype="http://", $empty=" ") { 
    $url = eregi_replace("http://","",trim($url)); 
    if($url) $url = $htype.$url; 
    else return $empty; 
     
    if($title) $turl = $title; 
    else $turl = $url; 

    if($ltype) return "<a href='{$url}' {$other}>{$turl}</a>"; 
    else return $url; 
} 

// 전송값 초기화 
function post_format($str, $type) { 
    switch($type) { 
        case "url": 
            $str = trim($str); 
            $str = eregi_replace("http://","",$str); 
            break; 
        case "num": 
            $str = trim($str); 
            $str = str_replace(",","",$str); 
            break; 
    } 
    return $str; 
} 

// 이메일 포맷 
function mail_format($email, $ltype=false, $title=false, $empty=" ") { 
    $email = trim($email); 
    $title = trim($title); 

    if(!$email && !$title) return $empty; 
    else if(!$email) return $title; 

    if($title) $temail = $title; 
    else $temail = $email; 

    if($ltype) return "<a href='mailto:{$email}'>{$temail}</a>"; 
    else return $email; 
} 

// 전화번호 포맷 
function tel_format($num1, $num2, $num3, $format="-", $empty=" ") { 
    $num1 = trim($num1); 
    $num2 = trim($num2); 
    $num3 = trim($num3); 
     
    if(!$num1) $num1 = "02"; 

    if($num2 && $num3) return $num1.$format.$num2.$format.$num3; 
    else return $empty; 
} 

// 문자 포맷 
function text_format($str, $empty=" ") { 
    $str = trim($str); 
    if($str) return $str; 
    else return $empty; 
} 

// 새창띄우기 
function win_format($title, $url, $target, $width, $height, $scrollbars=1, $empty) { 
    $title = text_format($title, $empty); 
    return "<a href='#' onclick=\"open_window('{$url}', '{$target}', {$width}, {$height}, {$scrollbars})\">{$title}</a>"; 
} 

// 나이(주민등록번호를 이용) 
function AGE_jumin($lno,$rno) { 
    $refArray = Array(18,19,19,20,20,16,16,17,17,18); 
    $refyy = substr($rno,0,1); 
     
    $biryear = $refArray[$refyy] * 100 + substr($lno,0,2); 
    $nowyear = date("Y"); 
    return $nowyear - $biryear + 1; 
} 

// URL 존재확인 
function URL_exists($url) { 
    $url = str_replace("http://", "", $url); 
    list($domain, $file) = explode("/", $url, 2); // 도메인부분과 주소부분으로 나눕니다. 
    $fid = fsockopen($domain, 80); // 도메인을 오픈합니다. 
        fputs($fid, "GET /$file HTTP/1.0\r\nHost: $domain\r\n\r\n"); // 파일 정보를 얻습니다. 
        $gets = fgets($fid, 128); 
    fclose($fid); 

    if(ereg("200 OK", $gets)) return TRUE; 
    else return FALSE; 
} 

// 조사 꾸미기 
$array = "뵤 벼 뱌 배 베 보 버 바 비 뷰 부 브 뱨 볘 봐 봬 붜 붸 뵈 뷔 븨 뾰 뼈 뺘 빼 뻬 뽀 뻐 빠 삐 쀼 뿌 쁘 뺴 뼤 뽜 뽸 뿨 쀄 뾔 쀠 쁴 죠 져 쟈 재 제 조 저 자 지 쥬 주 즈 쟤 졔 좌 좨 줘 줴 죄 쥐 즤 쬬 쪄 쨔 째 쩨 쪼 쩌 짜 찌 쮸 쭈 쯔 쪠 쪠 쫘 쫴 쭤 쮀 쬐 쮜 쯰 됴 뎌 댜 대 데 도 더 다 디 듀 두 드 댸 뎨 돠 돼 둬 뒈 되 뒤 듸 뚀 뗘 땨 때 떼 또 떠 따 띠 뜌 뚜 뜨 떄 뗴 똬 뙈 뚸 뛔 뙤 뛰 띄 교 겨 갸 개 게 고 거 가 기 규 구 그 걔 계 과 괘 궈 궤 괴 귀 긔 꾜 껴 꺄 깨 께 꼬 꺼 까 끼 뀨 꾸 끄 꺠 꼐 꽈 꽤 꿔 꿰 꾀 뀌 끠 쇼 셔 샤 새 세 소 서 사 시 슈 수 스 섀 셰 솨 쇄 숴 쉐 쇠 쉬 싀 쑈 쎠 쌰 쌔 쎄 쏘 써 싸 씨 쓔 쑤 쓰 썌 쎼 쏴 쐐 쒀 쒜 쐬 쒸 씌 묘 며 먀 매 메 모 머 마 미 뮤 무 므 먜 몌 뫄 뫠 뭐 뭬 뫼 뮈 믜 뇨 녀 냐 내 네 노 너 나 니 뉴 누 느 냬 녜 놔 놰 눠 눼 뇌 뉘 늬 요 여 야 애 에 오 어 아 이 유 우 으 얘 예 와 왜 워 웨 외 위 의 료 려 랴 래 레 로 러 라 리 류 루 르 럐 례 롸 뢔 뤄 뤠 뢰 뤼 릐 효 혀 햐 해 헤 호 허 하 히 휴 후 흐 햬 혜 화 홰 훠 훼 회 휘 희 쿄 켜 캬 캐 케 코 커 카 키 큐 쿠 크 컈 켸 콰 쾌 쿼 퀘 쾨 퀴 킈 툐 텨 탸 태 테 토 터 타 티 튜 투 트 턔 톄 톼 퇘 퉈 퉤 퇴 튀 틔 쵸 쳐 챠 채 체 초 처 차 치 츄 추 츠 챼 쳬 촤 쵀 춰 췌 최 취 츼 표 펴 퍄 패 페 포 퍼 파 피 퓨 푸 프 퍠 폐 퐈 퐤 풔 풰 푀 퓌 픠"; 
function lastCon($str) { 
    global $array; 
    if(ord($str[strlen($str)-1]) < 128) return false; 
    $str = substr($str, strlen($str)-2); 
    if(strstr($array, $str)) return false; 
    return true; 
} 
function ul_rul($str) { 
    return $str.(lastCon($str) ? "을" : "를"); 
} 
function gwa_wa($str) { 
    return $str.(lastCon($str) ? "과" : "와"); 
} 
function un_num($str) { 
    return $str.(lastCon($str) ? "은" : "는"); 
} 
function i_ga($str) { 
    return $str.(lastCon($str) ? "이" : "가"); 
} 

// 도메인 또는 문서가 존재하는지 검사 
function exists_url($url, $port="80") { 
    $fp = @fsockopen($url, $port); 
    if($fp) return true; 
    else return false; 
} 

// 숫자를 한글로 바꾸기 
function numtokor($num) { 
    $text =''; 
    $d_symbol = array('4'  => "만", '8'  => "억", '12' => "조", '16' => "경", '20' => "해", '24' => "시", '28' => "양", '32' => "구", '36' => "간", '40' => "정", '44' => "재", '48' => "극", '52' => "항하사", '56' => "아승지", '60' => "나유타", '64' => "불가사의", '68' => "무량대수"); 
    $p_symbol = array('0'  => "", '1'  => "십", '2'  => "백", '3'  => "천"); 
    $t_symbol = array('0'  => "", '1'  => "일", '2'  => "이", '3'  => "삼", '4'  => "사", '5'  => "오", '6'  => "육", '7'  => "칠", '8'  => "팔", '9'  => "구");         

    if(substr($num,0,1) == '-') { 
        $num = substr($num ,1); 
        $text .= '마이너스'; 
    } 
    $length_of_num = strlen($num); 
    if($length_of_num > 72) { 
        $text = "존재할 수 없는 수치 입니다."; 
    } else { 
        //실행 
        for ($k=0; $k< $length_of_num; $k++) { 
            $striped_value = substr($num, $k, 1); 
            $text .= $t_symbol[$striped_value];               
            $power_value = ($length_of_num - $k -1) % 4; 
            if ($striped_value <> 0) $text .= $p_symbol[$power_value]; 
            if ($power_value == 0) $text .= $d_symbol[$length_of_num - $k -1];               
        } 
    } 
    return $text; 
} 

//검색쿼리작성 
function querystring($query) { 
    if($query) { 
        $queryarray = explode("&", $query); 
        $count = count($queryarray); 

        foreach($queryarray as $key => $value) { 
            $array2st = explode("=", $value); 
            if($array2st[1]) { 
                if($querystring) $querystring .= "&".$value; 
                else $querystring = $value; 
            } 
        } 

        return $querystring; 
    } 
    else return ""; 
} 

//페이징 
function pagelist($tables, $nowpage, $primarykey , $chartline, $chartpage, $wheres="", $findquery="", $others="", $orders="", $urlquery="", $lastopt=true, $allopt=true,  $firstbutton="[처음]", $prebutton="[이전]", $nextbutton="[다음]",$lastbutton="[끝]") { 
     
    if($wheres) $wheres  = " where {$wheres} "; 
    if($others) $wheres .= " and {$others} "; 

    if(!$chartline) $chartline = 10; 
    if(!$chartpage) $chartpage = 10; 
     
    if(intval($nowpage) == 0) $nowpage = 1; 
    if(intval($nowstep) == 0) $nowstep = 1; 
     
    ##마지막버튼 유무 체크 
    if($lastopt) { 
        $query  = "select count(*) count from {$tables} {$wheres} {$others} {$findquery}"; 
        $result = mysql_query($query); 
        $total  = mysql_fetch_object($result); 
        #총카운트 $total->count; 
    } 

    ##총검색수 
    if($allopt) { 
        $query  = "select count(*) count from {$tables} {$wheres}"; 
        $result = mysql_query($query); 
        $all    = mysql_fetch_object($result); 
        #총검색수 $all->count; 
    } 
     
    ##설정값계산 
    $nowstep = ceil($nowpage/$chartpage); 
    if($lastopt) { 
        $allstep = ceil($total->count/($chartpage*$chartline)); 
        $allpage = ceil($total->count/$chartline); 
    } 
    $startpage = 1 + ($nowstep-1) * $chartpage; 
    $endpage = $startpage + $chartpage - 1; 
     
    if($lastopt && $endpage > $allpage) $endpage = $allpage; 
     
    ##다음버튼 유무 체크 
    $nextline = $nowstep * $chartline * $chartpage; 
    $nextlimitquery = " limit {$nextline}, 1"; 
    $query  = "select {$primarykey} from {$tables} {$wheres} {$others} {$findquery} {$nextlimitquery}"; 
    $result = mysql_query($query); 
    $nextok = mysql_affected_rows(); 

    ##처음버튼 및 이전버튼 
    if($nowstep > 1) { 
        $fir = " <a href='$PHP_SELF?$urlquery&nowpage=1'>{$firstbutton}</a> "; 
        $prepage = $startpage - $chartpage; 
        $pre = " <a href='$PHP_SELF?$urlquery&nowpage=$prepage'>{$prebutton}</a> "; 
    } else { 
        $fir = " <font color='#C0C0C0'>{$firstbutton}</font> "; 
        $pre = " <font color='#C0C0C0'>{$prebutton}</font> "; 
    } 
     
    ##NEXT 버튼 활성화 
    if($nextok) { 
        $nextpage = $endpage + 1; 
        $next = " <a href='$PHP_SELF?$urlquery&nowpage=$nextpage'>{$nextbutton}</a> "; 
    } else { 
        $next = " <font color='#C0C0C0'>{$nextbutton}</font> "; 
    } 
     
    ##중간페이지 
    for($i=$startpage;$i<=$endpage;$i++) { 
        if($i == $nowpage) $pagelist .= " <font color='#6600FF'><b>$i</b></font> "; 
        else $pagelist .= " <a href='$PHP_SELF?$urlquery&nowpage=$i'>$i</a> "; 
    } 
     
    ##끝페이지 
    if($lastopt && $allstep > $nowstep) { 
        $lastpage = $allpage; 
        $last = " <a href='$PHP_SELF?$urlquery&nowpage=$nextpage'>{$lastbutton}</a> "; 
    } else { 
        $last = " <font color='#C0C0C0'>{$lastbutton}</font> "; 
    } 
     
     
    $firstlimit = 0 + ($nowpage-1) * $chartline; 
    $limitquery = " limit {$firstlimit}, {$chartline}"; 
    $query  = "select * from {$tables} {$wheres} {$others} {$findquery} {$orders} {$limitquery}"; 
    $result = mysql_query($query); 
    while($fetch  = mysql_fetch_array($result)) $get[] = $fetch; 
     
    $get[0]["count"] = count($get); 
    $get[0]["page"] = $fir.$pre." [ ".$pagelist." ] ".$next.$last; 
    if($lastopt) $get[0]["total"] = $total->count; 
    if($allopt)  $get[0]["allto"] = $all->count; 

    return $get; 

} 

//업로드 
function file_upload($upfile,$upfile_name,$upfile_size,$dir,$newfilename) { 
    if($upfile_size) { 
         
        $is_file = is_file("{$dir}/{$newfilename}"); 
        if($is_file) unlink("{$dir}/{$newfilename}"); 

        move_uploaded_file($upfile, "{$dir}/{$newfilename}"); 
        chmod("{$dir}/{$newfilename}", 0644); 
         
        return true; 
     
    } else return false; 
} 

//현재디렉토리 
function nowdir() { 
    global $DOCUMENT_ROOT; 
    global $PHP_SELF; 
    $getdir = pathinfo($DOCUMENT_ROOT.$PHP_SELF); 
    return $getdir["dirname"]; 
} 

