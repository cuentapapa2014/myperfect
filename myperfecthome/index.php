<?php
require './clases/Leer.php';
require './clases/BaseDatos.php';
require './clases/Configuracion.php';
require './clases/ModeloAnuncio.php';
require './clases/Anuncio.php';

$operacion = Leer::get('op');
$producto = Leer::get('pr');
$precio = Leer::get('prc');
$localidad = Leer::get('l');
$provincia = Leer::get('prv');
$metros = Leer::get('m');
$habitaciones = Leer::get('h');
$condicion="1=1";
$parametros = array();

if(!empty($operacion) && $operacion!=null){
    $condicion=$condicion." and operacion=:operacion";
    $parametros['operacion']=$operacion;
}
if(!empty($producto) && $producto!=null){
    $condicion =$condicion." and producto=:producto";
    $parametros['producto'] = $producto;
}
if(!empty($precio) && $precio!=null){
    $condicion = $condicion." and precio<=:precio";
    $parametros['precio']=$precio;
}
if(!empty($localidad) && $localidad!=null){
    $condicion =$condicion." and localidad=:localidad";
    $parametros['localidad']=$localidad;
}
if(!empty($provincia) && $provincia!=null){
    $condicion =$condicion." and provincia=:provincia";
    $parametros['provincia'] = $provincia;
}
if(!empty($metros) && $metros!=null){
    $condicion =$condicion." and metros >= :metros";
    $parametros['metros']=$metros;
}
if(!empty($habitaciones)){
    $condicion +=$condicion." and habitaciones >= :habitaciones";
    $parametros['habitaciones']=$habitaciones;
}

$bd = new BaseDatos();
$modeloAnuncio = new ModeloAnuncio($bd);

$anuncios = $modeloAnuncio->getList($condicion, $parametros,"1");
?>
<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="estilo/mainlstyle.css"/>
        <link rel="stylesheet" href="estilo/estiloindex.css"/>
        <title>
            My perfect home
        </title>
    </head>
    <body>
        <header>
            <div id="containsheader">
                <img src="img/logo.gif" id="logo"/>
                
            </div>
        </header>
        <div id="contains">
            <section id="productbox">
                <table id="articulos">
                    <?php
                    foreach ($anuncios as $value) {
                        $img="img/casa.JPG";
                        $handle = opendir('img');
                        while (false !== ($entry = readdir($handle))) {
                            
                            if ($entry != "." && $entry != ".." && strstr($entry, $value->getId()."_")) {
                                $img="img/$entry";
                            }
                        }
                        closedir($handle);
                        ?>

                        <tr>
                            <td><img class="imagenfront "src=<?php echo $img?>></td>
                            <td class="anunciofront"><a href="frontend/detalle.php?id=<?php echo $value->getId()?>"><?php echo $value->getTitulo()?></a></td>
                            <td class="anunciofront right"><?php echo $value->getPrecio() ?></td>
                        </tr>   
<?php } ?>
                </table>
            </section>
            <section id="parameterbox">
                <div id="tituloFiltro"><h4>Filtrar resultados</h4></div>
                <form method="post" action="frontend/filtrar.php">
                    <label>Operacion:</label><select name="operacion" id="tipoOperacionAnuncio">
                        <option value="venta">Venta</option>
                        <option value="alquiler">Alquiler</option>
                    </select><br/>
                    <label>Tipo articulo:</label><select name="tipo" id="tipoProductoAnuncio">
                        <option value="apartamento">Apartamento</option>
                        <option value="apartamento">Piso</option>
                        <option value="apartamento">Casa</option>
                        <option value="apartamento">Bajo</option>
                        <option value="apartamento">Rústico</option>
                        <option value="apartamento">Industrial</option>
                    </select><br/>
                    <label>Precio maximo:</label><input type="text" name="precio" id="precioMaximo"/><br/>
                    <label>Localidad:</label><input type="text" name="localidad" id="textoLocalidad"/><br/>
                    <label>Provincia:</label><input type="text" name="provincia" id="textoProvincia"/><br/>
                    <label>Metros:</label><input type="text" name="metros" id="textoMetros"/><br/>
                    <label>Habitaciones:</label><input type="text" name="habitaciones" id="textoHabitaciones"/><br/>

                    <input type="submit" value="Filtrar" id="botonFiltrar"/>              
                </form>
            </section>
        </div>
        <footer>
            <p>Martin de Martin Santiago</p>
        </footer>
    </div>
</body>
</html>

<?php
$bd->closeConesxion();
?>