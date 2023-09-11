<?php
   require_once "../modelo/articulos_familia.php";

   $datos = new Articulos_Familia();
   $jsondata[] = $datos->agregar($_POST);
   echo json_encode($jsondata);
?>    