function load_city() {
    ajaxPromise('module/search/controller/crtl_search.php?op=search_city', 'POST', 'JSON')

        .then(function (data) {
            // funciona el console.log(data);
            $('<option>Ciudades</option>').attr('selected', true).attr('disabled', true).appendTo('#search_cities')
            for (row in data) {
                $('<option value="' + data[row].id_city + '">' + data[row].city_name + '</option>').appendTo('#search_cities')
            }
        }).catch(function () {
            window.location.href = "view/inc/error404.php";
        });
}

function load_category(cities) {
    //este funciona console.log('VALOR DE CITIES EN LOAD CATEGORY ES ' + JSON.stringify(cities));
    $('#search_category').empty(); //borramos los datos del select

    if (cities == undefined) {
        ajaxPromise('module/search/controller/crtl_search.php?op=search_category_null', 'POST', 'JSON')
            .then(function (data) {
                //console.log(data);
                //console.log('VALOR DE CITIES EN LOAD CATEGORY ES ' + cities);
                $('<option>Tipo de Inmueble</option>').attr('selected', true).attr('disabled', true).appendTo('#search_category')
                for (row in data) {
                    $('<option value="' + data[row].id_category + '">' + data[row].category_name + '</option>').appendTo('#search_category')
                }
            }).catch(function () {
                //window.location.href = "index.php?module=exception&op=503&error=fail_search_category&type=503";
            });
    }
    else {
        //console.log('VALOR DE CITIES EN LOAD CATEGORY ' + JSON.stringify(cities));
        ajaxPromise('module/search/controller/crtl_search.php?op=search_category', 'POST', 'JSON', cities)
            .then(function (data) {
                //console.log(data); //ESTE ES IMPORTANTE PARA DEPURAR
                for (row in data) {
                    $('<option value="' + data[row].id_category + '">' + data[row].category_name + '</option>').appendTo('#search_category')
                }
            }).catch(function () {
                //window.location.href = "index.php?module=exception&op=503&error=fail_load_category_2&type=503";
            });
    }
}

function autocomplete() {  //  ************************ HAY QUE PONER OTRO CAMPO QUE NO SEA NI CATEGORIA NI CITY

    $("#autocompletar").on("keyup", function () {
        let sdata = { complete: $(this).val() }; //creamos una variable sdata con el valor del input
        if (($('#search_cities').val() != 0)) {
            sdata.cities = $('#search_cities').val();//añadimos el valor del select al objeto con una propiedad cities
            if (($('#search_cities').val() != 0) && ($('#search_category').val() != 0)) {
                sdata.category = $('#search_category').val();
            }
        }
        if (($('.search_cities').val() == undefined) && ($('#search_category').val() != 0)) {
            sdata.category = $('#search_category').val();
        }
        ajaxPromise('module/search/crtl/crtl_search.php?op=autocomplete', 'POST', 'JSON', sdata)
            .then(function (data) {
                $('#search_auto').empty();
                $('#search_auto').fadeIn(10000000);
                for (row in data) {
                    $('<div></div>').appendTo('#search_auto').html(data[row].city_name).attr({ 'class': 'searchElement', 'id': data[row].id_city });
                }
                $(document).on('click', '.searchElement', function () {
                    $('#autocompletar').val(this.getAttribute('id'));
                    $('#search_auto').fadeOut(1000);
                });
                $(document).on('click scroll', function (event) { //ocultar el autocompletar al hacer click fuera de él
                    if (event.target.id !== '#autocompletar') {
                        $('#search_auto').fadeOut(1000);
                    }
                });
            }).catch(function () {
                $('#search_auto').fadeOut(500); //ocultar el autocompletar al hacer click fuera de él
            });
    });
}

function launch_search() {
    load_city();
    load_category();
    $(document).on('change', '#search_cities', function () {
        let cities = $(this).val();  //obtenemos el valor del select
        if (cities === 0) {
            load_category();
        } else {
            //ESTE FUNCIONA console.log('VALOR DE CITIES EN LAUNCH SEARCH ES ' + cities);
            load_category({ cities });
        }
    });
}


function button_search() {
    $('#search-btn').on('click', function () {
        var search = [];
        alert('hola SEARCH-BTN');
        if ($('#search_cities').val() != undefined) {
            search.push({ "cities": [$('#search_cities').val()] })
            if ($('#search_category').val() != undefined) {
                search.push({ "category": [$('#search_category').val()] })
            }
            if ($('#autocompletar').val() != undefined) {
                search.push({ "city": [$('#autocompletar').val()] })
            }
        } else if ($('#search_cities').val() == undefined) {
            if ($('#search_category').val() != undefined) {
                search.push({ "category": [$('#search_category').val()] })
            }
            if ($('#autocompletar').val() != undefined) {
                search.push({ "city": [$('#autocompletar').val()] })
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
    //autocomplete();
    //button_search();
});