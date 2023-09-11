<?php
    //Datos requeridos
    // Servidor, nombre de la BBDD,usuario y contraseña
    class DB
    {
        private $servidor;
        private $puerto;
        private $base;
        private $usuario;
        private $contraseña;
        private $charset;
        private $opciones = array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION);

        function __construct()
        {
            $this->servidor = "127.0.0.1";
            $this->puerto = "3306";
            $this->base = "decathlon";
            $this->usuario = "root";
            $this->contraseña = "";
            $this->charset="utf8";
        }

        public function conexion() {
            try{
                $conecta = new PDO("mysql:host=$this->servidor:$this->puerto;dbname=$this->base;charset=$this->charset",$this->usuario,$this->contraseña,$this->opciones);
                return $conecta;
            }catch (PDOexception $e){
                echo 'Error de conexion :'.$e->getMessage();
                exit;
            }
        }
    }
?>