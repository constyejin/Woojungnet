$(document).ready(function(){
    let bx = $('.bxslider').bxSlider({
    mode: 'fade',
    speed: 100,
    slideWidth: 1200,
    pagerType: 'short',
    nextText: '<i class="fa-solid fa-chevron-right"></i>',
    prevText: '<i class="fa-solid fa-chevron-left"></i>',
    pager: true,
    infiniteLoop: false,
    onSlideAfter: function($slideElement, oldIndex, newIndex){
      $('.view-thumb .img-list > ul > li[data-thumb="'+(newIndex+1)+'"]').addClass('active').siblings().removeClass('active');

      $('.view-thumb .img-list > ul').animate({
        marginLeft: -(Math.floor(newIndex / 10) * 1200) + "px"
      });
    }
  });
  
  $('.view-thumb .img-list > ul > li').on('mouseenter',function(e){
    var target = $(this).data('thumb');
    $(this).addClass('active').siblings().removeClass('active');
    bx.goToSlide(target-1);
  });

  
  // swiper
  let cur = 0;

  let len = $('.view-thumb .img-list > ul > li').length;
  $('.view-thumb .img-list > ul').width(120 * len);
      
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

    $('.view-thumb .img-list > ul').animate({
      marginLeft : -120 * cur + "px"
    })

    $('.view-thumb .img-list > ul').animate({
      marginLeft : -120 * cur + "px"
    })
  }

  $('.view-thumb .img-list .prev-btn').on('click', function(){
    sliding(-10, 10);
    console.log('이전이전');
  })

  $('.view-thumb .img-list .next-btn').on('click', function(){
    sliding(10, 10);
    console.log('다음다음');
  })

})



