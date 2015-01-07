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
  locationsMap:{
    init: function(){
      
      if(!$('.page-map').length) return false;

      this.createMap();

    },

    createMap: function(){
      var geocoder = new google.maps.Geocoder();
      var latlng = new google.maps.LatLng(47.498405600000000000, 19.040757799999938000);
      var mapOptions = {
        zoom: 12,
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

  registrationForm:{
  


    init: function(){
      if(!$('form[name=pixeloid_appbundle_eventregistration]').length) return false;

      $('#mapModal').on('shown.bs.modal', this.onModalShown);
      $('form[name=pixeloid_appbundle_eventregistration] select').on('change', this.onPriceChanged);
      $('#pixeloid_appbundle_eventregistration_reservation_accomodation').on('change', this.onAccomodationSelected).change()

      this.onPriceChanged();


    },

    onModalShown: function(e){

      var accomodationName = $(e.relatedTarget).closest('tr').find('td.name b').text()
      var accomodationAddress = $(e.relatedTarget).closest('tr').find('td.name small').text()

      $('#mapModal .modal-title').text(accomodationName);


      ESPCR.registrationForm.showMap(accomodationAddress);


    },

    showMap: function(accomodationAddress){

      var map = new google.maps.Map($('#mapModal .modal-body').height(400).get(0), mapOptions);
      var geocoder = new google.maps.Geocoder();
      var mapOptions = {
        zoom: 12,
      }

      var baseLocation = new google.maps.Marker({
        position: {lng: 19.078370, lat: 47.481119}, 
        map: map, 
        icon: 'http://gmapsmarkergenerator.eu01.aws.af.cm/getmarker?scale=2&color=cc5566'
      }); 



      geocoder.geocode( { 'address': accomodationAddress}, function(results, status) {

        var location = results[0].geometry.location;
        if (status == google.maps.GeocoderStatus.OK) {
           //  map.setCenter(results[0].geometry.location);
           var marker = new google.maps.Marker({
             map: map,
             position: results[0].geometry.location
           });




          map.panTo(location);
          // map.setCenter({lng: 19.071349599999962, lat: 47.482519});

           map.setZoom(16);

        } else {
           alert('Geocode was not successful for the following reason: ' + status);
        }


      })

    },

    onAccomodationSelected:function() {

      if($(this).val())
        $('.accomodation-selected').show()
      else
        $('.accomodation-selected').hide()

    },

    onPriceChanged: function(){

      var data = $('form[name=pixeloid_appbundle_eventregistration]').serializeArray();
      var url = $('form[name=pixeloid_appbundle_eventregistration]').data('calculate-url')

      jQuery.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: data,
        complete: function(xhr, textStatus) {
          //called when complete
        },
        success: function(data, textStatus, xhr) {
                $('.price-total').text(data.total);
                $('.num-nights').text(data.nights);

        },
        error: function(xhr, textStatus, errorThrown) {
          //called when there is an error
              }
      });
      

    }


  }


})






$(document).ready(function(){

  ESPCR.locationsMap.init();
  ESPCR.registrationForm.init();



});

