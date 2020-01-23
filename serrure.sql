-- ----------------------------
-- Project  : Serrure AAC
-- Date     : 11/12/2019
-- Autor    : CARDINAL Florian
-- Nom      : serrure.sql
-- Location : /
-- ----------------------------

-- Settings
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


-- Création de la table 'card' pour contenir les carte RFID
CREATE TABLE `card` (
	`idCard` int(4) NOT NULL COMMENT '[int(4)]',
	`addedDate` datetime NOT NULL DEFAULT current_timestamp() COMMENT '[datetime]',
	`value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[varchar(255)]',
	`name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[varchar(64)]',
	`fname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[varchar(64)]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contenu de la table 'card'
INSERT INTO `card` (`idCard`, `addedDate`, `value`, `name`, `fname`) VALUES
	(1, '2019-12-19 08:37:04', '0c2dc3b16fc2bf', 'ardanouy', 'baptiste'),
	(2, '2020-01-15 01:34:21', '0c2dc29f4bc3b5', 'cardinal', 'florian'),
	(3, '2020-01-15 01:35:51', '0c2dc', 'ahamadi', 'djamildine');


-- Création de la table 'story' pour contenir l'historique des passage
CREATE TABLE `story` (
	`idStory` int(4) NOT NULL COMMENT '[int(4)]',
	`time` datetime NOT NULL DEFAULT current_timestamp() COMMENT '[datetime]',
	`value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '[varchar(255)]',
	`dir` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '[varchar(2)]',
	`access` tinyint(1) NOT NULL DEFAULT 0 COMMENT '[bool(1)]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contenu de la table 'story'
INSERT INTO `story` (`idStory`, `time`, `value`, `dir`, `access`) VALUES
	(1, '2019-12-11 10:38:20', '0c2dc3b16fc2bf', '1', 1),
	(2, '2019-12-11 10:38:33', '0c2dc29f4bc3b5', '1', 0),
	(3, '2019-12-11 10:38:39', '0c2dc29f4bc3b5', '1', 0),
	(4, '2019-12-11 10:38:45', '0c2dc3b16fc2bf', '1', 1),
	(5, '2019-12-11 10:41:27', '0c2dc3b16fc2bf', '1', 1),
	(6, '2019-12-11 10:48:46', '0c2dc3b16fc2bf', '1', 1),
	(7, '2019-12-11 10:49:06', '0c2dc3b16fc2bf', '1', 1),
	(8, '2019-12-11 10:49:11', '0c2dc3b16fc2bf', '1', 1),
	(9, '2019-12-11 10:49:16', '0c2dc3b16fc2bf', '1', 1),
	(10, '2019-12-11 10:49:21', 'button', '0', 1),
	(11, '2019-12-11 10:51:42', '0c2dc3b16fc2bf', '1', 1),
	(12, '2019-12-11 10:54:54', '0c2dc3b16fc2bf', '1', 1),
	(13, '2019-12-11 10:55:59', '', '1', 0),
	(14, '2019-12-11 10:56:14', '0c2dc29f4bc3b5', '1', 0),
	(15, '2019-12-11 10:56:41', '', '1', 0),
	(16, '2019-12-11 10:56:49', '', '1', 0),
	(17, '2019-12-11 10:56:55', '', '1', 0),
	(18, '2019-12-11 10:57:34', '', '1', 0),
	(19, '2019-12-11 10:57:40', '0c2dc29f4bc3b5', '1', 0),
	(20, '2019-12-11 10:57:45', '0c2dc29f4bc3b5', '1', 0),
	(21, '2019-12-11 10:57:54', '0c2dc3b16fc2bf', '1', 1),
	(22, '2019-12-11 10:57:59', '0c2dc29f4bc3b5', '1', 0),
	(23, '2019-12-11 11:57:34', '0c2dc3b16fc2bf', '1', 1),
	(24, '2019-12-11 11:57:40', 'button', '0', 1),
	(25, '2019-12-11 11:57:47', 'button', '0', 1),
	(26, '2019-12-16 11:33:29', '0c2dc3b16fc2bf', '1', 1),
	(27, '2019-12-16 11:36:20', 'button', '0', 1);


-- Création de la table 'unlock' contient la valeur d'ouverture de la gâche
CREATE TABLE `unlock` (
	`idLock` int(2) NOT NULL,
	`value` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Contenu de la table 'unlock'
INSERT INTO `unlock` (`idLock`, `value`) VALUES
	(1, 0);


-- Création de la table 'users' pour contenir les utilisateurs autorisés
CREATE TABLE `users` (
  `idUsers` int(4) NOT NULL COMMENT '[int(4)]',
  `nichandle` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[varchar(32)]',
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[varchar(64)] (base64(md5(value))))',
  `isAdmin` tinyint(1) NOT NULL COMMENT '[bool(1)]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contenu de la table 'users'
INSERT INTO `users` (`idUsers`, `nichandle`, `password`, `isAdmin`) VALUES
	(1, 'admin', 'MjEyMzJmMjk3YTU3YTVhNzQzODk0YTBlNGE4MDFmYzM=', 1);


-- Attribution des clés primaire pour chaque table créer
ALTER TABLE `card`
	ADD PRIMARY KEY (`idCard`);

ALTER TABLE `story`
	ADD PRIMARY KEY (`idStory`);

ALTER TABLE `unlock`
	ADD PRIMARY KEY (`idLock`);

ALTER TABLE `users`
	ADD PRIMARY KEY (`idUsers`);


-- Ajout de l'auto incrémentation pour les id des tables
ALTER TABLE `card`
	MODIFY `idCard` int(4) NOT NULL AUTO_INCREMENT COMMENT '[int(4)]', AUTO_INCREMENT=4;

ALTER TABLE `story`
	MODIFY `idStory` int(4) NOT NULL AUTO_INCREMENT COMMENT '[int(4)]', AUTO_INCREMENT=28;

ALTER TABLE `unlock`
	MODIFY `idLock` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `users`
	MODIFY `idUsers` int(4) NOT NULL AUTO_INCREMENT COMMENT '[int(4)]', AUTO_INCREMENT=2;


COMMIT;

-- END
