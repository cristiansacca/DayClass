function setIdProf(id){
    eval("debugger;");
    var buscar = "inicLic" + id;
    document.getElementById('impIDprof').value=id;
    var inicioLicencia = document.getElementById(buscar).value;
    
    var today = document.getElementById('hoy').value;
    
    var fchHasta = document.getElementById('fechaHasta').value;
    
    if(fchHasta != ""){
         document.getElementById('fechaHasta').disabled = true;
        document.getElementById('fechaHasta').value = "";
    }
    
    
    if(inicioLicencia <= today || inicioLicencia == ""){
        /*document.getElementById('fechaDesde').min = today;
        document.getElementById('fechaDesde').value = today;*/
    }else{
        document.getElementById('fechaDesde').min = inicioLicencia;
        document.getElementById('fechaDesde').value = inicioLicencia;
    }
    
    ultimaLicencia(id);
    
}


function habilitarFechaHasta(){
    var fchDesde = document.getElementById('fechaDesde').value;
    //var fchHoy = document.getElementById('todayDate').value;
    
    document.getElementById('fechaHasta').value = fchDesde;
        document.getElementById('fechaHasta').min = fchDesde; 
    
    /*if(fchDesde < fchHoy){
       document.getElementById('fechaHasta').value = fchHoy;
    document.getElementById('fechaHasta').min = fchHoy; 
    }else{
        
    }*/
    
    
    document.getElementById('fechaHasta').disabled = false;
    document.getElementById('fechaHasta').readonly = false;  
}

function ultimaLicencia(id){
    var inicioUltimaLicencia = 'inicioUltimaLicencia' + id;
    var finUltimaLicencia = 'finUltimaLicencia' + id;
    var contenido = "";
    
    var fchInicLic = document.getElementById(inicioUltimaLicencia).value;
    var fchFinLic = document.getElementById(finUltimaLicencia).value;
    
    if(fchInicLic == "" && fchFinLic == ""){
       contenido = "<div class='alert alert-warning' role='alert'>"+
           "<h5><i class='fa fa-exclamation-circle mr-2'></i>No registra licencias</h5>" +
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
        var datos = {
            id_curso: document.getElementById('cursoId').value,
            id_prof: document.getElementById('impIDprof').value,
            fchDesde: document.getElementById('fechaDesde').value,
            fchHasta: document.getElementById('fechaHasta').value;
        }

        $.ajax({
            url:'validarFechasLicencia.php',
            type: 'POST',
            async: false,
            data: datos,
            success:function(datosRecibidos) {
                
                json = JSON.parse(datosRecibidos);
                //alert(datosRecibidos);
                
                switch(json){
                    case "noAsociado":
                        rtdo = true;
                        break;
                    case "siAsociado":
                        document.getElementById("resultadoMostrar").innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert' ><h5><i class='fa fa-exclamation-circle mr-2'></i>El usuario ya se encuentra asociado al curso.</h5></div>";
                        rtdo = false;
                        break;
                    case "noExiste":
                       document.getElementById("resultadoMostrar").innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert' ><h5><i class='fa fa-exclamation-circle mr-2'></i>Los datos ingresados no corresponden a un usuario existente.</h5></div>"; 
                        rtdo = false;
                        break;
                }
            }
        })
        
        
        
        
        
        
        return true;
        
    }else{
        return false;
    }
}