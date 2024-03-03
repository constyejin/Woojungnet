////////////////////////////////////////////////////////////////////

var varSYMBOL = "~!@#$%^&*() -+|.:/,?";

// ���� �˻�
function isEmpty(varCk) {
    if ((varCk == "") || (varCk == null)) {
        return true;
    }
    return false;
}

// �Է� ���ڿ� �˻� (����/����/Ư������)
function isString(varCk, charSet) {
    var chk=true;
    for (i=0; i<=varCk.length-1; i++) {
        ch = varCk.substring(i,i+1);
        if ((ch>="0" && ch<="9") || (ch>="a" && ch<="z") || (ch>="A" && ch<="Z")) {
            chk = true;
        } else {
            chk=false;
            for (j=0; j<=charSet.length-1; j++) {
                comp = charSet.substring(j,j+1);
                if (ch==comp) {
                    chk = true;
                    break;
                }
            }
            if (!chk)   break;  // ����/����/Ư�����ڿ��� ���ڰ� �ִ� ��츸 error ���� 2002.04.08
        }
    }
    return chk;
}

// �Է� ���ڿ� �˻� (����/Ư������)
function isInteger(varCk, charSet) {
    if( varCk.search('V') != -1 ) return true;
    var chk=true;
    for (i=0; i<=varCk.length-1; i++) {
        ch = varCk.substring(i,i+1);
        if (ch>="0" && ch<="9") {
            chk = true;
        } else {
            chk=false;
            for (j=0; j<=charSet.length-1; j++) {
                comp = charSet.substring(j,j+1);
                if (ch==comp) {
                    chk = true;
                    break;
                }
            }
            if (!chk)   break;  // ����+Ư�����ڿ��� ���ڰ� �ִ� ��츸 error ���� 2002.04.08
        }
    }
    return chk;
}

//onKeyUp�� ���ȴ�. �޽����� �����ش�.
function isNumber( InputBox ) {
    if(InputBox.value == "" ) {
        return (true);
    }

    var checkOK = "0123456789";
    var checkStr = InputBox.value;
    var allValid = true;
    var decPoints = 0;
    var allNum = "";
    var MinusYN;

    if( InputBox.value=="NaN")
        InputBox.value = "";
    for (i = 0;  i < checkStr.length;  i++) {
       ch = checkStr.charAt(i);
       for (j = 0;  j < checkOK.length;  j++)  {
           if (ch == checkOK.charAt(j))
               break;
       }
       if (j == checkOK.length) {
            allValid = false;
            break;
       }

       if (ch != ","){
            allNum += ch;
       }
    }

    if ( !allValid ) {
        alert("���ڸ� �Է��Ͻʽÿ�.");
        InputBox.value = "";
        InputBox.focus();
        return (false);
    }
}



// �Է� ���ڿ� �˻� (�ѱ�/Ư������)
function isKor(varCk, charSet) {
    var chk=true;
    for (i=0; i<=varCk.length-1; i++) {
        ch = varCk.substring(i,i+1);
        if ((ch == "\n") || ((ch >= "��") && (ch <= "��")) || ((ch >="��") && (ch <="��"))) {
            chk = true;
        } else {
            chk=false;
            for (j=0; j<=charSet.length-1; j++) {
                comp = charSet.substring(j,j+1);
                if (ch==comp) {
                    chk = true;
                    break;
                }
            }
            if (!chk)   break;  // �ѱ�+Ư�����ڿ��� ���ڰ� �ִ� ��츸 error ���� 2002.04.08
        }
    }
    return chk;
}


function isEng(varCk, charSet) {
    var chk=true;
    for (i=0; i<=varCk.length-1; i++) {
        ch = varCk.substring(i,i+1);

        if ((ch>="a" && ch<="z") || (ch>="A" && ch<="Z")) {
            chk = true;
        } else {
            chk=false;
            for (j=0; j<=charSet.length-1; j++) {
                comp = charSet.substring(j,j+1);
                if (ch==comp) {
                    chk = true;
                    break;
                }
            }
            break;
        }
    }
    return chk;
}



// 2002.12.02 BSH �輺�� �߰� start
// �Է� ���ڿ� �˻� (�ѱ�/Ư������)
function isHan(varCk, charSet) {
        var chk=true;
        for (i=0; i<=varCk.length-1; i++) {
                ch = varCk.substring(i,i+1);
                if ((ch >= "��") && (ch <= "\uD7A3")) {
                        chk = true;
                } else {
                        chk = false;
                        for (j=0; j<=charSet.length-1; j++) {
                                comp = charSet.substring(j,j+1);
                                if (ch == comp) {
                                        chk = true;
                                        break;
                                }
                        }
                        if (!chk)       break;  // �ѱ�+Ư�����ڿ��� ���ڰ� �ִ� ��츸 error ���� 2002.04.08
                }
        }
        return chk;
}

// �Էµ� ����Ÿ�� �ѱ� �����󿩺� üũ
function isValidValue(varCk, charSet) {
        var chk=true;
        for (i=0; i<varCk.length; i++) {
                ch = varCk.charAt(i);
                if ((ch >= "��" && ch <= "\uD7A3") || (ch>="0" && ch<="9") || (ch>="a" && ch<="z") || (ch>="A" && ch<="Z")) {
                        chk = true;
                } else {
                        chk = false;
                        for (j=0; j<charSet.length; j++) {
                                comp = charSet.charAt(j);
                                if (ch == comp) {
                                        chk = true;
                                        break;
                                }
                        }
                        if (!chk)       break;  // �ѱ�+Ư�����ڿ��� ���ڰ� �ִ� ��츸 error ���� 2002.04.08
                }
        }
        return chk;
}
// 2002.12.02 BSH �輺�� �߰� end

// �Էµ� ����Ÿ�� �ѱ� �����󿩺��� ���� ��ǿ� üũ �޸�(,)�� �߰��Ѵ�.
function isValidAddComma(varCk, charSet) {
        var chk=true;
        for (i=0; i<varCk.length; i++) {
                ch = varCk.charAt(i);
                if ((ch >= "��" && ch <= "\uD7A3") || (ch>="0" && ch<="9")
                    || (ch>="a" && ch<="z") || (ch>="A" && ch<="Z") || (ch==",")) {
                        chk = true;
                } else {
                        chk = false;
                        for (j=0; j<charSet.length; j++) {
                                comp = charSet.charAt(j);
                                if (ch == comp) {
                                        chk = true;
                                        break;
                                }
                        }
                        if (!chk)       break;  // �ѱ�+Ư�����ڿ��� ���ڰ� �ִ� ��츸 error ���� 2004-10-20 3:28����
                }
        }
        return chk;
}
// 2004-10-20 3:28���� ������ �߰�



// ���ڿ� ���� �˻�
function isLength(varCk) {
    var varLen = 0;
    var agr = navigator.userAgent;

    for (i=0; i<varCk.length; i++) {
        ch = varCk.charAt(i);
        if ((ch == "\n") || ((ch >= "��") && (ch <= "��")) || ((ch >="��") && (ch <="��")))
            varLen += 2;
        else
            varLen += 1;
    }
    return (varLen);
}

// ��¥ ��ȿ�� �˻�(��,��,��)
function isDay(varCk1,varCk2,varCk3) {
    if ( (isLength(varCk1)==4) && (isLength(varCk2)==2) && (isLength(varCk3)==2) ) {
        if ( (isInteger(varCk1,"")) && (isInteger(varCk2,"")) && (isInteger(varCk3,"")) ) {
            if (varCk1>="1900" && varCk1<="2099" && varCk2>="01" && varCk2<="12") {
                if (varCk2=="01" && varCk3>="01" && varCk3<="31") return true;
                if (varCk2=="02" && varCk3>="01" && varCk3<="28") return true;
                if (varCk2=="03" && varCk3>="01" && varCk3<="31") return true;
                if (varCk2=="04" && varCk3>="01" && varCk3<="30") return true;
                if (varCk2=="05" && varCk3>="01" && varCk3<="31") return true;
                if (varCk2=="06" && varCk3>="01" && varCk3<="30") return true;
                if (varCk2=="07" && varCk3>="01" && varCk3<="31") return true;
                if (varCk2=="08" && varCk3>="01" && varCk3<="31") return true;
                if (varCk2=="09" && varCk3>="01" && varCk3<="30") return true;
                if (varCk2=="10" && varCk3>="01" && varCk3<="31") return true;
                if (varCk2=="11" && varCk3>="01" && varCk3<="30") return true;
                if (varCk2=="12" && varCk3>="01" && varCk3<="31") return true;
                return false;
            }
            return false;
        } else {
            return false;
        }
    } else {
        return false;
    }

}

