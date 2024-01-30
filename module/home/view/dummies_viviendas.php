<div id="contenido">
    <form autocomplete="on" method="post" name="dummies_viviendas" id="dummies_viviendas">
        <table border='0'>
            <br>
            <br>
            <br>
            <br>
            <tr>
                <th width=1200><h3>¿Quieres cargar los datos de los inmuebles?</h3></td>
                <input type="hidden" id="id" name="id" placeholder="id" value="prova"/>
            </tr>
        </table>
        <table border='0'>
            <tr>
                <td width=680 align="center"><input name="Submit" type="button" class="Button_green" onclick="operations_viviendas('dummies')" value="Aceptar"/></td>
                <td width=680 align="center"><a class="Button_red" href="index.php?page=controller_viviendas&op=list">Cancelar</a></td>
            </tr>
        </table>
    </form>
</div>