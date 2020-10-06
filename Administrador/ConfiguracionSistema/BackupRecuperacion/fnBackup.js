function unHide(){
    eval("debugger;");
    document.getElementById('inputFile').style.display='block';
    document.getElementById('inputSQL').setAttribute("required", "");
    document.getElementById('msgLastBackUp').style.display='none'; 
}


function hide(){
    eval("debugger;");
    document.getElementById('inputSQL').required = false;
    document.getElementById("uploadBackup").reset();
    document.getElementById('inputFile').style.display='none'; 
    document.getElementById('msgLastBackUp').style.display='block';

}

function confirmRestaurar(){
   var confirmar = confirm("¿Realmente desea restaurar la base de datos? ");
    if (confirmar) {
        var contenido = "<span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Restaurando...";
        document.getElementById("btnImportar").innerHTML = contenido;
        return true;
    } else {
        return false;
    }
    
}
