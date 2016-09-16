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

		$string = '<p>' . $this->size . ' >>>';

		$node = $this->head;

		// TODO: Iterate over each linkedlist item and add it to a string.
		while ($node->next != NULL) {
			$node = $node->next;
			$string .= ' ' . $node->value . ',';
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
		
		if ($index < 0 || $index >= $this->size) {
			throw new Exception('Error: '. $index . ' is not within the bounds of the current list.');
		}

		else {
			$node = $this->get_node($index - 1);

			// Copy the items after the insert point over to another variable.
			$list = $this->get_node($index);

			// Create a new node to insert into the list.
			$node->next = new Node($item);

			// Move the list pointer onto the new item.
			$node = $node->next;

			// If $node is the last item on the list, set next to NULL.
			if ($index == $this->size - 1) {
				echo 'Last item';
				$node->next = NULL;
			}

			// If the $node is not the last in the list, set the value of next to the next node after the added one.
			else {
				print_r($list);
				$node->next = $list;
			}

			$this->size++;
			echo '<p>Size: ' . $this->size . '</p>';
		}
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
			echo '<p>Size: ' . $this->size . '</p>';
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