<? include $_SERVER['DOCUMENT_ROOT'] . "/inc/header.php"; ?>
<script language="JavaScript" src="/admin/inc/default.js"></script>
<script type="text/javascript" src="/common/js/form.js"></script>

<?
$tb_name = "woojung_part";

$view_article = 15; // 한화면에 나타날 게시물의 총 개수  
if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
$start = ($page - 1) * $view_article;

$nowDate = date("YmdHi");

$href = "&wc_made=$wc_made&wc_model=$wc_model&wc_model2=$wc_model2&wc_trans=$wc_trans&wc_trans2=$wc_trans2&gubun4=$gubun4&sear4=$sear4";

$where = " wc_gubun1='2' ";
if ($wc_made) {
	$where .= " and wc_made = '$wc_made' ";
}
if ($wc_model) {
	$where .= " and wc_model='$wc_model' ";
}
if ($wc_model2) {
	$where .= " and wc_model2='$wc_model2' ";
}
if ($wc_trans) {
	$where .= " and wc_trans='$wc_trans' ";
}
if ($wc_trans2) {
	$where .= " and wc_fual='$wc_trans2' ";
}
if ($gubun4) {
	$where .= " and wc_gubun4='$gubun4' ";
}
if ($sear4) {
	$where .= " and ( wc_no  like '%$sear4%' or wc_mem_name like '%$sear4%' or wc_model  like '%$sear4%') ";
}

$qry_cnt = mysql_query("SELECT count(*) FROM woojung_part  WHERE  $where ");
$temp = mysql_fetch_row($qry_cnt);
$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	


function getImg($content)
{
	preg_match_all('/src=\"(.[^"]+)"/i', $content, $src_location);
	//print_r($src_location); 
	$pat = str_replace("src=\"", "", $src_location[0][0]);
	$pat = str_replace("\"", "", $pat);
	return $pat;
}
?>

<script>
function delete_member() {


    var j = 0;
    var obj = document.getElementsByName('check[]');
    for (var i = 0; i < obj.length; i++) {
        if (obj[i].checked == true) {
            j++;
            break;
        }
    }

    if (j == 0) {
        alert("선택된 자료가 없습니다.");
        return;
    }

    result = confirm("한번 삭제하신 자료는 복구 불가능 합니다.  \n\n정말 삭제 하시겠습니까??");
    if (result) {

        document.f.submit();
    }

}
</script>

