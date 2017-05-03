function initMap() {
  "use strict";

  // Objetos globais
  var map;


  // Modelos de dados
  var model = {
    mapModel: {
      zoom: 15,
      mapTypeControl: false,
      streetViewControl: false
    },

    icon: {
      iconDemo: 'http://labs.google.com/ridefinder/images/mm_20_orange.png',
      iconHome: 'http://maps.google.com/mapfiles/kml/pal2/icon10.png',
      iconHealth: 'http://maps.google.com/mapfiles/kml/pal3/icon46.png',
      iconSearch: 'http://maps.google.com/mapfiles/kml/paddle/blu-stars.png',
    },

    marker: {
      models: [{
        marker: {
          title: 'Santa Casa de Ubatuba',
          position: {lat: -23.4350898, lng: -45.0714174},
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
        postosSaude: [],
      },
    },

    status: {
      search: false,
      demografia: false,
      btnClearDemo: false,
      btnClearSearch: false,
    },

    init: function() {
      // Determinar o centro de visualização do mapa na Santa Casa
      this.mapModel.center = this.marker.models[0].marker.position;
      // Definir o icone do marcador da Santa Casa
      this.marker.models[0].marker.icon = this.icon.iconHome;
    }
  };


  // Control
  var control = {

    // Obter as configurações inciais do mapa
    getMapModel: function() {
      return model.mapModel;
    },

    // Obter as configurações dos marcadores iniciais
    getInitialModels: function() {
      return model.marker.models;
    },

    // Obter marcadores iniciais
    getInitialMarkers: function() {
      return model.marker.colections.initial;
    },

    // Obter marcadores de buscas recentes
    getSearchMarkers: function() {
      return model.marker.colections.search;
    },

    // Obter marcadores demográficos
    getDemoMarkers: function() {
      return model.marker.colections.demografia;
    },

    // Formata url para API request
    getAddressUrl: function(data) {
      return data.join('+');
    },

    // Adiciona marcador a marcadores iniciais
    addInitialMarker: function(marker) {
      model.marker.colections.initial.push(marker);
    },

    // Adiciona marcador a marcadores de busca
    addSearchMarker: function(marker) {
      model.marker.colections.search.push(marker);
    },

    // Adiciona marcador a demográficos
    addDemoMarker: function(marker) {
      model.marker.colections.demografia.push(marker);
    },

    getStatus: function(tipo) {
      return model.status[tipo];
    },

    toggleStatus: function(tipo) {
      model.status[tipo] = !model.status[tipo];
    },

    clearDemoMarkers: function() {
      model.marker.colections.demografia.length = 0;
    },

    clearSearchMarkers: function() {
      model.marker.colections.search.length = 0;
    },

    init: function() {
      model.init();
      view.init();
    },
  };


  // Vistas
  var view = {

    // Mostrar o mapa e inicializar o objeto global map
    showMap: function() {
      var map = new google.maps.Map(document.getElementById('map'), control.getMapModel());
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
        control.addInitialMarker(marker);
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

                  var searchMarkers = control.getSearchMarkers();

                  var isMarker = false;
                  isMarker = searchMarkers.some(function(mkr) {
                    return mkr.getTitle() === data.pes_nome &&
                    mkr.getPosition().equals(new google.maps.LatLng(position));
                  });

                  if (!isMarker) {
                    var marker = new google.maps.Marker({
                      map: map,
                      position: position,
                      title: data.pes_nome,
                      animation: google.maps.Animation.DROP,
                      icon: model.icon.iconSearch
                    });
                    control.addSearchMarker(marker);
                  }

                  view.showInfoAddress(result.formatted_address);

                  map.panTo(position);
                  map.setZoom(18);

                  if (!control.getStatus('search')) {
                    control.toggleStatus('search');
                  }

                  if (!control.getStatus('btnClearSearch')) {
                    var $btnClearSearch = $('<button class="btn btn-clear-search">Limpar Buscas</button>');
                    $('.buttons').append($btnClearSearch);

                    control.toggleStatus('btnClearSearch');

                    $('.btn-clear-search').click(function() {
                      $(this).remove();
                      // view.resetSelect(true);
                      view.resetSearch();

                      view.clearSearchMarkers();
                      control.clearSearchMarkers();

                      control.toggleStatus('btnClearSearch');
                      control.toggleStatus('search');
                    });
                  }
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
      var santaCasa = model.marker.models[0].marker.position;
      map.panTo(santaCasa);
      map.setZoom(15);
    },

    showPostosSaude: function() {
    },

    showDemografia: function() {
      $.getJSON('geolocalizar.php', { tipo: 'demografia' })

        .done(function(data) {
          view.clearDemoMarkers();
          control.clearDemoMarkers();

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
                var marker = new google.maps.Marker({
                  map: map,
                  position: position,
                  title: pessoa.pes_nome,
                  icon: model.icon.iconDemo,
                });

                var santaCasa = model.marker.models[0].marker.position;
                map.panTo(santaCasa);
                map.setZoom(13);

                control.addDemoMarker(marker);
              }
            })
            .fail(function() { alert('Fail'); });
          });

          if (!control.getStatus('demografia')) {
            control.toggleStatus('demografia');
          }

          if (!control.getStatus('btnClearDemo')) {
            var $btnClearDemo = $('<button class="btn btn-clear-demo">Limpar Demografia</button>');
            $('.buttons').append($btnClearDemo);

            control.toggleStatus('btnClearDemo');

            $('.btn-clear-demo').click(function() {
              $(this).remove();
              view.resetSelect(true);

              view.clearDemoMarkers();
              control.clearDemoMarkers();

              control.toggleStatus('demografia');
              control.toggleStatus('btnClearDemo');
            });
          }
        })
        .fail(function() {alert('Fail');});
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

    // Apaga marcadores iniciais
    clearInitialMarkers: function() {
      control.getInitialMarkers().forEach(function(marker) {
        marker.setMap(null);
      });
    },

    // Apaga marcadores demográficos
    clearDemoMarkers: function() {
      control.getDemoMarkers().forEach(function(marker) {
        marker.setMap(null);
      });
    },

    // Apaga marcadores de busca
    clearSearchMarkers: function() {
      control.getSearchMarkers().forEach(function(marker) {
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
          case 'postos de saude':
              view.showPostosSaude();
            break;
          default:

        }
      });
    }
  };

  control.init();
}
