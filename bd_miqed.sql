-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2017 a las 19:04:46
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_miqed`
--
CREATE DATABASE IF NOT EXISTS `bd_miqed` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_miqed`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `alu_id` int(11) NOT NULL,
  `alu_nombre` varchar(50) NOT NULL,
  `alu_apellido1` varchar(50) NOT NULL,
  `alu_apellido2` varchar(50) NOT NULL,
  `alu_sexo` enum('Hombre','Mujer','Otro','') NOT NULL,
  `alu_fecha_n` date NOT NULL,
  `alu_dni` varchar(9) NOT NULL,
  `alu_ss` int(14) NOT NULL,
  `alu_telf` int(9) NOT NULL,
  `alu_direccion` varchar(200) NOT NULL,
  `alu_pais` varchar(50) NOT NULL,
  `alu_cp` int(5) NOT NULL,
  `alu_observaciones` text NOT NULL,
  `alu_curso` varchar(50) NOT NULL,
  `alu_email` varchar(100) NOT NULL,
  `alu_pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ausencia`
--

CREATE TABLE `ausencia` (
  `aus_id` int(11) NOT NULL,
  `aus_fichero` varchar(200) NOT NULL,
  `aus_motivo` text NOT NULL,
  `aus_horas` int(1) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo`
--

CREATE TABLE `ciclo` (
  `cic_id` int(11) NOT NULL,
  `cic_nombre` varchar(100) NOT NULL,
  `cic_grado` enum('Medio','Superior','','') NOT NULL,
  `cic_horas` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenio`
--

CREATE TABLE `convenio` (
  `con_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `emp_id` int(11) NOT NULL,
  `emp_tipo` enum('Pequeña','Mediana','Grande','') NOT NULL,
  `emp_cif_nif` varchar(9) NOT NULL,
  `emp_nom` text NOT NULL,
  `emp_direccion` text NOT NULL,
  `emp_cp` int(5) NOT NULL,
  `emp_telf` int(9) NOT NULL,
  `emp_fax` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela`
--

CREATE TABLE `escuela` (
  `esc_id` int(11) NOT NULL,
  `esc_nombre` varchar(100) NOT NULL,
  `esc_direccion` text NOT NULL,
  `esc_telf` int(9) NOT NULL,
  `esc_cp` int(5) NOT NULL,
  `esc_fax` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_convenio`
--

CREATE TABLE `horario_convenio` (
  `hr_id` int(11) NOT NULL,
  `hr_dias_semana` int(1) NOT NULL,
  `hr_hora_inicio` time NOT NULL,
  `hr_hora_final` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `tar_id` int(11) NOT NULL,
  `tar_descripcion` text NOT NULL,
  `tar_duracion` varchar(10) NOT NULL,
  `tar_nota_tutor` int(2) NOT NULL,
  `tar_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_tarea`
--

CREATE TABLE `tipo_tarea` (
  `tip_tar_id` int(11) NOT NULL,
  `tip_tar_descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor_empresa`
--

CREATE TABLE `tutor_empresa` (
  `tut_emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor_escuela`
--

CREATE TABLE `tutor_escuela` (
  `tut_esc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`alu_id`);

--
-- Indices de la tabla `ausencia`
--
ALTER TABLE `ausencia`
  ADD PRIMARY KEY (`aus_id`);

--
-- Indices de la tabla `ciclo`
--
ALTER TABLE `ciclo`
  ADD PRIMARY KEY (`cic_id`);

--
-- Indices de la tabla `convenio`
--
ALTER TABLE `convenio`
  ADD PRIMARY KEY (`con_id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indices de la tabla `escuela`
--
ALTER TABLE `escuela`
  ADD PRIMARY KEY (`esc_id`);

--
-- Indices de la tabla `horario_convenio`
--
ALTER TABLE `horario_convenio`
  ADD PRIMARY KEY (`hr_id`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`tar_id`);

--
-- Indices de la tabla `tipo_tarea`
--
ALTER TABLE `tipo_tarea`
  ADD PRIMARY KEY (`tip_tar_id`);

--
-- Indices de la tabla `tutor_empresa`
--
ALTER TABLE `tutor_empresa`
  ADD PRIMARY KEY (`tut_emp_id`);

--
-- Indices de la tabla `tutor_escuela`
--
ALTER TABLE `tutor_escuela`
  ADD PRIMARY KEY (`tut_esc_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `alu_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ausencia`
--
ALTER TABLE `ausencia`
  MODIFY `aus_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ciclo`
--
ALTER TABLE `ciclo`
  MODIFY `cic_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `convenio`
--
ALTER TABLE `convenio`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `escuela`
--
ALTER TABLE `escuela`
  MODIFY `esc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `horario_convenio`
--
ALTER TABLE `horario_convenio`
  MODIFY `hr_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
  MODIFY `tar_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_tarea`
--
ALTER TABLE `tipo_tarea`
  MODIFY `tip_tar_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tutor_empresa`
--
ALTER TABLE `tutor_empresa`
  MODIFY `tut_emp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tutor_escuela`
--
ALTER TABLE `tutor_escuela`
  MODIFY `tut_esc_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
