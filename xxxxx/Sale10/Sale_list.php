<?
include $_SERVER['DOCUMENT_ROOT'] . '/manage/inc/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/manage/inc/top_menu.php';
include $_SERVER['DOCUMENT_ROOT'] . '/manage/inc/global.php';
?>
<?
$tb_name = "cardata1";
$tb_name2 = "cardata2";

$view_article = 15; // 한화면에 나타날 게시물의 총 개수  
if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
$start = ($page - 1) * $view_article;

//pay nopay scharge sstoketype state Search_text
$href = "&page=$page&search=$search&state=$state&scom=$scom&scharge=$scharge&sstoketype=$sstoketype&Search_text=$Search_text&sdate=$sdate&edate=$edate";
$where = " 1 ";

if ($scom) $where .= " and set_idx1='" . $scom . "' ";
if ($scharge) $where .= " and set_idx2='" . $scharge . "' ";
if ($ssale) $where .= " and sale_idx='" . $ssale . "' ";
if ($sstoketype) $where .= " and stoketype = '" . $sstoketype . "' ";
if ($state) {
    if ($state == 12) $where .= " and (state = '1' or state = '2') ";
    else $where .= " and state = '" . $state . "' ";
}
if ($sdate) {
    $where .= " and stokeday >= '$sdate' ";
}
if ($edate) {
    $where .= " and stokeday <= '$edate' ";
}

// 검색 단어를 입력했을때   
if ($Search_text) {
    $tmp1 = "carname";
    $tmp2 = "carnum";
    $tmp3 = "carym";
    $tmp4 = "stoketype";
    $tmp5 = "charge";
    $where .= " and ( ($tmp1 like '%$Search_text%') or ($tmp2 like '%$Search_text%') or ($tmp3 like '%$Search_text%') or ($tmp4 like '%$Search_text%') or ($tmp5 like '%$Search_text%')) ";
}
$where .= " ORDER BY regdate desc";
$query = "select count(*) from $tb_name where $where ";
//echo $query;
$result = mysql_query($query, $connect);
$temp = mysql_fetch_row($result);
$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함


?>
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
        window.open('./exldown.php?querya=1&tb_name=' + tb_name + '&tb_name2=' + tb_name2, 'exl_pop',
            'width=500,height=500');
    } else {
        window.open('./exldown.php?querya=' + que + '&tb_name=' + tb_name + '&tb_name2=' + tb_name2, 'exl_pop',
            'width=500,height=500');
    }
}

function chkall() {
    var cobj = document.getElementById('allcheck');
    var obj = document.getElementsByName('check[]');
    //alert(2);
    for (var i = 0; i < obj.length; i++) {
        if (cobj.checked == true) {
            obj[i].checked = true;
        } else {
            obj[i].checked = false;
        }
    }

}
//
-->
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function() {
    //모든 datepicker에 대한 공통 옵션 설정
    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd' //Input Display Format 변경
            ,
        showOtherMonths: true //빈 공간에 현재월의 앞뒤월의 날짜를 표시
            ,
        showMonthAfterYear: true //년도 먼저 나오고, 뒤에 월 표시
            ,
        changeYear: true //콤보박스에서 년 선택 가능
            ,
        changeMonth: true //콤보박스에서 월 선택 가능                
            ,
        showOn: "both" //button:버튼을 표시하고,버튼을 눌러야만 달력 표시 ^ both:버튼을 표시하고,버튼을 누르거나 input을 클릭하면 달력 표시  
            ,
        buttonImage: "/images/icon_data.gif" //버튼 이미지 경로
            ,
        buttonImageOnly: true //기본 버튼의 회색 부분을 없애고, 이미지만 보이게 함
            ,
        buttonText: "선택" //버튼에 마우스 갖다 댔을 때 표시되는 텍스트                
            ,
        yearSuffix: "년" //달력의 년도 부분 뒤에 붙는 텍스트
            ,
        monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'] //달력의 월 부분 텍스트
            ,
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월',
                '12월'
            ] //달력의 월 부분 Tooltip 텍스트
            ,
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'] //달력의 요일 부분 텍스트
            ,
        dayNames: ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'] //달력의 요일 부분 Tooltip 텍스트
            ,
        onSelect: function(dateText) {
            // 변하는 내용이 있을 때 호출되는 함수이다.
            if (this.id == "mdate") {
                // 시작에서 선택한 날짜를 마지막의 처음 날짜로 설정한다.
                var minDate = $(this).datepicker('getDate');

            } else if (this.id == "datePickEnd") {
                // 마지막에서 선택한 날짜를 시작의 마지막 날짜로 설정한다.
                var maxDate = $(this).datepicker('getDate');
            }
        }
    });

    //input을 datepicker로 선언
    $("#sdate").datepicker({
        changeMonth: false,
        changeYear: false
    });
    $("#edate").datepicker({
        changeMonth: false,
        changeYear: false
    });
});
</script>
<style>
/*datepicer 버튼 롤오버 시 손가락 모양 표시*/
.ui-datepicker-trigger {
    cursor: pointer;
}

