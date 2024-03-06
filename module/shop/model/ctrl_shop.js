

function loadviviendas() {

    var verificate_filters_home = localStorage.getItem('filters_home') || undefined; //si no hay un valor, devuelve une valor undefined
    var verificate_filters_shop = localStorage.getItem('filters_shop') || undefined; //si no hay un valor, devuelve une valor undefined

    if (verificate_filters_home != undefined) { // comprueba si la variable verificate_filters es distinta de false (si existe)
        localStorage.removeItem('filters_home');
        var filters = JSON.parse(verificate_filters_home); // convierte la variable json a un objeto de javascript pasamos del string al objeto array
        ajaxForSearch('module/shop/controller/ctrl_shop.php?op=filters_home', 'POST', 'JSON', { 'filters': filters }); // si es distinta de false carga los filtros de la página de shop
        //highlightFilters();
        //alert("el valor de filters home en load viviendas es " + localStorage.getItem('filters_home'));

    } else if (verificate_filters_shop != undefined) {
        //localStorage.removeItem('filters_shop');
        var filters = JSON.parse(verificate_filters_shop); // convierte la variable json a un objeto de javascript pasamos del string al objeto array
        //alert('Valor de filters_shop antes de pasarlo al promise ' + filters);
        ajaxForSearch('module/shop/controller/ctrl_shop.php?op=filters_shop', 'POST', 'JSON', { 'filters': filters }); // si es distinta de false carga los filtros de la página de shop
        //highlightFilters();
        //alert("el valor de verificate filters shop en load viviendas es " + verificate_filters_shop);
        //console.log(verificate_filters_shop);

    } else {
        //console.log('has entrado en loadviviendas sin filtros');
        //highlightFilters();
        ajaxForSearch('module/shop/controller/ctrl_shop.php?op=all_viviendas', 'GET', 'JSON'); // si no carga todas las viviendas
    }


}

