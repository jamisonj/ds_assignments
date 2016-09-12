<?php

// An array implementation that holds arbitrary objects.
class myArray {

	protected $items;
	protected $initial_size;
	protected $chunk_size;
	
	// Creates an array with an intial size.
	function __construct($initial_size = 10, $chunk_size = 5) {
		// Create an empty array
		$this->items = array();
		$this->initial_size = $initial_size;
		$this->chunk_size = $chunk_size;

		$this->items = array_fill(0, $this->initial_size, 'none');

		// print_r($this->items);
	}

	// Prints a representation of the entire allocated space, including unused spots.
	function debug_print() {

	}

	// Ensures the index is within the bounds of the array: 0 <= index <= size.
	private function check_bounds($index) {

	}

	// Checks whether the array is full and needs to increase by chunk size in preparation for adding an item to the array.
	private function check_increase() {
		$index = array_search('none', $this->items);

		// If 'none' is found in the array...
		if ($index !== false) {
			return $index;
		}

		else {
			return true;
		}
	}

	// Checks whether the array has too many empty spots and can be decreased by chunk size. If a decrease is warranted, it should be done by allocating a new array and copying thedata into it (don't allocate multiple arrays if multiple chunks need decreasing).
	private function check_decrease() {

	}

	// Adds an item to the end of the array, allocating a larger array if necessary.
	function add($item) {

		$index = $this->check_increase();

		// print_r($this->items);

		// If 'none' is found in the array...
		if ($index !== true) {
			echo "<p>'None' WAS found in the array!</p>";

			// Replace the first 'none' with the added value.
			$this->items[$index] = $item;

			echo '<p>Items (after adding new item):</p>';
			print_r($this->items);
		}

		// If 'none' is not found in the array...
		else {
			echo "<p>'None' was NOT found in the array!</p>";

			// Use the $chunk_size to add that many spaces to the array...
			$alloc_array = alloc($this->chunk_size);

			echo '<p>None: </p>';
			print_r($alloc_array);

			// Merges arrays together.
			$this->items = array_merge($this->items, $alloc_array);

			echo '<p>Items: </p>';
			print_r($this->items);

			// ...then call our function again.
			$this->add($item);
		}
	}

	// Inserts an item at the given index, shifting remaining items right and allocating a larger array if necessary.
	function insert($index, $item) {

		$keys = array_keys($this->items, 'none');

		echo 'Keys: <br>';
		print_r($keys);

		// If the $index is in the array of "none" keys.
		if (in_array($index, $keys)) {
			throw new Exception('Error: Cannot insert at specified index. Range out of bounds.');
		}

		else {
			// Copy the shifted items to another array.
			$copy = array_splice($this->items, $index);

			echo '<p>Array_splice: $this:</p>';
			print_r($this->items);
			echo '<p>Array_splice: $copy:</p>';
			print_r($copy);

			// $mem_loc = $this->check_increase();

			// // If no space is allocated...
			// if ($mem_loc == true) {
			// 	$alloc_array = alloc($this->chunk_size);

			// 	$this->items = array_merge($this->items, $alloc_array);
				
			// 	echo '<p>Array_splice: $this:</p>';
			// 	print_r($this->items);
			// }

			// Insert the new value into $this->items.
			$this->items[$index] = $item;

			echo '<p>Array_splice: $this:</p>';
			print_r($this->items);

			foreach($copy as $item) {
				echo '<p>Item copied: ' . $item . '</p>';

				// // If the value of item is 'none', we remove it from the copy.
				// if ($item)

				$this->add($item);
			}

			// for ($i = 0; $i <= $index; $i++) {
			// 	array_push();
			// }
		}
	}

	// Sets the given item at the given index.  Throws an exception if the index is not within the bounds of the array.
	function set($index, $item) {
		$key = array_search('none', $this->items);

		if ($this->items[$index] == 'none') {
			throw new Exception('Error: Index is not within the bounds of the array. Index: ' . $index . ', Item: ' . $item . '.');
		}

		else {
			$this->items[$index] = $item;

			echo '<p>Set(): $this:</p>';
			print_r($this->items);
		}
	}

	// Retrieves the item at the given index.  Throws an exception if the index is not within the bounds of the array.
	function get($index) {
		if ($this->items[$index] == 'none') {
			throw new Exception('Error: Index is not within the bounds of the array. Index: ' . $index . '.');
		}

		else {
			return $this->items[$index];
		}
	}

	// Deletes the item at the given index, decreasing the allocated memory if needed. Throws an exception if the index is not within the bounds of the array.
	function delete($index) {
		if ($this->items[$index] == 'none') {
			throw new Exception('Error: Index is not within the bounds of the array. Index: ' . $index . '.');
		}

		else {
			// Copy the shifted items to another array.
			$copy = array_splice($this->items, $index + 1);

			echo '<p>Delete: $this:</p>';
			print_r($this->items);
			echo '<p>Delete: $copy:</p>';
			print_r($copy);

			// If the next value is NOT 'none', then we append the copy onto the array.
			if ($copy[0] !== 'none') {

				// Add a space to copy, to replace the lost one.
				array_push($copy, 'none');

				// Remove the last item from $this->items, and replace it with $copy.
				array_splice($this->items, $index, 1, $copy);

				// If we have more than 5 "none" spaces, remove them.
				$keys = array_keys($this->items, 'none');

				if (count($keys) > 5) {
					$output = array_splice($this->items, -5);
					echo '<p>Delete: Splice: </p>';
					print_r($output);
				}

				echo '<p>Delete:</p>';
				print_r($this->items);
			}

			// If there are already no 'none' values, then replace the single value we are deleting with 'none'.
			else {
				$this->items[$index] = 'none';
				echo '<p>Delete:</p>';
				print_r($this->items);
			}
		}
	}

	// Swaps the values at the given indices.
	function swap($index1, $index2) {

	}
}

/* Utilities */

// Allocates array space in memory. This is similar to C's alloc function.
function alloc($size) {
	$items = array();

	// Use the $chunk_size to add that many spaces to the array...
	for ($i = 0; $i < $size; $i++) {
		array_push($items, "none");
	}

	return $items;
}

// Copies items from one array to another.  This is similar to C's memcpy function.
function memcpy($dest, $source, $size) {

}
        
?>