function load_operations() {
    ajaxPromise('module/search/controller/crtl_search.php?op=search_operation', 'POST', 'JSON')

        .then(function (data) {
            // funciona el console.log(data);
            $('<option>Tipo de operación</option>').attr('selected', true).attr('disabled', true).appendTo('#search_operation')
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
                ///console.log(data);
                //console.log('operation no esta definida' + JSON.stringify(data));
                //console.log('VALOR DE operation EN LOAD CATEGORY ES ' + operation);
                $('<option>Tipo de Inmueble</option>').attr('selected', true).attr('disabled', true).appendTo('#search_category')
                for (row in data) {
                    $('<option value="' + data[row].id_category + '">' + data[row].category_name + '</option>').appendTo('#search_category')
                }
            }).catch(function () {
                //window.location.href = "index.php?module=exception&op=503&error=fail_search_category&type=503";
            });
    }
    else {
        //console.log('VALOR DE operation EN LOAD CATEGORY ' + JSON.stringify(operation));

        ajaxPromise('module/search/controller/crtl_search.php?op=search_category', 'POST', 'JSON', operation)
            .then(function (data) {
                //console.log('VALOR DE operation EN LOAD CATEGORY ' + JSON.stringify(operation));
                //console.log(data); //ESTE ES IMPORTANTE PARA DEPURAR
                for (row in data) {
                    $('<option value="' + data[row].id_category + '">' + data[row].category_name + '</option>').appendTo('#search_category')
                }
            }).catch(function () {
                //window.location.href = "index.php?module=exception&op=503&error=fail_load_category_2&type=503";
            });
    }
}

function autocomplete() {

    $("#autocompletar").on("keyup", function () {//al pulsar una tecla
        $('#search_auto').css('visibility', 'visible'); //mostrar el autocompletar 

        let sdata = { complete: $(this).val() }; //creamos una variable sdata con el valor del input
        if (($('#search_operation').val() != 0)) { //si el valor del select es distinto de 0
            sdata.operation = $('#search_operation').val();//añadimos el valor que tiene almacenado el select search_operation 
            //console.log(sdata.operation);
            if (($('#search_operation').val() != 0) && ($('#search_category').val() != 0)) {//si el valor del select es distinto de 0
                sdata.category = $('#search_category').val();//añadimos los valores que tiene almacenado el objeto search_category
                //console.log(sdata.category);
            }
        }
        if (($('#search_operation').val() == undefined) && ($('#search_category').val() != 0)) { //si el valor del select es distinto de 0
            sdata.category = $('#search_category').val();
        }
        ajaxPromise('module/search/controller/crtl_search.php?op=autocomplete', 'POST', 'JSON', sdata)

            .then(function (data) {
                console.log(sdata);
                $('#search_auto').empty();//vaciar el autocompletar
                $('#search_auto').fadeIn(10000000);//mostrar el autocompletar

                for (row in data) {
                    $('<div></div>').appendTo('#search_auto').html(data[row].city_name).attr({ 'class': 'searchElement', 'id': data[row].id_city });
                }
                $(document).on('click', '.searchElement', function () {//al hacer click en un elemento del autocompletar
                    $('#autocompletar').val(this.getAttribute('id'));//rellenar el input con el valor del elemento
                    $('#search_auto').fadeOut(900000);//ocultar el autocompletar
                    $('#id').val(data[row].id_city);
                    console.log($('#id').val());

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

function launch_search() {
    load_operations();
    load_category();
    $(document).on('change', '#search_operation', function () {
        let operation = $(this).val();  //obtenemos el valor del select
        if (operation === 0) {
            load_category();
        } else {
            //console.log('VALOR DE operation EN LAUNCH SEARCH ES ' + operation);
            load_category({ operation });
        }
    });
}


function button_search() {
    $('#search-btn').on('click', function () {
        var search = [];
        if ($('#search_operation').val() != undefined) {
            //search.push({ "operation": [$('#search_operation').val()] })
            search.push(['id_operation', $('#search_operation').val()])
            if ($('#search_category').val() != undefined) {
                //search.push({ "category": [$('#search_category').val()] })
                search.push(['id_category', $('#search_category').val()])
            }
            if ($('#autocompletar').val() != undefined) {
                //search.push({ "city": [$('#autocompletar').val()] })
                //search.push(['id_city', $('#id').val()]);
            }
        } else if ($('#search_operation').val() == undefined) {
            if ($('#search_category').val() != undefined) {

                // DESACTIVADO DE MOMENTO HASTA QUE ARREGLE EL PROBLEMA DE QUE NO SE CARGA EL SELECT
                //search.push({ "category": [$('#search_category').val()] })
                search.push(['id_category', $('#search_category').val()])
            }
            if ($('#autocompletar').val() != undefined) {
                // DESACTIVADO DE MOMENTO HASTA QUE ARREGLE EL PROBLEMA DE QUE NO SE CARGA EL SELECT

                //search.push({ "city": [$('#autocompletar').val()] })
                //search.push(['id_city', $('#id').val()]);
            }
        }
        localStorage.removeItem('filters_search');
        if (search.length != 0) {
            localStorage.setItem('filters_search', JSON.stringify(search));
        }
        window.location.href = 'index.php?page=ctrl_shop&op=list';
    });
}

$(document).ready(function () {
    launch_search();
    autocomplete();
    button_search();
});