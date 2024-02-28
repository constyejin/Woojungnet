<!-- 

var n4 = (document.layers)?true:false; 
var e4 = (document.all)?true:false; 

//¼ıÀÚ¸¸ÀÔ·Â(onKeypress='return keyCheckdot(event)') 
function keyCheck(e) { 
    if(n4) var keyValue = e.which 
    else if(e4) var keyValue = event.keyCode 
    if (((keyValue >= 48) && (keyValue <= 57))  || keyValue==13) return true; 
    else return false 
} 

//¼ıÀÚ¹×µ¾Æ®ÀÔ·Â(onKeypress='return keyCheckdot(event)') 
function keyCheckDot(e) { 
    if(n4) var keyValue = e.which 
    else if(e4) var keyValue = event.keyCode 
    if (((keyValue >= 48) && (keyValue <= 57)) || keyValue==13 || keyValue==46) return true; 
    else return false 
} 

//°ø¹éÁ¦°Å 
function Trim(string) { 
    for(;string.indexOf(" ")!= -1;){ 
        string=string.replace(" ","") 
    } 
    return string; 
} 

//ÀÔ·Â°Ë»ç 
function Exists(input,types) { 
    if(types) if(!Trim(input.value)) return false; 
    return true; 
} 

//¿µ¹®°Ë»ç+¼ıÀÚ°Ë»ç(Ã¹±ÛÀÚ´Â ¹İµå½Ã¿µ¹®) 
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

//¿µ¹®°Ë»ç+¼ıÀÚ°Ë»ç 
function EngNumAll(input,types) { 
    if(types) if(!Trim(input.value)) return false; 
    var error_c=0, i, val; 
    for(i=0;i<Byte(input.value);i++) { 
        val = input.value.charAt(i); 
        if(!((val>=0 && val<=9) || (val>='a' && val<='z') || (val>='A' && val<='Z'))) return false; 
   } 
   return true; 
} 

//¿µ¹®°Ë»ç+¼ıÀÚ°Ë»ç+'_' 
function EngNumAll2(input,types) { 
    if(types) if(!Trim(input.value)) return false; 
    var error_c=0, i, val; 
    for(i=0;i<Byte(input.value);i++) { 
        val = input.value.charAt(i); 
        if(!((val>=0 && val<=9) || (val>='a' && val<='z') || (val>='A' && val<='Z') || val=='_')) return false; 
   } 
   return true; 
} 

//¿µ¹®°Ë»ç 
function Eng(input,types) { 
    if(types) if(!Trim(input.value)) return false; 
    var error_c=0, i, val; 
    for(i=0;i<Byte(input.value);i++) { 
        val = input.value.charAt(i); 
        if(!((val>='a' && val<='z') || (val>='A' && val<='Z'))) return false; 
   } 
   return true; 
} 

//¼ıÀÚ¸¸ÀÔ·Â 
/* 
function numberonlyinput() { 
    var ob = event.srcElement; 
    ob.value = noSplitAndNumberOnly(ob); 
    return false; 
} 
*/ 

//µ·(3´ÜÀ§¸¶´Ù ÄÄ¸¶¸¦ ºÙÀÎ´Ù.) 
function checkNumber() { 
    var ob=event.srcElement; 
    ob.value = filterNum(ob.value); 
    ob.value = commaSplitAndNumberOnly(ob); 
    return false; 
} 

//ÇÑÁ¤¾×(ÀÏÁ¤±İ¾× ÀÌ»óÀÌ µÇ¸é ¿Ã¶ó±âÁö ¾Ê°Ô ÇÑ´Ù.) 
function chkhando(money) { 
    var ob=event.srcElement; 
    ob.value = noSplitAndNumberOnly(ob); 
    if(ob.value > money) ob.value = money; 
    return false; 
} 

//ÀÌÀÚÀ²(¼Ò¼öÁ¡ »ç¿ë°¡´É) 
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

//ÂüÁ¶ÇÔ¼ö 
function filterNum(str) { 
        re = /^\$|,/g; 
        return str.replace(re, ""); 
} 

//ÂüÁ¶ÇÔ¼ö(ÄÄ¸¶ºÒ°¡) 
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

//ÂüÁ¶ÇÔ¼ö(ÄÄ¸¶°¡´É) 
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

