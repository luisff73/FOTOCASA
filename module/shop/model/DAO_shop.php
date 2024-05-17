<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "/model/connect.php");

class DAOShop
{
    function select_all_viviendas($offset, $items_page) 
    {
        
        $sql = "SELECT v.id_vivienda,v.vivienda_name,v.long,v.lat,ci.city_name,state,status,v.vivienda_price,
        v.description,v.image_name,v.m2,c.category_name,o.operation_name, t.type_name,a.adapted, count(l.id_vivienda) as total_likes 
        FROM viviendas v 
        INNER JOIN category c ON v.id_category = c.id_category 
        INNER JOIN operation o ON v.id_operation = o.id_operation 
        INNER JOIN city ci ON v.id_city = ci.id_city 
        INNER JOIN type t ON v.id_type = t.id_type 
        LEFT JOIN likes l on v.id_vivienda=l.id_vivienda
        LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda where v.id_vivienda>0 group by v.id_vivienda LIMIT $offset,$items_page;";

        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
                $retrArray[] = $row; 
            }
        }
        //return $sql;
        return $retrArray;
    }
    function count_all_viviendas()
    {

        $sql = "SELECT COUNT(*) as contador FROM viviendas;";
        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
                $retrArray[] = $row; 
            }
        }
        return $retrArray;
    }
    function select_one_vivienda($id)
    {
        //return $id;
        $sql = "SELECT v.id_vivienda, v.vivienda_name, ci.city_name, v.state, v.status, v.vivienda_price, v.description, 
        v.image_name, v.m2, v.long, v.lat, c.category_name, o.operation_name, t.type_name, a.adapted, v.id_city,  count(l.id_vivienda) as total_likes 
        FROM viviendas v 
        INNER JOIN category c ON v.id_category = c.id_category 
        INNER JOIN operation o ON v.id_operation = o.id_operation 
        INNER JOIN city ci ON v.id_city = ci.id_city 
        INNER JOIN type t ON v.id_type = t.id_type 
        LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda
        LEFT JOIN likes l on v.id_vivienda=l.id_vivienda 
        WHERE v.id_vivienda = '$id'
        GROUP BY v.id_vivienda;";

        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);
        return $resultado;
    }
    function select_img_viviendas($id)
    {
        $sql = "SELECT id_vivienda, id_image, image_name FROM images WHERE id_vivienda = '$id';";

        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $imgArray = array();
        if (mysqli_num_rows($resultado) > 0) {
            foreach ($resultado as $row) {
                array_push($imgArray, $row);
            }
        }
        return $imgArray;
    }
    function filters_home($filters, $offset, $items_page)
    {
        $select = "SELECT v.id_vivienda, v.vivienda_name, ci.city_name, v.state, v.status, v.vivienda_price, 
        v.description, v.image_name, v.m2, v.long, v.lat, c.category_name, o.operation_name, t.type_name, 
        c.id_category, o.id_operation, ci.id_city, t.id_type, a.adapted, count(l.id_vivienda) as total_likes  
        FROM viviendas v 
        INNER JOIN category c ON v.id_category = c.id_category 
        INNER JOIN operation o ON v.id_operation = o.id_operation 
        INNER JOIN city ci ON v.id_city = ci.id_city 
        INNER JOIN type t ON v.id_type = t.id_type 
        LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda 
        LEFT JOIN likes l on v.id_vivienda=l.id_vivienda
        WHERE v.id_vivienda>0";

        //return $filters;
        //return $filters[0][0];

        if (isset($filters[0][0]) && $filters[0][0] == 'id_operation') {  // Si el array de filtros contiene el índice id_operation((iel isset obliga)
            $add_filter = $filters[0][1];
            $select .= " and o.id_operation = '$add_filter'";
        } else if (isset($filters[0][0]) && $filters[0][0] =='id_category') { // Si el array de filtros contiene el índice id_category
            $add_filter = $filters[0][1];
            $select .= " and c.id_category = '$add_filter'";
        } else if (isset($filters[0][0]) && $filters[0][0] =='id_city') { // Si el array de filtros contiene el índice id_city
            $add_filter = $filters[0][1];
            $select .= " and ci.id_city = '$add_filter'";
        } else if (isset($filters[0][0]) && $filters[0][0] =='id_type') { // Si el array de filtros contiene el índice id_type
            $add_filter = $filters[0][1];
            $select .= " and t.id_type = '$add_filter'";
        } else if (isset($filters[0][0]) && $filters[0][0] =='adapted') { // Si el array de filtros contiene el índice adapted
            $add_filter = $filters[0][1];
            $select .= " and a.adapted = '$add_filter'";
        } else if (isset($filters[0][0]) && $filters[0][0] =='vivienda_price') { // Si el array de filtros contiene el índice vivienda_price
            $add_filter = $filters[0][1];
            $select .= " and v.vivienda_price = '$add_filter'";
        } else if (isset($filters[0]['filter_order'])) { // Si el array de filtros contiene el índice filter_order
            $add_filter = $filters[0][1];
            $select .= " ORDER BY v.vivienda_price $add_filter";
        }
        $select .= " GROUP BY v.id_vivienda";
        $select .= " LIMIT $offset,$items_page";

        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($resultado->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $retrArray[] = $row;
            }
        }
        //return $select; //Esto no devuelve $select, con estro comprobamos que resuelve ajaxs desde el console.log
        return $retrArray;
    }
    function count_filters_home($filters)
    {
        $select = "SELECT COUNT(*) as contador,v.id_vivienda, v.vivienda_name, ci.city_name, v.state, v.status, 
        v.vivienda_price, v.description, v.image_name, v.m2, v.long, v.lat, c.category_name, o.operation_name, 
        t.type_name, c.id_category, o.id_operation, ci.id_city, t.id_type, a.adapted 
        FROM viviendas v 
        INNER JOIN category c ON v.id_category = c.id_category 
        INNER JOIN operation o ON v.id_operation = o.id_operation 
        INNER JOIN city ci ON v.id_city = ci.id_city 
        INNER JOIN type t ON v.id_type = t.id_type 
        LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda WHERE v.id_vivienda>0";

        if (isset($filters[0][0]) && $filters[0][0] == 'id_operation') {  // Si el array de filtros contiene el índice id_operation((iel isset obliga)
            $add_filter = $filters[0][1];
            $select .= " and o.id_operation = '$add_filter'";
        } else if (isset($filters[0][0]) && $filters[0][0] == 'id_category') { // Si el array de filtros contiene el índice id_category
            $add_filter = $filters[0][1];
            $select .= " and c.id_category = '$add_filter'";
        } else if (isset($filters[0][0]) && $filters[0][0] == 'id_city') { // Si el array de filtros contiene el índice id_city
            $add_filter = $filters[0][1];
            $select .= " and ci.id_city = '$add_filter'";
        } else if (isset($filters[0][0]) && $filters[0][0] == 'id_type') { // Si el array de filtros contiene el índice id_type
            $add_filter = $filters[0][1];
            $select .= " and t.id_type = '$add_filter'";
        } else if (isset($filters[0][0]) && $filters[0][0] == 'adapted') { // Si el array de filtros contiene el índice adapted
            $add_filter = $filters[0][1];
            $select .= " and a.adapted = '$add_filter'";
        } else if (isset($filters[0][0]) && $filters[0][0] == 'vivienda_price') { // Si el array de filtros contiene el índice vivienda_price
            $add_filter = $filters[0][1];
            $select .= " and v.vivienda_price = '$add_filter'";
        }

        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($resultado->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $retrArray[] = $row;
            }
        }
        return $select; //Esto no devuelve $select, con estro comprobamos que resuelve ajaxs desde el console.log
        return $retrArray;
    }
    function filters_shop($filters, $offset, $items_page)
    {
        $select = "SELECT v.id_vivienda,v.vivienda_name,ci.city_name,v.state,v.status,v.vivienda_price,
        v.description,v.image_name,v.m2,c.category_name,o.operation_name,t.type_name,c.id_category,
        o.id_operation,ci.id_city,t.id_type,
        a.adapted,v.long,v.lat, count(l.id_vivienda) as total_likes FROM viviendas v 
        INNER JOIN category c ON v.id_category = c.id_category 
        INNER JOIN operation o ON v.id_operation = o.id_operation 
        INNER JOIN city ci ON v.id_city = ci.id_city 
        INNER JOIN type t ON v.id_type = t.id_type 
        LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda 
        LEFT JOIN likes l ON v.id_vivienda = l.id_vivienda
        WHERE v.id_vivienda>0";

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
        $select .= $order; // Añadimos la cláusula ORDER BY a la consulta
        $select .= " GROUP BY V.id_vivienda";
        $select .= " LIMIT $offset,$items_page ";

        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $select);
        connect::close($conexion);
        
        $retrArray = array();
        if ($resultado->num_rows > 0) { // Si hay más de 0 filas
            while ($row = mysqli_fetch_assoc($resultado)) {
                $retrArray[] = $row;
            }
        }
        //return $select; 
        return $retrArray;
    }
    function count_filters_shop($filters)
    {
        $select = "SELECT COUNT(*) as contador,v.id_vivienda,v.vivienda_name,ci.city_name,v.state,
        v.status,v.vivienda_price,v.description,v.image_name,v.m2,c.category_name,o.operation_name,
        t.type_name,c.id_category,o.id_operation,ci.id_city,t.id_type,a.adapted,v.long,v.lat
        FROM viviendas v 
        INNER JOIN category c ON v.id_category = c.id_category 
        INNER JOIN operation o ON v.id_operation = o.id_operation 
        INNER JOIN city ci ON v.id_city = ci.id_city 
        INNER JOIN type t ON v.id_type = t.id_type 
        LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda 
        WHERE v.id_vivienda>0";

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

        $select .= $order; // Añadimos la cláusula ORDER BY a la consulta

        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($resultado->num_rows > 0) { // Si hay más de 0 filas
            while ($row = mysqli_fetch_assoc($resultado)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }
    function filters_search($filters, $offset, $items_page)
    {
        $select = "SELECT v.id_vivienda,v.vivienda_name,ci.city_name,v.state,v.status,
        v.vivienda_price,v.description,v.image_name,v.m2,c.category_name,o.operation_name,
        t.type_name,c.id_category,o.id_operation,ci.id_city,t.id_type,a.adapted,v.long,v.lat, count(l.id_vivienda) as total_likes
        FROM viviendas v 
        INNER JOIN category c ON v.id_category = c.id_category 
        INNER JOIN operation o ON v.id_operation = o.id_operation 
        INNER JOIN city ci ON v.id_city = ci.id_city 
        INNER JOIN type t ON v.id_type = t.id_type 
        LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda 
        LEFT JOIN likes l on v.id_vivienda=l.id_vivienda
        WHERE v.id_vivienda>0";
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
        $select .= " GROUP BY V.id_vivienda";
        $select .= " LIMIT $offset,$items_page";

        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($resultado->num_rows > 0) { // Si hay más de 0 filas
            while ($row = mysqli_fetch_assoc($resultado)) {
                $retrArray[] = $row;
            }
        }
        //return $select;
        return $retrArray;
    }
    function select_categories()
    {
        $sql = "SELECT * FROM category";
        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
                $retrArray[] = $row; //array_push($retrArray, $row);
            }
        }
        return $retrArray;
    }
    function select_type()
    {
        $sql = "SELECT * FROM type";
        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
                $retrArray[] = $row; //array_push($retrArray, $row);
            }
        }
        return $retrArray;
    }
    function select_city()
    {
        $sql = "SELECT * FROM city";
        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
                $retrArray[] = $row; //array_push($retrArray, $row);
            }
        }
        return $retrArray;
    }
    function select_operation()
    {
        $sql = "SELECT * FROM operation";
        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
                $retrArray[] = $row; //array_push($retrArray, $row);
            }
        }
        return $retrArray;
    }
    function incrementa_visita($id)
    {
        $sqlupdate = "UPDATE most_visited SET visitas = visitas + 1 WHERE id_vivienda = '$id';";
        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $sqlupdate);
        connect::close($conexion);
        return $resultado;
    }

    // function select_recientes()
    // {
    //     $sql = "SELECT * FROM operation";
    //     $conexion = connect::con();
    //     $resultado = mysqli_query($conexion, $sql);
    //     connect::close($conexion);

    //     $retrArray = array();
    //     if (mysqli_num_rows($resultado) > 0) {
    //         while ($row = mysqli_fetch_assoc($resultado)) { // fetch_assoc() devuelve un array asociativo con los datos de la fila
    //             $retrArray[] = $row; //array_push($retrArray, $row);
    //         }
    //     }
    //     return $retrArray;
    // }

    function select_viviendas_related($id_city, $offset, $items){
		$sql = "SELECT v.id_vivienda,v.vivienda_name,v.long,v.lat,ci.city_name,state,status,v.vivienda_price,
        v.description,v.image_name,v.m2,c.category_name,o.operation_name, t.type_name,a.adapted, ci.city_name
        FROM viviendas v 
        INNER JOIN category c ON v.id_category = c.id_category 
        INNER JOIN operation o ON v.id_operation = o.id_operation 
        INNER JOIN city ci ON v.id_city = ci.id_city 
        INNER JOIN type t ON v.id_type = t.id_type 
        LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda 
        WHERE ci.id_city = '$id_city' 
        LIMIT $offset, $items";

		$conexion = connect::con();
		$resultado = mysqli_query($conexion, $sql);
		connect::close($conexion);

		
		$retrArray = array();
		if (mysqli_num_rows($resultado) > 0) {
			while ($row = mysqli_fetch_assoc($resultado)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}
    
	function count_more_viviendas_related($id_city){
		$sql = "SELECT COUNT(*) AS num_viviendas,v.id_vivienda,v.vivienda_name,v.long,v.lat,ci.city_name,state,status,v.vivienda_price,
        v.description,v.image_name,v.m2,c.category_name,o.operation_name, t.type_name,a.adapted 
        FROM viviendas v 
        INNER JOIN category c ON v.id_category = c.id_category 
        INNER JOIN operation o ON v.id_operation = o.id_operation 
        INNER JOIN city ci ON v.id_city = ci.id_city 
        INNER JOIN type t ON v.id_type = t.id_type 
        LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda WHERE ci.id_city = '$id_city'";
		$conexion = connect::con();
		$resultado = mysqli_query($conexion, $sql);
		connect::close($conexion);

		$retrArray = array();
		if (mysqli_num_rows($resultado) > 0) {
			while ($row = mysqli_fetch_assoc($resultado)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}
    function incrementa_like($id_vivienda, $id_user)
    {
        $sql = "CALL ACTUALIZA_LIKES('$id_vivienda', '$id_user');";
        $conexion = connect::con();
        $resultado = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $resultado;
    }

}