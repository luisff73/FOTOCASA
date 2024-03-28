<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "/module/shop/model/DAO_shop.php");


switch ($_GET['op']) {

    case 'list':
        include('module/shop/view/shop.html');
        break;

    case 'all_viviendas':  // a esta opcion se accede desde el menu principal

        try {
            $daoshop = new DAOShop(); 
            $Dates_Viviendas = $daoshop->select_all_viviendas($_POST['offset'],$_POST['items_page']);
        } catch (Exception $e) {
            echo json_encode("error en php all_viviendas");
        }

        if (!empty($Dates_Viviendas)) {
            echo json_encode($Dates_Viviendas);
        } else {
            echo json_encode("error en php all_viviendas");
        }
        break;
    case 'count_all_viviendas':
        try {
            $daoshop = new DAOShop();
            $SelectCount = $daoshop->count_all_viviendas();
        } catch (Exception $e) {
            echo json_encode("error");
        }
    
        if (!empty($SelectCount)) {
            echo json_encode($SelectCount);
        } else {
            echo json_encode("error en php count_all_viviendas");
        }
        break;

    case 'filters_home':
        try {// si no hay errores en la consulta
            $daoshop = new DAOShop();
            $Dates_Viviendas = $daoshop->filters_home($_POST['filters'],$_POST['offset'],$_POST['items_page']); //llamamos a la funcion que nos devuelve todas las viviendas
        } catch (Exception $e) { // si hay un error en la consulta
            echo json_encode("error"); //devolvemos un mensaje de error
        }

        if (!empty($Dates_Viviendas)) {
            echo json_encode($Dates_Viviendas);
        } else {
            echo json_encode("error en php filters_home");
        }

        break;

    case 'filters_shop':
        try {/// si no hay errores en la consulta
            $daoshop = new DAOShop();
            // echo json_encode($_POST['filters']);
            // echo json_decode($_POST['offset']);
            // echo json_encode($_POST['items_page']);
            // break;
            $Dates_Viviendas = $daoshop->filters_shop($_POST['filters'],$_POST['offset'],$_POST['items_page']); //llamamos a la funcion que nos devuelve todas las viviendas
        } catch (Exception $e) { // si hay un error en la consulta
            echo json_encode("error"); //devolvemos un mensaje de error
        }
        if (!empty($Dates_Viviendas)) { /// si hay datos en la consulta
            echo json_encode($Dates_Viviendas);
            //echo ('<script>console.log(' . json_encode($Dates_Viviendas) . ');</script>');
        } else {
            echo json_encode("error en php filters_shop");
        }
        break;

    case 'filters_search':
        try {/// si no hay errores en la consulta
            $daoshop = new DAOShop();
            $Dates_Viviendas = $daoshop->filters_search($_POST['filters'],$_POST['offset'],$_POST['items_page']); //llamamos a la funcion que nos devuelve todas las viviendas

        } catch (Exception $e) { // si hay un error en la consulta
            echo json_encode("error"); //devolvemos un mensaje de error
        }
        if (!empty($Dates_Viviendas)) { /// si hay datos en la consulta
            echo json_encode($Dates_Viviendas);
        } else {
            echo json_encode("error en php filters_search");
        }
        break;
    case 'count_filters_home':    
        $daoshop = new DAOShop();
        $resultado = $daoshop -> count_filters_home($_POST['filters_home']);
        if (!empty($resultado)) {
            echo json_encode($resultado);
        }
        else {
            echo "error";
        }
        break;
    case 'count_filters_shop':    
        $daoshop = new DAOShop();
        $resultado = $daoshop -> count_filters_shop($_POST['filters_shop']);
        if (!empty($resultado)) {
            echo json_encode($resultado);
        }
        else {
            echo json_encode("error en php filters_shop");
        }
        break;

    case 'count_filters_search':    
        $daoshop = new DAOShop();
        $resultado = $daoshop -> count_filters_shop($_POST['filters_search']);
        if (!empty($resultado)) {// si no esta vacia
            echo json_encode($resultado);
        }
        else {
            echo json_encode("error en php count filters_search");
        }
        break;


    case 'details_vivienda':  //request al servidor
        //echo json_encode('Has entrado en details vivienda con el id ' . $_GET['id']);
        //break;
        try {
            $daoshop = new DAOShop();
            $Details_viviendas = $daoshop->select_one_vivienda($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        try {
            $daoshop_img = new DAOShop();
            $Date_images = $daoshop_img->select_img_viviendas($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Details_viviendas || $Date_images)) { // si hay datos details e images
            $resultado = array();
            $resultado[0] = $Details_viviendas;
            $resultado[1][] = $Date_images;
            echo json_encode($resultado);
        } else {

            echo json_encode("error");
        }
        break;

    case 'select_categories':
        try {
            $daohome = new DAOShop();
            $resultado = $daohome->select_categories();
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($resultado)) {
            echo json_encode($resultado);
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
        // try {
        //     $daohome = new DAOShop();
        //     $SelectPrice = $daohome->select_price();
        // } catch (Exception $e) {
        //     echo json_encode("error");
        // }

        // if (!empty($SelectPrice)) {
        //     echo json_encode($SelectPrice);
        // } else {
        //     echo json_encode("error");
        // }
        // break;

    case 'incrementa_visita':
        
        try {
            $daoshop = new DAOShop();
            $daoshop->incrementa_visita($_GET['id']);
            echo json_encode("Visita incrementada con éxito");
        } catch (Exception $e) {
            echo json_encode("Error incrementando la visita: " . $e->getMessage());
        }
        break;

    case 'viviendas_related':
        try {
            $dao = new DAOShop();
            $resultado = $dao->select_viviendas_related($_POST['id_city'],$_POST['offset'],$_POST['items_page']);
        } catch (Exception $e) {
            echo json_encode("error viviendas related");
            exit;
        }
        if (!$resultado) {
            echo json_encode("error viviendas related");
            exit;
        } else {
            $dinfo = array();
            foreach ($resultado as $row) {
                array_push($dinfo, $row);
            }
            echo json_encode($dinfo);
        }
        break;

    case 'count_viviendas_related':
        try {
            $dao = new DAOShop();
            $resultado = $dao->count_more_viviendas_related($_POST['id_city']);
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        if (!$resultado) {
            echo json_encode("error");
            exit;
        } else {
            $dinfo = array();
            foreach ($resultado as $row) {
                array_push($dinfo, $row);
            }
            echo json_encode($dinfo);
        }
        break;
    
    default:
    include("view/inc/error404.php");
    break;
}   