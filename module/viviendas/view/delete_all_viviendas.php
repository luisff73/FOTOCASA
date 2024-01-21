<div id="contenido">
    <form autocomplete="on" method="post" name="delete_all_viviendas" id="delete_all_viviendas">
        <table border='0'>
            <tr>
                <td>
                    <br>
                    <br>
                </td>
            <tr>
                <th width=1500><h3>¿Estás seguro de que quieres eliminar toda la lista de inmuebles?</h3></th>
                <input type="hidden" id="id" name="id" placeholder="id" value="<?php echo $id['id'];?>"/> 
            </tr>
        </table>
        <table border='0'>
            <tr>
                <td width=680 align="center"><input name="Submit" type="button" class="Button_green" onclick="operations_viviendas('delete_all')" value="Aceptar"/></td>
                <td width=680 align="center"><a class="Button_red" href="index.php?page=controller_viviendas&op=list">Cancelar</a></td>
            </tr>
        </table>
        <br>
        <br>
    </form>
</div>