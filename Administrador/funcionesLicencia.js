function setIdProf(id){
    eval("debugger;");
    document.getElementById('impIDprof').value=id;
    
    
}


function habilitarFechaHasta(){
   var fchDesde = document.getElementById('fechaDesde').value;
   
    document.getElementById('fechaHasta').value = fchDesde;
    document.getElementById('fechaHasta').min = fchDesde;
    document.getElementById('fechaHasta').disabled = false;
}