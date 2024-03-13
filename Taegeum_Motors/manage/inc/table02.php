<script>
function pr(){
     window.onbeforeprint = beforePrint;   
     window.onafterprint = afterPrint;   
     window.print();
}
function beforePrint()  
{   
   initBody = document.body.innerHTML;   
   document.body.innerHTML = print_page.innerHTML;  
}   
function afterPrint()  
{   
  document.body.innerHTML = initBody;   
	 document.location.reload();
}   
function img_change(idx,img_count){
	for(i=1;i<img_count;i++){
		img_name="img"+i;
		if(i==idx){
			document.getElementById(img_name).style.display="inline";
//			document.getElementById("img_td").style.textAlign="center";
		}else{
			document.getElementById(img_name).style.display="none";
		}
	}
}
</script>

<div id='print_page'>			
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20" align="left" class="title">
		<table width="100%">
			<tr>
				<td width="80%"><img src="/manage/img/icon_1.jpg" class="bullet">  <strong>출품자정보</strong></td>
				<td align="right" width="20%"><a href="javascript:pr();">인쇄하기</a></td>
			</tr>
		</table>
	  </td>
  </tr>
  <tr> 
    <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" class="table-style">
			<colgroup>
				<col style="width: 120px;">
				<col style="width: 330px;">
				<col style="width: 120px;">
				<col style="width: 330px;">
			</colgroup>
        <tr>
          <td class="table-th" bgcolor="f6f6f6">신청구분</td>
          <td colspan="3"  align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[calltype]?>          </td>
        </tr>
        <tr>
          <td class="table-th" bgcolor="f6f6f6" >사고유형</td>
          <td colspan="3"  align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?
			WriteArrHTML('checkbox', 'acctype[]', $ArrcarAcc, $row[acctype], '', 7, 'all', '');
		   ?> <?=$row[accd_etc]?></td>
        </tr>
         <tr> 
          <td class="table-th" bgcolor="f6f6f6" >신 청 자</td>
          <td width="285" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <?=$row[wc_mem_name]?> <font style="color:red">(<?=grade_sort($row['usort'])?>)</font></td>
          <td class="table-th" bgcolor="f6f6f6" >일반전화</td>
          <td width="285" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <?=$row[wc_mem_phone]?>          </td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >업체명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
            <?=$companyInfo?>          </td>
<?

	if($row[wc_mem_mobile] == ""){
		$Pcs = $row[pcs];
	}else{
		$Pcs = $row[wc_mem_mobile];
	}

	if($row[wc_mem_fax] == ""){
		$Fax = $row[fax];
	}else{
		$Fax = $row[wc_mem_fax];
	}
?>
          <td class="table-th" bgcolor="f6f6f6">휴대전화</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_mem_mobile]?>          </td>
        </tr>
        <!--tr> 
          <td class="table-th" bgcolor="f6f6f6">보상담당자</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[bodam]?></td>
          <td class="table-th" align="center" bgcolor="f6f6f6">연락처</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> <?=$row[botel]?></td>
        </tr>
		
      <tr> 
          <td class="table-th" bgcolor="f6f6f6">조직명</td>
					<td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[orm]?></td>
          <td class="table-th" bgcolor="f6f6f6">직책</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[orm2]?></td>
      </tr--> 
        <tr>
          <td class="table-th" bgcolor="f6f6f6">제휴사접수번호</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[jnumber]?></td>
          <td class="table-th" bgcolor="f6f6f6">담보</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[dambo1]?></td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">은행명</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[dambo3]?></td>
        </tr>
    </table></td>
  </tr>
</table>


