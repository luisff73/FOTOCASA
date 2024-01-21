

<?php
//-----------------------------------------------------------------------------------------------------------------------------------------
// DAO viviendas MODEL, en este modulo se encuentran las funciones que se comunican con la base de datos para realizar las operaciones CRUD
//-----------------------------------------------------------------------------------------------------------------------------------------
$path = $_SERVER['DOCUMENT_ROOT'] . '/fotocasa_MVC/';  // Ruta absoluta de la carpeta del proyecto
include($path . "model/connect.php");

// include("model/connect.php");
    
	class DAOViviendas{  // Creamos la Clase DAOViviendas
	
		function insert_viviendas($datos){ // Creamos la función insert_viviendas
			
			$extras = "";  // Inicializamos la variable $extras porque nos da error
			echo '<script>alert("'.json_encode($datos).'");</script>';
			echo('<script>console.log('.json_encode( $datos ) .');</script>');
			// $id=$datos['id'];
        	$ref_catastral=$datos['ref_catastral'];
        	$tipo=$datos['tipo'];
        	$m2=$datos['m2'];
        	$habitaciones=$datos['habitaciones'];
        	$localidad=$datos['localidad'];
			foreach ($datos['extras'] as $indice) {
			    $extras=$extras."$indice:";
			}
			$extras = rtrim($extras, ':');  // Elimina los dos puntos al final de la cadena
			//die('<script>console.log('.json_encode( $extras ) .');</script>');
        	$estado=$datos['estado'];
        	$precio=$datos['precio'];	
			$fecha_publicacion=$datos['fecha_publicacion'];
			$activo=$datos['activo'];

        	$sqlinsert = "INSERT INTO inmueble(ref_catastral, tipo, m2, habitaciones, localidad, extras, estado, precio, activo, fecha_publicacion) VALUES('$ref_catastral','$tipo','$m2','$habitaciones','$localidad','$extras','$estado','$precio','$activo','$fecha_publicacion')";
            
			// die('<script>console.log('.json_encode( $sql ) .');</script>');
            $conexion = connect::con();
            $res = mysqli_query($conexion, $sqlinsert);
            connect::close($conexion);
			return $res;
		}
		
		function select_all_viviendas(){ // Creamos la función select_all_viviendas
			// $data = 'hola DAO select_all_viviendas';
            // die('<script>console.log('.json_encode( $data ) .');</script>');
			$sqlselectall = "SELECT * FROM inmueble ORDER BY id DESC";			     
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sqlselectall);
			connect::close($conexion);
            return $res;
		}
		
		function select_viviendas($viviendas){ // Creamos la función select_viviendas
			// $data = 'hola DAO select_vivienda;
            // die('<script>console.log('.json_encode( $data ) .');</script>');
			$sqlselectid = "SELECT * FROM inmueble WHERE id='$viviendas'";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sqlselectid)->fetch_object();  // fetch_object() devuelve un objeto con la información de la fila obtenida
            connect::close($conexion);
            return $res;
		}
		
		function update_viviendas($datos){ // Creamos la función update_viviendas
			//die('<script>console.log('.json_encode( $datos ) .');</script>');
			$extras = "";  // Inicializamos la variable $extras porque nos da error
			$id=$datos['id'];
        	$ref_catastral=$datos['ref_catastral'];
        	$tipo=$datos['tipo'];
        	$m2=$datos['m2'];
        	$habitaciones=$datos['habitaciones'];
        	$localidad=$datos['localidad'];
        	foreach ($datos['extras'] as $indice) {
				$extras=$extras."$indice:";
        	}
			
			$extras = rtrim($extras, ':');  // Elimina los dos puntos al final de la cadena
         	$estado=$datos['estado'];
        	$precio=$datos['precio'];
            $activo=$datos['activo'];
			$fecha_publicacion=$datos['fecha_publicacion'];
        	
        	$sqlupdate = " UPDATE inmueble SET ref_catastral='$ref_catastral', tipo='$tipo', m2='$m2', habitaciones='$habitaciones', localidad='$localidad', extras='$extras',"
        		. " estado='$estado', precio='$precio', activo='$activo', fecha_publicacion='$fecha_publicacion' WHERE id='$id'";
            //die('<script>console.log('.json_encode( $sqlupdate ) .');</script>');
            $conexion = connect::con();
            $res = mysqli_query($conexion, $sqlupdate);
            connect::close($conexion);
			return $res;
		}
		
		function delete_viviendas($viviendas){ // Creamos la función delete_viviendas
			$sqldelete = "DELETE FROM inmueble WHERE id='$viviendas'"; // Elimina la vivienda con el ID proporcionado
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sqldelete);
            connect::close($conexion);
            return $res;
		}
		function delete_all_viviendas(){
			$sqldeleteall = "DELETE FROM inmueble";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sqldeleteall);
            connect::close($conexion);

            return $res;
		}
		function dummies_viviendas(){
			$sqlinsert = "DELETE FROM inmueble;";

			$sqlinsert.= "INSERT INTO inmueble (ref_catastral, tipo, m2, habitaciones, localidad, extras, estado, precio, activo, fecha_publicacion)"
			." VALUES('asefsxffassfd','Piso','92','3','Fontanars','Aire acondicionado','A estrenar','56000','1','15/12/2023');";
			$sqlinsert.= "INSERT INTO inmueble (ref_catastral, tipo, m2, habitaciones, localidad, extras, estado, precio, activo, fecha_publicacion)"
			." VALUES('asefsxffa','Piso','98','2','Ontinyent','Aire acondicionado','A estrenar','1236000','1','18/10/2023');";
			$sqlinsert.= "INSERT INTO inmueble (ref_catastral, tipo, m2, habitaciones, localidad, extras, estado, precio, activo, fecha_publicacion)"
			." VALUES('asefsxfsfds','Piso','96','6','Aielo','Aire acondicionado','A reformar','80000','0','20/12/2023');";
			$sqlinsert.= "INSERT INTO inmueble (ref_catastral, tipo, m2, habitaciones, localidad, extras, estado, precio, activo, fecha_publicacion)"
			." VALUES('asefsxfsdfs','Adosado','102','3','Benissoda','Aire acondicionado','A estrenar','320000','0','23/11/2023');";		
			$sqlinsert.= "INSERT INTO inmueble (ref_catastral, tipo, m2, habitaciones, localidad, extras, estado, precio, activo, fecha_publicacion)"
			." VALUES('aasfsefsasfs','Piso','123','5','Albaida','Aire acondicionado','A reformar','33000','1','01/11/2023');";
			
			$conexion = connect::con();
            $res = mysqli_multi_query($conexion, $sqlinsert);
            connect::close($conexion);

            return $res;
		}

	}
