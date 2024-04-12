function login() {
    if (validate_login() != 0) {
        var data = [];
        data.push({ name: 'username_log', value: document.getElementById('username_log').value });
        data.push({ name: 'passwd_log', value: document.getElementById('passwd_log').value });
        //console.log('valor de data ');
        //console.log(data);
        ajaxPromise('module/login/controller/ctrl_login.php?op=login', 'POST', 'JSON', data)
            .then(function (result) {
                console.log('VALOR DE RESULT :' + result); //esto es lo que devuelve el php en formato json QUE ES EL TOKEN
                if (result == "error_select_user") {
                    document.getElementById('error_username_log').innerHTML = "El usario no existe,asegurase de que lo a escrito correctamente"
                } else if (result == "error_password") {
                    document.getElementById('error_passwd_log').innerHTML = "La contraseña es incorrecta"
                } else {
                    localStorage.setItem("token", result);
                    toastr.success("Loged succesfully");

                    // if (localStorage.getItem('redirect_like')) {
                    //     setTimeout(' window.location.href = "index.php?module=ctrl_shop&op=list"; ', 3000);
                    // } else {
                    setTimeout(' window.location.href = "index.php?page=ctrl_shop&op=list"; ', 3000);
                    // }
                }
            }).catch(function (textStatus) {
                if (console && console.log) { //
                    console.log("La solicitud ha fallado en el login : " + textStatus);
                }
            });
    }
}

function key_login() {
    $("#login").keypress(function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            e.preventDefault();
            login();
        }
    });
}

function button_login() {
    $('#login').on('click', function (e) {
        e.preventDefault();//evita que se recargue la pagina, en JavaScript se utiliza para prevenir la ejecución de la acción predeterminada del evento.
        login();
    });
}

function validate_login() {
    var error = false;

    if (document.getElementById('username_log').value.length === 0) {
        document.getElementById('error_username_log').innerHTML = "Por favor, introduce el usuario";
        error = true;
    } else {
        if (document.getElementById('username_log').value.length < 5) {
            document.getElementById('error_username_log').innerHTML = "El usuario tiene que tener 5 caracteres como minimo";
            error = true;
        } else {
            document.getElementById('error_username_log').innerHTML = "";
        }
    }

    if (document.getElementById('passwd_log').value.length === 0) {
        document.getElementById('error_passwd_log').innerHTML = "Por favor, introduce la contraseña";
        error = true;
    } else {
        document.getElementById('error_passwd_log').innerHTML = "";
    }

    if (error == true) {
        return 0;
    }
}

$(document).ready(function () {
    key_login();
    button_login();
});