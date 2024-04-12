<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
    include($path . "model/connect.php");

    class DAOLogin{
        function select_email($email){
			$sql = "SELECT email FROM users WHERE email='$email'";
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql)->fetch_object();
            connect::close($conexion);
            return $res;
		}

        function insert_user($username, $email, $password){
            $hashed_pass = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]); //funcion de php para encriptar la contraseña
            $hashavatar = md5(strtolower(trim($email))); //genera un hash a partir del email
            $avatar = "https://i.pravatar.cc/500?u=$hashavatar"; //genera un avatar aleatorio con el nombre de usuario
            $sql ="   INSERT INTO `users`(`username`, `password`, `email`, `type_user`, `avatar`) 
            VALUES ('$username','$hashed_pass','$email','client','$avatar')";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        function select_user($username){
			$sql = "SELECT `username`, `password`, `email`, `type_user`, `avatar` FROM `users` WHERE username='$username'";
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql)->fetch_object();
            connect::close($conexion);

            if ($res) {
                $value = get_object_vars($res);
                return $value;
            }else {
                return "error_select_user";
            }
        }

        function select_data_user($username){
			$sql = "SELECT * FROM users WHERE username='$username'";
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql)->fetch_object();
            connect::close($conexion);
            echo $username;
            return $res;
        }

    }