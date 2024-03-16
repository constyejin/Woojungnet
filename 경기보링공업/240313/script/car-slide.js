$(document).ready(function(){
  $('.slide-img-list').slick({
    prevArrow: `<button type="button" class="slick-prev">
                  <i class="fa-solid fa-angle-left"></i>
                </button>`,         
    nextArrow: `<button type="button" class="slick-next">
                  <i class="fa-solid fa-angle-right"></i>
                </button>`,       
    dots: true,
    autoplay: false,
  });

  $('.slide-thum-list').slick({
    prevArrow: false,         
    nextArrow: false,   
    slidesToShow: 10, 
    focusOnSelect: true,
    centerMode: false,
    infinite: false,
  });

  let cur = 0;
  let len = $('.slick-track li').length;
  $('.slick-track').width(120 * len);

  function sliding(dir,num){
    cur = cur + dir;
    if(len <= num) {
      // 아이템이 10개 미만인 경우
      $('.prev-btn').attr('disabled', true);
      $('.next-btn').attr('disabled', true);
      return;
    }

    if(cur >= len - num) {
      // 마지막 페이지일 떄
      cur = len - num;
      $('.prev-btn').attr('disabled', false);
      $('.next-btn').attr('disabled', true);
    } else if(cur <= 0) {
      // 첫 번째 페이지일 때
      cur = 0;
      $('.prev-btn').attr('disabled', true);
      $('.next-btn').attr('disabled', false);
    } else {
      $('.prev-btn').attr('disabled', false);
      $('.next-btn').attr('disabled', false);
    }

    $('.slick-track').animate({
      marginLeft : -120 * cur + "px"
    })

    $('.slick-track').animate({
      marginLeft : -120 * cur + "px"
    })
  }

$('.prev-btn').on('click', function(){
  sliding(-10, 10);
})

$('.next-btn').on('click', function(){
  sliding(10, 10);
})

    // 썸네일 클릭시 해당 슬라이드 보이기
    // $('.slide-thum-item').on('click', function(){
    //   var index = $(this).index();
    //   $('.slide-img-list').slick('slickGoTo', index);
    // });
})

