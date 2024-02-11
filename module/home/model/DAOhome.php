<?php
<<<<<<< HEAD
	$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
	include($path . "model/connect.php");
    
	class DAOHome {
		function select_viviendas() {
			$sql= "SELECT * FROM viviendas";
=======
	//$path = $_SERVER['DOCUMENT_ROOT'] . '/fotocasa_MVC_v2';
	include("C:/xampp/htdocs/fotocasa_MVC_v2/model/connect.php");
    
	
	class DAOHome {
		function select_viviendas() {
			$sql= "SELECT * FROM `viviendas` ORDER BY vivienda_name ASC LIMIT 30";
>>>>>>> d3de0469915f3e9ceeacbce45fd4b95057494b57

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

		function select_categories() {
<<<<<<< HEAD
			$sql= "SELECT * FROM category";
=======
		
			$sql= "SELECT * FROM category;";
>>>>>>> d3de0469915f3e9ceeacbce45fd4b95057494b57

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
<<<<<<< HEAD
		}

		function select_operation() {
			$sql= "SELECT * FROM operation";

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
		function select_type() {
			$sql= "SELECT * FROM type";
=======
			
		}

		function select_type() {
			$sql= "SELECT * FROM type ORDER BY type_name DESC";
>>>>>>> d3de0469915f3e9ceeacbce45fd4b95057494b57

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
	
<<<<<<< HEAD
		function select_city() {
			$sql= "SELECT * FROM city";

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
=======
>>>>>>> d3de0469915f3e9ceeacbce45fd4b95057494b57
		
	}