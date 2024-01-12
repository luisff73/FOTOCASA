<div id="contenido">
    <!-- <form autocomplete="on" method="post" name="alta_vivienda" id="alta_vivienda" onsubmit="return validate();" action="index.php?page=controller_viviendas&op=create" >  -->
    <form autocomplete="on" method="post" name="alta_vivienda" id="alta_vivienda"><!-- eliminamos el action -->
    <h1>Crear Inmueble</h1>
        <table border='0'>

            <tr>
                <td>Referencia Catastral: </td>
                <td><input type="text" id="ref_catastral" name="ref_catastral" placeholder="ref_catastral" value=""/></td>
                <td><font color="red">
                    <span id="error_referencia catastral" class="error"></span>
                </font></td>
            </tr>
            
            <tr>
                <!-- desplegable de tipo de inmueble -->
                <td>Tipo de Inmueble: </td>
                <td><select id="tipo" name="tipo" placeholder="tipo">
                    <option value="Piso">Piso</option>
                    <option value="Adosado">Adosado</option>
                    <option value="Terreno">Terreno</option>
                    </select></td>
                <td><font color="red">
                    <span id="error_tipo" class="error"></span>
                </font></td>
            </tr>

            <tr>
                <td>Metros Cuadrados: </td>
                <td><input type="text" id= "m2" name="m2" placeholder="m2" value=""/></td>
                <td><font color="red">
                    <span id="error_m2" class="error"></span>
                </font></td>
            </tr>

            <tr>
                <td>Habitaciones: </td>
                <td><input type="text" id= "habitaciones" name="habitaciones" placeholder="habitaciones" value="0"/></td>
                <td><font color="red">
                    <span id="error_habitaciones" class="error"></span>
                </font></td>
            </tr>
            <tr>
                <td>Localidad: </td>
                <td><input type="text" id= "localidad" name="localidad" placeholder="localidad" value=""/></td>
                <td><font color="red">
                    <span id="error_localidad" class="error"></span>
                </font></td>
            </tr>
            <tr>
                <td>Extras: </td>
                    <td><select multiple size="6" id="extras[]" name="extras[]">
                    <option value="Ascensor">Ascensor</option>
                    <option value="Aire acondicionado">Aire acondicionado</option>
                    <option value="Calefaccion central">Calefaccion central</option>
                    <option value="Terraza">Terraza</option>
                    <option value="Garaje">Garaje</option>
                    <option value="Piscina">Piscina</option>
                    </select></td>
                <td><font color="red">
                    <span id="error_extras" class="error"></span>
                </font></td>
            </tr>

            <tr>
                <td>Estado: </td>
                <td>
                    <input type="radio" id="estado" name="estado" placeholder="estado" value="A estrenar" checked >A estrenar
					<input type="radio" id="estado" name="estado" placeholder="estado" value="Buen estado">Buen estado
					<input type="radio" id="estado" name="estado" placeholder="estado" value="A reformar">A reformar
                </td>
                <td><font color="red">
                    <span id="error_estado" class="error"></span>
                </font></td>
            </tr>
            
            <tr>
                <td>Precio: </td>
                <td><input type="text" id= "precio" name="precio" placeholder="precio" value=""/></td>
                <td><font color="red">
                    <span id="error_precio" class="error"></span>
                </font></td>
            </tr>
            <tr>
                <td>Fecha de publicacion: </td>
                <td><input id="fecha_publicacion" type="text" name="fecha_publicacion" placeholder="fecha de publicacion" value=""/></td>
                <td><font color="red">
                    <span id="error_fecha_publicacion" class="error"></span>
                </font></td>
            </tr>
            
            <tr>
                <td>Activo: </td>
                <td><input type="checkbox" id="activo" name="activo" placeholder="activo" value="1" checked/></td>
                <td><font color="red">
                    <span id="error_activo" class="error"></span>
                </font></td>
                
            </tr>

            <tr>
            
                <td><input type="button" name="create" id="create" onclick="validate('create')" value="Crear"/></td>
                <!-- <td><input type="submit" name="create" id="create"/></td> -->
                <td align="right"><a href="index.php?page=controller_viviendas&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>