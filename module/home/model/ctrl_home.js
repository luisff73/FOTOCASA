
function carousel_operation() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepageoperation', 'GET', 'JSON') //llamamos al ctr_home_ y ejecuta el DAO que nos devolverá la promesa
        .then(function (data) {
            for (row in data) {
                $('<div></div>').attr('class', "carousel__elements").attr('id', data[row].id_operation).appendTo(".carousel_operaciones")
                    .html(
                        "<img class='carousel__img' id='' src='" + data[row].image_name + "' alt='' >" +
                        "<h5>" + data[row].operation_name + "</h5>"
                    )

            }

            new Glider(document.querySelector('.carousel_operaciones'), {
                slidesToShow: 6,
                slidesToScroll: 1,
                draggable: true,
                dots: '.dots',
                arrows: {
                    prev: '.carousel__prev',
                    next: '.carousel__next',
                }
            });



        })
        .catch(function () {
            //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Carrousel_Brand HOME";
        });
}

function loadCategories() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepagecategory', 'GET', 'JSON') //llamamos al ctr_home_ y ejecuta el DAO que nos devolverá la promesa
        .then(function (data) {
            for (row in data) {

                $('<div></div>').attr('class', "div_cate").attr({ 'id': data[row].id_category }).appendTo('#containercategories')
                    .html(
                        "<li class='portfolio-item'>" +
                        "<div class='item-main'>" +
                        "<div class='portfolio-image'>" +
                        "<img src = " + data[row].image_name + " alt='foto' </img> " +
                        "</div>" +
                        "<h5>" + data[row].category_name + "</h5>" +
                        "</div>" +
                        "</li>"
                    )
            }
        }).catch(function () {
            //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
        });
}

function loadcatcity() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepagecity', 'GET', 'JSON')
        .then(function (data) {
            for (row in data) {
                $('<div></div>').attr('class', "div_city").attr({ 'id': data[row].id_city }).appendTo('#containercity')
                    .html(
                        "<li class='portfolio-item'>" +
                        "<div class='item-main2'>" +
                        "<div class='portfolio-image'>" +
                        "<img src = " + data[row].image_name + " alt='foto' </img> " +
                        "</div>" +
                        "<h5>" + data[row].city_name + "</h5>" +
                        "</div>" +
                        "</li>"
                    )
            }
        }).catch(function () {
            //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Types_car HOME";
        });
}

function loadCatTypes() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepagetype', 'GET', 'JSON')
        .then(function (data) {
            for (row in data) {
                $('<div></div>').attr('class', "div_type").attr({ 'id': data[row].id_type }).appendTo('#containertype')
                    .html(
                        "<li class='portfolio-item'>" +
                        "<div class='item-main3'>" +
                        "<div class='portfolio-image'>" +
                        "<img src = " + data[row].image_name + " alt='foto' </img> " +
                        "</div>" +
                        //"<h5>" + data[row].type_name + "</h5>" +
                        "</div>" +
                        "</li>"
                    )

            }
        }).catch(function () {
            //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Types_car HOME";
        });
}

function loadoperation() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepageoperation', 'GET', 'JSON')
        .then(function (data) {
            for (row in data) {
                $('<div></div>').attr('class', "div_operation").attr({ 'id': data[row].id_operation }).appendTo('#containeroperation')
                    .html(
                        "<li class='portfolio-item'>" +
                        "<div class='item-main'>" +
                        "<div class='portfolio-image'>" +
                        "<img src = " + data[row].image_name + " alt='foto' </img> " +
                        "</div>" +
                        "<h5>" + data[row].operation_name + "</h5>" +
                        "</div>" +
                        "</li>"
                    )
            }
        }).catch(function () {
            //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
        });
}



