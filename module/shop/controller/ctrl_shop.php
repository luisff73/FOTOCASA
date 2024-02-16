<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "/module/shop/model/DAO_shop.php");


switch ($_GET['op']) {

    case 'list':
        include('module/shop/view/shop.html');
        break;

    case 'all_viviendas':  // a esta opcion se accede desde el menu principal
        // echo "Este es un mensaje de prueba en la consola all viviendas";
        // echo "console.log(" . json_encode('hola') . ");"; esto si que funciona
        // die('<script>console.log('.json_encode( 'hola' ) .');</script>'); esto si que funciona
        try {
            $daoshop = new DAOShop();
            $Dates_Viviendas = $daoshop->select_all_viviendas(); //llamamos a la funcion que nos devuelve todas las viviendas
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Dates_Viviendas)) {
            echo json_encode($Dates_Viviendas);
        } else {
            echo json_encode("error");
        }
        //include('module/shop/view/shop.html');  //
        break;

    case 'details_vivienda':  //request al servidor
        //echo json_encode('Has entrado en details vivienda con el id ' . $_GET['id']);
        //break;  //response del servidor
        try {
            $daoshop = new DAOShop();
            $Details_viviendas = $daoshop->select_one_vivienda($_GET['id']);
            //echo json_encode($Details_viviendas);

        } catch (Exception $e) {
            echo json_encode("error");
        }
        //break;  //response del servidor

        try {
            $daoshop_img = new DAOShop();
            $Date_images = $daoshop_img->select_img_viviendas($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Details_viviendas || $Date_images)) {
            //echo json_encode($Details_viviendas);
            $rdo = array();
            $rdo[0] = $Details_viviendas;
            $rdo[1][] = $Date_images;
            echo json_encode($rdo);
        } else {
            
            echo json_encode("error");
        }
        break;

    case 'print_filters_home':
        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> print_filters_home();
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
        break;

    //  case 'filter':
    //     echo "Este es un mensaje de prueba en la consola filter";
    //     echo "console.log(" . json_encode($selSlide) . ");";
    //     echo "</script>";
        
    //     echo json_encode('Has entrado en filters vivienda con el id ' . $_GET['id']);
    //     echo json_encode('Has entrado en filters vivienda el valor de filters_home es ' . $_GET['filters_home']);
        
    //     //break;  //response del servidor
    //         print_r($_POST['filters_home'], true); // Suponiendo que estás pasando los datos de los filtros por POST
    //         $homeQuery = new DAOShop();
    //         $selSlide = $homeQuery->filters_home($_POST['filters_home']); // ¿¿post o get??
    //         if (!empty($selSlide)) {
    //             echo json_encode($selSlide);
    //         } else {
    //             echo "error";
    //         }
    //         break;
        

    case 'redirect':
        // echo "console.log(" . json_encode('hola') . ");"; ojo que esto aparece en la cabecera de la pagina
        // echo "Este es un mensaje de prueba en la consola redirect"; 
        //die('<script>console.log('.json_encode( 'Has entrado en Ctrl_shop opcion redirect' ) .');</script>');
        echo json_encode($_POST['filters_home']);
        echo "console.log(" . json_encode('filters_home') . ");";
        
        die('<script>console.log("El valor actual de filters home es: ' . json_encode($_POST['filters_home']) . '");</script>');

        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> redirect($_POST['filters_home']);
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
        break;


    default;
        //include("module/exceptions/views/pages/error404.php");
        break;
}
