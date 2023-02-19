/*Create Table*/
CREATE TABLE user (
user_id INT AUTO_INCREMENT,
fname VARCHAR(256),
lname VARCHAR(256),
email VARCHAR(256),
PRIMARY KEY(user_id)
)ENGINE = innodb;

ALTER TABLE user
ADD biography VARCHAR(256);


CREATE TABLE course (
course_id INT,
name VARCHAR(256),
PRIMARY KEY(course_id)
)ENGINE = innodb;


CREATE TABLE semester (
semester_id INT AUTO_INCREMENT,
term VARCHAR(256),
start_date DATE,
end_date DATE,
PRIMARY KEY(semester_id)
)ENGINE = innodb;


CREATE TABLE building (
building_code VARCHAR(256),
name VARCHAR(256),
room INT,
street VARCHAR(256),
city VARCHAR(256),
state VARCHAR(256),
zip_code INT,
PRIMARY KEY(building_code)
)ENGINE = innodb;


CREATE TABLE schedule (
schedule_id INT AUTO_INCREMENT,
course_id INT,
semester_id INT,
weekday VARCHAR(256),
timeslot TIME,
building_code VARCHAR(256) 
PRIMARY KEY(index),
FOREIGN KEY(course_id) REFERENCES courses(course_id),
FOREIGN KEY(semester_id) REFERENCES semester(semester_id),
FOREIGN KEY(building_code) REFERENCES building(building_code)
)ENGINE = innodb;


CREATE TABLE appointment (
appointment_id INT AUTO_INCREMENT,
ta_id INT,
student_id INT,
time DATETIME,
building_code VARCHAR(256),
emergency_id INT,
check_in BOOLEAN,
PRIMARY KEY(appointment_id),
CONSTRAINT fk_student_id FOREIGN KEY(student_id) REFERENCES user(user_id),
CONSTRAINT fk_ta_id FOREIGN KEY(ta_id) REFERENCES user(user_id),
FOREIGN KEY(building_code) REFERENCES building(building_code),
FOREIGN KEY(emergency_id) REFERENCES emergency(emergency_id)
)ENGINE = innodb;

ALTER TABLE appointment
ADD schedule_id INT,
ADD FOREIGN KEY(schedule_id) REFERENCES schedule(schedule_id)

ALTER TABLE appointment
ADD course_id INT,
ADD FOREIGN KEY(course_id) REFERENCES course(course_id)



CREATE TABLE emergency (
emergency_id INT AUTO_INCREMENT,
course_id INT,
ta_id INT,
time DATETIME,
solved BOOLEAN,
PRIMARY KEY(emergency_id),
FOREIGN KEY(course_id) REFERENCES course(course_id),
FOREIGN KEY(ta_id) REFERENCES user(user_id)
)ENGINE = innodb;

CREATE TABLE finalized_OHschedule(
schedule_id INT,
ta_id INT,
FOREIGN KEY(schedule_id) REFERENCES schedule(schedule_id),
FOREIGN KEY(ta_id) REFERENCES user(user_id)
)ENGINE = innodb;

CREATE TABLE social_media(
id INT AUTO_INCREMENT,
user_id INT,
application VARCHAR(256),
link VARCHAR(256),
PRIMARY KEY(id),
FOREIGN KEY(user_id) REFERENCES user(user_id)
)ENGINE = innodb;

CREATE TABLE profile_photo(
id INT AUTO_INCREMENT,
user_id INT,
file_name VARCHAR(256),
PRIMARY KEY(id),
FOREIGN KEY(user_id) REFERENCES user(user_id)
)ENGINE = innodb;

CREATE TABLE review_session (
id INT AUTO_INCREMENT,
course_id INT,
title VARCHAR(256),
description VARCHAR(250),
weekday VARCHAR(256),
timeslot TIME,
status VARCHAR(10),
PRIMARY KEY(id),
FOREIGN KEY(course_id) REFERENCES courses(course_id),
)ENGINE = innodb;

