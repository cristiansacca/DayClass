function validarDNI() {
    var elem = document.getElementById('inputDNI').value;
    alert(elem);
    var cantDigitos = elem.length;
    
    if(cantDigitos == 8){
        var rtdo = numbers(elem);
        if(rtdo == false){
            alert("En el DNI solo van números");
        }
       }else{
           alert("El número de DNI deben ser 8 números");
       }
}






function numbers(nros){
	var patron = /^[0-9]*$/;
	return patron.test(nros);
}