<script language="JavaScript" src="/admin/inc/default.js"></script>
<script type="text/javascript" src="/lib/form.js"></script>
<div id="contents_basic">

    <div class="co_car_all">

        <div class="sub-visual">
            <div class="sub-text">
                <p class="catch-phrase">
                    부품차량
                </p>
                <p class="description-text">중고차/ 사고차/수출차량을  다량 보유하고 있습니다. </p>
          </div>
        </div>


        <div class="div_basic">
            <table width="100%" align="center">

                <tr>
                    <td align="center">
                        <table style="width:1200px" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td valign="top">
                                    <table style="width:1200px" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td
                                                style="border-bottom:1px solid #979797;padding-bottom:15px;padding-top: 30px;">
                                                <table style="width:1200px" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                            <div class="search-box">
                                                                <form name="cform" method="get" style="height:37px">
                                                                    <table border="0" align="right" cellpadding="0"
                                                                        cellspacing="0"
                                                                        style="padding-top:3px; border:1px solid #CCCCCC;">
                                                                        <tr>
                                                                            <td align="right" height="37"
                                                                                style="padding-right: 30px;">
                                                                                <p
                                                                                    style="float:left; margin-top : 3px;padding-left:10px;text-align: center;font-size : 1.1em;font-weight:500">
                                                                                    다양한 차종보유!! 방문을 환영합니다</p>
                                                                                <select name="wc_made"
                                                                                    onchange="document.cform.submit();"
                                                                                    class="form_select">
                                                                                    <option value="">==제조==</option>
                                                                                    <?
																					$sql = "select * from cate2 where depth='1' order by name asc ";
																					$result_made = mysql_query($sql);
																					while ($data_made = mysql_fetch_array($result_made)) {
																					?>
                                                                                    <option
                                                                                        value="<?= $data_made[idx] ?>"
                                                                                        <? if
                                                                                        ($wc_made==$data_made[idx])
                                                                                        echo "selected" ; ?>>
                                                                                        <?= $data_made[name] ?>
                                                                                    </option>
                                                                                    <?
																					}
																					?>
                                                                                </select>
                                                                                <select name="wc_model"
                                                                                    onchange="document.cform.submit();"
                                                                                    class="form_select">
                                                                                    <option value="">==모델명==</option>
                                                                                    <?
																					if ($wc_made) {
																						$sql = "select * from cate2 where code='$wc_made' and depth='2' order by name asc";
																						$result_made = mysql_query($sql);
																						while ($data_made = mysql_fetch_array($result_made)) {
																					?>
                                                                                    <option
                                                                                        value="<?= $data_made[name] ?>"
                                                                                        <? if
                                                                                        ($wc_model==$data_made[name]) {
                                                                                        echo "selected" ; } ?>>
                                                                                        <?= $data_made[name] ?>
                                                                                    </option>
                                                                                    <?
																						}
																					}
																					?>
                                                                                </select>
                                                                                <!--select name="wc_trans" onchange="document.cform.submit();" class="form_select">
																<option value="">==부품1==</option>
																	<?
																	$sql = "select * from cate3 where depth='1' order by name asc";
																	$result_made = mysql_query($sql);
																	while ($data_made = mysql_fetch_array($result_made)) {
																	?>
																	<option value="<?= $data_made[idx] ?>" <? if ($wc_trans == $data_made[idx]) echo "selected"; ?>>
																		<?= $data_made[name] ?>
																		</option>
																	<?
																	}
																	?>
															</select-->
                                                                                <input type="text" name="textfield"
                                                                                    class="form_control" />
                                                                                <input type="button" name="button2"
                                                                                    value="검색" class="imgbt1"
                                                                                    style="cursor:pointer; background-color:#e8eff7; color:#0e3b5d; border:#4e7ac1 1px solid; padding-bottom:3px; font-size:12px; height:25px; padding: 0 10px;" />
                                                                            </td>
                                                                            <!--<td width="47"  align="right"><img src="/images/s_bt.jpg" width="44" height="21" ></ td>-->
                                                                        </tr>
                                                                    </table>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5" colspan="2">
                                                <!--서브내용-->
                                                <!--center start-->
                                                <table width="1200" height="350" border="0" align="center"
                                                    cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="20%"></td>
                                                        <td width="20%"></td>
                                                        <td width="20%"></td>
                                                        <td width="20%"></td>
                                                        <td width="20%"></td>
                                                    </tr>
                                                    <tr>

                                                        <form name="f" action="proc.php" method="post">
                                                            <input type="hidden" name="mode" value="delete">
                                                            <input type="hidden" name="back_url" value="o">
                                                            <input type="hidden" name="gubun4" value="<?= $gubun4 ?>">
                                                            <input type="hidden" name="page" value="<?= $page ?>">
                                                            <?
															$kk = 1;
															$num = $total_article - (($page - 1) * $view_article) + 1;
															$query = mysql_query("SELECT * FROM woojung_part  WHERE  $where order by wc_regdate desc LIMIT $start, $view_article");
															while ($row = mysql_fetch_array($query)) {
																$car_img_arr = explode('/', $row[wc_img_1]);
																$cate1 = mysql_fetch_array(mysql_query("select * from cate2 where idx='" . $row[wc_made] . "'"));
																$cate3 = mysql_fetch_array(mysql_query("select * from cate3 where idx='" . $row[wc_trans] . "'"));
															?>

                                                            <td width="210" height="300" align="center"
                                                                style=" vertical-align:top; padding:0 20px">
                                                                <table width="200" border="0" cellpadding="0"
                                                                    cellspacing="0">

                                                                    <tr style="cursor:pointer;">
                                                                        <td valign="middle">
                                                                            <table width="185" border="0" align="center"
                                                                                cellpadding="0" cellspacing="0">
                                                                                <tr>
                                                                                    <td height="30" align="left"
                                                                                        bgcolor="#FFFFFF"><input
                                                                                            type="checkbox"
                                                                                            name="check[]" id="check[]"
                                                                                            value="<?= $row[wc_idx] ?>"
                                                                                            style="vertical-align:middle" />
                                                                                        NO : <?= $row[wc_orderno] ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" bgcolor="#FFFFFF"
                                                                                        onclick="location.href='sub08_1_view.php?wc_idx=<?= $row[wc_idx] ?>'">
                                                                                        <? if ($car_img_arr[0]) { ?>
                                                                                        <img src="../data1/<?= $car_img_arr[0] ?>"
                                                                                            width="200" height="160"
                                                                                            border="0" />
                                                                                        <? } else { ?>
                                                                                        <img src="<?= getImg($row[wc_option_add]) ?>"
                                                                                            width="200" height="160"
                                                                                            border="0" />
                                                                                        <? } ?>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                    <tr style="cursor:pointer;"
                                                                        onclick="location.href='sub08_1_view.php?wc_idx=<?= $row[wc_idx] ?>'">
                                                                        <td valign="middle" style="padding-top:5px;">
                                                                            <table width="200" align="center"
                                                                                cellpadding="2" cellspacing="0"
                                                                                style="width:200px;" border="0">
                                                                                <tr>
                                                                                    <td height="25" align="center"
                                                                                        style=" padding :5px;">
                                                                                        <? if ($row[calltype] == "1") { ?>
                                                                                        <a href
                                                                                            class="btn btn-sm btn-red btn-round">sale</a>
                                                                                        <? } else if ($row[calltype] == "2") { ?>
                                                                                        <a href
                                                                                            class="btn btn-sm btn-black btn-round">soldout</a>
                                                                                        <? } ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <!-- <tr>
                                                                                    <td height="25" align="center">
                                                                                        <strong><?= $cate3[name] ?></strong>
                                                                                    </td>
                                                                                </tr> -->
                                                                                <tr>
                                                                                    <td height="25" align="center"
                                                                                        style="font-size: 16px;font-weight:700;">

                                                                                        <?= $row['wc_mem_etc'] ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td height="25" align="center"
                                                                                        style="color: #595959; font-weight:600;">
                                                                                        <span
                                                                                            style="padding : 0 5px;"><?= $row[wc_age] ?></span>
                                                                                        ㅣ<span
                                                                                            style="padding : 0 5px;"><?= $row[wc_trans] ?></span>
                                                                                        ㅣ<span
                                                                                            style="padding : 0 5px;"><?= $row[wc_fual] ?></span>

                                                                                    </td>
                                                                                </tr>
                                                                                <!--tr>
                      <td height="25" align="center" style=" padding :10px;">
					  <? if ($row[calltype] == "1") { ?>
					  <a href class="btn btn-sm btn-red btn-round">sale</a>
					  <? } else if ($row[calltype] == "2") { ?>
					  <a href class="btn btn-sm btn-black btn-round">soldout</a>
					  <? } ?>
                      </td>
                    </tr-->
                                                                            </table>

                                                                </table>

                                                                <?
																if ($kk % 5 == 0) {
																	echo "		<tr><td colspan='5' height='1' bgcolor='#d8d8d8'></td></tr>";
																}
																$kk++;
															}
																?>
                                                        </form>
                                                    <tr>
                                                        <td colspan="5" height="1" bgcolor="#dedbde"></td>
                                                    </tr>
                                                </table>

                                                <table width="1200" border="0" align="center" cellpadding="0"
                                                    cellspacing="0">

                                                    <tr>
                                                        <td height="15" align="center">&nbsp;</td>
                                                        <td align="center">&nbsp;</td>
                                                        <td align="center">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" align="left">
                                                            <?
															if ($loginUsort == "admin" || $loginUsort == "admin1" || $loginUsort == "admin2" || $loginUsort == "superadmin" || $loginUsort == "jisajang2") {
															?>
                                                            <!--<img src="/images/d_bt.jpg" onClick="window.location='javascript:delete_member()'"/>-->
                                                            <a href="javascript:void(0);"
                                                                onclick="window.location='javascript:delete_member()'"
                                                                style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #000000; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600; ">
                                                                선택삭제
                                                            </a>
                                                            <?
															}
															?>
                                                        </td>
                                                        <td align="center">
                                                            <table width=100%>
                                                                <tr>
                                                                    <td align=center class=text> <span
                                                                            style="font-size: 12px;">
                                                                            <? include "../inc/page.php"; ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td width="20%" align="right">
                                                            <?
															if ($loginUsort == "admin" || $loginUsort == "admin1" || $loginUsort == "admin2" || $loginUsort == "superadmin" || $loginUsort == "jisajang2") {
															?>
                                                            <!-- <a href="sub08_1_write.php"><img src="/images/w_bt.jpg" /></a> -->
                                                            <a href="sub08_1_write.php"
                                                                style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #cc3535; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color: #cc3535; ">
                                                                등록하기
                                                            </a>
                                                            <?
															}
															?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="40" align="center">&nbsp;</td>
                                                        <td align="center">&nbsp;</td>
                                                        <td align="center">&nbsp;</td>
                                                    </tr>
                                                </table>
                                                <!--서브내용끝-->
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>


                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- footer -->
    <div class="cha_footer">
        <? include "../inc/bottom.php" ?>
    </div>
</div>
</body>

</html>