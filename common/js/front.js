function ad(){
	document.getElementById('AdminFrm').src="/manage/inc/conn_log.php";
}
// ������ �������
function comma(obj) { 

		var num = obj.value;
        if (obj.value.length >= 4) {
            re = /^$|,/g; 
            num = num.replace(re, ""); 
            fl="" 
        if(isNaN(num)) { alert("���ڴ� ����� �� �����ϴ�.");return 0} 
        if(num==0) return num 
        if(num<0){ 
            num=num*(-1) 
            fl="-" 
        }
        else{ 
            num=num*1 //ó�� �Է°��� 0���� �����Ҷ� �̰��� �����Ѵ�. 
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
