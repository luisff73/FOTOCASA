<div id="contenido">
    <div class="container">
    	<div class="row" text-align: center>
        <br>
            <br>
            <br>
             &nbsp;&nbsp;&nbsp;<h3>LISTADO DE VIVIENDAS</h3>                
            </div>
            <br>

    	<div class="row">
            <table class="tabla_centrada"> 
    		<td><p><a href="index.php?page=controller_viviendas&op=create"><img src="view/img/anadir.png"></a></p></td>
            <td><p><a href="index.php?page=controller_viviendas&op=delete_all"><img src="view/img/borrar_todo.png"></a></p></td>
            <td><p><a href="index.php?page=controller_viviendas&op=dummies"><img src="view/img/crear_dummies.png"></a></p> </td>
            </table>
<br>
    		<table>
                <tr>
                    <td width=25><b>Id</b></td>
                    <td width=125><b>Ref_catastral</b></td>
                    <td width=125><b>Tipo</b></td>
                    <td width=25><b>M2</b></td>
                    <td width=125><b>Habitaciones</b></td>
                    <td width=125><b>Localidad</b></td>
                    <td width=125><b>Extras</b></td>
                    <td width=125><b>Estado</b></td>
                    <td width=125><b>Precio</b></td> 
                    <td width=12><b>Activo</b></td>
                    <td width=125><b>Fecha_publicacion</b></td>
                </tr>
                <?php
                    if ($rdo->num_rows === 0){
                        echo '<tr>';
                        echo '<td align="center"  colspan="3">NO HAY NINGUNA VIVIENDAs</td>';
                        echo '</tr>';
                    }else{
                        foreach ($rdo as $row) {
                       		echo '<tr>';
                    	   	echo '<td width=25>'. $row['id'] . '</td>';
                    	   	echo '<td width=125>'. $row['ref_catastral'] . '</td>';
                    	   	echo '<td width=125>'. $row['tipo'] . '</td>';
                            echo '<td width=25>'. $row['m2'] . '</td>';
                            echo '<td width=125>'. $row['habitaciones'] . '</td>';
                            echo '<td width=125>'. $row['localidad'] . '</td>';
                            echo '<td width=125>'. $row['extras'] . '</td>';
                            echo '<td width=125>'. $row['estado'] . '</td>';
                            echo '<td width=125>'. $row['precio'] . '</td>';
                            echo '<td width=12>'. $row['activo'] . '</td>';
                            echo '<td width=125>'. $row['fecha_publicacion'] . '</td>';
                    	   	echo '<td width=350>';

                        


                            print ("<div class='vivienda' id='".$row['id']."'><a class='Button_blue' data-tr='Read'>Read</a></div>");  
                    	   	//echo '<a class="Button_blue" href="index.php?page=controller_viviendas&op=read&id='.$row['id'].'">Read</a>';                         
                    	   	//echo '&nbsp;';
                    	   	//echo '<a class="Button_green" href="index.php?page=controller_viviendas&op=update&id='.$row['id'].'">Update</a>';
                    	   	//echo '&nbsp;';
                    	   	//echo '<a class="Button_red" href="index.php?page=controller_viviendas&op=delete_v&id='.$row['id'].'">Delete</a>';
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