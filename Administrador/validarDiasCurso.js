function habilitarTimeP(dia){
    eval("debugger;");
    var elem = document.getElementById(dia);
    
    elem.addEventListener( 'change', function() {
    if(this.checked) {
       
        var elem = document.getElementById(dia + "1").disabled =false;
        //var elem = document.getElementById(dia + "2").disabled =false;
    }else{
        var elem = document.getElementById(dia + "1").disabled =true;
        var elem = document.getElementById(dia + "2").disabled =true;
        var elem = document.getElementById(dia + "1").value = "";
        var elem = document.getElementById(dia + "2").value = "";
    }
});
}

function habilitar2do(dia){
    var len = dia.length;
    
    var hora1 = document.getElementById(dia).value;
    var sdia = dia.substring(0,len-1);
    var elem = document.getElementById(sdia + "2").disabled =false;
    document.getElementById(sdia + "2").value = hora1;
}

function validar(dia){
    eval("debugger;");
    var len = dia.length;
    
    var hora1 = document.getElementById(dia).value;
    var sdia = dia.substring(0,len-1);
    
    var elem1 = document.getElementById(sdia + "1").value;
    var elem2 = document.getElementById(dia).value;
    
    if(elem1 != "" && elem2 != ""){
        if(elem1 <= elem2){
           // alert("fechas validas");
        }else{
           // alert("fechas no correctas");  
        }
    }
}

function enviar(){
    eval("debugger;");
    var arregloDiasHorarios = [];
    var diaSem = document.getElementsByClassName("checkDia");
    var rtdo = false;
    
    
    for(let index = 0; index < diaSem.length; index++){
        var nombreDia = diaSem[index].id;
        var fechaInicio = document.getElementById(nombreDia+"1").value;
        var fechaFin = document.getElementById(nombreDia+"2").value;
    
        if(diaSem[index].checked){
           if(fechaInicio < fechaFin){
               var diaHora = [nombreDia,fechaInicio,fechaFin];
               arregloDiasHorarios.push(diaHora);
               rtdo =True;
           }  
        }
    }
    
    if(rtdo == true){
        document.getElementById("arregloDiasHorario").value=JSON.stringify(arregloDiasHorarios);
    }
    
    return rtdo;
}