<style>
.car-info-view{
	width: 1200px;
	margin: 20px auto;
	padding-bottom: 50px;
	text-align: left;
	font-family:'SUIT', "Malgun Gothic",sans-serif;;
}
.car-info-view h3{
	color: #333333;
	font-size: 16px;
	margin-top: 25px;
	margin-bottom: 15px;
}
.car-info-view .view-container{
	display:inline-block;
	vertical-align: top;
	width: 780px;
}
.car-info-view .aside{
	position: sticky;
	top: 10px;
	float: right;
	width: 400px;
}
.car-info-view .car-image,
.car-info-view .car-image .img-wrap,
.car-info-view .car-image .img-wrap img{
	width: 100%;
}
.car-info-view .car-image .img-wrap{
	position:relative;
	overflow: hidden;
	height: 520px;
}
.car-info-view .car-image .img-wrap.swiper{
	width: 780px;
	height: 520px;
}
.car-info-view .car-image .img-wrap img{
	position: absolute;
	width: 100%;
	top: 50%;
	transform: translateY(-50%);
}
.car-info-view .img-wrap .nav-prev,
.car-info-view .img-wrap .nav-next{
	display: inline-block;
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	font-size: 20px;
	color: #ffffff;
	background-color: #000000;
	border-radius: 8px;
	padding: 5px;
	height: 30px;
	width: 20px;
}
.nav-prev{
	left: 10px;
}
.nav-next{
	right: 10px;
}
.swiper-button-prev.nav-prev:after, .swiper-button-next.nav-next:after{
	content: none;
}
.swiper-button-prev.nav-prev:before, .swiper-button-next.nav-next:before{
	display: inline-block;
	width: 20px;
	height: 30px;
	text-align: center;
}
.nav-prev:before{
	content: '<';
}
.nav-next:before{
	content: '>';
}
.btn-zoom{
	position: absolute;
	bottom: 20px;
	right: 20px;
	padding: 7px;
	border-radius: 10px;
	line-height: 1;
	background-color: #000000;
	color: #ffffff;
	font-size: 13px;
	z-index: 1;
}
.car-info-view .car-image{
	position: relative;
}
.car-info-view .car-image .pagination{
	position: absolute;
	left: 20px;
	bottom: 20px;
	width: 50px;
	text-align: center;
	padding: 5px;
	border-radius: 20px;
	background-color: #000000;
	color: #ffffff;
	font-weight: 700;
}
.pagination .current-page:after{
	content: ' /';
}
.car-info-view .img-list-wrap{
	margin-top: 10px;
}
.car-info-view .img-list-wrap .img-list ul{
	display: flex;
	flex-wrap: wrap;
	background-color: #ffffff;
}
.car-info-view .img-list-wrap .img-list li{
	background-color: #ffffff;
	flex: 0 0 10%;
	height: 60px;
	overflow: hidden;
}
.car-info-view .img-list-wrap .img-list li > img{
	width: 100%;
	opacity: 0.5;
}
.car-info-view .img-list-wrap .img-list li.active{
	box-sizing: border-box;
	border: 2px solid #00b5ff;
}
.car-info-view .img-list-wrap .img-list li.active > img{
	opacity: 1;
}
.notice-small{
	text-align: center;
	margin-top: 15px;
	margin-bottom: 30px;
	font-size: 12px;
	color: #333333;
}
.car-info-view .detail-info dl{
	display: flex;
	flex-wrap: wrap;
	border-top: 1px solid #eeeeee;
}
.car-info-view .detail-info dl dt,
.car-info-view .detail-info dl dd{
	box-sizing: border-box;
	padding: 10px;
}
.car-info-view .detail-info dl dt.label{
	flex: 0 0 15%;
	background-color: #efefef;
	border-bottom: 1px solid #dedede;
	font-weight: 700;
	color: #888888;
	font-size: 12px;
}
.car-info-view .detail-info dl dd.info-data{
	flex: 0 0 35%;
	font-weight: 700;
	border-bottom: 1px solid #eeeeee;
	font-size: 13px;
}
.car-info-view .detail-info dl dd.info-data.stretch{
	flex: 1 0 75%;
}
.car-info-view .notice-must ul li{
	text-indent: -10px;
	margin: 8px 60px 8px 10px;
	line-height: 1.8;
	font-size: 14px;
	color: #333333;
	word-break: keep-all;
}

