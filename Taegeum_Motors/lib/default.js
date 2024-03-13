
// 문자열 길이 검사
function isLength(varCk) {
    var varLen = 0;
    var agr = navigator.userAgent;

    for (i=0; i<varCk.length; i++) {
        ch = varCk.charAt(i);
        if ((ch == "\n") || ((ch >= "ㅏ") && (ch <= "히")) || ((ch >="ㄱ") && (ch <="ㅎ")))
            varLen += 2;
        else
            varLen += 1;
    }
    return (varLen);
}


// 입력 문자열 검사 (숫자/특수문자)
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
            if (!chk)   break;  // 숫자+특수문자외의 문자가 있는 경우만 error 종료 2002.04.08
        }
    }
    return chk;
}



// 주민등록번호 검사
function isRegNo(varCk1,varCk2) {
    if ( (isLength(varCk1)==6) && (isLength(varCk2)==7) ) {

        //-----------------------------------------------------------------------------
        // 요청번호  :  [3036] 가상주민번호 적용
        // 요청자   : 김미경
        // 수정자   : 이재용
        // 수정일   : 2007-03-13 5:10오후
        // 수정내용 : 가상주민번호일 경우 주민번호 체크로직 패스
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
                alert ("정확한 주민번호를 입력하세요.");
                return false;
            } else {
                return true;
            }
        } else {
            alert("정확한 주민번호를 입력하세요.");
            return false;
        }
    } else {
        alert("정확한 주민번호를 입력하세요.");
        return false;
    }
}

// 사업자 등록번호 검사
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
                alert ("잘못된 사업자등록번호입니다. 다시 확인해 주십시오");
                return false;
            } else {
                return true;
            }
        } else {
            alert("사업자등록번호는 숫자이어야 합니다.");
            return false;
        }
    } else {
        alert("사업자등록번호의 자릿수가 잘못 입력되었습니다.");
        return false;
    }
}



// 사업자 등록번호 검사
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
                alert ("잘못된 사업자등록번호입니다. 다시 확인해 주십시오");
                return false;
            } else {
                return true;
            }
        } else {
            alert("사업자등록번호는 숫자이어야 합니다.");
            return false;
        }
    } else {
        alert("사업자등록번호의 자릿수가 잘못 입력되었습니다.");
        return false;
    }
}
