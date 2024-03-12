<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "/module/shop/model/DAO_shop.php");


switch ($_GET['op']) {

    case 'list':
        //die('<script>console.log("El valor actual de filters home en el list es: ' . json_encode($_POST['filters_home']) . '");</script>');
        include('module/shop/view/shop.html');
        break;

    case 'all_viviendas':  // a esta opcion se accede desde el menu principal
        // echo "console.log(" . json_encode('hola') . ");"; // esto si que funciona
        // die('<script>console.log(' . json_encode('hola') . ');</script>'); //esto si que funciona

        try {
            $daoshop = new DAOShop();
            $Dates_Viviendas = $daoshop->select_all_viviendas(); //llamamos a la funcion que nos devuelve todas las viviendas

            //echo json_encode($Dates_Viviendas);
            //break;
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Dates_Viviendas)) {
            echo json_encode($Dates_Viviendas);
        } else {
            echo json_encode("error");
        }
        break;

    case 'filters_home':
        // echo "console.log(" . json_encode('hola') . ");"; esto si que funciona
        //die('<script>console.log(' . json_encode('hola') . ');</script>'); //esto si que funciona
        try {// si no hay errores en la consulta
            $daoshop = new DAOShop();
            $Dates_Viviendas = $daoshop->filters_home($_POST['filters']); //llamamos a la funcion que nos devuelve todas las viviendas
        } catch (Exception $e) { // si hay un error en la consulta
            echo json_encode("error"); //devolvemos un mensaje de error
        }

        if (!empty($Dates_Viviendas)) {
            echo json_encode($Dates_Viviendas);
        } else {
            echo json_encode("error");
        }

        break;

    case 'filters_shop':
        //echo json_encode($_POST['filters_shop']); // 
        //echo "console.log(" . json_encode('hola') . ");"; // esto si que funciona
        //die('<script>console.log(' . json_encode('hola') . ');</script>'); //esto si que funciona
        try {/// si no hay errores en la consulta
            $daoshop = new DAOShop();
            $Dates_Viviendas = $daoshop->filters_shop($_POST['filters']); //llamamos a la funcion que nos devuelve todas las viviendas
            //echo ('<script>console.log(' . json_encode('hola has entrado en filters shop') . ');</script>');
        } catch (Exception $e) { // si hay un error en la consulta
            echo json_encode("error"); //devolvemos un mensaje de error
        }

        if (!empty($Dates_Viviendas)) { /// si hay datos en la consulta
            echo json_encode($Dates_Viviendas);
            //echo ('<script>console.log(' . json_encode($Dates_Viviendas) . ');</script>');
        } else {
            echo json_encode("error");
        }

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

    case 'select_categories':
        try {
            $daohome = new DAOShop();
            $Select = $daohome->select_categories();
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Select)) {
            echo json_encode($Select);
        } else {
            echo json_encode("error");
        }
        break;

    case 'select_city':
        try {
            $daohome = new DAOShop();
            $SelectCity = $daohome->select_city();
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($SelectCity)) {
            echo json_encode($SelectCity);
        } else {
            echo json_encode("error");
        }
        break;

    case 'select_type':
        try {
            $daohome = new DAOShop();
            $SelectType = $daohome->select_type();
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($SelectType)) {
            echo json_encode($SelectType);
        } else {
            echo json_encode("error");
        }
        break;

    case 'select_operation':
        try {
            $daohome = new DAOShop();
            $SelectOperation = $daohome->select_operation();
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($SelectOperation)) {
            echo json_encode($SelectOperation);
        } else {
            echo json_encode("error");
        }
        break;

    case 'select_price':
        try {
            $daohome = new DAOShop();
            //$SelectType = $daohome->select_price();
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($SelectType)) {
            echo json_encode($SelectType);
        } else {
            echo json_encode("error");
        }
        break;

    case 'incrementa_visita':

        try {
            $daoshop = new DAOShop();
            $daoshop->incrementa_visita($_GET['id']);
            echo json_encode("Visita incrementada con éxito");
        } catch (Exception $e) {
            echo json_encode("Error incrementando la visita: " . $e->getMessage());
        }
        break;


    default;
        include("module/exceptions/views/pages/error404.php");
        break;
}