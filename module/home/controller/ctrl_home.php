<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
    include($path . "/module/home/model/DAOhome.php");

    switch ($_GET['op']) {
        case 'list':
                // try{
                //     $daoviviendas = new DAOhome();
                //     $rdo = $daoviviendas->select_type(); // Se llama al método select_type() de la clase DAOViviendas
                //     //die('<script>console.log('.json_encode( $rdo->num_rows ) .');</script>');
                // }catch (Exception $e){
                //     $callback = 'index.php?page=503';
                //     die('<script>window.location.href="'.$callback .'";</script>');
                // }
                
                // if(!$rdo){
                //     $callback = 'index.php?page=503';
                //     die('<script>window.location.href="'.$callback .'";</script>');
                // }else{                        
                    include("module/home/view/home.html");
                // }

        break;

        case 'carrousel_categories':
            try{ 
                $daohome = new DAOHome();
                $Selectcategories = $daohome->select_categories(); 
            } catch(Exception $e){  
                echo json_encode("error");
            }
            
            if(!empty($Selectcategories)){  // Si la consulta no devuelve ningún resultado, se devuelve un array vacío
                echo json_encode($Selectcategories); 
            }
            else{
                echo json_encode("error");  // Si la consulta devuelve un error, se devuelve un mensaje de error
            }
        break;

        case 'homepagecategory':
            try{
                $daohome = new DAOHome();
                $SelectCategory = $daohome->select_categories();
            } catch(Exception $e){
                echo json_encode("error");
            }
            
            if(!empty($SelectCategory)){
                echo json_encode($SelectCategory); 
            }
            else{
                echo json_encode("error");
            }
        break;

        case 'homepagecity':
        try{
            $daohome = new DAOHome();
            $SelectCity = $daohome->select_city();
        } catch(Exception $e){
            echo json_encode("error");
        }
        
        if(!empty($SelectCity)){
            echo json_encode($SelectCity); 
        }
        else{
            echo json_encode("error");
        }
    break;

        case 'homepagetype':
            try{
                $daohome = new DAOHome();
                $SelectType = $daohome->select_type();
            } catch(Exception $e){
                echo json_encode("error");
            }
            
            if(!empty($SelectType)){
                echo json_encode($SelectType); 
            }
            else{
                echo json_encode("error");
            }
        break;

        case 'homepageoperation':
        try{
            $daohome = new DAOHome();
            $SelectType = $daohome->select_operation();
        } catch(Exception $e){
            echo json_encode("error");
        }
        
        if(!empty($SelectType)){
            echo json_encode($SelectType); 
        }
        else{
            echo json_encode("error");
        }
    break;

        default;
            include("module/exceptions/views/pages/error404.php");
        break;
    }
