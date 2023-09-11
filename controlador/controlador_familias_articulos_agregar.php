<?php
   require_once "../modelo/familias.php";

   $datos = new Familias();
   $jsondata[] = $datos->agregar($_POST);
   echo json_encode($jsondata);
?>    