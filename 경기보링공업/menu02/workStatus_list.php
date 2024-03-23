<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? 
include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php";

$start=$page_row*($page-1);
$woojung_part=sql_list("select * from woojung_part where wc_gubun1='1' $where order by wc_regdate desc limit $start,$page_row ");
$total_count=sql_total("select count(*) as cnt from woojung_part where wc_gubun1='1' $where ");
$list_num=$total_count-$page_start;
?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/menu02/style//workStatus.css">
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

<main class="work-status">
  <section>
    <h2 class="sub-title">작업현황
      <p>작업중이거나 작업이 완료된 차량정보입니다</p>
    </h2>
    
    <form name="f" action="proc.php" method="post" target="HiddenFrm">
      <input type="hidden" name="mode" value="delete">
      <ul class="work-status-list">
        <? for($i=0;$i<count($woojung_part);$i++){ 
          $car_img_arr = explode('/', $woojung_part[$i][wc_img_1]);
        ?>
        <li class="work-status-item">
          <div class="work-status-chk">
            <input type="checkbox" name="check[]" value="<?= $woojung_part[$i][wc_idx] ?>">
            <span><?=$list_num--;?></span>
          </div>

          <a href="/menu02/workStatus_view.php?wc_idx=<?=$woojung_part[$i][wc_idx]?>">
            <div class="work-status-img">
              <img src="/data/<?= $car_img_arr[0] ?>" alt="">
            </div>
            <b><?=$woojung_part[$i][wc_mem_etc]?></b>
          </a>
        </li>
        <? } ?>
      </ul>
    </form>
  </section>

  <section class="work-status-control">
    <? if($_SESSION[login_level]>="10"&&$_SESSION[login_level]<="40"){ ?>
      <button class="post-btn select-del-btn" type="button" onclick="delete_member()">선택삭제</button>
    <? } ?>

    <div class="pagenation">
      <div class="pagenation-icons prev">
        <a href=""></a>
        <a href=""></a>
      </div>

      <ol class="pagenation-list">
        <li class="active">
          <? echo paging_f($page, $page_row, $page_scale, $total_count, $ext); ?> 
        </li>
      </ol>

      <div class="pagenation-icons next">
        <a href=""></a>
        <a href=""></a>
      </div>              
    </div>

    <? if($_SESSION[login_level]>="10"&&$_SESSION[login_level]<="40"){ ?>
      <button class="post-btn register-btn">
        <a href="/menu02/workStatus_write.php">등록하기</a>
      </button>
    <? } ?>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>
