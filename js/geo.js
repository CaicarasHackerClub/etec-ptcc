$(function() {
  var santaCasa = {lat: -23.4350898, lng: -45.0714174};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: santaCasa
  });

  var markerSC = new google.maps.Marker({
    title: 'Santa Casa',
    map: map,
    animation: google.maps.Animation.DROP,
    position: santaCasa
  });

  var infoSC = '<div class="poi-info-window gm-style">' +
      '<div class="address">' +
        '<div class="title full-width">Santa Casa de Ubatuba</div>' +
        '<div class="address-line full-width">R. Conceição, 135 - Centro, Ubatuba - SP, 11680-000, Brazil</div>' +
        '<div class="address-line full-width">+55 12 3834-3230</div>' +
        '<div class="view-link"><a href="http://santacasaubatuba.org.br">santacasaubatuba.org.br</a></div>' +
      '</div>' +
    '</div>';

  var infoWindowSC = new google.maps.InfoWindow({
    content: infoSC
  });

  markerSC.addListener('click', function() {
    infoWindowSC.open(map, markerSC);
  });

  infoWindowSC.open(map, markerSC);

  $('.search-form').submit(function(ev) {
    ev.preventDefault();
    var pessoa = $('.search-in').val();

    $.get('geolocalizar.php', { pessoa: pessoa })
      .done(function(data) {
        var address = data.end_rua + '+' + data.end_numero;
        $('.ul-info').remove();
        $('.info').append('<ul class="ul-info"></ul>');
        $('.ul-info').append('<li>Rua: ' + data.end_rua + '</li>');
        $('.ul-info').append('<li>Número: ' + data.end_numero + '</li>');

        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ address: address }, function(results, status) {
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
});
