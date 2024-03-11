const incaronUI = {
  gnbScrollEffect: function(){
   let offsetTop = 0;
   $(document).on('scroll', function(){
    offsetTop = $(window).scrollTop();
    if( offsetTop > 0 ){
      $('header').addClass('bg-white');
    } else {
      $('header').removeClass('bg-white');
    }
   })
  },
  navMouseHover: function(){
    let index = 0;
    $('.nav').mouseleave(function(){
      $('header').removeClass('open');
      $('.nav-list > li').removeClass('on');
    })

    $('.nav-list > li').hover(function(e){
      // mouseover
      index = $(this).index();
      $('header').addClass('open');
      $('.nav-list > li').eq(index).addClass('on').siblings().removeClass('on');
      $('.depth-02-list > li').eq(index).addClass('on').siblings().removeClass('on');
    }, function(){
      // mouseleave
      
    });
    $('.depth-02-list > li').hover(function(){
      index = $(this).index();
      $('.depth-02-list > li').eq(index).addClass('on').siblings().removeClass('on');
      $('.nav-list > li').eq(index).addClass('on').siblings().removeClass('on');
    })
  },
  quickMenu : function(){
    //퀵메뉴
    let offsetTop = 0;
    $(window).on('scroll', function(e){
      offsetTop = $(window).scrollTop();
      if( offsetTop > 300 ){
        $('.quick-menu').addClass('on');
      } else {
        $('.quick-menu').removeClass('on');
      }
    })  
  },
  mainImageSlide: function(){
    var swiper = new Swiper(".swiper.main-visual", {
      autoplay: {
        delay: 6000
      },
      effect: 'fade',
      speed: 1000,
      fadeEffect:{
        crossFade: true
      }
    });
  },
}
$(function(){
  // incaronUI.gnbScrollEffect();
  incaronUI.navMouseHover();
  incaronUI.quickMenu();
  incaronUI.mainImageSlide();
});
