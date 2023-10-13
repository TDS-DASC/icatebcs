function soloNumeros(e){
    return /[0-9]/i.test(e.key);
 }
 
 function soloLetras(e){
    return /[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/i.test(e.key);
 }
 
function letrasYNumeros(e){
    return /[a-zA-Z0-9\s]/i.test(e.key);
}

function letrasYNumerosSinEspacios(e) {
    return /[a-zA-Z0-9]/i.test(e.key);
}

function slug(e){
    return /[a-zA-Z0-9\-]/i.test(e.key);
}

function numeroDeCasa(e) {
    return /[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ/#,&\-]/i.test(e.key);
}

