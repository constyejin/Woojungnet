<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?> 
<?
if(!$user_level && (!$loginId || $loginUsort=="indi") ){
	echo "<script>alert('로그인후 사용 가능합니다.');location.href='/login/login.php';</script>";
}

	$query = mysql_query("select * from woojung_member where userId = '$loginId' limit 1");
	$member_new = mysql_fetch_array($query);
	//echo $member_new[power];

if(!$gubun2) $gubun2="4";
if($gubun2=="2"){$kk="보험경공매";}
if($gubun2=="3"){$kk="스페셜매물";}
if($gubun2=="4"){$kk="일반경공매";}
?>

<div id="contents_basic">
    <!-- 1:자동차리스트 -->
    <div class="co_car_all">


  	<div class="sub-visual">
			<div class="sub-text">
				<p class="catch-phrase">
					<?=$kk?>
				</p>
				<p class="description-text">
					보험사잔존물의 온라인경공매서비스로 신속,정확한정보를 제공합니다.</p>
	  </div>
		</div>
        
        	<div class="div_basic">
<? 
if($gubun3=="1"){
 $on2 = "class='on'";
}else if($gubun3=="2"){
 $on3 = "class='on'";
}else{
 $on1 = "class='on'";
} 
?>
			<div class="tab_type01">
				<ul>
                    <li <?=$on1 ?>><a href="/sub04/sub04_1.php"><span><?=$kk?></span></a></li>
					<? if($gubun2=="2"){ ?>
					<li <?=$on2 ?>><a href="/sub02/sub02_1.php?gubun2=2&gubun3=3"><span>공매(파손/도난)</span></a></li>
					<li <?=$on3 ?>><a href="/sub02/sub02_1.php?gubun2=2&gubun3=6"><span>공매(침수차량)</span></a></li>
					<li <?=$on4 ?>><a href="/sub02/sub02_1.php?gubun2=2&gubun3=2"><span>경매(파손/도난)</span></a></li>
					<? }else if($gubun2=="3"){ ?>
					<li <?=$on2 ?>><a href="/sub03/sub03_1.php?gubun2=3&gubun3=1"><span>공매물건</span></a></li>
					<li <?=$on3 ?>><a href="/sub03/sub03_1.php?gubun2=3&gubun3=2"><span>경매물건</span></a></li>
					<? }else if($gubun2=="4"){ ?>
					<li <?=$on2 ?>><a href="/sub04/sub04_1.php?gubun2=4&gubun3=1"><span>공매물건</span></a></li>
					<li <?=$on3 ?>><a href="/sub04/sub04_1.php?gubun2=4&gubun3=2"><span>경매물건</span></a></li>
					<? } ?>
				</ul>
			</div>

 
			<!-- =============== 새로운 디자인 리스트 -->
			<div class="search-box">
				<!-- 검색박스 -->
			   <form name="sear" id="sear">
			   <input type="hidden" name="gubun2" value="<?=$gubun2?>" >
			   <input type="hidden" name="gubun3" value="<?=$gubun3?>" >
				<table width="" border="0" cellspacing="0" cellpadding="0" style="padding-top:3px; border:1px solid #CCCCCC;">
					<tr>
						<td style="height: 50px;text-align:left;padding-left:30px;">
							<select name="wc_made" onchange="document.sear.submit();" class="form_select">
								<option value="" >=== 제조사 ===</option>
								<?
									$team_cate_sql=mysql_query("select * from cate2 where depth='1'");
									while($team_cate=mysql_fetch_array($team_cate_sql)){
								?>
								<option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$wc_made){ echo "selected"; }?>>
									<?=$team_cate["name"]?>
								</option>
								<?}?>
							</select>
							<select name="wc_model" onchange="document.sear.submit();" class="form_select">
								<option value="" >=== 모델명 ===</option>
								<? if($wc_made){ ?>
								<?
									$team_cate_sql=mysql_query("select * from cate2 where depth='2' and code='$wc_made' ");
									while($team_cate=mysql_fetch_array($team_cate_sql)){
								?>
								<option value="<?=$team_cate["name"]?>" <?if($team_cate["name"]==$wc_model){ echo "selected"; }?>>
									<?=$team_cate["name"]?>
								</option>
								<?}?>
							<? } ?>
							</select>
							<?=WriteArrHTML('select', 'wc_keep_area1', $ArrcarPlace , $wc_keep_area1, 'onchange="document.sear.submit();"', '' , 'all', '=== 보관 ===' )?>
						   <!--
							<select class="form_select">
								<option value="">=== 매각유형 ===</option>
							</select>
							-->
							<input type="text" name="sear4" value="<?=$sear4?>" style="width:140px;" class="form_control"/>
							
							<input type="submit" value="검색" class="imgbt1" style="cursor:pointer; background-color:#e8eff7; color:#0e3b5d; border:#4e7ac1 1px solid; padding-bottom:3px; font-size:12px; height:25px; padding: 0 10px;"/>
						</td>
						<td style="text-align:right; padding-right: 30px">
							<!--<img src="/images/sub02_icon.png" width="200" height="18" border="0" usemap="#sub02_icon" />-->
							<div class="filter-group">
								<a href="sub04_1.php?gubun2=<?=$gubun2?>&gubun3=<?=$gubun3?>&type=1">폐차</a>&nbsp;&nbsp;ㅣ&nbsp;&nbsp;
								<a href="sub04_1.php?gubun2=<?=$gubun2?>&gubun3=<?=$gubun3?>&type=2">명의이전</a>&nbsp;&nbsp;ㅣ&nbsp;&nbsp;
								<a href="sub04_1.php?gubun2=<?=$gubun2?>&gubun3=<?=$gubun3?>&evaltype=1">전손</a>&nbsp;&nbsp;ㅣ&nbsp;&nbsp;
								<a href="sub04_1.php?gubun2=<?=$gubun2?>&gubun3=<?=$gubun3?>&evaltype=2">분손</a></a>
							</div>
						</td>
						</form>
					</tr>
				</table>
			</div>

			<div class="co_car_list for-sale">

          <?
			/*
			"폐차"=>"1",
			"경/공매"=>"2",
			"중고차"=>"3",
			"감정평가"=>"4",
			"기타"=>"5"
			gubun_3 2,4 //경매 
			gubun_3 3,5 //공매
			이페이지는 경매
			*/
			   $view_article = 20; // 한화면에 나타날 게시물의 총 개수  
				$href="&gubun2=$gubun2&type=$type&t=$t&wc_made=$wc_made&wc_model=$wc_model";
				$nowDate = date("YmdHi");
			   $where=" wc_gubun4='2' ";
			   if($gubun2){
				   $where .= " and wc_gubun2 = '$gubun2' ";
			   }else{
				   $where .= " and wc_gubun2 = '2' ";
			   }
			   if($gubun3){
				   if($gubun3 =="3"){ 
				   $where .= " and (wc_gubun3 = '3' or wc_gubun3 = '5') ";
				   }else if($gubun3 =="2"){ 
				   $where .= " and (wc_gubun3 = '2' or wc_gubun3 = '4') ";
				   }else{
			        $where .= " and wc_gubun3 = '$gubun3' "; 
				   }
			   }
			   if($sear1){
				   $where .= " and c.wc_go_type = '$sear1' ";
			   }
			   if($sear3){
				   $where .= " and car_cate = '$sear3' ";
			   }
			   if($wc_made){
				   $where .= " and wc_made = '$wc_made' ";
			   }
			   if($wc_model){
					$where .= " and wc_model='$wc_model' ";	
			   }
			   if($t=="9"){
					$where .= " and (wc_go_end_hh = '09' and wc_go_end_mm = '30') ";	
			   }
			   if($t=="10"){
					$where .= " and (wc_go_end_hh = '10' and wc_go_end_mm = '30') ";	
			   }
			   if($t=="13"){
					$where .= " and (wc_go_end_hh = '13' and wc_go_end_mm = '30') ";	
			   }
			   if($t=="15"){
					$where .= " and (wc_go_end_hh = '15' and wc_go_end_mm = '30') ";	
			   }
			   if($type=="1"){
					$where .= " and (wc_go_type = '1' or wc_go_type = '3') ";	
			   }
			   if($type=="2"){
					$where .= " and (wc_go_type = '2' or wc_go_type = '3') ";	
			   }
			   if($evaltype=="1"){
					$where .= " and (evalAmt_type = '전손') ";	
			   }
			   if($evaltype=="2"){
					$where .= " and (evalAmt_type = '분손') ";	
			   }
			   
			   if($wc_keep_area1){
				   $where .= " and wc_keep_area1='$wc_keep_area1' ";
			   }
			   if($sear4){
					$where .= " and ( wc_no  like '%$sear4%' or wc_orderno like '%$sear4%' or wc_model  like '%$sear4%' or wc_model2  like '%$sear4%' ) ";	
			   }
				$where .= " and concat(REPLACE (c.wc_go_end_date, '-', ''), wc_go_end_hh , wc_go_end_mm) >= '$nowDate' ";

				$qry_cnt = mysql_query("SELECT count(*) FROM woojung_car as a left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx  WHERE  $where ");
				$temp = mysql_fetch_row($qry_cnt);  
				$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	

				$query = mysql_query("SELECT * FROM woojung_car as a left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx  WHERE  $where order by concat(REPLACE (c.wc_go_end_date, '-', ''), wc_go_end_hh , wc_go_end_mm) asc LIMIT $start, $view_article");
 			//echo "SELECT * FROM woojung_car as a left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx  WHERE  $where order by concat(REPLACE (c.wc_go_end_date, '-', ''), wc_go_end_hh , wc_go_end_mm) asc LIMIT $start, $view_article";
				$kk=1;
				while($row = mysql_fetch_object($query)) {	
					if($row->wc_go_type == 2){
						$p_img="<img src='/img/sub/btn_04.jpg'>"; 
					} else if($row->wc_go_type == 1){
						$p_img="<img src='/img/sub/btn_05.jpg'>"; 
					}
					$car_img_arr = explode('/',$row->wc_img_1);
					$site_u = mysql_fetch_array(mysql_query("select * from recruit as a left join woojung_member as b on a.code=b.code left join woojung_car as c on b.userId=c.wc_mem_id where c.wc_idx='".$row->wc_idx."' "));

					$year			= cutStr($row->wc_go_end_date,0,4);
					$month			= cutStr($row->wc_go_end_date,5,2);
					$day			= cutStr($row->wc_go_end_date,8,2);
					$hour			= $row->wc_go_end_hh;
					$min			= $row->wc_go_end_mm;
					$last_end_date = $year.'-'.$month.'-'.$day.' ['.$hour.':'.$min.']';
					if($row->wc_go_type=="1"){
						if($member_new[power]=="1"||$member_new[power]=="3"){
							$onc="auctionView('$row->wc_idx','$gubun2');";
						}else{
							$onc="alert('입찰권한이 없습니다. 운영자에게 문의하세요');";
						}
					}else if($row->wc_go_type=="2"){
						if($member_new[power]=="2"||$member_new[power]=="3"){
							$onc="auctionView('$row->wc_idx','$gubun2');";
						}else{
							$onc="alert('입찰권한이 없습니다. 운영자에게 문의하세요');";
						}
					}else if($row->wc_go_type=="3"){
						$onc="auctionView('$row->wc_idx','$gubun2');";
					}

					if($loginUsort == "admin" || $loginUsort=="superadmin"||$loginUsort=="indi2"){
						$onc="auctionView('$row->wc_idx','$gubun2');";
					}

					if($row->wc_go_cost_type == "2"){ // 낙찰자 부담일 경우만 금액 적어준다
						$wc_go_cost = $row->wc_go_cost;
						$total_amt = $row->wc_go_cost;
					}else{
						$wc_go_cost = 0;
						$total_amt = 0;
					}
			  ?>
				<!-- 각 차량 -->
				<div class="carbox" onclick="<?=$onc?>" style="cursor:pointer">
						<div class="image-wrap"> 
							<img src="<?=$site_u[home_url]?>/data/<?=$car_img_arr[0]?>" alt="챠량이미지"  >
						</div>
						<div class="area_h">
							<button>
									<span>
										<?
										$sql="select * from car_zzim where no='".$row->wc_idx."' and userid='".$loginId."'";
										$que=mysql_query($sql);
										$rowZim=mysql_fetch_array($que);
										if(!$rowZim[idx]){ 
										?>
											<i class="ico_carheart" onclick="zzim('<?=$row->wc_idx?>')"></i>
										<?}else{?>
											<i class="ico_carheart on" onclick="zzim2('<?=$row->wc_idx?>')"></i>
										<?} ?>
										<!--
											description
											아이콘 클래스에 'on'을 붙이면 빨간색 하트 아이콘 노출
										-->
									</span>
							</button>
							<div class="ct_c"><?=$row->evalAmt_type?></div>
							<div class="ct_r"><?WriteArrHTML('radio', 'Arrgubun2', $ArrgoSale, $row->wc_go_type, '', '' , 'direct', '');?></div>
						</div>
						<div class="number">
							<div class="n_tit"><?=$row->wc_orderno?></div>
							<div class="n_tit"><span>
												<? 
													WriteArrHTML('select', 'gubun3', ${"Arrgubun3_".$row->wc_gubun2}, $row->wc_gubun3, '', '' , 'direct', ''); 
												?></span></div>
						</div>

						<div class="carname">
							<div class="c_model">
							 <?if($row->wc_model) echo $row->wc_model;?>
							 <?if($row->wc_model2) echo $row->wc_model2;?>
							</div>
							<p>
								<span><?if($row->wc_age)?><?=substr($row->wc_age,0,4)?>-<?=substr($row->wc_age,4,2)?></span> 
								|<span><?=$row->wc_mem_name=="동부"?$row->trans_dong:$row->wc_trans ?></span>
								|<span><?=$row->wc_mem_name=="동부"?$row->fual_dong:$row->wc_fual ?></span>
							</p>
						</div>
						<div class="carcheck">
							<p><span>보관 : </span> <?
								if($row->wc_keep_area2){
									$keep_area = WriteArrHTML('select', 'area1', $ArrcarPlace , $row->wc_keep_area2, '', '' , 'direct', '' );
								}else{
									$keep_area = WriteArrHTML('select', 'area1', $ArrcarPlace , $row->wc_keep_area1, '', '' , 'direct', '' );
								}
								?> </p>
							<p><span>마감 : </span> <strong><?=$last_end_date?></strong></p>
						</div>
				</div>
				<!-- //각 차량 끝 --> 
			<? 
				$kk++;
				} 
				if($kk==1){
					echo " <div>진행중인 물건이 없습니다 </div> ";
				}
			?>

			</div> 

			<!-- =============== 새로운 디자인 리스트 끝 -->


			<!--  페이지네이션 -->
			<table cellpadding="0" cellspacing="0" style="width:1200px; margin-left: auto; margin-right: auto; border-top: 1px solid #dddddd">
				<tr>
					<td height="15" align="center">&nbsp;</td>
				</tr>
				<tr>
					<td align="center"><table width=100%><tr><td height="50" align=center class=text> <span style="font-size: 14px;"><? include "../inc/page.php";?></td>
					</tr></table> </td>
				</tr>
				<tr>
					<td height="15" align="center">&nbsp;</td>
				</tr>
			</table> 

	</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>


