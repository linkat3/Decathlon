<?php
   require_once "../modelo/articulos.php";

   $datos = new Articulos();
   $jsondata[] = $datos->eliminar($_POST);
   echo json_encode($jsondata);
?>    