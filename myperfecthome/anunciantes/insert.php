<?php
require '../require/comun.php';

$nif = Leer::post('nif');
$nombre = Leer::post('nombre');
$apellidos = Leer::post('apellidos');
$telefono = Leer::post('telefono');
$email = Leer::post('email');

$bd = new BaseDatos();
$modelo = new ModeloAnunciante($bd);
$r = $modelo->add(new Anunciante(NULL, $nif, $nombre, $apellidos, $telefono, $email));

header("Location:view.php?res=$r");
exit();

