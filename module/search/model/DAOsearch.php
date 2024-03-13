<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "model/connect.php");

class DAO_search
{
    function search_operation()
    {
        $select = "SELECT id_operation, operation_name FROM operation;";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array(); //declaramos la variable como array
        if ($res->num_rows > 0) {  // si devuelve mas de 0 filas
            while ($row = mysqli_fetch_assoc($res)) { //mientras haya filas
                $retrArray[] = $row; //añade la fila al array
            }
        }
        return $retrArray;
    }

    function search_category_null()
    {
        $select = "SELECT id_category, category_name FROM category;";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }

    function search_category($operation)
    {
        $select = "SELECT distinct c.id_category, c.category_name FROM viviendas v, category c
        WHERE c.id_category = v.id_category AND v.id_operation = '$operation';";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        //return $select;
        return $retrArray;
    }

    function select_only_operation($operation, $complete)
    {
        $select = "SELECT v.*, c.city_name, o.operation_name FROM viviendas v, city c, operation o
        WHERE v.id_city=c.id_city and v.id_operation=o.id_operation and v.id_operation = '$operation' AND c.city_name LIKE '$complete%';";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }

    function select_only_category($category, $complete)
    {
        $select = "SELECT v.*, c.city_name, ca.category_name FROM viviendas v, city c, category ca
        WHERE v.id_city=c.id_city and v.id_category=ca.id_category and ca.id_category = '$category' AND c.city_name LIKE '$complete%';";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }


    function select_operation_category($complete, $operation, $category)
    {
        $select = "SELECT v.*, o.operation_name,ca.category_name, c.city_name FROM viviendas v, operation o, category ca, city c 
        WHERE v.id_operation=o.id_operation and v.id_category=ca.id_category and v.id_city=c.id_city and o.id_operation = '$operation' AND ca.id_category = '$category' AND c.city_name LIKE '$complete%';";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }

    function select_city($complete)
    {
        $select = "SELECT distinct c.city_name FROM viviendas v, city c WHERE v.id_city=c.id_city and city_name LIKE '$complete%';";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }
}