<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";?>
  <div class="gnb">
    <div class="container">
      <div class="prefix">
        <h1><a href="/">dgds</a></h1>
      </div>
      <div class="suffix">
<? if($_SESSION[user_id]){ ?>
        <a href="/admin/sub04/sub01.php" class="btn-manage">�����ڸ��</a>
<? } ?>
<? if($_SESSION[user_id]){ ?>
        <span class="user"><?=$_SESSION[user_name]?>��</span>
<? } ?>
        <ul class="links">
          <li><a href="/sub05/">��������</a></li>
<? if($_SESSION[user_id]){ ?>
          <li><a href="/member/logout.php">�α׾ƿ�</a></li>
<? }else{ ?>
          <li><a href="/member/login.php">�α���</a></li>
<? } ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="header">
    <div class="main-visaul">
      <img src="./img/main1.png" alt="���� �����̵� �̹���">
    </div>
    <div class="nav">
      <ul>
        <li class="on"><a href="">������</a></li>
        <li><a href="">Ȩ����������</a></li>
        <li><a href="">��������</a></li>
        <li><a href="">��ȣ����</a></li>
        <li>�������� �����ּ��� 1899-3840 / 02-2601-6569</li>
      </ul>
    </div>
  </div>
  <div class="content">
    <div class="container">
      <h2>PORTFOLIO</h2>
      <p class="sub-phrase"> ����(���)�� ���忡�� �ֻ��� ���㼭�񽺿� �ְ��� ����Ƽ�� �ּ��� ���ϰڽ��ϴ�</p>
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
              <img src="/images/portfolio/<?=$data[p_file]?>" alt="��Ʈ������1 �̹���">
				<?=$data[com_name]?>
              <div class="dim">
                <span class="text"><?=$data[com_name]?></span>
                <span class="icon-home"></span>
                <span>������</span>
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
      <div class="logo">
        <h1>
          <span>������</span>
          <span>WOOJUNGNET</span>
          <a href="" class="link-to-pc">PC����</a>
        </h1>
      </div>
      <div class="info">
        <div>����: 1899-3840/02-2601-6569~70  �ѽ�: 02)2601-6691 | �̸���: drg1038@naver.com</div>
        <div>��ȣ: ������ �� ����ڹ�ȣ: 152-25-00212  |  ��ǥ: ���̼�  ��  �ּ�: ���� ������ ȭ���185 ���������� 505ȣ</div>
      </div>
    </div>
    <a href="" class="banner">
      <p>Ȩ���������� �������� <span class="tag">�ٷΰ���</span></p>
    </a>
  </footer>
</body>
</html>
