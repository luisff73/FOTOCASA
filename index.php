<?php
    
    //isset($_GET['page']): 
	//Verifica si la variable $_GET['page'] 
	//está definida en la URL. 
	//$_GET es una superglobal en PHP que se utiliza para recoger datos enviados a través de una solicitud GET. 
	//Si page está presente en la URL, entonces isset devuelve true.

	// $_GET['page']==="controller_viviendas":
	// Comprueba si el valor de $_GET['page'] es estrictamente igual (tanto en valor como en tipo) a la cadena "controller_viviendas". 
	// Si esta condición es verdadera, significa que la página solicitada es "controller_viviendas".

    if ((isset($_GET['page'])) && ($_GET['page']==="controller_viviendas") ){
		include("view/inc/top_page_viviendas.php");
	}else{
		include("view/inc/top_page.php");
	}

	// La función session_start() en PHP se utiliza para iniciar una nueva sesión o reanudar la sesión existente en el servidor.
	session_start();
?>

<!-- Este código PHP y HTML está estructurado incluye secciones de una página web desde archivos externos, 
     utilizando la función INCLUDE.  -->

<div id="wrapper">		
    <div id="header">    	
    	<?php
    	    include("view/inc/header.php");
    	?>        
    </div>  

    <div id="menu">
		<?php
		    include("view/inc/menu.php");
		?>
    </div>	
    <div id="">
    	<?php 
		    include("view/inc/pages.php"); 
		?>        
        <br style="clear:both;" />
    </div>
    <div id="footer">   	   
	    <?php
	        include("view/inc/footer.php");
	    ?>        
    </div>
	
</div>
<?php
    include("view/inc/bottom_page.php");
?>
    