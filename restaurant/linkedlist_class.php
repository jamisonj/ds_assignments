<?php

/* A linked list implementation that holds arbitrary objects. */
class LinkedList {
	
	// Creates a linked list.
	function __construct() {
		$this->size = 0;
		$this->head = new Node(NULL);
        $this->tail = $this->head;
	}

	// Prints a representation of the entire list.
	function debug_print() {

        $node = $this->head;
        $string = $this->size . ' >>> ' . $node->value . ',';

        for ($i = 1; $i < $this->size; $i++) {
            $node = $node->next;
            $string .= ' ' . $node->value . ',';
        }

		$string = rtrim($string, ',');
        return $string;
	}

	// Retrieves the Node object at the given index.  Throws an exception if the index is not within the bounds of the linked list.
	protected function get_node($index) {
		if ($index < 0 || $index >= $this->size) {
			throw new Exception('Error: '. $index . ' is not within the bounds of the current list.');
		}

		else {
			$node = $this->head;

			for ($i = 0; $i < $index; $i++) {
				$node = $node->next;
			}

			return $node;
		}
	}

	// Adds an item to the end of the linked list.
	function add($item) {

        $node = $this->head;

        // If this is the first list item...
        if ($this->size == 0) {
            $node->value = $item;
        }

        else {
            $node = $this->tail;
            $node->next = new Node($item);
            $this->tail = $node->next;
        }

        $this->size++;
	}

	// Inserts an item at the given index, shifting remaining items right.
	function insert($index, $item) {
		
		if ($index < 0 || $index >= $this->size) {
			throw new Exception('Error: '. $index . ' is not within the bounds of the current list.');
		}

		else {
            // Copy the items after the insert point over to another variable.
            $next = $this->get_node($index);

            // Create a new node to insert into the list.
            $node = new Node($item);

            // If we are not inserting at the very first spot...
            if ($index > 0) {
                $prev = $this->get_node($index - 1);
                $prev->next = $node;
                $node->next = $next;
            }

            else {
                $node->next = $this->head;

                // Set $this->head to the new head.
                $this->head = $node;
            }

			$this->size++;
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
		return $node->value;
	}

	// Deletes the item at the given index. Throws an exception if the index is not within the bounds of the linked list.
	function delete($index) {

		if ($index < 0 || $index >= $this->size) {
			throw new Exception('Error: '. $index . ' is not within the bounds of the current list.');
		}

		else {
            switch ($index) {

                // If $index is the first in the list.
                case 0:
                    // If the first item is the only item in the list.
                    if ($this->size == 1) {
                        $node = $this->get_node(0);
                        $node->value = NULL;
                        $node->next = NULL;
                    }

                    else {
                        $this->head = $this->get_node($index + 1);
                    }

                    break;

                // If $index is the last in the list.
                case $this->size - 1:
                    $node = $this->get_node($index - 1);
                    $node->next = NULL;
                    $this->tail = $node;
                    break;

                // Everything else.
                default: {
                    $node = $this->get_node($index - 1);
                    $node->next = $this->get_node($index + 1);
                    break;
                }
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
        $this->prev = NULL;
	}
}
        
?>