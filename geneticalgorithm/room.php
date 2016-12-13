<?php 
	class Room {

		public $room;
		public $capacity;
		public $type;
		public $schedule;

		function __construct($room, $capacity, $type) {

			$this->room = $room;
			$this->capacity = $capacity;
			$this->type = $type;

			$this->schedule = array();
			$days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday');

			foreach ($days as $day) {
				$this->schedule[$day] = array (
					'8:00',
					'8:30',
					'9:00',
					'9:30',
					'10:00',
					'10:30',
					'11:00',
					'11:30',
					'12:00',
					'12:30',
					'1:00',
					'1:30',
					'2:00',
					'2:30',
					'3:00',
					'3:30',
					'4:00',
					'4:30'
					); 
			}
		}

		function getSchedule() {
			return $this->schedule;
		}

		// Returns the timeslots both days have in common.
		function getAvailableTimeSlots($valid_days) {
			
			$result = $this->schedule[$valid_days[0]];

			if (count($valid_days) > 1) {

				$count = 0;

				foreach ($valid_days as $day) {
					$result = array_intersect($result, $this->schedule[$valid_days[$count]]);
					$count++;
				}
			}

			// Combined schedule.
			// print_r($result);

			return $result;
		}

		// Calculates the fitness function for the current time slot.
		function getFitness() {

		}

	}
?>