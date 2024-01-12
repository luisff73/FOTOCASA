<?php

// ENRUTADOR A CONTROLADORES.
if(isset($_GET['page'])){ // Si existe la variable $_GET['page']...
	switch($_GET['page']){
		case "homepage";
			include("module/inicio/view/inicio.php"); // Incluye la vista de inicio.
			break;
		case "controller_viviendas";
			include("module/viviendas/controller/".$_GET['page'].".php"); // Incluye el controlador de viviendas.
			break;
		case "services";
			include("module/services/".$_GET['page'].".php"); // Incluye el controlador de servicios.
			break;
		case "aboutus";
			include("module/aboutus/".$_GET['page'].".php");// Incluye el controlador de aboutus.
			break;
		case "contactus";
			include("module/contact/".$_GET['page'].".php");//	Incluye el controlador de contactus.
			break;
		case "404";
			include("view/inc/error".$_GET['page'].".php");	// Incluye la vista de error.
			break;
		case "503";
			include("view/inc/error".$_GET['page'].".php");	// Incluye la vista de error.
			break;
		default;
			include("module/inicio/view/inicio.php"); // Incluye la vista de inicio.
			break;

	}
} else{ // Si no existe la variable $_GET['page']...
	include("module/inicio/view/inicio.php");
}
?>