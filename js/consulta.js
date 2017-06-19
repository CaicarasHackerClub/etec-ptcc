$(function() {
  var i = 0;

  $(".adicionar").click(function() {
    if (i === 0) {
      $(".receita").empty();
    }

    i++;
    $(".med").attr("value", i);

    $("<div/>", {
      "class":"row" + i
    }).appendTo($(".receita"));

    $("<label/>", {
      "html":"Medicamento " + i + ": "
    }).appendTo($(".row" + i));

    $("<input/>", {
      "type":"number",
      "size":"3",
      "name":"quantidade"+i
    }).appendTo($(".row" + i));

    $("<select/>", {
      "name":"unidade"+i,
      "html":"<option> mg </option> <option> g </option> <option> mL </option> <option> L </option>"
    }).appendTo($(".row" + i));

    $("<label/>", {
      "html":" de "
    }).appendTo($(".row" + i));

    $("<input/>", {
      "type":"text",
      "name":"medicamento"+i
    }).appendTo($(".row" + i));

    $("<label/>", {
      "html":" a cada "
    }).appendTo($(".row" + i));

    $("<input/>", {
      "type":"number",
      "size":"2",
      "name":"tempo"+i
    }).appendTo($(".row" + i));

    $("<select/>", {
      "name":"unidadeTempo"+i,
      "html":"<option> horas </option> <option> dias </option>"
    }).appendTo($(".row" + i));

    $("<label/>", {
      "html":" durante "
    }).appendTo($(".row" + i));

    $("<input/>", {
      "type":"number",
      "size":"3",
      "name":"periodo"+i
    }).appendTo($(".row" + i));

    $("<label/>", {
      "html":" dias"
    }).appendTo($(".row" + i));
  });

  $(".remover").click(function() {
    $(".row" + i).remove();
    i--;
    $(".med").attr("value", i);
  });

  $(".limpar").click(function() {
    $(".receita").empty();
    i = 0;
    $(".med").attr("value", i);
  });
});
