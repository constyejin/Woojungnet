<?include "../inc/header.php" ?>
<?
	if(!$loginId){
		echo "<script>alert('로그인후 사용 가능합니다.');history.back();</script>";
	}
?>

<!-- 마이페이지독립 css -->
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
							<li class="on"><a href="/mypage/sub05.php"><span>낙찰현황</span></a></li>
							<li><a href="/mypage/sub03.php"><span>관심차량</span></a></li>
							<li><a href="/mypage/sub01.php"><span>접수현황</span></a></li>
							<li><a href="/mypage/sub07.php"><span>회원정보수정</span></a></li>
                            <li><a href="/mypage/sub08.php"><span>회원탈퇴</span></a></li>
						</ul>
        
			<!--컨텐츠 부분-->
            <div class="join_area">

						

				<div class="join_img_body">
           <div class="join_area">
			<form name="searchForm" method="get">
				<table width="730" border="0" cellpadding="0" cellspacing="0">
					<tr align="center">
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
					<select id="wc_go_type" name="wc_go_type" class="form_select"> 
						<option value="">낙찰구분</option>
						<option value="1" <?if($wc_go_type== "1"){ echo "selected"; }?>>-폐차</option>
						<option value="2" <?if($wc_go_type== "2"){ echo "selected"; }?>>-명의이전</option>
					</select> 
					<input class="input form_control" name="Search_text" type="text" size="25" value="<?=$Search_text?>"/>
					<input type="button" value="검색" class="Submit2222222" onclick="document.searchForm.submit();" style="cursor:pointer; background-color:#e8eff7; color:#0e3b5d; border:#4e7ac1 1px solid; padding-bottom:3px; font-size:12px; height:25px; padding: 0 10px;"> 
				</td>
					</tr>
				</table>
			</form>
			<br />
			<table width="730" border="0" cellSpacing="1" cellPadding="0">
			  <tbody>
						<tr>
							<td bgColor="#ebebeb">
								<table width="100%" bgColor="#ffffff" border="0" cellSpacing="0" cellPadding="0" style="font-size: 13px;font-weight: 600;">
 										<tbody>
											<tr>
											  <td align="center">
											     <table class="join_form table-standard" width="100%" border="0" cellspacing="0" cellpadding="5">
															<!--추가 에러-->
														<colgroup>
															<col style="width:50px;" />
															<col style="width:200px;" />
															<col style="width:400px;" />
															<!-- <col style="width:9%" />
															<col style="width:9%" />
															<col style="width:9%" />
															<col style="width:auto;" /> -->
														</colgroup>
															<tr>
																<th height="25" align="center" ><strong>no</strong></th>
																<th align="center" ><strong>사진</strong></th>
																<th align="center"><strong>차량정보</strong></th>
																<th align="center" ><strong>입찰일시</strong></th>
																<th align="center"><strong>낙찰유형</strong></th>
																<th align="center"><strong>낙찰금액</strong></th>
																<th align="center"><strong>낙찰일자</strong></th>
															</tr>

 <?php
	$tb_name = "woojung_bid ";
	$view_article = 10; // 한화면에 나타날 게시물의 총 개수  
	if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
	$start = ($page-1)*$view_article;  
                
	$href = "&id=$id&wc_go_type=$wc_go_type&wc_made=$wc_made&wc_model=$wc_model&Search_text=$Search_text&li=$li";  
	//echo $total_article;
 
	$where = "  ";
	if($Search_text){
		$where .= "and ( d.name like '%$Search_text%' or wc_model like '%$Search_text%' or wc_orderno like '%$Search_text%' )  ";
	}
   if($wc_made){
	   $where .= " and wc_made = '$wc_made' ";
   }
   if($wc_model){
		$where .= " and wc_model='$wc_model' ";	
   }
	if($wc_go_type){  		 
		$where .= " and c.wc_go_type  = '$wc_go_type'";  
	}   

		//echo $where;
		$query = "select count(*) from woojung_bid as a
							left join woojung_car as b on a.auct_key = b.wc_idx
							left join woojung_car_go c on a.auct_key = c.wcg_wcidx
							left join cate2 d on d.idx = b.wc_made
					where  a.userId='$loginId' 
							and a.bid_sort = 'Y'  
							and ( b.wc_gubun2='2' || b.wc_gubun2='3' )
							and (b.wc_gubun4='4' || b.wc_gubun4='6'|| b.wc_gubun4='8'|| b.wc_gubun4='10' || b.wc_gubun4='11' || b.wc_gubun4='12' ) 
							$where
							";  
	 //echo $query;
		$result = mysql_query($query);  
		//echo $result;
		$temp = mysql_fetch_array($result);  
		$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	

			$qry = "select * from woojung_bid as a
							left join woojung_car as b on a.auct_key = b.wc_idx
							left join woojung_car_go c on a.auct_key = c.wcg_wcidx
							left join cate2 d on d.idx = b.wc_made
					where  a.userId='$loginId' 
							and a.bid_sort = 'Y'  
							and ( b.wc_gubun2='2' || b.wc_gubun2='3' )
							and  (b.wc_gubun4='4' || b.wc_gubun4='6'|| b.wc_gubun4='8'|| b.wc_gubun4='10'|| b.wc_gubun4='11' || b.wc_gubun4='12'  ) 
							$where
					order by b.wc_auction_date desc LIMIT $start, $view_article";
			
		
		//echo $qry;

		$auctQuery = $db->query($qry);

		 while($auctRow = mysql_fetch_object($auctQuery)) {

			 $num = $total_article-$i-(($page-1)*$view_article);
	    	 $car_img_arr = explode('/',$auctRow->wc_img_1);
		
 ?>
		<tr  onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''" >
			<td height="25" align="center" valign="middle" onclick="location.href='/sub02/sub02_1_view.php?idx=<?=$auctRow->wc_idx?>';" style="cursor:pointer;"><?=$num?></td>
			<td align="center" valign="middle" onclick="location.href='/sub02/sub02_1_view.php?idx=<?=$auctRow->wc_idx?>';" style="cursor:pointer;color:blue;">
				<img src="/data/<?=$car_img_arr[0]?>" width="200" height="160" border="0" /> 
			</td> 
			<td align="center" valign="middle" onclick="location.href='/sub02/sub02_1_view.php?idx=<?=$auctRow->wc_idx?>';" style="cursor:pointer;">
				<p class="car-info-p">
				<span style="color:#1855c6;"><?=$auctRow->wc_orderno?></span> | <span style="color: #c270c2;"><?=$auctRow->evalAmt_type?></span> | <strong style="color:#000;"><?=$auctRow->wc_no?></span></strong>
				</p>
				<p style="font-size: 17px;color:#000;" class="car-info-p">
					<?
						$sql="select * from cate2 where idx='$auctRow->wc_made' ";
						$result_made=mysql_query($sql);
						$data_made=mysql_fetch_array($result_made);
						echo $data_made[name];
					?>
					<?=$auctRow->made_dong?> |

					<?=$auctRow->wc_model?> <?=$auctRow->wc_model2?$auctRow->wc_model2:""?>
				</p>
				<p style="font-weight:400" class="car-info-p">
			        <?if($auctRow->wc_age){?> 
						<?=substr($auctRow->wc_age,0,4)?>년
						<?=substr($auctRow->wc_age,4,2)?>월
					<?}?> 
					| <?=$auctRow->wc_trans?> | <?=$auctRow->wc_fual?> |  <?=number($auctRow->wc_cc)?> cc  |  <?=number($auctRow->wc_mileage)  ?> km
				</p>
				<p style="font-weight:400" class="car-info-p">
					<? WriteArrHTML('select', 'area1', $ArrcarPlace , $auctRow->wc_keep_area1, '', '' , 'direct', '' );?>
				| 
				<?
				if($auctRow->moveKeepReq){
					echo $auctRow->moveKeepReq;
				}else{
					echo $auctRow->wc_keep_place1;
				} 
				?>  
				</p>
			</td> 
												<td align="center" valign="middle" onclick="location.href='/sub02/sub02_1_view.php?idx=<?=$auctRow->wc_idx?>';" style="cursor:pointer;">
	                                            <?=substr($auctRow->bid_rcpt_sort_date,0,4).'-'.substr($auctRow->bid_rcpt_sort_date,4,2).'-'.substr($auctRow->bid_rcpt_sort_date,6,2)?>
												 
												</td>  
												<td align="center" valign="middle" onclick="location.href='/sub02/sub02_1_view.php?idx=<?=$auctRow->wc_idx?>';" style="cursor:pointer;"> 
	                                            <?=WriteArrHTML('checkbox', '', $ArrgoSale, $auctRow->sale_type, '', 0, 'direct', '', '', '');?> 
												</td>  
												<td align="center" valign="middle" onclick="location.href='/sub02/sub02_1_view.php?idx=<?=$auctRow->wc_idx?>';" style="cursor:pointer;">
												<strong style="color: #000;">
													<?=number_format($auctRow->bid_price)?>
												</strong>
												<p style="text-align:center;color: #ff0000;font-weight:700">( <?=number_format($auctRow->total_price+$auctRow->wc_accepted_priceG)?>)</p>
												</td>  
                                                <td width="11%" align="center" valign="middle">
													<?=substr($auctRow->wc_auction_date,0,10)?>
<?if($auctRow->nak_ok == '1'){?>
												 <br>
												 <!-- <img src="/images/icon1_2.png" border="0" onclick="window.open('/inc/my_popup_03.php?wc_idx=<?=$auctRow->wc_idx?>','jungsan','width=700, height=900, scrollbars=yes');" style="cursor:pointer;"/> -->
												 	<a href="javascript:void(0)" style="display: inline-block;margin-top: 15px;color: #0065c7;line-height: 1.4; margin-top: 10px;font-size: 17px;font-weight:700" onclick="window.open('/inc/my_popup_03.php?wc_idx=<?=$auctRow->wc_idx?>','jungsan','width=700, height=900, scrollbars=yes');">
														<img src="/images/icon_template.png" alt="문서" style="width:23px;vertical-align:bottom;">
														낙찰정산서
													</a>
<?}?>					 
												</td>
                                                </tr>
        <? 
	$i++;
}?>
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
</div></div>



			</div>
		</div>
	</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>

</body>
</html>

