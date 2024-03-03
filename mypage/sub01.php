<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?> 
<?
	if(!$loginId){
		echo "<script>alert('로그인후 사용 가능합니다.');history.back();</script>";
	}
?>

 
 

<!-- 회원가입독립 css -->
<style type="text/css">
.join_img_body { position:relative;  margin-top:30px; }
.join_area p {text-align:left; margin:10px 0;}
.join_img_body table.join_form tr th {height: 35px; background:#f7f7f7; font-weight:normal;border:1px solid #D8D8D8;
}
.join_img_body table.join_form tr td { text-align:center; padding:2px 2px 2px 2px; color:#000000; border:1px solid #D8D8D8;}
input[type=text] { padding:1px 1px 1px 1px; border:1px solid #666666; height:17px; }
.join_img_body table.join_form tr td  table { padding:0; margin:0; }
.join_img_body table.join_form tr td  table tr td { padding:0; margin:0; border:none; padding:2px 2px 2px 2px; }
.join_area p.s_title { margin-bottom: 30px; }
select.no{border:1px solid #666666;}
.join_area p.car-info-p{
	padding-left: 10px;
	text-align:left;
	font-weight: 600;
}
.join_area p.car-info-p.fs-14{
	font-size: 14px;
}
</style>

<div id="contents_basic">

     <div class="co_car_all">
			<div class="sub-visual">
				<div class="sub-text">
					<p class="catch-phrase">
					마이페이지ㅣMypage
					</p>
					<p class="description-text">입찰 ㅣ낙찰 ㅣ관심 ㅣ접수현황 및 회원정보수정을 하실수 있습니다. </p>
			  </div>
			</div>

			  <div class="join_img_head" style="margin-top:0;" align="center">
					<div class="tab_type01">
						<ul>
							<li><a href="/mypage/sub04.php"><span>입찰현황</span></a></li>
							<li><a href="/mypage/sub05.php"><span>낙찰현황</span></a></li>
							<li><a href="/mypage/sub03.php"><span>관심차량</span></a></li>
							<li class="on"><a href="/mypage/sub01.php"><span>접수현황</span></a></li>
							<li><a href="/mypage/sub07.php"><span>회원정보수정</span></a></li>
                            <li><a href="/mypage/sub08.php"><span>회원탈퇴</span></a></li>
						</ul>
 				
			<div class="join_area">
				<div class="join_img_body">

				  <table border="0" align="center" cellpadding="0" cellspacing="0" style="font-size: 13px;font-weight: 600;">
			        <tbody>
						<tr>
						  <td align="center">
							<!--
								<table width="100%" bgColor="#ffffff" border="0" cellSpacing="0" cellPadding="0">
									<form name="searchForm" action="/mypage/sub01.php" method="post">
										<tbody>
											<tr>
											  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            
                                                <colgroup>
                                                <col width="*" />
                                                <col width="*" />
                                                </colgroup>
                                                 
                                                 <tr>
                                                 <td align="right"><span style="padding-right:3px">
                                                   <select name="sear2" onchange="document.sear.sear5.value='';document.sear.submit();" class="no">
                                                     <option value="" >=== 제조사 ===</option>
                                                     <?
			   $team_cate_sql=mysql_query("select * from cate2 where depth='1'");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
                                                     <option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$sear2){ echo "selected"; }?>>
                                                     <?=$team_cate["name"]?>
                                                     </option>
                                                     <?}?>
                                                   </select>
                                                   <select name="sear5" onchange="document.sear.submit();" class="no">
                                                     <option value="" >=== 모델명 ===</option>
                                                     <?
			if($sear2){
			   $team_cate_sql=mysql_query("select * from cate2 where code='$sear2' order by name asc ");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
                                                     <option value="<?=$team_cate["name"]?>" <?if($team_cate["name"]==$sear5){ echo "selected"; }?>>
                                                     <?=$team_cate["name"]?>
                                                     </option>
                                                     <?}}?>
                                                   </select>
                                                 </span></td>
                                                  <!--td width="70" height="25" align="right">
													<input name="start_date" class="input" id="start_date" type="text" size="10"/>
												  </td>
                                                  <td width="20" align="center"><a onclick="Calendar(end_date);" href="javascript:;"> <img src="/images/icon_calendar.gif" border="0" /></a></td>
                                                  <td width="15" align="center">~</td>
                                                  <td width="70" align="right"><span class="style1">
													 <input name="end_date" class="input" id="end_date" type="text" size="10"/></span></td>
												<td width="30" align="left"><a onclick="Calendar(end_date);" href="javascript:;">&nbsp;<img src="/images/icon_calendar.gif" border="0" /></a></td>
												<td width="100" align="left"><span class="style1">
													<input name="sear6" class="input" type="text" size="15" value="<?=$sear6?>"/></span></td>
                    <td width="50" align="center"><span class="style1">
                    <img src="/images/search.jpg" onclick="document.searchForm.submit();"/></span></td>
                                                </tr>
									</form>
                                                 <tr>
                                                   <td height="7" colspan="8" align="right"></td>
                                                 </tr>
                                              </table>
											  -->

					<form name="searchForm" method="get">
						<table width="730" border="0" cellpadding="0" cellspacing="0">
							<tr align="center">
								<td align="left" bgcolor="#FFFFFF">
								</td>
								<td align="right" bgcolor="#FFFFFF">
								<select name="wc_made" id="wc_made"  onchange="document.searchForm.submit();"  class="form_select"> 
									<option value="">제조사</option>  
									<?
										$team_cate_sql=mysql_query("select * from cate2 where depth='1'");
										while($team_cate=mysql_fetch_array($team_cate_sql)){
									?>
									<option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$wc_made){ echo "selected"; }?>>
										<?=$team_cate["name"]?>
									</option>
									<?}?> 
								</select> 
									<input class="input form_control" name="Search_text" type="text" size="25" value="<?=$Search_text?>"/>
									<input type="button" value="검색" class="Submit2222222" onclick="document.searchForm.submit();" style="cursor:pointer; background-color:#e8eff7; color:#0e3b5d; border:#4e7ac1 1px solid; padding-bottom:3px; font-size:12px; height:25px; padding: 0 10px;"> 
								</td>
							</tr>
						</table>
					</form>
					<br />
					 <table class="join_form table-standard" width="100%" border="0" cellspacing="0">
						<!--추가 에러-->
						<colgroup>
								<col style="width:50px;" />
						</colgroup>
						<tr>
							<th height="25" align="center" ><strong>no</strong></th>
							<th align="center" ><strong>차량정보</strong></th> 
							<!--
							<th height="25" align="center" ><strong>no</strong></th>
							<th align="center" ><strong>접수번호</strong></th>
							<th align="center" ><strong>접수일자</strong></th>
							<th align="center" ><strong>차량번호</strong></th>
							<th align="center"><strong>모델명</strong></th>
							<th align="center"><strong>접수증</strong></th>
							<th align="center"><strong>감정평가</strong></th>
							<th align="center"><strong>출품정산서</strong></th>
							<th align="center"><strong>입찰자</strong></th>
							-->
						</tr>

                                                    
	 <?

	$where = " wc_mem_id='$loginId' ";


	if($sear2){
		$where .= " and wc_made = '$sear2' ";  	
	}
	if($sear5){		
		$where .= " and wc_model = '$sear5' ";
	}
	if($sear6){
		$where .= " and ( wc_no  like '%$sear6%'  or wc_orderno  like '%$sear6%') ";  	
	}
	

	$href = "&id=$id&wc_go_type=$wc_go_type&wc_made=$wc_made&wc_model=$wc_model&Search_text=$Search_text&li=$li";  
	//echo $total_article;
 
	if($Search_text){
		$where .= "and ( e.name like '%$Search_text%' or wc_model like '%$Search_text%' or wc_orderno like '%$Search_text%' )  ";
	}
   if($wc_made){
	   $where .= " and wc_made = '$wc_made' ";
   }
   if($wc_model){
		$where .= " and wc_model='$wc_model' ";	
   }
