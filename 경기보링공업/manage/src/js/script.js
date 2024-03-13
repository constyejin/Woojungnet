$().ready(function(){
  $('.nav.nav-tabs .nav-link').on('click',function(e){
    e.preventDefault();
    let index = $(this).parents('li').index();
    $('.nav.nav-tabs .nav-link').removeClass('active');
    $('.tab-contents .tab').removeClass('active');
    $(this).addClass('active');
    $('.tab-contents .tab').eq(index).addClass('active');
  });

  function layerPop(){
    $('.toggle-layer-pop').on('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      $('.layer-pop, .dim').css('display', 'block');
      $('.layer-pop, .dim').animate({'opacity':1});
    });
    $('.layer-pop .btn-close, .layer-pop .close-pop').on('click', function(e){
      e.preventDefault();
      $('.dim').animate({'opacity': 0});
      $(this).parents('.layer-pop').animate({'opacity': 0});
      setTimeout(() => {
        $('.dim').css('display','none');
        $(this).parents('.layer-pop').css('display', 'none');
      }, 500);
    });
  }
  
  // function storeOptionFunctionSelect(){
  //   $functionList = $('.additional-option-list-wrap li');
  //   $functionItem = $('.additional-option-list-wrap li .item-wrap');
  //   $functionItem.on('click', function(e){
  //     let target = $(this).parent('li');
  //     target.toggleClass('selected');
  //   })
  // }
  
  function storeDetailSlider(){
    const swiper = new Swiper('.vehicle-detail-slide', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
    const $thumb = $('.thumbnail-list li');
    swiper.on('slideChangeTransitionEnd', function(swiper){
      $thumb.removeClass('on').eq(swiper.activeIndex).addClass('on');
    });
    $thumb.on('click', function(e){
      e.preventDefault();
      let index = $(this).index();
      swiper.slideTo(index);
    })
  }

  function storeOptionColorSelect(){
    $chipsList = $('.color-chip-list li');
    $chips = $('.color-chip-list li a');
    $chips.on('click', function(e){
      e.preventDefault();
      if($(this).parents('.store-detail-preview').length || $(this).parents('.select-options').length){
        let target = $(this).parent('li');
        let $color1 = $(this).closest('#color1');
        let $color2 = $(this).closest('#color2');
        
        if($(this).parents('.select-options.select-one').length){
          target.addClass('selected').siblings().removeClass('selected');
        } else {
          if($color1.length){
            if(target.find('input[name="car_color1[]"]').is(':checked')){
              target.toggleClass('selected');
            } else {
              alert('노출상품으로 체크 후 이용하세요');
            }
          } else if($color2.length) {
            if(target.find('input[name="car_color2[]"]').is(':checked')){
              target.toggleClass('selected');
            } else {
              alert('노출상품으로 체크 후 이용하세요');
            }
          } else {
            target.toggleClass('selected');

          }
        }
      }
    })
  }
  
  function storeOptionFunctionSelect(){
    $functionList = $('.first-options li');
    $functionItem = $('.first-options li .item-wrap');
    $functionItem.on('click', function(e){
      console.log($(this).parent('li'));
      if($(this).parents('.store-detail-preview').length || $(this).parents('.select-options').length){
        let target = $(this).parent('li');
        let $choice1 = $(this).closest('#choice1');
        let $choice3 = $(this).closest('#choice3');
        console.log('$choice', $choice1);
        if($choice1.length) {
          if(target.find('input[name="car_choice1[]"]').is(':checked')){
            target.toggleClass('selected');
          } else {
            alert('노출상품으로 체크 후 이용하세요');
          }
        } else if($choice3.length) {
          if(target.find('input[name="car_choice3[]"]').is(':checked')){
            target.toggleClass('selected');
          } else {
            alert('노출상품으로 체크 후 이용하세요');
          }
        }
        // target.toggleClass('selected');
      }
    })
  }
  
  function tab(){
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
  }
  function checkAll(){
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
  }
  function btnCheckAll(){
    $('.btn-check-all').on('click', function(){
      $('.check-all-target input[type="checkbox"]').each(function(){
        this.checked = true;
      })
    });
    $('.btn-checkout-all').on('click', function(){
      $('.check-all-target input[type="checkbox"]').each(function(){
        this.checked = false;
      })
    });
  }
  function floatBar(){
    console.log('floating');
    $('.content-container').scroll(function(e){
      console.log('scroll');
      let scrollTop = $(this).scrollTop();
      if( scrollTop > 300 ){
        $('.floating-bar').addClass('on');
      } else {
        $('.floating-bar').removeClass('on');
      }
    })
  }


  layerPop();
  storeOptionFunctionSelect();
  storeOptionColorSelect();
  storeDetailSlider();
  tab();
  checkAll();
  btnCheckAll();
  floatBar();
})