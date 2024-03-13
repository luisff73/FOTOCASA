<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "/module/search/model/DAOsearch.php");

switch ($_GET['op']) {

    case 'search_operation';
        $homeQuery = new DAO_search();//creamos un objeto de la clase DAO_search
        $selSlide = $homeQuery->search_operation();//llamamos a la funcion search_operation
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        } else {
            echo "error";
        }
        break;

    case 'search_category';

        $homeQuery = new DAO_search();
        $selSlide = $homeQuery->search_category($_POST['operation']);
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        } else {
            echo "error";
        }
        break;

    case 'search_category_null';
        $homeQuery = new DAO_search();
        $selSlide = $homeQuery->search_category_null();
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        } else {
            echo "error";
        }
        break;


    case 'autocomplete';
        try {
            $dao = new DAO_search();
            if (!empty($_POST['operation']) && empty($_POST['category'])) {//si operation no esta vacio y category si
                $rdo = $dao->select_only_operation($_POST['complete'], $_POST['operation']);//llamamos a la funcion select_only_city

            } else if (empty($_POST['operation']) && !empty($_POST['category'])) {//si operation esta vacio y category no esta vacio
                $rdo = $dao->select_only_category($_POST['category'], $_POST['complete']); //llamamos a la funcion select_only_category

            } else if (!empty($_POST['operation']) && !empty($_POST['category'])) {//si operation no esta vacio y category no esta vacio
                $rdo = $dao->select_operation_category($_POST['complete'], $_POST['operation'], $_POST['category']);//llamamos a la funcion select_brand_category

            } else {
                $rdo = $dao->select_city($_POST['complete']);
            }
        } catch (Exception $e) {
            echo json_encode("catch");
            exit;
        }
        if (!$rdo) {
            echo json_encode("rdo!!!");
            exit;
        } else {
            $dinfo = array();
            foreach ($rdo as $row) {
                array_push($dinfo, $row);
            }
            echo json_encode($dinfo);
        }
        break;
}