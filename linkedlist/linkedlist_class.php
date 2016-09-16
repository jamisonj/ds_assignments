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
		
		$node = $this->get_node($index);
		$node->value = $item;
	}

	// Retrieves the item at the given index.  Throws an exception if the index is not within the bounds of the linked list.
	function get($index) {
		
	}

	// Deletes the item at the given index. Throws an exception if the index is not within the bounds of the linked list.
	function delete($index) {
		
	}

	// Swaps the values at the given indices.
	function swap($index1, $index2) {
		
	}
}

/* A node in the linked list */

// A node on the linked list
class Node {

	function __construct($value) {
		$this->value = $value;
		$this->next = NULL;
	}
}
        
?>