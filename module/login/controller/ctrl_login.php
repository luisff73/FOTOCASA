<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "/module/login/model/DAOlogin.php");
include($path . "/model/middleware_auth.php");
@session_start(); // AQUI SOLO PONEMOS ESTO, EL RESTO DE SESIONES SE PONEN EN EL MIDDLEWARE

switch ($_GET['op']) {
    case 'login-register_view';
        include("module/login/view/login-register.html");
        break;

    case 'register':
        // Comprobar que la email no exista
        try {
            $daoLog = new DAOLogin();
            $check = $daoLog->select_email($_POST['email_reg']);
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }

        if ($check) {
            $check_email = false;
        } else {
            $check_email = true;
        }

        // Si no existe el email creará el usuario
        if ($check_email) {
            try {
                $daoLog = new DAOLogin();
                $rdo = $daoLog->insert_user($_POST['username_reg'], $_POST['email_reg'], $_POST['passwd1_reg']);
            } catch (Exception $e) {
                echo json_encode("error");
                exit;
            }
            if (!$rdo) {
                echo json_encode("error_user");
                exit;
            } else {
                echo json_encode("ok");
                exit;
            }
        } else {
            echo json_encode("error_email");
            exit;
        }
        break;

    case 'login':
        try {
            $daoLog = new DAOLogin();
            $rdo = $daoLog->select_user($_POST['username_log']);                                               
            if ($rdo == "error_select_user") {
                echo json_encode("error_select_user"); //devuelve error_select_user para que lo recoga la funcion login
                exit;
            } else {
                if (password_verify($_POST['passwd_log'], $rdo['password'])) { //comprueba que la contraseña sea correcta
                   $accestoken = create_accestoken($rdo["username"]); //crea el token de la funcion accestoken del middleware_auth.php
                   $refreshtoken = create_refreshtoken($rdo["username"]); //crea el token create_refreshtoken del middleware_auth.php este token se usa para refrescar el accestoken  
                    
                    $_SESSION['username'] = $rdo['username']; //Guardamos el usuario en la sesion
                    $_SESSION['tiempo'] = time(); //Guardamos el tiempo que se logea

                    //echo json_encode('accestoken' => $accestoken); //devuelve el token de acceso
                    //echo json_encode('refreshtoken' => $refreshtoken); //devuelve el token de refresco
                    //echo json_encode(array('accestoken' => $accestoken, 'refreshtoken' => $refreshtoken));
                   
                    $response = array(
                        'accestoken' => $accestoken,
                        'refreshtoken' => $refreshtoken
                    );
                    
                    echo json_encode($response);
                    
                    
                    exit;
                } else {
                    echo json_encode("error_password");                 
                    exit;
                }
            }
        } catch (Exception $e) {
            echo json_encode("error");
            exit;  
        }
        break;

    case 'logout':
        unset($_SESSION['username']); //unset destruye la variable, con lo que borramos el usuario
        unset($_SESSION['tiempo']); //unset destruye la variable, con lo que borramos el tiempo
        session_destroy(); //session_destroy destruye la sesion
        echo json_encode('Done');
        break;

    case 'data_user':
        
        $json = decode_token($_POST['accestoken']);
        //echo json_encode ($json);
        //exit;
        $daoLog = new DAOLogin();
        //echo json_encode ($json['username']);
        //exit;
        $rdo = $daoLog->select_data_user($json['username']);
        echo json_encode($rdo);
        exit;
        break;

    case 'actividad':
        if (!isset($_SESSION["tiempo"])) { //si no existe la variable tiempo 
            echo json_encode("inactivo"); //devuelve inactivo
            exit();
        } else {
            if ((time() - $_SESSION["tiempo"]) >= 1800) { //1800s=30min CON ESTO SE DELIMITA EL TIEMPO DE LA SESION DEL USUARIO
                //ES EL TIEMPO DE AHORA MENOS EL TIEMPO DEL CREACION DEL TOKEN
                echo json_encode("inactivo");
                exit();
            } else {
                echo json_encode("activo");
                exit();
            }
        }
        break;

    case 'controluser':
        $token_dec = decode_token($_POST['accestoken']);

        if ($token_dec['exp'] < time()) {
            echo json_encode("Wrong_User");
            exit();
        }
         //si existe la variable usuario y es igual al usuario del token 
         //(o sea que comprobamos que el usuario de localstorage sea el mismo que el del token del servidor)
        if (isset($_SESSION['username']) && ($_SESSION['username']) == $token_dec['username']) { 
            echo json_encode("Correct_User");
            $old_token = decode_token($_POST['accestoken']);
            $new_token = create_accestoken($old_token['username']);
            echo json_encode($new_token);
            exit();
        } else {
            echo json_encode("Wrong_User");
            exit();
        }
        break;

    case 'refresh_cookie':
        session_regenerate_id(); //regenera el id de la sesion
        echo json_encode("Done");
        exit;
        break;

    default;
        include("view/inc/error404.php");
        break;
}