// �ֹε�Ϲ�ȣ �˻縸 ó��
function isRegNoCheck(varCk1, varCk2) {

    if ( (isLength(varCk1)==6) && (isLength(varCk2)==7) ) {

        //-----------------------------------------------------------------------------
        // ��û��ȣ  :  [3036] �����ֹι�ȣ ����
        // ��û��   : ��̰�
        // ������   : �����
        // ������   : 2007-03-13 5:10����
        // �������� : �����ֹι�ȣ�� ��� �ֹι�ȣ üũ���� �н�
        //-----------------------------------------------------------------------------
        if(varCk2.substring(1,2) == 'V')
        {
            return true;
        }
        //-----------------------------------------------------------------------------

        if ( (isInteger(varCk1,"")) && (isInteger(varCk2,"")) ) {
            ckValue = new Array(13);
            var ckLastid,ckMod,ckMinus,ckLast;

            ckLastid    = parseFloat(varCk2.substring(6,7));
            ckValue[0]  = parseFloat(varCk1.substring(0,1))  * 2;
            ckValue[1]  = parseFloat(varCk1.substring(1,2))  * 3;
            ckValue[2]  = parseFloat(varCk1.substring(2,3))  * 4;
            ckValue[3]  = parseFloat(varCk1.substring(3,4))  * 5;
            ckValue[4]  = parseFloat(varCk1.substring(4,5))  * 6;
            ckValue[5]  = parseFloat(varCk1.substring(5,6))  * 7;
            ckValue[6]  = parseFloat(varCk2.substring(0,1))  * 8;
            ckValue[7]  = parseFloat(varCk2.substring(1,2))  * 9;
            ckValue[8]  = parseFloat(varCk2.substring(2,3))  * 2;
            ckValue[9]  = parseFloat(varCk2.substring(3,4))  * 3;
            ckValue[10] = parseFloat(varCk2.substring(4,5))  * 4;
            ckValue[11] = parseFloat(varCk2.substring(5,6))  * 5;
            ckValue[12] = 0;

            for (var i = 0; i<12;i++) {
                ckValue[12] = ckValue[12] + ckValue[i];
            }
            ckMod   = ckValue[12] %11;
            ckMinus = 11 - ckMod;
            ckLast  = ckMinus % 10;
            if (ckLast != ckLastid) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// �ֹε�Ϲ�ȣ �˻�
function isRegNo(varCk1,varCk2) {
    if ( (isLength(varCk1)==6) && (isLength(varCk2)==7) ) {

        //-----------------------------------------------------------------------------
        // ��û��ȣ  :  [3036] �����ֹι�ȣ ����
        // ��û��   : ��̰�
        // ������   : �����
        // ������   : 2007-03-13 5:10����
        // �������� : �����ֹι�ȣ�� ��� �ֹι�ȣ üũ���� �н�
        //-----------------------------------------------------------------------------
        if(varCk2.substring(1,2) == 'V')
        {
            return true;
        }
        //-----------------------------------------------------------------------------

        if ( (isInteger(varCk1,"")) && (isInteger(varCk2,"")) ) {
            ckValue = new Array(13);
            var ckLastid,ckMod,ckMinus,ckLast;

            ckLastid    = parseFloat(varCk2.substring(6,7));
            ckValue[0]  = parseFloat(varCk1.substring(0,1))  * 2;
            ckValue[1]  = parseFloat(varCk1.substring(1,2))  * 3;
            ckValue[2]  = parseFloat(varCk1.substring(2,3))  * 4;
            ckValue[3]  = parseFloat(varCk1.substring(3,4))  * 5;
            ckValue[4]  = parseFloat(varCk1.substring(4,5))  * 6;
            ckValue[5]  = parseFloat(varCk1.substring(5,6))  * 7;
            ckValue[6]  = parseFloat(varCk2.substring(0,1))  * 8;
            ckValue[7]  = parseFloat(varCk2.substring(1,2))  * 9;
            ckValue[8]  = parseFloat(varCk2.substring(2,3))  * 2;
            ckValue[9]  = parseFloat(varCk2.substring(3,4))  * 3;
            ckValue[10] = parseFloat(varCk2.substring(4,5))  * 4;
            ckValue[11] = parseFloat(varCk2.substring(5,6))  * 5;
            ckValue[12] = 0;

            for (var i = 0; i<12;i++) {
                ckValue[12] = ckValue[12] + ckValue[i];
            }
            ckMod   = ckValue[12] %11;
            ckMinus = 11 - ckMod;
            ckLast  = ckMinus % 10;
            if (ckLast != ckLastid) {
                alert ("�߸��� �ֹε�Ϲ�ȣ�Դϴ�. �ٽ� Ȯ���� �ֽʽÿ�");
                return false;
            } else {
                return true;
            }
        } else {
            alert("�ֹε�Ϲ�ȣ�� �����̾�� �մϴ�.");
            return false;
        }
    } else {
        alert("�ֹε�Ϲ�ȣ�� �ڸ����� �߸� �ԷµǾ����ϴ�.");
        return false;
    }
}

// ����� ��Ϲ�ȣ �˻�
function isBusinessNo(varCk1,varCk2,varCk3) {
    ckValue = new Array(10);
    if ( (isLength(varCk1)==3) && (isLength(varCk2)==2) && (isLength(varCk3)==5) ) {
        if ( (isInteger(varCk1,"")) && (isInteger(varCk2,"")) && (isInteger(varCk3,"")) ) {
            ckValue[0] = ( parseFloat(varCk1.substring(0 ,1))  * 1 ) % 10;
            ckValue[1] = ( parseFloat(varCk1.substring(1 ,2))  * 3 ) % 10;
            ckValue[2] = ( parseFloat(varCk1.substring(2 ,3))  * 7 ) % 10;
            ckValue[3] = ( parseFloat(varCk2.substring(0 ,1))  * 1 ) % 10;
            ckValue[4] = ( parseFloat(varCk2.substring(1 ,2))  * 3 ) % 10;
            ckValue[5] = ( parseFloat(varCk3.substring(0 ,1))  * 7 ) % 10;
            ckValue[6] = ( parseFloat(varCk3.substring(1 ,2))  * 1 ) % 10;
            ckValue[7] = ( parseFloat(varCk3.substring(2 ,3))  * 3 ) % 10;
            ckTemp     = parseFloat(varCk3.substring(3 ,4))  * 5  + "0";
            ckValue[8] = parseFloat(ckTemp.substring(0,1)) + parseFloat(ckTemp.substring(1,2));
            ckValue[9] = parseFloat(varCk3.substring(4,5));
            ckLastid = ( 10 - ( ( ckValue[0]+ckValue[1]+ckValue[2]+ckValue[3]+ckValue[4]+ckValue[5]+ckValue[6]+ckValue[7]+ckValue[8] ) % 10 ) ) % 10;
            if (ckValue[9] != ckLastid) {
                alert ("�߸��� ����ڵ�Ϲ�ȣ�Դϴ�. �ٽ� Ȯ���� �ֽʽÿ�");
                return false;
            } else {
                return true;
            }
        } else {
            alert("����ڵ�Ϲ�ȣ�� �����̾�� �մϴ�.");
            return false;
        }
    } else {
        alert("����ڵ�Ϲ�ȣ�� �ڸ����� �߸� �ԷµǾ����ϴ�.");
        return false;
    }
}

// ���ι�ȣ �˻�
function isCorporationNo(varCk){
    var checkNum = new Array("1","2","1","2","1","2","1","2","1","2","1","2");

    //�������� �з���ȣ, ���������� �з���ȣ �� �Ϸù�ȣ�� ���ʷ� ������ 12�ڸ�
    //�� ���ڸ� �����.
    var newNum = new Array();
    for(var i = 0; i < varCk.length -1; i++)
        newNum[i] = varCk.charAt(i);

    //�� ���ڿ� ���ʷ� 1�� 2�� ���� ��.���� ��� ���Ͽ� ���� ���Ѵ�.
    var multiNum = new Array();
    for(var k = 0; k < newNum.length; k++)
        multiNum[k] = checkNum[k] * newNum[k];

   // alert("�� ���ڿ� ���ʷ� 1�� 2�� ���� ��: "+ multiNum[11]);
    //���� ���� ��� ���Ͽ� ���� ���Ѵ�.
    var addNum = 0;
    for(var y = 0; y < multiNum.length; y++)
        addNum = addNum + Number(multiNum[y]);

   // alert("���� ���� ��� ���Ͽ� ���� ���Ѵ�: "+ addNum);
    //���� 10���� ������ ��� �������� ���Ѵ�.
    var remainder;
    var quota;
    remainder = Number(addNum) % 10;
    quota = Number(addNum) / 10;
    //10���� �������� �� ���� �����˻���ȣ�� �Ѵ�. �ٸ�, 10���� �������� �� ����
    //10�� ������ 0�� �����˻���ȣ�� �Ѵ�.
    var failCheckNum;
    if( (10 - Number(remainder)) == 10 )
    {
        failCheckNum = 0;
    }
    else
    {
        failCheckNum = 10 - Number(remainder);
    }
   // alert("�����˻���ȣ: "+ failCheckNum);
    if(failCheckNum != varCk.charAt(12)) return false;

    return true;

}

//���ι�ȣ �˻� alert����
function isCorpNo(varCk1,varCk2) {
    var varCk = varCk1 + varCk2;

    if ( (isInteger(varCk1,"")) && (isInteger(varCk2,"")) ) {
        if ( (isLength(varCk1)==6) && (isLength(varCk2)==7) ) {
            //���ι�ȣ check
            if( !isCorporationNo(varCk) ){
                alert("�߸��� ���ι�ȣ�Դϴ�. �ٽ� Ȯ���� �ֽʽÿ�");
                return false;
            }else{
                return true;
            }


        } else {
            alert("���ι�ȣ�� �ڸ����� �߸� �ԷµǾ����ϴ�.");
            return false;
        }
    }else {
            alert("���ι�ȣ�� �����̾�� �մϴ�.");
            return false;
    }
    return true;

}//end ����


//�ܱ��� ��Ϲ�ȣ check
function chkForeignNo(No){
    var nSum;
    var odd;
    odd= (parseInt(No.charAt(7))*10)+(parseInt(No.charAt(8)))

    if((odd%2) != 0){
        return false;
    }
    if((parseInt(No.charAt(11))!=6) && (parseInt(No.charAt(11))!=7) && (parseInt(No.charAt(11))!=8) && (parseInt(No.charAt(11))!=9)){
        return false;
    }

    nSum=
    (parseInt(No.charAt(0))*2)+
    (parseInt(No.charAt(1))*3)+
    (parseInt(No.charAt(2))*4)+
    (parseInt(No.charAt(3))*5)+
    (parseInt(No.charAt(4))*6)+
    (parseInt(No.charAt(5))*7)+
    (parseInt(No.charAt(6))*8)+
    (parseInt(No.charAt(7))*9)+
    (parseInt(No.charAt(8))*2)+
    (parseInt(No.charAt(9))*3)+
    (parseInt(No.charAt(10))*4)+
    (parseInt(No.charAt(11))*5);

    nSum = 11 - (nSum % 11);
    if(nSum >= 10){
        nSum = nSum - 10;
    }
    nSum = nSum + 2;
    if(nSum >= 10){
        nSum = nSum - 10;
    }
    if(nSum != (parseInt(No.charAt(12)))){
        return false;
    }
    else{
        return true;
    }
}

//�ܱ��� ��Ϲ�ȣ check alert����

function chkForNo(varCk1){
    var varCk = varCk1;
    if ( isInteger(varCk1,"") ) {
        if ( isLength(varCk1)==13 ) {
            //���ι�ȣ check
            if( !chkForeignNo(varCk) ){
                alert("�߸��� �ܱ��� ��Ϲ�ȣ�Դϴ�. �ٽ� Ȯ���� �ֽʽÿ�");
                return false;
            }else{
                return true;
            }


        } else {
            alert("�ܱ��� ��Ϲ�ȣ�� �ڸ����� �߸� �ԷµǾ����ϴ�.");
            return false;
        }
    }else {
            alert("�ܱ��� ��Ϲ�ȣ�� �����̾�� �մϴ�.");
            return false;
    }
    return true;
}


// �̸��� �˻�
function isEmail(str) {
    // regular expression ���� ���� ����
    var supported = 0;
    if(window.RegExp){
        var tempStr = "a";
        var tempReg = new RegExp(tempStr);
        if (tempReg.test(tempStr)) supported = 1;
    }

    if (!supported){
        return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
    }

    var r1 = new RegExp("(@.*@)|(\\.\\.)|(@\\.)|(^\\.)");
    var r2 = new RegExp("^.+\\@(\\[?)[a-zA-Z0-9\\-\\.]+\\.([a-zA-Z]{2,3}|[0-9]{1,3})(\\]?)$");

    return (!r1.test(str) && r2.test(str));
}


//�̸����� �´� �������� onKeyUp�� �˷��ش�.

function valEmail(str){
    var strEmail = str.value;
    if( trim(strEmail) == ''){
        ;
    }else{
        if( isEmail(strEmail)==false ){
            alert('�̸��� ������ ���� �ʽ��ϴ�. �ٽ� �Է��Ͽ� �ֽʽÿ�.');
        }
    }
}

// ������ȣ �� �ڵ��� 0502, 0505�ϰ�� ���� ������ �ֵ��� �Ѵ�.
// 2003/06/30 ������ �ۼ�
function telJiyukPna_onKey(input1, input2){

    var strVal1 = input1.value;
	//2007-08-08
	var varCk       = window.event.keyCode;
    if ( varCk == 8 || varCk == 9 || varCk == 46 ) {
        return true;
    }
    //2007-08-08
    if(!isInteger(strVal1,'')) {
        alert("���ڸ� �Է� �����մϴ�!!!");
        input1.focus();
        input1.select();
    }


    if( isGenPhone(input1.value) ){
        input2.focus();
        input2.select();
    }else if ( isCellarPhone(input1.value) ){
        if( input1.value.length == 2){
            input1.value = "0" + input1.value;
        }
        input2.focus();
        input2.select();
    }else if( isPnaPhone(input1.value) ){
        input2.focus();
        input2.select();
    }else if( input1.value.length == 4 ) {
        input2.focus();
        input2.select();
    }
}

function telJiyukPnaCntr_onKey(input1, input2){

    var strVal1 = input1.value;
	//2007-08-08
	var varCk       = window.event.keyCode;
    if ( varCk == 8 || varCk == 9 || varCk == 46 ) {
        return true;
    }
    //2007-08-08
    if(!isInteger(strVal1,'')) {
        alert("���ڸ� �Է� �����մϴ�!!!");
        input1.focus();
        input1.select();
    }


    if( isGenPhone(input1.value) ){
        input2.focus();
        input2.select();
        //2007-08-08
    }else if (isPnaPhone(input1.value)) {
        input2.focus();
        input2.select();
    }else if (isVoipCheck(input1.value)) {
        input2.focus();
        input2.select();
        //2007-08-08
    }else if ( isCellarPhone(input1.value) ){
        if( input1.value.length == 2){
            input1.value = "0" + input1.value;
        }
        input2.focus();
        input2.select();
    }else if( isPnaPhone(input1.value) ){
        input2.focus();
        input2.select();
    }else if( input1.value.length == 4 ) {
        input2.focus();
        input2.select();
    }
}

// �Ϲ���ȭ ������ȣ �˻�(DDD)
function isGenPhone(varCk1) {

    if ( varCk1.length == 2 ) {
        varCk1 = '0' + varCk1;
    } else if ( varCk1.length == 4 ) {
        varCk1 = varCk1.substring(1,4);
    } else if ( varCk1.length != 3 ) {
        return false ;
    }

    if( !isEmpty(varCk1) ) {
       if(varCk1 == "002" || varCk1 == "031" || varCk1 == "032" || varCk1 == "033" || varCk1 == "041" || varCk1 == "042" || varCk1 == "043" || varCk1 == "051" || varCk1 == "052" || varCk1 == "053" || varCk1 == "055" || varCk1 == "054" || varCk1 == "061" || varCk1 == "062" || varCk1 == "063" || varCk1 == "064" ){
         return true;
       }
     }
    return false;
}

// �ڵ��� ����ڱ��� �˻�(����ڱ���)
// KTP (0130 Check Logic �߰� . by 2003.10.10 �����)
// 010 �߰� 2003-12-17 4:29���� ������
function isCellarPhone(varCk1) {
    if ( varCk1.length == 2 ) {
        varCk1 = '0' + varCk1;

    } else if ( varCk1.length == 4 && varCk1 != "0130") {
        varCk1 = varCk1.substring(1,4);

    } else if ( varCk1.length == 4 && varCk1 == "0130") {

    } else if ( varCk1.length != 3 ) {
        return false ;
    }

    if(!isEmpty(varCk1)){
       if( varCk1 == "010" || varCk1 == "011" || varCk1 == "017" || varCk1 == "016" || varCk1 == "018" || varCk1 == "019" || varCk1 == "0130"){
            return true;
       }
    }
    return false;
}

//�����ȣ check
function isPnaPhone(varCk1) {

    if ( varCk1.length == 3 ) {
        varCk1 = '0' + varCk1;
    } else if ( varCk1.length != 4 ) {
        return false ;
    }

    if(!isEmpty(varCk1)){
       if(varCk1 == "0505" || varCk1 == "0502" ){
            return true;
       }
    }
    return false;
}

//070 check 2007-08-08
function isVoipCheck(varCk1) {

    if ( varCk1.length == 2 ) {
        varCk1 = '0' + varCk1;
    } else if ( varCk1.length == 4 ) {
        varCk1 = varCk1.substring(1,4);
    } else if ( varCk1.length != 3 ) {
        return false ;
    }

    if(!isEmpty(varCk1)){
       if(varCk1 == "070" ){
            return true;
       }
    }
    return false;
}


// ����üũ
function leapYear(year) {
  if (year % 4 == 0) // basic rule
    return true; // is leap year
  /* else */ // else not needed when statement is "return"
    return false; // is not leap year
}

// �ΰ��� ��¥ ������ �� �ϼ��� ���Ѵ�.
function getDaysBetween(from, to) {
    var sdate = new Date(Number(from.substring(0,4)),Number(from.substring(4,6))-1,Number(from.substring(6,8))-1);
    var edate = new Date(Number(to.substring(0,4)),Number(to.substring(4,6))-1,Number(to.substring(6,8)));

    var fromMillis = sdate.getTime();
    var toMillis = edate.getTime();
    return (toMillis - fromMillis) / (1000 * 60 * 60 * 24);
}

// ����� ���� last day��
function getDays(month, year) {
  // create array to hold number of days in each month
  var ar = new Array(12);
  ar[0] = 31; // January
  ar[1] = (leapYear(year)) ? 29 : 28; // February
  ar[2] = 31; // March
  ar[3] = 30; // April
  ar[4] = 31; // May
  ar[5] = 30; // June
  ar[6] = 31; // July
  ar[7] = 31; // August
  ar[8] = 30; // September
  ar[9] = 31; // October
  ar[10] = 30; // November
  ar[11] = 31; // December

  // return number of days in the specified month (parameter)
  return ar[month];
}


function na_open_window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable)
{
  toolbar_str = toolbar ? 'yes' : 'no';
  menubar_str = menubar ? 'yes' : 'no';
  statusbar_str = statusbar ? 'yes' : 'no';
  scrollbar_str = scrollbar ? 'yes' : 'no';
  resizable_str = resizable ? 'yes' : 'no';
  window.open(url, name, 'left='+left+',top='+top+',width='+width+',height='+height+',toolbar='+toolbar_str+',menubar='+menubar_str+',status='+statusbar_str+',scrollbars='+scrollbar_str+',resizable='+resizable_str);
}

// �ּ���ȸ ������ Open
function NewWindow(mypage, myname, w, h, scroll) {
    var winl = (screen.width - w) / 2;
    var wint = (screen.height - h) / 2;
    winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'
    win = window.open(mypage, myname, winprops)
    if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}


function NewWindow2(mypage, myname, w, h, scroll, resizable) {
    var winl = (screen.width - w) / 2;
    var wint = (screen.height - h) / 2;
    winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable='+resizable
    win = window.open(mypage, myname, winprops)
    if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}

function NewWindow3(mypage, myname, w, h, scroll, resizable) {
    var winl = (screen.width - w) / 2;
    var wint = (screen.height - h) / 2;
    winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable='+resizable
    win = window.open(mypage, myname, winprops)
    if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
    return win;
}

// �¿찡� ��� �����̽� ����
function trim(parm_str)
{
    return rtrim(ltrim(parm_str));
}

// ���� �����̽� ����
function ltrim(parm_str)
{
    str_temp = parm_str;

    while (str_temp.length != 0) {
        if (str_temp.substring(0, 1) == " ") {
            str_temp = str_temp.substring(1, str_temp.length) ;
        }
        else {
            return str_temp ;
        }
    }
    return str_temp ;
}

// ���� �����̽� ����
function rtrim(parm_str) {
  str_temp = parm_str ;
  while (str_temp.length != 0) {
    int_last_blnk_pos = str_temp.lastIndexOf(" ");
    if ((str_temp.length - 1) == int_last_blnk_pos) {
      str_temp = str_temp.substring(0, str_temp.length - 1);
    }
    else {
      return str_temp;
    }
  }
  return str_temp;
}

// �Է¹��� ���ڸ� �˻��� 4�ڸ��� ä���ش�.
function makeFmt4(val)
{
    var newVal = "";

    if(val.length == 1) {
        newVal = "000".concat(val);
    } else if(val.length == 2) {
        newVal = "00".concat(val);
    } else if(val.length == 3) {
        newVal = "0".concat(val);
    } else if(val.length == 0)  {
        newVal = "";
    } else {
        newVal = val;
    }

    return newVal ;
}

// ������ȣ �� �ڵ��� ���� ��ȣ üũ
function chkTelJiyuk(input1, flag1){
    //////////////////////////////////////////////////////////////////////////
    // input 1  : ������ȣ�� �Է��ϴ� text�� name                           //
    // flag1    : '1' --> ��ȭüũ, '2' --> �ڵ���üũ, '3' --> �Ѵ� üũ   //
    //////////////////////////////////////////////////////////////////////////
    var strVal1     = input1.value;
    var strFlag1    = flag1;

    if(strFlag1 == "1"){
        // �����Է� üũ
        if(!isInteger(strVal1,'')){
            alert("���ڸ� �Է� �����մϴ�!!!");
            input1.focus();
            return false;
        }

        // ���� üũ
        if(isLength(strVal1) < 3){
            if(strVal1 != "02"){
                alert("������ȣ�� �ٸ��� �Է��ϼ���!!!");
                input1.focus();
                return false;
            }
        }

        // ������ȣ üũ
        if(!isGenPhone(strVal1)){
            alert("������ȣ�� �ٸ��� �Է��ϼ���!!!");
            input1.focus();
            return false;
        }

        return true;

    }else if(strFlag1 =="2"){
        // �����Է� üũ
        if(!isInteger(strVal1,'')){
            alert("���ڸ� �Է� �����մϴ�!!!");
            input1.focus();
            return false;
        }

        // ���� üũ
        if(isLength(strVal1) < 3){
            alert("�ڵ��� ��ȣ�� �ٸ��� �Է��ϼ���!!!");
            input1.focus();
            return false;
        }

        // ������ȣ üũ
        if(!isCellarPhone(strVal1)){
            alert("�ڵ��� ��ȣ�� �ٸ��� �Է��ϼ���!!!");
            input1.focus();
            return false;
        }

        return true;

    }else{
        // �����Է� üũ
        if(!isInteger(strVal1,'')){
            alert("���ڸ� �Է� �����մϴ�!!!");
            input1.focus();
            return false;
        }

        // ���� üũ
        if(isLength(strVal1) < 3){
            if(strVal1 != "02"){
                alert("������ȣ�� �ٸ��� �Է��ϼ���!!!");
                input1.focus();
                return false;
            }
        }

        // ������ȣ üũ
        if(!isCellarPhone(strVal1) && !isGenPhone(strVal1)){
            alert("��ȣ�� �ٸ��� �Է��ϼ���!!!");
            input1.focus();
            return false;
        }

        return true;
    }
}

// ��ȣüũ
function chkTelKukbun(input2)
{
    //////////////////////////////////////////////////////////////////////////
    // input 2  : ������ �Է��ϴ� text�� name                               //
    //////////////////////////////////////////////////////////////////////////
    var strVal2     = input2.value;

    // ���� üũ
    if(!isInteger(strVal2,'')){
        alert("���ڸ� �Է��� �����մϴ�!!!");
        input2.focus();
        return false;

    }

    // ���� üũ
    if(isLength(strVal2) < 3){
        alert("������ 3�ڸ� �̻� �Է��ϼž� �մϴ�!!!");
        input2.focus();
        return false;
    }else{
        /*
        if((strVal2.substring(0,1) == "0") && (isLength(strVal2) == 3)){
            alert("�Ǿ��ڸ��� '0'�� �� ���� �����ϴ�!!!");
            input2.focus();
            return false;
        }
        */
        if((strVal2.substring(0,2) == "00") && (isLength(strVal2) == 4)){
            alert("�Ǿ��ڸ��� '00'�� �� ���� �����ϴ�!!!");
            input2.focus();
            return false;
        }
    }

    return true;
}

// ����üũ
function chkTelNo(input3)
{
    //////////////////////////////////////////////////////////////////////////
    // input 3  : ��ȣ�� �Է��ϴ� text�� name                               //
    //////////////////////////////////////////////////////////////////////////
    var strVal3     = input3.value;

    // ���� üũ
    if(!isInteger(strVal3,'')){
        alert("���ڸ� �Է��� �����մϴ�!!!");
        input3.focus();
        return false;
    }

    // ���� üũ
    if(isLength(strVal3) < 4){
        alert("��ȣ�� �ڸ����� 4�ڸ��Դϴ�!!!");
        input3.focus();
        return false;
    }

    return true;
}

// ��ȭ��ȣ üũ
function chkFmtTelNo(input1, input2, input3, flag1, flag2 )
{
    //////////////////////////////////////////////////////////////////////////
    // input 1  : ������ȣ�� �Է��ϴ� text�� name                           //
    // input 2  : ������ �Է��ϴ� text�� name                               //
    // input 3  : ��ȣ�� �Է��ϴ� text�� name                               //
    // flag1    : '1' --> ��ȭüũ, '2' --> �ڵ���üũ, '3' --> �Ѵ� üũ   //
    // flag2    : '1' --> �ʼ� �Է� ����, '2' --> NON �ʼ� �Է� ����        //
    //////////////////////////////////////////////////////////////////////////

    var strVal1     = input1.value;
    var strVal2     = input2.value;
    var strVal3     = input3.value;
    var strFlag1    = flag1;
    var strFlag2    = flag2;

    // �ʼ����� �ƴ����� ����
    if(strFlag2 == "1"){
        // ������ȣ �� �ڵ��� ���� ��ȣ üũ �Լ� ȣ��
        if(!chkTelJiyuk(input1, flag1)){
            return false;
        }

        // ��ȣüũ �Լ� ȣ��
        if(!chkTelKukbun(input2)){
            return false;
        }

        // ����üũ �Լ� ȣ��
        if(!chkTelNo(input3)){
            return false;
        }

    } else {
        if(isEmpty(strVal1) && isEmpty(strVal2) && isEmpty(strVal3)) {
            return true;
        } else {
            // ������ȣ �� �ڵ��� ���� ��ȣ üũ �Լ� ȣ��
            if(!chkTelJiyuk(input1, flag1)){
                return false;
            }

            // ��ȣüũ �Լ� ȣ��
            if(!chkTelKukbun(input2)){
                return false;
            }

            // ����üũ �Լ� ȣ��
            if(!chkTelNo(input3)){
                return false;
            }
        }
    }

    return true;
}

// ��ȭ��ȣ ��ġ�� �Լ�
function getFmtTelNo(input1, input2, input3){
    var strVal1     = input1;
    var strVal2     = input2;
    var strVal3     = input3;

    var retVal      = "";
    var retVal1     = makeFmt4(strVal1);
    var retVal2     = makeFmt4(strVal2);
    var retVal3     = makeFmt4(strVal3);

    retVal          = retVal1 + retVal2 + retVal3;

    return retVal;
}

// 2005-07-27 10:59����  tableOver tableOut
// visibility �Ӽ��� display �Ӽ��� ���� ó���ȴ�.
//���̺� ���̾�
function tableOver(Y)
{

    var menu = document.all[Y];

    if ( self.selectTable && selectTable != menu ) {
        try{
         menu.style.display= '';
         selectTable.style.display= 'none' ;
        }catch(e){
         menu.style.visibility= 'visible';
         selectTable.style.visibility= 'hidden' ;
        }

    }
    selectTable = menu;

}

//���̺� ���̾�
function tableOut(Y) {

    var menu = document.all[Y];

    if ( self.selectTable && selectTable != menu ) {
        try{
         menu.style.display= 'none';
         selectTable.style.display= '' ;
        }catch(e){
         menu.style.visibility= 'hidden';
         selectTable.style.visibility= 'visible' ;
        }

    }
    selectTable = menu;

}

var globalUMS = "1";

var globalUMS_TEL_NO1   = "";
var globalUMS_TEL_NO2   = "";
var globalUMS_TEL_NO3   = "";
var globalUMS_HAND_NO1  = "";
var globalUMS_HAND_NO1  = "";
var globalUMS_HAND_NO1  = "";
var globalUMS_EMAIL     = "";


// UMS ����
function chgUms() {
    var form = document.mainForm;

    if ( form.UMS_TYPE_CD.value == "3" ) {              // ����
        tableOut("tel");
        tableOver("mail");
        if(form.hUMS_TYPE_CD.value == "" && form.hUMS_NO.value == ""){
            form.UMS_EMAIL.value = form.hUMS_CUST_EMAIL.value;
        }

    } else if (form.UMS_TYPE_CD.value == "0") {     // ����
        tableOver("no");
    } else if (form.UMS_TYPE_CD.value == "2") {     // ��ȭ
        globalUMS = "1";

        form.UMS_TEL_NO1.value = "";
        form.UMS_TEL_NO2.value = "";
        form.UMS_TEL_NO3.value = "";
        tableOver("tel");

        if( form.hUMS_TYPE_CD.value == "" && form.hUMS_NO.value == "" ) {
            form.UMS_TEL_NO1.value = form.hTMP_UMS_TEL_NO1.value;
            form.UMS_TEL_NO2.value = form.hTMP_UMS_TEL_NO2.value;
            form.UMS_TEL_NO3.value = form.hTMP_UMS_TEL_NO3.value;
        }


    } else if (form.UMS_TYPE_CD.value == "1") {     // �ڵ���
        globalUMS = "2";

        form.UMS_TEL_NO1.value = "";
        form.UMS_TEL_NO2.value = "";
        form.UMS_TEL_NO3.value = "";

        tableOver("tel");
        if(form.hUMS_TYPE_CD.value == "" && form.hUMS_NO.value == ""){
            form.UMS_TEL_NO1.value = form.hTMP_UMS_HAND_NO1.value;
            form.UMS_TEL_NO2.value = form.hTMP_UMS_HAND_NO2.value;
            form.UMS_TEL_NO3.value = form.hTMP_UMS_HAND_NO3.value;
        }
    } else {                                        // �ѽ�
        tableOver("tel");
        if(form.hUMS_TYPE_CD.value == "" && form.hUMS_NO.value == ""){
            form.UMS_TEL_NO1.value = "";
            form.UMS_TEL_NO2.value = "";
            form.UMS_TEL_NO3.value = "";
        }
    }
}

//�ּ� �˾� : �ű� �ּ���ȸ �˾� ���� (2002.11.12)
function NewAddrWindow_ADSL(input,sacd)
{
    var params = "?";

    params = params + "sa_cd="+sacd;

    // �ּ��˾����� �÷��� ������
    params = params + "&trdareacd=" + mainForm.ADSL_DONG_CD.value;              // ���ڵ�
    params = params + "&addrno="    + mainForm.ADSL_ADDR_NO.value;              // ����
    params = params + "&addrho="    + mainForm.ADSL_ADDR_HO.value;              // ȣ
    params = params + "&addrtype="  + mainForm.ADSL_ADDR_TYPE.value;            // �ּ�����
    params = params + "&addrnotype="+ mainForm.ADSL_ADDR_NO_TYPE.value;         // ��������
    params = params + "&bldgname="  + mainForm.ADSL_ADDR_BLDG_NAME.value;       // �ǹ���
    params = params + "&bldgid="    + mainForm.ADSL_ADDR_BLDG_ID.value;         // �ǹ� ID
    params = params + "&addrref="   + mainForm.ADSL_ADDR_BLDG_NO.value;         // �ǹ���/�����ּ�

    // �ּ��˾����� �������� ������
    params = params + "&rtn_addr_type=mainForm.ADSL_ADDR_TYPE.value";            // �ּ�����
    params = params + "&rtn_zipcd=mainForm.ADSL_ZIP.value";                      // �����ȣ
    params = params + "&rtn_trdareacd=mainForm.ADSL_DONG_CD.value";              // ���ڵ�
    params = params + "&rtn_bldg_id=mainForm.ADSL_ADDR_BLDG_ID.value"            // �ǹ� ID
    params = params + "&rtn_bldgtypecd=mainForm.ADSL_ADDR_BLDG_TYPE_CD.value";   // ��������
    params = params + "&rtn_bldg_name=mainForm.ADSL_ADDR_BLDG_NAME.value"        // �ǹ���
    params = params + "&rtn_bldg_ref=mainForm.ADSL_ADDR_REF.value"               // �����ּ�     2003-02-21 9:21����
    params = params + "&rtn_addr_bldg_no=mainForm.ADSL_ADDR_BLDG_NO.value"       // �ǹ� NO
    params = params + "&rtn_addr_bldg_ho=mainForm.ADSL_ADDR_ROOM_NO.value"       // �ǹ�ȣ
    params = params + "&rtn_AddrNoType=mainForm.ADSL_ADDR_NO_TYPE.value";        // ��������
    params = params + "&rtn_AddrNo=mainForm.ADSL_ADDR_NO.value";                 // ����
    params = params + "&rtn_AddrHo=mainForm.ADSL_ADDR_HO.value";                 // ȣ
    params = params + "&rtn_makeaddr=mainForm.ADSL_ADDR_FULL_TEXT.value";        // �ּ�
    params = params + "&rtn_acpt_ofc_cd=mainForm.SVC_OFC_CD.value";              // ���뱹 �ڵ�
    params = params + "&rtn_rs_cd=mainForm.RS_CD.value";                         // RS_CODE

    NewWindow2('/pr/jsp/pr001q_p01.jsp'+params,'','700','550','no','no');
}

//�ּ� �˾�
function NewAddrWindow_PAYER(input,sacd)
{
    var params = "?";

    params = params + "sa_cd="+sacd;

    // �ּ��˾����� �÷��� ������
    params = params + "&trdareacd=" + mainForm.PAYER_DONG_CD.value;                 // ���ڵ�
    params = params + "&addrno="    + mainForm.PAYER_ADDR_NO.value;                 // ����
    params = params + "&addrho="    + mainForm.PAYER_ADDR_HO.value;                 // ȣ
    params = params + "&addrtype="  + mainForm.PAYER_ADDR_TYPE.value;               // �ּ�����
    params = params + "&addrnotype="+ mainForm.PAYER_ADDR_NO_TYPE.value;            // ��������
    params = params + "&bldgname="  + mainForm.PAYER_ADDR_BLDG_NAME.value;          // �ǹ���
    params = params + "&bldgid="    + mainForm.PAYER_ADDR_BLDG_ID.value;            // �ǹ� ID
    params = params + "&addrref="   + mainForm.PAYER_ADDR_BLDG_NO.value;            // �ǹ���/�����ּ�

    // �ּ��˾����� �������� ������
    params = params + "&rtn_addr_type=mainForm.PAYER_ADDR_TYPE.value";              // �ּ�����
    params = params + "&rtn_zipcd=mainForm.PAYER_ZIP.value";                        // �����ȣ
    params = params + "&rtn_trdareacd=mainForm.PAYER_DONG_CD.value";                // ���ڵ�
    params = params + "&rtn_bldg_id=mainForm.PAYER_ADDR_BLDG_ID.value"              // �ǹ� ID
    params = params + "&rtn_bldgtypecd=mainForm.PAYER_ADDR_BLDG_TYPE_CD.value";     // ��������
    params = params + "&rtn_bldg_name=mainForm.PAYER_ADDR_BLDG_NAME.value"          // �ǹ���
    params = params + "&rtn_bldg_ref=mainForm.PAYER_ADDR_REF.value"                 // �����ּ�     2003-02-21 9:21����
    params = params + "&rtn_addr_bldg_no=mainForm.PAYER_ADDR_BLDG_NO.value"         // �ǹ� NO      2003-02-21 9:25����
    params = params + "&rtn_addr_bldg_ho=mainForm.PAYER_ADDR_ROOM_NO.value"         // �ǹ�ȣ
    params = params + "&rtn_AddrNoType=mainForm.PAYER_ADDR_NO_TYPE.value";          // ��������
    params = params + "&rtn_AddrNo=mainForm.PAYER_ADDR_NO.value";                   // ����
    params = params + "&rtn_AddrHo=mainForm.PAYER_ADDR_HO.value";                   // ȣ
    params = params + "&rtn_makeaddr=mainForm.PAYER_ADDR_FULL_TEXT.value";          // �ּ�

    NewWindow2('/pr/jsp/pr001q_p01.jsp'+params,'','700','550','no','no');
}

//������Ŀ���� �̵�
function nextFocus(obj,maxlength) {
    if (obj.value.length == maxlength){
        for (i=0;i<obj.form.length-1;i++){
            if (obj.form[i].tabIndex ==''){
                if (obj.form[i] == obj){
                    index = i+1;
                    break;
                }
            }else{
                if (obj.form[i].tabIndex == obj.tabIndex+1){
                    index = i;
                    break;
                }
            }
        }
        obj.form[index].focus();
        obj.form[index].select();
    }
}

//������Ŀ���� �̵�
function nextFocus2(obj,maxlength) {
    if (obj.value.length == maxlength){
        for (i=0;i<obj.form.length-1;i++){
            if (obj.form[i].tabIndex ==''){
                if (obj.form[i] == obj)
                    index = i+1;
            }else
            if (obj.form[i].tabIndex == obj.tabIndex+1)
                index = i;
        }
    }
}

// ���� ��ȸ �˾�
function listSearch()
{
    var form = document.mainForm;

    if(form.INFOFLAG.value == "0")
    {
        alert("���翩�θ� �����Ͽ� �ּ���!!!");
        return;
    }else
    {
        NewWindow2('/pa/jsp/pa907c_p01.jsp','name','500','350','no','no');
    }
}

// �Ѹ������� üũ�Ѵ�.
function isHanmail(mail){
    if( mail.indexOf("hanmail") > 0 || mail.indexOf("daum") > 0 ){ // �Ѹ����� ����ϰ� �ִٸ�
        return true;
    }
    return false;

}


function isAGENTEMAIL(emailin){
    var mf = document.mainForm;
    if(mf.USR_GB.value != "6" ){ // ������� üũ
        return false;
    }


    var email = mf.AUSER_EMAIL.value;
    if( email == emailin ){
        alert("�� ������ E-Mail�� �Է��ϼ���");
        return true;
    }

    return false;
}

function isAGENTTELNO(telnoin){
    var mf = document.mainForm;
    if(mf.USR_GB.value != "6" ){ // ������� üũ
        return false;
    }

    var telno = mf.AUSER_TEL_NO.value;
    if( telno == telnoin){
        alert("�� ������ ��ȭ��ȣ�� �Է��ϼ���");
        return true;
    }

    return false;
}


function isAGENTCELLNO(telnoin){
    var mf = document.mainForm;
    if(mf.USR_GB.value != "6" ){ // ������� üũ
        return false;
    }

    var cellno = mf.AUSER_CELL_NO.value;

    if( cellno == telnoin){
        alert("�� ������ �ڵ��� ��ȣ�� �Է��ϼ���");
        return true;
    }
    return false;
}


// UMS ó������ �Լ�...(�������� �����...)
function checkUms(){
    var form = document.mainForm;

    if ( form.UMS_TYPE_CD.value == "0" ) {          // ����

    } else if ( form.UMS_TYPE_CD.value == "3" ) {   // ����
        if(isEmpty(form.UMS_EMAIL.value)){
            alert("ó������� �뺸���� �̸����� �����ֽʽÿ�!!!");
            form.UMS_EMAIL.focus();
            return false;
        }

        if(!isEmail(form.UMS_EMAIL.value)){
            alert("ó������� �뺸���� �̸����� ��Ȯ�ϰ� �Է��� �ֽʽÿ�!!!");
            form.UMS_EMAIL.focus();
            return false;
        }

        /*
        if( isHanmail( form.UMS_EMAIL.value ) ){ // �Ѹ��� üũ
            alert("hanmail, daum������ ������ �����Ǽ� �����ϴ�.");
            form.UMS_EMAIL.focus();
            return false;
        }
        */

        ///////
        // ����� ������ ���� ��������.
        if( isAGENTEMAIL(form.UMS_EMAIL.value) == true){
            return false;
        }


        form.UMS_NO.value = form.UMS_EMAIL.value;

    } else if ( form.UMS_TYPE_CD.value == "2" ) {       // ��ȭ��ȣ

        if(isEmpty(form.UMS_TEL_NO1.value) || isEmpty(form.UMS_TEL_NO2.value) || isEmpty(form.UMS_TEL_NO3.value)){

            if(isEmpty(form.UMS_TEL_NO1.value)){
                alert("ó������� �뺸���� ��ȭ��ȣ�� �����ֽʽÿ�!!!");
                form.UMS_TEL_NO1.focus();
                return false;
            }

            if(isEmpty(form.UMS_TEL_NO2.value)){
                alert("ó������� �뺸���� ��ȭ��ȣ�� �����ֽʽÿ�!!!");
                form.UMS_TEL_NO2.focus();
                return false;
            }

            if(isEmpty(form.UMS_TEL_NO3.value)){
                alert("ó������� �뺸���� ��ȭ��ȣ�� �����ֽʽÿ�!!!");
                form.UMS_TEL_NO3.focus();
                return false;
            }

        } else {

            if(!isGenPhone(form.UMS_TEL_NO1.value)){
                alert("ó������� �뺸���� ��ȭ(������ȣ)�� ������ �ʽ��ϴ� !!!");
                form.UMS_TEL_NO1.focus();
                return false;
            }

            if(isLength(form.UMS_TEL_NO2.value) < 2){
                alert("ó������� �뺸���� ��ȭ(����)�� 2�ڸ� �̻��Դϴ� !!");
                form.UMS_TEL_NO2.focus();
                return false;
            }

            if(isLength(form.UMS_TEL_NO3.value) < 4){
                alert("ó������� �뺸���� ��ȭ(��ȣ)�� 4�ڸ� �Դϴ� !!");
                form.UMS_TEL_NO3.focus();
                return false;
            }

        }

        tempTelNoJj = makeFmt4(form.UMS_TEL_NO1.value);
        tempTelNoKk = makeFmt4(form.UMS_TEL_NO2.value);
        tempTelNoNn = makeFmt4(form.UMS_TEL_NO3.value);

        var vTEMPUMSNO = tempTelNoJj + tempTelNoKk + tempTelNoNn;
        if( isAGENTTELNO(vTEMPUMSNO) == true ){

            return false;
        }

        form.UMS_NO.value = tempTelNoJj + tempTelNoKk + tempTelNoNn;




    } else if ( form.UMS_TYPE_CD.value == "1" ) {           // �ܹ��޼���
        if(isEmpty(form.UMS_TEL_NO1.value) || isEmpty(form.UMS_TEL_NO2.value) || isEmpty(form.UMS_TEL_NO3.value)){

            if(isEmpty(form.UMS_TEL_NO1.value)){
                alert("ó������� �뺸���� �ڵ�����ȣ�� �����ֽʽÿ�!!!");
                form.UMS_TEL_NO1.focus();
                return false;
            }

            if(isEmpty(form.UMS_TEL_NO2.value)){
                alert("ó������� �뺸���� �ڵ�����ȣ�� �����ֽʽÿ�!!!");
                form.UMS_TEL_NO2.focus();
                return false;
            }


            if( checkFakeNum() == false ){
                    alert("ó������� �뺸���� �ڵ����� ������ �ٸ��� �Է��Ͽ� �ֽʽÿ� !!");
                    form.UMS_TEL_NO2.focus();
                    return false;
            }


            if(isEmpty(form.UMS_TEL_NO3.value)){
                alert("ó������� �뺸���� �ڵ�����ȣ�� �����ֽʽÿ�!!!");
                form.UMS_TEL_NO3.focus();
                return false;
            }

        } else {

            if(!isCellarPhone( form.UMS_TEL_NO1.value ) ) {
                alert("ó������� �뺸���� �ڵ��� ����� ��ȣ�� ������ �ʽ��ϴ� !!!");
                form.UMS_TEL_NO1.focus();
                return false;
            }

            if(isLength(form.UMS_TEL_NO2.value) < 3){
                alert("ó������� �뺸���� �ڵ����� ������ 3�ڸ� �̻��Դϴ� !!");
                form.UMS_TEL_NO2.focus();
                return false;
            }

            if( checkFakeNum() == false ){
                    alert("ó������� �뺸���� ��ȭ�� ������ �ٸ��� �Է��Ͽ� �ֽʽÿ� !!");
                    form.UMS_TEL_NO2.focus();
                    return false;
            }

            if(isLength(form.UMS_TEL_NO3.value) < 4){
                alert("ó������� �뺸���� �ڵ����� ��ȣ�� 4�ڸ� �Դϴ� !!");
                form.UMS_TEL_NO3.focus();
                return false;
            }

        }

        tempTelNoJj = makeFmt4(form.UMS_TEL_NO1.value);
        tempTelNoKk = makeFmt4(form.UMS_TEL_NO2.value);
        tempTelNoNn = makeFmt4(form.UMS_TEL_NO3.value);

        var vTEMPUMSNO = tempTelNoJj + tempTelNoKk + tempTelNoNn;
        if( isAGENTCELLNO(vTEMPUMSNO) == true ){

            return false;
        }

        form.UMS_NO.value = tempTelNoJj + tempTelNoKk + tempTelNoNn;

    } else {                                // �ѽ�
        if(isEmpty(form.UMS_TEL_NO1.value) || isEmpty(form.UMS_TEL_NO2.value) || isEmpty(form.UMS_TEL_NO3.value)){

            if(isEmpty(form.UMS_TEL_NO1.value)){
                alert("ó������� �뺸���� �ѽ���ȣ�� �����ֽʽÿ�!!!");
                form.UMS_TEL_NO1.focus();
                return false;
            }

            if(isEmpty(form.UMS_TEL_NO2.value)){
                alert("ó������� �뺸���� �ѽ���ȣ�� �����ֽʽÿ�!!!");
                form.UMS_TEL_NO2.focus();
                return false;
            }

            if(isEmpty(form.UMS_TEL_NO3.value)){
                alert("ó������� �뺸���� �ѽ���ȣ�� �����ֽʽÿ�!!!");
                form.UMS_TEL_NO3.focus();
                return false;
            }

        }else{

            if(!isGenPhone(form.UMS_TEL_NO1.value)){
                alert("ó������� �뺸���� �ѽ��� ������ȣ�� ������ �ʽ��ϴ� !!!");
                form.UMS_TEL_NO1.focus();
                return false;
            }

            if(isLength(form.UMS_TEL_NO2.value) < 2){
                alert("ó������� �뺸���� �ڽ��� ������ 2�ڸ� �̻��Դϴ� !!");
                form.UMS_TEL_NO2.focus();
                return false;
            }else



            if( checkFakeNum() == false ){
                    alert("ó������� �뺸���� �ѽ��� ������ �ٸ��� �Է��Ͽ� �ֽʽÿ� !!");
                    form.UMS_TEL_NO2.focus();
                    return false;
            }


            if(isLength(form.UMS_TEL_NO3.value) < 4){
                alert("ó������� �뺸���� �ѽ��� ��ȣ�� 4�ڸ� �Դϴ� !!");
                form.UMS_TEL_NO3.focus();
                return false;
            }

        }

        tempTelNoJj = makeFmt4(form.UMS_TEL_NO1.value);
        tempTelNoKk = makeFmt4(form.UMS_TEL_NO2.value);
        tempTelNoNn = makeFmt4(form.UMS_TEL_NO3.value);

        form.UMS_NO.value = tempTelNoJj + tempTelNoKk + tempTelNoNn;

    }
    return true;
}


function checkFakeNum(fakeNum){

    if(
        fakeNum == '0000' ||
        fakeNum == '1111' ||
        fakeNum == '2222' ||
        fakeNum == '3333' ||
        fakeNum == '4444' ||
        fakeNum == '5555' ||
        fakeNum == '6666' ||
        fakeNum == '7777' ||
        fakeNum == '8888' ||
        fakeNum == '9999'
    ){
        return false;
    }


}
//[3775] START
function checkCertYn() {

	var form = document.mainForm;


	try{

		if( form.SERT_LOGIN_FLAG.value != "") return true;

		if( form.SERT_URL_SIGN_YN.value == "Y" || form.SERT_URL_SIGN_YN.value == "T"  ) {


			if( ( form.USR_GB.value != "5"  && form.USR_GB.value != "6" &&
				form.USR_GB.value != "7"  && form.SERT_USR_TYPE_GB.value != "1" && form.EXT_CORP_CD.value == "") ||
				( form.USR_GB.value != "5"  && form.USR_GB.value != "6" &&
				form.USR_GB.value != "7" && form.SERT_USR_TYPE_GB.value != "1"  &&  form.EXT_CORP_CD.value == "99")  )
			{

				if(  form.SERT_URL_SIGN_YN.value == "Y"  &&  form.SERT_PUB_CERT_FLAG.value != "Y" ) {
					alert("���������� �ʿ��� �۾��̹Ƿ� ���� ���������� �� �ּ���.");
					return false;
				}
				else if(  form.SERT_URL_SIGN_YN.value == "T"  &&  ( form.SERT_PUB_CERT_FLAG.value == "N"  &&  form.SERT_MOB_CERT_FLAG.value == "N" ) ) {
					alert("[�޴�������],[��������] �� \n\n�ϳ��� �����Ͽ� ���������� �� �ּ���");
					return false;
				}
			}
		}
     }catch(E){

     }

	return true;
}
//[3775] END
// ��û�ڻ��� �Է��׸� üũ �Լ�...(�������� �����...)
function checkReqer(chkIAType){

    //���̹��� ��û�� ������ �Է����� �ʾƿ�~~
    if( chkIAType == "IA_CYBER") {
		return true;
	}
	//[3775] START
	if( checkCertYn() == false) {
		return false;
	}
	//[3775] END

    var form = document.mainForm;

    //��û��ȣ:[3906]��ǰ ��ûȭ�� ���� �ο�-������� CM ���� Ŀ�´����̼� ����-��ȸ�� ���� ���:�ڰ��:2007-09-19
	/* ��� ����
    if( form.USR_GB.value == "5") {
    	alert("�������� �� �� �ִ� ������ �����ϴ�.");
    	return false;
    }
    */
    //var varSpecialChar = '[]~!@#$%^&*()_+|`-=\[]{}:\"<>?,./ 0123456789';
    ////////////
    // 2005-03-07 3:41���� * ����
    var varSpecialChar = '[]~!@#$%^&()_+|`-=\[]{}:\"<>?,./ 0123456789';
    if (isLength(form.REQER_NAME.value) ==0) {
        alert("��û�ڸ��� �ùٸ��� �Է��� �ֽʽÿ�!(�ִ� 30�ڸ����� �Է°���)");
        form.REQER_NAME.focus();
        return false;
    }

    if (isLength(form.REQER_NAME.value) > 50) {
        alert("��û�ڸ��� �ùٸ��� �Է��� �ֽʽÿ�!(�ִ� 50�ڸ����� �Է°���)");
        form.REQER_NAME.focus();
        return false;
    }

    if (isValidValue(form.REQER_NAME.value, varSpecialChar) == false) {
        alert("��û�ڸ��� �ùٸ��� �Է��� �ֽʽÿ�!");
        form.REQER_NAME.focus();
        form.REQER_NAME.select();
        return false;
    }

	//[4060]
	try{
		if( form.USR_GB.value == "5" || form.USR_GB.value == "6" ){
			if( (form.DDMS_SVC_MODE == null || form.DDMS_SVC_MODE.value == "" ||  form.DDMS_SVC_MODE.value != "TRUE")) {
				if( form.REQER_CUST_NO1.value == "" || form.REQER_CUST_NO2.value == "" ) {
					alert("��û�� �ֹι�ȣ�� �Է��ϼ���.");
					if( form.REQER_CUST_NO1.value == "" ) form.REQER_CUST_NO1.focus();
					if( form.REQER_CUST_NO2.value == "" ) form.REQER_CUST_NO2.focus();
					return false;
				}
			}

		}
    }catch(e){
    }


    if ( !eval(form.REQER_CNTC_NO_JJ) ) {

        //������ȭ��ȣ1 check
		//2007-08-08 START
        tmpREQER_CNTC_NO = makeFmt4(form.REQER_CNTC_NO1.value)
                                 + makeFmt4(form.REQER_CNTC_NO2.value)
                                 + makeFmt4(form.REQER_CNTC_NO3.value);

        tempREQER_CNTC_HP_NO = trim(form.REQER_CNTC_HP_NO1.value)
                                +  trim(form.REQER_CNTC_HP_NO2.value)
                                +  trim(form.REQER_CNTC_HP_NO3.value);

        if( isLength(tmpREQER_CNTC_NO) == 0 && isLength(tempREQER_CNTC_HP_NO)==0) {
        	alert("��û�� ������ �޴���ȭ�� ������ȭ �� �ϳ��� �ݵ�� �Է��ؾ� �մϴ�.");
        	return false;
        }
        //2007-08-08 END

        if( isLength(form.REQER_CNTC_NO1.value) > 0){
            //if( !isGenPhone(form.REQER_CNTC_NO1.value) && !isCellarPhone(form.REQER_CNTC_NO1.value) && !isPnaPhone(form.REQER_CNTC_NO1.value) ){
            if( !isCellarPhone(form.REQER_CNTC_NO1.value)){
                alert('��û�� ������ �޴���ȭ�� ������ȣ�� Ȯ���ϼ���.');
                form.REQER_CNTC_NO1.focus();
                form.REQER_CNTC_NO1.select();
                return false;
            }

            if( isLength(form.REQER_CNTC_NO2.value) < 2){
                alert('��û�� ������ �޴���ȭ�� ������ Ȯ���ϼ���.');
                form.REQER_CNTC_NO2.focus();
                form.REQER_CNTC_NO2.select();
                return false;
            }

            if( isLength(form.REQER_CNTC_NO3.value) != 4){
                alert('��û�� ������ �޴���ȭ�� ��ȭ��ȣ�� Ȯ���ϼ���.');
                form.REQER_CNTC_NO3.focus();
                form.REQER_CNTC_NO3.select();
                return false;
            }


        } else {

             if( isLength(form.REQER_CNTC_NO1.value)  == 0 &&  tmpREQER_CNTC_NO > 1 )
             {

                alert('��û�� ������ �޴���ȭ�� ������ȣ�� Ȯ���ϼ���.');
                form.REQER_CNTC_NO1.focus();
                form.REQER_CNTC_NO1.select();
                return false;
             }
        }



        /*
        if ( !chkFmtTelNo(form.REQER_CNTC_NO1, form.REQER_CNTC_NO2, form.REQER_CNTC_NO3, '1', '1') ) {
            return false;
        }
        */

        form.REQER_CNTC_NO.value = makeFmt4(form.REQER_CNTC_NO1.value)
                                 + makeFmt4(form.REQER_CNTC_NO2.value)
                                 + makeFmt4(form.REQER_CNTC_NO3.value);



        if( isLength(form.REQER_CNTC_HP_NO1.value) > 0){
            //if( !isGenPhone(form.REQER_CNTC_HP_NO1.value) && !isCellarPhone(form.REQER_CNTC_HP_NO1.value) && !isPnaPhone(form.REQER_CNTC_HP_NO1.value)){
            if( !isGenPhone(form.REQER_CNTC_HP_NO1.value) && !isVoipCheck(form.REQER_CNTC_HP_NO1.value) && !isPnaPhone(form.REQER_CNTC_HP_NO1.value)){
                alert('��û�� ������ ������ȭ�� ������ȣ�� Ȯ���ϼ���.');
                form.REQER_CNTC_HP_NO1.focus();
                form.REQER_CNTC_HP_NO1.select();
                return false;
            }

            if( isLength(form.REQER_CNTC_HP_NO2.value) < 2){
                alert('��û�� ������ ������ȭ�� ������ Ȯ���ϼ���.');
                form.REQER_CNTC_HP_NO2.focus();
                form.REQER_CNTC_HP_NO2.select();
                return false;
            }

            if( isLength(form.REQER_CNTC_HP_NO3.value) != 4){
                alert('��û�� ������ ������ȭ�� ��ȭ��ȣ�� Ȯ���ϼ���.');
                form.REQER_CNTC_HP_NO3.focus();
                form.REQER_CNTC_HP_NO3.select();
                return false;
            }


        } else {

            if( isLength(form.REQER_CNTC_HP_NO1.value)  == 0 &&  tempREQER_CNTC_HP_NO > 1 )
            {
              alert('��û�� ������ ������ȭ�� ������ȣ�� Ȯ���ϼ���.');
              form.REQER_CNTC_HP_NO1.focus();
              form.REQER_CNTC_HP_NO1.select();
              return false;

            }
        }


        // �ڵ����̰� Non�ʼ��Է� �׸�
        /*
        if ( !chkFmtTelNo(form.REQER_CNTC_HP_NO1, form.REQER_CNTC_HP_NO2, form.REQER_CNTC_HP_NO3, '2', '2') ) {
            return false;
        }
        */

        tempREQER_CNTC_HP_NO = trim(form.REQER_CNTC_HP_NO1.value)
                                +  trim(form.REQER_CNTC_HP_NO2.value)
                                +  trim(form.REQER_CNTC_HP_NO3.value);

        if (tempREQER_CNTC_HP_NO != "") {
            form.REQER_CNTC_HP_NO.value = makeFmt4(form.REQER_CNTC_HP_NO1.value)
                                        + makeFmt4(form.REQER_CNTC_HP_NO2.value)
                                        + makeFmt4(form.REQER_CNTC_HP_NO3.value);
        }
    } else {

		//2007-08-08 START
        tmpREQER_CNTC_NO = makeFmt4(form.REQER_CNTC_NO_JJ.value)
                                 + makeFmt4(form.REQER_CNTC_NO_KK.value)
                                 + makeFmt4(form.REQER_CNTC_NO_NN.value);

        tempREQER_CNTC_HP_NO = trim(form.REQER_CNTC_HP_NO_JJ.value)
                                +  trim(form.REQER_CNTC_HP_NO_KK.value)
                                +  trim(form.REQER_CNTC_HP_NO_NN.value);

        if( isLength(tmpREQER_CNTC_NO) == 0 && isLength(tempREQER_CNTC_HP_NO)==0) {
        	alert("��û�� ������ �޴���ȭ�� ������ȭ �� �ϳ��� �ݵ�� �Է��ؾ� �մϴ�.");
        	return false;
        }
        //2007-08-08 END


        if( isLength(form.REQER_CNTC_NO_JJ.value) > 0){
            //if( !isGenPhone(form.REQER_CNTC_NO_JJ.value) && !isCellarPhone(form.REQER_CNTC_NO_JJ.value)  ){
            if( !isCellarPhone(form.REQER_CNTC_NO_JJ.value)  ){
                alert('��û�� ������ �޴���ȭ�� ������ȣ�� Ȯ���ϼ���.');
                form.REQER_CNTC_NO_JJ.focus();
                form.REQER_CNTC_NO_JJ.select();
                return false;
            }

            if( isLength(form.REQER_CNTC_NO_KK.value) < 2){
                alert('��û�� ������ �޴���ȭ�� ������ Ȯ���ϼ���.');
                form.REQER_CNTC_NO_KK.focus();
                form.REQER_CNTC_NO_KK.select();
                return false;
            }

            if( isLength(form.REQER_CNTC_NO_NN.value) != 4){
                alert('��û�� ������ �޴���ȭ�� ��ȭ��ȣ�� Ȯ���ϼ���.');
                form.REQER_CNTC_NO_NN.focus();
                form.REQER_CNTC_NO_NN.select();
                return false;
            }


        } else {
            if( isLength(form.REQER_CNTC_NO_JJ.value)  == 0 &&  tmpREQER_CNTC_NO > 1 )
            {
               alert('��û�� ������ �޴���ȭ�� ������ȣ�� Ȯ���ϼ���.');
               form.REQER_CNTC_NO_JJ.focus();
               form.REQER_CNTC_NO_JJ.select();
               return false;
            }
        }


        /*
        if ( !chkFmtTelNo(form.REQER_CNTC_NO_JJ, form.REQER_CNTC_NO_KK, form.REQER_CNTC_NO_NN, '1', '1') ) {
            return false;
        }
        */

        form.REQER_CNTC_NO.value = makeFmt4(form.REQER_CNTC_NO_JJ.value)
                                 + makeFmt4(form.REQER_CNTC_NO_KK.value)
                                 + makeFmt4(form.REQER_CNTC_NO_NN.value);




        if( isLength(form.REQER_CNTC_HP_NO_JJ.value) > 0){
            //if( !isGenPhone(form.REQER_CNTC_HP_NO_JJ.value) && !isCellarPhone(form.REQER_CNTC_HP_NO_JJ.value) ){
            if( !isGenPhone(form.REQER_CNTC_HP_NO_JJ.value) && !isVoipCheck(form.REQER_CNTC_HP_NO_JJ.value) && !isPnaPhone(form.REQER_CNTC_HP_NO_JJ.value) ){
                alert('��û�� ������ ������ȭ�� ������ȣ�� Ȯ���ϼ���.');
                form.REQER_CNTC_HP_NO_JJ.focus();
                form.REQER_CNTC_HP_NO_JJ.select();
                return false;
            }

            if( isLength(form.REQER_CNTC_HP_NO_KK.value) < 2){
                alert('��û�� ������ ������ȭ�� ������ Ȯ���ϼ���.');
                form.REQER_CNTC_HP_NO_KK.focus();
                form.REQER_CNTC_HP_NO_KK.select();
                return false;
            }

            if( isLength(form.REQER_CNTC_HP_NO_NN.value) != 4){
                alert('��û�� ������ ������ȭ�� ��ȭ��ȣ�� Ȯ���ϼ���.');
                form.REQER_CNTC_HP_NO_NN.focus();
                form.REQER_CNTC_HP_NO_NN.select();
                return false;
            }


        } else {
            if( isLength(form.REQER_CNTC_HP_NO_JJ.value)  == 0 &&  tempREQER_CNTC_HP_NO > 1 )
            {
              alert('��û�� ������ ������ȭ�� ������ȣ�� Ȯ���ϼ���.');
              form.REQER_CNTC_HP_NO_JJ.focus();
              form.REQER_CNTC_HP_NO_JJ.select();
              return false;
            }

        }



        /*
        // �ڵ����̰� Non�ʼ��Է� �׸�
        if ( !chkFmtTelNo(form.REQER_CNTC_HP_NO_JJ, form.REQER_CNTC_HP_NO_KK, form.REQER_CNTC_HP_NO_NN, '2', '2') ) {
            return false;
        }
        */

        var tempREQER_CNTC_HP_NO = trim(form.REQER_CNTC_HP_NO_JJ.value)
                                +  trim(form.REQER_CNTC_HP_NO_KK.value)
                                +  trim(form.REQER_CNTC_HP_NO_NN.value);

        if (tempREQER_CNTC_HP_NO != "") {
            form.REQER_CNTC_HP_NO.value = makeFmt4(form.REQER_CNTC_HP_NO_JJ.value)
                                        + makeFmt4(form.REQER_CNTC_HP_NO_KK.value)
                                        + makeFmt4(form.REQER_CNTC_HP_NO_NN.value);
        }
    }


    //�����ּ�/��Ÿ

    if (isLength(form.REQER_ADDR.value) > 200) {
        alert("��û�� ������ ��������� �ִ� 200�ڸ����� �Է°����մϴ�");
        form.REQER_ADDR.focus();
        return false;
    }

    if (isLength(form.REQER_ADDR.value) != 0) {
        if (isValidValue(form.REQER_ADDR.value, varSpecialChar) == false) {
            alert("��û�� ������ ��������� �ٸ��� �Է��Ͽ� �ֽʽÿ�.");
            form.REQER_ADDR.focus();
            form.REQER_ADDR.select();
            return false;
        }
    }

    return true;

}

//���ݹ�ȣ ��밡�� üũ
function checkBill() {

    var form = document.mainForm;
    if(form.RTN_PAYER_LIFE_CYCLE.value =="P") {
        alert("���ݹ�ȣ�� �������� ��ȭ��ȣ�Դϴ�. �ٽ� �Է��ϼ���");
        form.PAYER_PAY_TEL_NO1.focus();
        return false;
    }
    if(form.RTN_PAYER_LIFE_CYCLE.value =="F"||form.RTN_PAYER_LIFE_CYCLE.value =="D") {
        alert("���ݹ�ȣ�� ö������ ��ȭ��ȣ�Դϴ�. �ٽ� �Է��ϼ���");
        form.PAYER_PAY_TEL_NO1.focus();
        return false;
    }
    if(form.RTN_PAYER_SVC_STATUS_CD.value=="05") {
        alert("���ݹ�ȣ�� �Ͻ��̿����� ��ȭ��ȣ�Դϴ�. �ٽ� �Է��ϼ���");
        form.PAYER_PAY_TEL_NO1.focus();
        return false;
    }
    if(form.RTN_PAYER_SVC_STATUS_CD.value!="02") {
        alert("���ݹ�ȣ�� ������� �ƴմϴ�. �ٽ� �Է��ϼ���");
        form.PAYER_PAY_TEL_NO1.focus();
        return false;
    }
    if(form.RTN_PAYER_SA_CD.value=="0507"||form.RTN_PAYER_SA_CD.value=="0508") {
        alert("���ݹ�ȣ�� ������ȭ ��ȣ�Դϴ�. �ٽ��Է��ϼ���");
        form.PAYER_PAY_TEL_NO1.focus();
        return false;
    }

    if(form.RTN_PAYER_KT_USE_FLAG.value=="1") {
        if(form.ATEL_OFC_CD.value!="000159") {
            alert("���ݹ�ȣ�� KT������Դϴ�. ������ȭ�������� ó���� �� �ֽ��ϴ�.");
            form.PAYER_PAY_TEL_NO1.focus();
            return false;
        }
    }
    return true;
}



// �������� ���� ����ڻ��� �Է��׸� üũ �Լ�.(�������� �����...) 2003-05-19 10:53����
function checkCustComm(){
    var form = document.mainForm;
    if(form.RTN_CUST_ID.value =="") {
        alert("����ڻ����� �Է��ϰ� ��ȸ�ϼ���.");
        form.SEARCH_CUST_NO.focus();
        return false;
    }
    return true;
}

// �������� ���� �����ڻ��� �Է��׸� üũ �Լ�.(�������� �����...) 2003-05-19 10:53����
function checkPayerComm(){
    var form = document.mainForm;
    //�ջ� û���� ��û�� ���
    if(form.PAYER_PAY_GB(0).checked ==true) {
        if(form.RTN_PAYER_LINKNO.value =="") {
            alert("�����ڻ����� �Է��ϰ� ��ȸ�ϼ���.");
            form.PAYER_PAY_TEL_NO1.focus();
            return false;
        }
        if(form.RTN_PAYER_PAY_TEL_NO1.value!=form.PAYER_PAY_TEL_NO1.value ||
            form.RTN_PAYER_PAY_TEL_NO2.value!=form.PAYER_PAY_TEL_NO2.value ||
            form.RTN_PAYER_PAY_TEL_NO3.value!=form.PAYER_PAY_TEL_NO3.value ) {
            alert("�Է��Ͻ� ������ ������ ��ȭ��ȣ�� ��ȸ�ϼ���.");
            form.PAYER_SEARCH1.focus();
            return false;
        }
    //����û���� ������ ������ ���
    }else if(form.PAYER_PAY_GB(1).checked ==true) {
    //����û���� ������ ��å�� ���
    }else if(form.PAYER_PAY_GB(2).checked ==true) {

    }
    return true;

}

function checkReqComm() {
    var form = document.mainForm;
    if(isEmpty(form.REQER_NAME.value)){
        alert("��û�ڸ��� �ùٸ��� �Է��� �ֽʽÿ�!(�ִ� 30�ڸ����� �Է°���)");
        form.REQER_NAME.focus();
        return false
    }
    return true;
}


// ����ڻ��� �Է��׸� üũ �Լ�...(�������� �����...)
function checkCust(){

    var form = document.mainForm;
    var strCustNo       = form.CUST_NO.value;
    var strCustNoType   = form.CUST_NO_TYPE.value;


    // ������
    var strCustType = document.mainForm.CUST_TYPE.selectedIndex;
    if (strCustType < 0) {
        alert("������� �������� ������ �ֽʽÿ�!");
        form.CUST_TYPE.focus();
        return false;
    }

    // �ĺ���ȣ
    if ( strCustNoType == "1" ) {   // �ֹε�Ϲ�ȣ
        if ( (isLength(strCustNo) != 13) || (!isInteger(strCustNo,"")) ) {
            alert("����� �ĺ���ȣ(�ֹε�Ϲ�ȣ)�� �ùٸ��� �Է��� �ֽʽÿ�!");
            form.CUST_NO.focus();
            return false;
        }
        if ( !isRegNo(strCustNo.substr(0,6), strCustNo.substr(6,7)) ) {
            form.CUST_NO.focus();
            return false;
        }
    } else
    if ( strCustNoType == "3" ) {   // ���ι�ȣ
        if ( (isLength(strCustNo) != 13 ) || (!isInteger(strCustNo,"")) ) {
            alert("����� �ĺ���ȣ(���ι�ȣ)�� �Է��� �ֽʽÿ�!");
            form.CUST_NO.focus();
            return false;
        }
        if ( !isCorporationNo(strCustNo) ) {
            alert("����� �ĺ���ȣ(���ι�ȣ)�� �ùٸ��� �Է��� �ֽʽÿ�!");
            form.CUST_NO.focus();
            return false;
        }
    } else {
        if (isLength(strCustNo) < 2) {
            alert("����� �ĺ���ȣ�� �Է��� �ֽʽÿ�!");
            form.CUST_NO.focus();
            return false;
        }
    }


    //����ڸ�
    if (isEmpty(form.CUST_NAME.value)) {
        alert("����ڸ��� �Է��� �ֽʽÿ�!(�ִ� 50�ڸ����� �Է°���)");
        form.CUST_NAME.focus();
        return false;
    }
    else if (isLength(form.CUST_NAME.value) > 50) {
        alert("����ڸ��� �ùٸ��� �Է��� �ֽʽÿ�!(�ִ� 50�ڸ����� �Է°���)");
        form.CUST_NAME.focus();
        return false;
    }
    else if (isValidValue(form.CUST_NAME.value, varSYMBOL) == false) {
        alert("����ڸ��� �ùٸ��� �Է��� �ֽʽÿ�!");
        form.CUST_NAME.focus();
        return false;
    }

    //����� ������ȣ
    if ( !eval(form.CUST_CNTC_TEL_NO_JJ) ) {

        // �Ϲ���ȭ �Ǵ� �ڵ����̰� �ʼ��Է� �׸�
        if ( !chkFmtTelNo(form.CUST_CNTC_TEL_NO1, form.CUST_CNTC_TEL_NO2, form.CUST_CNTC_TEL_NO3, '3', '1') ) {

            return false;
        }

        form.CUST_CNTC_TEL_NO.value = makeFmt4(form.CUST_CNTC_TEL_NO1.value)
                                    + makeFmt4(form.CUST_CNTC_TEL_NO2.value)
                                    + makeFmt4(form.CUST_CNTC_TEL_NO3.value);

    } else {

        // �Ϲ���ȭ �Ǵ� �ڵ����̰� �ʼ��Է� �׸�
        if ( !chkFmtTelNo(form.CUST_CNTC_TEL_NO_JJ, form.CUST_CNTC_TEL_NO_KK, form.CUST_CNTC_TEL_NO_NN, '3', '1') ) {
            return false;
        }

        form.CUST_CNTC_TEL_NO.value = makeFmt4(form.CUST_CNTC_TEL_NO_JJ.value)
                                    + makeFmt4(form.CUST_CNTC_TEL_NO_KK.value)
                                    + makeFmt4(form.CUST_CNTC_TEL_NO_NN.value);

    }

    var strCUST_CNTC_EMAIL_ADDR = trim(form.CUST_CNTC_EMAIL_ADDR.value);
    if (strCUST_CNTC_EMAIL_ADDR.length > 0) {
        if (!isEmail(strCUST_CNTC_EMAIL_ADDR)) {
            alert("����� E-Mail �ּҸ� �ùٸ��� �Է��� �ֽʽÿ�!");
            form.CUST_CNTC_EMAIL_ADDR.focus();
            return false;
        }
    }

    //�����ּ� �� ��Ÿ 2002.04.23
    var strCUST_ADDR = trim(form.CUST_ADDR.value);
    if (isLength(strCUST_ADDR) > 0) {
        if (isLength(strCUST_ADDR)  >    99) {
            alert("����� �����ּ�/��Ÿ������ �ùٸ��� �Է��� �ֽʽÿ�!(�ִ� 100�ڸ����� ����)");
            form.CUST_ADDR.focus();
            return false;
        }
    }
    if (isValidValue(strCUST_ADDR, varSYMBOL) == false) {
        alert("����� �����ּ�/��Ÿ������ �ùٸ��� �Է��� �ֽʽÿ�!");
        form.CUST_ADDR.focus();
        return false;
    }

    return true;
}

// �����ڻ��� ����...(�������� �����...)
function lf_bill_data_display(bill_flag ) {

    var form    =   document.mainForm;

    form.PAYER_PAY_GB[0].disabled = true;
    form.PAYER_PAY_GB[1].disabled = true;

    if (bill_flag == '2') { // ����û���� ����
        form.PAYER_PAY_TELNO1.disabled      = true;
        form.PAYER_PAY_TELNO2.disabled      = true;
        form.PAYER_PAY_TELNO3.disabled      = true;

        form.PAYER_ADDR_FULL_TEXT.readonly  = true;
        form.PAYER_ADDR_SEARCH.disabled     = false;    //�ּ��Է¹�ư

        form.PAYER_PAY_TELNO1.style.background      = "#FFFFFF";
        form.PAYER_PAY_TELNO2.style.background      = "#FFFFFF";
        form.PAYER_PAY_TELNO3.style.background      = "#FFFFFF";
        form.PAYER_ADDR_FULL_TEXT.style.background  = "#E3E4E6";

    } else {    // ��ȭ����ջ�

        form.PAYER_PAY_TELNO1.disabled      = false;
        form.PAYER_PAY_TELNO2.disabled      = false;
        form.PAYER_PAY_TELNO3.disabled      = false;

        form.PAYER_ADDR_FULL_TEXT.readonly  = true;
        form.PAYER_ADDR_SEARCH.disabled     = true;     //�ּ��Է¹�ư

        form.PAYER_PAY_TELNO1.style.background      = "#FCFCDF";
        form.PAYER_PAY_TELNO2.style.background      = "#FCFCDF";
        form.PAYER_PAY_TELNO3.style.background      = "#FCFCDF";
        form.PAYER_ADDR_FULL_TEXT.style.background  = "#FFFFFF";

    }

    // �ڵ���ü ����
    lf_check_Payer_Autopay_gb();
    form.PAYER_AUTOPAY_GB_CHK.disabled  = true; //�ڵ���ü����
}

// �����ڻ��� ����...(�������� �����...)
function lf_bill_data_display_020515(bill_flag ) {

    var form    =   document.mainForm;

    form.PAYER_PAY_GB[0].disabled = true;
    form.PAYER_PAY_GB[1].disabled = true;

    if (bill_flag == '2') { // ����û���� ����
        form.PAYER_PAY_TELNO1.disabled      = true;
        form.PAYER_PAY_TELNO2.disabled      = true;
        form.PAYER_PAY_TELNO3.disabled      = true;

        form.PAYER_ADDR_FULL_TEXT.readonly  = true;
        form.PAYER_ADDR_SEARCH.disabled     = false;    //�ּ��Է¹�ư

        form.PAYER_PAY_TELNO1.style.background      = "#FFFFFF";
        form.PAYER_PAY_TELNO2.style.background      = "#FFFFFF";
        form.PAYER_PAY_TELNO3.style.background      = "#FFFFFF";
        form.PAYER_ADDR_FULL_TEXT.style.background  = "#E3E4E6";

        form.PAYER_INV_MEDIA_CD[0].disabled     =   false;      // 2002.05.15
        form.PAYER_INV_MEDIA_CD[1].disabled     =   false;      // 2002.05.15

        form.PAYER_SHEET_OPTION_FLAG_CHK.disabled   =   true;       // 2002.05.15

        lf_invmedia_control(01);                 // �ܵ�û�� ���ý� ���ʴ�(���̹������� ��)


    } else {    // ��ȭ����ջ�
        form.PAYER_PAY_TELNO1.disabled      = false;
        form.PAYER_PAY_TELNO2.disabled      = false;
        form.PAYER_PAY_TELNO3.disabled      = false;

        form.PAYER_ADDR_FULL_TEXT.readonly  = true;
        form.PAYER_ADDR_SEARCH.disabled     = true;     //�ּ��Է¹�ư

        form.PAYER_PAY_TELNO1.style.background      = "#FCFCDF";
        form.PAYER_PAY_TELNO2.style.background      = "#FCFCDF";
        form.PAYER_PAY_TELNO3.style.background      = "#FCFCDF";
        form.PAYER_ADDR_FULL_TEXT.style.background  = "#FFFFFF";


        form.PAYER_INV_MEDIA_CD[0].disabled     =   true;       // 2002.05.15
        form.PAYER_INV_MEDIA_CD[1].disabled     =   true;       // 2002.05.15
        form.PAYER_SHEET_OPTION_FLAG_CHK.disabled   =   true;       // 2002.05.15
    }

    form.PAYER_EMAIL_ID.disabled            =   true;       // 2002.05.15
    form.PAYER_EMAIL_ID.style.background    =   "#E3E4E6";  // 2002.05.15
    // �ڵ���ü ����
    lf_check_Payer_Autopay_gb();
    form.PAYER_AUTOPAY_GB_CHK.disabled  = true; //�ڵ���ü����
}

// �����ڻ����� ���ι�Ŀ� ���� ����...(�������� �����...)
function lf_bill_display(bill_flag ) {

    var form    =   document.mainForm;

    if (bill_flag == '2') { // ����û���� ����
        form.PAYER_PAY_TELNO1.disabled      = true;
        form.PAYER_PAY_TELNO2.disabled      = true;
        form.PAYER_PAY_TELNO3.disabled      = true;

        form.PAYER_ADDR_FULL_TEXT.readonly  = true;
        form.PAYER_ADDR_SEARCH.disabled     = false;    //�ּ��Է¹�ư

        form.PAYER_AUTOPAY_GB_CHK.disabled  = false;    //�ڵ���ü����
        form.PAYER_AUTOPAY_GB_CHK.checked   = true;
        lf_check_Payer_Autopay_gb();
/*
        form.PAYER_PAY_TELNO1.value         = "";
        form.PAYER_PAY_TELNO2.value         = "";
        form.PAYER_PAY_TELNO3.value         = "";
*/
        form.PAYER_PAY_TELNO1.style.background      = "#FFFFFF";
        form.PAYER_PAY_TELNO2.style.background      = "#FFFFFF";
        form.PAYER_PAY_TELNO3.style.background      = "#FFFFFF";
        form.PAYER_ADDR_FULL_TEXT.style.background  = "#E3E4E6";


    } else {    // ��ȭ����ջ�
        form.PAYER_PAY_TELNO1.disabled      = false;
        form.PAYER_PAY_TELNO2.disabled      = false;
        form.PAYER_PAY_TELNO3.disabled      = false;


        form.PAYER_ADDR_FULL_TEXT.readonly  = true;
        form.PAYER_ADDR_SEARCH.disabled     = true;     //�ּ��Է¹�ư

        form.PAYER_AUTOPAY_GB_CHK.disabled  = true;     //�ڵ���ü����
        form.PAYER_AUTOPAY_GB_CHK.checked   = false;
        lf_check_Payer_Autopay_gb();

        form.PAYER_PAY_TELNO1.style.background      = "#FCFCDF";
        form.PAYER_PAY_TELNO2.style.background      = "#FCFCDF";
        form.PAYER_PAY_TELNO3.style.background      = "#FCFCDF";
        form.PAYER_ADDR_FULL_TEXT.style.background  = "#FFFFFF";

        form.PAYER_PAY_TELNO1.focus();


    }

}

function lf_bill_display_020515(bill_flag ) {

    var form    =   document.mainForm;

    if (bill_flag == '2') { // ����û���� ����
        form.PAYER_PAY_TELNO1.disabled      = true;
        form.PAYER_PAY_TELNO2.disabled      = true;
        form.PAYER_PAY_TELNO3.disabled      = true;

        form.PAYER_ADDR_FULL_TEXT.readonly  = true;
        form.PAYER_ADDR_SEARCH.disabled     = false;    //�ּ��Է¹�ư

        form.PAYER_AUTOPAY_GB_CHK.disabled  = false;    //�ڵ���ü����
        form.PAYER_AUTOPAY_GB_CHK.checked   = true;
        lf_check_Payer_Autopay_gb();

        form.PAYER_PAY_TELNO1.style.background      = "#FFFFFF";
        form.PAYER_PAY_TELNO2.style.background      = "#FFFFFF";
        form.PAYER_PAY_TELNO3.style.background      = "#FFFFFF";
        form.PAYER_ADDR_FULL_TEXT.style.background  = "#E3E4E6";

        form.PAYER_INV_MEDIA_CD[0].disabled     =   false;      // 2002.05.15 jwc
        form.PAYER_INV_MEDIA_CD[0].checked      =   true;       // 2002.05.15
        form.PAYER_INV_MEDIA_CD[1].disabled     =   false;      // 2002.05.15
        form.PAYER_SHEET_OPTION_FLAG_CHK.disabled   =   false;      // 2002.05.15
        form.PAYER_SHEET_OPTION_FLAG_CHK.checked    =   true;       // 2002.05.15

    } else {    // ��ȭ����ջ�
        form.PAYER_PAY_TELNO1.disabled      = false;
        form.PAYER_PAY_TELNO2.disabled      = false;
        form.PAYER_PAY_TELNO3.disabled      = false;


        form.PAYER_ADDR_FULL_TEXT.readonly  = true;
        form.PAYER_ADDR_SEARCH.disabled     = true;     //�ּ��Է¹�ư

        form.PAYER_AUTOPAY_GB_CHK.disabled  = true;     //�ڵ���ü����
        form.PAYER_AUTOPAY_GB_CHK.checked   = false;
        lf_check_Payer_Autopay_gb();

        form.PAYER_PAY_TELNO1.style.background      = "#FCFCDF";
        form.PAYER_PAY_TELNO2.style.background      = "#FCFCDF";
        form.PAYER_PAY_TELNO3.style.background      = "#FCFCDF";
        form.PAYER_ADDR_FULL_TEXT.style.background  = "#FFFFFF";

        form.PAYER_PAY_TELNO1.focus();

        form.PAYER_INV_MEDIA_CD[0].disabled     =   true;       // 2002.05.15
        form.PAYER_INV_MEDIA_CD[1].disabled     =   true;       // 2002.05.15
        form.PAYER_SHEET_OPTION_FLAG_CHK.disabled   =   true;       // 2002.05.15
        form.PAYER_SHEET_OPTION_FLAG_CHK.checked    =   false;      // 2002.05.15
    }

    lf_invmedia_control("01");      // ���ʴ�(���̹������� ��)
}

// û����ü�� ���� ȭ������
function lf_invmedia_control(invmedia)  {

    var form    =   document.mainForm;
    if (invmedia    ==  "") return;

    if (invmedia    ==  "01")   {   // ����
        form.PAYER_SHEET_OPTION_FLAG_CHK.disabled   =   true;       // 2002.05.16 jwc
        form.PAYER_SHEET_OPTION_FLAG_CHK.checked    =   true;       // 2002.05.16 jwc
        form.PAYER_EMAIL_ID.disabled            =   true;           // 2002.05.15
        form.PAYER_EMAIL_ID.style.background    =   "#E3E4E6";      // 2002.05.15

        form.PAYER_SHEET_OPTION_FLAG.value      =   "1";            // 2002.05.15
    }
    else {                      // Email ID
        form.PAYER_SHEET_OPTION_FLAG_CHK.disabled   =   false;      // 2002.05.16 jwc
        form.PAYER_SHEET_OPTION_FLAG_CHK.checked    =   true;       // 2002.05.16 jwc

        form.PAYER_EMAIL_ID.disabled            =   false;          // 2002.05.15
        form.PAYER_EMAIL_ID.style.background    =   "#FCFCDF";      // 2002.05.15

        form.PAYER_SHEET_OPTION_FLAG.value      =   "";            // 2002.05.15
    }
    lf_check_Payer_SheetOptionFlag_gb();    // û����ü�� ���� ���̹��࿩�� ȭ������ 2002.05.16(jwc)


}
// û����ü�� ���� ���̹��࿩�� ȭ������ �� ������
function    lf_check_Payer_SheetOptionFlag_gb() {

    var form    =   document.mainForm;

    if  (form.PAYER_SHEET_OPTION_FLAG_CHK.checked)  {
        form.PAYER_SHEET_OPTION_FLAG.value      =   "1";            // 2002.05.15
    } else  {
        form.PAYER_SHEET_OPTION_FLAG.value      =   "0";                // 2002.05.15
    }


}

// �ڵ���ü���ο� ���� ȭ�� ����...(�������� �����...)
function lf_check_Payer_Autopay_gb() {

    var form    =   document.mainForm;

    if ( form.PAYER_AUTOPAY_GB_CHK.checked ) {

        form.PAYER_AUTOPAY_GB.value         = "1";  // �ڵ���ü ��û

        if ( form.CUST_NO_TYPE.value == "1" && isLength(form.PAYER_ACNTER_NAME.value) < 1) {
            form.PAYER_ACNT_NO.value        = "";
            form.PAYER_ACNTER_NAME.value    = form.CUST_NAME.value;
            form.PAYER_ACNTER_CUST_NO.value = form.CUST_NO.value;
        }

        form.PAYER_BANK_CD.disabled         = false;
        form.PAYER_ACNT_NO.disabled         = false;
        form.PAYER_ACNTER_NAME.disabled     = false;
        form.PAYER_ACNTER_CUST_NO.disabled  = false;

        form.PAYER_BANK_CD.style.background         = "#FCFCDF";
        form.PAYER_ACNT_NO.style.background         = "#FCFCDF";
        form.PAYER_ACNTER_NAME.style.background     = "#FCFCDF";
        form.PAYER_ACNTER_CUST_NO.style.background  = "#FCFCDF";

    } else {

        form.PAYER_AUTOPAY_GB.value             = "0"; // �ڵ���ü ��û����

        form.PAYER_BANK_CD.options[0].selected  = true;
        form.PAYER_ACNT_NO.value                = "";
        form.PAYER_ACNTER_NAME.value            = "";
        form.PAYER_ACNTER_CUST_NO.value         = "";

        form.PAYER_BANK_CD.disabled         = true;
        form.PAYER_ACNT_NO.disabled         = true;
        form.PAYER_ACNTER_NAME.disabled     = true;
        form.PAYER_ACNTER_CUST_NO.disabled  = true;

        form.PAYER_BANK_CD.style.background         = "#FFFFFF";
        form.PAYER_ACNT_NO.style.background         = "#FFFFFF";
        form.PAYER_ACNTER_NAME.style.background     = "#FFFFFF";
        form.PAYER_ACNTER_CUST_NO.style.background  = "#FFFFFF";
    }
}

// û�������� �Է��׸� üũ �Լ�...(�������� �����...)
function checkPayerPaper() {

    var form = document.mainForm;

    if ( isEmpty(form.PAYER_DONG_CD.value) ) {
        alert("������ û���� �ּҸ� �Է��ϼ���!");
        return false;
    }

    // û����ü�� ���� üũ 2002.05.15
    if  ( eval(form.PAYER_INV_MEDIA_CD) )   {

        if  (form.PAYER_INV_MEDIA_CD[0].checked) {  // ���̹���
            form.PAYER_EMAIL_ID.value   =   "";
            //jwc?? ���̹��������θ� ���õǾ�� �ϴ��� Ȯ�ο��
        }
        else                                        // emailû���� ����
        {
            if  (isEmpty(form.PAYER_EMAIL_ID.value) )   {
                alert("û������ ���ɹ��� �̸����ּҸ� �Է��ϼ���!");
                form.PAYER_EMAIL_ID.focus();
                return false;
            }
            if  (isLength(form.PAYER_EMAIL_ID.value) > 99   )   {
                alert("û������ ���ɹ��� �̸����ּҸ� Ȯ�����ֽʽÿ�(�ִ� 99�ڸ�����)!");
                form.PAYER_EMAIL_ID.focus();
                return false;
            }
            if(!isEmail(form.PAYER_EMAIL_ID.value)){
                alert("û������ ���ɹ��� �̸����� ��Ȯ�ϰ� �Է��� �ֽʽÿ�!!!");
                form.PAYER_EMAIL_ID.focus();
                return false;
            }
        }
    }

    //�ڵ���ü�� ���
    if (form.PAYER_AUTOPAY_GB_CHK.checked) {
        // �������
        if (form.PAYER_BANK_CD.selectedIndex == 0) {
            alert("��������� �����ϼ���!");
            form.PAYER_BANK_CD.focus();
            return false;
        }

        // ���¹�ȣ
        if (isLength(form.PAYER_ACNT_NO.value) == 0) {
            alert("������ ���¹�ȣ�� �Է����ֽʽÿ�!");
            form.PAYER_ACNT_NO.focus();
            return false;
        }

        if ( !isInteger(    mainForm.PAYER_ACNT_NO.value, "" ) ) {
            alert("���¹�ȣ�� �����Է¸� �����մϴ�!");
            mainForm.PAYER_ACNT_NO.focus();
            return false;
        }

        // �����ָ�
        if (isEmpty(form.PAYER_ACNTER_NAME.value)) {
            alert("�����ָ��� �Է��� �ֽʽÿ�!(�ִ� 50�ڸ����� �Է°���)");
            form.PAYER_ACNTER_NAME.focus();
            return false;
        }
        if (isLength(form.PAYER_ACNTER_NAME.value) == 0 || isLength(form.PAYER_ACNTER_NAME.value) > 50 ) {
            alert("�����ָ��� �Է����ֽʽÿ�!(�ִ�50�ڸ����� ����)");
            form.PAYER_ACNTER_NAME.focus();
            return false;
        }
        else if (isValidValue(form.PAYER_ACNTER_NAME.value, varSYMBOL) == false) {
            alert("�����ָ��� �ùٸ��� �Է��� �ֽʽÿ�!");
            form.PAYER_ACNTER_NAME.focus();
            return false;
        }

        if ( isEmpty(form.PAYER_DONG_CD.value) ) {
            alert("������ û���� �ּҸ� �Է��ϼ���!");
            return false;
        }

        var StrPAYERACNTERCUSTNO = form.PAYER_ACNTER_CUST_NO.value;
        if (isLength(form.PAYER_ACNTER_CUST_NO.value) != 13) {
            alert("������ �ֹε�Ϲ�ȣ 13�ڸ� �Է����ֽʽÿ�!");
            form.PAYER_ACNTER_CUST_NO.focus();
            return false;
        }

        if ( !isRegNo(StrPAYERACNTERCUSTNO.substr(0,6), StrPAYERACNTERCUSTNO.substr(6,7)) ) {
            form.PAYER_ACNTER_CUST_NO.focus();
            return false;
        }
    }

    return true;
}

// ��ȭ��ȣ �ջ� �Է��׸� üũ �Լ�...(�������� �����...)
function checkPayerTel() {

    var form = document.mainForm;
/* ++ ����� ���Ǹ� ���� clear ����
    form.PAYER_ADDR_FULL_TEXT.value     = "";
    form.PAYER_ADDR_TYPE.value          = "";
    form.PAYER_DONG_CD.value            = "";
    form.PAYER_ADDR_BLDG_ID.value       = "";
    form.PAYER_ADDR_BLDG_TYPE_CD.value  = "";
    form.PAYER_ADDR_BLDG_NAME.value     = "";
    form.PAYER_ADDR_BLDG_NO.value       = "";
    form.PAYER_ADDR_ROOM_NO.value       = "";
    form.PAYER_ADDR_NO_TYPE.value       = "";
    form.PAYER_ADDR_NO.value            = "";
    form.PAYER_ADDR_HO.value            = "";
    form.PAYER_ADDR_REF.value           = "";
*/
/*
    if (isEmpty(form.PAYER_PAY_TELNO1.value) || (!isGenPhone(form.PAYER_PAY_TELNO1.value))) {
        alert("���ݹ�ȣ�� Ȯ���� �ֽʽÿ�!");
        form.PAYER_PAY_TELNO1.focus();
        return false;
    }

    if (isEmpty(form.PAYER_PAY_TELNO2.value)) {
        alert("���ݹ�ȣ�� �Է��� �ֽʽÿ�!");
        form.PAYER_PAY_TELNO2.focus();
        return false;
    }

    if (!isInteger(form.PAYER_PAY_TELNO2.value)) {
        alert("���ݹ�ȣ�� ���ڷ� �Է��� �ֽʽÿ�!");
        form.PAYER_PAY_TELNO2.focus();
        return false;
    }

    if (isEmpty(form.PAYER_PAY_TELNO3.value)) {
        alert("���ݹ�ȣ�� �Է��� �ֽʽÿ�!");
        form.PAYER_PAY_TELNO3.focus();
        return false;
    }

    if (!isInteger(form.PAYER_PAY_TELNO3.value)) {
        alert("���ݹ�ȣ�� ���ڷ� �Է��� �ֽʽÿ�!");
        form.PAYER_PAY_TELNO3.focus();
        return false;
    }

*/
    // �Ϲ���ȭ�̰� �ʼ��Է� �׸�
    if ( !chkFmtTelNo(form.PAYER_PAY_TELNO1, form.PAYER_PAY_TELNO2, form.PAYER_PAY_TELNO3, '1', '1') ) {
        return false;
    }

    form.PAYER_PAY_TELNO.value =  makeFmt4(form.PAYER_PAY_TELNO1.value)
                                + makeFmt4(form.PAYER_PAY_TELNO2.value)
                                + makeFmt4(form.PAYER_PAY_TELNO3.value);

    return true;

}

// �����ڻ��׿��� �ֹ�/���� �Է°����ϵ��� üũ �Լ�...(�������ŵ�...)
function checkPayerInfo() {

    var form = document.mainForm;

    // �����ڼ���
    if (isEmpty(form.PAYER_NAME.value) || isLength(form.PAYER_NAME.value) > 50) {
        alert("�����ڼ����� �ùٸ��� �Է��� �ֽʽÿ�!");
        form.PAYER_NAME.focus();
        return false;
    }

    // ������ �ֹε�Ϲ�ȣ
    var StrPAYERCUSTNO = form.PAYER_CUST_NO.value;
    if (isLength(StrPAYERCUSTNO) != 13) {
        alert("������ �ֹ�/���ι�ȣ 13�ڸ� �Է��� �ֽʽÿ�!"); // 2002.03.26
        form.PAYER_CUST_NO.focus();
        return false;
    }

    if ( !isRegNoCheck(StrPAYERCUSTNO.substr(0,6), StrPAYERCUSTNO.substr(6,7)) &&
            !isCorporationNo( StrPAYERCUSTNO ) ) {
        alert("������ �ĺ���ȣ(�ֹι�ȣ/���ι�ȣ)�� �ùٸ��� �Է��� �ֽʽÿ�!");
        form.PAYER_CUST_NO.focus();
        return false;
    }

    if ( !checkPayerPaper() )
        return false;   // û���� ����

    // �ڵ���ü�� üũ�Ѱ��
    if ( form.PAYER_AUTOPAY_GB_CHK.checked ) {
        if ( checkNCBank() == false ) {
               return false;
        }
    }

    return true;
}

// �����ڻ��� �Է��׸� üũ �Լ�...(�������� �����...)
function checkPayer() {

    var form = document.mainForm;

    // �����ڸ�
    if (isEmpty(form.PAYER_NAME.value)) {
        alert("�����ڸ� �Է��� �ֽʽÿ�!(�ִ� 50�ڸ����� �Է°���)");
        form.PAYER_NAME.focus();
        return false;
    }
    else if (isLength(form.PAYER_NAME.value) > 50) {
        alert("�����ڸ� �ùٸ��� �Է��� �ֽʽÿ�!(�ִ� 50�ڸ����� �Է°���)");
        form.PAYER_NAME.focus();
        return false;
    }
    else if (isValidValue(form.PAYER_NAME.value, varSYMBOL) == false) {
        alert("�����ڸ� �ùٸ��� �Է��� �ֽʽÿ�!");
        form.PAYER_NAME.focus();
        return false;
    }

    // ������ �ֹε�Ϲ�ȣ
    var StrPAYERCUSTNO = form.PAYER_CUST_NO.value;
    if (isLength(StrPAYERCUSTNO) == 0) {
        alert("������ �ĺ���ȣ�� �Է����ֽʽÿ�!");
        return false;
    }
    if ( form.PAYER_CUST_NO_TYPE.value == "1")  {   // ������_�ֹι�ȣ�� ���  // 2002.03.26�߰�
        if (isLength(StrPAYERCUSTNO) != 13) {
            alert("������ �ֹε�Ϲ�ȣ 13�ڸ� �Է��� �ֽʽÿ�!"); // 2002.03.26
            form.PAYER_CUST_NO.focus();
            return false;
        }

        if ( !isRegNo(StrPAYERCUSTNO.substr(0,6), StrPAYERCUSTNO.substr(6,7)) ) {
            form.PAYER_CUST_NO.focus();
            return false;
        }
    }


    // ��ȭ��ȣ �ջ��� �ִ°�� �ջ�û������ û�����߻����� üũ
    if ( eval(form.PAYER_PAY_GB)) {
        if  (form.PAYER_PAY_GB[0].checked) { // ��ȭ��� �ջ�
            if ( !checkPayerTel() ) return false;
        } else {
/*
            form.PAYER_PAY_TELNO1.value = "";
            form.PAYER_PAY_TELNO2.value = "";
            form.PAYER_PAY_TELNO3.value = "";
*/
            if ( !checkPayerPaper() ) return false; // û���� ����
        }
    } else {
        if ( !checkPayerPaper() ) return false; // û���� ����
    }

    // �ڵ���ü�� üũ�Ѱ��
    if ( form.PAYER_AUTOPAY_GB_CHK.checked ) {
        if ( checkNCBank() == false ) {
               return false;
        }
    }

    if ( eval(form.PAYER_INV_MEDIA_CD)) {
        // �ڵ������̰ų� ���̹����� �ݵ�� �����϶�.   2002.05.16
        if (( !form.PAYER_SHEET_OPTION_FLAG_CHK.checked) && ( !form.PAYER_AUTOPAY_GB_CHK.checked ))
        {       alert("�ڵ���ü�� ���̹��࿩�� �� �ϳ��� �ݵ�� �����ϼ���!");
                form.PAYER_SHEET_OPTION_FLAG_CHK.focus();
                return false;
        }
    }

    return true;
}

// ��ҹ�ư�� Ŭ���� ȣ�� �Լ�
function cancelForm(input)
{
    var form            = document.mainForm;
    var strInPut        = input;

    if (confirm("���� �Ͻðڽ��ϱ� ?") !=true ) {
        return false;
    }

    try{
        if( closeExtCorp() == false ) {
            return ;
        }
    }catch(e){}

    if(strInPut == "REG"){
        // ��ǰ��û ������ ������ġ�� ����...
        var rtnUrl = "";
        ////////////
        // ���������̳� KT-PLAZA�϶�
        if( form.USR_GB.value == "5" || form.USR_GB.value == "6" ){
            rtnUrl = form.SUCC_URL.value + "?USR_GB=" + form.USR_GB.value;
        }else{
            var vPAGE_CODE = "";
            try{
                vPAGE_CODE = form.page_code.value;
            }catch(E){}


            //rtnUrl = form.SUCC_URL.value + "?mn=" + form.mn.value + "&scode=" + form.scode.value + "&sname=" + form.sname.value;
            rtnUrl = "/kt07/comm/go_page.jsp" + "?page_code=" + vPAGE_CODE;
        }

    }else if(strInPut == "CHANGE"){
        // ��ǰ��û ������ ������ġ�� ����...
        var rtnUrl = "";
        ////////////
        // ���������̳� KT-PLAZA�϶�
        if( form.USR_GB.value == "5" || form.USR_GB.value == "6" ){
            rtnUrl = form.SUCC_URL.value + "?USR_GB=" + form.USR_GB.value;
        }else{
            rtnUrl = form.SUCC_URL.value;
        }

        location.href= rtnUrl;

    }

    location.href= rtnUrl;
}


//������̳� �ö��� ��ҹ�ư Ŭ���� �߰�:2003.05.18 by blacksea
function cancelBusiForm(input){
    var form            = document.mainForm;
    var strInPut        = input

    if (confirm("���� �Ͻðڽ��ϱ� ?") !=true ) {
        return false;
    }
    var usr_gb = form.USR_GB.value;

    if(strInPut == "REG"){
        location.href= "/pa/jsp/pa000m.jsp?USR_GB=" + usr_gb;
    }else if(strInPut == "CHANGE"){
        location.href= "/pa/jsp/pa000m.jsp?USR_GB=" + usr_gb;
    }
}

//�ּ� �˾�
function NewAddrWindow(input)
{
    var strOpenArea = input;

    //lf_TmpAddr_Clear();
    NewWindow2('/po/jsp/po012q_p01.jsp?OPEN_FORM_NAME=mainForm&OPEN_AREA='+strOpenArea,'name','700','600','no','no');
}

//�ּ� �˾�
function NewAddrWindow_ctcz(input)
{
    var strOpenArea = input;

    //lf_TmpAddr_Clear();
    NewWindow2('/po/jsp/po012q_p01.jsp?OPEN_FORM_NAME=mainForm&OPEN_GB=CTCZ&OPEN_AREA='+strOpenArea,'name','700','600','no','no');
}
/*
  ���Գ�����ȸ ���濡 ���� ó�� ���
  1.��������
    �Ϸ����� null�� �ƴϸ� ó������
  2.���񽺻���
    ������� �ƴϸ� ��� ����Ұ�
    �Ͻ��̿��ߴܽ�  �Ͻ��̿�/�ߴܺ�Ȱ�� ����
*/
function IsChgEnable(orderCompDh,serviceStat,OrdTypeCd)
{
    /*if( orderCompDh == "����" && serviceStat == "����") {
        alert( "ó���Ҵ�!!! 100������ ������ �ֽʽÿ�." );
        return false;
    }*/

    if( orderCompDh == "�̿Ϸ�" ) {
        alert( "���� �������̹Ƿ� ó���� �� �����ϴ�!!!");
        return false;
    }

    if ( OrdTypeCd == "C2" ) {
        if ( serviceStat != "�Ͻ��̿��ߴ�" && serviceStat != "�����" ) {
            alert( "�Ͻ��̿��ߴ�/��Ȱó���� �� �� �����ϴ�!!!" );
            return false;
        }
    } else if( serviceStat != "�����" ) {
        alert( "������� �ƴϹǷ� ó�� �� �� �����ϴ�!!!" );
        return false;
    }

    return true;
}

/*
  ���Գ�����ȸ ������ ���濡 ���� ó�� ���
  1.���񽺻���
    �ű԰������̾�߸� ó��
*/
function IsChgEnableGasul(orderCompDh,serviceStat,OrdTypeCd)
{
    if( orderCompDh == "�̿Ϸ�" ) {
        ;
    } else{
        alert( "�ű� �������� �ڷḸ ó���� �� �ֽ��ϴ�!!!");
        return false;
    }

    if( serviceStat != "�ű԰�����" ) {
        alert( "�ű� �������� �ڷḸ ó���� �� �ֽ��ϴ�" );
        return false;
    }

    return true;
}

//�� Form���� input��ü���� ��Ŀ�� �̵�
//���ڿ� ���� Ű(����Ű ��) ���� 02/02/01
//fname :��ü���� ������ ���̸�
//str1  :���� onFocus()�� ��ü
//str2  :Focus�� �̵��Ǿ��� ��ü
//len       :���� ��ü���� check�� ����
function length_check(fname, str1, str2, len) {

    var strlen = eval("document." + fname + "." + str1 + ".value.length");
    var varCk = window.event.keyCode;

    if ( (varCk>= 48 && varCk<=57) || (varCk>=65 && varCk<=90) || (varCk>=96 && varCk<=105)) {
        if (strlen == len) {
            if( str2 != "") {
                eval("document."+ fname + "." + str2 + ".focus()");
                eval("document."+ fname + "." + str2 + ".select()");
            }
        }
    }
}

//<input>�������� EnterŰ typing --> ����
function chkEnter(mthd) {

    if(window.event.keyCode == 13) {
        eval(mthd);
    }
}

// ���� ���� üũ
function checkNCBank()
{
    var  strBankCd = mainForm.PAYER_BANK_CD.value ;
    var  strAcntNo = mainForm.PAYER_ACNT_NO.value ;

    // �����߾�ȸ(16)�� ��������(17) ���� : �ڵ���ü �ȵ�.
    if ( strBankCd == "16" || strBankCd == "17" ) {
        alert("�����߾�ȸ->�����߾�ȸ, ��������->������������ �����Ͻʽÿ�.\n����������(13�ڸ�)�� �ڵ���ü�� �Ұ��մϴ�.");
        return false ;
    }

    // �ѱ�����, �������������� �ڵ���ü�� �Ұ�
    if ( strBankCd == "01" || strBankCd == "08" ) {
        alert( "�ѱ�����, �������������� �ڵ���ü�� �Ұ��մϴ�." );
        return false ;
    }

    // ��ݰ��� �����(��ü��) �������� ��ȸ
    if( strBankCd ==  "71" ) {
        if( getAcntType() == false ) {
            alert("�Է��Ͻ� ��ü�� ���¹�ȣ�� �߸� �ԷµǾ����ϴ�.");
            return false;
        }
    }

    // �����߾�ȸ �ڸ��� üũ
    if( strBankCd ==  "11" ) {
        if( strAcntNo.length < 11 || strAcntNo.length > 12 ) {
            alert("�Է��Ͻ� �����߾�ȸ ���¹�ȣ�� �߸� �ԷµǾ����ϴ�.");
            return false;
        }
    }

    // �������� �ڸ��� üũ
    if( strBankCd ==  "12" ) {
        if( strAcntNo.length != 14 ) {
            alert("�Է��Ͻ� �������� ���¹�ȣ�� �߸� �ԷµǾ����ϴ�.");
            return false;
        }
    }

    // �������ݰ� ��ȿ�� üũ
    if( strBankCd ==  "41" ) {
        if( checkSmuAcntNo() == false ) {
            alert("�Է��Ͻ� �������ݰ� ���¹�ȣ�� �߸� �ԷµǾ����ϴ�.");
            return false;
        }
    }
}


    /////////////////////////////////////////////////////////////////////////////////
    //      ��ȭ��ȣ�� �����Ѵ�.
    //   000203211143 -> 02-321-1143
    function formatTel(unFormat)
    {
        if(unFormat.length < 12 ){
            return unFormat;
        }

        if(unFormat.substring(0,1) != "0" ){
            return unFormat;
        }

        var first,middle,last;
        first = unFormat.substring(0,4);
        middle = unFormat.substring(4,8);
        last = unFormat.substring(8,12);

        if( first.substring(0,2) == "000" ){
            first = first.substring(2,4);
        }else{
            first = first.substring(1,4);
        }

        if( middle.substring(0,1) == "0" ){
            middle = middle.substring(1,4);
        }
        return first + "-" + middle + "-" + last;

    }





// ��ü���� �������� ����.
/*
 *  (���¹�ȣ ���� 15)14,15�ڸ� : 11->3, 12->4, 17->5, 21->6
 *  (���¹�ȣ ���� 14) 7, 8�ڸ� : 01->3, 02->4, 04->5, 05->6
 */
function getAcntType()
{
    // ���¹�ȣ
    var strAcntNo = mainForm.PAYER_ACNT_NO.value ;

    var str14th = "";       // �Ű��� 14�ڸ�
    var str15th = "";       // ������ 15�ڸ�

    if ( strAcntNo.length == 15 ) {
        str15th = strAcntNo.substring(13, 15);

        if ( ( str15th == "11" ) || ( str15th == "12" ) ||
             ( str15th == "17" ) || ( str15th == "21" ) ) {
            return true ;
        }
    } else if ( strAcntNo.length == 14 ) {
        str14th = strAcntNo.substring(6, 8);

        if ( ( str14th == "01" ) || ( str14th == "02" ) || ( str14th == "06" ) ||
             ( str14th == "05" ) || ( str14th == "52" ) ) {
            return true;
        }
    }

    return false ;
}

// �������ݰ�� 5~6�ڸ��� '09','10'�� �ڸ��� ����.
function checkSmuAcntNo ()
{
    // ���¹�ȣ
    var strAcntNo = mainForm.PAYER_ACNT_NO.value ;
    if( strAcntNo.length < 6 ) {
        return false ;
    }

    var str56th = strAcntNo.substring(4, 6);
    // �������ݰ�� 5~6�ڸ��� '09','10'�� �ڸ��� ����.
    if( ( str56th == "09") || ( str56th == "10" ) ) {
        return true;
    }

    return false;
}

// chkCustNo() �Լ��� �������� ������! by gagi
// ������ ��� �� �ʿ��մϴ�!
function    chkCustNo(vTXT)
{
}

// �ڸ����� ���� �տ� '0'�� �߰��Դ�.
// str_value    : raw ��
// int_length   : '0'�� ������ ��ü����
function setZero(str_value, int_length)
{
    var int_cnt = 0;

    for ( int_cnt = str_value.length; int_cnt < int_length; int_cnt++)
        str_value = "0" + str_value;

    return str_value;
}

// ��ü �� ���濡 �پ��ִ� '0' ����
function cutZero(num)
{
    var s = "";
    var i = 0;

    if (num.length == 0) return "";

    while(num.charAt(i++) == '0')
        if (i==num.length) return "0";

    s = num.substring(i-1);
    return s;
}

/*
// Help Open �ٸ������� �����Ͽ���
//function HelpOpen(helpUrl) {
//  window.open("/po/help/"+helpUrl,"","width=640,height=400,scrollbars=yes,resizable=yes");
}
*/

function HelpSubOpen(helpUrl, myname) {
    //window.open(helpUrl,name,"width=640,height=400,scrollbars=yes,resizable=yes");
    NewWindow2("/pa/help/"+helpUrl, myname, 640, 400, 'yes', 'yes');
}


// �ش� ������� �ϼ��� ����Ѵ�.
function countDay(yr,m,d) {

    var montharray = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec") ;

    var paststring = montharray[m-1] + " " + d + ", " + yr ;

    var vDay = Math.round(Date.parse(paststring) / (24*60*60*1000)) * 1 ;

    return vDay;
}

// ���� ȭ�� ȣ��
function openMsgDiag(msg){
    window.showModalDialog ('/weblogic/CtosMsgDiag?msgname=' + msg + '&msgtype=E&btncnt=1', '', 'dialogHeight:260px;dialogWidth:520px;status:no; help:no;');
}

// ���� ID�� ȭ�� ȣ��
//  �輺�� 2002.10.18 �߰�
function openMsgIdDiag(msg_id){
    var sendMsg = "msgid=" + msg_id + "&msgtype=E&btncnt=1";
    window.showModalDialog ('/weblogic/CtosMsgDiag?'+sendMsg, '', 'dialogHeight:260px;dialogWidth:520px;status:no; help:no;');
}


// 2003-03-21 4:56���� �輺�� �߰�
// ��������� ��ȸ
function getDatePopup_ADSL()
{
    // �ʼ��Է� data

    var param  = document.mainForm.SVC_OFC_CD.value;
    var param1 = document.mainForm.ADSL_ADDR_TYPE.value;
    var param2 = document.mainForm.ADSL_DONG_CD.value;
    var param3 = document.mainForm.ADSL_ADDR_NO_TYPE.value;
    var param4 = document.mainForm.ADSL_ADDR_NO.value;
    var param5 = document.mainForm.ADSL_ADDR_HO.value;
    var param6 = document.mainForm.ADSL_ADDR_BLDG_TYPE_CD.value;
    var param7 = document.mainForm.ADSL_ADDR_BLDG_NAME.value;
    var param8 = document.mainForm.ADSL_ADDR_BLDG_NO.value;
    var param9 = document.mainForm.ADSL_ADDR_ROOM_NO.value;
    var param0 = document.mainForm.ADSL_ADDR_REF.value;
    // 20021224 BSH ����ó���� ������ RS_CD���� ����
    var addr   = document.mainForm.ADSL_ADDR_FULL_TEXT.value;
    var rscd   = document.mainForm.RS_CD.value;
    // 2003-04-16 6:12����
    var capaall = "";
    try {
        capaall = document.mainForm.CAPAALL.value;
    } catch (e) { ; }

//    var rscd   = '';
//
//    if(addr.indexOf('����Ư����')>-1) rscd = '1';

    if( param == null || param.length==0 ||param1 == null || param1.length==0 || param2 == null || param2.length==0 ||
        param3== null || param3.length==0 || param4 == null || param4.length==0)
    {
        alert('��ġ�ּҸ� �켱 �����ϼž� �մϴ�');
        document.mainForm.BN_INSTADDR_SEARCH.focus();
        return;
    }

    NewWindow('/po/jsp/po831q_p01.jsp?RS_CD=0&OFC_CD='+param+'&ADDR_TYPE='+param1+'&DONG_CD='+param2+'&ADDR_NO_TYPE='+param3
                                    +'&ADDR_NO='+param4+'&ADDR_HO='+param5+'&ADDR_BLDG_TYPE_CD='+param6
                                    +'&ADDR_BLDG_NAME='+param7+'&ADDR_BLDG_NO='+param8+'&ADDR_ROOM_NO='+param9
                                    +'&ADDR_REF='+param0+'&REAL_RS_CD='+rscd+'&CAPAALL='+capaall,'callOpenDate','690','400','no');
}
// 2003-03-21 4:56���� �輺�� �߰�

//---------------------------------------------------------------------------------
// ��û��ȣ : BCN ���������� üũ
// ��û��   :
// ������   : ������
// ������   : 2007-06-01
// �������� : �Ϲ���ȭ�ϰ�츸 csng101s ���� ��ȸ�� ���� - �ּ���ȸ�� pagecd�߰�
//--------------------------------------------------------------------------------
// 2003-04-25 3:49���� �輺�� �߰�
//�ּ� �˾� : �ű� �ּ���ȸ �˾� ����
function paComm_Popup_Address(ObjAddr, vModal)
{
    var params = "?";
    try
    {
        params = params + "sa_cd="          + ObjAddr.sacd;                         // ��ǰ�ڵ�
        params = params + "&flag="          + ObjAddr.flag;                         // �۾�����
        params = params + "&fstareacd="     + ObjAddr.fstareacd;                    // �����õ� �ڵ�
        params = params + "&sndareacd="     + ObjAddr.sndareacd;                    // �ñ��� �ڵ�
        params = params + "&trdareacd="     + ObjAddr.trdareacd;                    // ���ڵ�
        params = params + "&addrno="        + ObjAddr.AddrNo;                       // ����
        params = params + "&addrho="        + ObjAddr.AddrHo;                       // ȣ
        params = params + "&addrtype="      + ObjAddr.addr_type;                    // �ּ�����
        params = params + "&addrnotype="    + ObjAddr.AddrNoType;                   // ��������
        params = params + "&bldgname="      + ObjAddr.bldg_name;                    // �ǹ���
        params = params + "&bldgid="        + ObjAddr.bldg_id;                      // �ǹ� ID
        params = params + "&detail_yn="     + ObjAddr.detail_yn;                    // ���뱹, ���� ��ȸ����(Y/N)
        params = params + "&call_name="     + ObjAddr.call_name;                    // ȣ�� �����챸���� (�� ȭ�鿡�� �ּ� �ΰ�(û���� �ּ�, ��ġ�ּ�)�� ȣ��� �����)
        // �����ּҵ� ������ 2006-08-12 5:35���Ŀ�����
        try{
            params = params + "&bldg_ref="      + ObjAddr.bldg_ref;                     // �����ּҵ� ������ 2006-08-12 5:35���Ŀ�����
            params = params + "&bldgtypecd="    + ObjAddr.bldgtypecd;                   // �����ּҵ� ������ 2006-08-12 5:35���Ŀ�����
            /////////////
            // ����Ʈ�ϰ�쵵.. ó���� �� ȣ��ó��
            params = params + "&addr_bldg_ho="      + ObjAddr.addr_bldg_ho;     // �����ּҵ� ������ 2006-08-12 5:35���Ŀ�����
            params = params + "&addr_bldg_dong="    + ObjAddr.addr_bldg_dong;   // �����ּҵ� ������ 2006-08-12 5:35���Ŀ�����
        }catch(e){
            params = params + "&bldg_ref="      +    "";
            params = params + "&bldgtypecd="    +    "";
            params = params + "&addr_bldg_ho="  +    "";
            params = params + "&addr_bldg_dong="+    "";
        }
        // �����ּҵ� ������ 2006-08-12 5:35���Ŀ�����
        // 2003-06-06 4:33����
        try {
            params = params + "&USR_GB="    + document.mainForm.USR_GB.value;       // ����ڱ���
        } catch (e) {
            params = params + "&USR_GB=6";       // ����ڱ���
        }

        // BCN - CSNG101S���� ��� �Ϲ���ȭ�϶���
        // 2007-06-01 5:16����
        try {
        	if(ObjAddr.pagecd != null && ObjAddr.pagecd != "undefined") {
            	params = params + "&pagecd="    + ObjAddr.pagecd;       // �Ϲ���ȭ�϶���
            } else {
            	params = params + "&pagecd="    + "";
            }
        } catch (e) {
            params = params + "&pagecd="+"";       // ����ڱ���
        }

    } catch (e) { ; }

    if (vModal == true)
    {
        var rtnValue = window.showModalDialog('/weblogic/pa909c_s01'+params, '', 'dialogWidth:620px;dialogHeight:600px;status:no;help:no;');

        // �ּ� ��ȸ window���� Ȯ�ι�ư Ŭ���ø� rtnValue�� Object�� �Ѿ�´�.
        try        {
            if (typeof(rtnValue) == "object") childwindow_address(rtnValue);
        } catch (e) { ; }
    }
    else
    {
        NewWindow2('/weblogic/pa909c_s01'+params, '', '620', '600', 'no', 'no');
    }
}

// �޼��� ǥ�� ó�� start
try
{
    Msgbox = new objMsgBox();
}
catch (e) { ; }

function objMsgBox()
{
    this.show = MsgBox_Display;
    this.Display = MsgBox_Display;
}
// tgt : A-alert, C-Confirm, W-window(MessageID�� ǥ��), M-window(Message ��ü�� ǥ��)
function MsgBox_Display(msg, tgt, str1, str2, str3)
{
    var vmsg = msg;
    var smsg = "";
    if ((tgt == null) || (tgt == "") || (tgt == "A"))
    {
        if ((str1 == null) || (str1 == "")) { alert(vmsg); return; }
        else vmsg = StringReplace(vmsg, "%s", str1);
        if ((str2 == null) || (str2 == "")) { alert(vmsg); return; }
        else vmsg = StringReplace(vmsg, "%s", str2);
        if ((str3 == null) || (str3 == "")) { alert(vmsg); return; }
        else vmsg = StringReplace(vmsg, "%s", str3);
        alert(vmsg);
    }
    else if (tgt == "C")
    {
        if ((str1 == null) || (str1 == "")) { return confirm(vmsg); }
        else vmsg = StringReplace(vmsg, "%s", str1);
        if ((str2 == null) || (str2 == "")) { return confirm(vmsg); }
        else vmsg = StringReplace(vmsg, "%s", str2);
        if ((str3 == null) || (str3 == "")) { return confirm(vmsg); }
        else vmsg = StringReplace(vmsg, "%s", str3);
        return confirm(vmsg);
    }
    else if (tgt == "W")
    {
        openMsgIdDiag(msg);
    }
    else if (tgt == "M")
    {
        openMsgDiag(msg);
    }
}
// �޼��� ǥ�� ó�� end

// �����޼������� v_s1���� ã�Ƽ� v_s2�� ��ġ�Ѵ�.
function StringReplace(v_msg, v_s1, v_s2)
{
    var idx = v_msg.indexOf(v_s1);

    if (idx == -1) return v_msg;
    else return v_msg.substring(0, idx) + v_s2 + v_msg.substring(idx+2);
}

// ���� radio rObj�� ���õ� index���� return�Ѵ�.
function getRadioIndex(rObj)
{
    var i;
    var rtn;
    try
    {
        for(i=0;i<rObj.length;i++)
            if (rObj[i].checked == true) return i;
    }
    catch (e) { return ""; }
    return rtn;
}

// ���� radio rObj�� ���õ� index���� return�Ѵ�.
function getRadioValue(rObj)
{
    var i;
    var rtn;
    try
    {
        for(i=0;i<rObj.length;i++)
            if (rObj[i].checked == true) return rObj[i].value;
    }
    catch (e) { return ""; }
    return rtn;
}

// ������ȣ �� �ڵ��� ���� ��ȣ üũ
function chkTelJiyuk2(input1, flag1, vfoc){
    //////////////////////////////////////////////////////////////////////////
    // input 1  : ������ȣ�� �Է��ϴ� text�� name                           //
    // flag1    : '1' --> ��ȭüũ, '2' --> �ڵ���üũ, '3' --> �Ѵ� üũ   //
    // vfoc     : 'Y' --> focus �̵�, 'N' --> focus �̵�����                //
    //////////////////////////////////////////////////////////////////////////
    var strVal1     = input1.value;
    var strFlag1    = flag1;

    if (strVal1 == "")
    {
        alert("������ȣ�� �Է��ϼ���.");
        if (vfoc == "Y") input1.focus();
        return false;
    }

    if(strFlag1 == "1"){
        // �����Է� üũ
        if(!isInteger(strVal1,'')){
            alert("���ڸ� �Է� �����մϴ�!!!");
            if (vfoc == "Y") input1.focus();
            return false;
        }

        // ���� üũ
        if(isLength(strVal1) < 3){
            if(strVal1 != "02"){
                alert("������ȣ�� �ٸ��� �Է��ϼ���!!!");
                if (vfoc == "Y") input1.focus();
                return false;
            }
        }

        // ������ȣ üũ
        if(!isGenPhone(strVal1)){
            alert("������ȣ�� �ٸ��� �Է��ϼ���!!!");
            if (vfoc == "Y") input1.focus();
            return false;
        }

        return true;

    }else if(strFlag1 =="2"){
        // �����Է� üũ
        if(!isInteger(strVal1,'')){
            alert("���ڸ� �Է� �����մϴ�!!!");
            if (vfoc == "Y") input1.focus();
            return false;
        }

        // ���� üũ
        if(isLength(strVal1) < 3){
            alert("�ڵ��� ��ȣ�� �ٸ��� �Է��ϼ���!!!");
            if (vfoc == "Y") input1.focus();
            return false;
        }

        // ������ȣ üũ
        if(!isCellarPhone(strVal1)){
            alert("�ڵ��� ��ȣ�� �ٸ��� �Է��ϼ���!!!");
            if (vfoc == "Y") input1.focus();
            return false;
        }

        return true;

    }else{
        // �����Է� üũ
        if(!isInteger(strVal1,'')){
            alert("���ڸ� �Է� �����մϴ�!!!");
            if (vfoc == "Y") input1.focus();
            return false;
        }

        // ���� üũ
        if(isLength(strVal1) < 3){
            if(strVal1 != "02"){
                alert("������ȣ�� �ٸ��� �Է��ϼ���!!!");
                if (vfoc == "Y") input1.focus();
                return false;
            }
        }

        // ������ȣ üũ
        if(!isCellarPhone(strVal1) && !isGenPhone(strVal1)){
            alert("��ȣ�� �ٸ��� �Է��ϼ���!!!");
            if (vfoc == "Y") input1.focus();
            return false;
        }

        return true;
    }
}

// ��ȣüũ
function chkTelKukbun2(input2, vfoc)
{
    //////////////////////////////////////////////////////////////////////////
    // input 2  : ������ �Է��ϴ� text�� name                               //
    //////////////////////////////////////////////////////////////////////////
    var strVal2     = input2.value;

    if (strVal2 == "")
    {
        alert("������ �Է��ϼ���.");
        if (vfoc == "Y") input2.focus();
        return false;
    }

    // ���� üũ
    if(!isInteger(strVal2,'')){
        alert("���ڸ� �Է��� �����մϴ�!!!");
        if (vfoc == "Y") input2.focus();
        return false;

    }

    // ���� üũ
    if(isLength(strVal2) < 3){
        alert("������ 3�ڸ� �̻� �Է��ϼž� �մϴ�!!!");
        if (vfoc == "Y") input2.focus();
        return false;
    }else{
        /*
        if((strVal2.substring(0,1) == "0") && (isLength(strVal2) == 3)){
            alert("�Ǿ��ڸ��� '0'�� �� ���� �����ϴ�!!!");
            if (vfoc == "Y") input2.focus();
            return false;
        }
        */
        if((strVal2.substring(0,2) == "00") && (isLength(strVal2) == 4)){
            alert("�Ǿ��ڸ��� '00'�� �� ���� �����ϴ�!!!");
            if (vfoc == "Y") input2.focus();
            return false;
        }
    }

    return true;
}

// ����üũ
function chkTelNo2(input3, vfoc)
{
    //////////////////////////////////////////////////////////////////////////
    // input 3  : ��ȣ�� �Է��ϴ� text�� name                               //
    //////////////////////////////////////////////////////////////////////////
    var strVal3     = input3.value;

    if (strVal3 == "")
    {
        alert("��ȣ�� �Է��ϼ���.");
        if (vfoc == "Y") input3.focus();
        return false;
    }

    // ���� üũ
    if(!isInteger(strVal3,'')){
        alert("���ڸ� �Է��� �����մϴ�!!!");
        if (vfoc == "Y") input3.focus();
        return false;
    }

    // ���� üũ
    if(isLength(strVal3) < 4){
        alert("��ȣ�� �ڸ����� 4�ڸ��Դϴ�!!!");
        if (vfoc == "Y") input3.focus();
        return false;
    }

    return true;
}

// ��ȭ��ȣ üũ
function chkFmtTelNo2(input1, input2, input3, flag1, flag2, vfoc )
{
    //////////////////////////////////////////////////////////////////////////
    // input 1  : ������ȣ�� �Է��ϴ� text�� name                           //
    // input 2  : ������ �Է��ϴ� text�� name                               //
    // input 3  : ��ȣ�� �Է��ϴ� text�� name                               //
    // flag1    : '1' --> ��ȭüũ, '2' --> �ڵ���üũ, '3' --> �Ѵ� üũ   //
    // flag2    : '1' --> �ʼ� �Է� ����, '2' --> NON �ʼ� �Է� ����        //
    //////////////////////////////////////////////////////////////////////////

    var strVal1     = input1.value;
    var strVal2     = input2.value;
    var strVal3     = input3.value;
    var strFlag1    = flag1;
    var strFlag2    = flag2;

    // �ʼ����� �ƴ����� ����
    if(strFlag2 == "1"){
        // ������ȣ �� �ڵ��� ���� ��ȣ üũ �Լ� ȣ��
        if(!chkTelJiyuk2(input1, flag1, vfoc)){
            return false;
        }

        // ��ȣüũ �Լ� ȣ��
        if(!chkTelKukbun2(input2, vfoc)){
            return false;
        }

        // ����üũ �Լ� ȣ��
        if(!chkTelNo2(input3, vfoc)){
            return false;
        }

    } else {
        if(isEmpty(strVal1) && isEmpty(strVal2) && isEmpty(strVal3)) {
            return true;
        } else {
            // ������ȣ �� �ڵ��� ���� ��ȣ üũ �Լ� ȣ��
            if(!chkTelJiyuk2(input1, flag1, vfoc)){
                return false;
            }

            // ��ȣüũ �Լ� ȣ��
            if(!chkTelKukbun2(input2, vfoc)){
                return false;
            }

            // ����üũ �Լ� ȣ��
            if(!chkTelNo2(input3, vfoc)){
                return false;
            }
        }
    }

    return true;
}

// Login ID ��ȿ�� üũ
function paComm_IsFitLoginId(ObjSvcNo,strMsg, cls)
{
    var vStrMsg = "";

    if ("undefined" == typeof(strMsg)) {
        vStrMsg = "";
    } else {
        vStrMsg = strMsg;
    }

    var vloginid = ObjSvcNo.value;

    if (vloginid == "")
    {
        if ( vStrMsg == "" ) {
          if(cls == "potalEvent")
            Msgbox.show("�ް��н� ���̵� Ȯ���ϼ���.");
          else
            // �α���ID�� Ȯ���ϼ���
            Msgbox.show(MCSNI5179);
        } else {
            alert(  vStrMsg + "�� Ȯ���ϼ���");
        }

        return false;
    }

    // �ý��ۿ��� ����ϴ� ���ڴ� ������
    if ((vloginid == "admin")     || (vloginid == "master")    || (vloginid == "webadmin")  ||
        (vloginid == "webmaster") || (vloginid == "helpme"))
    {
        // ����Ҽ� ���� ID�Դϴ�.");
        Msgbox.show(MCSNI5240);
        return false;
    }

    // �α���ID�� �߸��Է��� ���
    var nLength = vloginid.length;
    if ((nLength < 4) || (nLength > 15) || (vloginid.charAt(0) < 'a') || (vloginid.charAt(0) > 'z'))
    {

        if ( vStrMsg == "" ) {
            // �α��� ID�� 4�ڸ� �̻� 15�ڸ� ���Ϸ� �Է��ϼ���
            Msgbox.show(MCSNI5174);
        } else {
            alert(  vStrMsg + "�� 4�ڸ� �̻� 15�ڸ� ���Ϸ� �Է��ϼ���");
        }
        return false;
    }

    // Ư�����ڰ� �����ϴ� ���
    for (var i=1; i<nLength; i++)
    {
        if ((vloginid.charAt(i) < '0' || vloginid.charAt(i) > '9') &&
            (vloginid.charAt(i) < 'a' || vloginid.charAt(i) > 'z'))
        {
            if ( vStrMsg == "" ) {
                // �α���ID�� �ҹ���,�����̿��� ���ڴ� ����� �� �����ϴ�
                Msgbox.show(MCZZI0044);
            } else {
                alert(  vStrMsg + "�� �ҹ���,�����̿��� ���ڴ� ����� �� �����ϴ�");
            }
            return false;
        }
    }
    return true;
}

function paComm_IsFitPasswd(ObjSvcNo, ObjPasswd)
{
    var vSvcNo = ObjSvcNo.value;
    var vPasswd = ObjPasswd.value;

    // �Է��ڷ� üũ
    if ( vPasswd == "" )
    {
        // alert("��й�ȣ�� �Է��ϼ���!");
        Msgbox.show(MCSNI5012);
        ObjPasswd.focus();
        return  false;
    }
    if ( isString(vPasswd, '') == false ) {
        // alert("��й�ȣ�� �����ڸ� �����մϴ�!");
        Msgbox.show(MCSNI7545);
        ObjPasswd.focus();
        return  false;
    }

    if ( vPasswd == false ) {
        if ( vPasswd == '000000' || vPasswd == '0000000' || vPasswd == '00000000' ) {

        } else {
            // alert("��й�ȣ�� �����ڸ� �����մϴ�!");
            Msgbox.show(MCSNI7545);
            ObjPasswd.focus();
            return  false;
        }
    }

    if ( vPasswd.length < 6  ) {
        // alert("��й�ȣ�� 6~8�ڷ� �Է��ϼ���!");
        Msgbox.show(MCZZI0057, "A", "6", "8");
        ObjPasswd.focus();
        return false;
    }
    //------- �빮�ڰ� �����ϴ��� ���� üũ
    var chk = false;
    for (var i=0; i<=vPasswd.length-1; i++) {
            ch = vPasswd.substring(i,i+1);
            if (ch>="A" && ch<="Z") {
                chk = true;
                break;
            }
    }
    if (chk == true) {
        // alert("��й�ȣ�� �����ҹ���,���ڷθ� �Է��ϼž� �մϴ�!");
        Msgbox.show(MCSNI7545);
        ObjPasswd.focus();
        return false;
    }
    //-----���̵�� �н����尡 ���Ͽ��� üũ
    if (vPasswd == vSvcNo) {
        // alert("���̵�� �н����尡 �����մϴ�.�ٸ��� �Է��ؾ� �մϴ�!");
        Msgbox.show(MCSNI5214);
        ObjPasswd.focus();
        return false;
    }

//  if ( document.mainForm.tPASSWD2.value == "" )
//  {
//      alert("��й�ȣ�� �Է��ϼ���!");
//      document.mainForm.tPASSWD2.focus();
//      return false;
//  }
//  if ( isString(document.mainForm.tPASSWD2.value, '') == false ) {
//      alert("��й�ȣ�� �����ڸ� �����մϴ�!");
//      document.mainForm.tPASSWD2.focus();
//      return false;
//  }
//
//  var strPw2 = document.mainForm.tPASSWD2.value;
//  if ( strPw2.length < 6  ) {
//      alert("��й�ȣ�� 6~8�ڷ� �Է��ϼ���!");
//      document.mainForm.tPASSWD2.focus();
//      return false;
//  }
//
//  if (strPw != strPw2) {
//      alert("��й�ȣ�� ��й�ȣȮ���� ���� �ٸ��ϴ�. Ȯ���� �Է��ϼ���!");
//      document.mainForm.tPASSWD2.focus();
//      return false;
//  }
    return true;
}

// ����������� ��ȸ�Ѵ�.
//---------------------------------------------------------------------------------------
// ������   : ������
// ������   : 2007-03-08
// �������� : addr_bldg_no ���ڰ��� Ư������(#)�� �� ġȯ
//---------------------------------------------------------------------------------------
function paComm_Popup_CompleteDate(rObj, flag)
{
    // �ʼ��Է� data
    var param   = rObj.svc_ofc_cd;                  // ���뱹�ڵ�
    var param1  = rObj.addr_type;                   // �ּ�����
    var param2  = rObj.dong_cd;                     // ���ڵ�
    var param3  = rObj.addr_no_type;                // ��������
    var param4  = rObj.addr_no;                     // ����
    var param5  = rObj.addr_ho;                     // ȣ
    var param6  = rObj.addr_bldg_type_cd;           // �ǹ�����
    var param7  = rObj.addr_bldg_name;              // �ǹ���
    var param8  = rObj.addr_bldg_no;                // ����NO

    param8 = param8.replace("#","��");

    var param9  = rObj.addr_room_no;                //
    var param0  = rObj.addr_ref;                    // �����ּ�
    var addr    = rObj.addr_full_text;              // ��ü�ּ�
    var rscd    = rObj.rs_cd;                       // RS CD
    var capaall = rObj.capaall;                     // �����뷮 �ʰ��� ���� ���� ����
    var USR_GB  = rObj.USR_GB;                      // USR_GB
    var param10 = rObj.gSacd;                       // sa_cd
    var param11 = rObj.cust_id;                     // cust_id
    var param12 = rObj.orderNo;                     // orderNo
    var param13 = rObj.OrderType;                   // OrderType
    var bldg_id = "";
    try{
        var mF = document.mainForm;
        bldg_id = mF.ADSL_ADDR_BLDG_ID.value;


    }catch(E){

    }
    var new_mega= '';

    try{
        new_mega = rObj.new_mega;                    // NEW_MEGA -> �����üũ�� �����Ѵ�. 2006-06-08 9:30����
    } catch(e) {};


    var ChgCompFlag = rObj.strChgCompletDayFlag;    // �������� ����� ������� �߰� 2003.12.15 ��̰�

    if( param1 == null || param1.length==0 || param2 == null ||
        param2.length==0 || param3== null || param3.length==0 || param4 == null || param4.length==0)
    {
        // alert('��ġ�ּҸ� �켱 �����ϼž� �մϴ�');
        Msgbox.show(MCSNI9953);
        return;
    }

    // 2006-05-16 5:45���� �����
    // NEW_MEGA�� ����� ���� ��ȸ üũ�� �����Ѵ�.
    if(new_mega != 'Y')
    {
        if( param11 == null || param11.length==0 ){
            alert("����� ������ ��ȸ�ϼž� �մϴ�.");
            return;
        }
    }

    // 2005-03-09 ��������� �����ֱ�
    // Nespot ID �� ������̰ų� û�����̸� ��,�Ͽ��� ��û �Ұ�ó��
    var vNespotIdFlag   = "N";
    var vNespotIdFlagCnt = 0;

    try {
        vNespotIdFlagCnt = IsUseSubId(C_CSNT_PROD_NES_MULTI_ID_SUB,false)
    }catch(e){;}

    try {
        vNespotIdFlagCnt = IsUseSubId("4589",false)
    }catch(e){;}

    if(vNespotIdFlagCnt > 0){
        vNespotIdFlag ="Y";
    }
     ///////////////////////////////////////////////////////////////////
    NewWindow('/pa/jsp/pa910c_p02.jsp?RS_CD=0&OFC_CD='+param+'&ADDR_TYPE='+param1+'&DONG_CD='+param2+'&ADDR_NO_TYPE='+param3
                                    +'&ADDR_NO='+param4+'&ADDR_HO='+param5+'&ADDR_BLDG_TYPE_CD='+param6
                                    +'&BLDG_ID='+bldg_id
                                    +'&ADDR_BLDG_NAME='+param7+'&ADDR_BLDG_NO='+param8+'&ADDR_ROOM_NO='+param9
                                    +'&CHGCOMFLAG='+ChgCompFlag  // �������� ����� ������� �߰� 2003.12.15 ��̰�
                                    +'&USR_GB='+USR_GB  // �������� ����� ������� �߰� 2003.12.15 ��̰�
                                    +'&cust_id='+param11  // �������� �������� �߰� 2004�� 4�� 10��  �����  04:47:25 ���� ��̰�
                                    +'&gSacd='+param10  // �������� �������� �߰� 2004�� 4�� 10��  �����  04:47:25 ���� ��̰�
                                    +'&orderNo='+param12  // �������� �������� �߰� 2004�� 4�� 13��  ȭ����  10:34:19 ���� ��̰�
                                    +'&OrderType='+param13  // �������� �������� �߰� 2004�� 4�� 13��  ȭ����  10:34:30 ���� ��̰�
//-----------------------------------------------------------------------------
//  �� ������ �߰�  2004/06/04 14:49:34 ��û�� : ��̰�,������
//-----------------------------------------------------------------------------
// 2005-03-09 ��������� �����ֱ�
                                    +'&ADDR_REF='+param0+'&REAL_RS_CD='+rscd+'&CAPAALL='+capaall+'&NESPOT_FLAG='+vNespotIdFlag, 'callOpenDate', '725', '502', 'yes');//[2934]'660', '450'
//-----------------------------------------------------------------------------





}

// 2003-05-09 20:00 �Ǻ��� �߰�
var jiyukStat = false;  // ������ȣ �۾� �÷���(onBlur �̺�Ʈ �����)

// ������ȣ �� �ڵ��� ���� ��ȣ üũ(�Ǳ�� �߰�)
// KTP(0130) Logic �߰�. by 2003.10.10 �����
function telJiyuk_onKey(input1, input2, flag1){
    //////////////////////////////////////////////////////////////////////////
    // input 1  : ������ȣ�� �Է��ϴ� text�� name                               //
    // input 2  : ������ �Է��ϴ� text�� name                                   //
    // flag1    : '1' --> ��ȭüũ, '2' --> �ڵ���üũ, '3' --> �Ѵ� üũ       //
    //////////////////////////////////////////////////////////////////////////
    var strVal1     = input1.value;
    var strFlag1    = flag1;
    var varCk       = window.event.keyCode;

    //BackSpace or Tab or Del keyCode ����
    if ( varCk == 8 || varCk == 9 || varCk == 46 ) {
        return true;
    }

    jiyukStat = false;

    // �����Է� üũ

    if(!isInteger(strVal1,'')) {
        alert("���ڸ� �Է� �����մϴ�!!!");
        jiyukStat = true;
        input1.focus();
        input1.select();
        return false;
    }

    if(strFlag1 == "1") {   // �Ϲ���ȭ
        // ���ڸ� ���� ���� ����
        if( isLength(strVal1) < 2 ) {
            jiyukStat = true;
            return false;
        }

        // ���� üũ
        if( (isLength(strVal1) < 3) && (strVal1 != "02") ) {
            jiyukStat = true;
            return false;
        }

        /*
        // ������ȣ üũ
        if( !isGenPhone(strVal1) ) {
            if(!trim(strVal1) == ""){
                alert("������ȣ�� �ٸ��� �Է��ϼ���!!!");
            }
            jiyukStat = true;
            input1.focus();
            input1.select();
            return false;
        }
        */
    } else if(strFlag1 =="2") { // �޴���ȭ
        // ���ڸ� ���� ���� ����
        if(isLength(strVal1) < 3) {
            jiyukStat = true;
            return false;

        // �޴���ȭ�� KTP(0130)�ϰ�� by 2003.10.10 �����
        } else if(isLength(strVal1) == 3 && strVal1 == "013") {
            jiyukStat = true;
            return false;
        }

        /*
        // �̵���Ż� ��ȣ üũ
        if(!isCellarPhone(strVal1)) {

            if( !trim(strVal1) == ""){
                alert("�ڵ��� ��ȣ�� �ٸ��� �Է��ϼ���!!!");
            }
            jiyukStat = true;
            input1.focus();
            input1.select();
            return false;
        }
        */


    } else {    // �Ϲ� or �޴���ȭ
        // ���� üũ
        if(isLength(strVal1) < 3) {
            if(strVal1 == "02") {
                ;
            } else {
                jiyukStat = true;
                return false;
            }
        }
        /*
        // ������ȣ üũ
        if(!isCellarPhone(strVal1) && !isGenPhone(strVal1)) {
            alert("����(�̵����)��ȣ�� �ٸ��� �Է��ϼ���!!!");
            jiyukStat = true;
            input1.focus();
            input1.select();    return false;
        }
        */

    }

    jiyukStat = true;
    input2.focus();
    input2.select();
    return true;
}


// ������ȣ �� �ڵ��� ���� ��ȣ üũ(�Ǳ�� �߰�)
function telJiyuk_onBlur(input1, input2, flag1){
    //////////////////////////////////////////////////////////////////////////
    // input 1  : ������ȣ�� �Է��ϴ� text�� name                               //
    // input 2  : ������ �Է��ϴ� text�� name                                   //
    // flag1    : '1' --> ��ȭüũ, '2' --> �ڵ���üũ, '3' --> �Ѵ� üũ       //
    //////////////////////////////////////////////////////////////////////////
    var strVal1     = input1.value;
    var strFlag1    = flag1;
    var varCk       = window.event.keyCode;

    //BackSpace or Tab or Del keyCode ����
    if ( varCk == 8 || varCk == 9 || varCk == 46 ) {
        return true;
    }

    // key�̺�Ʈ ó�� ��
    if(jiyukStat == true) {
        // �����Է� üũ
        if(!isInteger(strVal1,'')) {
            alert("���ڸ� �Է� �����մϴ�!!!");return false;
        }

        /*
        if(strFlag1 == "1") {   // �Ϲ���ȭ
            // ������ȣ üũ
            if( !isGenPhone(strVal1) ) {
                if( trim(strVal1) != ""){
                    alert("������ȣ�� �ٸ��� �Է��Ͻÿ�!!!");
                }
                return false;
            }

        } else if(strFlag1 =="2") { // �޴���ȭ
            // ������ȣ üũ
            if(!isCellarPhone(strVal1)) {
                if( trim(strVal1) != ""){
                    alert("�ڵ��� ��ȣ�� �ٸ��� �Է��Ͻÿ�!!!");
                }
                return false;
            }

        } else {    // �Ϲ� or �޴���ȭ
            // ���� üũ
            if(isLength(strVal1) < 3) {
                if(strVal1 == "02") {
                    ;
                } else return true;
            }

            // ����(�̵����)��ȣ üũ
            if(!isCellarPhone(strVal1) && !isGenPhone(strVal1)) {
                alert("����(�̵����)��ȣ�� �ٸ��� �Է��Ͻÿ�!!!");
            alse;
            }
        }
        */
    }
}


function telJiyukCntr_onBlur(input1, input2, flag1){
    //////////////////////////////////////////////////////////////////////////
    // input 1  : ������ȣ�� �Է��ϴ� text�� name                               //
    // input 2  : ������ �Է��ϴ� text�� name                                   //
    // flag1    : '1' --> ��ȭüũ, '2' --> �ڵ���üũ, '3' --> �Ѵ� üũ       //
    //////////////////////////////////////////////////////////////////////////

    var strVal1     = input1.value;
    var strFlag1    = flag1;
    var varCk       = window.event.keyCode;

    //BackSpace or Tab or Del keyCode ����
    if ( varCk == 8 || varCk == 9 || varCk == 46 ) {
        return true;
    }
	jiyukStat = true; //2007-08-08
    // key�̺�Ʈ ó�� ��
    if(jiyukStat == true) {
        // �����Է� üũ
        if(!isInteger(strVal1,'')) {
            alert("���ڸ� �Է� �����մϴ�!!!");return false;
        }


        if(strFlag1 == "1") {   // �Ϲ���ȭ
            // ������ȣ üũ
            if( !isGenPhone(strVal1) && !isPnaPhone(strVal1) && !isVoipCheck(strVal1) ) {
                if( trim(strVal1) != ""){
                    alert("������ȣ�� �ٸ��� �Է��Ͻÿ�!!!");
                    input1.focus();
        			input1.select();
                }
                return false;
            }

        } else if(strFlag1 =="2") { // �޴���ȭ
            // ������ȣ üũ
            if(!isCellarPhone(strVal1)) {
                if( trim(strVal1) != ""){
                    alert("�ڵ��� ��ȣ�� �ٸ��� �Է��Ͻÿ�!!!");
                    input1.focus();
        			input1.select();
                }
                return false;
            }

        } else {    // �Ϲ� or �޴���ȭ
            // ���� üũ
            if(isLength(strVal1) < 3) {
                if(strVal1 == "02") {
                    ;
                } else return true;
            }

            // ����(�̵����)��ȣ üũ
            if(!isCellarPhone(strVal1) && !isGenPhone(strVal1)) {
                alert("����(�̵����)��ȣ�� �ٸ��� �Է��Ͻÿ�!!!");
            alse;
            }
        }

    }
}

var kukStat = false;    // ���� �۾� �÷���(onBlur �̺�Ʈ �����)
// ����ȣ üũ(key up��)
function telKuk_onKey(input2, input3)
{
    //////////////////////////////////////////////////////////////////////////
    // input 2  : ������ �Է��ϴ� text�� name                                   //
    // input 3  : ��ȣ�� �Է��ϴ� text�� name                                   //
    //////////////////////////////////////////////////////////////////////////
    var strVal2     = input2.value;

    //if ( event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 46) {
    //    input1.focus();
    //    kukStat = false;
    //  return false;
    //}
    kukStat = false;

/*
    if( strVal2.substring(0,1) == "0" ) {
        alert("�Ǿ��ڸ��� '0'�� �� ���� �����ϴ�!!!");
        //input2.value = strVal2.substring(1);
        kukStat = true;
        return false;
    }
*/
    // ���� üũ
    if(!isInteger(strVal2,'')) {
        alert("���ڸ� �Է��� �����մϴ�!!!");
        kukStat = true;
        input2.focus();
        input2.select();
        return false;
    }

    // ��ȣ�ʵ�� ��Ŀ�� �̵�
    if ( isLength(strVal2) == 3 ) {
        kukStat = true;
        input3.focus();
        input3.select();
    }

    kukStat = true;
    return true;
}

// ����ȣ üũ(focus�̵���)
function telKuk_onBlur(input2, input3)
{
    //////////////////////////////////////////////////////////////////////////
    // input 2  : ������ �Է��ϴ� text�� name                                   //
    // input 3  : ��ȣ�� �Է��ϴ� text�� name                                   //
    //////////////////////////////////////////////////////////////////////////
    var strVal2     = input2.value;

    if ( event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 46) {
    //    input1.focus();
        return false;
    }

    if(kukStat == false) return false;

    // ���� ���� üũ
    /*
    if ( isLength(strVal2) < 3 ) {
        alert("���ڸ� �̻��� ������ �Է��Ͻ�?!!");
        return false;
    }

/*    // ���� ù°�ڸ� üũ

    if( strVal2.substring(0,1) == "0" ) {
        alert("�Ǿ��ڸ��� '0'�� �� ���� �����ϴ�!!!");
        //input2.value = strVal2.substring(1);
        return false;
    }
    */
    // ���� üũ
    if(!isInteger(strVal2,'')) {
        alert("���ڸ� �Է��� �����մϴ�!!!");

        return false;
    }

    return true;
}


var noStat = false; // ���� �۾� �÷���(onBlur �̺�Ʈ �����)
// ���� üũ(KeyUp�̵���)
// ���� üũ(KeyUp�̵���)
function telNo_onKey(input2, input3)
{

    //////////////////////////////////////////////////////////////////////////
    // input 2  : ����ȣ�� �Է��ϴ� text�� name                             //
    // input 3  : ��ȣ�� �Է��ϴ� text�� name                                   //
    //////////////////////////////////////////////////////////////////////////
    var strVal3     = input3.value;

    if ( event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 46) {
    //    input1.focus();
        return false;
    }

    kukStat = false;

    // ���� üũ
    if(!isInteger(strVal3,'')) {
        alert("���ڸ� �Է��� �����մϴ�!!!");
        kukStat = true;
        //input3.focus();
        input3.focus();
        input3.select();
        return false;
    }

    if(input2.value.length !=4 ){
        if ( strVal3.length == 5 ) {
            strVal3 = strVal3.substring(0,1);
            input2.value = input2.value.substring(0,3) + strVal3;
            input3.value = input3.value.substring(1,5);
        }
    }

    if(strVal3.length ==5 ){
        input3.value = strVal3.substring(0,4);
    }

    kukStat = true;
    return true;
}
// ����üũ(focus�̵���)
function telNo_onBlur(input3)
{
    //////////////////////////////////////////////////////////////////////////
    // input 2  : ����ȣ�� �Է��ϴ� text�� name                             //
    // input 3  : ��ȣ�� �Է��ϴ� text�� name                                   //
    //////////////////////////////////////////////////////////////////////////
    var strVal3     = input3.value;

    if ( event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 46) {
    //    input1.focus();
        return false;
    }

    if(kukStat == false) return false;

    // ���� ���� üũ
    //if ( isLength(strVal3) < 4 ) {
    //  alert("���ڸ� �̻��� ��ȭ��ȣ�� �Է��Ͻÿ�!!!");
    //  return false;
    //}

    if ( isLength(strVal3) == 2 ) {
        input3.value = "00" + strVal3;
        //return false;
    }

    /*
    if ( isLength(strVal3) == 1 || isLength(strVal3) == 3) {
        alert("���ڸ� �̻��� ��ȭ��ȣ�� �Է��Ͻ�!!");
        return false;
    }
    */
    return true;
}


/**
* changeTelNumberSplit                                        <BR>
* ���ڿ��� �Էµ� ����12�ڸ� ��ȭ��ȣ�� �޾� ����,������ȣ,��ȣ�� �и��ؼ� return�Ѵ�.
* @param    numberValue   String �Է¹��� ���ڿ�
*           gbn           1:���� 2:������ȣ 3:��ȣ
* ex) "005305427845", 1  ----> "053"
*     "005305427845", 2  ----> "542"
*     "005305427845", 3  ----> "7845"
* @return   Str           String �и��� ��ȭ��ȣ ���
*/
function changeTelNumberSplit(numberValue, gbn) {
    if(numberValue == "" || numberValue == null || numberValue.length != 12)
    {
        return "";
    }

    var telNumber = "";

    switch ( gbn ){
        case 1 :
            telNumber = numberValue.substring(0,4);
            if(telNumber.charAt(0) == "0")
            {//0661
                var first = "";
                first = telNumber.substring(1,4);
                if(first.charAt(0) != "0")
                {
                    return telNumber;
                }
                else
                {//0032
                    var second = "";
                    second = telNumber.substring(2,4);
                    if(second.charAt(0) != "0")
                    {
                        return first;
                    }
                    else
                    {//0002
                        var third = "";
                        third = telNumber.substring(3,4);
                        if(third.charAt(0) != "0")
                        {
                            return second;
                        }
                    }//0002
                }//0032

            }//0661
            else
            {
                return telNumber;
            }

        case 2 :
            telNumber = numberValue.substring(4,8);
            if(telNumber.charAt(0) == "0")
            {
                return numberValue.substring(5,8);
            }
            else
            {
                return telNumber;
            }

        case 3 :
            return numberValue.substring(8,12);
    }

    return "";

}//changeTelNumberSplit(String numberValue, gbn)


/**
* custNoSplit                                        <BR>
* ���ڿ��� �Էµ� 13�ڸ��� �ֹι�ȣ�� �޾� ���ڸ�6�ڸ��� ���ڸ�7�ڸ��� �и��ؼ� return�Ѵ�.
* @param    numberValue   String �Է¹��� ���ڿ�
*           gbn           1:�ֹι�ȣ6�ڸ� 2:�ֹι�ȣ7�ڸ�
* ex) "1234561234567", 1  ----> "123456"
*     "1234561234567", 2  ----> "1234567"
* @return   Str           String ���ڸ��� ���ڸ��� �и��� �ֹι�ȣ ���
*/
function custNoSplit(custNoValue, gbn) {
    var custNo = "";
    switch ( gbn ){
        case 1 :
            custNo = custNoValue.substring(0,6);
            break;
        case 2 :
            custNo = custNoValue.substring(6,13);
            break;
        case 3 :
            custNo = "";
            break;
    }
    return custNo;
}


// 2003-05-17 5:57���� �輺�� �߰� start
// �ΰ����� ��ȸ
//-----------------------------------------------------------------------------
// ��û��ȣ : ���̺�� ���� ID �ݿ�
// ��û��   : ���
// ������   : �̵���
// ������   : 2006-02-27 1:23����
//-----------------------------------------------------------------------------

function PaComm_Popup_SubSvc(rObj, vModal)
{
    var params = "";

    try
    {
        params = params + "?SA_CD="             + rObj.sa_cd;
        params = params + "&SVC_TYPE_CD="       + rObj.svc_type_cd;
        params = params + "&SUBSVC_P_SA_CD="    + rObj.subsvc_p_sa_cd;

        var subsvc_len = rObj.subsvc_svc_no.length;
        for(var i=0; i<subsvc_len; i++)
        {
            params = params + "&SUBSVC_SA_CD="              + rObj.subsvc_sa_cd[i].value;
            params = params + "&SUBSVC_PROC_TYPE="          + rObj.subsvc_proc_type[i].value;
            params = params + "&SUBSVC_SELF_INDEX="         + rObj.subsvc_self_index[i].value;
            params = params + "&SUBSVC_SVC_NO="             + rObj.subsvc_svc_no[i].value;
            params = params + "&SUBSVC_PASSWD="             + rObj.subsvc_passwd[i].value;
            params = params + "&SUBSVC_PAY_BASE="           + rObj.subsvc_pay_base[i].value;
            params = params + "&SUBSVC_SELLER_TYPE_CD="     + rObj.subsvc_seller_type_cd[i].value;
            params = params + "&SUBSVC_SELLER_ID="          + rObj.subsvc_seller_id[i].value;
            params = params + "&SUBSVC_SELLER_NAME="        + rObj.subsvc_seller_name[i].value;
            params = params + "&SUBSVC_OLD_SA_CD="          + rObj.subsvc_old_sa_cd[i].value;
            params = params + "&SUBSVC_OLD_PROC_TYPE="      + rObj.subsvc_old_proc_type[i].value;
            params = params + "&SUBSVC_OLD_SELF_INDEX="     + rObj.subsvc_old_self_index[i].value;
            params = params + "&SUBSVC_OLD_SVC_NO="         + rObj.subsvc_old_svc_no[i].value;
            params = params + "&SUBSVC_OLD_PASSWD="         + rObj.subsvc_old_passwd[i].value;
            params = params + "&SUBSVC_OLD_PAY_BASE="       + rObj.subsvc_old_pay_base[i].value;
            params = params + "&SUBSVC_OLD_SELLER_TYPE_CD=" + rObj.subsvc_old_seller_type_cd[i].value;
            params = params + "&SUBSVC_OLD_SELLER_ID="      + rObj.subsvc_old_seller_id[i].value;
            params = params + "&SUBSVC_OLD_SELLER_NAME="    + rObj.subsvc_old_seller_name[i].value;
        }
    } catch (e) { ; }

    if (vModal == true)
    {
        var rtnValue = window.showModalDialog('/weblogic/pa911c_s01'+params, '', 'dialogWidth:600px;dialogHeight:460px;status:no;help:no;');

        if (typeof(rtnValue) != "undefined" && rtnValue != "NONE")
        {
            Layer_SubSvc.innerHTML = rtnValue;
        }
        // �ּ� ��ȸ window���� Ȯ�ι�ư Ŭ���ø� rtnValue�� Object�� �Ѿ�´�.
        try        {
            childwindow_subsvc(rtnValue);
        } catch (e) { ; }
    }
    else
    {
        NewWindow2('/weblogic/pa911c_s01'+params, '', '600', '400', 'no', 'no');
    }
}

function paComm_Popup_Equip()
{
    NewWindow2('/pa/jsp/pa912c_p01.jsp','','600','450','no','no');
}

//��, ���� ����Ʈ�ڽ� onChange �ÿ� ȣ��Ǵ� �Լ�
function selectDate ( YR, MT, DY ) {
    var year  = YR.value;
    var day   = 0;
    var month = MT.selectedIndex;

    var today =  new Date();

    // 2003-06-04 9:59����
    //  �輺�� ������
    var falDay   = "";
    try { falDay = Number(DY.value) ; } catch(e) { falDay = 1; }
    // 2003-09-08 1:52���� �輺�� ������
//  try { falDay = DY.selectedIndex+1; } catch(e) { falDay = 1; }
    displayCalendar(month, year, DY, falDay);
    if (falDay > (DY.selectedIndex+1)) DY.selectedIndex = 0;
}

//�� �޿� �´� ��¥�� ������ ����Ʈ�ڽ��� ������ִ� �Լ�
function displayCalendar(month, year, l_DAY, s_day) {

    var arrChild = null;
    var arrChildName = null;
    arrChild = new Array;
    arrChildName = new Array;

    arrChild[0] = new Option();
    arrChildName[0] = new String();

    month = parseInt(month);
    year = parseInt(year);
    var i = 0;
    var j = 0;
    var days = getDaysInMonth( month + 1, year);

    var firstOfMonth = new Date (year, month, 1);
    var startingPos = firstOfMonth.getDay();

    for (j = 0; j < l_DAY.options.length; j++) {
        l_DAY.options[j] =null;
    }

    for (i = 0; i < days; i++) {
        arrChild[i] = new Option(i+1);
        arrChildName[i] = new String(i+1);
        l_DAY.options[i] =arrChild[i];

        if (i < 9){                                   //8�ڸ���  ���߱� ���� 10�Ϻ��� ���� ���ڴ� 2�ڸ���..  ex)
            l_DAY.options[i].value = "0";
            l_DAY.options[i].value +=arrChildName[i];
            l_DAY.options[i].text = "0";
            l_DAY.options[i].text +=arrChildName[i];
        }else{
            l_DAY.options[i].text  =arrChildName[i];
            l_DAY.options[i].value =arrChildName[i];

        }
    }

    if (s_day < 10) {                          // �߰�  2002/01/01
     s_day = "0".concat(s_day);
    }

    l_DAY.selectedIndex = s_day;     //���ڿ� ���� ��¥�� ......
    l_DAY.value = s_day;
}

function getDaysInMonth(month,year)  {
        var days;
        if (month==1 || month==3 || month==5 || month==7 || month==8 || month==10 || month==12)  days=31;
        else if (month==4 || month==6 || month==9 || month==11) days=30;
        else if (month==2)  {
        if ( isLeapYear(year) ) { days=29; }
        else { days=28; }
        }
        return (days);
}


function isLeapYear (Year) {
        if (((Year % 4)==0) && ((Year % 100)!=0) || ((Year % 400)==0)) {
        return (true);
        } else { return (false); }
}
// 2003-05-17 5:57���� �輺�� �߰� end

// 2003-05-19 5:57���� �絿ȣ �߰� start
function getCurrentDate(usrDataFormat){
    var usrToDay = new Date();
    var retStr = "";
    var ktYear  = usrToDay.getYear();
    var ktMonth = usrToDay.getMonth();
    ktMonth = ktMonth+1;
    if ( ktMonth < 10 )
        ktMonth = "0" + ktMonth;
    var ktDay   = usrToDay.getDate();
    if ( ktDay < 10 )
        ktDay = "0" + ktDay;

    var ktHour   = usrToDay.getHours();
    if ( ktHour < 10 )
        ktHour = "0" + ktHour;
    var ktMinute = usrToDay.getMinutes();
    if ( ktMinute < 10 )
        ktMinute = "0" + ktMinute;
    var ktSecond = usrToDay.getSeconds();
    if ( ktSecond < 10 )
        ktSecond = "0" + ktSecond;

    usrDataFormat = "____" + usrDataFormat;

    if ( usrDataFormat.indexOf("yyyy") != -1){
        retStr += ktYear;
    }
    if ( usrDataFormat.indexOf("MM") != -1){
        retStr += ktMonth;
    }
    if ( usrDataFormat.indexOf("dd") != -1){
        retStr += ktDay;
    }

    if ( usrDataFormat.indexOf("HH") != -1){
        retStr += ktHour;
    }
    if ( usrDataFormat.indexOf("mm") != -1){
        retStr += ktMinute;
    }
    if ( usrDataFormat.indexOf("ss") != -1){
        retStr += ktSecond;
    }

    return retStr;

}

function day_before(s,subDay) {
   var nSubDay = Number(subDay);
   var sdate = new Date(Number(s.substring(0,4)),Number(s.substring(4,6))-1,Number(s.substring(6,8)));
   var odate = new Date(sdate.getTime() - (nSubDay * 86400000));
   return (odate.getMonth()+1) + '/' + odate.getDate() + '/' + odate.getYear();
}
// 2003-05-19 5:57���� �絿ȣ �߰� end

// 2003-05-21 11:13���� �Ǻ��� �߰� start
// �����޼������� v_s1���� ã�Ƽ� ��� v_s2�� ��ġ�Ѵ�.
function StringReplaceAll(v_msg, v_s1, v_s2)
{

    while(v_msg.indexOf(v_s1) != -1)
    {
        v_msg = v_msg.replace(v_s1, v_s2);
    }
    return v_msg;

}

/**
* changeTelNumberSplitNew                                        <BR>
* ���ڿ��� �Էµ� ��ȭ��ȣ�� �޾� "-"�� " "�� ���� �� �ı���,������ȣ,��ȣ�� �и��ؼ� return�Ѵ�.
* @param    numberValue   String �Է¹��� ���ڿ�
*           gbn           1:���� 2:������ȣ 3:��ȣ
* ex) "005305427845"      ----> 12�ڸ� ---> changeTelNumberSplit(numberValue, gbn)����
*     "053 542 7845 ", 1  ----> "053"
*     "053-0542-7845", 2  ----> "542"
*     "053 542 7845 ", 3  ----> "7845"
* @return   Str           String �и��� ��ȭ��ȣ ���
*/
function changeTelNumberSplitNew(numberValue, gbn) {
    var steTmp1 = "";
    var steTmp2 = "";

    if(numberValue == "" || numberValue == null)
    {
        return "";
    }

    numberValue = StringReplaceAll(StringReplaceAll(trim(numberValue), "-", ""), " ", "");

    if(numberValue.length == 12)
    {
        return changeTelNumberSplit(numberValue, gbn);
    }

    if(numberValue.length == 7 || numberValue.length == 8)
    {
        steTmp1 = "";
        steTmp2 = numberValue;
    }
    else
    {
        if(numberValue.substring(0, 2) == "02") {
            steTmp1 = numberValue.substring(0, 2);
            steTmp2 = numberValue.substring(2);
        }
        else {
            steTmp1 = numberValue.substring(0, 3);
            steTmp2 = numberValue.substring(3);
        }
    }

    switch(gbn)
    {
        case 1:
            return steTmp1;
            break;
        case 2:
            if(steTmp2.length == 7) {
                return steTmp2.substring(0, 3);
            }
            else {
                return steTmp2.substring(0, 4);
            }
            break;
        case 3:
            if(steTmp2.length == 7) {
                return steTmp2.substring(3);
            }
            else {
                return steTmp2.substring(4);
            }
            break;
    }

}
// 2003-05-21 11:13���� �Ǻ��� �߰� end


/**
* addMonth
* ��¥���ڿ�(ex "20031213")�� ������ ���� �Է¹޾Ƽ� ������ ��¥�� �����Ѵ�.
* @param    strDate         String �Է¹��� �����(�Ǵ� ����Ͻú��ʵ��)
*           nAddMonth       ������ ��(-�� ���� ���� ���̴�.)
* ex) addMonth("20010131",1)  -> ���� ��Ʈ���� "20010228"
* @return   Str           ������ ��¥ ��Ʈ��
*/
function addMonth(strDate,nAddMonth){

        var szMonth = new Array(31,28,31,30,31,30, 31,31,30, 31,30,31);
        var strCurDate = strDate.toString();
        var strAddDate = "";
        var strRest ="";

        var nYear = 0;
        var nMonth = 0;
        var nDay =0;

        if (strCurDate.length == 0) {
            return strCurDate;
        }

        while(strCurDate.length < 8) {
            strCurDate += "0";
        }

        nYear   = parseInt(strCurDate.substring(0,4)   ,10);
        nMonth  = parseInt(strCurDate.substring(4, 6)  ,10);
        nDay    = parseInt(strCurDate.substring(6, 8)  ,10);


        if( strCurDate.length > 8) {
            strRest = strCurDate.substring(8,strCurDate.length);
        } else {
            strRest = "";
        }

        nMonth += nAddMonth;

        //��, �⵵�� ���� ���� ó���� �����Ѵ�.
        while (nMonth < 1) {
            nYear -= 1;
            nMonth += 12;
        }

        while (nMonth > 12 ) {
            nYear += 1;
            nMonth -= 12;
        }

        szMonth[1] = 28;                                //  2�� Reset
        if( (nYear%100) != 0 && (nYear%4) == 0 ) {
            szMonth[1] = 29;
        } else if((nYear%400) == 0) {
            szMonth[1] = 29;
        }

        if( szMonth[nMonth-1] < nDay) {
            nDay = szMonth[nMonth-1];
        }

        var year  = nYear.toString();
        var month = nMonth.toString();
        var day   = nDay.toString();
        if(month.length==1){
            month = "0" + month;
        }
        if(day.length ==1){
            day = "0" + day;
        }

        return year + month + day + strRest;

    }
// 2003-05-22 20:11 �������߰�

    // 2003-06-11 3:30���� �輺�� �߰�
    // ���簪�� ��ġ�ϴ� radio rObj�� �������ش�.
    function setRadioValue(rObj, val)
    {
        var i;
        var rtn;
        try
        {
            for(i=0;i<rObj.length;i++)
                if (rObj[i].value == val) rObj[i].checked = true;
        }
        catch (e) { ; }
    }

    // 2003-06-13 7:27���� �輺�� �߰�
    // ���� Object�� ���ؼ� ǥ�� ��ǥ�� �Ѵ�.
    function ObjDisplay(vObj)
    {
        try
        {
            if (vObj.style.display == "none")
                vObj.style.display = "";
            else
                vObj.style.display = "none";
        } catch (e) { ; }
    }

    //2003-06-24 ko
    //��������ȭ�鿡�� ����� kt���� �ϰ�� ���� �Ұ�
    function checkSaveAgentUser(usrGB,usrGUBUN)
    {
        var msg;
        if(usrGB=="6") {
            if(usrGUBUN !="0" &&usrGUBUN !="1") {
                msg = "���� ����ڴ� ���� ������ �����ϴ�!";
                openMsgDiag(msg);
                return false;
            }
        }
        return true;
    }


// ���� �������� , (�޸�) �߰�
// 1000 -> 1,000
function commaSplit(srcNumber) {
var txtNumber = '' + srcNumber;
if (isNaN(txtNumber) || txtNumber == "") {
alert("���ڸ� �Է� �ϼ���");
fieldName.select();
fieldName.focus();
}
else {
var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
var arrNumber = txtNumber.split('.');
arrNumber[0] += '.';
do {
arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
} while (rxSplit.test(arrNumber[0]));
if (arrNumber.length > 1) {
return arrNumber.join('');
}
else {
return arrNumber[0].split('.')[0];
      }
   }
}


////////////////////////////
// ICIS �¶����� �ƴҶ� �¶����� üũ�Ѵ�.
function onLineCheck(){
    var form = document.mainForm;
return;
    try
    {
        if( form.ACCEPT_ST.value != "" ){
            return;
        }
    } catch (e) { ; }

    var onOffFlag =form.ON_OFFFLAG.value;

    var vMAIL_CONFIRM_FLAG = form.MAIL_CONFIRM_FLAG.value;

    //if( onOffFlag == "" && vMAIL_CONFIRM_FLAG =="1" ){
    //    return;
    //}

    //-----------------------------------------------------------------------------
    // ��û��ȣ : PENALTY_FLAG üũ...
    // ��û��   : ���־�
    // ������   : �����
    // ������   : 2006.03.06
    // �������� :  PENALTY_FLAG üũ...
    //-----------------------------------------------------------------------------
    var vPENALTY_FLAG    = '';
    var vZZ_NO_MENU_FLAG = '';

    //-----------------------------------------------------------------------------
    // ��û��ȣ : [3443] ������ �����ϴ� ȭ�鿡 ssl ����
    // ��û��   : ��̰�
    // ������   : �����
    // ������   : 2007-05-11 10:01����
    // �������� : SSL ���� �ε�
    //-----------------------------------------------------------------------------
    var vSSL_HTTPS = '';

    try
    {
        vSSL_HTTPS = form.CTOS_SSL_HTTPS.value;

    } catch(e) {
        vSSL_HTTPS = 'http://plaza.kt.co.kr';
    }
    //-----------------------------------------------------------------------------

    try
    {
        vPENALTY_FLAG    = form.PENALTY_FLAG.value;
        vZZ_NO_MENU_FLAG = form.ZZ_NO_MENU_FLAG.value;

        if(vPENALTY_FLAG == 'Y' && vZZ_NO_MENU_FLAG != 'Y')
        {
            var vPenaltyMsg = '���������� ������Դϴ�. �������� �Ⱓ�߿��� ��ǰ��û�� �ϽǼ� �����ϴ�.';

            openMsgDiag(vPenaltyMsg);

            // ���������̳� KT-PLAZA�϶�
            if( form.USR_GB.value == "5" || form.USR_GB.value == "6" )
            {
                //rtnUrl = form.SUCC_URL.value + "?USR_GB=" + form.USR_GB.value;
                rtnUrl= "/agent/main.jsp?USR_GB=" + form.USR_GB.value;
                location.href= rtnUrl;
                return;

            }else{
//-----------------------------------------------------------------------------
// ��û��ȣ : [2936] ������ð� ��� ���� ������, �̱��� 20070406
// ��û��   : ��̰�
// ������   : �̱���
// ������   : 2007-04-06 1:45����
// �������� : ������ġ�� �Ǻ��׸���
//-----------------------------------------------------------------------------
                var wd;
                if(form.USR_GB.value == "1" && confirm("��� ������ ��û�Ͻðڽ��ϱ�?")) {
                	wd = window.open(vSSL_HTTPS+"/pa/jsp/pa960i_p01.jsp", "reserve", "width=550, height=500, menubar=no, toolbar=no, scrollbars=no, status=no, resizable=no");
                }
                rtnUrl = form.SUCC_URL.value
                        + "?mn="     + form.mn.value
                        + "&scode="  + form.scode.value
                        + "&sname="  + form.sname.value;

                location.href= rtnUrl;

                if(wd != null) {
                 wd.focus();
                }

                return;
            }
        }

    }catch (e) {};
    //-----------------------------------------------------------------------------

    //////////////////
    // 2005-11-24 4:56���� oracle 9i up
    var vISCHECKEDSINYOUNG = "";
    var vSINYOUNGALERTTXT  = "";
    try
    {
        vISCHECKEDSINYOUNG = form.ISCHECKEDSINYOUNG.value;
        vSINYOUNGALERTTXT  = form.SINYOUNGALERTTXT.value;
    } catch (e) { ; }

    if( vISCHECKEDSINYOUNG != "" ) {
        ////////////
        openMsgDiag(vSINYOUNGALERTTXT);
        // ���������̳� KT-PLAZA�϶�
        if( form.USR_GB.value == "5" || form.USR_GB.value == "6" ){
            //rtnUrl = form.SUCC_URL.value + "?USR_GB=" + form.USR_GB.value;
            rtnUrl= "/pa/jsp/pa000m.jsp?USR_GB=" + form.USR_GB.value;
            location.href= rtnUrl;
            return;
        }else{
//-----------------------------------------------------------------------------
// ��û��ȣ : [2936] ������ð� ��� ���� ������, �̱��� 20070406
// ��û��   : ��̰�
// ������   : �̱���
// ������   : 2007-04-06 1:45����
// �������� : ������ġ�� �Ǻ��׸���
//-----------------------------------------------------------------------------
        	var wd;
          if(form.USR_GB.value == "1" && confirm("��� ������ ��û�Ͻðڽ��ϱ�?")) {
          	wd = window.open(vSSL_HTTPS+"/pa/jsp/pa960i_p01.jsp", "reserve", "width=550, height=500, menubar=no, toolbar=no, scrollbars=no, status=no, resizable=no");
          }

    //-----------------------------------------------------------------------------
    //  �� ������ �߰�  2004/07/01 01:33:40 ��û�� : ��̰�,������
    //      rtnUrl = form.SUCC_URL.value;
    //-----------------------------------------------------------------------------
            rtnUrl = form.SUCC_URL.value
                    + "?mn="     + form.mn.value
                    + "&scode="  + form.scode.value
                    + "&sname="  + form.sname.value;
    //-----------------------------------------------------------------------------
            location.href= rtnUrl;

            if(wd != null) {
             wd.focus();
            }

            return;
        }
    }

    //-----------------------------------------------------------------------------
    // ��û��ȣ : [3431] ��ǰ��û ��ȭ�鿡 �������� ���
    // ��û��   : ���
    // ������   : �����
    // ������   : 2007-05-07 2:49����
    // �������� : ���޴� Close �ȳ�
    //-----------------------------------------------------------------------------
    try
    {
        var vA4SMenuInfoMsg =
            '���������� �̿����ּż� �����մϴ�.\n'+
            '���� ��ȭ���� ������ �ߴܵǿ���\n'+
            '�����ϸ� ��ȭ���� �̿����ֽø� �����ϰڽ��ϴ�.\n\n'+
            '�ѱ�ȭ�� �ߴ����� : ���İ���\n'+
            '���ߴ�ȭ�� : \n'+
            '    �� �ް��н� Lite(��)\n'+
            '    �� �ް��н� Premium(��)\n'+
            '    �� �ް��н� Special(��)\n'+
            '    �� �ް��н� Ntopia(��)\n'+
            '    �� Nespot Lite(��)\n'+
            '    �� Nespot Premium(��)\n'+
            '    �� Nespot Special(��)\n'+
            '    �� Nespot Ntopia(��)\n'+
            '    �� �Ϲ���ȭ ��û(��ȭ��)\n'+
            '    �� ��ġ��Һ���(��ȭ��)\n'+
            '    �� ��ȣ����(��ȭ��)\n'+
            '    �� LM����������û(��ȭ��)\n'+
            '    �� ���̽�Ÿ�Ͽ����(��ȭ��)\n'+
            '    �� �����û(��ȭ��)\n';

        var vA4SMenuId      = form.A4S_MENU_ID.value;

        // ���������̳� KT-PLAZA�϶�
        if( form.USR_GB.value == "5" || form.USR_GB.value == "6" )
        {
            if( vA4SMenuId == 'A143' || // A143	�Ϲ���ȭ ��û(��ȭ��)
                vA4SMenuId == 'A144' || // A144	��ġ��Һ���(��ȭ��)
                vA4SMenuId == 'A145' || // A145	��ȣ����(��ȭ��)
                vA4SMenuId == 'A146' || // A146	LM�������� ��û(��ȭ��)
                vA4SMenuId == 'A147' || // A147	���̽�Ÿ�Ͽ���� (��ȭ��)
                vA4SMenuId == 'A148' || // A148	���� ��û(��ȭ��)
                vA4SMenuId == 'A202' || // A202	Megapass Lite(��)
                vA4SMenuId == 'A203' || // A203	Megapass Premium ��û(��)
                vA4SMenuId == 'A204' || // A204	Megapass Special ��û(��)
                vA4SMenuId == 'A205' || // A205	Megapass Ntopia ��û(��)
                vA4SMenuId == 'A219' || // A219	Nespot Solo Lite(��)
                vA4SMenuId == 'A220' || // A220	Nespot Solo Premium(��)
                vA4SMenuId == 'A221' || // A221	Nespot Solo Ntopia(��)
                vA4SMenuId == 'A222' )  // A222	Nespot Solo Special(��)
            {
                alert(vA4SMenuInfoMsg);
//                openMsgDiag(vA4SMenuInfoMsg);
            }
        }

    } catch(e) {

    }
    //-----------------------------------------------------------------------------

    if( onOffFlag == "" ){
        return;
    }

    // ��ǰ��û ������ ������ġ�� ����...
    var rtnUrl = "";

    var onOfftimeMsg = form.ON_OFF_TIME.value;
    if( onOfftimeMsg != "" ) {
        ////////////
        openMsgDiag(onOfftimeMsg);
        //Msgbox.Display("POI150","W");
        // ���������̳� KT-PLAZA�϶�
        if( form.USR_GB.value == "5" || form.USR_GB.value == "6" ){
            //rtnUrl = form.SUCC_URL.value + "?USR_GB=" + form.USR_GB.value;
            rtnUrl= "/pa/jsp/pa000m.jsp?USR_GB=" + form.USR_GB.value;
            location.href= rtnUrl;
            return;
        }else{
//-----------------------------------------------------------------------------
// ��û��ȣ : [2936] ������ð� ��� ���� ������, �̱��� 20070406
// ��û��   : ��̰�
// ������   : �̱���
// ������   : 2007-04-06 1:45����
// �������� : ������ġ�� �Ǻ��׸���
//-----------------------------------------------------------------------------
        	var wd;
          if(form.USR_GB.value == "1" && confirm("��� ������ ��û�Ͻðڽ��ϱ�?")) {
          	wd = window.open(vSSL_HTTPS+"/pa/jsp/pa960i_p01.jsp", "reserve", "width=550, height=500, menubar=no, toolbar=no, scrollbars=no, status=no, resizable=no");
          }

    //-----------------------------------------------------------------------------
    //  �� ������ �߰�  2004/07/01 01:33:40 ��û�� : ��̰�,������
    //      rtnUrl = form.SUCC_URL.value;
    //-----------------------------------------------------------------------------
            rtnUrl = form.SUCC_URL.value
                    + "?mn="     + form.mn.value
                    + "&scode="  + form.scode.value
                    + "&sname="  + form.sname.value;
    //-----------------------------------------------------------------------------
            var vPAGE_CODE = "";
            try{
                vPAGE_CODE = form.page_code.value;
            }catch(E){}


            //rtnUrl = form.SUCC_URL.value + "?mn=" + form.mn.value + "&scode=" + form.scode.value + "&sname=" + form.sname.value;
            rtnUrl = "/kt07/comm/go_page.jsp" + "?page_code=" + vPAGE_CODE;

            location.href= rtnUrl;

            if(wd != null) {
             wd.focus();
            }

            return;
        }
    }


    //var form = document.mainForm;
    //try
    //{
    //    if( form.EXT_CORP_CD.value != "" ){ // �ܺλ���Ʈ ������ ���
    //        return;
    //    }
    //} catch (e) {
    //
    //}

    //try{
    //    // 2004-07-14 10:24 �����϶� ���� ������������ 2004-07-14 10:24���� ������ �߰�
    //    var vMAIL_CONFIRM_FLAG = form.MAIL_CONFIRM_FLAG.value;
    //
    //    if( vMAIL_CONFIRM_FLAG != "1" ){
    //        if( form.USR_GB.value == "1" || form.USR_GB.value == "2" || form.USR_GB.value == "3" || form.USR_GB.value == "4" ){
    //            var emailMsg = "�̸��� ������ �ϼž�, ��ǰ ��û/���� �Ͻ� �� �ֽ��ϴ�.";
    //            openMsgDiag(emailMsg);
    //            rtnUrl = form.SUCC_URL.value
    //              + "?mn="     + form.mn.value
    //              + "&scode="  + form.scode.value
    //              + "&sname="  + form.sname.value;
    ////-----------------------------------------------------------------------------
    //            location.href= rtnUrl;
    //          return;
    //        }
    //    }
    //}catch(e){
    //
    //}
}

////////////////////////////
//
function closeExtCorp(){
    var form = document.mainForm;
    try
    {

        if( form.EXT_CORP_CD.value == "" ){
            //return true;
        }else {
            self.close();
            return false;
        }
    } catch (e) {
    //alert(e);
    }

    try
    {
        if( form.ZZ_NO_MENU_FLAG.value == "" ){
            return true;
        }else {
            self.close();
            return false;
        }
    } catch (e) {
    //alert(e);
    }
    return true;

}




function onLineCheckS(form){

    var onOffFlag =form.ON_OFFFLAG.value;
    if( onOffFlag == "" ){
        return;
    }

    // ��ǰ��û ������ ������ġ�� ����...
    var rtnUrl = "";

    var onOfftimeMsg = form.ON_OFF_TIME.value;

    ////////////
    openMsgDiag(onOfftimeMsg);

    //-----------------------------------------------------------------------------
    // ��û��ȣ : [3443] ������ �����ϴ� ȭ�鿡 ssl ����
    // ��û��   : ��̰�
    // ������   : �����
    // ������   : 2007-05-11 10:01����
    // �������� : SSL ���� �ε�
    //-----------------------------------------------------------------------------
    var vSSL_HTTPS = '';

    try
    {
        vSSL_HTTPS = form.CTOS_SSL_HTTPS.value;

    } catch(e) {
        vSSL_HTTPS = 'http://www.kt100.com';
    }
    //-----------------------------------------------------------------------------

    // ���������̳� KT-PLAZA�϶�
    if( form.USR_GB.value == "5" || form.USR_GB.value == "6" ){
        //rtnUrl = form.SUCC_URL.value + "?USR_GB=" + form.USR_GB.value;
        rtnUrl= "/pa/jsp/pa000m.jsp?USR_GB=" + form.USR_GB.value;
    }else{
//-----------------------------------------------------------------------------
//  �� ������ �߰�  2004/07/01 01:33:40 ��û�� : ��̰�,������
//      rtnUrl = form.SUCC_URL.value;
//-----------------------------------------------------------------------------
        rtnUrl = form.SUCC_URL.value
                + "?mn="     + form.mn.value
                + "&scode="  + form.scode.value
                + "&sname="  + form.sname.value
//-----------------------------------------------------------------------------
        var vPAGE_CODE = "";
        var wd;
        try{
            vPAGE_CODE = form.page_code.value;
        }catch(E){}

//-----------------------------------------------------------------------------
// ��û��ȣ : [2936] ������ð� ��� ���� ������, �̱��� 20070406
// ��û��   : ��̰�
// ������   : �̱���
// ������   : 2007-04-06 1:45����
// �������� : ������ġ�� �Ǻ��׸���
//-----------------------------------------------------------------------------
        if(form.USR_GB.value == "1" && confirm("��� ������ ��û�Ͻðڽ��ϱ�?")) {
        	wd = window.open(vSSL_HTTPS+"/pa/jsp/pa960i_p01.jsp", "reserve", "width=550, height=500, menubar=no, toolbar=no, scrollbars=no, status=no, resizable=no");
        }

        //rtnUrl = form.SUCC_URL.value + "?mn=" + form.mn.value + "&scode=" + form.scode.value + "&sname=" + form.sname.value;
        rtnUrl = "/kt07/comm/go_page.jsp" + "?page_code=" + vPAGE_CODE;

        location.href= rtnUrl;
        if(wd != null) {
         wd.focus();
        }

        return;
    }
}

// ���� ID�� ȭ�� ȣ��
// �̵��� 2002.10.18 �߰�
function openMsgfmtDiag(sendMsg,types,btncnt){
    var sendMsgfmt  = sendMsg+ "&msgtype="+types+"&btncnt="+btncnt+"";
    var returnval= "";
    returnval    = window.showModalDialog ('/weblogic/CtosMsgDiag?msgname='+sendMsgfmt, '', 'dialogHeight:260px;dialogWidth:520px;status:no; help:no;');
    return  returnval;
}



// �ѱ� �ѱ��ڸ� 2byte�� �ν��Ͽ�, IE�� Netscape��
// ����� byte���̸� ���� �ݴϴ�.

function getByteLength(s){
   var len = 0;
   if ( s == null ) return 0;
   for(var i=0;i<s.length;i++){
      var c = escape(s.charAt(i));
      if ( c.length == 1 ) len ++;
      else if ( c.indexOf("%u") != -1 ) len += 2;
      else if ( c.indexOf("%") != -1 ) len += c.length/3;
   }
   return len;
}

//custno type to custno type name
function getCustNoTypeName(s){
    if( s=='1'){
        return "�ֹι�ȣ";
    }else if(s=='2'){
        return "���ǹ�ȣ";
    }else if(s=='3'){
        return "���ι�ȣ";
    }else if(s=='4'){
        return "��ü";
    }else if(s=='5'){
        return "�ܱ��ε�Ϲ�ȣ";
    }else if(s=='6'){
        return "������ȣ";
    }else if(s=='8'){
        return "����ڹ�ȣ";
    }else if(s=='9'){
        return "��Ÿ";
    }else{
        return "error";
    }
/*
1   �ֹι�ȣ
2   ���ǹ�ȣ
3   ���ι�ȣ
4   ��ü
5   �ܱ��ε�Ϲ�ȣ
6   ������ȣ
8   ����ڹ�ȣ
9   ��Ÿ
*/

}


//cust no �� format�� �����Ѵ�.
function getCustNoFormat(custNoType,unFormatCustNo){
    try{
        var formattedCustNo = unFormatCustNo;
        if( custNoType=="1" && unFormatCustNo.length==13 ){
                formattedCustNo = unFormatCustNo.substring(0,6) + "-" + unFormatCustNo.substring(6,13);
        }else if( custNoType=="2" ){
                formattedCustNo = unFormatCustNo;
        }else if( custNoType=="3" && unFormatCustNo.length==13 ){
                formattedCustNo = unFormatCustNo.substring(0,6) + "-" +unFormatCustNo.substring(6,13);
        }else if( custNoType=="4" ){
                formattedCustNo = unFormatCustNo;
        }else if( custNoType=="5" ){
                formattedCustNo = unFormatCustNo;
        }else if( custNoType=="6" && unFormatCustNo.length==10 ){
                formattedCustNo = unFormatCustNo.substring(0,3) + "-" + unFormatCustNo.substring(3,5) + "-" + unFormatCustNo.substring(5,10);
        }else if( custNoType=="9" ){
                formattedCustNo = unFormatCustNo;
        }else{
            formattedCustNo = unFormatCustNo;
        }
        return  formattedCustNo;
    }catch(e){;}
}



function checkSellerNespot(UsePrpFlag){

    // start 2003.09.16 �����Ͽ䱸 ��û��ȣ:20030513 ������ϰ�� ��Ź������ �Ұ���
    if(UsePrpFlag.value == "3" ) {
        alert("������� ��쿡�� ��Ź���� �� �������ϴ�");
        //m_objMsgBox.Display("MCSNI9453`CSNT682W");
        return false;
    }

    return true;

}

function paComm_SvcTypeCdChg(){

    var pForm = document.mainForm;
    pForm.flagLogin.value   = "2";
    pForm.method            = "POST";
    pForm.action            = "/pa/inc/seller_nespotIframe.jsp";
    pForm.target            = "inSellerForm";
    pForm.submit();

}


////////////////////////////
// ICIS �¶����� �ƴҶ� �¶����� üũ�Ѵ�.
function onLineCheckNS(){
    var form = document.mainForm;
    try
    {
        if( form.ACCEPT_ST.value != "" ){
            return;
        }
    } catch (e) { ; }

    var onOffFlag =form.NS_ONLINE.value;
    if( onOffFlag == "" ){
        return;
    }


    // ��ǰ��û ������ ������ġ�� ����...
    var rtnUrl = "";

    var onOfftimeMsg = form.NS_ONLINE.value;

    ////////////
    openMsgDiag(onOfftimeMsg);
    //Msgbox.Display("POI150","W");

    //-----------------------------------------------------------------------------
    // ��û��ȣ : [3443] ������ �����ϴ� ȭ�鿡 ssl ����
    // ��û��   : ��̰�
    // ������   : �����
    // ������   : 2007-05-11 10:01����
    // �������� : SSL ���� �ε�
    //-----------------------------------------------------------------------------
    var vSSL_HTTPS = '';

    try
    {
        vSSL_HTTPS = form.CTOS_SSL_HTTPS.value;

    } catch(e) {
        vSSL_HTTPS = 'http://www.kt100.com';
    }
    //-----------------------------------------------------------------------------


    // ���������̳� KT-PLAZA�϶�
    if( form.USR_GB.value == "5" || form.USR_GB.value == "6" ){
        //rtnUrl = form.SUCC_URL.value + "?USR_GB=" + form.USR_GB.value;
        rtnUrl= "/pa/jsp/pa000m.jsp?USR_GB=" + form.USR_GB.value;

    }else{
//-----------------------------------------------------------------------------
// ��û��ȣ : [2936] ������ð� ��� ���� ������, �̱��� 20070406
// ��û��   : ��̰�
// ������   : �̱���
// ������   : 2007-04-06 1:45����
// �������� : ������ġ�� �Ǻ��׸���
//-----------------------------------------------------------------------------
    	  var wd;
        if(form.USR_GB.value == "1" && confirm("��� ������ ��û�Ͻðڽ��ϱ�?")) {
        	wd = window.open(vSSL_HTTPS+"/pa/jsp/pa960i_p01.jsp", "reserve", "width=550, height=500, menubar=no, toolbar=no, scrollbars=no, status=no, resizable=no");
        }
//-----------------------------------------------------------------------------
//  �� ������ �߰�  2004/07/01 01:33:40 ��û�� : ��̰�,������
//      rtnUrl = form.SUCC_URL.value;
//-----------------------------------------------------------------------------
        rtnUrl = form.SUCC_URL.value
                + "?mn="     + form.mn.value
                + "&scode="  + form.scode.value
                + "&sname="  + form.sname.value
//-----------------------------------------------------------------------------
        var vPAGE_CODE = "";
        try{
            vPAGE_CODE = form.page_code.value;
        }catch(E){}


        //rtnUrl = form.SUCC_URL.value + "?mn=" + form.mn.value + "&scode=" + form.scode.value + "&sname=" + form.sname.value;
        rtnUrl = "/kt07/comm/go_page.jsp" + "?page_code=" + vPAGE_CODE;

        location.href= rtnUrl;

        if(wd != null) {
         wd.focus();
        }

        return;

    }
    location.href= rtnUrl;
}


////////////////////////////
// ICIS �¶����� �ƴҶ� �¶����� üũ�Ѵ�.
// form name�� Ʋ�����
function onLineCheckNSS(form){
    try
    {
        if( form.ACCEPT_ST.value != "" ){
            return;
        }
    } catch (e) { ; }

    var onOffFlag =form.NS_ONLINE.value;
    if( onOffFlag == "" ){
        return;
    }


    // ��ǰ��û ������ ������ġ�� ����...
    var rtnUrl = "";

    var onOfftimeMsg = form.NS_ONLINE.value;

    ////////////
    openMsgDiag(onOfftimeMsg);
    //Msgbox.Display("POI150","W");

    //-----------------------------------------------------------------------------
    // ��û��ȣ : [3443] ������ �����ϴ� ȭ�鿡 ssl ����
    // ��û��   : ��̰�
    // ������   : �����
    // ������   : 2007-05-11 10:01����
    // �������� : SSL ���� �ε�
    //-----------------------------------------------------------------------------
    var vSSL_HTTPS = '';

    try
    {
        vSSL_HTTPS = form.CTOS_SSL_HTTPS.value;

    } catch(e) {
        vSSL_HTTPS = 'http://www.kt100.com';
    }
    //-----------------------------------------------------------------------------

    // ���������̳� KT-PLAZA�϶�
    if( form.USR_GB.value == "5" || form.USR_GB.value == "6" ){
        //rtnUrl = form.SUCC_URL.value + "?USR_GB=" + form.USR_GB.value;
        rtnUrl= "/pa/jsp/pa000m.jsp?USR_GB=" + form.USR_GB.value;
    }else{
//-----------------------------------------------------------------------------
// ��û��ȣ : [2936] ������ð� ��� ���� ������, �̱��� 20070406
// ��û��   : ��̰�
// ������   : �̱���
// ������   : 2007-04-06 1:45����
// �������� : ������ġ�� �Ǻ��׸���
//-----------------------------------------------------------------------------
    	  var wd;
        if(form.USR_GB.value == "1" && confirm("��� ������ ��û�Ͻðڽ��ϱ�?")) {
        	wd = window.open(vSSL_HTTPS+"/pa/jsp/pa960i_p01.jsp", "reserve", "width=550, height=500, menubar=no, toolbar=no, scrollbars=no, status=no, resizable=no");
        }
//-----------------------------------------------------------------------------
//  �� ������ �߰�  2004/07/01 01:33:40 ��û�� : ��̰�,������
//      rtnUrl = form.SUCC_URL.value;
//-----------------------------------------------------------------------------
        rtnUrl = form.SUCC_URL.value
                + "?mn="     + form.mn.value
                + "&scode="  + form.scode.value
                + "&sname="  + form.sname.value
//-----------------------------------------------------------------------------
        var vPAGE_CODE = "";
        try{
            vPAGE_CODE = form.page_code.value;
        }catch(E){}


        //rtnUrl = form.SUCC_URL.value + "?mn=" + form.mn.value + "&scode=" + form.scode.value + "&sname=" + form.sname.value;
        rtnUrl = "/kt07/comm/go_page.jsp" + "?page_code=" + vPAGE_CODE;

        location.href= rtnUrl;

        if(wd != null) {
         wd.focus();
        }

        return;

    }
    location.href= rtnUrl;
}

    ////////////////////////////
    // �������� �������� �޽���
    function custInfoUse(cust_id,cust_no_type,rs_cd ,methodname){
        mainForm.ASSENT_CUST_ID.value = cust_id;
        mainForm.ASSENT_RS_CD.value = rs_cd;
        mainForm.ASSENT_METHOD_NAME.value = methodname;
        mainForm.ASSENT_SAVE_FLAG.value = "X";

        // 2005-08-30 5:37���� ���κ� �����ǻ��� ������
        try{
            //callOrdSaveProc();
            eval( methodname + "();");
        }catch(e){

        }
        return;

    }

    ////////////
    // ��ǰ ����� ���α׷����ٸ� �����ش�.
    function showProgress(){
        try{
            loadingBar.style.display = '';
        }catch(e){

        }
    }

    ////////////
    // ��ǰ ����� ���α׷����ٸ� �����.
    function hideProgress(){

        try{
            parent.loadingBar.style.display = 'none';
        }catch(e){
            try{
                loadingBar.style.display = 'none';
            }catch(e){
                ;
            }
        }
            try{
                loadingBar.style.display = 'none';
            }catch(e){
                ;
            }
    }

//-----------------------------------------------------------------------------
//  �� ������ �߰�  2004/06/16 09:07:49 ��û�� : ��̰�,������
//-----------------------------------------------------------------------------
    function fn_sert(value)
    {
//      if ( value == "1" ){
//          alert("���� ����");
//          return true;
//      } else if ( value == "2" ) {
//            return "�������� �� ��û�Ͻðڽ��ϱ�? ";
//      }
    }
//-----------------------------------------------------------------------------


//------------------------------------------------------------------------------
// �ּҹ޾Ƽ� * �� �ٲپ��ִ°�
//------------------------------------------------------------------------------
    /**
     * �ּ� ������ ���ؼ� �ٲ۴�. INPUT "����� ������ ������ ���� ����Ʈ 112"
     * OUTPUT "����� ������ *** *** ** *** ***"�� �ٲپ��ش�. (�������� �ٲپ��ش�)
     */
    function  getAuthAddressTxt(fullAddressTxt ,usr_gb){
        try{
            if( fullAddressTxt == "" || fullAddressTxt == "" ){
                return "";
            }
            if( !( usr_gb == "0" || usr_gb =="1" ||
                   usr_gb == "2" || usr_gb == "3" || usr_gb == "4") ) {
                return fullAddressTxt;
            }
            return getAuthAddressTxt2(fullAddressTxt);
        }catch(e){
            return fullAddressTxt;
        }
    }

    function  getAuthAddressTxt2(fullAddressTxt){
        try{
            if( fullAddressTxt == "" || fullAddressTxt == "" ){
                return "";
            }
            var st = fullAddressTxt.split(" ");

            if(st.length < 3) return fullAddressTxt;

            var bFindGu = false;
            var nTh = 0 ;
            for ( i=0; i < st.length; i++ ) {
                var splist  =   st[i];
                if( nTh == 2 ){

                    var strGu = splist.substring(splist.length-1,splist.length);
                    if( strGu == "��" ){
                        bFindGu = true;
                    }
                }
                nTh = nTh+1;
            }
            var nFindDong = 2;
            if( bFindGu == true ){
                nFindDong = 3;
            }
            var strEdited ="";
            var nTh = 0 ;
            for ( i=0; i < st.length; i++ ) {
                var splist  =   st[i];
                if( nTh > nFindDong ){
                    strEdited = strEdited + fillStarChr(splist) + " ";
                }else{
                    strEdited = strEdited + splist + " ";
                }

                nTh = nTh+1;
            }

            return strEdited;
        }catch(e){
            return fullAddressTxt;
        }
    }


    /**
     * ���� ������ ���ؼ� �ٲ۴�. INPUT "ȫ�浿"
     * OUTPUT "ȫ*��"�� �ٲپ��ش�.
     */
    function getAuthCustName( fullCustName ){
        if( fullCustName =="" || fullCustName == null ){
            return "";
        }
        var nLength = fullCustName.length ;
        if( nLength < 2){
            return    fullCustName;
        }

        var vTotal = "";
        for( i = 0 ; i < nLength ; i ++ ){
            var charat = fullCustName.substring(i, i+1);
            //if( (i % 2) == 1 ){ //
			if( i == 0 ){ 
                charat = "*";
            }
            vTotal = vTotal + charat;
        }
        return vTotal;
    }


    function fillStarChr(splist) {
        var chk     = true;
        var rsplist = "";

        for (ii=0; ii <= splist.length-1; ii++) {
            rsplist = rsplist+"*";
        }
        return rsplist;
    }

    function openCalendar(obj)
    {
        var modalstr = window.showModalDialog('/pa/jsp/mega_calendar.jsp','calendar',
            'dialogHeight:206px;dialogWidth:195px;left=500;top=400;status:no;location=no,resizable=no,scrollbars=no,copyhistory=no help:no; center:yes;');
        if(modalstr !=null){
            obj.value= modalstr;
        }
    }


    /*
     * Interfaces:
     * b64 = base64encode(data);
     * data = base64decode(b64);
     */


    var base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
    var base64DecodeChars = new Array(
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63,
        52, 53, 54, 55, 56, 57, 58, 59, 60, 61, -1, -1, -1, -1, -1, -1,
        -1,  0,  1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14,
        15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -1, -1, -1, -1, -1,
        -1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40,
        41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1, -1, -1);

    function base64encode(str) {
        var out, i, len;
        var c1, c2, c3;

        len = str.length;
        i = 0;
        out = "";
        while(i < len) {
        c1 = str.charCodeAt(i++) & 0xff;
        if(i == len)
        {
            out += base64EncodeChars.charAt(c1 >> 2);
            out += base64EncodeChars.charAt((c1 & 0x3) << 4);
            out += "==";
            break;
        }
        c2 = str.charCodeAt(i++);
        if(i == len)
        {
            out += base64EncodeChars.charAt(c1 >> 2);
            out += base64EncodeChars.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4));
            out += base64EncodeChars.charAt((c2 & 0xF) << 2);
            out += "=";
            break;
        }
        c3 = str.charCodeAt(i++);
        out += base64EncodeChars.charAt(c1 >> 2);
        out += base64EncodeChars.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4));
        out += base64EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >>6));
        out += base64EncodeChars.charAt(c3 & 0x3F);
        }
        return out;
    }

    function base64decode(str) {
        var c1, c2, c3, c4;
        var i, len, out;

        len = str.length;
        i = 0;
        out = "";
        while(i < len) {
        /* c1 */
        do {
            c1 = base64DecodeChars[str.charCodeAt(i++) & 0xff];
        } while(i < len && c1 == -1);
        if(c1 == -1)
            break;

        /* c2 */
        do {
            c2 = base64DecodeChars[str.charCodeAt(i++) & 0xff];
        } while(i < len && c2 == -1);
        if(c2 == -1)
            break;

        out += String.fromCharCode((c1 << 2) | ((c2 & 0x30) >> 4));

        /* c3 */
        do {
            c3 = str.charCodeAt(i++) & 0xff;
            if(c3 == 61)
            return out;
            c3 = base64DecodeChars[c3];
        } while(i < len && c3 == -1);
        if(c3 == -1)
            break;

        out += String.fromCharCode(((c2 & 0XF) << 4) | ((c3 & 0x3C) >> 2));

        /* c4 */
        do {
            c4 = str.charCodeAt(i++) & 0xff;
            if(c4 == 61)
            return out;
            c4 = base64DecodeChars[c4];
        } while(i < len && c4 == -1);
        if(c4 == -1)
            break;
        out += String.fromCharCode(((c3 & 0x03) << 6) | c4);
        }
        return out;
    }

    function encryptCtos(str){
        return encodeURIComponent( str) ;
    }

    function decryptCtos(str){
        return decodeURIComponent(str) ;
    }


    function encryptCtos2(str){
        return encodeURIComponent(base64encode(str) );
    }

    function decryptCtos2(str){
        return decodeURIComponent(base64decode(str) );
    }

