<?php

	include 'room.php';

	// Iterate over the CSV file and create an AvailableSlots object for each room.
	$row = 0;

	echo '<pre>';

	$open_rooms = array();

	if (($handle = fopen("rooms.csv", "r")) !== FALSE) {
		
		while (($data = fgetcsv($handle, 20, ",")) !== FALSE) {

			if ($row > 0) {
				$room = new Room($data[0], $data[1], $data[2]);
				$open_rooms[$row] = $room;
				echo $room->room . PHP_EOL;
			}

			$row++;
		}

		fclose($handle);
	}

	array_shift($open_rooms);
	print_r($open_rooms);

	echo '</pre>';
?>