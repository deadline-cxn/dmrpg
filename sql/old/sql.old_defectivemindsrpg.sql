-- phpMyAdmin SQL Dump
-- version 2.11.9.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2009 at 07:23 AM
-- Server version: 5.1.30
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `dminds1_rpg`
--

-- --------------------------------------------------------

--
-- Table structure for table `banned`
--

CREATE TABLE IF NOT EXISTS `banned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` text NOT NULL,
  `link` text NOT NULL,
  `ip` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=626 ;

--
-- Dumping data for table `banned`
--


-- --------------------------------------------------------

--
-- Table structure for table `link_bin`
--

CREATE TABLE IF NOT EXISTS `link_bin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` text NOT NULL,
  `poster` int(11) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sname` text NOT NULL,
  `referrals` int(11) NOT NULL DEFAULT '0',
  `hidden` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `clicks` int(11) NOT NULL DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0',
  `category` text NOT NULL,
  `bumptime` datetime NOT NULL,
  `referral` text NOT NULL,
  `reviewed` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `link_bin`
--

INSERT INTO `link_bin` (`id`, `link`, `poster`, `time`, `sname`, `referrals`, `hidden`, `description`, `clicks`, `rating`, `category`, `bumptime`, `referral`, `reviewed`) VALUES
(58, 'http://defectiveminds.com/', 0, '2009-06-29 21:17:07', 'defectiveminds.com', 11, 1, '', 0, 0, '!!!TEMP!!!', '2009-06-30 21:40:44', 'yes', 'no'),
(59, 'http://howtobeevil.com/', 0, '2009-06-30 01:53:48', 'howtobeevil.com', 11, 1, '', 0, 0, '!!!TEMP!!!', '2009-06-30 18:18:10', 'yes', 'no'),
(60, 'http://whois.domaintools.com/', 0, '2009-06-30 02:54:58', 'whois.domaintools.com', 3, 1, '', 0, 0, '!!!TEMP!!!', '2009-06-30 15:34:13', 'yes', 'no'),
(61, 'http://retardedgorillas.com/', 0, '2009-06-30 03:06:20', 'retardedgorillas.com', 4, 1, '', 0, 0, '!!!TEMP!!!', '2009-06-30 04:42:24', 'yes', 'no'),
(62, 'http://www.sitedossier.com/', 0, '2009-06-30 18:46:35', 'www.sitedossier.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-06-30 18:46:35', 'yes', 'no'),
(63, 'http://www.validpokerrooms.com/', 0, '2009-06-30 20:14:08', 'www.validpokerrooms.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-06-30 20:14:08', 'yes', 'no'),
(64, 'http://www.widecircles.com/', 0, '2009-06-30 22:17:37', 'www.widecircles.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-06-30 22:17:37', 'yes', 'no'),
(65, 'http://www.candidcarinsure.com/', 0, '2009-07-01 03:06:14', 'www.candidcarinsure.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-01 03:06:14', 'yes', 'no'),
(66, 'http://smart.apnoti.com/', 0, '2009-07-01 05:50:16', 'smart.apnoti.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-01 05:50:16', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_actions`
--

CREATE TABLE IF NOT EXISTS `rpg_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` text NOT NULL,
  `modifier` text NOT NULL,
  `value` text NOT NULL,
  `location` text NOT NULL,
  `use_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `rpg_actions`
--

INSERT INTO `rpg_actions` (`id`, `action`, `modifier`, `value`, `location`, `use_text`) VALUES
(1, 'increase', 'hp', '5', '', 'You gain 5 health.'),
(5, 'increase', 'hp', '15', '', '15 hit points restored.'),
(2, 'teleport', 'none', '', '0,0,0', 'You have been teleported to the starting area.'),
(3, 'increase', 'pow', '5', '', 'You gain 5 power.'),
(4, 'teleport', 'none', '', '0,1,0', 'You are teleported.'),
(6, 'increase', 'str', '5', '20', 'Your strength is increased by 5 for 20 turns.'),
(7, 'increase', 'pow', '15', '', '15 power replinished.'),
(8, 'increase', 'hp', '23400', '', '23400 hit points restored.'),
(9, 'increase', 'hp', '8', '', '8 hp restored.'),
(10, 'combine', 'none', '', '', 'item is a crafting material'),
(11, 'increase', 'hpmax', '5', '', 'Increases maximum HP by 5.'),
(12, 'increase', 'ap', '1', '', 'Increases Action Points by 1.'),
(13, 'loottable', 'none', '5', '', 'Give items from loot table 5.'),
(14, 'increase', 'cash', '5.50', '', 'Give you $5.50 '),
(15, 'increase', 'hpmax', '1', '', 'Increases maximum HP by 1'),
(16, 'increase', 'ap', '5', '', 'Increase AP by 5.');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_classes`
--

