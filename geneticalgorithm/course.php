<?php 
	class Course {

		public $name;
		public $days = array();
		public $sections;
		public $hours;
		public $pref_time;
		public $pref_room_type;
		public $num_students;

		function __construct($name, $days, $sections, $hours, $pref_time, $pref_room_type, $num_students) {

			$this->name = $name;
			$this->days = $days;
			$this->sections = $sections;
			$this->hours = $hours;
			$this->pref_time = $pref_time;
			$this->pref_room_type = $pref_room_type;
			$this->num_students = $num_students;
		}

		function get_days() {

			$return_array = array();

			foreach ($this->days as $day => $value) {
				
				if ($value == 'x') {
					array_push($return_array, $day);
				}
			}

			return $return_array;
		}

		// Calculates the fitness function for the current time slot.
		function getFitness() {

		}

	}
?>