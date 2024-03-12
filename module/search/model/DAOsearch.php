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

    function select_only_city($complete, $city)
    {
        $select = "SELECT * FROM viviendas
        WHERE id_city = '$city' AND id_category LIKE '$complete%'"; // revisar

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
        $select = "SELECT * FROM viviendas WHERE id_category = '$category' AND id_vivienda LIKE '$complete%'"; // revisar

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


    function select_brand_category($complete, $brand, $category)
    {
        $select = "SELECT *
        FROM car c
        WHERE c.marca = '$brand' AND c.categoria = '$category' AND c.city LIKE '$complete%'";

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
        $select = "SELECT * FROM city WHERE city_name LIKE '$complete%'";

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