<?
$mod_sub=sql_fetch("select * from image_sub where sub_type='menu' and sub_menu='회사소개' "); 
$category_menu=sql_list("select * from category where cate_type1='화물차' order by cate_list asc ");
$category_menu2=sql_list("select * from category where cate_type1='캠핑카' order by cate_list asc ");
?>
  <nav class="gnb<?=$is_main!='ok'?' bg-color-white bg-on':''?>">
    <h1>
      <a href="/">
        <img src="/front/src/image/icon_logo.png" alt="나르미 로고">
      </a>
    </h1>
    <div class="suffix">
      <ul class="depth-1">
        <li>
          <a href="/menu01/sub01.php" class="">회사소개</a>
          <div class="depth-2">
            <div class="introduce">
              <div class="description">
                <span class="title">회사소개</span>
                <a href="/menu01/sub01.php" class="icon-arrow"></a>
                <p class="descript-phrase">
                  나르미모터스 회사소개
                </p>
              </div>
              <div class="img-wrap">
			  <? if($mod_sub[sub_file]){ ?>
                <img src="/images/img/<?=$mod_sub[sub_file]?>" alt="카테고리 이미지">
			  <? } ?>
              </div>
            </div>
            <ul>
              <li>
                <a href="/menu01/sub01.php"><span>인사말</span></a>
              </li>
              <li>
                <a href="/menu01/sub02.php"><span>오시는 길</span></a>
              </li>
            </ul>
          </div>
        </li>
  <? $mod_sub=sql_fetch("select * from image_sub where sub_type='menu' and sub_menu='화물차' "); ?>
        <li>
          <a href="/menu02/sub01.php">화물차</a>
          <div class="depth-2">
            <div class="introduce">
              <div class="description">
                <span class="title">화물차</span>
                <a href="" class="icon-arrow"></a>
                <p class="descript-phrase">
                  화물차제품라인업
                </p>
              </div>
              <div class="img-wrap">
			  <? if($mod_sub[sub_file]){ ?>
                <img src="/images/img/<?=$mod_sub[sub_file]?>" alt="카테고리 이미지">
			  <? } ?>
              </div>
            </div>
            <ul>
<? for($i=0;$i<count($category_menu);$i++){ ?>
              <li>
                <a href="/menu02/sub01.php?st=<?=$category_menu[$i][idx]?>"><span><?=$category_menu[$i][cate_type2]?></span></a>
              </li>
<? } ?>
            </ul>
          </div>
        </li>
  <? $mod_sub=sql_fetch("select * from image_sub where sub_type='menu' and sub_menu='캠핑카' "); ?>
        <li>
          <a href="/menu03/sub01.php">캠핑카</a>
          <div class="depth-2">
            <div class="introduce">
              <div class="description">
                <span class="title">캠핑카</span>
                <a href="" class="icon-arrow"></a>
                <p class="descript-phrase">
                  캠핑카제품라인업
                </p>
              </div>
              <div class="img-wrap">
			  <? if($mod_sub[sub_file]){ ?>
                <img src="/images/img/<?=$mod_sub[sub_file]?>" alt="카테고리 이미지">
			  <? } ?>
              </div>
            </div>
            <ul>
