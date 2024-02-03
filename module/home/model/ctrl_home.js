function carousel_categories() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=carrousel_categories','GET', 'JSON') //llamamos a la función que nos devolverá la promesa
    .then(function(data) {
            for (row in data) {
                $('<div></div>').attr('class', "carousel__elements").attr('id', data[row].category_name).appendTo(".carousel__list")
                .html(
                    "<img class='carousel__img' id='' src='" + data[row].image_name + "' alt='' >"
                )
            }
            new Glider(document.querySelector('.carousel__list'), {
                slidesToShow: 5,
                slidesToScroll: 2,
                dots: '.carousel__indicator',
                draggable: true,
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'

                    //prev: '.carousel__prev',
                    //next: '.carousel__next'
                }
            });
        })
        .catch(function() {
            //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Carrousel_Brand HOME";
        });
}

function loadCategories() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepagecategory','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "div_cate").attr({ 'id': data[row].category_name }).appendTo('#containercategories')
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
    }).catch(function() {
        //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
    });
}

function loadCatTypes() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepagetype','GET', 'JSON')
    .then(function(data) {s
        for (row in data) {
            $('<div></div>').attr('class', "div_motor").attr({ 'id': data[row].type_name }).appendTo('#containertype')
                .html(
                    "<li class='portfolio-item2'>" +
                    "<div class='item-main2'>" +
                    "<div class='portfolio-image2'>" +
                    "<img src = " + data[row].image_name + " alt='foto'" +
                    "</div>" +
                    "<h5>" + data[row].type_name + "</h5>" +
                    "</div>" +
                    "</li>"
                )

        }
    }).catch(function() {
        //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Types_car HOME";
    });
}

$(document).ready(function() {
    carousel_categories();
    loadCategories();
    loadCatTypes();
});