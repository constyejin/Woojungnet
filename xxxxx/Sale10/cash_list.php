<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
	$pno=4;
?>
<style type="text/css">
.pageTitleBold{
	font-weight: bold;
	font-size: 13px;
}
.btn-blue {
  cursor: pointer;
background-color: #e7f1f9;
color: #084573;
border: #636563 1px solid;
}
.btn-pink {
  cursor: pointer;
background-color: #fae3e3;
color: #ff0000;
border: #ff0000 1px solid;
}
.ui-datepicker-trigger{
    position:relative;
    top:3px;
}

</style>
<script type="text/javascript">
<?
	$view_article = 15; // ��ȭ�鿡 ��Ÿ�� �Խù��� �� ����  
	if (!$page) $page = 1; // ���� ������ �������� �ʾ��� ��� 1�� ����  
	$start = ($page-1)*$view_article; 
	 
//pay nopay scharge sstoketype state Search_text
	$href = "&caridxe=$caridx&search=$search&Search_text=$Search_text&admidx=$admidx ";
	$where = " admcom_idx=$admidx ";
	
	// �˻� �ܾ �Է�������   
	if($Search_text){  	
			$tmp1 = "company";$tmp2 = "bname";
			$where .= " and ( ($tmp1 like '%$Search_text%') or ($tmp2 like '%$Search_text%')) ";
	}  
	$where .= " ORDER BY regdate desc";
	$query = "select count(*) from cardata1 as a join cardata2 as b on a.idx=b.cardata_idx where $where ";  
	//echo $query;
	$result = mysql_query($query, $connect);  
	$temp = mysql_fetch_row($result);  
	$total_article = $temp[0]; // ���� ������ �Խù��� �� ������ ����
?>


<script language='javascript' src='../inc/Object.js'></script>
<script language="JavaScript" src="/inc/default.js"></script>
<link rel="stylesheet" href="/css/admin.css" type="text/css">
<link rel="stylesheet" href="/css/style.css" type="text/css">
<title>결제하게</title>

<script type="text/javascript">

</script>

                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="12%" height="42"><img src="/manage/img/icon02.gif"> 위치 : <span class="pageTitleBold"> 결제하기 </span>  </td>
                  </tr>
                </table>
                </td>
                </tr>
                <tr><td>
                  
        
                      </td></tr>
                <tr>
                  <td>