.car-info-view .car-info-summary{
	color: #333333;
}
.car-info-view .car-info-summary .summary-header{
	padding: 18px;
	background-color:#ebf6fb;
	border: 1px solid #e0e0e0;
	border-bottom: 0;
}
.car-info-view .car-info-summary .summary-header .car-name{
	margin-bottom: 8px;
	font-size: 18px;
	font-weight: 700;
}
.car-info-view .car-info-summary .summary-header .summary-info{
	font-weight: 600;
	color: #888888;
}
.car-info-view .car-info-summary .summary-header .summary-info > span:after{
	content: ' / ';
}
.car-info-view .car-info-summary .summary-header .summary-info > span:nth-last-of-type(1):after{
	content: none;
}
.car-info-view .car-info-summary .summary-body{
	padding: 18px 0;
	padding-bottom: 80px;
	border: 1px solid #e0e0e0;
	border-top: 0;
	border-bottom: 0;
}
.car-info-view .car-info-summary .summary-body .body-topper{
	display: flex;
	justify-content: space-between;
	padding: 0 18px;
	margin-bottom: 15px;
	color: #666666;
	font-size: 13px;
	font-weight: 700;
}
.car-info-view .car-info-summary .summary-body .body-topper .center > span{
	/* margin: 0 10px; */
}
.car-info-view .car-info-summary .summary-body .body-topper .suffix > span:after{
	content: '|';
	margin: 0 10px;
	color: #000000;
}
.car-info-view .car-info-summary .summary-body .body-topper .damage-type{
	color: purple;
}
.car-info-view .car-info-summary .summary-body .body-topper .bid-type{
	color: #2279cb;
}
.car-info-view .car-info-summary .summary-body .body-topper .bid-type em{
	font-weight: 700;
}
.car-info-view .car-info-summary .summary-body .body-topper .icon-heart{
	display: inline-block;
	width: 17px;
	height: 17px;
	background-image: url('/mainimg/icon_carheart_off.png');
	background-size: contain;
	background-repeat: no-repeat;
	vertical-align: text-bottom;
}
.car-info-view .car-info-summary .summary-body .body-topper .on .icon-heart{
	background-image: url('/mainimg/icon_carheart_on.png');
}