<map name="img_sub02_1_bar" id="img_sub02_1_bar">
<area shape="rect" coords="658,14,712,35" href="sub02_1.php?gubun2=<?=$gubun2?>&gubun3=<?=$gubun3?>&type=1" />
<area shape="rect" coords="719,14,770,34" href="sub02_1.php?gubun2=<?=$gubun2?>&gubun3=<?=$gubun3?>&type=2" />
<area shape="rect" coords="777,14,828,36" href="sub02_1.php?gubun2=<?=$gubun2?>&gubun3=<?=$gubun3?>&t=11" />
<area shape="rect" coords="834,15,887,34" href="sub02_1.php?gubun2=<?=$gubun2?>&gubun3=<?=$gubun3?>&t=2" />
</map>
 

<map name="sub02_icon" id="sub02_icon">
<area shape="rect" coords="2,1,54,16" href="sub02_1.php?gubun2=<?=$gubun2?>&gubun3=<?=$gubun3?>&type=1" />
<area shape="rect" coords="58,1,109,17" href="sub02_1.php?gubun2=<?=$gubun2?>&gubun3=<?=$gubun3?>&type=2"/>
<area shape="rect" coords="119,1,168,19" href="sub02_1.php?gubun2=<?=$gubun2?>&gubun3=<?=$gubun3?>&t=11"  />
<area shape="rect" coords="174,2,227,18" href="sub02_1.php?gubun2=<?=$gubun2?>&gubun3=<?=$gubun3?>&t=2" />
</map></body>
</html>

<script type="text/javascript">
function auctionView(idx,gubun2) {
	window.location.href="sub04_1_view.php?gubun2="+gubun2+"&idx="+idx;
}
function zzim(idx){
	var f = document.signform;
	f.no.value=idx;
	f.target="hiddenframe";
	f.action="/inc/myzzim.php";
	f.submit();
} 
function zzim2(idx){
	var f = document.signform;
	f.no.value=idx;
	f.target="hiddenframe";
	f.action="/inc/myzzimDel.php";
	f.submit();
} 
</script>
<iframe name="HiddenFrm" style="display:none;"></iframe>
<iframe name="hiddenframe" style="display:none;"></iframe>
<form name='signform' method='post'>
	<input type="hidden" name="no" value="<?=$idx?>">
	<input type="hidden" name="userid" value="<?=$loginId?>">
</form>