CREATE TABLE IF NOT EXISTS `rpg_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `alignment` text NOT NULL,
  `image` text NOT NULL,
  `info` text NOT NULL,
  `start_hp` int(11) NOT NULL DEFAULT '0',
  `start_pow` int(11) NOT NULL DEFAULT '0',
  `start_str` int(11) NOT NULL DEFAULT '0',
  `start_int` int(11) NOT NULL DEFAULT '0',
  `start_agl` int(11) NOT NULL DEFAULT '0',
  `start_def` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `rpg_classes`
--

INSERT INTO `rpg_classes` (`id`, `name`, `alignment`, `image`, `info`, `start_hp`, `start_pow`, `start_str`, `start_int`, `start_agl`, `start_def`) VALUES
(1, 'Detective', 'Good', 'class-detective.gif', 'They rely completely on their wits. As such, they have and can not have any special abilities. However, their high intelligence allows them to master nearly any item. (high INT, low POW, average+1 AGL, average OTHER)', 20, 0, 10, 15, 12, 10),
(2, 'Mad Scientist', 'Evil', 'class-mad_scientist.gif', 'They rely completely on their wits. As such, they have and can not have any special abilities. However, their high intelligence allows them to master nearly any item. (high INT, low POW, average+1 AGL, average OTHER)', 20, 0, 10, 15, 12, 10),
(3, 'Crusader', 'Good', 'class-crusader.gif', 'They are the slightly above average group. While not excelling in any one area, they are a step above everyone else. (average +1 OTHER)', 25, 25, 12, 12, 12, 12),
(4, 'Outlaw', 'Evil', 'class-outlaw.gif', 'They are the slightly above average group. While not excelling in any one area, they are a step above everyone else. (average +1 OTHER)', 25, 25, 12, 12, 12, 12),
(5, 'Magician', 'Good', 'class-magician.gif', 'They command large amounts of power, and as a tradeoff have a weakened physique. (high POW, low STR, average+1 INT, average OTHER)', 15, 30, 8, 12, 10, 10),
(6, 'Sorcerer', 'Evil', 'class-sorcerer.gif', 'They command large amounts of power, and as a tradeoff have a weakened physique. (high POW, low STR, average+1 INT, average OTHER)', 15, 30, 7, 12, 10, 10),
(7, 'Strongman', 'Good', 'class-strongman.gif', 'They rely on brute strength to overcome obstacles, but usually have trouble solving quadratic equations, or remembering telephone numbers. Make a good team with Magicians. (high STR, low INT, average+1 HP, average OTHER)', 25, 20, 15, 7, 10, 12),
(8, 'Thug', 'Evil', 'class-thug.gif', 'They rely on brute strength to overcome obstacles, but usually have trouble solving quadratic equations, or remembering telephone numbers. Make a good team with Magicians. (high STR, low INT, average+1 HP, average OTHER)', 25, 20, 15, 7, 10, 12),
(9, 'Robot', 'Good', 'class-robot.gif', 'Metal bodies often leave robots unscathed in battle. However, heavy slow-moving metal parts also tend to make them easy to hit. \r\n(high DEF, low AGL, average+1 HP, average OTHER)\r\n', 25, 20, 10, 10, 7, 15),
(10, 'Evil Robot', 'Evil', 'class-evil_robot.gif', 'Metal bodies often leave robots unscathed in battle. However, heavy slow-moving metal parts also tend to make them easy to hit. \r\n(high DEF, low AGL, average+1 HP, average OTHER)\r\n', 25, 20, 10, 10, 7, 15);

-- --------------------------------------------------------

--
-- Table structure for table `rpg_encounters`
--

CREATE TABLE IF NOT EXISTS `rpg_encounters` (
  `characterid` int(11) NOT NULL DEFAULT '0',
  `data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rpg_encounters`
--


-- --------------------------------------------------------

--
-- Table structure for table `rpg_items`
--

CREATE TABLE IF NOT EXISTS `rpg_items` (
  `name` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `damage` tinyint(4) NOT NULL DEFAULT '0',
  `damage_high` tinyint(4) NOT NULL DEFAULT '0',
  `absorb` tinyint(4) NOT NULL DEFAULT '0',
  `absorb_high` tinyint(4) NOT NULL DEFAULT '0',
  `durability` tinyint(4) NOT NULL DEFAULT '0',
  `durability_max` tinyint(4) NOT NULL DEFAULT '0',
  `str_mod` tinyint(4) NOT NULL DEFAULT '0',
  `agl_mod` tinyint(4) NOT NULL DEFAULT '0',
  `pow_mod` tinyint(4) NOT NULL DEFAULT '0',
  `int_mod` tinyint(4) NOT NULL DEFAULT '0',
  `def_mod` tinyint(4) NOT NULL DEFAULT '0',
  `hp_mod` tinyint(4) NOT NULL DEFAULT '0',
  `wear_slot` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `action` tinyint(4) NOT NULL DEFAULT '0',
  `charges` tinyint(4) NOT NULL DEFAULT '0',
  `charges_max` tinyint(4) NOT NULL DEFAULT '0',
  `useable` tinyint(4) NOT NULL DEFAULT '0',
  `unique` text NOT NULL,
  `sell_value` text NOT NULL,
  `required_level` text NOT NULL,
  `quest` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `rpg_items`
--

INSERT INTO `rpg_items` (`name`, `id`, `damage`, `damage_high`, `absorb`, `absorb_high`, `durability`, `durability_max`, `str_mod`, `agl_mod`, `pow_mod`, `int_mod`, `def_mod`, `hp_mod`, `wear_slot`, `image`, `description`, `action`, `charges`, `charges_max`, `useable`, `unique`, `sell_value`, `required_level`, `quest`) VALUES
('Onyx Helmet', 1, 0, 0, 10, 12, 60, 60, 0, 0, 2, 0, 0, 0, 'item_head', 'item_head.gif', 'This helmet is imbued with an Onyx coating and gives the wearer +2 power.', 0, 0, 0, 0, '', '.20', '2', ''),
('Headband of the Owl', 2, 0, 0, 5, 5, 10, 10, 0, 0, 0, 4, 0, 0, 'item_head', 'item_head.gif', 'Headband that has a trendy Owl logo imprinted on it. This thing gives off +4 Intelligence to the wearer.', 0, 0, 0, 0, '0', '.20', '2', ''),
('Machine Gun of Disgruntledness', 3, 10, 15, 0, 0, 50, 50, 0, 0, -2, 0, 0, 0, 'item_weapon1', 'item_weapon.gif', 'Plows through targets.  Especially good for bosses.', 0, 0, 0, 0, '0', '1.20', '4', ''),
('Retard Ring', 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, -2, 2, 0, 'item_hands', 'item_ring.gif', 'Makes the wearer a little bit dull, but also increases defenses.', 0, 0, 0, 0, '0', '1.30', '8', ''),
('Butthuggers', 5, 0, 0, 10, 12, 50, 50, 0, -2, 0, 0, 2, 0, 'item_legs', 'item_legs.gif', 'Extremely tight pants. They make moving difficult.', 0, 0, 0, 0, '', '.80', '1', ''),
('Mysterious Device', 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_mystery.gif', 'No one knows what this thing does and you are not completely sure either. It has a large red button on the top and a label that reads "Do not press".', 2, 5, 5, 1, '', '.40', '1', ''),
('Power Rectangle', 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_power_rectangle.gif', 'Eat it and it will replinish 5 power.', 3, 1, 1, 1, '', '.05', '1', ''),
('Guts', 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_ratguts.gif', 'The brutally crushed remains of something.', 0, 0, 0, 0, '', '.02', '1', ''),
('Eyeball', 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_rateyeball.gif', 'An eyeball that has been violently dislodged from it''s socket. (Used in recipies)', 0, 0, 0, 0, '', '.03', '1', ''),
('Empty Bottle', 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_emptybottle.gif', 'It''s a bottle... with nothing in it.', 0, 0, 0, 0, '', '.02', '1', ''),
('Upside Down Heart', 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, '', 'item_upsidedownheart.gif', 'It''s an upside down heart. It restores 5 hit points if used.', 1, 1, 1, 1, '', '.05', '1', ''),
('Rat Killin'' Stick', 12, 2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_ratkillinstick.gif', 'This stick looks like it might be a good weapon. A good weapon against rats.', 0, 0, 0, 0, '', '.01', '1', ''),
('Fingernail', 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_fingernail.gif', 'It is a fingernail. It probably got knocked loose in a fight and you just happened to pick it up.', 0, 0, 0, 0, '', '.02', '1', ''),
('Ear', 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_ear.gif', 'This is an ear. Someone or... some "thing"... can''t hear anymore.', 0, 0, 0, 0, '', '.01', '1', ''),
('Hair', 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_hair.gif', 'A little lock of hair. It has blood on it.', 0, 0, 0, 0, '', '.01', '1', ''),
('Leather Gloves', 16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 'item_hands', 'item_glove.gif', 'This is a pair of leather gloves.', 0, 0, 0, 0, '', '.05', '1', ''),
('Knit Socks', 17, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 'item_feet', 'item_socks.gif', 'Put them on your feet and stay warm.', 0, 0, 0, 0, '', '.10', '1', ''),
('Purple Shirt', 18, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 'item_chest', 'item_shirt.gif', 'This is a finely crafted purple shirt.', 0, 0, 0, 0, '', '.30', '1', ''),
('Cotton Armbands', 19, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 1, 0, 'item_arms', 'item_armbands.gif', 'They look like the would fit pretty snuggly.', 0, 0, 0, 0, '0', '.05', '1', ''),
('Kevlar Chest', 20, 0, 0, 12, 12, 0, 0, 0, 0, 0, 0, 8, 0, 'item_chest', 'item_shirt.gif', 'A chest piece made of kevlar.', 1, 0, 0, 0, '0', '1.20', '6', ''),
('Blue Mask', 21, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 1, 0, 'item_head', 'item_blue_mask.gif', 'A generic blue mask, used to hide your identity and protect your eyes from dirt and stuff. ', 0, 0, 0, 0, '0', '.25', '1', ''),
('Ray Gun', 22, 5, 10, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 'item_weapon2', 'item_raygun.gif', 'A gun designed by a guy named Ray. Oh, it also shoots beams of focused energy. ', 0, 0, 0, 0, '0', '5', '5', ''),
('Knife', 23, 2, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_knife.gif', 'Just a plain ol'' knife. Used for stabbin and cuttin steaks. ', 0, 0, 0, 0, '0', '.1', '1', ''),
('Banana', 24, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8, '', 'item_bannana.gif', 'For some reason, evertime you look at this, you think it\\''s peanut butter jelly time. You also gain 8 hit points when you eat it. ', 9, 1, 1, 1, '0', '.01', '1', ''),
('Blue Cape', 25, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 'item_back', 'item_blue_cape.gif', 'Generic blue cape. Keeps your back warm and looks cool. ', 0, 0, 0, 0, '0', '.14', '1', ''),
('Sharp Dagger', 26, 12, 42, 1, 1, 0, 0, 0, 0, 0, 5, 0, 0, 'item_weapon1', 'item_dagger.gif', 'The blade on this dagger is very sharp. Watch out! It also makes you sharper.', 0, 0, 0, 0, '0', '.25', '1', ''),
('Gorgon\\''s Stick', 27, 82, 102, 1, 1, 0, 0, 23, 0, 0, 0, 0, 0, 'item_weapon1', 'item_ratkillinstick.gif', 'This is the very stick used by Gorgon.', 0, 0, 0, 0, '0', '15.50', '7', ''),
('Ring of Hate', 28, 0, 0, 0, 0, 0, 0, -2, 0, 15, 0, 0, 0, 'item_hands', 'item_ring.gif', 'A ring that has an aura that makes you hate it. Yet you love it at the same time. You want it. You want to wear it. But you hate it.', 0, 0, 0, 0, '0', '.04', '5', ''),
('Adrenaline', 29, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_hypo.gif', 'It\\''s a hypodermic needle with some adrenaline in it.', 5, 0, 0, 1, '0', '.05', '3', ''),
('Vodka', 30, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_emptybottle.gif', 'A bottle of fine vodka.', 5, 0, 0, 1, '0', '.10', '3', ''),
('Huntin\\'' Knife', 31, 5, 9, 1, 1, 0, 0, 2, 0, 0, 0, 0, 0, 'item_weapon1', 'item_knife2.gif', 'This knife is kinda big. It\\''s got serrated edges and it looks like it might be good for huntin\\''\r\n', 0, 0, 0, 0, '0', '.20', '1', ''),
('Floppy Disc', 32, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_disk.gif', 'A floppy disc. You might be able to use this with a computer somehow.', 0, 0, 0, 0, '0', '.10', '1', ''),
('Parcel', 33, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_env.gif', 'Someone\\''s mail. I bet you\\''re wondering what\\''s inside.', 0, 0, 0, 0, '0', '0', '1', ''),
('Orb of Power', 34, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_orb2.gif', 'A shiny, black, round orb that screams \\"I will restore 15 power\\".', 7, 0, 0, 1, '0', '.20', '5', ''),
('Coffee', 35, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_coffee_cup.gif', 'Coffee... Mmmm (Developer\\''s Choice)', 8, 0, 0, 1, '0', '1.42', '1', ''),
('Kid Beatin'' Stick', 36, 8, 12, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 'item_weapon1', 'item_ratkillinstick.gif', 'This is a big stick. You could probably shoo off lots of kids with this thing.', 0, 0, 0, 0, '0', '.30', '4', ''),
('Beretta', 37, 10, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_beretta.gif', '', 0, 0, 0, 0, '0', '.80', '10', 'no'),
('Gorgon\\''s Fingernail', 38, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_fingernail.gif', 'A fingernail. Not just any fingernail though, it\\\\\\''s Gorgon\\\\\\''s fingernail.', 0, 0, 0, 0, '0', '0', '1', 'yes'),
('Lionheart Gloves', 39, 0, 0, 0, 0, 0, 0, 4, 4, 0, 0, 0, 0, 'item_hands', 'item_glove.gif', 'Some gloves that look pretty cool and stuff.', 0, 0, 0, 0, '0', '.80', '10', 'no'),
('Ray Gun', 40, 6, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_raygun.gif', 'It''s a gun. A gun that shoots rays.', 0, 0, 0, 0, '0', '0', '5', 'no'),
('Robot Brain', 41, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_thingy.gif', 'A brain of a robot.', 10, 0, 0, 0, '0', '.40', '1', 'no'),
('Ball Bearing', 42, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_orb2.gif', 'It\\''s a ball bearing.', 10, 0, 0, 0, '0', '.02', '1', 'no'),
('Robot Arm', 43, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_robotarm.gif', 'An arm from a robot.', 10, 0, 0, 0, '0', '.60', '1', 'no'),
('Interdimensional Pear', 44, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_pear.gif', 'It\\''s a pear, except there seems to be something interdimensional about it.', 9, 0, 0, 1, '0', '0', '1', 'no'),
('Intergalactic Calculator', 45, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_calc.gif', 'It is a calculator that exhibits space like qualities. Like its been in space or something.', 0, 0, 0, 0, '0', '0', '1', 'no'),
('Alien Testicle', 46, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_orb.gif', 'A single alien testicle. ', 0, 0, 0, 0, '0', '0', '1', 'no'),
('Floppy Disk', 47, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_disk.gif', 'It is a floppy disk. Probably has some old data on it.', 0, 0, 0, 0, '0', '0', '1', 'no'),
('Little Dagger', 48, 3, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_dagger.gif', 'It is a little dagger. Not too big.', 0, 0, 0, 0, '0', '0', '1', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_loot_table`
--

