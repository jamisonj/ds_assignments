<?php

	class CourseAssignment {

		public $schedule;
		public $course;
		public $room;

		function createAssignment($course, $rooms) {
			
			// Add 15 minutes (0.25) to each course.
			$course->hours += 0.25;

			// Get the class length.
			$num_slots = round($course->hours * 2); // Rounds to whole slots.

			// Do this for each section of the course.s
			for ($i = 0; $i < $course->sections; $i++) {
				
				// Temporary array of rooms to check the capacity constraint.
				$eligible_rooms = array();

				foreach ($rooms as $room) {

					if ($room->capacity >= $course->num_students) {
						array_push($eligible_rooms, $room);
					}
				}

				echo $course->name . PHP_EOL;
				echo $course->hours . PHP_EOL;
				echo 'Section: ' . $i . PHP_EOL;
				echo 'num_slots = ' . $num_slots . PHP_EOL;

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


				// Check if the first day has times available. If not, then return without scheduling.
				if (empty($eligible_rooms[$room_key]->schedule[$valid_days[0]])) {
					echo "Course could not be scheduled." . PHP_EOL;
					echo PHP_EOL;
					return;
				}

				else {

					// Get an initial $timeslot_key to test with.
					$timeslot_key = array_rand($eligible_rooms[$room_key]->schedule[$valid_days[0]]);

					$counter = 0;

					// Check the course length constraint (course cannot run past 5 pm). The initial timeslot key must be at least [course duration] less than 18.
					while ($timeslot_key > 18 - ($course->hours * 2)) {

						for ($k = 0; $k < $num_slots; $k++) {
							if (!(array_key_exists($timeslot_key + $k, $eligible_rooms[$room_key]->schedule[$valid_days[0]]))) {
								break; // Break out and create a new $timeslot_key.
							}
						}
						
						$timeslot_key = array_rand($eligible_rooms[$room_key]->schedule[$valid_days[0]]);

						// If we loop too many times trying to get a new timeslot_key, we could get an infinite loop.
						if ($counter > 25) {
							echo "Course could not be scheduled." . PHP_EOL;
							echo PHP_EOL;
							return;
						}

						$counter++;
					}

					// If there are two days...
					if (count($valid_days) > 1) {

						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][0]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][1]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][2]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][3]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][4]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][5]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][6]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][7]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][8]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][9]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][10]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][11]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][12]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][13]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][14]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][15]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][16]);
						// unset($eligible_rooms[$room_key]->schedule[$valid_days[1]][17]);
						
						if (empty($eligible_rooms[$room_key]->schedule[$valid_days[1]])) {
							echo "Course could not be scheduled." . PHP_EOL;
							echo PHP_EOL;
							return;
						}

						else {

							$counter = 0;

							// Reassign the $time_slot key as many times as necessary until we get a valid timeslot.
							while (!(array_key_exists($timeslot_key, $eligible_rooms[$room_key]->schedule[$valid_days[1]])) || $timeslot_key > 18 - ($course->hours * 2)) {

								for ($k = 0; $k < $num_slots; $k++) {
									if (!(array_key_exists($timeslot_key + $k, $eligible_rooms[$room_key]->schedule[$valid_days[0]]))) {
										break; // Break out and create a new $timeslot_key.
									}
								}

								$timeslot_key = array_rand($eligible_rooms[$room_key]->schedule[$valid_days[0]]);

								// echo 'Random Timeslot: ' . $eligible_rooms[$room_key]->schedule[$valid_days[0]][$timeslot_key] . ' on ' . $valid_days[0] . PHP_EOL;

								echo 'timeslot_key: ' . $timeslot_key . PHP_EOL;

								// If we loop too many times trying to get a new timeslot_key, we could get an infinite loop.
								if ($counter > 25) {
									echo "Course could not be scheduled." . PHP_EOL;
									echo PHP_EOL;
									return;
								}

								$counter++;
							}

							echo "Key " . $timeslot_key . " exists in array on " . $valid_days[1] . PHP_EOL;
						}
					}

					echo 'Random Timeslot: ' . $eligible_rooms[$room_key]->schedule[$valid_days[0]][$timeslot_key] . ' on ' . $valid_days[0] . PHP_EOL;

					echo 'timeslot_key: ' . $timeslot_key . PHP_EOL;

					foreach ($valid_days as $day) {

						for ($j = 0; $j < $num_slots; $j++) {
							// Remove the timeslots from the schedule.
							$slot_key = $timeslot_key + $j;
							unset($eligible_rooms[$room_key]->schedule[$day][$slot_key]);
						}
					}

					print_r($eligible_rooms[$room_key]->schedule);
				}

				echo PHP_EOL;

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