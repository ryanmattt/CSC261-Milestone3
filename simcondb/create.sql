DROP DATABASE IF EXISTS `simcondb`;
CREATE DATABASE `simcondb`; 
USE `simcondb`;


CREATE TABLE 'Attendee' (
	'First_Name' VARCHAR(50) NOT NULL,
	'Last_Name' VARCHAR(50), 
	'Email' VARCHAR(255),
	'ID' INT NOT NULL AUTO_INCREMENT,
	'Ticket_Type' VARCHAR(50) NOT NULL,
	'Mailing_List' BIT NOT NULL DEFAULT 0,
	'Date_Checked_In' DATETIME NOT NULL DEFAULT GETDATE(),
	CONSTRAINT 'Valid_Ticket' CHECK 'Ticket_Type' IN ('Day', 'Weekend'),
	CONSTRAINT 'Valid_Email' CHECK 'Email' LIKE '%@%',
	PRIMARY KEY ('ID')
);

CREATE TABLE 'Staff' (
	'First_Name' VARCHAR(50) NOT NULL,
	'Last_Name' VARCHAR(50), 
	'ID' INT NOT NULL AUTO_INCREMENT,
	'Primary_Team' VARCHAR(50) NOT NULL,
	'Rank' INT NOT NULL DEFAULT 3,
	'Password' VARCHAR(50) NOT NULL,
	PRIMARY KEY ('ID')
);

CREATE TABLE 'Event' (
	'Event_ID' INT NOT NULL AUTO_INCREMENT,
	'Staff_Event_Runner_ID' INT DEFAULT 0,
	'Attendee_Event_Runner_ID' INT DEFAULT 0,
	'Max_Attendees' INT NOT NULL DEFAULT 10,
	'Length_Minutes' INT NOT NULL,
	'Name' VARCHAR(100) DEFAULT 'Event_ID',
	'Description' VARCHAR(500),
	'Time' DATETIME NOT NULL,

	PRIMARY KEY ('Event_ID'),
	FOREIGN KEY ('Staff_Event_Runner_ID') REFERENCES 'Staff'('ID'),
	FOREIGN KEY ('Attendee_Event_Runner_ID') REFERENCES 'Attendee'('ID')
);

CREATE TABLE 'Event_Attendee_Staff'(
	'ID' INT NOT NULL,
	'Event_ID' INT NOT NULL,
	PRIMARY KEY ('ID', 'Event_ID'),
	FOREIGN KEY ('ID') REFERENCES 'Staff'('ID'),
	FOREIGN KEY ('Event_ID') REFERENCES 'Event'('Event_ID'),
);

CREATE TABLE 'Event_Attendee_Attendee'(
	'ID' INT NOT NULL,
	'Event_ID' INT NOT NULL,
	PRIMARY KEY ('ID', 'Event_ID'),
	FOREIGN KEY ('ID') REFERENCES 'Attendee'('ID'),
	FOREIGN KEY ('Event_ID') REFERENCES 'Event'('Event_ID')
);

CREATE TABLE 'Stock'(
	'SKU' INT NOT NULL,
	'Cost' DECIMAL(6,2) NOT NULL DEFAULT 0.00,
	'Size' VARCHAR(10),
	'Quantity' INT NOT NULL DEFAULT 0,
	PRIMARY KEY ('SKU')
);

CREATE TABLE 'Item_Category'(
	'Item_Name' VARCHAR(50) NOT NULL,
	'Category' VARCHAR(50) NOT NULL,
	PRIMARY KEY ('Item_Name')
);

CREATE TABLE 'Sale'(
	'Sale_ID' INT NOT NULL AUTO_INCREMENT,
	'Total' DECIMAL(6,2) NOT NULL DEFAULT 0.00,
	'Date_Purchased' DATETIME NOT NULL DEFAULT GETDATE(),
	'Quantity' INT NOT NULL,
	'SKU' INT NOT NULL,
	'Customer_ID_Staff' INT DEFAULT 0,
	'Customer_ID_Attendee' INT DEFAULT 0,

	PRIMARY KEY ('Sale_ID'),
	FOREIGN KEY ('SKU') REFERENCES 'Stock'('SKU'),
	FOREIGN KEY ('Customer_ID_Staff') REFERENCES 'Staff'('ID'),
	FOREIGN KEY ('Customer_ID_Attendee') REFERENCES 'Attendee'('ID')
);