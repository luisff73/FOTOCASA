<div id="contenido">
    <!-- <form autocomplete="on" method="post" name="delete_viviendas" id="delete_viviendas" action="index.php?page=controller_viviendas&op=delete&id=<?php //echo $_GET['id']; ?>"> -->
    <form autocomplete="on" method="post" name="delete_viviendas" id="delete_viviendas">
   
        <table border='0'>
            <br>
            <br>
            <br>
            <br>
            <tr>
                <td align="center"  colspan="2"><h3>¿Esta seguro de querer borrar la vivienda con id <?php echo $_GET['id']; ?>?</h3></td>
                <input type="hidden" id="id" name="id" placeholder="id" value="<?php echo $id['id'];?>"/>
            </tr>
            <tr>
                <td width=680 align="center"><input name="delete_v" type="button" id="delete_v" class="Button_green" onclick="operations_viviendas('delete_v')" value="Borrar"/></td>
                <td width=680 align="center"><a class="Button_red" href="index.php?page=controller_viviendas&op=list">Cancelar</a></td>
            </tr>
        </table>
    </form>
</div>