CREATE TABLE IF NOT EXISTS `rpg_loot_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `rpg_loot_table`
--

INSERT INTO `rpg_loot_table` (`id`, `data`) VALUES
(1, '8;1;5;60|9;1;2;30|5;1;1;1|7;1;1;10|11;1;1;10|1;1;1;1'),
(2, '7;1;1;20|10;1;1;80|11;1;1;20|30;1;1;10'),
(3, '4;1;1;1|16;1;1;10'),
(4, '5;1;1;.1|7;1;1;20|11;1;1;20|13;1;1;25|14;1;1;25|15;1;1;25'),
(5, '12;1;1;1|16;1;1;1|17;1;1;1|18;1;1;1|19;1;1;1|21;1;1;1|23;1;1;50|25;1;1;50'),
(6, '27;1;1;50|38;1;1;100'),
(7, '7;1;1;20|11;1;1;20|13;1;1;50|14;1;1;50|15;1;1;50|24;1;1;50|28;1;1;.01|33;1;1;50|36;1;1;5'),
(8, '38;1;1;100'),
(9, '39;1;1;100'),
(10, '8;6;6;50'),
(11, '41;1;1;50|42;1;1;50|43;1;1;50'),
(12, '11;1;1;50'),
(13, '35;848;8488;99'),
(14, '40;1;1;4|44;1;1;30|45;1;1;40|46;1;1;60|48;1;1;25');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_map`
--

