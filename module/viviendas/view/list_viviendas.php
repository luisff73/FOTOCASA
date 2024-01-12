<div id="contenido">
    <div class="container">
    	<div class="row">
    			<h3>LISTA DE VIVIENDAS</h3>
    	</div>
    	<div class="row">
    		<p><a href="index.php?page=controller_viviendas&op=create"><img src="view/img/anadir.png"></a></p>
    		
    		<table>
                <tr>
                    <td width=25><b>Id</b></th>
                    <td width=125><b>Ref_catastral</b></th>
                    <td width=125><b>Tipo</b></th>
                    <!-- <th width=25><b>M2</b></th>
                    <td width=125><b>Habitaciones</b></th>
                    <td width=125><b>Localidad</b></th>
                    <td width=125><b>Extras</b></th>
                    <td width=125><b>Estado</b></th>
                    <td width=125><b>Precio</b></th> -->
                    <td width=12><b>Activo</b></th>
                    <td width=125><b>Fecha_publicacion</b></th>
                </tr>
                <?php
                    if ($rdo->num_rows === 0){
                        echo '<tr>';
                        echo '<td align="center"  colspan="3">NO HAY NINGUNA VIVIENDA</td>';
                        echo '</tr>';
                    }else{
                        foreach ($rdo as $row) {
                       		echo '<tr>';
                    	   	echo '<td width=25>'. $row['id'] . '</td>';
                    	   	echo '<td width=125>'. $row['ref_catastral'] . '</td>';
                    	   	echo '<td width=125>'. $row['tipo'] . '</td>';
                            //echo '<td width=25>'. $row['m2'] . '</td>';
                            //echo '<td width=125>'. $row['habitaciones'] . '</td>';
                            //echo '<td width=125>'. $row['localidad'] . '</td>';
                            //echo '<td width=125>'. $row['extras'] . '</td>';
                            //echo '<td width=125>'. $row['estado'] . '</td>';
                            //echo '<td width=125>'. $row['precio'] . '</td>';
                            echo '<td width=12>'. $row['activo'] . '</td>';
                            echo '<td width=125>'. $row['fecha_publicacion'] . '</td>';
                    	   	echo '<td width=350>';
                    	   	echo '<a class="Button_blue" href="index.php?page=controller_viviendas&op=read&id='.$row['id'].'">Read</a>';                         
                    	   	echo '&nbsp;';
                    	   	echo '<a class="Button_green" href="index.php?page=controller_viviendas&op=update&id='.$row['id'].'">Update</a>';
                    	   	echo '&nbsp;';
                    	   	echo '<a class="Button_red" href="index.php?page=controller_viviendas&op=delete&id='.$row['id'].'">Delete</a>';
                    	   	echo '</td>';
                    	   	echo '</tr>';
                        }
                    }
                ?>
            </table>
    	</div>
    </div>
</div>