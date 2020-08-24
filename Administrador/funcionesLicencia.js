function setIdProf(id){
    eval("debugger;");
    document.getElementById('impIDprof').value=id;
    
    
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