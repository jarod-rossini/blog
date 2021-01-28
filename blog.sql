-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 27 jan. 2021 à 21:07
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `article` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `article`, `id_utilisateur`, `id_categorie`, `date`) VALUES
(6, 'Vendu à plus de dix millions d’exemplaires depuis sa publication en série dans la presse dans les années 1930, l’album consacré par Hergé à l’ancienne.', 1, 4, '2021-01-22 16:44:23'),
(7, 'okay owei ceci est un teste je ne sais pas si c\'est le php qui commence a monter au cerveau mets les teste sont de plus en plus positifs ce qui voudrait peut etre dire qu\'un nouveau steve jobs commencerai a naitre owwwwww myyyy godddddd', 1, 19, '2021-01-23 20:57:41'),
(9, 'aieaieeeeeeee moderateurrrrrr', 10, 19, '2021-01-23 21:55:15'),
(11, 'ke la tesutelllleleee', 1, 15, '2021-01-24 09:36:51'),
(12, 'un dernier loptimisation', 1, 4, '2021-01-24 09:37:14'),
(13, 'des test des tetststst', 1, 14, '2021-01-24 12:03:11'),
(14, 'skssksksk', 1, 4, '2021-01-24 12:04:04'),
(15, 'sskskskk', 1, 14, '2021-01-24 12:04:13'),
(16, 's,ss,,s,s,', 1, 19, '2021-01-24 12:04:20'),
(17, 'skskskk', 1, 14, '2021-01-24 12:04:27'),
(18, 'skskskskksks', 1, 14, '2021-01-24 12:04:34'),
(19, 'okayyyyy', 1, 14, '2021-01-24 12:33:13'),
(20, 'ksksspkpks', 1, 4, '2021-01-24 12:33:25'),
(21, 'alalskdkk', 1, 15, '2021-01-24 12:33:32'),
(22, 'llldldldl', 1, 14, '2021-01-24 12:33:48'),
(23, 'kskksksksks', 1, 15, '2021-01-24 12:33:56'),
(24, 'kkksksksksk', 1, 15, '2021-01-24 12:34:02'),
(25, 'ksksioadofapos', 1, 15, '2021-01-24 12:34:08'),
(27, 'I am boo\r\nDragonnnnnnBALllLLlLLlZZZZZZ', 1, 19, '2021-01-25 17:17:18'),
(29, 'le dernier jespere kameamememmammamaammaaaaeeaaaaaaaaaaaaaaaaaaaaaaaaaa', 1, 19, '2021-01-25 22:06:01');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(4, 'agriculture'),
(14, 'Geographie'),
(15, 'Histoire'),
(19, 'drole');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES
(1, '        okay ceci est la premier tentavie de com aller pas derreurs premier couppppp', 20, 1, '2021-01-24 23:18:37'),
(3, 'sisilafamilelee', 26, 1, '2021-01-24 23:54:16'),
(4, '        okay deuxieme testeeeeeee', 26, 1, '2021-01-25 00:01:56'),
(5, 'c la fete a bangkok', 26, 1, '2021-01-25 00:05:42'),
(6, '   wesh la team je suis utilisateur du site je pense peut etre bientot devenir moderateur si je sui trop chanceux ', 26, 1, '2021-01-25 00:12:03'),
(7, '        jespere c bon la le p^seudooooo', 26, 11, '2021-01-25 00:13:51'),
(8, '        je laisse des commentaires je suis un thug oui merci', 28, 10, '2021-01-25 00:16:25'),
(10, 'sisi ceci est un commentaires de vegeta donc si tu veux pas de te baisser devant moi  fait attention a toi    ', 29, 1, '2021-01-26 09:12:02'),
(11, 'mamamammam', 29, 1, '2021-01-27 12:58:31');

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'modérateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `id_droits`) VALUES
(1, 'admin', '$2y$10$gORng3ThlKPw1triI1OR9..0m5l.JUMoL9u0CjjP/kDpw2Dqr3ArO', '', 1337),
(7, 'zorkinaa', '$2y$10$MwICA9vIsP0FlqcnNEGKQ.P9v6JdtrVi4u6pFmR6a0gwyiZyFSIKq', 'zorkin@hotmail.fr', 42),
(10, 'bobo', '$2y$10$biETxyv/WeLtbqXT.zF.7u95zLFzUuZoc4YvMpuWxS1tj1Udj66y2', 'bobo@gmail.com', 42),
(11, 'zorkin', '$2y$10$i8oE26sF3.wcR31Vt4CGVumpkneBspwBBbgJgpqpbg6ggEbw8I3sO', 'zorkin@hotmail.fr', 42),
(16, 'salut', '$2y$10$mnwWGj/sS7q.M6pu.Gm1x.Vmgby7dXu8PUXtMkPx7YXCy/.qsJZpS', 'sofiane1ziri@gmail.com', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `droits`
--
ALTER TABLE `droits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `droits`
--
ALTER TABLE `droits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1338;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
