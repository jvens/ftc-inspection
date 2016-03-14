/* TODO: creating the competition table 

CREATE TABLE competition
(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
location VARCHAR(100) NOT NULL,
description VARCHAR (255)
);
*/


# creating the database
CREATE DATABASE ftc;

#creating a user that volunteers can sign in with
#username = ftciowa
#pass = gp
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES ON ftc.* TO 'ftciowa'@'localhost' IDENTIFIED BY 'gp';


#To log in with this user run the following command
mysql -u ftciowa  -p


#make sure you are in the correct database
USE ftc

# creating the team table
CREATE TABLE team
(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
division VARCHAR(64) NOT NULL,
team_name VARCHAR(64) NOT NULL,
team_number INT NOT NULL,
robot_inspection_status ENUM('NOT_SEEN','PASS', 'FAIL') DEFAULT 'NOT_SEEN',
field_inspection_status ENUM('NOT_SEEN','PASS', 'FAIL') DEFAULT 'NOT_SEEN',
robot_inspection_comment VARCHAR(140),
field_inspection_comment VARCHAR(140),
last_updated datetime 
);


# adding test teams to the database
INSERT INTO team (division, team_name, team_number, last_updated)
VALUES ("Ortberg", "Kool Kids", 12345, NOW());

INSERT INTO team (division, team_name, team_number, last_updated)
VALUES ("Ryerson", "Lemons", 5466, NOW());

INSERT INTO team (division, team_name, team_number, last_updated)
VALUES ("Ortberg", "beta", 3550, NOW());

INSERT INTO team (division, team_name, team_number, last_updated)
VALUES ("Ryerson", "Even more clever of a name", 5925, NOW());


#if you have a scv file that follows this exact format then use the following script and command
/* filename should be `teams.sql`

5466,Combustable Lemons,Ortberg
12345,Big Boom Boom Boys,Ryerson
00019,The teens,Ortberg
80085,Do you get It?,Ryerson
*/

#run ./insertScript.sh\
#then dump the created .sql file into the database with this command
#    mysql -u ftciowa -D ftc -p < teams.sql
