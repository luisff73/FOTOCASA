<?php
	//$path = $_SERVER['DOCUMENT_ROOT'] . '/fotocasa_MVC_v2';
	include("C:/xampp/htdocs/fotocasa_MVC_v2/model/connect.php");
    
	
	class DAOHome {
		// function select_viviendas() {
		// 	$sql= "SELECT * FROM `viviendas` ORDER BY vivienda_name ASC LIMIT 30";

		// 	$conexion = connect::con();
		// 	$res = mysqli_query($conexion, $sql);
		// 	connect::close($conexion);

		// 	$retrArray = array();
		// 	if (mysqli_num_rows($res) > 0) {
		// 		while ($row = mysqli_fetch_assoc($res)) {
		// 			$retrArray[] = $row;
		// 		}
		// 	}
		// 	return $retrArray;
		// }

		function select_categories() {
			return 'hola';
			$sql= "SELECT * FROM category";

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

		// function select_type() {
		// 	$sql= "SELECT * FROM type ORDER BY type_name DESC";

		// 	$conexion = connect::con();
		// 	$res = mysqli_query($conexion, $sql);
		// 	connect::close($conexion);

		// 	$retrArray = array();
		// 	if (mysqli_num_rows($res) > 0) {
		// 		while ($row = mysqli_fetch_assoc($res)) {
		// 			$retrArray[] = $row;
		// 		}
		// 	}
		// 	return $retrArray;
		// }
	
		
	}