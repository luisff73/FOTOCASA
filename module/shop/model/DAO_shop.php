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
}
