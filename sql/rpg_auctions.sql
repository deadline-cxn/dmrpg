

CREATE TABLE IF NOT EXISTS `rpg_auctions` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `name` text NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `id` int(11) NOT NULL,

  `starttime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `endtime`   datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  
  `startbid`  decimal(19,2) NOT NULL,
  `buyout`    decimal(19,2) NOT NULL,

  `highbidder` int(11) NOT NULL,
  `highbid` decimal(19,2) NOT NULL,



  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=216 ;
