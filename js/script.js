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
var ok = false;
function mostrar(){
  var submodulo = document.getElementById('submodulo_1');

  if (ok == false){
    submodulo.style.position   = "relative";
    submodulo.style.visibility = "visible";
    ok = true;
  }else {
    submodulo.style.position   = "absolute";
    submodulo.style.visibility = "hidden";
    ok = false;
  }
}
