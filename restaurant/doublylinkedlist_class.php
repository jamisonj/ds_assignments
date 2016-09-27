<?php
    /* A doubly-linked list implementation that holds arbitrary objects. */
    class DoublyLinkedList {

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

            while ($node->next != NULL) {
                $node = $node->next;
                $string .= ' ' . $node->value . ',';
            }

            $string = rtrim($string, ',');
            $string .= ' >>> ';

            $node = $this->tail;
            $string .= $node->value . ',';

            while ($node->prev != NULL) {
                $node = $node->prev;
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

            echo $string . '<br>';

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
                }

                return $node;
            }
        }

        // Adds an item to the end of the linked list.
        function add($item) {

            // If this is the first list item...
            if ($this->size == 0) {
                $this->head->value = $item;
            }

            else {
                $node = $this->tail;

                $node->next = new Node($item);

                $node->next->prev = $node;
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
                if ($index - 1 >= 0) {
                    $prev = $this->get_node($index - 1);

                    $next->prev = $node;
                    $prev->next = $node;

                    // If $node is the last item on the list, set next to NULL.
                    if ($index == $this->size) {
                        $node->next = NULL;
                    }

                    // If the $node is not the last in the list, set the value of next to the next node after the added one.
                    else {
                        $node->next = $next;

                        // Point the new node to the previous one.
                        $node->prev = $prev;
                    }
                }

                else {
                    $next->prev = $node;
                    $node->next = $next;

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
?>