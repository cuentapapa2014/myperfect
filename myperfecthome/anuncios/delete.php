<?php

require '../require/comun.php';

$id = Leer::post('id');
echo"$id";
$bd = new BaseDatos();
$modelo = new ModeloAnuncio($bd);
$r = $modelo->deletePorId($id);
echo $r;
header("Location:view.php?res=$r");
exit();

