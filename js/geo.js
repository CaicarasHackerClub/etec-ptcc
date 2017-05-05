function initMap() {
  "use strict";

  // Objetos globais
  var map;

  var INITIAL = 'initial';
  var SAUDE = 'saude';
  var DEMO = 'demografia';
  var SEARCH = 'search';
  var SANTA_CASA = new google.maps.LatLng({lat: -23.4350898, lng: -45.0714174});

  // TODO: salvar latlng em BD e só procurar quando não tem salvo.
  // TODO: transformar select e buttons em checkboxses
  // FIXME: corrigir chamadas a model em view


  // Modelos de dados
  var model = {
    map: {
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: SANTA_CASA,
      zoom: 15,
      mapTypeControl: false,
      streetViewControl: false
    },

    icon: {
      demografia: 'http://labs.google.com/ridefinder/images/mm_20_orange.png',
      home: 'http://maps.google.com/mapfiles/kml/pal2/icon10.png',
      saude: 'http://maps.google.com/mapfiles/kml/pal3/icon46.png',
      search: 'http://maps.google.com/mapfiles/kml/paddle/blu-stars.png',
    },

    marker: {
      models: [{
        marker: {
          title: 'Santa Casa de Ubatuba',
          position: SANTA_CASA,
          animation: google.maps.Animation.DROP,
        },
        infoWin: {
          title: 'Santa Casa de Ubatuba',
          lines: [
            'R. Conceição, 135 - Centro, Ubatuba - SP, 11680-000, Brazil',
            '+55 12 3834-3230'
          ],
          links: [{
            url: 'http://santacasaubatuba.org.br',
            value: 'santacasaubatuba.org.br'
          }]
        }
      }],

      colections: {
        initial: [],
        search: [],
        demografia: [],
        saude: [],
      },
    },

    status: {
      search: false,
      demografia: false,
      saude: false,
      btnClearDemo: false,
      btnClearSearch: false,
      btnClearSaude: false,
    },

    init: function() {
      // Definir o icone do marcador da Santa Casa
      this.marker.models[0].marker.icon = this.icon.home;
    }
  };


  // Control
  var control = {

    // Obter as configurações inciais do mapa
    getMap: function() {
      return model.map;
    },

    // Obter as configurações dos marcadores iniciais
    getInitialModels: function() {
      return model.marker.models;
    },

    // Obter marcadores saúde
    getMarkers: function(tipo) {
      return model.marker.colections[tipo];
    },

    // Formata url para API request
    getAddressUrl: function(data) {
      return data.join('+');
    },

    getIcon: function(tipo) {
      return model.icon[tipo];
    },

    getStatus: function(tipo) {
      return model.status[tipo];
    },

    // Adiciona marcador
    addMarker: function(marker, tipo) {
      model.marker.colections[tipo].push(marker);
    },

    getAllLatLng: function() {
      var result = [];
      var colections = model.marker.colections;

      for (var key in colections) {
        if (colections.hasOwnProperty(key)) {
          var colection = colections[key];
          for (var i = 0; i < colection.length; i++) {
            result.push(colection[i].getPosition());
          }
        }
      }

      return result;
    },

    clearMarkers: function(tipo) {
      model.marker.colections[tipo].length = 0;
    },

    toggleStatus: function(tipo) {
      model.status[tipo] = !model.status[tipo];
    },

    init: function() {
      model.init();
      view.init();
    },
  };


  // Vistas
  var view = {

    templates: {
      buttons: '<button class="btn btn-clear-%tipo%">Limpar %nome%</button>',
    },

    // Mostrar o mapa e inicializar o objeto global map
    showMap: function() {
      var map = new google.maps.Map(document.getElementById('map'), control.getMap());
      return map;
    },

    // Mostrar os marcadores iniciais e os popups de informação se tiver
    showInitialMarkers: function() {
      var initialModels = control.getInitialModels();

      initialModels.forEach(function(model) {
        // Criar marcador com informação do modelo
        var marker = new google.maps.Marker(model.marker);
        marker.setMap(map);
        // Adicionar aos marcadores iniciais
        control.addMarker(marker, INITIAL);
        // Mostrar popup
        if (model.infoWin) {
          view.showInfoWindow(model.infoWin, marker);
        }
      });
    },

    // Mostrar popups informativos dos marcadores
    showInfoWindow: function(model, marker) {
      // Preencher plantilhas HTML
      var content = view.getContentInfoWindow(model);
      // Criar e abrir popup informativo
      var info = new google.maps.InfoWindow({ content: content });
      // Evento clicar para abrir
      marker.addListener('click', function() {
        info.open(map, marker);
      });
    },

    createMarker: function(tipo, properties, result) {
      var marker = new google.maps.Marker(properties);

      if (result) {
        view.showInfoAddress(result.formatted_address);
      }

      marker.addListener('click', function() {
          var geocoder = new google.maps.Geocoder();
          var location = marker.getPosition();

          geocoder.geocode({location: location}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
              if (results[0]) {
                view.showInfoAddress(results[0].formatted_address);
              }
            }
          });
      });

      control.addMarker(marker, tipo);
    },

    setBounds: function() {
      var bounds = new google.maps.LatLngBounds();
      var allLatLng = control.getAllLatLng();
      allLatLng.forEach(function(latLng) {
        bounds.extend(latLng);
      });
      map.fitBounds(bounds);
    },

    // Mostrar informação de endereço no aside
    showInfoAddress: function(address) {
      $('.info-inner').remove();
      $('.info-wrapper').append('<div class="info-inner">' + address + '</div>');
    },

    // Mostrar marcador segundo nome
    showMarkerByName: function(nome) {

      // Ajax request
      // Retorna objeto com nome e dados de endereço da pessoa
      $.getJSON('geolocalizar.php', { tipo: 'endereço', pessoa: nome })
        .done(function(data) {

          data = JSON.parse(data);
          view.resetSelect(true);

          if (data.pes_nome) {
            $.getJSON('https://maps.googleapis.com/maps/api/geocode/json', {
              address: control.getAddressUrl([
                data.end_rua,
                data.end_numero,
                data.end_bairro,
                data.end_cidade,
                data.end_cep
              ]),
              language: 'pt',
              region: 'BR',
              key: 'AIzaSyC0Qliqe7HjHeD2daBzwVtk6ndT3kJLVlc'})

              .done(function(geocode) {
                if (geocode.status === google.maps.GeocoderStatus.OK) {
                  var result = geocode.results[0];
                  var position = result.geometry.location;

                  view.createMarker(SEARCH, {
                    map: map,
                    position: position,
                    title: data.pes_nome,
                    animation: google.maps.Animation.DROP,
                    icon: control.getIcon(SEARCH),
                  }, result);

                  view.setBounds();
                  view.toggleViewStatus(SEARCH, 'Busca');
                }
              })
              .fail(function() { alert('Fail'); });
          } else {
            alert('Nome não cadastrado no Banco de Dados');
          }
        })
        .fail(function() { alert('Fail'); }
      );
    },

    showSantaCasa: function() {
      map.panTo(SANTA_CASA);
      map.setZoom(15);
    },

    showSaude: function() {
      view.clearMarkers(SAUDE);
      control.clearMarkers(SAUDE);

      var places = new google.maps.places.PlacesService(map);
      var request = {
        location: SANTA_CASA,
        radius: 30000,
        type: 'hospital'
      };

      places.nearbySearch(request, function(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          results.forEach(function(place) {
            view.createMarker(SAUDE, {
              map: map,
              position: place.geometry.location,
              title: place.name,
              // icon: place.icon,
              icon: control.getIcon(SAUDE),
            });
            view.setBounds();

          });

          view.toggleViewStatus(SAUDE, 'Saúde');
        }
      });
    },

    showDemografia: function() {
      $.getJSON('geolocalizar.php', { tipo: 'demografia' })
        .done(function(data) {
          view.clearMarkers(DEMO);
          control.clearMarkers(DEMO);

          var bounds = new google.maps.LatLngBounds();

          data.forEach(function(item) {
            var pessoa = JSON.parse(item);
            var title = pessoa.pes_nome;

            $.getJSON('https://maps.googleapis.com/maps/api/geocode/json', {
              address: control.getAddressUrl([
                pessoa.end_rua,
                pessoa.end_numero,
                pessoa.end_bairro,
                pessoa.end_cidade,
                pessoa.end_cep
              ]),
              language: 'pt',
              region: 'BR',
              key: 'AIzaSyC0Qliqe7HjHeD2daBzwVtk6ndT3kJLVlc'})

            .done(function(geocode) {
              var result = geocode.results[0];
              var position = result.geometry.location;

              if (geocode.status === 'OK') {
                view.createMarker(DEMO, {
                  map: map,
                  position: position,
                  title: pessoa.pes_nome,
                  icon: control.getIcon(DEMO),
                });
                view.setBounds();
              }
            })
            .fail(function() { alert('Fail'); });
          });

          view.toggleViewStatus(DEMO, 'Demografia');
        })
        .fail(function() {alert('Fail');});
    },

    toggleViewStatus: function(tipo, nome) {
      if (!control.getStatus(tipo)) {
        control.toggleStatus(tipo);

        var $btnClear= $(view.templates.buttons
          .replace(/%tipo%/, tipo)
          .replace(/%nome%/, nome));

        $('.buttons').append($btnClear);

        $('.btn-clear-' + tipo).click(function() {
          control.toggleStatus(tipo);

          $(this).remove();

          view.resetSelect(true);
          view.resetSearch();

          view.clearMarkers(tipo);
          control.clearMarkers(tipo);
        });
      }
    },

    // Criar conteudo para popup informativo dos marcadores
    getContentInfoWindow: function(info) {
      // Plantilhas HTML
      var InfoWindowTemplate = '<div class="poi-info-window gm-style">' +
        '<div class="address">%address%</div>' +
        '</div>';
      var infoWindowTitle = '<div class="title full-width">%title%</div>';
      var infoWindowLine = '<div class="address-line full-width">%line%</div>';
      var infoWindowLink = '<div class="view-link"><a href="%url%">%value%</a></div>';

      var tmpStr = infoWindowTitle.replace(/%title%/, info.title);
      info.lines.forEach(function(line) {
        tmpStr += infoWindowLine.replace(/%line%/, line);
      });
      info.links.forEach(function(link) {
        tmpStr += infoWindowLink
          .replace(/%url%/, link.url)
          .replace(/%value%/, link.value);
      });

      return InfoWindowTemplate.replace(/%address%/, tmpStr);
    },

    // Apaga marcadores da tela
    clearMarkers: function(tipo) {
      control.getMarkers(tipo).forEach(function(marker) {
        marker.setMap(null);
      });
    },

    resetSelect: function(visualizar) {
      $('.sel-visualizar').children('option[value="visualizar"]').remove();
      if (visualizar) {
        $('.sel-visualizar').prepend('<option value="visualizar" selected>Visualizar</option>');
      }
    },

    resetSearch: function() {
      $('.search-in').val('');
      $('.info-inner').remove();
    },

    init: function() {
      map = view.showMap();
      view.showInitialMarkers();

      // Search Evento
      $('.search-form').submit(function(ev) {
        ev.preventDefault();
        var pessoa = $('.search-in').val();
        view.showMarkerByName(pessoa);
      });

      $('.sel-visualizar').change(function() {
        view.resetSelect(false);
        view.resetSearch();

        var optSel = $(this).val();
        switch (optSel) {
          case 'demografia':
              view.showDemografia();
            break;
          case 'santa casa':
              view.showSantaCasa();
            break;
          case 'saude':
              view.showSaude();
            break;
          default:

        }
      });
    }
  };

  control.init();
}
