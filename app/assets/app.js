import { Datepicker } from 'vanillajs-datepicker';
import './styles/app.scss';

const ESPCR = ESPCR || {};

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

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
            $('input, select').removeAttr('required');
            const elem = document.querySelector('input.datepicker-input');
      //     const datepicker = new Datepicker(elem, {'language': 'hu', 'format': 'yyyy-mm-dd',
      //     'minDate': '2019-09-15',
      //         'maxDate': '2021-10-14'});


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



            var lastvideo = getCookie('lastvideo');
            if (lastvideo) {
                $('.show-video[data-id="' + lastvideo + '"]').click();
                document.cookie = "lastvideo=0";

            }





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

    rate:{



        init: function(){


            $(document).on('click','.show-rate-video', function(e){
                e.preventDefault();
                var url = $(this).attr('href');

                $('#main-modal .modal-content').load(url, function(){
                    $('#main-modal').modal('show')
                    var id = $(this).closest('[data-id]').data('current-id')
                    document.cookie = "lastrated=" + id;
                    ESPCR.rate.load();
                });
            })

            $(document).on(
                'submit',
                'form[name="jury_vote"]',
                ESPCR.rate.handleNewFormSubmit.bind(this)
            );

            $(document).on('show.bs.modal', '#confirm-finalize', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                alert('OK')
            });

            ESPCR.rate.calcPercents();

        },

        calcPercents: function () {
            $('.rates .panel').each(function (i, el) {
                var total = $('tr', el).length - 1;
                var rated = $('tr.rated', el).length;
                var percent = Math.round(rated / total * 100);
                $('.rate-percent', el).text( total + '/' + rated);
                $('.rate-bar', el).css('width',  percent + '%');
                $('.rate-bar', el).addClass('length-' +  Math.round(percent) );
            })
        },

        handleNewFormSubmit: function(e) {
            e.preventDefault();
            var $form = $(e.currentTarget);
            var id = $('[data-current-id]').data('current-id');
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                success: function(data) {
                    $('#main-modal').modal('hide');
                    $('tr[data-id="'+id+'"]').replaceWith(data)
                    ESPCR.rate.calcPercents();

                },
                error: function(jqXHR) {
                    $form.closest('.rate-form-wrapper').html(jqXHR.responseText);
                    ESPCR.rate.load();
                }


            });
        },

        load: function(){

            $('.video-item__btn--close').click(function(e){
                e.preventDefault();
                $('#main-modal .modal-content').empty()
                $('#main-modal').modal('hide');
            })



            $('#jury_vote_rate').rating({stars: 10, step: 1, min: 0, max: 10, size:'lg'});

            ESPCR.customFormElements.init();
            ESPCR.rate.calcPercents();

            var player = new YT.Player('player', {
                height: $('#player').closest('.video-item').height(),
                width: $('#player').closest('.video-item').width(),
                videoId: $("#player").data('video-id'),
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });


            $('.video-item__btn--play, .video-item__image').click(function(e){

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
                    $('.video-item__btn--play').fadeIn()
                }
                if (event.data == YT.PlayerState.PLAYING) {
                    $('.video-item__btn--stop').fadeIn();
                    $('.video-item__btn--play').fadeOut()
                }
            }
            function stopVideo() {
                player.stopVideo();
            }

        }
    }
})




extend(ESPCR, {

    youtubeList:{



        init: function(){




            if(!$('.yt-player').length) return false;
            var players = [];

            YTdeferred.done(function(YT) {


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


            $(document).on('click', '.fb-login', function (e) {
                var id = $(this).closest('[data-current-id]').data('current-id')
                document.cookie = "lastvideo=" + id;
            })




            var tag = document.createElement('script');

            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


            window.YTdeferred = $.Deferred();
            window.onYouTubeIframeAPIReady = function() {
                // resolve when youtube callback is called
                // passing YT as a parameter
                YTdeferred.resolve(window.YT);

                var id = window.location.hash.replace('#video-', '');
                if(id){
                    $('.votes, .rate').find("[data-id='" + id + "']").click();
                    window.location.href.split('#')[0]
                }

            };
        }
    }


})





$(document).ready(function () {
    ESPCR.navbar.init();
    ESPCR.locationsMap.init();
    // ESPCR.registrationForm.init();
    ESPCR.youtube.init();
    ESPCR.youtubeList.init();
    ESPCR.customFormElements.init();
    ESPCR.vote.init();
    ESPCR.rate.init();
});



