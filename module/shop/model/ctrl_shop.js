function clicks() {
    $(document).on("click", ".detalles_inmueble", function() {
        var id_vivienda = this.getAttribute('id');
        //console.log('id_vivienda en click ' + id_vivienda);
        loadDetails(id_vivienda);
    });
}
function loadviviendas() {
    //alert('has entrado en loadviviendas');
    //console.log("has entrado en loadviviendas");
    var verificate_filters = localStorage.getItem('filters_shop') || false; //recogemos los filtros de la página de shop
    if (verificate_filters != false) {
            loadviviendas_filters();
    } else {

    ajaxForSearch('module/shop/controller/ctrl_shop.php?op=all_viviendas');
}
}     

function ajaxForSearch(url) {
    ajaxPromise(url, 'GET', 'JSON')
        .then(function(data) {
            //console.log(data);
            $('#content_shop_viviendas').empty();
            $('.date_viviendas' && '.date_img').empty();

            //Mejora para que cuando no hayan resultados en los filtros aplicados
            if (data == "error") {
                $('<div></div>').appendTo('#content_shop_viviendas')
                    .html(
                        '<h3>¡No se encuentarn resultados con los filtros aplicados!</h3>'
                    )
            } else {

                for (row in data) {

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
                                    "<h1><b><a class='list__house' id='" + data[row].id_vivienda + "'><i id= " + data[row].id_vivienda + " class='fa-solid fa-house-chimney-window'></i></a>   " + data[row].vivienda_name + "</b></h1>"+
                                        "<ul>" +
                                            "<li> <i id='col-ico' class='fa-solid fa-city'></i>&nbsp;&nbsp;" + "Localidad "+ data[row].city_name + "</li>" +
                                            "<li> <i id='col-ico' class='fa-solid fa-flag-usa'></i>&nbsp;&nbsp;" + " Provincia " +data[row].state +  "</li>" +
                                            "<li> <i id='col-ico' class='fa-solid fa-signal'></i>&nbsp;&nbsp;&nbsp;" + data[row].status + "&nbsp;&nbsp;&nbsp;<i id='col-ico' class='fa-solid fa-vector-square'></i>&nbsp;&nbsp;&nbsp;" + data[row].m2 +" m2"+"</li>" +
                                            "<li> <i id='col-ico' class='fa-regular fa-font-awesome'></i>&nbsp;&nbsp;&nbsp;" + data[row].category_name + "&nbsp;&nbsp;&nbsp;<i id='col-ico' class='fa-regular fa-chart-bar'></i>&nbsp;&nbsp;&nbsp;" + data[row].type_name +"</li>" +  
                                        "</ul>" +
                                        
                                        "<div class='buttons'>" +
                                             "<button id='" + data[row].id_vivienda + "' class='detalles_inmueble button add' >Detalles</button>" +
                                             "<button class='button buy' >Comprar</button>" + "&nbsp;&nbsp;&nbsp;" +
                                            "<h1><b><span class='button' id='price'>" + data[row].vivienda_price + ' €' + "</span></b></h1>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>" +
                            "</div>" +
                            "<br>" +
                            "<br>"


                        )
                }
            }
        }).catch(function() {
            //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Function ajaxForSearch SHOP";
        });
}


