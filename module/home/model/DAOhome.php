<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "model/connect.php");

class DAOHome
{
	function select_viviendas()
	{
		$sql = "SELECT * FROM viviendas";

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

	function select_categories()
	{
		$sql = "SELECT * FROM category";

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

	function select_operation()
	{
		$sql = "SELECT * FROM operation";

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
	function select_type()
	{
		$sql = "SELECT * FROM type";

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

	function select_city()
	{
		$sql = "SELECT * FROM city";

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

	function select_mas_visitadas()
	{
		//$prueba = "hola dao shop";
		//return $prueba;

		$sql = "SELECT DISTINCT v.id_vivienda,v.vivienda_name,ci.city_name,state,status,v.vivienda_price,v.description,v.image_name,v.m2,c.category_name,o.operation_name, t.type_name,a.adapted, vv.visitas FROM viviendas v INNER JOIN category c ON v.id_category = c.id_category INNER JOIN operation o ON v.id_operation = o.id_operation INNER JOIN city ci ON v.id_city = ci.id_city INNER JOIN type t ON v.id_type = t.id_type LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda INNER JOIN most_visited vv ON v.id_vivienda=vv.id_vivienda order by vv.visitas desc;";
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

	function filters_busquedas($filters)
	{
		$select = "SELECT v.id_vivienda,v.vivienda_name,ci.city_name,v.state,v.status,v.vivienda_price,v.description,v.image_name,v.m2,c.category_name,o.operation_name,t.type_name,c.id_category,o.id_operation,ci.id_city,t.id_type,a.adapted FROM viviendas v INNER JOIN category c ON v.id_category = c.id_category INNER JOIN operation o ON v.id_operation = o.id_operation INNER JOIN city ci ON v.id_city = ci.id_city INNER JOIN type t ON v.id_type = t.id_type LEFT JOIN adapted a ON v.id_vivienda = a.id_vivienda WHERE v.id_vivienda>0";


		for ($i = 0; $i < count($filters); $i++) {
			if ($filters[$i][0] == 'vivienda_price') {
				// Si el filtro es 'filter_price', separamos el contenido por la coma
				list($value1, $value2) = explode('|', $filters[$i][1]);
				$select .= " AND v." . $filters[$i][0] . " BETWEEN " . $value1 . " AND " . $value2;
			} else {
				$select .= " AND v." . $filters[$i][0] . "=" . $filters[$i][1];
			}
		}



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
}