CREATE TABLE IF NOT EXISTS `rpg_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `exits` text NOT NULL,
  `moblist` text NOT NULL,
  `required_level` text NOT NULL,
  `data` text NOT NULL,
  `ap` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `rpg_map`
--

INSERT INTO `rpg_map` (`id`, `location`, `name`, `description`, `image`, `exits`, `moblist`, `required_level`, `data`, `ap`) VALUES
(1, '0,0,0', 'The Suburbs', 'This is the noob area. To the east there is a pawn shop where you can buy or trade stuff. There is a bar to the west. The road leads south out of the noob area. To the north you can see lots of rats which could very well earn you some combat experience.', 'map_noob.gif', 'n0,s0,e0,w0,rest', '', '', 'rest', '1'),
(2, '-1,0,0', 'Mingler\\''s Club', 'Bar', 'map_bar.gif', 'enter', '4;20', '6', '', ''),
(3, '0,1,0', 'Road South', 'A road... leading south', 'map_road_vert.gif', 'n0', '', '', '', ''),
(4, '1,0,0', 'Milard\\''s Pawn Shop', 'Pawn Shop', 'map_pawn.gif', 'w0,n0,vendor', '', '', '1', ''),
(5, '0,-1,0', 'The Woods', 'A wild area.', 'map_ratlevel.gif', 's0,e0', '1;60|2;10|4;55', '', '', '1'),
(6, '1,-1,0', 'The Strip Mall', 'A strip mall overrun with teenagers.', 'map_strip_mall.gif', 's0,w0', '5;50|6;35|9;55', '3', '', '1'),
(7, '1,1,0', 'The Creek', 'A small creek in the woods...', 'map_creek.gif', 'n0,w0', '1;40|2;40|3;40|11;70|14;50', '2', '', '1'),
(8, '-7,6,0', 'Test Area', 'This is the testing area', 'map_fence_1.gif', '', '1;40|2;40|3;40|4;10|5;10|6;10|9;5|10;98', '4', '2', ''),
(9, '-6,6,0', 'road', 'road', 'map_road_2.gif', '', '', '', '', ''),
(10, '-6,5,0', 'road', 'road', 'map_road_9.gif', '', '', '', '', ''),
(11, '-5,5,0', 'road', 'road', 'map_road_horz.gif', '', '', '', '', ''),
(12, '-4,5,0', 'road', 'road', 'map_road_horz.gif', '', '', '', '', ''),
(13, '-3,5,0', 'road', 'road', 'map_road_horz.gif', '', '', '', '', ''),
(14, '0,5,0', 'road', 'road', 'map_road_7.gif', '', '', '', '', ''),
(15, '-1,5,0', 'road', 'road', 'map_road_horz.gif', '', '', '', '', ''),
(16, '-2,5,0', 'road', 'road', 'map_road_horz.gif', '', '', '', '', ''),
(17, '0,4,0', 'road', 'road', 'map_road_vert.gif', '', '', '', '', ''),
(18, '0,3,0', 'road', 'road', 'map_road_vert.gif', '', '', '', '', ''),
(19, '0,2,0', 'road', 'road', 'map_road_vert.gif', '', '', '', '', ''),
(20, '-3,6,0', 'Telo\\''s Bar', 'A bar owned by Telo', 'map_bar.gif', 'enter', '', '10', '', ''),
(21, '-6,7,0', 'Guy Smiley', 'A merchant', 'map_pawn.gif', 'vendor', '', '', '2', ''),
(22, '1,3,0', 'Robot Disco-tech', 'A place where all the coolest robots come to show off thier moves.', 'map_fence_2.gif', 'w0', '12;50|13;50|15;20', '4', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_monsters`
--

