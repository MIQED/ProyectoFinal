-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2017 at 06:08 PM
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
(1, 'Granjero', 'Busca', 'Esposa', 'Hombre', '2017-05-09', '123456789', 12, 1, 'sdsasdasda', 'wdeqa', 8901, 'ddwqdwqdq', 'Segundo', 'a@gmail.com', 'miuMRKK8xhs3M', 1),
(2, 'B', 'ADSA', 'ASDADA', 'Mujer', '2017-05-18', '235235', 35353, 23, 'Hola que hase', 'Espain', 23408, 'KOLA', 'Primero', 'b@gmail.com', 'miuMRKK8xhs3M', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ausencia`
--

CREATE TABLE `ausencia` (
  `aus_id` int(11) NOT NULL,
  `aus_fichero` varchar(200) DEFAULT NULL,
  `aus_motivo` text NOT NULL,
  `aus_horas` int(1) NOT NULL,
  `fecha` date NOT NULL,
  `aus_convenioid` int(11) NOT NULL,
  `aus_visto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ausencia`
--

INSERT INTO `ausencia` (`aus_id`, `aus_fichero`, `aus_motivo`, `aus_horas`, `fecha`, `aus_convenioid`, `aus_visto`) VALUES
(10, 'hola.docx', 'sadadsad  as das da sd sasd as da sd as da sd asd as da sda sd ad asd asd as da sda ', 2, '2017-05-16', 1, 1),
(12, NULL, 'porque si', 4, '2017-05-10', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ciclo`
--

CREATE TABLE `ciclo` (
  `cic_id` int(11) NOT NULL,
  `cic_nombre` varchar(100) NOT NULL,
  `cic_grado` enum('Medio','Superior','','') NOT NULL,
  `cic_horas` int(4) NOT NULL,
  `cic_tutescid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ciclo`
--

INSERT INTO `ciclo` (`cic_id`, `cic_nombre`, `cic_grado`, `cic_horas`, `cic_tutescid`) VALUES
(1, 'Desarrollo de aplicaciones web (DAW)', 'Superior', 317, 1);

-- --------------------------------------------------------

--
-- Table structure for table `convenio`
--

CREATE TABLE `convenio` (
  `con_id` int(11) NOT NULL,
  `con_alumnoid` int(11) NOT NULL,
  `con_empresaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `convenio`
--

INSERT INTO `convenio` (`con_id`, `con_alumnoid`, `con_empresaid`) VALUES
(1, 1, 1),
(2, 2, 1);

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

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`emp_id`, `emp_tipo`, `emp_cif_nif`, `emp_nom`, `emp_direccion`, `emp_cp`, `emp_telf`, `emp_fax`) VALUES
(1, 'Grande', '712123432', 'Bits and Bytes Malta', 'Calle falsa de num 123', 21345, 123456789, 987654321);

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

--
-- Dumping data for table `escuela`
--

INSERT INTO `escuela` (`esc_id`, `esc_nombre`, `esc_direccion`, `esc_telf`, `esc_cp`, `esc_fax`) VALUES
(1, 'Joan XXIII', 'Mare de déu de bellvitge 110', 123123123, 8903, 12313135);

-- --------------------------------------------------------

--
-- Table structure for table `horario_convenio`
--

CREATE TABLE `horario_convenio` (
  `hr_id` int(11) NOT NULL,
  `hr_dias_semana` int(1) NOT NULL,
  `hr_hora_inicio` time NOT NULL,
  `hr_hora_final` time NOT NULL,
  `hr_dia_inicio` date NOT NULL,
  `hr_dia_final` date NOT NULL,
  `hr_convenioid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `horario_convenio`
--

INSERT INTO `horario_convenio` (`hr_id`, `hr_dias_semana`, `hr_hora_inicio`, `hr_hora_final`, `hr_dia_inicio`, `hr_dia_final`, `hr_convenioid`) VALUES
(1, 5, '09:00:00', '13:00:00', '2017-03-22', '2017-06-22', 1),
(2, 5, '15:00:00', '20:00:00', '2017-03-31', '2017-06-05', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tarea`
--

CREATE TABLE `tarea` (
  `tar_id` int(11) NOT NULL,
  `tar_duracion` int(1) NOT NULL,
  `tar_fecha` date NOT NULL,
  `tar_convenioid` int(11) NOT NULL,
  `tar_tiptareaid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarea`
--

INSERT INTO `tarea` (`tar_id`, `tar_duracion`, `tar_fecha`, `tar_convenioid`, `tar_tiptareaid`) VALUES
(9, 2, '2017-05-11', 1, 1),
(10, 1, '2017-05-11', 1, 2),
(11, 1, '2017-05-11', 1, 6),
(12, 4, '2017-05-02', 1, 7),
(23, 1, '2017-05-03', 1, 1),
(24, 2, '2017-05-03', 1, 4),
(25, 1, '2017-05-03', 1, 6),
(26, 1, '2017-05-01', 1, 1),
(27, 1, '2017-05-01', 1, 4),
(28, 2, '2017-05-01', 1, 8),
(29, 4, '2017-05-15', 1, 1),
(31, 4, '2017-05-04', 1, 9),
(38, 2, '2017-05-16', 1, 5),
(39, 4, '2017-05-05', 1, 3),
(40, 4, '2017-05-08', 1, 21),
(41, 4, '2017-05-12', 1, 7),
(42, 0, '2017-05-10', 1, NULL),
(43, 4, '2017-04-03', 1, 23),
(44, 4, '2017-04-04', 1, 1),
(45, 4, '2017-04-05', 1, 17),
(46, 4, '2017-04-06', 1, 9),
(47, 4, '2017-04-07', 1, 14),
(48, 4, '2017-04-10', 1, 2),
(49, 4, '2017-04-11', 1, 17),
(50, 4, '2017-04-12', 1, 10),
(51, 4, '2017-04-13', 1, 9),
(52, 4, '2017-04-14', 1, 20),
(53, 4, '2017-04-17', 1, 6),
(54, 2, '2017-04-18', 1, 17),
(55, 2, '2017-04-18', 1, 18),
(56, 3, '2017-04-19', 1, 18),
(57, 1, '2017-04-19', 1, 21),
(58, 4, '2017-04-20', 1, 10),
(59, 4, '2017-04-21', 1, 20),
(60, 4, '2017-04-24', 1, 12),
(61, 4, '2017-04-25', 1, 2),
(62, 4, '2017-04-26', 1, 16),
(63, 4, '2017-04-27', 1, 5),
(64, 4, '2017-04-28', 1, 3),
(65, 4, '2017-05-09', 1, 2),
(66, 4, '2017-05-17', 1, 17),
(67, 4, '2017-05-18', 1, 6),
(68, 4, '2017-03-22', 1, 1),
(69, 4, '2017-03-23', 1, 2),
(70, 4, '2017-03-24', 1, 16),
(71, 4, '2017-03-27', 1, 14),
(72, 4, '2017-03-28', 1, 13),
(73, 4, '2017-03-29', 1, 2),
(74, 4, '2017-03-30', 1, 17),
(75, 4, '2017-03-31', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_h_tarea`
--

CREATE TABLE `tipo_h_tarea` (
  `tip_tar_id` int(11) NOT NULL,
  `tip_tar_descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_h_tarea`
--

INSERT INTO `tipo_h_tarea` (`tip_tar_id`, `tip_tar_descripcion`) VALUES
(1, '1. Relacionades amb la gestió i utilització de sistemes informàtics i entorns de desenvolupament, avaluant els seus requeriments i característiques en funció del propòsit d''ús.'),
(2, '2. Relacionades amb la participació en la gestió de bases de dades i servidors d''aplicacions, avaluant / planificant la seva configuració en funció del projecte de desenvolupament web al qual donen suport.'),
(3, '4. Relacionades amb la intervenció en el desenvolupament i prova de la interfície per a aplicacions web, utilitzant les eines i llenguatges específics i complint els requeriments establerts.');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_tarea`
--

CREATE TABLE `tipo_tarea` (
  `tt_id` int(11) NOT NULL,
  `tt_descripcion` text NOT NULL,
  `tt_tiphtarid` int(11) NOT NULL,
  `tt_cicloid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_tarea`
--

INSERT INTO `tipo_tarea` (`tt_id`, `tt_descripcion`, `tt_tiphtarid`, `tt_cicloid`) VALUES
(1, '1.1. Treball sobre diferents sistemes informàtics, identificant en cada cas el seu maquinari, sistemes operatius i aplicacions instal·lades i les restriccions o condicions específiques d''ús.', 1, 1),
(2, '1.2. Gestió la informació en diferents sistemes, aplicant mesures que assegurin la integritat i disponibilitat de les dades.', 1, 1),
(3, '1.3. Participació en la gestió de recursos en xarxa identificant les restriccions de seguretat existents.', 1, 1),
(4, '1.4. Utilització aplicacions informàtiques per elaborar, distribuir i mantenir documentació tècnica i d''assistència a usuaris.', 1, 1),
(5, '1.5. Gestió d''entorns de desenvolupament, per editar, depurar, provar i documentar codi, a més de generar executables.', 1, 1),
(6, '1.6. Gestió d''entorns de desenvolupament afegint i emprant complements específics en les diferents fases de projectes de desenvolupament.', 1, 1),
(7, '2.1. Interpretació del disseny lògic de bases de dades que asseguren l''accessibilitat a les dades.', 2, 1),
(8, '2.2. Participació en la materialització del disseny lògic sobre algun sistema gestor de bases de dades.', 2, 1),
(9, '2.3. Utilització de bases de dades aplicant tècniques per mantenir la persistència de la informació.', 2, 1),
(10, '2.4. Execució de consultes directes i procediments capaços de gestionar i emmagatzemar objectes i dades de la base de dades.', 2, 1),
(11, '2.5. Establiment de connexions amb bases de dades per executar consultes i recuperar els resultats en objectes d''accés a dades.', 2, 1),
(12, '2.6. Participació en la gestió de servidors per a la publicació d''aplicacions Web.', 2, 1),
(13, '2.7. Verificació de la configuració dels serveis de xarxa per garantir l''execució segura de les aplicacions Web.', 2, 1),
(14, '2.8. Configuració de sistemes de gestió de bases de dades i la seva interconnexió amb el servidor d''aplicacions web.', 2, 1),
(15, '2.9. Elaboració de manuals de servei i manteniment del servidor d''aplicacions i del sistema gestor de bases de dades.', 2, 1),
(16, '4.1. Interpretació del disseny i la guia d''estil per a la interfície de les aplicacions web que s''han de desenvolupar, atenent les indicacions de l''equip de disseny.', 3, 1),
(17, '4.2. Edició i prova de blocs de sentències en llenguatges de marques que formen totalment o parcialment la interfície d''aplicacions web, administrant estils des de fulles externes.', 3, 1),
(18, '4.3. Utilització de fulls de transformació per a convertir i adaptar informació als formats de presentació adequats a la part client.', 3, 1),
(19, '4.4. Participació en la preparació i integració de materials multimèdia per a la interfície d''una aplicació web, seguint les instruccions de l''equip de disseny.', 3, 1),
(20, '4.5. Col·laboració en el desenvolupament d''aplicacions web interactives, basades en el maneig d''esdeveniments i en la integració d''elements interactius i animacions.', 3, 1),
(21, '4.6. Verificació, accessibilitat i usabilitat de les aplicacions web, prendre part en els canvis i mesures necessàries per complir els nivells exigits.', 3, 1),
(22, '4.7. Col·laboració amb els encarregats del disseny i desenvolupament de la part servidor de les aplicacions web, unificant criteris i coordinant el desenvolupament en ambdós costats de l''aplicació.', 3, 1),
(23, '4.8. Participació en la definició i elaboració de la documentació i de la resta de components utilitzats en els protocols d''assistència a l''usuari de l''aplicació.', 3, 1);

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

--
-- Dumping data for table `tutor_empresa`
--

INSERT INTO `tutor_empresa` (`tut_emp_id`, `tut_emp_nombre`, `tut_emp_apellido1`, `tut_emp_apellido2`, `tut_emp_email`, `tut_emp_pass`, `tut_emp_telf`, `tut_emp_empresaid`) VALUES
(1, 'Nombre', 'Ape', 'Llido', 'napellido@gmail.com', 'miuMRKK8xhs3M', 123456789, 1);

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
  `tut_esc_telf` int(9) NOT NULL,
  `tut_esc_escuelaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutor_escuela`
--

INSERT INTO `tutor_escuela` (`tut_esc_id`, `tut_esc_nombre`, `tut_esc_apellido1`, `tut_esc_apellido2`, `tut_esc_email`, `tut_esc_pass`, `tut_esc_telf`, `tut_esc_escuelaid`) VALUES
(1, 'Pedro', 'Blanco', 'Asecas', 'pblanco@fje.edu', 'miuMRKK8xhs3M', 123456789, 1);

-- --------------------------------------------------------

--
-- Table structure for table `validacion`
--

CREATE TABLE `validacion` (
  `val_id` int(11) NOT NULL,
  `val_validado` enum('0','1','2','') DEFAULT NULL,
  `val_mes` int(2) NOT NULL,
  `val_convenioid` int(11) NOT NULL,
  `val_observacionEmp` text,
  `val_observacionEsc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `validacion`
--

INSERT INTO `validacion` (`val_id`, `val_validado`, `val_mes`, `val_convenioid`, `val_observacionEmp`, `val_observacionEsc`) VALUES
(15, '2', 4, 1, '', 'Muh bien todo'),
(18, '1', 3, 1, '', NULL),
(19, '0', 4, 0, NULL, NULL),
(20, '0', 3, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `validar_tarea`
--

CREATE TABLE `validar_tarea` (
  `vt_id` int(11) NOT NULL,
  `vt_totalHoras` int(4) NOT NULL,
  `vt_notaEmpresa` varchar(20) DEFAULT NULL,
  `vt_validacionid` int(11) NOT NULL,
  `vt_tipotareaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `validar_tarea`
--

INSERT INTO `validar_tarea` (`vt_id`, `vt_totalHoras`, `vt_notaEmpresa`, `vt_validacionid`, `vt_tipotareaid`) VALUES
(3, 4, 'Suficiente', 15, 1),
(4, 8, 'Excelente', 15, 2),
(5, 4, 'Notable', 15, 3),
(6, 0, 'Suficiente', 15, 4),
(7, 4, 'Insuficiente', 15, 5),
(8, 4, 'Notable', 15, 6),
(9, 0, 'Notable', 15, 7),
(10, 0, 'Excelente', 15, 8),
(11, 8, 'Excelente', 15, 9),
(12, 8, 'Excelente', 15, 10),
(13, 0, 'Excelente', 15, 11),
(14, 4, 'Suficiente', 15, 12),
(15, 0, 'Excelente', 15, 13),
(16, 4, 'Notable', 15, 14),
(17, 0, 'Suficiente', 15, 15),
(18, 4, 'Insuficiente', 15, 16),
(19, 10, 'Suficiente', 15, 17),
(20, 5, 'Excelente', 15, 18),
(21, 0, 'Notable', 15, 19),
(22, 8, 'Excelente', 15, 20),
(23, 1, 'Excelente', 15, 21),
(24, 0, 'Excelente', 15, 22),
(25, 4, 'Notable', 15, 23),
(28, 0, NULL, 16, 3),
(29, 0, NULL, 16, 4),
(30, 0, NULL, 16, 5),
(31, 0, NULL, 16, 6),
(32, 0, NULL, 16, 7),
(33, 0, NULL, 16, 8),
(34, 0, NULL, 16, 9),
(35, 0, NULL, 16, 10),
(36, 0, NULL, 16, 11),
(37, 0, NULL, 16, 12),
(38, 0, NULL, 16, 13),
(39, 0, NULL, 16, 14),
(40, 0, NULL, 16, 15),
(41, 0, NULL, 16, 16),
(42, 0, NULL, 16, 17),
(43, 0, NULL, 16, 18),
(44, 0, NULL, 16, 19),
(45, 0, NULL, 16, 20),
(46, 0, NULL, 16, 21),
(47, 0, NULL, 16, 22),
(48, 0, NULL, 16, 23),
(49, 0, NULL, 17, 1),
(50, 0, NULL, 17, 2),
(51, 0, NULL, 17, 3),
(52, 0, NULL, 17, 4),
(53, 0, NULL, 17, 5),
(54, 0, NULL, 17, 6),
(55, 0, NULL, 17, 7),
(56, 0, NULL, 17, 8),
(57, 0, NULL, 17, 9),
(58, 0, NULL, 17, 10),
(59, 0, NULL, 17, 11),
(60, 0, NULL, 17, 12),
(61, 0, NULL, 17, 13),
(62, 0, NULL, 17, 14),
(63, 0, NULL, 17, 15),
(64, 0, NULL, 17, 16),
(65, 0, NULL, 17, 17),
(66, 0, NULL, 17, 18),
(67, 0, NULL, 17, 19),
(68, 0, NULL, 17, 20),
(69, 0, NULL, 17, 21),
(70, 0, NULL, 17, 22),
(71, 0, NULL, 17, 23),
(72, 4, 'Notable', 18, 1),
(73, 8, 'Notable', 18, 2),
(74, 0, 'Excelente', 18, 3),
(75, 0, 'Notable', 18, 4),
(76, 0, 'Suficiente', 18, 5),
(77, 0, 'Notable', 18, 6),
(78, 0, 'Excelente', 18, 7),
(79, 0, 'Excelente', 18, 8),
(80, 0, 'Excelente', 18, 9),
(81, 0, 'Excelente', 18, 10),
(82, 0, 'Excelente', 18, 11),
(83, 4, 'Excelente', 18, 12),
(84, 4, 'Excelente', 18, 13),
(85, 4, 'Suficiente', 18, 14),
(86, 0, 'Excelente', 18, 15),
(87, 4, 'Excelente', 18, 16),
(88, 4, 'Suficiente', 18, 17),
(89, 0, 'Excelente', 18, 18),
(90, 0, 'Excelente', 18, 19),
(91, 0, 'Suficiente', 18, 20),
(92, 0, 'Suficiente', 18, 21),
(93, 0, 'Insuficiente', 18, 22),
(94, 0, 'Suficiente', 18, 23);

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
-- Indexes for table `tipo_h_tarea`
--
ALTER TABLE `tipo_h_tarea`
  ADD PRIMARY KEY (`tip_tar_id`);

--
-- Indexes for table `tipo_tarea`
--
ALTER TABLE `tipo_tarea`
  ADD PRIMARY KEY (`tt_id`);

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
-- Indexes for table `validacion`
--
ALTER TABLE `validacion`
  ADD PRIMARY KEY (`val_id`);

--
-- Indexes for table `validar_tarea`
--
ALTER TABLE `validar_tarea`
  ADD PRIMARY KEY (`vt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumno`
--
ALTER TABLE `alumno`
  MODIFY `alu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ausencia`
--
ALTER TABLE `ausencia`
  MODIFY `aus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ciclo`
--
ALTER TABLE `ciclo`
  MODIFY `cic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `convenio`
--
ALTER TABLE `convenio`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `escuela`
--
ALTER TABLE `escuela`
  MODIFY `esc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `horario_convenio`
--
ALTER TABLE `horario_convenio`
  MODIFY `hr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tarea`
--
ALTER TABLE `tarea`
  MODIFY `tar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `tipo_h_tarea`
--
ALTER TABLE `tipo_h_tarea`
  MODIFY `tip_tar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipo_tarea`
--
ALTER TABLE `tipo_tarea`
  MODIFY `tt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tutor_empresa`
--
ALTER TABLE `tutor_empresa`
  MODIFY `tut_emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tutor_escuela`
--
ALTER TABLE `tutor_escuela`
  MODIFY `tut_esc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `validacion`
--
ALTER TABLE `validacion`
  MODIFY `val_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `validar_tarea`
--
ALTER TABLE `validar_tarea`
  MODIFY `vt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
