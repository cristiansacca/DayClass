function habilitarTimeP(dia){
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

    var arregloDiasHorarios = [];
    var diaSem = document.getElementsByClassName("checkDia");
    var rtdo = false;
    var erroneos = 0;
    var chequeados = 0;
    var selectedoption = document.getElementById("divisiones").value;
    
    for(let index = 0; index < diaSem.length; index++){
        var nombreDia = diaSem[index].id;
        var fechaInicio = document.getElementById(nombreDia+"1").value;
        var fechaFin = document.getElementById(nombreDia+"2").value;
    
        if(diaSem[index].checked){
           if(fechaInicio < fechaFin){
               var diaHora = [nombreDia,fechaInicio,fechaFin];
               arregloDiasHorarios.push(diaHora);
               chequeados ++;
               
           }else{
               erroneos ++;
           } 
        }
    }
    
    
    if(erroneos == 0 && rtdo == false && chequeados > 0 && selectedoption != ""){
        rtdo = true;
        document.getElementById("arregloDiasHorario").value=JSON.stringify(arregloDiasHorarios);
        return true;
    }else{
        return false;
    }
    
    //return rtdo;
}

//feunciones del cambio de horarios de un curso
function habilitarTimePCF(dia){
    var elem = document.getElementById(dia);
    
    elem.addEventListener( 'change', function() {
    if(this.checked) {
       
        var elem = document.getElementById(dia + "1").disabled =false;
        //var elem = document.getElementById(dia + "2").disabled =false;
    }else{
        var elem = document.getElementById(dia + "1").disabled =true;
        var elem = document.getElementById(dia + "2").disabled =true;
        
    }
});
}


function deleteRow(row){
    var confirmar = confirm("¿Realmente desea eliminar este día?");
    if (confirmar) {
        var i = row.parentNode.parentNode.rowIndex;
        document.getElementById("daysHoursTable").deleteRow(i);
        return true;
    } else {
        return false;
    }
     
}


var selectDiasSemana = "<select class='custom-select' name='diasNuevos' style='width:100%' >";
    selectDiasSemana += "<option value='Lunes'>Lunes</option>";
    selectDiasSemana += "<option value='Martes'>Martes</option>";
    selectDiasSemana += "<option value='Miercoles'>Miércoles</option>";
    selectDiasSemana += "<option value='Jueves'>Jueves</option>";
    selectDiasSemana += "<option value='Viernes'>Viernes</option>";
    selectDiasSemana += "<option value='Sabado'>Sábado</option>";
    selectDiasSemana += "<option value='Domingo'>Domingo</option>";
    selectDiasSemana += "</select>";

var contador = 0;

function addCourseDay(){
    var table = document.getElementById("daysHoursTable");
  
    var x = document.getElementById("daysHoursTable").rows.length;
    var row = table.insertRow(x);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    
    cell1.innerHTML = selectDiasSemana;
    cell2.innerHTML = "<input type='time'  id='diaNuevo"+contador+1+"' onchange='habilitar2do(this.id)'>";
    cell3.innerHTML = "<input type='time' id='diaNuevo"+contador+2+"'  disabled> ";
    
    
    contador ++;
}

function getNewDays(){
    eval("debugger;");
    var diaNew = document.getElementsByName("diasNuevos");
    
    if(diaNew.length != 0){
        for(let index = 0; index < diaNew.length; index++){
            var nombreDia = diaNew[index].value;
            var horaInicio = document.getElementById("diaNuevo"+index+1).value;
            var horaFin = document.getElementById("diaNuevo"+index+2).value;
            alert(nombreDia + ", " + horaInicio + ", " + horaFin);
        }
    }else{
        alert("no hay dias nuevos");
    }
   
}


