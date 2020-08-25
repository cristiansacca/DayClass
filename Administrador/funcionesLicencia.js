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
    
    
    if(inicioLicencia < today){
        document.getElementById('fechaDesde').min = today;
        document.getElementById('fechaDesde').value = today;
    }else{
        document.getElementById('fechaDesde').min = inicioLicencia;
        document.getElementById('fechaDesde').value = inicioLicencia;
    }
    
}


function habilitarFechaHasta(){
     eval("debugger;");
   var fchDesde = document.getElementById('fechaDesde').value;
   
    var fechaSig = new Date(fchDesde);
    fechaSig.setDate(fechaSig.getDate() + 1);
    document.getElementById('fechaHasta').value = fchDesde;
    document.getElementById('fechaHasta').min = fchDesde;
    document.getElementById('fechaHasta').disabled = false;
}