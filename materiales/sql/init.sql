-- Volcar la base de datos para la tabla `tmodulo`
INSERT INTO `tmodulo` VALUES (6, 'CONFIGURACION', 1, 1, NULL, NULL);
INSERT INTO `tmodulo` VALUES (7, 'SEGURIDAD', 1, 2, NULL, NULL);

-- Volcar la base de datos para la tabla `tservicio`
INSERT INTO `tservicio` VALUES (1, 6, 'MODULO', 'vistaTmodulo.php', 1, 1, NULL);
INSERT INTO `tservicio` VALUES (2, 6, 'SERVICIO', 'vistaTservicio.php', 1, 2, NULL);
INSERT INTO `tservicio` VALUES (3, 7, 'ROL', 'vistaTrol.php', 1, 1, NULL);
INSERT INTO `tservicio` VALUES (4, 7, 'USUARIO', 'vistaTusuario.php', 1, 2, NULL);

-- Volcar la base de datos para la tabla `trol`
INSERT INTO `trol` VALUES (3, 'ADMINISTRADOR', '1');

-- Volcar la base de datos para la tabla `trol_servicio`
INSERT INTO `trol_servicio` VALUES (5, 3, 1, 0);
INSERT INTO `trol_servicio` VALUES (6, 3, 2, 0);
INSERT INTO `trol_servicio` VALUES (8, 3, 3, 0);
INSERT INTO `trol_servicio` VALUES (9, 3, 4, 0);

-- Volcar la base de datos para la tabla `tusuario`
INSERT INTO `tusuario` VALUES ('wmcarlos', 'carlos19455541', 3, 'NOMBRE DE MI PRIMERA MASCOTA', 'MANCHITA', 0, '1', 'CARLOS VARGAS', 'LIBROSDELPROGRAMADOR@GMAIL.COM', 1);