<form name="cform" method="post" target="HiddenFrm" style="margin:0px;">
<input type="hidden" value="allpay" name="mode">
<input type="hidden" value="href" name="<?=$href?>">

                <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#626262" frame="border or box " style="border-collapse:collapse;" class='pad_10 list-table-standard'>
                                          <tr height="30">
                                            <td width="5%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">NO</td>
                                            <td width="9%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">등록일</td>
                                            <td width="11%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">차량명</td>
                                            <td width="11%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">차량번호</td>
                                            <td width="11%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">년식</td>
                                            <td width="7%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">연료</td>
                                            <td width="10%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">거래처</td>
                                            <td width="10%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">지급내역</td>
                                            <td width="14%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">미결금액</td>
                                            <td width="3%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">
                                              <input type="checkbox" name="allchk" id="allcheck" onClick="chkall2()" />
                                              </td>
                                          </tr>
                        
                     
                                      <tr height="30" onblur="this.style.backgroundColor='#deecee'" onfocus="this.style.backgroundColor='#FFF'" onMouseOver="this.style.backgroundColor='#deecee'" onMouseOut="this.style.backgroundColor='#FFF'" style="cursor:hand">
                                            <td width="5%" align="center">1</td>
                                            <td width="9%" align="center" >2024-02-99</td>
                                            <td width="11%" align="center" >아이오닉</td>
                                            <td width="11%" align="center" >99마9999</td>
                                            <td width="11%" align="center" >2023-04</td>
                                            <td width="7%" align="center" >전기</td>
                                            <td width="10%" align="center" >전기차2(9999)</td>
                                            <td width="10%" align="center" >차대비</td>
                                            <td width="14%" align="center"><font color="#0033FF">100,000</font></td>
                                            <td width="3%" align="center"><input type="checkbox" onClick="paycheck();" ><input type="hidden" name="callpay[]" value="<?=($data2[paydiv]==1)?$data2[callpay]:0?>"></td>
                                          </tr>

                                      <tr height="30"  onblur="this.style.backgroundColor='#deecee'" onfocus="this.style.backgroundColor='#FFF'" onMouseOver="this.style.backgroundColor='#deecee'" onMouseOut="this.style.backgroundColor='#FFF'" style="cursor:hand">
                                            <td width="5%" align="center">2</td>
                                            <td width="9%" align="center" >2024-02-99</td>
                                            <td width="11%" align="center" >투싼</td>
                                            <td width="11%" align="center" >99마1234</td>
                                            <td width="11%" align="center" >2023-03</td>
                                            <td width="7%" align="center" >디젤</td>
                                            <td width="10%" align="center" >디젤(1999)</td>
                                            <td width="10%" align="center" >차대비</td>
                                            <td width="14%" align="center"><font color="#0033FF">200,000</font></td>
                                            <td width="3%" align="center"><input type="checkbox" onClick="paycheck();" ><input type="hidden" name="callpay[]" value="<?=($data2[paydiv]==1)?$data2[callpay]:0?>"></td>
                                          </tr>

                    </form>

                                          <tr height="30" >
                                            <td colspan="2" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">입금계좌</td>
                                            <td colspan="5" align="center" class="p_tt">은행명 / 계좌번호 / 예금주</td>
                                            <td align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">합계</td>
                                            <td align="center"><font color="#3399FF"><b><?=number_format($totalsumpay)?></b></font></td>
                                            <td align="center">&nbsp;</td>
                    </tr>
                  </table></td>
                  </tr>
                  <tr><td>
                  
                <table width="100%" height="106" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                <td height="49" align="center">
                <input type="button" id="button" value="목록보기" class='btn-blue' style='width:80px;cursor:hand' onclick='location.href="/manage/Sale10/Sale_list7.php"'> &nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td height="25" valign="top">
                                      <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#626262" frame="border or box " class='pad_10' style="border-collapse:collapse; border-color:rgb(194, 194, 194);" align="center">
                                       <tr height="30">
                                         <td colspan="6" align="center" bgcolor="#FF9999" class="p_tt">선택한 금액을 결제하시겠습니까? 다시 한번 확인하여 주십시요</td>
                                        </tr>
                                        <tr height="30">
                                         <td class="p_tt" width="16%" style="padding-left:10px">아오닉(99마9999)</td>
                                         <td class="p_tt" width="24%" style="padding-left:10px">은행명 / 계좌번호 / 예금주</td>
                                         <td class="p_tt" width="10%" align="center">
                                         <input type="text" style="position:relative; top:-5px"  >
                                         <img class="ui-datepicker-trigger" src="/images/icon_data.gif" alt="선택" title="선택">      
                                         </td>
                                          </td>
                                         <td align="center" width="14%"><font color="#CC0000"><b><span id="totalprice">100,000</span></b></font></td>
                                         <td align="center" width="16%">
                                         <select name="account" >
                                          <option value="">
                                          ::결제통장::
                                          </optopn>
                                          <option value="">
                                          우리은행 ㅣ 12534-5678-90500
                                          </optopn>
                                          </select>
                                            </td>
                                         <td align="center" width="8%"><input type="button" class="btn-pink"value="결제하기" onClick="pay_list();"></td>
                                       </tr>
                                      </table>

                                      
                                      </td>
                                    </tr>
                  </table>
                      </td></tr>
                  </table>
                </td>
              </tr>
           
            </table>
		</td>
	</tr>
	<tr>
		<td height='100%'>
	
		</td>
	</tr>
</table>

</body>
</html>