<? for($i=0;$i<count($category_menu2);$i++){ ?>
              <li>
                <a href="/menu03/sub01.php?st=<?=$category_menu2[$i][idx]?>"><span><?=$category_menu2[$i][cate_type2]?></span></a>
              </li>
<? } ?>
            </ul>
          </div>
        </li>
  <? $mod_sub=sql_fetch("select * from image_sub where sub_type='menu' and sub_menu='출고차량' "); ?>
        <li>
          <a href="/menu04/sub01.php">출고차량</a>
          <div class="depth-2">
            <div class="introduce">
              <div class="description">
                <span class="title">출고차량</span>
                <a href="" class="icon-arrow"></a>
                <p class="descript-phrase">
                  출고사례 & 제품갤러리
                </p>
              </div>
              <div class="img-wrap">
			  <? if($mod_sub[sub_file]){ ?>
                <img src="/images/img/<?=$mod_sub[sub_file]?>" alt="카테고리 이미지">
			  <? } ?>
              </div>
            </div>
            <ul>
              <li>
                <a href="/menu04/sub01.php"><span>출고차량</span></a>
              </li>
            </ul>
          </div>
        </li>
  <? $mod_sub=sql_fetch("select * from image_sub where sub_type='menu' and sub_menu='부품구매' "); ?>
        <li>
          <a href="/menu05/sub01.php">부품구매</a>
          <div class="depth-2">
            <div class="introduce">
              <div class="description">
                <span class="title">부품구매</span>
                <a href="" class="icon-arrow"></a>
                <p class="descript-phrase">
                  나르미모터스 부품구매
                </p>
              </div>
              <div class="img-wrap">
			  <? if($mod_sub[sub_file]){ ?>
                <img src="/images/img/<?=$mod_sub[sub_file]?>" alt="카테고리 이미지">
			  <? } ?>
              </div>
            </div>
            <ul>
              <li>
                <a href="/menu05/sub01.php"><span>부품구매</span></a>
              </li>
            </ul>
          </div>
        </li>
  <? $mod_sub=sql_fetch("select * from image_sub where sub_type='menu' and sub_menu='고객센터' "); ?>
        <li>
          <a href="/menu06/sub01.php">고객센터</a>
          <div class="depth-2">
            <div class="introduce">
              <div class="description">
                <span class="title">고객센터</span>
                <a href="" class="icon-arrow"></a>
                <p class="descript-phrase">
                  공지사항 & 1:1문의사항
                </p>
              </div>
              <div class="img-wrap">
			  <? if($mod_sub[sub_file]){ ?>
                <img src="/images/img/<?=$mod_sub[sub_file]?>" alt="카테고리 이미지">
			  <? } ?>
              </div>
            </div>
            <ul>
              <li>
                <a href="/menu06/sub01.php"><span>공지사항</span></a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <a href="" class="btn-menu bg-color-white">
    <div class="hamburger-toggle">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
  </a>
  <div class="megadrop">
    <div class="header">
      <img src="/front/src/image/icon_logo_megadrop.png" alt="">
    </div>
    <div class="sitemap">
      <ul>
        <li>
          <span class="title">회사소개</span>
          <ul class="depth-2">
            <li>
              <a href="/menu01/sub01.php">인사말</a>
            </li>
            <li>
              <a href="/menu01/sub02.php">오시는 길</a>
            </li>
          </ul>
        </li>
        <li>
          <span class="title">화물차</span>
          <ul class="depth-2">
<? for($i=0;$i<count($category_menu);$i++){ ?>
              <li>
                <a href="/menu02/sub01.php?st=<?=$category_menu[$i][idx]?>"><span><?=$category_menu[$i][cate_type2]?></span></a>
              </li>
<? } ?>
          </ul>
        </li>
        <li>
          <span class="title">캠핑카</span>
          <ul class="depth-2">
<? for($i=0;$i<count($category_menu2);$i++){ ?>
              <li>
                <a href="/menu03/sub01.php?st=<?=$category_menu2[$i][idx]?>"><span><?=$category_menu2[$i][cate_type2]?></span></a>
              </li>
<? } ?>
          </ul>
        </li>
        <li>
          <span class="title">출고차량</span>
          <ul class="depth-2">
            <li>
              <a href="/menu04/sub01.php">출고차량</a>
            </li>
          </ul>
        </li>
        <li>
          <span class="title">부품구매</span>
          <ul class="depth-2">
            <li>
              <a href="/menu05/sub01.php">부품구매</a>
            </li>
          </ul>
        </li>
        <li>
          <span class="title">고객센터</span>
          <ul class="depth-2">
            <li>
              <a href="/menu06/sub01.php">공지사항</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="cs-center">
      <p class="title">CS CENTER</p>
      <ul>
        <li>· 대표 ☎ 1588-1277</li>
        <li>· FAX : 02-794-3300</li>
        <li>· E-mail : account@narmimotors.com</li>
        <li> 
		<? if($_SESSION[login_idx]){ ?>
		<a href="/manage/menu01/sub01.php">[관리자모드]</a>
		<a href="/member/logout.php">[로그아웃]</a>
		<? }else { ?>
		<a href="/member/login.php">[로그인]</a>
		<? } ?>
		</li>
      </ul>
    </div>
  </div> 
