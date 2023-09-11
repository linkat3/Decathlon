-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 05:04 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `decathlon`
--
CREATE DATABASE IF NOT EXISTS `decathlon` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `decathlon`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `altarticulo` (IN `vararticulo` VARCHAR(30), IN `varprecio` FLOAT)   BEGIN
       	 insert into articulos (articulo,precio) values (vararticulo,varprecio);
         SELECT codigo FROM articulos WHERE codigo = (SELECT MAX(codigo) FROM articulos) ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_articulo_familias` (IN `codigo` INT, IN `familias` VARCHAR(1000))   BEGIN
    DECLARE start_pos SMALLINT;
    DECLARE comma_pos SMALLINT;
    DECLARE current_id int;
    DECLARE end_loop TINYINT;
    DECLARE contador int;
    SET contador = 0;
    SET start_pos = 1;
    SET comma_pos = locate(',', familias);
    delete from articulos_familia where articulos_familia.cod_articulo = codigo;
    REPEAT
        IF comma_pos > 0 THEN
            SET current_id = cast(substring(familias, start_pos, comma_pos - start_pos) as int);
            SET end_loop = 0;
        ELSE
            SET current_id = cast(substring(familias, start_pos) as int);
            SET end_loop = 1;
        END IF;
     	insert into articulos_familia (cod_articulo,cod_familia) values (codigo,current_id);
        SET contador = contador + 1;
        IF end_loop = 0 THEN
            SET familias = substring(familias, comma_pos + 1);
            SET comma_pos = locate(',', familias);
        END IF;
    UNTIL end_loop = 1
    END REPEAT;
    select concat("Articulo:",codigo," agregado correctamente con ",contador, " familias agregadas para el mismo") as respuesta;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `baja_articulo` (IN `idarticulo` INT)   BEGIN
   delete from articulos_familia where  cod_articulo = idarticulo;
   delete from articulos where  codigo = idarticulo;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `codigo` int(7) NOT NULL,
  `articulo` varchar(80) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`codigo`, `articulo`, `precio`) VALUES
(8316547, 'GORRO CON OREJERAS DE ESQUÍ ADULTO CRUISING  GRIS', '19.99'),
(8351925, 'Raqueta de Tenis Artengo TR100 Adulto Negro (265 GR)', '7.00'),
(8380453, 'Banco Musculación Plegable Inclinable Domyos 500', '79.00'),
(8492875, 'PANTALÓN CÁLIDO PERLANTE SENDERISMO NIEVE - SH100 ULTRA-WARM - HOMBRE', '9.00'),
(8493604, 'Zapatillas Impermeables Niños de Montaña y Trekking Quechua Crossrock 35 a 38', '29.00'),
(8494471, 'Cámara Trampeo 30MP con sistema DualLens Noche y Día', '179.00'),
(8495356, 'CINTURÓN PORTADORSAL DISTANCIA CORTA TRIATLÓN TALLAS S A XXXL', '5.00'),
(8500689, 'GUANTES MTB VERANO ROCKRIDER ST 100 NEGRO', '11.00'),
(8501381, 'Gafas de Sol Polarizadas Adulto Montaña y Senderismo Quechua MH140 Categoría 3', '19.00'),
(8503088, 'Bicicleta Estática sin cables autoalimentada Domyos Bike 500', '349.00'),
(8504168, 'Neopreno Surf Mujer 900 4/3 mm. Cierre Front Zip.', '159.00'),
(8529977, 'Gafas Running Runperf Adulto Negro Amarillo Fluorescente Fotocromáticas Cat. 1-3', '34.00'),
(8533913, 'Balón Fútbol Americano NFL FORCE Talla Oficial Adulto Marrón', '24.00'),
(8543296, 'Chándal niño niña Domyos 100 Warmy Zip transpirable gimnasia deportiva azul', '7.00'),
(8544555, 'Camiseta Protección Solar Surf Hombre Olaian 500 Fluorescente Estampada', '9.00'),
(8544852, 'Neopreno De Triatlón 3/2 mm Aptonia SD Hombre NEGRO', '98.00'),
(8546353, 'Zapatillas de pádel hombre PS 990 Dynamic M azul amarillo', '64.00'),
(8550719, 'Camiseta de Neopreno Manga Corta Subea 500 Mujer Turquesa', '14.00'),
(8551401, 'Zapatillas Hombre Caminar en Ciudad Actiwalk Comfort Leather Negro Piel', '44.00'),
(8553967, 'Mochila de Montaña y Trekking. Forclaz. Trek900 Symbium 50+10Litros. Hombre', '119.00'),
(8555624, 'Zapatillas Adidas Bebé primeros pasos Advantage blanco verde talla 19 al 27', '20.00'),
(8556616, 'BICICLETA ELÉCTRICA DE MONTAÑA ROCKRIDER EBIKE ST 520 27.5\" GRIS AMARILLO', '1799.00'),
(8560739, 'BICICLETA ELÉCTRICA DE MONTAÑA ROCKRIDER EBIKE ST 100 27.5\" AZUL', '999.00'),
(8560928, 'Botas de Montaña y Trekking Impermeables Niños Quechua Crossrock Azul Media Caña', '34.00'),
(8562891, 'Bañador Natación Jammer Fit Hombre Negro Amarillo', '24.00'),
(8573829, 'Chaqueta Acolchada Hombre Montaña y Trekking TREK 100 -5 °C Con Capucha Negro', '29.00'),
(8580105, 'Cinta de correr plegable eléctrica Domyos INCLINE RUN', '999.00'),
(8585189, 'MOCHILA TRANSICIÓN TRIATLÓN APTONIA 35L', '49.00'),
(8585277, 'Traje Canoa-Kayak Stand-Up Paddle LongJane Mujer Neopreno 2 mm', '39.00'),
(8585539, 'ZAPATILLAS DE TENIS ADIDAS TENSAUR NIÑOS NEGRO AZUL', '24.00'),
(8600146, 'Boya Natacón En Aguas Abiertas Zone 3 Alta Visibilidad', '29.00'),
(8602025, 'Mallas Largas Trail Running Hombre Negro', '29.00'),
(8605569, 'Pantalones Hombre de Montaña y Trekking Trek 500', '29.00'),
(8612880, 'Neopreno Surf Corto Mujer Olaian 900 1.5 mm. Sin Cremallera', '69.00'),
(8652554, 'Chándal niño niña Domyos Warmy Zip transpirable gimnasia deportiva negro rojo', '9.00'),
(8653714, 'Bañador Adidas Deportivo Natación Piscina Mujer Negro SH3RO ', '34.00'),
(8657031, 'Reloj GPS Conectado Garmin Vívoactive 4S Blanco Dorado', '249.00'),
(8661089, 'Chándal niña niño Adidas gimnasia deportiva negro rosa', '24.00'),
(8661327, 'Chándal Adidas niñas niños negro y blanco', '24.00'),
(9600020, 'Riñonera Tiro Al Plato Solognac 50 Cartuchos Gris', '19.00'),
(9608203, 'Zapatillas Baloncesto Tarmak Shield 500 Adulto Rojo Negro', '29.00'),
(9608216, 'patinete eletrico xiaomi 3 lit', '339.99'),
(9608217, 'Abcoaster', '199.00'),
(9608218, 'Electroestimulador Compex', '350.00'),
(9608219, 'Electroestimulador Bluetens', '199.00'),
(9608220, 'Electroestimulador Bluetens', '199.00'),
(9608221, 'Electroestimulador Bluetens', '199.00');

-- --------------------------------------------------------

--
-- Table structure for table `articulos_familia`
--

CREATE TABLE `articulos_familia` (
  `cod_articulo` int(7) NOT NULL,
  `cod_familia` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `articulos_familia`
--

INSERT INTO `articulos_familia` (`cod_articulo`, `cod_familia`) VALUES
(8316547, 2),
(8351925, 1),
(8380453, 5),
(8492875, 1),
(8492875, 3),
(8493604, 4),
(8494471, 4),
(8495356, 1),
(8500689, 2),
(8501381, 4),
(8503088, 5),
(8504168, 2),
(8529977, 2),
(8533913, 1),
(8543296, 4),
(8544555, 3),
(8544852, 1),
(8544852, 3),
(8546353, 3),
(8550719, 2),
(8551401, 3),
(8553967, 4),
(8555624, 4),
(8556616, 5),
(8560739, 1),
(8560928, 4),
(8562891, 3),
(8573829, 1),
(8573829, 3),
(8580105, 5),
(8585189, 1),
(8585277, 2),
(8585539, 4),
(8600146, 1),
(8600146, 5),
(8602025, 3),
(8605569, 3),
(8612880, 2),
(8652554, 4),
(8653714, 2),
(8657031, 4),
(8661089, 4),
(8661327, 4),
(9600020, 2),
(9600020, 5),
(9608203, 1),
(9608216, 1),
(9608216, 5),
(9608217, 5),
(9608218, 2),
(9608218, 3),
(9608218, 5),
(9608221, 1);

-- --------------------------------------------------------

--
-- Table structure for table `familias`
--

CREATE TABLE `familias` (
  `cod_familia` int(1) NOT NULL,
  `familia` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `familias`
--

INSERT INTO `familias` (`cod_familia`, `familia`) VALUES
(1, 'Deportes'),
(2, 'Mujer'),
(3, 'Hombre'),
(4, 'Niños'),
(5, 'Equipamiento');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `articulos_familia`
--
ALTER TABLE `articulos_familia`
  ADD PRIMARY KEY (`cod_articulo`,`cod_familia`),
  ADD KEY `cod_familia` (`cod_familia`);

--
-- Indexes for table `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`cod_familia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `codigo` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9608222;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articulos_familia`
--
ALTER TABLE `articulos_familia`
  ADD CONSTRAINT `articulos_familia_ibfk_2` FOREIGN KEY (`cod_familia`) REFERENCES `familias` (`cod_familia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `articulos_familia_ibfk_3` FOREIGN KEY (`cod_articulo`) REFERENCES `articulos` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
