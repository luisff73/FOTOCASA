function carousel_categories() {
<<<<<<< HEAD
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepageoperation','GET', 'JSON') //llamamos a la función que nos devolverá la promesa
    .then(function(data) {
            for (row in data) {
                $('<div></div>').attr('class', "carousel__elements").attr('id', data[row].operation_name).appendTo(".carousel__list")
                .html(
                    "<img class='carousel__img' id='' src='" + data[row].image_name + "' alt='' >"
                )
            }
            new Glider(document.querySelector('.carousel__list'), {
                slidesToShow: 4,
                slidesToScroll: 2,
                dots: '.dots',
                draggable: true,
                arrows: {
                    //prev: '.glider-prev',
                    //next: '.glider-next'

                    prev: '.carousel__prev',
                    next: '.carousel__next'
                }
            });
        })
        .catch(function() {
            //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Carrousel_Brand HOME";
=======
                
    ajaxPromise('module/home/controller/ctrl_home.php?op=homePageCategory','GET', 'JSON')
    .then(function(data) {
        alert("data");
        console.log(data);  //  <---  AQUI
        //alert(data);
        //     for (row in data) {
        //         $('<div></div>').attr('class', "carousel__elements").attr('id', data[row].category_name).appendTo(".carousel__list")
        //         .html(
        //             "<img class='carousel__img' id='' src='" + data[row].image_name    + "' alt='' >"
        //         )
        //     }
        //     new Glider(document.querySelector('.carousel__list'), {
        //         slidesToShow: 5,
        //         slidesToScroll: 5,
        //         dots: '.carousel__indicator',
        //         draggable: true,
        //         arrows: {
        //             prev: '.carousel__prev',
        //             next: '.carousel__next'
        //         }
        //     });
        })
        .catch(function() {
           // window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Carrusel_Brands HOME";
>>>>>>> d3de0469915f3e9ceeacbce45fd4b95057494b57
        });
}

function loadCategories() {
<<<<<<< HEAD
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepagecategory','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "div_cate").attr({ 'id': data[row].category_name }).appendTo('#containercategories')
=======
               
    ajaxPromise('module/home/controller/ctrl_home.php?op=homePageCategory','GET', 'JSON')
    .then(function(data) {
        console.log('Data received:', data);
        for (row in data) {
            console.log('Processing row:', data[row]);
            $('<div></div>').attr('class', "div_cate").attr({ 'id': data[row].category_name }).appendTo('#containerCategories')
>>>>>>> d3de0469915f3e9ceeacbce45fd4b95057494b57
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
<<<<<<< HEAD
        //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
    });
}

function loadcatcity() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepagecity','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "div_cate").attr({ 'id': data[row].city_name }).appendTo('#containercity')
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
    }).catch(function() {
        //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Types_car HOME";
=======
        console.error('Error:', error);
       // window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
>>>>>>> d3de0469915f3e9ceeacbce45fd4b95057494b57
    });
}

function loadCatTypes() {
<<<<<<< HEAD
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepagetype','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "div_cate").attr({ 'id': data[row].type_name }).appendTo('#containertype')
                .html(
                    "<li class='portfolio-item'>" +
                    "<div class='item-main3'>" +
                    "<div class='portfolio-image'>" +
                    "<img src = " + data[row].image_name + " alt='foto' </img> " +
                    "</div>" +
                    //"<h5>" + data[row].type_name + "</h5>" +
=======
    ajaxPromise('module/home/controller/ctrl_home.php?op=homePageType','GET', 'JSON')
    .then(function(data) {
        console.log('Data received:', data);
        for (row in data) {
            console.log('Processing row:', data[row]);
            $('<div></div>').attr('class', "div_motor").attr({ 'id': data[row].type_name }).appendTo('#containerTypecar')
                .html(
                    "<li class='portfolio-item2'>" +
                    "<div class='item-main2'>" +
                    "<div class='portfolio-image2'>" +
                    "<img src = " + data[row].id_image + " alt='foto'" +
                    "</div>" +
                    "<h5>" + data[row].type_name + "</h5>" +
>>>>>>> d3de0469915f3e9ceeacbce45fd4b95057494b57
                    "</div>" +
                    "</li>"
                )

        }
    }).catch(function() {
<<<<<<< HEAD
=======
        console.error('Error:', error);
>>>>>>> d3de0469915f3e9ceeacbce45fd4b95057494b57
        //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Types_car HOME";
    });
}

<<<<<<< HEAD
function loadoperation() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepageoperation','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "div_cate").attr({ 'id': data[row].operation_name }).appendTo('#containeroperation')
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
    }).catch(function() {
        //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
    });
}

$(document).ready(function() {
    carousel_categories();
    loadCategories();
    loadcatcity();
    loadCatTypes();
    loadoperation();
=======
$(document).ready(function() {
    //alert(data[row].category_name[2]); 
    carousel_categories();
   // loadCategories();
    //loadCatTypes();
>>>>>>> d3de0469915f3e9ceeacbce45fd4b95057494b57
});