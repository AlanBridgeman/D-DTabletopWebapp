<?php
	require_once ('/API/MysqliDb.php');
	$db = new MysqliDb ('localhost', 'root', '', 'dnd');
    $db->rawQuery
	("
	CREATE TABLE IF NOT EXISTS Users 
	(
		id INT NOT NULL AUTO_INCREMENT,							# user id
		passwod VARCHAR(60) NOT NULL,							# user password
		admin INT(1) NOT NULL DEFAULT 0,						# rights(ie. admin, user, etc....)
		active BOOLEAN,											# activly logged in
		fName VARCHAR(255) CHARACTER SET utf8 NOT NULL,			# first name
		lName VARCHAR(255) CHARACTER SET utf8 NOT NULL,			# last name  
		phone VARCHAR(16),										# phone number
		email VARCHAR(128) CHARACTER SET utf8 NOT NULL UNIQUE,	# email address
		intro VARCHAR(1024) CHARACTER SET utf8,					# self-introduction
		picture VARCHAR(256),									# picture path
		createdAt DATETIME,										# creation datetime
		expires DATETIME,										# expiry datetime
		PRIMARY KEY (id),
		CONSTRAINT fullName UNIQUE (fName, lName)
	) ENGINE=InnoDB;
	");
	$db->rawQuery
	("
	CREATE TABLE IF NOT EXISTS Posts 
	(
		id INT NOT NULL AUTO_INCREMENT,							# user id
		uID INT NOT NULL,
		message TEXT NOT NULL,									# picture path
		postedAt DATETIME,										# creation datetime
		editedAt DATETIME,										# expiry datetime
		PRIMARY KEY (id),
		FOREIGN KEY (uID) REFERENCES Users(id) 
	) ENGINE=InnoDB;
	");
	$db->rawQuery
	("
	CREATE TABLE IF NOT EXISTS CharTypes 
	(
		charID INT NOT NULL AUTO_INCREMENT,						# character id
		charType VARCHAR(255) NOT NULL,								# character sheet type
		PRIMARY KEY (charID, charType) 
	) ENGINE=InnoDB;
	");
	$db->rawQuery
	("
	CREATE TABLE IF NOT EXISTS UserChars
	(
		chariD INT NOT NULL,									# character id
		uID INT NOT NULL,										# user id
		PRIMARY KEY (charID, uID),
		FOREIGN KEY (charID) REFERENCES CharTypes(charID),
		FOREIGN KEY (uID) REFERENCES Users(id) 
	) ENGINE=InnoDB;
	");
?>