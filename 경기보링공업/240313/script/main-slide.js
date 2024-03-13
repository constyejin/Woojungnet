$(document).ready(function(){
  $('.slide-img-list').slick({
    prevArrow: "<button type='button' class='slick-prev'><i class='fa-solid fa-angle-left'></i></button>",         
    nextArrow: "<button type='button' class='slick-next'><i class='fa-solid fa-angle-right'></i></button>",    
    dots: true,
    autoplay: true,
    autoplaySpeed: 4000
  });

  $('.slide-img-list').find('[data-slick-index=0]').children('li').animate({
    opacity: 1
  });

  $(".slide-img-list").on("afterChange", function(slick,aaa){
    $(this).find(".slick-slide").children("li").css({
      opacity: 0,
    });

    let c = aaa.currentSlide;
    $(this).find("[data-slick-index="+c+"]").children("li").animate({
      opacity: 1,
    });
  });
})


