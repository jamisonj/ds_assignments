<?php
    include 'linkedlist_class.php';

    /* A linked list implementation of a queue.
     * This contains a LinkedList internally.  It does not extend LinkedList.
     * In other words, this class uses "Composition" rather than "Inheritance".
     */
    class Queue {

        // Constructor
        function __construct() {
            //TODO: Create the LinkedList in here.
        }

        function debug_print() {
            $string = $this->size . ' >>>';

            $node = $this->head;

            while ($node->next != NULL) {
                $node = $node->next;
                $string .= ' ' . $node->value . ',';
            }

            $string = rtrim($string, ',');
            return $string;
        }

        // Adds an item to the end of the queue.
        function enqueue($item) {

        }

        /* Dequeues the first item from the list.  This involves the following:
         * 1. Get the first node in the list.
         * 2. Delete the node from the list.
         * 3. Return the value of the node.
         */
        function dequeue() {

        }

        // Returns the number of items in the queue.
        function size() {

        }
    }

?>

