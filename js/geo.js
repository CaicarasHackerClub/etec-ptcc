
    var map;
    var santaCasa = {lat: -23.4350898, lng: -45.0714174};

    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: santaCasa
      });

      var markerSC = new google.maps.Marker({
        title: 'Santa Casa',
        map: map,
        animation: google.maps.Animation.DROP,
        position: santaCasa
      });

      markerSC.addListener('click', function() {
        infoWindowSC.open(map, markerSC);
      });

      var infoSC = '<div class="infoWin">' +
          '<h3>Santa Casa de Ubatuba</h3>' +
          '<ul>' +
            '<li><a href="http://santacasaubatuba.org.br">santacasaubatuba.org.br</a></li>' +
            '<li>R. Conceição, 135 - Centro, Ubatuba - SP, 11680-000, Brazil</li>' +
            '<li>+55 12 3834-3230</li>' +
          '</ul>' +
        '</div>';

      var infoWindowSC = new google.maps.InfoWindow({
        content: infoSC
      });
    }

    $('.form-search').submit(function(ev) {
      ev.preventDefault();
      var pessoa = $('.in-search').val();

      $.get('geolocalizar.php', { pessoa: pessoa })
        .done(function(data) {
          var address = data.end_rua + '+' + data.end_numero;
          $('.ul-info').remove();
          $('.info').append('<ul class="ul-info"></ul>');
          $('.ul-info').append('<li>Rua: ' + data.end_rua + '</li>');
          $('.ul-info').append('<li>Número: ' + data.end_numero + '</li>');

          var geocoder = new google.maps.Geocoder();
          geocoder.geocode({address: address}, function(results, status) {
            if (status === 'OK') {
              map.setCenter(results[0].geometry.location);

              new google.maps.Marker({
                title: pessoa,
                map: map,
                animation: google.maps.Animation.DROP,
                position: results[0].geometry.location
              });
            }
          });
        })
        .fail(function() {

        });
    });