CREATE TABLE review_session_poll (
id INT,
student_id INT, 
FOREIGN KEY(id) REFERENCES review_session(id),
FOREIGN KEY(student_id) REFERENCES user(user_id)
)ENGINE = innodb;

CREATE TABLE forum (
post_id INT AUTO_INCREMENT,
user_id INT,
course_id INT,
message text,
date datetime,
PRIMARY KEY(post_id),
FOREIGN KEY(user_id) REFERENCES user(user_id),
FOREIGN KEY(course_id) REFERENCES course(course_id)
)ENGINE = innodb;

CREATE TABLE forum_topic (
topic_id INT AUTO_INCREMENT,
topic_name VARCHAR(256),
PRIMARY KEY(topic_id)
)ENGINE = innodb;

ALTER TABLE forum 
ADD topic_id INT,
ADD FOREIGN KEY(topic_id) REFERENCES forum_topic(topic_id);


/*Weak Entity*/

CREATE TABLE enrollment_details (
role VARCHAR(20),
user_id INT,
course_id INT,
semester_id INT,
FOREIGN KEY(user_id) REFERENCES user(user_id),
FOREIGN KEY(course_id) REFERENCES course(course_id),
FOREIGN KEY(semester_id) REFERENCES semester(semester_id)
)ENGINE = innodb;


CREATE TABLE ta_availability (
schedule_id INT,
user_id INT,
FOREIGN KEY (schedule_id) REFERENCES schedule(schedule_id);
FOREIGN KEY (user_id) REFERENCES user(user_id)
)ENGINE = innodb;

ALTER TABLE ta_availability
ADD course_id INT,
ADD FOREIGN KEY(course_id) REFERENCES course(course_id)


/*Insert Data*/
/* user  table insert data */
insert into user (user_id, fname, lname, email) values (1, 'Eolanda', 'Sneesbie', 'esneesbie0@iu.edu');
insert into user (user_id, fname, lname, email) values (2, 'Renie', 'Aaronson', 'raaronson1@iu.edu');
insert into user (user_id, fname, lname, email) values (3, 'Shaylynn', 'Cave', 'scave2@iu.edu');
insert into user (user_id, fname, lname, email) values (4, 'Dasha', 'Ricson', 'dricson3@iu.edu');
insert into user (user_id, fname, lname, email) values (5, 'Aldous', 'St. Ledger', 'astledger4@iu.edu');
insert into user (user_id, fname, lname, email) values (6, 'Willabella', 'Tooze', 'wtooze5@iu.edu');
insert into user (user_id, fname, lname, email) values (7, 'Leanor', 'Tudge', 'ltudge6@iu.edu');
insert into user (user_id, fname, lname, email) values (8, 'Rachele', 'Brendel', 'rbrendel7@iu.edu');
insert into user (user_id, fname, lname, email) values (9, 'Rosina', 'Chaff', 'rchaff8@iu.edu');
insert into user (user_id, fname, lname, email) values (10, 'Tad', 'Waddilove', 'twaddilove9@iu.edu');
insert into user (user_id, fname, lname, email) values (11, 'Sebastiano', 'Flewin', 'sflewin0@iu.edu');
insert into user (user_id, fname, lname, email) values (12, 'Liza', 'Hynes', 'lhynes1@iu.edu');
insert into user (user_id, fname, lname, email) values (13, 'Beau', 'Camerello', 'bcamerello2@iu.edu');
insert into user (user_id, fname, lname, email) values (14, 'Herminia', 'Weepers', 'hweepers3@iu.edu');
insert into user (user_id, fname, lname, email) values (15, 'Jourdan', 'McFater', 'jmcfater4@iu.edu');

/* course table insert data */
insert into course (course_id, name) values (1, 'INFO-I495');

/* semester table insert data */
insert into semester (semester_id, term, start_date, end_date) values (1, 'spring2021', '2021-01-19', '2021-05-08');



