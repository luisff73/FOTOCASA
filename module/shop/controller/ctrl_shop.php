<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "/module/shop/model/DAO_shop.php");


switch ($_GET['op']) {

    case 'list':
        include('module/shop/view/shop.html');
        break;

    case 'all_viviendas':
        //echo "Este es un mensaje de prueba en la consola all viviendas";
        try {
            $daoshop = new DAOShop();
            $Dates_Viviendas = $daoshop->select_all_viviendas();
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
            //print_r($Details_viviendas);
            //var_dump($Details_viviendas);
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

     case 'filter':
        echo "<script>";
        echo "console.log(" . json_encode($selSlide) . ");";
        echo "</script>";
        
            print_r($_POST['filters_home'], true); // Suponiendo que estás pasando los datos de los filtros por POST
            $homeQuery = new DAOShop();
            $selSlide = $homeQuery->filters_home($_POST['filters_home']); // ¿¿post o get??
            if (!empty($selSlide)) {
                echo json_encode($selSlide);
            } else {
                echo "error";
            }
            break;
        

    case 'redirect':
        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> redirect($_POST['filtros'],$_POST['total_prod'],$_POST['items_page']);
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
        break;


    default;
        include("module/exceptions/views/pages/error404.php");
        break;
}
