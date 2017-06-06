var $error = $('#error-onload');
var $searchbox = $('#autocompletar-in');
var $enderecoForm = $('#auto-endereco');

var LONG_MESSAGE = 4500;
var SHORT_MESSAGE = 3500;

function initAutocomplete() {
  'use strict';

  var autocomplete;
  var componentForm = {
    route: 'long_name',                         // Rua
    street_number: 'short_name',                // Número
    sublocality_level_1: 'long_name',           // Bairro
    administrative_area_level_1: 'long_name',   // Estado
    administrative_area_level_2: 'short_name',  // Cidade
    postal_code: 'short_name',                  // CEP
    country: 'long_name',                       // País
  };

  $searchbox.keypress(function(e) {
    if (e.which === 13) {
      e.preventDefault();
    }
  });

  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocompletar-in'), {types: ['geocode']});

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    showFields();
    fillInAddress();
  });

  function clearForm() {
    for (var component in componentForm) {
      $('#' + component).children('input').val('');
    }
  }

  function fillInAddress() {

    clearForm();

    getPlace().then(function(place) {

      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];

        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
          var $container = $('#' + addressType);
          $container.children('input').val(val);
        }
      }
      $error.fadeOut('fast');

    }, function(isOnline) {
      if (isOnline) {

        showMessage($error, 'Nenhuma opção válida de autocompletado foi selecionada.', SHORT_MESSAGE, function() {
          showMessage($error, 'Você pode realizar outra busca ou completar de forma manual.', 0, function() {
            showFields();
          });
        });
      } else {
        var message = 'Você está offline nesse momento. A função de autocompletado precisa que você esteja conectado à Internet.';
        showMessage($error, message, LONG_MESSAGE, function() {
          var message = 'Verifique sua conexão de Internet. Você ainda pode cadastrar de forma manual.';
          showMessage($error, message, 0);
        });
      }
    });
  }

  function showFields() {
    $enderecoForm.fadeIn();
    $('.cadastro-submit').fadeIn('slow');
  }

  function getPlace() {
    return new Promise(function(resolve, reject) {
      var place = autocomplete.getPlace();

      if (place.hasOwnProperty('address_components')) {
        resolve(place);
      } else {
        $.ajax({
          url: 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js',
        })
        .done(function() {
          reject(true);
        })
        .fail(function() {
          reject(false);
        });
      }
    });
  }
}

function loadError() {
  'use strict';

  $('#autocompletar').hide();
  $enderecoForm.fadeIn();
  $('.cadastro-submit').fadeIn('slow');

  var message = 'Verifique sua conexão de Internet. Autocompletado de endereço não está disponível, ' +
    'mas você ainda pode cadastrar manualmente.';
  showMessage($error, message, 0);
}
