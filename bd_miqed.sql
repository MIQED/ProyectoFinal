-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2017 at 05:22 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_miqed`
--
CREATE DATABASE IF NOT EXISTS `bd_miqed` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_miqed`;

-- --------------------------------------------------------

--
-- Table structure for table `alumno`
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
  `alu_pass` varchar(500) NOT NULL,
  `alu_cicloid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumno`
--

INSERT INTO `alumno` (`alu_id`, `alu_nombre`, `alu_apellido1`, `alu_apellido2`, `alu_sexo`, `alu_fecha_n`, `alu_dni`, `alu_ss`, `alu_telf`, `alu_direccion`, `alu_pais`, `alu_cp`, `alu_observaciones`, `alu_curso`, `alu_email`, `alu_pass`, `alu_cicloid`) VALUES
(1, 'a', 'a', 'a', 'Hombre', '2017-05-09', '123456789', 12, 1, 'sdsasdasda', 'wdeqa', 1, 'ddwqdwqdq', 'daw', 'a@gmail.com', 'miuMRKK8xhs3M', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ausencia`
--

CREATE TABLE `ausencia` (
  `aus_id` int(11) NOT NULL,
  `aus_fichero` varchar(200) NOT NULL,
  `aus_motivo` text NOT NULL,
  `aus_horas` int(1) NOT NULL,
  `fecha` date NOT NULL,
  `aus_convenioid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ciclo`
--

CREATE TABLE `ciclo` (
  `cic_id` int(11) NOT NULL,
  `cic_nombre` varchar(100) NOT NULL,
  `cic_grado` enum('Medio','Superior','','') NOT NULL,
  `cic_horas` int(4) NOT NULL,
  `cic_escuelaid` int(11) NOT NULL,
  `cic_tutescid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `convenio`
--

CREATE TABLE `convenio` (
  `con_id` int(11) NOT NULL,
  `con_alumnoid` int(11) NOT NULL,
  `con_empresaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
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
-- Table structure for table `escuela`
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
-- Table structure for table `horario_convenio`
--

CREATE TABLE `horario_convenio` (
  `hr_id` int(11) NOT NULL,
  `hr_dias_semana` int(1) NOT NULL,
  `hr_hora_inicio` time NOT NULL,
  `hr_hora_final` time NOT NULL,
  `hr_convenioid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tarea`
--

CREATE TABLE `tarea` (
  `tar_id` int(11) NOT NULL,
  `tar_descripcion` text NOT NULL,
  `tar_duracion` varchar(10) NOT NULL,
  `tar_nota_tutor` int(2) NOT NULL,
  `tar_fecha` date NOT NULL,
  `tar_convenio` int(11) NOT NULL,
  `tar_tiptareaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_tarea`
--

CREATE TABLE `tipo_tarea` (
  `tip_tar_id` int(11) NOT NULL,
  `tip_tar_descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutor_empresa`
--

CREATE TABLE `tutor_empresa` (
  `tut_emp_id` int(11) NOT NULL,
  `tut_emp_nombre` varchar(15) NOT NULL,
  `tut_emp_apellido1` varchar(20) NOT NULL,
  `tut_emp_apellido2` varchar(20) NOT NULL,
  `tut_emp_email` varchar(100) NOT NULL,
  `tut_emp_pass` varchar(500) NOT NULL,
  `tut_emp_telf` int(9) NOT NULL,
  `tut_emp_empresaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutor_escuela`
--

CREATE TABLE `tutor_escuela` (
  `tut_esc_id` int(11) NOT NULL,
  `tut_esc_nombre` varchar(15) NOT NULL,
  `tut_esc_apellido1` varchar(20) NOT NULL,
  `tut_esc_apellido2` varchar(20) NOT NULL,
  `tut_esc_email` varchar(100) NOT NULL,
  `tut_esc_pass` varchar(500) NOT NULL,
  `tut_esc_telf` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutor_escuela`
--

INSERT INTO `tutor_escuela` (`tut_esc_id`, `tut_esc_nombre`, `tut_esc_apellido1`, `tut_esc_apellido2`, `tut_esc_email`, `tut_esc_pass`, `tut_esc_telf`) VALUES
(1, 'Pedro', 'Blanco', 'Asecas', 'pblanco@fje.edu', '1234', 123456789);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`alu_id`);

--
-- Indexes for table `ausencia`
--
ALTER TABLE `ausencia`
  ADD PRIMARY KEY (`aus_id`);

--
-- Indexes for table `ciclo`
--
ALTER TABLE `ciclo`
  ADD PRIMARY KEY (`cic_id`);

--
-- Indexes for table `convenio`
--
ALTER TABLE `convenio`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `escuela`
--
ALTER TABLE `escuela`
  ADD PRIMARY KEY (`esc_id`);

--
-- Indexes for table `horario_convenio`
--
ALTER TABLE `horario_convenio`
  ADD PRIMARY KEY (`hr_id`);

--
-- Indexes for table `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`tar_id`);

--
-- Indexes for table `tipo_tarea`
--
ALTER TABLE `tipo_tarea`
  ADD PRIMARY KEY (`tip_tar_id`);

--
-- Indexes for table `tutor_empresa`
--
ALTER TABLE `tutor_empresa`
  ADD PRIMARY KEY (`tut_emp_id`);

--
-- Indexes for table `tutor_escuela`
--
ALTER TABLE `tutor_escuela`
  ADD PRIMARY KEY (`tut_esc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumno`
--
ALTER TABLE `alumno`
  MODIFY `alu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ausencia`
--
ALTER TABLE `ausencia`
  MODIFY `aus_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ciclo`
--
ALTER TABLE `ciclo`
  MODIFY `cic_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `convenio`
--
ALTER TABLE `convenio`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `escuela`
--
ALTER TABLE `escuela`
  MODIFY `esc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `horario_convenio`
--
ALTER TABLE `horario_convenio`
  MODIFY `hr_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tarea`
--
ALTER TABLE `tarea`
  MODIFY `tar_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipo_tarea`
--
ALTER TABLE `tipo_tarea`
  MODIFY `tip_tar_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tutor_empresa`
--
ALTER TABLE `tutor_empresa`
  MODIFY `tut_emp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tutor_escuela`
--
ALTER TABLE `tutor_escuela`
  MODIFY `tut_esc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