function setValue(date) {
    this.tmpObj.value = date.substring(0,4) + "/" + date.substring(4,6) + "/" + date.substring(6,8);
}

//ccui122s üũ 2008-01-28
function chkCcui122s(arrCcui) {
	
	var form = document.mainForm;
		
	var sParam = "?flag=ccui122s" ;
	
	// arrCcui[0] �� ���̹� �ϰ�� ���� ƨ������ ����
	// mall : ��ǰ�������� change : ��ǰ����������
	
	sParam	= sParam + "&ccuiSglSaId=" 		+ 	arrCcui[1];
	sParam	= sParam + "&ccuiSglSaCd=" 		+ 	arrCcui[2];
	sParam	= sParam + "&ccuiCustNoType=" 	+ 	arrCcui[3];
	sParam	= sParam + "&ccuiCustNo=" 		+ 	arrCcui[4];
	sParam	= sParam + "&ccuiDongCd=" 		+ 	arrCcui[5];	
	sParam	= sParam + "&ccuiAddrNoType=" 	+ 	arrCcui[6];	
	sParam	= sParam + "&ccuiAddrNo=" 		+ 	arrCcui[7];	
	sParam	= sParam + "&ccuiAddrHo=" 		+ 	arrCcui[8];	
	//sParam	= sParam + "&SHOW=" 			+ 	arrCcui[9];	
	sParam	= sParam + "&ccuiLineCnt=" 		+ 	arrCcui[10];	
	
	var sTemp = "";
    try {
    	if(arrCcui[11] == null || arrCcui[11]== "undefined" ) {
    		sTemp =  "&ccuiTranTypeCd=";
    	}
    	else {
    		sTemp =  "&ccuiTranTypeCd="   + 	arrCcui[11];
    	} 	
 	}catch(e){ sTemp = "&ccuiTranTypeCd=";	}  	
	sParam = sParam + sTemp;
	
    //���ջ�ǰ���� üũ START
    //alert(sParam);
    var urlval = '/weblogic/pa906i_s01'+sParam;
    var rtnValue = window.showModalDialog(urlval,'winCcui122', 'dialogHeight:300px;dialogWidth:620px;status:no; help:no;');
    
    if( rtnValue == null || rtnValue != "1" ){
    	if( form.USR_GB.value != '5' && form.USR_GB.value != '6' ) {
    		//if(arrCcui[0] == "" || arrCcui[0] == "mall") {
    		//	parent.top.location.href = "/kt07/customer/cu00_00_00_00m_p02.jsp?page_code=00_00_00_00_02&menuNum=1&subNum=&tabNum=&sProductCode=&sProductType=1&sComparisonYn=N";
	    	//}
	    	//else {
	        	parent.top.location.href = "/kt07/customer/ProductApplyChange.jsp?&sSearchPageCode=10_00_00_00_00&menuNum=2&subNum=&tabNum=&page_code=00_10_00_00_00&sProductCode=&sProductType=1&sComparisonYn=N";
	        //}
	        return false;
	    }
		else {
        	return false;			
		}
    }
    return true;
    //////////////////////////////////////////
    //���ջ�ǰ���� üũ END
        	
}  