.car-info-view .car-info-summary .box-gray{
	background-color: #f8f8f8;
	padding: 18px;
}
.car-info-view .car-info-summary .box-pink{
	background-color: #fff2f5;
	padding: 18px;
}
.car-info-view .car-info-summary .bar-gray > ul > li{
	background-color: #f8f8f8;
}
.car-info-view .car-info-summary .summary-body .detail-info-table{
	margin-bottom: 5px;
}
.car-info-view .car-info-summary .summary-body .detail-info-table > ul > li{
	display: flex;
	/* margin: 12px 0; */
}
.car-info-view .car-info-summary .summary-body .detail-info-table > ul > li .label{
	flex: 0 0 120px;
	color: #666666;
}
.car-info-view .car-info-summary .summary-body .detail-info-table > ul > li .data{
	color: #333333;
	font-weight: 600;
}
.car-info-view .car-info-summary .summary-body .timer-count-down > ul > li{
	display: flex;
	justify-content: space-between;
}
.car-info-view .car-info-summary .summary-body .timer-count-down > ul > li .label{
	flex: 0 0 120px;
	font-size: 14px;
	font-weight: 600;
	color: #666666;
}
.car-info-view .car-info-summary .summary-body .timer-count-down > ul > li .data{
	color: #ff4141;
	font-weight: 600;
	font-size: 15px;
}
.car-info-view .car-info-summary .summary-body .timer-count-down > ul > li .data .unit{
	color: #333333;
}
.car-info-view .car-info-summary .notice-small.bold{
	font-weight: 700;
	font-size: 14px;
}
.car-info-view .car-info-summary .notice-small{
	font-size: 13px;
	text-align: left;
	margin: 15px 0 5px 0;
	padding: 0 18px;
}
.car-info-view .car-info-summary .summary-body input[type="checkbox"]{
	width: 14px;
	height: 14px;
	vertical-align: middle;
}
.car-info-view .car-info-summary .notice-small .fc-emphas{
	color: #ff4141;
}
.car-info-view .car-info-summary .summary-body .price-list{
	border-bottom: 1px solid #e0e0e0;
}
.car-info-view .car-info-summary .summary-body .bar-gray > ul > li{
	display: flex;
	height: 38px;
	background-color: #f8f8f8;
	margin-bottom: 1px;
	justify-content: space-between;
	align-items: center;
	font-size: 12px;
}
.car-info-view .car-info-summary .summary-body .bar-gray > ul > li label{
	vertical-align: middle;
}
.car-info-view .car-info-summary .summary-body .bar-gray > ul > li label input[type=radio]{
	vertical-align: middle;
}
.car-info-view .car-info-summary .summary-body .bar-gray > ul > li .label{
	font-weight: 700;
	flex: 0 0 100px;
	padding: 10px 10px 10px 18px;
	background-color: #e2e2e2;
	color: #888888;
}
.car-info-view .car-info-summary .summary-body .bar-gray > ul > li .label em{
	font-weight: 700;
}
.car-info-view .car-info-summary .summary-body .bar-gray > ul > li .data{
	font-size: 13px;
	font-weight: 700;
	padding: 10px 18px 10px 10px;
	color: #000000;
}
.car-info-view .car-info-summary .summary-body .bar-gray > ul > li .data .unit{
	color: #666666;
	margin-left: 5px;
	font-weight: 700;
}
.car-info-view .car-info-summary .summary-body .bar-gray > ul > li .data input{
	font-size: 13px;
}
.car-info-view .car-info-summary .summary-body .bar-gray > ul > li .data.flex-type{
	display: flex;
	justify-content: center;
	width: 100%;
	gap: 4px;
	align-items: center;
}
.car-info-view .car-info-summary .summary-body .bar-gray > ul > li .data.has-input{
	display: flex;
	align-items: center;
	justify-content: flex-end;
	padding: 5px 10px;
	width: calc(70% - 40px);
}
.car-info-view .car-info-summary .summary-body .price-list > ul > li .data input[type="text"]{
	flex: 0 1 70%;
	height: 30px;
	/* border: 0; */
	padding: 5px 10px;
	text-align: right;
	box-sizing: border-box;
	font-size: 15px;
	font-weight: 700;
	min-width: 80%;
}
.car-info-view .car-info-summary .summary-body .price-list > ul > li .data input[type="text"][readonly] {
	border: 0;
	background-color: transparent;
	opacity: 1;
	color: #000000;
}
.car-info-view .car-info-summary .summary-body .bar-gray > ul > li .data.has-input .unit{
	flex: 0 1 33px;
} 
.car-info-view .car-info-summary .summary-body .bar-gray .fc-emphas{
	color: #ff4141;
}
.car-info-view .car-info-summary .summary-body .price-list > ul > li .data .unit{
	color: #666666;
	margin-left: 5px;
	font-weight: 700;
}
.car-info-view .car-info-summary .summary-body .price-list > ul > li.total{
	height: auto;
	background-color: #ffffff;
	color: #2cade2;
}
.car-info-view .car-info-summary .summary-body .price-list > ul > li.total .label, .car-info-view .car-info-summary .summary-body .price-list > ul > li.total .data{
	background-color: #ffffff;
	color: #2cade2;
	font-weight: 700;
	font-size: 18px;
}
.car-info-view .car-info-summary .summary-body .price-list > ul > li.total .data{
	display: flex;
	align-items: center;
}
.car-info-view .car-info-summary .summary-body .price-list > ul > li.total .label, .car-info-view .car-info-summary .summary-body .price-list > ul > li.total .data input[type="text"][readonly]{
	flex: 1 1 auto;
	background-color: #ffffff;
	color: #2cade2;
	font-weight: 700;
	font-size: 18px;
}

