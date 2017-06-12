$(function() {
  // Máscara
  // $(".cpf").mask("999.999.999-99");

  $(".cpf").blur(function() {
      validar($(this).val());
  });

  $(".form").submit(function(event) {
    if (validar($('.cpf').val())) {
      return;
    }

    event.preventDefault();
  });

  function validar(cpf) {
    // Com mascára
    // cpf = cpf.replace(".", "");
    // cpf = cpf.replace(".", "");
    // cpf = cpf.replace("-", "");

    if (cpf.length == 11) {
      var soma;
      var resto;
      var n;

      for (d = 0; d < 2; d++) {
        soma = 0;
        resto = 0;
        n = 10 + d;

        for (i = 0; i < 9+d; i++) {
          soma += cpf[i] * n;
          // alert(soma);
          n--;
        }

        resto = (soma * 10) % 11;

        if (resto == 10 || resto == 11) {
          resto = 0;
        }

        // alert('Dígito: ' + cpf[9+d] + ', resto: ' + resto);

        if (cpf[9+d] != resto) {
          $(".val").text("CPF inválido");
          $(".cpf").focus();
          // alert("CPF inválido");
          return false;
        } else {
          $(".val").text("OK");
          // alert("CPF válido");
          return true;
        }
      }
    } else {
      alert("CPF inválido - deve conter 11 caracteres numéricos");
      return false;
    }
  }
});
