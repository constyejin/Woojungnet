<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
?>
<?
$pno=5;
$time_start = array_sum(explode(' ', microtime()));

if($_SESSION[loginLevel] > 1){
		echo '<script>alert("보기권한이 없습니다.");history.go(-1);</script>';
		exit;
	}

$href = "&search=$search&Search_text=$Search_text&dateid=$dateid&oy1=$oy1&om1=$om1&od1=$od1&oy2=$oy2&om2=$om2&od2=$od2&admidx=$admidx&caridx=$caridx";


	 $oy1 = ($oy1)?$oy1:date("Y");
	 $om1 = ($om1)?$om1:date("m");
	 $od1 = ($od1)?$od1:date("d");
	 $oy2 = ($oy2)?$oy2:date("Y");
	 $om2 = ($om2)?$om2:date("m");
	 $od2 = ($od2)?$od2:date("d");
//(paydate >= 1332255600 and paydate <= 1332342000)
//echo date("Y-m-d",1332255600);
	//if($search) $where .= " and (paydate >= ".strtotime($oy1."-".$om1."-".$od1)." and paydate <= ".mktime(23,59,59,$om2,$od2,$oy2).") ";

//	$where .= " and (paydate >= ".strtotime($oy1."-".$om1."-".$od1)." and paydate <= ".mktime(23,59,59,$om2,$od2,$oy2).") ";
	if($sadmcom) $where .= " and admcom_idx='".$sadmcom."' ";
	if($sadmbank) $where .= " and admbank='".$sadmbank."' ";
?>
<style type="text/css">
/* .style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {font-size: 12px} */
.ui-datepicker-trigger {
    position: relative;
    top: 6px;
}

.btn_blue {
    cursor: pointer;
    background-color: #e7f1f9;
    color: #084573;
    border: #636563 1px solid;
}

.pageTitleBold {
    font-weight: bold;
    font-size: 13px;
}
</style>

<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
    var d = document;
    if (d.images) {
        if (!d.MM_p) d.MM_p = new Array();
        var i, j = d.MM_p.length,
            a = MM_preloadImages.arguments;
        for (i = 0; i < a.length; i++)
            if (a[i].indexOf("#") != 0) {
                d.MM_p[j] = new Image;
                d.MM_p[j++].src = a[i];
            }
    }
}

function exl_down(que, tb_name, tb_name2) {
    if (!que) {
        window.open('./exldown_pay.php?querya=1&tb_name=' + tb_name + '&tb_name2=' + tb_name2, 'exl_pop',
            'width=500,height=500');
    } else {
        window.open('./exldown_pay.php?querya=' + que + '&tb_name=' + tb_name + '&tb_name2=' + tb_name2, 'exl_pop',
            'width=500,height=500');
    }
}
//
-->
</script>

<table width="100%" border="0" cellpadding="0" cellspacing="0" height='100%'>
    <tr>
        <td valign='top'>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <!-- <td width='145' align='center' valign="top" style='font-size:14px;'>
				<-? // left ?>	
				<-? include "../inc/sm_calculate.php";?>
				</td>
                <td width="1" height="400" valign="top" style="background-color:#bbb;"></td> -->
                    <td valign="top" style='padding:10px;'>
                        <form name="search" method="get" action="/admin/cash_pay.php" style="margin:0px;">
                            <input type=hidden value="1" name="search">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td valign="top"><img src="/manage/img/icon02.gif"> 위치 : <span
                                                        class="pageTitleBold"> 일일결제내역 </span> </td>
                                            </tr>
                                            <tr>
                                                <td align="right" style="padding-bottom:5px;">
                                                    <!-- <input type="button" value="엑셀다운" class='btn_pink' style='cursor:hand;' onClick="exl_down('<-?=urlencode($where)?>','<-?=$tb_name?>','<-?=$tb_name2?>')"/>&nbsp; -->
                                                    <font color="#000000"><b>결제일기준</b></b> :
                                                        <!-- <select name="oy1">
                        <option value="">::선택::</option>
                        <?foreach($year_arr as $v){?>
                        <option value="<?=$v?>" <?=($v == $oy1)?"selected":""?>>
                          <?=$v?>
                          년</option>
                        <?}?>
                                        </select>
                    <select name="om1">
                        <option value="">::선택::</option>
                        <?foreach($month_arr as $v){?>
                        <option value="<?=$v?>" <?=($v == $om1)?"selected":""?>>
                          <?=$v?>
                          월</option>
                        <?}?>
                                        </select>
                    <select name="od1">
                        <option value="">::선택::</option>
                        <?foreach($day_arr as $v){?>
                        <option value="<?=$v?>" <?=($v == $od1)?"selected":""?>>
                          <?=$v?>
                          일</option>
                        <?}?>
                                        </select>
                                        
