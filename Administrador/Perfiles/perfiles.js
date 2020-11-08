function enviarRoles(){
eval("debugger;");
    var arregloFunciones = [];
    var funciones = document.getElementsByClassName("checkFuncion");
    //var erroneos = 0;
    var chequeados = 0;
    var erroneos = 0;
    
        for(let index = 0; index < funciones.length; index++){
            
            if(funciones[index].checked){
                var idFuncion = funciones[index].id;
                arregloFunciones.push(idFuncion);
                chequeados ++;
            }        
        }
    
    if(chequeados > 0 || erroneos == 0){
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


function validarCambioRol(){
    eval("debugger;");
    var userDNI = document.getElementById("inputDNI").value;
    var rtdo = false;
    var datos = {
            dni: document.getElementById('inputDNI').value,
            
        }

        $.ajax({
            url:'verificarRolAnt.php',
            type: 'POST',
            async: false,
            data: datos,
            success:function(datosRecibidos) {
                
                json = JSON.parse(datosRecibidos);
                //alert(datosRecibidos);
                
                if(json){
                   var confirmar = confirm("El usuario ya posee rol asignado, ¿Desea cambiarlo?");
                    if (confirmar) {
                        rtdo = true;
                    } else {
                        rtdo = false;
                    } 
                }else{
                    rtdo = true;
                }
                
            }
        })
    
    return rtdo;
}