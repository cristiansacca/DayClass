function habilitarSegundaFecha(){

    var fchDesde = document.getElementById('fechaDesde').value;
    document.getElementById('fechaHasta').value = fchDesde;
    document.getElementById('fechaHasta').min = fchDesde;
    document.getElementById('fechaHasta').disabled = false;
    validarCampos();
}

function seleccionarTodos(){
    var todos = document.getElementById("checkTodos");
    let cont = document.getElementsByClassName("checkMateria");
    if(todos.checked == true) {
        for (let index = 0; index < cont.length; index++) {
            cont[index].checked = true; 
        }
    }else{
        for (let index = 0; index < cont.length; index++) {
            cont[index].checked = false; 
        }
    }
    validarCampos();
}

function validarFechasJustificativo(){
    let desde = document.getElementById("fechaDesde").value;
    let hasta = document.getElementById("fechaHasta").value;
    let cont = document.getElementsByClassName("checkMateria");
    let al_menos_uno = false;
    
    for (let index = 0; index < cont.length; index++) {
        if (cont[index].checked) {
            al_menos_uno = true;
        }   
    }
    if(desde!=""&&hasta!=""){
        if(desde>hasta){
            //setValitationMesage("msgDesde",false,"El período no es válido.");
            //setValitationMesage("msgHasta",false,"El período no es válido.");
            $("#btnCargar").attr("disabled", "disabled" );
        }
        else{
            //setValitationMesage("msgDesde",true,"");
            //setValitationMesage("msgHasta",true,"");
            if(al_menos_uno){
                $("#btnCargar").removeAttr("disabled");
            }
        }
    }
}

function validar_checkbox() {
    let desde = document.getElementById("fechaDesde").value;
    let hasta = document.getElementById("fechaHasta").value;
    let cont = document.getElementsByClassName("checkMateria");
    let al_menos_uno = false;
    let todos = true;
    
    for (let index = 0; index < cont.length; index++) {
        if (cont[index].checked) {
            al_menos_uno = true;
        }   
    }

    for (let index = 0; index < cont.length; index++) {
        if (!cont[index].checked) {
            todos = false;
        }   
    }

    if(!todos){
        document.getElementById("checkTodos").checked = false;
    } else{
        document.getElementById("checkTodos").checked = true;
    }

    if(!al_menos_uno){
        setValitationMesage("msgMaterias",false,"Seleccione al menos una materia.");
        $("#btnCargar").attr("disabled", "disabled" );
    }else{
        setValitationMesage("msgMaterias",true,"");
        if(desde!=""&&hasta!=""){
            if(desde<=hasta){
                $("#btnCargar").removeAttr("disabled");  
            }
        }
    }
}

function validarCampos(){
    let check = validar_checkbox();
    let just = validarFechasJustificativo();
    if(check==true && just==true){
        return true;
    }
    else{
        return false;
    }
}