//¼ıÀÚ¸¸°¡´É 
function noSplitAndNumberOnly(ob) { 
    var txtNumber = '' + ob.value; 
    if (isNaN(txtNumber) || txtNumber.indexOf('.') != -1 ) { 
        ob.value = ob.value.substring(0, ob.value.length-1 ); 
        ob.focus(); 
        return ob.value; 
    } 
    else return ob.value; 
} 


//¹ÙÀÌÆ®°Ë»ç 
function Byte(input) { 
    var i, j=0; 
    for(i=0;i<input.length;i++) { 
        val=escape(input.charAt(i)).length; 
        if(val==  6) j++; 
        j++; 
    } 
    return j; 
} 

//ÆË¾÷¸Ş´º 
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


//ÆäÀÌÁöÀÌµ¿ 
function move(url) { 
    location.href = url; 
} 

//´İ±â 
function toclose() { 
    self.close(); 
} 

//À§Ä¡º¯°æ 
function winsize(w,h,l,t) { 
    if(window.opener) resizeTo(w,h); 
} 

//Æ÷Ä¿½ºÀ§Ä¡ 
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

// ³¯Â¥,½Ã°£ format ÇÔ¼ö = phpÀÇ date() 
function date(arg_format, arg_date) { 
       if(!arg_date) arg_date = new Date(); 

       var M = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"); 
       var F = new Array("January","February","March","April","May","June","July","August","September","October","November","December"); 
       var K = new Array("ÀÏ","¿ù","È­","¼ö","¸ñ","±İ","Åä"); 
       var k = new Array("ìí","êÅ","ûı","â©","ÙÊ","Ğİ","÷Ï"); 
       var D = new Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat"); 
       var l = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"); 
       var o = new Array("Àü","ÈÄ"); 
       var O = new Array("¿ÀÀü","¿ÀÈÄ"); 
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

// ÇØ»óµµ¿¡ ¸Â´Â Å©±â »ç¿ë 
function screensize() { 
    self.moveTo(0,0); 
    self.resizeTo(screen.availWidth,screen.availHeight); 
} 

// ÁÖ¹Îµî·Ï¹øÈ£Ã¼Å©( ÀÔ·ÂÆû 1°³) 
function check_jumin(jumin) { 
    var weight = "234567892345"; // ÀÚ¸®¼ö weight ÁöÁ¤ 
    var val = jumin.replace("-",""); // "-"(ÇÏÀÌÇÂ) Á¦°Å 
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

// ÁÖ¹Îµî·Ï¹øÈ£Ã¼Å©( ÀÔ·ÂÆû 2°³) 
function check_jumin2(input, input2) { 
    input.value=Trim(input.value); 
    input2.value=Trim(input2.value); 
    var left_j=input.value; 
    var right_j=input2.value; 
    if(input.value.length != 6) { 
        alert('ÁÖ¹Îµî·Ï¹øÈ£¸¦ Á¤È®È÷ ÀÔ·ÂÇÏ¼¼¿ä.'); 
        input.focus(); 
        return true; 
    } 
    if(right_j.length != 7) { 
        alert('ÁÖ¹Îµî·Ï¹øÈ£¸¦ Á¤È®È÷ ÀÔ·ÂÇÏ¼¼¿ä.'); 
        input2.focus(); 
        return true; 
    } 
    var i2=0; 
    for(var i=0;i<left_j.length;i++) { 
        var temp=left_j.substring(i,i+1); 
        if(temp<0 || temp>9)  i2++; 
    } 
    if((left_j==  '') || (i2 != 0)) { 
        alert('ÁÖ¹Îµî·Ï¹øÈ£°¡ Àß¸ø ÀÔ·ÂµÇ¾ú½À´Ï´Ù.'); 
        j_left.focus(); 
        return true; 
    } 
    var i3=0; 
    for(var i=0;i<right_j.length;i++) { 
        var temp=right_j.substring(i,i+1); 
        if (temp<0 || temp>9) i3++; 
    } 
    if((right_j==  '') || (i3 != 0)) { 
        alert('ÁÖ¹Îµî·Ï¹øÈ£°¡ Àß¸ø ÀÔ·ÂµÇ¾ú½À´Ï´Ù.'); 
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
        alert('ÁÖ¹Îµî·Ï¹øÈ£°¡ Àß¸ø ÀÔ·ÂµÇ¾ú½À´Ï´Ù.'); 
        input2.focus(); 
        return true; 
    } 
    return false; 
} 

// ºñ¹Ğ¹øÈ£ Ã¼Å© 
function check_passwd(input, input2, min) { 
    if(!input.value) { 
        alert('ºñ¹Ğ¹øÈ£¸¦ ÀÔ·ÂÇØ ÁÖ½Ê½Ã¿À.'); 
        input.focus(); 
        return false; 
    } 
    else if(BYTE(input.value) < min) { 
        alert('ºñ¹Ğ¹øÈ£ÀÇ ±æÀÌ°¡ ³Ê¹« Âª½À´Ï´Ù.'); 
        input.focus(); 
        input.value=''; 
        input2.value=''; 
        return false; 
    } 
    else if(!input2.value) { 
        alert('È®ÀÎºñ¹Ğ¹øÈ£¸¦ ÀÔ·ÂÇØ ÁÖ½Ê½Ã¿À.'); 
        input2.focus(); 
        return false; 
    } 
    else if(input.value != input2.value) { 
        alert('ºñ¹Ğ¹øÈ£°¡ ¼­·Î ´Ù¸£°Ô ÀÔ·ÂµÇ¾ú½À´Ï´Ù.'); 
        input2.value=''; 
        input2.focus(); 
        return false; 
    } 
    else return true; 
} 

//ÄŞ¸¶ ³Ö±â(Á¤¼ö¸¸ ÇØ´ç) 
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

//¹®ÀÚ¿­¿¡¼­ ¼ıÀÚ¸¸ °¡Á®°¡±â 
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

//ÁÖ¹Îµî·Ï¹øÈ£¸¦ ³ªÀÌ·Î º¯È¯ 
function agechange(lno,rno) { 
    var refArray = new Array(18,19,19,20,20,16,16,17,17,18); 
    var refyy = rno.substring(0,1); 
    var refno = lno.substring(0,2); 
    var biryear = refArray[refyy] * 100 + eval(refno); 
     
    var nowDate = new Date(); 
    var nowyear = nowDate.getYear(); 
    return nowyear - biryear + 1; 
} 

//·¹µğ¿À¹Ú½º Ã¼Å©°Ë»ç 
function radio_chk(input, msg) { 
    var len = input.length; 
    for(var i=0;i<len;i++) if(input[i].checked == true && input[i].value) return true; 
    alert(msg); 
    return false; 
} 

//¼¿·ºÆ®¹Ú½º Ã¼Å©°Ë»ç 
function select_chk(input, msg) { 
    if(input[0].selected == true) { 
        alert(msg); 
        return false; 
    } 
    return true; 
} 

//»õÃ¢¶ç¿ì±â 
function open_window(url, target, w, h, s) { 
    if(s) s = 'yes'; 
    else s = 'no'; 
    var its = window.open(url,target,'width='+w+',height='+h+',top=0,left=0,scrollbars='+s); 
    its.focus(); 
} 
//--> 

 

 

<? 
//¼¿·ºÆ® 
function optionlist($optionlist, $getvalue="", $keyfield="key", $valuefield="value") { 
    foreach($optionlist as $key => $value) { 
        if($getvalue && $getvalue == ${$keyfield}) $chk = "selected"; 
        else $chk = ""; 
        echo "<option value='{${$keyfield}}' {$chk}>{${$valuefield}}</option>"; 
    } 
    echo "\n"; 
} 

//¼¿·ºÆ¼µå 
function selected($checkkey, $getvalue="") { 
    echo "value='$checkkey'"; 
    if($getvalue && $checkkey == $getvalue) echo " selected"; 
} 

//Ã¼Å©µå 
function checked($checkkey, $getvalue="") { 
    echo "value='$getvalue'"; 
    if($getvalue && $checkkey == $getvalue) echo " checked"; 
} 

//ÁÖ¹Î¹øÈ£ °Ë»ç 
function RegiNum($reginum) { 
    $weight = '234567892345'; // ÀÚ¸®¼ö weight ÁöÁ¤ 
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

//»ç¾÷ÀÚ¹øÈ£ °Ë»ç 
function comRegiNum($reginum) { 
    $weight = '137137135'; // ÀÚ¸®¼ö weight ÁöÁ¤ 
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


//±ÛÀÚ¸£±â 
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

// ¸ğµçÇÑ±ÛÀÇ ±ÛÀÚ¸¦ Ãâ·Â 
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

// ÇÑ±Û°Ë»ç 
function is_han($str) { 
   if(strlen($str) != 2) return false; 

   $i = ord ($str[0]); 
   $j = ord ($str[1]); 

   if($i < 0x81 || $i > 0xC8 || $j > 0xFE || ($j >= 0x00 && $j <= 0x40) || ($j >= 0x5B && $j <= 0x60) || ($j >= 0x7B && $j <= 0x80) || 
     ($j >= 0x00 && $j <= 0x40) || (($i >= 0xA1 && $i <=0xAF) && ($j >= 0xA1 && $j <= 0xFE)) || 
     ($i == 0xC6 && ($j >= 0x53 && $j <= 0xA0)) || ($i >= 0xC7 && ($j >= 0x41 && $j <= 0xA0))) return false; 
   else return true; 
} 


// ·£´ı°ª »ı¼º 
function random_string($length) { 
    $randomcode = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 
                        'A', 'B', 'C', 'd', 'E', 'F', 'G', 'H', 'x', 'J', 
                        'K', 'b', 'M', 'N', 'y', 'P', 'r', 'R', 'S', 'T', 
                        'u', 'V', 'W', 'X', 'Y', 'Z'); 
    mt_srand((double)microtime()*1000000); 
    for($i=1;$i<=$length;$i++) $Rstring .= $randomcode[mt_rand(1, 36)]; 
    return $Rstring; 
} 


// µğ·ºÅä¸® ¸®½ºÆ® 
function DirList($path="./") { 
    $path = opendir($path); 
    while($list = readdir($path)) if($list != "." && $list != "..") $Arraydir[] = $list; 
    closedir($path); 
    return $Arraydir; 
} 

// 15ÀÚ¸®ÀÇ À¯ÀÏÇÑ ¼ıÀÚ°ª ¸¸µé±â 
function uniquenumber() { 
    $temparray = explode(" ", microtime()); 
    $temparray2 = substr($temparray[0],2,5); 
    $number =$temparray[1].$temparray2; 
    return $number; 
} 

// ÆÄÀÏÀÌ¸§°ú È®ÀåÀÚ ºĞ¸® 
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

// ±×¸²È®ÀåÀÚ 
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

// À¯´Ğ½º³¯Â¥ Æ÷¸Ë 
function date_format($unixtime,$format="Y.m.d",$empty=" ") { 
    if($unixtime) return date($format, $unixtime); 
    else return $empty; 
} 

//YYYY-MM-DD Çü½ÄÀ» À¯´Ğ½º Å¸ÀÓÀ¸·Î 
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

// ÁÖ¹Îµî·Ï¹øÈ£ Æ÷¸Ë 
function jumin_format($juminno, $cutno=3, $des="x", $empty=" ") { 
    $juminno = str_replace("-","",$juminno); 
    if(strlen($juminno) != 13) return $empty; 
    for($i=0;$i<$cutno;$i++) $x .= $des; 
    $juminno = substr($juminno,0,13-$cutno).$x; 
    $juminno = substr($juminno,0,6)."-".substr($juminno,6); 
    return $juminno; 
} 

// È¨ÆäÀÌÁö Æ÷¸Ë 
function url_format($url, $ltype=false, $title=false, $other="", $htype="http://", $empty=" ") { 
    $url = eregi_replace("http://","",trim($url)); 
    if($url) $url = $htype.$url; 
    else return $empty; 
     
    if($title) $turl = $title; 
    else $turl = $url; 

    if($ltype) return "<a href='{$url}' {$other}>{$turl}</a>"; 
    else return $url; 
} 

// Àü¼Û°ª ÃÊ±âÈ­ 
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

// ÀÌ¸ŞÀÏ Æ÷¸Ë 
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

// ÀüÈ­¹øÈ£ Æ÷¸Ë 
function tel_format($num1, $num2, $num3, $format="-", $empty=" ") { 
    $num1 = trim($num1); 
    $num2 = trim($num2); 
    $num3 = trim($num3); 
     
    if(!$num1) $num1 = "02"; 

    if($num2 && $num3) return $num1.$format.$num2.$format.$num3; 
    else return $empty; 
} 

// ¹®ÀÚ Æ÷¸Ë 
function text_format($str, $empty=" ") { 
    $str = trim($str); 
    if($str) return $str; 
    else return $empty; 
} 

// »õÃ¢¶ç¿ì±â 
function win_format($title, $url, $target, $width, $height, $scrollbars=1, $empty) { 
    $title = text_format($title, $empty); 
    return "<a href='#' onclick=\"open_window('{$url}', '{$target}', {$width}, {$height}, {$scrollbars})\">{$title}</a>"; 
} 

// ³ªÀÌ(ÁÖ¹Îµî·Ï¹øÈ£¸¦ ÀÌ¿ë) 
function AGE_jumin($lno,$rno) { 
    $refArray = Array(18,19,19,20,20,16,16,17,17,18); 
    $refyy = substr($rno,0,1); 
     
    $biryear = $refArray[$refyy] * 100 + substr($lno,0,2); 
    $nowyear = date("Y"); 
    return $nowyear - $biryear + 1; 
} 

// URL Á¸ÀçÈ®ÀÎ 
function URL_exists($url) { 
    $url = str_replace("http://", "", $url); 
    list($domain, $file) = explode("/", $url, 2); // µµ¸ŞÀÎºÎºĞ°ú ÁÖ¼ÒºÎºĞÀ¸·Î ³ª´¯´Ï´Ù. 
    $fid = fsockopen($domain, 80); // µµ¸ŞÀÎÀ» ¿ÀÇÂÇÕ´Ï´Ù. 
        fputs($fid, "GET /$file HTTP/1.0\r\nHost: $domain\r\n\r\n"); // ÆÄÀÏ Á¤º¸¸¦ ¾ò½À´Ï´Ù. 
        $gets = fgets($fid, 128); 
    fclose($fid); 

    if(ereg("200 OK", $gets)) return TRUE; 
    else return FALSE; 
} 

// Á¶»ç ²Ù¹Ì±â 
$array = "ºÌ º­ ¹ò ¹è º£ º¸ ¹ö ¹Ù ºñ ºä ºÎ ºê “ º¶ ºÁ ºÄ ºÛ ºŞ ºÆ ºß •‘ »Ï »À »² »© »¾ »Ç »µ ºü »ß »Ø »Ñ »Ú •û –§ –Ø –ô —¨ —Ä »Î —à ˜u ÁÒ Á® Àğ Àç Á¦ Á¶ Àú ÀÚ Áö Áê ÁÖ Áî À÷ Áµ ÁÂ ÁÈ Áà Áâ ÁË Áã £p §c ÂÇ Â¹ Â° ÂÅ ÂÉ Â¼ Â¥ Âî Âé ÂŞ Âê ¥™ ¥™ ÂÒ ÂÖ Âå ¨R ÂØ Âè ©n µÍ µ® ´ô ´ë µ¥ µµ ´õ ´Ù µğ µà µÎ µå ˆÛ µ³ µÂ µÅ µÖ µØ µÇ µÚ µï ŒÃ ¶Å ‹x ¶§ ¶¼ ¶Ç ¶° µû ¶ì  ¶Ñ ¶ß ‹š ‹ó ¶Ì ¶Î Œô ¶Ø ¶Ï ¶Ù ¶ç ±³ °Ü °¼ °³ °Ô °í °Å °¡ ±â ±Ô ±¸ ±× °Â °è °ú ±¥ ±Å ±Ë ±« ±Í ±á ²Ø ²¸ ²¥ ±ú ²² ²¿ ²¨ ±î ³¢ ²ó ²Ù ²ô ƒÆ ²¾ ²Ê ²Ï ²ã ²ç ²Ò ²î …Ê ¼î ¼Å »ş »õ ¼¼ ¼Ò ¼­ »ç ½Ã ½´ ¼ö ½º ¼¨ ¼Î ¼İ ¼â ½¤ ½¦ ¼è ½¬ šÃ ¾¤ ›Ç ›X ½Ø ½ê ½î ½á ½Î ¾¾ o ¾¥ ¾² ›y ›ã ½÷ ½û ¾¬ ¾® ½ı ¾¯ ¾º ¹¦ ¸ç ¸Ï ¸Å ¸Ş ¸ğ ¸Ó ¸¶ ¹Ì ¹Â ¹« ¹Ç Ù ¸ï ¸ú ‘À ¹¹ ¹¾ ¸ş ¹¿ ’Ş ´¢ ³à ³Ä ³» ³× ³ë ³Ê ³ª ´Ï ´º ´© ´À †v ³é ³ö ‡R ´² ´´ ³ú ´µ ´Ì ¿ä ¿© ¾ß ¾Ö ¿¡ ¿À ¾î ¾Æ ÀÌ À¯ ¿ì À¸ ¾ê ¿¹ ¿Í ¿Ö ¿ö ¿ş ¿Ü À§ ÀÇ ·á ·Á ·ª ·¡ ·¹ ·Î ·¯ ¶ó ¸® ·ù ·ç ¸£ m ·Ê ·Ö O ·ï ·ñ ·Ú ·ò l È¿ Çô Çá ÇØ Çì È£ Çã ÇÏ È÷ ÈŞ ÈÄ Èå Á… Çı È­ È³ ÈÌ ÈÑ È¸ ÈÖ Èñ Äì ÄÑ Ä¼ Ä³ ÄÉ ÄÚ Ä¿ Ä« Å° Å¥ Äí Å© °m ÄÙ Äâ Äè Äõ Äù Äê Äû ´” Åô Åß ÅË ÅÂ Å× Åä ÅÍ Å¸ Æ¼ Æ© Åõ Æ® ¶O Åâ Åí Åï Åı Æ¡ Åğ Æ¢ Æ· Ãİ ÃÄ Ã­ Ã¤ Ã¼ ÃÊ Ã³ Â÷ Ä¡ Ãò Ãß Ã÷ ª‰ ÃÇ ÃÒ ¬‚ Ãç Ãé ÃÖ Ãë ¯M Ç¥ Æì ÆÙ ÆĞ Æä Æ÷ ÆÛ ÆÄ ÇÇ Ç» Çª ÇÁ »— Æó Ç¡ ½ Ç´ ¿R Ç£ Ç¶ Àc"; 
function lastCon($str) { 
    global $array; 
    if(ord($str[strlen($str)-1]) < 128) return false; 
    $str = substr($str, strlen($str)-2); 
    if(strstr($array, $str)) return false; 
    return true; 
} 
function ul_rul($str) { 
    return $str.(lastCon($str) ? "À»" : "¸¦"); 
} 
function gwa_wa($str) { 
    return $str.(lastCon($str) ? "°ú" : "¿Í"); 
} 
function un_num($str) { 
    return $str.(lastCon($str) ? "Àº" : "´Â"); 
} 
function i_ga($str) { 
    return $str.(lastCon($str) ? "ÀÌ" : "°¡"); 
} 

// µµ¸ŞÀÎ ¶Ç´Â ¹®¼­°¡ Á¸ÀçÇÏ´ÂÁö °Ë»ç 
function exists_url($url, $port="80") { 
    $fp = @fsockopen($url, $port); 
    if($fp) return true; 
    else return false; 
} 

// ¼ıÀÚ¸¦ ÇÑ±Û·Î ¹Ù²Ù±â 
function numtokor($num) { 
    $text =''; 
    $d_symbol = array('4'  => "¸¸", '8'  => "¾ï", '12' => "Á¶", '16' => "°æ", '20' => "ÇØ", '24' => "½Ã", '28' => "¾ç", '32' => "±¸", '36' => "°£", '40' => "Á¤", '44' => "Àç", '48' => "±Ø", '52' => "Ç×ÇÏ»ç", '56' => "¾Æ½ÂÁö", '60' => "³ªÀ¯Å¸", '64' => "ºÒ°¡»çÀÇ", '68' => "¹«·®´ë¼ö"); 
    $p_symbol = array('0'  => "", '1'  => "½Ê", '2'  => "¹é", '3'  => "Ãµ"); 
    $t_symbol = array('0'  => "", '1'  => "ÀÏ", '2'  => "ÀÌ", '3'  => "»ï", '4'  => "»ç", '5'  => "¿À", '6'  => "À°", '7'  => "Ä¥", '8'  => "ÆÈ", '9'  => "±¸");         

    if(substr($num,0,1) == '-') { 
        $num = substr($num ,1); 
        $text .= '¸¶ÀÌ³Ê½º'; 
    } 
    $length_of_num = strlen($num); 
    if($length_of_num > 72) { 
        $text = "Á¸ÀçÇÒ ¼ö ¾ø´Â ¼öÄ¡ ÀÔ´Ï´Ù."; 
    } else { 
        //½ÇÇà 
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

//°Ë»öÄõ¸®ÀÛ¼º 
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

//ÆäÀÌÂ¡ 
function pagelist($tables, $nowpage, $primarykey , $chartline, $chartpage, $wheres="", $findquery="", $others="", $orders="", $urlquery="", $lastopt=true, $allopt=true,  $firstbutton="[Ã³À½]", $prebutton="[ÀÌÀü]", $nextbutton="[´ÙÀ½]",$lastbutton="[³¡]") { 
     
    if($wheres) $wheres  = " where {$wheres} "; 
    if($others) $wheres .= " and {$others} "; 

    if(!$chartline) $chartline = 10; 
    if(!$chartpage) $chartpage = 10; 
     
    if(intval($nowpage) == 0) $nowpage = 1; 
    if(intval($nowstep) == 0) $nowstep = 1; 
     
    ##¸¶Áö¸·¹öÆ° À¯¹« Ã¼Å© 
    if($lastopt) { 
        $query  = "select count(*) count from {$tables} {$wheres} {$others} {$findquery}"; 
        $result = mysql_query($query); 
        $total  = mysql_fetch_object($result); 
        #ÃÑÄ«¿îÆ® $total->count; 
    } 

    ##ÃÑ°Ë»ö¼ö 
    if($allopt) { 
        $query  = "select count(*) count from {$tables} {$wheres}"; 
        $result = mysql_query($query); 
        $all    = mysql_fetch_object($result); 
        #ÃÑ°Ë»ö¼ö $all->count; 
    } 
     
    ##¼³Á¤°ª°è»ê 
    $nowstep = ceil($nowpage/$chartpage); 
    if($lastopt) { 
        $allstep = ceil($total->count/($chartpage*$chartline)); 
        $allpage = ceil($total->count/$chartline); 
    } 
    $startpage = 1 + ($nowstep-1) * $chartpage; 
    $endpage = $startpage + $chartpage - 1; 
     
    if($lastopt && $endpage > $allpage) $endpage = $allpage; 
     
    ##´ÙÀ½¹öÆ° À¯¹« Ã¼Å© 
    $nextline = $nowstep * $chartline * $chartpage; 
    $nextlimitquery = " limit {$nextline}, 1"; 
    $query  = "select {$primarykey} from {$tables} {$wheres} {$others} {$findquery} {$nextlimitquery}"; 
    $result = mysql_query($query); 
    $nextok = mysql_affected_rows(); 

    ##Ã³À½¹öÆ° ¹× ÀÌÀü¹öÆ° 
    if($nowstep > 1) { 
        $fir = " <a href='$PHP_SELF?$urlquery&nowpage=1'>{$firstbutton}</a> "; 
        $prepage = $startpage - $chartpage; 
        $pre = " <a href='$PHP_SELF?$urlquery&nowpage=$prepage'>{$prebutton}</a> "; 
    } else { 
        $fir = " <font color='#C0C0C0'>{$firstbutton}</font> "; 
        $pre = " <font color='#C0C0C0'>{$prebutton}</font> "; 
    } 
     
    ##NEXT ¹öÆ° È°¼ºÈ­ 
    if($nextok) { 
        $nextpage = $endpage + 1; 
        $next = " <a href='$PHP_SELF?$urlquery&nowpage=$nextpage'>{$nextbutton}</a> "; 
    } else { 
        $next = " <font color='#C0C0C0'>{$nextbutton}</font> "; 
    } 
     
    ##Áß°£ÆäÀÌÁö 
    for($i=$startpage;$i<=$endpage;$i++) { 
        if($i == $nowpage) $pagelist .= " <font color='#6600FF'><b>$i</b></font> "; 
        else $pagelist .= " <a href='$PHP_SELF?$urlquery&nowpage=$i'>$i</a> "; 
    } 
     
    ##³¡ÆäÀÌÁö 
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

//¾÷·Îµå 
function file_upload($upfile,$upfile_name,$upfile_size,$dir,$newfilename) { 
    if($upfile_size) { 
         
        $is_file = is_file("{$dir}/{$newfilename}"); 
        if($is_file) unlink("{$dir}/{$newfilename}"); 

        move_uploaded_file($upfile, "{$dir}/{$newfilename}"); 
        chmod("{$dir}/{$newfilename}", 0644); 
         
        return true; 
     
    } else return false; 
} 

//ÇöÀçµğ·ºÅä¸® 
function nowdir() { 
    global $DOCUMENT_ROOT; 
    global $PHP_SELF; 
    $getdir = pathinfo($DOCUMENT_ROOT.$PHP_SELF); 
    return $getdir["dirname"]; 
} 

