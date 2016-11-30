//var initMap;

(function() {
  var args, countPrice;
  $('#topSlider').owlCarousel({
    singleItem: true,
    navigation: true,
    pagination: true,
    navigationText: [],
    autoPlay: 4000,
    slideSpeed: 500
  });
  args = {
    items: 4,
    navigation: false,
    pagination: true,
    navigationText: [],
    slideSpeed: 500
  };
  $('#artistSlider').owlCarousel(args);
  $('#eventsSlider').owlCarousel(args);
  $('#gallerySlider').owlCarousel({
    items: 3,
    navigation: false,
    pagination: true,
    navigationText: [],
    slideSpeed: 500,
    afterAction: function(el) {
      this.$owlItems.removeClass('active');
      this.$owlItems.eq(this.currentItem + 1).addClass('active');
    }
  });
  $('#artistPhotos').owlCarousel({
    items: 5,
    navigation: true,
    pagination: false,
    navigationText: [],
    slideSpeed: 500
  });
  $('section:not(.page) .owl-carousel').after('<div class="nav"> <div class="owl-prev"></div><div class="owl-next"></div></div>');
  $('section .nav div').click(function() {
    var owl;
    owl = $(this).parents('section').find('.owl-carousel').data('owlCarousel');
    if ($(this).hasClass('owl-prev')) {
      return owl.prev();
    } else {
      return owl.next();
    }
  });
  $('.btn-up').click(function() {
    return $('html,body').animate({
      scrollTop: 0
    });
  });
  $(window).scroll(function() {
    if ($(window).scrollTop() > 400) {
      return $('.btn-up').addClass('visible');
    } else {
      return $('.btn-up').removeClass('visible');
    }
  });
  $('.wrapper-filter select.form-control').selectize();
  $('.price-slider').ionRangeSlider({
    type: 'double',
    min: 1000,
    max: 500000,
    from: 1000,
    to: 500000,
    step: 1000
  });
  $('.light-gallery-wrapper').lightGallery({
    thumbnail: true
  });
  $('#artistPhotos').lightGallery({
    thumbnail: true,
    selector: '.photo'
  });
  $('.ticket-count .btn').click(function(e) {
    var count;
    e.preventDefault();
    count = $(this).parent().find('input');
    if ($(this).hasClass('btn-default')) {
      if (parseInt(count.val()) > 0) {
        count.val(parseInt(count.val()) - 1);
      }
    } else {
      count.val(parseInt(count.val()) + 1);
    }
    return countPrice();
  });
  $('.ticket-count input').keyup(function(e) {
    if (/\D/g.test(this.value)) {
      this.value = this.value.replace(/\D/g, '');
    }
    return countPrice();
  }).blur(function() {
    if (!this.value) {
      this.value = 0;
    }
    return countPrice();
  });
  $('.ticket-count input').change(function() {
    return countPrice();
  });
  countPrice = function() {
    var price;
    price = 0;
    $('.ticket-count input').each(function() {
      price += parseInt($(this).val()) * parseInt($(this).data('price'));
    });
    $('#price').text(price + ' грн');
  };
})(jQuery);

var initMap = function() {
  var map, marker, myLatLng;
  myLatLng = {
    lat: 50.441699,
    lng: 30.588512
  };
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    scrollwheel: false,
    center: myLatLng
  });
  marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    icon: '/template/images/marker.png',
    title: 'NOTA Production'
  });
};
