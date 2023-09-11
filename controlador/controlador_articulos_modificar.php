<?php
   require_once "../modelo/articulos.php";

   $datos = new Articulos();
   $jsondata[] = $datos->modificar($_POST);
   echo json_encode($jsondata);
?>    