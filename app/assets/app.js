const $ = require('jquery');
window.$ = $;
window.jQuery = $;
import './styles/app.scss';

    const ESPCR = ESPCR || {};

    function extend(destination, source) {
        var toString = Object.prototype.toString,
            objTest = toString.call({});
        for (const property in source) {
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

        }
    });


    extend(ESPCR, {

        customFormElements:{



            init: function(){
                $('input[type=checkbox]').iCheck({
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
                if(!$('#yt-player').length) return false;

                var v = $('#yt-player').data('yt');

                var videoid = v.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);

                var tag = document.createElement('script');

                tag.src = "https://www.youtube.com/iframe_api";
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);




                var player;
                window.onYouTubePlayerAPIReady = function() {
                    player = new YT.Player('yt-player', {
                        height: '390',
                        width: '100%',
                        videoId: videoid[1],
                    });
                }

                // if(videoid != null) {
                //    console.log("video id = ",videoid[1]);
                //    $('#yt-player').append('<img class="img-responsive" src="http://img.youtube.com/vi/'+videoid[1]+'/hqdefault.jpg" />').click(function(){
                //     $('#yt-player').empty().player({video: videoid[1], width: '100%'})
                //    })
                // } else {
                //     console.log("The youtube url is not valid.");
                // }
                // $('#yt-player').player({video: v, width: '100%'})

            }
        }
    })






    $(document).ready(function () {

        ESPCR.navbar.init();
        ESPCR.locationsMap.init();
        // ESPCR.registrationForm.init();
        ESPCR.youtubeList.init();
        ESPCR.customFormElements.init();


    });



