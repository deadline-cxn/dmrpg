

CREATE TABLE `users` (
  `name` text NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL,
  `real_name` text NOT NULL,

  `gender` text NOT NULL,
  
  `rpg_emails` text NOT NULL,

  `karma` int(11) NOT NULL default '0',
  `id` int(11) NOT NULL auto_increment,

  `sentence` text NOT NULL,

  `first_login` datetime NOT NULL default '0000-00-00 00:00:00',
  `last_login` datetime NOT NULL default '0000-00-00 00:00:00',

  `access` int(11) NOT NULL default '0',

  `awards` text NOT NULL,


	str
	agl
	int
	def
	hp
	hpmax
	pow
	powmax
	cash
	inv
	class
	x
	y
	z
	level
	exp
	totalexp
	encounter
	hands
	head
	arms
	legs
	chest
	back
	feet
	hand1
	hand2
	trainpoints
	ability
   

  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='hi' AUTO_INCREMENT=1198 ;


CREATE TABLE `banned` (
  `id` int(11) NOT NULL auto_increment,
  `domain` text NOT NULL,
  `link` text NOT NULL,
  `ip` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=626 ;
