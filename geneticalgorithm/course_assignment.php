<?php

	class CourseAssignment {

		public $schedule;
		public $course;
		public $room;

		function createAssignment($course, $rooms) {

			$output = '';
			
			// Add 15 minutes (0.25) to each course.
			$course->hours += 0.25;

			// Get the class length.
			$num_slots = round($course->hours * 2); // Rounds to whole slots.

			// Do this for each section of the course.
			for ($i = 0; $i < $course->sections; $i++) {
				
				// Temporary array of rooms to check the capacity constraint.
				$eligible_rooms = array();

				foreach ($rooms as $room) {

					if ($room->capacity >= $course->num_students) {
						array_push($eligible_rooms, $room);
					}
				}

				$output .= $course->name . PHP_EOL;
				$output .= 'Hours: ' . $course->hours . PHP_EOL;
				$output .= 'Section: ' . ($i + 1) . PHP_EOL;
				$output .= 'num_slots: ' . $num_slots . PHP_EOL;
				// echo $course->name . PHP_EOL;
				// echo 'Hours: ' . $course->hours . PHP_EOL;
				// echo 'Section: ' . ($i + 1) . PHP_EOL;
				// echo 'num_slots: ' . $num_slots . PHP_EOL;

				// Pick a room randomly.
				$room_key = array_rand($eligible_rooms);

				$output .= 'Random room: ' . $eligible_rooms[$room_key]->room . PHP_EOL;
				// echo 'Random room: ' . $eligible_rooms[$room_key]->room . PHP_EOL;

				// Pick a timeslot that is available on all of the eligible days.
				$valid_days = $course->get_days();
				
				$output .= 'Valid Days: ';

				foreach ($valid_days as $day) {
					$output .= $day . ' ';					
				}

				$output .= PHP_EOL;
				// echo 'Valid Days ';
				// $output .= print_r($valid_days);

				$common_schedules = $eligible_rooms[$room_key]->getAvailableTimeSlots($valid_days);

				// Check if the combined schedule has times available. If not, then return without scheduling.
				if (empty($common_schedules)) {
					
					$output .= "Course could not be scheduled." . PHP_EOL . PHP_EOL;
					// echo "Course could not be scheduled." . PHP_EOL;
					// echo PHP_EOL;
					return;
				}

				else {

					// Get an initial $timeslot_key to test with.
					$timeslot_key = array_rand($common_schedules);

					$output .= 'Starting timeslot_key: ' . $timeslot_key . PHP_EOL;
					// echo 'Starting timeslot_key: ' . $timeslot_key . PHP_EOL;

					$counter = 0;

					// Check the course length constraint (course cannot run past 5 pm). The initial timeslot key must be at least [course duration] less than 18.
					while ($timeslot_key > 18 - ($course->hours * 2)) {

						$timeslot_key = array_rand($common_schedules);

						$output .= 'timeslot_key reassigned: ' . $timeslot_key . PHP_EOL;
						// echo 'timeslot_key reassigned: ' . $timeslot_key . PHP_EOL;

						// If we loop too many times trying to get a new timeslot_key, we could get an infinite loop.
						if ($counter > 25) {
							
							$output .= "Course could not be scheduled." . PHP_EOL . PHP_EOL;
							// echo "Course could not be scheduled." . PHP_EOL;
							// echo PHP_EOL;
							return;
						}

						$counter++;
					}

					$counter = 0;

					// Check the adjacent slots constraint.
					for ($k = 0; $k < $num_slots; $k++) {
						
						if (!(array_key_exists(($timeslot_key + $k), $common_schedules))) {
							
							$output .= "Key " . ($timeslot_key + $k) . " did not exist." . PHP_EOL;
							// echo "Key " . ($timeslot_key + $k) . " did not exist." . PHP_EOL;
							
							$timeslot_key = array_rand($common_schedules);

							$output .= 'timeslot_key reassigned: ' . $timeslot_key . PHP_EOL;
							// echo 'timeslot_key reassigned: ' . $timeslot_key . PHP_EOL;

							$k = 0;
						}

						// If we loop too many times trying to get a new timeslot_key, we could get an infinite loop.
						if ($counter > 25) {

							$output .= "Course could not be scheduled." . PHP_EOL . PHP_EOL;
							// echo "Course could not be scheduled." . PHP_EOL;
							// echo PHP_EOL;
							return;
						}

						$counter++;
					}
					
					$output .= 'Final Assigned Timeslot: ' . $eligible_rooms[$room_key]->schedule[$valid_days[0]][$timeslot_key] . ' on ' . $valid_days[0] . PHP_EOL;
					// echo 'Final Assigned Timeslot: ' . $eligible_rooms[$room_key]->schedule[$valid_days[0]][$timeslot_key] . ' on ' . $valid_days[0] . PHP_EOL;

					foreach ($valid_days as $day) {

						for ($j = 0; $j < $num_slots; $j++) {
							
							// Remove the timeslots from the schedule.
							$slot_key = $timeslot_key + $j;
							unset($eligible_rooms[$room_key]->schedule[$day][$slot_key]);
						}
					}

					// See the available slots disappear after each course is scheduled.
					// print_r($eligible_rooms[$room_key]->schedule);
				}

				$output .= PHP_EOL;
				// echo PHP_EOL;

				// print_r($courses);
			}

			return $output;
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