.car-info-view .car-info-summary .summary-body .price-list > ul > li.total .data .unit{
	font-size: 14px;
	color: #2cade2; 
}
.car-info-view .car-info-summary .summary-footer .button-bottom-fix{
	position: absolute;
	display: flex;
	bottom: 0;
	left: 0;
	width: 100%;
}
.car-info-view .car-info-summary .summary-footer .button-bottom-fix [class*=btn-]{
	flex: 1 1 50%;
}
.car-info-view .summary-footer [class*="btn-"]{
	font-size: 16px;
	text-align: center;
	height: 60px;
	display: flex;
	align-items: center;
	justify-content: center;
	box-sizing: border-box;
}
.car-info-view .btn-outline{
	border: 1px solid #2cade2;
	color: #2cade2;
}
.car-info-view .btn-fill{
	border: 0;
	background-color: #2cade2;
	color: #ffffff;
}
.car-info-view .location-wrap{
	text-align: right;
	padding: 10px 0;
	font-weight: 700;
}
.car-info-view .location-wrap a{
	display: inline-block;
}

.zoom-image-wrap{
	min-width: 800px;
	width: 100%;
}
.zoom-image-wrap .header-summary{
	width: 100%;
}
.zoom-image-wrap .img-list-wrap{
	margin-top: 10px;
}
.zoom-image-wrap .img-list-wrap .img-list ul{
	display: flex;
	padding: 0;
	flex-wrap: wrap;
	background-color: #ffffff;
}
.zoom-image-wrap .img-list-wrap .img-list li{
	background-color: #ffffff;
	flex: 0 0 10%;
	height: 60px;
	overflow: hidden;
}
.zoom-image-wrap .img-list-wrap .img-list li > img{
	width: 100%;
	opacity: 0.5;
}
.zoom-image-wrap .img-list-wrap .img-list li.active{
	box-sizing: border-box;
	border: 2px solid #00b5ff;
}
.zoom-image-wrap .img-list-wrap .img-list li.active > img{
	opacity: 1;
}

.layer-popup-wrap{
	display: none;
	position: fixed;
	top:0;
	left: 0;
	right: 0;
	height: 100%;
	background-color: rgba(0,0,0,.3);
	z-index: 1;
}
.layer-popup-wrap.open{
	display: block;
}

.layer-popup-wrap .popup-content{
	position: absolute;
	display: block;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	width: 1000px;
	min-height: 300px;	
	background-color: #ffffff;
}

.layer-popup-wrap .popup-content .popup-header{
	position: relative;
	padding: 15px;
	text-align: left;
	background-color: #2cade2;
	font-size: 16px;
	color: #ffffff;
	font-family: 'SCoreDream', sans-serif;
}
.layer-popup-wrap .popup-content .popup-header p.summary{
  margin: 0;
}
.layer-popup-wrap .popup-header .close-popup{
	position: absolute;
	right: 15px;
	top: 14px;
  font-size: 16px;
	color: #ffffff;
}
.layer-popup-wrap .popup-content .img-large{
	height: 600px;
	background-color: rgba(0,0,0,.8);
}
.layer-popup-wrap .popup-content .img-large img{
	height: 600px;
	width: 1000px;
	object-fit: contain;
}

