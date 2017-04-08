
/*Funçao que atualiza a hora*/
setInterval("hora()", 1000);
function hora() {
 var hora = new Date();
 document.getElementById('hora').innerHTML = hora.toLocaleTimeString();
}


/* Função que mostra o menú lateral */
var ok = false
function mostrarMenu() {

  var nav = document.getElementById('lateral');
  nav.style.transition = "1s margin-left";

  if (!ok) {
    nav.style.marginLeft = "0px";
    ok = true;
  }else{
    nav.style.marginLeft = "-390px";
    ok = false;
  }
}

/*Funçao que mostra os submodulos*/
var okMostrar = false;
function mostrar(){
  var submodulo = document.getElementById('submodulo_1');

  if (okMostrar == false){
    submodulo.style.position   = "relative";
    submodulo.style.visibility = "visible";
    okMostrar = true;
  }else {
    submodulo.style.position   = "absolute";
    submodulo.style.visibility = "hidden";
    okMostrar = false;
  }
}

/*Funçao que mostra os as opções de salvar editar e imprimir*/
var okConfig = false;
function mostrarConfig(){
  var config = document.getElementById('config');

  if (okConfig == false) {
    config.style.visibility = "visible";
    okConfig = true;
  }else{
    config.style.visibility = "hidden";
    okConfig = false;
  }
}

// $(document).ready(function () {

  var abaAberta = new Object();
  /*Função que mostra os conteudos das abas*/
  function mostrarAbas(nomeAba, url, num) {
    if (!$("#abas"+num ).is( ":visible")) {
      $('#abas').append("<li><div class='aba' id='abas"+num+"'><span>"+nomeAba+"</span></div></li>");
      $('#content').append("<div class='conteudo' id='conteudo"+num+"'></div>");
      $('#conteudo'+num).append("<iframe name='frame"+num+"' id='frame"+num+"' width='100%' height='400%'></iframe>");
      window.open (url, 'frame'+num, 'toolbar=yes,scrollbars=yes,resizable=yes');
      abas(num);
    }
  }

  /*Função que implementa as abas*/
  function abas(num){
    $("#content div:nth-child(1)").show();
    $(".abas li:first div").addClass("selecionada");

    /*Coloca o icone de fechar nas abas*/
    $('#abas'+num).append("<img class='image-close' src='../img/icons/fecharJ.png'>");

    /*Adiciona o hover nos nomes das abas*/
    $(".aba").hover(
      function(){$(this).addClass("ativa")},
      function(){$(this).removeClass("ativa")}
    );

    /*permite a seleção das abas*/
    $(".aba").click(function(){
      $(".aba").removeClass("selecionada");
      $(this).addClass("selecionada");
      var indice = $(this).parent().index();
      indice++;
      $("#content div").hide();
      $("#content div:nth-child("+indice+")").show();
    });

    /*Fecha a aba*/
    $(".aba > img").click(function(){
      var aba = $(this).parent().parent();
      var indice = aba.index() + 1;
      aba.remove();
      $("#content div:nth-child("+indice.toString()+")").remove();
      $(".aba").removeClass("selecionada");
      $("#content div").hide();
      if(indice > 1){
          var id = indice - 1;
          $("#content div:nth-child("+id.toString()+")").show();
          $(".abas  li:nth-child("+id+") .aba").addClass("selecionada");
      }else{
          $("#content div:nth-child("+indice.toString()+")").show();
          $(".abas  li:nth-child("+indice+") .aba").addClass("selecionada");
      }
    });
  }
// });
