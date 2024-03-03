<?

include $_SERVER['DOCUMENT_ROOT'] . "/inc/header.php";

?>

<? include "inc/popup.php" ?>



<!-- main visual -->

<div class="main-visual swiper">

    <ul class="swiper-wrapper">

        <?

        $sql = "select * from home_main where type='1' and view='Y' order by list_num asc";

        $result = mysql_query($sql);

        while ($data = mysql_fetch_array($result)) {

        ?>

            <li class="swiper-slide">

                <img src="/mainimg/<?= $data[imgfile] ?>" alt="메인비주얼">

            </li>

        <?

            $k++;

        }

        ?>

    </ul>



    <!-- 독립 css -->

    <style type="text/css">

        .intro_txt_box {

            max-width: 800px;

            width: 1000px;

            height: 250px;

            position: absoulte;

            top: 400px;

            left: 400px;

            z-index: 1;

        }



        .main-text {

            width: 700px !important;

        }

    </style>

    <div class="intro_txt_area">

        <div class="intro_txt_box"">

      <div class=" main-text">

            <p class="catch-phrase">

                보험사잔존물경공매!! 매매!! 부품수출!!<br>
                (주)태금모터스 에서 입찰경매를 시작하세요

            </p>

            <p class="sub-text">

                보험사잔존물,사고차, 매매, 가치평가! 신속하고 공정하게 안전한서비스를 제공합니다.

            </p>

        </div>

    </div>

</div>





</div>

<!-- //main visual -->

<!-- contents -->