/*datepicer input 롤오버 시 손가락 모양 표시*/
.hasDatepicker {
    cursor: pointer;
}

/*ui-datepicker-trigger에서 9px를 올려준 것은 이미지가 살짝 위로 올라가서 위치를 조정하기 위해서 */
.ui-datepicker-trigger {
    position: relative;
    top: 6px;
}

.btn_pink {
    cursor: pointer;
    background-color: #ffecec;
    color: #ff0000;
    border: #ff0000 1px solid;
}

.btn_gray {
    cursor: pointer;
    background-color: #FFFFFF;
    border: 1px #636563 solid;
    font-weight: bold;
    margin-top: 15px;
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

<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td valign="top" style='padding:10px;'>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="42" colspan="2">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><img src="/manage/img/icon02.gif"> 위치 : <span class="pageTitleBold">
                                                    입고목록 </span> </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="fbfbfb">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="10">
                                                    <tr>
                                                        <td>
                                                            <table width="100%" border="0" cellspacing="0">
                                                                <tr>
                                                                    <td width="40%">1. <strong>청구누계</strong>: 담당자가 결제올린
                                                                        금액의 합계액임</td>
                                                                  <td>2. <strong>결제누계</strong>: 해당건의 결제금액 합계액임</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3. <strong>차액(미결)</strong>: 청구누계-결제누계=차액(미결)
                                                                    </td>
                                                                    <td>4. <strong>초과결제</strong>: 매입가격 < 결제누계=초과결제</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr> </tr>
                            <tr>
                                <td class="p_tt" style="vertical-align: bottom;">
                                    <form name="search" method="get" action="/admin/calculate.php" style="margin:0px;">
                                        <input type=hidden value="1" name="search">
                                        <span class="p_tt">
                                            <input type="button" value="입고등록" class='btn_pink' style='cursor:hand;'
                                                onClick="window.location='Sale_write.php'" /></span>&nbsp;

                                </td>

                                <td align="right" class="p_tt">
                                    <!-- <input type="button" value="결제조회" class='btn6_1' style='cursor:hand;' onClick="window.location='/admin/calculate.php?<?= $href ?>&pay=1'"/>
                    <input type="button" value="미결조회" class='btn1_1' style='cursor:hand;' onClick="window.location='/admin/calculate.php?<?= $href ?>&nopay=1'"/> -->
                                    <!-- 
                    <select name="scom" id="select5" onChange="document.location.href='?<?= $href ?>&scom='+this.value">
                      <option value="">영업소별</option>
                      <?
                        $sql = "select idx,company from setting where tdiv=1 order by idx";
                        $result = mysql_query($sql);
                        while ($data = mysql_fetch_assoc($result)) {

                        ?>
                                            <option value="<?= $data[idx] ?>" <?= ($scom == $data[idx]) ? "selected" : "" ?>><?= $data[company] ?></option>
									<? } ?>
                    </select>
                     -->
                                    <!--select name="ssale" id="select5" onChange="document.location.href='?<?= $href ?>&ssale='+this.value">
                      <option value="">매입처별</option>
                      <?
                        /*
											$sql="select idx,company from admcom order by idx";
											$result=mysql_query($sql);
											while ($data = mysql_fetch_assoc($result)){	
						*/
                        ?>
                                            <option value="<?= $data[idx] ?>" <?= ($ssale == $data[idx]) ? "selected" : "" ?>><?= $data[company] ?></option>
									<? //}
                                    ?>
                    </select-->
                                    <!-- 
                    <select name="scharge" id="select6" onChange="document.location.href='?<?= $href ?>&scharge='+this.value">
                      <option value="">담당자별</option>
					   <?
                        $sql = "select idx,name from setting where (tdiv=2 or tdiv=3) and id<>'drg1038' order by idx";
                        $result = mysql_query($sql);
                        while ($data = mysql_fetch_assoc($result)) {

                        ?>
                                            <option value="<?= $data[idx] ?>" <?= ($scharge == $data[idx]) ? "selected" : "" ?>><?= $data[name] ?></option>
									<? } ?>
                    </select>
                     -->
                                    <select name="sstoketype" id="select4"
                                        onChange="document.location.href='?<?= $href ?>&sstoketype='+this.value">
                                        <option value="">입고유형</option>
                                        <option value="1" <?= ($sstoketype == 1) ? "selected" : "" ?>>일반폐차</option>
                                        <option value="2" <?= ($sstoketype == 2) ? "selected" : "" ?>>차량초과</option>
                                        <option value="3" <?= ($sstoketype == 3) ? "selected" : "" ?>>조기폐차</option>
                                    </select>
                                    <select name="state" id="select"
                                        onChange="document.location.href='?<?= $href ?>&state='+this.value">
                                        <option value="">:::상태:::</option>
                                        <option value="1" <?= ($state == 1) ? "selected" : "" ?>>미결</option>
                                        <option value="2" <?= ($state == 2) ? "selected" : "" ?>>발급</option>
                                        <option value="3" <?= ($state == 3) ? "selected" : "" ?>>말소</option>
                                        <!--option value="12" <?= ($state == 12) ? "selected" : "" ?>>미결+발급</option-->
                                        <option value="13" <?= ($state == 13) ? "selected" : "" ?>>카카오토</option>
                                    </select>
                                    <input name="sdate" id="sdate" size="10"> ~
                                    <input name="edate" id="edate" size="10">
                                    <input type="text" name="Search_text"
                                        value="<?= ($Search_text) ? $Search_text : "" ?>" class="ipip" size="20">
                                    <input name="input" type="submit" value="검색" class="btn_blue">
                                    </span>
                                    <span style="vertical-align: bottom;">
                                        <?
                                        if ($loginUsort == "superadmin") {
                                        ?>
                                        <img src="../img/btnl_excel.gif"
                                            onclick="exl_down('<?= base64_encode($where) ?>','<?= $start ?>','<?= $view_article ?>')"
                                            style="cursor:hand;" />
                                        <?
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td height="10" colspan="2" class="p_tt"></td>
                            </tr>
                        </table>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form name="cform" method="post" target="HiddenFrm" style="margin:0px;">
                            <input type=hidden value="alldel" name="mode">
                            <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#626262"
                                frame="border or box " style="border-collapse:collapse;"
                                class='pad_10 list-table-standard'>
                                <tr>
                                    <td width="2%" height="30" align="center" bgcolor="f3f3f3"
                                        class="p_tt table-th-dark"><input type="checkbox" name="allchk" id="allcheck"
                                            onClick="chkall()" /></td>
                                    <td width="3%" align="center" bgcolor="f3f3f3" class="table-th-dark">NO</td>
                                    <td width="7%" align="center" bgcolor="f3f3f3" class="table-th-dark">입고일</td>
                                    <td width="10%" align="center" bgcolor="f3f3f3" class="table-th-dark">차량명</td>
                                    <td width="9%" align="center" bgcolor="f3f3f3" class="table-th-dark">차량번호</td>
                                    <td width="6%" align="center" bgcolor="f3f3f3" class="table-th-dark">년식</td>
                                    <td width="6%" align="center" bgcolor="f3f3f3" class="table-th-dark">입고유형</td>
                                    <td align="center" bgcolor="f3f3f3" class="table-th-dark">매입처</td>
                                    <!--td width="6%" align="center" bgcolor="f3f3f3" class="table-th-dark">영업소</td-->
                                    <td width="6%" align="center" bgcolor="f3f3f3" class="table-th-dark">담당자</td>
                                    <td width="7%" align="center" bgcolor="f3f3f3" class="table-th-dark">매입가격</td>
                                  <td width="7%" align="center" bgcolor="f3f3f3" class="table-th-dark">청구누계</td>
                                  <td width="7%" align="center" bgcolor="f3f3f3" class="table-th-dark">결제누계</td>
                                    <td width="7%" align="center" bgcolor="f3f3f3" class="table-th-dark">차액(미결)</td>
                                    <td width="5%" align="center" bgcolor="f3f3f3" class="table-th-dark">상태</td>
                                </tr>
                                <?
                                if ($total_article > 0) {
                                    $qry = "SELECT * FROM $tb_name WHERE $where LIMIT $start, $view_article";
                                    //echo $qry;
                                    $result = mysql_query($qry);
                                    $i = 0;
                                    while ($data2 = mysql_fetch_assoc($result)) {

                                        $crow = mysql_fetch_row(mysql_query("select company from admcom where idx='$data2[sale_idx]'"));
                                        $drow = mysql_fetch_row(mysql_query("select name from setting where idx='$data2[set_idx2]'"));
                                        $prow = mysql_fetch_row(mysql_query("select company from setting where idx='$data2[set_idx1]'"));

                                        $sumcallpay = mysql_fetch_row(mysql_query("select sum(callpay) from cardata2 where cardata_idx='$data2[idx]'"));
                                        $sumdivpay = mysql_fetch_row(mysql_query("select sum(callpay) from cardata2 where cardata_idx='$data2[idx]' and paydiv=1"));
                                        $sumpay = mysql_fetch_row(mysql_query("select sum(callpay) from cardata2 where cardata_idx='$data2[idx]' and paydiv=2"));

                                ?>
                                <tr onblur="this.style.backgroundColor='#deecee'"
                                    onfocus="this.style.backgroundColor='#FFF'"
                                    onMouseOver="this.style.backgroundColor='#deecee'"
                                    onMouseOut="this.style.backgroundColor='#FFF'" style="cursor:hand">
                                    <td width="3%" height="30" align="center" class="p_tt"><input type="checkbox"
                                            name="check[]" value="<?= $data2[idx] ?>"></td>
                                    <td width="3%" align="center">
                                        <?= $total_article - $i - (($page - 1) * $view_article) ?></td>
                                    <td align="center"
                                        onclick='location.href="Sale_view.php?<?= $href ?>&caridx=<?= $data2[idx] ?>"'>
                                        <?= $data2[stokeday] ?></td>
                                    <td width="8%" align="center"
                                        onclick='location.href="Sale_view.php?<?= $href ?>&caridx=<?= $data2[idx] ?>"'>
                                        <?= $data2[carname] ?></td>
                                    <td width="9%" align="center"
                                        onclick='location.href="Sale_view.php?<?= $href ?>&caridx=<?= $data2[idx] ?>"'>
                                        <?= $data2[carnum] ?></td>
                                    <td align="center"
                                        onclick='location.href="Sale_view.php?<?= $href ?>&caridx=<?= $data2[idx] ?>"'>
                                        <?= $data2[carym] ?></td>
                                    <td align="center"
                                        onclick='location.href="Sale_view.php?<?= $href ?>&caridx=<?= $data2[idx] ?>"'>
                                        <?= $stoke_arr2[$data2[stoketype]] ?></td>
                                    <td align="center"
                                        onclick='location.href="Sale_view.php?<?= $href ?>&caridx=<?= $data2[idx] ?>"'>
                                        <?= $crow[0] ?></td>
                                    <td align="center"
                                        onclick='location.href="Sale_view.php?<?= $href ?>&caridx=<?= $data2[idx] ?>"'>
                                        <?= $drow[0] ?></td>
                                    <td width="8%" align="center"
                                        onclick='location.href="Sale_view.php?<?= $href ?>&caridx=<?= $data2[idx] ?>"'>
                                        <?= number_format($data2[carbody]) ?></td>
                                    <td align="center"
                                        onclick='location.href="Sale_view.php?<?= $href ?>&caridx=<?= $data2[idx] ?>"'>
                                        <?= number_format($sumcallpay[0]) ?></td>
                                    <td align="center"
                                        onclick='location.href="Sale_view.php?<?= $href ?>&caridx=<?= $data2[idx] ?>"'>
                                        <?= number_format($sumpay[0]) ?></td>
                                    <td align="center"
                                        onclick='location.href="Sale_view.php?<?= $href ?>&caridx=<?= $data2[idx] ?>"'>
                                        <?= number_format($sumcallpay[0] - $sumpay[0]) ?></td>
                                    <td width="5%" align="center">
                                        <select name="status" id="select2"
                                            onChange="subreg('/comm/regexc.php?mode=status&idx=<?= $data2[idx] ?>&sno='+ this.value);">
                                            <option value=1 <? if ($data2[state]==1) { echo "selected" ; } ?>>미결
                                            </option>
                                            <option value=2 <? if ($data2[state]==2) { echo "selected" ; } ?>>발급
                                            </option>
                                            <option value=3 <? if ($data2[state]==3) { echo "selected" ; } ?>>말소
                                            </option>
                                            <option value=13 <? if ($data2[state]==13) { echo "selected" ; } ?>>카카오토
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <? $i++;
                                    }
                                } ?>
                        </form>
            </table>
        </td>
    </tr>
    <!-- 하단 선택삭제 G-->

    <table border="0" cellpadding="0" cellspacing="0" style='margin-top:10px;' width='100%'>
        <!-- <tr>
                <td bgcolor='dddddd' height='1' colspan='3' ></td>
              </tr> -->
        <tr>
            <td width='50'>
                <? if ($_SESSION[loginLevel] > 1) {
                } else { ?><input type="button" value="선택삭제" class='btn_gray' onClick="delete_list('regexc.php');">
                <? } ?>
            </td>
            <td>
                <? include "../../inc/page.php"; ?>
            <td width='50'></td>
        </tr>
    </table>
    <!-- 하단 선택삭제 E-->
</table>
</tr>
<!-- <tr>
                <td bgcolor='dddddd' height='1' colspan='3'></td>
              </tr> 삭제버튼 위로 이동-->
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