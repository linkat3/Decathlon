<?php
   require_once "../modelo/familias.php";

   $datos = new Familias();
   $jsondata[] = $datos->lista_familia($_POST);
   echo json_encode($jsondata);
?>    