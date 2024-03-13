const incaronUI = {
  allMenu: function(){
    $('.btn-all-menu').on('click', function(e){
      e.preventDefault();
      $('.all-menu').addClass('open');
    });
    $('.btn-close-menu').on('click', function(e){
      e.preventDefault();
      $('.all-menu').removeClass('open');
    })
  },
  popToggle: function(){
    $('.layer-pop-toggle').on('click', function(){
      $('.layer-pop').addClass('open');
      $('body').css('overflow','hidden');
    });
    $('.layer-pop .btn-close-pop').on('click', function(e){
      e.preventDefault();
      $('.layer-pop').removeClass('open');
      $('body').css('overflow','auto');
    })
  },
  toggleBottomFixedButton: function(){
    $(document).on('scroll',function(){
      offsetTop = $(window).scrollTop();
      if( offsetTop > 0 ){
        $('.bottom-fixed.fade-in').addClass('active');
      } else {
        $('.bottom-fixed.fade-in').removeClass('active');
      }
    })
  },
  viewImageSlide: function(){
    var swiper = new Swiper(".swiper.car-list", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      slidesPerView: 2.1,
      spaceBetween: 10,
      slidesPerGroup: 2,
      breakpoints: {
        480: {
          slidesPerView: 4.5,
          slidesPerGroup: 4,
          spaceBetween: 10,
        },
      },
      on:{
        slideChangeTransitionEnd: function(swiper){
          // console.log(swiper.activeIndex);
        }
      }
    });
  },
  home_key: function(){
    // 접속 핸드폰 정보 
    
    var userAgent = navigator.userAgent.toLowerCase();
    
    var url = "http://www.taegeummotors.com/";
    
    var icon = "http://www.taegeummotors.com/images/front/icon_app_install.png";
    
    var title = "Taegeum";
    
    var serviceCode = "nstore";
    
    window.open('naversearchapp://addshortcut?url='+url+'&icon='+icon+'&title='+title+'&serviceCode='+serviceCode+'&version=7')
    
  }
}
$(function(){
  incaronUI.allMenu();
  incaronUI.popToggle();
  incaronUI.toggleBottomFixedButton();
  incaronUI.viewImageSlide();
});