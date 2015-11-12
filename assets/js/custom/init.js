$(document).ready(function() {
  makeResponsive();
  addTweets();
  footerContact();
  cboxSlideShow();
});

function cboxSlideShow(){
  $(".cbox-gallary1, .slideshow").colorbox({rel:'gallary', scrolling:false, transition:"fade", slideshow:true, preloading:true, fixed:true, slideshowSpeed:"4000"});
}

function footerContact(){
  $('.newsletter form').submit(function(e){
    e.preventDefault();
    window.location.href = "/contact?email="+$('.newsletter form input').val();
  });
}

function addTweets() {
  $.getJSON("assets/php/tweets.php", function(data) {
    var items = [];
    $.each(data, function(key, val) {
      items.push("<div class='tweet'>" + val['text'] + "<br><span style=\"font-style: italic;\">" + val['time'] + "</span></div><br>");
    });
    $('.tweets').append(items.join(""));
  });
}

function makeResponsive() {
  var isMobile = null
  var size = null
  if ($(window).width() > 1920) {
    isMobile = false
    size = "xlg"
  } else if ($(window).width() <= 1920 && $(window).width() >= 992) {
    isMobile = false
    size = "lg"
  } else if ($(window).width() < 992 && $(window).width() >= 768) {
    isMobile = false
    size = "md"
  } else if ($(window).width() < 768 && $(window).width() >= 600) {
    isMobile = true
    size = "sm"
  } else if ($(window).width() < 600 && $(window).width() >= 320) {
    isMobile = true
    size = "xs"
  } else {
    isMobile = true
  }
  if (isMobile) {
    $('.parallax, .parallax-section1').removeClass('parallax').removeClass('parallax-section1').css('top', '0px').removeClass('parallax-background2')
    $('.section-counter').addClass('forced')
    $('.world-map').removeClass('world-map')
    $('#pollyfill-canvas').attr('width', '0')
    $('.bg-img-staff').css('background-position', '30% 0px')
  } else {
    switch (size) {
      case "xlg":
        $('.section-counter').addClass('forced')
        break
      default:
        $('.section-counter').attr('style', "background-image: url('assets/img/full/31-opt.jpg')")
    }
  }
}