function loadDetails(id_vivienda) {
    
    //console.log("has entrado en load Details viviendas con el id_vivienda " + id_vivienda);

    ajaxPromise('module/shop/controller/ctrl_shop.php?op=details_vivienda&id=' + id_vivienda, 'GET', 'JSON')
               
    .then(function(data) {
        
        // console.log (data[1][0]);// esto no funciona
        $('#content_shop_viviendas').empty();
        $('.date_img_dentro').empty();
        $('.date_vivienda_dentro').empty();
        
        
        for (row in data[1][0]) {
            //console.log(data);
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
                
                // $('.date_img').slick({ //carousel 
                //     infinite: true,
                //     speed: 300,
                //     slidesToShow: 1,
                //     adaptiveHeight: true,
                //     autoplay: true,
                //     autoplaySpeed: 1300,    
                //     adaptiveHeight: true,
                    
                // });

                $('.date_img').slick({
                    dots: true,
                    infinite: true,
                    speed: 500,
                    fade: true,
                    cssEase: 'linear',
                    arrows: true,
                  });
   
              
                // $('.date_img').slick({
                //     dots: true,
                //     infinite: true,
                //     speed: 500,
                //     date_img: true,
                //     cssEase: 'linear'
                //   });
   
                  
                $('.date_img').slick({
                    dots: true,
                    infinite: true,
                    speed: 500,
                    date_img: true,
                    cssEase: 'linear'
                  });
                
            }).catch(function() {
                 //window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Load_Details SHOP";
            });
        }
        function load_salto() {
            var filtros = JSON.parse(localStorage.getItem('filters_home'));
            ajaxPromise('module/shop/controller/crtl_shop.php?op=redirect', 'POST', 'JSON', { 'filtros': filtros })
                .then(function(shop) {
                    $("#containerShop").empty(); //limpiamos el contenedor
                    for (row in shop) { //recorremos el array de objetos
                        //$('<div></div>').appendTo('#containerShop') //añadimos un div al contenedor
                        $('<div></div>').appendTo('#content_shop_viviendas') //añadimos un div al contenedor
                            .html(
                                '<div id="overlay">' +
                                '<div class= "cv-spinner" >' +
                                '<span class="spinner"></span>' +
                                '</div >' +
                                '</div > ' +
                                '</div>' +
                                '</div>' +
                                '<div class="page">' +
                                '<section class="section section-md bg-white">' +
                                '<div class="shell">' +
                                '<div class="range range-50 range-sm-center range-md-left range-md-middle range-md-reverse">' +
                                '<div class="cell-sm-6 wow fadeInRightSmall">' +
                                ' <div class="thumb-line"><img src="' + shop[row].image_name + '" alt="" width="531" height="640"/>' +
                                '</div>' +
                                '</div>' +
                                '<div class="cell-sm-6">' +
                                '<div class="box-width-3">' +
                                '<p class="heading-1 wow fadeInLeftSmall">' + shop[row].id_city + '</p>' +
                                '<article class="quote-big wow fadeInLeftSmall" data-wow-delay=".1s">' +
                                '<p class="q">' + shop[row].id_operation + '</p>' +
                                '<p class="q">' + shop[row].id_type + '€</p>' +
                                '<p class="q">' + shop[row].id_category + '</p>' +
                                '</article>' +
                                '<div class="divider wow fadeInLeftSmall" data-wow-delay=".2s"></div>' +
                                '<p class="q">' + shop[row].id_type + '<i class="fa-thin fa-gas-pump fa-2xl"></i></p>' +
                                '<p class="wow fadeInLeftSmall" data-wow-delay=".3s">' + shop[row].m2 + '<i class="fa-solid fa-door-open fa-2xl"></i></p><a class="button button-primary-outline button-ujarak button-size-1 wow fadeInLeftSmall link button_spinner" data-wow-delay=".4s" id="' + shop[row].id + '">Read More</a>' +
                                '</div>' +
                                '</div>' +
                                '</section>' +
                                '</div>');
                    }
                    // mapBox_all(shop); //llamamos a la función que pinta el mapa
                }).catch(function() {
                    //window.location.href = "index.php?modules=exception&op=503&error=fail_salto&type=503";
                });
        }

        function mapBox_all(shop) {
            mapboxgl.accessToken = 'pk.eyJ1IjoiMjBqdWFuMTUiLCJhIjoiY2t6eWhubW90MDBnYTNlbzdhdTRtb3BkbyJ9.uR4BNyaxVosPVFt8ePxW1g';
            const map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [-0.61667, 38.83966492354664], // starting position [lng, lat]
                zoom: 6 // starting zoom
            });
        
            for (row in shop) {
                const marker = new mapboxgl.Marker()
                const minPopup = new mapboxgl.Popup()
                minPopup.setHTML('<h3 style="text-align:center;">' + shop[row].brand_name + '</h3><p style="text-align:center;">Modelo: <b>' + shop[row].modelo + '</b></p>' +
                    '<p style="text-align:center;">Precio: <b>' + shop[row].precio + '€</b></p>' +
                    '<img src=" ' + shop[row].img + '"/>' +
                    '<a class="button button-primary-outline button-ujarak button-size-1 wow fadeInLeftSmall link" data-wow-delay=".4s" id="' + shop[row].id + '">Read More</a>')
                marker.setPopup(minPopup)
                    .setLngLat([shop[row].longi, shop[row].lat])
                    .addTo(map);
            }
        }

        $(document).ready(function() {
            clicks();
            loadviviendas();
            load_salto();
        });


        