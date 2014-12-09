<?php
    require '../require/comun.php';
    $bd = new BaseDatos();
    $modelo = new ModeloAnunciante($bd);
    $anunciantes = $modelo->getList();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Administración</title>
        <link rel="stylesheet" href="../estilo/estiloanuncios.css"/>
        <link rel="stylesheet" href="../estilo/estiloanunciantes.css"/>
        
        <script src="../js/operacionesanunciantes.js"></script>
    </head>
    <body>
        <header>
            <div id="contenidoheader">
                <h3>Consola de administración</h3>
            </div>
        </header>
        <div id="contenido">
            <div id="usuarios">
                <table id="tablaresultados">
                    <tr><th colspan="6">Anunciantes Registrados</th></tr>
                    <?php foreach ($anunciantes as $value) {?> 
                    <tr id="filaanunciante">
                        <td id="tablaid" class="tdanunciante"><?php echo $value->getId()?></td>
                        <td id="tablaNif" class="tdanunciante"><?php echo $value->getNif()?></td>
                        <td id="tablaNombre" class="tdanunciante"><?php echo $value->getNombre()?></td>
                        <td id="tablaApellidos" class="tdanunciante"><?php echo $value->getApellidos()?></td>
                        <td id="tablaTelefono" class="tdanunciante"><?php echo $value->getTelefono()?></td>
                        <td id="tablaEmail" class="tdanunciante"><?php echo $value->getEmail()?></td>
                    </tr>
                    <?php }?>                        
                </table>
            </div>
            <form method="post" action="" id="formulario">
            <label>Contacto</label><br/>
            <label>NIF:</label><input type="text" name="nif" id="nifAnuncio" required/><br/>
            <label>Nombre:</label></label><input type="text" name="nombre" id="nombreAnuncio" required/><label>Apellidos:</label><input type="text" name="apellidos" id="apellidosAnuncio"/><br/>
            <label>Telefono:</label><input type="text" name="telefono" id="telefonoAnuncio"/><label>email</label><input type="text" name="email" id="emailAnuncio"/><br/>
            <input type="hidden" name="id" required/>
            <input type="submit" name="accion" value="Agregar" class="boton" id="agregar" required/><br/>
            <input type="submit" name="accion" value="Editar" class="boton" id="editar" required/><br/>
            <input type="submit" name="accion" value="Eliminar" class="boton" id="eliminar" required/><br/>
            <input type="reset" value="Cancelar" class="boton" id="cancelar"/>                                        
        </form>
            <footer>
            <p>Martin de Martin Santiago</p>
        </footer>
    </body>
</html>
<?php
    $bd->closeConesxion();
?>
