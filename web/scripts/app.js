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
        // 
        var $cb = $('<input class="styled" type="checkbox"> ');
        $('#pixeloid_appbundle_eventregistration_extra_info').parent().wrap('<div class="checkbox">').prepend($cb);
        $cb.on('change', function () {
          if($(this).prop('checked')) {
            $('#pixeloid_appbundle_eventregistration_extra_info').show()
          } else {
            $('#pixeloid_appbundle_eventregistration_extra_info').hide();
          }
        }).change();

        $('#pixeloid_appbundle_eventregistration_song_publish_date').datepicker({'language': 'hu', 'format': 'yyyy-mm-dd'});
        $('#pixeloid_appbundle_eventregistration_video_publish_date').datepicker({'language': 'hu', 'format': 'yyyy-mm-dd',  'startDate': '2015-05-01'});
      }
    }
  })


  extend(ESPCR, {

    vote:{
    


      init: function(){

        $('#main-modal').on('hidden.bs.modal', function (e) {
          $('#main-modal .modal-content').empty()        
        })


            $('.show-video').click(function(e){
              e.preventDefault();
              var url = $(this).attr('href');

              $('#main-modal .modal-content').load(url, function(){
                $('#main-modal').modal('show')
                ESPCR.vote.load();

              });
            })






      },

      load: function(){

        $('.video-item__btn--close').click(function(e){
          e.preventDefault();
          $('#main-modal .modal-content').empty()        
          $('#main-modal').modal('hide');
        })

              var player = new YT.Player('player', {
                height: $('#player').closest('.video-item').height(),
                width: $('#player').closest('.video-item').width(),
                videoId: $("#player").data('video-id'),
                events: {
                  'onReady': onPlayerReady,
                  'onStateChange': onPlayerStateChange
                }
              });


              $('.video-item__btn--play').click(function(e){
                
                e.preventDefault();

                $('#player').show();

                player.playVideo();
              
              })
              
              $('.video-item__btn--stop').click(function(e){
                e.preventDefault();
                $('#player').fadeOut();
                $(this).fadeOut();
                player.stopVideo();
              })

              // 4. The API will call this function when the video player is ready.
              function onPlayerReady(event) {
              //  event.target.playVideo();
              }

              // 5. The API calls this function when the player's state changes.
              //    The function indicates that when playing a video (state=1),
              //    the player should play for six seconds and then stop.
              var done = false;
              function onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.ENDED) {
                  $('#player').fadeOut();
                }
                if (event.data == YT.PlayerState.PLAYING) {
                  $('.video-item__btn--stop').fadeIn();
                }
              }
              function stopVideo() {
                player.stopVideo();
              }


              $('.video-item__btn--vote').click(function(e){
                e.preventDefault();
                var url = $(this).attr('href');

                $('#main-modal .modal-content').html('<span class="loader">Generálás folyamatban...</span>');
                $('#main-modal .modal-content').load(url, function(){
                  $('#main-modal .loader').hide();
                });
              })

      }
    }
  })




  extend(ESPCR, {

    youtubeList:{
    


      init: function(){



        if(!$('.yt-player').length) return false;
        var players = [];

        YTdeferred.done(function(YT) {
          console.log('YTdeferred.done');

          function createVideo(el, h, videoid) {
            return new YT.Player(el, {
              height: h ? h : '390',
              width: h*1.5,
              videoId: videoid
            });
          }

          $('.yt-player').each (function(){
            var el = $(this)[0];
            var v = $(this).data('yt');
            var videoid = v.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
            var h = $(this).data('height');
            players.push(createVideo(el, h, videoid[1]));
          })

        })

      }

    }

  })

  extend(ESPCR, {

    youtube:{
    


      init: function(){

        var tag = document.createElement('script');
        tag.src = "http://youtube.com/iframe_api";
        tag.id = "youtubeScript";
        var firstScriptTag = document.getElementsByTagName('script')[1];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        window.YTdeferred = $.Deferred();
        window.onYouTubeIframeAPIReady = function() {
          console.log('API ready');
          // resolve when youtube callback is called
          // passing YT as a parameter
          YTdeferred.resolve(window.YT);

          var id = window.location.hash.replace('#video-', '');
          if(id){
            $('.votes').find("[data-id='" + id + "']").click();
            window.location.href.split('#')[0]
          }

        };
      }
    }
  })




  extend(ESPCR, {

    swiper:{
    


      init: function(){
        var heroSwiper = new Swiper ('.heroes .swiper-container', {
          // Optional parameters
          loop: true,
          loopedSlides: 1
        })
        var sponsorSwiper = new Swiper ('.sponsors .swiper-container', {
          // Optional parameters
          loop: true,
          slidesPerView: 10,
          breakpoints: {
            // when window width is <= 320px
            600: {
              slidesPerView: 2,
            },
            // when window width is <= 480px
            800: {
              slidesPerView: 3,
            },
            // when window width is <= 640px
            1000: {
              slidesPerView: 4,
            },
            1100: {
              slidesPerView: 5,
            },
            1200: {
              slidesPerView: 6,
            },
            1300: {
              slidesPerView: 8,
            }
          },
          autoplay: {
            delay: 2000,
          },


        })
      }
    }
  })







  $(function () {
    ESPCR.youtube.init();
    ESPCR.navbar.init();
    ESPCR.customFormElements.init();
    ESPCR.vote.init();
    ESPCR.swiper.init();
    
    $('#eventregistration_datatable').on( 'draw.dt', function () {
      ESPCR.youtubeList.init();
    });

  });




}(jQuery, this, this.document));



