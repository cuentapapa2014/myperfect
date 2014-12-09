<?php

require '../require/comun.php';
$id = Leer::post('id');
$titulo = Leer::post('titulo');
$precio = Leer::post('precio');
$tipo = Leer::post('tipo');
$operacion = Leer::post('operacion');
$metros = Leer::post('metros');
$habitaciones = Leer::post('habitaciones');
$aseos = Leer::post('aseos');
$descripcion = Leer::post('descripcion');
$calle = Leer::post('calle');
$numero = Leer::post('numero');
$planta = Leer::post('planta');
$localidad = Leer::post('localidad');
$provincia = Leer::post('provincia');
$cp = Leer::post('cp');

$bd = new BaseDatos();
$modelo = new ModeloAnuncio($bd);
$anuncio = new Anuncio($id,$titulo,$descripcion,$tipo,$metros, $habitaciones, $aseos, 
                              $calle, $numero, $planta, $localidad, $provincia, $operacion, $precio, $cp);
$r = $modelo->edit($anuncio);

header("Location:view.php?res=$r");
exit();

