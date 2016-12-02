--Will Davies
--Matt Garner
--CS340 - Database Project - SQL Queries



-- CREATE TABLES

CREATE TABLE `day` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`exact_date` date NOT NULL,
`day_of_week` varchar(255),
PRIMARY KEY (`id`),
UNIQUE KEY (`exact_date`)

)ENGINE=InnoDB;


CREATE TABLE `workout` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`did` int(11) NOT NULL,
`name` varchar(255) NOT NULL,
`total_time_in_min` int(11),
`time_of_day` varchar(255),
PRIMARY KEY (`id`),
FOREIGN KEY (`did`) REFERENCES `day` (`id`)
)ENGINE=InnoDB;


CREATE TABLE `exercise` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`exercise_name` varchar(255) NOT NULL,
`exercise_type` varchar(255) NOT NULL, -- cardio or weight training
`resistance` varchar(255),             -- yes/no for cardio resistance
`push_pull` varchar(255),              -- push or pull for weight training
`compound_isolation` varchar(255),     -- compound or isolation for weight training
PRIMARY KEY(`id`)

)ENGINE=InnoDB;

CREATE TABLE `muscle_groups` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`group_name` varchar(255) NOT NULL,
`included_muscles` varchar(355),
PRIMARY KEY(`id`)

)ENGINE=InnoDB;

CREATE TABLE `workout_exercise` (
`w_id` int(11) NOT NULL,
`e_id` int(11) NOT NULL,
PRIMARY KEY(`w_id`,`e_id`),
FOREIGN KEY (`w_id`) REFERENCES `workout` (`id`),
FOREIGN KEY (`e_id`) REFERENCES `exercise` (`id`)
)ENGINE=InnoDB;

CREATE TABLE `exercise_muscle_groups` (
`e_id` int(11) NOT NULL,
`mg_id` int(11) NOT NULL,
PRIMARY KEY(`e_id`,`mg_id`),
FOREIGN KEY (`e_id`) REFERENCES `exercise` (`id`),
FOREIGN KEY (`mg_id`) REFERENCES `muscle_groups` (`id`)

)ENGINE=InnoDB



-- POPULATE TABLES


INSERT INTO `muscle_groups` (group_name, included_muscles) VALUES ('chest','pectorals'),('legs','Hamstring, calves, quads, glutes'), ('arms', 'Triceps, Biceps, Forearms, Deltoids'), ('back', 'Traps, erector, lats'), ('abs', 'Abdominals, obliques');


INSERT INTO `exercise` (exercise_name, exercise_type, resistance, push_pull, compound_isolation) VALUES ('bench press','weight training', ' ', 'push', 'compound'), ('curls','weight training', ' ', 'pull', 'isolation');


INSERT INTO `exercise_muscle_groups` (e_id, mg_id) VALUES
((SELECT id from exercise where exercise_name = 'bench press'), (SELECT id from muscle_groups where group_name='chest')),
((SELECT id from exercise where exercise_name='bench press'), (SELECT id from muscle_groups where group_name='back')),
((SELECT id from exercise where exercise_name='bench press'), (SELECT id from muscle_groups where group_name='arms')),
((SELECT id from exercise where exercise_name='curls'), (SELECT id from muscle_groups where group_name='arms'));


INSERT INTO `day` (exact_date, day_of_week) VALUES 
('2016-11-07', 'Monday'), ('2016-11-07', 'Tuesday'), ('2016-11-09', 'Wednesday');


INSERT INTO `workout` (did, total_time_in_min, time_of_day) VALUES ((SELECT id from day WHERE exact_date='2016-11-07'), 60, 'morning'), ((SELECT id from day WHERE exact_date='2016-11-08'), 60, 'morning'), ((SELECT id from day WHERE exact_date='2016-11-09'), 90, 'afternoon');



INSERT INTO `workout_exercise` (w_id, e_id) VALUES
((SELECT id from workout where did = (SELECT id from `day` where exact_date = '2016-11-07')), (SELECT id from exercise where exercise_name='bench press'));


-- Have brackets to represent user choice.

--INSERT INTO `workout_exercise` (w_id, e_id) VALUES
--((SELECT id from workout where did = (SELECT id from `day` where exact_date = [date])), (SELECT id from exercise where exercise_name=[exerciseName]));



--SELECT INFORMATION


--All muscle groups worked on a certain date
SELECT mg.group_name FROM muscle_groups mg
INNER JOIN excercise_muscle_groups emg ON emg.mg_id = mg.id
INNER JOIN exercise e ON e.id=emg.e_id
INNER JOIN workout_exercise we ON we.e_id = e.id
INNER JOIN workout w ON w.id = we.w_id
INNER JOIN day d on d.id = w.did
WHERE d.exact_date = '2016-11-07';

-- WHERE d.exact_date = [user_requested_date];
