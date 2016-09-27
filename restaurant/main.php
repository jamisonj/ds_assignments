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

//            $this->buzzers->push('Buzzer1');
//            $this->buzzers->debug_print();
//            $this->buzzers->push('Buzzer2');
//            $this->buzzers->debug_print();
//            $this->buzzers->push('Buzzer3');
//            $this->buzzers->debug_print();
//            $this->buzzers->pop();
//            $this->buzzers->debug_print();
//            $this->buzzers->pop();
//            $this->buzzers->debug_print();
//            $this->buzzers->pop();
//            $this->buzzers->debug_print();

//            $this->appetizers->enqueue('Shrimp');
//            $this->appetizers->debug_print();
//            $this->appetizers->enqueue('Nachos');
//            $this->appetizers->debug_print();
//            $this->appetizers->enqueue('Potstickers');
//            $this->appetizers->debug_print();
//            $this->appetizers->enqueue('Varna');
//            $this->appetizers->debug_print();
//            $this->appetizers->dequeue();
//            $this->appetizers->debug_print();
//            $this->appetizers->size();

//            $this->callahead->add(1);
//            $this->callahead->add(2);
//            $this->callahead->add(3);
//            $this->callahead->add(4);
//            $this->callahead->add(5);
//            $this->callahead->add(6);
//            $this->callahead->add(7);
//            $this->callahead->add(8);
//            $this->callahead->add(9);
//            $this->callahead->insert(0, "tooth");
//            $this->callahead->insert(7, "brain");
//            $this->callahead->set(5, "pimble");
//            $this->callahead->delete(0);
//            $this->callahead->debug_print();
//            $this->callahead->delete(4);
//            $this->callahead->debug_print();
//            $this->callahead->delete(6);
//            $this->callahead->debug_print();

//            $this->songs->add('Song 1');
//            $this->songs->add('Song 2');
//            $this->songs->add('Song 3');
//            $this->songs->add('Song 4');
//            $this->songs->add('Song 5');
//            $this->songs->add('Song 6');
//            $this->songs->add('Song 7');
//            $this->songs->add('Song 8');
//            $this->songs->debug_cycle(15);
//            $this->songs->delete(7);
//            $this->songs->debug_print();
//            $this->songs->delete(0);
//            $this->songs->debug_print();
//            $this->songs->delete(2);
//            $this->songs->debug_print();
//            $this->songs->delete(2);
//            $this->songs->debug_print();
//            $this->songs->delete(2);
//            $this->songs->debug_print();
//            $this->songs->delete(2);
//            $this->songs->debug_print();
//            $this->songs->delete(1);
//            $this->songs->debug_print();
//            $this->songs->delete(0);
//            $this->songs->debug_print();

            if ($handle !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                    // Output string for each row: The $row and $data values are added to $output string.
                    $output .= $row . ':' . $data[0] . ',' . $data[1] . ',' . $data[2] . PHP_EOL;

            		switch ($data[0]) {

                        case "SONG":
                            if ($this->songs_iter->has_next()) {
                                $song = $this->songs_iter->next();
                                $output .= $song . ' Size: ' . $this->songs->size . PHP_EOL;
                            }

                            break;

                        case "APPETIZER_READY":
                            $this->appetizers->enqueue($data[1]);
//                            echo $this->appetizers->debug_print();
                            break;

                        case "APPETIZER":

                            $index = $this->waiting->size - 1;

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
                                if ($this->waiting->size == 0 || $this->appetizers->size == 0) {
                                    $app_output = $e->getMessage();
                                }
                            }

                            $app_output = rtrim($app_output, ',') . PHP_EOL;
                            $output .= $app_output;
                            break;

                        case "SEAT":
                            try {
                                $output .= $this->waiting->get(0);
                                $this->waiting->delete(0);
                            }

                            catch (Exception $e) {
                                $output .= $e->getMessage();
                            }

                            $output .= PHP_EOL;

                            break;

                        case "ARRIVE":
                            $this->waiting->add($data[1]);
                            break;

                        case "CALL":
                            break;

                        case "LEAVE":
                            $index = 0;

                            do {
                                $index++;
                            }

                            while ($this->waiting->get($index) != $data[1]);

                            $this->waiting->delete($index);

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

                echo $output;
            }

            echo '</pre>';

            // Writing to the output.txt file. This also creates it if it doesn't already exist.
//            $file = fopen("output.txt", "w") or die("Could not open file.");
//            fwrite($file, $output);
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