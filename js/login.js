
let form=document.getElementById('form');
let user=document.getElementById('user');
let pass=document.getElementById('pass');
let error=document.getElementById('error');
error.style.color='red';
var expespacio= /^\s+$/;

function enviarLogin(){
console.log("enviando1..");
var mensajesError=[];
let act=0;
if(user.value===null || user.value===''){
    mensajesError.push('Ingresa usuario o correo ');
    act=1;
}
if(pass.value===null || pass.value===''){
    mensajesError.push('Ingresa la contraseña');
    act=1;
}
if(expespacio.test(user.value) || expespacio.test(pass.value) ){
    mensajesError.push("Datos no validos (Solo ingreso espacios)");
    act=1;
}
if(act ==1){
error.innerHTML =mensajesError.join('e ');
    return false;
}else{
    return true;
}
}
function validarCorreo (){
    var expCorreo=/\w+@\w+\.+[a-z]/;
    var mail=document.getElementById("mail").value;
    if(mail===null || mail===''){
        alert("Por favor llenar campo ");
    return false;
    }
    if(!expCorreo.test(mail)){
        alert("Formato de correo incorrecto: "+mail);
    return false;
    }
    if(expespacio.test(mail)){
        alert("Mail no valido");
    return false;
    }
}
function validarAnswer(){
    var answer=document.getElementById("answer").value;
    if(answer===null || answer===''){
        alert("Por favor llenar campo ");
    return false;
    }
    if(answer.length>100){
        alert("Respuesta demasiada larga");
    return false;
    }
    if(expespacio.test(answer)){
        alert("answer no valida");
    return false;
    }
}