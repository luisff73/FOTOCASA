<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "/model/connect.php");

class DAOShop
{
    function select_all_viviendas()
    {
        //$prueba = "hola dao";
        //return $prueba;

        //$sql = "SELECT v.id_vivienda,v.vivienda_name,ci.city_name,state,status,v.vivienda_price,v.description,v.image_name,v.m2,c.category_name,o.operation_name, t.type_name FROM viviendas v, category c, operation o, city ci, type t where v.id_category=c.id_category and v.id_operation=o.id_operation and v.id_city=ci.id_city and v.id_type=t.id_type and v.id_vivienda='12';";
        $sql = "SELECT v.id_vivienda,v.vivienda_name,v.long,v.lat,ci.city_name,state,status,v.vivienda_price,v.description,v.image_name,v.m2,c.category_name,o.operation_name, t.type_name,a.adapted FROM viviendas v INNER JOIN category c ON v.id_category = c.id_category INNER JOIN operation o ON v.id_operation = o.id_operation INNER JOIN city ci ON v.id_city = ci.id_city INNER JOIN type t ON v.id_type = t.id_type LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda where v.id_vivienda>0;";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
                $retrArray[] = $row; //array_push($retrArray, $row);
            }
        }
        return $retrArray;
    }

    function select_one_vivienda($id)
    {
        //return $id;
        $sql = "SELECT v.id_vivienda, v.vivienda_name, ci.city_name, v.state, v.status, v.vivienda_price, v.description, v.image_name, v.m2, v.long, v.lat, c.category_name, o.operation_name, t.type_name, a.adapted FROM viviendas v INNER JOIN category c ON v.id_category = c.id_category INNER JOIN operation o ON v.id_operation = o.id_operation INNER JOIN city ci ON v.id_city = ci.id_city INNER JOIN type t ON v.id_type = t.id_type LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda WHERE v.id_vivienda = '$id';";
        // antigua $sql = "SELECT v.id_vivienda,v.vivienda_name,ci.city_name,state,status,v.vivienda_price,v.description,v.image_name,v.m2,c.category_name,o.operation_name, t.type_name  a.adapted FROM viviendas v, category c, operation o, city ci, type t where v.id_category=c.id_category and v.id_operation=o.id_operation and v.id_city=ci.id_city and v.id_type=t.id_type and v.id_vivienda = '$id';";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);
        //echo json_encode("resultado de $res " + $res); // hacemos un log para ver que devuelve
        //print_r($res);
        //var_dump($res);
        return $res;
    }

    function select_img_viviendas($id)
    {
        $sql = "SELECT id_vivienda, id_image, image_name FROM images WHERE id_vivienda = '$id';";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $imgArray = array();
        if (mysqli_num_rows($res) > 0) {
            foreach ($res as $row) {
                array_push($imgArray, $row);
            }
        }
        return $imgArray;
    }

    function filters_home($filters)
    {
        //return $filters;  //Esto no devuelve filters, con estro comprobamos que resuelve ajaxs desde el console.log
        //die('<script>console.log("El valor actual de filters home es: ' . json_encode($_POST['filters']) . '");</script>');
        //die('<script>console.log(filters));</script>');
        //$prueba = "hola dao";
        //return $prueba;

        $select = "SELECT v.id_vivienda, v.vivienda_name, ci.city_name, v.state, v.status, v.vivienda_price, v.description, v.image_name, v.m2, v.long, v.lat, c.category_name, o.operation_name, t.type_name, c.id_category, o.id_operation, ci.id_city, t.id_type, a.adapted FROM viviendas v INNER JOIN category c ON v.id_category = c.id_category INNER JOIN operation o ON v.id_operation = o.id_operation INNER JOIN city ci ON v.id_city = ci.id_city INNER JOIN type t ON v.id_type = t.id_type INNER JOIN adapted a ON v.id_vivienda = a.id_vivienda WHERE v.id_vivienda>0";

        //return $select;

        if (isset($filters[0]['id_operation'])) {  // Si el array de filtros contiene el índice id_operation((iel isset obliga)
            $add_filter = $filters[0]['id_operation'][0];
            $select .= " and o.id_operation = '$add_filter'";
        } else if (isset($filters[0]['id_category'])) { // Si el array de filtros contiene el índice id_category
            $add_filter = $filters[0]['id_category'][0];
            $select .= " and c.id_category = '$add_filter'";
        } else if (isset($filters[0]['id_city'])) { // Si el array de filtros contiene el índice id_city
            $add_filter = $filters[0]['id_city'][0];
            $select .= " and ci.id_city = '$add_filter'";
        } else if (isset($filters[0]['id_type'])) { // Si el array de filtros contiene el índice id_type
            $add_filter = $filters[0]['id_type'][0];
            $select .= " and t.id_type = '$add_filter'";
        } else if (isset($filters[0]['adapted'])) { // Si el array de filtros contiene el índice adapted
            $add_filter = $filters[0]['adapted'][0];
            $select .= " and a.adapted = '$add_filter'";
        } else if (isset($filters[0]['vivienda_price'])) { // Si el array de filtros contiene el índice vivienda_price
            $add_filter = $filters[0]['vivienda_price'][0];
            $select .= " and v.vivienda_price = '$add_filter'";
        } else if (isset($filters[0]['filter_order'])) { // Si el array de filtros contiene el índice filter_order
            $add_filter = $filters[0]['filter_order'][0];
            $select .= " ORDER BY v.vivienda_price $add_filter";
        }

        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        // return $select; //Esto no devuelve $select, con estro comprobamos que resuelve ajaxs desde el console.log
        return $retrArray;
    }
    function filters_shop($filters)
    {
        //return $filters;  //Esto no devuelve filters, con estrocomprobamos que resuelve ajaxs desde el console.log
        //$prueba = "hola dao_filters shop";
        //return $prueba;
        //echo "console.log('daoshop ' + " . json_encode('$filters') . ");";
        //$select = "SELECT v.id_vivienda,v.vivienda_name,ci.city_name,v.state,v.status,v.vivienda_price,v.description,v.image_name,v.m2,c.category_name,o.operation_name,t.type_name,c.id_category,o.id_operation,ci.id_city,t.id_type FROM viviendas v, category c, operation o, city ci, type t where v.id_category=c.id_category and v.id_operation=o.id_operation and v.id_city=ci.id_city and v.id_type=t.id_type";
        $select = "SELECT v.id_vivienda,v.vivienda_name,ci.city_name,v.state,v.status,v.vivienda_price,v.description,v.image_name,v.m2,c.category_name,o.operation_name,t.type_name,c.id_category,o.id_operation,ci.id_city,t.id_type,a.adapted,v.long,v.lat FROM viviendas v INNER JOIN category c ON v.id_category = c.id_category INNER JOIN operation o ON v.id_operation = o.id_operation INNER JOIN city ci ON v.id_city = ci.id_city INNER JOIN type t ON v.id_type = t.id_type LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda WHERE v.id_vivienda>0";



        $order = ""; // Variable para almacenar la cláusula ORDER BY

        for ($i = 0; $i < count($filters); $i++) {
            if ($filters[$i][0] == 'vivienda_price') {
                // Si el filtro es 'filter_price', separamos el contenido por la coma
                list($value1, $value2) = explode('|', $filters[$i][1]);
                $select .= " AND v." . $filters[$i][0] . " BETWEEN " . $value1 . " AND " . $value2;
            } elseif ($filters[$i][0] == 'filter_order') {
                $order = " ORDER BY " . $filters[$i][1];
            } else {
                $select .= " AND v." . $filters[$i][0] . "=" . $filters[$i][1];
            }
        }

        $select .= $order;

        // return $select; IMPORTANTE PARA DEVOLVER EL VALOR DE LA CONSULTA

        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($res->num_rows > 0) { // Si hay más de 0 filas
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }

    function select_categories()
    {
        $sql = "SELECT * FROM category";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
                $retrArray[] = $row; //array_push($retrArray, $row);
            }
        }
        return $retrArray;
    }
    function select_type()
    {
        $sql = "SELECT * FROM type";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
                $retrArray[] = $row; //array_push($retrArray, $row);
            }
        }
        return $retrArray;
    }
    function select_city()
    {
        $sql = "SELECT * FROM city";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
                $retrArray[] = $row; //array_push($retrArray, $row);
            }
        }
        return $retrArray;
    }
    function select_operation()
    {
        $sql = "SELECT * FROM operation";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
                $retrArray[] = $row; //array_push($retrArray, $row);
            }
        }
        return $retrArray;
    }

    function incrementa_visita($id)
    {
        $sqlupdate = "UPDATE most_visited SET visitas = visitas + 1 WHERE id_vivienda = '$id';";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sqlupdate);
        connect::close($conexion);
        return $res;
    }



    // function select_recientes()
    // {
    //     $sql = "SELECT * FROM operation";
    //     $conexion = connect::con();
    //     $res = mysqli_query($conexion, $sql);
    //     connect::close($conexion);

    //     $retrArray = array();
    //     if (mysqli_num_rows($res) > 0) {
    //         while ($row = mysqli_fetch_assoc($res)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
    //             $retrArray[] = $row; //array_push($retrArray, $row);
    //         }
    //     }
    //     return $retrArray;
    // }



}