<div id="contenido">
    <form autocomplete="on" method="post" name="update_viviendas" id="update_viviendas"> 
 <br>
     
        <h1>Modificar ficha Inmueble</h1>
        <table border='0'>

            <tr>
                <td>Id: </td>
                <td><input type="text" id="id" name="id" placeholder="id" value="<?php echo $viviendas['id'];?>" readonly/></td>
                <td><font color="red">
                    <span id="error_id" class="error"></span> 
                 </font>
                </td>
            </tr>

            <tr>
                <td>Referencia Catastral: </td>
                <td><input type="text" id="ref_catastral" name="ref_catastral" placeholder="ref_catastral" value="<?php echo $viviendas['ref_catastral'];?>"/></td>
                <td><font color="red">
                    <span id="error_referencia_catastral" class="error"></span> 
                 </font>
                </td>
            </tr>
        
            <tr>
                <td>Tipo de Inmueble: </td>
                <td><input type="text" id="tipo" name="tipo" placeholder="tipo" value="<?php echo $viviendas['tipo'];?>"/></td>
                <td><font color="red">
                    <span id="error_tipo" class="error"></span>
                </font>
                </td>
            </tr>
            
            <tr>
                <td>Metros Cuadrados: </td>
                <td><input type="text" id="m2" name="m2" placeholder="m2" value="<?php echo $viviendas['m2'];?>"/></td>
                <td><font color="red">
                    <span id="error_m2" class="error"></span>
                </font>
                </td>
            </tr>
            
            <tr>
                <td>Habitaciones: </td>
                <td><input type="text" id= "habitaciones" name="habitaciones" placeholder="habitaciones" value="<?php echo $viviendas['habitaciones'];?>"/></td>
                <td><font color="red">
                    <span id="error_habitaciones" class="error"></span>
                </font>
                </td>
            </tr>

            <tr>
                <td>Localidad: </td>
                <td><input type="text" id="localidad" name="localidad" placeholder="localidad" value="<?php echo $viviendas['localidad'];?>"/></td>
                <td><font color="red">
                    <span id="error_localidad" class="error"></span>
                </font>
                </td>
            </tr>

            <tr>
                <td>Extras: </td>
                <?php
                    $extras=explode(":", $viviendas['extras']);
                ?>
                <td><select multiple size="6" id="extras[]" name="extras[]">
                    <?php
                        $busca_array=in_array("Ascensor", $extras);
                        if($busca_array){
                    ?>
                        <option value="Ascensor" selected>Ascensor</option>
                    <?php
                        }else{
                    ?>
                        <option value="Ascensor">Ascensor</option>
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array=in_array("Aire acondicionado", $extras);
                        if($busca_array){
                    ?>
                        <option value="Aire acondicionado" selected>Aire acondicionado</option>
                    <?php
                        }else{
                    ?>
                        <option value="Aire acondicionado">Aire acondicionado</option>
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array=in_array("Calefaccion central", $extras);
                        if($busca_array){
                    ?>
                        <option value="Calefaccion central" selected>Calefaccion central</option>
                    <?php
                        }else{
                    ?>
                        <option value="Calefaccion central">Calefaccion central</option>
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array=in_array("Terraza", $extras);
                        if($busca_array){
                    ?>
                        <option value="Terraza" selected>Terraza</option>
                    <?php
                        }else{
                    ?>
                        <option value="Terraza">Terraza</option>
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array=in_array("Garaje", $extras);
                        if($busca_array){
                    ?>
                        <option value="Garaje" selected>Garaje</option>
                    <?php
                        }else{
                    ?>
                        <option value="Garaje">Garaje</option>
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array=in_array("Piscina", $extras);
                        if($busca_array){
                    ?>
                        <option value="Piscina" selected>Piscina</option>
                    <?php
                        }else{
                    ?>
                        <option value="Piscina">Piscina</option>
                    <?php
                        }
                    ?>
                    </select></td>
                <td><font color="red">
                    <span id="error_extras" class="error"></span>
                </font></td>
            </tr>

            <tr>
                <td>Estado: </td>
                <td>
                    <?php
                        if($viviendas['estado']==="A estrenar"){
                    ?>
                    <input type="radio" id="estado" name="estado" placeholder="estado" value="A estrenar" checked/>A estrenar
                    <input type="radio" id="estado" name="estado" placeholder="estado" value="Buen estado"/>Buen estado
                    <input type="radio" id="estado" name="estado" placeholder="estado" value="A reformar"/>A reformar
                    <?php
                        }elseif($viviendas['estado']==="Buen estado"){
                    ?>
                    <input type="radio" id="estado" name="estado" placeholder="estado" value="A estrenar"/>A estrenar
                    <input type="radio" id="estado" name="estado" placeholder="estado" value="Buen estado" checked/>Buen estado
                    <input type="radio" id="estado" name="estado" placeholder="estado" value="A reformar"/>A reformar
                    <?php
                        }else{
                    ?>
                    <input type="radio" id="estado" name="estado" placeholder="estado" value="A estrenar"/>A estrenar
                    <input type="radio" id="estado" name="estado" placeholder="estado" value="Buen estado"/>Buen estado
                    <input type="radio" id="estado" name="estado" placeholder="estado" value="A reformar" checked/>A reformar
                    <?php
                        }
                    ?>
                </td>
                <td><font color="red">
                    <span id="error_estado" class="error">
                        
                    </span>
                </font></td>
            </tr>
            
            <tr>
                <td>Precio: </td>
                <td><input id="precio" type="text" name="precio" placeholder="precio" value="<?php echo $viviendas['precio'];?>"/></td>
                <td><font color="red">
                    <span id="error_precio" class="error">
                        
                    </span>
                </font></td>
            </tr>
            
            <tr>
                <td>Fecha publicacion: </td>
                <td><input id="fecha_publicacion" type="text" name="fecha_publicacion" placeholder="fecha_publicacion" value="<?php echo $viviendas['fecha_publicacion'];?>"/></td>
                <td><font color="red">
                    <span id="error_fecha_publicacion" class="error">
                        
                    </span>
                </font></td>
            </tr>

            <tr>
                <td>Activo: </td>
                <td>
                    <?php
                        if($viviendas['activo']==="1"){
                    ?>
                    <input type="radio" id="activo" name="activo" placeholder="activo" value="1" checked/>Si
                    <input type="radio" id="activo" name="activo" placeholder="activo" value="0"/>No
                    <?php
                        }else{
                    ?>
                    <input type="radio" id="activo" name="activo" placeholder="activo" value="1"/>Si
                    <input type="radio" id="activo" name="activo" placeholder="activo" value="0" checked/>No
                    <?php
                        }
                    ?>
                </td>
                <td><font color="red">
                    <span id="error_activo" class="error"></span>          
                    </font>
                </td>
            </tr>
            <tr>
                <td><input type="button" name="update" id="update" onclick="validate('updates')" value="Modificar"/></td>
                <!-- <td><input type="submit" name="update" id="update"/></td> -->
                <td align="right"><a href="index.php?page=controller_viviendas&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>