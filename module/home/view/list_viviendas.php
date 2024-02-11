<div id="contenido">
    <div class="container">
    	<div class="row" text-align: center>
        <br>
            <br>
            <br>
             &nbsp;&nbsp;&nbsp;<h3>LISTADO DE TYPE</h3>                
            </div>
            <br>

    	<div class="row">
            <table class="tabla_centrada"> 
    		<td><p><a href="index.php?page=ctrl_home&op=create"><img src="view/img/anadir.png"></a></p></td>
            <td><p><a href="index.php?page=ctrl_home&op=delete_all"><img src="view/img/borrar_todo.png"></a></p></td>
            <td><p><a href="index.php?page=ctrl_home&op=dummies"><img src="view/img/crear_dummies.png"></a></p> </td>
            </table>
<br>
    		<table>
                <tr>
                    <td width=25><b>Id_type</b></td>
                    <td width=125><b>type_name</b></td>
                    <td width=125><b>image_name</b></td>
                </tr>
                <?php
                    if (is_array($rdo) && count($rdo) === 0) {
                        echo '<tr>';
                        echo '<td align="center"  colspan="3">NO HAY NINGUNA VIVIENDA EN LA BASE DE DATOS</td>';
                        echo '</tr>';
                    }else{
                        foreach ($rdo as $row) {
                       		echo '<tr>';
                    	   	echo '<td width=25>'. $row['id_type'] . '</td>';
                    	   	echo '<td width=125>'. $row['type_name'] . '</td>';
                    	   	echo '<td width=125>'. $row['image_name'] . '</td>';
                    	   	echo '<td width=350>';  
                            echo('<script>console.log('.json_encode( $row ) .');</script>');
                                              
                            print ("<div class='vivienda' id_category='".$row['id_type']."'><a class='Button_blue' data-tr='Read'>Read</a></div>");  
                    	   	//echo '<a class="Button_blue" href="index.php?page=ctrl_home&op=read&id='.$row['id'].'">Read</a>';                         
                    	   	//echo '&nbsp;';
                    	   	//echo '<a class="Button_green" href="index.php?page=ctrl_home&op=update&id='.$row['id'].'">Update</a>';
                    	   	//echo '&nbsp;';
                    	   	//echo '<a class="Button_red" href="index.php?page=ctrl_home&op=delete_v&id='.$row['id'].'">Delete</a>';
                    	   	//echo '</td>';
                    	   	echo '</tr>';
                        }
                    }
                ?>
            </table>
    	</div>
    </div>
</div>

<!-- modal window -->

<!-- Este fragmento de código HTML define una sección (elemento <section>) con el identificador vivienda_modal. 
Dentro de esa sección, hay un contenedor <div> con el identificador details_vivienda que tiene el atributo hidden, 
Dentro de ese contenedor oculto (details_vivienda), hay otro <div> con el identificador details y un contenedor adicional 
<div> con el identificador container. Este último contenedor (container) está vacío, no contiene contenido o elementos visibles.

Este código se puede utilizar como estructura base para un modal en una página web. El modal (details_vivienda) se encuentra oculto 
inicialmente (hidden), y probablemente se mostrará y ocultará dinámicamente mediante JavaScript o algún otro código del lado del cliente. 
Cuando se activa, el modal podría contener información detallada o elementos adicionales que se superpondrán sobre el contenido principal 
de la página para proporcionar información adicional al usuario.
 -->


<section id="vivienda_modal">  
    <div id="details_vivienda" hidden> 

    </div>
</section>