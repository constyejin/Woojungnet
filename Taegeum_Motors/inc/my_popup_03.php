<?php

	$dir = $_SERVER['DOCUMENT_ROOT'];
	include "$_SERVER[DOCUMENT_ROOT]/lib/common.php";

if($loginId){  //로그인했을때만


	include $dir.'/lib/basicdb.class.php';
	include $dir.'/lib/scriptAlert.class.php';
	$script = new scriptAlert();
	$db		= new basicdb();
	$connect = dbconn();

	$wc_idx = $_REQUEST['wc_idx'];



if(!$wc_idx)
{
	$script->alert("잘못된 정보입니다");
	exit;
      
}


// 낙찰 정산서 회원 보이기
if($wc_idx && $wc_go_idx){
	$usql = "update woojung_car_go set wcg_view2 ='Y' where    wc_go_idx ='$wc_go_idx' and wcg_wcidx='$wc_idx'  ";
	
	$result = mysql_query($usql, $connect) or die(mysql_error());
	if(!$result){
		msg("수정시 오류가 발생했습니다. 잠시후 다시 시도해주세요!");
		exit;
	}else{
		$script->alert("낙찰 정산서가 노출 되었습니다.");
		exit;
	}
}



	// 출품자 정보를 불러온다.
	$Qry = "SELECT a.*, 
				b.team_code, b.team_name, b.team_subname, b.team_subname_etc ,
				b.company_tel, b.tel, b.pcs, b.fax, b.company_name, 
				b.company_sort, b.company_subsort , b.usort , c.* , d.bid_sort_date 
			FROM woojung_car as a 
				left join woojung_member as b  on a.wc_mem_idx = b.idx 
				left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx					
				left join woojung_bid as d on a.wc_idx = d.auct_key					
			WHERE a.wc_idx = '$wc_idx' ";

	$row = Row_string($Qry);

	$Qry2 = "SELECT * 
			FROM  woojung_bid 			
			WHERE auct_key = '$wc_idx' and bid_sort='Y' ";
	$row2 = Row_string($Qry2);

	// 제휴 회원이라면
	if( substr($row['usort'], 0, 3) == "com" ){
		$companyNm = $row[team_name];
		$companysubNm = $row[team_subname];
		$wc_mem_etc = $row[wc_mem_etc];	
		$companyInfo = $companyNm ." / ".$companysubNm;
	}else{ // 일반출품 or 구매회원
		$companyInfo = "";
		$wc_mem_etc = $row[wc_mem_etc];		
	}

	//낙찰자 구해오기
	$sql_bid=mysql_query("select * from woojung_bid where bid_sort='Y' and auct_key = '$wc_idx'");
//	echo "select * from woojung_bid where bid_sort='Y' and auct_key = '$wc_idx'";
	$bid=mysql_fetch_array($sql_bid);
//	echo $bid[userId];
    $sale_type = $bid[sale_type];
	if($bid[userId]){
		//낙찰자 회원정보 구해오기
		$bid_mem=mysql_fetch_array(mysql_query("select * from woojung_member where userId='".$bid[userId]."'"));
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>낙찰정산서</title>
<link rel='stylesheet' href='/common/css/adm_style.css' type='text/css'> 
<link rel='stylesheet' href='/common/css/admin_style.css' type='text/css'>

<style type="text/css">
<!--
.style1 {font-size: 24px}
-->
</style>
<SCRIPT LANGUAGE="JavaScript">
<!--

function dataintComma(objext) {
  
    	formnum = objext.value;
    	num1 = formnum.length;        
	
        FirstNum = formnum.substr(0,1);
        FirstNum2 = formnum.substr(1,num1);
   
        if(FirstNum == "0"){
                alert("입력숫자는 0 으로 시작할 수 없습니다.");
        objext.value  = FirstNum2;
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
	        }
	        else {
	        var comma = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
	        var data = fieldnum.split('.');
	        data[0] += '.';
	           do {
	             data[0] = data[0].replace(comma, '$1,$2');
	            } while (comma.test(data[0]));
	
	           if (data.length > 1) {
	           objext.value = data.join('');
	           }
	           else {
	           objext.value =  data[0].split('.')[0];
	                }
	        }
	      
	        var temp = parseInt(rs(outForm.cunserting_amt.value))+parseInt(rs(outForm.auction_amt_fee.value))+parseInt(rs(outForm.etc_amt.value));
	        document.all.sub_tot1.value = addComma(temp);
	        
	        var temp2 = parseInt(rs(outForm.sub_traction_amt.value))+parseInt(rs(outForm.sub_keeped_amt.value))+parseInt(rs(outForm.sub_otherwise_amt.value));
	        document.all.sub_tot2.value = addComma(temp2);
	        
	        var temp3 = parseInt(temp) + parseInt(temp2);
	        document.all.sub_tot3.value = addComma(temp3);
	        
	        
	        var temp4 = parseInt(Number(<?=$bid[bid_price]?>)) - parseInt(Number(temp3));
	        document.all.sub_tot4.value = addComma(temp4);
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

function auction_submit(f){
	
	if(confirm("출품 정산서를 회원에게 노출 하시겠습니까? \n\n노출후 비노출로 변경하실 수 없습니다.")){
		f.submit();
	}
	
}

function pprint(){
		window.print();
}
function nak_ok(){
	if(confirm("발급하시겠습니까?")){
		document.nakform.submit();
	}
}
//-->
</SCRIPT>
</head>

<body>

<iframe name="HiddenFrm" style="display:none;"></iframe>
<form name="nakform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="nak_ok.php">
<input type="hidden" name="wc_idx" value="<?=$wc_idx?>">
</form>


<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
	
	
<form name="outForm" method="post" action="<?=$PHP_SELF?>"  onsubmit="return auction_submit(this)">
		<input type="hidden" name="wc_idx" value="<?=$row[wcg_wcidx]?>">
		<input type="hidden" name="wc_go_idx" value="<?=$row[wc_go_idx]?>">


  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="30" align="right" valign="top"><a href="javascript:window.print()" >인쇄하기</a> / 
			<a href="javascript:self.close();">창닫기</a></td>
        </tr>
        <tr> 
          <td height="20" align="center" valign="top" ><span class="style1"><strong>낙 찰 정 산 서</strong></span><span style="font-size:18px;">(<?=WriteArrHTML('select', 'Sale', $ArrgoSale, $sale_type, '', '' , 'direct', '' );?>)</span></td>
        </tr>
        <tr>
          <td height="3" bgcolor="#666666"></td>
        </tr>
        <tr>
          <td height="10" align="center" valign="top" class="style5 style1">&nbsp;</td>
        </tr>
        <tr> 
          <td height="20" align="left" style="padding-left:5px;"><span class="style7"><strong>* 
            차량정보</strong></span></td>
        </tr>
        <tr> 
          <td align="left" valign="top"> <table width="600" border="0" cellpadding="0" cellspacing="1" bgcolor="#cccccc">

              <tr> 
                <td width="100" height="25" align="center" bgcolor="#f6f6f6">차량번호</td>
                <td width="200" height="25" bgcolor="#ffffff" style="padding-left:3px;">&nbsp; 
                   <?=$row[wc_no]?>                </td>
                <td width="100" height="25" align="center" valign="middle" bgcolor="#f6f6f6">모 
                  델 명</td>
                <td width="200" height="25" bgcolor="#ffffff" style="padding-left:3px;">&nbsp; 
                 <?=$row[wc_model]?>  <?=$row[wc_model2]?$row[wc_model2]:""?></td>
              </tr>

              <tr> 
                <td width="100" height="25" align="center" bgcolor="#f6f6f6">차대번호</td>
                <td width="200" height="25" bgcolor="#ffffff" style="padding-left:3px;">&nbsp; 
                   <?=$row[wc_prog_area_price]?>                </td>
                <td width="100" height="25" align="center" valign="middle" bgcolor="#f6f6f6">전손/분손</td>
                <td width="200" height="25" bgcolor="#ffffff" style="padding-left:3px;">&nbsp; 
                 <?=$row[evalAmt_type]?></td>
              </tr>
		   
              <tr bgcolor="b2b2b2">
                <td height="25" align="center" bgcolor="f6f6f6">발생비용</td>
                <td colspan="3" bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=number($row[wc_go_cost])?>
                  원</td>
              </tr>
              <tr bgcolor="b2b2b2">
                <td height="25" align="center" bgcolor="f6f6f6">보관장소</td>
                <td width="183" bgcolor="#FFFFFF" style="padding:3 0 0 10"><?

		//== /lib/code.php 안에 있음
		WriteArrHTML('select', 'area1', $ArrcarPlace , $row[wc_keep_area1], '', '' , 'direct', '' );
?>                </td>
                <td width="97" align="center" bgcolor="f6f6f6">보관장소상세</td>
                <td width="205" bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$row[wc_keep_place1]?>                </td>
              </tr>
              <tr bgcolor="b2b2b2">
                <td height="25" align="center" bgcolor="f6f6f6">전화번호</td>
                <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$row[wc_keep_tel1]?>                </td>
                <td align="center" bgcolor="f6f6f6">담 당 자</td>
                <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$row[wc_keep_name1]?>                </td>
              </tr>
              
            </table></td>
        </tr>
        <tr>
          <td height="10" ></td>
        </tr>
        <tr> 
          <td height="20" align="left" style="padding-left:5px;"><span class="style7"><strong>* 
            낙찰자정보</strong></span></td>
        </tr>
        <tr> 
          <td align="left" valign="top"> <table width="600" border="0" cellpadding="0" cellspacing="1" bgcolor="#cccccc">
              <tr> 
                <td width="100" height="25" align="center" bgcolor="#f6f6f6">낙 찰 자 </td>
                <td height="25" bgcolor="#ffffff" style="padding-left:3px;">&nbsp;<?=$bid_mem[name]?></td>
                <td width="100" height="25" align="center" bgcolor="#f6f6f6">낙찰일자</td>
                <td width="200" height="25" bgcolor="#ffffff" style="padding-left:3px;">&nbsp;<?=substr($row2[bid_sort_date],0,10)?></td>
              </tr>
              <tr> 
                <td height="25" align="center" bgcolor="#f6f6f6">회 
                  사 명</td>
                <td height="25" colspan="3" bgcolor="#ffffff" style="padding-left:3px;">&nbsp;<?=$bid_mem[company_name]?>&nbsp;</td>
              </tr>
              <tr> 
                <td height="25" align="center" bgcolor="#f6f6f6">일반전화</td>
                <td width="200" height="25" bgcolor="#ffffff" style="padding-left:3px;">&nbsp;<?=$bid_mem[tel]?></td>
                <td width="100" height="25" align="center" bgcolor="#f6f6f6">휴대전화</td>
                <td width="200" height="25" bgcolor="#ffffff" style="padding-left:3px;">&nbsp;<?=$bid_mem[pcs]?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="10" ></td>
        </tr>
        <tr> 
          <td height="20" align="left">
		  <table width="100%">
		  <tr>
			<td width="50%"><span class="style7" style="padding-left:5px;"><strong>* 
            정산금액</strong></span></td>
			<td width="50%" align="right"><?=WriteArrHTML('select', 'Sale', $ArrgoSale, $sale_type, '', '' , 'direct', '' );?></td>
		  </tr>
		  </table>
		  </td>
        </tr>
        <tr> 
          <td align="left" valign="top">
              <table width="600" border="0" cellpadding="0" cellspacing="1" bgcolor="#cccccc">
              <tr> 
                <td colspan="2" height="25" align="center" bgcolor="#f6f6f6">낙찰금액 A</td>
                <td width="168" height="25" align="right" bgcolor="#ffffff" style="padding-right:3px;"> <strong> 
                <?=number($row[wc_accepted_priceA])?>  원 </strong></td>
              </tr>
              <tr> 
                <td width="165" height="25" align="center" bgcolor="#ffffff" style="padding-left:3px;">부가세</td>
                <td width="168" height="25" align="right" valign="middle" bgcolor="#ffffff" style="padding-right:3px;"><?=number($row[wc_accepted_priceB])?> 원</td>
                <td width="168" rowspan="6" bgcolor="#FFFFFF"></td>
              </tr>
              <tr> 
                <td height="25" align="center" bgcolor="#ffffff" style="padding-left:3px;">수수료</td>
                <td height="25" align="right" valign="middle" bgcolor="#ffffff" style="padding-right:3px;"><?=number($row[wc_accepted_priceC])?> 원</td>
              </tr>
              <tr> 
                <td height="25" align="center" bgcolor="#ffffff" style="padding-left:3px;">대지급금</td>
                <td height="25" align="right" valign="middle" bgcolor="#ffffff" style="padding-right:3px;"><?=number($row[wc_accepted_priceD])?> 원</td>
                </tr>
              <tr> 
                <td height="25" align="center" bgcolor="#ffffff" style="padding-left:3px;">상사이전비</td>
                <td height="25" align="right" valign="middle" bgcolor="#ffffff" style="padding-right:3px;"><?=number($row[wc_accepted_priceE])?> 원</td>
                </tr>
			  <tr> 
                <td height="25" align="center" bgcolor="#ffffff" style="padding-left:3px;">서류대행비</td>
                <td height="12" align="right" valign="middle" bgcolor="#ffffff" style="padding-right:3px;"><?=number($row[wc_accepted_priceF])?> 원</td>
              </tr>
              <tr>
                <td height="25" align="center" bgcolor="#ffffff" style="padding-left:3px;">기타비용</td>
                <td height="12" align="right" valign="middle" bgcolor="#ffffff" style="padding-right:3px;"><?=number($row[wc_accepted_priceG])?> 원</td>
              </tr>
              <tr> 
                <td height="25" colspan="2" align="center" valign="middle" bgcolor="#f6f6f6"" style="padding-right:3px;">비용소계 B</td>
                <td bgcolor="#ffffff" align="right"><span style="padding-right:3px;"><strong>
                <?=number( $row[wc_accepted_priceB] + $row[wc_accepted_priceC] + $row[wc_accepted_priceD] + $row[wc_accepted_priceE] + $row[wc_accepted_priceF] + $row[wc_accepted_priceG] )?> 원</strong></span></td>
              </tr>

              <tr> 
                <td height="25" colspan="2" align="center" bgcolor="#f6f6f6">정산합계 (A+B)</td>
                <td height="25" align="right" valign="middle" bgcolor="#ffffff"  style="padding-right:3px;"><strong> 
                 <?=number( $row[wc_accepted_priceA] + $row[wc_accepted_priceB] + $row[wc_accepted_priceC]+ $row[wc_accepted_priceD] + $row[wc_accepted_priceE] + $row[wc_accepted_priceF] + $row[wc_accepted_priceG] )?> 원</strong></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="10" ></td>
        </tr>
        
        <tr>
          <td height="20" align="left" style="padding-left:5px;"><span class="style7"><strong>* 
            입금계좌안내</strong></span></td>
        </tr>
                  <?$data=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));?>
        <tr>
          <td align="left" valign="top"><table width="600" border="0" cellpadding="0" cellspacing="1" bgcolor="#cccccc">
              <tr bgcolor="b2b2b2">
                <td width="100" height="25" align="center" bgcolor="f6f6f6">계좌번호</td>
                <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$data[bankno]?></td>
              </tr>

            </table></td>
        </tr>
        
        
        <tr> 
          <td height="100" align="center"> <p><span style="padding-right:10px;">위와 
              귀사(하)에서 의뢰하신 차량에 대한 정산서를 제출합니다<br />
              <br />
              <?=date("Y")?>
              년 
              <?=date("m")?>
              월 
              <?=date("d")?>
              일
              <br />
 <?if($row[wcg_view2] == "N"){?>

              <br >
 <?}?>
              </span></p></td>
        </tr>
        <tr> 
          <td align="center" valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="1" bgcolor="#000000"></td>
              </tr>
              <tr> 
                <td height="100"><table width="600" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="100" height="25" align="right" valign="middle">업체명 :</td>
                    <td width="415" height="25" align="left" valign="middle" style="padding-left:10px;"><?=$data[shop_cname]?></td>
                    <td width="89" rowspan="6"><img src="/images/sub/dojang.gif" style="width:90px;"></td>
                  </tr>
                  <!--tr>
                <td height="25" align="right" valign="middle">대표자 :</td>
                <td width="415" height="25" align="left" valign="middle" style="padding-left:10px;"><?=$data[owner_name]?></td>
              </tr-->
                  <tr>
                    <td height="25" align="right" valign="middle">사업자번호 :</td>
                    <td width="415" height="25" align="left" valign="middle" style="padding-left:10px;"><?=$data[office_num]?></td>
                  </tr>
                  <tr>
                    <td height="25" align="right" valign="middle">전화번호 :</td>
                    <td width="415" height="25" align="left" valign="middle" style="padding-left:10px;"><?=$data[com_num]?></td>
                  </tr>
                  <tr>
                    <td height="25" align="right" valign="middle">팩스번호 :</td>
                    <td width="415" height="25" align="left" valign="middle" style="padding-left:10px;"><?=$data[fax_num]?></td>
                  </tr>
                  <tr>
                    <td height="25" align="right" valign="middle">주소 :</td>
                    <td width="415" height="25" align="left" valign="middle" style="padding-left:10px;"><?=$data[address]?></td>
                  </tr>
                </table></td>
              </tr>
              <tr> 
                <td height="1" bgcolor="#000000"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  </form>
</table>
</body>
</html>
<?
	}  //로그인
?>