//ccui111s üũ 2008-01-28
function chkCcui111s(arrCcui) {
	
	var form = document.mainForm;
	
	var sParam = "?flag=ccui111s" ;	
	
	sParam	= sParam + "&ccuiSglSaId=" 			+ 	arrCcui[1];
	sParam	= sParam + "&ccuiSglSaCd=" 			+ 	arrCcui[2];
	sParam	= sParam + "&ccuiSglUserOrdTypeCd=" + 	arrCcui[3];
	sParam	= sParam + "&ccuiSglOrdTypeCd=" 	+ 	arrCcui[4];
	sParam	= sParam + "&ccuiSglSubOrdTypeCd="	+	arrCcui[5];	

	
    //���ջ�ǰ���� üũ START
   // alert(sParam);
    var urlval = '/weblogic/pa906i_s01'+sParam;
    var rtnValue = window.showModalDialog(urlval,'winCcui111', 'dialogHeight:300px;dialogWidth:620px;status:no; help:no;');
    
    if( rtnValue == null || rtnValue != "1" ){
    	if( form.USR_GB.value != '5' && form.USR_GB.value != '6' ) {
    		//if(arrCcui[0] == "" || arrCcui[0] == "mall") {
    		//	parent.top.location.href = "/kt07/product/Product.jsp?sProductCode=1&page_code=10_10_10_00_00&menuNum=&subNum=&tabNum=#mallPoint";
	    	//}
	    	//else {
	        	parent.top.location.href = "/kt07/customer/ProductApplyChange.jsp?&sSearchPageCode=10_00_00_00_00&menuNum=2&subNum=&tabNum=&page_code=00_10_00_00_00&sProductCode=&sProductType=1&sComparisonYn=N";
	       // }
	        return false;
	    }
		else {
        	return false;			
		}
    }
    return true;
    //////////////////////////////////////////
    //���ջ�ǰ���� üũ END
        	
}  
		
