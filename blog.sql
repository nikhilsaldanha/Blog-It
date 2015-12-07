-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2015 at 04:01 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `comment_body` text NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upvote` int(10) unsigned DEFAULT '0',
  `downvote` int(10) unsigned DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `comment_body`, `author_id`, `date`, `upvote`, `downvote`) VALUES
(1, 2, 'oh wow!!!!!\r\n', 1, '2015-11-13 18:54:53', 0, 0),
(2, 3, 'cool...nd they should be able to win this year with the current squad. \r\n', 2, '2015-11-13 19:03:36', 0, 0),
(3, 1, 'This is a great timekilling game.And it is ruining lpt of students precious time to hell.Still i love to play it.', 3, '2015-11-13 19:06:51', 0, 0),
(4, 2, 'Basically the binary dump utility takes each record, exactly as it is stored in the physical database, and dumps it to a file. There are no conversion, formatting, century or other such issues to worry about and as a result, the binary dump is the fastest method to dump your data. Unless you say otherwise, the primary index will be used (more on this later)...\r\n\r\nThis is really awesome one @akshay', 2, '2015-11-13 19:11:54', 0, 0),
(5, 1, 'I love clash of clans....though it is time killing everybody loves to play it.....In coc we have our hostel clan also....:-)', 4, '2015-11-13 19:12:06', 1, 1),
(6, 1, 'This game is been killing all of the network speed...\r\n', 2, '2015-11-13 19:12:49', 1, 0),
(7, 1, 'i think the game is awesome\r\nas a student i love to kill the time LOL', 6, '2015-11-13 19:13:30', 1, 0),
(8, 3, 'Isn''t it your favorite team @akshay ?', 2, '2015-11-13 19:13:52', 0, 0),
(9, 5, 'The demand for small unmanned air vehicles, commonly termed micro air vehicles, is rapidly increasing. Driven by applications ranging from civil search-and-rescue missions to military surveillance missions, there is a rising level of interest and investment in better vehicle designs, and miniaturized components are enabling many rapid advances.', 2, '2015-11-13 19:17:43', 0, 0),
(10, 6, 'I really impressed with ur infringement skills.But i think u could have editted before posting it.', 3, '2015-11-13 19:18:47', 0, 0),
(11, 6, 'Yeah...But as it is just for the sake of 10 marks..\r\nDoesn''t matter', 2, '2015-11-13 19:22:17', 0, 0),
(12, 10, 'waw...nice one dude', 2, '2015-11-13 19:30:42', 0, 0),
(13, 11, 'yes...it is more flexible and easy to understand.....\r\nprovide more styling properties...nd page is awesome\r\n', 4, '2015-11-13 19:37:30', 3, 0),
(14, 11, 'Yeah...This page is also looks like designed using bootstrap', 2, '2015-11-13 19:42:44', 1, 0),
(15, 10, 'Yeah....but these cars are not for the general purpose', 7, '2015-11-13 19:49:29', 0, 0),
(16, 1, 'cool', 2, '2015-11-14 04:46:41', 1, 0),
(17, 14, 'First Comment!', 9, '2015-11-14 07:31:57', 2, 1),
(19, 14, 'Nice dude...\r\n', 2, '2015-11-14 07:36:40', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `uid`, `fid`) VALUES
(1, 9, 2),
(2, 2, 3),
(3, 2, 4),
(4, 2, 5),
(5, 3, 4),
(6, 10, 2),
(7, 3, 2),
(8, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(64) NOT NULL,
  `body` text NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upvote` int(10) unsigned DEFAULT '0',
  `downvote` int(10) unsigned DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `body`, `author_id`, `date`, `upvote`, `downvote`) VALUES