~
<select name="oy2">
  <option value="">::선택::</option>
  <?foreach($year_arr as $v){?>
  <option value="<?=$v?>" <?=($v == $oy2)?"selected":""?>>
    <?=$v?>
    년</option>
  <?}?>
</select>
<select name="om2">
  <option value="">::선택::</option>
  <?foreach($month_arr as $v){?>
  <option value="<?=$v?>" <?=($v == $om2)?"selected":""?>>
    <?=$v?>
    월</option>
  <?}?>
</select>
<select name="od2">
  <option value="">::선택::</option>
  <?foreach($day_arr as $v){?>
  <option value="<?=$v?>" <?=($v == $od2)?"selected":""?>>
    <?=$v?>
    일</option>
  <?}?>
</select> -->

                                                        <!-- 달력 -->
                                                        <input name="sdate" id="sdate" size="10">
                                                        <img class="ui-datepicker-trigger" src="/images/icon_data.gif"
                                                            alt="선택" title="선택">
                                                        ~
                                                        <input name="edate" id="edate" size="10">
                                                        <img class="ui-datepicker-trigger" src="/images/icon_data.gif"
                                                            alt="선택" title="선택">



                                                        <span class="p_tt">
                                                            <select name="sadmbank" id="select6">
                                                                <option value="">::결제통장별::</option>
                                                                <?
											$sql="select * from admbank order by idx";
											$result=mysql_query($sql);
											while ($data = mysql_fetch_assoc($result)){	
										
									?>
                                                                <option value="<?=$data[idx]?>"
                                                                    <?=($sadmbank==$data[idx])?"selected":""?>>
                                                                    <?=$data[bankname]?>
                                                                    /
                                                                    <?=$data[banknum]?>
                                                                    /
                                                                    <?=$data[bname]?>
                                                                </option>
                                                                <?}?>
                                                            </select>
                                                        </span><span class="p_tt">
                                                            <select name="sadmcom" id="select">
                                                                <option value="">::거래처별::</option>
                                                                <?
											$sql="select * from admcom order by idx";
											$result=mysql_query($sql);
											while ($data = mysql_fetch_assoc($result)){	
										
									?>
                                                                <option value="<?=$data[idx]?>"
                                                                    <?=($sadmcom==$data[idx])?"selected":""?>>
                                                                    <?=$data[company]?>
                                                                </option>
                                                                <?}?>
                                                            </select>
                                                        </span>
                                                        <input name="input" type="submit" value="검색" class="btn_blue">
                                                        <span class="ui-datepicker-trigger">
                                                            <img src="../img/btnl_excel.gif"
                                                                onClick="exl_down('<?=urlencode($where)?>','<?=$tb_name?>','<?=$tb_name2?>')"
                                                                style="cursor:hand;" />&nbsp;
                                                        </span>
                                                </td>
                                            </tr>

                                        </table>
                        </form>

                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#626262"
                            frame="border or box " style="border-collapse:collapse;"
                            class='pad_10  list-table-standard'>
                            <tr>
                                <td width="3%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">NO</td>
                                <td width="8%" align="center" bgcolor="f3f3f3" class="p_tt  table-th-dark">결제일자</td>
                                <td width="13%" align="center" bgcolor="f3f3f3" class="p_tt  table-th-dark">거래처</td>
                                <td width="9%" align="center" bgcolor="f3f3f3" class="p_tt  table-th-dark">은행명</td>
                                <td width="13%" align="center" bgcolor="f3f3f3" class="p_tt  table-th-dark">계좌번호</td>
                                <td width="13%" align="center" bgcolor="f3f3f3" class="p_tt  table-th-dark">예금주</td>
                                <td width="7%" align="center" bgcolor="f3f3f3" class="p_tt  table-th-dark">건수</td>
                                <td width="10%" align="center" bgcolor="f3f3f3" class="p_tt  table-th-dark">청구금액합계</td>
                                <td width="10%" align="center" bgcolor="f3f3f3" class="p_tt  table-th-dark">결제금액합계액</td>
                            </tr>

                            <?
									$qry = "SELECT * from day_result where year>='$oy1' and month>='$om1' and day>='$od1' and year<='$oy2' and month<='$om2' and day<='$od2' $where order by year desc, month desc, day desc ";
									$result=mysql_query($qry);
									$i=1;
									while ($data = mysql_fetch_assoc($result)){
										$payd=$data[year]."-".$data[month]."-".$data[day];
							  ?>

                            <tr onblur="this.style.backgroundColor='#deecee'"
                                onfocus="this.style.backgroundColor='#FFF'"
                                onMouseOver="this.style.backgroundColor='#deecee'"
                                onMouseOut="this.style.backgroundColor='#FFF'" style="cursor:hand">
                                <td width="3%" align="center"
                                    onclick='location.href="/admin/cash_paylist.php?<?=$href?>&dateid=<?=$payd?>&admidx=<?=$data[admcom_idx]?>"'>
                                    <?=$i?>
                                    <?//$data[admcom_idx]?>
                                </td>
                                <td width="8%" align="center"
                                    onclick='location.href="/admin/cash_paylist.php?<?=$href?>&dateid=<?=$payd?>&admidx=<?=$data[admcom_idx]?>"'>
                                    <?=$payd?></td>
                                <td width="13%" align="center"
                                    onclick='location.href="/admin/cash_paylist.php?<?=$href?>&dateid=<?=$payd?>&admidx=<?=$data[admcom_idx]?>"'>
                                    <?=$data[company]?></td>
                                <td width="9%" align="center"
                                    onclick='location.href="/admin/cash_paylist.php?<?=$href?>&dateid=<?=$payd?>&admidx=<?=$data[admcom_idx]?>"'>
                                    <?=$data[bankname]?></td>
                                <td width="13%" align="center"
                                    onclick='location.href="/admin/cash_paylist.php?<?=$href?>&dateid=<?=$payd?>&admidx=<?=$data[admcom_idx]?>"'>
                                    <?=$data[banknum]?></td>
                                <td width="13%" align="center"
                                    onclick='location.href="/admin/cash_paylist.php?<?=$href?>&dateid=<?=$payd?>&admidx=<?=$data[admcom_idx]?>"'>
                                    <?=$data[bname]?></td>
                                <td width="7%" align="center"
                                    onclick='location.href="/admin/cash_paylist.php?<?=$href?>&dateid=<?=$payd?>&admidx=<?=$data[admcom_idx]?>"'>
                                    <b>
                                        <font color="#000000"><?=$data[day_count]?></font>
                                    </b></td>
                                <td width="10%" align="center"
                                    onclick='location.href="/admin/cash_paylist.php?<?=$href?>&dateid=<?=$payd?>&admidx=<?=$data[admcom_idx]?>"'>
                                    <?=number_format($data[callpay1])?></td>
                                <td width="10%" align="center"
                                    onclick='location.href="/admin/cash_paylist.php?<?=$href?>&dateid=<?=$payd?>&admidx=<?=$data[admcom_idx]?>"'>
                                    <?=number_format($data[callpay1])?></td>
                            </tr>

                            <?		$i++;
										  $totalsumpay1+=$data[callpay1];
										   $totalsumpay2+=$data[callpay1];
										  }?>

                            <tr height="30">
                                <td colspan="7" align="center" bgcolor="f3f3f3" class="p_tt"><b>합 계</b></td>
                                <td align="center">
                                    <font color="#3399FF"><b><?=number_format($totalsumpay1)?></b></font>
                                </td>
                                <td align="center">
                                    <font color="#990000"><b><?=number_format($totalsumpay2)?></b></font>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- <tr>
                <td bgcolor='dddddd' height='1' colspan='3'></td>
              </tr> -->
</table>
<!--/로고 & 탑메뉴-->
</td>
</tr>
<tr>
    <td height='100%'>
        <!--body-->
        <!--/body-->
    </td>
</tr>
</table>



</body>

</html>

<?
$delayTime = array_sum(explode(' ', microtime())) - $time_start;

//echo $delayTime;


?>