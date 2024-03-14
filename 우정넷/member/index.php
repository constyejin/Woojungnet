<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";?>
  <div class="gnb">
    <div class="container">
      <div class="prefix">
        <h1><a href="/">우정넷 WOOJUNGNET</a></h1>
      </div>
      <div class="suffix">
        <? if($_SESSION[user_id]){ ?>
                <a href="/admin/sub04/sub01.php" class="btn-manage">관리자모드</a>
        <? } ?>
        <? if($_SESSION[user_id]){ ?>
                <span class="user"><?=$_SESSION[user_name]?>님</span>
        <? } ?>
          <ul class="links">
          <li><a href="/sub05/">견적문의</a></li>
        <? if($_SESSION[user_id]){ ?>
          <li><a href="/member/logout.php">로그아웃</a></li>
        <? }else{ ?>
           <li><a href="/member/login.php">로그인</a></li>
        <? } ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="header">
    <div class="main-visaul">
      <img src="./img/main1.png" alt="???? ??????? ?????">
    </div>
    <div class="nav">
      <ul>
        <li class="on"><a href="">우정넷</a></li>
        <li><a href="">홈페이지제작</a></li>
        <li><a href="">유지보수</a></li>
        <li><a href="">웹호스팅</a></li>
        <li>언제든지 연락주세요 1899-3840 / 02-2601-6569</li>
      </ul>
    </div>
  </div>

  <div class="content">
    <div class="container">
      <h2>PORTFOLIO</h2>
      <p class="sub-phrase">기업(고객)의 입장에서 최상의 맞춤서비스와 최고의 퀄리티로 최선을 다하겠습니다</p>
      <div class="portfolio-list">
        <ul>
          <?
          if($_GET[page] && $_GET[page] > 0){
              $page = $_GET[page];
          }else{
              $page = 1;
          }
          $page_row = 20;
          $page_scale = 10;
          $paging_str = "";

          $wh=" portfolio='1' ";

          $sql = "select count(*) as cnt from user where $wh ";
          $total_count = sql_total($sql);
          $paging_str = paging2($page, $page_row, $page_scale, $total_count,$_SERVER['PHP_SELF']."?"."sear=".$sear."&lev=$_GET[lev]&");
          $from_record = ($page - 1) * $page_row;

          $sql="select * from user where $wh order by op_date desc,regdate desc limit $from_record , $page_row";
          $result=sql_query($sql);
          $i=$page_row*($page-1);
          $k=0;
          while($data=mysql_fetch_array($result)){
          ?>
          <li>
            <a href="http://<?=$data[domain]?>">
              <img src="/images/portfolio/<?=$data[p_file]?>" alt="?????????1 ?????">
			      	<?=$data[com_name]?>
              <div class="dim">
                <span class="text"><?=$data[com_name]?></span>
                <span class="icon-home"></span>
                <span>바로가기</span>
              </div>
            </a>
          </li>
          <?
            $k++;
          }
          ?>
        </ul>

      </div>
      <div class="pagination">
    	  <?=$paging_str?>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
        <? if($_SESSION[user_id]){ ?>
      <p onclick="location.href='/admin/sub04/sub01.php';">[관리자모드]</p>
        <? } ?>
      <div class="logo">
        <h1>
          <span>우정넷</span>
          <span>WOOJUNGNET</span>
        <? if($_SESSION[user_id]){ ?>
          <a href="/member/logout.php" class="link-to-pc">로그아웃</a>
        <? }else{ ?>
          <a href="/member/login.php" class="link-to-pc">로그인</a>
        <? } ?>
        </h1>
      </div>
      <div class="info">
        <div>문의: 1899-3840/02-2601-6569~70  팩스: 02)2601-6691 | 이메일: drg1038@naver.com</div>
        <div>상호: 우정넷 ㅣ 사업자번호: 152-25-00212  |  대표: 권이수  ㅣ  주소: 서울 강서구 화곡로185 서안이지텔 505호</div>
      </div>
    </div>
  </footer>
  <div class="banner sm-only">
    <a href="/sub05">
      <p>홈페이지제작 견적문의
        <span class="tag">바로가기</span>
      </p>
    </a>
  </div>
</body>
</html>
