-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 17. srp 2017, 23:11
-- Verze serveru: 10.1.21-MariaDB
-- Verze PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `cg`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `opt_delete` text NOT NULL,
  `opt_edit` text NOT NULL,
  `opt_upload` text NOT NULL,
  `opt_title` text NOT NULL,
  `opt_content` text NOT NULL,
  `no_content` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `sections`
--

INSERT INTO `sections` (`id`, `name`, `opt_delete`, `opt_edit`, `opt_upload`, `opt_title`, `opt_content`, `no_content`) VALUES
(126, 'Messages', 'on', 'on', 'off', 'off', 'on', 7),
(131, 'ÃšÄetnictvÃ­', 'on', 'on', 'off', 'on', 'on', 1),
(167, 'Test', 'on', 'on', 'on', 'on', 'on', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `sitecontent`
--

CREATE TABLE `sitecontent` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `file` text NOT NULL,
  `section_name` text NOT NULL,
  `class` text NOT NULL,
  `title_heading` text NOT NULL,
  `content_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `sitecontent`
--

INSERT INTO `sitecontent` (`id`, `title`, `content`, `file`, `section_name`, `class`, `title_heading`, `content_date`) VALUES
(155, '', '<img src=\"http://localhost/music/cg/uploads/5983140fdb2d77.12260917.png\">&nbsp;<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">VÃ­tejte na naÅ¡Ã­ webovÃ© strÃ¡nce!</span>', 'NULL', 'Messages', 'messages', 'NULL', '0000-00-00 00:00:00'),
(156, '', '<img src=\"http://localhost/music/cg/uploads/5983140fdb2d77.12260917.png\">&nbsp;<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">HledÃ¡me brigÃ¡dnÃ­ky!</span>', 'NULL', 'Messages', 'messages', 'NULL', '0000-00-00 00:00:00'),
(157, '', '<img src=\"http://localhost/music/cg/uploads/5983140fdb2d77.12260917.png\">&nbsp;<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">VÃ­tejte na naÅ¡Ã­ webovÃ© strÃ¡nce!</span>', 'NULL', 'Messages', 'messages', 'NULL', '0000-00-00 00:00:00'),
(158, '', '<img src=\"http://localhost/music/cg/uploads/5983140fdb2d77.12260917.png\">&nbsp;<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">MÃ¡me novou webovou strÃ¡nku!</span>', 'NULL', 'Messages', 'messages', 'NULL', '0000-00-00 00:00:00'),
(159, '', '<img src=\"http://localhost/music/cg/uploads/5983140fdb2d77.12260917.png\">&nbsp;<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">V pÃ¡tek 4.8. mÃ¡me zavÅ™eno!</span>', 'NULL', 'Messages', 'messages', 'NULL', '0000-00-00 00:00:00'),
(160, '', '<img src=\"http://localhost/music/cg/uploads/5983140fdb2d77.12260917.png\">&nbsp;<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Sledujte nÃ¡s na sociÃ¡lnÃ­ch sÃ­tÃ­ch!</span>', 'NULL', 'Messages', 'messages', 'NULL', '0000-00-00 00:00:00'),
(161, '', '<img src=\"http://localhost/music/cg/uploads/5983140fdb2d77.12260917.png\">&nbsp;<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">MÃ¡me k dispozici novÃ© nÃ¡stroje!</span>', 'NULL', 'Messages', 'messages', 'NULL', '0000-00-00 00:00:00'),
(188, 'ÃšÄetnictvÃ­ - Ãšvod', '<h2><b>ÃšÄetnictvÃ­ - Funcke</b> :</h2><div><br></div><div>1. Informace o hospodaÅ™enÃ­ firmy</div><div>2. DÅ¯kaznÃ­ prostÅ™edek</div><div>3. Poskytuje informace pro rozhodovÃ¡nÃ­ v budoucnosti</div><div>4. ZjiÅ¡tÄ›nÃ­ informacÃ­ pro ÃºÄely daÅˆovÃ©</div><div>5. Kontrola stavu majetku</div><div><br></div><h2><font color=\"#0000cc\">ZÃ¡kon o ÃºÄetnictvÃ­</font> :&nbsp;</h2><div><br></div><div><b style=\"\"><font style=\"background-color: rgb(255, 255, 255);\" color=\"#0066ff\">ÃšplnÃ© ÃºÄetnictvÃ­</font></b> = VÅ¡echny <a href=\"http://business.center.cz/business/pojmy/p319-ucetni-pripad.aspx\">ÃºÄetnÃ­ pÅ™Ã­pady</a> tÃ½kajÃ­cÃ­ se danÃ©ho uÄetnÃ­ho obdobÃ­ jsou doloÅ¾eny</div><div><b style=\"background-color: rgb(255, 255, 255);\"><font color=\"#0066ff\">PrÅ¯kaznÃ© ÃºÄetnictvÃ­</font></b> = ÃšÄetnÃ­ pÅ™Ã­pady a <a href=\"http://ucetnictvi.studentske.cz/2008/10/etn-zpisy-etn-knihy.html\">ÃºÄetnÃ­ zÃ¡pisy</a> jsou doloÅ¾eny a <a href=\"http://business.center.cz/business/pojmy/p312-ucetni-jednotka.aspx\">ÃºÄetnÃ­ jednotka</a> provedla <a href=\"http://www.vysokeskoly.cz/maturitniotazky/ucetnictvi/inventarizace\">inventarizace</a></div><div><b><font style=\"background-color: rgb(255, 255, 255);\" color=\"#0066ff\">SprÃ¡vnÃ© ÃºÄetnictvÃ­</font></b> = Pokud ÃºÄetnictvÃ­ neodporuje Å¾Ã¡dnÃ©mu zÃ¡konu</div><div><br></div><h3><font color=\"#0066ff\">Druhy ÃºÄetnÃ­ch jednotek</font> :</h3><div><br></div><div>1. Mikro ÃºÄetnÃ­ jednotka</div><div>2. MalÃ¡&nbsp;ÃºÄetnÃ­&nbsp;jednotka</div><div>3. StÅ™ednÃ­&nbsp;ÃºÄetnÃ­&nbsp;jednotka</div><div>4. VelkÃ¡&nbsp;ÃºÄetnÃ­&nbsp;jednotka</div>', 'NULL', 'ÃšÄetnictvÃ­', 'uce_div', 'h1', '2017-08-16 12:45:01');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `pwd` text NOT NULL,
  `em` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `uid`, `pwd`, `em`) VALUES
(7, 'admin', '$2y$10$64fWaC4Tn9c8tTxUOH5ywuv2FAf1bxw9p64kooeCVgKR30ReBBqPG', 'updater19@gmail.com');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `sitecontent`
--
ALTER TABLE `sitecontent`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT pro tabulku `sitecontent`
--
ALTER TABLE `sitecontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;
--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
