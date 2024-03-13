<?
include $_SERVER['DOCUMENT_ROOT'] . '/manage/inc/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/manage/inc/top_menu.php';
include $_SERVER['DOCUMENT_ROOT'] . '/manage/inc/global.php';
?>
<style>
.btn_blue {
    cursor: pointer;
    background-color: #e7f1f9;
    color: #084573;
    border: #636563 1px solid;
}

.btn_pink {
    cursor: pointer;
    background-color: #fae3e3;
    color: #ff0000;
    border: #ff0000 1px solid;
}

.css_warning_img {
    width: 18px;
    height: 18px;
    background: url('/manage/img/warning.png');
    background-position: center center;
    background-repeat: no-repeat;
    object-fit: cover;
    cursor: pointer;
}
</style>

<script type="text/javascript">
// <!--
// function MM_preloadImages() { //v3.0
//     var d = document;
//     if (d.images) {
//         if (!d.MM_p) d.MM_p = new Array();
//         var i, j = d.MM_p.length,
//             a = MM_preloadImages.arguments;
//         for (i = 0; i < a.length; i++)
//             if (a[i].indexOf("#") != 0) {
//                 d.MM_p[j] = new Image;
//                 d.MM_p[j++].src = a[i];
//             }
//     }
// }
// //
// -->

