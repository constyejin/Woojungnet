<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/header.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/menu.php";

$tb_name = "woojung_part";

if (!$page) $page = 1; //초기 페이지 설정
$nperpage = 10;
$nperblock = 10;

$nowDate = date("YmdHi");

$qcommon = "&wc_made=$wc_made&wc_model=$wc_model&wc_model2=$wc_model2&wc_trans=$wc_trans&wc_trans2=$wc_trans2&gubun4=$gubun4&sear4=$sear4";

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
$trecord = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	

$tpage = ceil($trecord / $nperpage); //전체페이지
// 출력 레코드 범위
if ($trecord == 0) {
	$first = 0;
	$last = 0;
} else {
	$first = $nperpage * ($page - 1);
	$last = $nperpage * $page;
}
$article_num = $trecord - $nperpage * ($page - 1); //가상번호 설정
// 각 페이지로 직접 이동할 수 있는 페이지 링크에 대한 설정을 한다.
$tblock = ceil($tpage / $nperblock);
$block = ceil($page / $nperblock);
$first_page = ($block - 1) * $nperblock;
$last_page = $block * $nperblock;
if ($tblock <= $block) {
	$last_page = $tpage;
}

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
function allDel() {
    var fobj = document.frmdel;
    var obj = document.getElementsByName('chk[]');
    var k = 0;
    for (var i = 0; i < obj.length; i++) {
        if (obj[i].checked == true) {
            k++;
            break;
        }
    }

    if (k > 0) {
        if (confirm("선택된 게시물들을 모두 삭제 하시겠습니까?")) {
            fobj.action = "proc.php";
            fobj.submit();
        }
        return false;
    } else {
        alert("선택된 게시물이 없습니다.");
        return false;
    }
}

function allcancel() {
    var obj = document.getElementsByName('chk[]');
    for (var i = 0; i < obj.length; i++) {
        obj[i].checked = false;
    }
}
</script>

<section class="title-wrap">
    <h2>부품차량</h2>
</section>
<section class="filter-wrap">
    <form name="cform" method="get" style="height:37px">
        <div class="filter parts-sale">
            <ul>
                <li>
                    <select name="wc_made" onchange="document.cform.submit();">
                        <option value="">==제조==</option>
                        <?
						$sql = "select * from cate2 where depth='1' order by name asc ";
						$result_made = mysql_query($sql);
						while ($data_made = mysql_fetch_array($result_made)) {
						?>
                        <option value="<?= $data_made[idx] ?>" <? if ($wc_made==$data_made[idx]) echo "selected" ; ?>>
                            <?= $data_made[name] ?>
                        </option>
                        <?
						}
						?>
                    </select>
                </li>
                <li>
                    <select name="wc_model" onchange="document.cform.submit();">
                        <option value="">==모델명==</option>
                        <?
						if ($wc_made) {
							$sql = "select * from cate2 where code='$wc_made' and depth='2' order by name asc";
							$result_made = mysql_query($sql);
							while ($data_made = mysql_fetch_array($result_made)) {
						?>
                        <option value="<?= $data_made[name] ?>" <? if ($wc_model==$data_made[name]) { echo "selected" ;
                            } ?>>
                            <?= $data_made[name] ?>
                        </option>
                        <?
							}
						}
						?>
                    </select>
                </li>
                <li>
                    <div class="search-input-wrap">
                        <input type="text" name="textfield" class="search-input">
                        <button class="btn-search">
                            <img src="<?= $site_u[home_url] ?>/images/front/icon_search.png" alt="검색아이콘">
                        </button>
                    </div>
                </li>
            </ul>
        </div>
    </form>
</section>

