-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2014 a las 03:19:13
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `compdig`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `resultado_estudiante`(IN `encuestado` CHAR(15))
    DETERMINISTIC
begin
select FA.id,
FA.nombre,
PR.id,
PR.nombre,
SE.nivel,
PRS.identificacion,
PRS.nombre,
PRS.apellido,
CP.id,
CP.nombre,
    
(select sum(respuestas.valor) from respuestas 
	inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres on (personas_programas_semestres.persona_id = PNS.id)
 	where PNS.id=PRS.id   
 	group by CPS.id having CPS.id=CP.id LIMIT 1) as totalcompetencia,
    
(select count(preguntas.id) from preguntas 
	inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    group by CPS.id having CPS.id = CP.id LIMIT 1) as preguntascompetencia,
    
truncate(((select sum(respuestas.valor) from respuestas 
	inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres on (personas_programas_semestres.persona_id = PNS.id)
 	where PNS.id=PRS.id   
 	group by CPS.id having CPS.id=CP.id LIMIT 1)/
          (select count(preguntas.id) from preguntas 
	inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    group by CPS.id having CPS.id = CP.id LIMIT 1)),2) as valorcompetencia,
dominios.id,dominios.nombre,
# Deseamos calcular el puntaje por el nivel de dominio             
sum(respuestas.valor) as puntajetotaldominio,

# Es la cantidad de preguntas por el nivel de dominio
count(preguntas.id) as preguntasdominio,