.layer-popup-wrap .img-list-wrap{
	margin-top: 10px;
}
.layer-popup-wrap .img-list-wrap .img-list ul{
	display: flex;
	flex-wrap: wrap;
	background-color: #ffffff;
  padding: 0;
  margin: 0;
}
.layer-popup-wrap .img-list-wrap .img-list li{
	background-color: #ffffff;
	flex: 0 0 5%;
	height: 40px;
	overflow: hidden;
}
.layer-popup-wrap .img-list-wrap .img-list li > img{
	width: 100%;
	opacity: 0.5;
}
.layer-popup-wrap .img-list-wrap .img-list li.active{
	box-sizing: border-box;
	border: 2px solid #00b5ff;
}
.layer-popup-wrap .img-list-wrap .img-list li.active > img{
	opacity: 1;
}
.layer-popup-wrap .car-image .pagination{
	position: absolute;
	left: 20px;
	bottom: 20px;
	width: 60px;
	text-align: center;
	padding: 5px;
	border-radius: 20px;
	background-color: #000000;
	color: #ffffff;
	font-weight: 700;
}
.layer-popup-wrap .img-wrap .nav-prev,
.layer-popup-wrap .img-wrap .nav-next{
	display: inline-block;
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	font-size: 20px;
	color: #ffffff;
	background-color: #000000;
	border-radius: 8px;
	padding: 5px;
	height: 30px;
	width: 20px;
}
.vlign-m{
	vertical-align: middle;
}</style>

<table width="900" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
  <tr> 
    <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" class="bullet">  
      <strong>차량정보</strong></td>
  </tr>
  <tr> 
    <td align="left">
	
<?
if($row[car_cate]){
	$team_cate=mysql_fetch_array(mysql_query("select * from team_cate where idx='".$row[car_cate]."'"));
	$car_cate=$team_cate["name"];
} else {
	$car_cate="X";
}
if($row[car_cate2]){
	$team_cate2=mysql_fetch_array(mysql_query("select * from team_cate where idx='".$row[car_cate2]."'"));
	$car_cate2=$team_cate2["name"];
}
?>
	<table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0;word-break:break-all;" class="table-style">
		<colgroup>
			<col style="width: 120px;">
			<col style="width: 330px;">
			<col style="width: 120px;">
			<col style="width: 330px;">
		</colgroup>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >차량번호</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
            <?=$row[wc_no]?>          </td>
          <td class="table-th" bgcolor="f6f6f6" >보 험 사</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <?=$car_cate?><?=$car_cate2?" / ".$car_cate2:""?>                              </td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >차대번호</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
            <?=$row[wc_prog_area_price]?></td>
          <td class="table-th" bgcolor="f6f6f6" >전손/분손</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
          <?=$row[evalAmt_type]!="미정"?$row[evalAmt_type]:""?></td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >제조사</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
<?
	$sql="select * from cate2 where idx='$row[wc_made]' ";
	$result_made=mysql_query($sql);
	$data_made=mysql_fetch_array($result_made);
	echo $data_made[name];
?>          <?=$row[made_dong]?></td>
          <td class="table-th" bgcolor="f6f6f6" >모 델 명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <?=$row[wc_model]?> <?=$row[wc_model2]?></td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >년식(등록일)</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <?if($row[wc_age])?>
           
            <?=substr($row[wc_age],0,4)?>
            년 
            <?=substr($row[wc_age],4,2)?>
            월</td>
          <td class="table-th" bgcolor="f6f6f6" >변 속 기</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_trans]?></td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >연 료</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_fual]?></td>

          <td class="table-th" bgcolor="f6f6f6" >배 기 량</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <?=number($row[wc_cc])?>
            cc </td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >주행거리</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
            <?=number($row[wc_mileage])?>
            km </td>
          <td class="table-th" bgcolor="f6f6f6" >세전출고가</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <?=number($row[wc_price ])?>
            원</td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >예상수리비</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <?=number($row[wc_cost])?>
            원</td>
          <td class="table-th" bgcolor="f6f6f6" >사고발생일</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_acc_date]?></td>
        </tr>
        <tr>
          <td class="table-th" bgcolor="f6f6f6" >발생비용</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=number($row[wc_go_cost])?>
            원</td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >차량설명</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding:3 0 0 10;" >
            <?=nl2br($row[wc_damage])?>          </td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >입고일</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <?=$row[wrhsDate]?>          </td>
          <td class="table-th" bgcolor="f6f6f6" >보관장소1</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <?=$row[moveKeepReq]?>          </td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >보관지역</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">

