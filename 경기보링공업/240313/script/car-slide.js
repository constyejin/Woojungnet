// swiper
let cur = 0;

let len = $('.work-status .img-list > ul > li').length;
console.log(len)
$('.work-status .img-list > ul').width(120 * len);
    
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

  $('.work-status .img-list > ul').animate({
    marginLeft : -120 * cur + "px"
  })

  $('.work-status .img-list > ul').animate({
    marginLeft : -120 * cur + "px"
  })
}

$('.work-status .img-list .prev-btn').on('click', function(){
  sliding(-10, 10);
})

$('.work-status .img-list .next-btn').on('click', function(){
  sliding(10, 10);
})

// 차량이미지 swipe기능
$(function(){
  var bx = $('.bxslider').bxSlider({
    mode: 'fade',
    speed: 100,
    slideWidth: 1200,
    pagerType: 'short',
    nextText: '',
    prevText: '',
    pager: true,
    infiniteLoop: false,
    onSlideAfter: function($slideElement, oldIndex, newIndex){
      console.log('bx', newIndex);
      $('.view-thumb .img-list > ul > li[data-thumb="'+(newIndex+1)+'"]').addClass('active').siblings().removeClass('active');

      $('.view-thumb .img-list > ul').animate({
        marginLeft: -(Math.floor(newIndex / 10) * 1200) + "px"
      });
    }
  });
  
  $('.view-thumb .img-list > ul > li').on('mouseenter',function(e){
    var target = $(this).data('thumb');
    $(this).addClass('active').siblings().removeClass('active');
    console.log(target);
    bx.goToSlide(target-1);
  });
})

