<?php

/* A linked list implementation that holds arbitrary objects. */
class LinkedList {
	
	// Creates a linked list.
	function __construct() {
		$this->size = 0;
		$this->head = new Node(NULL);
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

        echo $string . '<br>';

        print_r($this->head);

		return $string;
	}

	// Retrieves the Node object at the given index.  Throws an exception if the index is not within the bounds of the linked list.
	private function get_node($index) {
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
            echo "Size was 0<br>";
        }

        else {
            echo "Size was not 0<br>";
            while ($node->next != NULL) {
                $node = $node->next;
            }

            $node->next = new Node($item);
        }

        $this->size++;
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
			if ($index == $this->size) {
				$node->next = NULL;
			}

			// If the $node is not the last in the list, set the value of next to the next node after the added one.
			else {
				$node->next = $list;
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

                // Index is the first in the list.
                case 0:
                    $this->head = $this->get_node($index + 1);
//                    $this->tail->next = $this->head;
                    break;

                // Index is the last in the list.
                case $this->size - 1:
                    $node = $this->get_node($index - 1);
//                    $node->next = $this->head;
//                    $this->tail = $node;
                    break;

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