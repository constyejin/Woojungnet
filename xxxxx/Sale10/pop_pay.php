<? include_once "../admin_setting.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
.btn-blue {
    cursor: pointer;
    background-color: #e7f1f9;
    color: #084573;
    border: #636563 1px solid;
}

.btn-gray {
    cursor: pointer;
    background-color: #FFFFFF;
    border: 1px #636563 solid;
    font-weight: bold;

}

.btn-pink {
    cursor: pointer;
    background-color: #fae3e3;
    color: #ff0000;
    border: #ff0000 1px solid;
}
</style>
<script language='javascript' src='../inc/Object.js'></script>
<script language="JavaScript" src="/inc/default.js"></script>
<link rel="stylesheet" href="/css/admin.css" type="text/css">
<link rel="stylesheet" href="/css/style.css" type="text/css">
<link rel="stylesheet" href="/common/css/adm_style.css">
<link rel="stylesheet" href="/common/css/admin_style.css">

<body>
    <table width="850" border="0" align="center" cellpadding="10" cellspacing="0">
        <tr>
            <td align="center" valign="top">
                <table width="100%" border="1" cellpadding="0" cellspacing="0" frame="border or box "
                    style="border-collapse:collapse; border-color:rgb(194, 194, 194);" class='pad_10'>
                    <tr>
                        <td height="22" colspan="9" class="p_tt"><b>1. 차량정보</b></td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="f3f3f3" class="p_tt">등록일</td>
                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">차량명</td>
                        <td width="17%" height="30" align="center" bgcolor="f3f3f3" class="p_tt">차량번호</td>
                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">년식</td>
                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">연료</td>
                        <td width="13%" height="30" align="center" bgcolor="f3f3f3" class="p_tt">담당자</td>
                    </tr>
                    <!-- 샘플 -->
                    <tr>
                        <td align="center" class="p_tt">2024-02-21</td>
                        <td height="30" align="center" class="p_tt">투싼</td>
                        <td width="17%" height="30" align="center" class="p_tt">12가345</td>
                        <td height="30" align="center" class="p_tt">2019</td>
                        <td height="30" align="center" class="p_tt">디젤</td>
                        <td width="13%" height="30" align="center" class="p_tt">홍길동</td>
                    </tr>
                </table>
                <br>
                <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#626262"
                    frame="border or box " style="border-collapse:collapse; border-color:rgb(194, 194, 194);"
                    class='pad_10'>
                    <tr height=22>
                        <td colspan="9" class="p_tt"><b>2. 지급요청내역</b></td>
                    </tr>
                    <tr>
                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">NO</td>
                        <td align="center" bgcolor="f3f3f3" class="p_tt">거래처</td>
                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">은행명</td>
                        <td width="17%" height="30" align="center" bgcolor="f3f3f3" class="p_tt">계좌번호</td>
                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">예금주</td>
                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">지급내역</td>
                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">청구금액</td>
                        <td width="9%" height="30" align="center" bgcolor="f3f3f3" class="p_tt">구분</td>
                        <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">결제금액</td>
                    </tr>

                    <!-- 샘플 -->
                    <tr>
                        <td height="30" align="center" class="p_tt">1</td>
                        <td align="center" class="p_tt">거래처명 나옴</td>
                        <td height="30" align="center" class="p_tt">농협</td>
                        <td width="17%" height="30" align="center" class="p_tt">123456789</td>
                        <td height="30" align="center" class="p_tt">ㅁㅁㅁ</td>
                        <td height="30" align="center" class="p_tt">지급내역</td>
                        <td height="30" align="center" class="p_tt">500,000</td>
                        <td width="9%" height="30" align="center" class="p_tt">종결</td>
                        <td height="30" align="center" class="p_tt">500,000</td>
                    </tr>



                    <!-- ==================== -->
                    <!-- <?
                $sql2 = "select * from cardata2 where cardata_idx=$caridx order by idx";
                $result2 = mysql_query($sql2);
                $i = 1;
                while ($data2 = mysql_fetch_assoc($result2)) {
                  $grow = qrow("select bankname,banknum,bname from admcom where idx='$data2[admcom_idx]'");
                ?>
                    <tr>
                        <td width="3%" height="30" align="center"><?= $i ?></td>
                        <td width="14%" height="30" align="center"><?= $data2[company] ?></td>
                        <td width="11%" height="30" align="center"><?= $grow[0] ?></td>
                        <td height="30" align="center"><?= $grow[1] ?></td>
                        <td width="10%" height="30" align="center"><?= $grow[2] ?></td>
                        <td width="12%" height="30" align="center"><?= $data2[payinfo] ?></td>
                        <td width="13%" height="30" align="center"><?= number_format($data2[callpay]) ?></td>
                        <td height="30" align="center"><?= $gubun_arr2[$data2[cardiv]] ?></td>
                        <td width="11%" height="30" align="center">
                            <?= ($data2[paydiv] == 2) ? number_format($data2[callpay]) : 0 ?></td>
                    </tr>
                    <?
                    $totalpay1 += ($data2[paydiv] == 1) ? $data2[callpay] : 0;
                    $totalpay2 += ($data2[paydiv] == 2) ? $data2[callpay] : 0;
                    $i++;
                  } ?> -->
                    <!-- ==================== -->

                    <tr style="font-weight: 700;">
                        <td height="30" colspan="2" align="center" bgcolor="f7f7f7" class="p_tt">매입가격</td>
                        <td height="30" colspan="2" align="center" class="p_tt">500,000
                        </td>
                        <td height="30" colspan="2" align="center" bgcolor="f7f7f7" class="p_tt">청구합계액</td>
                        <td height="30" align="center" class="p_tt">
                            <font color="#3399FF">500,000</font>
                        </td>
                        <td height="30" align="center" class="p_tt">&nbsp;</td>
                        <td height="30" align="center" class="p_tt">
                            <font color="#990000">500,000</font>
                        </td>
                    </tr>
                </table>
                <br>
                <table width="850" border="1" cellpadding="0" cellspacing="0" bordercolor="#626262"
                    frame="border or box " style="border-collapse:collapse; border-color:rgb(194, 194, 194);"
                    class='pad_10'>
                    <form name="gage" method="post" action="gage_ok.php">
                        <input type="hidden" name="type" value="2">
                        <input type="hidden" name="smonth" value="01">
                        <input type="hidden" name="sday" value="31">
                        <input type="hidden" name="stoday" value="2012">
                        <tr height="22">
                            <td colspan="8" class="p_tt"><b>3. 결제내역</b></td>
                        </tr>
                        <tr class="tab_bg2" height=30>
                            <td width="3%" align="center" bgcolor="f3f3f3" class="p_tt">NO</td>
                            <td width="12%" align="center" bgcolor="f3f3f3" class="p_tt">결제일자</td>
                            <td width="20%" align="center" bgcolor="f3f3f3" class="p_tt">거래처</td>
                            <td width="9%" align="center" bgcolor="f3f3f3" class="p_tt">예금주</td>
                            <td width="9%" align="center" bgcolor="f3f3f3" class="p_tt">결제자</td>
                            <td align="center" bgcolor="f3f3f3" class="p_tt">결제통장</td>
                            <td width="15%" align="center" bgcolor="f3f3f3" class="p_tt">결제금액</td>
                            <td width="12%" align="center" bgcolor="f3f3f3" class="p_tt">관리</td>
                        </tr>


                        <tr class="tab_bg2" height=30>
                            <td width="3%" align="center" class="p_tt">1</td>
                            <td width="12%" align="center" class="p_tt">2024-02-21</td>
                            <td width="20%" align="center" class="p_tt">거래처명 나옴</td>
                            <td width="9%" align="center" class="p_tt">ㅁㅁㅁ</td>
                            <td width="9%" align="center" class="p_tt">홍길동</td>
                            <td align="center" class="p_tt">기업은행(서울지점)</td>
                            <td width="15%" align="center" class="p_tt">500,000</td>
                            <td align="center"><input type="button" value="삭제하기" class="btn-blue" style='cursor:hand'
                                    onClick="subreg('/comm/regexc.php?mode=paycancel&caridx=<?= $caridx ?>&idx2=<?= $data2[idx] ?>');opener.document.location.reload(true);">
                            </td>
                        </tr>
                        <?
            $sql2 = "select * from cardata2 where cardata_idx=$caridx and paydiv=2 order by idx";
            $result2 = mysql_query($sql2);
            $i = 1;
            while ($data2 = mysql_fetch_assoc($result2)) {
              $grow = qrow("select bankname,banknum,bname from admcom where idx='$data2[admcom_idx]'");
              $crow = qrow("select name from setting where idx='$data2[payment]'");
              $drow = qrow("select bankname,bname from admbank where idx='$data2[admbank]'");
              //echo "select name from setting where idx='$data2[payment]'";
            ?>
                        <tr height=30>
                            <td align="center"> <?= $i ?> </td>
                            <td align="center"><?= ($data2[paydate]) ? date("Y-m-d", $data2[paydate]) : "" ?></td>
                            <td align="center"><?= $data2[company] ?></td>
                            <td align="center"><?= $grow[2] ?></td>
                            <td align="center"><?= $crow[0] ?></td>
                            <td align="center"><?= $drow[0] ?>(<?= $drow[1] ?>)</td>
                            <td align="center"> <?= number_format($data2[callpay]) ?></td>
                            <td align="center"><input type="button" value="삭제하기" class="btn-blue" style='cursor:hand'
                                    onClick="subreg('/comm/regexc.php?mode=paycancel&caridx=<?= $caridx ?>&idx2=<?= $data2[idx] ?>');opener.document.location.reload(true);">
                            </td>
                        </tr>
                        <?
              $totalpay += $data2[callpay];

              $i++;
            } ?>
                        <tr height=30>
                            <td colspan="6" align="center" bgcolor="f3f3f3" class="p_tt">합계</td>
                            <td align="center">
                                <font color="#3399FF"><b>500,000</b></font>
                            </td>
                            <td align="center">&nbsp;</td>
                        </tr>
                </table>

                <br>

                <div style="width:100%; text-align:right">
                    <input type="button" value="[ 삭제하기 ]" onClick="javascript:window.close()"
                        style="font-weight:700; cursor:pointer; border:0; background-color:transparent">
                </div>

                <!-- <input type="button" value="창닫기" class="btn-gray" onClick="javascript:window.close()"> -->
                <br>
                <br>
            </td>
        </tr>
    </table>

</body>