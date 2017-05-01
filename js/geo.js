var map;

$(function() {
  $.getJSON('geolocalizar.php', { tipo: 'demografia' })
    .done(function(data) {
      data.forEach(function(pessoa) {
        var json = JSON.parse(pessoa);
        var address = json.end_rua + '+' + json.end_numero;
        var title = json.pes_nome;
        setMarkerByAddress(address, title);
      });
    })
    .fail(function() {alert('Fail');});

  $('.search-form').submit(function(ev) {
    ev.preventDefault();
    var pessoa = $('.search-in').val();

    $.getJSON('geolocalizar.php', { tipo: 'endereço', pessoa: pessoa })
      .done(function(data) {
        $('.ul-info').remove();
        $('.info').append('<ul class="ul-info"></ul>');
        $('.ul-info').append('<li>Rua: ' + data.end_rua + '</li>');
        $('.ul-info').append('<li>Número: ' + data.end_numero + '</li>');

        var address = data.end_rua + '+' + data.end_numero;
        var title = data.pes_nome;
        setMarkerByAddress(address, title);
      })
      .fail(function() {alert('Fail');});
  });
});

function setMarkerByAddress(address, title) {
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({ address: address }, function(results, status) {
    if (status === 'OK') {
      var position = results[0].geometry.location;
      map.setCenter(position);
      setMarkerByPosition(position, title);
    }
  });
}

function setMarkerByPosition(position, title) {
  var marker = new google.maps.Marker({
    title: title,
    map: map,
    animation: google.maps.Animation.DROP,
    position: position
  });
  return marker;
}

function initMap() {
  var santaCasa = {lat: -23.4350898, lng: -45.0714174};

  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: santaCasa,
    mapTypeControl: false,
    streetViewControl: false
  });

  var markerSC = setMarkerByPosition(santaCasa, 'Santa Casa de Ubatuba');

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
}
