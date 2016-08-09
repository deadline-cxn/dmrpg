-- phpMyAdmin SQL Dump
-- version 2.11.9.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2009 at 08:06 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `dminds1_rpg`
--

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE IF NOT EXISTS `awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `name`, `description`, `image`, `time`) VALUES
(1, 'king', 'Lead by Example Crown', 'images/awards/king_edit.gif', '2004-10-07 16:39:51'),
(2, 'php', 'PHP holy light blue oval of coding', 'images/awards/php.gif', '2004-10-07 16:40:04'),
(3, 'c++', 'Ornamental Paperweight of C++', 'images/awards/c.gif', '2004-10-07 16:40:16'),
(4, 'shit_bronze', '2,500 Shit Point bronze turd', 'images/awards/shit_bronze.gif', '2004-10-07 16:40:30'),
(11, 'linux', 'Ominpotent Trinket of the Penguin', 'images/awards/linux.gif', '2004-10-07 05:55:21'),
(5, 'flash', 'Golden Belt-Necklace of Flashing', 'images/awards/gm_flash.gif', '2004-10-07 16:40:43'),
(6, 'shit_gold', '5,000 Shit Point golden turds', 'images/awards/shit_gold.gif', '2004-10-07 05:40:12'),
(7, 'jumpman', 'Master Sprite of Game Programming', 'images/awards/gameprg.gif', '2004-10-07 05:41:24'),
(8, 'gl', 'Open GL Prophet Crescent of the Owl', 'images/awards/opengl.gif', '2004-10-07 05:41:57'),
(9, 'html', 'HTML hacks ''n'' slashes award', 'images/awards/html.gif', '2004-10-07 05:43:05'),
(10, 'cascader', 'Cascading Style Sheets Rainbow Amulet', 'images/awards/css.gif', '2004-10-07 05:44:49'),
(13, 'sideburn', 'Encrusted Sideburn of the Bear', 'images/awards/sideburn.gif', '2004-12-10 03:15:44'),
(14, 'holygrenade', 'Lesser Holy Handgrenade', 'images/awards/sideburn.gif', '2004-12-10 03:23:23'),
(15, 'art', 'Majestic Paint  Brush of the Sacred Badger ', 'images/awards/brush.gif', '2005-01-23 12:43:24');

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
-- Table structure for table `forum_list`
--

CREATE TABLE IF NOT EXISTS `forum_list` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Forum Listing' AUTO_INCREMENT=23 ;

--
-- Dumping data for table `forum_list`
--

INSERT INTO `forum_list` (`name`, `id`, `comment`, `posts`, `moderator`, `password`, `no_reply`, `folder`, `parent`, `priority`, `usepass`, `private`, `moderated`, `last_post`) VALUES
('General BS', 9, 'Post about whatever you want...', 0, 1, '', '', '', '21', '1', 'no', 'no', 'no', '0000-00-00 00:00:00'),
('Site Updates', 16, 'Stuff about the site being updated', 0, 1, '', '', '', '21', '8', 'no', 'no', 'no', '285'),
('Kings', 19, 'The inner chamber', 0, 1, '', '', '', '21', 'b', 'no', 'yes', 'no', '287'),
('RPG', 20, 'The Defective Minds RPG', 0, 1, '', '', '', '21', '.2', 'no', 'no', 'no', '286'),
('Forums', 21, '', 0, 0, '', '', 'yes', '', '', '', '', '', '0000-00-00 00:00:00'),
('Bug Reporting', 22, 'Please submit any bugs you may encounter on the website', 0, 0, '', '', '', '21', '.5', '', '', '', '267');

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE IF NOT EXISTS `forum_posts` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=288 ;

--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` (`id`, `poster`, `title`, `message`, `thread`, `forum`, `time`, `thread_top`, `bumptime`, `views`) VALUES
(157, 1168, 'RPG Stuff', 'Hokay now that we have the RPG going I am going to start using this here forum to keep track of our ideas. So, with that note, put your ideas in here.\r\n\r\nIdeas:\r\n1) Inventory on the right pane; when you click on an item in the inventory it will bring up a description of the item and also some options that you can do with the item. For instance if it is a food item, one option will be [Eat] another option will be [Destroy]. If you click on Eat it will do whatever it is to your character that we decide that food item will do, then remove it from the inventory and then put the inventory screen back up. Same principle with other things, like if it is a wearable item, it will put [Equip] and when you click it it will put it on your equipped items like if it is your head item then it will be on your head and now bonuses and modifiers will apply to your stats.\r\n', 157, 19, '2005-08-03 12:03:59', 'yes', '0000-00-00 00:00:00', 7),
(159, 1168, 'Formulas', 'Formulas used off top of my head:<br>\r\n<br>\r\nExperience to next level:<br>\r\nexptolvl = (currentlevel / 8 ) * currentlevel * 2000<br>\r\n<br>\r\nHere is the outout of this algorithm:<br>\r\nLevel          EXP to next Level<br>\r\n1                   250<br>\r\n2                1,000<br>\r\n3                2,250<br>\r\n4                4,000<br>\r\n5                6,250<br>\r\n6                9,000<br>\r\n7              12,250<br>\r\n8              16,000<br>\r\n...<br>\r\n27           182,250<br>\r\n...<br>\r\n53            702,250<br>\r\n<br>\r\nNot bad eh? Yeah I came up with that shit.\r\n\r\n\r\n\r\n', 159, 19, '2005-08-03 10:58:30', 'yes', '2009-07-06 21:00:11', 8),
(163, 1170, 're:RPG Stuff', 'We need a logout button for the actual game page. Also, I would like to put a flash banner for the top, complete with the same buttons you have... but in FLASH!\r\n', 157, 19, '2005-08-06 12:57:28', 'no', '0000-00-00 00:00:00', 0),
(165, 1170, 're:RPG Stuff', 'Also, do you think we should incorporate shit points somehow? I\\''m still not sure how that would translate over to the game... maybe a special store where they can exchange shit points for special items?\r\n', 157, 19, '2005-08-06 01:00:00', 'no', '0000-00-00 00:00:00', 0),
(166, 1170, 're:RPG Stuff', 'Okay... there should be two types of weapons: Melee and Projectile. The Melee weapons are based off of strength, and projectile weapons are based off of intelligence. Projectiles may or may not have ammo (or charges) and melee weapons may or may not degrade over time. Basically, every item should have the option of having a charge or not. ', 157, 19, '2005-08-06 03:01:18', 'no', '0000-00-00 00:00:00', 0),
(167, 1170, 're:RPG Stuff', 'Powers... we need to figure out a system for powers. I don\\''t see this as being much different than regular items, other than powers use up POW. Also, Detectives/Mad Scientists don\\''t have powers, so their POW needs to always be 0.  ', 157, 19, '2005-08-06 03:03:15', 'no', '0000-00-00 00:00:00', 0),
(227, 1170, 'Cleaned up the forums', 'I cleaned up the forums of all the old topics and stuff. ', 227, 19, '2006-11-21 20:07:19', 'yes', '0000-00-00 00:00:00', 1),
(172, 1168, 'Vendors', 'I added images and descriptions to vendors.\r\nThe images are going to be from the monsters_ pool.\r\nAnd the description will be put up under the image when someone talks to a vendor.\r\nIt will be something like:\r\nHey I just got in some shiny new motorcycles...', 172, 19, '2005-08-07 09:05:22', 'yes', '0000-00-00 00:00:00', 0),
(171, 1168, 're:RPG Stuff', 'Um first off so many ideas you should create new threads for each thought.\r\n\r\nUh... Yeah well lets see here the menu buttons across the top ARE in flash already.\r\nAnd I am working on the combat so just chill.', 157, 19, '2005-08-06 07:28:45', 'no', '0000-00-00 00:00:00', 0),
(173, 1168, 'Site fix', 'I added in this thing to the site that whereever there is a viewing of the forums or news or comments items, it automatically puts in the linefeeds.\r\n\r\nYou see I am two lines lower now, and all i did was hit enter two times.\r\nNo need to fuss with all that crappy HTML anymore.\r\nThanks,\r\nSeth\r\n', 173, 19, '2005-08-07 09:07:00', 'yes', '0000-00-00 00:00:00', 0),
(174, 1168, 'RPG Combat', 'How combat melee damage works:\r\n\r\n(Your Strength) / 3 +Weapon damage.\r\n\r\nIf it is a 2-5 damage item, it will add 2-5 damage.\r\n\r\nSo lets say you have 18 str. 18 / 3 = 6. Your base damage is 6.\r\nYou weapon hits for 3 damage.\r\n6+3=9\r\n\r\nThen there is a roll (1-100) and if it is lower than your agility then you get a critical strike. Lets say I have 12 agility. The roll is placed, and it is 9. I get a critical.\r\n\r\n9*2=18\r\n\r\nYou hit X for 18.\r\n\r\n\r\n\r\n', 174, 19, '2005-08-07 09:12:19', 'yes', '0000-00-00 00:00:00', 0),
(175, 1168, 'RPG Combat Bug', 'I fixed the problem where it would attack multiple times without actually causing damage.\r\n\r\nThanks,\r\nSeth\r\n', 175, 19, '2005-08-07 10:32:48', 'yes', '0000-00-00 00:00:00', 2),
(176, 1168, 'Kings posts go to the menu', 'If you are admin of the site then the posts made in this forum will show up on the left menu now.\r\nThanks,\r\nSeth\r\n', 176, 19, '2005-08-07 10:39:51', 'yes', '0000-00-00 00:00:00', 1),
(177, 1170, 're:RPG Combat Bug', 'What was the problem?', 175, 19, '2005-08-08 11:16:26', 'no', '0000-00-00 00:00:00', 0),
(178, 1168, 're:RPG Combat Bug', 'It wasn''t clearing the table after each turn so the turns stacked up in the encounter table.\r\nWhen it retrieved information from the encounter table it went with the first one that was available.\r\n\r\nBefore: write monster data to encounter table...\r\n[old data]\r\n[new data]\r\n[new data]\r\n[new data]\r\n\r\nFix: clear the encounter table after each turn, write the monster data\r\n[new data]\r\n\r\n', 175, 19, '2005-08-09 09:24:12', 'no', '0000-00-00 00:00:00', 0),
(179, 1168, 'RPG Builder', 'Couple of new things:\r\n\r\n1) You can build NPC\\''s now\r\n2) You can build quests now\r\n3) You can attach quests to npc\\''s\r\n4) You can attach loot tables to npcs and quests\r\n5) You can edit users now (basics) and give them items x qty\r\n\r\nThe way a quest works:\r\nrequired_loot = what you have to have in your inventory to finish said quest, it is a loot table of course, percentages dont count here only minimum quantity\r\ngives_loot = will give you this loot from a loot table percentages don\\''t count here only minimum quantity \r\nI am also going to add experience gain to the quest, as well as cash\r\n\r\nso to set up a quest you must first set up at least one loot table to be the required loot for the quest\r\n\r\nUm, what else about the NPC\\''s you can\\''t really do anything with them yet I plan on making an option to add them to a map tile somehow and it will appear when you step on that tile', 179, 19, '2005-08-09 09:31:10', 'yes', '0000-00-00 00:00:00', 3),
(180, 1170, 'Leveling up bug', 'When I got to level 5 it said:\r\nYou have reached level 5!\r\nYou gain -4 hit points.\r\nYou gain -4 power.\r\nI in fact went up 6 HP and not sure about the power, which is better than -4 but I thought I\\''d point this out. ', 180, 19, '2005-08-12 06:54:27', 'yes', '0000-00-00 00:00:00', 2),
(181, 1168, 're:Leveling up bug', 'Yeah I know, its just asthetic though.\r\nI fixed it, but if you are fucking around with the editor giving yourself 35050534 experience, then jumping back to level 2 and then to 35 then back or whatever it\\''s gonna really do some tripped out shit.\r\n', 180, 19, '2005-08-12 04:46:38', 'no', '0000-00-00 00:00:00', 0),
(182, 1168, 'Flash', 'Ok, hear me now..\r\n\r\n I put in a lot of flashes into the flash folder.\r\n\r\nTake a look, and grab them.\r\n\r\nThere are new flashes for all the items in this format:\r\n\r\nitems_name.gif.swf\r\n\r\nIf you create an item, create it in flash AND a gif. The good thing about this is that it\\''s a flash movie clip and you can pretty much do what ever you want with it. \r\n\r\nNow the reason for this, is if you check out the equipment button now, it is a flash. Yes, and it loads in these different little item flashes that you have equipped.\r\n\r\nIt is kind of complex to set up, but now that I understand how to pass data back and forth from flash to the database, there\\''s no limit to the damage we can do here.\r\n\r\nYou can make flashes all you want that rely on the rpg database, just insert that actionscript code to read in the variables from the main frame.\r\n\r\nAnyhow, make all graphics x2 gif and swf but make sure you use .gif.swf extension on the end of the flashes so we can be able to turn off the swf (future).\r\n\r\n', 182, 19, '2005-08-12 04:54:29', 'yes', '0000-00-00 00:00:00', 1),
(183, 1170, 'RPG Ideas left over from old project', '- Headquarters with profile info (more on that later)\r\n- Able to have sidekicks/henchmen \r\n- Ability to set up and join teams\r\n --Have a team headquarters page\r\n- Some locations only reachable by purchasing vehicle, (car, plane, rocket, etc)\r\n- Items that level up along with you\r\n- Abilities that are permentant (flight, superspeed)\r\n --Superspeed would increase AGL and flight would cancel out vehicle use. \r\n --Also, these would not use up POW\r\n- Ability to fight other users, as long as they are of different alignment\r\n- Melee weapons based off of Str and Agl\r\n- Projectiles based off of Agl and Int\r\n\r\nWell, that\\''s what I could salvage from my original idea for the game. ', 183, 19, '2005-08-13 10:34:28', 'yes', '0000-00-00 00:00:00', 1),
(184, 1168, 're:RPG Ideas left over from old project', 'Interesting... Very interesting...', 183, 19, '2005-08-14 06:56:02', 'no', '0000-00-00 00:00:00', 0),
(185, 1170, 're:RPG Builder', 'Kick ass', 179, 19, '2005-08-14 19:01:07', 'no', '0000-00-00 00:00:00', 0),
(186, 1168, 'Combat text replacement', '- This is a reminder and progress indicator\r\n', 186, 19, '2005-08-14 22:24:24', 'yes', '0000-00-00 00:00:00', 1),
(187, 1168, 'Alignment issue', '- reminder and progress', 187, 19, '2005-08-14 22:24:45', 'yes', '0000-00-00 00:00:00', 0),
(188, 1170, 'Defective Minds, Inc Map Tile', 'Make a flash showcasing us and our work. Also, embed a secret that takes the player into combat with our digital personas. \r\nInclude Seth, Will, Tralboss, the DM Brain, Gorgon?, and Rex Ramblewood. \r\n', 188, 19, '2005-08-14 22:30:07', 'yes', '0000-00-00 00:00:00', 0),
(189, 1168, 're:Defective Minds, Inc Map Tile', 'Gorgon is already a monster and I say it is a seperate encounter for him\r\nBut, don\\''t forget the Shit Fairy', 188, 19, '2005-08-15 09:47:22', 'no', '0000-00-00 00:00:00', 0),
(190, 1170, 'News post authors ', 'I think we need something stating who the news post authors are. I have no idea who made that last post. Was it you? Trailboss? Me in a meth-addled frenzy? I don''t know. Maybe I could redesign the pics or something. Or, possibly, we could place the pics in the upper right corner. ', 190, 19, '2005-08-16 11:23:39', 'yes', '0000-00-00 00:00:00', 0),
(195, 1170, 'Games I\\''m playing right now:', 'PC: Dungeon Siege 2 and Rise of Nations\r\nWeb-Based: Darkthrone, Lords of Legend, Kingdom of Loathing, and Torn City\r\nPlaystation: Tekken 4 and GTA: San Andreas', 195, 14, '2005-09-22 06:46:55', 'yes', '0000-00-00 00:00:00', 0),
(196, 1168, 're:Games I''m playing right now:', 'That''s cool here''s a game I''m playing:\r\nNerd Hunter\r\n\r\nI just got 1 point!', 195, 14, '2005-09-24 16:08:25', 'no', '0000-00-00 00:00:00', 0),
(192, 1170, 'Expansion Site', 'Hey remember how we were gonna do the expansion site? MAybe we can still do that? Anyway, I think the banner  on <a href=http://www.defectiveminds.com/ExpansionA/>the expansion site</a> could be used for the rpg banner, just add the buttons. Whatever, just throwin it out there. ', 192, 19, '2005-08-16 12:15:36', 'yes', '0000-00-00 00:00:00', 0),
(212, 1168, 're:Link Friends not working', 'Yeah I know I fixed that shit', 211, 19, '2006-07-24 18:48:39', 'no', '0000-00-00 00:00:00', 0),
(197, 1168, 're:News post authors ', 'I put the pics back ok?\r\ngosh\r\n', 190, 19, '2005-09-24 16:10:24', 'no', '0000-00-00 00:00:00', 0),
(198, 1170, 're:Games I''m playing right now:', 'I''m just curious. What level was your main WoW character? Oh, and how many do you have? Oh, and dlstorm.com... what is that about? Also, how many computers do you own? How many different op systems? Do you have a computer in your bedroom? Backroom? Living room? A laptop you can bring in the bathroom?\r\nAnother thing, what magazines do you have in your bathroom? Anything to do with Linux? Game programming? Do any of them have a semi-nuded woman on the cover? No? \r\nI''m pretty sure that makes 10000 points for me...', 195, 14, '2005-10-02 17:13:53', 'no', '0000-00-00 00:00:00', 0),
(199, 1170, 're:News post authors ', 'About fucking time...', 190, 19, '2005-10-02 17:14:52', 'no', '0000-00-00 00:00:00', 0),
(200, 1168, 're:Games I\\''m playing right now:', 'No, Nerd Hunter is played like this. One point if you encounter a nerd. If it\\''s dealing with more than one issue of nerdiness then it is still one point. Also, you may only gain 1 point per individual. And you need a 100 sided dice with a roll of at least 80.\r\n', 195, 14, '2005-10-10 09:02:43', 'no', '0000-00-00 00:00:00', 0),
(201, 1005, 're:Games I\\''m playing right now:', 'Hoo boy! I just got me TWO points... heh heh...', 195, 14, '2005-10-11 10:22:17', 'no', '0000-00-00 00:00:00', 0),
(243, 1168, 'Items', 'I''ve been adding items.\r\n\r\nOne of our first priorities needs to be to come up with a good set of items for levels 1-10. The reason for this is so that people will get a sense of being able to upgrade thier characters. This is essential.\r\nWe need to get some items in for each type ie; weapons, helmets, etc.\r\n\r\nAnyway great work, lets do this!\r\nSeth\r\n', 243, 19, '2009-07-03 11:14:41', 'yes', '2009-07-03 11:14:41', 8),
(203, 1168, 'Going to add some stuff to the site...', 'And you can\\''t stop me... I will rearrange your face like I am rearranging the site if you say anything....', 203, 19, '2005-11-08 01:31:51', 'yes', '0000-00-00 00:00:00', 0),
(205, 1170, 're:Going to add some stuff to the site...', 'Ummm... what?\r\nSeriously though, I have begun gearing up for renovations. Remember when we said we would change up the site in response to the new year? Well, I have been writing down propositions and ideas for a while now, which is why I haven\\''t been updating the site lately. \r\nWhat I mean to say by this is that I have some very intriguing ideas to make this site stand out. I am putting together a \\"portfolio\\" of sorts to present to you. I hopefully will have a complete package to present you within a month, with everything from a website redesign to completed literary masterpieces. \r\nI have this vision that refuses to leave. I plan on exploiting it to the fullest. \r\n', 203, 19, '2005-11-22 06:43:54', 'no', '0000-00-00 00:00:00', 0),
(211, 1170, 'Link Friends not working', 'The link friends area is giving an error when you click on them. ', 211, 19, '2006-03-20 12:28:49', 'yes', '0000-00-00 00:00:00', 0),
(218, 1170, 'New Ideas', 'Its been awhile since we did anything new or interesting on this site, so why don\\''t we write down a few things here that might reel some people in. I\\''ll start:\r\n\r\n - Weekly Comic Strip\r\n - Regular product/entertainment reviews\r\n\r\nBTW, are you still selling stuff on that store?\r\n', 218, 19, '2006-08-01 17:49:28', 'yes', '0000-00-00 00:00:00', 0),
(219, 1168, 're:New Ideas', 'We could whore out the site to anyone who wants to advertise...\r\nAnd I mean anyone, including the xxx stuff\r\n', 218, 19, '2006-08-05 13:28:43', 'no', '0000-00-00 00:00:00', 0),
(225, 1170, 're:New Ideas', 'Decided to move this from the front page:\r\n\r\n\r\n\r\nI was just thinking of something good to make for a flash movie, or whatever. Even a comic.\r\nCheck this out:\r\nThere’s this guy who is just some guy, but he is all happy and cool and stuff. He goes to work etc, and lives a normal life. He is really into the planet Pluto for some reason, and he’s got like T-Shirts and everything like a sports car with a planet Pluto thing on the bumper, and posters in his room, etc. So then he’s all like coming in to work one day real stoked, unaware that they’ are leaving Pluto out of the planets now. So then someone has to break the news to this guy and stuff and of course he snaps. Or whatever…\r\n\r\nJust a thought.\r\nLater,\r\nSeth', 218, 19, '2006-11-17 20:22:32', 'no', '0000-00-00 00:00:00', 0),
(222, 1170, 'Lost Links', 'I am listing all the links we''ve either forgotten about or were never completed in this forum. Also, we seem to have a few other links that you use, so feel free to add anything I am missing. I am just doing this for future reference.\r\n\r\n<a href="http://www.defectiveminds.com/treasures.php">Treasures</a>\r\n<a href="http://www.defectiveminds.com/projects.php">Projects</a>\r\n<a href="http://www.defectiveminds.com/sewage.php">Sewage</a>\r\n<a href="http://www.defectiveminds.com/opencdrom.php">OpenCDTray Script - doesn''t work</a>\r\n<a href="http://www.defectiveminds.com/nes.php">Neverending Story</a>\r\n<a href="http://www.defectiveminds.com/music.php">Music</a>\r\n<a href="http://www.defectiveminds.com/rpg/">RPG</a>\r\n<a href="http://www.defectiveminds.com/ExpansionA/">Expansion</a>\r\n<a href="http://www.defectiveminds.com/tutorials.php">Tutorials</a>\r\n<a href="http://www.defectiveminds.com/photoshopper.php">Photoshop</a>\r\n<a href="http://www.defectiveminds.com/anim.php">Animation</a>\r\n\r\n\r\n', 222, 19, '2006-11-17 20:11:26', 'yes', '0000-00-00 00:00:00', 0),
(226, 1170, 're:Lost Links', 'Couldn''t forget these:\r\n<a href="http://www.defectiveminds.com/ffchat.php">FF Chat</a>\r\n<a href="http://www.defectiveminds.com/new8ball/">8 Ball and stuff</a>\r\n<a href="http://www.defectiveminds.com/delp/">DELP</a>\r\n<a href="http://www.cafepress.com/defectiveminds/">Cafepress Store</a>', 222, 19, '2006-11-19 04:25:27', 'no', '0000-00-00 00:00:00', 0),
(242, 1184, 'Imacomputa', 'Hi you may get emails from me from time to time. If you don''t like this idea, just go to your base and edit your profile to turn off emails from the website.\r\nThat''s all,\r\nImacomputa', 242, 20, '2009-07-03 09:06:29', 'yes', '2009-07-03 09:06:29', 15),
(240, 1168, 'Hello', 'Hi,\r\nWelcome to the game.\r\nIf you have any questions please feel free to ask!\r\nIt doesn''t mean anyone will answer your question but it might make you feel good.\r\nEnjoy!\r\nSeth\r\n', 240, 20, '2009-07-02 23:03:12', 'yes', '2009-07-02 23:03:23', 22),
(232, 1170, 'Bugs', 'I am starting this to list bugs I find.', 232, 0, '2009-07-02 20:38:32', 'yes', '2009-07-02 20:38:32', 0),
(233, 1168, 'What the fuck!', 'Yes it works!', 233, 19, '2009-07-02 20:49:48', 'yes', '2009-07-02 20:49:48', 4),
(286, 1168, 'Testing built in forum commands', '[usr]\r\n[usrs]\r\n[users_logged_details]\r\n', 286, 20, '2009-07-22 21:58:06', 'yes', '2009-07-22 21:58:06', 31),
(235, 1168, 'Test threads', 'Testing...', 235, 9, '2009-07-02 20:50:34', 'yes', '2009-07-02 20:50:34', 6),
(236, 1168, 'Any bugs?', 'Please submit bugs you find here. Try to give as much detail as possible including any error messages you encounter.\r\nThanks,\r\nSeth', 236, 22, '2009-07-02 21:00:52', 'yes', '2009-07-06 18:42:19', 30),
(237, 1170, 're:Any bugs?', 'Ray Gun won''t equip.', 236, 22, '2009-07-02 21:07:03', 'no', '0000-00-00 00:00:00', 0),
(238, 1168, 're:Any bugs?', 'Fixed', 236, 22, '2009-07-02 22:20:13', 'no', '0000-00-00 00:00:00', 0),
(244, 1168, 'I found some old graphics ', 'and uploaded them\r\n', 244, 19, '2009-07-04 17:24:44', 'yes', '2009-07-04 17:24:44', 7),
(245, 1170, 're:Any bugs?', 'Sometimes when fighting more than one monster, two are defeated at the same time (especially if they are the same type). Also, many times when defeating the last (or only) monster, the screen goes straight to the map, bypassing the text that says you won. ', 236, 22, '2009-07-06 18:27:06', 'no', '0000-00-00 00:00:00', 0),
(246, 1170, 're:Any bugs?', 'When you buy or sell anything to a vendor, you return immediately to the map (the item is sold/bought)', 236, 22, '2009-07-06 18:29:47', 'no', '0000-00-00 00:00:00', 0),
(247, 1168, 're:Any bugs?', 'K do me a favor and put bugs in individual threads that way i can deal with them one at a time. It''s easier for me that way', 236, 22, '2009-07-06 18:42:19', 'no', '0000-00-00 00:00:00', 0),
(248, 1168, 'Latest Stuff', 'Here''s some changes I made today.\r\n\r\n- Item bonuses are now included in combat\r\n- Added base\r\n- Added base upgrades\r\n- Added base mailbox upgrade\r\n- Added base bed upgrade\r\n- Added base sidekick generator\r\n- Added base bank upgrade', 248, 16, '2009-07-06 20:51:15', 'yes', '2009-07-06 20:51:15', 9),
(249, 1168, 're:Formulas', 'Monsters give 32 * level experience\r\n\r\nThis will give a curve going up in the amount of monsters needed to kill to level.\r\n\r\nAlso, monsters that are 6 levels below or above you will give you no experience.\r\n', 159, 19, '2009-07-06 20:56:50', 'no', '0000-00-00 00:00:00', 0),
(250, 1168, 're:Formulas', 'In combat 3 strength = 1 damage point modifier.\r\n\r\nIn other words, if you have a weapon that is 22-29 damage and +6 strength. The actual damage will be 24-31.', 159, 19, '2009-07-06 20:58:36', 'no', '0000-00-00 00:00:00', 0),
(251, 1168, 're:Formulas', 'Agility affects your critical strike rating.\r\n\r\nThe formula at present is\r\n\r\nIf agility is greater than Random 1-100. Then it is a critical strike.', 159, 19, '2009-07-06 21:00:11', 'no', '0000-00-00 00:00:00', 0),
(252, 1170, 'Vendor issues', 'Can''t sell anything to vendors.', 252, 22, '2009-07-07 17:11:34', 'yes', '2009-07-07 18:35:24', 11),
(270, 1170, 'New Images Uploaded', 'I am using this to list all the images that I upload.\r\n<img src="http://www.defectiveminds.com/images/monster_homemaker.gif" >\r\n<img src="http://www.defectiveminds.com/images/monster_mailman.gif" >\r\n', 270, 19, '2009-07-11 15:45:41', 'yes', '2009-07-12 02:05:06', 45),
(259, 1168, 'Double post in Firefox', '<a href=http://groups.google.com/group/mozilla.support.firefox/browse_thread/thread/eb1dcbf63457cd5b target=_blank>Double post in firefox bug</a>\r\n\r\nIt has plagued me for like 4 years. Now it is fixed.\r\n\r\nThis happened every time you go to the page using firefox. It was the reason for many of the other bugs that you''ve been reporting to me.\r\n', 259, 22, '2009-07-07 19:42:00', 'yes', '2009-07-07 19:42:00', 8),
(258, 1168, 're:Vendor issues', 'I think that is something I broke for a minute last night. It should be working now.', 252, 22, '2009-07-07 18:35:24', 'no', '0000-00-00 00:00:00', 0),
(260, 1170, 'Good-Evil and Classes', 'I would like to change the Good - Evil stuff (in name only)\r\nGood = Sane\r\nNeutral = Narcissistic\r\nEvil = Sociopathic\r\n\r\nThese tie into what I would like to do with classes:\r\nI am thinking of a branching structure, with class names depending on alignment and level. I''m not sure how alignment will be implemented (if its chosen at the start, like now, or if your actions change that later on)\r\nRegardless, I was thinking about something like this:\r\n\r\nSane: Doctor\r\nNarcissistic: Psychiatrist\r\nSociopathic: Physicist\r\n\r\nAnother idea was to have both levels and alignment play into your class:\r\nFor instance, if you are Sane and chose the Doctor path:\r\nLV 1-10: Student\r\nLV 11-20: Biologist\r\nLV 21+: Doctor\r\n\r\nor if you are a Sociopath:\r\n1-10: Student\r\n11-20: Mathmetician\r\n21+: Physicist\r\n', 260, 19, '2009-07-08 14:02:41', 'yes', '2009-07-08 14:02:41', 5),
(261, 1170, 'World and local maps', 'I have started breaking down the map locations.\r\n\r\nWorld Map: Countryside, Small Town, Woods, Suburb, Gated Community, Uptown, Downtown, Industrial District, and Docks.\r\n\r\nCountryside:\r\nTrailer Park\r\nFarm\r\nCreek\r\nGeneral Store (vendor)\r\nCorn Field\r\nJunkyard\r\nBar\r\nMeth Lab?\r\nCult Compound?\r\n\r\nWoods: \r\n(vendor)\r\nSummer Camp\r\nHunting Ground/camp\r\nCamper Site\r\nLake\r\nForest\r\nField\r\nSwamp\r\nAbandoned Shack\r\n\r\nSmall Town (Starting Location):\r\nChurch\r\nClinic\r\nMechanics\r\nCourt House\r\nRural School\r\nBar\r\n\r\nSuburb(Starting Location):\r\nSuperstore (Walmart)\r\nRetirement Home\r\nStrip Mall\r\nPawn Shop (vendor)\r\nNeighborhood\r\nPublic School\r\nBar\r\nUnfinished Subdivision\r\n\r\nGated Community (Starting Location):\r\nGuard Shack\r\nPrivate School\r\nMansion\r\n\r\nThat''s as far as I got. I was also toying around with the idea of starting locations depending on your class. Each starting location will have a school.', 261, 19, '2009-07-08 14:12:15', 'yes', '2009-07-14 12:37:59', 21),
(262, 1170, 'Schools', 'Here is my idea. You go to school in your starting location. You earn a high school diploma, which allows you to attend university. Once you''ve earned a degree, you are allowed to visit class specific locations to earn abilities and items. \r\n\r\nFor instance, you choose the Doctor class. You go to school as a student. After you get a diploma, you can go to university. After you get your degree, you can go to a hospital and instead of just fighting monsters, you would be able to learn abilities or whatever. \r\n\r\nI would also like to see leveling dependent on education. For instance, you can''t get past level 10 without finishing high school. Just an idea.', 262, 19, '2009-07-08 14:16:54', 'yes', '2009-07-08 16:26:31', 5),
(263, 1170, 'Stats', 'HP = Will to live\r\nPOW = Motivation\r\nAP = Enthusiasm? Apathy? Maybe switch with POW?\r\nSTR = Intimidation \r\nDEX = Fatness??? Body Mass Index? (BMI)? Magnitude?\r\nINT = Syllogism (means deductive reasoning)? Comprehension? \r\nDEF = Callousness\r\n\r\nI''m trying to shift most of the attacks and defenses to mental ones,\r\nwhich is why the stats are renamed to something that affects perception.\r\nLet me know what you think.', 263, 19, '2009-07-08 14:34:16', 'yes', '2009-07-08 16:25:36', 6),
(264, 1168, 're:Stats', 'All this sounds good. I especially like BMI.\r\nI''ll change it all when i get a chance\r\n\r\n', 263, 19, '2009-07-08 16:25:36', 'no', '0000-00-00 00:00:00', 0),
(265, 1168, 're:Schools', 'Hmm ok I will start thinking about how to implement that', 262, 19, '2009-07-08 16:26:31', 'no', '0000-00-00 00:00:00', 0),
(266, 1170, 'Motivation error', 'When wearing something that boosts motivation, you are still unable to have more motivation than your base max.', 266, 22, '2009-07-08 18:40:16', 'yes', '2009-07-08 18:41:27', 8),
(267, 1168, 're:Motivation error', 'Yes its the same way with hp. I just haven''t added the code for that yet. It isn''t really a bug per se.\r\n', 266, 22, '2009-07-08 18:41:27', 'no', '0000-00-00 00:00:00', 0),
(268, 1168, 'Started spreadsheet for items', 'It is based off the php data base.\r\nGood stuff\r\n\r\n<a href=http://www.defectiveminds.com/files/rpg_items.xls target=_blank>http://www.defectiveminds.com/files/rpg_items.xls</a>\r\n\r\nyou can use open office (free office suite) to work with it which i highly recommend.\r\n\r\nI''m going to put some other stuff in files folder also.\r\n', 268, 19, '2009-07-10 20:48:44', 'yes', '2009-07-11 12:56:55', 6),
(269, 1170, 're:Started spreadsheet for items', 'awesome. And yeah, I only use openoffice... fuck MS office. Actually, next semester, I plan on converting my laptop to open source software only since I no longer need to work in MS visual studio for class. ', 268, 19, '2009-07-11 12:56:55', 'no', '0000-00-00 00:00:00', 0),
(271, 1170, 're:New Images Uploaded', '<img src="http://www.defectiveminds.com/images/monster_witness.gif" >\r\n(jehovah''s witness type character)', 270, 19, '2009-07-11 16:18:56', 'no', '0000-00-00 00:00:00', 0),
(272, 1168, 'Site Log', '<a href=http://www.defectiveminds.com/log/log.htm target=_blank>Log File</a>', 272, 19, '2009-07-11 16:57:54', 'yes', '2009-07-11 16:57:54', 6),
(273, 1170, 're:New Images Uploaded', 'dm_new_banner - going to be used for the new front page.\r\n        I am also working on an awesome front page pic. More to come on that.\r\n\r\n<img src="http://www.defectiveminds.com/images/dm_new_banner.gif"  width=700 height=100>', 270, 19, '2009-07-11 17:20:50', 'no', '0000-00-00 00:00:00', 0),
(274, 1168, 'Loot tables / World Loot', 'I made some changes to the way the loot tables work.\r\n\r\nFirst any creature will drop equipable items within 2 levels of itself.\r\nThis means that any item that is created to be equipable will automatically drop off creatures of the correct level.\r\n\r\nSecond I removed alot of the items from the loot tables because they were dropping way too much. \r\n', 274, 19, '2009-07-12 01:08:09', 'yes', '2009-07-12 01:08:09', 7),
(275, 1170, 're:New Images Uploaded', 'Here is a preview of what I''m working on for the front page. \r\n<img src="http://www.defectiveminds.com/will/front_image.gif" height=200 width=600>\r\nStill got a lot left to do, but its coming along nicely.', 270, 19, '2009-07-12 01:35:41', 'no', '0000-00-00 00:00:00', 0),
(276, 1170, 're:New Images Uploaded', 'Oh, and this is what the front page <i>may</i> look like when I finish (minus all the trim and ruffles)\r\n<img src="http://www.defectiveminds.com/will/site_sketch.jpg" height =384 width=512 >', 270, 19, '2009-07-12 01:54:11', 'no', '0000-00-00 00:00:00', 0),
(277, 1168, 're:New Images Uploaded', 'Very nice... BTW I made a file called \r\n\r\nitem__blank.gif\r\n\r\nI am going to start making items with this image.\r\n\r\n\r\n<img src=images/item__blank.gif>\r\n\r\nIf  you see it that is an item you could draw in.\r\nThen edit the item to point to the new item_ file.\r\n', 270, 19, '2009-07-12 02:05:06', 'no', '0000-00-00 00:00:00', 0),
(278, 1168, 're:World and local maps', 'I''ve been toying around with this but I don''t think alot of starting areas is the answer. Lets start with 2 starting areas. Here is my proposal. I have broken the areas down into levels and put some monsters in. If you like it I will start implementing these areas and remove all the locations we have now.\r\n\r\nSmall Town (Starting Location):	Lvl 1-15				\r\n					\r\nClinic Lvl 1-3	Junkie	Nurse	Doctor		\r\nChurch Lvl 3-6	Pastor	Choir Boy	Youth	Deacon	\r\nMechanic Lvl 6-9	Grease Monkey				\r\nCourt House Lvl 9-12	Judge	Court Recorder	Bailiff	Jury Member	\r\nGated Community Lvl 12-15	Homemaker				(incorporate guard shack, private school, mansion in here?)\r\nRural School (school)					\r\nBar (building) &#8594; more to come					\r\nSpeedy Mart (vendor)					\r\n					\r\nSuburb (Starting Location):	Lvl 1-15				\r\n					\r\nNeighborhood Lvl 1-3					\r\nStrip Mall Lvl 3-6	Fan Boy	Goth Kid	Fat Kid	Bully	Whino\r\nUnfinished Subdivision Lvl 6-9					\r\nSuper-Mart Lvl 9-12	Greeter	Cashier\r\nWackers Lvl 11-14    \r\nRetirement Home Lvl 12-15					\r\nPublic School (school)					\r\nBar (building) &#8594; more to come					\r\nPawn Shop (vendor)					\r\n					\r\nWoods: 	Lvl 15-25				\r\n					\r\nSummer Camp	 Lvl 15-16\r\nCamper Site    Lvl 16-17		\r\nDeep Lake      Lvl 17-18		\r\nDense Forest Lvl 18-19		\r\nGreen Field   Lvl 19-20		\r\nSwamp         Lvl 20-21	\r\nHunter''s Camp Lvl 21-23\r\nCave  Lvl 23-24\r\nShit Fairy City Lvl 24-25\r\nAbandoned Shack (building)\r\nLog Cabin (school)	\r\nBlack Market (vendor)\r\n					\r\nCountryside:	Lvl 25-35			\r\n					\r\nTrailer Park Lvl 25-26\r\nFarm Lvl 26-27\r\nCreek Lvl 27-28\r\nUFO Wreck Lvl 28-29\r\nCorn Field Lvl 29-30\r\nJunkyard Lvl 30-31\r\nMeth Lab Lvl 31-32\r\nUnderground Lair Lvl 32-33\r\nCult Compound Lvl 33-35\r\nSchoolhouse (school)\r\nBar (building)\r\nGeneral Store (vendor)\r\n					\r\n					\r\nUptown:	Lvl 35-45\r\n					\r\nRobot Disco Lvl 35-36\r\nMonument Lvl 42-43\r\nSkyscraper Lvl 44-45\r\n					\r\nDowntown:	Lvl 35-40\r\n\r\n					\r\nIndustrial District:	Lvl 40-45	\r\n\r\nWarehouse Lvl 40-41\r\n					\r\nDocks:	Lvl 45-50\r\n\r\nCargo Ship Lvl 45-46\r\n\r\n\r\nSome Island:	Lvl 50-55	\r\n\r\n					\r\nUnderwater City:	Lvl 55-60\r\n\r\n					\r\n					\r\n					\r\n					\r\n					\r\n					\r\n', 261, 19, '2009-07-14 12:37:59', 'no', '0000-00-00 00:00:00', 0),
(279, 1194, 'Abilities', 'Abilities are now working. There are actions that allow you to learn abilities. These actions can be tied to items. You will notice the scrolls in your inventory. Those will teach you the abilities.\r\nThen just use them in combat.\r\nEdit as you wish.\r\nI''ll be balancing the abilities as we go.\r\n', 279, 19, '2009-07-16 23:59:15', 'yes', '2009-07-16 23:59:15', 4),
(280, 1194, 'Base', 'I have upgraded the base page. More stuff in the base and it looks more like a base.\r\nYou see the four corners of the base that is where the towers are going to be. You''ll be able to upgrade the towers with weapons and/or defense type things like a shield. \r\nWell so much for the base for now. \r\nMore to come.\r\n\r\n', 280, 19, '2009-07-17 00:00:51', 'yes', '2009-07-17 00:00:51', 4),
(281, 1168, 'Hidden Map Tiles', 'Now hidden map tiles work.\r\nThere is only one way to unhide them at this moment.\r\nYou put in see criteria box in the map editor:\r\n\r\naccess=255\r\n\r\nI will be adding more ways to unhide a map tile in the future such as:\r\n\r\nitem=5|item=6\r\n\r\nThe above will require you to have item 5 and 6 in your inventory to see the map tile for instance.\r\n\r\ndiscover=yes\r\n\r\nThis will make this tile show if you have "discovered" it somehow.\r\n\r\ntime=5:00-17:00\r\n\r\nWill show up from 5 am to 5 pm\r\n\r\ndate=5-7|time=5:00-10:00\r\n\r\nWill show up on the 5th - 7th of each month from 5 am to 10 am\r\n\r\ndate=7/4|item=251\r\n\r\nThis will show up on July 4th but only if you have item 251 in your inventory\r\n\r\netc...\r\n\r\n\r\n', 281, 19, '2009-07-18 18:01:02', 'yes', '2009-07-25 12:03:18', 8),
(282, 1168, 're:Hidden Map Tiles', 'One more thing about the hidden map tiles. Our test area on the bottom right of the map is hidden to those who don''t have access 255.\r\n', 281, 19, '2009-07-18 18:02:22', 'no', '0000-00-00 00:00:00', 0),
(283, 1168, 'Crafts', 'Tell me what you think about these crafting professions\r\n\r\n     // techniker     - makes computa hardware\r\n     // hackling      - makes software upgrades for computas\r\n     // squishologist - makes things by squishing other things together\r\n     // armamentary   - makes weapons\r\n     // armorentary   - makes armor\r\n     // enhancifier   - makes improvements to things that can be equipped\r\n     // macgyverist   - makes crazy things out of seemingly useless or unrelated objects', 283, 19, '2009-07-21 17:59:21', 'yes', '2009-07-21 18:02:16', 14),
(284, 1168, 're:Crafts', 'Squishologist recipes:\r\n\r\nEyeball + Empty Bottle = Eye Juice\r\nBird Eyeball + Empty Bottle = Bird Eye Juice\r\n\r\n\r\netc.\r\n', 283, 19, '2009-07-21 18:02:15', 'no', '0000-00-00 00:00:00', 0),
(285, 1168, 'More updates', '- Base Auction Robot\r\n- Map Size changeable\r\n- Fixed various bugs with left character panel displaying wrong information\r\n- Combat is more based on the stats now, still alot of tweaking to do though\r\n- Added Crafts and Recipes in editor (more to come on these)\r\n- Fixed bug with leveling where it would show incorrect information\r\n', 285, 16, '2009-07-22 21:54:39', 'yes', '2009-07-22 21:54:39', 2),
(287, 1168, 're:Hidden Map Tiles', 'level=#\r\nnow works\r\n', 281, 19, '2009-07-25 12:03:18', 'no', '0000-00-00 00:00:00', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `link_bin`
--

INSERT INTO `link_bin` (`id`, `link`, `poster`, `time`, `sname`, `referrals`, `hidden`, `description`, `clicks`, `rating`, `category`, `bumptime`, `referral`, `reviewed`) VALUES
(58, 'http://defectiveminds.com/', 0, '2009-06-29 21:17:07', 'defectiveminds.com', 75, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-26 09:28:13', 'yes', 'no'),
(59, 'http://howtobeevil.com/', 0, '2009-06-30 01:53:48', 'howtobeevil.com', 31, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-26 02:17:57', 'yes', 'no'),
(60, 'http://whois.domaintools.com/', 0, '2009-06-30 02:54:58', 'whois.domaintools.com', 18, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-24 16:18:34', 'yes', 'no'),
(61, 'http://retardedgorillas.com/', 0, '2009-06-30 03:06:20', 'retardedgorillas.com', 19, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-26 07:43:59', 'yes', 'no'),
(62, 'http://www.sitedossier.com/', 0, '2009-06-30 18:46:35', 'www.sitedossier.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-06-30 18:46:35', 'yes', 'no'),
(63, 'http://www.validpokerrooms.com/', 0, '2009-06-30 20:14:08', 'www.validpokerrooms.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-06-30 20:14:08', 'yes', 'no'),
(64, 'http://www.widecircles.com/', 0, '2009-06-30 22:17:37', 'www.widecircles.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-06-30 22:17:37', 'yes', 'no'),
(65, 'http://www.candidcarinsure.com/', 0, '2009-07-01 03:06:14', 'www.candidcarinsure.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-01 03:06:14', 'yes', 'no'),
(66, 'http://smart.apnoti.com/', 0, '2009-07-01 05:50:16', 'smart.apnoti.com', 5, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-21 12:14:01', 'yes', 'no'),
(67, 'http://www.furthercarehealth.com/', 0, '2009-07-01 09:25:23', 'www.furthercarehealth.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-01 09:25:23', 'yes', 'no'),
(68, 'http://www.howtoautoinsure.com/', 0, '2009-07-01 18:37:25', 'www.howtoautoinsure.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-01 18:37:25', 'yes', 'no'),
(69, 'http://r2606.com/', 0, '2009-07-02 07:05:34', 'r2606.com', 3, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-02 07:05:35', 'yes', 'no'),
(70, 'http://www.localpokercasino.com/', 0, '2009-07-02 08:07:49', 'www.localpokercasino.com', 4, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-02 10:14:37', 'yes', 'no'),
(71, 'http://www.justlygamble.com/', 0, '2009-07-06 03:02:35', 'www.justlygamble.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-06 12:06:28', 'yes', 'no'),
(72, 'http://www.worthautoinsure.com/', 0, '2009-07-07 05:11:34', 'www.worthautoinsure.com', 4, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-07 11:03:56', 'yes', 'no'),
(73, 'http://www.yandex.ru/', 0, '2009-07-07 16:38:38', 'www.yandex.ru', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-07 16:38:38', 'yes', 'no'),
(74, 'http://www.throughhealthcare.com/', 0, '2009-07-07 19:04:26', 'www.throughhealthcare.com', 4, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-08 03:00:55', 'yes', 'no'),
(75, 'http://www.intocasinopoker.com/', 0, '2009-07-09 00:56:55', 'www.intocasinopoker.com', 4, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-09 08:38:49', 'yes', 'no'),
(76, 'http://www.leadergambling.com/', 0, '2009-07-10 04:31:33', 'www.leadergambling.com', 3, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-10 12:33:07', 'yes', 'no'),
(77, 'http://www.modernmotorinsure.com/', 0, '2009-07-11 13:37:57', 'www.modernmotorinsure.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-11 15:30:39', 'yes', 'no'),
(78, 'http://www.google.com/', 0, '2009-07-11 19:56:35', 'www.google.com', 10, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-24 20:12:52', 'yes', 'no'),
(79, 'http://by124w.bay124.mail.live.com/', 0, '2009-07-11 20:08:08', 'by124w.bay124.mail.live.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-11 20:26:34', 'yes', 'no'),
(80, 'http://www.finesthealthinsure.com/', 0, '2009-07-12 04:04:10', 'www.finesthealthinsure.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-12 08:51:27', 'yes', 'no'),
(81, 'http://lobsterprices2009.freshlivelobsters.com/', 0, '2009-07-12 11:14:57', 'lobsterprices2009.freshlivelobsters.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-12 11:14:57', 'yes', 'no'),
(82, 'http://www.legalcasinopoker.com/', 0, '2009-07-13 00:49:06', 'www.legalcasinopoker.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-13 03:46:37', 'yes', 'no'),
(83, 'http://www.retardedgorillas.com/', 0, '2009-07-13 04:50:24', 'www.retardedgorillas.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-13 04:50:24', 'yes', 'no'),
(84, 'http://www.itisgambling.com/', 0, '2009-07-13 18:09:23', 'www.itisgambling.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-13 19:12:52', 'yes', 'no'),
(85, 'http://www.yahoo.com/', 0, '2009-07-13 20:38:43', 'images.search.yahoo.com', 8, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-21 21:08:01', 'yes', 'no'),
(86, 'http://www.usualmotorinsure.com/', 0, '2009-07-14 12:39:44', 'www.usualmotorinsure.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-14 16:04:43', 'yes', 'no'),
(87, 'http://www.opthealthcoverage.com/', 0, '2009-07-14 23:15:04', 'www.opthealthcoverage.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-15 00:11:33', 'yes', 'no'),
(88, 'http://www.howtobeevil.com/', 0, '2009-07-15 11:36:33', 'www.howtobeevil.com', 3, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-22 13:14:37', 'yes', 'no'),
(89, 'http://www.goforpokerrooms.com/', 0, '2009-07-15 13:42:07', 'www.goforpokerrooms.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-15 13:42:07', 'yes', 'no'),
(90, 'http://red-dir-cgpay-0307.com/', 0, '2009-07-15 16:42:21', 'red-dir-cgpay-0307.com', 3, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-15 16:42:22', 'yes', 'no'),
(91, 'http://www.crucialblackjack.com/', 0, '2009-07-16 07:36:38', 'www.crucialblackjack.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-16 10:37:59', 'yes', 'no'),
(92, 'http://www.inspectautoinsure.com/', 0, '2009-07-16 17:28:52', 'www.inspectautoinsure.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-16 17:28:52', 'yes', 'no'),
(93, 'http://www.facebook.com/', 0, '2009-07-17 11:01:10', 'www.facebook.com', 3, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-25 14:45:46', 'yes', 'no'),
(94, 'http://www.nationalcarehealth.com/', 0, '2009-07-17 11:13:51', 'www.nationalcarehealth.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-17 11:57:46', 'yes', 'no'),
(95, 'http://www.keywordspy.com/', 0, '2009-07-17 17:10:27', 'www.keywordspy.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-17 17:10:27', 'yes', 'no'),
(96, 'http://www.badmovies.org/', 0, '2009-07-17 20:03:55', 'www.badmovies.org', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-19 20:56:00', 'yes', 'no'),
(97, 'http://www.williamdelahoussaye.com/', 0, '2009-07-17 21:49:06', 'www.williamdelahoussaye.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-17 21:49:06', 'yes', 'no'),
(98, 'http://www.viewgambling.com/', 0, '2009-07-18 03:21:05', 'www.viewgambling.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-18 03:21:05', 'yes', 'no'),
(99, 'http://www.onlineautoinsure.com/', 0, '2009-07-18 07:25:20', 'www.onlineautoinsure.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-18 09:13:44', 'yes', 'no'),
(100, 'http://www.originalroulette.com/', 0, '2009-07-19 02:33:53', 'www.originalroulette.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-19 02:49:03', 'yes', 'no'),
(101, 'http://www.nonstophealthplans.com/', 0, '2009-07-19 15:58:33', 'www.nonstophealthplans.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-19 16:14:47', 'yes', 'no'),
(102, 'http://127.0.0.1/', 0, '2009-07-20 09:29:00', '127.0.0.1', 17, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-26 20:05:26', 'yes', 'no'),
(103, 'http://michael-pc/', 0, '2009-07-20 09:29:05', 'michael-pc', 605, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-20 20:56:03', 'yes', 'no'),
(104, 'http://www.extraholdem.com/', 0, '2009-07-21 14:03:19', 'www.extraholdem.com', 4, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-21 19:02:41', 'yes', 'no'),
(105, 'http://bl107w.blu107.mail.live.com/', 0, '2009-07-22 13:15:11', 'bl107w.blu107.mail.live.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-22 13:15:11', 'yes', 'no'),
(106, 'http://www.nowcraps.com/', 0, '2009-07-22 20:32:57', 'www.nowcraps.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-22 20:33:14', 'yes', 'no'),
(107, 'http://by103w.bay103.mail.live.com/', 0, '2009-07-22 21:12:04', 'by103w.bay103.mail.live.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-22 21:12:04', 'yes', 'no'),
(108, 'http://www.primewheelsinsure.com/', 0, '2009-07-23 13:08:58', 'www.primewheelsinsure.com', 4, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-23 20:07:03', 'yes', 'no'),
(109, 'http://bl137w.blu137.mail.live.com/', 0, '2009-07-23 20:42:30', 'bl137w.blu137.mail.live.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-23 20:42:30', 'yes', 'no'),
(110, 'http://www.fastmedicalplans.com/', 0, '2009-07-24 18:24:45', 'www.fastmedicalplans.com', 2, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-24 22:33:32', 'yes', 'no'),
(111, 'http://www.oktexaspoker.com/', 0, '2009-07-25 05:05:05', 'www.oktexaspoker.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-25 05:05:05', 'yes', 'no'),
(112, 'http://www.yourbaccarat.com/', 0, '2009-07-25 23:09:13', 'www.yourbaccarat.com', 3, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-26 01:03:20', 'yes', 'no'),
(113, 'http://www.choosedriveinsure.com/', 0, '2009-07-26 19:42:06', 'www.choosedriveinsure.com', 1, 1, '', 0, 0, '!!!TEMP!!!', '2009-07-26 19:42:06', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='news' AUTO_INCREMENT=243 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `headline`, `message`, `category1`, `category2`, `category3`, `category4`, `submitter`, `time`, `image_url`, `image_link`, `image_alt`, `topstory`, `published`, `views`, `rating`, `sfw`) VALUES
(232, 'Site news updated', 'The news is now added to the site.<br>\r\nMore to come.<br>\r\n', '', '', '', '', 1168, '2009-07-09 08:38:02', '', '', '', 'no', 'yes', 111, '', ''),
(239, 'Auction Robot added to Base', 'Auctions are now in. You have to find an auction robot to add to your base first.\r\n', '', '', '', '', 1194, '2009-07-17 22:53:05', '', '', '', '', 'yes', 0, '', ''),
(240, 'New Areas Available', 'There are some new areas available. You can level from 1-15 in the starting areas. You can level further in the new areas. Good luck.', '', '', '', '', 1168, '2009-07-19 20:01:19', '', '', '', '', 'yes', 0, '', ''),
(241, 'Map size adjustable', 'You can now adjust the size of the map by clicking the + or - on the map screen', '', '', '', '', 1168, '2009-07-21 19:30:01', '', '', '', '', 'yes', 0, '', ''),
(242, 'Henchmen and Henchmen Leaders added', 'The henchmen and henchmen leader generators are now in. These will allow you to use some action points to make henchmen. You will only be able to make 1000 henchmen per henchmen leader. These henchmen will play a key role in the PvP battles that are going in.\r\nYou may PvP battle someone now but the henchmen are not completely worked in.\r\nFor the time being it is purely a 50/50 chance of winning in PvP.\r\nIn the future the base towers will also play a role in the PvP battles.\r\nMore to come on the PvP system.', '', '', '', '', 1168, '2009-07-24 16:48:21', '', '', '', '', 'yes', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pmsg`
--

CREATE TABLE IF NOT EXISTS `pmsg` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `pmsg`
--

INSERT INTO `pmsg` (`id`, `to`, `from`, `subject`, `message`, `date`, `time`, `read`, `cash`, `items`) VALUES
(1, 'Defective Will', 'Defective Seth', 'Test', 'Test', '2009-07-06', '23:43:58', 'yes', '', ''),
(2, 'Defective Seth', 'Defective Will', 'test', 'teest test test', '2009-07-06', '23:47:00', 'yes', '', ''),
(3, 'Defective Will', 'Defective Seth', 'Test again', 'This is another test\r\n', '2009-07-07', '16:56:21', 'yes', '', ''),
(4, 'Defective Seth', 'Imacomputa', 'What', '? The hell?\r\n', '2009-07-07', '17:01:20', 'yes', '', ''),
(99, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.10 and 51 henchmen', '2009-07-24', '19:47:46', 'no', '', ''),
(11, 'MOFO', 'Defective Seth', 're: ', 'you stinkYou stink too\r\n', '2009-07-19', '21:49:40', 'yes', '', ''),
(28, 'Defective Will', 'Defective Seth', 'Mail', 'Yeah testing again', '2009-07-21', '05:53:40', 'yes', '', ''),
(93, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.08', '2009-07-24', '19:42:18', 'no', '', ''),
(94, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.06 and 0 henchmen', '2009-07-24', '19:46:03', 'no', '', ''),
(95, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.03 and 0 henchmen', '2009-07-24', '19:46:08', 'no', '', ''),
(96, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.04 and 0 henchmen', '2009-07-24', '19:47:19', 'no', '', ''),
(97, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.11 and 103 henchmen', '2009-07-24', '19:47:33', 'no', '', ''),
(98, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.05 and 35 henchmen', '2009-07-24', '19:47:37', 'no', '', ''),
(90, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.08', '2009-07-24', '19:38:20', 'no', '', ''),
(91, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.11', '2009-07-24', '19:40:38', 'no', '', ''),
(92, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.04', '2009-07-24', '19:40:44', 'no', '', ''),
(38, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.00', '2009-07-24', '00:19:17', 'no', '', ''),
(39, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.05', '2009-07-24', '00:19:59', 'no', '', ''),
(42, 'MOFO', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.20', '2009-07-24', '00:20:56', 'no', '', ''),
(48, 'MOFO', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Sam. You lost $0.01', '2009-07-24', '00:27:04', 'no', '', ''),
(51, 'MOFO', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Sam. You lost $0.01', '2009-07-24', '00:34:10', 'no', '', ''),
(56, 'MOFO', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Sam. You lost $0.00', '2009-07-24', '00:36:38', 'no', '', ''),
(57, 'MOFO', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Sam. You lost $0.01', '2009-07-24', '00:36:49', 'no', '', ''),
(58, 'MOFO', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Sam. You lost $0.01', '2009-07-24', '00:36:54', 'no', '', ''),
(59, 'MOFO', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Sam. You lost $0.01', '2009-07-24', '00:36:59', 'no', '', ''),
(60, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Sam. You lost $0.01', '2009-07-24', '00:37:02', 'no', '', ''),
(61, 'MOFO', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Sam. You lost $0.01', '2009-07-24', '00:37:21', 'no', '', ''),
(66, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Sam. You lost $0.00', '2009-07-24', '00:44:39', 'no', '', ''),
(68, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Sam. You lost $0.03', '2009-07-24', '00:45:29', 'no', '', ''),
(105, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.35 and 3299 henchmen', '2009-07-24', '23:41:41', 'no', '', ''),
(100, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.05 and 69 henchmen', '2009-07-24', '19:47:55', 'no', '', ''),
(101, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.10 and 105 henchmen', '2009-07-24', '19:52:52', 'no', '', ''),
(104, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.25 and 2994 henchmen', '2009-07-24', '23:41:09', 'no', '', ''),
(103, 'MOFO', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $16.32 and 713 henchmen', '2009-07-24', '20:00:38', 'no', '', ''),
(106, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.12 and 3579 henchmen', '2009-07-24', '23:42:02', 'no', '', ''),
(107, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.17 and 3460 henchmen', '2009-07-24', '23:42:26', 'no', '', ''),
(109, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.21 and 3943 henchmen', '2009-07-24', '23:45:54', 'yes', '', ''),
(110, 'MOFO', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $12.66 and 1001 henchmen', '2009-07-25', '19:48:18', 'no', '', ''),
(111, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.16 and 4101 henchmen', '2009-07-25', '19:50:44', 'no', '', ''),
(112, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.21 and 1897 henchmen', '2009-07-25', '19:51:05', 'no', '', ''),
(113, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $1.13 and 662 henchmen', '2009-07-25', '19:52:22', 'no', '', ''),
(114, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.88 and 332 henchmen', '2009-07-25', '19:52:46', 'no', '', ''),
(115, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.89 and 136 henchmen', '2009-07-25', '19:52:55', 'no', '', ''),
(116, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $1.69 and 68 henchmen', '2009-07-25', '19:53:01', 'no', '', ''),
(117, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $1.01 and 40 henchmen', '2009-07-25', '19:53:05', 'no', '', ''),
(118, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $0.88 and 150 henchmen', '2009-07-25', '19:53:17', 'no', '', ''),
(119, 'MOFO', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $4.01 and 570 henchmen', '2009-07-25', '19:53:34', 'no', '', ''),
(120, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $2.27 and 69 henchmen', '2009-07-25', '19:53:50', 'no', '', ''),
(121, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $5.16 and 89 henchmen', '2009-07-25', '19:55:48', 'no', '', ''),
(122, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $1.33 and 64 henchmen', '2009-07-25', '19:56:05', 'no', '', ''),
(123, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $1.66 and 29 henchmen', '2009-07-25', '19:56:11', 'no', '', ''),
(124, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $4.34 and 21 henchmen', '2009-07-25', '19:56:28', 'no', '', ''),
(125, 'MOFO', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $21.65 and 281 henchmen', '2009-07-25', '19:58:17', 'no', '', ''),
(126, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $5.29 and 39 henchmen', '2009-07-25', '19:59:42', 'no', '', ''),
(127, 'Defective Will', 'Imacomputa', 'PvP Lost', 'You lost a PvP battle against Defective Seth. You lost $5.73 and 29 henchmen', '2009-07-25', '20:00:24', 'no', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_actions`
--

CREATE TABLE IF NOT EXISTS `rpg_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `rpg_actions`
--

INSERT INTO `rpg_actions` (`id`, `action`, `value`) VALUES
(1, 'modify_hp', '10'),
(5, 'modify_hp', '15'),
(2, 'teleport', '0,0,0'),
(3, 'modify_pow', '15'),
(4, 'teleport', '0,1,0'),
(6, 'modify_str', '5'),
(7, 'modify_pow', '20'),
(8, 'modify_hp', '15000'),
(9, 'modify_hp', '20'),
(10, 'modify_int', '5'),
(11, 'modify_hpmax', '5'),
(12, 'modify_ap', '5'),
(13, 'loottable', '5'),
(14, 'modify_cash', '5.50'),
(15, 'modify_hpmax', '1'),
(16, 'modify_ap', '5'),
(17, 'loottable', '15'),
(18, 'loottable', '13'),
(19, 'upgrade_base', 'start'),
(31, 'upgrade_base', 'sidekick_stable'),
(20, 'modify_ap', '15000'),
(21, 'loottable', '18'),
(22, 'upgrade_base', 'destroy'),
(23, 'upgrade_base', 'bank'),
(24, 'upgrade_base', 'bed'),
(25, 'upgrade_base', 'sidekick_generator'),
(26, 'upgrade_base', 'mailbox'),
(27, 'modify_hp', '35'),
(28, 'upgrade_base', 'shield_3'),
(29, 'upgrade_base', 'tower_foundation'),
(30, 'upgrade_base', 'tower_guns_1'),
(32, 'upgrade_base', 'trophy_case'),
(33, 'upgrade_base', 'barracks'),
(34, 'upgrade_base', 'shield_2'),
(35, 'upgrade_base', 'tower_guns_2'),
(36, 'upgrade_base', 'shield_1'),
(37, 'modify_hp', '55'),
(38, 'modify_hp', '75'),
(39, 'modify_hp', '105'),
(40, 'modify_hp', '25'),
(41, 'modify_hp', '45'),
(42, 'modify_hp', '125'),
(43, 'teach_ability', '1'),
(44, 'teach_craft', '1'),
(45, 'do_encounter', '6'),
(46, 'hp_modify_enemy', '-28,-35'),
(47, 'hp_leech_enemy', '35,40'),
(48, 'do_fight', '24'),
(49, 'hp_modify_enemy', '-15'),
(50, 'action_chain', '8,20,59'),
(51, 'modify_cash', '-2000000'),
(52, 'upgrade_base', 'quest_log'),
(53, 'upgrade_base', 'craft_machine'),
(54, 'upgrade_base', 'cable_tv'),
(55, 'upgrade_base', 'auction_counter'),
(56, 'upgrade_base', 'trinket_panel'),
(57, 'upgrade_base', 'factory'),
(58, 'hp_modify_enemy', '-10,-15'),
(59, 'modify_pow', '15000'),
(60, 'hp_modify_enemy', '-60,-70'),
(61, 'teach_ability', '12'),
(62, 'teach_ability', '11'),
(63, 'teach_ability', '3'),
(64, 'hp_modify_enemy', '-15,-19'),
(65, 'teach_craft', '2'),
(66, 'teach_craft', '3'),
(67, 'teach_ability', 'Create Hamburger'),
(68, 'modify_str', '1'),
(69, 'modify_int', '1'),
(70, 'modify_agl', '1'),
(71, 'modify_def', '1'),
(72, 'modify_ap', '1'),
(73, 'upgrade_base', 'henchmen_generator'),
(74, 'upgrade_base', 'henchleader_generator'),
(75, 'upgrade_base', 'garage'),
(76, 'modify_exp', '3000'),
(77, 'modify_cash', '2'),
(78, 'action_chain', '44,77'),
(79, 'teach_recipe', '1'),
(80, 'upgrade_base', 'wtf'),
(81, 'teach_craft', '4'),
(82, 'teach_craft', '5'),
(83, 'action_chain', '66,77');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_clans`
--

CREATE TABLE IF NOT EXISTS `rpg_clans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rpg_clans`
--


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
-- Table structure for table `rpg_crafts`
--

CREATE TABLE IF NOT EXISTS `rpg_crafts` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rpg_crafts`
--

INSERT INTO `rpg_crafts` (`id`, `name`, `description`, `image`, `required_tools`, `required_base`, `skill_99`, `skill_199`, `skill_299`, `skill_399`, `skill_499`, `skill_500`) VALUES
(1, 'Squishology', 'Makes things like potions by squishing other things together. It''s a messy profession.', 'craft_squishology.gif', 0, '', 'Assistant Squisher', 'Squish Detective', 'Journeyman Mashifier', 'Master Mashifier', 'Squish Artist', 'Proffesional Squishologist'),
(2, 'MacGyvery', '', 'craft_macgyverism.gif', 0, '', '', '', '', '', '', ''),
(3, 'Techniker', 'Create items based on state of the art technology', 'craft_techniker.gif', 0, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_craft_recipes`
--

CREATE TABLE IF NOT EXISTS `rpg_craft_recipes` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rpg_craft_recipes`
--

INSERT INTO `rpg_craft_recipes` (`id`, `craft_id`, `name`, `description`, `image`, `recipe_skill`, `skill_required`, `craft_mats`, `created_items`) VALUES
(1, 1, 'Eye Juice', 'Looks great, less filling', 'item_vodka.gif', 1, 1, 19, 20),
(2, 2, 'Warp Drive Engine', 'Nothing short of a miracle', 'item_claws.gif', 500, 500, 11, 0),
(3, 1, 'Bird Eye Juice', 'Makes Bird Eye Juice', 'item_bottle_2.gif', 10, 15, 28, 30);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `rpg_encounter`
--

INSERT INTO `rpg_encounter` (`id`, `name`, `image`, `type`, `description`, `repeatable`, `required_level`, `requires_loot`, `reqlootamt`, `gives_loot`, `finishtext`, `unfinishtext`, `trigaction`, `puzzle_opt1`, `puzzle_opt2`, `puzzle_opt3`, `puzzle_opt4`, `puzzle_answer`) VALUES
(5, 'Ruff', 'monster_aggressivepoodle.gif', 'puzzle_hidden_answer', 'Ruff?', 'yes', '1', 0, 0, 1, 'Ruff!', 'Ruff Ruff Ruff! Ruff!', 0, 'Ruff', '', '', '', ''),
(6, 'Oracle Dog', 'monster_enragedterrier.gif', 'puzzle_multiple_choice', 'Welcome adventurer! Answer me this riddle and I shall grant you a fabulous treasure! If you do not answer correctly you get nothing. I have a face but can not see.\r\nI have hands but can not touch.', 'yes', '1', 0, 0, 3, 'Great job! Here is some treasure.', 'Alas you did not get the answer correct. Now off with you!', 14, 'Jesus Christ', 'Verizon Mobile Guy', 'A Clock', 'Your Mom', '3'),
(7, 'Brain', 'DMBrain1.gif', 'puzzle_multiple_choice', 'A floating brain appears and beckons you closer.', 'yes', '1', 0, 0, 0, 'You gain 1 maximum will to live', 'Nothing happens', 15, 'Go toward the brain', 'Flee like a little girl', 'Attack the brain', 'Pretend to fart on the brain', 'random'),
(8, 'Crate', 'item_crate.gif', 'puzzle_multiple_choice', 'You find a crate.', 'yes', '1', 0, 0, 4, 'You hit the jackpot.', 'You get nothing.', 0, 'Open it', 'Leave it', '', '', 'random'),
(9, 'Billiam', 'monster_fan_boy.gif', 'puzzle_multiple_choice', 'Hi, I am looking for my Capt. Smirk doll. Have you seen it?', 'yes', '1', 0, 0, 5, 'Oh thank you! Here is a gift for helping me.', 'Whatever', 0, 'No have you tried looking in your mom''s bed?', 'There it is on the ground', 'Nerd', '', '2'),
(10, 'A Shit Fairy', 'monster_shitfairy.gif', 'puzzle_multiple_choice', 'Hi would you like some shit?', 'yes', '1', 0, 0, 25, 'Allright then here is your shit...', 'You will not recieve any shit', 0, 'Yes', 'No', '', '', '1'),
(11, 'Bottle of Scotch', 'item_emptybottle.gif', 'puzzle_multiple_choice', 'A bottle of scotch! Do you drink it?', 'yes', '', 0, 0, 26, 'You get drunk.', 'You don\\''t get anything.', 40, 'Yes', 'No', '', '', '1'),
(12, 'Blue Discotron 79-H1', 'monster_bluerobotthing.gif', 'puzzle_multiple_choice', '11001011101010101?', 'yes', '4', 0, 0, 27, '10101 1110010 101010!!!!', '10101 1110010 101010!!!!', 0, 'Yes', 'No', 'Maybe', 'What?', 'random'),
(13, 'Evil Robot', 'class-evil_robot.gif', 'puzzle_hidden_answer', 'You find a door in the back of the disco and you make your way over to it.  Suddenly an evil robot comes out of nowhere and asks... What''s the password?', 'yes', '5', 0, 0, 0, '5K-34Le must have sent you huh?', 'No that isn\\''t it... Get lost', 0, '110101', '', '', '', '1'),
(14, 'Preaching Zealot', 'monster_dude.gif', 'puzzle_multiple_choice', 'Hey would you like some information?', 'yes', '3', 0, 0, 16, 'Fine', 'Uh yeah ok', 0, 'Yes', 'No', '', '', '1'),
(15, 'unnamed', 'nopic.gif', '', '', '', '', 0, 0, 0, '', '', 0, '', '', '', '', '');

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

INSERT INTO `rpg_encounters` (`characterid`, `data`) VALUES
(1197, '36;6;14;20;0;20;0');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_inventory`
--

CREATE TABLE IF NOT EXISTS `rpg_inventory` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=731 ;

--
-- Dumping data for table `rpg_inventory`
--

INSERT INTO `rpg_inventory` (`iid`, `user`, `name`, `description`, `quantity`, `id`, `durability`, `durability_max`, `charges`, `charges_max`, `auction_owner`, `auction_starttime`, `auction_endtime`, `auction_startbid`, `auction_highbid`, `auction_buyout`, `auction_highbidder`) VALUES
(2, 1168, 'Gorgon''s Fingernail', 'A fingernail. Not just any fingernail though, it\\''s Gorgon\\''s fingernail.', 1, 38, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(626, 0, 'Robot Brain', 'A brain of a robot.', 1, 41, 0, 0, 0, 0, 1168, '2009-07-24 16:29:57', '2009-07-27 16:29:57', 4.00, 4.00, 5.00, 0),
(627, 0, 'Ball Bearing', 'It\\''s a ball bearing.', 1, 42, 0, 0, 0, 0, 1168, '2009-07-24 16:30:11', '2009-07-27 16:30:11', 4.00, 4.00, 5.00, 0),
(628, 0, 'Sniper Rifle', 'Take a deep breath then exhale... Now shoot', 1, 78, 0, 0, 1, 1, 1168, '2009-07-24 16:32:38', '2009-07-27 16:32:38', 6.00, 6.00, 7.00, 0),
(730, 1184, 'Hair', 'A little lock of hair. It has blood on it.', 2, 15, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(613, 0, 'Overalls of Non-Fatness', 'You feel like planting some squash', 1, 128, 0, 0, 1, 1, 1168, '2009-07-23 23:37:11', '2009-07-26 23:37:11', 5.00, 5.00, 6.00, 0),
(614, 0, 'Viking Boots', 'Not quite as good as pirate boots', 1, 95, 0, 0, 1, 1, 1168, '2009-07-23 23:37:27', '2009-07-26 23:37:27', 5.00, 5.00, 6.00, 0),
(503, 1192, 'Empty Bottle', 'It\\''s a bottle... with nothing in it.', 5, 10, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(543, 0, 'Empty Bottle', 'It\\''s a bottle... with nothing in it.', 5, 10, 0, 0, 0, 0, 1168, '2009-07-24 16:33:16', '2009-07-27 16:33:16', 3.00, 3.00, 4.00, 0),
(709, 1196, 'Eyeball', 'An eyeball that has been violently dislodged from it\\''s socket. (Used in recipies)', 2, 9, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(643, 1192, 'Intergalactic Calculator', 'It is a calculator that exhibits space like qualities. Like its been in space or something.', 2, 45, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(655, 1192, 'Huntin'' Knife', 'This knife is kinda big. It\\''s got serrated edges and it looks like it might be good for huntin\\''\r\n', 1, 31, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(583, 1199, 'Base Bed Assembly Starter Kit', 'One size fits all!', 1, 66, 0, 0, 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(576, 1198, 'Rat Killin'' Stick', 'This stick looks like it might be a good weapon. A good weapon against rats.', 1, 12, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(575, 1198, 'Blue Mask', 'A generic blue mask, used to hide your identity and protect your eyes from dirt and stuff. ', 1, 21, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(581, 1199, 'Rat Killin'' Stick', 'This stick looks like it might be a good weapon. A good weapon against rats.', 1, 12, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(570, 1198, 'Ray Gun', 'A gun designed by a guy named Ray. Oh, it also shoots beams of focused energy. ', 1, 22, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(571, 1198, 'Intergalactic Calculator', 'It is a calculator that exhibits space like qualities. Like its been in space or something.', 2, 45, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(726, 1184, 'Banana', 'For some reason, every time you look at this, you think it\\''s peanut butter jelly time. ', 2, 24, 0, 0, 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(578, 1198, 'Hook', 'It is shaped like a hook', 1, 159, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(728, 1184, 'Upside Down Heart', 'It\\''s an upside down heart. ', 2, 11, 0, 0, 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(729, 1184, 'Fingernail', 'It is a fingernail. It probably got knocked loose in a fight and you just happened to pick it up.', 4, 13, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(727, 1184, 'Parcel', 'Someone\\''s mail. I bet you\\''re wondering what\\''s inside.', 2, 33, 0, 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(724, 1184, 'Power Rectangle', 'It is a rectangle and it seems to radiate energy.', 3, 7, 0, 0, 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(713, 1196, 'Damaged sales invoice', 'It\\''s a sales invoice. You can\\''t read it though because it is damaged beyond readability. If only you had a sales invoice repair kit.', 8, 49, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(711, 1196, 'Apple', 'An apple.', 2, 52, 0, 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(703, 1196, 'Banana', 'For some reason, every time you look at this, you think it\\''s peanut butter jelly time. ', 2, 24, 0, 0, 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(706, 1196, 'Upside Down Heart', 'It\\''s an upside down heart. ', 2, 11, 0, 0, 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(725, 1184, 'Ear', 'This is an ear. Someone or... some "thing"... can''t hear anymore.', 3, 14, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(701, 1196, 'Ear', 'This is an ear. Someone or... some "thing"... can''t hear anymore.', 3, 14, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(582, 1199, 'Base seed', 'This is a base seed. It might grow into a base someday.', 1, 54, 0, 0, 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(580, 1199, 'Pistol of Anger', 'Plows through targets.  Especially good for bosses.', 1, 3, 50, 50, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(625, 0, 'AA Battery', 'AA Battery', 2, 132, 0, 0, 1, 1, 1168, '2009-07-24 16:30:57', '2009-07-27 16:30:57', 5.00, 5.00, 6.00, 0),
(698, 1196, 'Hair', 'A little lock of hair. It has blood on it.', 2, 15, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(517, 1192, 'Knit Socks', 'Put them on your feet and stay warm.', 1, 17, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(519, 1192, 'Leather Boots', 'Leather boots', 1, 87, 0, 0, 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(697, 1196, 'Fingernail', 'It is a fingernail. It probably got knocked loose in a fight and you just happened to pick it up.', 4, 13, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(695, 1168, 'Eyeball', 'An eyeball that has been violently dislodged from it\\''s socket. (Used in recipies)', 2, 9, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(710, 1196, 'Floppy Disc', 'A floppy disc. You might be able to use this with a computer somehow. Looks almost like a floppy disk.', 1, 32, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(708, 1196, 'Guts', 'The brutally crushed remains of something.', 12, 8, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0),
(694, 1168, 'Guts', 'The brutally crushed remains of something.', 12, 8, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rpg_items`
--

CREATE TABLE IF NOT EXISTS `rpg_items` (
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=187 ;

--
-- Dumping data for table `rpg_items`
--

INSERT INTO `rpg_items` (`name`, `id`, `damage`, `damage_high`, `durability`, `durability_max`, `str_mod`, `agl_mod`, `pow_mod`, `int_mod`, `def_mod`, `hp_mod`, `wear_slot`, `image`, `description`, `action`, `charges`, `charges_max`, `useable`, `unique`, `sell_value`, `required_level`, `quest`, `craft_mat`, `sellable`, `tradeable`) VALUES
('Onyx Helmet', 1, 0, 0, 60, 60, 0, 0, 2, 0, 0, 0, 'item_head', 'item_head.gif', 'This helmet is imbued with an Onyx coating and gives the wearer +2 power.', 0, 0, 0, 0, '', '.20', 2, 'no', 'no', 'yes', 'yes'),
('Headband of the Owl', 2, 0, 0, 10, 10, 0, 0, 0, 4, 0, 0, 'item_head', 'item_head.gif', 'Headband that has a trendy Owl logo imprinted on it. This thing gives off +4 Intelligence to the wearer.', 0, 0, 0, 0, '0', '.25', 3, 'no', 'no', 'yes', 'yes'),
('Pistol of Anger', 3, 10, 15, 50, 50, 0, 0, -2, 0, 0, 0, 'item_weapon1', 'item_weapon.gif', 'Plows through targets.  Especially good for bosses.', 0, 0, 0, 0, '0', '.42', 4, 'no', 'no', 'yes', 'yes'),
('Ring of Diminishing', 4, 0, 0, 0, 0, 0, 0, 0, -2, 2, 0, 'item_sechand', 'item_ring.gif', 'Makes the wearer a little bit dull, but also increases defenses.', 0, 0, 0, 0, '0', '1.30', 8, 'no', 'no', 'yes', 'yes'),
('Butthuggers', 5, 0, 0, 50, 50, 0, -2, 0, 0, 4, 0, 'item_legs', 'item_legs.gif', 'Extremely tight pants. They make moving difficult.', 0, 0, 0, 0, '0', '.05', 1, 'no', 'no', 'yes', 'yes'),
('Mysterious Device', 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_mystery.gif', 'No one knows what this thing does and you are not completely sure either. It has a large red button on the top and a label that reads "Do not press".', 2, 5, 5, 1, '', '.40', 1, 'no', 'no', 'yes', 'yes'),
('Power Rectangle', 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_power_rectangle.gif', 'It is a rectangle and it seems to radiate energy.', 3, 1, 1, 1, '0', '.05', 1, 'no', 'no', 'yes', 'yes'),
('Guts', 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_ratguts.gif', 'The brutally crushed remains of something.', 0, 0, 0, 0, '', '.02', 1, 'no', 'no', 'yes', 'yes'),
('Eyeball', 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_rateyeball.gif', 'An eyeball that has been violently dislodged from it\\''s socket. (Used in recipies)', 0, 0, 0, 0, '0', '.03', 1, 'no', 'yes', 'yes', 'yes'),
('Empty Bottle', 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_emptybottle.gif', 'It\\''s a bottle... with nothing in it.', 0, 0, 0, 0, '0', '.02', 1, 'no', 'yes', 'yes', 'yes'),
('Upside Down Heart', 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, '', 'item_upsidedownheart.gif', 'It\\''s an upside down heart. ', 1, 1, 1, 1, '', '.05', 1, 'no', 'no', 'yes', 'yes'),
('Rat Killin'' Stick', 12, 2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_ratkillinstick.gif', 'This stick looks like it might be a good weapon. A good weapon against rats.', 0, 0, 0, 0, '0', '.01', 1, 'no', 'no', 'yes', 'yes'),
('Fingernail', 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_fingernail.gif', 'It is a fingernail. It probably got knocked loose in a fight and you just happened to pick it up.', 0, 0, 0, 0, '', '.02', 1, 'no', 'no', 'yes', 'yes'),
('Ear', 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_ear.gif', 'This is an ear. Someone or... some "thing"... can''t hear anymore.', 0, 0, 0, 0, '', '.01', 1, 'no', 'no', 'yes', 'yes'),
('Hair', 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_hair.gif', 'A little lock of hair. It has blood on it.', 0, 0, 0, 0, '', '.01', 1, 'no', 'no', 'yes', 'yes'),
('Leather Gloves', 16, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 'item_hands', 'item_glove.gif', 'This is a pair of leather gloves.', 0, 0, 0, 0, '', '.05', 1, 'no', 'no', 'yes', 'yes'),
('Knit Socks', 17, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 'item_feet', 'item_socks.gif', 'Put them on your feet and stay warm.', 0, 0, 0, 0, '', '.10', 1, 'no', 'no', 'yes', 'yes'),
('Purple Shirt', 18, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 'item_chest', 'item_shirt.gif', 'This is a finely crafted purple shirt.', 0, 0, 0, 0, '', '.30', 1, 'no', 'no', 'yes', 'yes'),
('Cotton Armbands', 19, 0, 0, 0, 0, 2, 0, 0, 0, 1, 0, 'item_arms', 'item_armbands.gif', 'They look like the would fit pretty snuggly.', 0, 0, 0, 0, '0', '.05', 1, 'no', 'no', 'yes', 'yes'),
('Kevlar Chest', 20, 0, 0, 0, 0, 0, 0, 0, 0, 12, 0, 'item_chest', 'item_shirt_7.gif', 'A chest piece made of kevlar.', 0, 0, 0, 0, '0', '1.20', 6, 'no', 'no', 'yes', 'yes'),
('Blue Mask', 21, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 'item_head', 'item_blue_mask.gif', 'A generic blue mask, used to hide your identity and protect your eyes from dirt and stuff. ', 0, 0, 0, 0, '0', '.25', 1, 'no', 'no', 'yes', 'yes'),
('Ray Gun', 22, 13, 19, 0, 0, 0, 0, 0, 1, 0, 0, 'item_weapon1', 'item_raygun.gif', 'A gun designed by a guy named Ray. Oh, it also shoots beams of focused energy. ', 0, 0, 0, 0, '0', '.65', 5, 'no', 'no', 'yes', 'yes'),
('Knife', 23, 2, 5, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_knife.gif', 'Just a plain ol\\'' knife. Used for stabbin and cuttin steaks. ', 0, 0, 0, 0, '0', '.10', 1, 'no', 'no', 'yes', 'yes'),
('Banana', 24, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_bannana.gif', 'For some reason, every time you look at this, you think it\\''s peanut butter jelly time. ', 5, 1, 1, 1, '0', '.10', 3, 'no', 'no', 'yes', 'yes'),
('Cash Generator', 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_stopwatch.gif', 'This is a test item to see if cash generation actions work.', 14, 1, 1, 1, '0', '5.50', 1, 'no', 'no', 'yes', 'yes'),
('Blue Cape', 25, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 'item_back', 'item_blue_cape.gif', 'Generic blue cape. Keeps your back warm and looks cool. ', 0, 0, 0, 0, '0', '.14', 1, 'no', 'no', 'yes', 'yes'),
('Sharp Dagger', 26, 12, 19, 0, 0, 0, 0, 0, 5, 0, 0, 'item_weapon1', 'item_dagger.gif', 'The blade on this dagger is very sharp. Watch out! It also makes you sharper.', 0, 0, 0, 0, '0', '.75', 6, 'no', 'no', 'yes', 'yes'),
('Gorgon''s Stick', 27, 82, 102, 0, 0, 23, 0, 0, 0, 0, 0, 'item_weapon1', 'item_ratkillinstick.gif', 'This is the very stick used by Gorgon.', 0, 0, 0, 0, '0', '15.50', 25, 'no', 'no', 'yes', 'yes'),
('Ring of Hate', 28, 0, 0, 0, 0, -2, 0, 15, 0, 0, 0, 'item_sechand', 'item_ring.gif', 'A ring that has an aura that makes you hate it. Yet you love it at the same time. You want it. You want to wear it. But you hate it.', 0, 0, 0, 0, '0', '.04', 5, 'no', 'no', 'yes', 'yes'),
('Adrenaline', 29, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_hypo.gif', 'It\\''s a hypodermic needle with some adrenaline in it.', 9, 0, 0, 1, '0', '.15', 3, 'no', 'no', 'yes', 'yes'),
('Vodka', 30, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_emptybottle2.gif', 'A bottle of fine vodka.', 40, 0, 0, 1, '0', '.25', 4, 'no', 'no', 'yes', 'yes'),
('Huntin'' Knife', 31, 5, 9, 0, 0, 2, 0, 0, 0, 0, 0, 'item_weapon1', 'item_knife2.gif', 'This knife is kinda big. It\\''s got serrated edges and it looks like it might be good for huntin\\''\r\n', 0, 0, 0, 0, '0', '.20', 2, 'no', 'no', 'yes', 'yes'),
('Floppy Disc', 32, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_disk.gif', 'A floppy disc. You might be able to use this with a computer somehow. Looks almost like a floppy disk.', 0, 0, 0, 0, '0', '.20', 1, 'no', 'yes', 'yes', 'yes'),
('Parcel', 33, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_env.gif', 'Someone\\''s mail. I bet you\\''re wondering what\\''s inside.', 17, 1, 0, 1, '0', '.02', 1, 'no', 'no', 'yes', 'yes'),
('Orb of Power', 34, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_orb2.gif', 'A shiny, black, round orb. It looks like it might motivate you', 7, 0, 0, 1, '0', '.20', 5, 'no', 'no', 'yes', 'yes'),
('Coffee', 35, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_coffee_cup.gif', 'Coffee... Mmmm (Developer\\\\\\''s Choice)', 8, 1, 1, 1, '0', '87431.42', 1, 'no', 'no', 'yes', 'no'),
('Kid Beatin'' Stick', 36, 11, 16, 0, 0, 2, 0, 0, 0, 0, 0, 'item_weapon1', 'item_ratkillinstick.gif', 'This is a big stick. You could probably shoo off lots of kids with this thing.', 0, 0, 0, 0, '0', '.48', 4, 'no', 'no', 'yes', 'yes'),
('Beretta', 37, 16, 22, 0, 0, 2, 0, 0, 0, 0, 0, 'item_weapon1', 'item_beretta.gif', 'It\\''s some kind of metal device that can propel smaller metal objects at high velocities', 0, 0, 0, 0, '0', '.80', 6, 'no', 'no', 'yes', 'yes'),
('Gorgon''s Fingernail', 38, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_fingernail.gif', 'A fingernail. Not just any fingernail though, it\\''s Gorgon\\''s fingernail.', 0, 0, 0, 0, 'yes', '0', 1, 'yes', 'no', 'yes', 'yes'),
('Lionheart Gloves', 39, 0, 0, 0, 0, 4, 4, 0, 0, 14, 0, 'item_hands', 'item_glove.gif', 'Some gloves that look pretty cool and stuff.', 0, 0, 0, 0, '0', '.80', 10, 'no', 'no', 'yes', 'yes'),
('Brass Knuckles', 40, 12, 18, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_brassknuckles.gif', 'Some brass knuckles.', 0, 0, 0, 0, '0', '.60', 5, 'no', 'no', 'yes', 'yes'),
('Robot Brain', 41, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_thingy.gif', 'A brain of a robot.', 0, 0, 0, 0, '0', '.40', 1, 'no', 'yes', 'yes', 'yes'),
('Ball Bearing', 42, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_orb2.gif', 'It\\''s a ball bearing.', 0, 0, 0, 0, '0', '.02', 1, 'no', 'yes', 'yes', 'yes'),
('Robot Arm', 43, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_robotarm.gif', 'An arm from a robot.', 0, 0, 0, 0, '0', '.60', 1, 'no', 'yes', 'yes', 'yes'),
('Interdimensional Pear', 44, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_pear.gif', 'It\\''s a pear, except there seems to be something interdimensional about it.', 27, 1, 1, 1, '0', '.12', 6, 'no', 'no', 'yes', 'yes'),
('Intergalactic Calculator', 45, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_calc.gif', 'It is a calculator that exhibits space like qualities. Like its been in space or something.', 0, 0, 0, 0, '0', '1.45', 1, 'no', 'no', 'yes', 'yes'),
('Alien Testicle', 46, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_orb.gif', 'A single alien testicle. ', 0, 0, 0, 0, '0', '1.43', 1, 'no', 'yes', 'yes', 'yes'),
('Floppy Disk', 47, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_disk.gif', 'It is a floppy disk. You might be able to put data on it. Similar to a floppy disc.', 0, 0, 0, 0, '0', '.25', 1, 'no', 'yes', 'yes', 'yes'),
('Little Dagger', 48, 3, 7, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_dagger.gif', 'It is a little dagger. Not too big.', 0, 0, 0, 0, '0', '.25', 2, 'no', 'no', 'yes', 'yes'),
('Damaged sales invoice', 49, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_printout2.gif', 'It\\''s a sales invoice. You can\\''t read it though because it is damaged beyond readability. If only you had a sales invoice repair kit.', 0, 0, 0, 0, '0', '.23', 1, 'no', 'no', 'yes', 'yes'),
('Sales invoice repair kit', 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_case.gif', 'This is used to repair damaged sales invoices. Model SIR-K 1K', 0, 0, 0, 0, '0', '24.95', 1, 'no', 'no', 'yes', 'yes'),
('AK-46', 51, 18, 25, 0, 0, 3, 0, 0, 0, 0, 0, 'item_weapon1', 'item_ak47.gif', 'This is the precursor to the AK-47. There is a reason there is an AK-47 if you know what I mean.', 0, 0, 0, 0, '0', '1.16', 7, 'no', 'no', 'yes', 'yes'),
('Apple', 52, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_apple.gif', 'An apple.', 40, 1, 0, 1, '0', '.25', 4, 'no', 'no', 'yes', 'yes'),
('Coffee Machine', 53, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_coffee.gif', 'Makes coffee i guess.', 18, 1, 1, 1, '0', '436431.53', 1, 'no', 'no', 'yes', 'no'),
('Base seed', 54, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_bean.gif', 'This is a base seed. It might grow into a base someday.', 19, 1, 1, 1, 'yes', '5', 1, 'no', 'no', 'no', 'yes'),
('Taser', 55, 21, 26, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_taser.gif', 'This device shoots electrical pulses into the victim.', 0, 1, 1, 0, '0', '1.23', 7, 'no', 'no', 'yes', 'yes'),
('Snug Denim Jeans', 56, 0, 0, 0, 0, 0, 0, 0, 0, 14, 0, 'item_legs', 'item_jeans.gif', 'Snug fitting jeans. They are kind of stylish too.', 0, 1, 1, 0, '0', '.23', 4, 'no', 'no', 'yes', 'yes'),
('Cordouroy Pants', 57, 0, 0, 0, 0, 0, 0, 0, 0, 8, 0, 'item_legs', 'item_cordouroy.gif', 'They make a zipping noise as you walk. ', 0, 1, 1, 0, '0', '.15', 2, 'no', 'no', 'yes', 'yes'),
('Green Jeans', 58, 0, 0, 0, 0, 0, 0, 0, 0, 19, 0, 'item_legs', 'item_greenjeans.gif', 'Faded green jeans. They are cool though.', 0, 1, 1, 0, '0', '.43', 6, 'no', 'no', 'yes', 'yes'),
('Construction Hat', 59, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 'item_head', 'item_hardhat.gif', 'Great defense for the noob types.', 0, 1, 1, 0, '0', '.45', 4, 'no', 'no', 'yes', 'yes'),
('AP Ade', 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_vodka.gif', 'Mmmm delicious AP Ade... Oh yeah!', 12, 1, 1, 1, '0', '2.00', 1, 'no', 'no', 'yes', 'yes'),
('Base Mailbox Kit', 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_mailbox.gif', 'Add a mailbox to your base.', 26, 1, 1, 1, 'yes', '6', 1, 'no', 'no', 'no', 'yes'),
('Extreme Beverage', 61, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_extreme_bev.gif', 'OMG Wow!', 50, 1, 1, 1, '0', '32441.23', 1, 'no', 'no', 'yes', 'no'),
('AP Ade Extreme Generator', 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_gameboy.gif', 'Makes a batch of AP Ade Extreme.', 21, 1, 1, 1, '0', '93562', 1, 'no', 'no', 'yes', 'no'),
('Ring of Intimidation', 63, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 'item_sechand', 'item_ring2.gif', 'This ring looks like it might make you stronger.', 0, 1, 1, 0, '0', '.24', 5, 'no', 'no', 'yes', 'yes'),
('Base destruction kit', 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_crate.gif', 'This crate contains a portable base destruction kit. Use at your own risk.', 22, 1, 1, 1, 'yes', '25', 1, 'no', 'no', 'no', 'yes'),
('Base Bank Upgrade Kit', 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_safe.gif', 'Upgrades your base to include a personal bank.', 23, 1, 1, 1, 'yes', '35', 1, 'no', 'no', 'no', 'yes'),
('Base Bed Assembly Starter Kit', 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_bed.gif', 'One size fits all!', 24, 1, 1, 1, 'yes', '2', 1, 'no', 'no', 'no', 'yes'),
('Base Sidekick Generator', 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_dome.gif', 'Put this in your base, plug it in and wait for your sidekick to generate.', 25, 1, 1, 1, 'yes', '32', 1, 'no', 'no', 'no', 'yes'),
('Laptop Computer', 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_laptop.gif', 'The latest in computing technology. ', 0, 1, 1, 0, '0', '6', 1, 'no', 'no', 'yes', 'yes'),
('Compact Disc Recordable', 71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_cd.gif', 'A blank compact disc recordable.', 0, 1, 1, 0, '0', '.32', 1, 'no', 'yes', 'yes', 'yes'),
('Video Card', 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_cpu_card.gif', 'A 3D video card', 0, 1, 1, 0, '0', '2', 1, 'no', 'no', 'yes', 'yes'),
('Yellow Cake', 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_twinkie.gif', 'Looks delicious', 41, 1, 1, 1, '0', '.35', 8, 'no', 'no', 'yes', 'yes'),
('Rambo Knife', 74, 22, 29, 0, 0, 4, 0, 0, 0, 0, 0, 'item_weapon1', 'item_knife.gif', 'Grrrrrrrrrrrrrrr!', 0, 1, 1, 0, '0', '1.35', 8, 'no', 'no', 'yes', 'yes'),
('Back Scratcher', 75, 8, 12, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_robotarm.gif', 'Great for killing pests... Or scratching your back', 0, 1, 1, 0, '0', '.34', 3, 'no', 'no', 'yes', 'yes'),
('Radiocative TP', 76, 25, 32, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_toiletpaper.gif', 'Wipe your enemies off the radar', 0, 1, 1, 0, '0', '1.45', 9, 'no', 'no', 'yes', 'yes'),
('Banana Bomb', 77, 29, 35, 0, 0, 5, 0, 0, 0, 0, 0, 'item_weapon1', 'item_bannana.gif', 'Kaboom', 0, 1, 1, 0, '0', '1.58', 10, 'no', 'no', 'yes', 'yes'),
('Sniper Rifle', 78, 24, 28, 0, 0, 4, 0, 0, 0, 0, 0, 'item_weapon1', 'item_sniperrifle.gif', 'Take a deep breath then exhale... Now shoot', 0, 1, 1, 0, '0', '1.45', 9, 'no', 'no', 'yes', 'yes'),
('Smoke Grenade', 79, 24, 30, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_smokegrenade.gif', 'Blind your enemies', 0, 1, 1, 0, '0', '1.42', 8, 'no', 'no', 'yes', 'yes'),
('Oversized Green Jeans', 80, 0, 0, 0, 0, 0, 0, 0, 0, 24, 0, 'item_legs', 'item_biggreenjeans.gif', 'They fit!', 0, 1, 1, 0, '0', '.82', 8, 'no', 'no', 'yes', 'yes'),
('Buttsnugglers', 81, 0, 0, 0, 0, 0, -3, 4, 0, 28, 0, 'item_legs', 'item_legs.gif', 'These things fit like a dream. If your dream is to have really tight pants.', 0, 1, 1, 0, '0', '.94', 10, 'no', 'no', 'yes', 'yes'),
('Foreign Army Device', 82, 32, 36, 0, 0, 6, 6, 0, 0, 0, 0, 'item_weapon1', 'item_sak.gif', 'FAD... There is something in there for every occasion', 0, 1, 1, 0, '0', '1.63', 10, 'no', 'no', 'yes', 'yes'),
('Orb of Destruction', 83, 6, 11, 0, 0, 0, 0, 0, 2, 0, 0, 'item_weapon1', 'item_orb2.gif', 'Evil looking orb... It hurts', 0, 1, 1, 0, '0', '.38', 3, 'no', 'no', 'yes', 'yes'),
('Base Shield Installer', 84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_orb.gif', 'Installs a shield (class 1) at your base. Requires base tower foundation', 28, 1, 1, 1, 'yes', '45', 1, 'no', 'no', 'no', 'yes'),
('Base Tower Foundation', 85, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_tower_foundation.gif', 'Use this to add a tower to your base. You can have up to 4 towers.', 29, 1, 1, 1, 'yes', '250', 1, 'no', 'no', 'no', 'yes'),
('Base Tower Gun Housing Assembly', 86, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_tower_guns_1.gif', 'Add guns (class 1) to one of your base towers. Requires base tower foundation', 30, 1, 1, 1, 'yes', '350', 1, 'no', 'no', 'no', 'yes'),
('Leather Boots', 87, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 'item_feet', 'item_boots_1.gif', 'Leather boots', 0, 1, 1, 0, '0', '.15', 2, 'no', 'no', 'yes', 'yes'),
('Scuba Feet', 88, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 'item_feet', 'item_boots_8.gif', 'All you need now is a snorkle', 0, 1, 1, 0, '0', '.35', 3, 'no', 'no', 'yes', 'yes'),
('Steel Toed Boots', 89, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 'item_feet', 'item_boots_2.gif', 'You need to break these in before they become comfortable', 0, 1, 1, 0, '0', '.45', 4, 'no', 'no', 'yes', 'yes'),
('Sneakers', 90, 0, 0, 0, 0, 0, 2, 0, 0, 8, 0, 'item_feet', 'item_boots_10.gif', 'Plain ol sneakers', 0, 1, 1, 0, '0', '.65', 6, 'no', 'no', 'yes', 'yes'),
('Dark Slippers', 91, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 'item_feet', 'item_boots_9.gif', 'Dark as the night...', 0, 1, 1, 0, '0', '.53', 5, 'no', 'no', 'yes', 'yes'),
('Snow Boots', 92, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 'item_feet', 'item_boots_4.gif', 'These boots are warm', 0, 1, 1, 0, '0', '.76', 7, 'no', 'no', 'yes', 'yes'),
('Purple High Heels', 93, 0, 0, 0, 0, 0, -2, 0, 0, 12, 0, 'item_feet', 'item_boots_6.gif', 'For the sophisticated hero', 0, 1, 1, 0, '0', '.82', 8, 'no', 'no', 'yes', 'yes'),
('Red Sneakers', 94, 0, 0, 0, 0, 0, 0, 0, 0, 13, 0, 'item_feet', 'item_boots_5.gif', 'Great for playing basketball... Or covering up feet for battle', 0, 1, 1, 0, '0', '.95', 9, 'no', 'no', 'yes', 'yes'),
('Viking Boots', 95, 0, 0, 0, 0, 5, 0, 0, 0, 15, 0, 'item_feet', 'item_boots_3.gif', 'Not quite as good as pirate boots', 0, 1, 1, 0, '0', '1.03', 10, 'no', 'no', 'yes', 'yes'),
('Rock T-Shirt', 96, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 'item_chest', 'item_shirt_4.gif', 'Someone\\''s favorite band is printed on the front', 0, 1, 1, 0, '0', '.73', 3, 'no', 'no', 'yes', 'yes'),
('Wife Beater', 97, 0, 0, 0, 0, 0, 0, 0, 0, 18, 0, 'item_chest', 'item_shirt_6.gif', 'Yippie Ka Yay', 0, 1, 1, 0, '0', '2.65', 9, 'no', 'no', 'yes', 'yes'),
('Button Down Leisure Top', 98, 0, 0, 0, 0, 0, 0, 0, 0, 21, 0, 'item_chest', 'item_shirt_5.gif', 'Lightly colored for maximum comfort', 0, 1, 1, 0, '0', '2.75', 10, 'no', 'no', 'yes', 'yes'),
('Blue T-Shirt', 99, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 'item_chest', 'item_shirt_2.gif', 'Plain old blue t-shirt', 0, 1, 1, 0, '0', '.52', 2, 'no', 'no', 'yes', 'yes'),
('Long Sleeved Green Shirt', 100, 0, 0, 0, 0, 0, 0, 0, 0, 9, 0, 'item_chest', 'item_shirt_3.gif', '100% Cotton', 0, 1, 1, 0, '0', '.86', 4, 'no', 'no', 'yes', 'yes'),
('Turtle Neck', 101, 0, 0, 0, 0, 0, 0, 0, 3, 11, 0, 'item_chest', 'item_shirt_8.gif', 'Warms the neck', 0, 1, 1, 0, '0', '.98', 5, 'no', 'no', 'yes', 'yes'),
('Red Shirt', 102, 0, 0, 0, 0, 0, 0, 0, 0, 14, 0, 'item_chest', 'item_shirt_9.gif', 'Red Shirt', 0, 1, 1, 0, '0', '1.58', 7, 'no', 'no', 'yes', 'yes'),
('Loafers', 103, 0, 0, 0, 0, 0, 0, 0, 0, 17, 0, 'item_feet', 'item_boots_7.gif', 'Loafers', 0, 1, 1, 0, '0', '1.12', 11, 'no', 'no', 'yes', 'yes'),
('Sweater', 104, 0, 0, 0, 0, 0, 0, 0, 0, 16, 0, 'item_chest', 'item_shirt_10.gif', 'Sweater', 0, 1, 1, 0, '0', '1.86', 8, 'no', 'no', 'yes', 'yes'),
('Flesh Colored Swimsuit', 105, 0, 0, 0, 0, 0, 0, 0, 0, 12, 0, 'item_legs', 'item_shorts_1.gif', 'You\\''ll fool them', 0, 1, 1, 0, '0', '.20', 3, 'no', 'no', 'yes', 'yes'),
('Army Boots', 106, 0, 0, 0, 0, 4, 0, 0, 0, 20, 0, 'item_feet', 'item_boots_2.gif', 'An army boot of one', 0, 1, 1, 0, '0', '1.42', 12, 'no', 'no', 'yes', 'yes'),
('Die Easy Shirt', 107, 0, 0, 0, 0, 0, 0, 0, 0, 24, 0, 'item_chest', 'item_shirt_6.gif', 'Yippie Ka Yay', 0, 1, 1, 0, '0', '2.95', 11, 'no', 'no', 'yes', 'yes'),
('Robo Arms', 108, 0, 0, 0, 0, 0, 0, 0, 0, 18, 0, 'item_hands', 'item_robotarm.gif', 'Roll out', 0, 1, 1, 0, '0', '1.54', 10, 'no', 'no', 'yes', 'yes'),
('Bird Eye', 109, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_eyeb.gif', 'It\\''s the eye of a bird.', 0, 1, 1, 0, '0', '.15', 1, 'no', 'yes', 'yes', 'yes'),
('Giblets', 110, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_ratguts.gif', 'Some bird giblets', 0, 1, 1, 0, '0', '.12', 1, 'no', 'yes', 'yes', 'yes'),
('Talons', 111, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_brassknuckles.gif', 'Bird talons', 0, 1, 1, 0, '0', '.02', 1, 'no', 'no', 'yes', 'yes'),
('Glazed Donut', 112, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_donut.gif', 'This is different than a glayzed dough nut', 37, 1, 1, 1, '0', '.45', 10, 'no', 'no', 'yes', 'yes'),
('Glayzed Dough Nut', 113, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_donut.gif', 'Looks incredibly like a glazed donut', 38, 1, 1, 1, '0', '.85', 12, 'no', 'no', 'yes', 'yes'),
('Egg Noodles', 114, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_pasta.gif', 'Some delicious chinese egg noodles', 42, 1, 1, 1, '0', '1.72', 16, 'no', 'no', 'yes', 'yes'),
('Bifocals', 115, 0, 0, 0, 0, 0, 6, 0, 0, 4, 0, 'item_head', 'item_glasses.gif', 'Makes things easier to see... And hit!', 0, 1, 1, 0, '0', '.35', 5, 'no', 'no', 'yes', 'yes'),
('Red & Green Cape', 116, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 'item_back', 'item_redgreencape.gif', 'Cool looking red and green cape', 0, 1, 1, 0, '0', '.25', 2, 'no', 'no', 'yes', 'yes'),
('Cape of the Flame', 117, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 'item_back', 'item_yellowpurplecape.gif', 'It bears an insignia of the Flame', 0, 1, 1, 0, '0', '.36', 3, 'no', 'no', 'yes', 'yes'),
('Plain ol'' Backpack', 118, 0, 0, 0, 0, 0, 0, 0, 0, 8, 0, 'item_back', 'item_backpack.gif', 'New and improved defensive properties', 0, 1, 1, 0, '0', '.47', 4, 'no', 'no', 'yes', 'yes'),
('Sunfire cape', 121, 0, 0, 0, 0, 0, 0, 0, 0, 18, 0, 'item_back', 'item_orangecape.gif', 'This is hot!', 0, 1, 1, 0, '0', '.91', 7, 'no', 'no', 'yes', 'yes'),
('Crusader''s Cape', 119, 0, 0, 0, 0, 5, 0, 0, 0, 10, 0, 'item_back', 'item_redcape.gif', 'It\\''s super!', 0, 1, 1, 0, '0', '.58', 5, 'no', 'no', 'yes', 'yes'),
('The Dark Avenger', 120, 0, 0, 0, 0, 0, 6, 0, 0, 14, 0, 'item_back', 'item_blackcape.gif', 'Sinister yet heroic', 0, 1, 1, 0, '0', '.79', 6, 'no', 'no', 'yes', 'yes'),
('Helihat', 122, 0, 0, 0, 0, 0, 0, 0, 0, 14, 0, 'item_head', 'item_helihat.gif', 'Helps with stabilization', 0, 1, 1, 0, '0', '.87', 9, 'no', 'no', 'yes', 'yes'),
('Viking Helmet', 123, 0, 0, 0, 0, 0, 0, 0, 0, 8, 0, 'item_head', 'item_vikinghat.gif', 'It looks like it can double as a bed pan', 0, 1, 1, 0, '0', '.87', 6, 'no', 'no', 'yes', 'yes'),
('Deadly Key', 124, 35, 39, 0, 0, 4, 0, 0, 0, 0, 0, 'item_weapon1', 'item_key.gif', 'Put it in between your fingers. It\\''s deadly. It can also open your apartment door.', 0, 1, 1, 0, '0', '1.92', 12, 'no', 'no', 'yes', 'yes'),
('Cash Reducer', 125, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_stopwatch.gif', 'Cash reducer. A test item really to see if the actions work.', 51, 1, 1, 1, '0', '-400000', 1, 'no', 'no', 'yes', 'yes'),
('Sumo Wrestler''s Belt', 126, 0, 0, 0, 0, 0, 0, 0, 0, 32, 0, 'item_legs', 'item_ring3.gif', 'It is shaped like a butt crack.', 0, 1, 1, 0, '0', '2.43', 12, 'no', 'no', 'yes', 'yes'),
('TPS Report', 127, 37, 42, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_printout.gif', 'Um... yeah... ', 0, 1, 1, 0, '0', '2.12', 13, 'no', 'no', 'yes', 'yes'),
('Overalls of Non-Fatness', 128, 0, 0, 0, 0, 0, 8, 0, 0, 36, 0, 'item_legs', 'item_overalls.gif', 'You feel like planting some squash', 0, 1, 1, 0, '0', '2.54', 13, 'no', 'no', 'yes', 'yes'),
('Parachute Shorts', 129, 0, 0, 0, 0, 0, -4, 0, 0, 16, 0, 'item_legs', 'item_shorts_2.gif', 'They make a synthesizer sound as you walk', 0, 1, 1, 0, '0', '.32', 5, 'no', 'no', 'yes', 'yes'),
('Base Trophy Case Upgrade Kit', 130, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_strange.gif', 'Upgrades your base to include a trophy case', 32, 1, 1, 1, 'yes', '14', 1, 'no', 'no', 'no', 'yes'),
('Shit Fairy Hand', 131, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_hand.gif', 'This is the hand from a Shit Fairy.', 0, 1, 1, 0, '0', '.23', 1, 'no', 'yes', 'yes', 'yes'),
('AA Battery', 132, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_battery.gif', 'AA Battery', 0, 1, 1, 0, '0', '3', 1, 'no', 'yes', 'yes', 'yes'),
('Mobster Pistol', 133, 35, 41, 0, 0, 8, 0, 0, 0, 0, 0, 'item_weapon1', 'item_weapon.gif', 'Say hello to my little friend', 0, 1, 1, 0, '0', '2.19', 13, 'no', 'no', 'yes', 'yes'),
('Heavy Wrench', 134, 38, 44, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_spanner.gif', 'You could tighten up the place with this thing', 0, 1, 1, 0, '0', '2.53', 14, 'no', 'no', 'yes', 'yes'),
('Cement Block', 135, 9, 17, 0, 0, 4, 0, 0, 0, 0, 0, 'item_weapon1', 'item_ice.gif', 'That\\''s got to hurt', 0, 1, 1, 0, '0', '.46', 4, 'no', 'no', 'yes', 'yes'),
('Tranquillizer', 136, 39, 47, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_hypo.gif', 'Jab into the neck for best results', 0, 1, 1, 0, '0', '2.75', 15, 'no', 'no', 'yes', 'yes'),
('Length of Rope', 137, 33, 37, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_rope.gif', 'You could probably choke someone with this ', 0, 1, 1, 0, '0', '1.75', 11, 'no', 'no', 'yes', 'yes'),
('Cell Phone', 138, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_cell.gif', 'Samdung model 347M3', 0, 0, 0, 0, '', '7', 0, 'no', 'no', 'yes', 'yes'),
('Dark Armbands', 139, 0, 0, 0, 0, 0, 0, 0, 0, 8, 0, 'item_arms', 'item_armbands2.gif', 'Are they evil? Or are they good but just look evil?', 0, 0, 0, 0, '', '.65', 5, 'no', 'no', 'yes', 'yes'),
('Golden Armbands', 140, 0, 0, 0, 0, 0, 0, 0, 0, 16, 0, 'item_arms', 'item_armbands3.gif', 'Shiny', 0, 0, 0, 0, '', '1.23', 10, 'no', 'no', 'yes', 'yes'),
('White Nylon Arm Covers', 141, 0, 0, 0, 0, 0, 0, 0, 0, 24, 0, 'item_arms', 'item_armbands4.gif', 'They are coated with radioactive material', 0, 0, 0, 0, '', '1.82', 15, 'no', 'no', 'yes', 'yes'),
('Metro Arm Wraps', 142, 0, 0, 0, 0, 0, 0, 0, 0, 32, 0, 'item_arms', 'item_armbands5.gif', 'Strangly, they make you look very manly', 0, 0, 0, 0, '', '2.43', 20, 'no', 'no', 'yes', 'yes'),
('Small Sculpture', 143, 54, 64, 0, 0, 8, 0, 0, 0, 0, 0, 'item_weapon1', 'item_arrtwork.gif', 'It pleases the senses and bashes skulls', 0, 0, 0, 0, '', '4.26', 20, 'no', 'no', 'yes', 'yes'),
('Ring of Syllogism', 144, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0, 'item_sechand', 'item_ring4.gif', 'Smart ring', 0, 0, 0, 0, '', '.89', 5, 'no', 'no', 'yes', 'yes'),
('Cutoff Jean Shorts', 145, 0, 0, 0, 0, 0, 0, 0, 0, 21, 0, 'item_legs', 'item_jeans2.gif', 'Just like Daisy wore', 0, 0, 0, 0, '', '.63', 7, 'no', 'no', 'yes', 'yes'),
('Monkey Wrench', 146, 42, 50, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_monkeywrench.gif', 'Primitive as a weapon, but can also be used to fix things', 0, 0, 0, 0, '', '2.85', 16, 'no', 'no', 'yes', 'yes'),
('Fork', 147, 46, 54, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_fork.gif', 'A fork', 0, 0, 0, 0, '', '3.37', 17, 'no', 'no', 'yes', 'yes'),
('Crabs', 148, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_crab.gif', 'You may need some ointment for these', 0, 0, 0, 0, '', '.02', 0, 'no', 'no', 'yes', 'yes'),
('Jewel Encrusted White Glove', 149, 0, 0, 0, 0, 0, 2, 0, 0, 3, 0, 'item_hands', 'item_whitehand.gif', 'The right hand glove of a recently deceased drug addict', 0, 0, 0, 0, '', '.10', 2, 'no', 'no', 'yes', 'yes'),
('Base Trinket Panel', 150, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_trinket_panel.gif', 'Base Trinket Panel Assembly Kit model TR-32', 56, 1, 1, 1, 'yes', '27', 0, 'no', 'no', 'no', 'yes'),
('Holy Reference Material', 176, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_printout4.gif', 'Some holy scriptures', 0, 0, 0, 0, '', '.66', 0, '', '', '', ''),
('Scroll of Whine', 152, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_printout5.gif', 'Scroll of Whine', 43, 1, 0, 1, '', '2.32', 0, 'no', 'no', 'yes', 'yes'),
('Scroll of Ouch', 153, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_printout4.gif', 'Scroll of Ouch... Wow that stings', 61, 1, 0, 1, '', '4.76', 10, 'no', 'no', 'yes', 'yes'),
('Scroll of Bite', 154, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_printout3.gif', 'Scroll of Bite...', 62, 1, 0, 1, '', '1.54', 2, 'no', 'no', 'yes', 'yes'),
('Base Auction Robot', 155, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_robohead.gif', 'Base Auction Robot', 55, 1, 0, 1, 'yes', '32', 0, 'no', 'no', 'no', 'yes'),
('Scalpel of Non-Fatness', 156, 4, 8, 0, 0, 0, 2, 0, 0, 0, 0, 'item_weapon1', 'item_scalpel.gif', 'This thing is sharp', 0, 0, 0, 0, '', '.24', 2, 'no', 'no', 'yes', 'yes'),
('Hypodermic Needle', 157, 8, 12, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_hypo.gif', 'It has some deadly liquid in it', 0, 0, 0, 0, '', '.33', 3, 'no', 'no', 'yes', 'yes'),
('Cushing Vein Retractor', 158, 2, 6, 0, 0, 1, 0, 0, 0, 0, 0, 'item_weapon1', 'item_retractor.gif', 'Cuts off circulation', 0, 0, 0, 0, '', '.15', 1, 'no', 'no', 'yes', 'yes'),
('Hook', 159, 11, 19, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_hook.gif', 'It is shaped like a hook', 0, 0, 0, 0, '', '.56', 5, 'no', 'no', 'yes', 'yes'),
('Ankh of Callousness', 160, 15, 21, 0, 0, 0, 0, 0, 0, 6, 0, 'item_weapon1', 'item_ankh.gif', '', 0, 0, 0, 0, '', '.83', 6, 'no', 'no', 'yes', 'yes'),
('Pretty Big Rock', 161, 19, 27, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_rock.gif', 'This thing is pretty big. ', 0, 0, 0, 0, '', '1.27', 7, 'no', 'no', 'yes', 'yes'),
('Holy Implement of Destruction', 162, 24, 31, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_trinket_1.gif', 'Good against vampires', 0, 0, 0, 0, '', '1.44', 8, 'no', 'no', 'yes', 'yes'),
('Postage Stamp', 163, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_stamp.gif', 'Postage Stamp', 0, 0, 0, 0, '', '.15', 0, 'no', 'no', 'yes', 'yes'),
('Scroll of Firestorm', 164, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_printout5.gif', 'Scroll of Firestorm', 63, 1, 0, 1, '', '2.32', 5, 'no', 'no', 'yes', 'yes'),
('Base Sidekick Stable', 165, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_stable.gif', 'Base Sidekick Stable. This will allow you to have more than one sidekick.', 31, 1, 1, 1, 'yes', '45', 0, 'no', 'no', 'no', 'yes'),
('Ice Cube', 166, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_ice.gif', 'Cold', 0, 0, 0, 0, '', '.15', 0, '', '', 'yes', ''),
('Steel Claws', 167, 44, 52, 0, 0, 0, 0, 0, 0, 0, 0, 'item_weapon1', 'item_claws.gif', 'Made from tempered steel', 0, 0, 0, 0, '', '3.24', 16, '', '', 'yes', ''),
('Mug of Hurtin', 168, 48, 58, 0, 0, 12, 0, 0, 0, 0, 0, 'item_weapon1', 'item_coffee_cup.gif', 'Time to bring the smack down', 0, 0, 0, 0, '', '3.56', 18, '', '', 'yes', ''),
('Floppy Disc of Callousness', 169, 52, 60, 0, 0, 0, 0, 0, 0, 15, 0, 'item_weapon1', 'item_disk.gif', 'This floppy stores more than just data', 0, 0, 0, 0, '', '3.76', 19, '', '', 'yes', ''),
('Pure Silver Ring', 170, 0, 0, 0, 0, 0, 0, 0, 0, 12, 0, 'item_sechand', 'item_ring5.gif', 'Might be good against undead stuff', 0, 0, 0, 0, '', '3.45', 10, '', '', 'yes', ''),
('Jewel Encrusted Ring', 171, 0, 0, 0, 0, 12, 6, 0, 0, 18, 0, 'item_sechand', 'item_ring6.gif', 'Shiny', 0, 0, 0, 0, '', '4.89', 15, '', '', 'yes', ''),
('Motorcycle Helmet', 172, 0, 0, 0, 0, 0, 0, 0, 0, 16, 0, 'item_head', 'item_helmet.gif', 'Keeps bugs out', 0, 0, 0, 0, '', '3.34', 12, '', '', 'yes', ''),
('Ring of Your Mom', 173, 0, 0, 0, 0, 24, 0, 0, 0, 0, 0, 'item_sechand', 'item_ring3.gif', 'This used to belong to your mom', 0, 0, 0, 0, '', '5.67', 19, '', '', 'yes', ''),
('Bird Eye Juice', 179, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_bottle_2.gif', 'Bird Eye Juice', 38, 1, 1, 1, '', '.95', 10, '', '', '', ''),
('Eye Juice', 175, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_vodka.gif', 'Looks great, less filling', 27, 1, 0, 1, '', '.35', 5, '', '', '', ''),
('Hanah Nebraska Wig', 174, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 'item_head', 'item_pasta.gif', '', 0, 0, 0, 0, '', '.34', 3, '', '', '', ''),
('Rock of Ages', 177, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_rock.gif', 'Still rollin', 0, 0, 0, 0, '', '.05', 0, '', '', '', ''),
('Base PvP Henchmen Generator', 178, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_henchmen_generator.gif', 'Generates henchmen for PvP battle', 73, 1, 1, 1, '', '5', 0, '', '', '', 'no'),
('Seth''s XP Generator', 180, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_cell.gif', 'Gives you some free XP', 76, 15, 15, 1, '', '', 0, '', '', '', 'no'),
('Base Henchmen Leader Generator', 181, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_boots_2.gif', 'Base Henchmen Leader Generator', 74, 1, 1, 1, '', '8', 0, '', '', '', ''),
('Recipe: Eye Juice', 182, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_printout.gif', 'It is a recipe for Eye Juice', 79, 1, 1, 1, '', '2.34', 0, '', '', '', ''),
('Base Quest Log', 183, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_log.gif', 'Yep its a pretty lame play on words and it also shows you the quests you are on.', 52, 1, 1, 1, '', '1', 0, '', '', 'no', 'no'),
('Trunk O'' Pain', 184, 56, 62, 0, 0, 16, 0, 0, 0, 0, 0, 'item_weapon1', 'item_log.gif', 'Ow man... That has got to hurt', 0, 0, 0, 0, '', '4.89', 21, '', '', '', ''),
('Black Leather Gloves', 185, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 'item_hands', 'item_boots_8.gif', 'Dark just like the night... ', 0, 0, 0, 0, '', '.15', 3, '', '', '', ''),
('Rat Guts', 186, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'item_ratguts.gif', 'Rat guts... Disgusting', 0, 0, 0, 0, '', '', 0, 'yes', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_loot_table`
--

CREATE TABLE IF NOT EXISTS `rpg_loot_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `rpg_loot_table`
--

INSERT INTO `rpg_loot_table` (`id`, `data`) VALUES
(1, '7;1;1;10|8;1;5;60|9;1;2;30|11;1;1;10'),
(2, '7;1;1;20|10;1;1;80|11;1;1;20|30;1;1;10|60;1;1;5'),
(3, '4;1;1;1|16;1;1;10'),
(4, '7;1;1;20|11;1;1;20|13;1;1;25|14;1;1;25|15;1;1;25'),
(5, '7;1;1;50|12;1;1;1|16;1;1;1|17;1;1;1|18;1;1;1|19;1;1;1|21;1;1;1|23;1;1;50|24;1;1;50|25;1;1;50|37;1;1;50|52;1;1;50|54;1;1;50|60;1;1;50|64;1;1;50'),
(6, '27;1;1;50|38;1;1;100'),
(7, '7;1;1;20|11;1;1;20|13;1;1;50|14;1;1;50|15;1;1;50|24;1;1;50|28;1;1;.01|33;1;1;50|36;1;1;5'),
(8, '38;1;1;100'),
(9, '39;1;1;100'),
(10, '186;6;6;50'),
(11, '41;1;1;50|42;1;1;50|43;1;1;50|132;1;2;20'),
(12, '11;1;1;50'),
(13, '35;8489;98488;100'),
(14, '40;1;1;4|44;1;1;30|45;1;1;40|46;1;1;60|48;1;1;25'),
(26, '10;1;1;100'),
(15, '49;1;1;100'),
(16, '32;1;1;50|33;1;1;50|45;1;1;12|50;1;1;20|52;1;1;20'),
(17, '35;1;1;50|53;1;1;50|54;1;1;50|60;1;1;50|68;1;1;50|61;1;1;50|62;1;1;50|64;1;1;50|65;1;1;50|66;1;1;50|84;1;1;50|85;1;1;50|86;1;1;50|130;1;1;50|150;1;1;50|155;1;1;50'),
(18, '61;5733;73832;100'),
(19, '9;1;1;50|10;1;1;50'),
(20, '175;1;1;50'),
(21, '109;1;2;80|110;1;1;50|111;1;2;80'),
(27, '10;1;1;50|44;1;3;100|45;1;1;50|60;1;1;10|68;1;1;10|65;1;1;10|132;1;2;50'),
(22, '126;1;1;5'),
(23, '3;1;1;50|20;1;1;50|29;1;1;50|83;1;1;50|85;1;1;50|89;1;1;50|91;1;1;50|96;1;1;50|106;1;1;50|118;1;1;50|120;1;1;50|123;1;1;50|129;1;1;50'),
(24, '9;1;1;50|14;1;1;50|15;1;1;50|29;1;1;50|54;1;1;5|131;1;1;5'),
(25, '11;1;3;100|52;1;1;20|96;1;1;5'),
(28, '10;1;1;50|109;1;1;50'),
(29, '148;1;1;50|178;1;1;50|181;1;1;50'),
(30, '179;1;1;50'),
(31, '46;1;1;50'),
(32, '186;1;1;50'),
(33, '182;1;1;100'),
(34, '9;4;1;50');

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
  `encounter_list` text NOT NULL,
  `required_level` text NOT NULL,
  `required_items` text NOT NULL,
  `data` text NOT NULL,
  `ap` text NOT NULL,
  `hidden` text NOT NULL,
  `see_criteria` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=287 ;

--
-- Dumping data for table `rpg_map`
--

INSERT INTO `rpg_map` (`id`, `location`, `name`, `description`, `image`, `exits`, `moblist`, `encounter_list`, `required_level`, `required_items`, `data`, `ap`, `hidden`, `see_criteria`) VALUES
(33, '-3,-2,1', 'Clinic', 'Clinic\r\nLevel 1-3', 'map_building1.gif', '', '1;5|2;5|29;20|30;100|31;40|32;40', '', '1', '', '', '1', 'no', ''),
(4, '1,0,0', 'Milard\\''s Pawn Shop', 'Pawn Shop', 'map_pawn.gif', 'w0,n0,vendor', '', '', '', '', '1', '', '', ''),
(5, '0,-1,0', 'The Woods', 'A wild area. Level 1-3', 'map_ratlevel.gif', 'w0,s0,e0', '1;60|2;10|4;55|22;10|16;15', '6;1|7;5|10;8|11;20', '', '', '', '1', '', ''),
(6, '2,-1,2', 'The Strip Mall', 'A strip mall overrun with teenagers. Level 3-6', 'map_strip_mall.gif', 's0,w0', '5;50|6;35|9;55', '', '3', '', '', '1', '', ''),
(7, '1,1,0', 'The Creek', 'A small creek in the woods... Level 5-8', 'map_creek.gif', 'n0,w0', '1;40|2;35|3;35|11;35|14;35', '', '5', '', '', '1', '', ''),
(8, '-1,2,0', 'Test Area', 'This is the testing area', 'map_test1.gif', '', '24;40|18;98|25;90', '', '4', '', '', '1', '', ''),
(32, '10,6,-1', 'Testing Area', 'Defective Minds Test Area (Restricted Access)', 'world-what2.gif', '', '', '', '', '', '0,0,0', '123', 'yes', 'access=255'),
(28, '4,3,-1', 'Small Town', 'A quaint little small town', 'world-smalltown.gif', '', '', '', '', '', '0,0,1', '', '', ''),
(22, '-1,1,0', 'Robot Disco-tech', 'A place where all the coolest robots come to show off thier moves. Level 4-10', 'map_what.gif', 'w0', '12;50|13;50|15;20|23;40', '12;10|13;10', '4', '', '', '1', '', ''),
(23, '-1,-1,0', 'Fieldview Circle', 'Another suburb. A slightly more paranoid suburb... Level 4-6', 'map_noob.gif', 'e0,s0', '18;25|19;25|20;25|', '', '4', '', '', '1', '', ''),
(27, '4,2,0', 'Defective Minds HQ', 'Only developers should come here. Really. If you think you got what it takes go ahead. Do you feel lucky? Well do you?', 'map_defectiveminds.gif', 'vendor', '', '', '', '', '3', '', '', ''),
(31, '4,0,0', 'The Goth Store', 'The store is dark but open', 'map_pawn.gif', 'vendor', '', '', '', '', '4', '', '', ''),
(34, '-1,-2,1', 'Church', 'Church \r\nLevel 3-6', 'map_church.gif', '', '33;10|34;20|35;100', '14;20', '3', '', '', '1', 'no', ''),
(35, '7,1,-1', 'Suburbs', 'Some houses and stuff', 'world-what3.gif', '', '', '', '', '', '0,0,2', '', '', ''),
(36, '-3,1,2', 'Neighborhood', 'Neighborhood\r\nLevel 1-3', 'map_noob.gif', 'mapportal', '', '', '', '', '0,0,48', '1', '', ''),
(38, '0,1,2', '', '', 'map_road_vert.gif', '', '', '', '', '', '', '', '', ''),
(46, '1,-1,2', '', '', 'map_road_2.gif', '', '', '', '', '', '', '', '', ''),
(39, '2,1,2', 'Super-Mart', 'Super-Mart\r\nLevel 9-12', 'map_supermart.gif', '', '', '', '', '', '', '1', '', ''),
(40, '0,2,2', '', '', 'map_road_2.gif', '', '', '', '', '', '', '', '', ''),
(41, '-1,2,2', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(42, '0,0,2', '', '', 'map_road_5.gif', '', '', '', '', '', '', '', '', ''),
(43, '1,0,2', '', '', 'map_road_6.gif', '', '', '', '', '', '', '', '', ''),
(44, '1,1,2', '', '', 'map_road_8.gif', '', '', '', '', '', '', '', '', ''),
(45, '2,0,2', '', '', 'map_road_3.gif', '', '', '', '', '', '', '', '', ''),
(47, '1,-2,2', '', '', 'map_road_vert.gif', '', '', '', '', '', '', '', '', ''),
(48, '1,-3,2', '', '', 'map_road_vert.gif', '', '', '', '', '', '', '', '', ''),
(49, '-2,2,2', '', '', 'map_road_5.gif', '', '', '', '', '', '', '', '', ''),
(50, '-2,3,2', '', '', 'map_road_vert.gif', '', '', '', '', '', '', '', '', ''),
(51, '-3,2,2', '', '', 'map_road_3.gif', '', '', '', '', '', '', '', '', ''),
(52, '-4,2,2', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(53, '-5,2,2', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(54, '-1,1,2', '', '', 'map_plains.gif', '', '', '', '', '', '', '', '', ''),
(55, '4,2,2', 'Retirement Home', 'Retirement Home<br>\r\nLevel 12-15', 'map_proggraphics2.gif', '', '', '', '', '', '', '1', '', ''),
(56, '4,1,2', '', '', 'map_plains.gif', '', '', '', '', '', '', '', '', ''),
(57, '-1,-1,1', '', '', 'map_road_3.gif', '', '', '', '', '', '', '', '', ''),
(58, '-2,-1,1', '', '', 'map_road_5.gif', '', '', '', '', '', '', '', '', ''),
(59, '-3,-1,1', '', '', 'map_road_3.gif', '', '', '', '', '', '', '', '', ''),
(60, '-1,0,2', 'Unfinished Neighborhood', 'Unfinished Neighborhood\r\nLevel 6-9', 'map_proggraphics1.gif', '', '', '', '', '', '', '1', '', ''),
(61, '0,3,2', 'Wackers', 'Wackers resturaunt<br>\r\nLevel 11-14', 'map_wackers.gif', '', '', '', '', '', '', '1', '', ''),
(62, '3,2,2', '', '', 'map_road_8.gif', '', '', '', '', '', '', '', '', ''),
(63, '3,1,2', '', '', 'map_road_vert.gif', '', '', '', '', '', '', '', '', ''),
(64, '3,0,2', '', '', 'map_road_5.gif', '', '', '', '', '', '', '', '', ''),
(65, '0,-2,2', 'Milard''s Pawn Shop', 'Milard''s Pawn Shop', 'map_pawn.gif', 'vendor', '', '', '', '', '1', '', '', ''),
(66, '0,-1,2', '', '', 'map_road_3.gif', '', '', '', '', '', '', '', '', ''),
(67, '4,-1,2', 'Bar', 'Bar', 'map_bar.gif', 'enter', '', '', '', '', '', '', '', ''),
(68, '4,0,2', '', '', 'map_road_3.gif', '', '', '', '', '', '', '', '', ''),
(69, '5,0,2', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(70, '-3,-2,2', 'Public School', 'Public School', 'map_school1.gif', '', '', '', '', '', '', '', '', ''),
(71, '-3,-1,2', '', '', 'map_road_3.gif', '', '', '', '', '', '', '', '', ''),
(72, '-4,-2,2', '', '', 'map_road_9.gif', '', '', '', '', '', '', '', '', ''),
(73, '-4,-1,2', '', '', 'map_road_8.gif', '', '', '', '', '', '', '', '', ''),
(74, '-2,-1,2', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(75, '-1,-1,2', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(76, '1,0,1', 'Widas', 'Widas Auto Repair<br>\r\nLevel 6-9', 'map_proggraphics3.gif', '', '36;100|21;50', '', '6', '', '', '1', '', ''),
(77, '1,-1,1', '', '', 'map_road_6.gif', '', '', '', '', '', '', '', '', ''),
(78, '0,0,1', '', '', 'map_road_4.gif', '', '', '', '', '', '', '', '', ''),
(79, '0,-1,1', '', '', 'map_road_5.gif', '', '', '', '', '', '', '', '', ''),
(80, '-1,0,1', 'Court House', 'Court House <br>\r\nLevel 9-12', 'map_courthouse.gif', '', '37;100', '', '9', '', '', '1', '', ''),
(81, '-3,1,1', 'Gated Community', 'Gated Community<br>\r\nLevel 12-15', 'map_gated.gif', '', '38;100', '', '12', '', '', '1', '', ''),
(82, '-4,-1,1', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(83, '-5,-1,1', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(84, '1,-2,1', '', '', 'map_road_vert.gif', '', '', '', '', '', '', '', '', ''),
(85, '1,-3,1', '', '', 'map_road_vert.gif', '', '', '', '', '', '', '', '', ''),
(86, '2,-1,1', '', '', 'map_road_3.gif', '', '', '', '', '', '', '', '', ''),
(87, '3,-1,1', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(88, '4,-1,1', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(89, '5,-1,1', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(90, '0,1,1', '', '', 'map_road_2.gif', '', '', '', '', '', '', '', '', ''),
(91, '0,2,1', '', '', 'map_road_vert.gif', '', '', '', '', '', '', '', '', ''),
(92, '0,3,1', '', '', 'map_road_6.gif', '', '', '', '', '', '', '', '', ''),
(93, '3,2,1', 'School', 'School', 'map_school1.gif', '', '', '', '', '', '', '', '', ''),
(94, '3,-2,1', 'Speedy Mart', 'Speedy Mart', 'map_speedy.gif', 'vendor', '', '', '', '', '2', '', '', ''),
(95, '2,-2,1', '', '', 'map_road_9.gif', '', '', '', '', '', '', '', '', ''),
(96, '-1,2,1', 'House of Squishology', 'There''s a lot of squishing going on in here', 'map_what.gif', 'enter', '', '', '', '', '1,2', '', '', ''),
(97, '-1,3,1', '', '', 'map_road_8.gif', '', '', '', '', '', '', '', '', ''),
(98, '7,4,-1', 'Woods', 'There is a lot of trees here', 'world-woods.gif', '', '', '', '', '', '0,0,3', '', 'yes', 'level=15'),
(99, '-2,-1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(100, '-3,-1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(101, '-3,0,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(102, '-2,0,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(103, '-3,-2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(104, '-5,-3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(105, '-4,-3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(106, '-3,-3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(107, '-4,-2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(108, '-5,-2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(109, '-4,-1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(110, '-4,0,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(111, '-5,-1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(112, '-5,0,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(113, '-5,1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(114, '-4,1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(115, '-5,2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(116, '-5,3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(117, '0,-1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(118, '1,-2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(119, '2,-3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(120, '2,-2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(121, '1,-1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(122, '2,-1,3', 'Swampy Creek', 'Swampy Creek<br>\r\nLevel 20-21', 'map_creek.gif', '', '', '', '', '', '', '1', '', ''),
(123, '2,0,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(124, '3,0,3', 'Green Field', 'Green Field<br>\r\nLevel 19-20', 'map_plains.gif', '', '', '', '', '', '', '1', '', ''),
(125, '4,0,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(126, '5,0,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(127, '4,1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(128, '5,1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(129, '3,1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(130, '2,1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(131, '1,0,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(132, '3,-1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(133, '3,-2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(134, '3,-3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(135, '4,2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(136, '5,2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(137, '5,3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(138, '4,3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(139, '4,-1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(140, '4,-2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(141, '5,-3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(142, '5,-2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(143, '5,-1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(144, '4,-3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(145, '-4,2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(146, '-4,3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(147, '-3,3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(148, '-3,1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(149, '-3,2,3', 'Dense Forest', 'Dense Forest<br>\r\nLevel 18-19', 'map_woods25.gif', '', '', '', '', '', '', '1', '', ''),
(150, '-2,1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(151, '-2,-2,3', 'Summer Camp', 'Summer Camp<br>\r\nLevel 15-16', 'map_summercamp.gif', '', '', '', '', '', '', '1', '', ''),
(152, '-2,-3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(153, '-1,-3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(154, '0,2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(155, '0,3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(156, '-1,3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(157, '1,3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(158, '2,3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(159, '0,0,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(160, '-1,0,3', 'Deep Lake', 'Deep Lake<br>\r\nLevel 17-18', 'map_lake.gif', '', '', '', '', '', '', '1', '', ''),
(161, '-1,1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(162, '0,1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(163, '1,1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(164, '1,2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(165, '2,2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(166, '-1,2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(167, '-1,-1,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(168, '-1,-2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(169, '0,-2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(170, '1,-3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(171, '0,-3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(172, '-2,3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(173, '-2,2,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(174, '3,2,3', 'Camper Site', 'Camper Site<br>\r\nLevel 16-17', 'map_summercamp.gif', '', '', '', '', '', '', '1', '', ''),
(175, '3,3,3', '', '', 'map_woods23.gif', '', '', '', '', '', '', '', '', ''),
(176, '1,3,1', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(177, '2,3,1', '', '', 'map_road_3.gif', '', '', '', '', '', '', '', '', ''),
(178, '3,3,1', '', '', 'map_road_7.gif', '', '', '', '', '', '', '', '', ''),
(179, '2,2,1', '', '', 'map_road_9.gif', '', '', '', '', '', '', '', '', ''),
(180, '-1,1,1', '', '', 'map_road_3.gif', '', '', '', '', '', '', '', '', ''),
(181, '-2,1,1', '', '', 'map_road_4.gif', '', '', '', '', '', '', '', '', ''),
(182, '-2,0,1', '', '', 'map_road_vert.gif', '', '', '', '', '', '', '', '', ''),
(183, '-2,2,1', '', '', 'map_road_7.gif', '', '', '', '', '', '', '', '', ''),
(184, '-3,2,1', '', '', 'map_road_8.gif', '', '', '', '', '', '', '', '', ''),
(185, '9,2,-1', 'Countryside', 'I bet there is a lot of country stuff out here', 'world-country.gif', '', '', '', '', '', '', '', 'yes', 'level=25'),
(186, '1,5,-1', 'Uptown', 'Part of a bigger city', 'world-city1.gif', '', '', '', '', '', '', '', 'yes', 'what'),
(187, '0,6,-1', 'Downtown', 'Part of a bigger city only the downtown part of that bigger city', 'world-city1.gif', '', '', '', '', '', '', '', 'yes', 'what'),
(188, '0,4,-1', 'Industrial District', 'I guess they make stuff around here... Probably a couple of evil warehouses or something too', 'world-city1.gif', '', '', '', '', '', '', '', 'yes', 'what'),
(189, '0,0,-1', 'Mountains', 'Some mountains with snow on top', 'world-mountain.gif', '', '', '', '', '', '', '', 'yes', 'level=10'),
(190, '0,1,-1', '', '', 'world-blank.gif', '', '', '', '', '', '', '', '', ''),
(191, '0,5,-1', '', '', 'world-blank.gif', '', '', '', '', '', '', '', '', ''),
(192, '1,6,-1', '', '', 'world-blank.gif', '', '', '', '', '', '', '', '', ''),
(193, '4,5,-1', 'PvP Arena', 'You can see a big stadium on the horizon', 'world-stadium.gif', '', '', '', '', '', '0,0,8', '', 'no', ''),
(194, '0,0,8', 'PvP Vendor', 'A big building with lots of balloons and streamers', 'map_store3.gif', 'vendor', '', '', '', '', '5', '', '', ''),
(195, '2,1,8', 'PvP Arena', 'Some kind of PvP arena', 'map_stadium2.gif', '', '', '', '', '', '', '', '', ''),
(196, '-3,1,0', 'Place of Tuplin', 'Something here?', 'map_store3.gif', 'mapportal', '', '', '', '', '0,0,45', '', '', ''),
(197, '3,-1,45', 'Back to World Map', 'What?', 'map_lake.gif', 'mapportal', '', '', '', '', '0,0,-1', '', '', ''),
(198, '-3,-1,45', 'Hey what the hell?', 'This is a test area', 'map_church.gif', 'enter', '', '', '', '', '1\r\n', '', '', ''),
(199, '-1,1,45', 'Hole in the ground', 'There is a hole in the ground here', 'world-hole.gif', 'mapportal', '', '', '', '', '0,0,46', '', '', ''),
(200, '-5,-3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(201, '-4,-3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(202, '-4,-2,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(203, '-3,-1,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(204, '-2,0,46', '', '', 'map_black_left.gif', '', '', '', '', '', '', '', '', ''),
(205, '-1,1,46', 'Underground Cave', 'There is a cave down here', 'map_black_17.gif', 'enter', '', '', '', '', '3', '', '', ''),
(206, '0,1,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(207, '1,2,46', '', '', 'map_black_13.gif', '', '', '', '', '', '', '', '', ''),
(208, '2,3,46', '', '', 'map_black_topright.gif', '', '', '', '', '', '', '', '', ''),
(209, '1,0,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(210, '2,-1,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(211, '3,-2,46', '', '', 'map_black_right.gif', '', '', '', '', '', '', '', '', ''),
(212, '4,-3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(213, '5,-3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(214, '5,-2,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(215, '4,-1,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(216, '5,0,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(217, '4,1,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(218, '5,2,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(219, '4,3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(220, '5,3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(221, '-5,3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(222, '-4,3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(223, '-4,2,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(224, '-2,-1,46', '', '', 'map_black_left.gif', '', '', '', '', '', '', '', '', ''),
(225, '-2,-2,46', '', '', 'map_black_left.gif', '', '', '', '', '', '', '', '', ''),
(226, '-3,-2,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(227, '-3,0,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(228, '-4,0,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(229, '-5,-1,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(230, '-4,-1,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(262, '0,-1,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(231, '-5,-2,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(232, '-3,-3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(233, '-5,0,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(234, '-5,1,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(235, '-5,2,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(236, '-4,1,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(237, '-3,3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(238, '-3,1,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(239, '-1,-3,46', '', '', 'map_black_top.gif', '', '', '', '', '', '', '', '', ''),
(240, '-1,2,46', '', '', 'map_black_bottom.gif', '', '', '', '', '', '', '', '', ''),
(241, '-2,1,46', '', '', 'map_black_left.gif', '', '', '', '', '', '', '', '', ''),
(242, '-3,2,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(243, '-2,3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(244, '-2,-3,46', '', '', 'map_black_topleft.gif', '', '', '', '', '', '', '', '', ''),
(245, '-1,3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(246, '5,-1,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(247, '5,1,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(248, '3,3,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(249, '1,3,46', '', '', 'map_black_12.gif', '', '', '', '', '', '', '', '', ''),
(250, '0,3,46', '', '', 'map_black_left.gif', '', '', '', '', '', '', '', '', ''),
(251, '-2,2,46', '', '', 'map_black_botleft.gif', '', '', '', '', '', '', '', '', ''),
(252, '3,-3,46', '', '', 'map_black_topright.gif', '', '', '', '', '', '', '', '', ''),
(253, '3,2,46', '', '', 'map_black_botright.gif', '', '', '', '', '', '', '', '', ''),
(254, '3,1,46', '', '', 'map_black_right.gif', '', '', '', '', '', '', '', '', ''),
(255, '3,0,46', '', '', 'map_black_right.gif', '', '', '', '', '', '', '', '', ''),
(256, '3,-1,46', '', '', 'map_black_right.gif', '', '', '', '', '', '', '', '', ''),
(257, '2,2,46', '', '', 'map_black_bottom.gif', '', '', '', '', '', '', '', '', ''),
(258, '0,2,46', '', '', 'map_black_14.gif', '', '', '', '', '', '', '', '', ''),
(259, '1,1,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(260, '2,1,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(261, '2,0,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(263, '-1,-2,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(264, '-1,-1,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(265, '-1,0,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(266, '0,0,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(267, '1,-1,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(268, '0,-3,46', '', '', 'map_black_top.gif', '', '', '', '', '', '', '', '', ''),
(269, '1,-3,46', '', '', 'map_black_top.gif', '', '', '', '', '', '', '', '', ''),
(270, '2,-3,46', '', '', 'map_black_top.gif', '', '', '', '', '', '', '', '', ''),
(271, '0,-2,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(272, '1,-2,46', 'Rat Hole', 'A hole full of rats', 'map_black_17.gif', '', '2;100', '', '', '', '', '', '', ''),
(273, '2,-2,46', '', '', 'map_black_16.gif', '', '', '', '', '', '', '', '', ''),
(274, '4,-2,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(275, '4,0,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(276, '4,2,46', '', '', 'map_black.gif', '', '', '', '', '', '', '', '', ''),
(277, '-5,1,2', 'Techniker''s', 'Learn the techniker craft', 'map_store3.gif', 'enter', '', '', '', '', '4', '', '', ''),
(278, '-1,0,48', 'A Neighborhood', 'A lot of houses ', 'map_noob.gif', 'enter', '', '', '', '', '5', '', '', ''),
(279, '-1,1,48', '', '', 'map_road_3.gif', '', '', '', '', '', '', '', '', ''),
(280, '-2,1,48', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(281, '-3,1,48', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(282, '-4,1,48', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(283, '-5,1,48', '', '', 'map_road_horz.gif', '', '', '', '', '', '', '', '', ''),
(284, '0,1,48', '', '', 'map_road_10.gif', '', '', '', '', '', '', '', '', ''),
(285, '0,2,48', '', '', 'map_road_vert.gif', '', '', '', '', '', '', '', '', ''),
(286, '0,3,48', '', '', 'map_road_vert.gif', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_monsters`
--

CREATE TABLE IF NOT EXISTS `rpg_monsters` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `rpg_monsters`
--

INSERT INTO `rpg_monsters` (`id`, `name`, `image`, `loot_table`, `level_low`, `level_high`, `str`, `int`, `agl`, `def`, `hp`, `hp_max`, `pow`, `pow_max`, `dmg_low`, `dmg_high`, `alignment`, `special_atttack`, `special_attack_percent`, `group`) VALUES
(1, 'Small Rat', 'monster_rat.gif', 1, 1, 2, 8, 1, 5, 5, 5, 7, 0, 0, 1, 3, 'nuetral', 0, 0, 4),
(2, 'Medium Rat', 'monster_rat_medium.gif', 32, 2, 4, 10, 4, 8, 8, 13, 18, 0, 0, 2, 5, 'nuetral', 0, 0, 0),
(3, 'Large Rat', 'monster_rat_medium.gif', 1, 3, 5, 12, 5, 10, 10, 14, 20, 0, 0, 3, 8, 'nuetral', 0, 0, 0),
(4, 'Whino', 'monster_whino.gif', 2, 2, 4, 14, 1, 4, 5, 14, 19, 8, 10, 2, 5, 'nuetral', 1, 15, 0),
(5, 'Goth Kid', 'monster_goth_kid.gif', 4, 4, 6, 10, 12, 4, 8, 15, 20, 15, 20, 4, 7, 'nuetral', 0, 0, 2),
(6, 'Bully', 'monster_bully.gif', 7, 4, 6, 14, 8, 12, 10, 16, 22, 2, 9, 4, 8, 'nuetral', 0, 0, 2),
(7, 'Enraged Terrier', 'monster_enragedterrier.gif', 6, 4, 6, 8, 2, 4, 6, 12, 15, 0, 0, 2, 5, 'nuetral', 0, 0, 1),
(8, 'Aggresive Poodle', 'monster_aggressivepoodle.gif', 6, 4, 6, 8, 2, 5, 4, 10, 14, 0, 0, 2, 6, 'nuetral', 0, 0, 1),
(9, 'Fat Kid', 'monster_fat_kid.gif', 3, 5, 9, 9, 12, 5, 7, 5, 11, 11, 15, 5, 8, 'Nuetral', 0, 0, 2),
(10, 'Gorgon', 'monster_gorgon.gif', 6, 100, 100, 23, 87, 60, 89, 450, 520, 470, 520, 190, 290, 'evil', 0, 0, 1),
(11, 'Small Gator', 'monster_gator1.gif', 1, 2, 3, 9, 1, 5, 12, 9, 15, 10, 15, 4, 10, 'nuetral', 0, 0, 2),
(12, 'Dancing Robot', 'monster_robot-dancer.gif', 11, 5, 7, 1, 1, 1, 1, 15, 28, 1, 1, 1, 1, 'nuetral', 0, 0, 2),
(13, 'Grooving Robot', 'monster_robot.gif', 11, 7, 9, 1, 1, 1, 1, 15, 18, 1, 1, 20, 27, 'nuetral', 0, 0, 1),
(14, 'Strange Monster', 'monster_monster1.gif', 14, 4, 6, 16, 9, 10, 13, 8, 15, 9, 18, 11, 14, 'nuetral', 0, 0, 3),
(15, 'Twin Freaks', 'monster_peeps.gif', 7, 5, 8, 13, 13, 17, 18, 11, 17, 12, 18, 8, 15, 'evil', 0, 0, 2),
(16, 'Shit Fairy', 'monster_shitfairy.gif', 24, 1, 4, 1, 1, 1, 1, 10, 19, 1, 1, 3, 8, 'nuetral', 0, 0, 1),
(17, 'Stitch', 'monster_stitch.gif', 4, 100, 100, 105, 172, 192, 159, 666, 666, 1, 1, 221, 301, 'evil', 0, 0, 1),
(18, 'Internet Troll', 'monster_internet_troll.gif', 16, 4, 6, 3, 8, 3, 15, 25, 37, 5, 10, 10, 17, 'evil', 0, 0, 1),
(19, 'Executive', 'monster_exec.gif', 16, 4, 8, 4, 10, 8, 12, 28, 38, 1, 10, 10, 19, 'nuetral', 0, 0, 1),
(20, 'Fan Boy', 'monster_fan_boy.gif', 4, 4, 8, 3, 16, 6, 18, 25, 32, 10, 16, 12, 26, 'good', 0, 0, 1),
(21, 'Drunk Redneck', 'monster_redneck.gif', 2, 6, 10, 10, 2, 10, 14, 30, 40, 10, 10, 20, 37, 'nuetral', 0, 0, 1),
(22, 'Mutant Chick', 'monster_chick.gif', 1, 1, 4, 1, 1, 1, 1, 9, 18, 1, 1, 6, 12, 'nuetral', 0, 0, 2),
(23, 'Mix Master 5K', 'monster_robotthing.gif', 11, 7, 10, 1, 1, 1, 1, 13, 27, 1, 1, 25, 34, 'nuetral', 0, 0, 1),
(24, 'Crow', 'monster_crow.gif', 21, 3, 7, 3, 8, 11, 5, 12, 20, 5, 11, 5, 13, 'nuetral', 0, 0, 3),
(25, 'Sumo Wrestler', 'monster_sumo.gif', 22, 10, 15, 1, 1, 1, 1, 110, 160, 1, 1, 26, 45, 'good', 0, 0, 1),
(26, 'Shit Fairy Leader', 'monster_shitfairy.gif', 24, 5, 8, 1, 1, 1, 1, 13, 20, 1, 1, 8, 12, 'nuetral', 0, 0, 1),
(27, 'Homemaker', 'monster_homemaker.gif', 0, 1, 3, 0, 0, 0, 0, 4, 10, 0, 0, 3, 8, 'nuetral', 0, 0, 1),
(28, 'Jalapeno', 'monster_jalapeno.gif', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(29, 'Mailman', 'monster_mailman.gif', 7, 1, 3, 0, 0, 0, 0, 5, 13, 0, 0, 0, 0, '', 0, 0, 1),
(30, 'Nurse', 'monster_secretary.gif', 4, 1, 3, 0, 0, 0, 0, 6, 12, 0, 0, 0, 0, 'nuetral', 0, 0, 1),
(31, 'Doctor', 'monster_bluecollar.gif', 7, 1, 3, 0, 0, 0, 0, 7, 14, 0, 0, 0, 0, '', 0, 0, 1),
(32, 'Confused Patient', 'monster_goth_kid.gif', 4, 1, 3, 0, 0, 0, 0, 7, 15, 0, 0, 0, 0, '', 0, 0, 1),
(33, 'Pastor', 'monster_dude.gif', 1, 3, 5, 0, 0, 0, 0, 9, 19, 0, 0, 9, 15, 'good', 0, 0, 1),
(34, 'Choir Singer', 'monster_dude.gif', 1, 3, 6, 0, 0, 0, 0, 10, 22, 0, 0, 8, 12, 'good', 0, 0, 2),
(35, 'Church Member', 'monster_dude.gif', 1, 3, 6, 0, 0, 0, 0, 12, 25, 0, 0, 12, 19, 'nuetral', 0, 0, 1),
(43, 'Janitor Robot', 'monster_bluerobotthing.gif', 0, 2, 4, 0, 0, 0, 0, 14, 18, 0, 0, 5, 8, 'nuetral', 0, 0, 1),
(36, 'Grease Monkey', 'monster_monkey.gif', 4, 6, 9, 0, 0, 0, 0, 17, 22, 0, 0, 13, 19, 'evil', 0, 0, 1),
(37, 'Judge', 'monster_dude.gif', 16, 9, 12, 0, 0, 0, 0, 30, 43, 0, 0, 20, 24, 'nuetral', 0, 0, 1),
(38, 'Security Guard', 'monster_dude.gif', 7, 12, 15, 0, 0, 0, 0, 34, 43, 0, 0, 0, 0, 'nuetral', 0, 0, 1),
(39, 'Jury Member', 'monster_dude.gif', 0, 9, 12, 0, 0, 0, 0, 15, 32, 0, 0, 14, 22, 'nuetral', 0, 0, 1),
(40, 'Lawyer', 'monster_exec.gif', 0, 9, 12, 0, 0, 0, 0, 21, 33, 0, 0, 18, 21, 'evil', 0, 0, 1),
(41, 'Court Recorder', 'monster_homemaker.gif', 0, 10, 13, 0, 0, 0, 0, 25, 31, 0, 0, 17, 24, 'nuetral', 0, 0, 1),
(42, 'VAPA Driver', 'monster_paperboy.gif', 0, 7, 10, 0, 0, 0, 0, 12, 20, 0, 0, 10, 15, 'nuetral', 0, 0, 1),
(44, 'Nun', 'monster_dude.gif', 0, 3, 6, 0, 0, 0, 0, 6, 15, 0, 0, 7, 10, 'good', 0, 0, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `rpg_npc`
--

INSERT INTO `rpg_npc` (`id`, `name`, `image`, `loot`, `quest`) VALUES
(1, 'Squidgie', 'monster_dude.gif', 0, '5,7,4'),
(2, 'Squishmeister J', 'monster_dude.gif', 0, '3'),
(3, 'Hole Hermit', 'monster_hermit.gif', 0, '2,6'),
(4, 'Technikerbot 5K', 'monster_bluerobotthing.gif', 0, '8'),
(5, 'Homemaker', 'monster_homemaker.gif', 0, '9');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `rpg_quest`
--

INSERT INTO `rpg_quest` (`id`, `name`, `description`, `repeatable`, `required_level`, `requires_loot`, `killmonsters`, `gives_loot`, `finishtext`, `unfinishtext`, `trigaction`, `prereq_quest`, `question`, `answer_1`, `answer_2`, `answer_3`, `answer_4`, `correct_answer`, `accepttext`) VALUES
(1, 'The fingernail of Gorgon', 'Bring me Gorgon''s fingernail. I need it.', 'no', '8', 8, '', 9, 'Ah Gorgon''s fingernail at last! Thank you!', 'Did you bring me Gorgon''s fingernail? No... um... ok well get out there and find it!', 15, 0, '', '', '', '', '', '', ''),
(2, 'Rat Guts', 'Hey ah... Ah I need some rat guts. Bring me 6 rat guts. NOW!', 'yes', '1', 10, '', 1, 'Thanks for my rat guts bro.', 'You got my rat guts?', 0, 0, '', '', '', '', '', '', 'Great I will see you when you retrieve the guts I asked for.'),
(3, 'I require an Alien Testicle', 'I am working on a new recipe for Squishology. I require an Alien Testicle. If you get it for me I will share my secret.', 'yes', '1', 31, '', 10, 'Ah... This is what I need.', 'Have you got the Alien Testicle I asked for?', 0, 7, '', '', '', '', '', '', 'You might be able to find an Alien Testicle on an alien of some kind. Dunno where though.'),
(4, 'Bring me an upside down heart!', 'I require an upside down heart!', 'yes', '1', 12, '', 0, 'Thanks for the upside down heart.', 'Have you got the upside down heart?', 14, 3, '', '', '', '', '', '', ''),
(5, 'The art of the squisher', 'Squishology! This is a secret art. I can lead you down the path if you''d like to get started. I can teach you how to squish things! All you will need is the proper tools.', 'no', '1', 0, '', 0, 'Great job! Now lets get you set up with some Squishing tools.', 'So would you like to learn Squishology?', 78, 0, 'Would you like to learn the art of Squishology?', 'Yes', 'No', '', '', '1', ''),
(6, 'Test Quest', 'Test 1', 'no', '4', 22, '', 12, 'Test 3', 'Test 2', 0, 2, '', '', '', '', '', '', 'Test 4'),
(7, 'Squishy Business', 'So now that you have chosen to be a squishologist, you are probably wondering what you can do with this profession. Bring me some eyeballs and I will show you!', 'no', '', 34, '', 33, 'Great you have the eyeballs I asked for.', 'Bring me 4 eyeballs.', 0, 5, '', '', '', '', '', '', 'Good now it is up to you to get the eyeballs by any means necessary.'),
(8, 'To be a techniker', 'I can teach you how to become a techniker. I was made from technikers!', 'no', '', 0, '', 0, 'Awesome lets go!', 'Fine.', 83, 0, 'Do you want to be a techniker?', 'Yes', 'No', '', '', '1', 'A new career in techniking awaits.'),
(9, 'Kill me some rats', 'There are so many rats around here! Help!', 'no', '5', 0, '1;6', 0, 'Thank you for killing the rats.', 'Did you kill all those rats yet?\r\n', 0, 0, '', '', '', '', '', '', 'Oh my gosh! Thank you so much for helping me!');

-- --------------------------------------------------------

--
-- Table structure for table `rpg_special_attacks`
--

CREATE TABLE IF NOT EXISTS `rpg_special_attacks` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `rpg_special_attacks`
--

INSERT INTO `rpg_special_attacks` (`id`, `name`, `description`, `image`, `persist_rounds`, `power`, `cooldown`, `action`, `class`, `level`, `trained`) VALUES
(1, 'Whine', '', 'abl_whine.gif', 0, 25, 0, '46', '', '', ''),
(2, 'Sucker Punch', '', 'abl_suckerpunch.gif', 0, 5, 0, '49', '', '', ''),
(3, 'Firestorm', 'Scorch enemies ', 'abl_fire.gif', 0, 10, 0, '64', 'Mad Scientist', '5', 'no'),
(4, 'Nipple Twist', '', 'abl_suckerpunch.gif', 0, 5, 0, '', '', '', ''),
(5, 'Gaze', '', 'abl_eyeray.gif', 2, 25, 0, '', '', '', ''),
(6, 'Gaze (rank 2)', '', 'abl_eyeray.gif', 5, 35, 0, '46', '', '', ''),
(7, 'Gaze (rank 3)', '', 'abl_eyeray.gif', 8, 45, 0, '', '', '', ''),
(8, 'Life Siphon', '', 'abl_siphon.gif', 1, 35, 0, '47', '', '', ''),
(9, 'Create Hamburger', '', 'abl_createfood.gif', 2, 0, 0, '', '', '', ''),
(10, 'Fling', 'Fling your enemy', 'abl_suckerpunch.gif', 0, 15, 0, '', 'All', '10', ''),
(11, 'Bite', 'Bite an enemy', 'abl_bite.gif', 0, 10, 0, '58', 'All', '2', 'auto'),
(12, 'Ouch', 'Ouch', 'abl_swirl.gif', 0, 60, 0, '60', 'All', '10', 'no'),
(13, 'Icestorm', 'Icestorm', 'abl_ice.gif', 0, 15, 0, '', 'All', '6', 'yes'),
(14, 'Wind Howl', 'Blows wind up the enemies way', 'abl_base.gif', 0, 15, 0, '64', 'Crusader', '4', 'yes'),
(15, 'Explode', '', 'abl_base.gif', 0, 0, 0, '', '', '', ''),
(16, 'Roundhouse Kick', '', 'abl_base.gif', 0, 0, 0, '', '', '', ''),
(17, 'Meme', '', 'abl_base.gif', 0, 0, 0, '', '', '', ''),
(18, 'Stern Talking To', 'You give the enemy a stern talking to', 'abl_base.gif', 0, 15, 0, '', 'Crusader', '5', 'yes'),
(19, 'Fry', 'Fry', 'abl_base.gif', 0, 0, 0, '', '', '', '');

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
  `will_not_buy` text NOT NULL,
  `future` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `rpg_vendor`
--

INSERT INTO `rpg_vendor` (`id`, `name`, `image`, `description`, `inventory`, `will_not_buy`, `future`) VALUES
(1, 'Milard', 'monster_whino.gif', 'I deal in extreme junk. Give it a look see.', '5', '132', ''),
(2, 'Mr. Smiley', 'monster_bully.gif', 'Hey I just got a shipment in from Milards.', '5', '', ''),
(3, 'Developer Vendor', 'monster_enragedterrier.gif', 'This dog is strange and smells funny. He beckons you closer to look at his wares.', '17', '', ''),
(4, 'James', 'monster_goth_kid.gif', 'Some dark colored items and accessories', '23', '1', ''),
(5, 'Your mom', 'monster_monkey.gif', 'This is your mom', '29', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `searches`
--

CREATE TABLE IF NOT EXISTS `searches` (
  `search` text NOT NULL,
  `engine` text NOT NULL,
  `fullsearch` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `searches`
--

INSERT INTO `searches` (`search`, `engine`, `fullsearch`, `time`) VALUES
('q=defective+minds', 'www.google.com', 'http://www.google.com/search?hl=en&ei=GTRZSo3pEZy_twfD4JDdCg&sa=X&oi=spell&resnum=0&ct=result&cd=1&q=defective+minds&spell=1', '2009-07-11 19:56:35'),
('p=monkey+animations', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dmonkey%2Banimations%26b%3D21%26ni%3D20%26ei%3Dutf-8%26pstart%3D1%26fr%3Dyfp-t-501-s%26fr2%3Dsg-gac&w=220&h=253&imgurl=www.defectiveminds.com%2Ffiles%2Fimages%2Fmonkey_smoking.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=21k&name=monkey+smoking+j...&p=monkey+animations&oid=3698be2bc09c3392&fr2=sg-gac&no=40&tt=426&b=21&ni=20&sigr=11dleqm0m&sigi=1318nisn4&sigb=13njg7k6v', '2009-07-13 20:38:43'),
('p=monkey+animations', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dmonkey%2Banimations%26b%3D21%26ni%3D20%26ei%3Dutf-8%26pstart%3D1%26fr%3Dyfp-t-501-s%26fr2%3Dsg-gac&w=220&h=253&imgurl=www.defectiveminds.com%2Ffiles%2Fimages%2Fmonkey_smoking.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=21k&name=monkey+smoking+j...&p=monkey+animations&oid=3698be2bc09c3392&fr2=sg-gac&no=40&tt=426&b=21&ni=20&sigr=11dleqm0m&sigi=1318nisn4&sigb=13njg7k6v', '2009-07-13 20:38:43'),
('q=defective+minds', 'www.google.com', 'http://www.google.com/search?hl=en&q=defective+minds&aq=f&oq=&aqi=', '2009-07-15 11:42:52'),
('q=defective+minds', 'www.google.com', 'http://www.google.com/search?hl=en&q=defective+minds&aq=f&oq=&aqi=', '2009-07-15 11:44:22'),
('q=defective+minds', 'www.google.com', 'http://www.google.com/search?hl=en&q=defective+minds&aq=f&oq=&aqi=', '2009-07-15 11:44:47'),
('q=defective+minds%5C', 'www.google.com', 'http://www.google.com/search?hl=en&q=defective+minds%5C&aq=f&oq=&aqi=', '2009-07-15 11:46:09'),
('p=three+some', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dthree%2Bsome%26js%3D1%26b%3D341%26ni%3D20%26ei%3Dutf-8%26y%3DSearch%26pstart%3D1%26fr%3Dyfp-t-501&w=394&h=595&imgurl=www.defectiveminds.com%2Fimages%2FthreesomeA.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=77k&name=threesomeA+jpg&p=three+some&oid=4474990a45a62028&fr2=&no=358&tt=1087386&b=341&ni=20&sigr=11dleqm0m&sigi=12nh0er7j&sigb=13ilo47c0', '2009-07-17 19:16:29'),
('p=three+some', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dthree%2Bsome%26js%3D1%26b%3D341%26ni%3D20%26ei%3Dutf-8%26y%3DSearch%26pstart%3D1%26fr%3Dyfp-t-501&w=394&h=595&imgurl=www.defectiveminds.com%2Fimages%2FthreesomeA.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=77k&name=threesomeA+jpg&p=three+some&oid=4474990a45a62028&fr2=&no=358&tt=1087386&b=341&ni=20&sigr=11dleqm0m&sigi=12nh0er7j&sigb=13ilo47c0', '2009-07-17 19:16:29'),
('p=three+some', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dthree%2Bsome%26js%3D1%26b%3D341%26ni%3D20%26ei%3Dutf-8%26y%3DSearch%26pstart%3D1%26fr%3Dyfp-t-501&w=394&h=595&imgurl=www.defectiveminds.com%2Fimages%2FthreesomeA.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=77k&name=threesomeA+jpg&p=three+some&oid=4474990a45a62028&fr2=&no=358&tt=1087386&b=341&ni=20&sigr=11dleqm0m&sigi=12nh0er7j&sigb=13ilo47c0', '2009-07-17 19:16:31'),
('p=three+some', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dthree%2Bsome%26js%3D1%26b%3D341%26ni%3D20%26ei%3Dutf-8%26y%3DSearch%26pstart%3D1%26fr%3Dyfp-t-501&w=394&h=595&imgurl=www.defectiveminds.com%2Fimages%2FthreesomeA.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=77k&name=threesomeA+jpg&p=three+some&oid=4474990a45a62028&fr2=&no=358&tt=1087386&b=341&ni=20&sigr=11dleqm0m&sigi=12nh0er7j&sigb=13ilo47c0', '2009-07-17 19:16:31'),
('p=three+some', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dthree%2Bsome%26js%3D1%26b%3D341%26ni%3D20%26ei%3Dutf-8%26y%3DSearch%26pstart%3D1%26fr%3Dyfp-t-501&w=394&h=595&imgurl=www.defectiveminds.com%2Fimages%2FthreesomeA.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=77k&name=threesomeA+jpg&p=three+some&oid=4474990a45a62028&fr2=&no=358&tt=1087386&b=341&ni=20&sigr=11dleqm0m&sigi=12nh0er7j&sigb=13ilo47c0', '2009-07-17 19:16:38'),
('p=three+some', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dthree%2Bsome%26js%3D1%26b%3D341%26ni%3D20%26ei%3Dutf-8%26y%3DSearch%26pstart%3D1%26fr%3Dyfp-t-501&w=394&h=595&imgurl=www.defectiveminds.com%2Fimages%2FthreesomeA.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=77k&name=threesomeA+jpg&p=three+some&oid=4474990a45a62028&fr2=&no=358&tt=1087386&b=341&ni=20&sigr=11dleqm0m&sigi=12nh0er7j&sigb=13ilo47c0', '2009-07-17 19:16:38'),
('p=three+some', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dthree%2Bsome%26js%3D1%26b%3D341%26ni%3D20%26ei%3Dutf-8%26y%3DSearch%26pstart%3D1%26fr%3Dyfp-t-501&w=394&h=595&imgurl=www.defectiveminds.com%2Fimages%2FthreesomeA.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=77k&name=threesomeA+jpg&p=three+some&oid=4474990a45a62028&fr2=&no=358&tt=1087386&b=341&ni=20&sigr=11dleqm0m&sigi=12nh0er7j&sigb=13ilo47c0', '2009-07-19 02:30:00'),
('p=three+some', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dthree%2Bsome%26js%3D1%26b%3D341%26ni%3D20%26ei%3Dutf-8%26y%3DSearch%26pstart%3D1%26fr%3Dyfp-t-501&w=394&h=595&imgurl=www.defectiveminds.com%2Fimages%2FthreesomeA.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=77k&name=threesomeA+jpg&p=three+some&oid=4474990a45a62028&fr2=&no=358&tt=1087386&b=341&ni=20&sigr=11dleqm0m&sigi=12nh0er7j&sigb=13ilo47c0', '2009-07-19 02:30:00'),
('p=smoking+animations', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dsmoking%2Banimations%26ei%3Dutf-8%26fr%3Dyfp-t-203&w=220&h=253&imgurl=www.defectiveminds.com%2Ffiles%2Fimages%2Fmonkey_smoking.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=21k&name=monkey+smoking+j...&p=smoking+animations&oid=3698be2bc09c3392&fr2=&no=3&tt=126&sigr=11dleqm0m&sigi=1318nisn4&sigb=12n7lio5g&type=JPG', '2009-07-19 08:30:31'),
('p=smoking+animations', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dsmoking%2Banimations%26ei%3Dutf-8%26fr%3Dyfp-t-203&w=220&h=253&imgurl=www.defectiveminds.com%2Ffiles%2Fimages%2Fmonkey_smoking.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=21k&name=monkey+smoking+j...&p=smoking+animations&oid=3698be2bc09c3392&fr2=&no=3&tt=126&sigr=11dleqm0m&sigi=1318nisn4&sigb=12n7lio5g&type=JPG', '2009-07-19 08:30:31'),
('p=smoking+animations', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dsmoking%2Banimations%26ei%3Dutf-8%26fr%3Dyfp-t-203&w=220&h=253&imgurl=www.defectiveminds.com%2Ffiles%2Fimages%2Fmonkey_smoking.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=21k&name=monkey+smoking+j...&p=smoking+animations&oid=3698be2bc09c3392&fr2=&no=3&tt=126&sigr=11dleqm0m&sigi=1318nisn4&sigb=12n7lio5g&type=JPG', '2009-07-19 08:30:38'),
('p=smoking+animations', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dsmoking%2Banimations%26ei%3Dutf-8%26fr%3Dyfp-t-203&w=220&h=253&imgurl=www.defectiveminds.com%2Ffiles%2Fimages%2Fmonkey_smoking.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=21k&name=monkey+smoking+j...&p=smoking+animations&oid=3698be2bc09c3392&fr2=&no=3&tt=126&sigr=11dleqm0m&sigi=1318nisn4&sigb=12n7lio5g&type=JPG', '2009-07-19 08:30:38'),
('q=defective+minds', 'www.google.com', 'http://www.google.com/search?hl=en&q=defective+minds&aq=f&oq=&aqi=', '2009-07-19 21:12:44'),
('q=defective+minds', 'www.google.com', 'http://www.google.com/search?hl=en&q=defective+minds&btnG=Google+Search&aq=f&oq=&aqi=', '2009-07-19 21:45:47'),
('p=smoking+animations', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dsmoking%2Banimations%26fr%3Dyfp-t-151-s&w=220&h=253&imgurl=www.defectiveminds.com%2Ffiles%2Fimages%2Fmonkey_smoking.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=21k&name=monkey+smoking+j...&p=smoking+animations&oid=3698be2bc09c3392&fr2=&no=3&tt=129&sigr=11dleqm0m&sigi=1318nisn4&sigb=12g29j3q8', '2009-07-21 21:08:01'),
('p=smoking+animations', 'images.search.yahoo.com', 'http://images.search.yahoo.com/images/view?back=http%3A%2F%2Fimages.search.yahoo.com%2Fsearch%2Fimages%3Fp%3Dsmoking%2Banimations%26fr%3Dyfp-t-151-s&w=220&h=253&imgurl=www.defectiveminds.com%2Ffiles%2Fimages%2Fmonkey_smoking.jpg%3Fdefective%3Da9a1d570deebb16408a05b8bc572669f&rurl=http%3A%2F%2Fwww.defectiveminds.com%2Fnews.php%3Ftop%3D20&size=21k&name=monkey+smoking+j...&p=smoking+animations&oid=3698be2bc09c3392&fr2=&no=3&tt=129&sigr=11dleqm0m&sigi=1318nisn4&sigb=12g29j3q8', '2009-07-21 21:08:01'),
('q=defective+minds', 'www.google.com', 'http://www.google.com/search?hl=en&q=defective+minds&aq=f&oq=&aqi=', '2009-07-21 21:08:09'),
('q=defective+minds', 'www.google.com', 'http://www.google.com/search?hl=en&q=defective+minds&aq=f&oq=&aqi=', '2009-07-24 19:55:46'),
('q=defective+minds', 'www.google.com', 'http://www.google.com/search?hl=en&q=defective+minds&aq=f&oq=&aqi=', '2009-07-24 20:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `smilies`
--

CREATE TABLE IF NOT EXISTS `smilies` (
  `sfrom` text NOT NULL,
  `sto` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smilies`
--

INSERT INTO `smilies` (`sfrom`, `sto`) VALUES
(':)', '<img src="http://www.defectiveminds.com/images/emoticons/smiley.gif" alt=":)">'),
('^-', '&lt;'),
('^+', '&gt;'),
('(king)', '<img src="http://www.defectiveminds.com/images/awards/king_edit.gif" alt="The King Award!">'),
(':X', '<img src="http://www.defectiveminds.com/images/skull.gif" alt=":X" width=24>'),
('(linux)', 'linux <img src="http://www.defectiveminds.com/images/emoticons/linux.gif" alt="linux" width=24>'),
('(new)', '<img src="http://www.defectiveminds.com/images/emoticons/new.gif" alt="new">'),
('(*)', '<img src="http://www.defectiveminds.com/images/emoticons/pi_lightbulb.gif" alt="(*)">'),
(':(', '<img src="http://www.defectiveminds.com/images/emoticons/sad.gif" alt=":(">'),
('8)', 'cool <img src="http://www.defectiveminds.com/images/emoticons/smokin.gif" alt="cool">'),
('>:|', '<img src="http://www.defectiveminds.com/images/emoticons/upset.gif" alt=">:|">'),
(';)', '<img src="http://www.defectiveminds.com/images/emoticons/wink2.gif" alt=";)">'),
('(/)', '<img src="http://www.defectiveminds.com/images/emoticons/yingyang.gif" alt="(/)">'),
('(yes)', '<img src="http://www.defectiveminds.com/images/emoticons/yes.gif" alt="yes">'),
(':P', '<img src="http://www.defectiveminds.com/images/emoticons/tongue2.gif" alt=":P">'),
('(bullet1)', '<img src="http://www.defectiveminds.com/images/emoticons/unread.gif" alt="(bullet1)">'),
('(graph)', '<img src="http://www.defectiveminds.com/images/emoticons/poll_icon.gif" alt="(graph)">'),
('(folder)', '<img src="http://www.defectiveminds.com/images/emoticons/openfolder.gif" alt="(folder)">'),
('(!)', '<img src="http://www.defectiveminds.com/images/emoticons/notice.gif" alt="(!)">'),
('(^)', '<img src="http://www.defectiveminds.com/images/emoticons/KNIFE.gif" alt="(^)" width=24>'),
('(key)', '<img src="http://www.defectiveminds.com/images/emoticons/KEY.gif" alt="(key)" height=20>'),
('(keyboard)', '<img src="http://www.defectiveminds.com/images/emoticons/KEYBOARD.gif" alt="(keyboard)" height=24>'),
('computer', '<img src="http://www.defectiveminds.com/images/emoticons/gnote.gif" alt="computer" width=16> computer'),
('(look!)', '<img src="http://www.defectiveminds.com/images/emoticons/HAND.gif" alt="(look!)">'),
('(gears)', '<img src="http://www.defectiveminds.com/images/emoticons/gears.gif" alt="(gears)">'),
('(clip)', '<img src="http://www.defectiveminds.com/images/emoticons/clipboard.gif" alt="(clip)">'),
('(bananaman)', '<img src="http://www.defectiveminds.com/images/emoticons/banana.gif" alt="(bananaman)">'),
('(armor)', '<img src="http://www.defectiveminds.com/images/armor.gif" alt="(armor)">'),
('(@)', '<img src="http://www.defectiveminds.com/images/fat.gif" alt="(@)">'),
('(?)', '<img src="http://www.defectiveminds.com/images/help.gif" alt="(?)">'),
('(ninja)', '<img src="http://www.defectiveminds.com/images/ninja.gif" alt="(ninja)" width=32>'),
('(weapon)', '<img src="http://www.defectiveminds.com/images/weapon.gif" alt="(weapon)">'),
('(gorgon)', '<img src="http://www.defectiveminds.com/images/gorgon.gif" alt="I damn thee!" width=64>'),
('%X', '<img src="http://www.defectiveminds.com/images/emoticons/skull.gif" alt="Grrrrrrrrrrrrrrr!" width=64>'),
('(shit_fairy)', '<img src="http://www.defectiveminds.com/images/shit_fairy.jpg" alt="Blessed be thou!">'),
('(tm)', '&#8482;');

-- --------------------------------------------------------

--
-- Table structure for table `useronline`
--

CREATE TABLE IF NOT EXISTS `useronline` (
  `locale` text NOT NULL,
  `timestamp` int(15) NOT NULL DEFAULT '0',
  `ip` varchar(40) NOT NULL DEFAULT '',
  `page` varchar(100) NOT NULL,
  `loggedin` text NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useronline`
--

INSERT INTO `useronline` (`locale`, `timestamp`, `ip`, `page`, `loggedin`, `name`) VALUES
('http://127.0.0.1/', 1248656726, '76.100.56.103', '/index.php', '1', ''),
('http://127.0.0.1/', 1248656726, '76.100.56.103', '/index.php', '1', ''),
('http://127.0.0.1/', 1248656726, '76.100.56.103', '/index.php', '1', ''),
('http://127.0.0.1/', 1248656726, '76.100.56.103', '/index.php', '1', ''),
('http://127.0.0.1/', 1248656726, '76.100.56.103', '/index.php', '1', ''),
('http://www.defectiveminds.com/', 1248656731, '76.100.56.103', '/login.php', '1', ''),
('http://www.defectiveminds.com/index.php', 1248656796, '76.100.56.103', '/rpg_rightpane.php', '1', 'Seth');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='hi' AUTO_INCREMENT=1201 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `pass`, `real_name`, `country`, `gender`, `email`, `webpage`, `avatar`, `picture`, `posts`, `karma`, `id`, `show_flash`, `icq`, `yahoo`, `msn`, `aim`, `irc_server`, `irc_channel`, `website_fav`, `sentence`, `first_login`, `reporter`, `show_contact_info`, `upload`, `files_uploaded`, `files_downloaded`, `last_activity`, `last_login`, `birthday`, `access`, `forumposts`, `forumreplies`, `awards`, `referrals`, `comments`, `linksadded`, `logins`, `rpg`, `rpg_name`, `rpg_hp`, `rpg_hpmax`, `rpg_pow`, `rpg_powmax`, `rpg_str`, `rpg_int`, `rpg_agl`, `rpg_def`, `rpg_level`, `rpg_trainpoints`, `rpg_abilities`, `rpg_craft`, `rpg_craft_skill`, `rpg_craft_skill_max`, `rpg_craft_recipes`, `rpg_exp`, `rpg_totalexp`, `rpg_class`, `rpg_bank`, `rpg_bankcash`, `rpg_x`, `rpg_y`, `rpg_z`, `rpg_cash`, `rpg_encounter`, `rpg_slot_head`, `rpg_slot_hands`, `rpg_slot_legs`, `rpg_slot_arms`, `rpg_slot_feet`, `rpg_slot_chest`, `rpg_slot_back`, `rpg_slot_mainhand`, `rpg_slot_sechand`, `rpg_lastaction`, `rpg_ap`, `rpg_emails`, `rpg_base`, `rpg_base_tower1`, `rpg_base_tower2`, `rpg_base_tower3`, `rpg_base_tower4`, `rpg_henchleaders`, `rpg_henchmen`, `rpg_tutorial`, `rpg_mapsize`, `rpg_pvp_won`, `rpg_pvp_lost`, `rpg_pvp_lastplayer`, `rpg_clan`, `rpg_clanrank`, `rpg_quests_current`, `rpg_quests_completed`) VALUES
('Seth', '123', 'Seth Parson', 'United States', 'male', 'seth@defectiveminds.com', 'www.defectiveminds.com', '', '', 0, 0, 1168, 'no', '', '', 'seth_coder@hotmail.com', '', '', '', '', 'What?', '2009-06-25 05:19:37', 'yes', 'no', '', 0, 0, '2009-07-26 20:05:31', '2009-07-26 00:22:15', '1971-11-14 01:01:01', 255, 17, 20, '', 0, 0, 0, 0, 'yes', 'Defective Seth', 318, 318, 8, 408, 95, 64, 76, 76, 17, 0, '11|12|3', '1', 1, 99, '|1', 2898, 225424, '2', '', '', '-1', '-2', '1', 205.83, 'no', 115, 16, 128, 19, 103, 98, 25, 134, 28, '-1,-2,1', 20000, 'yes', 'base|mailbox|bed|bank|sidekick_generator|trinket_panel|auction_counter|trophy_case|sidekick_stable|henchmen_generator|henchleader_generator|quest_log', 'tower_guns_1', 'tower_foundation', 'tower_foundation', 'tower_foundation', 86, 1259, 'no', '64', 64, 52, 0, 0, 0, '6,9,', ',5,7,3,4,2'),
('Will', 'd3f3ct1v3', 'Will', 'United States', 'male', 'will@defectiveminds.com', 'http://www.defectiveminds.com', '', '', 0, 50, 1170, 'no', '', '', '', '', '', '', '', '', '2009-06-29 21:19:37', 'yes', 'yes', '', 0, 0, '2009-07-26 09:28:13', '2009-07-25 10:30:37', '1980-02-06 01:01:01', 255, 7, 8, '', 0, 0, 0, 0, 'yes', 'Defective Will', 116, 116, 114, 114, 20, 20, 20, 20, 9, 0, '', '', 0, 0, '', 14992, 71236, '3', '', '', '2', '-1', '2', 106.63, 'no', 115, 28, 5, 19, 92, 20, 25, 55, 0, '2,-1,2', 20000, 'no', 'base|sidekick_generator|bed|mailbox|bank|henchmen_generator|henchleader_generator', '', '', '', '', 11, 15, 'no', '64', 35, 35, 0, 0, 0, '', ''),
('imacomputa', '123', 'Imacomputa', 'United States', 'male', 'imacomputa@defectiveminds.com', '', '', '', 0, 0, 1184, 'no', '', '', '', '', '', '', '', 'Hey kid!', '2009-07-02 23:50:53', '', 'no', '', 0, 0, '2009-07-26 00:15:39', '2009-07-26 00:14:52', '1901-01-01 01:01:01', 0, 1, 0, '', 0, 0, 0, 0, 'yes', 'Imacomputa', 74, 74, 59, 59, 13, 13, 10, 10, 4, 0, '', '1', 1, 99, '', 1424, 5032, '9', '', '', '-3', '-2', '1', 3.29, 'no', 1, 16, 5, 19, 17, 18, 25, 3, 0, '-3,-2,1', 195, 'no', 'base|mailbox|sidekick_generator|bed|bank|quest_log', '', '', '', '', 0, 0, '', '64', 1, 1, 0, 0, 0, '67,7,', ',2,5'),
('peaceiswar', ']-L%uXt2', '', '', 'male', 'lordruairi@hotmail.com', '', '', '', 0, 0, 1197, '', '', '', '', '', '', '', '', '', '2009-07-22 13:14:37', '', '', '', 0, 0, '2009-07-22 13:15:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, '', 0, 0, 0, 0, 'yes', 'Nietzsche', 35, 66, 60, 60, 12, 12, 12, 12, 1, 0, '', '', 0, 0, '', 0, 0, '4', '', '', '1', '0', '1', 0.30, 'yes', 0, 0, 0, 0, 0, 0, 0, 0, 0, '1,0,1', 198, '', '', '', '', '', '', 0, 0, 'yes', '60', 1, 0, 0, 0, 0, '', ''),
('sarah', '3edc4rfv', '', '', 'male', 'sarahykuk200@hotmail.co.uk', '', '', '', 0, 0, 1192, '', '', '', '', '', '', '', '', '', '2009-07-11 20:07:34', '', '', '', 0, 0, '2009-07-24 20:13:03', '2009-07-24 20:09:29', '0000-00-00 00:00:00', 0, 0, 0, '', 0, 0, 0, 0, 'yes', 'MOFO', 124, 174, 135, 205, 49, 75, 60, 60, 8, 0, '|1|11|3', '', 0, 0, '', 12944, 2944, '2', '', '', '-1', '-2', '1', 420.18, 'no', 174, 149, 105, 19, 87, 99, 25, 162, 63, '-1,-2,1', 200, '', 'base|bed|auction_counter|mailbox|bank|henchmen_generator|henchleader_generator', '', '', '', '', 3, 221, 'no', '40', 5, 11, 0, 0, 0, '', ''),
('Seth2', '123', '', '', 'male', 'seth@defectiveminds.com', '', '', '', 0, 0, 1196, '', '', '', '', '', '', '', '', '', '2009-07-19 21:00:15', '', '', '', 0, 0, '2009-07-26 00:11:15', '2009-07-25 23:57:37', '0000-00-00 00:00:00', 0, 0, 0, '', 0, 0, 0, 0, 'yes', 'Sam', 61, 61, 74, 74, 11, 19, 16, 16, 3, 0, '|11', '1', 1, 99, '|1', 382, 1632, '6', '', '', '-1', '2', '1', 55.15, 'no', 0, 0, 0, 0, 0, 0, 0, 12, 0, '-1,-2,1', 57, '', 'base|bed|henchmen_generator|quest_log', '', '', '', '', 0, 56, 'no', '52', 36, 34, 0, 0, 0, '3,', ',5,7'),
('Seth4', '123', '', '', 'male', 'seth@defectiveminds.com', '', '', '', 0, 0, 1198, '', '', '', '', '', '', '', '', '', '2009-07-23 19:32:10', '', '', '', 0, 0, '2009-07-26 00:13:29', '2009-07-26 00:12:19', '0000-00-00 00:00:00', 0, 0, 0, '', 0, 0, 0, 0, 'yes', 'Phillip', 124, 124, 86, 86, 30, 14, 20, 20, 4, 0, '|11', '3', 1, 99, '', 1108, 4608, '7', '', '', '-3', '1', '2', 3.33, 'no', 174, 0, 0, 0, 0, 0, 25, 3, 0, '2,-1,2', 127, '', 'base|bed|quest_log', '', '', '', '', 0, 0, 'no', '64', 4, 2, 0, 0, 0, '', ',8'),
('rwlew', 'gr6,ybmq', '', '', 'male', 'richlew@live.com', '', '', '', 0, 0, 1199, '', '', '', '', '', '', '', '', '', '2009-07-23 20:40:57', '', '', '', 0, 0, '2009-07-23 20:42:30', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, '', 0, 0, 0, 0, 'yes', 'William Delahoussaye', 56, 56, 35, 35, 10, 10, 7, 7, 1, 0, '', '', 0, 0, '', 0, 0, '10', '', '', 'none', '', '0', 0.30, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'none', 199, '', '', '', '', '', '', 0, 0, 'yes', '', 1, 0, 0, 0, 0, '', ''),
('raskrutkaseo@mail.ru', '.2CwN9%@', '', '', 'male', 'raskrutkaseo@mail.ru', '', '', '', 0, 0, 1200, '', '', '', '', '', '', '', '', '', '2009-07-24 02:29:02', '', '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, '', 0, 0, '', '', '', '', '', '', 0.00, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 100, '', '', '', '', '', '', 0, 0, '', '', 0, 0, 0, 0, 0, '', '');
