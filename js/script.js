
function recebe() {
  var img = JSON.parse(sessionStorage.getItem('img'));
  $("#lbl_triagem").html(JSON.parse(sessionStorage.getItem('nome-modulo')));
  $('.tit-image').css( {
    "background": "url("+img+") no-repeat",
    "background-size": "140px",
    "background-position": "15% -1%"
  });
}

/*Funçao que atualiza a hora*/
setInterval(function() {
  var hora = new Date();
  document.getElementById('hora').innerHTML = hora.toLocaleTimeString();

  if (screen.width > 650) {
    if ($("#lateral").css("margin-left") == "-390px") {
      $("#lateral").css("margin-left", "0px");
    }

    if ($("#config").css("visibility") == "hidden") {
      $("#config").css("visibility", "visible");
    }

    $('.tit-image').css( {
      "background-size": "140px",
    });
  } else {
    $('.tit-image').css( {
      "background-size": "70px",
    });
  }

  if (screen.width <= 711 && screen.width > 650 ) {
    $(".config").css("width", "44%");
  }
}, 100);

/* Função que mostra o menú lateral */
var ok = false;
function mostrarMenu() {

  var nav = document.getElementById('lateral');
  nav.style.transition = "1s margin-left";

  if (!ok) {
    nav.style.marginLeft = "0px";
    ok = true;
  } else {
    nav.style.marginLeft = "-390px";
    ok = false;
  }
}

/*Funçao que mostra os submodulos*/
var okMostrar = false;
function mostrar(){
  var submodulo = document.getElementById('submodulo_1');

  if (!okMostrar){
    submodulo.style.position   = "relative";
    submodulo.style.visibility = "visible";
    okMostrar = true;
  } else {
    submodulo.style.position   = "absolute";
    submodulo.style.visibility = "hidden";
    okMostrar = false;
  }
}

/*Funçao que mostra os as opções de salvar editar e imprimir*/
var okConfig = false;
function mostrarConfig(){
  var config = document.getElementById('config');

  if (!okConfig) {
    config.style.visibility = "visible";
    okConfig = true;
  } else {
    config.style.visibility = "hidden";
    okConfig = false;
  }
}

/*Função que mostra os conteudos das abas*/
function mostrarAbas(nomeAba, url, num) {
  if (!$("#abas"+num ).is( ":visible")) {
    $('#abas').append("<li><div class='aba' id='abas"+num+"'><span>"+nomeAba+"</span></div></li>");
    $('#content').append("<div class='conteudo' id='conteudo"+num+"'></div>");
    $('#conteudo'+num).append("<iframe name='frame"+num+"' id='frame"+num+"' width='100%' height='95%'></iframe>");
    window.open (url, 'frame'+num);
    abas(num);
    if (screen.width <= 650) {
      $("#lateral").css("margin-left", "-390px");
    }
  }
}

/*Função que implementa as abas*/
function abas(num) {
  $("#content div:nth-child(1)").show();
  $(".abas li:first div").addClass("selecionada");

  /*Coloca o icone de fechar nas abas*/
  $('#abas'+num).append("<img class='image-close' src='../img/icons/fecharJ.png'>");

  /*Adiciona o hover nos nomes das abas*/
  $(".aba").hover(
    function(){$(this).addClass("ativa");},
    function(){$(this).removeClass("ativa");}
  );

  /*permite a seleção das abas*/
  $(".aba").click(function() {
    $(".aba").removeClass("selecionada");
    $(this).addClass("selecionada");
    var indice = $(this).parent().index();
    indice++;
    $("#content div").hide();
    $("#content div:nth-child("+indice+")").show();
  });

  /*Fecha a aba*/
  $(".aba > img").click(function() {
    var aba = $(this).parent().parent();
    var indice = aba.index() + 1;
    aba.remove();
    $("#content div:nth-child("+indice.toString()+")").remove();
    // $(".aba").removeClass("selecionada");
    // $("#content div").hide();
    if(indice > 1) {
        var id = indice - 1;
        $("#content div:nth-child("+id.toString()+")").show();
        $(".abas li:nth-child("+id+") .aba").addClass("selecionada");
    }else{
        $("#content div:nth-child("+indice.toString()+")").show();
        $(".abas li:nth-child("+indice+") .aba").addClass("selecionada");
    }
  });
}

function enviar(val) {
  var img;
  var name;
  switch(val) {
    case 1:
        img  = $("#img-triagem").attr('src');
        name = $("#name-tri").html();
        break;
    case 2:
        img = $("#img-recepcao").attr('src');
        name = $("#name-recep").html();
        break;
    case 3:
        img = $("#img-admin").attr('src');
        name = $("#name-admin").html();
    default:
        img = $("#img-portaria").attr('src');
        name = $("#name-portaria").html();
  }

  var image = JSON.stringify(img);
  var txt   = JSON.stringify(name);
  sessionStorage.setItem('img', image );
  sessionStorage.setItem('nome-modulo', txt );
}
