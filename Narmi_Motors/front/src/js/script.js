const narmiUi = {
  gnbHoverMain: (e) => {
    $('.gnb .depth-1 > li > a').mouseenter(function(e){
      $(this).parent('li').siblings().find('a').removeClass('active');
      $(this).addClass('active').siblings();
    });
    $('.gnb .depth-1').mouseenter(function(e){
      let scrollTop = $(window).scrollTop();
      if( scrollTop > 10 ){
        $('.gnb').addClass('open bg-color-white');
        $('.btn-menu').addClass('bg-color-white');
      } else {
        $('.gnb').addClass('open bg-color-dark');
      }
    });
    $('.gnb').mouseleave(function(e){
      let scrollTop = $(window).scrollTop();
      if( scrollTop > 10 ){
        $('.gnb').removeClass('open');
        $('.gnb').addClass('bg-on bg-color-white');
        $('.btn-menu').addClass('bg-color-white');
      } else {
        $('.gnb').removeClass('open bg-color-dark bg-color-white');
        $('.btn-menu').removeClass('bg-color-white');
      }
      $('.gnb .depth-1 > li a').removeClass('active');
    })
  },
  gnbHoverSub: (e) => {
    $('.gnb .depth-1 > li > a').mouseenter(function(e){
      $(this).parent('li').siblings().find('a').removeClass('active');
      $(this).addClass('active').siblings();
    });
    $('.gnb .depth-1').mouseenter(function(e){
      let scrollTop = $(window).scrollTop();
      $('.gnb').addClass('open bg-color-white');
      $('.btn-menu').addClass('bg-color-white');
    });
    $('.gnb').mouseleave(function(e){
      let scrollTop = $(window).scrollTop();
      $('.gnb').removeClass('open');
      $('.gnb').addClass('bg-on bg-color-white');
      $('.btn-menu').addClass('bg-color-white');
      $('.gnb .depth-1 > li a').removeClass('active');
    })
  },
  gnbScrollMain: () => {
    $(window).scroll(function(e){
      let scrollTop = $(this).scrollTop();
      if( scrollTop > 10 ){
        if($('.gnb').hasClass('open')){
          $('.gnb').removeClass('bg-color-dark');  
          $('.gnb').addClass('bg-color-white');
          $('.btn-menu').addClass('bg-color-white');  
        } else {
          $('.gnb').addClass('bg-on bg-color-white');
          $('.btn-menu').addClass('bg-color-white');
        }
      } else {
        if($('.gnb').hasClass('open')){
          $('.gnb').addClass('bg-color-dark');
          $('.gnb').removeClass('bg-color-white');
          $('.btn-menu').removeClass('bg-color-white');
        } else {
          $('.gnb').removeClass('bg-on bg-color-white');
          $('.btn-menu').removeClass('bg-color-white');
        }
      }
    })
  },
  mainScrollAnimation: function(){
    let posArr = [];
    let scrollTop = 0;
    let adjust = 600;
    $('.products .item').each((index, item)=>{
      posArr.push($(item).offset().top);
    });
    let posBanner = $('.wide-banner').offset().top;
    let posContact = $('.contact-us').offset().top;
    $(window).on('scroll', function(e){
      scrollTop = $(this).scrollTop();
      // 제품설명영역
      posArr.forEach(function(item, index){
        if( scrollTop > posArr[index] - adjust ){
          $('.products .item').eq(index).addClass('on');
        }
      });
      //배너영역
      if( scrollTop > posBanner - adjust - 100){
        $('.wide-banner').addClass('on');
      }
      if( scrollTop > posContact - adjust){
        $('.contact-us').addClass('on');
      }
    });
    if(window.innerWidth < 960){
      setTimeout(function(){
        // $('.products .item').eq(0).addClass('on');
      }, 500);
    }
  },
  greetScrollAnimation: function(){
    let posArr = [];
    let scrollTop = 0;
    let adjust = 600;
    $('.greetings .item').each((index, item)=>{
      posArr.push($(item).offset().top);
    });
    $(window).on('scroll', function(e){
      scrollTop = $(this).scrollTop();
      // 제품설명영역
      posArr.forEach(function(item, index){
        if( scrollTop > posArr[index] - adjust ){
          $('.greetings .item').eq(index).addClass('on');
        }
      });
    });
    setTimeout(function(){
      $('.greeting.item').addClass('on');
    },100);
  },
  megadrop:function(){
    $('.btn-menu').on('click', function(e){
      e.preventDefault();
      if(window.innerWidth > 960){
        $('.depth-2').show();
      }
      $('body').toggleClass('prevent-scroll');
      $(this).toggleClass('active');
      if( $('.megadrop').hasClass('open') ){
        //닫힘
        $('.megadrop').removeClass('open');;
        setTimeout(function(){
          $('.megadrop').css('display', 'none');
        },500);
      } else {
        //열림
        $('.megadrop').css('display', 'block');
        setTimeout(function(){
          $('.megadrop').addClass('open');;
        },100);
      }
    });
    $('.megadrop .sitemap > ul > li > .title').on('click', function(e){
      if(window.innerWidth < 960){
        console.log($(this).next('.depth-2'));
        $(this).next('.depth-2').slideToggle().toggleClass('on');
        $(this).toggleClass('on');
      }
    })
  },
  storeTruckSlider: function(){
    const swiper = new Swiper('.vehicle-slider', {
      loop: true,
      slidesPerView: 1,
      loopedSlides: 1,
      spaceBetween: 30,
      centeredSlides: true,
      pagination: {
        el: '.swiper-pagination',
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        960:{
          slidesPerView: 'auto'
        }
      }
    })

    //클릭방지
    $('.vehicle-slider a').on('click', function(e){
      e.preventDefault();
      console.log('클릭');
    })
  },
  storeDetailSlider: function(){
    const swiper = new Swiper('.vehicle-detail-slide', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      effect: 'fade'
    });
    const $thumb = $('.thumbnail-list li');
    swiper.on('slideChangeTransitionEnd', function(swiper){
      $thumb.removeClass('on').eq(swiper.activeIndex).addClass('on');
    });
    $thumb.on('mouseenter', function(e){
      e.preventDefault();
      let index = $(this).index();
      swiper.slideTo(index);
    })
  },
  storeDetailSliderThumb: function(){
    $thumb = $('.thumbnail-list li');
    
  },
  storeOptionColorSelect: function(){
    $chipsList = $('.color-chip-list li');
    $chips = $('.color-chip-list li a');
    $chips.on('click', function(e){
      e.preventDefault();
      let target = $(this).parent('li');
      target.addClass('selected').siblings().removeClass('selected');
    })
  },
  storeOptionFunctionSelect: function(){
    $functionList = $('.first-options li');
    $functionItem = $('.first-options li .item-wrap');
    $functionItem.on('click', function(e){
      let target = $(this).parent('li');
      target.toggleClass('selected');
    })
  },
  tab:function(){
    //화면이동방지
    $('.tab-item a').on('click', function(e){
      e.preventDefault();
    })
    const $tabItems = $('.tab-wrap .tab-list .tab-item');
    $tabItems.on('click', function(){
      $(this).addClass('on').siblings().removeClass('on');
      let index = $(this).index();
      $(this).parents('.tab-wrap').find('.tab-content').removeClass('on').eq(index).addClass('on');
    });
  },
  layerPop: function(){
    $('.toggle-layer-pop').on('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      $('.layer-pop, .dim').css('display', 'block');
      $('.layer-pop, .dim').animate({'opacity':1});
    });
    $('.layer-pop .btn-close, .layer-pop .btn-close-bottom').on('click', function(e){
      e.preventDefault();
      $('.dim').animate({'opacity': 0});
      $(this).parents('.layer-pop').animate({'opacity': 0});
      setTimeout(() => {
        $('.dim').css('display','none');
        $(this).parents('.layer-pop').css('display', 'none');
      }, 500);
    });
  },
  checkAll: function(){
    $('#all-check').on('change', function(e){
      console.log('check', $(this).is(':checked'));
      if($(this).is(':checked')){
        $('input[type="checkbox"]').each(function(){
          this.checked = true;
        })
      } else {
        $('input[type="checkbox"]').each(function(){
          this.checked = false;
        })
      }
    })
  },
  floatBar: function(){
    $(window).scroll(function(e){
      let scrollTop = $(this).scrollTop();
      if( scrollTop > 300 ){
        $('.floating-bar').addClass('on');
        $('.anchor-wrap').addClass('on');
      } else {
        $('.floating-bar').removeClass('on');
        $('.anchor-wrap').removeClass('on');
      }
    })
  }
}
$(function(e){
  if($('body').children().is('.main')){
    narmiUi.mainScrollAnimation(); //메인 스크롤 이벤트 애니메이션
    narmiUi.gnbHoverMain(); //메인 마우스오버 이벤트
    narmiUi.gnbScrollMain(); //메인 스크롤 이벤트
  }
  if($('body').children().is('.sub-visual')){
    narmiUi.storeTruckSlider(); // 화물차 슬라이더
    narmiUi.gnbHoverSub(); // 서브 마우스오버 이벤트
    // narmiUi.gnbScrollSub(); //서브 스크롤 이벤트
    narmiUi.storeDetailSlider();
  }
  narmiUi.megadrop(); //메인 스크롤 이벤트 애니메이션
  narmiUi.tab();
  narmiUi.storeOptionColorSelect(); //색상선택
  narmiUi.storeOptionFunctionSelect(); //색상선택
  narmiUi.layerPop(); //레이어팝업
  narmiUi.checkAll(); //목록 전체선택
  narmiUi.greetScrollAnimation(); //인사말 애니메이션
  narmiUi.floatBar(); //총가격 플로팅바
})