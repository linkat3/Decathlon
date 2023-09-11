<?php
    require_once "db.php";

    class Articulos
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
        public function listar($post) {
            try {
                $filtro = $post["filtro"];
                $cod_familia = $post["cod_familia"];
                $pagina  = ($post["pagina"]-1)*12;
                if ($cod_familia == 0){
                    $resultado = $this->pdo->conexion()->prepare("SELECT distinct articulos.codigo,articulos.articulo,articulos.precio FROM articulos inner join articulos_familia on articulos.codigo = articulos_familia.cod_articulo where articulos.articulo like CONCAT('%', :filtro, '%') limit :pagina,12");
                } else {
                    $resultado = $this->pdo->conexion()->prepare("SELECT distinct articulos.codigo,articulos.articulo,articulos.precio FROM articulos inner join articulos_familia on articulos.codigo =
                    articulos_familia.cod_articulo where (articulos_familia.cod_familia = :cod_familia) and (articulos.articulo like CONCAT('%', :filtro, '%')) limit :pagina,12");
                    $resultado->bindValue(':cod_familia',$cod_familia,PDO::PARAM_STR);
                }
                $resultado->bindValue(':filtro',$filtro,PDO::PARAM_STR);
                $resultado->bindValue(':pagina',$pagina,PDO::PARAM_INT);
                $resultado->execute();
                return $resultado->fetchall(PDO::FETCH_OBJ);
            } catch (Exception $e){
                echo $e->getMessage();
            }
        }

        public function modificar($post){
            try {
                $codigo = $post["codigo"];
                $articulo = $post["articulo"];
                $precio = $post["precio"];
                $resultado = $this->pdo->conexion()->prepare ("update articulos set articulo= :articulo, precio = :precio 
                where codigo =:codigo");
                $resultado->bindValue(':codigo',$codigo,PDO::PARAM_INT);
                $resultado->bindValue(':articulo',$articulo,PDO::PARAM_STR);
                $resultado->bindValue(':precio',$precio,PDO::PARAM_STR);
                if($resultado->execute()){
                   //Aqui vamos a subir la imagen al sevidor en dos pasos
                   // Paso 1 definir el nuevo nombre de la imagen
                   // Paso 2 copiar la imagen al servidor
                   define ('SITE_ROOT', realpath(dirname(dirname(__FILE__))));
                   $uploaded_file_tmp  = $_FILES['cargaImagen']['tmp_name'];
                   $destdir = '/vista/imagenes/';
                   $filename = $post["codigo"].".jpg";
                   move_uploaded_file($uploaded_file_tmp, SITE_ROOT.$destdir.$filename);
                }
            } catch (Exception $e){
                echo $e->getMessage();
            }
        }

        public function agregar($post){
            try {
                
                $articulo = $post["articulo"];
                $precio = $post["precio"];
                $resultado = $this->pdo->conexion()->prepare("call altarticulo(:articulo,:precio);");
              
                $resultado->bindValue(':articulo',$articulo,PDO::PARAM_STR);
                $resultado->bindValue(':precio',$precio,PDO::PARAM_STR);
                if($resultado->execute()){
                    //    Aqui vamos a subir la imagen al sevidor en dos pasos
                    //    Paso 1 definir el nuevo nombre de la imagen
                    //    Paso 2 copiar la imagen al servidor
                       $respuesta = $resultado->fetch(PDO::FETCH_OBJ);
                       define ('SITE_ROOT', realpath(dirname(dirname(__FILE__))));
                       $uploaded_file_tmp  = $_FILES['cargaImagen']['tmp_name'];
                       $destdir = '/vista/imagenes/';
                       $filename = $respuesta->codigo.".jpg";
                       move_uploaded_file($uploaded_file_tmp, SITE_ROOT.$destdir.$filename);
                }
                return json_encode($respuesta);
            } catch (Exception  $e){
                echo $e->getMessage();
            }
        }

        public function contar($post) {
            try {
                $filtro = $post["filtro"];
                $cod_familia = $post["cod_familia"];
                if ($cod_familia == 0){
                    $resultado = $this->pdo->conexion()->prepare("SELECT count(distinct(articulos.codigo)) as cantidad FROM articulos inner join articulos_familia on articulos.codigo =
                    articulos_familia.cod_articulo where articulos.articulo like CONCAT('%', :filtro, '%')");
                } else {
                    $resultado = $this->pdo->conexion()->prepare("SELECT count(distinct(articulos.codigo)) as cantidad FROM articulos inner join articulos_familia on articulos.codigo =
                    articulos_familia.cod_articulo where (articulos_familia.cod_familia = :cod_familia) and (articulos.articulo like CONCAT('%', :filtro, '%'))");
                    $resultado->bindValue(':cod_familia',$cod_familia,PDO::PARAM_STR);
                }
                $resultado->bindValue(':filtro',$filtro,PDO::PARAM_STR);
                $resultado->execute();
                return $resultado->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e){
                echo $e->getMessage();
            }
        }

        public function eliminar($post){
            try {
                $codigo = $post["codigo"];
                $resultado = $this->pdo->conexion()->prepare("call baja_articulo(:codigo)");
                $resultado->bindValue(':codigo',$codigo,PDO::PARAM_INT);
                if ($resultado->execute()){
                    //Aqui vamos a borrar la imagen del articulo
                    unlink("../vista/imagenes/".$codigo.".jpg");
                    return $resultado->fetch(PDO::FETCH_OBJ);
                }
            } catch (Exception $e){
                echo $e->getMessage();
            }
        } 
       
    }
?>
