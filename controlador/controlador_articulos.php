<?php
   require_once "../modelo/articulos.php";

   $datos = new Articulos();
   $jsondata[] = $datos->listar($_POST);
   echo json_encode($jsondata);
?>  
