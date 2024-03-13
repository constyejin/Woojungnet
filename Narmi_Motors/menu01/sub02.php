<?
include "../inc/header.php";
include "../inc/menu_sub.php";
?>
  <div class="sub-visual">
    <!-- 서브비주얼 -->
    <img src="/front/src/image/img_sub_visual.png" alt="">
    <!-- <div class="title">
      <p class="catch-phrase">대한민국의 운송장비의 성공신화 !!</p>
      <p class="sub-text">화물차! 특장차! 캠핑카! 책임있고 오랜경험을 고객님들과 함께 합니다. </p>
      <p class="third-text">TEL  1588-1277  , FAX  02-794-3300</p>
    </div> -->
  </div>
  <div class="content-wrap sub greetings">
    <div class="anchor-wrap">
      <a href="#" class="anchor"></a>
    </div>
    <section class="greeting-header">
      <div class="container">
        <div class="prefix">
          <h2>오시는길</h2>
        </div>
        <div class="suffix">
          <div class="home">
            <a href="./main.html" class="btn-home">
              <span class="icon-home"></span>
            </a>
          </div>
          <div class="location">
            회사소개 > 오시는길
          </div>
        </div>
      </div>
    </section>
    <section class="address item">
      <div class="container">
        <div class="tab-wrap tab-map">
          <div class="tab-list pillow-type">
            <ul>
              <li class="tab-item on">
                <a href="" class="btn btn-outline-default sm">서울 사무실</a>
              </li>
              <li class="tab-item">
                <a href="" class="btn btn-outline-default sm">화성공장</a>
              </li>
            </ul>
          </div>
          <div class="tab-content-list">
            <div class="tab-content on" data-tab="0">
              <div class="adress-header">
                <div class="label">서울 사무실</div>
                <div class="dd">서울 용산구 원효로 243-2 1층</div>
                <div class="label">전화번호</div>
                <div class="dd">1588-1277</div>
              </div>
              <div id="map" class="map_box map" style="width:100%;"></div>
              
            </div>
            <div class="tab-content on" data-tab="1">
              <div class="adress-header">
                <div class="label">화성공장</div>
                <div class="dd">경기 화성시 송산면 화성로 580-73 (삼존리850-2)</div>
                <div class="label">전화번호</div>
                <div class="dd">1588-1277</div>
              </div>
              <div id="map2" class="map_box map" style="width:100%;"></div>
              <!-- <script type="text/javascript" src="https://dapi.kakao.com/v2/maps/sdk.js?appkey=28f94abb713814ba163cea75e257b50b"></script> -->
            </div>
          </div>

        </div>

      </div>
    </section>
  </div>
<?
include "../inc/consult_form.php";
include "../inc/footer.php";
?>

  <script type="text/javascript" src="https://dapi.kakao.com/v2/maps/sdk.js?appkey=28f94abb713814ba163cea75e257b50b"></script>
  <script>
    $(document).ready(function(){
    // 서울사무실
      var mapContainer = document.getElementById('map');
      var mapOption = {
        center: new daum.maps.LatLng(37.53969502292853, 126.96808334221633),
        level: 4
      };

      var map = new daum.maps.Map(mapContainer, mapOption);

      // 커스텀 오버레이 내용
      var content = '<div class="customoverlay">' +
      ' <span>' +
      '  나르미모터스(주)' +
      '  </span>' +
      '</div>';

      // 커스텀 오버레이가 표시될 위치입니다 
      var position = new kakao.maps.LatLng(37.53969502292853, 126.96808334221633);  

      // 커스텀 오버레이를 생성합니다
      var customOverlay = new kakao.maps.CustomOverlay({
        map: map,
        position: position,
        content: content,
        yAnchor: 1 
      });

      // 마커가 표시될 위치입니다 
      var markerPosition  = new daum.maps.LatLng(37.53969502292853, 126.96808334221633); 

      // 마커를 생성합니다
      var marker = new daum.maps.Marker({
        position: markerPosition,
        title : "나르미모터스(주)",
        clickable : true
      });

      // 마커가 지도 위에 표시되도록 설정합니다
      marker.setMap(map);

      // 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
      var mapTypeControl = new daum.maps.MapTypeControl();

      // 지도에 컨트롤을 추가해야 지도위에 표시됩니다
      // daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
      map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);

      // 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
      var zoomControl = new daum.maps.ZoomControl();
      map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);
      });
    // 화성공장

      var mapContainer2 = document.getElementById('map2');
      var mapOption2 = {
        center: new daum.maps.LatLng(37.2088849481323, 126.754531665954),
        level: 4
      };

      var map2 = new daum.maps.Map(mapContainer2, mapOption2);

      // 커스텀 오버레이 내용
      var content2 = '<div class="customoverlay">' +
      ' <span>' +
      '  나르미모터스(주)화성공장' +
      '  </span>' +
      '</div>';

      // 커스텀 오버레이가 표시될 위치입니다 
      var position2 = new kakao.maps.LatLng(37.2088849481323, 126.754531665954);  

      // 커스텀 오버레이를 생성합니다
      var customOverlay = new kakao.maps.CustomOverlay({
        map: map2,
        position: position2,
        content: content2,
        yAnchor: 1 
      });

      // 마커가 표시될 위치입니다 
      var markerPosition2  = new daum.maps.LatLng(37.2088849481323, 126.754531665954); 

      // 마커를 생성합니다
      var marker2 = new daum.maps.Marker({
        position: markerPosition2,
        title : "나르미모터스(주)",
        clickable : true
      });

      // 마커가 지도 위에 표시되도록 설정합니다
      marker2.setMap(map2);

      // 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
      var mapTypeControl2 = new daum.maps.MapTypeControl();

      // 지도에 컨트롤을 추가해야 지도위에 표시됩니다
      // daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
      map2.addControl(mapTypeControl2, daum.maps.ControlPosition.TOPRIGHT);

      // 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
      var zoomControl2 = new daum.maps.ZoomControl();
      map2.addControl(zoomControl2, daum.maps.ControlPosition.RIGHT);

      $('.tab-content').eq(1).removeClass('on');
      

  </script>
