<?php
    include 'linkedlist_class.php';
    include 'circularlist_class.php';
    include 'doublylinkedlist_class.php';
    include 'stack_class.php';
    include 'queue_class.php';

    class Processor {

        function __construct() {
            // Creates the lists.
            $this->callahead = new DoublyLinkedList();
            $this->waiting = new DoublyLinkedList();
            $this->appetizers = new Queue();


            $this->buzzers = new Stack();
            $this->buzzers->push('Buzzer');
            $this->buzzers->push('Buzzer');
            $this->buzzers->push('Buzzer');
            $this->buzzers->push('Buzzer');
            $this->buzzers->push('Buzzer');
            $this->buzzers->push('Buzzer');
            $this->buzzers->push('Buzzer');
            $this->buzzers->push('Buzzer');
            $this->songs = new CircularLinkedList();
            $this->songs->add('Song 1');
            $this->songs->add('Song 2');
            $this->songs->add('Song 3');
            $this->songs_iter = new CircularLinkedListIterator($this->songs);
        }

        function run($handle) {
            //Processes the given file stream.
            $row = 1;
            $output = '';

            echo '<pre>';

            if ($handle !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                    // Output string for each row: The $row and $data values are added to $output string.
                    $output .= $row . ':' . $data[0] . ',' . $data[1] . ',' . $data[2] . PHP_EOL;

            		switch ($data[0]) {

                        case "SONG":
                            if ($this->songs_iter->has_next()) {
                                $song = $this->songs_iter->next();
                                $output .= $song . PHP_EOL;
                            }

                            break;

                        case "APPETIZER_READY":
                            $this->appetizers->enqueue($data[1]);
                            break;

                        case "APPETIZER":
                            if ($this->waiting->size == 0) {
                                $index = 0;
                            }

                            else {
                                $index = $this->waiting->size - 1;
                            }

                            $app_output = '';

                            try {
                                $app_output .= $this->appetizers->dequeue() . ' >>>';

                                for ($i = 0; $i < 3; $i++){
                                    $app_output .= ' ' . $this->waiting->get($index) . ',';
                                    $index--;
                                }
                            }

                            catch (Exception $e) {
                                // If waiting list or appetizers have no contents, print out the exception. Otherwise, do nothing.
                                if ($this->waiting->size == 0 || $this->appetizers->size() == 0) {
                                    $app_output = $e->getMessage();
                                }
                            }

                            $app_output = rtrim($app_output, ',') . PHP_EOL;
                            $output .= $app_output;
                            break;

                        case "SEAT":
                            try {
                                $output .= $this->waiting->get(0);
                                $this->buzzers->push('Buzzer');
                                $this->waiting->delete(0);
                            }

                            catch (Exception $e) {
                                $output .= $e->getMessage();
                            }

                            $output .= PHP_EOL;

                            break;

                        case "ARRIVE":
                            try {

                                $this->waiting->add($data[1]);
                                $this->buzzers->pop();

                                // Check if $callahead even has any contents.
                                if ($this->callahead->size > 0) {

                                    for ($index = 0; $index < $this->callahead->size; $index++) {

                                        // If this name matches a family in the callahead list...
                                        if ($this->callahead->get($index) == $data[1]) {

                                            // Have to delete it since we had previously added it.
                                            $this->waiting->delete($this->waiting->size - 1);

                                            // Delete from $callahead.
                                            $this->callahead->delete($index);

//                                            $node = $this->waiting->tail;

                                            // If the list is smaller than 5, push them to the front.
                                            if ($this->waiting->size <= 5) {
                                                $this->waiting->insert(0, $data[1]);
                                            }

                                            // Otherwise, calculate the distance as 5 from the back.
                                            else {
                                                $this->waiting->insert(($this->waiting->size - 4), $data[1]);
                                            }
                                        }
                                    }
                                }
                            }

                            catch (Exception $e) {
                                $output .= $e->getMessage() . PHP_EOL;
                            }

                            break;

                        case "CALL":
                            $this->callahead->add($data[1]);
                            break;

                        case "LEAVE":
                            try {
                                $index = 0;

                                do {
                                    $index++;
                                }

                                while ($this->waiting->get($index) != $data[1]);

                                $this->waiting->delete($index);
                            }

                            catch (Exception $e) {
                                $output .= $e->getMessage() . PHP_EOL;
                            }

                            break;

            			case "DEBUG":
            				$output .= $this->callahead->debug_print() . PHP_EOL;
                            $output .= $this->waiting->debug_print() . PHP_EOL;
                            $output .= $this->appetizers->debug_print() . PHP_EOL;
                            $output .= $this->buzzers->debug_print() . PHP_EOL;
                            $output .= $this->songs->debug_print() . PHP_EOL;
            				break;
            		}

                    $row++;
                }

                // Outputs to the browser for easier viewing.
                echo $output;
            }

            echo '</pre>';

            // Writing to the output.txt file. This also creates it if it doesn't already exist.
            $file = fopen("output.txt", "w") or die("Could not open file.");
            fwrite($file, $output);
        }

        function debug() {
            $this->callahead->debug_print();
            $this->waiting->debug_print();
            $this->appetizers->debug_print();
            $this->buzzers->debug_print();
            $this->songs->debug_print();
        }
    }

    // Main Loop:
    $handle = fopen('data.csv','r');
    $processor = new Processor();
    $processor->run($handle);

?>