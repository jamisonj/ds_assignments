<?php

    /* A circularly-linked list implementation that holds arbitrary objects. */
    class CircularLinkedList {

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

            echo 'Head: ' . $this->head->value . '<br>';
            echo 'Tail: ' . $this->tail->value . '<br>';
//            echo '0: ' . $this->get_node(0)->value . '<br>';
//            echo '1: ' . $this->get_node(1)->value . '<br>';
//            echo '2: ' . $this->get_node(2)->value . '<br>';
//            echo '3: ' . $this->get_node(3)->value . '<br>';
//            echo '4: ' . $this->get_node(4)->value . '<br>';
//            echo '5: ' . $this->get_node(5)->value . '<br>';
//            echo '6: ' . $this->get_node(6)->value . '<br>';
            echo $string . '<br>';

//            print_r($this->head);

            return $string;
        }

        // Prints a representation of the entire cycled list up to $count items.
        function debug_cycle($count) {

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
                $node = $this->tail;
                $node->next = new Node($item);
                $node->next->next = $this->head;
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
                echo '$next->value: ' . $next->value .'<br>';

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

                    // Index is the first in the list.
                    case 0:
                        $this->head = $this->get_node(1);
                        $this->tail->next = $this->head;
                        break;

                    // Index is the last in the list.
                    case $this->size - 1:
                        $node = $this->get_node($index - 1);
                        $node->next = $this->head;
                        $this->tail = $node;
                        break;

                    default: {
                        $node = $this->get_node($index - 1);
                        $node->next = $this->get_node($index + 1);
                        break;
                    }
                }



//                // Get the item right before the one at the given index.
//                $node = $this->get_node($index - 1);
//
//                // If this is the last item on the list, set next to NULL.
//                if ($index == $this->size - 1) {
//                    $node->next = $this->head;
//                    $this->tail = $node;
//                }
//
//                // If the $index is not the last in the list, set the value of next to the next node after the deleted one.
//                else {
//                    $node->next = $this->get_node($index + 1);
//                }

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
            $list = new CircularLinkedList();
            $this->start = $list->get(0);
        }

        // Returns whether there is another value in the list.
        function has_next() {
            $index = 0;

            for ($i = 0; $i < $index; $i++){
                $truth = $list->get($index);
            }
        }

        // Returns the next value, and increments the iterator by one value.
        function next() {

        }
    }

?>