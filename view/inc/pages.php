<?php

// ENRUTADOR A CONTROLADORES.
if(isset($_GET['page'])){ // Si existe la variable $_GET['page']...

	// echo "El valor de page es " . ($_GET['page']);
	// Según el valor de $_GET['page'] se incluirá un controlador u otro.
	
	switch($_GET['page']){
		case "homepage";
			include("module/home/view/home.html"); // Incluye la vista de inicio.
			break;
		case "shop";	
			include("module/shop/view/".$_GET['page'].".html"); // Incluye el controlador del modulo shop.
			break;
		case "ctrl_home";
			include("module/home/controller/".$_GET['page'].".php"); // Incluye el controlador de viviendas.
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
			include("module/home/view/home.html"); // Incluye la vista de inicio.
			break;

	}
} else{ // Si no existe la variable $_GET['page']...(es la primera vez que entrammos)
// Intenta incluir el primer archivo
include_once("module/home/view/home.html");
              
if ($php_errormsg) {
    echo "Error al incluir home.html: " . $php_errormsg;
	die('<script>console.log('.json_encode( $data ) .');</script>');
}

// Intenta incluir el segundo archivo
include_once($path . "/view/inc/top_page_home.php");
if ($php_errormsg) {
    echo "Error al incluir top_pages_viviendas.php: " . $php_errormsg;
}

}
