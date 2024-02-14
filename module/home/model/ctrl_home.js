function carousel_operation() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepageoperation','GET', 'JSON') //llamamos a la función que nos devolverá la promesa
    .then(function(data) {
            for (row in data) {   ///////////////////////////////////////////////////////poner aqui abajo el id de la operacion
                $('<div></div>').attr('class', "carousel__elements").attr('id', data[row].operation_name).appendTo(".carousel__list")
                .html(
                    "<img class='carousel__img' id='' src='" + data[row].image_name + "' alt='' >"
                )
            }
            new Glider(document.querySelector('.carousel__list'), {
                slidesToShow: 5,
                slidesToScroll: 5,
                draggable: true,
                dots: '.dots',
                pasive: true,
                arrows: {
                  prev: '.glider-prev',
                  next: '.glider-next'
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
            $('<div></div>').attr('class', "div_cate").attr({'id': data[row].category_name }).appendTo('#containercategories')
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

function loadcatcity() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepagecity','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "div_city").attr({ 'id': data[row].city_name }).appendTo('#containercity')
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
    });
}

function loadCatTypes() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepagetype','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "div_type").attr({ 'id': data[row].type_name }).appendTo('#containertype')
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
    }).catch(function() {
        //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Types_car HOME";
    });
}

function loadoperation() {
    ajaxPromise('module/home/controller/ctrl_home.php?op=homepageoperation','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "div_operation").attr({ 'id': data[row].operation_name }).appendTo('#containeroperation')
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

function clicks(){ //función que se encarga de redirigir a la página de shop con los filtros seleccionados

     
      $(document).on("click",'div.carousel__elements', function (){ //recoge el click en el carrousel con el div.carousel__elements
      var filters_home = [];
      filters_home.push({"operation_name":[this.getAttribute('id')]});
      localStorage.removeItem('filters_home')
      localStorage.setItem('filters_home', JSON.stringify(filters_home)); 
      setTimeout(function(){ 
          window.location.href = 'index.php?page=ctrl_shop&op=filter'; //redirige a la página de shop con la opcion de ver los productos filtrados.
        }, 1000);  
    }); 

    $(document).on("click",'div.div_cate', function (){  //recoge el click en el div.div_cate
       var filters_home = [];
      filters_home.push({"category_name":[this.getAttribute('id')]});
      localStorage.removeItem('filters_home')
      localStorage.setItem('filters_home', JSON.stringify(filters_home)); 
      console.log(filters_home);
      console.log(localStorage.getItem('filters_home'));
      console.log(filters_home[0].category_name);
        setTimeout(function(){ 
          window.location.href = 'index.php?page=ctrl_shop&op=filter'; //redirige a la página de shop con la opcion de ver los productos filtrados.
        }, 1000);  
    });

    $(document).on("click",'div.div_city', function (){ //recoge el click en el div.div_city
      var filters_home = [];
      filters_home.push({"city_name":[this.getAttribute('id')]});
      localStorage.removeItem('filters_home')
      localStorage.setItem('filters_home', JSON.stringify(filters_home)); 
      console.log(filters_home);
      console.log(localStorage.getItem('filters_home'));
      console.log(filters_home[0].city_name);
        setTimeout(function(){ 
          window.location.href = 'index.php?page=ctrl_shop&op=filter'; //redirige a la página de shop con la opcion de ver los productos filtrados.
        }, 1000);  
    });

    $(document).on("click",'div.div_type', function (){ //recoge el click en el div.div_type
      var filters_home = [];
      filters_home.push({"type_name":[this.getAttribute('id')]});
      localStorage.removeItem('filters_home')
      localStorage.setItem('filters_home', JSON.stringify(filters_home)); 
      console.log(filters_home);
      console.log(localStorage.getItem('filters_home'));
      console.log(filters_home[0].type_name);
        setTimeout(function(){ 
          window.location.href = 'index.php?page=ctrl_shop&op=filter'; //redirige a la página de shop con la opcion de ver los productos filtrados.
        }, 1000); 
    });
  } 

$(document).ready(function() {
    clicks();
    carousel_operation();
    loadCategories();
    loadcatcity();
    loadCatTypes();
    loadoperation();
});