<?php

// An array implementation that holds arbitrary objects.
class myArray {

	protected $items;
	protected $initial_size;
	protected $chunk_size;
	protected $current_size;
	
	// Creates an array with an intial size.
	function __construct($initial_size = 10, $chunk_size = 5) {
		// Create an empty array
		$this->items = array();
		$this->initial_size = $initial_size;
		$this->chunk_size = $chunk_size;
		$this->current_size = 0;

		$this->items = array_fill(0, $this->initial_size, 'none');
	}

	// Prints a representation of the entire allocated space, including unused spots.
	function debug_print() {
		
		$value = $this->current_size . ' of ' . $this->initial_size . ' >>>';
		$output = '';

		foreach ($this->items as $item) {
			$output = $output . ' '. $item . ',';
		}

		// Remove the last comma.
		$output = rtrim($output, ',');
		$value .= $output;
		return $value;
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

	// Adds an item to the end of the array, allocating a larger array if necessary.
	function add($item) {
		$index = $this->check_increase();

		// If 'none' is found in the array...
		if ($index !== true) {

			// Replace the first 'none' with the added value.
			$this->items[$index] = $item;
			$this->current_size++;
		}

		// If 'none' is not found in the array...
		else {
			
			// Use the $chunk_size to add that many spaces to the array.
			$alloc_array = alloc($this->chunk_size);
			$this->initial_size += $this->chunk_size;

			// Merge arrays together...
			$this->items = array_merge($this->items, $alloc_array);

			// ...then call our function again.
			$this->add($item);
		}
	}

	// Inserts an item at the given index, shifting remaining items right and allocating a larger array if necessary.
	function insert($index, $item) {

		if ($index >= $this->current_size) {
			throw new Exception('Error: '. $index . ' is not within the bounds of the current array.');
		}

		else {
			// Copy the shifted items to another array.
			$copy = array_splice($this->items, $index);

			// Insert the new value into $this->items.
			$this->items[$index] = $item;

			// If $copy does not have 'none' in it.
			if (!(in_array('none', $copy))) {
				$alloc = alloc($this->chunk_size);
				$copy = array_merge($copy, $alloc);
				$this->initial_size += $this->chunk_size;
			}

			// Merge $copy back into the array.
			$this->items = array_merge($this->items, $copy);

			// Remove the last "none" from the array - not needed anymore!
			array_pop($this->items);
			$this->current_size++;
		}
	}

	// Sets the given item at the given index. Throws an exception if the index is not within the bounds of the array.
	function set($index, $item) {
		$key = array_search('none', $this->items);

		if ($index >= $this->current_size) {
			throw new Exception('Error: '. $index . ' is not within the bounds of the current array.');
		}

		else {
			$this->items[$index] = $item;
		}
	}

	// Retrieves the item at the given index. Throws an exception if the index is not within the bounds of the array.
	function get($index) {
		if ($index >= $this->current_size) {
			throw new Exception('Error: '. $index . ' is not within the bounds of the current array.');
		}

		else {
			return $this->items[$index];
		}
	}

	// Deletes the item at the given index, decreasing the allocated memory if needed. Throws an exception if the index is not within the bounds of the array.
	function delete($index) {
		if ($index >= $this->current_size) {
			throw new Exception('Error: '. $index . ' is not within the bounds of the current array.');
		}

		else {
			// Copy the shifted items to another array.
			$copy = array_splice($this->items, $index + 1);

			// Add a space to copy, to replace the deleted value.
			array_push($copy, 'none');

			// Remove the last item from $this->items, and replace it with $copy.
			array_splice($this->items, $index, 1, $copy);

			$keys = array_keys($this->items, 'none');

			// If we have more than 5 "none" spaces, remove them.
			if (count($keys) > $this->chunk_size) {
				$output = array_splice($this->items, -($this->chunk_size));

				$this->initial_size -= $this->chunk_size;
			}

			$this->current_size--;
		}
	}

	// Swaps the values at the given indices.
	function swap($index1, $index2) {
		if ($index1 >= $this->current_size || $index2 >= $this->current_size) {
			if ($index1 >= $this->current_size) {
				throw new Exception('Error: '. $index1 . ' is not within the bounds of the current array.');
			}

			elseif ($index2 >= $this->current_size) {
				throw new Exception('Error: '. $index2 . ' is not within the bounds of the current array.');
			}
		}

		else {
			$value1 = $this->items[$index1]; //Will
			$value2 = $this->items[$index2]; //Ryan

			$this->items[$index1] = $value2; //Ryan
			$this->items[$index2] = $value1; //Will
		}
	}
}

/* Utilities */

// Allocates array space in memory. This is similar to C's alloc function.
function alloc($size) {
	$items = array();

	// Use the $chunk_size to add that many spaces to the array.
	for ($i = 0; $i < $size; $i++) {
		array_push($items, "none");
	}

	return $items;
}
        
?>