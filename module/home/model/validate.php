<?php

function validate_ref_catastral_ORIGINAL($ref_catastral){  // ESTA ES LA ORIGINAL

    $sql = "SELECT * FROM inmueble WHERE ref_catastral='$ref_catastral'";
    $conexion = connect::con();  // 'connect::con()' realiza la conexión a la base de datos
    $res = mysqli_query($conexion, $sql)->fetch_object();  // Realiza la consulta y obtiene el primer resultado como objeto
    connect::close($conexion);  // Cierra la conexión a la base de datos
    //die('<script>console.log('.json_encode( $res ) .');</script>');
    
    echo ('<script>console.log('.json_encode( $ref_catastral . " valor de ref catastral") .');</script>');   
    return $res;  // Devuelve el objeto resultado de la consulta
}

function validate_ref_catastral($ref_catastral) {
    $sql = "SELECT * FROM inmueble WHERE ref_catastral='$ref_catastral'";
    $conexion = connect::con();
    $result = mysqli_query($conexion, $sql);

    if (!$result) {
        // Manejo de errores si la consulta falla
        echo '<script>console.error("Error en la consulta SQL: ' . mysqli_error($conexion) . '");</script>';
        connect::close($conexion);
        return null;
    }

    $res = $result->fetch_object();
    connect::close($conexion);

    echo '<script>console.log('.json_encode($ref_catastral . " valor de ref catastral").');</script>';   
    return $res;
}



function validate(){
    
    //die ('<script>console.log('.json_encode( $_POST . " valor de ref catastral") .');</script>');

    $check = true;  // Establece $check en true
    $ref_catastral = $_POST['ref_catastral'];
	$ref_catastral = validate_ref_catastral($ref_catastral);

    // echo ('<script>console.log('.json_encode( $ref_catastral . " valor de ref catastral") .');</script>');
        
	//die('<script>console.log('.json_encode( $ref_catastral ) .');</script>');

    if ($ref_catastral !== null) {  // Verifica que la referencia catastral no esté vacía
		//echo ('<script>console.log('.json_encode( $ref_catastral . " valor de ref catastral") .');</script>');
        echo '<script language="javascript">setTimeout(() => {
                toastr.error("La referencia catastral no puede estar repetida");
            }, 1000);</script>';
        $check = false;  // Establece $check en false si la referencia catastral está vacía
    }
	//die('<script>console.log(' . json_encode($check ) . ' );</script>');

    return $check;  // Devuelve el valor de $check, que indica si la referencia catastral está vacía o no
}

