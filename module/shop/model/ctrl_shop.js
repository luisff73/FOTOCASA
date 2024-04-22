
function ajaxForSearch(url, type, dataType, sData = undefined, offset = 0, items_page = 3) {

    ajaxPromise(url, type, dataType, sData, { 'offset': offset, 'items_page': items_page })

        .then(function (data) {
            console.log(data); //ESTE ES IMPORTANTE PARA DEPURAR
            $('#content_shop_viviendas').empty();  //vacia el contenido de la página de shop.html
            $('.date_viviendas' && '.date_img').empty();//vacia el contenido de la página de shop.html

            if (data == "error") {//si el valor de data es igual a error
                $('<div></div>').appendTo('#content_shop_viviendas')
                    .html(
                        '<h3>¡No se encuentarn resultados con los filtros aplicados!</h3>'
                    )
            } else {

                for (row in data) {
                    var imageHtml = "";
                    if (data[row].adapted) {
                        imageHtml = "<img src='view/img/logo_minusvalido_mini.png'>";

                        var resultHtml = "<i id='col-ico' class='image'></i>&nbsp;&nbsp;&nbsp;" + imageHtml + " " + data[row].adapted + " €";
                    } else { resultHtml = "" }

                    $('<div></div>').attr({ 'id': data[row].id_vivienda, 'class': 'list_content_shop' }).appendTo('#content_shop_viviendas')

                        .html(
                            "<div class='list_product'>" +
                            "<div class='img-description-container'>" +
                            "<div class='img-container'>" +
                            "<img src='" + data[row].image_name + "' style='width: 100%;' />" +
                            "</div>" +
                            "<div class='description'>" + data[row].description + "</div>" +
                            "</div>" +
                            "<div class='product-info'>" +
                            "<div class='product-content'>" +
                            "<h1><b><a class='list__house' id='" + data[row].id_vivienda + "'><i id='" + data[row].id_vivienda + "' class='fa-solid fa-house-chimney-window'></i></a>   " + data[row].vivienda_name + "</b></h1>" +
                            "<table>" +
                            "<tr>" +
                            "<td rowspan='5'>" + // Aquí ajusta el valor según cuántas filas desees que abarque resultHtml
                            "<ul>" +
                            "<li><i id='col-ico' class='fa-solid fa-city'></i>&nbsp;&nbsp; Localidad " + data[row].city_name + "</li>" +
                            "<li><i id='col-ico' class='fa-solid fa-flag-usa'></i>&nbsp;&nbsp; Provincia " + data[row].state + "</li>" +
                            "<li><i id='col-ico' class='fa-solid fa-signal'></i>&nbsp;&nbsp;&nbsp;" + data[row].status + "&nbsp;&nbsp;&nbsp;<i id='col-ico' class='fa-solid fa-vector-square'></i>&nbsp;&nbsp;&nbsp;" + data[row].m2 + " m2" + "</li>" +
                            "<li><i id='col-ico' class='fa-regular fa-font-awesome'></i>&nbsp;&nbsp;&nbsp;" + data[row].category_name + "&nbsp;&nbsp;&nbsp;<i id='col-ico' class='fa-regular fa-chart-bar'></i>&nbsp;&nbsp;&nbsp;" + data[row].type_name + "</li>" +
                            "<li><i id='col-ico' class='fa-regular fa-font-awesome'></i>&nbsp;&nbsp;&nbsp;" + data[row].operation_name + "&nbsp;&nbsp;&nbsp;<i id='col-ico' class='fa-regular fa-chart-bar'></i>&nbsp;&nbsp;&nbsp;" + data[row].type_name + " Visitas " + "</li>" +
                            "</ul>" +
                            "</td>" +
                            "<td>" +
                            "<ul>" +
                            "<li><i id='col-ico' class='image'></i>&nbsp;&nbsp;&nbsp;" + resultHtml + "</li>" +
                            "</ul>" +
                            "</td>" +
                            "</tr>" +
                            "</table>" +
                            "<div class='buttons'>" +
                            "<button id='" + data[row].id_vivienda + "' class='detalles_inmueble button add' >Detalles</button>" +
                            "<button class='button buy' >Comprar</button>" + "&nbsp;&nbsp;&nbsp;" +
                            "<h1><b><span class='button' id='price'>" + data[row].vivienda_price + ' €' + "</span></b></h1>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "</div>"
                        )
                }
            }
            console.log(data);
            mapBox_all(data);
        }).catch(function () {
            console.log(data);
            console.log('error catch');
        });
}


