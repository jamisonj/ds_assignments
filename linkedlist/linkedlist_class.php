<?php

// A linked list implementation that holds arbitrary objects.
class LinkedList {

	protected $size;
	protected $head;
	
	// Creates a linked list.
	function __construct() {
		$this->size = 0;
		$this->head = new Node(NULL);
	}

	// Prints a representation of the entire list.
	function debug_print() {

		$string = '<p>' . $this->size . ' >>> ';

		$node = $this->head;

		// TODO: Iterate over each linkedlist item and add it to a string.
		while ($node->next != NULL) {
			$node = $node->next;
			$string .= $node->value;
			$string .= ', ';
		}

		$string = rtrim($string, ',');
		$string .= '</p>';
		echo $string;
	}

	// Retrieves the Node object at the given index.  Throws an exception if the index is not within the bounds of the linked list.
	private function get_node($index) {
		if ($index < 0 || $index >= $this->size) {
			throw new Exception('Error: '. $index . ' is not within the bounds of the current list.');
		}

		else {
			$node = $this->head;

			for ($i = 0; $i <= $index; $i++) {
				$node = $node->next;
			}

			return $node;
		}
	}

	// Adds an item to the end of the linked list.
	function add($item) {

		$node = $this->head;

		while ($node->next != NULL) {
			$node = $node->next;
		}

		$node->next = new Node($item);
		$this->size++;
		echo '<p>Size: ' . $this->size . '</p>';
	}

	// Inserts an item at the given index, shifting remaining items right.
	function insert($index, $item) {

	}

	// Sets the given item at the given index.  Throws an exception if the index is not within the bounds of the linked list.
	function set($index, $item) {

		if ($index < 0 || $index >= $this->size) {
			throw new Exception('Error: '. $index . ' is not within the bounds of the current list.');
		}

		else {
			$node = $this->get_node($index);
			$node->value = $item;
		}
	}

	// Retrieves the item at the given index.  Throws an exception if the index is not within the bounds of the linked list.
	function get($index) {

		$node = $this->get_node($index);
		echo '<p>Get: ' . $node->value . '</p>';
		return $node->value;
	}

	// Deletes the item at the given index. Throws an exception if the index is not within the bounds of the linked list.
	function delete($index) {

		echo "<p>Delete called</p>";

		if ($index < 0 || $index >= $this->size) {
			throw new Exception('Error: '. $index . ' is not within the bounds of the current list.');
		}

		else {
			// Get the item right before the one at the given index.
			$node = $this->get_node($index - 1);

			// If this is the last item on the list, set next to NULL.
			if ($index == $this->size - 1) {
				echo 'Last item';
				$node->next = NULL;
			}

			// If the $index is not the last in the list, set the value of next to the next node after the deleted one.
			else {
				$node->next = $this->get_node($index + 1);
			}

			$this->size--;
		}
	}

	// Swaps the values at the given indices.
	function swap($index1, $index2) {

		$value1 = $this->get($index1);
		$value2 = $this->get($index2);

		$this->set($index1, $value2);
		$this->set($index2, $value1);
	}
}

/* A node in the linked list */

class Node {

	function __construct($value) {
		$this->value = $value;
		$this->next = NULL;
	}
}
        
?>