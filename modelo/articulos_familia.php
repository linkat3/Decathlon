<?php
    require_once "db.php";

    class Articulos_Familia
    {
        private $pdo;

        public function __construct() {
            try {
                $this->pdo = new DB;
            } catch (PDOException $e) {
              echo $e;
            }
        }
       
        public function agregar($post){
            try {
                $codigo = $post["codigo"];
                $familias = $post["familias"];
                $resultado = $this->pdo->conexion()->prepare("call alta_articulo_familias(:codigo,:familias);");
                $resultado->bindValue(':codigo',$codigo,PDO::PARAM_INT);
                $resultado->bindValue(':familias',$familias,PDO::PARAM_STR);
                $resultado->execute();
                return $resultado->fetch(PDO::FETCH_OBJ);
            } catch (Exception  $e){
                echo $e->getMessage();
            }
        }

     

    }
?>
