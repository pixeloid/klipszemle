var ESPCR = ESPCR || {};


function extend(destination, source) {
    var toString = Object.prototype.toString,
        objTest = toString.call({});
    for (var property in source) {
        if (source[property] && objTest == toString.call(source[property])) {
            destination[property] = destination[property] || {};
            extend(destination[property], source[property]);
        } else {
            destination[property] = source[property];
        }
    }
    return destination;
};


extend(ESPCR, {
  navbar:{
    init: function(){
      
      $(window).scroll(function() {
          if ($(".navbar").offset().top > 50) {
              $(".navbar-fixed-top").addClass("top-nav-collapse");
          } else {
              $(".navbar-fixed-top").removeClass("top-nav-collapse");
          }
      });

      // jQuery for page scrolling feature - requires jQuery Easing plugin
      $(function() {
          $('a.page-scroll').bind('click', function(event) {
              var $anchor = $(this);
              $('html, body').stop().animate({
                  scrollTop: $($anchor.attr('href').replace('/', '')).offset().top
              }, 1500, 'easeInOutExpo');
              event.preventDefault();
          });
      });

      // Closes the Responsive Menu on Menu Item Click
      $('.navbar-collapse ul li a').click(function() {
          $('.navbar-toggle:visible').click();
      });


    },
  }
});


extend(ESPCR, {
  locationsMap:{
    init: function(){
      
      if(!$('.page-map').length) return false;

      this.createMap();

    },

    createMap: function(){
      var geocoder = new google.maps.Geocoder();
      var latlng = new google.maps.LatLng(47.8669915,19.978868,14);
      var mapOptions = {
        zoom: 15,
        center: latlng
      }
      map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

      var markers = [];





      var colors = ['e70000', 'dfe700', '5ce700', 'f99bcc', '0082e7', '2100e7', 'df00e7', ]

      $('.page-map .nav  li a').each(function(i){

        var address = $('small', this).text();
        var $link = $(this)

        $(this).parent().css('border-left', '8px solid #' + colors[i])

        geocoder.geocode( { 'address': address}, function(results, status) {

          var location = results[0].geometry.location;

          if (status == google.maps.GeocoderStatus.OK) {
             //  map.setCenter(results[0].geometry.location);
             var marker = new google.maps.Marker({
               map: map,
               icon: 'http://gmapsmarkergenerator.eu01.aws.af.cm/getmarker?scale=1&color=' + colors[i],
               position: results[0].geometry.location
             });

             $link.click(function(e){
              e.preventDefault();
              $('.page-map .nav  li').removeClass('active')
              $(this).parent().addClass('current')
              map.panTo(location);
              map.setZoom(16);
            })

          } else {
             alert('Geocode was not successful for the following reason: ' + status);
          }



        })



      })
    }
  }
});


extend(ESPCR, {

  customFormElements:{
  


    init: function(){
      $('input').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'iradio_minimal-grey',
      });

      $('input, select').removeAttr('required');
      $('select').selectpicker();
      $('.datepicker').datepicker({'language': 'hu', 'format': 'yyyy-mm-dd'});

    }
  }
})


extend(ESPCR, {

  youtubeList:{
  


    init: function(){

        $('.yt-player').each(function(){
          var v = $(this).data('yt');

          var videoid = v.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
          if(videoid != null) {
             console.log("video id = ",videoid[1]);
             $(this).append('<img class="img-responsive" src="http://img.youtube.com/vi/'+videoid[1]+'/hqdefault.jpg" />').click(function(){
              $(this).empty().player({video: videoid[1], width: '100%'})
             })
          } else { 
              console.log("The youtube url is not valid.");
          }
          //$(this).player({video: v, width: '100%'})
        })

    }
  }
})






$(document).ready(function(){

  ESPCR.navbar.init();
  ESPCR.locationsMap.init();
 // ESPCR.registrationForm.init();
  ESPCR.youtubeList.init();
  ESPCR.customFormElements.init();


  $(".table-reg").tablesorter(); 
});

