
 var exptelefono=/^\d{10}$/;
 var expespacio= /^\s+$/;
 var expfecha, expnum ;
 var expfecha = /^([0-9]{4})\-([0-9]{2})\-([0-9]{2})$/;
 var expnum=/^([0-9])*$/;
function validarEditM (){
    var telefono;
     telefono = document.getElementById("telefono").value;
      if(telefono==="" ){
      alert("Por favor rellene los campos obligatorios ");
      return false;
     }
     if(expespacio.test(telefono)){
      alert("No se permiten espacios en blanco");
      return false;
     }
     if(!exptelefono.test(telefono)){
      alert("Telefono muy largo o telefono invalido");
      return false;
     }
   }
function validarEditC() {
    let fecha, hora;
    fecha = document.getElementById("fecha").value;
    hora = document.getElementById("hora").value;
   if(!expfecha.test(fecha)){
    alert("Formato de fecha incorrecto: "+fecha);
    return false;
   }
   if(!expnum.test(hora)){
    alert("Formato de hora incorrecto");
    return false;
   }
}