<?php
     //$data = 'hola controler luis';
     //die('<script>console.log('.json_encode( $data ) .');</script>');
     $path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';       // Se define el path de la raíz del servidor                           
     include($path . "module/home/model/DAOhome.php"); // Se incluye el fichero DAOViviendas.php
    // session_start();
                              
    //include ("module/homemodel/DAOViviendas.php");
    
    switch($_GET['op']){ // Se recoge la variable op enviada por get desde el index.php y se ejecuta el case correspondiente

        case 'list';
             //$data = 'hola crtl list categories';
             //die('<script>console.log('.json_encode( $data ) .');</script>');
              
            try{
                $daoviviendas = new DAOhome();
            	$rdo = $daoviviendas->select_categories(); // Se llama al método select_all_viviendas() de la clase DAOViviendas
                //die('<script>console.log('.json_encode( $rdo->num_rows ) .');</script>');
            }catch (Exception $e){
                $callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
            }
            
            if(!$rdo){
    			$callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
    		}else{                        
                include("module/home/view/list_viviendas.php");
    		}
        break;

        default;
            include("view/inc/error404.php");
        break;
    }