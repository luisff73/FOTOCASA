function launch_search() {
    load_operations();
    load_category();
    $(document).on('change', '#search_operation', function () {
        let operation = $(this).val();  //obtenemos el valor del select
        if (operation === 0) {
            load_category();
        } else {
            load_category({ operation });
        }
    });
}
function load_operations() {
    ajaxPromise('module/search/controller/crtl_search.php?op=search_operation', 'POST', 'JSON')

        .then(function (data) {
            $('<option>Tipo de operación</option>').attr('selected', true).attr('disabled', true).appendTo('#search_operation') // opcion por defecto del select
            for (row in data) {
                $('<option value="' + data[row].id_operation + '">' + data[row].operation_name + '</option>').appendTo('#search_operation')
            }
        }).catch(function () {
            //window.location.href = "view/inc/error404.php";
        });
}
function load_category(operation) {

    $('#search_category').empty(); //borramos los datos del select

    if (operation == undefined) { //si no hemos rellenado operation

        ajaxPromise('module/search/controller/crtl_search.php?op=search_category_null', 'POST', 'JSON')
            .then(function (data) {
                $('<option>Tipo de Inmueble</option>').attr('selected', true).attr('disabled', true).appendTo('#search_category') // opcion por defecto del select
                for (row in data) {
                    $('<option value="' + data[row].id_category + '">' + data[row].category_name + '</option>').appendTo('#search_category')
                }
            }).catch(function () {
                //window.location.href = "index.php?module=exception&op=503&error=fail_search_category&type=503";
            });
    }
    else {

        ajaxPromise('module/search/controller/crtl_search.php?op=search_category', 'POST', 'JSON', operation)
            .then(function (data) {
                $('<option>Tipo de Inmueble</option>').attr('selected', true).attr('disabled', true).appendTo('#search_category') // opcion por defecto del select
                for (row in data) {
                    $('<option value="' + data[row].id_category + '">' + data[row].category_name + '</option>').appendTo('#search_category')
                }
            }).catch(function () {
                //window.location.href = "index.php?module=exception&op=503&error=fail_load_category_2&type=503";
            });
    }
}
function autocomplete() {
    globalThis.$id_city = undefined;
    $("#autocompletar").on("keyup", function () {//al pulsar una tecla
        $('#search_auto').css('visibility', 'visible'); //mostrar el autocompletar 

        let sdata = { complete: $(this).val() }; //creamos una variable sdata con el valor del input
        if (($('#search_operation').val() != 0)) { //si el valor del select es distinto de 0
            sdata.operation = $('#search_operation').val();//añadimos el valor que tiene almacenado el select search_operation 
            if (($('#search_operation').val() != 0) && ($('#search_category').val() != 0)) {//si el valor del select es distinto de 0
                sdata.category = $('#search_category').val();//añadimos los valores que tiene almacenado el objeto search_category
            }
        }
        if (($('#search_operation').val() == undefined) && ($('#search_category').val() != 0)) { //si el valor del select es distinto de 0
            sdata.category = $('#search_category').val(); //añadimos los valores que tiene almacenado el objeto search_category
        }
        ajaxPromise('module/search/controller/crtl_search.php?op=autocomplete', 'POST', 'JSON', sdata)

            .then(function (data) {
                console.log(data);
                $('#search_auto').empty();//vaciar el autocompletar
                $('#search_auto').fadeIn(10000000);//mostrar el autocompletar

                for (row in data) {
                    // ojo con esto que es posible añadir mas componentes al div ademas de la clase i del id. 'data-id_city': data[row].id_city' es un atributo que se añade al div
                    $('<div></div>').appendTo('#search_auto').html(data[row].city_name).attr({ 'class': 'searchElement', 'id': data[row].city_name, 'data-id_city': data[row].id_city });
                }
                $(document).on('click', '.searchElement', function () {//al hacer click en un elemento del autocompletar
                    $('#autocompletar').val(this.getAttribute('id'));//rellenar el input con el valor del elemento
                    $id_city = this.getAttribute('data-id_city');

                    $('#search_auto').fadeOut(900000);//ocultar el autocompletar

                });
                $(document).on('click scroll', function (event) { //ocultar el autocompletar al hacer click fuera de él
                    if (event.target.id !== '#autocompletar') {
                        $('#search_auto').fadeOut(900000);
                        $('#search_auto').css('visibility', 'collapse');
                    }
                });
            }).catch(function () {
                $('#search_auto').fadeOut(500); //ocultar el autocompletar al hacer click fuera de él
            });
    });
}


function button_search() {

    $('#search-btn').on('click', function () {
        remove_filters_search();
        var search = [];
        if ($('#search_operation').val() != undefined) { //si el valor del selector es distinto de 0
            localStorage.setItem('filter_operation', $('#search_operation').val());
            search.push(['id_operation', $('#search_operation').val()])

            if ($('#search_category').val() != undefined) { //si el valor del selector es distinto de 0
                localStorage.setItem('filter_category', $('#search_category').val());
                search.push(['id_category', $('#search_category').val()])
            }
            if ($('#autocompletar').val() != undefined) {// si el valor del input es distinto de 0
                if ($id_city != undefined) {
                    search.push(['id_city', $id_city]);
                    localStorage.setItem('filter_city', $id_city)
                }
            }
        } else if ($('#search_operation').val() == undefined) {
            if ($('#search_category').val() != undefined) {
                localStorage.setItem('filter_category', $('#search_category').val());
                search.push(['id_category', $('#search_category').val()])
            }
            if ($('#autocompletar').val() != undefined) {// si el valor del input es distinto de 0
                if ($id_city != undefined) {
                    search.push(['id_city', $id_city]);
                    localStorage.setItem('filter_city', $id_city)
                }
            }
        }
        localStorage.removeItem('filters_search');
        if (search.length != 0) {
            //localStorage.setItem('filters_search', JSON.stringify(search)); //guardamos en el localstorage los filtros de busqueda
            localStorage.setItem('filters_shop', JSON.stringify(search)); // hacemos esto para que la pagina de shop pueda coger los datos
        }
        window.location.href = 'index.php?page=ctrl_shop&op=list';
    });
}

function remove_filters_search() {
    localStorage.removeItem('filters_home');
    localStorage.removeItem('filters_shop');
    localStorage.removeItem('filters_search');
    localStorage.removeItem('filter_category');
    localStorage.removeItem('filter_operation');
    localStorage.removeItem('filter_type');
    localStorage.removeItem('filter_city');
    localStorage.removeItem('filter_price');
    localStorage.removeItem('filter_order');
}

$(document).ready(function () {
    launch_search();
    autocomplete();
    button_search();
});