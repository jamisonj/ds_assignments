<?php
    /* A doubly-linked list implementation that holds arbitrary objects. */
    class DoublyLinkedList {

        // Creates a linked list.
        function __construct() {
            $this->size = 0;
            $this->head = NULL;
            $this->tail = NULL;
        }

        // Prints a representation of the entire list.
        function debug_print() {

            $string = $this->size . ' >>>';

            $node = $this->head;

            while ($node->next != NULL) {
                $node = $node->next;
                $string .= ' ' . $node->value . ',';
            }

            $string = rtrim($string, ',');
            $string .= ' >>>';

            while ($node->prev != NULL) {
                $node = $node->prev;
                $string .= ' ' . $node->value . ',';
            }

            $string = rtrim($string, ',');

            echo $string;

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

            // Create a new node.
            $node = new Node($item);

            // If this is the first list item...
            if ($this->size == 0) {
                $this->head = &$node;
                $node->prev = NULL;
                echo 'This-size (0) = ' . $this->size . '<br>';
            }

            else {
                echo 'This-size = ' . $this->size . '<br>';
                $node->prev = $this->get_node($this->size - 1);
            }

            // Next is always NULL, because it doesn't exist yet!
            $node->next = NULL;
            $this->tail = $node;

            print_r($node);

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
                // Get the item right before the one at the given index.
                $node = $this->get_node($index - 1);

                // If this is the last item on the list, set next to NULL.
                if ($index == $this->size - 1) {
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
?>