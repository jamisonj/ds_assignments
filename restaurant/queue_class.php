<?php

    /* A linked list implementation of a queue.
     * This contains a LinkedList internally.  It does not extend LinkedList.
     * In other words, this class uses "Composition" rather than "Inheritance".
     */
    class Queue {

        // Constructor
        function __construct() {
            //TODO: Create the LinkedList in here.
            $this->list = new LinkedList();
        }

        function debug_print() {
            $string = $this->list->debug_print();
            return $string;
        }

        // Adds an item to the end of the queue.
        function enqueue($item) {
            $this->list->add($item);
        }

        /* Dequeues the first item from the list.  This involves the following:
         * 1. Get the first node in the list.
         * 2. Delete the node from the list.
         * 3. Return the value of the node.
         */
        function dequeue() {
            $value = $this->list->get(0);
            $this->list->delete(0);
            echo 'Get: ' . $value . '<br>';
            return $value;
        }

        // Returns the number of items in the queue.
        function size() {
            return $this->list->size;
        }
    }

?>