<?

		//== /lib/code.php 안에 있음
		WriteArrHTML('select', 'area1', $ArrcarPlace , $row[wc_keep_area1], '', '' , 'direct', '' );
?></td>
          <td class="table-th" bgcolor="f6f6f6" >보관장소2</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
<?=$row[wc_keep_place1]?></td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >보관소연락처</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">

<?=$row[wc_keep_tel1]?></td>
          <td class="table-th" bgcolor="f6f6f6" >담 당 자</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
<?=$row[wc_keep_name1]?></td>
        </tr>
         <!--tr> 
          <td height="20" align="center" bgcolor="f6f6f6">보관장소2</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">

<?

		//== /lib/code.php 안에 있음
		WriteArrHTML('select', 'area1', $ArrcarPlace , $row[wc_keep_area2], '', '' , 'direct', '' );
?></td>
          <td width="100" align="center" bgcolor="f6f6f6">보관장소상세</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
<?=$row[wc_keep_place2]?></td>
        </tr>
        <tr> 
          <td height="20" align="center" bgcolor="f6f6f6">보관소연락처</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">

<?=$row[wc_keep_tel2]?></td>
          <td align="center" bgcolor="f6f6f6">담 당 자</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
<?=$row[wc_keep_name2]?></td>
        </tr-->
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >소유형태</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 


		<?
			//== /lib/code.php 안에 있음
			WriteArrHTML('radio', 'ArrcarOwner', $ArrcarOwner, $row[wc_ownertype], '', '', 'direct', '');
		   ?>
		   
			</td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >차 주 명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <?=$row[wc_owner]?>          </td>
          <td class="table-th" bgcolor="f6f6f6" >차주연락처</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <?=$row[wc_owner_tel]?>          </td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" style="padding-top:5px;padding-bottom:5px;" >사 진<br>
          <img src="/manage/img/imgv.gif" width="75" height="19" onclick="location.href = location.href.split('#')[0]+'#1';openLayerPop()" style="cursor:pointer;" /> </td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding:5 10 5 10"><table width="100%"  border="0">
            <tr>
              <td>
                  <table width="100%" border="0" align="center">
                    <tr>
                      <?
			$cnt = 0;	
			for($i=1; $i<=100; $i++) {
				$file_name = 'wc_img_'.$i;
				$real_name = explode('/',$row[$file_name]);
				$fileName = 'file'.$i;
				if(strlen($real_name[0]) == 0)
				{
					$fileName = 'noImage_auction.gif';
				}
				else
				{
					$fileName = $real_name[0];
					if(!file_exists($_SERVER[DOCUMENT_ROOT]."/data/".$fileName)){
						copy($_SERVER[DOCUMENT_ROOT]."/mobile/data/".$fileName,$_SERVER[DOCUMENT_ROOT]."/data/".$fileName);
					}
				}
				
											
			?>
                      <td><table border="0" width="100%" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="10">
							<?if($fileName != 'noImage_auction.gif'){?>
                                <a class="hand" onclick="location.href = location.href.split('#')[0]+'#<?=$i?>';openLayerPop()" > p-
                                  <?=$i?>
                                </a>
							<?
								$cnt++;	
							}
							?>
							</td>
                          </tr>
                      </table></td>
                      <? 
			if($cnt&&$cnt%10 == 0){ echo '</tr><tr>';}
                          }  ?>
                    </tr>
                  </table>
              </td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>




</div>


