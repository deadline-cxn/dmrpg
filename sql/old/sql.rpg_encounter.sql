-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 09, 2008 at 03:29 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `dminds1_rpg`
--

-- --------------------------------------------------------

--
-- Table structure for table `rpg_encounter`
--

CREATE TABLE IF NOT EXISTS `rpg_encounter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `type` text NOT NULL,
  `description` text NOT NULL,
  `repeatable` text NOT NULL,
  `required_level` text NOT NULL,
  `requires_loot` int(11) NOT NULL DEFAULT '0',
  `reqlootamt` int(11) NOT NULL,
  `gives_loot` int(11) NOT NULL DEFAULT '0',
  `finishtext` text NOT NULL,
  `unfinishtext` text NOT NULL,
  `trigaction` int(11) NOT NULL,
  `puzzle_opt1` text NOT NULL,
  `puzzle_opt2` text NOT NULL,
  `puzzle_opt3` text NOT NULL,
  `puzzle_opt4` text NOT NULL,
  `puzzle_answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `rpg_encounter`
--

INSERT INTO `rpg_encounter` (`id`, `name`, `image`, `type`, `description`, `repeatable`, `required_level`, `requires_loot`, `reqlootamt`, `gives_loot`, `finishtext`, `unfinishtext`, `trigaction`, `puzzle_opt1`, `puzzle_opt2`, `puzzle_opt3`, `puzzle_opt4`, `puzzle_answer`) VALUES
(5, 'Ruff', 'monster_aggressivepoodle.gif', 'puzzle_hidden_answer', 'Ruff?', 'yes', '1', 0, 0, 1, 'Ruff!', 'Ruff Ruff Ruff! Ruff!', 0, 'Ruff', '', '', '', ''),
(6, 'Oracle Dog', 'monster_enragedterrier.gif', 'puzzle_multiple_choice', 'Welcome adventurer! Answer me this riddle and I shall grant you a fabulous treasure! If you do not answer correctly you get nothing. I have a face but can not see.\r\nI have hands but can not touch.', 'yes', '1', 0, 0, 3, 'Great job! Here is some treasure.', 'Alas you did not get the answer correct. Now off with you!', 14, 'Jesus Christ', 'Verizon Mobile Guy', 'A Clock', 'Your Mom', '3'),
(7, 'Brain', 'DMBrain1.gif', 'puzzle_multiple_choice', 'A floating brain appears and beckons you closer.', 'yes', '1', 0, 0, 0, 'You gain 1 maximum will to live', 'Nothing happens', 15, 'Go toward the brain', 'Flee like a little girl', 'Attack the brain', 'Pretend to fart on the brain', 'random');
