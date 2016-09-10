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

	// Checks whether the array has too many empty spots and can be decreased by chunk size.If a decrease is warranted, it should be done by allocating a new array and copying thedata into it (don't allocate multiple arrays if multiple chunks need decreasing).
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

			$this->add($item);
		}

		// for ($i = 0; $i <= $index; $i++) {
		// 	array_push();
		// }
	}

	// Sets the given item at the given index.  Throws an exception if the index is not within the bounds of the array.
	function set($index, $item) {

	}

	// Retrieves the item at the given index.  Throws an exception if the index is not within the bounds of the array.
	function get($index) {

	}

	// Deletes the item at the given index, decreasing the allocated memory if needed. Throws an exception if the index is not within the bounds of the array.
	function delete() {

	}

	// Swaps the values at the given indices.
	function swap($index1, $index2) {

	}
}

/* Utilities */

// Allocates array space in memory. This is similar to C's alloc function.
function alloc($size) {
	// TODO: Move the functionality for adding more memory to the alloc() helper function.

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