CREATE TABLE IF NOT EXISTS `rpg_monsters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `loot_table` int(11) NOT NULL DEFAULT '0',
  `level_low` text NOT NULL,
  `level_high` text NOT NULL,
  `str` int(11) NOT NULL DEFAULT '0',
  `int` int(11) NOT NULL DEFAULT '0',
  `agl` int(11) NOT NULL DEFAULT '0',
  `def` int(11) NOT NULL DEFAULT '0',
  `hp` int(11) NOT NULL DEFAULT '0',
  `hp_max` int(11) NOT NULL DEFAULT '0',
  `pow` int(11) NOT NULL DEFAULT '0',
  `pow_max` int(11) NOT NULL DEFAULT '0',
  `dmg_low` int(11) NOT NULL DEFAULT '0',
  `dmg_high` int(11) NOT NULL DEFAULT '0',
  `alignment` text NOT NULL,
  `special_atttack` int(11) NOT NULL DEFAULT '0',
  `special_attack_percent` int(11) NOT NULL DEFAULT '0',
  `group` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `rpg_monsters`
--

INSERT INTO `rpg_monsters` (`id`, `name`, `image`, `loot_table`, `level_low`, `level_high`, `str`, `int`, `agl`, `def`, `hp`, `hp_max`, `pow`, `pow_max`, `dmg_low`, `dmg_high`, `alignment`, `special_atttack`, `special_attack_percent`, `group`) VALUES
(1, 'Small Rat', 'monster_rat.gif', 1, '1', '2', 8, 1, 5, 5, 5, 7, 0, 0, 1, 3, 'nuetral', 0, 0, 4),
(2, 'Medium Rat', 'monster_rat_medium.gif', 1, '2', '4', 10, 4, 8, 8, 13, 18, 0, 0, 2, 5, 'nuetral', 0, 0, 0),
(3, 'Large Rat', 'monster_rat_medium.gif', 1, '3', '5', 12, 5, 10, 10, 14, 20, 0, 0, 3, 8, 'nuetral', 0, 0, 0),
(4, 'Whino', 'monster_whino.gif', 2, '2', '4', 14, 1, 4, 5, 14, 19, 8, 10, 2, 5, 'nuetral', 1, 15, 0),
(5, 'Goth Kid', 'monster_goth_kid.gif', 4, '4', '6', 10, 12, 4, 8, 15, 20, 15, 20, 4, 7, 'nuetral', 0, 0, 2),
(6, 'Bully', 'monster_bully.gif', 7, '4', '6', 14, 8, 12, 10, 16, 22, 2, 9, 4, 8, 'nuetral', 0, 0, 2),
(7, 'Enraged Terrier', 'monster_enragedterrier.gif', 6, '4', '6', 8, 2, 4, 6, 12, 15, 0, 0, 2, 5, 'nuetral', 0, 0, 1),
(8, 'Aggresive Poodle', 'monster_aggresivepoodle.gif', 6, '4', '6', 8, 2, 5, 4, 10, 14, 0, 0, 2, 6, 'nuetral', 0, 0, 1),
(9, 'Fat Kid', 'monster_fat_kid.gif', 3, '5', '9', 9, 12, 5, 7, 5, 11, 11, 15, 5, 8, 'Nuetral', 0, 0, 2),
(10, 'Gorgon', 'monster_gorgon.gif', 6, '100', '100', 90, 87, 60, 89, 450, 520, 470, 520, 230, 300, 'evil', 0, 0, 1),
(11, 'Small Gator', 'monster_gator1.gif', 1, '2', '3', 9, 1, 5, 12, 9, 15, 10, 15, 4, 10, 'nuetral', 0, 0, 2),
(12, 'Dancing Robot', 'monster_robot-dancer.gif', 11, '5', '7', 1, 1, 1, 1, 15, 28, 1, 1, 1, 1, 'nuetral', 0, 0, 2),
(13, 'Grooving Robot', 'monster_robot.gif', 11, '7', '9', 1, 1, 1, 1, 15, 18, 1, 1, 1, 1, 'nuetral', 0, 0, 1),
(14, 'Strange Monster', 'monster_monster1.gif', 14, '4', '6', 16, 9, 10, 13, 8, 15, 9, 18, 11, 14, 'nuetral', 0, 0, 3),
(15, 'Twin Freaks', 'monster_peeps.gif', 7, '5', '8', 13, 13, 17, 18, 11, 17, 12, 18, 8, 15, 'evil', 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rpg_npc`
--

