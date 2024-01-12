<div id="contenido">
    <h1>Ficha del Inmueble</h1>
    <p>
    <table border='1'>
        <tr>
            <td>Id:</td>
            <td>
                <?php
                echo $viviendas['id'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Referencia catastral: </td>
            <td>
                <?php
                    echo $viviendas['ref_catastral'];
                ?>
            </td>
        </tr>
    
        <tr>
            <td>Tipo: </td>
            <td>
                <?php
                    echo $viviendas['tipo'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>M2: </td>
            <td>
                <?php
                    echo $viviendas['m2'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Habitaciones: </td>
            <td>
                <?php
                    echo $viviendas['habitaciones'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Localidad: </td>
            <td>
                <?php
                    echo $viviendas['localidad'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Extras: </td>
            <td>
                <?php
                    echo $viviendas['extras'];
                ?>
            </td>
        </tr>

        <tr>
            <td>Estado: </td>
            <td>
                <?php
                    echo $viviendas['estado'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Precio: </td>
            <td>
                <?php
                    echo $viviendas['precio'];
                ?>
            </td>
            
        </tr>
        
        <tr>
            <td>Activo: </td>
            <td>
                <?php
                    echo $viviendas['activo'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Fecha publicacion: </td>
            <td>
                <?php
                    echo $viviendas['fecha_publicacion'];
                ?>
            </td>
        </tr>

    </table>
    </p>
    <p><a href="index.php?page=controller_viviendas&op=list">Volver</a></p>
</div>