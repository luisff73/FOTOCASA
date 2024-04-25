function protecturl() {
    var accestoken = localStorage.getItem('accestoken');
    //console.log("Control activity recogemos el token EN PROTECTURL: " + accestoken);
    ajaxPromise('module/login/controller/ctrl_login.php?op=controluser', 'POST', 'JSON', { 'accestoken': accestoken })
        .then(function (data) {
            if (data == "Correct_User") {
                console.log("CORRECTO-->El usario coincide con la session");
            } else if (data == "Wrong_User") {
                console.log("INCORRECTO--> Estan intentando acceder a una cuenta");
                logout_auto();
            }
        })
        .catch(function () { console.log("ANONYMOUS_user") });
}

function control_activity() {
    //ESTA FUNCION RECOGERA EL TOKEN Y COMPROBARA SI EL USUARIO ESTA ACTIVO O INACTIVO
    var accestoken = localStorage.getItem('accestoken');
    //console.log("Control activity recogemos el token EN CONTROL ACTIVITY: " + accestoken);

    if (accestoken) {
        ajaxPromise('module/login/controller/ctrl_login.php?op=actividad', 'POST', 'JSON')
            .then(function (response) {
                if (response == "inactivo") {
                    console.log("usuario INACTIVO");
                    logout_auto();
                } else {
                    console.log("usuario ACTIVO")
                }
            });
    } else {
        console.log("No hay usario logeado");
    }
}

function refresh_cookie() {
    ajaxPromise('module/login/controller/ctrl_login.php?op=refresh_cookie', 'POST', 'JSON')
        //.then(function (response) {??RESPONSE NO SE USA??
        .then(function (response) {
            //console.log("Refresh cookie correctly");
        });
}

function logout_auto() {

    ajaxPromise('module/login/controller/ctrl_login.php?op=logout', 'POST', 'JSON')
        .then(function (data) {
            localStorage.removeItem('accestoken');
            localStorage.removeItem('refreshtoken');
            window.location.href = "index.php?module=ctrl_home&op=list";
        }).catch(function () {
            console.log('Something has occured');
        });
}

$(document).ready(function () {

    //controal activity se ejecuta cada xxxx tiempo para comprobar si el usuario esta activo 
    //o inactivo dependiendo del valor que devuelva el php (alli definimos el tiempo de inactividad que queramos)
    setInterval(function () { control_activity() }, 10000); //10min= 600000

    // esta funcion se encarga de comprobar que el usuario que esta logeado 
    // es el mismo que el que esta en la session (comparando el token del 
    // servidor y el usuario de localStorage)
    protecturl();

    //igual que en el caso anterior, este fragmento de código
    setInterval(function () { refresh_cookie() }, 15000);
});