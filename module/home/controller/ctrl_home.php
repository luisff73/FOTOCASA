<?php
    echo json_encode ("hola acabas de entrar en ctrl_home");  //comprobar que entra en el case
    $path = $_SERVER['DOCUMENT_ROOT'] . '/fotocasa_MVC_v2';
    include($path . "/module/home/model/DAOhome.php");
    include("C:/xampp/htdocs/fotocasa_MVC_v2/module/home/model/DAOhome.php");
      

    switch ($_GET['op']) {
        
        // case 'carrousel_viviendas';
        //     try{
        //         $daohome = new DAOHome();
        //         $Selectviviendas = $daohome->select_viviendas();
        //     } catch(Exception $e){
        //         echo json_encode("error");
        //     }
            
        //     if(!empty($Selectviviendas)){
        //         echo json_encode($Selectviviendas); 
        //     }
        //     else{
        //         echo json_encode("error");
        //     }
        // break;

        case 'homePageCategory';
            echo json_encode ("hola acabas de entrar en homePageCategory");  //comprobar que entra en el case
            break;       
            try{
                $daohome = new DAOHome();
                $SelectCategory = $daohome->select_categories();
                echo json_encode ("holay");
                echo json_encode ("hola acabas de entrar en homePageCategory");
                echo json_encode($SelectCategory);

                //comprobar que entra en el case
            
            
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

        // case 'homePageType';
        //     try{
        //         $daohome = new DAOHome();
        //         $SelectType = $daohome->select_type();
        //     } catch(Exception $e){
        //         echo json_encode("error");
        //     }
            
        //     if(!empty($SelectType)){
        //         echo json_encode($SelectType); 
        //     }
        //     else{
        //         echo json_encode("error");
        //     }
        // break;

        default;
            include("module/exceptions/views/pages/error404.php");
        break;
    }
?>