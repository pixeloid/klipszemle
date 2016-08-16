var ESPCR = ESPCR || {};

;(function ($, window, document, undefined) {

  'use strict';



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
                    scrollTop: $($anchor.attr('href').replace('/', '')).offset().top - 50
                }, 1500, 'easeInOutExpo');
                event.preventDefault();
            });
        });

        // Closes the Responsive Menu on Menu Item Click
        $('.navbar-collapse ul li a').click(function() {
            $('.navbar-toggle:visible').click();
        });


      }
    }
  });


  extend(ESPCR, {

    customFormElements:{
    


      init: function(){
        $('input[type=checkbox]').addClass('styled').each(function(){
        	$(this).insertBefore($(this).parent())
        });

        $('input, select').removeAttr('required');
        // $('.selectpicke').selectpicker({
        //   style: 'btn-info',
        //   size: 4
        // });
        $('#pixeloid_appbundle_eventregistration_song_publish_date').datepicker({'language': 'hu', 'format': 'yyyy-mm-dd'});
        $('#pixeloid_appbundle_eventregistration_video_publish_date').datepicker({'language': 'hu', 'format': 'yyyy-mm-dd',  'startDate': '2015-05-01'});

      }
    }
  })


  extend(ESPCR, {

    youtubeList:{
    


      init: function(){


        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      },

      load: function(){

        if(!$('.yt-player').length) return false;
        var players = [];

        function createVideo(el, h, videoid) {
            return new YT.Player(el, {
              height: h ? h : '390',
              width: h*1.5,
              videoId: videoid[1],
            });
          }

          $('.yt-player').each (function(){
            var el = $(this)[0];
            var v = $(this).data('yt');
            var videoid = v.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
            var h = $(this).data('height');
            players.push(createVideo(el, h, videoid))
          })
      }
    }
  })







  $(function () {

    ESPCR.navbar.init();
    // ESPCR.locationsMap.init();
   // ESPCR.registrationForm.init();
    ESPCR.customFormElements.init();
    ESPCR.youtubeList.init();
    window.onYouTubePlayerAPIReady = function() {
      ESPCR.youtubeList.load();
    }

    $('#eventregistration_datatable').on( 'draw.dt', function () {
      ESPCR.youtubeList.load();
    } );

  });

}(jQuery, this, this.document));

