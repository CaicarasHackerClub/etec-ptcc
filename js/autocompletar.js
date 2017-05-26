var $error = $('#error-onload');
var $searchbox = $('#autocompletar-in');
var $enderecoForm = $('#auto-endereco');

function initAutocomplete() {
  var autocomplete;
  var componentForm = {
    route: 'long_name',
    street_number: 'short_name',
    sublocality_level_1: 'long_name',
    administrative_area_level_1: 'long_name',
    administrative_area_level_2: 'short_name',
    postal_code: 'short_name',
    country: 'long_name',
  };

  $searchbox.keypress(function(e) {
    if (e.which === 13) {
      e.preventDefault();
    }
  });

  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocompletar-in'), {types: ['geocode']});

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var val = $searchbox.val();
    showFields();
    fillInAddress(val);
  });

  function fillInAddress(val) {
    getPlace().then(function(place) {
      for (var component in componentForm) {
        if (document.getElementById(component)) {
          document.getElementById(component).value = '';
        }
      }

      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];

        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
          var $container = $('#' + addressType);
          $container.children('input').val(val);
        }
      }
      $error.fadeOut('fast');
    }, function() {
      showMessage($error, 'Nenhuma opção válida foi selecionada.', 3500, function() {
        showMessage($error, 'Você pode realizar outra busca ou completar manualmente.', 0, function() {
          showFields();
        });
      });
    });
  }

  function getPlace() {
    return new Promise(function(resolve, reject) {
      var place = autocomplete.getPlace();

      if (place.hasOwnProperty('address_components')) {
        resolve(place);
      }
      reject();
    });
  }
}

function showFields() {
  $enderecoForm.fadeIn();
  $('.cadastro-submit').fadeIn('slow');
}

function hideFields() {
  $enderecoForm.fadeOut();
  $('.cadastro-submit').fadeOut();
}

function loadError() {
  try {
    throw new URIError('Autocompletado de endereço não está disponível nesse momento.');
  } catch (e) {
    $('#autocompletar').hide();
    $enderecoForm.show();
    $('.cadastro-submit').show();
    showMessage($error, e.message, 0);
  }
}
