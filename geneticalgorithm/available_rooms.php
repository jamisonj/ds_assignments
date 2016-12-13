<?php

	class AvailableSlots {

		public $open_rooms = array();

		function populate_slots($filename, $mode) {

			//TODO: Add some validation/exception handling.

			// Iterate over the CSV file and create a Room object for each room.
			if ($mode == 'r') {

				$handle = fopen($filename, $mode);

				if ($handle !== FALSE) {

					$row = 0;
					
					while (($data = fgetcsv($handle, 20, ",")) !== FALSE) {

						$room = new Room($data[0], $data[1], $data[2]);
						$this->open_rooms[$row] = $room;
						$row++;
					}

					fclose($handle);
				}
			}

			return $this->open_rooms;
		}

		function remove_slot() {

		}
	}
?>