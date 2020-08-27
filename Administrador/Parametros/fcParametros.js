function minutosValidos(){
    eval("debugger;");
    var min = document.getElementById('minutosCodigo').value;
    var minAnt = document.getElementById('minutosCodigoAnt').value;
    var rtdo =false;
    var msg;
    if (min  > 0 && (min % 5) == 0){ 
      if(min != minAnt){
         rtdo = true;
        }else{
           msg ="Es el mismo codigo que esta vigente"; 
        }
     }else{
         msg ="El codigo tiene que ser multiplo de 5";
     }
    
    changeColor('minutosCodigo',rtdo);
    setValitationMesage('msjValidacionCodigo', rtdo, msg);
    
    return rtdo;
}

function changeColor(elementID, rtdo){
    if(rtdo == false){
        document.getElementById(elementID).style.backgroundColor = "PeachPuff";
        document.getElementById(elementID).style.color = "Black";
        }else{
            document.getElementById(elementID).style.backgroundColor = "Azure";  
            document.getElementById(elementID).style.color = "Black";
        }
}


function setValitationMesage(elementID, rtdo, msg){
    if(rtdo == false){ document.getElementById(elementID).style.visibility='visible';
        document.getElementById(elementID).style.display='contents';
        document.getElementById(elementID).style.color = "Red"
        document.getElementById(elementID).innerHTML = msg;
    }else{
        document.getElementById(elementID).style.visibility='hidden';
        document.getElementById(elementID).style.display='none';
    }
      
}