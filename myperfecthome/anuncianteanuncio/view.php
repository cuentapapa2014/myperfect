<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Administración</title>
        <link rel="stylesheet" href="../estilo/estiloanuncios.css"/>
        <script src="../js/imagenes.js"></script>
    </head>
    <body>
        <header>
            <div id="contenidoheader">
                <h3>Consola de administración</h3>
            </div>
        </header>
        <div id="contenido">
            <div id="imagenesAnuncios">
                <table id="tablaimagenes">
                    
                </table>
            </div>
            <form>
                <label>Contacto</label><br/>
                <label>NIF:</label><input type="text" name="nif" id="nifAnuncio"/><input type="file" name="fotos[]" id="imagenes"/><br/>
                <label>Nombre:</label></label><input type="text" name="nombre" id="nombreAnuncio"/><label>Apellidos:</label><input type="text" name="apellidos" id="apellidosAnuncio"/><br/>
                <label>Telefono:</label><input type="text" name="telefono" id="telefonoAnuncio"/><label>email</label><input type="text" name="email" id="emailAnuncio"/><br/>
                <label>Titulo del anuncio:</label><input type="text" name="titulo" id="tituloAnuncio"/><br/>
                <label>Precio:</label><input type="text" name="precio" id="precioAnuncio"/>
                <label>Producto:</label><select name="tipo" id="tipoProductoAnuncio">
                    <option value="apartamento">Apartamento</option>
                    <option value="apartamento">Piso</option>
                    <option value="apartamento">Casa</option>
                    <option value="apartamento">Bajo</option>
                    <option value="apartamento">Rustico</option>
                    <option value="apartamento">Industrial</option>
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
                <label>Calle:</label><input type="text" name="calle" id="calleAnuncio"/>
                <label>Número:</label><input type="text" name="numero" id="numeroAnuncio"/>
                <label>Planta:</label><input type="text" name="planta" id="plantaAnuncio"/><br/>
                <label>Localidad:</label><input type="text" name="localidad" id="localidadAnuncio"/>
                <label>Provincia:</label><input type="text" name="provincia" id="provinciaAnuncio"/>
                <label>CP:</label><input type="text" name="cp" id="cpAnuncio"/><br/>
                <input type="submit" value="Aceptar"/><input type="reset" value="Borrar"/>

            </form>
            <?php
            // put your code here
            ?>
            <footer>

            </footer>
    </body>
</html>