//ccui111s üũ 2008-01-28
function chkCcui907s(arrCcui) {
	
	var form = document.mainForm;
	
	var sParam = "?flag=ccui907s" ;	
	
	sParam	= sParam + "&ccuiTYPE=" 			+ 	arrCcui[1];
	sParam	= sParam + "&ccuiSIZE=" 			+ 	arrCcui[2];
	sParam	= sParam + "&ccuiValue000=" 		+ 	arrCcui[3];
	sParam	= sParam + "&ccuiChgGb000=" 		+ 	arrCcui[4];

	
   // alert(sParam);
    var urlval = '/weblogic/pa906i_s01'+sParam;
    var rtnValue = window.showModalDialog(urlval,'winCcui907', 'dialogHeight:300px;dialogWidth:620px;status:no; help:no;');
    
    try {
    	form.arr907SaId.value = "";
 	}catch(e){}     	
    
    if( rtnValue != null ) {
    	if( rtnValue[0] == "1" ){
    		try {
    			form.arr907SaId.value = rtnValue[1];
	        }catch(e){}    		
    		return true;
    	}
    	else {
    		if( form.USR_GB.value != '5' && form.USR_GB.value != '6' ) {
	    		parent.top.location.href = "/kt07/customer/ProductApplyChange.jsp?&sSearchPageCode=10_00_00_00_00&menuNum=2&subNum=&tabNum=&page_code=00_10_00_00_00&sProductCode=&sProductType=1&sComparisonYn=N";
	    	}
    		return false;
    	}
    }

	if( form.USR_GB.value != '5' && form.USR_GB.value != '6' ) {
		parent.top.location.href = "/kt07/customer/ProductApplyChange.jsp?&sSearchPageCode=10_00_00_00_00&menuNum=2&subNum=&tabNum=&page_code=00_10_00_00_00&sProductCode=&sProductType=1&sComparisonYn=N";
	}
    return false;
    //////////////////////////////////////////
        	
}  