# Calculamos el puntaje de 0-5 del nivel de dominio
(truncate((sum(respuestas.valor)/count(preguntas.id)),2))as puntajeescaladominio,
#Concepto del puntaje
(select escalas.concepto from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as concepto,
#Color del puntaje
(select escalas.color from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as color

from respuestas inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
	inner join dominios on (preguntas.dominio_id = dominios.id) 
	inner join competencias CP on (dominios.competencia_id=CP.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas  PRS on (personas_cuestionarios.persona_id = PRS.id) 
    inner join personas_programas_semestres on (personas_programas_semestres.persona_id = PRS.id)
    inner join programas PR on (personas_programas_semestres.programa_id = PR.id)
    inner join semestres SE on (personas_programas_semestres.semestre_id = SE.id)
    inner join facultades FA on (PR.facultad_id = FA.id)
    where PRS.identificacion = encuestado
    group by PRS.id,dominios.id order by FA.nombre asc,PR.nombre asc,SE.nivel asc,PRS.apellido asc,CP.orden asc,dominios.orden asc,preguntas.orden asc;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `resultado_facultad`(IN `facultad` INT(15))
begin
select FA.id,
FA.nombre,
PR.id,
PR.nombre,
SE.nivel,
PRS.identificacion,
PRS.nombre,
PRS.apellido,
CP.id,
CP.nombre,
    
(select sum(respuestas.valor) from respuestas 
    inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
    inner join programas PRS on (PPS.programa_id = PRS.id)
    inner join semestres SES on (PPS.semestre_id = SES.id)
    inner join facultades FAS on (PRS.facultad_id = FAS.id)
    where FA.id = facultad
    group by CPS.id having CPS.id=CP.id LIMIT 1) as totalcompetencia,
    
(select count(respuestas.id) from respuestas 
    inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
    inner join programas PRS on (PPS.programa_id = PRS.id)
    inner join semestres SES on (PPS.semestre_id = SES.id)
    inner join facultades FAS on (PRS.facultad_id = FAS.id)
    where FA.id = facultad
    group by CPS.id having CPS.id=CP.id LIMIT 1) as preguntascompetencia,    
    
(truncate(((select sum(respuestas.valor) from respuestas 
    inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
    inner join programas PRS on (PPS.programa_id = PRS.id)
    inner join semestres SES on (PPS.semestre_id = SES.id)
    inner join facultades FAS on (PRS.facultad_id = FAS.id)
    where FA.id = facultad
    group by CPS.id having CPS.id=CP.id LIMIT 1)/
          (select count(respuestas.id) from respuestas 
    inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
    inner join programas PRS on (PPS.programa_id = PRS.id)
    inner join semestres SES on (PPS.semestre_id = SES.id)
    inner join facultades FAS on (PRS.facultad_id = FAS.id)
           where FA.id = facultad
    group by CPS.id having CPS.id=CP.id LIMIT 1)),2)) as valorcompetencia,
    
dominios.id,dominios.nombre,
# Deseamos calcular el puntaje por el nivel de dominio             
sum(respuestas.valor) as puntajetotaldominio,

# Es la cantidad de preguntas por el nivel de dominio
count(preguntas.id) as preguntasdominio,

# Calculamos el puntaje de 0-5 del nivel de dominio
(truncate((sum(respuestas.valor)/count(preguntas.id)),2))as puntajeescaladominio,
#Concepto del puntaje
(select escalas.concepto from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as concepto,
#Color del puntaje
(select escalas.color from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as color

from respuestas inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CP on (dominios.competencia_id=CP.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas  PRS on (personas_cuestionarios.persona_id = PRS.id) 
    inner join personas_programas_semestres on (personas_programas_semestres.persona_id = PRS.id)
    inner join programas PR on (personas_programas_semestres.programa_id = PR.id)
    inner join semestres SE on (personas_programas_semestres.semestre_id = SE.id)
    inner join facultades FA on (PR.facultad_id = FA.id)
    where FA.id = facultad
    group by dominios.id order by FA.nombre asc,PR.nombre asc,SE.nivel asc,PRS.apellido asc,CP.orden asc,dominios.orden asc,preguntas.orden asc;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `resultado_programa`(IN `programa` INT(15))
    NO SQL
begin
select FA.id,
FA.nombre,
PR.id,
PR.nombre,
SE.nivel,
PRS.identificacion,
PRS.nombre,
PRS.apellido,
CP.id,
CP.nombre,
    
(select sum(respuestas.valor) from respuestas 
	inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
 	where PPS.programa_id = programa
 	group by CPS.id having CPS.id=CP.id LIMIT 1) as totalcompetencia,
    
(select count(respuestas.id) from respuestas 
	inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
 	where PPS.programa_id = programa
 	group by CPS.id having CPS.id=CP.id LIMIT 1) as preguntascompetencia,    
    
(truncate(((select sum(respuestas.valor) from respuestas 
	inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
 	where PPS.programa_id = programa
 	group by CPS.id having CPS.id=CP.id LIMIT 1)/
          (select count(respuestas.id) from respuestas 
	inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
 	where PPS.programa_id = programa
 	group by CPS.id having CPS.id=CP.id LIMIT 1)),2)) as valorcompetencia,
    
dominios.id,dominios.nombre,
# Deseamos calcular el puntaje por el nivel de dominio             
sum(respuestas.valor) as puntajetotaldominio,

# Es la cantidad de preguntas por el nivel de dominio
count(preguntas.id) as preguntasdominio,

# Calculamos el puntaje de 0-5 del nivel de dominio
(truncate((sum(respuestas.valor)/count(preguntas.id)),2))as puntajeescaladominio,
#Concepto del puntaje
(select escalas.concepto from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as concepto,
#Color del puntaje
(select escalas.color from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as color

from respuestas inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
	inner join dominios on (preguntas.dominio_id = dominios.id) 
	inner join competencias CP on (dominios.competencia_id=CP.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas  PRS on (personas_cuestionarios.persona_id = PRS.id) 
    inner join personas_programas_semestres on (personas_programas_semestres.persona_id = PRS.id)
    inner join programas PR on (personas_programas_semestres.programa_id = PR.id)
    inner join semestres SE on (personas_programas_semestres.semestre_id = SE.id)
    inner join facultades FA on (PR.facultad_id = FA.id)
    where PR.id = programa
    group by dominios.id order by FA.nombre asc,PR.nombre asc,SE.nivel asc,PRS.apellido asc,CP.orden asc,dominios.orden asc,preguntas.orden asc;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `resultado_semestre_programa`(IN `semestre` INT(15), IN `programa` INT(15))
begin
select FA.id,
FA.nombre,
PR.id,
PR.nombre,
SE.nivel,
PRS.identificacion,
PRS.nombre,
PRS.apellido,
CP.id,
CP.nombre,
    
(select sum(respuestas.valor) from respuestas 
	inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
 	where PPS.programa_id = programa and PPS.semestre_id = semestre 
 	group by CPS.id having CPS.id=CP.id LIMIT 1) as totalcompetencia,
    
(select count(respuestas.id) from respuestas 
	inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
 	where PPS.programa_id = programa and PPS.semestre_id = semestre 
 	group by CPS.id having CPS.id=CP.id LIMIT 1) as preguntascompetencia,    
    
(truncate(((select sum(respuestas.valor) from respuestas 
	inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
 	where PPS.programa_id = programa and PPS.semestre_id = semestre 
 	group by CPS.id having CPS.id=CP.id LIMIT 1)/
          (select count(respuestas.id) from respuestas 
	inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
    inner join dominios on (preguntas.dominio_id = dominios.id) 
    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
 	where PPS.programa_id = programa and PPS.semestre_id = semestre 
 	group by CPS.id having CPS.id=CP.id LIMIT 1)),2)) as valorcompetencia,
    
dominios.id,dominios.nombre,
# Deseamos calcular el puntaje por el nivel de dominio             
sum(respuestas.valor) as puntajetotaldominio,

# Es la cantidad de preguntas por el nivel de dominio
count(preguntas.id) as preguntasdominio,

# Calculamos el puntaje de 0-5 del nivel de dominio
(truncate((sum(respuestas.valor)/count(preguntas.id)),2))as puntajeescaladominio,
#Concepto del puntaje
(select escalas.concepto from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as concepto,
#Color del puntaje
(select escalas.color from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as color

from respuestas inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
	inner join dominios on (preguntas.dominio_id = dominios.id) 
	inner join competencias CP on (dominios.competencia_id=CP.id) 
    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
    inner join personas  PRS on (personas_cuestionarios.persona_id = PRS.id) 
    inner join personas_programas_semestres on (personas_programas_semestres.persona_id = PRS.id)
    inner join programas PR on (personas_programas_semestres.programa_id = PR.id)
    inner join semestres SE on (personas_programas_semestres.semestre_id = SE.id)
    inner join facultades FA on (PR.facultad_id = FA.id)
    where PR.id = programa and SE.id = semestre
    group by dominios.id order by FA.nombre asc,PR.nombre asc,SE.nivel asc,PRS.apellido asc,CP.orden asc,dominios.orden asc,preguntas.orden asc;
    end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

CREATE TABLE IF NOT EXISTS `competencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `orden` int(11) NOT NULL,
  `cuestionario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cuestionario_id` (`cuestionario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `competencias`
--

INSERT INTO `competencias` (`id`, `nombre`, `descripcion`, `orden`, `cuestionario_id`) VALUES
(1, 'Uso de las TIC', 'Uso de las TIC', 1, 1),
(2, 'Gestión de Base de Datos', 'Gestión de Base de Datos', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionarios`
--

CREATE TABLE IF NOT EXISTS `cuestionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cuestionarios`
--

INSERT INTO `cuestionarios` (`id`, `titulo`, `descripcion`) VALUES
(1, 'Evaluación de las competencias digitales en la I.U.CESMAG.', 'Cuestionario para la evaluación de competencias en la Institución universitaria Centro de estudios superiores maria goretty.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominios`
--

CREATE TABLE IF NOT EXISTS `dominios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) CHARACTER SET latin1 NOT NULL,
  `descripcion` text CHARACTER SET latin1,
  `orden` int(11) NOT NULL,
  `competencia_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `competencia_id` (`competencia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `dominios`
--

INSERT INTO `dominios` (`id`, `nombre`, `descripcion`, `orden`, `competencia_id`) VALUES
(1, 'Primer nivel de dominio', NULL, 1, 1),
(2, 'Segundo nivel de dominio', NULL, 2, 1),
(3, 'Tercer nivel de domi', 'Tercer nivel de domi', 3, 1),
(4, 'Primer nivel de dominio', 'Primer nivel de dominio', 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escalas`
--

CREATE TABLE IF NOT EXISTS `escalas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Numero` int(11) NOT NULL,
  `porcentajeInicio` double NOT NULL,
  `porcentajeFin` double NOT NULL,
  `valorInicio` double NOT NULL,
  `valorFin` double NOT NULL,
  `color` varchar(10) NOT NULL,
  `concepto` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `escalas`
--

INSERT INTO `escalas` (`id`, `Numero`, `porcentajeInicio`, `porcentajeFin`, `valorInicio`, `valorFin`, `color`, `concepto`) VALUES
(1, 1, 20, 36, 1, 1.89, 'ff0000', 'Deficiente'),
(2, 2, 37, 53, 1.9, 2.69, 'F8BC39', 'Aceptable'),
(3, 3, 54, 70, 2.7, 3.59, 'EEF839', 'Bueno'),
(4, 4, 71, 87, 3.6, 4.39, 'C8F839', 'Sobresaliente'),
(5, 5, 88, 100, 4.4, 5.1, '6CF839', 'Excelente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultades`
--

CREATE TABLE IF NOT EXISTS `facultades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(60) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `facultades`
--

INSERT INTO `facultades` (`id`, `nombre`) VALUES
(1, 'Ingenieria'),
(2, 'Arquitectura y Bellas Artes'),
(3, 'Ciencias Administrativas y Contables'),
(4, 'Ciencias Sociales y Humanas'),
(5, 'EducaciÃ³n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vinculo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `icono` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `texto`, `vinculo`, `icono`, `menu_id`) VALUES
(1, 'Inicio', '/', '', 0),
(2, 'Menus', '/menus/', '', 0),
(3, 'Niveles', '/niveles/', '', 0),
(4, 'Asignar menus', '/menusniveles/', '', 0),
(5, 'Administrar usuarios', '/personas/', '', 0),
(7, 'Salir', '/menus/delmnu', '', 0),
(30, 'menus', '/menus/', '', 0),
(36, 'users', '/users/', '', 0),
(39, 'Realizar cuestionario', '/cuestionarios/responder', '', 0),
(40, 'Consultar resultado', '/cuestionarios/resultado_opciones', '', 0),
(41, 'Modificar Cuestionario', '/cuestionarios/edit/1', '', 0),
(42, 'Consultar resultado individual', '/cuestionarios/resultado_individual', '', 0),
(43, 'Consultar resultado semestre', '/cuestionarios/resultado_semestre', '', 0),
(46, 'Consultar resultado programa', '/cuestionarios/resultado_programa', '', 0),
(47, 'Consultar resultado facultad', '/cuestionarios/resultado_facultad', '', 0),
(48, 'Consultar resultado universidad', '/cuestionarios/resultado_universidad', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus_niveles`
--

CREATE TABLE IF NOT EXISTS `menus_niveles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `nivel_id` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `nivel_id` (`nivel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `menus_niveles`
--

INSERT INTO `menus_niveles` (`id`, `menu_id`, `nivel_id`, `orden`, `estado`) VALUES
(3, 1, 1, 1, 1),
(8, 5, 1, 6, 1),
(13, 7, 1, 7, 1),
(14, 41, 1, 2, 1),
(15, 40, 2, 2, 1),
(16, 39, 2, 1, 1),
(17, 7, 2, 3, 1),
(18, 40, 1, 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE IF NOT EXISTS `niveles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Tiene acceso total.'),
(2, 'Encuestado', 'Solo tiene permiso para realizar cuestionarios\r\n'),
(3, 'sa', 'as');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE IF NOT EXISTS `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tiposidentificacion_id` int(50) DEFAULT NULL,
  `identificacion` char(15) CHARACTER SET latin1 NOT NULL,
  `nombre` char(20) CHARACTER SET latin1 NOT NULL,
  `apellido` char(20) CHARACTER SET latin1 NOT NULL,
  `fecha de nacimiento` date NOT NULL,
  `email` char(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `identificacion` (`identificacion`) COMMENT 'unica',
  KEY `tiposidentificacion_id` (`tiposidentificacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=167 ;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `tiposidentificacion_id`, `identificacion`, `nombre`, `apellido`, `fecha de nacimiento`, `email`) VALUES
(32, 1, '1085288768', 'servio andres', 'pantoja', '0000-00-00', 'prueba@hotmail.com'),
(165, 1, '111', 'aaa', 'aaa', '1999-06-02', '111@hotmail.com'),
(166, 1, '222', 'bbb', 'bbb', '1999-06-14', '222@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_cuestionarios`
--

CREATE TABLE IF NOT EXISTS `personas_cuestionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha realizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `terminado` int(11) NOT NULL DEFAULT '0',
  `persona_id` int(11) DEFAULT NULL,
  `cuestionario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cuestionario_id` (`cuestionario_id`),
  KEY `persona_id` (`persona_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=119 ;

--
-- Volcado de datos para la tabla `personas_cuestionarios`
--

INSERT INTO `personas_cuestionarios` (`id`, `fecha realizacion`, `terminado`, `persona_id`, `cuestionario_id`) VALUES
(116, '2014-06-11 07:47:05', 0, 32, 1),
(117, '2014-06-15 05:32:42', 0, 165, 1),
(118, '2014-06-16 09:46:16', 1, 166, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_programas_semestres`
--

CREATE TABLE IF NOT EXISTS `personas_programas_semestres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `programa_id` int(11) NOT NULL,
  `semestre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `programa_id` (`programa_id`),
  KEY `semestre_id` (`semestre_id`),
  KEY `persona_id` (`persona_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `personas_programas_semestres`
--

INSERT INTO `personas_programas_semestres` (`id`, `persona_id`, `programa_id`, `semestre_id`) VALUES
(3, 32, 3, 2),
(33, 165, 3, 1),
(34, 166, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE IF NOT EXISTS `preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orden` int(2) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dominio_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dominio_id` (`dominio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `orden`, `titulo`, `dominio_id`) VALUES
(1, 0, 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T.', 1),
(2, 2, 'Abrahamcho firme y duro muy duro 2', 1),
(3, 4, '7asdsadas', 2),
(5, 32, '8', 3),
(8, 1, 'Abrahamcho firme y duro', 1),
(9, 33, 'Abrahamcho firm y duro 22', 1),
(10, 34, 'as', 1),
(11, 35, '6', 1),
(12, 36, '12', 4),
(13, 37, 'lolasoooasdsad', 4),
(15, 38, 'Abrahamcho gilll', 1),
(16, 39, '2222', 4),
(17, 40, 'Deficiente', 4),
(18, 41, 'Servio Andres', 4),
(19, 42, '111', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE IF NOT EXISTS `programas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(60) CHARACTER SET latin1 NOT NULL,
  `facultad_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `facultad_id` (`facultad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id`, `nombre`, `facultad_id`) VALUES
(3, 'Arquitectura', 2),
(5, 'Diseño grafico', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE IF NOT EXISTS `respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` int(100) NOT NULL DEFAULT '1',
  `pregunta_id` int(11) NOT NULL,
  `personacuestionario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pregunta_id` (`pregunta_id`),
  KEY `personacuestionario_id` (`personacuestionario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1093 ;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `valor`, `pregunta_id`, `personacuestionario_id`) VALUES
(1047, 4, 1, 116),
(1048, 4, 8, 116),
(1049, 4, 2, 116),
(1050, 4, 9, 116),
(1051, 4, 10, 116),
(1052, 4, 11, 116),
(1053, 4, 15, 116),
(1054, 3, 3, 116),
(1055, 2, 5, 116),
(1056, 5, 12, 116),
(1057, 5, 13, 116),
(1058, 5, 16, 116),
(1059, 5, 17, 116),
(1061, 5, 18, 116),
(1062, 1, 19, 116),
(1063, 5, 1, 117),
(1064, 5, 8, 117),
(1065, 5, 2, 117),
(1066, 5, 9, 117),
(1067, 5, 10, 117),
(1068, 5, 11, 117),
(1069, 5, 15, 117),
(1070, 5, 19, 117),
(1071, 5, 3, 117),
(1072, 5, 5, 117),
(1073, 5, 12, 117),
(1074, 5, 13, 117),
(1075, 5, 16, 117),
(1076, 5, 17, 117),
(1077, 5, 18, 117),
(1078, 1, 1, 118),
(1079, 1, 8, 118),
(1080, 1, 2, 118),
(1081, 5, 9, 118),
(1082, 4, 10, 118),
(1083, 5, 11, 118),
(1084, 5, 15, 118),
(1085, 1, 19, 118),
(1086, 1, 3, 118),
(1087, 2, 5, 118),
(1088, 5, 12, 118),
(1089, 5, 13, 118),
(1090, 5, 16, 118),
(1091, 1, 17, 118),
(1092, 5, 18, 118);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestres`
--

CREATE TABLE IF NOT EXISTS `semestres` (
  `id` int(11) NOT NULL,
  `nivel` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `semestres`
--

INSERT INTO `semestres` (`id`, `nivel`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III'),
(4, 'IV'),
(5, 'V'),
(6, 'VI'),
(7, 'VII'),
(8, 'VII'),
(9, 'IX'),
(10, 'X');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposidentificaciones`
--

CREATE TABLE IF NOT EXISTS `tiposidentificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tiposidentificaciones`
--

INSERT INTO `tiposidentificaciones` (`id`, `titulo`) VALUES
(1, 'C.C'),
(2, 'T.I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(30) CHARACTER SET latin1 NOT NULL,
  `password` char(50) CHARACTER SET latin1 NOT NULL,
  `persona_id` int(11) NOT NULL,
  `nivel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `persona_id` (`persona_id`),
  KEY `nivel_id` (`nivel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=147 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `persona_id`, `nivel_id`) VALUES
(8, 'prueba@hotmail.com', '65ae0032594ec688bc1298c909165536cbccada4', 32, 1),
(145, '111@hotmail.com', '8ceeaf35560bd975145dfb6fd965b482f86db349', 165, 2),
(146, '222@hotmail.com', 'e424b8bdce276446ab7c56018a268e6fdf9ab3dd', 166, 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD CONSTRAINT `competencias_ibfk_1` FOREIGN KEY (`cuestionario_id`) REFERENCES `cuestionarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `dominios`
--
ALTER TABLE `dominios`
  ADD CONSTRAINT `dominios_ibfk_1` FOREIGN KEY (`competencia_id`) REFERENCES `competencias` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_2` FOREIGN KEY (`tiposidentificacion_id`) REFERENCES `tiposidentificaciones` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas_cuestionarios`
--
ALTER TABLE `personas_cuestionarios`
  ADD CONSTRAINT `personas_cuestionarios_ibfk_1` FOREIGN KEY (`cuestionario_id`) REFERENCES `cuestionarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_cuestionarios_ibfk_2` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas_programas_semestres`
--
ALTER TABLE `personas_programas_semestres`
  ADD CONSTRAINT `personas_programas_semestres_ibfk_2` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_programas_semestres_ibfk_3` FOREIGN KEY (`semestre_id`) REFERENCES `semestres` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_programas_semestres_ibfk_4` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`dominio_id`) REFERENCES `dominios` (`id`);

--
-- Filtros para la tabla `programas`
--
ALTER TABLE `programas`
  ADD CONSTRAINT `programas_ibfk_1` FOREIGN KEY (`facultad_id`) REFERENCES `facultades` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respuestas_ibfk_2` FOREIGN KEY (`personacuestionario_id`) REFERENCES `personas_cuestionarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
