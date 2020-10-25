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
    var radioBtn = document.getElementById("guardado").checked;
    var confirmar;
    if(radioBtn){
        confirmar = confirm("¿Realmente desea restaurar la base de datos? ");
    } else {
        confirmar = confirm("Está a punto de restaurar una copia de seguridad que podría ser antigua ¿Desea continuar? ");
    }
   
    if (confirmar) {
        var contenido = "<span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Restaurando...";
        document.getElementById("btnImportar").innerHTML = contenido;
        return true;
    } else {
        return false;
    }
    
}
