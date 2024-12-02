ñ/*
 Navicat Premium Dump SQL

 Source Server         : localhost_mysql
 Source Server Type    : MySQL
 Source Server Version : 80300 (8.3.0)
 Source Host           : localhost:3306
 Source Schema         : project

 Target Server Type    : MySQL
 Target Server Version : 80300 (8.3.0)
 File Encoding         : 65001

 Date: 02/12/2024 02:53:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for administrators
-- ----------------------------
DROP TABLE IF EXISTS `administrators`;
CREATE TABLE `administrators`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of administrators
-- ----------------------------
INSERT INTO `administrators` VALUES (1, 'Sam', 'test123', '2024-12-02 02:50:27', '2024-12-02 02:50:27', 1);

-- ----------------------------
-- Table structure for goals
-- ----------------------------
DROP TABLE IF EXISTS `goals`;
CREATE TABLE `goals`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `goal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `goals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of goals
-- ----------------------------
INSERT INTO `goals` VALUES (1, 'Convertirse en un instructor respetado.', '2024-11-23 11:42:41', '2024-11-25 19:22:34', 1);
INSERT INTO `goals` VALUES (3, 'Honrar el legado de su padre.', '2024-11-23 11:43:00', '2024-11-25 19:22:34', 1);
INSERT INTO `goals` VALUES (4, 'Proteger a sus compañeros.', '2024-11-23 11:43:18', '2024-11-25 19:22:34', 1);
INSERT INTO `goals` VALUES (5, 'Mantener la superioridad aérea de su país.', '2024-11-23 11:43:35', '2024-11-25 19:22:34', 1);
INSERT INTO `goals` VALUES (6, 'Balancear su vida personal y profesional.', '2024-11-23 11:43:51', '2024-11-25 19:23:02', 1);
INSERT INTO `goals` VALUES (8, 'Redimir su legado industrial.', '2024-11-25 19:21:33', '2024-11-25 19:23:17', 2);
INSERT INTO `goals` VALUES (9, 'Proteger al mundo de amenazas tecnológicas.', '2024-11-25 19:22:03', '2024-11-25 19:23:17', 2);
INSERT INTO `goals` VALUES (10, 'Inspirar a futuras generaciones de inventores.', '2024-11-25 19:22:13', '2024-11-25 19:23:17', 2);
INSERT INTO `goals` VALUES (11, 'Garantizar la sostenibilidad energética global.', '2024-11-25 19:22:22', '2024-11-25 19:23:17', 2);
INSERT INTO `goals` VALUES (12, 'Mantener su vida personal estable.', '2024-11-25 19:23:12', '2024-11-25 19:23:17', 2);
INSERT INTO `goals` VALUES (13, 'Revolucionar el fútbol mundial.', '2024-11-25 19:23:35', '2024-11-25 19:24:14', 3);
INSERT INTO `goals` VALUES (14, 'Crear una escuela global de fútbol total.', '2024-11-25 19:23:43', '2024-11-25 19:24:14', 3);
INSERT INTO `goals` VALUES (15, 'Proveer acceso al deporte a comunidades desfavorecidas.', '2024-11-25 19:23:51', '2024-11-25 19:24:14', 3);
INSERT INTO `goals` VALUES (16, 'Ganar títulos como jugador y entrenador.', '2024-11-25 19:24:00', '2024-11-25 19:24:14', 3);
INSERT INTO `goals` VALUES (17, 'Transmitir su filosofía de vida.', '2024-11-25 19:24:10', '2024-11-25 19:24:14', 3);

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES (1, 'Manual de Vuelo', 'Guía para pilotos novatos en maniobras avanzadas.', '2024-11-24 20:01:32', '2024-11-25 19:54:11');
INSERT INTO `projects` VALUES (2, 'Legado Aéreo', 'Entrenamiento a futuros líderes de la aviación.', '2024-11-24 20:02:24', '2024-11-25 19:54:22');
INSERT INTO `projects` VALUES (3, 'Veteranos del Aire', 'Apoyo a pilotos retirados.', '2024-11-24 20:05:49', '2024-11-25 19:54:38');
INSERT INTO `projects` VALUES (4, 'Innovación en Vuelo', 'Colaboración en nuevas tecnologías aéreas.', '2024-11-25 19:54:48', '2024-11-25 19:54:48');
INSERT INTO `projects` VALUES (5, 'Liderazgo Bajo Presión', 'Conferencias sobre liderazgo militar.', '2024-11-25 19:55:05', '2024-11-25 19:55:05');
INSERT INTO `projects` VALUES (6, 'Proyecto Reactor Stark', 'Energía limpia para comunidades.', '2024-11-25 19:55:26', '2024-11-25 19:55:26');
INSERT INTO `projects` VALUES (7, 'Ultron', 'Inteligencia Artificial de alta eficiencia', '2024-11-25 19:55:55', '2024-11-25 19:55:55');
INSERT INTO `projects` VALUES (8, 'Legión de hierro', 'Armadura que cubra el mundo', '2024-11-25 19:56:05', '2024-11-25 19:56:19');
INSERT INTO `projects` VALUES (9, 'Iron Man', 'Traje protector todopoderoso', '2024-11-25 19:56:50', '2024-11-25 19:56:50');
INSERT INTO `projects` VALUES (10, 'Nuevo elemento', 'Creación de un nuevo elemento', '2024-11-25 19:58:14', '2024-11-25 19:58:14');
INSERT INTO `projects` VALUES (11, 'Academias Total Football', 'Formación de jóvenes futbolistas.', '2024-11-25 19:58:32', '2024-11-25 19:58:32');
INSERT INTO `projects` VALUES (12, 'Filosofía del Fútbol', 'Libro sobre su visión del deporte.', '2024-11-25 19:58:48', '2024-11-25 19:58:48');
INSERT INTO `projects` VALUES (13, 'Fútbol para Todos', 'Acceso gratuito en comunidades vulnerables.', '2024-11-25 19:58:58', '2024-11-25 19:58:58');
INSERT INTO `projects` VALUES (14, 'Cruyff Coaches', 'Programa de formación para entrenadores.', '2024-11-25 19:59:16', '2024-11-25 19:59:16');
INSERT INTO `projects` VALUES (15, 'Fundación Cruyff', 'Apoyo a niños a través del deporte.', '2024-11-25 19:59:24', '2024-11-25 19:59:24');

-- ----------------------------
-- Table structure for skills
-- ----------------------------
DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `skill` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of skills
-- ----------------------------
INSERT INTO `skills` VALUES (1, 'Pilotaje', '2024-11-21 23:27:03', '2024-11-25 19:30:32');
INSERT INTO `skills` VALUES (2, 'Precisión', '2024-11-21 23:34:46', '2024-11-25 19:30:32');
INSERT INTO `skills` VALUES (3, 'Estrategia', '2024-11-21 23:35:13', '2024-11-25 19:30:32');
INSERT INTO `skills` VALUES (4, 'Trabajo en equipo', '2024-11-22 00:03:10', '2024-11-25 19:30:32');
INSERT INTO `skills` VALUES (5, 'Adaptabilidad', '2024-11-25 19:27:42', '2024-11-25 19:30:32');
INSERT INTO `skills` VALUES (6, 'Innovación', '2024-11-25 19:32:31', '2024-11-25 19:32:54');
INSERT INTO `skills` VALUES (7, 'Construcción', '2024-11-25 19:32:44', '2024-11-25 19:32:44');
INSERT INTO `skills` VALUES (8, 'Liderazgo', '2024-11-25 19:33:05', '2024-11-25 19:33:05');
INSERT INTO `skills` VALUES (9, 'Creatividad', '2024-11-25 19:34:21', '2024-11-25 19:34:21');
INSERT INTO `skills` VALUES (10, 'Comunicación', '2024-11-25 19:34:41', '2024-11-25 19:34:41');

-- ----------------------------
-- Table structure for strengths
-- ----------------------------
DROP TABLE IF EXISTS `strengths`;
CREATE TABLE `strengths`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `strength` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of strengths
-- ----------------------------
INSERT INTO `strengths` VALUES (1, 'Valentía', '2024-11-24 00:00:01', '2024-11-25 19:47:50');
INSERT INTO `strengths` VALUES (2, 'Resiliencia', '2024-11-24 00:00:14', '2024-11-25 19:47:50');
INSERT INTO `strengths` VALUES (3, 'Liderazgo', '2024-11-24 00:00:28', '2024-11-25 19:47:50');
INSERT INTO `strengths` VALUES (4, 'Lealtad', '2024-11-25 19:47:44', '2024-11-25 19:47:50');
INSERT INTO `strengths` VALUES (5, 'Determinación', '2024-11-25 19:47:46', '2024-11-25 19:47:50');
INSERT INTO `strengths` VALUES (6, 'Inteligencia', '2024-11-25 19:48:06', '2024-11-25 19:48:23');
INSERT INTO `strengths` VALUES (7, 'Carisma', '2024-11-25 19:48:09', '2024-11-25 19:48:23');
INSERT INTO `strengths` VALUES (8, 'Creatividad', '2024-11-25 19:48:11', '2024-11-25 19:48:23');
INSERT INTO `strengths` VALUES (9, 'Adaptabilidad', '2024-11-25 19:48:13', '2024-11-25 19:48:23');
INSERT INTO `strengths` VALUES (10, 'Visión', '2024-11-25 19:48:41', '2024-11-25 19:48:41');
INSERT INTO `strengths` VALUES (11, 'Motivación', '2024-11-25 19:49:09', '2024-11-25 19:49:09');

-- ----------------------------
-- Table structure for user_project
-- ----------------------------
DROP TABLE IF EXISTS `user_project`;
CREATE TABLE `user_project`  (
  `project_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`project_id`, `user_id`) USING BTREE,
  INDEX `user_project_ibfk_2`(`user_id` ASC) USING BTREE,
  CONSTRAINT `user_project_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `user_project_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_project
-- ----------------------------
INSERT INTO `user_project` VALUES (1, 1);
INSERT INTO `user_project` VALUES (2, 1);
INSERT INTO `user_project` VALUES (3, 1);
INSERT INTO `user_project` VALUES (4, 1);
INSERT INTO `user_project` VALUES (5, 1);
INSERT INTO `user_project` VALUES (6, 2);
INSERT INTO `user_project` VALUES (7, 2);
INSERT INTO `user_project` VALUES (8, 2);
INSERT INTO `user_project` VALUES (9, 2);
INSERT INTO `user_project` VALUES (10, 2);
INSERT INTO `user_project` VALUES (11, 3);
INSERT INTO `user_project` VALUES (12, 3);
INSERT INTO `user_project` VALUES (13, 3);
INSERT INTO `user_project` VALUES (14, 3);
INSERT INTO `user_project` VALUES (15, 3);

-- ----------------------------
-- Table structure for user_skill
-- ----------------------------
DROP TABLE IF EXISTS `user_skill`;
CREATE TABLE `user_skill`  (
  `user_id` int NOT NULL,
  `skill_id` int NOT NULL,
  `intensity` int NOT NULL,
  PRIMARY KEY (`user_id`, `skill_id`) USING BTREE,
  INDEX `skill_id`(`skill_id` ASC) USING BTREE,
  CONSTRAINT `user_skill_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `user_skill_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_skill
-- ----------------------------
INSERT INTO `user_skill` VALUES (1, 1, 5);
INSERT INTO `user_skill` VALUES (1, 2, 6);
INSERT INTO `user_skill` VALUES (1, 3, 5);
INSERT INTO `user_skill` VALUES (1, 4, 4);
INSERT INTO `user_skill` VALUES (1, 5, 7);
INSERT INTO `user_skill` VALUES (2, 3, 6);
INSERT INTO `user_skill` VALUES (2, 5, 4);
INSERT INTO `user_skill` VALUES (2, 6, 5);
INSERT INTO `user_skill` VALUES (2, 7, 6);
INSERT INTO `user_skill` VALUES (2, 8, 7);
INSERT INTO `user_skill` VALUES (3, 3, 7);
INSERT INTO `user_skill` VALUES (3, 6, 5);
INSERT INTO `user_skill` VALUES (3, 8, 4);
INSERT INTO `user_skill` VALUES (3, 9, 6);
INSERT INTO `user_skill` VALUES (3, 10, 7);

-- ----------------------------
-- Table structure for user_strength
-- ----------------------------
DROP TABLE IF EXISTS `user_strength`;
CREATE TABLE `user_strength`  (
  `user_id` int NOT NULL,
  `strength_id` int NOT NULL,
  `value` int NOT NULL,
  PRIMARY KEY (`user_id`, `strength_id`) USING BTREE,
  INDEX `strength_id`(`strength_id` ASC) USING BTREE,
  CONSTRAINT `user_strength_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_strength_ibfk_2` FOREIGN KEY (`strength_id`) REFERENCES `strengths` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_strength_chk_1` CHECK (`value` between 0 and 100)
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_strength
-- ----------------------------
INSERT INTO `user_strength` VALUES (1, 1, 86);
INSERT INTO `user_strength` VALUES (1, 2, 45);
INSERT INTO `user_strength` VALUES (1, 3, 76);
INSERT INTO `user_strength` VALUES (1, 4, 62);
INSERT INTO `user_strength` VALUES (1, 5, 94);
INSERT INTO `user_strength` VALUES (2, 5, 74);
INSERT INTO `user_strength` VALUES (2, 6, 73);
INSERT INTO `user_strength` VALUES (2, 7, 89);
INSERT INTO `user_strength` VALUES (2, 8, 51);
INSERT INTO `user_strength` VALUES (2, 9, 67);
INSERT INTO `user_strength` VALUES (3, 2, 81);
INSERT INTO `user_strength` VALUES (3, 3, 96);
INSERT INTO `user_strength` VALUES (3, 8, 86);
INSERT INTO `user_strength` VALUES (3, 10, 78);
INSERT INTO `user_strength` VALUES (3, 11, 82);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `profession` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `biography` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `motivation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `phone` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `adress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT 1,
  `admin_id` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_id`(`admin_id` ASC) USING BTREE,
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `administrators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Pete', 'Mitchell', 'Piloto', 'Pete Mitchell es un piloto de combate de la Marina de los EE. UU. que creció soñando con seguir los pasos de su padre, un piloto legendario que murió en una misión clasificada. A pesar de su carácter indisciplinado y su tendencia a romper las reglas, \"Maverick\" es un piloto extremadamente talentoso, capaz de maniobras aéreas arriesgadas que nadie más se atrevería a intentar. En su vida personal, lucha por equilibrar su carrera con relaciones estables debido a su naturaleza competitiva e impulsiva.', 'Demostrar que su habilidad y valor están por encima de cualquier legado o duda que otros puedan tener sobre él. Quiere honrar la memoria de su padre mientras forja su propia reputación como el mejor piloto del mundo.', 'pete_mitchell.jpg', 2147483647, 'pete@mail.com', '101 Fighter Pilot Avenue', '2024-11-20 22:04:58', '2024-11-20 22:04:58', 1, 1);
INSERT INTO `users` VALUES (2, 'Tony', 'Stark', 'Avenger', 'Tony Stark, un genio inventor y multimillonario, hereda la empresa de tecnología Stark Industries a una edad temprana tras la muerte de sus padres. Originalmente despreocupado y egoísta, Tony sufre un cambio de perspectiva tras ser secuestrado por terroristas que usan sus propias armas. Al diseñar la primera armadura de Iron Man para escapar, encuentra un propósito más grande: usar su intelecto para proteger al mundo en lugar de contribuir a su destrucción.', 'Redimirse por los errores de su pasado y garantizar que su tecnología no sea usada para causar daño. Su objetivo es dejar un legado que inspire al mundo a ser mejor.', 'tony_stark.jpg', 2147483647, 'tonystark@mail.com', '10880 Malibu Point', '2024-11-20 23:32:36', '2024-11-25 19:11:19', 1, 1);
INSERT INTO `users` VALUES (3, 'Johan', 'Cruyff', 'Futbolista', 'Johan Cruyff creció en un barrio humilde de Ámsterdam, donde su amor por el fútbol lo llevó a destacar rápidamente en las calles y luego en las categorías inferiores del Ajax. Con un estilo de juego que combinaba creatividad, inteligencia y técnica, revolucionó el deporte tanto como jugador como entrenador, siendo el pionero del concepto de \"fútbol total\".', 'Cruyff busca no solo ganar, sino cambiar la forma en que el fútbol es entendido y jugado. Quiere que el deporte sea un arte, donde la inteligencia y el trabajo en equipo superen la fuerza bruta.', 'leyenda_maxima.jpg', 2147483647, 'johancruyff14@mail.com', '14 Oranjehofstraat', '2024-11-20 23:33:09', '2024-11-25 19:12:17', 1, 1);
INSERT INTO `users` VALUES (4, 'Franz', 'Beckenbauer', 'Futbolista', 'Franz Beckenbauer nació en Múnich y desde joven mostró una elegancia innata dentro y fuera del campo. Como jugador, redefinió el papel del \"líbero\", convirtiéndose en un líder indiscutible tanto en el Bayern Múnich como en la selección alemana. Posteriormente, tuvo una carrera igualmente exitosa como entrenador y dirigente.', 'Beckenbauer tiene como misión demostrar que el fútbol no solo se juega con los pies, sino también con la cabeza. Su objetivo es mantener la excelencia en todas las áreas del deporte y dejar un legado de disciplina, innovación y éxito.', 'franz_beckenbauer.jpg', 2147483647, 'kaiser@mail.com', '7 Kaiserstraße', '2024-11-20 23:45:22', '2024-11-25 19:12:43', 1, 1);
INSERT INTO `users` VALUES (5, 'José', 'José', 'Cantante', 'José Rómulo Sosa Ortiz, conocido artísticamente como José José, nació en una familia humilde en Ciudad de México. Desde joven, su amor por la música lo llevó a luchar contra las adversidades, incluyendo problemas familiares y de salud. Con una voz privilegiada, combinó romanticismo y melancolía, convirtiéndose en \"El Príncipe de la Canción\".', 'José José buscaba tocar los corazones de las personas y ser una voz para quienes no podían expresar sus emociones. Su lucha personal contra los obstáculos de la vida alimentaba su interpretación, conectando profundamente con su público.', 'el_principe.jpg', 2147483647, 'eltriste@mail.com', 'Calle Melodía #23', '2024-11-20 23:46:34', '2024-11-25 19:13:11', 1, 1);
INSERT INTO `users` VALUES (6, 'Ronaldinho', 'Gaúcho', 'Futbolista', 'Nacido como Ronaldo de Assis Moreira en Porto Alegre, Brasil, Ronaldinho creció en un entorno humilde, donde el fútbol era parte integral de la vida cotidiana. Desde niño, su talento y alegría en el campo lo destacaron, usando su creatividad, técnica y sonrisa contagiosa para iluminar el juego. Su paso por clubes como el Barcelona y el AC Milan dejó huellas imborrables, combinando espectáculo y eficacia en partes iguales.', 'Ronaldinho juega para celebrar la vida y compartir felicidad. Su objetivo siempre fue mostrar que el fútbol es arte, una manera de unir a las personas y expresar su amor por el deporte a través de su estilo único.', 'ronaldinho.jpg', 2147483647, 'dinho@mail.com', 'Rua Samba #10', '2024-11-20 23:49:15', '2024-11-25 19:13:49', 1, 1);
INSERT INTO `users` VALUES (7, 'Cristiano', 'Ronaldo', 'Futbolista', 'Cristiano Ronaldo dos Santos Aveiro nació en Madeira, Portugal, en una familia humilde. Desde joven mostró una ética de trabajo inquebrantable, combinando talento natural con una determinación feroz por superar sus limitaciones. Su camino al éxito estuvo marcado por el esfuerzo constante, convirtiéndose en uno de los mejores futbolistas de la historia, con una carrera que abarcó equipos como el Manchester United, Real Madrid y Juventus.', 'Cristiano busca ser el mejor en todo lo que hace, impulsado por el deseo de superar los obstáculos de su infancia. Su ambición está profundamente ligada a demostrar que la disciplina y el sacrificio pueden transformar cualquier sueño en realidad.', 'cristiano_ronaldo.jpg', 1254789643, 'elbicho@mail.com', '7 CR7 Avenue', '2024-11-25 19:14:13', '2024-11-25 19:14:13', 1, 1);
INSERT INTO `users` VALUES (8, 'Lionel', 'Messi', 'Futbolista', 'Lionel Andrés Messi creció en Rosario, Argentina, donde su habilidad con el balón destacó desde temprana edad. Diagnosticado con una deficiencia de la hormona del crecimiento, su familia apostó todo para apoyar su tratamiento, lo que lo llevó a Barcelona a una corta edad. Allí, Messi se convirtió en una leyenda del fútbol mundial, rompiendo récords y deslumbrando con su técnica y visión de juego.', 'Messi está motivado por la superación personal y el amor por el juego. Su objetivo es honrar a su familia y mostrar que, con esfuerzo y humildad, es posible superar cualquier barrera. Juega por la pasión y la conexión emocional con su tierra y su público.', 'the_goat.jpg', 1643813843, 'thebest@mail.com', 'Calle Rosario Central #10', '2024-11-25 19:14:37', '2024-11-25 19:14:37', 1, 1);
INSERT INTO `users` VALUES (9, 'Michael', 'Jackson', 'Cantante', 'Michael Joseph Jackson creció en Gary, Indiana, en una familia numerosa. Como parte de los Jackson 5, destacó desde niño gracias a su voz y carisma. Su carrera en solitario lo llevó a redefinir la música pop, el espectáculo y los videoclips, convirtiéndose en el \"Rey del Pop\". A pesar de sus enormes logros, su vida personal estuvo marcada por la búsqueda de amor y aceptación.', 'Michael quería unir a las personas a través de la música y dejar un impacto positivo en el mundo. Impulsado por la necesidad de superar las presiones de su infancia, buscaba crear un legado de arte, magia y mensajes de paz que trascendieran generaciones.', 'michael_jackson.jpg', 940316852, 'popprince@mail.com', '2300 Jackson Street', '2024-11-25 19:15:22', '2024-11-25 19:15:22', 1, 1);
INSERT INTO `users` VALUES (10, 'Carles', 'Puyol', 'Futbolista', 'Carles Puyol creció en La Pobla de Segur, un pequeño pueblo en Cataluña, España. Desde joven mostró una gran pasión por el deporte, aunque inicialmente no se destacó por su técnica, sino por su entrega y carácter. Su perseverancia lo llevó a convertirse en uno de los defensores más emblemáticos en la historia del fútbol, jugando toda su carrera en el FC Barcelona. Conocido por su liderazgo, humildad y ética de trabajo, Puyol fue el capitán ideal tanto dentro como fuera del campo.', 'Puyol estaba impulsado por su amor por el fútbol y su compromiso con el equipo. Su motivación principal era ser un ejemplo de profesionalismo y demostrar que la disciplina, el sacrificio y el trabajo en equipo son más importantes que el talento individual. Quería que su legado fuera recordado como el de un líder que nunca se rindió y siempre luchó con honor.', 'mi_idolo.jpg', 2147483647, 'puyol@mail.com', '10 Carrer de la Lluita', '2024-11-25 19:16:25', '2024-11-25 19:16:25', 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
