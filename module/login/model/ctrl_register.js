function register() {
    if (validate_register() != 0) {
        var data = [];
        data.push({ name: 'username_reg', value: document.getElementById('username_reg').value });
        data.push({ name: 'passwd1_reg', value: document.getElementById('passwd1_reg').value });
        data.push({ name: 'passwd2_reg', value: document.getElementById('passwd2_reg').value });
        data.push({ name: 'email_reg', value: document.getElementById('email_reg').value });

        //console.log(data);

        ajaxPromise('module/login/controller/ctrl_login.php?op=register', 'POST', 'JSON', data)
            .then(function (result) {
                if (result == "error_email") {
                    document.getElementById('error_email_reg').innerHTML = "El email ya esta en uso, asegurate de no tener ya una cuenta"
                } else if (result == "error_user") {
                    document.getElementById('error_username_reg').innerHTML = "El usuario ya esta en uso, intentalo con otro"
                } else {

                    toastr.options = {
                        closeButton: true,
                        debug: false,
                        newestOnTop: false,
                        progressBar: true,
                        positionClass: "toast-center-center",
                        preventDuplicates: true,
                        showDuration: "4000",
                        hideDuration: "3000",
                        timeOut: "4000",
                        extendedTimeOut: "4000",
                    };

                    toastr.success("Registery succesfully");
                    setTimeout(' window.location.href = "index.php?page=ctrl_login&op=login-register_view"; ', 4000);
                }
            }).catch(function (textStatus) {
                if (console && console.log) {
                    console.log("La solicitud ha fallado en el register: " + textStatus);
                }
            });
    }
}

function key_register() {
    $("#register").keypress(function (e) {
        var code = (e.keyCode ? e.keyCode : e.which); //comprobamos si se ha pulsado la tecla enter
        if (code == 13) {
            e.preventDefault(); //El método .preventDefault() es un método en JavaScript que se utiliza para prevenir la acción predeterminada del navegador en respuesta a un evento.
            register();
        }
    });
}

function button_register() {
    $('#register').on('click', function (e) {

        e.preventDefault();
        register();
    });
}

function validate_register() {
    var username_exp = /^(?=.{5,}$)(?=.*[a-zA-Z0-9]).*$/;
    var mail_exp = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    // COMENTO PARA PRUEBAS var pssswd_exp = /^(?=.{7,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/;
    var pssswd_exp = /^(?=.{6,}$)(?=.*[A-Z]).*$/;
    var error = false;

    if (document.getElementById('username_reg').value.length === 0) {
        document.getElementById('error_username_reg').innerHTML = "Tienes que escribir el usuario";
        error = true;
    } else {
        if (document.getElementById('username_reg').value.length < 5) {
            document.getElementById('error_username_reg').innerHTML = "El username tiene que tener 5 caracteres como minimo";
            error = true;
        } else {
            if (!username_exp.test(document.getElementById('username_reg').value)) {
                document.getElementById('error_username_reg').innerHTML = "No se pueden poner caracteres especiales";
                error = true;
            } else {
                document.getElementById('error_username_reg').innerHTML = "";
            }
        }
    }

    if (document.getElementById('email_reg').value.length === 0) {
        document.getElementById('error_email_reg').innerHTML = "Tienes que escribir un correo";
        error = true;
    } else {
        if (!mail_exp.test(document.getElementById('email_reg').value)) {
            document.getElementById('error_email_reg').innerHTML = "El formato del mail es invalido";
            error = true;
        } else {
            document.getElementById('error_email_reg').innerHTML = "";
        }
    }

    if (document.getElementById('passwd1_reg').value.length === 0) {
        document.getElementById('error_passwd1_reg').innerHTML = "Tienes que escribir la contraseña";
        error = true;
    } else {
        if (document.getElementById('passwd1_reg').value.length < 6) {
            document.getElementById('error_passwd1_reg').innerHTML = "La password tiene que tener 7 caracteres como minimo";
            error = true;
        } else {
            if (!pssswd_exp.test(document.getElementById('passwd1_reg').value)) {
                console.log(document.getElementById('passwd1_reg').value);
                document.getElementById('error_passwd1_reg').innerHTML = "Debe de contener minimo 7 caracteres, mayusculas, minusculas y simbolos especiales";
                error = true;
            } else {
                document.getElementById('error_passwd1_reg').innerHTML = "";
            }
        }
    }

    if (document.getElementById('passwd2_reg').value.length === 0) {
        document.getElementById('error_passwd2_reg').innerHTML = "Tienes que repetir la contraseña";
        error = true;
    } else {
        if (document.getElementById('passwd2_reg').value.length < 7) {
            document.getElementById('error_passwd2_reg').innerHTML = "La password tiene que tener 7 caracteres como minimo";
            error = true;
        } else {
            if (document.getElementById('passwd2_reg').value === document.getElementById('passwd1_reg').value) {
                document.getElementById('error_passwd2_reg').innerHTML = "";
            } else {
                document.getElementById('error_passwd2_reg').innerHTML = "La password's no coinciden";
                error = true;
            }
        }
    }

    if (error == true) {
        return 0;
    }
}

$(document).ready(function () {
    key_register();
    button_register();
});