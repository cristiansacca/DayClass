function minutosValidos(){
    eval("debugger;");
    var min = document.getElementById('minutosCodigo').value;
    var minAnt = document.getElementById('minutosCodigoAnt').value;
    var rtdo =false;
    var msg;
    if (min  > 0 && (min % 5) == 0){ 
      if(min != minAnt){
         rtdo = true;
        }else{
           msg ="Es el mismo tiempo que esta vigente"; 
        }
     }else{
         msg ="El codigo tiene que ser multiplo de 5";
     }
    
    changeColor('minutosCodigo',rtdo);
    setValitationMesage('msjValidacionCodigo', rtdo, msg);
    
    return rtdo;
}

function changeColor(elementID, rtdo){
    if(rtdo == false){
        document.getElementById(elementID).style.backgroundColor = "PeachPuff";
        document.getElementById(elementID).style.color = "Black";
        }else{
            document.getElementById(elementID).style.backgroundColor = "Azure";  
            document.getElementById(elementID).style.color = "Black";
        }
}


function setValitationMesage(elementID, rtdo, msg){
    if(rtdo == false){ 
        document.getElementById(elementID).style.visibility='visible';
        document.getElementById(elementID).style.display='contents';
        document.getElementById(elementID).style.color = "Red"
        document.getElementById(elementID).innerHTML = msg;
    }else{
        document.getElementById(elementID).style.visibility='hidden';
        document.getElementById(elementID).style.display='none';
    }
      
}



function unHide(){
    eval("debugger;");
    
    document.getElementById('options').style.display='block';
    
    
}




function hide(){
    eval("debugger;");
    
    document.getElementById('options').style.display='none'; 
    var elem = document.getElementById("letras").checked =false;
    var elem = document.getElementById("numeros").checked =false;
    var elem = document.getElementById("letrasC").value = "";
    var elem = document.getElementById("numerosC").value = "";
    var elem = document.getElementById("letrasC").disabled =true;
    var elem = document.getElementById("numerosC").disabled =true;
    
}



function habilitarCant(id){
    
    eval("debugger;");
    var elem = document.getElementById(id);
    var idN = id + "N";
    
    elem.addEventListener('change', function() {
    if(this.checked) {
       
        var elem = document.getElementById(id + "C").disabled =false;
        //var elem = document.getElementById(dia + "2").disabled =false;
    }else{
         var elem = document.getElementById(id + "C").disabled =true;
        var elem = document.getElementById(id + "C").value = "";
    }
});
}



function armarMsg(){
  var msg ="El formato del legajo es: ";
    
    var elemL = document.getElementById("letrasC").value;
    var elemN = document.getElementById("numerosC").value;
    
    
    
}

function enviar(){
    eval("debugger;");
    var arregloTipoYcant = [];
    var chequeados = 0;
    
    var elem = document.getElementById("personalizado").checked;
    
    if(elem){
        var selecc = document.getElementsByClassName("opciones");
        
        for(let index = 0; index < selecc.length; index++){
            var tipo = selecc[index].id;
            
            if(selecc[index].checked){
                var cantidad = document.getElementById(tipo + "C").value;
                var tipoCant = [tipo, cantidad];
                arregloTipoYcant.push(tipoCant);
                chequeados ++;
            } 
        }
    
    }else{
        arregloTipoYcant.push("DNI");
    }
    
    if(chequeados > 0 || arregloTipoYcant.length > 0){
        document.getElementById("arregloTipos").value=JSON.stringify(arregloTipoYcant);
        mostrarMensaje();
        return true;
    }else{
        return false;
    }
    

}

function capitalize(id){
    eval("debugger;");
    var elem = document.getElementById(id).value;
    var primerLetra = elem.substring(0,1);
    var restoPalabra = elem.substring(1);
    
    primerLetra = primerLetra.toUpperCase();
    
    document.getElementById(id).value = primerLetra + restoPalabra;
    
}


function porcentajeValido(){
    eval("debugger;");
    var min = document.getElementById('minAsistencia').value;
    var minAnt = document.getElementById('porctajeMinAnt').value;
    var rtdo =false;
    var msg;
    if (min  > 0 && (min % 5) == 0){ 
      if(min != minAnt){
          if(min > 0 && min <= 100){
              rtdo = true;
          }else{
              msg ="No se permiten esos procetajes"; 
          }
            
        }else{
           msg ="Es el mismo porcentaje que esta vigente"; 
        }
     }else{
         msg ="El porcentaje tiene que ser multiplo de 5";
     }
    
    
    
    changeColor('minAsistencia',rtdo);
    setValitationMesage('msjValidacionMinAsistencia', rtdo, msg);
    
    return rtdo;
}



