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
.join_area p.s_title { margin-bottom: 10px; }
select.no{border:1px solid #666666;}
.join_area p.car-info-p{
	padding-left: 10px;
	text-align:left;
	font-weight: 600;
}
.join_area p.car-info-p.fs-14{
	font-size: 14px;
}
input[type="text"].counter{
	background: transparent;
	font-family: "SUIT","Malgun Gothic",sans-serif;
	font-size: 13px;
	width: 100%;
	text-align: center;
}
</style>
<script>
function auctionView_pubauct(a,b,c){
	location.href="/sub02/sub02_1_view.php?idx="+a;
}

	function all_check(){
		var lng =  document.getElementsByName('check[]');
		if(document.f.allcheck.checked == true){
			for(i=0;i<lng.length;i++){
				lng[i].checked = true;
			}
		} else {
			for(i=0;i<lng.length;i++){
				lng[i].checked = false;
			}
		}
	}
	function delete_car(){
		

		var j=0;
		var obj = document.getElementsByName('check[]');
		for(var i=0;i < obj.length ; i++){
			if(obj[i].checked == true){
				j++;
				break;
			}
		}
		
		if(j == 0){
			alert("선택된 자료가 없습니다.");
			return;
		}

		result = confirm("한번 삭제하신 자료는 복구 불가능 합니다. \n\n정말 삭제 하시겠습니까??");
		if(result){
			
			document.f.submit();
		}
		
	}

</script>



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
							<li class="on"><a href="/mypage/sub03.php"><span>관심차량</span></a></li>
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
								<td align="left" bgcolor="#FFFFFF">
									정렬 : <span style="cursor:pointer;<?if(!$li) echo "font-weight:bolder;";?>" onclick="location.href='sub04.php';">입찰종료일</span>  | <span style="cursor:pointer;<?if($li) echo "font-weight:bolder;";?>" onclick="location.href='sub04.php?li=1';">접수번호</span>
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
									<select id="wc_go_type" name="wc_go_type" class="form_select"> 
										<option value="">매각유형</option>
										<option value="1" <?if($wc_go_type== "1"){ echo "selected"; }?>>-폐차</option>
										<option value="2" <?if($wc_go_type== "2"){ echo "selected"; }?>>-명의이전</option>
										<option value="3" <?if($wc_go_type== "3"){ echo "selected"; }?>>-폐차/이전</option>
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
									<form name="f" action="sub03_del.php" method="post">
										<tbody>
											<tr>
											  <td align="center"><table class="join_form table-standard" width="100%" border="0" cellspacing="0" cellpadding="5">
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
														<!--th width="3%" height="25" align="center" ><input type="checkbox" name="allcheck" id="allcheck" onClick="all_check()" /></th-->
														<th height="25" align="center" ><strong>no</strong></th>
														<th align="center" ><strong>사진</strong></th>
														<th align="center"><strong>차량정보</strong></th>
														<th align="center" ><strong>입찰일시</strong></th>
														<th align="center"><strong>입찰유형</strong></th>
														<th align="center"><strong>입찰금액</strong></th>
														<th align="center"><strong>마감시간</strong></th>
														<!--th width="11%" align="center"><strong>진행상태</strong></th-->
													</tr>

                                                   
                                                      
<?
$view_article=10;
if(!$page)	 $page=1;
$start=($page-1)*$view_article;

                
	$href = "&id=$id&wc_go_type=$wc_go_type&wc_made=$wc_made&wc_model=$wc_model&Search_text=$Search_text&li=$li";  
	//echo $total_article;

	$where = "  ";
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

	$query = "select count(*) from  car_zzim as a 
	                                   left join woojung_car as b on a.no=b.wc_idx  
						   			   left join cate2 d on d.idx = b.wc_made
							left join woojung_car_go c on a.no = c.wcg_wcidx
									   where a.userid='".$_SESSION[loginId]."' and b.wc_gubun4='2' $where";
	$result = mysql_query($query);
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	
	//echo $query;	
		
	$qry = "select a.no,  b.wc_idx, b.wc_made, d.idx  , b.wc_gubun4, a.userid  from car_zzim as a 
	                    left join woojung_car as b on a.no=b.wc_idx 
							left join woojung_car_go c on a.no = c.wcg_wcidx
					    left join cate2 d on d.idx = b.wc_made
						where a.userid='".$_SESSION[loginId]."' and b.wc_gubun4='2' $where order by idx desc LIMIT $start, $view_article ";
	//echo $qry;	
	$auctQuery = $db->query($qry);
	$i=0;
	while($zzim_row = mysql_fetch_object($auctQuery)) {
	
		$num = $total_article-$i-(($page-1)*$view_article);
		$car_sql = "select * from woojung_car as a left join woojung_car_go as b on a.wc_idx = b.wcg_wcidx where a.wc_idx='".$zzim_row->no."'";
		$car_qry = $db->query($car_sql);
		$auctRow=mysql_fetch_object($car_qry);

		 	
	 		    $co = mysql_fetch_row(mysql_query("SELECT count(*) FROM woojung_bid  WHERE userId='$loginId' and auct_key='".$zzim_row->no."' " ));
  				if($co[0]=="2"){
					$sql="SELECT * FROM woojung_bid  WHERE userId='".$loginId."' and auct_key='".$zzim_row->no."' and sale_type='2' ";
					$result=mysql_query($sql);
					$data1=mysql_fetch_array($result);
					$sql="SELECT * FROM woojung_bid  WHERE userId='".$loginId."' and auct_key='".$zzim_row->no."' and sale_type='1' ";
					$result=mysql_query($sql);
					$data2=mysql_fetch_array($result);
				}	 	
		
		if(!$auctRow->wc_orderno){
			$car_del = "delete from car_zzim where idx='".$zzim_row->idx."'";
			$db->query($car_del);
		}

		$nacChk=$auctRow->bid_sort; 
		if($nacChk=="Y"){
			$nacPay=number_format($auctRow->bid_price);
		} else {
			$nacPay="";
		}

			  	$car_img_arr = explode('/',$auctRow->wc_img_1);



$auctionTrue = $auctRow->wc_auction; //낙찰유무

$param_auct_idx = $auctRow->wc_idx;
$sale_type		= $auctRow->sale_type;
$end_time		= $auctRow->wc_go_end_date;
$year			= cutStr($auctRow->wc_go_end_date,0,4);
$month			= cutStr($auctRow->wc_go_end_date,5,2);
$day			= cutStr($auctRow->wc_go_end_date,8,2);
$hour			= $auctRow->wc_go_end_hh;
$min			= $auctRow->wc_go_end_mm;
$last_end_date2 = $year.'년 '.$month.'월 '.$day.'일  '.$hour.'시 '.$min.'분';
 

$date1=mktime($hour,$min,'00',$month,$day,$year);  
$date2=time(); //mktime은 초로 계산된 시간 125125212초 이런식 
 
$total_secs=$date1 - $date2;  
$diff_in_days = floor($total_secs / 86400); 
$rest_hours = $total_secs % 86400;  
 
$diff_in_hours = floor($rest_hours / 3600); 
$rest_mins = $rest_hours % 3600;  
$diff_in_mins = floor($rest_mins / 60); 
$diff_in_secs = floor($rest_mins % 60); 


		$qry = "select * from woojung_bid as a
							left join woojung_car as b on a.auct_key = b.wc_idx
							left join woojung_car_go c on a.auct_key = c.wcg_wcidx
					where  a.userId='$loginId' 
							and b.wc_gubun2 in ('1','2','3','4','5')
							and  b.wc_gubun3 in ( '2','3','4','5','6','7' )
							 and  auct_key =  '$auctRow->wc_idx'  ";
		
 //echo $qry ;

			$auctQuery2 = $db->query($qry);
			$auctQuery2 = mysql_fetch_object($auctQuery2)
 ?>
				<tr style="cursor:pointer;" id="r<?=$i?>"  onmouseover="document.getElementById('r<?=$i?>').bgColor='#d9f3fb';document.getElementById('t<?=$i?>').bgColor='#d9f3fb';" onmouseout="document.getElementById('r<?=$i?>').bgColor='';document.getElementById('t<?=$i?>').bgColor='';" onClick="auctionView_pubauct('<?=$auctRow->wc_idx?>','<?=$auctRow->wc_gubun2?>','<?=$auctRow->wc_gubun3?>');"> 
									<td rowspan="2" height="25" align="center" valign="middle"><?=$num?></td>
									<td rowspan="2" align="center" valign="middle">
											<img src="/data/<?=$car_img_arr[0]?>" width="200" height="160" border="0" /> 
									</td>
									<td rowspan="2" align="center" valign="middle">
										<p class="car-info-p">
											<span style="color:#1855c6;"><?=$auctRow->wc_orderno?></span>
											| <span style="color: #c270c2"><?=$auctRow->evalAmt_type?></span>
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
									<td align="center" valign="middle"> 
											<?
												if($co[0]=="2"){
													echo substr($data1[bid_rcpt_sort_date],0,4).'-'.substr($data1[bid_rcpt_sort_date],4,2).'-'.substr($data1[bid_rcpt_sort_date],6,2).' '.substr($data1[bid_rcpt_sort_date],8,2).':'.substr($data1[bid_rcpt_sort_date],10,2).':'.substr($data1[bid_rcpt_sort_date],12,2);
												}else{
													if($auctQuery2->sale_type=="2")echo substr($auctQuery2->bid_rcpt_sort_date,0,4).'-'.substr($auctQuery2->bid_rcpt_sort_date,4,2).'-'.substr($auctQuery2->bid_rcpt_sort_date,6,2).' ['.substr($auctQuery2->bid_rcpt_sort_date,8,2).':'.substr($auctQuery2->bid_rcpt_sort_date,10,2).']';
												}
											?>
										</td>
										<td height="25" align="center" valign="middle">명의이전</td>
										<td height="25" align="center" valign="middle"><strong style="color:#000;">
										<?   
											if($co[0]=="2"){
												echo number_format($data1[bid_price]);
											}else{
												if($auctQuery2->sale_type=="2")echo number_format($auctQuery2->bid_price);
											}
										?>
										</strong></td>
										<td rowspan="2" align="center" valign="middle">
											<p style="text-align: center;font-size: 15px;color: #000000;line-height: 1.6;">
												<? 
													WriteArrHTML('select', 'gubun3', ${"Arrgubun3_".$auctRow->wc_gubun2}, $auctRow->wc_gubun3, '', '' , 'direct', ''); 
												?><br>
												<?
														//== /lib/code.php 안에 있음
														WriteArrHTML('radio', 'wc_go_type', $ArrgoSale, $auctRow->wc_go_type, '', '' , 'direct', '');
												?> 		 
											</p>
										<?=$auctRow->wc_go_end_date?> [<?=$auctRow->wc_go_end_hh?>:<?=$auctRow->wc_go_end_mm?>]
											   <br>
						<span id="counter<?=$num?>" style="color:#FF0000;"></span>
                      <script language="JavaScript" type="text/javascript"> 
					  <!-- 
					        // 자바스크립트 코드 
					  function Timer<?=$num?>(diff_in_secs, diff_in_mins, diff_in_hours, diff_in_days, mm,dd,yy, num){
					        //남은시간 실시간으로 보여지는 부분 
					        day<?=$num?>=diff_in_days;    //일단 남은 날짜와 시간을 받아온다음에 timer1을 호출한다 
					        hour<?=$num?>=diff_in_hours; 
					        min<?=$num?>=diff_in_mins; 
					        sec<?=$num?>=diff_in_secs; 
							dt<?=$num?> = new Date();
					        nyy<?=$num?> =dt<?=$num?>.getFullYear();
					        nmm<?=$num?> =dt<?=$num?>.getMonth()+1;
							ndd<?=$num?>=dt<?=$num?>.getDate();

							if(yy==nyy<?=$num?>&&mm==nmm<?=$num?>&&dd==ndd<?=$num?>){
								tda=1;
							}else{
								tda=0;
							} 
 						
					        if(day<?=$num?> >= 0 )
					      	{
							 Timer1<?=$num?>(<?=$num?>); 								
					        }  
					        else
					        { 
							document.getElementById('counter'+num).innerHTML = '입찰이 마감되었습니다.';  
					        } 
					} 
					function Timer1<?=$num?>(num) { 
					//if(tda == 1 )document.all.end_maker.value = '[금일마감]';  					        	 	
					sec<?=$num?>=sec<?=$num?>-1;        //1초식 감소 하다가 -1이되면 1분을 뺀다은 초를 59초로 초기화 
        				if(sec<?=$num?> == -1) { 
				        sec<?=$num?> = 59; 
				        min<?=$num?> = min<?=$num?>-1; 
				        } 
 
					if(min<?=$num?> == -1) {        //1분씩 감소 하다가 -1이되면 1시간을 뺀다음 분을 59분으로 초기화 
					        min<?=$num?>=59; 
					        hour<?=$num?> = hour<?=$num?> - 1; 
					        } 
					if(hour<?=$num?> == -1) {  //1시간씩 감소 하다가 -1이되면 1일을 뺀다음 날짜 초기화 
					        hour<?=$num?> = 23; 
					        day<?=$num?> = day<?=$num?> - 1; 
					        } 
					if(sec<?=$num?> == 0 && min<?=$num?> == 0 && hour<?=$num?> == 0 && day<?=$num?> == 0) { 
					        //일:0 시간:0 분:0 초:0 이라면 종료메세지 출력 
					    	document.getElementById('counter'+num).innerHTML = '입찰이 마감되었습니다.';   
						//	document.getElementById('sb_img').style.display = "none";
						//	document.all.end_maker.value = '';
					    	clearTimeout('Timer1<?=$num?>()');
					        return; 
					        } 
					if(day<?=$num?> < 0) { 
					        //일:0 시간:0 분:0 초:0 이라면 종료메세지 출력 
					    	document.getElementById('counter'+num).innerHTML = '입찰이 마감되었습니다.';   
							//document.getElementById('sb_img').style.display = "none";
							//document.all.end_maker.value = '';
					    	clearTimeout('Timer1<?=$num?>()');
					        return; 
					        } 
						document.getElementById('counter'+num).innerHTML= day<?=$num?> + '일 ' + hour<?=$num?> + '시간 ' + min<?=$num?> + '분 ' + sec<?=$num?> + '초 '; 
				        //1초당 한번씩 timer1()을 호출하여 실행 
						window.setTimeout('Timer1<?=$num?>(<?=$num?>)',1000); 
					} 
					
					//window.attachEvent( 'onload', Timer(42,35,11,0));
					//document.onload=Timer(42,35,11,0);
					
					
					document.onload=Timer<?=$num?>(<?=$diff_in_secs?>,<?=$diff_in_mins?>,<?=$diff_in_hours?>,<?=$diff_in_days?>,<?=$month?>,<?=$day?>,<?=$year?>, <?=$num?>);
					
					//--> 
					</script>	
													
								  	</td>
									</tr>
								  <tr id="t<?=$i?>" onmouseover="document.getElementById('r<?=$i?>').bgColor='#d9f3fb';document.getElementById('t<?=$i?>').bgColor='#d9f3fb';" onmouseout="document.getElementById('r<?=$i?>').bgColor='';document.getElementById('t<?=$i?>').bgColor='';">
									<td width="12%" align="center" valign="middle">
<?
	if($co[0]=="2"){
		echo substr($data2[bid_rcpt_sort_date],0,4).'-'.substr($data2[bid_rcpt_sort_date],4,2).'-'.substr($data2[bid_rcpt_sort_date],6,2).' '.substr($data2[bid_rcpt_sort_date],8,2).':'.substr($data2[bid_rcpt_sort_date],10,2).':'.substr($data2[bid_rcpt_sort_date],12,2);
	}else{
		if($auctQuery2->sale_type=="1")echo substr($auctQuery2->bid_rcpt_sort_date,0,4).'-'.substr($auctQuery2->bid_rcpt_sort_date,4,2).'-'.substr($auctQuery2->bid_rcpt_sort_date,6,2).' ['.substr($auctQuery2->bid_rcpt_sort_date,8,2).':'.substr($auctQuery2->bid_rcpt_sort_date,10,2).']';
	}
?>


									</td>
								    <td height="25" align="center" valign="middle">폐차</td>
								    <td width="12%" height="25" align="center" valign="middle"><strong style="color: #000;">
<?
	if($co[0]=="2"){
		echo number_format($data2[bid_price]);
	}else{
		if($auctQuery2->sale_type=="1")echo number_format($auctQuery2->bid_price);
	}
?>
									</strong></td>
								  </tr>
  <?
			$i++;
		}?>      
                                              <!--tr style="cursor: hand;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''">
                                                 <td width="8%" height="25" align="center" valign="middle">1</td>
                                                <td width="10%" align="center" valign="middle"><a href="#">13-1000336</a></td>
                                                    <td width="11%" align="center" valign="middle">2013-08-26</td>
                                                    <td width="11%" align="center" valign="middle">서울 2자 1234</td>
                                                    <td width="16%" align="center" valign="middle">에쿠스3.3</td>
                                                <td align="center" valign="middle">2008-01</td>
                                                    <td align="center" valign="middle">오토</td>
                                                    <td align="center" valign="middle">경매도난</td>
                                                    <td align="center" valign="middle">진행</td>
                                              </tr>
                                              <tr>
                                                <td height="1" colspan="9" bgcolor="#999999"></td>
                                              </tr-->
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
                    <td width="33%" align="left"><!--span style="color:blue;" onclick="javascript:delete_car()">관심취소 </span--></td>
                    <td width="33%" align="center"><? include "../inc/page.php";?></td>
                    <td width="33%" align="center">&nbsp;</td>
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
