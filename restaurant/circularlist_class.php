<?php

    /* A circularly-linked list implementation that holds arbitrary objects. */
    class CircularLinkedList {

        // Creates a linked list.
        function __construct() {
            $this->size = 0;
            $this->head = new Node(NULL);
            $this->tail = $this->head;
            echo 'Size = ' . $this->size . '<br>';
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

//            echo 'Head: ' . $this->head->value . '<br>';
//            echo 'Tail: ' . $this->tail->value . '<br>';
//            echo $string . '<br>';

//            print_r($this->head);

            return $string;
        }

        // Prints a representation of the entire cycled list up to $count items.
        function debug_cycle($count) {

            $node = $this->head;
            $string = $this->size . ' >>> ' . $node->value . ',';

            for ($i = 1; $i < $count; $i++) {
                $node = $node->next;
                $string .= ' ' . $node->value . ',';
            }

            $string = rtrim($string, ',');

//            echo 'Head: ' . $this->head->value . '<br>';
//            echo 'Tail: ' . $this->tail->value . '<br>';
//            echo $string . '<br>';

//            print_r($this->head);

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
//                    echo ('Index: ' . $index);
//                    print_r($node);
                }

                return $node;
            }
        }

        // Adds an item to the end of the linked list.
        function add($item) {

            // If this is the first list item to be added...
            if ($this->size == 0) {
                $this->head->value = $item;
                $this->head->next = $this->head;
            }

            else {
                // Select the current tail.
                $node = $this->tail;

                // Set the one after the tail as a new node.
                $node->next = new Node($item);

                //Set the one after the new one to head.
                $node->next->next = $this->head;

                // Set the new node as the tail.
                $this->tail = $node->next;

                // If this is the second item, reset where $head->next points.
                if ($this->size == 1) {
                    $this->head->next = $node->next;
                }
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
//                echo '$next->value: ' . $next->value .'<br>';

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
                            $this->tail->next = $this->head;
                        }

                        break;

                    // If $index is the last in the list.
                    case $this->size - 1:
                        $node = $this->get_node($index - 1);
                        $node->next = $this->head;
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

    /* An iterator for the circular list. */
    class CircularLinkedListIterator {

        // Starts the iterator on the given circular list.
        function __construct($circular_list) {
            $this->list = $circular_list;
            $this->index = 0;
//            $this->current = $this->list->get_node($this->index);
        }

        // Returns whether there is another value in the list.
        function has_next() {
            if ($this->list->get($this->index) != NULL) {
                return true;
            }

            else {
                return false;
            }
        }

        // Returns the next value, and increments the iterator by one value.
        function next() {
            $current = $this->list->get($this->index);

            // If we are on the last item, reset the $index.
            if ($this->index == $this->list->size -1) {
                $this->index = 0;
            }

            else {
                $index = $this->index++;
            }

            return $current;
        }
    }

?>