-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-08-2020 a las 19:38:07
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dayclass`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrativo`
--

CREATE TABLE `administrativo` (
  `id` int(11) NOT NULL,
  `apellidoAdm` varchar(255) DEFAULT NULL,
  `contraseniaAdm` varchar(255) DEFAULT NULL,
  `dniAdm` int(11) NOT NULL,
  `emailAdm` varchar(255) DEFAULT NULL,
  `fechaAltaAdm` date DEFAULT NULL,
  `fechaBajaAdm` date DEFAULT NULL,
  `fechaNacAdm` date DEFAULT NULL,
  `legajoAdm` int(11) NOT NULL,
  `nombreAdm` varchar(255) DEFAULT NULL,
  `permiso_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrativo`
--

INSERT INTO `administrativo` (`id`, `apellidoAdm`, `contraseniaAdm`, `dniAdm`, `emailAdm`, `fechaAltaAdm`, `fechaBajaAdm`, `fechaNacAdm`, `legajoAdm`, `nombreAdm`, `permiso_id`) VALUES
(1, 'admin', '$2y$10$TNPmQGaxFNd2BjDLhR5YkuJzu1u530Pj9BAdPgsbSJF7kkdIy0Uka', 11111111, 'admin@dayclass.com', '2020-07-30', NULL, NULL, 12345, 'admin', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id` int(11) NOT NULL,
  `apellidoAlum` varchar(255) DEFAULT NULL,
  `contraseniaAlum` varchar(255) DEFAULT NULL,
  `dniAlum` int(11) NOT NULL,
  `emailAlum` varchar(255) DEFAULT NULL,
  `fechaAltaAlumno` date DEFAULT NULL,
  `fechaBajaAlumno` date DEFAULT NULL,
  `fechaNacAlumno` date DEFAULT NULL,
  `legajoAlumno` int(11) NOT NULL,
  `nombreAlum` varchar(255) DEFAULT NULL,
  `permiso_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnocursoactual`
--

CREATE TABLE `alumnocursoactual` (
  `id` int(11) NOT NULL,
  `fechaDesdeAlumCurAc` date DEFAULT NULL,
  `fechaHastaAlumCurAc` date DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnocursoestado`
--

CREATE TABLE `alumnocursoestado` (
  `id` int(11) NOT NULL,
  `fechaFinEstado` datetime DEFAULT NULL,
  `fechaInicioEstado` datetime DEFAULT NULL,
  `alumnoCursoActual_id` int(11) DEFAULT NULL,
  `cursoEstadoAlumno_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `nroFichaAsistencia` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `fechaHastaFichaAsis` date NOT NULL,
  `fechaDesdeFichaAsis` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciadia`
--

CREATE TABLE `asistenciadia` (
  `id` int(11) NOT NULL,
  `fechaHoraAsisDia` datetime DEFAULT NULL,
  `asistencia_id` int(11) DEFAULT NULL,
  `tipoAsistencia_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistenciadia`
--

INSERT INTO `asistenciadia` (`id`, `fechaHoraAsisDia`, `asistencia_id`, `tipoAsistencia_id`) VALUES
(1, '2020-08-03 21:05:35', 1, 2),
(2, '2020-08-03 01:30:07', 2, 2),
(3, '2020-08-04 01:32:43', 2, 2),
(4, '2020-08-04 01:32:43', 1, 1),
(5, '2020-07-15 01:48:33', 2, 2),
(6, '2020-08-18 18:40:46', 24, 1),
(7, '2020-08-18 18:43:38', 19, 2),
(8, '2020-08-18 18:43:38', 18, 1),
(9, '2020-08-18 18:43:38', 17, 2),
(10, '2020-08-18 18:43:38', 16, 2),
(11, '2020-08-18 18:43:38', 15, 2),
(12, '2020-08-18 18:43:38', 14, 1),
(13, '2020-08-18 18:43:38', 13, 2),
(14, '2020-08-18 18:43:38', 12, 1),
(15, '2020-08-18 18:43:38', 11, 1),
(16, '2020-08-18 18:43:38', 10, 2),
(17, '2020-08-18 18:43:38', 9, 1),
(18, '2020-08-18 18:43:38', 8, 2),
(19, '2020-08-18 18:43:38', 7, 1),
(20, '2020-08-18 18:43:38', 6, 1),
(21, '2020-08-18 18:43:38', 5, 1),
(22, '2020-08-18 18:43:38', 4, 1),
(23, '2020-08-18 18:43:38', 3, 1),
(24, '2020-08-18 18:43:38', 20, 1),
(25, '2020-08-18 18:43:38', 21, 1),
(26, '2020-08-18 18:43:38', 22, 1),
(27, '2020-08-18 18:43:38', 23, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `fechaAltaCargo` date DEFAULT NULL,
  `fechaFinCargo` date DEFAULT NULL,
  `nombreCargo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `fechaAltaCargo`, `fechaFinCargo`, `nombreCargo`) VALUES
(1, '2020-07-31', NULL, 'Titular'),
(2, '2020-07-31', NULL, 'JTP'),
(3, '2020-08-23', NULL, 'Auxiliar'),
(4, '2020-08-23', NULL, 'Adjunto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargoprofesor`
--

CREATE TABLE `cargoprofesor` (
  `id` int(11) NOT NULL,
  `fechaDesdeCargo` date DEFAULT NULL,
  `fechaHastaCargo` date DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargoprofesorestado`
--

CREATE TABLE `cargoprofesorestado` (
  `id` int(11) NOT NULL,
  `fechaDesdeCargoProfesorEstado` date NOT NULL,
  `fechaHastaCargoProfesorEstado` date NOT NULL,
  `estadoCargoProfesor_id` int(11) NOT NULL,
  `cargoProfesor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigoasitencia`
--

CREATE TABLE `codigoasitencia` (
  `id` int(11) NOT NULL,
  `fechaHoraFinCodigo` datetime DEFAULT NULL,
  `fechaHoraInicioCodigo` datetime DEFAULT NULL,
  `numCodigo` varchar(11) NOT NULL,
  `curso_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contraseniarestablecida`
--

CREATE TABLE `contraseniarestablecida` (
  `id` int(11) NOT NULL,
  `contraseniaProvisoria` varchar(255) DEFAULT NULL,
  `vigenciaContraDesde` datetime DEFAULT NULL,
  `vigenciaContraHasta` datetime DEFAULT NULL,
  `administrativo_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `fechaDesdeCurActual` date DEFAULT NULL,
  `fechaHastaCurActul` date DEFAULT NULL,
  `nombreCurso` varchar(255) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `fechaDesdeCursado` date NOT NULL,
  `fechaHastaCursado` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursodia`
--

CREATE TABLE `cursodia` (
  `id` int(11) NOT NULL,
  `nombreDia` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursoestadoalumno`
--

CREATE TABLE `cursoestadoalumno` (
  `id` int(11) NOT NULL,
  `nombreEstado` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `division`
--

CREATE TABLE `division` (
  `id` int(11) NOT NULL,
  `fechaAltaDivision` date DEFAULT NULL,
  `fechaBajaDivision` date DEFAULT NULL,
  `nombreDivision` varchar(255) DEFAULT NULL,
  `modalidad_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `division`
--

INSERT INTO `division` (`id`, `fechaAltaDivision`, `fechaBajaDivision`, `nombreDivision`, `modalidad_id`) VALUES
(1, '2020-07-31', NULL, '4K9', 1),
(2, '2020-08-13', NULL, '4K10', 1),
(4, '2020-08-15', NULL, '4K13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocargoprofesor`
--

CREATE TABLE `estadocargoprofesor` (
  `id` int(11) NOT NULL,
  `nombreEstadoCargoProfe` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadocargoprofesor`
--

INSERT INTO `estadocargoprofesor` (`id`, `nombreEstadoCargoProfe`) VALUES
(1, 'Activo'),
(2, 'Licencia'),
(3, 'Baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariocurso`
--

CREATE TABLE `horariocurso` (
  `id` int(11) NOT NULL,
  `horaFinCurso` time NOT NULL,
  `horaInicioCurso` time NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `cursoDia_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horariocurso`
--

INSERT INTO `horariocurso` (`id`, `horaFinCurso`, `horaInicioCurso`, `curso_id`, `cursoDia_id`) VALUES
(1, '00:00:21', '00:00:19', 1, 1),
(2, '00:00:22', '00:00:20', 1, 4),
(3, '23:28:00', '22:28:00', 13, 1),
(8, '23:30:00', '19:00:00', 16, 3),
(9, '23:30:00', '20:30:00', 17, 1),
(10, '23:30:00', '20:30:00', 17, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id` int(11) NOT NULL,
  `fechaAltaInstitucion` date DEFAULT NULL,
  `fechaBajaInstitucion` date DEFAULT NULL,
  `nombreInstitucion` varchar(255) DEFAULT NULL,
  `telefonoInstitucion` varchar(255) NOT NULL,
  `direccionInstitucion` varchar(255) NOT NULL,
  `correoInstitucion` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `justificativo`
--

CREATE TABLE `justificativo` (
  `id` int(11) NOT NULL,
  `aprobado` bit(1) NOT NULL,
  `comentarioJustificativo` varchar(255) DEFAULT NULL,
  `fechaPresentacion` date DEFAULT NULL,
  `fechaRevision` date DEFAULT NULL,
  `imagenJustificativo` longblob,
  `alumno_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `justificativoasistenciadia`
--

CREATE TABLE `justificativoasistenciadia` (
  `id` int(11) NOT NULL,
  `asistenciaDia_id` int(11) DEFAULT NULL,
  `justificativo_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id` int(11) NOT NULL,
  `fechaAltaMateria` date DEFAULT NULL,
  `fechaBajaMateria` date DEFAULT NULL,
  `nivelMateria` int(11) NOT NULL,
  `nombreMateria` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad`
--

CREATE TABLE `modalidad` (
  `id` int(11) NOT NULL,
  `fechaAltaModalidad` datetime DEFAULT NULL,
  `fechaBajaModalidad` datetime DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modalidad`
--

INSERT INTO `modalidad` (`id`, `fechaAltaModalidad`, `fechaBajaModalidad`, `nombre`) VALUES
(1, '2020-07-31 22:00:32', NULL, 'Sistemas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacionprofe`
--

CREATE TABLE `notificacionprofe` (
  `id` int(11) NOT NULL,
  `asunto` varchar(255) DEFAULT NULL,
  `fechaHoraNotif` datetime DEFAULT NULL,
  `mensaje` varchar(255) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  `fechaDesdeNotificacionProfe` date NOT NULL,
  `fechaHastaNotificacionProfe` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paramminimoasistencia`
--

CREATE TABLE `paramminimoasistencia` (
  `id` int(11) NOT NULL,
  `fechaAltaMinimoAsistencia` datetime DEFAULT NULL,
  `fechaBajaMinimoAsistencia` datetime DEFAULT NULL,
  `porcentajeAsistencia` int(11) NOT NULL,
  `cursoEstadoAlumno_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `fechaDesdePer` date DEFAULT NULL,
  `fechaHastaPer` date DEFAULT NULL,
  `nombrePermiso` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `fechaDesdePer`, `fechaHastaPer`, `nombrePermiso`) VALUES
(1, '2020-07-30', NULL, 'ALUMNO'),
(2, '2020-07-30', NULL, 'DOCENTE'),
(3, '2020-07-30', NULL, 'ADMINISTRADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id` int(11) NOT NULL,
  `apellidoProf` varchar(255) DEFAULT NULL,
  `contraseniaProf` varchar(255) DEFAULT NULL,
  `dniProf` int(11) NOT NULL,
  `emailProf` varchar(255) DEFAULT NULL,
  `fechaAltaProf` date DEFAULT NULL,
  `fechaBajaProf` date DEFAULT NULL,
  `fechaNacProf` date DEFAULT NULL,
  `legajoProf` int(11) NOT NULL,
  `nombreProf` varchar(255) DEFAULT NULL,
  `permiso_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programamateria`
--

CREATE TABLE `programamateria` (
  `id` int(11) NOT NULL,
  `anioPrograma` int(11) NOT NULL,
  `cargaHorariaMateria` int(11) NOT NULL,
  `descripcionPrograma` varchar(255) DEFAULT NULL,
  `fechaVigentePrograma` date DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temadia`
--

CREATE TABLE `temadia` (
  `id` int(11) NOT NULL,
  `comentarioTema` varchar(255) DEFAULT NULL,
  `fechaTemaDia` date DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `temasMateria_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temasmateria`
--

CREATE TABLE `temasmateria` (
  `id` int(11) NOT NULL,
  `fechaHastaTemMat` date DEFAULT NULL,
  `fechaDesdeTemMat` date DEFAULT NULL,
  `nombreTema` varchar(255) DEFAULT NULL,
  `programaMateria_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiempolimitecodigo`
--

CREATE TABLE `tiempolimitecodigo` (
  `id` int(11) NOT NULL,
  `minutosLimite` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiempolimitecodigo`
--

INSERT INTO `tiempolimitecodigo` (`id`, `minutosLimite`) VALUES
(1, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoasistencia`
--

CREATE TABLE `tipoasistencia` (
  `id` int(11) NOT NULL,
  `fechaAltaTipoAsistencia` date DEFAULT NULL,
  `fechaBajaTipoAsistencia` date DEFAULT NULL,
  `nombreTipoAsistencia` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoasistencia`
--

INSERT INTO `tipoasistencia` (`id`, `fechaAltaTipoAsistencia`, `fechaBajaTipoAsistencia`, `nombreTipoAsistencia`) VALUES
(1, '2020-08-03', NULL, 'PRESENTE'),
(2, '2020-08-03', NULL, 'AUSENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vigenciasesion`
--

CREATE TABLE `vigenciasesion` (
  `id` int(11) NOT NULL,
  `duracionSesion` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrativo`
--
ALTER TABLE `administrativo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKrmoejtr2yebukeu2kuvo3xwg7` (`permiso_id`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKctdmkskdhf5bla743m05m1u3x` (`permiso_id`);

--
-- Indices de la tabla `alumnocursoactual`
--
ALTER TABLE `alumnocursoactual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK36obnguwdre5apx5dchq91odn` (`alumno_id`),
  ADD KEY `FKt7ydcu477pnwgp95bumcwako7` (`curso_id`);

--
-- Indices de la tabla `alumnocursoestado`
--
ALTER TABLE `alumnocursoestado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKh3ew326q03dqseb9wyxsdcric` (`alumnoCursoActual_id`),
  ADD KEY `FK1nlk4159vb50rrgimdmx9tuib` (`cursoEstadoAlumno_id`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKnq42e1ofgrph75me0ryq4xd3r` (`alumno_id`),
  ADD KEY `FK5inf5bn7xwmwnrnebu1rk5cjj` (`curso_id`);

--
-- Indices de la tabla `asistenciadia`
--
ALTER TABLE `asistenciadia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKq321ay6csahth7tshhr0rbn6w` (`asistencia_id`),
  ADD KEY `FKtqtd79xsh4ircl22go5jyx1qh` (`tipoAsistencia_id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargoprofesor`
--
ALTER TABLE `cargoprofesor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKrbxf8x1h5hpn28fyjyrhr7r3p` (`cargo_id`),
  ADD KEY `FKt5cax41qk424i7e1ghn28ow9n` (`curso_id`),
  ADD KEY `FKjcr7feyg610sv4gde6ts2lvbj` (`profesor_id`);

--
-- Indices de la tabla `cargoprofesorestado`
--
ALTER TABLE `cargoprofesorestado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `codigoasitencia`
--
ALTER TABLE `codigoasitencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKjxci9ixskm4u2q3jeu3vvejf6` (`curso_id`);

--
-- Indices de la tabla `contraseniarestablecida`
--
ALTER TABLE `contraseniarestablecida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKmldqjsr08gjdktcgqf6u84f2k` (`administrativo_id`),
  ADD KEY `FKf6hu0tkygeqlcjtn4ju2pvpsi` (`alumno_id`),
  ADD KEY `FKq9empioxj25p70f0hlqmumuuy` (`profesor_id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKb0pu5rd27n5ld9n4oamd62dwj` (`division_id`),
  ADD KEY `FK48osbikkitlflgwqf0vh8qt7j` (`materia_id`);

--
-- Indices de la tabla `cursodia`
--
ALTER TABLE `cursodia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursoestadoalumno`
--
ALTER TABLE `cursoestadoalumno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKfr54cpkq6e5mmhivhi546oboy` (`modalidad_id`);

--
-- Indices de la tabla `estadocargoprofesor`
--
ALTER TABLE `estadocargoprofesor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horariocurso`
--
ALTER TABLE `horariocurso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKc1fqqmvfrs27v0ujycjokrq0j` (`curso_id`),
  ADD KEY `FKh09fpmkq3ex3t1ets58oa0q0p` (`cursoDia_id`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `justificativo`
--
ALTER TABLE `justificativo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKtm1gv5wen4ld811v7ampmrbbr` (`alumno_id`);

--
-- Indices de la tabla `justificativoasistenciadia`
--
ALTER TABLE `justificativoasistenciadia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKsdpoolygcb0uadr6goyeodvow` (`asistenciaDia_id`),
  ADD KEY `FKcosqyw65g6la8dfcvaonnx3j9` (`justificativo_id`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificacionprofe`
--
ALTER TABLE `notificacionprofe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKr8sm4xvbauo615nevjvo6ak7t` (`curso_id`),
  ADD KEY `FK8q19xnfemjpbhl93ueu21fr4g` (`profesor_id`);

--
-- Indices de la tabla `paramminimoasistencia`
--
ALTER TABLE `paramminimoasistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKdsdauip557b770enom24gw1h8` (`cursoEstadoAlumno_id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK62q9qdgk50ph2cra8pt464rpp` (`permiso_id`);

--
-- Indices de la tabla `programamateria`
--
ALTER TABLE `programamateria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKfqb3t1us027qjp8jctlqi46ui` (`materia_id`);

--
-- Indices de la tabla `temadia`
--
ALTER TABLE `temadia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKjpsvm6kadspqw0h80983xg4er` (`curso_id`),
  ADD KEY `FKlrpqrs0v24025xc081vf16dh1` (`temasMateria_id`);

--
-- Indices de la tabla `temasmateria`
--
ALTER TABLE `temasmateria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK23mxrw3xvlmkaiyy284c4r0w7` (`programaMateria_id`);

--
-- Indices de la tabla `tiempolimitecodigo`
--
ALTER TABLE `tiempolimitecodigo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipoasistencia`
--
ALTER TABLE `tipoasistencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vigenciasesion`
--
ALTER TABLE `vigenciasesion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrativo`
--
ALTER TABLE `administrativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT de la tabla `alumnocursoactual`
--
ALTER TABLE `alumnocursoactual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `alumnocursoestado`
--
ALTER TABLE `alumnocursoestado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `asistenciadia`
--
ALTER TABLE `asistenciadia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cargoprofesor`
--
ALTER TABLE `cargoprofesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cargoprofesorestado`
--
ALTER TABLE `cargoprofesorestado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `codigoasitencia`
--
ALTER TABLE `codigoasitencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contraseniarestablecida`
--
ALTER TABLE `contraseniarestablecida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `cursodia`
--
ALTER TABLE `cursodia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cursoestadoalumno`
--
ALTER TABLE `cursoestadoalumno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `division`
--
ALTER TABLE `division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estadocargoprofesor`
--
ALTER TABLE `estadocargoprofesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horariocurso`
--
ALTER TABLE `horariocurso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `justificativo`
--
ALTER TABLE `justificativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `justificativoasistenciadia`
--
ALTER TABLE `justificativoasistenciadia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `notificacionprofe`
--
ALTER TABLE `notificacionprofe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `paramminimoasistencia`
--
ALTER TABLE `paramminimoasistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `programamateria`
--
ALTER TABLE `programamateria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `temadia`
--
ALTER TABLE `temadia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `temasmateria`
--
ALTER TABLE `temasmateria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiempolimitecodigo`
--
ALTER TABLE `tiempolimitecodigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipoasistencia`
--
ALTER TABLE `tipoasistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vigenciasesion`
--
ALTER TABLE `vigenciasesion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
