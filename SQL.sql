-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.11-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para bancolibros
CREATE DATABASE IF NOT EXISTS `bancolibros` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `bancolibros`;

-- Volcando estructura para tabla bancolibros.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `DNI` int(11) NOT NULL,
  KEY `DNI` (`DNI`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `usuarios` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla bancolibros.admin: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
REPLACE INTO `admin` (`DNI`) VALUES
	(22222222);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Volcando estructura para tabla bancolibros.ciclos
CREATE TABLE IF NOT EXISTS `ciclos` (
  `IDciclo` int(11) NOT NULL AUTO_INCREMENT,
  `Ciclo` varchar(50) NOT NULL,
  PRIMARY KEY (`IDciclo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla bancolibros.ciclos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ciclos` DISABLE KEYS */;
REPLACE INTO `ciclos` (`IDciclo`, `Ciclo`) VALUES
	(1, 'Sistemas Microinformaticos y Redes');
/*!40000 ALTER TABLE `ciclos` ENABLE KEYS */;

-- Volcando estructura para tabla bancolibros.editoriales
CREATE TABLE IF NOT EXISTS `editoriales` (
  `IDeditorial` int(11) NOT NULL AUTO_INCREMENT,
  `Editorial` varchar(50) NOT NULL,
  PRIMARY KEY (`IDeditorial`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla bancolibros.editoriales: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `editoriales` DISABLE KEYS */;
REPLACE INTO `editoriales` (`IDeditorial`, `Editorial`) VALUES
	(2, 'Edebe'),
	(4, 'Anaya'),
	(6, 'Mcgraw hill'),
	(7, 'Express Publishing'),
	(10, 'Edelvives'),
	(11, 'SM');
/*!40000 ALTER TABLE `editoriales` ENABLE KEYS */;

-- Volcando estructura para tabla bancolibros.libros
CREATE TABLE IF NOT EXISTS `libros` (
  `IDlibro` int(11) NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(17) NOT NULL,
  `Titulo` varchar(50) NOT NULL,
  `IDeditorial` int(11) NOT NULL,
  `IDmodulo` int(11) NOT NULL,
  `IDusuario` int(11) NOT NULL,
  `Precio` double NOT NULL DEFAULT 0,
  `Vendido` tinyint(1) NOT NULL,
  `Foto` varchar(100) DEFAULT NULL,
  `Fecha` datetime NOT NULL,
  `Comentarios` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IDlibro`),
  KEY `IDmodulo` (`IDmodulo`),
  KEY `IDeditorial` (`IDeditorial`),
  KEY `FK_libros_usuarios` (`IDusuario`),
  CONSTRAINT `FK_libros_usuarios` FOREIGN KEY (`IDusuario`) REFERENCES `usuarios` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`IDmodulo`) REFERENCES `modulos` (`IDmodulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`IDeditorial`) REFERENCES `editoriales` (`IDeditorial`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla bancolibros.libros: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `libros` DISABLE KEYS */;
REPLACE INTO `libros` (`IDlibro`, `ISBN`, `Titulo`, `IDeditorial`, `IDmodulo`, `IDusuario`, `Precio`, `Vendido`, `Foto`, `Fecha`, `Comentarios`) VALUES
	(84, '9788448183943', 'Sistemas Operativos en Red', 6, 1, 22222222, 29.99, 1, '5e5397e676c82sor.jpg', '2020-02-24 10:31:18', ''),
	(85, '9788468345666', 'Empresa e Iniciativa Emprendedora', 2, 1, 22222222, 29.99, 1, '5e53984e9cfc5file.jpg', '2020-02-24 10:33:02', ''),
	(86, '9781471562518', 'Computing', 7, 1, 22222222, 15, 1, '5e539896a2e61computing.jpg', '2020-02-24 10:34:14', '');
/*!40000 ALTER TABLE `libros` ENABLE KEYS */;

-- Volcando estructura para tabla bancolibros.mensajes
CREATE TABLE IF NOT EXISTS `mensajes` (
  `IDmensaje` int(11) NOT NULL AUTO_INCREMENT,
  `Desde` int(11) NOT NULL,
  `Para` int(11) NOT NULL,
  `IDlibro` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Mensaje` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`IDmensaje`),
  KEY `FK_mensajes_libros` (`IDlibro`),
  KEY `FK_mensajes_usuarios` (`Desde`),
  KEY `FK_mensajes_usuarios_2` (`Para`),
  CONSTRAINT `FK_mensajes_libros` FOREIGN KEY (`IDlibro`) REFERENCES `libros` (`IDlibro`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_mensajes_usuarios` FOREIGN KEY (`Desde`) REFERENCES `usuarios` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_mensajes_usuarios_2` FOREIGN KEY (`Para`) REFERENCES `usuarios` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla bancolibros.mensajes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;

-- Volcando estructura para tabla bancolibros.modulos
CREATE TABLE IF NOT EXISTS `modulos` (
  `IDmodulo` int(11) NOT NULL AUTO_INCREMENT,
  `Modulo` varchar(50) NOT NULL,
  `IDciclo` int(11) NOT NULL,
  PRIMARY KEY (`IDmodulo`),
  KEY `IDciclo` (`IDciclo`),
  CONSTRAINT `FK_modulos_ciclos` FOREIGN KEY (`IDciclo`) REFERENCES `ciclos` (`IDciclo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla bancolibros.modulos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
REPLACE INTO `modulos` (`IDmodulo`, `Modulo`, `IDciclo`) VALUES
	(1, 'Sistemas Operativos en Red', 1),
	(3, 'Sistemas Operativos Monopuestos', 1),
	(8, 'Inglés', 1);
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;

-- Volcando estructura para tabla bancolibros.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `DNI` int(8) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  `Apellido` varchar(25) NOT NULL,
  `Movil` int(9) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  PRIMARY KEY (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla bancolibros.usuarios: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
REPLACE INTO `usuarios` (`DNI`, `Nombre`, `Apellido`, `Movil`, `email`, `pass`) VALUES
	(22222222, 'Prueba', 'Holamudo', 111111111, 'prueba@gmail.com', '$2y$10$6nTm4OaqqHNIPJr1459Ln.f8F05OhmZvDJCHareFeLy/LaGJwQMf.');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
