<?
$today_1 = mysql_fetch_row(mysql_query("SELECT count(*) FROM woojung_bid  WHERE rdate='".date("Y-m-d")."' " ));
$today_2 = mysql_fetch_row(mysql_query("SELECT count(*) FROM woojung_car_go  WHERE wc_go_end_date='".date("Y-m-d")."' " ));
$today_3 = mysql_fetch_row(mysql_query("SELECT count(*) FROM woojung_bid  WHERE bid_sort_date like '".date("Y-m-d")."%' and bid_sort = 'Y' " ));
?>

<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td></td>
		<td>
			<!-- <a href="" class="btn btn-link"><i class="bi bi-house"></i> 홈으로</a>
			<a href="" class="btn btn-link"><i class="bi bi-box-arrow-right"></i> 로그아웃</a> -->
		</td>
	</tr>
</table>
<form name="today_ib" method="post" action="/admin/Sale05/Sale_list.php">
<input name="start_date" type="hidden" class="input" value="<?=date("Y-m-d")?>" style="width:90px;" /><input name="end_date" type="hidden" class="input" value="<?=date("Y-m-d")?>" style="width:85px;" />
</form>