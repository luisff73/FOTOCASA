<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "/model/connect.php");

class DAOShop{
	function select_all_viviendas(){
		$sql = "SELECT v.id_vivienda,v.vivienda_name,ci.city_name,state,status,v.vivienda_price,v.description,v.image_name,v.m2,c.category_name,o.operation_name, t.type_name FROM viviendas v, category c, operation o, city ci, type t where v.id_category=c.id_category and v.id_operation=o.id_operation and v.id_city=ci.id_city and v.id_type=t.id_type;";
		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		$retrArray = array();
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}

	function select_one_vivienda($id){
		//return $id;
		$sql = "SELECT v.id_vivienda,v.vivienda_name,ci.city_name,state,status,v.vivienda_price,v.description,v.image_name,v.m2,c.category_name,o.operation_name, t.type_name FROM viviendas v, category c, operation o, city ci, type t where v.id_category=c.id_category and v.id_operation=o.id_operation and v.id_city=ci.id_city and v.id_type=t.id_type and v.id_vivienda = '$id';";
		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql)->fetch_object();
		connect::close($conexion);
		//echo json_encode("resultado de $res " + $res); // hacemos un log para ver que devuelve
		//print_r($res);
        //var_dump($res);
		return $res;
	}

	function select_img_viviendas($id){   
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

	function print_filters_home() {
        $select = "SELECT * FROM viviendas";
 
        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($res -> num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }

    function filters_home($filter){
        // return $filter;
        $consulta = "SELECT c.*, i.img, ca.cat_name, t.type_name, b.brand_name
        FROM car c INNER JOIN car_img i INNER JOIN categoria ca INNER JOIN type t INNER JOIN brand b
        ON c.id = i.car AND  i.img LIKE ('%1%') AND c.categoria = ca.id_categoria AND c.combustible = t.id_type AND c.marca = b.id_brand";
        
            for ($i=0; $i < count($filter); $i++){
                if ($i==0){
                    if ($filter[$i][0] == 'orden'){
                        $consulta.= " ORDER BY " . $filter[$i][1] . " ASC";

                    }else{
                    $consulta.= " WHERE c." . $filter[$i][0] . "=" . $filter[$i][1];
                    }
                }else {
                    if ($filter[$i][0] == 'orden'){
                        $consulta.= " ORDER BY " . $filter[$i][1] . " ASC";

                    }else{$consulta.= " AND c." . $filter[$i][0] . "=" . $filter[$i][1];}
                }        
            }
            // $consulta.= " LIMIT $total_prod, $items_page";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $consulta);
        connect::close($conexion);

        $retrArray = array();
        if ($res -> num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        echo "<script>console.log('Consulta filtrada:', '" . $consulta . "');</script>";
    
        return $retrArray;
    }

    function redirect($filtros){
        return $filtros;  
        $select = "SELECT *
        FROM car c, brand b, car_img ci, categoria ca, type t
        WHERE c.marca = b.id_brand AND c.categoria = ca.id_categoria 
        AND c.combustible = t.id_type AND c.id = ci.car AND ci.img LIKE '%1%'";

        if ($filtros[0]['categoria']){
            $prueba = $filtros[0]['categoria'][0];
            $select.= " AND ca.cat_name = '$prueba'";
        }
        else if($filtros[0]['type']) {
            $prueba = $filtros[0]['type'][0];
            $select.= " AND t.type_name = '$prueba'";
        }
        else if($filtros[0]['marca']) {
            $prueba = $filtros[0]['marca'][0];
            $select.= " AND c.marca = '$prueba'";
        }
        $select.= " LIMIT $total_prod, $items_page";
       
        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);

        $retrArray = array();
        if ($res -> num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }

}
