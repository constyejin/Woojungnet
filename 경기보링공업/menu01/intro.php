<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/inc/styles/form-table.css">
<link rel="stylesheet" href="/menu01/style/intro.css">

<main class="company-info">
  <section class="company-info-content">
    <h2 class="sub-title">회사소개
      <span><a href="#map-sec">오시는길</a></span>
    </h2>

    <div>
      <div class="company-info-img">
        <img src="/inc/assets/images/road.jpeg" alt="">
      </div>

      <div class="company-info-txt">
        <h3>안녕하십니까?</h3>
        <h4>(주)경기보링공업 홈페이지를 방문해 주셔서 감사합니다.</h4>
        <p>경기보링공업은 경기도의 대표적인 자동차엔진 전문기업입니다. </p>
        <p> 국내 어느곳이든 24시간 견인이 가능하며 국내 최저 비용으로 </p>
        <p>고객님의 부담을 덜어드립니다.</p>
        <p>
        언제나 고객의 입장에서 성실하고 책임감있는 서비스를 </p>
        <p>제공할것이며  고객님의  불편사항도 신속하게 </p>
        <p> 책임지고 처리해 드리겠습니다. </p>
        <p>우수한 인재를 보유하고 고객만족을 최우선으로 하며</p>
        <p>정확하고 안전한서비스의 제공을 약속드립니다 </p>
        <p>항상 지켜바주시고 격려와 응원을 보내주십시요.</p>
        <p>감사합니다 . </p>
        <h4>(주)경기보링공업 임직원 일동</h4>
      </div>
    </div>
  </section>

  <section id="map-sec" class="company-map">
    <h2>오시는 길</h2>
    <table>
      <thead>
        <tr>
          <th>도로명주소</th>
          <td>인천광역시 서구 거북로22 2동&#40;석남동&#41;</td>
        </tr>

        <tr>
          <th>대 표 전 화</th>
          <td>032-673-2511</td>
        </tr>
      </thead>
      <tr class="table-map">
        <td colspan="2" style="padding:0;">
          <div id="map" style="width:1200px; height:600px;"></div>
          <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=5df378863cf00d87eaff3de9f96ddcc6"></script>
          <script>
            let mapContainer = document.getElementById('map'), 
                mapOption = { 
                    center: new kakao.maps.LatLng(37.5016816, 126.6638402), 
                    level: 3 
                };

            let map = new kakao.maps.Map(mapContainer, mapOption); 
            let marker = new kakao.maps.Marker({ 
              position: map.getCenter() 
            }); 
            
            marker.setMap(map);

            kakao.maps.event.addListener(map, 'click', function(mouseEvent) {        
              let latlng = mouseEvent.latLng; 
              marker.setPosition(latlng);
              
              let message = '클릭한 위치의 위도는 ' + latlng.getLat() + ' 이고, ';
              message += '경도는 ' + latlng.getLng() + ' 입니다';
              
              let resultDiv = document.getElementById('clickLatlng'); 
              resultDiv.innerHTML = message;
            });
          </script>
        </td>
      </tr>
    </table>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>