/* building table insert data */
insert into building (building_code, name, room, street, city, state, zip_code) values ('IF', 'Luddy Hall', 1001, '700 N Woodlawn Ave', 'Bloomington', 'IN', 47401);
insert into building (building_code, name, room, street, city, state, zip_code) values ('IW', 'Info West', 002, '901 E 10th St Informatics West', 'Bloomington', 'IN', 47401);

/* schedule table insert data */
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (1,1,1,'Monday','12:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (2,1,1,'Monday','13:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (3,1,1,'Monday','14:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (4,1,1,'Monday','15:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (5,1,1,'Monday','16:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (6,1,1,'Monday','17:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (7,1,1,'Monday','18:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (8,1,1,'Monday','19:00:00','IW');

insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (9,1,1,'Tuesday','12:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (10,1,1,'Tuesday','13:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (11,1,1,'Tuesday','14:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (12,1,1,'Tuesday','15:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (13,1,1,'Tuesday','16:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (14,1,1,'Tuesday','17:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (15,1,1,'Tuesday','18:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (16,1,1,'Tuesday','19:00:00','IW');

insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (17,1,1,'Wednesday','12:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (18,1,1,'Wednesday','13:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (19,1,1,'Wednesday','14:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (20,1,1,'Wednesday','15:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (21,1,1,'Wednesday','16:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (22,1,1,'Wednesday','17:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (23,1,1,'Wednesday','18:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (24,1,1,'Wednesday','19:00:00','IW');

insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (25,1,1,'Thursday','12:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (26,1,1,'Thursday','13:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (27,1,1,'Thursday','14:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (28,1,1,'Thursday','15:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (29,1,1,'Thursday','16:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (30,1,1,'Thursday','17:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (31,1,1,'Thursday','18:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (32,1,1,'Thursday','19:00:00','IW');

insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (33,1,1,'Friday','12:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (34,1,1,'Friday','13:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (35,1,1,'Friday','14:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (36,1,1,'Friday','15:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (37,1,1,'Friday','16:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (38,1,1,'Friday','17:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (39,1,1,'Friday','18:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (40,1,1,'Friday','19:00:00','IW');

/* emergency table insert data */
insert into emergency (emergency_id, course_id, ta_id, time) values (1,1,10,'2020-03-30 15:00:00');

/* appointment table insert data */
insert into appointment (appointment_id, ta_id, student_id, time, building_code) values (1,9,1,'2020-02-15 14:00:00','IW');
insert into appointment (appointment_id, ta_id, student_id, time, building_code) values (2,9,1,'2020-02-15 15:00:00','IW');
insert into appointment (appointment_id, ta_id, student_id, time, building_code) values (3,10,1,'2020-02-15 16:00:00','IF');
insert into appointment (appointment_id, ta_id, student_id, time, building_code) values (4,9,1,'2020-02-15 16:00:00','IW');

UPDATE appointment SET schedule_id = 3 WHERE appointment_id = 1;
UPDATE appointment SET schedule_id = 17 WHERE appointment_id = 2;
UPDATE appointment SET schedule_id = 11 WHERE appointment_id = 3;
UPDATE appointment SET schedule_id = 30 WHERE appointment_id = 4;

UPDATE appointment SET course_id = 1 WHERE appointment_id = 1;
UPDATE appointment SET course_id = 1 WHERE appointment_id = 2;
UPDATE appointment SET course_id = 1 WHERE appointment_id = 3;
UPDATE appointment SET course_id = 1 WHERE appointment_id = 4;


/* enrollment_details table insert data*/
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 1, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 2, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 3, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 4, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 5, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 6, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 7, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 8, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 9, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 10, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('student', 11, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('student', 12, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('student', 13, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('student', 14, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('student', 15, 1, 1);

/* ta_availability table insert data */
insert into ta_availability (schedule_id, user_id) values (1,2);
insert into ta_availability (schedule_id, user_id) values (1,7);
insert into ta_availability (schedule_id, user_id) values (2,1);
insert into ta_availability (schedule_id, user_id) values (2,6);
insert into ta_availability (schedule_id, user_id) values (3,4);
insert into ta_availability (schedule_id, user_id) values (3,9);
insert into ta_availability (schedule_id, user_id) values (4,9);
insert into ta_availability (schedule_id, user_id) values (4,3);
insert into ta_availability (schedule_id, user_id) values (5,5);
insert into ta_availability (schedule_id, user_id) values (5,10);
/* no availability */
insert into ta_availability (schedule_id, user_id) values (7,3);
insert into ta_availability (schedule_id, user_id) values (7,7);
insert into ta_availability (schedule_id, user_id) values (8,2);
insert into ta_availability (schedule_id, user_id) values (8,8);

insert into ta_availability (schedule_id, user_id) values (9,9);
insert into ta_availability (schedule_id, user_id) values (9,6);
insert into ta_availability (schedule_id, user_id) values (10,1);
insert into ta_availability (schedule_id, user_id) values (10,7);
insert into ta_availability (schedule_id, user_id) values (11,6);
insert into ta_availability (schedule_id, user_id) values (11,10);
insert into ta_availability (schedule_id, user_id) values (12,5);
insert into ta_availability (schedule_id, user_id) values (12,9);
insert into ta_availability (schedule_id, user_id) values (13,4);
insert into ta_availability (schedule_id, user_id) values (13,10);
insert into ta_availability (schedule_id, user_id) values (14,3);
insert into ta_availability (schedule_id, user_id) values (14,5);
insert into ta_availability (schedule_id, user_id) values (15,2);
insert into ta_availability (schedule_id, user_id) values (15,4);
insert into ta_availability (schedule_id, user_id) values (16,1);
insert into ta_availability (schedule_id, user_id) values (16,3);

insert into ta_availability (schedule_id, user_id) values (17,3);
insert into ta_availability (schedule_id, user_id) values (17,9);
insert into ta_availability (schedule_id, user_id) values (18,2);
insert into ta_availability (schedule_id, user_id) values (18,8);
insert into ta_availability (schedule_id, user_id) values (18,10);
insert into ta_availability (schedule_id, user_id) values (19,1);
insert into ta_availability (schedule_id, user_id) values (19,5);
insert into ta_availability (schedule_id, user_id) values (19,7);
insert into ta_availability (schedule_id, user_id) values (20,4);
insert into ta_availability (schedule_id, user_id) values (20,6);
/* no availability */
insert into ta_availability (schedule_id, user_id) values (22,2);
insert into ta_availability (schedule_id, user_id) values (22,8);
insert into ta_availability (schedule_id, user_id) values (23,1);
insert into ta_availability (schedule_id, user_id) values (23,5);
insert into ta_availability (schedule_id, user_id) values (23,7);
insert into ta_availability (schedule_id, user_id) values (24,4);
insert into ta_availability (schedule_id, user_id) values (24,6);

insert into ta_availability (schedule_id, user_id) values (25,4);
insert into ta_availability (schedule_id, user_id) values (25,10);
insert into ta_availability (schedule_id, user_id) values (26,3);
insert into ta_availability (schedule_id, user_id) values (26,5);
insert into ta_availability (schedule_id, user_id) values (27,2);
insert into ta_availability (schedule_id, user_id) values (28,2);
insert into ta_availability (schedule_id, user_id) values (29,1);
insert into ta_availability (schedule_id, user_id) values (30,1);
insert into ta_availability (schedule_id, user_id) values (30,7);
insert into ta_availability (schedule_id, user_id) values (30,9);
insert into ta_availability (schedule_id, user_id) values (31,6);
insert into ta_availability (schedule_id, user_id) values (31,8);
insert into ta_availability (schedule_id, user_id) values (31,10);
insert into ta_availability (schedule_id, user_id) values (32,5);
insert into ta_availability (schedule_id, user_id) values (32,6);
insert into ta_availability (schedule_id, user_id) values (32,9);

insert into ta_availability (schedule_id, user_id) values (33,5);
insert into ta_availability (schedule_id, user_id) values (33,6);
insert into ta_availability (schedule_id, user_id) values (34,4);
insert into ta_availability (schedule_id, user_id) values (34,3);
insert into ta_availability (schedule_id, user_id) values (34,7);
insert into ta_availability (schedule_id, user_id) values (35,3);
insert into ta_availability (schedule_id, user_id) values (35,4);
insert into ta_availability (schedule_id, user_id) values (35,8);
insert into ta_availability (schedule_id, user_id) values (36,2);
insert into ta_availability (schedule_id, user_id) values (36,8);
insert into ta_availability (schedule_id, user_id) values (37,1);
insert into ta_availability (schedule_id, user_id) values (37,7);
/*17:00 no availability*/
insert into ta_availability (schedule_id, user_id) values (39,8);
insert into ta_availability (schedule_id, user_id) values (39,9);
insert into ta_availability (schedule_id, user_id) values (39,10);
insert into ta_availability (schedule_id, user_id) values (40,8);
insert into ta_availability (schedule_id, user_id) values (40,10);

UPDATE ta_availability SET course_id = 1

=======
/*Create Table*/
CREATE TABLE user (
user_id INT AUTO_INCREMENT,
fname VARCHAR(256),
lname VARCHAR(256) NOT NULL,
email VARCHAR(256) NOT NULL,
PRIMARY KEY(user_id)
)ENGINE = innodb;


CREATE TABLE course (
course_id INT,
name VARCHAR(256) NOT NULL,
PRIMARY KEY(course_id)
)ENGINE = innodb;


CREATE TABLE semester (
semester_id INT AUTO_INCREMENT,
term VARCHAR(256) NOT NULL,
start_date DATE NOT NULL,
end_date DATE NOT NULL,
PRIMARY KEY(semester_id)
)ENGINE = innodb;


CREATE TABLE building (
building_code VARCHAR(256),
name VARCHAR(256) NOT NULL,
room INT NOT NULL,
street VARCHAR(256) NOT NULL,
city VARCHAR(256) NOT NULL,
state VARCHAR(256) NOT NULL,
zip_code INT NOT NULL,
PRIMARY KEY(building_code)
)ENGINE = innodb;


CREATE TABLE schedule (
schedule_id INT AUTO_INCREMENT,
course_id INT NOT NULL,
semester_id INT NOT NULL,
weekday VARCHAR(256) NOT NULL,
timeslot TIME NOT NULL,
building_code VARCHAR(256) NOT NULL
PRIMARY KEY(index),
FOREIGN KEY(course_id) REFERENCES courses(course_id),
FOREIGN KEY(semester_id) REFERENCES semester(semester_id),
FOREIGN KEY(building_code) REFERENCES building(building_code)
)ENGINE = innodb;


CREATE TABLE appointment (
appointment_id INT AUTO_INCREMENT,
ta_id INT NOT NULL,
student_id INT NOT NULL,
time DATETIME NOT NULL,
building_code VARCHAR(256) NOT NULL,
emergency_id INT,
check_in BOOLEAN,
PRIMARY KEY(appointment_id),
CONSTRAINT fk_student_id FOREIGN KEY(student_id) REFERENCES user(user_id),
CONSTRAINT fk_ta_id FOREIGN KEY(ta_id) REFERENCES user(user_id),
FOREIGN KEY(building_code) REFERENCES building(building_code),
FOREIGN KEY(emergency_id) REFERENCES emergency(emergency_id)
)ENGINE = innodb;

CREATE TABLE emergency (
emergency_id INT AUTO_INCREMENT,
course_id INT NOT NULL,
ta_id INT NOT NULL,
time DATETIME NOT NULL,
solved BOOLEAN,
PRIMARY KEY(emergency_id),
FOREIGN KEY(course_id) REFERENCES course(course_id),
FOREIGN KEY(ta_id) REFERENCES user(user_id)
)ENGINE = innodb;




/*Weak Entity*/

CREATE TABLE enrollment_details (
role VARCHAR(20) NOT NULL,
user_id INT NOT NULL,
course_id INT NOT NULL,
semester_id INT NOT NULL,
FOREIGN KEY(user_id) REFERENCES user(user_id),
FOREIGN KEY(course_id) REFERENCES course(course_id),
FOREIGN KEY(semester_id) REFERENCES semester(semester_id)
)ENGINE = innodb;


CREATE TABLE ta_availability (
schedule_id INT NOT NULL,
user_id INT NOT NULL,
FOREIGN KEY (schedule_id) REFERENCES schedule(schedule_id);
FOREIGN KEY (user_id) REFERENCES user(user_id)
)ENGINE = innodb;


/*Insert Data*/
/* user  table insert data */
insert into user (user_id, fname, lname, email) values (1, 'Eolanda', 'Sneesbie', 'esneesbie0@iu.edu');
insert into user (user_id, fname, lname, email) values (2, 'Renie', 'Aaronson', 'raaronson1@iu.edu');
insert into user (user_id, fname, lname, email) values (3, 'Shaylynn', 'Cave', 'scave2@iu.edu');
insert into user (user_id, fname, lname, email) values (4, 'Dasha', 'Ricson', 'dricson3@iu.edu');
insert into user (user_id, fname, lname, email) values (5, 'Aldous', 'St. Ledger', 'astledger4@iu.edu');
insert into user (user_id, fname, lname, email) values (6, 'Willabella', 'Tooze', 'wtooze5@iu.edu');
insert into user (user_id, fname, lname, email) values (7, 'Leanor', 'Tudge', 'ltudge6@iu.edu');
insert into user (user_id, fname, lname, email) values (8, 'Rachele', 'Brendel', 'rbrendel7@iu.edu');
insert into user (user_id, fname, lname, email) values (9, 'Rosina', 'Chaff', 'rchaff8@iu.edu');
insert into user (user_id, fname, lname, email) values (10, 'Tad', 'Waddilove', 'twaddilove9@iu.edu');
insert into user (user_id, fname, lname, email) values (11, 'Sebastiano', 'Flewin', 'sflewin0@iu.edu');
insert into user (user_id, fname, lname, email) values (12, 'Liza', 'Hynes', 'lhynes1@iu.edu');
insert into user (user_id, fname, lname, email) values (13, 'Beau', 'Camerello', 'bcamerello2@iu.edu');
insert into user (user_id, fname, lname, email) values (14, 'Herminia', 'Weepers', 'hweepers3@iu.edu');
insert into user (user_id, fname, lname, email) values (15, 'Jourdan', 'McFater', 'jmcfater4@iu.edu');

/* course table insert data */
insert into course (course_id, name) values (1, 'INFO-I495');

/* semester table insert data */
insert into semester (semester_id, term, start_date, end_date) values (1, 'spring2021', '2021-01-19', '2021-05-08');



/* building table insert data */
insert into building (building_code, name, room, street, city, state, zip_code) values ('IF', 'Luddy Hall', 1001, '700 N Woodlawn Ave', 'Bloomington', 'IN', 47401);
insert into building (building_code, name, room, street, city, state, zip_code) values ('IW', 'Info West', 002, '901 E 10th St Informatics West', 'Bloomington', 'IN', 47401);

/* schedule table insert data */
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (1,1,1,'Monday','12:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (2,1,1,'Monday','13:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (3,1,1,'Monday','14:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (4,1,1,'Monday','15:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (5,1,1,'Monday','16:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (6,1,1,'Monday','17:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (7,1,1,'Monday','18:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (8,1,1,'Monday','19:00:00','IW');

insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (9,1,1,'Tuesday','12:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (10,1,1,'Tuesday','13:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (11,1,1,'Tuesday','14:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (12,1,1,'Tuesday','15:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (13,1,1,'Tuesday','16:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (14,1,1,'Tuesday','17:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (15,1,1,'Tuesday','18:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (16,1,1,'Tuesday','19:00:00','IW');

insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (17,1,1,'Wednesday','12:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (18,1,1,'Wednesday','13:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (19,1,1,'Wednesday','14:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (20,1,1,'Wednesday','15:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (21,1,1,'Wednesday','16:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (22,1,1,'Wednesday','17:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (23,1,1,'Wednesday','18:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (24,1,1,'Wednesday','19:00:00','IW');

insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (25,1,1,'Thursday','12:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (26,1,1,'Thursday','13:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (27,1,1,'Thursday','14:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (28,1,1,'Thursday','15:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (29,1,1,'Thursday','16:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (30,1,1,'Thursday','17:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (31,1,1,'Thursday','18:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (32,1,1,'Thursday','19:00:00','IW');

insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (33,1,1,'Friday','12:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (34,1,1,'Friday','13:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (35,1,1,'Friday','14:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (36,1,1,'Friday','15:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (37,1,1,'Friday','16:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (38,1,1,'Friday','17:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (39,1,1,'Friday','18:00:00','IW');
insert into schedule (schedule_id,course_id,semester_id,weekday,timeslot,building_code) values (40,1,1,'Friday','19:00:00','IW');

/* emergency table insert data */
insert into emergency (emergency_id, course_id, ta_id, time) values (1,1,10,'2020-03-30 15:00:00');

/* appointment table insert data */
insert into appointment (appointment_id, ta_id, student_id, time, building_code) values (1,9,1,'2020-02-15 14:00:00','IW');
insert into appointment (appointment_id, ta_id, student_id, time, building_code) values (2,9,1,'2020-02-15 15:00:00','IW');
insert into appointment (appointment_id, ta_id, student_id, time, building_code) values (3,10,1,'2020-02-15 16:00:00','IF');
insert into appointment (appointment_id, ta_id, student_id, time, building_code) values (4,9,1,'2020-02-15 16:00:00','IW');

/* enrollment_details table insert data*/
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 1, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 2, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 3, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 4, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 5, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 6, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 7, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 8, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 9, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('ta', 10, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('student', 11, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('student', 12, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('student', 13, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('student', 14, 1, 1);
insert into enrollment_details (role, user_id, course_id, semester_id) values ('student', 15, 1, 1);

/* ta_availability table insert data */
insert into ta_availability (schedule_id, user_id) values (1,2);
insert into ta_availability (schedule_id, user_id) values (1,7);
insert into ta_availability (schedule_id, user_id) values (2,1);
insert into ta_availability (schedule_id, user_id) values (2,6);
insert into ta_availability (schedule_id, user_id) values (3,4);
insert into ta_availability (schedule_id, user_id) values (3,9);
insert into ta_availability (schedule_id, user_id) values (4,9);
insert into ta_availability (schedule_id, user_id) values (4,3);
insert into ta_availability (schedule_id, user_id) values (5,5);
insert into ta_availability (schedule_id, user_id) values (5,10);
/* no availability */
insert into ta_availability (schedule_id, user_id) values (7,3);
insert into ta_availability (schedule_id, user_id) values (7,7);
insert into ta_availability (schedule_id, user_id) values (8,2);
insert into ta_availability (schedule_id, user_id) values (8,8);

insert into ta_availability (schedule_id, user_id) values (9,9);
insert into ta_availability (schedule_id, user_id) values (9,6);
insert into ta_availability (schedule_id, user_id) values (10,1);
insert into ta_availability (schedule_id, user_id) values (10,7);
insert into ta_availability (schedule_id, user_id) values (11,6);
insert into ta_availability (schedule_id, user_id) values (11,10);
insert into ta_availability (schedule_id, user_id) values (12,5);
insert into ta_availability (schedule_id, user_id) values (12,9);
insert into ta_availability (schedule_id, user_id) values (13,4);
insert into ta_availability (schedule_id, user_id) values (13,10);
insert into ta_availability (schedule_id, user_id) values (14,3);
insert into ta_availability (schedule_id, user_id) values (14,5);
insert into ta_availability (schedule_id, user_id) values (15,2);
insert into ta_availability (schedule_id, user_id) values (15,4);
insert into ta_availability (schedule_id, user_id) values (16,1);
insert into ta_availability (schedule_id, user_id) values (16,3);

insert into ta_availability (schedule_id, user_id) values (17,3);
insert into ta_availability (schedule_id, user_id) values (17,9);
insert into ta_availability (schedule_id, user_id) values (18,2);
insert into ta_availability (schedule_id, user_id) values (18,8);
insert into ta_availability (schedule_id, user_id) values (18,10);
insert into ta_availability (schedule_id, user_id) values (19,1);
insert into ta_availability (schedule_id, user_id) values (19,5);
insert into ta_availability (schedule_id, user_id) values (19,7);
insert into ta_availability (schedule_id, user_id) values (20,4);
insert into ta_availability (schedule_id, user_id) values (20,6);
/* no availability */
insert into ta_availability (schedule_id, user_id) values (22,2);
insert into ta_availability (schedule_id, user_id) values (22,8);
insert into ta_availability (schedule_id, user_id) values (23,1);
insert into ta_availability (schedule_id, user_id) values (23,5);
insert into ta_availability (schedule_id, user_id) values (23,7);
insert into ta_availability (schedule_id, user_id) values (24,4);
insert into ta_availability (schedule_id, user_id) values (24,6);

insert into ta_availability (schedule_id, user_id) values (25,4);
insert into ta_availability (schedule_id, user_id) values (25,10);
insert into ta_availability (schedule_id, user_id) values (26,3);
insert into ta_availability (schedule_id, user_id) values (26,5);
insert into ta_availability (schedule_id, user_id) values (27,2);
insert into ta_availability (schedule_id, user_id) values (28,2);
insert into ta_availability (schedule_id, user_id) values (29,1);
insert into ta_availability (schedule_id, user_id) values (30,1);
insert into ta_availability (schedule_id, user_id) values (30,7);
insert into ta_availability (schedule_id, user_id) values (30,9);
insert into ta_availability (schedule_id, user_id) values (31,6);
insert into ta_availability (schedule_id, user_id) values (31,8);
insert into ta_availability (schedule_id, user_id) values (31,10);
insert into ta_availability (schedule_id, user_id) values (32,5);
insert into ta_availability (schedule_id, user_id) values (32,6);
insert into ta_availability (schedule_id, user_id) values (32,9);

insert into ta_availability (schedule_id, user_id) values (33,5);
insert into ta_availability (schedule_id, user_id) values (33,6);
insert into ta_availability (schedule_id, user_id) values (34,4);
insert into ta_availability (schedule_id, user_id) values (34,3);
insert into ta_availability (schedule_id, user_id) values (34,7);
insert into ta_availability (schedule_id, user_id) values (35,3);
insert into ta_availability (schedule_id, user_id) values (35,4);
insert into ta_availability (schedule_id, user_id) values (35,8);
insert into ta_availability (schedule_id, user_id) values (36,2);
insert into ta_availability (schedule_id, user_id) values (36,8);
insert into ta_availability (schedule_id, user_id) values (37,1);
insert into ta_availability (schedule_id, user_id) values (37,7);
/*17:00 no availability*/
insert into ta_availability (schedule_id, user_id) values (39,8);
insert into ta_availability (schedule_id, user_id) values (39,9);
insert into ta_availability (schedule_id, user_id) values (39,10);
insert into ta_availability (schedule_id, user_id) values (40,8);
insert into ta_availability (schedule_id, user_id) values (40,10);

/* social_media table insert data*/
insert into social_media (user_id, application,link) values (1,"Twitter","https://twitter.com/IULuddy");
insert into social_media (user_id, application,link) values (1,"Facebook","https://www.facebook.com/IULuddy/");
insert into social_media (user_id, application,link) values (1,"Linkedin","https://www.linkedin.com/company/iuluddy/");
insert into social_media (user_id, application,link) values (1,"Github","https://github.com/indiana-university");







