<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/inc/styles/form-table.css">
<link rel="stylesheet" href="/menu01/style/intro.css">

<main class="company-info">
  <section class="company-info-content">
    <p class="menu-path sm-only">홈 > 회사소개</p>
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
        <p>(주)경기보링공업은 인천 및 경기도의 대표적인 자동차엔진 전문기업입니다. </p>
        <p> 국내 어느곳이든 24시간 견인이 가능하며 국내 최저 비용으로 </p>
        <p>고객님의 부담을 덜어드립니다.</p>
        <p>언제나 고객의 입장에서 성실하고 책임감있는 서비스를 </p>
        <p>제공할것이며  고객님의  불편사항도 신속하게 </p>
        <p> 책임지고 처리해 드리겠습니다. </p>
        <p>우수한 인재를 보유하고 고객만족을 최우선으로 하며</p>
        <p>정확하고 안전한서비스의 제공을 약속드립니다 </p>
        <p>항상 지켜 봐 주시고 격려와 응원 부탁드립니다.</p>
        <p>감사합니다 . </p>
        <h4>(주)경기보링공업 임직원 일동</h4>
      </div>
    </div>
  </section>

  <section id="map-sec" class="company-map">
    <h2 class="sub-title">오시는 길</h2>

    <div class="map-table">
      <ul class="map-table-list">
        <li class="table-title">도로명주소</li>
        <li class="table-content">인천광역시 서구 거북로24번길22. 2동&#40;석남동&#41;</li>
      </ul>

      <ul class="map-table-list">
        <li class="table-title">대 표 전 화</li>
        <li class="table-content">
          <a href="tel:032-571-4117">032-571-4117</a>
        </li>
      </ul>

      <div class="map" id="map"></div>
        <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=5df378863cf00d87eaff3de9f96ddcc6"></script>
        <script>
          let mapContainer = document.getElementById('map'), 
          mapOption = { 
            center: new kakao.maps.LatLng(37.5016816, 126.6638402), 
            level: 3 
          };

          let map = new kakao.maps.Map(mapContainer, mapOption); 

          var content = '<div class="customoverlay">' +
          ' <span>' +
          '  (주)경기보링공업' +
          '  </span>' +
          '</div>';

          var position = new kakao.maps.LatLng(37.5016816, 126.6638402);

          var customOverlay = new kakao.maps.CustomOverlay({
            map: map,
            position: position,
            content: content,
            yAnchor: 1
          });


          var markerPosition  = new daum.maps.LatLng(37.5016816, 126.6638402);

          var marker = new daum.maps.Marker({
            position: markerPosition,
            title : "(주)경기보링공업",
            clickable : true
          });
            
          marker.setMap(map);

          // 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
          var mapTypeControl = new daum.maps.MapTypeControl();

          // 지도에 컨트롤을 추가해야 지도위에 표시됩니다
          // daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
          map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);

          // 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
          var zoomControl = new daum.maps.ZoomControl();
          map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);
        </script>
    </div>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>