<!-- layerPopup -->
<!-- 차량이미지 상세보기 -->
<div class="layer-popup-wrap">
	<div class="popup-content">
		<div class="popup-header">
			<p class="summary">
				<span class="label">No :</span><span class="dd"><?=$row[wc_orderno]?></span> &nbsp;/&nbsp;
				<span class="dd"><?=$row[wc_model]?></span> &nbsp;/&nbsp;
				<span class="dd"><?if($row[wc_age])?> <?=substr($row[wc_age],0,4)?> 년 <?=substr($row[wc_age],4,2)?>월</span> &nbsp;/&nbsp;
				<span class="dd"><?=$row[wc_mem_name]=="동부"?$row[trans_dong]:$row[wc_trans] ?></span> &nbsp;/&nbsp;
				<span class="dd"><?=$row[wc_mem_name]=="동부"?$row[fual_dong]:$row[wc_fual] ?></span> &nbsp;/&nbsp;
				<span class="dd"><?=number_format($row[wc_cc])?>cc</span> &nbsp;/&nbsp;
				<span class="dd"><?=number_format($row[wc_mileage])?>km</span>
			</p>
			<a href="javascript:void()" class="close-popup">닫기</a>
		</div>
		<div class="popup-body">
			<!-- 차량이미지 -->
			<div class="car-image">
				<div class="img-wrap swiper img-large">
					<div class="swiper-wrapper">
						<!-- 차량이미지 리스트 -->
						<!-- description 
							슬라이드 이미지 리스트에는 data-hash값
							썸네일 리스트에는 data-thumb값을 매핑해줘야
							큰 이미지와 썸네일이 연동됨
						-->
<?
for($i=1; $i<=100; $i++) {

	$fileName = $row["wc_img_".$i];
	$real_name = explode('/', $fileName);	
	if(strlen($real_name[0]) == 0) break;
    $fileName = $site_u[home_url]."/data/".$real_name[0]; 
?>
					<div data-hash="<?=$i?>" class="swiper-slide">
						<img src="<?=$fileName?>" alt="차량이미지">
					</div> 
<? 
}	
?>  
					</div>

					<!-- navigator -->
					<div class="swiper-button-prev nav-prev"></div>
					<div class="swiper-button-next nav-next"></div>

					<!-- pagination -->
					<div class="swiper-pagination pagination"></div>

				</div>
			</div>
			<!-- //차량이미지 -->

			<!-- 차량이미지 리스트 -->
			<div class="img-list-wrap">
				<div class="img-list">
					<ul>
<?
for($i=1; $i<=100; $i++) {

	$fileName = $row["wc_img_".$i];
	$real_name = explode('/', $fileName);	
	if(strlen($real_name[0]) == 0) break;
    $fileName = $site_u[home_url]."/data/".$real_name[0]; 
?>
  <li data-thumb="<?=$i?>" <?if($i == 1){?>class="active"<?}?>><img src="<?=$fileName?>" alt="차량이미지 썸네일"></li> 
<? 
}	
?>
					</ul>
				</div>
			</div>
			<!-- //차량이미지 리스트 -->
		</div>
		<div class="popip-footer">

		</div>
	</div>
	<script>
		// 팝업 swiper
		// 차량이미지 swipe기능
		const popupSwiper = new Swiper('.popup-body .swiper', {
			loop: false,
			width: 1000,
			pagination: {
				el: '.swiper-pagination',
				type: "fraction",
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			hashNavigation: {
				watchState: true,
			},
		});
    popupSwiper.on('slideChangeTransitionEnd', function(swiper){
      console.log('swiper', swiper.activeIndex);
      $(`.img-list > ul > li[data-thumb="${swiper.activeIndex+1}"]`).addClass('active').siblings().removeClass('active');
    })
		// 썸네일 클릭 연동
		$('.popup-body .img-list > ul > li').on('click',function(e){
			var target = $(this).data('thumb');
			$(this).addClass('active').siblings().removeClass('active');
			console.log(target);
			location.href = location.href.split('#')[0]+'#'+target;
		});
		// 팝업 닫기
		$('.layer-popup-wrap .close-popup').on('click', function(){
			$('.layer-popup-wrap').removeClass('open')
		});
		// 팝업 열기
		function openLayerPop(){
			$('.layer-popup-wrap').addClass('open');
		}
	</script>
</div>
<!-- //차량이미지 상세보기 -->
<!-- //layerPopup -->

