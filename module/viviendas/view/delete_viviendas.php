<div id="contenido">
    <form autocomplete="on" method="post" name="delete_viviendas" id="delete_viviendas" action="index.php?page=controller_viviendas&op=delete&id=<?php echo $_GET['id']; ?>">
        <table border='0'>
            <tr>
                <td align="center"  colspan="2"><h3>¿Esta seguro de querer borrar la vivienda con id <?php echo $_GET['id']; ?>?</h3></td>
                
            </tr>
            <tr>
                <td align="center"><button type="submit" class="Button_green"name="delete" id="delete">Aceptar</button></td>
                <td align="center"><a class="Button_red" href="index.php?page=controller_viviendas&op=list">Cancelar</a></td>
            </tr>
        </table>
    </form>
</div>