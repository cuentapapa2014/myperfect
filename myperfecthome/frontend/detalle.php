<?php
require '../require/comun.php';
$id = Leer::get('id');
$bd = new BaseDatos();
$modeloAnunciante = new ModeloAnunciante($bd);
$modeloAnuncio = new ModeloAnuncio($bd);
$anuncio = $modeloAnuncio->get($id);
$anunciante = $modeloAnunciante->get($anuncio->getIdAnunciante());
$imagenes = array();
$handle = opendir('../img');
while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != ".." && strstr($entry, $anuncio->getId() . "_")) {
        $imagenes[] = "../img/$entry";
    }
}
closedir($handle);
?>
<!DOCTYPE html>

<html>
    <head>
        <title>My Perfect home</title>
        <link rel="stylesheet" href="../estilo/mainlstyle.css"/>
        <link rel="stylesheet" href="../estilo/estilodetalle.css"/>
    </head>
    <body>
        <header>
            <div id="containsheader">
                <img src="../img/logo.gif" id="logo"/>
                <nav id="enlaces">
                    <a href="../index.php" class="navigation">VOLVER</a>
                </nav>
            </div>
        </header>
        <div id="contains">
            <div id="titulo">
                <h2 id="tituloAnuncio"><?php echo $anuncio->getTitulo() ?></h2>
            </div>
            <div id="galeria" >
               
                <?php 
                if(count($imagenes)>0){
                    foreach ($imagenes as $value) { ?>
                    <img src="<?php echo $value ?>" class="imggaleria"><br/>
                    <p><?php echo $anuncio->getDescripcion()?></p>
                <?php } }else{?>
                    <img src="../img/casa.JPG" class="imggaleria"><br/>
                    <p id="pdescripcion"><?php echo $anuncio->getDescripcion()?></p>
                    <p class="pcontacto">Contactar con:</p>
                    <p class="pcontacto">Nombre:<span id="spannombre"><?php echo $anunciante->getNombre()?></span></p>
                    <p class="pcontacto">Apellidos:<span id="spanapellidos"> <?php echo $anunciante->getApellidos()?></span></p>
                    <p class="pcontacto">Telefono:<span id="spantfn"><?php echo $anunciante->getTelefono()?></span></p>
                    <p class="pcontacto">email:<span id="spanmail"><?php echo $anunciante->getEmail()?></span></p>
               <?php }
?>
            </div>
            <div id="detallesanuncio">
                <p class="parrafodetalle">Precio:<span id="spanprecio"><?php echo $anuncio->getPrecio()?><span></p>
                            <p class="parrafodetalle">Operacion:<span id="spanoperacion"><?php echo $anuncio->getOperacion()?></span></p>
                            <p class="parrafodetalle">Tipo:<span id="spanproducto"><?php echo $anuncio->getProducto()?></span></p>
                            <p class="parrafodetalle">Superficie:<span id="spanmetros"><?php echo $anuncio->getMetros()?></span></p>
                            <p class="parrafodetalle">Habitaciones:<span id="spanhab"><?php echo $anuncio->getHabitaciones()?></span></p>
                            <p class="parrafodetalle">Aseos:<span id="spanas"><?php echo $anuncio->getAseos()?></span></p>
                            <p class="parrafodetalle">Calle:<span id="spancalle"><?php echo $anuncio->getCalle()?></span></p>
                            <p class="parrafodetalle">Localidad:<span id="spanloc"><?php echo $anuncio->getLocalidad()?></span></p>
                            <p class="parrafodetalle">Provincia:<span id="spanprov"><?php echo $anuncio->getProvincia()?></span></p>
            </div>
        </div>
        <footer>
            <p>Martin de Martin Santiago</p>
        </footer>
    </body>
</html>
<?php
$bd->closeConesxion();
?>