(1, 'clash of clans', 'Clash of Clans is a 2012 freemium mobile MMO strategy video game developed and published by Supercell, a video game company based in Helsinki, Finland. The game was released for iOS platforms on August 2, 2012.', 1, '2015-11-13 18:52:03', 0, 0),
(2, 'Dump and Load Strategies', 'Wow - it''s been a month since my last blog entry. Time flies!\r\n\r\nIf you read Part I, you''ve already analyzed your data and designed your Type II storage areas and you''re ready to dump your existing data and load it into the new structure. If you''re still using Type I storage areas, this will probably be the slowest part of the entire D&L process so don''t despair. The load and the index rebuild should take considerably less time than the dump.\r\n\r\nYou have three choices when it comes to dumping your data:\r\n\r\nASCII Dictionary Dump\r\nASCII Custom Dump \r\nBinary Dump\r\nThis blog post is going to concentrate on the binary dump as that''s what most of you are going to use. Unless the database is very small or you need to do some conversions during the dump, there''s really no reason to use the dictionary dump for anything other than users and sequence current values.', 2, '2015-11-13 18:53:37', 6, 0),
(3, 'manchester united', 'Manchester United Football Club is a professional football club based in Old Trafford, Greater Manchester, England, that currently competes in the Premier League, the top flight of English football.', 1, '2015-11-13 18:53:56', 0, 0),
(4, 'ItÂ’s Easy to Scale Out a MongoDB Deployment', 'MongoDB is a unique NoSQL open source database, which is scalable and adaptable. It is an application of choice for many Fortune 500 companies and start-ups alike. In this, our second article in the series on MongoDB, discover how to scale out a MongoDB deployment.', 2, '2015-11-13 18:55:31', 0, 0),
(5, 'Micro Air Vehicle(MAV)', 'A micro air vehicle (MAV), or micro aerial vehicle, is a class of Miniature UAVs that has a size restriction and may be autonomous.It is mainly used for reconnaissance and surveillance purpose. Modern craft can be as small as 15 centimetres. Development is driven by commercial, research, government, and military purposes; with insect-sized aircraft reportedly expected in the future. The small craft allows remote observation of hazardous environments inaccessible to ground vehicles. MAVs have been built for hobby purposes, such as aerial robotics contests and aerial photography.', 3, '2015-11-13 19:14:35', 0, 0),
(6, 'Indian economy..', 'The Economy of India is the seventh-largest in the world by nominal GDP and the third-largest by purchasing power parity (PPP).[34] The country classified as newly industrialized country, one of the G-20 major economies, a member of BRICS and a developing economy with approximately 7% average growth rate for the last two decades.[35] India''s economy became the world''s fastest growing major economy from the last quarter of 2014, replacing the People''s Republic of China.[36]\r\n\r\nThe long-term growth prospective of the Indian economy is moderately positive due to its young population, corresponding low dependency ratio, healthy savings and investment rates, and increasing integration into the global economy,[37] The Indian economy has the potential to become the world''s 3rd-largest economy by the next decade, and one of the largest economies by mid-century.[38][39][40] And the outlook for short-term growth is also good as according to the IMF, the Indian economy is the "bright spot" in the global landscape.[41] India also topped the World Bankâ€™s growth outlook for 2015-16 for the first time with the economy having grown 7.3% in 2014-15 and expected to grow 7.5-8.3% in 2015-16.[42]', 2, '2015-11-13 19:16:11', 0, 0),
(7, 'Happy Deepavali', 'Beautiful Diwali lamps and fireworks to go with your wishes.', 2, '2015-11-13 19:19:54', 0, 1),
(8, 'Seriously....', 'Engineering is the application of mathematics, empirical evidence and scientific, economic, social, and practical knowledge in order to invent, design, build, maintain, research, and improve structures, machines, tools, systems, components, materials, and processes.', 2, '2015-11-13 19:21:32', 0, 0),
(9, 'Renewable Energy Source', 'Renewable energy is generally defined as energy that comes from resources which are naturally replenished on a human timescale, such as sunlight, wind, rain, tides, waves, and geothermal heat.Renewable energy replaces conventional fuels in four distinct areas: electricity generation, air and water heating/cooling, motor fuels, and rural (off-grid) energy services.\r\n\r\nBased on REN21''s 2014 report, renewables contributed 19 percent to our global energy consumption and 22 percent to our electricity generation in 2012 and 2013, respectively. This energy consumption is divided as 9% coming from traditional biomass, 4.2% as heat energy (non-biomass), 3.8% hydro electricity and 2% is electricity from wind, solar, geothermal, and biomass. Worldwide investments in renewable technologies amounted to more than US$214 billion in 2013, with countries like China and the United States heavily investing in wind, hydro, solar and biofuels.', 3, '2015-11-13 19:23:49', 0, 0),
(10, 'Top Ten Fasetest Cars 2014-15', '\r\n1. Koenigsegg Agera R\r\n2. Hennessy Venom GT\r\n3. Bugatti Veyron Super Sport\r\n4. RUF CTR3\r\n5. Pagani Huayra\r\n6. Noble M600\r\n7. Ferrari LaFerrari\r\n8. McLaren P1\r\n9. Lamborghini Aventador\r\n10. Porsche 918 Spyder', 3, '2015-11-13 19:28:18', 0, 0),
(11, 'bootstrap features', 'Bootstrap is compatible with the latest versions of the Google Chrome, Firefox, Internet Explorer, Opera, and Safari browsers, although some of these browsers are not supported on all platforms.[10]\r\n\r\nSince version 2.0 it also supports responsive web design. This means the layout of web pages adjusts dynamically, taking into account the characteristics of the device used (desktop, tablet, mobile phone).\r\n\r\nStarting with version 3.0, Bootstrap adopted a mobile first design philosophy, emphasizing responsive design by default.\r\n\r\nThe version 4.0 alpha release added Sass and Flexbox support.[11]\r\n\r\nBootstrap is open source and available on GitHub.[12] Developers are encouraged to participate in the project and make their own contributions to the platform', 2, '2015-11-13 19:29:40', 14, 4),
(12, 'Github', 'GitHub is a Web-based Git repository hosting service. It offers all of the distributed revision control and source code management (SCM) functionality of Git as well as adding its own features. Unlike Git, which is strictly a command-line tool, GitHub provides a Web-based graphical interface and desktop as well as mobile integration. It also provides access control and several collaboration features such as bug tracking, feature requests, task management, and wikis for every project.[3]\r\n\r\nGitHub offers both plans for private repositories and free accounts,[4] which are usually used to host open-source software projects.[5] As of 2015, GitHub reports having over 9 million users and over 21.1 million repositories,[6] making it the largest host of source code in the world.[7]', 2, '2015-11-13 19:30:23', 0, 0),
(13, 'Top 10 movies of 2015', '1.Avengers: Age of Ultron\r\n2.Jurassic World\r\n3.Furious 7\r\n4.Mad Max: Fury Road\r\n5.Terminator Genisys\r\n6.Spectre\r\n7.Star Wars: Episode VII - The Force Awakens\r\n8.Inside Out\r\n9.Mission: Impossible â€“ Rogue Nation\r\n10.Ant-Man', 4, '2015-11-13 19:49:08', 1, 0),
(14, 'First Post', 'This is a first post.\r\nTheres a first time for everything', 9, '2015-11-14 07:31:42', 5, 1),
(15, 'desserts', 'glen''s bake house: \r\nknown for apple pie, strawberry tart, cheese cake !!', 10, '2015-11-20 05:29:25', 0, 0),
(16, 'computer graphics', 'text book to be referred is hearn and baker', 11, '2015-11-20 05:35:23', 0, 0),
(17, 'The Slim Framework Application Lifecycle', 'The essence of a web application is simple: it receives an HTTP request; it invokes the appropriate code; and it returns an HTTP response. The Slim Framework makes it dead simple to build and launch small web applications and APIs by hiding the prerequisite application underpinnings beneath a simple, easy-to-use interface. But for those interested in the low-level details, hereâ€™s what a Slim applicationâ€™s lifecycle looks like from start to finish.', 2, '2015-12-01 16:45:53', 0, 0),
(18, 'hello', 'dbms lab extrnl', 2, '2015-12-02 05:39:44', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `tag` varchar(16) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `post_id`, `tag`) VALUES
(1, 1, 'coc'),
(2, 2, 'dumpdata'),
(3, 3, ''),
(4, 4, 'mongodb'),
(5, 5, ''),
(6, 6, 'economy'),
(7, 7, 'diwali'),
(8, 8, 'engineering'),
(9, 9, ''),
(10, 10, ''),
(11, 11, 'bootstrap'),
(12, 12, 'github'),
(13, 13, ''),
(14, 14, 'firstpost'),
(15, 14, 'post'),
(16, 14, 'awesome'),
(17, 15, '#sweettooth'),
(18, 16, '#cg'),
(19, 17, 'slim'),
(20, 17, 'php'),
(21, 17, 'framework'),
(22, 17, 'lifecycle'),
(23, 17, 'router'),
(24, 18, 'lab'),
(25, 18, 'dbms');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(32) NOT NULL,
  `name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`) VALUES
