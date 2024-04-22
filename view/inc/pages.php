<?php

// ENRUTADOR A CONTROLADORES.
if (isset($_GET['page'])) { // Si existe la variable $_GET['page']...

	switch ($_GET['page']) {
		
		case "ctrl_home":
			error_log("entrando en ctrl_home ".$_GET['page'].$_GET['op']);
			include("module/home/view/home.html"); // Incluye la pagina de inicio
			break;
		case "ctrl_shop":
			error_log("entrando en ctrl_shop ".$_GET['page'].$_GET['op']);
			include("module/shop/controller/" . $_GET['page'] . ".php"); // Incluye el controlador de viviendas.
			break;
		case "ctrl_login":
			error_log("entrando en login-register_view");
			include("module/login/controller/" . $_GET['page'] . ".php"); // Incluye el controlador de usuarios.
			break;
		case "aboutus":
			include("module/aboutus/" . $_GET['page'] . ".php"); // Incluye el controlador de aboutus.
			break;
		case "contactus":
			include("module/contact/" . $_GET['page'] . ".php"); //	Incluye el controlador de contactus.
			break;
		case "404":
			include("view/inc/error" . $_GET['page'] . ".php");	// Incluye la vista de error.
			break;
		case "503":
			include("view/inc/error" . $_GET['page'] . ".php");	// Incluye la vista de error.
			break;
		default:
		error_log("entrando en default ".$_GET['page'].$_GET['op']);
			include("module/home/view/home.html"); // Incluye la vista de inicio.
			break;
	}
} else { // Si no existe la variable $_GET['page']...(es la primera vez que entrammos)
	// Intenta incluir el primer archivo
	include_once("module/home/view/home.html");

	$error = error_get_last();

	if ($error) {
		echo "Error al incluir home.html: " . $error['message'];
		die('<script>console.log(' . json_encode($data) . ');</script>');
	}

}