-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 31 oct. 2024 à 12:23
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `memory_game`
--

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `id` int(11) NOT NULL,
  `nom_jeu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`id`, `nom_jeu`) VALUES
(1, 0),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `id_jeu` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date_heure_message` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `id_jeu`, `id_expediteur`, `message`, `date_heure_message`) VALUES
(1, 1, 1, 'Bonjour, tout le monde !', '2024-10-28 08:30:00.000000'),
(2, 1, 1, 'Quelquun pour une partie ?', '2024-10-28 09:15:00.000000'),
(3, 1, 1, 'Bonne chance à tous !', '2024-10-28 12:45:00.000000'),
(4, 1, 2, 'Salut, prêt à jouer !', '2024-10-28 10:20:00.000000'),
(5, 1, 2, 'Cétait intense la dernière partie.', '2024-10-28 11:55:00.000000'),
(6, 1, 2, 'Quel niveau jouez-vous ?', '2024-10-28 13:40:00.000000'),
(7, 1, 3, 'Jaime bien ce jeu.', '2024-10-28 15:10:00.000000'),
(8, 1, 3, 'Qui veut un défi ?', '2024-10-28 16:30:00.000000'),
(9, 1, 3, 'Mon score saméliore.', '2024-10-28 18:05:00.000000'),
(10, 1, 4, 'Jai battu mon record !', '2024-10-28 19:50:00.000000'),
(11, 1, 4, 'Il est difficile ce niveau.', '2024-10-29 08:00:00.000000'),
(12, 1, 4, 'Bravo pour votre victoire !', '2024-10-29 10:15:00.000000'),
(13, 1, 5, 'Cest super amusant !', '2024-10-29 11:35:00.000000'),
(14, 1, 5, 'Quelquun a des astuces ?', '2024-10-29 13:25:00.000000'),
(15, 1, 5, 'On se refait une partie ?', '2024-10-29 15:40:00.000000'),
(16, 1, 1, 'Je suis prêt pour le prochain niveau.', '2024-10-29 17:20:00.000000'),
(17, 1, 2, 'Quelquun veut jouer en équipe ?', '2024-10-29 18:45:00.000000'),
(18, 1, 3, 'Les points sont difficiles à obtenir.', '2024-10-29 20:10:00.000000'),
(19, 1, 4, 'Félicitations pour ton score !', '2024-10-30 09:00:00.000000'),
(20, 1, 5, 'Je suis là pour la victoire.', '2024-10-30 11:30:00.000000'),
(21, 1, 1, 'On sentraîne ensemble ?', '2024-10-30 13:10:00.000000'),
(22, 1, 2, 'La compétition est rude.', '2024-10-30 14:25:00.000000'),
(23, 1, 3, 'Ce jeu est génial !', '2024-10-30 16:45:00.000000'),
(24, 1, 4, 'À bientôt pour une nouvelle partie.', '2024-10-30 18:05:00.000000'),
(25, 1, 5, 'On progresse chaque jour.', '2024-10-30 19:55:00.000000');

-- --------------------------------------------------------

--
-- Structure de la table `messages_prives`
--

