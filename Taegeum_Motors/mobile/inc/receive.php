<? 
include $_SERVER['DOCUMENT_ROOT']."/lib/session.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/global.php';

$auct_idx = $_GET[auct_idx];
$mode = $_GET[mode];



	// 출품자 정보를 불러온다.
	$Qry = "SELECT a.*, 
				b.team_code, b.team_name, b.team_subname, b.team_subname_etc ,
				b.company_tel, b.tel, b.pcs, b.fax, b.company_name, 
				b.company_sort, b.company_subsort , b.usort , c.*
			FROM woojung_car as a 
				left join woojung_member as b  on a.wc_mem_idx = b.idx 
				left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx					
			WHERE a.wc_idx = '$wc_idx' ";

	$row = Row_string($Qry);
	
	

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




?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>접수증</title>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.receive-table{
  width:100%;
}
.receive-table td, .receive-table th{
  font-size: 12px;
}
table{
 width:100%; 
}
</style>

<script type="text/javascript">


	function pprint(){
		window.print();
	}

</script>
</head>

<body> 
<table border="0" cellspacing="0" cellpadding="0" class="receive-table">
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0"><tr>
          <td height="30" align="right" valign="top"><a href="javascript:window.print()" >인쇄하기</a> / <a href="javascript:self.close();">창닫기</a></td>
      </tr>
      <tr>
        <td height="20" align="center" valign="top"><span class="style1 style2 style5">접 수 증</span></td>
      </tr>
        <tr>
          <td height="3" bgcolor="#666666"></td>
        </tr>
        <tr>
          <td height="25" ></td>
        </tr>
      <tr>
        <td height="18" align="left" valign="top" style="padding-left:5px;"><span class="style7">* 기본정보</span></td>
      </tr>
      <tr>
        <td height="80" align="left" valign="top"><table border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="100" height="25" align="center" bgcolor="#f6f6f6"><span class="style8">접수번호</span></td>
            <td width="200" height="25" bgcolor="#FFFFFF">&nbsp;<?=$row[wc_orderno]?></td>
            <td width="100" height="25" align="center" bgcolor="#f6f6f6" class="style8">접수일자</td>
            <td width="200" height="25" bgcolor="#FFFFFF">&nbsp;<?=$row[wc_regdate]?></td>
          </tr>
         <tr>
            <td width="100" height="25" align="center" bgcolor="#f6f6f6"><span class="style8">차량번호</span></td>
            <td width="200" height="25" bgcolor="#FFFFFF">&nbsp;<?=$row[wc_no]?></td>
            <td width="100" height="25" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style8">모 델 명</span></td>
            <td width="200" height="25" bgcolor="#FFFFFF">&nbsp;<?=$row[wc_model]?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="18" align="left" valign="top" style="padding-left:5px;"><span class="style7">* 출품자정보</span></td>
      </tr>
      <tr>
        <td height="100" align="left" valign="top"><table border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="100" height="25" align="center" bgcolor="#f6f6f6"><span class="style8">신 청 자</span></td>
            <td height="25" colspan="3" bgcolor="#FFFFFF">&nbsp;<?=$row[wc_mem_name]?></td>
            </tr>
          <tr>
                <td width="100" height="25" align="center" bgcolor="#f6f6f6"><span class="style8">업 
                  체 명</span></td>
            <td width="200" height="25" bgcolor="#FFFFFF">&nbsp;<?=$companyNm?></td>
                <td width="100" height="25" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style8">팀 
                  명</span></td>
            <td width="200" height="25" bgcolor="#FFFFFF">&nbsp;<?=$companysubNm?></td>
          </tr>
           <tr>
                <td width="100" height="25" align="center" bgcolor="#f6f6f6"><span class="style8">전화번호</span></td>
            <td height="25" bgcolor="#FFFFFF">&nbsp;<?=$row[tel]?></td>
                <td width="100" height="25" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style8">휴대번호</span></td>
            <td height="25" bgcolor="#FFFFFF">&nbsp;<?=$row[pcs]?></td>
          </tr>

        </table></td>
      </tr>
      <tr>
        <td height="80" align="left" valign="top" style="padding-left:10px;">* 고객님께서 접수하신 내용은 경매서비스를 이용하기 위한 기본정보이며 안전하게 관리됩니다.<br />
          * 상기 사항의 정보가 실물과 다를 경우 신청자에게 책임이 있습니다.<br />
          * 위와 같이 경매서비스에 신청 접수 되었습니다.</td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="1" bgcolor="#000000"></td>
          </tr>
          <tr>
            <td height="100"><table border="0" cellspacing="0" cellpadding="0">
              <?$data=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));?>
              <tr>
                <td width="100" height="25" align="right" valign="middle"><span class="style8">업체명 :</span></td>
                <td width="415" height="25" align="left" valign="middle" style="padding-left:10px;"><?=$data[shop_cname]?></td>
                <td width="89" rowspan="6"><img src="http://www.incaron.co.kr/images/sub/dojang.gif" style="width:90px;" /></td>
              </tr>
              <!--tr>
                <td height="25" align="right" valign="middle"><span class="style8">대표자 :</span></td>
                <td width="415" height="25" align="left" valign="middle" style="padding-left:10px;"><?=$data[owner_name]?></td>
              </tr-->
              <tr>
                <td height="25" align="right" valign="middle"><span class="style8">사업자번호 :</span></td>
                <td width="415" height="25" align="left" valign="middle" style="padding-left:10px;"><?=$data[office_num]?></td>
              </tr>
              <tr>
                <td height="25" align="right" valign="middle"><span class="style8">전화번호 :</span></td>
                <td width="415" height="25" align="left" valign="middle" style="padding-left:10px;"><?=$data[com_num]?></td>
              </tr>
              <tr>
                <td height="25" align="right" valign="middle"><span class="style8">팩스번호 :</span></td>
                <td width="415" height="25" align="left" valign="middle" style="padding-left:10px;"><?=$data[fax_num]?></td>
              </tr>
              <tr>
                <td height="25" align="right" valign="middle"><span class="style8">주소 :</span></td>
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
</table>
</body>
</html>
