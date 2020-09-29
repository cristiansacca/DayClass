function habilitarSegundaFecha(){
    eval("debugger;");
    var fchDesde = document.getElementById('fechaDesde').value;
   
    document.getElementById('fechaHasta').value = fchDesde;
    document.getElementById('fechaHasta').min = fchDesde;
    document.getElementById('fechaHasta').disabled = false;
}