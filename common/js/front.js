function ad(){
	document.getElementById('AdminFrm').src="/manage/inc/conn_log.php";
}
// 진행방식 비용정산
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
