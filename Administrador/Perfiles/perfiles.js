function enviarRoles(){
eval("debugger;");
    var arregloFunciones = [];
    var funciones = document.getElementsByClassName("checkFuncion");
    var erroneos = 0;
    var chequeados = 0;
    
        for(let index = 0; index < funciones.length; index++){
            
            if(funciones[index].checked){
                var idFuncion = funciones[index].id;
                arregloFunciones.push(idFuncion);
                chequeados ++;
            }        
        }
    
    if(chequeados > 0){
        document.getElementById("arregloFunciones").value=JSON.stringify(arregloFunciones);
        return true;
    }else{
        return false;
    }
            
}


function habilitarFunciones(){
    eval("debugger;");
    var funciones = document.getElementsByClassName("checkFuncion");
    
    for(let index = 0; index < funciones.length; index++){
            
            if(funciones[index].disabled){
                funciones[index].disabled = false;
                document.getElementById("btnGuardar").style.display="block";
            }else{
                funciones[index].disabled = true;
                document.getElementById("btnGuardar").style.display="none";
            }       
        }
}