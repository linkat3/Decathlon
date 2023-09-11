<?php
    require_once "db.php";

    class Familias
    {
        private $pdo;

        public function __construct() {
            try {
                $this->pdo = new DB;
            } catch (PDOException $e) {
              echo $e;
            }
        }
        // Obtiene todos los datos de la tabla de comentarios
        public function listar() {
            try {
                $resultado = $this->pdo->conexion()->prepare("SELECT * FROM familias order by familias.familia");
                $resultado->execute();
                return $resultado->fetchall(PDO::FETCH_OBJ);
            } catch (Exception $e){
                echo $e->getMessage();
            }
        }

        public function listar_familias_articulo($post) {
            $codigoArticulo = $post["codigoArticulo"];
            try {
                $resultado = $this->pdo->conexion()->prepare("select familias.cod_familia,familias.familia from familias inner join articulos_familia on familias.cod_familia = articulos_familia.cod_familia where articulos_familia.cod_articulo = :codigoArticulo ");
                $resultado->bindValue(':codigoArticulo',$codigoArticulo,PDO::PARAM_INT);
                $resultado->execute();
                return $resultado->fetchall(PDO::FETCH_OBJ);
            } catch (Exception $e){
                echo $e->getMessage();
            }
        }
        public function agregar($post){
            try {
                var_dump($post);
                $id = intval($post["id"]);
                $categorias = $post["categoria"];
                $resultado = $this->pdo->conexion()->prepare("call alta_peli_categorias(:id,:categorias);");
                $resultado->bindValue(':id',$id,PDO::PARAM_INT);
                $resultado->bindValue(':categorias',$categorias,PDO::PARAM_STR);
                $resultado->execute();
                return $resultado->fetch(PDO::FETCH_OBJ);
            } catch (Exception  $e){
                echo $e->getMessage();
            }
        }
    }
?>