<section class="parts-list-wrap">
    <form name="frmdel" method="post">
        <input type="hidden" name="mode" value="delete">
        <input type="hidden" name="back_url" value="o">
        <input type="hidden" name="gubun4" value="<?= $gubun4 ?>">
        <input type="hidden" name="page" value="<?= $page ?>">
        <div class="parts-list">
            <ul>
                <?
				$kk = 1;
				$num = $total_article - (($page - 1) * $nperpage) + 1;
				$query = mysql_query("SELECT * FROM woojung_part  WHERE  $where order by wc_regdate desc LIMIT $first, $nperpage");
				while ($row = mysql_fetch_array($query)) {
					$car_img_arr = explode('/', $row[wc_img_1]);
					$cate1 = mysql_fetch_array(mysql_query("select * from cate2 where idx='" . $row[wc_made] . "'"));
					$cate3 = mysql_fetch_array(mysql_query("select * from cate3 where idx='" . $row[wc_trans] . "'"));
					if (file_exists($_SERVER[DOCUMENT_ROOT] . "/data1/" . $car_img_arr[0])) {
						copy($_SERVER[DOCUMENT_ROOT] . "/data1/" . $car_img_arr[0], "../../data1/" . $car_img_arr[0]);
					}
				?>
                <li>
                    <div class="carbox" style="border:0">
                        <div class="topper">
                            <!-- <div class="checkbox-wrap">
                                <input type="checkbox" name='chk[]' value="<?= $row[wc_idx] ?>">
                            </div> -->
                            <span class="item-id">
                                <?= $row[wc_orderno] ?>
                            </span>
                        </div>
                        <div class="image-wrap"
                            onclick="window.location='./sub08_1_view.php?wc_idx=<?= $row[wc_idx] ?>'">
                            <img src="<?= $site_u[home_url] ?>/data1/<?= $car_img_arr[0] ?>" alt="챠량이미지">
                        </div>
                        <div style="text-align: center; padding-top: 5px; transform:scale(0.8)">
                            <? if ($row[calltype] == "1") { ?>
                            <a href="" class="btn btn-sm btn-red btn-round">sale</a>
                            <? } else if ($row[calltype] == "2") { ?>
                            <a href="" class="btn btn-sm btn-black btn-round">sold out</a>
                            <? } ?>
                        </div>
                        <div class="detail-info-list" style="text-align: center"
                            onclick=" window.location='./sub08_1_view.php?wc_idx=<?= $row[wc_idx] ?>'">
                            <span
                                style=" padding : 0 5px; white-space:normal; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden"><?= $row['wc_mem_etc'] ?></span>
                        </div>
                    </div>
                </li>
                <?
					$kk++;
				}
				?>

            </ul>
        </div>
    </form>


    <div class="pagination">
        <div class="prev-wrap">
            <? list_number(); ?>
        </div>
    </div>
</section>
<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/footer.php";
?>
<?
function list_number()
{

	global $page, $qcommon, $first_page, $nperblock, $direct_page, $block, $last_page, $tblock, $tpage;

	// 첫번째 블록에 대한 링크
	if ($block > 1 && $tblock > 2) {
		echo "<a href=\"$PHP_SELF?$qcommon&page=1\" class=\"first disabled\">&lt;&lt;</a>";
	}


	// 이전블록에 대한 링크
	if ($block > 1) {
		$imsi = $page;
		$page = $first_page;
		echo "<a href=\"$PHP_SELF?$qcommon&page=$page\" class=\"prev disabled\">&lt;</a>";
		$page = $imsi;
	}

	echo '</div>
          <ul class="pages">
            <li>';

	// 페이지이동(블록내)

	for ($direct_page = $first_page + 1; $direct_page <= $last_page; $direct_page++) {
		if ($page == $direct_page) {
			echo "<a href=\"#\" class=\"current\">$direct_page</a>";
		} else {
			echo "<a href=\"$PHP_SELF?$qcommon&page=$direct_page\">$direct_page</a>";
		}
	}
	//$list_bottom=str_replace("[number]",$tmp_list_bottom,$list_bottom);


	echo '</li>
          </ul>
          <div class="next-wrap">';

	// 다음블록에 대한 링크

	if ($block < $tblock) {
		$page = $last_page + 1;
		echo "<a href=\"$PHP_SELF?$qcommon&page=$page\" class=\"next\">&gt;</a>";
	}

	//마지막 블록에 대한 링크
	if ($block < $tblock && $tblock > 2) {
		$final_page = ($tblock * 10) - 9;
		echo "&nbsp;&nbsp;&nbsp;<a href=\"$PHP_SELF?$qcommon&page=$final_page\" class=\"last\">>&gt;>&gt;</a>";
	}
}
?>
</body>

</html>