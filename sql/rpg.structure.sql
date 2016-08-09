-- MySQL dump 10.13  Distrib 5.7.13, for Linux (x86_64)
--
-- Host: localhost    Database: rpg
-- ------------------------------------------------------
-- Server version	5.7.13-0ubuntu0.16.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `awards`
--

DROP TABLE IF EXISTS `awards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `banned`
--

DROP TABLE IF EXISTS `banned`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` text NOT NULL,
  `link` text NOT NULL,
  `ip` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=626 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `forum_list`
--

DROP TABLE IF EXISTS `forum_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_list` (
  `name` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `posts` int(11) NOT NULL DEFAULT '0',
  `moderator` int(11) NOT NULL DEFAULT '0',
  `password` text NOT NULL,
  `no_reply` text NOT NULL,
  `folder` text NOT NULL,
  `parent` text NOT NULL,
  `priority` text NOT NULL,
  `usepass` text NOT NULL,
  `private` text NOT NULL,
  `moderated` text NOT NULL,
  `last_post` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COMMENT='Forum Listing';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `forum_posts`
--

DROP TABLE IF EXISTS `forum_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poster` int(11) NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `message` text NOT NULL,
  `thread` int(11) NOT NULL DEFAULT '0',
  `forum` int(11) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `thread_top` text NOT NULL,
  `bumptime` datetime NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=304 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `link_bin`
--

DROP TABLE IF EXISTS `link_bin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link_bin` (
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
) ENGINE=MyISAM AUTO_INCREMENT=314 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `headline` text NOT NULL,
  `message` text NOT NULL,
  `category1` text NOT NULL,
  `category2` text NOT NULL,
  `category3` text NOT NULL,
  `category4` text NOT NULL,
  `submitter` int(11) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `image_url` text NOT NULL,
  `image_link` text NOT NULL,
  `image_alt` text NOT NULL,
  `topstory` text NOT NULL,
  `published` text NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `rating` text NOT NULL,
  `sfw` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=latin1 COMMENT='news';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pmsg`
--

DROP TABLE IF EXISTS `pmsg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to` text NOT NULL,
  `from` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `read` text NOT NULL,
  `cash` text NOT NULL,
  `items` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_actions`
--

DROP TABLE IF EXISTS `rpg_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_chat`
--

DROP TABLE IF EXISTS `rpg_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_chat` (
  `timestamp` int(15) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `message` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=183 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_clans`
--

DROP TABLE IF EXISTS `rpg_clans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_clans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_classes`
--

DROP TABLE IF EXISTS `rpg_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_classes` (
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_craft_recipes`
--

DROP TABLE IF EXISTS `rpg_craft_recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_craft_recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `craft_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `recipe_skill` int(11) NOT NULL,
  `skill_required` int(11) NOT NULL,
  `craft_mats` int(11) NOT NULL,
  `created_items` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_crafts`
--

DROP TABLE IF EXISTS `rpg_crafts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_crafts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `required_tools` int(11) NOT NULL,
  `required_base` text NOT NULL,
  `skill_99` text NOT NULL,
  `skill_199` text NOT NULL,
  `skill_299` text NOT NULL,
  `skill_399` text NOT NULL,
  `skill_499` text NOT NULL,
  `skill_500` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_encounter`
--

DROP TABLE IF EXISTS `rpg_encounter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_encounter` (
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_encounters`
--

DROP TABLE IF EXISTS `rpg_encounters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_encounters` (
  `characterid` int(11) NOT NULL DEFAULT '0',
  `data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_inventory`
--

DROP TABLE IF EXISTS `rpg_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_inventory` (
  `iid` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `id` int(11) NOT NULL,
  `durability` tinyint(4) NOT NULL DEFAULT '0',
  `durability_max` tinyint(4) NOT NULL DEFAULT '0',
  `charges` tinyint(4) NOT NULL DEFAULT '0',
  `charges_max` tinyint(4) NOT NULL DEFAULT '0',
  `auction_owner` int(11) NOT NULL,
  `auction_starttime` datetime NOT NULL,
  `auction_endtime` datetime NOT NULL,
  `auction_startbid` decimal(14,2) NOT NULL,
  `auction_highbid` decimal(14,2) NOT NULL,
  `auction_buyout` decimal(14,2) NOT NULL,
  `auction_highbidder` int(11) NOT NULL,
  PRIMARY KEY (`iid`)
) ENGINE=MyISAM AUTO_INCREMENT=1707 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_items`
--

DROP TABLE IF EXISTS `rpg_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_items` (
  `name` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `damage` tinyint(4) NOT NULL DEFAULT '0',
  `damage_high` tinyint(4) NOT NULL DEFAULT '0',
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
  `required_level` int(11) NOT NULL,
  `quest` text NOT NULL,
  `craft_mat` text NOT NULL,
  `sellable` text NOT NULL,
  `tradeable` text NOT NULL,
  `meta` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=210 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_loot_table`
--

DROP TABLE IF EXISTS `rpg_loot_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_loot_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_map`
--

DROP TABLE IF EXISTS `rpg_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `exits` text NOT NULL,
  `moblist` text NOT NULL,
  `encounter_list` text NOT NULL,
  `required_level` text NOT NULL,
  `required_items` text NOT NULL,
  `data` text NOT NULL,
  `ap` text NOT NULL,
  `hidden` text NOT NULL,
  `hid_image` text NOT NULL,
  `see_criteria` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=377 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_monsters`
--

DROP TABLE IF EXISTS `rpg_monsters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_monsters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `loot_table` int(11) NOT NULL DEFAULT '0',
  `level_low` int(11) NOT NULL,
  `level_high` int(11) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_npc`
--

DROP TABLE IF EXISTS `rpg_npc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_npc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `loot` int(11) NOT NULL DEFAULT '0',
  `quest` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_quest`
--

DROP TABLE IF EXISTS `rpg_quest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_quest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `repeatable` text NOT NULL,
  `required_level` text NOT NULL,
  `requires_loot` int(11) NOT NULL DEFAULT '0',
  `killmonsters` text NOT NULL,
  `gives_loot` int(11) NOT NULL DEFAULT '0',
  `finishtext` text NOT NULL,
  `unfinishtext` text NOT NULL,
  `trigaction` int(11) NOT NULL,
  `prereq_quest` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer_1` text NOT NULL,
  `answer_2` text NOT NULL,
  `answer_3` text NOT NULL,
  `answer_4` text NOT NULL,
  `correct_answer` text NOT NULL,
  `accepttext` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_special_attacks`
--

DROP TABLE IF EXISTS `rpg_special_attacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_special_attacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `persist_rounds` int(11) NOT NULL DEFAULT '0',
  `power` int(11) NOT NULL DEFAULT '0',
  `cooldown` int(11) NOT NULL DEFAULT '0',
  `action` text NOT NULL,
  `class` text NOT NULL,
  `level` text NOT NULL,
  `trained` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rpg_vendor`
--

DROP TABLE IF EXISTS `rpg_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `inventory` text NOT NULL,
  `will_not_buy` text NOT NULL,
  `future` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `searches`
--

DROP TABLE IF EXISTS `searches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `searches` (
  `search` text NOT NULL,
  `engine` text NOT NULL,
  `fullsearch` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `smilies`
--

DROP TABLE IF EXISTS `smilies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smilies` (
  `sfrom` text NOT NULL,
  `sto` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `useronline`
--

DROP TABLE IF EXISTS `useronline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useronline` (
  `locale` text NOT NULL,
  `timestamp` int(15) NOT NULL DEFAULT '0',
  `ip` varchar(40) NOT NULL DEFAULT '',
  `page` varchar(100) NOT NULL,
  `loggedin` text NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
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
  `rpg_level` int(11) NOT NULL DEFAULT '0',
  `rpg_trainpoints` int(11) NOT NULL DEFAULT '0',
  `rpg_abilities` text NOT NULL,
  `rpg_craft` text NOT NULL,
  `rpg_craft_skill` int(11) NOT NULL,
  `rpg_craft_skill_max` int(11) NOT NULL,
  `rpg_craft_recipes` text NOT NULL,
  `rpg_exp` int(11) NOT NULL DEFAULT '0',
  `rpg_totalexp` int(11) NOT NULL DEFAULT '0',
  `rpg_class` text NOT NULL,
  `rpg_bank` text NOT NULL,
  `rpg_bankcash` text NOT NULL,
  `rpg_x` text NOT NULL,
  `rpg_y` text NOT NULL,
  `rpg_z` text NOT NULL,
  `rpg_cash` decimal(19,2) NOT NULL,
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
  `rpg_emails` text NOT NULL,
  `rpg_base` text NOT NULL,
  `rpg_base_tower1` text NOT NULL,
  `rpg_base_tower2` text NOT NULL,
  `rpg_base_tower3` text NOT NULL,
  `rpg_base_tower4` text NOT NULL,
  `rpg_henchleaders` int(11) NOT NULL,
  `rpg_henchmen` int(11) NOT NULL,
  `rpg_tutorial` text NOT NULL,
  `rpg_mapsize` text NOT NULL,
  `rpg_pvp_won` int(11) NOT NULL,
  `rpg_pvp_lost` int(11) NOT NULL,
  `rpg_pvp_lastplayer` int(11) NOT NULL,
  `rpg_clan` int(11) NOT NULL,
  `rpg_clanrank` int(11) NOT NULL,
  `rpg_quests_current` text NOT NULL,
  `rpg_quests_completed` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1297 DEFAULT CHARSET=latin1 COMMENT='hi';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-09 15:39:39