CREATE TABLE IF NOT EXISTS `rpg_npc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `loot` int(11) NOT NULL DEFAULT '0',
  `quest` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rpg_npc`
--


-- --------------------------------------------------------

--
-- Table structure for table `rpg_quest`
--

CREATE TABLE IF NOT EXISTS `rpg_quest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `repeatable` text NOT NULL,
  `required_level` text NOT NULL,
  `requires_loot` int(11) NOT NULL DEFAULT '0',
  `reqlootamt` int(11) NOT NULL,
  `gives_loot` int(11) NOT NULL DEFAULT '0',
  `finishtext` text NOT NULL,
  `unfinishtext` text NOT NULL,
  `trigaction` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rpg_quest`
--

INSERT INTO `rpg_quest` (`id`, `name`, `description`, `repeatable`, `required_level`, `requires_loot`, `reqlootamt`, `gives_loot`, `finishtext`, `unfinishtext`, `trigaction`) VALUES
(1, 'The fingernail of Gorgon', 'Bring me Gorgon''s fingernail. I need it.', 'no', '8', 8, 1, 9, 'Ah Gorgon''s fingernail at last! Thank you!', 'Did you bring me Gorgon''s fingernail? No... um... ok well get out there and find it!', 15),
(2, 'Rat Guts', 'Hey ah... Ah I need some rat guts. Bring me 6 rat guts. NOW!', 'yes', '1', 10, 6, 1, 'Thanks for my rat guts bro.', 'You got my rat guts?', 0),
(3, 'Lick my ballsack', 'Lick my ballsack!', 'yes', '1', 0, 0, 10, 'Ah that was nice...', 'You''re not licking!', 0),
(4, 'Bring me an upside down heart!', 'I require an upside down heart!', 'yes', '1', 12, 1, 0, 'Thanks for the upside down heart.', 'Have you got the upside down heart?', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rpg_special_attacks`
--

CREATE TABLE IF NOT EXISTS `rpg_special_attacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `modifies` text NOT NULL,
  `modify_value` int(11) NOT NULL DEFAULT '0',
  `dmg_low` int(11) NOT NULL DEFAULT '0',
  `dmg_high` int(11) NOT NULL DEFAULT '0',
  `persist_rounds` int(11) NOT NULL DEFAULT '0',
  `power` int(11) NOT NULL DEFAULT '0',
  `cooldown` int(11) NOT NULL DEFAULT '0',
  `class_lvl` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rpg_special_attacks`
--

INSERT INTO `rpg_special_attacks` (`id`, `name`, `image`, `modifies`, `modify_value`, `dmg_low`, `dmg_high`, `persist_rounds`, `power`, `cooldown`, `class_lvl`) VALUES
(1, 'Whine', 'abl_whine.gif', '', 0, 2, 4, 0, 0, 0, ''),
(2, 'Sucker Punch', 'abl_suckerpunch.gif', '', 0, 4, 5, 0, 5, 0, ''),
(3, 'Eat Me', 'abl_base.gif', '', 0, 0, 0, 45, 0, 0, ''),
(4, 'Nipple Twist', 'abl_suckerpunch.gif', 'hp', 5, 0, 0, 0, 5, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_vendor`
--

CREATE TABLE IF NOT EXISTS `rpg_vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `inventory` text NOT NULL,
  `will_buy` text NOT NULL,
  `future` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rpg_vendor`
--

INSERT INTO `rpg_vendor` (`id`, `name`, `image`, `description`, `inventory`, `will_buy`, `future`) VALUES
(1, 'Milard', 'monster_whino.gif', 'I deal in extreme junk. Give it a look see.', '5', '', ''),
(2, 'Mr. Smiley', 'monster_bully.gif', 'Hey I just got a shipment in from Milards.', '5', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `name` text NOT NULL,
  `pass` text NOT NULL,
  `real_name` text NOT NULL,
  `country` text NOT NULL,
  `gender` text NOT NULL,
  `email` text NOT NULL,
  `webpage` text NOT NULL,
  `avatar` text NOT NULL,
  `picture` text NOT NULL,
  `posts` int(11) NOT NULL DEFAULT '0',
  `shitpoints` int(11) NOT NULL DEFAULT '0',
  `karma` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show_flash` text NOT NULL,
  `icq` text NOT NULL,
  `yahoo` text NOT NULL,
  `msn` text NOT NULL,
  `aim` text NOT NULL,
  `irc_server` text NOT NULL,
  `irc_channel` text NOT NULL,
  `website_fav` text NOT NULL,
  `sentence` text NOT NULL,
  `first_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reporter` text NOT NULL,
  `show_contact_info` text NOT NULL,
  `upload` text NOT NULL,
  `files_uploaded` int(11) NOT NULL DEFAULT '0',
  `files_downloaded` int(11) NOT NULL DEFAULT '0',
  `last_activity` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `birthday` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(11) NOT NULL DEFAULT '0',
  `forumposts` int(11) NOT NULL DEFAULT '0',
  `forumreplies` int(11) NOT NULL DEFAULT '0',
  `awards` text NOT NULL,
  `theme` text NOT NULL,
  `referrals` int(11) NOT NULL DEFAULT '0',
  `comments` int(11) NOT NULL DEFAULT '0',
  `linksadded` int(11) NOT NULL DEFAULT '0',
  `logins` int(11) NOT NULL DEFAULT '0',
  `rpg` text NOT NULL,
  `rpg_name` text NOT NULL,
  `rpg_hp` int(11) NOT NULL DEFAULT '0',
  `rpg_hpmax` int(11) NOT NULL DEFAULT '0',
  `rpg_pow` int(11) NOT NULL DEFAULT '0',
  `rpg_powmax` int(11) NOT NULL DEFAULT '0',
  `rpg_str` int(11) NOT NULL DEFAULT '0',
  `rpg_int` int(11) NOT NULL DEFAULT '0',
  `rpg_agl` int(11) NOT NULL DEFAULT '0',
  `rpg_def` int(11) NOT NULL DEFAULT '0',
  `rpg_inventory` text NOT NULL,
  `rpg_level` int(11) NOT NULL DEFAULT '0',
  `rpg_trainpoints` int(11) NOT NULL DEFAULT '0',
  `rpg_abilities` text NOT NULL,
  `rpg_exp` int(11) NOT NULL DEFAULT '0',
  `rpg_totalexp` int(11) NOT NULL DEFAULT '0',
  `rpg_class` text NOT NULL,
  `rpg_align` text NOT NULL,
  `rpg_eq_head` text NOT NULL,
  `rpg_x` text NOT NULL,
  `rpg_y` text NOT NULL,
  `rpg_z` text NOT NULL,
  `rpg_cash` float NOT NULL DEFAULT '0',
  `rpg_encounter` text NOT NULL,
  `rpg_slot_head` int(11) NOT NULL DEFAULT '0',
  `rpg_slot_hands` int(11) NOT NULL DEFAULT '0',
  `rpg_slot_legs` int(11) NOT NULL DEFAULT '0',
  `rpg_slot_arms` int(11) NOT NULL DEFAULT '0',
  `rpg_slot_feet` int(11) NOT NULL DEFAULT '0',
  `rpg_slot_chest` int(11) NOT NULL DEFAULT '0',
  `rpg_slot_back` int(11) NOT NULL DEFAULT '0',
  `rpg_slot_mainhand` int(11) NOT NULL DEFAULT '0',
  `rpg_slot_sechand` int(11) NOT NULL DEFAULT '0',
  `rpg_lastaction` text NOT NULL,
  `rpg_ap` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='hi' AUTO_INCREMENT=1177 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `pass`, `real_name`, `country`, `gender`, `email`, `webpage`, `avatar`, `picture`, `posts`, `shitpoints`, `karma`, `id`, `show_flash`, `icq`, `yahoo`, `msn`, `aim`, `irc_server`, `irc_channel`, `website_fav`, `sentence`, `first_login`, `reporter`, `show_contact_info`, `upload`, `files_uploaded`, `files_downloaded`, `last_activity`, `last_login`, `birthday`, `access`, `forumposts`, `forumreplies`, `awards`, `theme`, `referrals`, `comments`, `linksadded`, `logins`, `rpg`, `rpg_name`, `rpg_hp`, `rpg_hpmax`, `rpg_pow`, `rpg_powmax`, `rpg_str`, `rpg_int`, `rpg_agl`, `rpg_def`, `rpg_inventory`, `rpg_level`, `rpg_trainpoints`, `rpg_abilities`, `rpg_exp`, `rpg_totalexp`, `rpg_class`, `rpg_align`, `rpg_eq_head`, `rpg_x`, `rpg_y`, `rpg_z`, `rpg_cash`, `rpg_encounter`, `rpg_slot_head`, `rpg_slot_hands`, `rpg_slot_legs`, `rpg_slot_arms`, `rpg_slot_feet`, `rpg_slot_chest`, `rpg_slot_back`, `rpg_slot_mainhand`, `rpg_slot_sechand`, `rpg_lastaction`, `rpg_ap`) VALUES
('Seth', '000', '', '', '', 'seth_coder@hotmail.com', '', '', '', 0, 0, 0, 1168, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '', '', 0, 0, '2009-07-01 07:07:29', '2009-07-01 00:17:22', '0000-00-00 00:00:00', 255, 0, 0, '', '', 0, 0, 0, 0, 'yes', 'Defective Seth', 51, 99, 74, 74, 18, 10, 13, 13, '0;7|7;17|11;6|33;4|41;14|42;19|43;16|12;1|35;8932|44;3|45;4|48;3|40;1|46;3', 4, 0, '', 2936, 6576, '8', '', '', '1', '0', '0', 3.9, 'no', 1, 16, 5, 19, 17, 18, 25, 3, 0, 'none', 9990),
('doogeri.87@mail.ru', '3aF=rw%o', '', '', 'male', 'doogeri.87@mail.ru', '', '', '', 0, 50, 50, 1171, '', '', '', '', '', '', '', '', '', '2009-06-30 01:53:50', '', '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, '', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', '', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('will', 'd3f3ct1v3', '', '', 'male', 'will@defectiveminds.com', '', '', '', 0, 50, 50, 1170, '', '', '', '', '', '', '', '', '', '2009-06-29 21:19:37', '', '', '', 0, 0, '2009-06-30 21:40:44', '2009-06-30 07:35:01', '0000-00-00 00:00:00', 255, 0, 0, '', '', 0, 0, 0, 0, 'yes', 'Defective Will', 84, 84, 84, 84, 15, 15, 15, 15, '7;25|11;17|30;4|0;7|33;7|24;5|35;9999|15;4|13;2|16;1|14;2|28;1|8;16|9;4|43;2', 4, 0, '', 2712, 6316, '3', '', '', '0', '0', '0', 3.81, 'no', 21, 16, 5, 19, 0, 18, 25, 3, 0, 'none', 888),
('elenrytu@mail.ru', 'lnfw3jou', '', '', 'male', 'elenrytu@mail.ru', '', '', '', 0, 50, 50, 1172, '', '', '', '', '', '', '', '', '', '2009-06-30 03:06:22', '', '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, '', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', '', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('estherrarteaga@gmail.com', '(3)^T9yQ', '', '', 'male', 'estherrarteaga@gmail.com', '', '', '', 0, 50, 50, 1173, '', '', '', '', '', '', '', '', '', '2009-06-30 14:18:52', '', '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, '', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', '', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('300609@cndnsfive.cn', 'vz;%6G:_', '', '', 'male', '300609@cndnsfive.cn', '', '', '', 0, 50, 50, 1174, '', '', '', '', '', '', '', '', '', '2009-06-30 15:48:04', '', '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, '', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', '', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('waymnantese@gmail.com', '@jqgy(6z', '', '', 'male', 'waymnantese@gmail.com', '', '', '', 0, 50, 50, 1175, '', '', '', '', '', '', '', '', '', '2009-06-30 18:18:08', '', '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, '', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', '', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('seth_2', '-d+it$h^', '', '', 'male', 'seth@defectiveminds.com', '', '', '', 0, 0, 0, 1176, '', '', '', '', '', '', '', '', '', '2009-06-30 19:31:15', '', '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, '', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', '', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0);