function mas_visitadas() {


    ajaxPromise('module/home/controller/ctrl_home.php?op=mas_visitadas', 'GET', 'JSON')
        .then(function (data) {
            for (row in data) {
                $('<div></div>').attr('class', "div_busquedas").attr({ 'id': data[row].id_vivienda }).appendTo('#containermasvisitadas')
                    .html(
                        "<li class='portfolio-item'>" +
                        "<div class='item-main'>" +
                        "<div class='portfolio-image'>" +
                        "<img src = " + data[row].image_name + " alt='foto' </img> " +
                        "</div>" +
                        "<h5>" + data[row].city_name + "</h5>" +
                        "<p>Precio: " + data[row].vivienda_price + " Visitas: " + data[row].visitas + "</p>" +
                        "</div>" +
                        "</li>"
                    )
            }
        }).catch(function () {
            //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
        });
}


function ultimas_busquedas() {

    var filters_shop = localStorage.getItem('filters_shop');


    ajaxPromise('module/home/controller/ctrl_home.php?op=ultimas_busquedas', 'GET', 'JSON')
        .then(function (data) {
            for (row in data) {
                $('<div></div>').attr('class', "div_busquedas").attr({ 'id': data[row].id_vivienda }).appendTo('#containerbusquedas')
                    .html(
                        "<li class='portfolio-item'>" +
                        "<div class='item-main'>" +
                        "<div class='portfolio-image'>" +
                        "<img src = " + data[row].image_name + " alt='foto' </img> " +
                        "</div>" +
                        "<h5>" + data[row].state + "</h5>" +
                        "<p>Precio: " + data[row].vivienda_price + "</p>" +
                        "</div>" +
                        "</li>"
                    )
            }
        }).catch(function () {
            //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
        });
}

function clicks() { //función que se encarga de redirigir a la página de shop con los filtros seleccionados


    $(document).on("click", 'div.carousel__elements', function () { //recoge el click en el carrousel con el div.carousel__elements
        var filters_home = [];
        filters_home.push({ "id_operation": [this.getAttribute('id')] });//añade el id del elemento seleccionado al array de filtros
        localStorage.removeItem('filters_home')
        localStorage.setItem('filters_home', JSON.stringify(filters_home));
        setTimeout(function () {
            window.location.href = 'index.php?page=ctrl_shop&op=list'; //redirige a la página de shop con la opcion de ver los productos filtrados.
        }, 200);
    });

    $(document).on("click", 'div.div_cate', function () {  //recoge el click en el div.div_cate
        var filters_home = [];
        filters_home.push({ "id_category": [this.getAttribute('id')] });
        localStorage.removeItem('filters_home')
        localStorage.setItem('filters_home', JSON.stringify(filters_home));
        setTimeout(function () {
            window.location.href = 'index.php?page=ctrl_shop&op=list'; //redirige a la página de shop con la opcion de ver los productos filtrados.
        }, 200);
    });

    $(document).on("click", 'div.div_city', function () { //recoge el click en el div.div_city
        var filters_home = [];
        filters_home.push({ "id_city": [this.getAttribute('id')] });
        localStorage.removeItem('filters_home')
        localStorage.setItem('filters_home', JSON.stringify(filters_home));
        setTimeout(function () {
            window.location.href = 'index.php?page=ctrl_shop&op=list'; //redirige a la página de shop con la opcion de ver los productos filtrados.
        }, 200);
    });

    $(document).on("click", 'div.div_type', function () { //recoge el click en el div.div_type
        var filters_home = [];
        filters_home.push({ "id_type": [this.getAttribute('id')] });
        localStorage.removeItem('filters_home')
        localStorage.setItem('filters_home', JSON.stringify(filters_home));
        setTimeout(function () {
            window.location.href = 'index.php?page=ctrl_shop&op=list'; //redirige a la página de shop con la opcion de ver los productos filtrados.
        }, 200);
    });

    $(document).on('click', '#regreso_home', function () {
        localStorage.removeItem('filters_home');
        localStorage.removeItem('filters_shop');
        localStorage.removeItem('filters_search');
    });
}

$(document).ready(function () {
    carousel_operation();
    loadCategories();
    loadcatcity();
    loadCatTypes();
    loadoperation();
    ultimas_busquedas();
    mas_visitadas();
    clicks();
});