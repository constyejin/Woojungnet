<?

include $_SERVER['DOCUMENT_ROOT'] . '/manage/inc/header.php';

include $_SERVER['DOCUMENT_ROOT'] . '/manage/inc/top_menu.php';

include $_SERVER['DOCUMENT_ROOT'] . '/manage/inc/global.php';

$pno = 6;

?>

<?

if ($_SESSION[loginLevel] > 1) {

    echo '<script>alert("보기권한이 없습니다.");history.go(-1);</script>';

    exit;
}



$tb_name = "admcom";



$view_article = 1000; // 한화면에 나타날 게시물의 총 개수  

if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  

$start = ($page - 1) * $view_article;



//pay nopay scharge sstoketype state Search_text

$href = "&page=$page&search=$search&state=$state&scom=$scom&scharge=$scharge&sstoketype=$sstoketype&Search_text=$Search_text";

$where = " 1 ";



// 검색 단어를 입력했을때   

if ($Search_text) {

    $tmp1 = "company";
    $tmp2 = "bname";

    $where .= " and ( ($tmp1 like '%$Search_text%') or ($tmp2 like '%$Search_text%')) ";
}

$where .= " ORDER BY regdate desc";

$query = "select count(*) from $tb_name where $where ";

//echo $query;

$result = mysql_query($query, $connect);

$temp = mysql_fetch_row($result);

$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함

?>





<style type="text/css">
/* .style1 {

	color: #FFFFFF;

	font-weight: bold;

}

.style2 {font-size: 12px} */
.tableTitle {
    background-color: #8A8C9A;
    color: white;
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

				</td> -->

                    <!-- <td width="1" height="400" valign="top" style="background-color:#bbb;"></td> -->

                    <td valign="top" style='padding:10px;'>
                        <table width="1000" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto">

                            <tr>

                                <td>

                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="20%" height="42" valign="top"><img src="/manage/img/icon02.gif">
                                                위치 : <span class="pageTitleBold"> 미결/결제하기 </span> : 리스트를 클릭하시면 결제하기
                                                가능합니다</td>
                                        </tr>
                                        <tr>

                                            <td valign="top">

                                                <form name="search" method="get" action="/admin/cash.php"
                                                    style="margin-bottom:10px;">

                                                    <input type=hidden value="1" name="search">

                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">

                                                        <tr>


                                                            <td width="88%" align="right"><input name="Search_text"
                                                                    value="<?= ($Search_text) ? $Search_text : "" ?>"
                                                                    type="text" size=30>

                                                                <input name="input" type="submit" value="검색"
                                                                    class="btn_blue">
                                                            </td>

                                                        </tr>

                                                    </table>

                                                </form>

                                            </td>

                                        </tr>

                                    </table>

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#626262"
                                        frame="border or box " style="border-collapse:collapse;"
                                        class='pad_10 list-table-standard'>

                                        <tr>

                                            <td width="3%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">NO
                                            </td>

                                            <td width="13%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">
                                                거래처</td>

                                            <td width="13%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">
                                                계좌정보</td>

                                            <td width="7%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">건수
                                            </td>

                                            <td width="10%" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">
                                                미결금액합계</td>

                                        </tr>



                                        <?

                                        if ($total_article > 0) {

                                            //									$qry = "SELECT * FROM $tb_name WHERE $where LIMIT $start, $view_article";

                                            $qry = "SELECT * FROM $tb_name WHERE $where ";

                                            //echo $qry;

                                            $result = mysql_query($qry);

                                            $i = 1;

                                            while ($data2 = mysql_fetch_assoc($result)) {



                                                //										$totalcount = qrow("select count(idx) from cardata2 where admcom_idx='$data2[idx]' and paydiv=1");

                                                //echo "select sum(callpay) from cardata2 where admcom_idx='$data2[idx]' and paydiv=1; <br>";

                                                //										$sumdivpay = qrow("select sum(callpay) from cardata2 where admcom_idx='$data2[idx]' and paydiv=1");

                                                //var_dump($sumdivpay);

                                                if ($data2[compay2] > 0) {

                                                    //											$query="update admcom set compay='$totalcount[0]',compay2='$sumdivpay[0]' where idx='$data2[idx]' ";

                                                    //											mysql_query($query);

                                                    //echo "select count(idx) from cardata2 where admcom_idx='$data2[idx]' and paydiv=1 <br>";



                                        ?>

                                        <tr onblur="this.style.backgroundColor='#deecee'"
                                            onfocus="this.style.backgroundColor='#FFF'"
                                            onMouseOver="this.style.backgroundColor='#deecee'"
                                            onMouseOut="this.style.backgroundColor='#FFF'" style="cursor:hand">

                                            <td width="3%" align="center"
                                                onclick='location.href="/admin/cash_list.php?admidx=<?= $data2[idx] ?>"'>
                                                <?= $i ?></td>

                                            <td width="13%" align="center"
                                                onclick='location.href="/admin/cash_list.php?admidx=<?= $data2[idx] ?>"'>
                                                <?= $data2[company] ?></td>

                                            <td width="13%" align="center"
                                                onclick='location.href="/admin/cash_list.php?admidx=<?= $data2[idx] ?>"'>
                                                <?= $data2[bname] ?></td>

                                            <td width="7%" align="center"
                                                onclick='location.href="/admin/cash_list.php?admidx=<?= $data2[idx] ?>"'>
                                                <b>
                                                    <font color="#000000"><?= $data2[compay] ?></font>
                                                </b>
                                            </td>

                                            <td width="10%" align="center"
                                                onclick='location.href="/admin/cash_list.php?admidx=<?= $data2[idx] ?>"'>
                                                <?= number_format($data2[compay2]) ?></td>

                                        </tr>

                                        <? $i++;

                                                    $totalsumpay += $data2[compay2];
                                                }
                                            }
                                        } ?>


                                        <!-- 샘플 -->


                                        <tr onclick='location.href="/manage/Sale10/cash_list.php"' height="30"
                                            onblur="this.style.backgroundColor='#deecee'"
                                            onfocus="this.style.backgroundColor='#FFF'"
                                            onMouseOver="this.style.backgroundColor='#deecee'"
                                            onMouseOut="this.style.backgroundColor='#FFF'" style="cursor:hand">

                                            <td width="3%" align="center"> 1 </td>

                                            <td width="13%" align="center">ㅁㅁ상회</td>

                                            <td width="13%" align="center">은행 / 계좌정보 / 예금주</td>

                                            <td width="7%" align="center"><b>
                                                    <font color="#000000">2</font>
                                                </b></td>

                                            <td width="10%" align="center">100</td>
                                        </tr>

                                        <tr onclick='location.href="/manage/Sale10/cash_list.php"' height="30"
                                            onblur="this.style.backgroundColor='#deecee'"
                                            onfocus="this.style.backgroundColor='#FFF'"
                                            onMouseOver="this.style.backgroundColor='#deecee'"
                                            onMouseOut="this.style.backgroundColor='#FFF'" style="cursor:hand">

                                            <td width="3%" align="center"> 2 </td>

                                            <td width="13%" align="center"> oo상회</td>

                                            <td width="13%" align="center">은행 / 계좌정보 / 예금주</td>

                                            <td width="7%" align="center"><b>
                                                    <font color="#000000">1</font>
                                                </b></td>

                                            <td width="10%" align="center">100,000</td>

                                        </tr>








                                        <tr height="30">

                                            <td colspan="4" align="center" bgcolor="f3f3f3" class="p_tt table-th-dark">
                                                <b>합 계</b>
                                            </td>

                                            <td align="center">
                                                <font color="#3399FF"><b>100,100</font>
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