(1, 'akshay', '$2y$10$boF.tnRjVhqTuQSbOkdRiOSGpRSa/ttiI00.D74kqYBkx9qfK8Oaq', 'shettyakshay008@gmail.com', 'Akshay shetty'),
(2, 'NishanthSp', '$2y$10$.FFHfQjTvZMkfpoGF9hS7etxsEMpTAuyhcbilFcM/1KVDeXdfzyBy', 'nishanthspshetty@gmail.com', 'Nishanth'),
(3, 'Seenasunil', '$2y$10$bD7JPzfacnLAPTF6yhIcgOi6HI/vKr2QrZy7l67Ck1D4Cwli5Tjn2', 'seenasunil121@gmail.com', 'Sunil'),
(4, 'nik', '$2y$10$5temgdwWfkdSUzcEvzLu8uwZlr6F5cq0rDcdQFtJqtgHIz/ZLgHve', 'nikhilhegde118@gmail.com', 'Nikhil'),
(5, 'daniel', '$2y$10$qZ.2vwYukkjRWxgkCDflf.uwiKFaIVPItwBtEmq1WMeLBTlmFh.86', 'daniel12688@gmail.com', 'daniel'),
(6, 'ganesh', '$2y$10$PXsgWfgvI4xgHK976oW3POraZRtzhUmSrJTCDcU08yCuF.DRKdg2y', 'ganesh.hegde312@gmai.com', 'ganesh'),
(7, 'jaikumar', '$2y$10$jpqnNYWexnrhsAstIjDyKuUHZ3HmXXyPGnR9/elYNx.0/t36YvjYq', 'jaikumar123@gmail.com', 'jai'),
(8, 'nishu', '$2y$10$NcA9mr4aHAaaAmqsaeV2Z.kRCyWReK1YR5TKnE.f8fzjdqHHAb.K.', 'Nishanth123@gmail.com', 'Nishu'),
(9, 'nikhilsaldanha', '$2y$10$rG5lOtejJCrF7OXIXNq92uFPv7ouQW1oZ4lDx/myRRhlsTAa1XNX.', 'nikhil.saldanha@gmail.com', 'nikhil saldanha'),
(10, 'nesaramadhav', '$2y$10$p0yJTSbeCuMnc44VFA5sO.DHS3ewe9s9lAu6QNYJbNVoBIrBRkLl.', 'nesaramadhav@gmail.com', 'nesaramadhav'),
(11, 'umama', '$2y$10$o8pH.XBk2qop.TgoIm9XC.a/7/qenUOPJ1ex3298Frsd.cW9zmJU6', 'umamakulsum23@gmail.com', 'umama'),
(12, 'yasha', '$2y$10$f6qPsy1eSZ0qfnXHj1BfxOJp70A6k4hdDNUkzpJaVLKGN4Am0vQHe', 'yasha@gmail.com', 'yasha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
