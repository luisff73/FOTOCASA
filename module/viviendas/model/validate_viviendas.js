
function validate_ref_catastral(texto){ // Validacion de la referencia catastral
    if (texto.length > 0){
        var reg=/^[a-zA-Z]*$/; // verificacion de que solo sean letras  
        return reg.test(texto);
    }
    return false;
}

function validate_tipo(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_m2(texto){
    if (texto.length > 0){
        var reg=/^[0-9]*$/; // verificacion de que solo sean numeros
        return reg.test(texto);
    }
    return false;
}

function validate_habitaciones(texto){
    if (texto.length > 0){
        var reg=/^[0-9]*$/; // verificacion de que solo sean numeros
        return reg.test(texto);
    }
    return false;
}

function validate_localidad(texto){
    if (texto.length > 0){
        var reg=/^[a-zA-Z]*$/; // verificacion de que solo sean letras
        return reg.test(texto);
    }
    return false;
}

function validate_estado(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}
function validate_precio(texto){
    if (texto.length > 0){
        var reg=/^[0-9]*$/; // verificacion de que solo sean numeros
        return reg.test(texto);
    }
    return false;
}

function validate_fecha_publicacion(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}
   
function validate_activo(texto){
    if (texto.length > 0){
        var reg=/^[0-1]*$/; // verificacion de que solo sean numeros 0 o 1
        return reg.test(texto);
    }
    return false;
}


/*
function validate_password(texto){
    if (texto.length > 0){
        var reg = /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
        return reg.test(texto);
    }
    return false;
}

function validate_DNI(dni){
  var numero = dni.substr(0,dni.length-1);
  var let = dni.substr(dni.length-1,1);
  numero = numero % 23;
  var letra='TRWAGMYFPDXBNJZSQVHLCKET';
  letra=letra.substring(numero,numero+1);
  if (letra!=let){
      return false;
  }else{
      return true;
  }
}

function validate_sexo(texto){
    var i;
    var ok=0;
    for(i=0; i<texto.length;i++){
        if(texto[i].checked){
            ok=1
        }
    }
 
    if(ok==1){
        return true;
    }
    if(ok==0){
        return false;
    }
}

function validate_fecha(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_edad(texto){
    if (texto.length > 0){
        var reg=/^[0-9]{1,2}$/;
        return reg.test(texto);
    }
    return false;
}


function validate_idioma(array){
    var check=false;
    for ( var i = 0, l = array.options.length, o; i < l; i++ ){
        o = array.options[i];
        if ( o.selected ){
            check= true;
        }
    }
    return check;
}

function validate_observaciones(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_aficion(array){
    var i;
    var ok=0;
    for(i=0; i<array.length;i++){
        if(array[i].checked){
            ok=1
        }
    }
 
    if(ok==1){
        return true;
    }
    if(ok==0){
        return false;
    }
}
*/

function validate(op) {

    // return true;

    
    var check = true;
    var v_ref_catastral=document.getElementById('ref_catastral').value;
    var v_tipo_de_inmueble = document.getElementById('tipo').value;
    var v_m2 = document.getElementById('m2').value;
    var v_habitaciones = document.getElementById('habitaciones').value;
    var v_localidad = document.getElementById('localidad').value;
    var v_estado = document.getElementById('estado').value;
    var v_precio = document.getElementById('precio').value;
    var v_fecha_publicacion = document.getElementById('fecha_publicacion').value;
    var v_activo = document.getElementById('activo').value;

    var r_ref_catastral = validate_ref_catastral(v_ref_catastral);
    var r_tipo_de_inmueble = validate_tipo(v_tipo_de_inmueble);
    var r_m2 = validate_m2(v_m2);
    var r_habitaciones = validate_habitaciones(v_habitaciones);
    var r_localidad = validate_localidad(v_localidad);
    var r_estado = validate_estado(v_estado);
    var r_precio = validate_precio(v_precio);
    var r_fecha_publicacion = validate_fecha_publicacion(v_fecha_publicacion);
    var r_activo = validate_activo(v_activo);
    
    
    
 
    if (!r_ref_catastral) {
        document.getElementById('error_referencia_catastral').innerHTML = " * La referencia catastral no es valida";
        check = false;
    } else {
        document.getElementById('error_referencia_catastral').innerHTML = "";
    }

    if (!r_tipo_de_inmueble) {
        document.getElementById('error_tipo').innerHTML = " * El tipo de inmueble no es valido";
        check = false;
    } else {
        document.getElementById('error_tipo').innerHTML = "";
    }

    if (!r_m2) {
        document.getElementById('error_m2').innerHTML = " * Los metros cuadrados introducidos no son validos";
        check = false;
    } else {
        document.getElementById('error_m2').innerHTML = "";
    }
  
    if (!r_habitaciones) {
        document.getElementById('error_habitaciones').innerHTML = " * El numero de habitaciones introducido no es valido";
        check = false;
    } else {
        document.getElementById('error_habitaciones').innerHTML = "";
    }
    if (!r_localidad) {
        document.getElementById('error_localidad').innerHTML = " * La localidad introducida no es valida";
        check = false;
    } else {
        document.getElementById('error_localidad').innerHTML = "";
    }


    if (!r_estado) {
        document.getElementById('error_estado').innerHTML = " * No has seleccionado ningun estado";
        check = false;
    } else {
        document.getElementById('error_estado').innerHTML = "";
    }
    if (!r_precio) {
        document.getElementById('error_precio').innerHTML = " * El precio introducido no es valido";
        check = false;
    } else {
        document.getElementById('error_precio').innerHTML = "";
    }
    if (!r_fecha_publicacion) {
        document.getElementById('error_fecha_publicacion').innerHTML = " * No has seleccionado ningun fecha_publicacion";
        check = false;
    } else {
        document.getElementById('error_fecha_publicacion').innerHTML = "";
    }
    if (!r_activo) {
        document.getElementById('error_activo').innerHTML = " * No has seleccionado ningun activo";
        check = false;
    } else {
        document.getElementById('error_activo').innerHTML = "";
    }
 
    if (check) { // Si todo esta correcto, se envian los datos al controlador
        if (op == 'creates') {
            //alert('JAVASCRIPT VALIDATE CREATE');
            document.getElementById('create_viviendas').submit();
            document.getElementById('create_viviendas').action = "index.php?page=controller_viviendas&op=create";

        }
        if (op == 'updates') {
            //alert('JAVASCRIPT VALIDATE UPDATE');
            document.getElementById('update_viviendas').submit();
            document.getElementById('update_viviendas').action = "index.php?page=controller_viviendas&op=update";
        }
    }

    return check; // Si devuelve false, no se envian los datos al controlador
}

function operations_viviendas(op) {


    if (op == 'delete_v') {

        document.getElementById('delete_viviendas').submit(); // Enviamos el formulario con el id de la vivienda a eliminar
        document.getElementById('delete_viviendas').action = "index.php?page=controller_viviendas&op=delete_v"; // Al controlador con la operacion delete_viviendas y el id de la vivienda
        //document.getElementById('delete_viviendas').action="index.php?page=controller_viviendas&op=delete&id=<?php echo $_GET['id']; ?>";
    }
    if (op == 'delete_all') {
        document.getElementById('delete_all_viviendas').submit();
        document.getElementById('delete_all_viviendas').action = "index.php?page=controller_viviendas&op=delete_all";
    }
    if (op == 'dummies') {
        document.getElementById('dummies_viviendas').submit();
        document.getElementById('dummies_viviendas').action = "index.php?page=controller_viviendas&op=dummies";
    }

}

function showModal(title_vivienda, id) { // Show modal con los detalles vivienda
    $("#details_vivienda").show(); // Show div con id details_vivienda
    $("#vivienda_modal").dialog({ // Show modal with vivienda details
        title: title_vivienda,
        width: 850,
        height: 500,
        resizable: "false",
        modal: "true",
        hide: "fold",
        show: "fold",
        buttons: {
            Update: function () {

                window.location.href = 'index.php?page=controller_viviendas&op=update&id=' + id;
            },
            Delete: function () {
                window.location.href = 'index.php?page=controller_viviendas&op=delete_v&id=' + id;
            }
        }
    });
}

function loadContentModal() {
    $('.vivienda').click(function () { // When click on a vivienda
        var id = this.getAttribute('id'); // carga el id de la vivienda
        // console.log("FUNCION loadcontentmodal id" + id);

        ajaxPromise('module/viviendas/controller/controller_viviendas.php?op=read_modal&modal=' + id, 'GET', 'JSON')
            .then(function (data) { // muestra los detalles de la vivienda
                // console.log("data" + data);
                // alert("data" + data);
                //return false;
                $('<div></div>').attr('id', 'details_vivienda', 'type', 'hidden').appendTo('#vivienda_modal'); // Create a div with the id details_vivienda
                $('<div></div>').attr('id', 'container').appendTo('#details_vivienda'); // Create a div with the id container
                $('#container').empty(); // Empty the div with the id container
                $('<div></div>').attr('id', 'vivienda_content').appendTo('#container'); // Crea un div con id vivienda_content
                $('#vivienda_content').html(function () {  // añade el contenido del div con id vivienda_content
                    var content = "";
                    for (row in data) {
                        content += '<br><span>' + row + ': <span id =' + row + '>' + data[row] + '</span></span>';
                    }
                    return content; // Devuelve el contenido del div con id vivienda_content
                });
                showModal(title_vivienda = data.ref_catastral + " " + data.localidad, data.id); // Show modal with the vivienda details
            })
            .catch(function () {
                //  alert("error catch");
                window.location.href = 'index.php?module=errors&op=503&desc=List error';
            }
             );
    });
}

$(document).ready(function () { // Cuando el docuemnto esta ready
    loadContentModal();     // Carga el contenido de la funcion loadContentModal
});
