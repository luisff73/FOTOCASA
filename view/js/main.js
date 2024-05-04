
function ajaxPromises(sUrl, sType, sTData, sData = undefined) {

    return new Promise((resolve, reject) => {
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData,


            beforeSend: function () {
                $("#overlay").fadeIn(300); // Muestra el loader EN EL MENU
            }
        }).done((data) => {
            setTimeout(function () {
                $("#overlay").fadeOut(300); // Oculta el loader EN EL MENU
            }, 500);
            resolve(data);

        }).fail((jqXHR, textStatus, errorThrow) => {
            reject(errorThrow);
        });
    });
}

//================LOAD-HEADER================
function load_menu() {
    var accestoken = localStorage.getItem('accestoken');


    if (accestoken) { //si hay un valor en token

        ajaxPromises('module/login/controller/ctrl_login.php?op=data_user', 'POST', 'JSON', { 'accestoken': accestoken })
            .then(function (data) {
                //console.log('valor de data en main js: ');
                //console.log(data);
                if (data.type_user == "client") {
                    console.log("Cliente logeado");
                    $('#login-register').empty();
                    // $('.opc_CRUD').empty();
                    // $('.opc_exceptions').empty();
                } else {
                    console.log("Admin loged");
                    // $('.opc_CRUD').show();
                    // $('.opc_exceptions').show();
                }

                $('.log-icon').empty();
                $('#user_info').empty();
                $('login-register').empty();
                $('<img src="' + data.avatar + '"alt="Robot">').appendTo('.log-icon');
                $('<p></p>').attr({ 'id': 'username' }).appendTo('#des_inf_user')
                    .html('<a>' + data.username + '<a/>&nbsp;&nbsp;' +
                        '<a id="logout"><i id="icon-logout" class="fa-solid fa-right-from-bracket"></i></a>'
                    )

            }).catch(function () {
                //console.log('valor de data en el main error js: ' + data);
                console.log("Error al cargar los datos del user");
                console.log(data);
            });
    } else {
        console.log("No hay token disponible");
        $('.opc_CRUD').empty();
        $('.opc_exceptions').empty();
        $('#user_info').hide();
        $('.log-icon').empty();
        $('<a href="index.php?module=ctrl_login&op=login-register_view"><i id="col-ico" class="fa-solid fa-user fa-2xl"></i></a>').appendTo('.log-icon'); //añadimos el icono de login
    }
}


//================CLICK-LOGUT================
function click_logout() {

    $(document).on('click', '#logout', function () {

        toastr.success("Logout succesfully");

        setTimeout('logout(); ', 1000);
    });
}

//================LOG-OUT================
function logout() {
    ajaxPromise('module/login/controller/ctrl_login.php?op=logout', 'POST', 'JSON')
        .then(function (data) {
            //localStorage.removeItem('token');
            localStorage.removeItem('accestoken');   /// usamos siempre el ACCESStoken
            localStorage.removeItem('refreshtoken');
            localStorage.removeItem('total_prod');
            console.log('Logout succesfully');
            window.location.href = "index.php?module=ctrl_home&op=list";
        }).catch(function () {
            console.log('No se ha podido cerrar la sesión');
        });
}

// Remove localstorage('page') with click in shop
function click_shop() {
    $(document).on('click', '#opc_shop', function () {
        localStorage.removeItem('page');
        localStorage.removeItem('total_prod');
    });
}

$(document).ready(function () {
    load_menu();
    click_logout();
    click_shop();
});