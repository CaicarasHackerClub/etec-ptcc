var map;
var santaCasa = {lat: -23.4350898, lng: -45.0714174};

function showByName(nome) {
  $.getJSON('geolocalizar.php', { tipo: 'endereço', pessoa: nome })
  .done(function(data) {
    resetSelect(true);
    data = JSON.parse(data);
    showInfoEndereco(data);

    var address = getEndereco(data.end_rua, data.end_numero, data.end_bairro, data.end_cidade, data.end_cep);
    var title = data.pes_nome;
    map.setZoom(18);
    setMarkerByAddress(address, title);
  })
  .fail(function() {alert('Fail');});
}

function makeInfoWindow(info) {
  var infoW = '<div class="poi-info-window gm-style">' +
    '<div class="address">%address%</div>' +
    '</div>';
  var infoWTitle = '<div class="title full-width">%title%</div>';
  var infoWLine = '<div class="address-line full-width">%line%</div>';
  var infoWLink = '<div class="view-link"><a href="%url%">%value%</a></div>';

  var tmpStr = infoWTitle.replace(/%title%/, info.title);
  info.lines.forEach(function(line) {
    tmpStr += infoWLine.replace(/%line%/, line);
  });
  info.links.forEach(function(link) {
    tmpStr += infoWLink
      .replace(/%url%/, link.url)
      .replace(/%value%/, link.value);
  });

  return infoW.replace(/%address%/, tmpStr);
}

function getEndereco(rua, numero, bairro, cidade, cep) {
  var endereco = '%rua%,+%numero%-+%bairro%,+%cidade%,+%cep%'
  .replace(/%rua%/, rua)
  .replace(/%numero%/, numero)
  .replace(/%bairro%/, bairro)
  .replace(/%cidade%/, cidade)
  .replace(/%cep%/, cep);
  return endereco;
}

function showInfoEndereco(data) {
  $('.ul-info').remove();
  $('.info').append('<ul class="ul-info"></ul>');
  $('.ul-info').append('<li>Rua: ' + data.end_rua + '</li>');
  $('.ul-info').append('<li>Número: ' + data.end_numero + '</li>');
  $('.ul-info').append('<li>Bairro: ' + data.end_bairro + '</li>');
  $('.ul-info').append('<li>Cidade: ' + data.end_cidade + '</li>');
  $('.ul-info').append('<li>CEP: ' + data.end_cep + '</li>');
}

function showDemografia() {
  $.getJSON('geolocalizar.php', { tipo: 'demografia' })
    .done(function(data) {
      map.setZoom(13);
      data.forEach(function(item) {
        var pessoa = JSON.parse(item);
        var title = pessoa.pes_nome;
        var address = getEndereco(
          pessoa.end_rua, pessoa.end_numero, pessoa.end_bairro, pessoa.end_cidade, pessoa.end_cep);
          setMarkerByAddress(address, title);
      });
    })
    .fail(function() {alert('Fail');});
}

function showSantaCasa() {
  map.panTo(santaCasa);
  map.setZoom(15);
}

function showPostosSaude() {
}

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

function resetSelect(visualizar) {
  $('.ul-info').remove();
  if (visualizar) {
    $('.sel-visualizar').prepend('<option value="visualizar" selected>Visualizar</option>');
  } else {
    $('.sel-visualizar').children('option[value="visualizar"]').remove();
  }
}

function resetSearch() {
  $('.search-in').val('');
}

function initMap() {

  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: santaCasa,
    mapTypeControl: false,
    streetViewControl: false
  });

  var markerSC = setMarkerByPosition(santaCasa, 'Santa Casa de Ubatuba');

  var infoSC = makeInfoWindow({
    title: 'Santa Casa de Ubatuba',
    lines: [
      'R. Conceição, 135 - Centro, Ubatuba - SP, 11680-000, Brazil',
      '+55 12 3834-3230'
    ],
    links: [{
      url: 'http://santacasaubatuba.org.br',
      value: 'santacasaubatuba.org.br'
    }]
  });

  var infoWindowSC = new google.maps.InfoWindow({
    content: infoSC,
  });

  infoWindowSC.open(map, markerSC);

  markerSC.addListener('click', function() {
    infoWindowSC.open(map, markerSC);
  });
}

$(function() {

  $('.sel-visualizar').change(function() {
    resetSelect(false);
    resetSearch();
    var optSel = $(this).val();
    switch (optSel) {
      case 'demografia':
          showDemografia();
        break;
      case 'santa casa':
          showSantaCasa();
        break;
      case 'postos de saude':
          showPostosSaude();
        break;
      default:

    }
  });

  $('.search-form').submit(function(ev) {
    ev.preventDefault();
    var pessoa = $('.search-in').val();
    showByName(pessoa);
  });
});
