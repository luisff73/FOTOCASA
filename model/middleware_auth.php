<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
include($path . "model/JWT.php"); // INCLUIMOS LA LIBRERIA JWT  

function decode_token($token){
    $jwt = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/compracasa/model/jwt.ini');
    $secret = $jwt['secret'];
    $JWT = new JWT;
    $token_dec = $JWT->decode($token, $secret);
    $rt_token = json_decode($token_dec, TRUE);
    //json_decode en una funcion de php que convierte un string json en un array asociativo
    return $rt_token;

}
function create_accestoken($username){
    $jwt = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/compracasa/model/jwt.ini');
    $header = $jwt['header']; // OBTENEMOS EL HEADER DEL ARCHIVO INI
    $secret = $jwt['secret']; // OBTENEMOS EL SECRET DEL ARCHIVO INI
    $payload = '{"iat":"' . time() . '","exp":"' . time() + (600) . '","username":"' . $username . '"}';
    $JWT = new JWT;  // CREACION DE OBJETO JWT
    $token = $JWT->encode($header, $payload, $secret); // CODIFICAMOS EL TOKEN
    return $token;
}
function create_refreshtoken($username){
    $jwt = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/compracasa/model/jwt.ini');
    $header = $jwt['header'];
    $secret = $jwt['secret'];
    $payload = '{"iat":"' . time() . '","exp":"' . time() + (1600) . '","username":"' . $username . '"}';
    $JWT = new JWT;  // CREACION DE OBJETO JWT
    $token = $JWT->encode($header, $payload, $secret); // CODIFICAMOS EL TOKEN
    return $token;
}

// para depurar ....
//$token = create_token("luis");
//echo $token; echo '<br>';
//$username = decode_token($token);
//echo $username;