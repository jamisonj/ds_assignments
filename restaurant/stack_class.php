<?php

    /* A linked list implementation of a stack.
     * This extends the LinkedList class, adding the typical stack methods to the class.
     * In other words, this class uses "Inheritance" instead of "Composition".
     */
    class Stack extends LinkedList {

        // Pushes an item onto the stack.
        function push($item) {

            $node = new Node($item);
            echo 'New node: ' . $node->value . '<br>';
            $this->add($item);
        }

        /* Pops an item from the stack.  This is done as follows:
         * 1. Get the last node in the list.
         * 2. Delete the node from the list.
         * 3. Return the value of the node.
         */
        function pop() {
            $node = $this->head;

            for ($i = 0; $i < $this->size - 1; $i++) {
                $node = $node->next;
            }

            $value = $node->value;
            $this->delete($i);

            echo 'Value deleted: ' . $value . '<br>';

            return $value;
        }
    }

?>