function chkCsng648s(arrCcui) {
	
	var form = document.mainForm;
	
	var sParam = "?flag=csng899s" ;	
	
	sParam	= sParam + "&REC_CNT=" 			+ 	arrCcui[1];
	sParam	= sParam + "&CUD_FLAG=" 		+ 	arrCcui[2];
	sParam	= sParam + "&TOP_SA_ID=" 		+ 	arrCcui[3];
	sParam	= sParam + "&CNTR_TYPE=" 		+ 	arrCcui[4];
	sParam	= sParam + "&CD_TYPE=" 			+ 	arrCcui[5];
	sParam	= sParam + "&CD=" 				+ 	arrCcui[6];
	sParam	= sParam + "&ORD_NO=" 			+ 	arrCcui[7];
	sParam	= sParam + "&NODE_ID=" 			+ 	arrCcui[8];	

	
    //alert(sParam);
    var urlval = '/weblogic/pa906i_s01'+sParam;
    var rtnValue = window.showModalDialog(urlval,'winCcui907', 'dialogHeight:300px;dialogWidth:620px;status:no; help:no;');	
    
    if( rtnValue != null ) {
    	if( rtnValue == "Y" ){  		
    		return true;
    	}
    	else {
    		if( form.USR_GB.value != '5' && form.USR_GB.value != '6' ) {
	    		//parent.top.location.href = "/kt07/customer/ProductApplyChange.jsp?&sSearchPageCode=10_00_00_00_00&menuNum=2&subNum=&tabNum=&page_code=00_10_00_00_00&sProductCode=&sProductType=1&sComparisonYn=N";
	    	}
    		return false;
    	}
    }

	if( form.USR_GB.value != '5' && form.USR_GB.value != '6' ) {
		//parent.top.location.href = "/kt07/customer/ProductApplyChange.jsp?&sSearchPageCode=10_00_00_00_00&menuNum=2&subNum=&tabNum=&page_code=00_10_00_00_00&sProductCode=&sProductType=1&sComparisonYn=N";
	}
    return false;
    //////////////////////////////////////////
        	
}  