$query = "select count(*) from woojung_car as a
                       left join cate2 e on e.idx = a.wc_made 
               where $where ";  
$result = mysql_query($query); 
$temp = mysql_fetch_array($result);  
$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	
 // echo $query;
	
$view_article=10;
if(!$page)	 $page=1;
$start=($page-1)*$view_article;
// echo $total_article;

if($total_article > 0){

	$Qry = "SELECT * FROM woojung_car as a
					left join woojung_car_scrap as b on a.wc_idx = b.wc_sidx
					left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx
					left join woojung_car_judgment as d on a.wc_idx = d.wcj_wcidx		
					                       left join cate2 e on e.idx = a.wc_made  
			WHERE $where order by wc_idx  desc LIMIT $start, $view_article";
	// echo $Qry;
	$arr = Fetch_string($Qry);
	
	for($i=0;$i<count($arr);$i++){

		$num = $total_article-$i-(($page-1)*$view_article);
		($i%2 == 0) ? $bgCol = "#f3f3f3" : $bgCol = "#ffffff";
			
	
		/*
		$Arrgubun2 = array(
			"폐차"=>"1",
			"손상차"=>"2",
			"특수차"=>"3",
			"감정평가"=>"4",
			"기타"=>"5"
		);
		*/

		$viewBtn = "";
		if($arr[$i][wc_gubun2] == "1"){ // 폐차
			if($arr[$i][wc_scrap_view] == "Y"){
				$viewBtn = "<a href=\"javascript:;\" onclick=\"window.open('../inc/train_statement.php?wc_idx=".$arr[$i][wc_idx]."','jungsan','width=630, scrollbars=yes');\">보기</a>";
			}
		}elseif($arr[$i][wc_gubun2] == "2" || $arr[$i][wc_gubun2] == "3"){ // 손상차, 특수차
			if($arr[$i][wcg_view1] == "Y"){
				$viewBtn = "<a href=\"javascript:;\" onclick=\"window.open('../inc/search_train_statement.php?wc_idx=".$arr[$i][wc_idx]."','jungsan','width=630, scrollbars=yes');\">보기</a>";
			}
		}elseif($arr[$i][wc_gubun2] == "4"){ // 감정평가
			if($arr[$i][wcj_view] == "Y"){
				$viewBtn = "<a href=\"javascript:;\" onclick=\"window.open('../inc/jodgment_pop.php?wc_idx=".$arr[$i][wc_idx]."','jungsan','width=630, scrollbars=yes');\">보기</a>";
			}
		}

		if($arr[$i][wc_gubun4]=="1"){
			$loca="alert('대기중입니다.');";

		}else{
			$loca="location.href='/sub02/sub02_1_view.php?idx=".$arr[$i][wc_idx]."';";
		}
    	$car_img_arr = explode('/',$arr[$i][wc_img_1]); 
	?>
                                              <tr id="r<?=$i?>" onmouseover="document.getElementById('r<?=$i?>').bgColor='#d9f3fb';document.getElementById('t<?=$i?>').bgColor='#d9f3fb';" onmouseout="document.getElementById('r<?=$i?>').bgColor='';document.getElementById('t<?=$i?>').bgColor='';">
                                                    <td height="25" align="center" valign="middle" onclick="<?=$loca?>" style="cursor:pointer;"><?=$num?></td>
													<td> 
												<table>
													<colgroup>
														<col style="width:200px">
														<col style="width:50%">
													</colgroup>
													<tr>
														<td style="border-right:1px solid #D8D8D8;"><img src="/data/<?=$car_img_arr[0]?>"  width="200" height="160" border="0" /></td>
														<td style="border-right:1px solid #D8D8D8;">
															<table>
																<tr>
																	<td>
																		<p class="car-info-p">
																			<span style="color:#1855c6;"><?=$arr[$i][wc_orderno]?></span> | <strong style="color:#000;"><?=$arr[$i][wc_no]?></strong>
																		</p>
																		<p style="font-size: 17px;color:#000;" class="car-info-p">
																			<?
																				$sql="select * from cate2 where idx='".$arr[$i][wc_made]."' "; 
																				$result_made=mysql_query($sql);
																				$data_made=mysql_fetch_array($result_made);
																				echo $data_made[name];
																			?>
																			<?=$arr[$i][made_dong]?> |
																			<?=$arr[$i][wc_model]?> <?=$arr[$i][wc_model2]?$arr[$i][wc_model2]:""?>
																		</p>
																		<p style="font-weight:400" class="car-info-p">
																			<?if($arr[$i][wc_age]){?> 
																					<?=substr($arr[$i][wc_age],0,4)?>년 
																					<?=substr($arr[$i][wc_age],4,2)?>월
																				<?}?> 
																				| <?=$arr[$i][wc_trans]?> | <?=$arr[$i][wc_fual]?> |  <?=number($arr[$i][wc_cc])?> cc  |  <?=number($arr[$i][wc_mileage])  ?> km
																		</p>
																		<p style="font-weight:400" class="car-info-p">
																			<? WriteArrHTML('select', 'area1', $ArrcarPlace , $arr[$i][wc_keep_area1], '', '' , 'direct', '' );?>
				| 
				<?
				if($arr[$i][moveKeepReq]){
					echo $arr[$i][moveKeepReq];
				}else{
					echo $arr[$i][wc_keep_place1];
				} 
				?>   
																		</p>
																	</td>
																</tr>
															</table>	

														</td>
													<td style="text-align:left;padding-left: 50px;">
															<p>접수: 2023-02-28 15:27:39</p>
															<a href="javascript:;" onClick="window.open('../inc/receive.php?wc_idx=<?=$arr[$i][wc_idx]?>&mode=outcar','Upload','width=620, height=650');"style="display: inline-block;margin-top: 15px;color: #1855c6;line-height: 1.4; margin-top: 10px;font-size: 17px;font-weight:700">
																<img src="/images/icon_template.png" alt="문서" style="width:23px;vertical-align:bottom;">
																접수증
															</a> 
															<br><br>
<?if($arr[$i][ch_ok] == "1"){?> 
															<a href="javascript:;" onClick="window.open('../inc/my_popup_04.php?wc_idx=<?=$arr[$i][wc_idx]?>&mode=outcar','Upload','width=700, height=900');" style="display: inline-block;margin-top: 15px;color: #008a00;line-height: 1.4; margin-top: 10px;font-size: 17px;font-weight:700">
																<img src="/images/icon_template.png" alt="문서" style="width:23px;vertical-align:bottom;">
																출품정산서
															</a>
<?}?>
														</td>
													</tr>
													</table>
													</td>
													<!--
													<td align="center" valign="middle" onclick="<?=$loca?>" style="cursor:pointer;color:blue;"><?=$arr[$i][wc_orderno]?></td>
													<td align="center" valign="middle" onclick="<?=$loca?>" style="cursor:pointer;"><?=substr( $arr[$i][wc_regdate], 0, 10)?></td>
													<td align="center" valign="middle" onclick="<?=$loca?>" style="cursor:pointer;"><?=$arr[$i][wc_no]?></td>
													<td align="center" valign="middle" onclick="<?=$loca?>" style="cursor:pointer;"><?=$arr[$i][wc_model]?><?if($arr[$i][wc_model]&&$arr[$i][wc_model2])echo "/";?><?if($arr[$i][wc_model2])echo $arr[$i][wc_model2];?></td>
													<td align="center" valign="middle"><a href="javascript:;" onClick="window.open('../inc/receive.php?wc_idx=<?=$arr[$i][wc_idx]?>&mode=outcar','Upload','width=620, height=650');"><img src="/images/icon2_2.png" border="0" /></a></td>
													<td align="center" valign="middle">
<?if($arr[$i][gam_ok] == "1"){?>
													<a href="javascript:;" onClick="window.open('../inc/my_popup_05.php?wc_idx=<?=$arr[$i][wc_idx]?>&mode=outcar','Upload','width=700, height=900');"><img src="/images/icon3_2.png" border="0" /></a>
<?}?>
													</td>
                                                    <td width="11%" align="center" valign="middle">
<?if($arr[$i][ch_ok] == "1"){?>
													<a href="javascript:;" onClick="window.open('../inc/my_popup_04.php?wc_idx=<?=$arr[$i][wc_idx]?>&mode=outcar','Upload','width=700, height=900');"><img src="/images/icon4_2.png" border="0" /></a>
<?}?>
													</td>
                                                    <td width="11%" align="center" valign="middle">
<?if(($arr[$i][wc_gubun4] == 4 || $arr[$i][wc_gubun4] == 6|| $arr[$i][wc_gubun4] == 8|| $arr[$i][wc_gubun4] == 9|| $arr[$i][wc_gubun4] == 10) && $arr[$i][ib_ok] == "1"){?>
													<a href="#" onClick="window.open('auction_popup.php?auct_idx=<?=$arr[$i][wc_idx]?>','auction','width=830, height=530, scrollbars=yes');"><img src="/images/icon5_2.png" border="0" /></a>
<?}?>
													</td>
													-->
                                                </tr> 
 <? 
		 }
	} 
 ?>
                                                </table>
                                              </td>
											</tr>
										</tbody>									
									</form>
								</table>
						  </td>
						</tr>
				  </tbody>
		  </table>
				<br /><br />
				<table width="730" border="0" cellspacing="0" cellpadding="0">
                  <tr align="center">
                    <td align="center"><? include "../inc/page.php";?></td>
                  </tr>
                </table>
			  <br /><br />
			  <br /> 
                <td height="25" align="center" vAlign="top">
					<tbody>
						<tr align="center" bgColor="#e6e6e6">
							
						</tr>
						
					</tbody>
				</table>


 </div> 

	<? include "../inc/bottom.php" ?>
</div>
</body>
</html>

<script type="text/javascript">
function auctionView(idx) {
	window.location.href="sub02_1_view.php?idx="+idx;
}
</script>