CREATE TABLE `messages_prives` (
  `id` int(11) NOT NULL,
  `id_utilisateur_1` int(11) NOT NULL,
  `id_utilisateur_2` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `est_lu` tinyint(1) DEFAULT 0,
  `date_heure_envoi` datetime NOT NULL,
  `date_heure_lecture` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages_prives`
--

INSERT INTO `messages_prives` (`id`, `id_utilisateur_1`, `id_utilisateur_2`, `contenu`, `est_lu`, `date_heure_envoi`, `date_heure_lecture`) VALUES
(2, 1, 2, 'Salut je me suis trompé', 0, '2024-10-28 09:05:00', NULL),
(3, 1, 2, 'Je suis disponible ce soir si tu veux faire une partie.', 0, '2024-10-28 09:10:00', NULL),
(4, 1, 2, 'J\'ai trouvé une astuce qui pourrait t\'aider !', 0, '2024-10-28 09:15:00', NULL),
(5, 1, 2, 'Tu as vu les derniers résultats du tournoi ?', 0, '2024-10-28 09:20:00', NULL),
(6, 1, 2, 'Je pense que je vais essayer un nouveau personnage.', 0, '2024-10-28 09:25:00', NULL),
(7, 1, 2, 'On pourrait former une équipe pour le prochain événement.', 0, '2024-10-28 09:30:00', NULL),
(8, 1, 2, 'Tu as des conseils pour le niveau 3 ?', 0, '2024-10-28 09:35:00', NULL),
(9, 1, 2, 'Je suis sûr que nous pouvons battre le record ensemble.', 0, '2024-10-28 09:40:00', NULL),
(10, 1, 2, 'J\'ai hâte de jouer avec toi.', 0, '2024-10-28 09:45:00', NULL),
(11, 2, 1, 'Salut ! Je vais bien, merci.', 0, '2024-10-28 09:50:00', NULL),
(12, 2, 1, 'Oui, j\'ai joué, c\'est vraiment amusant !', 0, '2024-10-28 09:55:00', NULL),
(13, 2, 1, 'Ce soir, ça marche pour moi.', 0, '2024-10-28 10:00:00', NULL),
(14, 2, 1, 'Quelle est l\'astuce dont tu parles ?', 0, '2024-10-28 10:05:00', NULL),
(15, 2, 1, 'Oui, c\'était incroyable !', 0, '2024-10-28 10:10:00', NULL),
(16, 2, 1, 'Nouveau personnage ? Ça m\'intéresse.', 0, '2024-10-28 10:15:00', NULL),
(17, 2, 1, 'Je suis partant pour une équipe.', 0, '2024-10-28 10:20:00', NULL),
(18, 2, 1, 'Niveau 3 ? Il est difficile, mais je peux t\'aider.', 0, '2024-10-28 10:25:00', NULL),
(19, 2, 1, 'On peut essayer de battre le record ensemble.', 0, '2024-10-28 10:30:00', NULL),
(20, 2, 1, 'Moi aussi, je suis impatient !', 0, '2024-10-28 10:35:00', NULL),
(21, 4, 5, 'Salut, comment ça va aujourd\'hui ?', 0, '2024-10-29 08:00:00', NULL),
(22, 4, 5, 'As-tu terminé le dernier niveau ?', 0, '2024-10-29 08:10:00', NULL),
(23, 4, 5, 'J\'ai trouvé un moyen de battre le boss final, tu veux l\'astuce ?', 0, '2024-10-29 08:15:00', NULL),
(24, 4, 5, 'À quelle heure seras-tu disponible ce soir ?', 0, '2024-10-29 08:20:00', NULL),
(25, 4, 5, 'On pourrait s\'entraîner pour le tournoi ensemble.', 0, '2024-10-29 08:25:00', NULL),
(26, 5, 4, 'Salut ! Ça va, et toi ?', 0, '2024-10-29 08:30:00', NULL),
(27, 5, 4, 'Non, pas encore fini, c\'est difficile !', 0, '2024-10-29 08:35:00', NULL),
(28, 5, 4, 'Je veux bien l\'astuce, merci !', 0, '2024-10-29 08:40:00', NULL),
(29, 5, 4, 'Je serai en ligne vers 19h ce soir.', 0, '2024-10-29 08:45:00', NULL),
(30, 5, 4, 'Le tournoi va être intense, je suis partant !', 0, '2024-10-29 08:50:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE `score` (
  `id` int(11) NOT NULL,
  `id_joueur` int(11) NOT NULL,
  `id_jeu` int(11) NOT NULL,
  `difficulte_partie` int(3) NOT NULL,
  `score_partie` int(50) NOT NULL,
  `date_heure_partie` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `score`
--

INSERT INTO `score` (`id`, `id_joueur`, `id_jeu`, `difficulte_partie`, `score_partie`, `date_heure_partie`) VALUES
(1, 1, 1, 1, 850, '2024-10-28 10:35:00.000000'),
(2, 1, 1, 2, 920, '2024-10-28 14:20:00.000000'),
(3, 1, 1, 3, 780, '2024-10-29 09:00:00.000000'),
(4, 1, 1, 1, 890, '2024-10-30 16:10:00.000000'),
(5, 1, 1, 2, 950, '2024-10-31 18:50:00.000000'),
(6, 2, 1, 1, 670, '2024-10-28 12:15:00.000000'),
(7, 2, 1, 2, 780, '2024-10-28 15:45:00.000000'),
(8, 2, 1, 3, 620, '2024-10-29 11:30:00.000000'),
(9, 2, 1, 1, 710, '2024-10-30 19:05:00.000000'),
(10, 2, 1, 2, 800, '2024-10-31 08:25:00.000000'),
(11, 3, 1, 2, 930, '2024-10-28 13:40:00.000000'),
(12, 3, 1, 1, 820, '2024-10-28 17:10:00.000000'),
(13, 3, 1, 3, 750, '2024-10-29 14:50:00.000000'),
(14, 3, 1, 1, 880, '2024-10-30 20:20:00.000000'),
(15, 3, 1, 2, 890, '2024-10-31 11:45:00.000000'),
(16, 4, 1, 2, 680, '2024-10-28 09:55:00.000000'),
(17, 4, 1, 1, 740, '2024-10-28 16:25:00.000000'),
(18, 4, 1, 3, 590, '2024-10-29 10:40:00.000000'),
(19, 4, 1, 2, 800, '2024-10-30 13:35:00.000000'),
(20, 4, 1, 1, 760, '2024-10-31 19:15:00.000000'),
(21, 5, 1, 1, 850, '2024-10-28 11:30:00.000000'),
(22, 5, 1, 2, 820, '2024-10-28 14:50:00.000000'),
(23, 5, 1, 3, 780, '2024-10-29 12:45:00.000000'),
(24, 5, 1, 1, 830, '2024-10-30 17:55:00.000000'),
(25, 5, 1, 2, 870, '2024-10-31 20:05:00.000000');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `mdp` varchar(30) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `date_heure_inscription` datetime(6) NOT NULL,
  `date_heure_dernier_connexion` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `mdp`, `pseudo`, `date_heure_inscription`, `date_heure_dernier_connexion`) VALUES
(1, 'siwar@gmail.com', 'mdpDeSiwar', 'Xx_Siwar_du_95_xX', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, 'killian.goulet.dubasque@gmail.com', '12345678', 'jean-killian', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(3, 'marioooo@gmail.com', 'superMarioOnPS4', 'Marioooo_le_bg', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(4, 'Sir.excremus@gmail.com', 'caca>pipi', 'excremus_lodorant', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(5, 'AD.laurent@gmail.com', 'big berta', 'AD_le_goat', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_expediteur` (`id_expediteur`),
  ADD KEY `fk_id_jeu` (`id_jeu`);

--
-- Index pour la table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_joueur` (`id_joueur`),
  ADD KEY `id_jeu` (`id_jeu`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