///////////////////////////
//// [4738] �系������ ���� Self��û ���¿� ���� �Ǹ���(������) ���� �Է±�� ����) 2008-03-10 ���� 8:22:56 �ڹ���
function checkCyberAgentNo(){
    var mf = document.mainForm;
    // ������ȣ üũ
    var INPUT_AGENT_EMP_NO = mf.INPUT_AGENT_EMP_NO.value;
    var CHECK_AGENT_EMP_NO = mf.CHECK_AGENT_EMP_NO.value;
    
    if( INPUT_AGENT_EMP_NO == ""){ // �Է¾��ص� ���� ���� 
        return true;   
    }
    
    
    if( !isInteger(INPUT_AGENT_EMP_NO , "")){
        alert("������ ������ ���ڸ� �Է°����մϴ�");
        mf.INPUT_AGENT_EMP_NO.focus();
        return false;
    }
    
    if(isLength(INPUT_AGENT_EMP_NO) != 9 ){
        alert("�ùٸ� ������ ������ �Է��� �ּ���.");
        mf.INPUT_AGENT_EMP_NO.focus();
        return false;
    }
    
    if( CHECK_AGENT_EMP_NO != INPUT_AGENT_EMP_NO ){
        alert("������ ������ư�� Ŭ���ؼ� ������ �ּ���.");
        mf.BTN_AGENT_EMP_NO.focus();
        return false;
    }
    
    return true;
}
//// [4738] �系������ ���� Self��û ���¿� ���� �Ǹ���(������) ���� �Է±�� ����) 2008-03-10 ���� 8:22:56 �ڹ���
///////////////////////////



