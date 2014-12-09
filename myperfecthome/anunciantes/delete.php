<?php

require '../require/comun.php';

$id = Leer::post('id');

$bd = new BaseDatos();
$modelo = new ModeloAnunciante($bd);
$r = $modelo->deletePorId($id);

header("Location:view.php?res=$r");
exit();

