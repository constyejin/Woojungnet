<?
include "../inc/header.php";
include "../inc/menu.php";

if (!$stoday) {
	$smonth=date("Y-m");
	$stoday=date("Y-m",strtotime("now"." -11 months "))."-01";
}

$sql_ip="select * from counter where counter_date >= '".$stoday."' ";
$result_ip=mysql_query($sql_ip);
while($data_ip=mysql_fetch_array($result_ip)){
	$co_d=explode("-" ,$data_ip[counter_date]);
	$sa_d[$co_d[0]][$co_d[1]][$co_d[2]]++;
}
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>접속자료</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid connect-info">
        <!-- 일자별 테이블 -->
        <div class="row mt-5">
          <div class="col-12">
            <h3>일자별 접속현황<span class="notice-sm">/ IP별로 하루 1회로 측정됩니다.</span> </h3>
            <table class="table table-layout table-hover border-type connect-of-date">
              <colgroup>
                <col style="width: 80px;">
              </colgroup>
              <thead>
                <th>월/일</th>
<? for($ii=1;$ii<32;$ii++){ ?>
                <th><?=$ii?>일</th>
<? } ?>
                <th>합계</th>
              </thead>
              <tbody class="table-light">
<?
for($i=0;$i<12;$i++){
?>
                <tr>
                  <td><?=$smonth?></td>
<? for($ii=1;$ii<32;$ii++){ ?>
<?
		$co_d_for=explode("-" ,$smonth);
		$year=$co_d_for[0];
		$month=sprintf("%02d",$co_d_for[1]);
		$day=sprintf("%02d",$ii);
		$month_sum[$i]+=$sa_d[$year][$month][$day];
?>
                  <td><?=number($sa_d[$year][$month][$day])?></td>
<? } ?>
                  <td><?=number($month_sum[$i])?></td>
                </tr>
<?
	$smonth=date("Y-m",strtotime($smonth."-01 -1 month "));
}
?>
              </tbody>
            </table>
          </div>
        </div>
<?
$view_article = 15; // 한화면에 나타날 게시물의 총 개수  
if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
$start = ($page-1)*$view_article; 

if (empty($fr_date)) $fr_date = date('Y-m-d', time()-2592000);
if (empty($to_date)) $to_date = G5_TIME_YMD;

$max = 0;
$sum_count = 0;
$sql = " select * from {$g5['visit_table']}
            where vi_date between '{$fr_date}' and '{$to_date}' ";
$result = mysql_query($sql);
while ($row=mysql_fetch_array($result)) {
    $str = $row['vi_referer'];
    preg_match("/^http[s]*:\/\/([\.\-\_0-9a-zA-Z]*)\//", $str, $match);
    $s = $match[1];
    $s = preg_replace("/^(www\.|search\.|dirsearch\.|dir\.search\.|dir\.|kr\.search\.|myhome\.)(.*)/", "\\2", $s);
    $arr[$s]++;

    if ($arr[$s] > $max) $max = $arr[$s];

    $sum_count++;
}
?>
		<div class="row mt-3">
          <div class="col-md-8 col-sm-12">
            <h4><?=$fr_date?> ~ <?=$to_date?></h4>
            <table class="table table-layout border-type connect-of-range table-hover">
              <colgroup>
                <col style="width:15%">
                <col style="width:auto">
                <col style="width:auto">
                <col style="width:auto; text-align: right;">
              </colgroup>
              <thead>
                <th>순위</th>
                <th>접속 도메인</th>
                <th>접속자수</th>
                <th>비율(%)</th>
              </thead>
              <tbody class="table-light">
<?
    $i = 0;
    $k = 0;
    $save_count = -1;
    $tot_count = 0;
    if (count($arr)) {
        arsort($arr);
        foreach ($arr as $key=>$value) {
            $count = $arr[$key];
            if ($save_count != $count) {
                $i++;
                $no = $i;
                $save_count = $count;
            } else {
                $no = '';
            }

            if (!$key) {
                $link = '';
                $link2 = '';
                $key = '직접';
            } else {
                $link = '<a href="./visit_list.php?'.$qstr.'&amp;domain='.$key.'">';
                $link2 = '</a>';
            }

            $rate = ($count / $sum_count * 100);
            $s_rate = number_format($rate, 1);

            $bg = 'bg'.($i%2);
?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $key ?></td>
                  <td><?php echo $count ?></td>
                  <td><?php echo $s_rate ?></td>
                </tr>
    <?php
        }
    } else {
        echo '<tr><td colspan="4" style="text-align:center;">자료가 없습니다.</td></tr>';
    }
    ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- //일자별 테이블 -->


      </div>
    </div>
  </div>
</body>
</html>