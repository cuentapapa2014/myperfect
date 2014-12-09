<?php
require '../require/comun.php';

$operacion = Leer::post('operacion');
$producto = Leer::post('tipo');
$precio = Leer::post('precio');
$localidad = Leer::post('localidad');
$provincia = Leer::post('provincia');
$metros = Leer::post('metros');
$habitaciones = Leer::post('habitaciones');

header("Location:../index.php?op=$operacion&pr=$producto&prc=$precio&l=$localidad&prv=$provincia&m=$metros&h=$habitaciones");
exit();
