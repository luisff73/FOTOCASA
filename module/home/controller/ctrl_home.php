<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/compracasa/';
    include($path . "/module/home/model/DAOhome.php");

    switch ($_GET['op']) {
        case 'list';
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

        case 'carrousel_categories';
            try{
                $daohome = new DAOHome();
                $Selectcategories = $daohome->select_categories();
            } catch(Exception $e){
                echo json_encode("error");
            }
            
            if(!empty($Selectcategories)){
                echo json_encode($Selectcategories); 
            }
            else{
                echo json_encode("error");
            }
        break;

        case 'homepagecategory';
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

        case 'homepagetype';
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

        default;
            include("module/exceptions/views/pages/error404.php");
        break;
    }
