CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `content` text NOT NULL,
  
  foreign key(chat_id) references chat(chat_id)	
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `messages` (
  `userId` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  
  foreign key(userId) references user(userId),
  foreign key(chat_id) references chat(chat_id),
  foreign key(message_id) references message(message_id)
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;