//  경고팝업
function popup() {
    var newwin,
        w_url = '/manage/Sale10/pop_pay.php',
        w_name = '',
        w_width = 1000,
        w_height = 700,
        w_left = (screen.width - w_width) / 2,
        w_top = (screen.height - w_height) / 2,
        w_options = 'width=' + w_width + ', height=' + w_height + ', left=' + w_left + ', top=' + w_top +
        ', scrollbars=yes';

    newwin = open(w_url, w_name, w_options);
    if (window.focus) newwin.focus();
};
</script>
<!-- <script>
function popUp(url) {
    <
    ?
    if ($_SESSION[loginLevel] > 1) {
        ?
        >
        return; <
        ?
    } ? >
    window.open(url, 'pop', 'height=500, width=840, scrollbars=yes');

}
</script> -->
<?
$href = "&page=$page&search=$search&state=$state&scom=$scom&scharge=$scharge&sstoketype=$sstoketype&Search_text=$Search_text";
if ($caridx) {
    $sql = "select * from cardata1 where idx='$caridx'";
    $data = mysql_fetch_array(mysql_query($sql));
    $prow = mysql_fetch_array(mysql_query("select company from setting where idx='$data[set_idx1]'"));
    $crow = mysql_fetch_array(mysql_query("select company,phone from admcom where idx='$data[sale_idx]'"));
    $drow = mysql_fetch_array(mysql_query("select name,phone from setting where idx='$data[set_idx2]'"));
}

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td valign="top" style='padding:10px;'>

            <table width="1000" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto">
                <tr>
                    <td>
                        <table width="100%" border="0" cellpadding="10" cellspacing="0">
                            <tr>
                                <td width="53%" height="42"><img src="/manage/img/icon02.gif"> 위치:입고목록&gt; <b>
                                        <font color="#000000"><span style="font-size:13px">상세페이지<span></font>
                                    </b></td>

                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <table width="1000" border="0" cellspacing="0" cellpadding="0">

                            <tr>
                                <td width="1000" align="center" valign="top">
                                    <input type="button" id="button" value="목록보기" class='btn_blue'
                                        style='width:80px;cursor:hand'
                                        onclick='location.href="Sale_list.php?<?= $href ?>"'> &nbsp;
                                    <input type="button" id="button2" value="수정하기" class='btn_pink'
                                        style='width:80px;cursor:hand'
                                        onclick='location.href="Sale_write.php?<?= $href ?>&caridx=<?= $data[idx] ?>"'>
                                </td>
                            </tr>
                            <tr>
                                <td height="10" valign="top"></td>
                            </tr>
                        </table>
                        <table width="1000" border="0" cellpadding="4" cellspacing="0" bordercolor="#333333"
                            frame="border or box " style="border-collapse:collapse;" class='pad_10'>
                            <tr>
                                <td valign="top">
                                    <table width="1000" cellspacing="0" cellpadding="0" border="0">
                                        <tr>
                                            <td align="center" valign="top" style="padding:5 5 5 5;">
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tr>
                                                        <td height="5">
                                                            <table width="1000">
                                                                <tr>
                                                                    <td width="263" align="left">
                                                                        등록일:<?= ($data[regdate]) ? date("Y-m-d", $data[regdate]) : "" ?>
                                                                        /
                                                                        최종수정일:<?= ($data[moddate]) ? date("Y-m-d", $data[moddate]) : "" ?>
                                                                    </td>
                                                                    <td width="508" align="right"></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <table width="100%" border="1" cellpadding="0"
                                                                cellspacing="0" bordercolor="#626262"
                                                                frame="border or box "
                                                                style="border-collapse:collapse; border-color:rgb(194, 194, 194);"
                                                                class='pad_10'>
                                                                <tr>
                                                                    <td colspan="2" height="30" align="center"
                                                                        bgcolor="f3f3f3" class="p_tt">
                                                                        <strong>차량정보</strong>
                                                                    </td>
                                                                    <td colspan="2" align="center" bgcolor="f3f3f3"
                                                                        class="p_tt"><strong>매입정보</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="15%" height="30" align="center"
                                                                        bgcolor="f7f7f7">
                                                                        차&nbsp;량&nbsp;명</td>
                                                                    <td width="35%" height="25" align="center">
                                                                        <?= $data[carname] ?></td>
                                                                    <td width="15%" align="center" bgcolor="f7f7f7">
                                                                        매&nbsp;입&nbsp;처
                                                                    </td>
                                                                    <td align="center">
                                                                        <?= $crow[0] ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" align="center" bgcolor="f7f7f7">
                                                                        차량번호
                                                                    </td>
                                                                    <td height="25" align="center"><?= $data[carnum] ?>
                                                                    </td>
                                                                    <td align="center" bgcolor="f7f7f7">
                                                                        연&nbsp;락&nbsp;처
                                                                    </td>
                                                                    <td align="center"><?= $crow[1] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" align="center" bgcolor="f7f7f7">
                                                                        년&nbsp;&nbsp;&nbsp;&nbsp;식
                                                                    </td>
                                                                    <td height="25" align="center"><?= $data[carym] ?>
                                                                    </td>
                                                                    <td align="center" bgcolor="f7f7f7">
                                                                        담&nbsp;당&nbsp;자
                                                                    </td>
                                                                    <td height="25" align="center"><?= $data[charge] ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" align="center" bgcolor="f7f7f7">
                                                                        연&nbsp;&nbsp;&nbsp;&nbsp;료
                                                                    </td>
                                                                    <td align="center"><?= $oil_arr2[$data[oil]] ?>
                                                                    </td>
                                                                    <td align="center" bgcolor="f7f7f7">
                                                                        매입유형
                                                                    </td>
                                                                    <td align="center">
                                                                        <?= ($data[saletype] == 1) ? "폐차매입" : "구제/보관" ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="10" valign="top"></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <table width="100%" border="1" cellpadding="0"
                                                                cellspacing="0" bordercolor="#626262"
                                                                frame="border or box "
                                                                style="border-collapse:collapse; border-color:rgb(194, 194, 194);"
                                                                class='pad_10'>
                                                                <tr>
                                                                    <td colspan="3" height="30" align="center"
                                                                        bgcolor="f3f3f3" class="p_tt">
                                                                        <strong>차주정보</strong>
                                                                    </td>
                                                                    <td colspan="2" align="center" bgcolor="f3f3f3"
                                                                        class="p_tt"><strong>출고지정보</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="15%" height="30" align="center"
                                                                        bgcolor="f7f7f7">소 유 자</td>
                                                                    <td width="17%" height="25" align="center">
                                                                        <?= $data[owner] ?></td>
                                                                    <td width="18%" align="center">
                                                                        <?= $data[ownernum] ?>
                                                                    </td>
                                                                    <td width="15%" align="center" bgcolor="f7f7f7">
                                                                        출 고
                                                                        처
                                                                    </td>
                                                                    <td align="center"><?= $data[outcom] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" align="center" bgcolor="f7f7f7">
                                                                        공동명의자
                                                                    </td>
                                                                    <td height="25" align="center">
                                                                        <?= $data[commname] ?>
                                                                    </td>
                                                                    <td align="center"><?= $data[commnum] ?>
                                                                    </td>
                                                                    <td align="center" bgcolor="f7f7f7">
                                                                        연&nbsp;락&nbsp;처
                                                                    </td>
                                                                    <td align="center">
                                                                        <p>
                                                                            <?= $data[outphone] ?>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" align="center" bgcolor="f7f7f7">
                                                                        소유자연락처
                                                                    </td>
                                                                    <td height="25" colspan="2" align="center">
                                                                        <?= $data[ownerphone] ?></td>
                                                                    <td align="center" bgcolor="f7f7f7">
                                                                        주&nbsp;&nbsp;&nbsp;&nbsp;소</td>
                                                                    <td height="25" align="center"><?= $data[outadd] ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" align="center" bgcolor="f7f7f7">
                                                                        소유형태
                                                                    </td>
                                                                    <td colspan="2" align="center">
                                                                        <?= $owner_arr2[$data[ownertype]] ?> </td>
                                                                    <td align="center" bgcolor="f7f7f7">
                                                                        비&nbsp;&nbsp;&nbsp;&nbsp;고</td>
                                                                    <td align="left"><?= $data[outetc] ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="10" valign="top"></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <table width="100%" border="1" cellpadding="0"
                                                                cellspacing="0" bordercolor="#626262"
                                                                frame="border or box "
                                                                style="border-collapse:collapse; border-color:rgb(194, 194, 194);"
                                                                class='pad_10'>
                                                                <tr>
                                                                    <td height="30" colspan="4" align="center"
                                                                        bgcolor="f3f3f3" class="p_tt">
                                                                        <strong>차량관리</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="15%" height="30" align="center"
                                                                        bgcolor="f7f7f7">입고유무</td>
                                                                    <td height="25" align="center">
                                                                        <?= ($data[stokeor] == 1) ? "입고" : "미입고" ?>
                                                                    </td>
                                                                    <td height="25" align="center" bgcolor="f7f7f7">
                                                                        입고일자
                                                                    </td>
                                                                    <td height="25" align="center">
                                                                        <?= $data[stokeday] ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" align="center" bgcolor="f7f7f7">
                                                                        입고유형
                                                                    </td>
                                                                    <td width="35%" height="25" align="center">
                                                                        <?= $stoke_arr2[$data[stoketype]] ?></td>
                                                                    <td width="15%" align="center" bgcolor="f7f7f7">
                                                                        진행일자
                                                                    </td>
                                                                    <td height="25" align="center"><?= $data[progday] ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="15%" height="30" align="center"
                                                                        bgcolor="f7f7f7">
                                                                        번&nbsp;호&nbsp;판
                                                                    </td>
                                                                    <td height="25" align="center"><?= $data[numpan] ?>
                                                                        개 </td>
                                                                    <td height="25" align="center" bgcolor="f7f7f7">
                                                                        등&nbsp;록&nbsp;증
                                                                    </td>
                                                                    <td height="25" align="center">
                                                                        <?= ($data[reglicence] == 1) ? "유" : "무" ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" align="center" bgcolor="f7f7f7">
                                                                        저&nbsp;&nbsp;&nbsp;&nbsp;당
                                                                    </td>
                                                                    <td height="25" align="center">
                                                                        <?= $data[collateral] ?>
                                                                        건</td>
                                                                    <td height="25" align="center" bgcolor="f7f7f7">
                                                                        압&nbsp;&nbsp;&nbsp;&nbsp;류
                                                                    </td>
                                                                    <td height="25" align="center"><?= $data[seize] ?>
                                                                        건</td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" align="center" bgcolor="f7f7f7">
                                                                        폐&nbsp;차&nbsp;증
                                                                    </td>
                                                                    <td height="25" align="center">
                                                                        <?= ($data[junkcar] == 1) ? "발급" : "미발급" ?>
                                                                    </td>
                                                                    <td height="25" align="center" bgcolor="f7f7f7">
                                                                        품의번호
                                                                    </td>
                                                                    <td height="25" align="center">
                                                                        <?= $data[consulnum] ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="10" valign="top"></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">

                                                            <form name="cform" method=post aaction="/comm/regexc.php"
                                                                ttarget="HiddenFrm" style="margin:0px;"
                                                                onSubmit="subreg('/comm/regexc.php?mode=memoadd&mdiv2=<?= $data[idx] ?>&contents='+ document.cform.memo.value);">
                                                                <table width="100%" border="1" cellpadding="3"
                                                                    cellspacing="0" bordercolor="#626262"
                                                                    frame="border or box "
                                                                    style="text-decoration: blink; border-collapse:collapse; border-color:rgb(194, 194, 194);"
                                                                    class='pad_10'>
                                                                    <tr>
                                                                        <td width="15%" height="30" align="center"
                                                                            bgcolor="#FFFF00"><strong>진행메모장</strong>
                                                                        </td>
                                                                        <td height="25" colspan="3" align="left"
                                                                            bgcolor="#FFFF00"><input type="text"
                                                                                name="memo" class="ipip" size="120">
                                                                            &nbsp;
                                                                            <input type="submit" value="입력"
                                                                                style='width:50px;cursor:hand'
                                                                                class="btn_pink" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="15%" height="30" align="center">
                                                                            2024-02-13</td>
                                                                        <td height="25" colspan="3" align="left"
                                                                            style="display:flex; align-items: center; border:0">
                                                                            <span> 샘플지역 지로납부-계산서발급 완료 </span>
                                                                            <img
                                                                                src="/manage/img/sale-view_deleteBtn.gif" />
                                                                        </td>
                                                                    </tr>
                                                                    <?
                                                                    $sql2 = "select * from memo where mdiv1=1 and mdiv2=$data[idx] order by idx desc";
                                                                    $result2 = mysql_query($sql2);
                                                                    while ($data2 = mysql_fetch_assoc($result2)) {
                                                                    ?>
                                                                    <tr>
                                                                        <td height="30" align="center">
                                                                            <?= date("Y-m-d", $data2[regdate]) ?></td>
                                                                        <td height="25" colspan="3" align="left">
                                                                            &nbsp;<?= $data2[memo] ?> <img
                                                                                src="/img/icon/btn_close.gif"
                                                                                style='cursor:hand'
                                                                                onClick="subreg('/comm/regexc.php?mode=memodel&mdiv2=<?= $data[idx] ?>&midx=<?= $data2[idx] ?>');">
                                                                        </td>
                                                                    </tr>
                                                                    <? } ?>
                                                            </form>

                                                </table>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="10" valign="top"></td>
                                        </tr>

                                        <tr>
                                            <td height="20" valign="top" class="p_tt"><strong>지급요청내역</strong></td>
                                        </tr>
                                        <tr>
                                            <td valign="top">
                                                <table width="100%" border="1" cellpadding="3" cellspacing="0"
                                                    bordercolor="#626262" frame="border or box "
                                                    style="border-collapse:collapse; border-color:rgb(194, 194, 194);"
                                                    class='pad_10'>
                                                    <tr>
                                                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">
                                                            NO
                                                        </td>
                                                        <td align="center" bgcolor="f3f3f3" class="p_tt">
                                                            거래처
                                                        </td>
                                                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">
                                                            은행명
                                                        </td>
                                                        <td width="13%" height="30" align="center" bgcolor="f3f3f3"
                                                            class="p_tt">계좌번호</td>
                                                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">
                                                            예금주
                                                        </td>
                                                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">
                                                            지급내역
                                                        </td>
                                                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">
                                                            청구금액
                                                        </td>
                                                        <td width="5%" height="30" align="center" bgcolor="f3f3f3"
                                                            class="p_tt">구분</td>
                                                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt"
                                                            style="display: flex; align-items:center;          justify-content: center;
 border:0">
                                                            결제금액
                                                            <!-- <a href="javascript:popUp('pop_pay.php?caridx=<?= $data[idx] ?>')"> -->
                                                            <!-- <span
                                                                    class="style3" style="color:red">■</span></a> -->
                                                            <div class="css_warning_img" onClick="popup()">
                                                            </div>
                                                        </td>
                                                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">
                                                            결제일
                                                        </td>
                                                    </tr>

                                                    <!-- 샘플 -->
                                                    <tr>
                                                        <td height="30" align="center" bgcolor="" class="p_tt">
                                                            1
                                                        </td>
                                                        <td align="center" bgcolor="" class="p_tt">
                                                            거래처명이 나옴
                                                        </td>
                                                        <td height="30" align="center" bgcolor="" class="p_tt">
                                                            농혐
                                                        </td>
                                                        <td width="13%" height="30" align="center" bgcolor=""
                                                            class="p_tt">1234-5789-33</td>
                                                        <td height="30" align="center" bgcolor="" class="p_tt">
                                                            홍길동
                                                        </td>
                                                        <td height="30" align="center" bgcolor="" class="p_tt">
                                                            지급내역
                                                        </td>
                                                        <td height="30" align="center" bgcolor="" class="p_tt">
                                                            1,000,000
                                                        </td>
                                                        <td width="5%" height="30" align="center" bgcolor=""
                                                            class="p_tt">종결</td>
                                                        <td height="30" align="center" bgcolor="" class="p_tt">
                                                            1,000,000<a
                                                                href="javascript:popUp('pop_pay.php?caridx=<?= $data[idx] ?>')"></a>
                                                        </td>
                                                        <td height="30" align="center" bgcolor="" class="p_tt">
                                                            2024-02-20
                                                        </td>
                                                    </tr>

                                                    <?
                                                    $sql2 = "select * from cardata2 where cardata_idx=$data[idx] order by idx";
                                                    $result2 = mysql_query($sql2);
                                                    $i = 1;
                                                    while ($data2 = mysql_fetch_assoc($result2)) {
                                                        $grow = qrow("select bankname,banknum,bname,idx from admcom where idx='$data2[admcom_idx]'");
                                                    ?>

                                                    <tr>
                                                        <td width="3%" height="30" align="center"><?= $i ?></td>
                                                        <td width="14%" height="30" align="center">
                                                            <?= $data2[company] ?>
                                                        </td>
                                                        <td width="7%" height="30" align="center"><?= $grow[0] ?></td>
                                                        <td height="30" align="center"><?= $grow[1] ?></td>
                                                        <td width="13%" height="30" align="center"><?= $grow[2] ?></td>

                                                        <td width="12%" height="30" align="center">
                                                            <?= $data2[payinfo] ?>
                                                        </td>
                                                        <td width="13%" height="30" align="center">
                                                            <?= number_format($data2[callpay]) ?></td>
                                                        <td width="5%" height="30" align="center">
                                                            <?= $gubun_arr2[$data2[cardiv]] ?></td>
                                                        <td height="30" align="center">
                                                            <?= ($data2[paydiv] == 2) ? number_format($data2[callpay]) : 0 ?>
                                                        </td>
                                                        <td height="30" align="center">
                                                            <?= $data2[paydate] > 86400 ? date("Y-m-d", $data2[paydate]) : "" ?>
                                                        </td>
                                                    </tr>

                                                    <?
                                                        $totalpay1 += $data2[callpay];
                                                        $totalpay2 += ($data2[paydiv] == 2) ? $data2[callpay] : 0;
                                                        $i++;
                                                    } ?>
                                                    <tr>
                                                        <td height="30" colspan="2" align="center" bgcolor="f7f7f7"
                                                            class="p_tt"><strong>매입가격</strong></td>
                                                        <td height="30" colspan="2" align="center" class="p_tt">
                                                            <?= number_format($data[carbody]) ?></td>
                                                        <td height="30" colspan="2" align="center" class="p_tt">
                                                            <strong>청구합계액</strong>
                                                        </td>
                                                        <td height="30" align="center" class="p_tt">
                                                            <font color="#3399FF"><b>1,000,000</b>
                                                            </font>
                                                        </td>
                                                        <td height="30" align="center" class="p_tt">&nbsp;</td>
                                                        <td height="30" align="center" class="p_tt">
                                                            <font color="#990000"><b>1,000,000</b>
                                                            </font>
                                                        </td>
                                                        <td></td>
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
            </table>
            <table width="1000" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="20" valign="top"></td>
                </tr>
                <tr>
                    <td align="center" valign="top"><input type="button" id="button" value="목록보기" class='btn_blue'
                            style='width:80px;cursor:hand' onclick='location.href="Sale_list.php?<?= $href ?>"'> &nbsp;
                        <input type="button" id="button2" value="수정하기" class='btn_pink' style='width:80px;cursor:hand'
                            onclick='location.href="Sale_write.php?<?= $href ?>&caridx=<?= $data[idx] ?>"'>
                    </td>
                </tr>
            </table>
        </td>

    </tr>
</table>
</td>
</tr>
<tr>
    <td bgcolor='dddddd' height='1' colspan='3'></td>
</tr>
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