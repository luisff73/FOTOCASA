<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "/module/home/model/DAOhome.php");

switch ($_GET['op']) {
    case 'list':
        include("module/home/view/home.html");
        break;
    case 'homepageoperation':
        try {
            $daohome = new DAOHome();
            $SelectType = $daohome->select_operation();
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($SelectType)) {
            echo json_encode($SelectType);
        } else {
            echo json_encode("error");
        }
        break;

    case 'carrousel_categories':
        try {
            $daohome = new DAOHome();
            $Selectcategories = $daohome->select_categories();
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Selectcategories)) {  // Si la consulta no devuelve ningún resultado, se devuelve un array vacío
            echo json_encode($Selectcategories);
        } else {
            echo json_encode("error");  // Si la consulta devuelve un error, se devuelve un mensaje de error
        }
        break;

    case 'homepagecategory':
        try {
            $daohome = new DAOHome();
            $SelectCategory = $daohome->select_categories();
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($SelectCategory)) {
            echo json_encode($SelectCategory);
        } else {
            echo json_encode("error");
        }
        break;

    case 'homepagecity':
        try {
            $daohome = new DAOHome();
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

    case 'homepagetype':
        try {
            $daohome = new DAOHome();
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

    case 'ultimas_busquedas':


        try {
            $daohome = new DAOHome();

            $Dates_Ultimas = $daohome->filters_busquedas($filters); //llamamos a la funcion que nos devuelve todas las viviendas
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Dates_Ultimas)) {
            echo json_encode($Dates_Ultimas);

        } else {
            echo json_encode("error");
        }
        break;

    case 'mas_visitadas':

        try {
            $daohome = new DAOHome();
            $Dates_Mas_Visitadas = $daohome->select_mas_visitadas(); //llamamos a la funcion que nos devuelve todas las viviendas
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Dates_Mas_Visitadas)) {
            echo json_encode($Dates_Mas_Visitadas);

        } else {
            echo json_encode("error");
        }
        break;

    default:
    include("view/inc/error404.php");
        break;
}