function validarRepetidos(){
    eval("debugger;");
    var diaNew = document.getElementsByName("diasNuevos");
    var diaSem = document.getElementsByClassName("checkDia");
    
    for(let index = 0; index < diaNew.length; index++){
        var nombreDiaN = diaNew[index].value;
            for(let j = 0; j < diaSem.length; j++){
                var nombreDiaV = diaSem[j].id;
                    if(nombreDiaN == nombreDiaV){
                       alert("esta dos veces el mismo día");
                        return false;
                        break;

                    } 
            }
    }
    
    return true;
}


function nuevosRepetidos(){
    eval("debugger;");
    var diaNew = document.getElementsByName("diasNuevos");
    for(let i = 0; i < diaNew.length; i++){
        var nombreDia = diaNew[i].value;
        for(let j = 0; j < diaNew.length; j++){
           var nombreDia2 = diaNew[j].value;
            if(i != j){
                if(nombreDia == nombreDia2){
                    return false;
                }
            }
        }                
    }
    return true;
}
    
function enviarFechasNuevas(){
    var arregloDiasHorarios = [];
    var diaSem = document.getElementsByClassName("checkDia");
    var diaNew = document.getElementsByName("diasNuevos");
    var rtdo = false;
    var erroneos = 0;
    var chequeados = 0;
    
    if(validarRepetidos()){
        if(diaSem.length != 0){
            for(let index = 0; index < diaSem.length; index++){
                var nombreDia = diaSem[index].id;
                var fechaInicio = document.getElementById(nombreDia+"1").value;
                var fechaFin = document.getElementById(nombreDia+"2").value;
                
                   if(fechaInicio < fechaFin && fechaInicio != "" && fechaFin != ""){
                       var diaHora = [nombreDia,fechaInicio,fechaFin];
                       arregloDiasHorarios.push(diaHora);
                       chequeados ++;

                   }else{
                       erroneos ++;
                   } 
                
            }
        }
        
        if(diaNew.length != 0){
            if(nuevosRepetidos()){
                for(let index = 0; index < diaNew.length; index++){
                    var nombreDia2 = diaNew[index].value;
                    var horaInicio = document.getElementById("diaNuevo"+index+1).value;
                    var horaFin = document.getElementById("diaNuevo"+index+2).value;

                    if(horaInicio < horaFin && horaInicio != "" && horaFin != ""){
                           var diaHora = [nombreDia2,horaInicio,horaFin];
                           arregloDiasHorarios.push(diaHora);
                           chequeados ++;

                       }else{
                           erroneos ++;
                       } 
                }
            }else{
                document.getElementById("mensajeError").innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h5><i class='fa fa-exclamation-circle mr-2'></i>Hay dos horarios definidos para el mismo día.</h5> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                return false;
            }
        }
      
        if(erroneos == 0 && rtdo == false && chequeados > 0 && (diaNew.length != 0 || diaSem.length != 0)){
            document.getElementById("arregloDiasHorario").value=JSON.stringify(arregloDiasHorarios);
            
            return true;
            
        }else{
            document.getElementById("mensajeError").innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h5><i class='fa fa-exclamation-circle mr-2'></i>Revisar las horas de inicio y fin de los días.</h5> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            return false;
        }
        
    }else{
        
        document.getElementById("mensajeError").innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h5><i class='fa fa-exclamation-circle mr-2'></i>Un día tiene dos horarios definidos.</h5> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        return false;
    }
}


//para cambiar las fechas de inicio y fin de cursado
function habilitarSegundaFecha() {
    eval("debugger;");
    var fchDesde = document.getElementById('inputInicioCursado').value;
    var fchHoy = document.getElementById('todayDate').value;
    
    if(fchDesde < fchHoy){
       document.getElementById('inputFinCursado').value = fchHoy;
        document.getElementById('inputFinCursado').min = fchHoy; 
    }else{
        document.getElementById('inputFinCursado').value = fchDesde;
        document.getElementById('inputFinCursado').min = fchDesde; 
    }
    
    
    document.getElementById('inputFinCursado').disabled = false;
    document.getElementById('inputFinCursado').readonly = false;

}


