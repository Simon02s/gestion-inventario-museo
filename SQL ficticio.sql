-- Estructura de tabla para la tabla `catalogacion`
CREATE TABLE `catalogacion` (
  `id` int(11) NOT NULL,
  `nombre_institucion` varchar(255) NOT NULL DEFAULT 'Museo Pringles',
  `numero_inventario` varchar(50) NOT NULL,
  `numero_inventario_anterior` varchar(50) DEFAULT NULL,
  `registro_provisorio` varchar(50) DEFAULT NULL,
  `catalogacion_clasificacion` varchar(100) NOT NULL,
  `coleccion_tipologia` varchar(100) DEFAULT NULL,
  `nombre_objeto` varchar(255) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `autor_fabricante_cultura` varchar(255) DEFAULT NULL,
  `marco_historico` text DEFAULT NULL,
  `lugar_ejecucion` varchar(255) DEFAULT NULL,
  `fecha_ejecucion_periodo` varchar(50) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `tecnica` varchar(255) DEFAULT NULL,
  `inscripciones_marcas` text DEFAULT NULL,
  `dimensiones` varchar(100) DEFAULT NULL,
  `dimensiones_complementarias` varchar(100) DEFAULT NULL,
  `peso` varchar(50) DEFAULT NULL,
  `duracion` varchar(50) DEFAULT NULL,
  `talla` varchar(50) DEFAULT NULL,
  `bibliografia_referencia` text DEFAULT NULL,
  `estado_conservacion_objeto` text DEFAULT NULL,
  `estado_conservacion_complementarios` text DEFAULT NULL,
  `reparaciones_intervenciones` text DEFAULT NULL,
  `forma_ingreso` varchar(255) DEFAULT NULL,
  `norma_legal_ingreso` varchar(255) DEFAULT NULL,
  `norma_legal_baja` varchar(255) DEFAULT NULL,
  `motivo_baja` text DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `procedencia` varchar(255) DEFAULT NULL,
  `numero_legal_ingreso` varchar(255) DEFAULT NULL,
  `responsable_ingreso` varchar(255) DEFAULT NULL,
  `restriccion_uso` text DEFAULT NULL,
  `marcaje` text DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `ubicacion_actual` varchar(255) DEFAULT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `restriccion_imagen` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `usuarios`
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Índices para tablas
ALTER TABLE `catalogacion`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);



