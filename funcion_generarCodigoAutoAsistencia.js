function getRandomInt() {
  return Math.floor(Math.random() * 1000000000);
}
 var codigoGenerado = "TC" + getRandomInt();
console.log(codigoGenerado);

var grupo1 = codigoGenerado.substring(0,2);
var grupo2 = codigoGenerado.substring(2,5);
var grupo3 = codigoGenerado.substring(5,8);
var grupo4 = codigoGenerado.substring(8,11);

console.log(grupo1);
console.log(grupo2);
var codigo = grupo1 + " " +grupo2 + " " + grupo3 + " " + grupo4;

console.log(codigo);
