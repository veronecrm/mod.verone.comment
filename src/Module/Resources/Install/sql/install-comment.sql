CREATE TABLE IF NOT EXISTS `#__comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `entity` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `entityId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`entity`,`entityId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