function loadviviendas() {

    //var verificate_filters_home = localStorage.getItem('filters_home') || undefined; //si no hay un valor, devuelve une valor undefined
    var verificate_filters_shop = localStorage.getItem('filters_shop') || undefined; //si no hay un valor, devuelve une valor undefined
    //var verificate_filters_search = localStorage.getItem('filters_search') || undefined; //si no hay un valor, devuelve une valor undefined
    var offset = 0;
    var items_page = 3;

    //if (verificate_filters_home != undefined) { // comprueba si la variable verificate_filters es distinta de false (si existe)
    //    var filters = JSON.parse(verificate_filters_home); // convierte la variable json a un objeto de javascript pasamos del string al objeto array
    //    ajaxForSearch('module/shop/controller/ctrl_shop.php?op=filters_home', 'POST', 'JSON', { 'filters': filters, 'offset': offset, 'items_page': items_page }); // si es distinta de false carga los filtros de la página de shop
    //} else 
    if (verificate_filters_shop != undefined) {
        var filters = JSON.parse(verificate_filters_shop); // convierte la variable json a un objeto de javascript pasamos del string al objeto array
        ajaxForSearch('module/shop/controller/ctrl_shop.php?op=filters_shop', 'POST', 'JSON', { 'filters': filters, 'offset': offset, 'items_page': items_page }); // si es distinta de false carga los filtros de la página de shop
    } else {
        // if (verificate_filters_search != undefined) {
        //     alert('valor de filters_search en load viviendas' + verificate_filters_search)
        //     var filters = JSON.parse(verificate_filters_search); // convierte la variable json a un objeto de javascript pasamos del string al objeto array
        //     ajaxForSearch('module/shop/controller/ctrl_shop.php?op=filters_search', 'POST', 'JSON', { 'filters': filters, 'offset': offset, 'items_page': items_page });
        //ajaxForSearch('module/shop/controller/ctrl_shop.php?op=filters_search', 'POST', 'JSON', { 'filters': filters }, { 'offset': offset }, { 'items_page': items_page }); // si es distinta de false carga los filtros de la página de shop
        // } else {

        //console.log('no hay filtros en load viviendas');
        ajaxForSearch('module/shop/controller/ctrl_shop.php?op=all_viviendas', 'POST', 'JSON', { 'filters': filters, 'offset': offset, 'items_page': items_page }); // si no carga todas las viviendas

    }
}
function mapBox(id) {
    console.log(id);
    mapboxgl.accessToken = 'pk.eyJ1IjoiMjBqdWFuMTUiLCJhIjoiY2t6eWhubW90MDBnYTNlbzdhdTRtb3BkbyJ9.uR4BNyaxVosPVFt8ePxW1g';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [id.long, id.lat], // starting position [lng, lat]
        zoom: 9 // starting zoom
    });
    const marker = new mapboxgl.Marker()
    const minPopup = new mapboxgl.Popup()
    minPopup.setHTML('<h5>' + id.vivienda_name + '</h5>' +
        '<p>Precio: ' + id.vivienda_price + '€</p>' +
        '<img id="imagen_vivienda_mapa"; src=" ' + id.image_name + '"/>')
    marker.setPopup(minPopup)
        .setLngLat([id.long, id.lat])
        .addTo(map);
}
function mapBox_all(data) {
    //console.log(data);
    mapboxgl.accessToken = 'pk.eyJ1IjoiMjBqdWFuMTUiLCJhIjoiY2t6eWhubW90MDBnYTNlbzdhdTRtb3BkbyJ9.uR4BNyaxVosPVFt8ePxW1g';
    const map = new mapboxgl.Map({
        container: 'map',// id del contenedor HTML donde se mostrará el mapa
        style: 'mapbox://styles/mapbox/streets-v11',// estilo del mapa
        center: [-0.5209, 38.8254], // starting position [lng, lat]
        zoom: 5 // starting zoom
    });

    for (row in data) {
        const marker = new mapboxgl.Marker()// creamos un nuevo marcador para cada vivienda
        const minPopup = new mapboxgl.Popup() // creamos un nuevo popup para cada vivienda
        mapboxgl.window = window;
        minPopup.setHTML('<h5 style="text-align:center;">' + data[row].vivienda_name + '</h5><p style="text-align:center;">Inmueble: <b>' + data[row].category_name + '</b><br>' +
            '<style="text-align:center;">Precio: <b>' + data[row].vivienda_price + '€</b></p>' +
            '<img id="imagen_vivienda_mapa"; src=" ' + data[row].image_name + '"/>' +
            '<a class="button button-primary-outline button-ujarak button-size-1 wow fadeInLeftSmall detalles_inmueble" data-wow-delay=".4s" id="' + data[row].id_vivienda + '">Detalles</a>')

        marker.setPopup(minPopup)
            .setLngLat([data[row].long, data[row].lat])
            .addTo(map);
    }
}
function clicks_details() {
    $(document).on("click", ".detalles_inmueble", function () {
        var id_vivienda = this.getAttribute('id');
        alert('id_vivienda ' + id_vivienda);
        loadDetails(id_vivienda);
        ajaxPromise('module/shop/controller/ctrl_shop.php?op=incrementa_visita&id=' + id_vivienda, 'POST', 'JSON')
            .then(function () {
                console.log('Visita incrementada con éxito');
            })
            .catch(function () {
            });
    });
}
function loadDetails(id_vivienda) {

    ajaxPromise('module/shop/controller/ctrl_shop.php?op=details_vivienda&id=' + id_vivienda, 'GET', 'JSON')

        .then(function (data) {

            $('#content_shop_viviendas').empty();
            $('.date_img_dentro').empty();
            $('.date_vivienda_dentro').empty();
            $('#pagination').empty();

            for (row in data[1][0]) { //recorremos el array de imagenes
                console.log(data);
                $('<div></div>').attr({ 'id': data[1][0].id_image, class: 'date_img_dentro' }).appendTo('.date_img')
                    .html(
                        "<div class='content-img-details'>" +
                        "<img src= '" + data[1][0][row].image_name + "'" + "</img>" +
                        "</div>"
                    )
            }

            $('<div></div>').attr({ 'id': data[0].id_vivienda, class: 'date_vivienda_dentro' }).appendTo('.date_viviendas')
                .html(
                    "<div class='list_product_details'>" +
                    "<div class='product-info_details'>" +
                    "<div class='product-content_details'>" +
                    "<h1><b>" + data[0].vivienda_name + "</b></h1>" +
                    "<hr class=hr-shop>" +
                    "<table id='table-shop'> <tr>" +
                    "<td>" +
                    "<td> <i id='col-ico' class='fa-solid fa-money-check-dollar'></i> &nbsp;" + data[0].vivienda_price + " €" + "</td>" +
                    "<td> <i id='col-ico' class='fa-solid fa-flag-usa'></i> &nbsp;" + data[0].state + "</td> " +
                    "<td> <i id='col-ico' class='fa-regular fa-font-awesome'></i> &nbsp;" + data[0].category_name + "</td> " +
                    "</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td>" +
                    "<td> <i id='col-ico' class='fa-solid fa-money-bill-wave'></i> &nbsp;" + data[0].operation_name + " </td>" +
                    "<td> <i id='col-ico' class='fa-solid fa-vector-square'></i> &nbsp;" + data[0].m2 + " m2" + "</td>" +
                    "<td> <i id='col-ico' class='fa-solid fa-signal'></i> &nbsp;" + data[0].status + "</td>" +
                    "</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td>" +
                    "<td> <i id='col-ico' class='fa-solid fa-city'></i> &nbsp;" + data[0].city_name + "</td>" +
                    "<td> <i id='col-ico' class='fa-regular fa-chart-bar'></i> &nbsp;" + data[0].type_name + " </td>" +
                    "</table>" +
                    "<hr class=hr-shop>" +
                    "<h3><b>" + "Mas información:" + "</b></h3>" +
                    "<p>Inmueble con certificado de eficiencia energetica.</p>" +
                    "<div class='buttons_details'>" +
                    "<span class='button add' href='#'>Añadir a la cesta</span>" +
                    "<span class='button buy' href='#'>Compra directa</span>" +
                    "<span class='button' id='price_details'>" + data[0].vivienda_price + "<i class='fa-solid fa-euro-sign'></i> </span>" +
                    "<a class='details__heart' id='" + data[0].id_vivienda + "'><i id=" + data[0].id_vivienda + " class='fa-solid fa-heart fa-lg'></i></a>" +
                    "</td>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                )

            $('.date_img').slick({
                dots: true,
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                arrows: true,
            });
            more_viviendas_related(data[0].id_city)// PASAMOS EL ID DE LA CIUDAD PARA QUE NOS DEVUELVA LOS INMUEBLES RELACIONADOS

            mapBox(data[0]);

        }).catch(function () {
            //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Load_Details SHOP";
        });
}
function print_filters() {

    // Creamos un nuevo elemento <div> con la clase "div-filters" y luego lo agregamos como un hijo al elemento con la clase "filters".
    $('<div class="div-filters"></div>').appendTo('.filters_shop_html') //añadimos un div con la clase div-filters a la clase filters
        .html(
            '<select class="filter_category" id="select_category">' +
            '<option style="display:none">Tipo de inmueble</option>' +
            // '<option value="1">Piso</option>' +
            // '<option value="2">Adosado</option>' +
            // '<option value="3">Parcela</option>' +
            // '<option value="4">Local</option>' +
            // '<option value="6">Chalet</option>' +
            // '<option value="7">Trastero</option>' +
            // '<option value="8">Nave Industrial</option>' +
            // '<option value="9">Duplex</option>' +
            '</select>' +
            '<select class="filter_operation" id="select_operation">' +
            '<option style="display:none">Tipo de Operacion</option>' +
            // '<option value="13">Compra</option>' +
            // '<option value="14">Venta</option>' +
            // '<option value="15">Alquiler</option>' +
            // '<option value="16">Alquiler opcion a compra</option>' +
            // '<option value="17">Alquiler habitaciones</option>' +
            // '<option value="18">Compra naves</option>' +
            '</select>' +
            '<select class="filter_city" id="select_city">' +
            '<option style="display:none">Localidad</option>' +
            // '<option value="1">Albaida</option>' +
            // '<option value="2">Fontanars</option>' +
            // '<option value="3">Ontinyent</option>' +
            // '<option value="4">Bocairent</option>' +
            // '<option value="5">Agullent</option>' +
            // '<option value="6">Paterna</option>' +
            // '<option value="7">Valencia</option>' +
            // '<option value="8">Xativa</option>' +
            '</select>' +
            '<select class="filter_price" id="select_price">' +
            '<option style="display:none">Cualquier precio</option>' +
            '<option value="1|29999">Menos de 30000 Eur</option>' +
            '<option value="30000|50000">De 30000 a 50000 Eur</option>' +
            '<option value="50000|100000">De 50000 a 100000 Eur</option>' +
            '<option value="100000|900000">De 100000 a 150000 Eur</option>' +
            '</select>' +
            //-- Botón que abre el modal -->
            '<button id="openModalEstado">Estado</button>' +
            '<div id="modal_estado" class="modal">' +
            '<div class="modal-content">' +
            '<span class="close">&times;</span>' +
            '<div class="filter_type checkbox-container" id="select_type">' +
            //'<label><input type="radio" name="type" value="7"> A estrenar<span class="checktype"></span></label>'+
            //'<label><input type="radio" name="type" value="8"> Buen estado<span class="checktype"></span></label>'+
            //'<label><input type="radio" name="type" value="9"> A reformar<span class="checktype"></span></label>'+
            '</div>' +
            '</div>' +
            '</div>' +
            '<select class="filter_order" id="select_order">' +
            '<option style="display:none">Ordenar por</option>' +
            '<option value="ci.city_name">Localidad</option>' +
            '<option value="o.operation_name">Operacion</option>' +
            '<option value="v.vivienda_price">Precio</option>' +
            '</select>' +
            //'<div class="filter_button">' +
            '<button class="toggle-button" id="toggleButton">' +
            '<img src="view/img/logo_minusvalido_mini.png" alt="Toggle Image">' +
            '</button>' +
            //</div>' +
            '<div id="overlay">' +
            '<div class= "cv-spinner" >' +
            '<span class="spinner"></span>' +
            '</div >' +
            '</div > ' +
            '</div>' +
            '</div>' +

            '<p> </p>' +
            '<button class="filter_button button_spinner" id="Button_filter">Filter</button>' +
            '<button class="filter_remove" id="Remove_filter">Remove</button>');
}
document.addEventListener('DOMContentLoaded', (event) => {
    var modal = document.getElementById("modal_estado");//obtenemos el modal
    var btn = document.getElementById("openModalEstado");//obtenemos el boton que abre el modal
    var span = document.getElementsByClassName("close")[0];//obtenemos el span que cierra el modal
    btn.onclick = function () {//cuando hacemos clic en el boton
        modal.style.display = "block";
    }
    span.onclick = function () { //Cuando el usuario haga clic en <span> (x), cierra el modal
        modal.style.display = "none";
    }
    window.onclick = function (event) {  // Cuando el usuario haga clic en cualquier lugar fuera del modal, cierra el modal
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});
function filter_button() { //funcion para filtrar los productos

    $('.filter_category').change(function () { //cada vez que cambiamos el valor del select con la clase filter_category
        localStorage.setItem('filter_category', this.value);//guardamos el valor del select en el localstorage
    });
    if (localStorage.getItem('filter_category')) {//si hay un valor en el localstorage
        $('.filter_category').val(localStorage.getItem('filter_category'));//cogemos el valor del localstorage y lo ponemos en el select
    }

    $('.filter_operation').change(function () {
        localStorage.setItem('filter_operation', this.value);
    });
    if (localStorage.getItem('filter_operation')) {
        $('.filter_operation').val(localStorage.getItem('filter_operation'));
    }

    $('#select_type').change(function () {
        var selectedType = $('#select_type input:checked').val();
        localStorage.setItem('filter_type', selectedType);
    });

    $('.filter_order').change(function () {
        localStorage.setItem('filter_order', this.value);
    });
    if (localStorage.getItem('filter_order')) {
        $('.filter_order').val(localStorage.getItem('filter_order'));
    }

    $(document).ready(function () {
        var storedType = localStorage.getItem('filter_type');
        if (storedType) {
            $('#select_type input[type="radio"]').each(function () {
                if ($(this).val() === storedType) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });
        }
    });


    $('.filter_city').change(function () {
        localStorage.setItem('filter_city', this.value);
    });
    if (localStorage.getItem('filter_city')) {
        $('.filter_city').val(localStorage.getItem('filter_city'));
    }

    $('.filter_price').change(function () {
        localStorage.setItem('filter_price', this.value);
    });
    if (localStorage.getItem('filter_price')) {
        $('.filter_price').val(localStorage.getItem('filter_price'));
    }
    $('.filter_adapted').change(function () {
        localStorage.setItem('filter_adapted', this.value);
    });
    if (localStorage.getItem('filter_adapted')) {
        $('.filter_adapted').val(localStorage.getItem('filter_price'));
    }
    if (localStorage.getItem('filter_order')) {
        $('.filter_order').val(localStorage.getItem('filter_order'));
    }

    $(document).on('click', '.filter_button', function () {//cuando hacemos click en el boton con la clase filter_button
        var filter_array = [];

        if (localStorage.getItem('filter_category')) {//si hay un valor en el localstorage con la key filter_category
            filter_array.push(['id_category', localStorage.getItem('filter_category')])//añadimos al array filter el valor del localstorage con la key filter_category
        }

        if (localStorage.getItem('filter_operation')) {
            filter_array.push(['id_operation', localStorage.getItem('filter_operation')])
        }

        if (localStorage.getItem('filter_type')) {
            filter_array.push(['id_type', localStorage.getItem('filter_type')])
        }

        if (localStorage.getItem('filter_city')) {
            filter_array.push(['id_city', localStorage.getItem('filter_city')])
        }
        if (localStorage.getItem('filter_price')) {
            filter_array.push(['vivienda_price', localStorage.getItem('filter_price')])
        }
        if (localStorage.getItem('filter_order')) {
            filter_array.push(['filter_order', localStorage.getItem('filter_order')])
        }
        // ahora guardamos en local storage el valor de filter_array en localstorage con la key filters_shop
        localStorage.setItem('filters_shop', JSON.stringify(filter_array));//pasamos el array a string
        //pagination(filter_array); //llamamos a la funcion pagination y le pasamos el valor de filter_array que es filters_shop  
        location.reload();//recargamos la página

    });

    $(document).on('click', '.filter_remove', function () {
        var filter_array = [];
        remove_filters();
        if (filter_array == 0 || filter_array == undefined) {//si el array filter es igual a 0
            ajaxForSearch('module/shop/controller/ctrl_shop.php?op=all_viviendas', 'POST', 'JSON', { 'offset': 0, 'items_page': 3 });
            location.reload();//recargamos la página
        }
    });
    setTimeout(() => {
        highlightFilters();
    }, "100");
}
function highlightFilters() {

    var all_filters = JSON.parse(localStorage.getItem('filters_shop'));
    //console.log('filtros highlight ' + all_filters[0][1]);

    if (all_filters && all_filters.length > 0) { // Verifica que el array tenga datos y no esté vacío
        all_filters.forEach(function (filter) {//recorremos el array de filtros
            //console.log('filtro higligt ' + filter[0]);

            switch (filter[0]) { // El primer elemento de cada filtro es el identificador
                case 'id_category':
                    $('#select_category').val(filter[1]); // El segundo elemento es el valor del filtro
                    $('#search_category').val(filter[1]);
                    //console.log('valor de category en higlight =' + filter[1]);
                    break;
                case 'id_operation':
                    $('#select_operation').val(filter[1]); // El segundo elemento es el valor del filtro
                    $('#search_operation').val(filter[1]);
                    //console.log(filter[1]);
                    break;
                case 'id_type':
                    $('#select_type').find('input[value="' + filter[1] + '"]').prop('checked', true); // El segundo elemento es el valor del filtro
                    //console.log(filter[1]);
                    break;
                case 'id_city':
                    $('#select_city').val(filter[1]); // El segundo elemento es el valor del filtro
                    //console.log(filter[1]);
                    break;
                case 'vivienda_price':
                    $('#select_price').val(filter[1]); // El segundo elemento es el valor del filtro
                    //console.log(filter[1]);
                    break;
                case 'order':
                    $('filter_order').val(filter[1]); // El segundo elemento es el valor del filtro
                    //console.log(filter[1]);
                    break;
                default:
                    break;
            }
        });
    } else {
        //console.log('No hay filtros en highlightFilters');
    }
}
function remove_filters() {
    localStorage.removeItem('filters_home');
    localStorage.removeItem('filters_shop');
    localStorage.removeItem('filters_search');
    localStorage.removeItem('filter_category');
    localStorage.removeItem('filter_operation');
    localStorage.removeItem('filter_type');
    localStorage.removeItem('filter_city');
    localStorage.removeItem('filter_price');
    localStorage.removeItem('filter_order');
    localStorage.removeItem('page');
    location.reload();
}
function loadCategoriesfilter() {

    ajaxPromise('module/shop/controller/ctrl_shop.php?op=select_categories', 'GET', 'JSON')
        .then(function (data) {
            //console.log(data);
            for (let category of data) {
                $('<option></option>').attr('value', category.id_category).text(category.category_name).appendTo('#select_category');
            }
        })
        .catch(function (error) {
            console.error("Error al cargar las categorías:", error);
        });
}
function loadOperationfilter() {

    ajaxPromise('module/shop/controller/ctrl_shop.php?op=select_operation', 'GET', 'JSON')
        .then(function (data) {
            //console.log(data);
            for (let operation of data) {
                $('<option></option>').attr('value', operation.id_operation).text(operation.operation_name).appendTo('#select_operation');
            }
        })
        .catch(function (error) {
            console.error("Error al cargar las operaciones:", error);
        });
}
function loadCityfilter() {

    ajaxPromise('module/shop/controller/ctrl_shop.php?op=select_city', 'GET', 'JSON')
        .then(function (data) {
            //console.log(data);
            for (let city of data) {
                $('<option></option>').attr('value', city.id_city).text(city.city_name).appendTo('#select_city');
            }
        })
        .catch(function (error) {
            console.error("Error al cargar las ciudades:", error);
        });
}
function loadTypefilter() {
    ajaxPromise('module/shop/controller/ctrl_shop.php?op=select_type', 'GET', 'JSON')
        .then(function (data) {
            //console.log(data);
            for (let type of data) {// recorremos el array de objetos
                $('#select_type').append('<label><input type="radio" name="type" value="' + type.id_type + '"> ' + type.type_name + '<span class="checktype"></span></label>');
            }
        })
        .catch(function () {
            console.error("Error al cargar los tipos:", error);
        });
}
function loadPricefilter() {
    // no se utiliza de momento por que no es dinamico.
    ajaxPromise('module/shop/controller/ctrl_shop.php?op=select_price', 'GET', 'JSON')
        .then(function (data) {
            console.log(data);
            for (let price of data) {
                $('<option></option>').attr('value', price.id_price).text(price.price).appendTo('#select_price');
            }
        })
        .catch(function (error) {
            console.error("Error al cargar los precios:", error);
        });
}
function pagination() {
    var filters_search = JSON.parse(localStorage.getItem('filters_search')); //busca en localstorage el valor de filters_search
    var filters_shop = JSON.parse(localStorage.getItem('filters_shop'));//busca en localstorage el valor de filters_shop
    var filters_home = JSON.parse(localStorage.getItem('filters_home'));//busca en localstorage el valor de filters_home
    var filters = undefined; //si no hay un valor en la variable filter_array, la variable filter es igual a undefined

    var url;
    if (filters_shop != undefined) {
        url = "module/shop/controller/ctrl_shop.php?op=count_filters_shop";
        filters = filters_shop;
    } else if (filters_search != undefined) {
        url = "module/shop/controller/ctrl_shop.php?op=count_filters_search";
        filters = filters_search;
        //} else if (filters_home != undefined) {
        //    url = "module/shop/controller/ctrl_shop.php?op=count_filters_home";
        //    filters = filters_home;
    } else {
        url = "module/shop/controller/ctrl_shop.php?op=count_all_viviendas";
    }
    //alert('filters .... despues del if ' + filters);
    //alert('valor de la url ' + url);
    ajaxPromise(url, 'POST', 'JSON', { 'filters_shop': filters_shop, 'filters_search': filters_search, 'filters_home': filters_home })

        //en este ajaxpromise podemos pasarle varios valores de varios filtros almacenados en el localstorage
        .then(function (data) {
            var offset = data[0].contador; //guardamos en la variable offset el valor de la posicion 0 del array data que es el total productos
            //console.log('valor de offset ' + offset);
            if (offset >= 3) {
                total_pages = Math.ceil(offset / 3)
            } else {
                total_pages = 1;
            }
            if (total_pages > 1) {
                //$('<div></div>').attr({ 'id': 0, 'class': 'pagination-button-first' }).text('<<').appendto('#pagination');
                for (var i = 0; i < total_pages; i++) {
                    $('<div></div>').attr({ 'id': i + 1, 'class': 'pagination-button' }).text(i + 1).appendTo('#pagination');
                }
            };
            $(document).on('click', '.pagination-button', function () {

                var page = this.getAttribute('id');
                localStorage.setItem('page', page); //guardamos en el localstorage el valor de la pagina
                offset = 3 * (page - 1);
                if (filters != undefined) { //si la variable filter es distinta de undefined

                    if (filters_home != undefined) {
                        ajaxForSearch("module/shop/controller/ctrl_shop.php?op=filters_home", 'POST', 'JSON', { filters: filters, offset: offset, items_page: 3 })
                    };
                    if (filters_search != undefined) {
                        ajaxForSearch("module/shop/controller/ctrl_shop.php?op=filters_search", 'POST', 'JSON', { filters: filters, offset: offset, items_page: 3 })
                    };
                    if (filters_shop != undefined) {
                        ajaxForSearch("module/shop/controller/ctrl_shop.php?op=filters_shop", 'POST', 'JSON', { filters: filters, offset: offset, items_page: 3 })
                    };
                } else {
                    ajaxForSearch("module/shop/controller/ctrl_shop.php?op=all_viviendas", 'POST', 'JSON', { sData: undefined, offset: offset, items_page: 3 });
                }
                $('html, body').animate({ scrollTop: $(".wrap") });
            }
            );

        })
}
function viviendas_related(offset = 0, id_city, total_items) {
    let items_page = 3;

    ajaxPromise("module/shop/controller/ctrl_shop.php?op=viviendas_related", 'POST', 'JSON', { 'id_city': id_city, 'offset': offset, 'items_page': items_page })
        .then(function (data) {
            if (offset == 0) {
                $('<div></div>').attr({ 'id': 'title_content', class: 'title_content' }).appendTo('.related_viviendas_title')
                    .html(
                        `<h2 class="cat">Viviendas en ${data[0].city_name}</h2>` // lee la ciudad de la primera vivienda
                    )
                $('<div></div>').attr({ 'id': 'viviendas_content', 'class': 'viviendas_content' }).appendTo('.related_viviendas');

                for (row in data) {
                    if (data[row].id_vivienda != undefined) {
                        $('<div></div>').attr({ 'id': data[row].id_vivienda, 'class': 'more_info_list' }).appendTo('.viviendas_content')
                            .html(
                                "<li class='portfolio-item'>" +
                                "<div class='item-main'>" +
                                "<div class='portfolio-image'>" +
                                "<img src = " + data[row].image_name + " alt='imagen vivienda' </img> " +
                                "</div>" +
                                "<h6>" + data[row].status + "  " + data[row].vivienda_name + "</h6>" +
                                "</div>" +
                                "</li>"
                            )
                    }
                }
                $('<div></div>').attr({ 'id': 'more_viviendas_button', 'class': 'more_viviendas_button' }).appendTo('.viviendas_content')
                    .html(
                        '<button class="load_more_button" id="load_more_button">MAS VIVIENDAS</button>'
                    )
            }
            if (offset >= 3) {
                for (row in data) {
                    if (data[row].id_vivienda != undefined) {
                        $('<div></div>').attr({ 'id': data[row].id_vivienda, 'class': 'more_info_list' }).appendTo('.viviendas_content')
                            .html(
                                "<li class='portfolio-item'>" +
                                "<div class='item-main'>" +
                                "<div class='portfolio-image'>" +
                                "<img src = " + data[row].image_name + " alt='imagen vivienda' </img> " +
                                "</div>" +
                                "<h6>" + data[row].status + "  " + data[row].vivienda_name + "</h6>" +
                                "</div>" +
                                "</li>"

                            )
                    }
                }
                var total_viviendas = total_items - 3;
                if (total_viviendas <= offset) {
                    $('.more_viviendas_button').remove();
                } else {
                    $('.more_viviendas_button').empty();
                    $('<div></div>').attr({ 'id': 'more_viviendas_button', 'class': 'more_viviendas_button' }).appendTo('.viviendas_content')
                        .html(
                            '<button class="load_more_button" id="load_more_button">MAS VIVIENDAS</button>'
                        )
                }

            }
        }).catch(function () {
            console.log("error viviendas_related");
        });

}
function more_viviendas_related(id_city) {
    var id_city = id_city;
    var items_page = 0;
    ajaxPromise('module/shop/controller/ctrl_shop.php?op=count_viviendas_related', 'POST', 'JSON', { 'id_city': id_city })
        .then(function (data) {
            var total_items = data[0].num_viviendas;
            //var total_items = math.ceil(num_viviendas / 3) * 3;
            viviendas_related(0, id_city, total_items);
            $(document).on("click", '.load_more_button', function () {
                items_page = items_page + 3;
                $('.more_viviendas_button').empty();
                viviendas_related(items_page, id_city, total_items);
            });
        }).catch(function () {
            console.log('error total_items');
        });
    $('html, body').animate({ scrollTop: $(".wrap") });
}

function clicks_details_related() {
    $(document).on("click", ".related_viviendas", function () {
        //  $('<div></div>').attr({ 'id': data[row].id_vivienda, 'class': 'more_info_list' }).appendTo('.viviendas_content')

        //"<button id='" + data[row].id_vivienda + "' class='detalles_inmueble button add' >Detalles</button>" +
        var id_vivienda = data[row].id_vivienda

        alert('has entrado en more viviendas related con el id de city ' + id_vivienda);
        loadDetails(id_vivienda);
        ajaxPromise('module/shop/controller/ctrl_shop.php?op=incrementa_visita&id=' + id_vivienda, 'POST', 'JSON')
            .then(function () {
                console.log('Visita incrementada con éxito');
            })
            .catch(function () {
            });
    });
}
$(document).ready(function () {
    print_filters();
    loadCategoriesfilter();
    loadOperationfilter();
    loadCityfilter();
    loadTypefilter();
    //loadPricefilter(); //De momento no es dinamico
    loadviviendas();
    clicks_details();
    clicks_details_related();
    filter_button();
    pagination();
    //highlightFilters();
});


