<?php
    require '../require/comun.php';
    $bd = new BaseDatos();
    $modelo = new ModeloAnuncio($bd);
    $anuncios = $modelo->getList();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Administración</title>
        <script src="../js/operacionesanuncios.js"></script>
        <link rel="stylesheet" href="../estilo/estiloanuncios.css"/>
    </head>
    <body>
        <header>
            <div id="contenidoheader">
                <h3>Consola de administración</h3>
            </div>
        </header>
        <div id="contenido">
            <div id="anuncios">
                <table id="tablaresultados">
                    <tr><th colspan="6">Anuncios Registrados</th></tr>
                    <?php foreach ($anuncios as $value) {?> 
                    <tr id="filaanuncio">
                        <td id="tablaid" class="tdanuncio"><?php echo $value->getId()?></td>
                        <td id="tablaTitulo" class="tdanuncio"><?php echo $value->getTitulo()?></td>
                        <td id="tablaPrecio" class="oculto"><?php echo $value->getPrecio()?></td>
                        <td id="tablaProducto" class="oculto"><?php echo $value->getProducto()?></td>
                        <td id="tablaOperacion" class="oculto"><?php echo $value->getOperacion()?></td>
                        <td id="tablaMetros" class="oculto"><?php echo $value->getMetros()?></td>
                        <td id="tablaHabitaciones" class="oculto"><?php echo $value->getHabitaciones()?></td>
                        <td id="tablaAseos" class="oculto"><?php echo $value->getAseos()?></td>
                        <td id="tablaDescripcion" class="oculto"><?php echo $value->getDescripcion()?></td>
                        <td id="tablaCalle" class="oculto"><?php echo $value->getCalle()?></td>
                        <td id="tablaNumero" class="oculto"><?php echo $value->getNumero()?></td>
                        <td id="tablaPlanta" class="oculto"><?php echo $value->getPlanta()?></td>
                        <td id="tablaLocalidad" class="oculto"><?php echo $value->getLocalidad()?></td>
                        <td id="tablaProvincia" class="oculto"><?php echo $value->getProvincia()?></td>
                        <td id="tablaIdAnunciante" class="oculto"><?php echo $value->getIdAnunciante()?></td>
                    </tr>
                    <?php }?>                        
                </table>
            </div>
            
            <form id="formulario" method="post" action="" enctype="multipart/form-data">
            <label>Anuncio</label><br/>
            <label>Titulo del anuncio:</label><input type="text" name="titulo" id="tituloAnuncio" required/><br/>
            <label>Precio:</label><input type="text" name="precio" id="precioAnuncio" required/>
            <label>Producto:</label><select name="tipo" id="tipoProductoAnuncio">
                                                <option value="apartamento">Apartamento</option>
                                                <option value="piso">Piso</option>
                                                <option value="casa">Casa</option>
                                                <option value="bajo">Bajo</option>
                                                <option value="rustico">Rustico</option>
                                                <option value="industrial">Industrial</option>
                                            </select>
            <label>Operacion:</label><select name="operacion" id="tipoOperacionAnuncio">
                                                <option value="venta">Venta</option>
                                                <option value="alquiler">Alquiler</option>
                                             </select><br/>
            <label>Número de metros:</label><input type="text" name="metros" id="metrosAnuncio"/><small>m<sup>2</sup></small>
            <label>Número de habitaciones:</label><input type="text" name="habitaciones" id="habitacionesAnuncio"/>
            <label>Número de aseos:</label><input type="text" name="aseos" id="aseosAnuncio"/><br/>
            <label>Descripción:</label><br/>
            <textarea name="descripcion" id="descripcionAnuncio"></textarea><br/>
            <label>Calle:</label><input type="text" name="calle" id="calleAnuncio" required/>
            <label>Número:</label><input type="text" name="numero" id="numeroAnuncio" required/>
            <label>Planta:</label><input type="text" name="planta" id="plantaAnuncio"/><br/>
            <label>Localidad:</label><input type="text" name="localidad" id="localidadAnuncio" required/>
            <label>Provincia:</label><input type="text" name="provincia" id="provinciaAnuncio" required/><br/>
            <label>C usuario:</label></label><input type="text" name="cp" id="cpAnuncio" required=/>
            <label>Imagenes:</label></label><input type="file" name="img[]" id="imgAnuncio"/>
            <input type="hidden" name="id" id="idAnuncio" />
            
            <input type="submit" name="accion" value="Agregar" class="boton" id="agregar"/><br/>
            <input type="submit" name="accion" value="Editar" class="boton" id="editar"/><br/>
            <input type="submit" name="accion" value="Eliminar" class="boton" id="eliminar"/><br/>
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