function ajaxForSearch(url, type, dataType, sData = undefined) {
    //console.log('hola ajaxForSearch');
    //console.log(url);
    //console.log(type);
    //console.log(dataType);
    //console.log(sData);
    //alert('VALOR DE FILTERS_SHOP EN EL PROMISE' + JSON.stringify(filters_shop));
    ajaxPromise(url, type, dataType, sData)
        .then(function (data) {
            console.log(data); //ESTE ES IMPORTANTE PARA DEPURAR
            //alert(JSON.stringify(filters_shop));
            $('#content_shop_viviendas').empty();  //vacia el contenido de la página de shop.html
            $('.date_viviendas' && '.date_img').empty();

            if (data == "error") {
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
                            "<li><i id='col-ico' class='fa-regular fa-font-awesome'></i>&nbsp;&nbsp;&nbsp;" + data[row].operation_name + "</li>" +
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
        }).catch(function () {
            console.log('error catch');
            //console.log($select);

            //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Function ajaxForSearch SHOP";
        });
}

function clicks_details() {
    $(document).on("click", ".detalles_inmueble", function () {
        var id_vivienda = this.getAttribute('id');
        loadDetails(id_vivienda);
        //console.log('id_vivienda en click ' + id_vivienda);
    });
}

function loadDetails(id_vivienda) {

    //console.log("has entrado en load Details viviendas con el id_vivienda " + id_vivienda);

    ajaxPromise('module/shop/controller/ctrl_shop.php?op=details_vivienda&id=' + id_vivienda, 'GET', 'JSON')

        .then(function (data) {

            $('#content_shop_viviendas').empty();
            $('.date_img_dentro').empty();
            $('.date_vivienda_dentro').empty();


            // // Elimina el bucle for-in y accede directamente a la propiedad que contiene las imágenes
            // for (var i = 0; i < data[1].length; i++) {
            //     $('<div></div>').attr({ 'id': data[1][i].id_image, class: 'date_img_dentro' }).appendTo('.date_img')
            //         .html(
            //             "<div class='content-img-details'>" +
            //             "<img src='" + data[1][i].image_name + "' />" +
            //             "</div>"
            //         );
            // }


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
                    "<h1><b>" + data[0].category_name + " " + data[0].vivienda_name + "</b></h1>" +
                    "<hr class=hr-shop>" +
                    "<table id='table-shop'> <tr>" +
                    "<td> <i id='col-ico' class='fa-solid fa-money-check-dollar'></i> &nbsp;" + data[0].vivienda_price + "€" + "</td>" +
                    "<td> <i id='col-ico' class='fa-solid fa-flag-usa'></i> &nbsp;" + data[0].state + "</td>  </tr>" +
                    "<td> <i id='col-ico' class='fa-regular fa-font-awesome'></i> &nbsp;" + data[0].category_name + "</td>" +
                    "<td> <i id='col-ico' class='fa-solid fa-money-bill-wave'></i> &nbsp;" + data[0].operation_name + "</td>  </tr>" +
                    "<td> <i id='col-ico' class='fa-solid fa-vector-square'></i> &nbsp;" + data[0].m2 + "</td>" +
                    "<td> <i id='col-ico' class='fa-solid fa-signal'></i> &nbsp;" + data[0].status + "</td>  </tr>" +
                    "<td> <i id='col-ico' class='fa-solid fa-city'></i> &nbsp;" + data[0].city_name + "</td>" +
                    "<td> <i id='col-ico' class='fa-regular fa-chart-bar'></i> &nbsp;" + data[0].type_name + "</td> </tr>" +
                    "</table>" +
                    "<hr class=hr-shop>" +
                    "<h3><b>" + "Mas información:" + "</b></h3>" +
                    "<p>Inmueble con certificado de eficiencia energetica.</p>" +
                    "<div class='buttons_details'>" +
                    "<a class='button add' href='#'>Añadir a la cesta</a>" +
                    "<a class='button buy' href='#'>Compra directa</a>" +
                    "<span class='button' id='price_details'>" + data[0].vivienda_price + "<i class='fa-solid fa-euro-sign'></i> </span>" +
                    "<a class='details__heart' id='" + data[0].id_vivienda + "'><i id=" + data[0].id_vivienda + " class='fa-solid fa-heart fa-lg'></i></a>" +
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
            '<div class="filter_type checkbox-container" id="select_type">' +
            // '<label><input type="radio" name="type" value="7"> A estrenar<span class="checktype"></span></label>' +
            // '<label><input type="radio" name="type" value="8"> Buen estado<span class="checktype"></span></label>' +
            // '<label><input type="radio" name="type" value="9"> A reformar<span class="checktype"></span></label>' +
            '</div>' +
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

    $(document).ready(function () {
        var storedType = localStorage.getItem('filter_type');
        if (storedType) {
            $('.select_type input[type="radio"]').each(function () {
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


    $(document).on('click', '.filter_button', function () {//cuando hacemos click en el boton con la clase filter_button
        var filter_array = [];

        if (localStorage.getItem('filter_category')) {//si hay un valor en el localstorage con la key filter_category
            filter_array.push(['id_category', localStorage.getItem('filter_category')])//añadimos al array filter el valor del localstorage con la key filter_category
            localStorage.removeItem('filter_category');
        }

        if (localStorage.getItem('filter_operation')) {
            filter_array.push(['id_operation', localStorage.getItem('filter_operation')])
            localStorage.removeItem('filter_operation');
        }

        if (localStorage.getItem('filter_type')) {
            filter_array.push(['id_type', localStorage.getItem('filter_type')])
            localStorage.removeItem('filter_type');
        }

        if (localStorage.getItem('filter_city')) {
            filter_array.push(['id_city', localStorage.getItem('filter_city')])
            localStorage.removeItem('filter_city');
        }
        if (localStorage.getItem('filter_price')) {
            filter_array.push(['vivienda_price', localStorage.getItem('filter_price')])
            localStorage.removeItem('filter_price');
        }
        //alert('valor de filter_array cuando pulsamos en el boton filter ' + filter_array);
        // ahora guardamos en local storage el valor de filter_array en localstorage con la key filters_shop
        localStorage.setItem('filters_shop', JSON.stringify(filter_array));//pasamos el array a string

        location.reload();//recargamos la página
        highlightFilters();
    });

    $(document).on('click', '.filter_remove', function () {
        //alert(filter_Array);
        remove_filters();
        if (filter_array == 0) {//si el array filter es igual a 0
            ajaxForSearch('module/shop/controller/ctrl_shop.php?op=all_viviendas', 'GET', 'JSON');
            location.reload();//recargamos la página
        }
    });
}

function highlightFilters() {
    var all_filters = JSON.parse(localStorage.getItem('filters_shop'));
    console.log(all_filters);

    if (all_filters && all_filters.length > 0) { // Verifica que el array tenga datos y no esté vacío
        all_filters.forEach(function (filter) {
            switch (filter[0]) { // El primer elemento de cada filtro es el identificador
                case 'id_category':
                    $('#select_category').val(filter[1]); // El segundo elemento es el valor del filtro
                    console.log(filter[1]);
                    break;
                case 'id_operation':
                    $('#select_operation').val(filter[1]);
                    console.log(filter[1]);
                    break;
                case 'id_type':
                    $('#select_type').find('input[value="' + filter[1] + '"]').prop('checked', true);
                    console.log(filter[1]);
                    break;
                case 'id_city':
                    $('#select_city').val(filter[1]);
                    console.log(filter[1]);
                    break;
                case 'vivienda_price':
                    //alert('valor de filter price ' + filter[1]);
                    $('#select_price').val(filter[1]);
                    console.log(filter[1]);
                    break;
                default:
                    break;
            }
        });
    }
}
function remove_filters() {
    localStorage.removeItem('filters_shop');
    localStorage.removeItem('filter_category');
    localStorage.removeItem('filter_operation');
    localStorage.removeItem('filter_type');
    localStorage.removeItem('filter_city');
    localStorage.removeItem('filter_price');
    filters_shop.length = 0;
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
            //window.location.href = "view/inc/error503.php";
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
            //window.location.href = "view/inc/error503.php";
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
            //window.location.href = "view/inc/error503.php";
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
            //console.error("Error al cargar los tipos:", error);
            //window.location.href = "view/inc/error503.php";
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
            //window.location.href = "view/inc/error503.php";
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
    filter_button();
    highlightFilters();
});