<div id="contents_basic">

    <!-- <div class="notice-banner">

          <div class="container">

            <div class="notice">

              <span class="header">

                공지사항

              </span>

              <div class="notice-item">

                <a href="" class="title">공지사항입니다.</a>

                <span class="date">

                  2022-12-31

                </span>

              </div>

            </div>

            <div class="btn-wrap">

              <a href="" class="btn-more">+ 더보기</a>

            </div>

          </div>

        </div> -->

    <!-- 1:자동차리스트 -->

    <div class="co_car_all">

        <div class="co_car_tit">

            <div class="co_car_area">

                <div class="ctit">오늘의 경공매차량</div>

                <div class="view"><a href="/sub02/sub02_1.php"><span>+</span>더보기</a></div>

            </div>

        </div>

    </div>

    <div class="co_car_list for-sale">



        <!-- 각 차량 -->

        <?

        $member_new = mysql_fetch_array(mysql_query("select * from woojung_member where idx='$_SESSION[cookie_user_no]'"));

        $nowDate = date("YmdHi");

        $where = " wc_gubun4='2' ";

        $where .= " and concat(REPLACE (c.wc_go_end_date, '-', ''), wc_go_end_hh , wc_go_end_mm) >= '$nowDate' ";



        $qry_cnt = mysql_query("SELECT count(*) FROM woojung_car as a left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx  WHERE  $where ");

        $temp = mysql_fetch_row($qry_cnt);

        $total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	



        $query = mysql_query("SELECT * FROM woojung_car as a left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx  WHERE  $where order by concat(REPLACE (c.wc_go_end_date, '-', ''), wc_go_end_hh , wc_go_end_mm) asc LIMIT 0,5");

        $kk = 1;

        while ($row = mysql_fetch_object($query)) {

            if ($row->wc_go_type == 2) {

                $p_img = "<img src='/img/sub/btn_04.jpg'>";

            } else if ($row->wc_go_type == 1) {

                $p_img = "<img src='/img/sub/btn_05.jpg'>";

            }

            $car_img_arr = explode('/', $row->wc_img_1);

            $site_u = mysql_fetch_array(mysql_query("select * from recruit as a left join woojung_member as b on a.code=b.code left join woojung_car as c on b.userId=c.wc_mem_id where c.wc_idx='" . $row->wc_idx . "' "));



            $year      = cutStr($row->wc_go_end_date, 0, 4);

            $month      = cutStr($row->wc_go_end_date, 5, 2);

            $day      = cutStr($row->wc_go_end_date, 8, 2);

            $hour      = $row->wc_go_end_hh;

            $min      = $row->wc_go_end_mm;

            $last_end_date = $year . '-' . $month . '-' . $day . ' [' . $hour . ':' . $min . ']';

            if ($row->wc_go_type == "1") {

                if ($member_new[power] == "1" || $member_new[power] == "3") {

                    $onc = "auctionView('$row->wc_idx');";

                } else {

                    $onc = "alert('입찰권한이 없습니다. 운영자에게 문의하세요');";

                }

            } else if ($row->wc_go_type == "2") {

                if ($member_new[power] == "2" || $member_new[power] == "3") {

                    $onc = "auctionView('$row->wc_idx');";

                } else {

                    $onc = "alert('입찰권한이 없습니다. 운영자에게 문의하세요');";

                }

            } else if ($row->wc_go_type == "3") {

                if ($member_new[power] == "1" || $member_new[power] == "3") {

                    $onc = "auctionView('$row->wc_idx');";

                } else {

                    $onc = "alert('입찰권한이 없습니다. 운영자에게 문의하세요');";

                }

            }

            if ($loginUsort == "admin" || $loginUsort == "superadmin") {

                $onc = "auctionView('$row->wc_idx');";

            }



            if ($row->wc_go_cost_type == "2") { // 낙찰자 부담일 경우만 금액 적어준다

                $wc_go_cost = $row->wc_go_cost;

                $total_amt = $row->wc_go_cost;

            } else {

                $wc_go_cost = 0;

                $total_amt = 0;

            }

        ?>

            <div class="carbox" onclick="<?= $onc ?>">

                <div class="image-wrap">

                    <img src="/data/<?= $car_img_arr[0] ?>" alt="챠량이미지">

                </div>

                <div class="area_h">

                    <button>

                        <span>

                            <?

                            $sql = "select * from car_zzim where no='" . $row->wc_idx . "' and userid='" . $loginId . "'";

                            $que = mysql_query($sql);

                            $rowZim = mysql_fetch_array($que);

                            if (!$rowZim[idx]) {

                            ?>

                                <i class="ico_carheart" onclick="zzim('<?= $row->wc_idx ?>')"></i>

                            <? } else { ?>

                                <i class="ico_carheart on" onclick="zzim2('<?= $row->wc_idx ?>')"></i>

                            <? } ?>

                            <!--

                        description

                        아이콘 클래스에 'on'을 붙이면 빨간색 하트 아이콘 노출

                      -->

                        </span>

                    </button>

                    <div class="ct_c"><?= $row->evalAmt_type ?></div>

                    <div class="ct_r">

                        <? WriteArrHTML('radio', 'Arrgubun2', $ArrgoSale, $row->wc_go_type, '', '', 'direct', ''); ?>

                    </div>

                </div>

                <div class="number">

                    <div class="n_tit"><?= $row->wc_orderno ?></div>

                    <div class="n_tit"><span>

                            <? WriteArrHTML('select', 'gubun3', ${"Arrgubun3_" . $row->wc_gubun2}, $row->wc_gubun3, '', '', 'direct', ''); ?>

                        </span></div>

                </div>



                <div class="carname">

                    <div class="c_model">

                        <? if ($row->wc_model) echo $row->wc_model; ?>

                        <? if ($row->wc_model2) echo $row->wc_model2; ?>

                    </div>

                    <p>

                        <span>

                            <? if ($row->wc_age) ?><?= substr($row->wc_age, 0, 4) ?>-<?= substr($row->wc_age, 4, 2) ?>

                        </span>

                        |<span><?= $row->wc_mem_name == "동부" ? $row->trans_dong : $row->wc_trans ?></span>

                        |<span><?= $row->wc_mem_name == "동부" ? $row->fual_dong : $row->wc_fual ?></span>

                    </p>

                </div>

                <div class="carcheck">

                    <p><span>보관 : </span>

                        <?

                        if ($row->wc_keep_area2) {

                            $keep_area = WriteArrHTML('select', 'area1', $ArrcarPlace, $row->wc_keep_area2, '', '', 'direct', '');

                        } else {

                            $keep_area = WriteArrHTML('select', 'area1', $ArrcarPlace, $row->wc_keep_area1, '', '', 'direct', '');

                        }

                        ?>

                    </p>

                    <p><span>마감 : </span> <strong><?= $last_end_date ?></strong></p>

                </div>

            </div>

        <?

            $kk++;

        }

        ?>

        <!-- //각 차량 끝 -->



    </div>

    <!-- //1:자동차리스트 -->



    <!-- 1-2:내수/수출 자동차리스트 -->

    <div class="co_car_all">

        <div class="co_car_tit">

            <div class="co_car_area">

                <div class="ctit">중고차ㅣ보유차량(직접방문환영!!)</div>

                <div class="view"><a href="/sub08/sub08_1.php"><span>+</span>더보기</a></div>

            </div>

        </div>

    </div>

    <div class="co_car_list for-sale">



        <!-- 각 차량 -->

        <?

        $query = mysql_query("SELECT * FROM woojung_part  WHERE  1 order by wc_regdate desc LIMIT 0, 5");

        while ($row = mysql_fetch_array($query)) {

            $car_img_arr = explode('/', $row[wc_img_1]);

            if ($row[wc_gubun1] == "1") {

                $img_fol = "data2";

            } else if ($row[wc_gubun1] == "2") {

                $img_fol = "data1";

            }

        ?>

            <div class="carbox" onclick="location.href='/sub08/sub08_1_view.php?wc_idx=<?= $row[wc_idx] ?>'">

                <div class="image-wrap">

                    <img src="../<?= $img_fol ?>/<?= $car_img_arr[0] ?>" alt="챠량이미지">

                </div>

                <div class="carname">

                    <div class="c_model">

                        <!-- 르노삼성 /  르노삼성 -->

                        <?= $row['wc_mem_etc'] ?>

                    </div>

                    <p>

                        <span><?= $row[wc_age] ?></span>

                        |<span><?= $row[wc_trans] ?></span>

                        |<span><?= $row[wc_fual] ?></span>

                    </p>

                </div>

                <div class="btn-group">

                    <? if ($row[calltype] == "1") { ?>

                        <a href class="btn btn-sm btn-red btn-round">sale</a>

                    <? } else if ($row[calltype] == "2") { ?>

                        <a href class="btn btn-sm btn-black btn-round">soldout</a>

                    <? } ?>

                </div>

            </div>

        <? } ?>

        <!-- //각 차량 끝 -->



    </div>

    <!-- //1-2:내수/수출 자동차리스트 -->



    <!-- 2:배너영역 -->

    <div class="main-half-banner">

        <div class="banner">

            <p class="title">입찰회원(경매입찰)을 모십니다!!</p>

            <p class="sub-text">PC버전과 모바일웹을 이용하여 365일 언제 어디서나 경매입찰에 참여할수 있습니다.</p>

            <a href="/login/terms.php" class="btn btn-round btn-white link">

                <span class="label">입찰회원가입신청</span><span class="icon-arrow-half"></span>

            </a>

        </div>

        <div class="banner">

            <p class="title">가치평가 및 내차 팔기</p>

            <p class="sub-text">손상, 사고, 폐차 상태인 자동차를 믿고 맡겨 주십시요.

                높은 가격으로 신속, 정확히 매각 할 수 있습니다.</p>



            <? if ($loginId) { ?>

                <a href="/sub01/sub01_1.php" class="btn btn-round btn-white link">



                <? } else { ?>

                    <a href="javascript:alert('로그인후 사용 가능합니다.');location.href='/login/login.php';" class="btn btn-round btn-white link">



                    <? } ?>



                    <span class="label">차량등록및상담</span><span class="icon-arrow-half"></span>

                    </a>

        </div>

    </div>

    <!-- //2:배너영역 -->

    <!-- 3:서비스영역 -->

    <!--div class="co_car_ser">

            <div class="ser_tit">인카온 경공매온라인서비스와  함께 하시면 국내 보험사의 입찰차량을 만날 수 있습니다.</div>

            <div class="inform">

                <div class="in_box">

                    <span class="img-wrap"><img src="/images/front/img_banner_small_01.jpg" alt=""></span>

                    <div class="in_tit">전문가의 정확한 판단</div>

                    <p>내 차량에 대한 가치평가<br>차량전문가가 신속,정확하게<br>평가 진단하여 드립니다.</p>

                </div>

                <div class="in_box">

                    <span class="img-wrap"><img src="/images/front/img_banner_small_02.jpg" alt=""></span>

                    <div class="in_tit">국내 보험사잔존물 입찰</div>

                    <p>보험사잔존물 매각물건을<br>인카온에서 입찰과 낙찰을<br>진행할 수 있습니다.</p>

                </div>

                <div class="in_box">

                    <span class="img-wrap"><img src="/images/front/img_banner_small_03.jpg" alt=""></span>

                    <div class="in_tit">경공매 온라인서비스</div>

                    <p>매각물건에 대하여 투명하고<br>공정하게 회원사에 대한 원활한<br>소통을 제공합니다.</p>

                </div>

                <div class="in_box">

                    <span class="img-wrap"><img src="/images/front/img_banner_small_04.jpg" alt=""></span>

                    <div class="in_tit">신속! 정확! 안전한서비스</div>

                    <p>매각물건에 대한 정확한 정보를<br>신속하고 정확하게 확인하여<br>회원사분들께  제공합니다.</p>

                </div>

            </div>

        </div-->

    <!-- //3:서비스영역 -->

    <!-- 4:고객센터영역 -->

    <div class="co_car_cus">

        <div class="ccus_box">

            <div class="ccus_tit">고객센터 <span>Customer Service</span></div>

            <div class="ccus_tel"><span>TEL.</span>031-278-6111</div>

            <div class="ccus_tel"><span>Fax.</span>031-278-6112</div>

            <p class="ccus_time"><span>평일 09:00 ~ 18:00</span><span>주말 및 공휴일 휴무</span></p>

        </div>

        <div class="ccus_box">

            <div class="ccus_tit">

                <div class="n_tit">공지사항</div>

                <div class="n_view"><a href="/board/board.php?id=notice">+ 더보기</a></div>

            </div>



            <ul class="ccus_notice">

                <?

                $n_query = mysql_query("SELECT * FROM notice where bdiv='0'  order by no  desc  LIMIT 4");

                while ($n_row = mysql_fetch_object($n_query)) {

                ?>

                    <li><a href="/board/board.php?id=notice&mode=view&no=<?= $n_row->no ?>"><?= str_cut($n_row->subject, 27) ?></a>

                    </li>

                <?

                }

                ?>

            </ul>

        </div>

        <div class="ccus_box">

            <div class="ccus_tit">

                <div class="n_tit">자료실</div>

                <div class="n_view"><a href="/board/board.php?id=data">+ 더보기</a></div>

            </div>

            <ul class="ccus_notice">

                <ul class="ccus_notice">

                    <?

                    $n_query = mysql_query("SELECT * FROM data where bdiv='0'  order by no  desc  LIMIT 4");

                    while ($n_row = mysql_fetch_object($n_query)) {

                    ?>

                        <li><a href="/board/board.php?id=data&mode=view&no=<?= $n_row->no ?>"><?= str_cut($n_row->subject, 27) ?></a>

                        </li>

                    <?

                    }

                    ?>

                </ul>

            </ul>

        </div>

    </div>

    <!-- //4:고객센터영역 -->

</div>

<!-- contents -->



<!-- footer -->

<div class="cha_footer">

    <? include "./inc/bottom.php" ?>

</div>



<!--레이어팝업-->

<!--//레이어팝업-->





<script type="text/javascript">

    function auctionView(idx) {

        window.location.href = "/sub02/sub02_1_view.php?idx=" + idx;

    }



    function zzim(idx) {

        var f = document.signform;

        f.no.value = idx;

        f.target = "hiddenframe";

        f.action = "/inc/myzzim.php";

        f.submit();

    }



    function zzim2(idx) {

        var f = document.signform;

        f.no.value = idx;

        f.target = "hiddenframe";

        f.action = "/inc/myzzimDel.php";

        f.submit();

    }

</script>

<iframe name="HiddenFrm" style="display:none;"></iframe>

<iframe name="hiddenframe" style="display:none;"></iframe>

<form name="signform" method="post">

    <input type="hidden" name="no" value="">

    <input type="hidden" name="userid" value="drg1038">

</form>

</div>

</body>



</html>