/******************************************************************************
* ��ȭ���� DB �۾����� ���� �۾� ���� ���� 2006-09-21 7:08����
******************************************************************************/
function PhoneDbTimeChk(){

    var vPHONEDBTIMECHK = "";
    var vPHONEDBTIMETXT = "";
    var vSaCd           = "";
    try
    {
        vPHONEDBTIMECHK = document.mainForm.PHONEDBTIMECHK.value;
        vPHONEDBTIMETXT = document.mainForm.PHONEDBTIMETXT.value;
//        alert(vPHONEDBTIMECHK+', '+vPHONEDBTIMETXT);
    } catch (e) { alert(e) }


    if( vPHONEDBTIMECHK != "" ) {
        openMsgDiag(vPHONEDBTIMETXT);

        if( document.mainForm.USR_GB.value == "5" || document.mainForm.USR_GB.value == "6" ){
            rtnUrl= "/pa/jsp/pa000m.jsp?USR_GB=" + document.mainForm.USR_GB.value;
            location.href= rtnUrl;
            return;
        }else{
            rtnUrl = document.mainForm.SUCC_URL.value
                    + "?mn="     + document.mainForm.mn.value
                    + "&scode="  + document.mainForm.scode.value
                    + "&sname="  + document.mainForm.sname.value;
            var vPAGE_CODE = "";
            try{
                vPAGE_CODE = document.mainForm.page_code.value;
            }catch(E){}


            //rtnUrl = form.SUCC_URL.value + "?mn=" + form.mn.value + "&scode=" + form.scode.value + "&sname=" + form.sname.value;
            rtnUrl = "/kt07/comm/go_page.jsp" + "?page_code=" + vPAGE_CODE;

            location.href= rtnUrl;
            return;

        }
    }
}


//////////////////////////////////////////////
// �귻�� ����Ʈ�� SO iframe������� ����
var MSG_PAGELOADED          = 0x0001; // ������ �ε��Ϸ�
var MSG_SESSIONEXPIRED      = 0x0010; // �α����� �ʿ��� ���������� �α����� �ȵȰ��
var MSG_MOBILECERTNEED      = 0x0020; // ���������(�Ǵ� ���������)�� �ʿ��� ���������� ����������� �ȵȰ��
var MSG_PUBLICCERTNEED      = 0x0030; // ���������ʿ��� ���������� ���������� �ȵȰ��
var MSG_ORDSAVESUCCESS      = 0x0500; // �� ��ǰ��û ������ ������ ���
var MSG_ORDSAVEFAIL         = 0x0550; // �� ��ǰ��û ������ ������ ��� �̶��� Error_msg_cd , Error_msg_text �� ä������.

function setParentMsgKT100( event_messsge , URLid , Error_msg_cd , Error_msg_text){
    try{
        parent.setParentMsgKT100( event_messsge , URLid , Error_msg_cd , Error_msg_text);
    }catch(E){
    }
}
// �귻�� ����Ʈ�� SO iframe������� ����
////////////////////////////////////////////////

//------------------------------------------------------------------------------
// MOUSE DRAG DISABLED 2007-03-20 6:49���� �����
//------------------------------------------------------------------------------
var omitformtags=["input", "textarea", "select"]
omitformtags=omitformtags.join("|")

function disableselect(e){
    if (omitformtags.indexOf(e.target.tagName.toLowerCase())==-1)
    return false
}

function reEnable(){
    return true
}

if (typeof document.onselectstart!="undefined")
    document.onselectstart=new Function ("return false")
else{
    document.onmousedown=disableselect
    document.onmouseup=reEnable
}
//------------------------------------------------------------------------------
// MOUSE RIGHT BUTTON CLICK DISABLED 2007-03-20 6:49���� �����
//------------------------------------------------------------------------------
// function right(e) {

//	if (navigator.appName == 'Netscape' && (e.which == 3 || e.which == 2))
//    	return false;
//	else if (navigator.appName == 'Microsoft Internet Explorer' && (event.button == 2 || event.button == 3)) {
 //   	alert("���콺�� ������ ��ư�� ����ϽǼ� �����ϴ�.");
//    	return false;
//	}
//	return true;
//}

//document.onmousedown=right;
//if (document.layers) window.captureEvents(Event.MOUSEDOWN);
//window.onmousedown=right;
//------------------------------------------------------------------------------

////////////////////////////////////////////
// �� ���� Script ��... �� //
///////////////////////////////////////////

-->
