<?php

	include 'room.php';
	include 'course.php';
	include 'course_assignment.php';
	include 'solution.php';

	echo '<pre>';

	// Iterate over the CSV file and create a Room object for each room.
	$open_rooms = array();

	if (($handle = fopen("rooms.csv", "r")) !== FALSE) {

		$row = 0;
		
		while (($data = fgetcsv($handle, 20, ",")) !== FALSE) {

			$room = new Room($data[0], $data[1], $data[2]);
			$open_rooms[$row] = $room;
			$row++;
		}

		fclose($handle);
	}

	array_shift($open_rooms);
	// print_r($open_rooms);

	// Iterate over the CSV file and create a Course object for each class.
	$courses = array();

	if (($handle = fopen("classes.csv", "r")) !== FALSE) {

		$row = 0;
		
		while (($data = fgetcsv($handle, 150, ",")) !== FALSE) {

			$days = array(
				'monday' => $data[1], 
				'tuesday' => $data[2], 
				'wednesday' => $data[3], 
				'thursday' => $data[4], 
				'friday' => $data[5]
				);

			$course = new Course($data[0], $days, $data[6], $data[7], $data[8], $data[9], $data[10]);
			$courses[$row] = $course;
			$row++;
		}

		fclose($handle);
	}

	array_shift($courses);
	// print_r($courses);

	foreach($courses as $course) {
		$course_assignment = new CourseAssignment();
		$course_assignment->createAssignment($course, $open_rooms);
	}

	foreach($open_rooms as $room) {
		echo 'Room: ' . $room->room . PHP_EOL;
		print_r($room->schedule);
	}

	echo '</pre>';
?>