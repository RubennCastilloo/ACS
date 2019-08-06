-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 05, 2019 at 02:39 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `control_asistencia`
--

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `apellido_paterno` varchar(60) NOT NULL,
  `apellido_materno` varchar(60) NOT NULL,
  `usuario` varchar(60) NOT NULL,
  `password` varchar(120) NOT NULL,
  `departamento` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`id`, `nombres`, `apellido_paterno`, `apellido_materno`, `usuario`, `password`, `departamento`) VALUES
(20, 'Ruben Abisai', 'Castillo', ' Gonzalez', 'rcastillo', '$2y$12$.uKbC7x8TO.24xz8ZxBs2uKSdhmJP.NJMd4U0/IV2xLlKWfmWMrKO', 'Sistemas');

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `apellido_paterno` varchar(60) NOT NULL,
  `apellido_materno` varchar(60) NOT NULL,
  `usuario` varchar(60) NOT NULL,
  `departamento` varchar(60) NOT NULL,
  `puesto` varchar(60) NOT NULL,
  `entrada` varchar(60) NOT NULL,
  `salida` varchar(60) NOT NULL,
  `estado` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`id`, `nombres`, `apellido_paterno`, `apellido_materno`, `usuario`, `departamento`, `puesto`, `entrada`, `salida`, `estado`) VALUES
(3, 'Ruben', 'Castillo', 'Gonzalez', '5253', 'Sistemas', 'Sistemas', '07:00', '21:00', 'activo'),
(4, 'Alexandra', 'Reyes', 'Marin', '5254', 'Sistemas', 'Sistemas', '07:00', '21:00', 'inactivo');

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `entrada` varchar(60) NOT NULL,
  `salida` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `horarios`
--

INSERT INTO `horarios` (`id`, `entrada`, `salida`) VALUES
(16, '07:00', '15:00'),
(17, '08:00', '16:00'),
(18, '08:00', '17:00'),
(19, '07:00', '12:00'),
(20, '12:00', '21:00');

-- --------------------------------------------------------

--
-- Table structure for table `registros`
--

CREATE TABLE `registros` (
  `id` int(60) NOT NULL,
  `usuario` varchar(60) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `horario` varchar(60) NOT NULL,
  `hora` varchar(60) NOT NULL,
  `hora_salida` varchar(20) NOT NULL,
  `fecha` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registros`
--

INSERT INTO `registros` (`id`, `usuario`, `nombres`, `apellido`, `horario`, `hora`, `hora_salida`, `fecha`) VALUES
(56, '', 'Ruben Abisai', 'Castillo', '07:00 - 03:00', '08:00:47 ', '20:01:56 ', 'Jueves, 1 de Agosto de 2019'),
(57, '5253', 'Ruben', 'Castillo', '07:00:21:00', '08:24:16 ', '20:27:05 ', '4 de Agosto de 2019'),
(58, '5253', 'Ruben', 'Castillo', '07:00:21:00', '08:24:26 ', '20:27:05 ', '4 de Agosto de 2019'),
(59, '5253', 'Ruben', 'Castillo', '07:00 - 21:00', '08:25:00 ', '20:27:05 ', '4 de Agosto de 2019');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;