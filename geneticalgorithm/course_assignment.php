<?php

	class CourseAssignment {

		public $schedule;
		public $course;
		public $rooms;

		function __construct($course, $rooms) {
			$this->course = $course;
			$this->rooms = $rooms;

			
			// Add 15 minutes (0.25) to each course.
			$course->hours += 0.25;

			// Do this for each section of the course.
			for ($i = 0; $i < $course->sections; $i++) {
				
				// Check the capacity constraint.
				$eligible_rooms = array();

				foreach ($rooms as $room) {

					if ($room->capacity >= $course->num_students) {
						array_push($eligible_rooms, $room);
					}
				}

				echo $course->name . PHP_EOL;
				echo $course->hours . PHP_EOL;

				foreach ($eligible_rooms as $eligible_room) {
					// echo $eligible_room->room . PHP_EOL;
					// print_r($eligible_room);
				}		

				// Pick a room randomly.
				$room_key = array_rand($eligible_rooms);

				echo 'Random room: ' . $eligible_rooms[$room_key]->room . PHP_EOL;

				// Pick a timeslot that is available on all of the eligible days.
				$valid_days = $course->get_days();
				print_r($valid_days);
				
				$timeslot_key = array_rand($eligible_rooms[$room_key]->schedule[$valid_days[0]]);

				// Check the course length constraint (course cannot run past 5 pm). The timeslot key must be at least [course duration] less than 18.
				while ($timeslot_key > 18 - ($course->hours * 2)) {
					$timeslot_key = array_rand($eligible_rooms[$room_key]->schedule[$valid_days[0]]);
				}

				echo 'Random Timeslot: ' . $eligible_rooms[$room_key]->schedule[$valid_days[0]][$timeslot_key] . ' on ' . $valid_days[0] . PHP_EOL;

				echo 'timeslot_key: ' . $timeslot_key . PHP_EOL;

				// print_r($courses);
			}

			

			
		}

		// Calculates the fitness function for the current time slot.
		function getFitness() {

		}

		// Crosses with another solution and returns a new solution.
		function crossover($other) {

		}
		
		// Mutates the solution in some way.
		function mutate() {

		}
	}
?>