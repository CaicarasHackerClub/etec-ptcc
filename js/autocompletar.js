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
  var $searchbox = $('#autocompletar-in');
  var $enderecoForm = $('#auto-endereco');

  $searchbox.keypress(function(e) {
    if (e.which === 13) {
      e.preventDefault();
    }
  });

  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocompletar-in'), {types: ['geocode']});

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    if ($searchbox.val()) {
      $enderecoForm.show();
      fillInAddress();
    }
  });

  function fillInAddress() {
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
    }, function(error) {
      loadError();
    });
  }

  function getPlace() {
    return new Promise(function(resolve, reject) {
      var place = autocomplete.getPlace();
      if (place && place !== '') {
        resolve(place);
      }
      reject();
    });
  }
}

function loadError() {
  try {
    throw new URIError('Autocompletado de endereço não está disponível nesse momento.');
  } catch (e) {
    $('#autocompletar').hide();
    $('#auto-endereco').show();
    $('#error-onload').text(e.message).show();
  }
}
