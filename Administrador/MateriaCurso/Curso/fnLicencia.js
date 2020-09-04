function setIdProf(id){
    
    var buscar = "inicLic" + id;
    document.getElementById('impIDprof').value=id;
    var inicioLicencia = document.getElementById(buscar).value;
    
    var today = document.getElementById('hoy').value;
    
    var fchHasta = document.getElementById('fechaHasta').value;
    
    if(fchHasta != ""){
         document.getElementById('fechaHasta').disabled = true;
        document.getElementById('fechaHasta').value = "";
    }
    
    
    if(inicioLicencia < today){
        document.getElementById('fechaDesde').min = today;
        document.getElementById('fechaDesde').value = today;
    }else{
        document.getElementById('fechaDesde').min = inicioLicencia;
        document.getElementById('fechaDesde').value = inicioLicencia;
    }
    
    ultimaLicencia(id);
    
}


function habilitarFechaHasta(){

   var fchDesde = document.getElementById('fechaDesde').value;
   
    var fechaSig = new Date(fchDesde);
    fechaSig.setDate(fechaSig.getDate() + 1);
    document.getElementById('fechaHasta').value = fchDesde;
    document.getElementById('fechaHasta').min = fchDesde;
    document.getElementById('fechaHasta').disabled = false;
}

function ultimaLicencia(id){
    var inicioUltimaLicencia = 'inicioUltimaLicencia' + id;
    var finUltimaLicencia = 'finUltimaLicencia' + id;
    var contenido = "";
    
    var fchInicLic = document.getElementById(inicioUltimaLicencia).value;
    var fchFinLic = document.getElementById(finUltimaLicencia).value;
    
    if(fchInicLic == "" && fchFinLic == ""){
       contenido = "<div class='alert alert-warning' role='alert'>"+
           "<h5>No registra licencias</h5>" +
            "</div>";
    }else{
        var fechaInicioUltimaLicencia = armarFecha(fchInicLic);
        var fechaFinUltimaLicencia =  armarFecha(fchFinLic);
        
        contenido += "<table class='table table-bordered text-center'>";
        contenido += "<thead>";
        contenido += "<th></th>";
        contenido += "<th>Fecha desde</th>";
        contenido += "<th>Fecha hasta</th>";
        contenido += "</thead>"; 
        contenido += "<tbody>";
        contenido +="<tr>";
        contenido += "<td>Utima licencia registrada</td>";                  
        contenido += "<td>"+fechaInicioUltimaLicencia+"</td>";                                   
        contenido += "<td>"+fechaFinUltimaLicencia +"</td>";                                   
        contenido += "</tr>";                                 
        contenido += "</tbody>";                            
        contenido += "</table>";                         
        
    }    
    
   document.getElementById("tablaLastLicencia").innerHTML = contenido; 
                      
}

function armarFecha(fecha){
    var fechaDesarmada = fecha.split('-');
    
    return fechaDesarmada[2] +"/" + fechaDesarmada[1] + "/" + fechaDesarmada[0];
}

function validarFechasLic(){
    var fchDesde = document.getElementById('fechaDesde').value;
    var fchHasta = document.getElementById('fechaHasta').value;
    
    if(fchHasta != ""){
        return true;
        
    }else{
        return false;
    }
}