<?php
   require_once "../modelo/familias.php";

   $datos = new Familias();
   $jsondata[] = $datos->listar_familias_articulo($_POST);
   echo json_encode($jsondata);
?>    