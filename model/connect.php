<?php
class connect {
    public static function con() {
        echo "Trying to connect...<br>";
        $host = 'localhost';
        $user = "root";
        $pass = "";
        $db = "fotocasa_v2";
        $port = 3306;

        $conexion = mysqli_connect($host, $user, $pass, $db, $port) or die(mysqli_error($conexion));
        echo "Connected successfully!<br>";
        return $conexion;
    }

    public static function close($conexion) {
        mysqli_close($conexion);
    }
}

