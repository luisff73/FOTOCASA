<?php
     //$data = 'hola controler luis';
     //die('<script>console.log('.json_encode( $data ) .');</script>');
     $path = $_SERVER['DOCUMENT_ROOT'] . '/fotocasa_MVC/';       // Se define el path de la raíz del servidor                           
     include($path . "module/viviendas/model/DAOViviendas.php"); // Se incluye el fichero DAOViviendas.php
    // session_start();
                              
    //include ("module/viviendas/model/DAOViviendas.php");
    
    switch($_GET['op']){ // Se recoge la variable op enviada por get desde el index.php y se ejecuta el case correspondiente

        case 'list';
             //$data = 'hola crtl list viviendas';
             //die('<script>console.log('.json_encode( $data ) .');</script>');
              
            try{
                $daoviviendas = new DAOViviendas();
            	$rdo = $daoviviendas->select_all_viviendas(); // Se llama al método select_all_viviendas() de la clase DAOViviendas
                //die('<script>console.log('.json_encode( $rdo->num_rows ) .');</script>');
            }catch (Exception $e){
                $callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
            }
            
            if(!$rdo){
    			$callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
    		}else{                        
                include("module/viviendas/view/list_viviendas.php");
    		}
        break;
            
        case 'create';     
                //echo ('<script>console.log("Has entrado en controler_viviendas_php opcion create");</script>');
                //include() se utiliza para incorporar el contenido de un archivo dentro de otro.
                include("module/viviendas/model/validate.php"); 
                include("module/viviendas/view/create_viviendas.php");
            
                $check = true;
            
            if ($_POST){ // si se ha pulsado el botón submit
              
                 //die('<script>console.log("' . json_encode( $_POST ) . '");</script>');

                 $check=validate();
                 //data = 'Has pasado la validacion en create viviendas';
                 //die('<script>console.log('.json_encode( $data ) .');</script>');

                 if ($check){ // si se ha validado correctamente comienza el insert
                    //die('<script>console.log('.json_encode( $_POST ) .');</script>');
                    try{
                        $daoviviendas = new DAOViviendas();
    		            $viviendas = $daoviviendas->insert_viviendas($_POST);
                        // die('<script>console.log('.json_encode( $rdo ) .');</script>');
                    }catch (Exception $e){
                        $callback = 'index.php?page=503';
        			    die('<script>window.location.href="'.$callback .'";</script>');
                    }
                    
		            if($viviendas){ // si se ha insertado correctamente
                        echo '<script language="javascript">setTimeout(() => {
                            toastr.success("Creado en la base de datos correctamente");
                        }, 1000);</script>';
                        echo '<script language="javascript">setTimeout(() => {
                            window.location.href="index.php?page=controller_viviendas&op=list";
                        }, 2000);</script>';
            		}else{
            			$callback = 'index.php?page=503';
    			        die('<script>window.location.href="'.$callback .'";</script>');
            		}
                }
            }
        break;
            
        case 'read_modal';
           
            // die('<scrip>console.log('.json_encode( $data ) .');</script>');
            // console.log(json_encode( $data ));
              
            //echo $_GET['id']; 
            //exit;

            try{
                $daoviviendas = new DAOViviendas();
            	$rdo = $daoviviendas->select_viviendas($_GET['modal']);
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            if(!$rdo){
    			echo json_encode("error");
                exit;
    		}else{
    		    $viviendas=get_object_vars($rdo);
                echo json_encode($viviendas);
                //echo json_encode("error");
                exit;
    		}
        break;

        case 'update';
            
            $check = true;
            //die('<script>console.log('.json_encode( $_POST ) .');</script>');
            
            if ($_POST){ // si se ha pulsado el botón submit
                 //$data = 'Inicio controller viviendas update';
                 //die('<script>console.log('.json_encode( $data ) .');</script>');
                //die('<script>console.log('.json_encode( $check ) .');</script>');
                
                if ($check){ // si se ha validado correctamente comienza el update
                    
                    //die('<script>console.log('.json_encode( $_POST ) .');</script>');
                    try{ // se realiza el update
                        $daoviviendas = new DAOViviendas();
                        $viviendas = $daoviviendas->update_viviendas($_POST);
                        //die('<script>console.log('.json_encode( $viviendas ) .');</script>');

                    }catch (Exception $e){ // si no se ha podido realizar el update
                        $callback = 'index.php?page=503';
        			    die('<script>window.location.href="'.$callback .'";</script>');
                    }
                    
		            if($viviendas){ // si se ha actualizado correctamente
            			echo '<script language="javascript">setTimeout(() => {
                            toastr.success("Modificado en la base de datos correctamente");
                        }, 1000);</script>';
                        echo '<script language="javascript">setTimeout(() => {
                            window.location.href="index.php?page=controller_viviendas&op=list";
                        }, 2000);</script>';
            		}else{ // si no se ha actualizado correctamente
            			$callback = 'index.php?page=503';
    			        die('<script>window.location.href="'.$callback .'";</script>');
            		}
                }else{ // si no se ha validado correctamente
                    echo '<script language="javascript">setTimeout(() => {
                        window.location.href="index.php?page=controller_viviendas&op=list";
                    }, 2000);</script>';
                }
            }
            
            try {
                $daoviviendas = new DAOViviendas();  // Se instancia un objeto de la clase DAOViviendas
                $rdo = $daoviviendas->select_viviendas($_GET['id']);  // Se llama al método select_viviendas con el ID proporcionado en la URL
                $viviendas = get_object_vars($rdo);  // Se convierte el objeto devuelto a un array asociativo
                //die('<script>console.log('.json_encode( $viviendas ) .');</script>');
            
            } catch (Exception $e) {
                // Si ocurre una excepción, se ejecuta este bloque
                $callback = 'index.php?page=503';
                die('<script>window.location.href="'.$callback .'";</script>');
            }
            
            
            if(!$viviendas){
    			$callback = 'index.php?page=503';
    			die('<script>window.location.href="'.$callback .'";</script>');
    		}else{
        	    include("module/viviendas/view/update_viviendas.php");
    		}
        break;
            
        case 'read';
            // $data = 'hola crtl LUIS read';
            // die('<script>console.log('.json_encode( $data ) .');</script>');
            // die('<script>console.log('.json_encode( $_GET['id'] ) .');</script>');

            try{
                $daoviviendas = new DAOViviendas();
            	$rdo = $daoviviendas->select_viviendas($_GET['id']);
            	$viviendas=get_object_vars($rdo);
                //die('<script>console.log('.json_encode( $viviendas ) .');</script>');
            }catch (Exception $e){
                $callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
            }
            if(!$rdo){
    			$callback = 'index.php?page=503';
    			die('<script>window.location.href="'.$callback .'";</script>');
    		}else{
                include("module/viviendas/view/read_viviendas.php");
    		}
        break;
            
        case 'delete_v';

            //$data = 'hola crtl luis delete';
            //die('<script>console.log('.json_encode( $data ) .');</script>');
            // die('<script>console.log('.json_encode( $_GET['id'] ) .');</script>');

            if ($_POST){
                //die('<script>console.log('.json_encode( $_GET['id'] ) .');</script>');
                try{
                    $daoviviendas = new DAOViviendas();
                	$rdo = $daoviviendas->delete_viviendas($_GET['id']);
                }catch (Exception $e){
                    $callback = 'index.php?page=503';
    			    die('<script>window.location.href="'.$callback .'";</script>');
                }
            	if($rdo){
                    echo '<script language="javascript">setTimeout(() => {
                        toastr.success("Borrado en la base de datos correctamente");
                    }, 1000);</script>';
                    echo '<script language="javascript">setTimeout(() => {
                        window.location.href="index.php?page=controller_viviendas&op=list";
                    }, 2000);</script>';
        		}else{
        			$callback = 'index.php?page=503';
			        die('<script>window.location.href="'.$callback .'";</script>');
        		}
            }
            
            include("module/viviendas/view/delete_viviendas.php");
        break;


        case 'delete_all';
             
            if ($_POST){
                try{
                    $daoviviendas = new DAOviviendas();
                    $rdo = $daoviviendas -> delete_all_viviendas();
                }catch (Exception $e){
                    $callback = 'index.php?page=controller_viviendas&op=503';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }
                
                if($rdo){
                    echo '<script language="javascript">setTimeout(() => {
                        toastr.success("Lista de viviendas borrada correctamente");
                    }, 1000);</script>';
                    $callback = 'index.php?page=controller_viviendas&op=list';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }else{
                    $callback = 'index.php?page=controller_viviendas&op=503';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }
            }
            
                include("module/viviendas/view/delete_all_viviendas.php");
        
        break;

        case 'dummies';
                if ($_POST){
                try{
                    $dao_viviendas = new DAOViviendas();
                    $rdo = $dao_viviendas -> dummies_viviendas();
                }catch (Exception $e){
                    $callback = 'index.php?page=controller_viviendas&op=503';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }

                if($rdo){
                    echo '<script language="javascript">setTimeout(() => {
                        toastr.success("Dummies creados correctamente");
                    }, 1000);</script>';
                    $callback = 'index.php?page=controller_viviendas&op=list';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }else{
                    $callback = 'index.php?page=controller_viviendas&op=503';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }
             }
            
            include("module/viviendas/view/dummies_viviendas.php");
        break;

        default;
            include("view/inc/error404.php");
        break;
    }