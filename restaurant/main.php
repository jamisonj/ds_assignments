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


//            $this->buzzers = new Stack();
//            $this->buzzers->push('Buzzer');
//            $this->buzzers->push('Buzzer');
//            $this->buzzers->push('Buzzer');
//            $this->buzzers->push('Buzzer');
//            $this->buzzers->push('Buzzer');
//            $this->buzzers->push('Buzzer');
//            $this->buzzers->push('Buzzer');
//            $this->buzzers->push('Buzzer');
//            $this->songs = new CircularLinkedList();
//            $this->songs->add('Song 1');
//            $this->songs->add('Song 2');
//            $this->songs->add('Song 3');
//            $this->songs_iter = new CircularLinkedListIterator($this->songs);
        }

        function run($handle) {
            //Processes the given file stream.
            $row = 1;
            $output = '';

            echo '<pre>';

            $this->appetizers->enqueue('Shrimp');
            $this->appetizers->debug_print();
            $this->appetizers->enqueue('Nachos');
            $this->appetizers->debug_print();
            $this->appetizers->enqueue('Potstickers');
            $this->appetizers->debug_print();
            $this->appetizers->enqueue('Varna');
            $this->appetizers->debug_print();
            $this->appetizers->dequeue();
            $this->appetizers->debug_print();

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
//            $this->songs->debug_print();
//            $this->songs->delete(7);
//            $this->songs->debug_print();
//            $this->songs->delete(0);
//            $this->songs->debug_print();
//            $this->songs->delete(2);
//            $this->songs->debug_print();

//            if ($handle !== FALSE) {
//                while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
//
//                    // Output string for each row: The $row and $data values are added to $output string.
//                    $output .= $row . ':' . $data[0] . ',' . $data[1] . ',' . $data[2] . PHP_EOL;
//
//            		switch ($data[0]) {
//            			case 'CREATE':
//            				$list = new LinkedList();
//            				break;
//
//            			case 'ADD':
//            			 	try {
//            			 		$list->add($data[1]);
//            			 	}
//
//            			 	catch (Exception $e) {
//            					$output .= $e->getMessage() . PHP_EOL;
//            				}
//
//            				break;
//
//            			case 'INSERT':
//            				try {
//            					$list->insert($data[1], $data[2]);
//            				}
//
//            				catch (Exception $e) {
//            					$output .= $e->getMessage() . PHP_EOL;
//            				}
//
//            				break;
//
//            			case 'SET':
//            				try {
//            					$list->set($data[1], $data[2]);
//            				}
//
//            				catch (Exception $e) {
//            					$output .= $e->getMessage() . PHP_EOL;
//            				}
//
//            				break;
//
//            			case 'GET':
//            				try {
//            					$get = $list->get($data[1]);
//            					$output .= $get . PHP_EOL;
//            				}
//
//            				catch (Exception $e) {
//            					$output .= $e->getMessage() . PHP_EOL;
//            				}
//
//            				break;
//
//            			case 'DELETE':
//            				try {
//            					$list->delete($data[1]);
//            				}
//
//            				catch (Exception $e) {
//            					$output .= $e->getMessage() . PHP_EOL;
//            				}
//
//            				break;
//
//            			case 'SWAP':
//            				try {
//            					$list->swap($data[1], $data[2]);
//            				}
//
//            				catch (Exception $e) {
//            					$output .= $e->getMessage() . PHP_EOL;
//            				}
//
//            				break;
//
//            			case "DEBUG":
//            				$output .= $list->debug_print() . PHP_EOL;
//            				break;
//            		}
//
//                    $row++;
//                }
//
//                echo $output;
//            }

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