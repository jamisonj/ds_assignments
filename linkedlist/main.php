<?php
    include 'linkedlist_class.php';

    $list = new LinkedList();

   	echo '<pre>';
   	// print_r($list);

   	// $list->debug_print();

   	$list->add(5);
   	$list->add(6);
   	$list->add(7);
   	$list->add(8);
   	$list->add(9);
   	$list->add(10);
   	$list->get(2);

   	// print_r($list);

   	$list->debug_print();

   	$list->delete(2);
   	$list->debug_print();

   	$list->swap(0, 1);
   	$list->debug_print();

   	$list->swap(4, 1);
   	$list->debug_print();



   	// print_r($list);

   	// $list->debug_print();

   	echo '</pre>';

    // Set the starting row number, the file to read, and the initial $output string.
    // $row = 1;
    // $handle = fopen('data.csv','r');
    // $output = '';

    // if ($handle !== FALSE) {
    // 	while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
    		
    // 		// Output string for each row: The $row and $data values are added to $output string.
    // 		$output .= $row . ':' . $data[0] . ',' . $data[1] . ',' . $data[2] . PHP_EOL;
    		
    // 		switch ($data[0]) {
    // 			case 'CREATE':
    // 				$array = new myArray();
    // 				break;
    			
    // 			case 'ADD':
    // 			 	$array->add($data[1]);
    // 			 	break;
    			
    // 			case 'INSERT':
    // 				try {
    // 					$array->insert($data[1], $data[2]);
    // 				}

    // 				catch (Exception $e) {
    // 					$output .= $e->getMessage() . PHP_EOL;
    // 				}

    // 				break;
    				
    // 			case 'SET':
    // 				try {
    // 					$array->set($data[1], $data[2]);
    // 				}

    // 				catch (Exception $e) {
    // 					$output .= $e->getMessage() . PHP_EOL;
    // 				}

    // 				break;

    // 			case 'GET':
    // 				try {
    // 					$get = $array->get($data[1]);
    // 					$output .= $get . PHP_EOL;
    // 				}

    // 				catch (Exception $e) {
    // 					$output .= $e->getMessage() . PHP_EOL;
    // 				}

    // 				break;

    // 			case 'DELETE':
    // 				try {
    // 					$array->delete($data[1]);
    // 				}

    // 				catch (Exception $e) {
    // 					$output .= $e->getMessage() . PHP_EOL;
    // 				}

    // 				break;

    // 			case 'SWAP':
    // 				try {
    // 					$array->swap($data[1], $data[2]);
    // 				}

    // 				catch (Exception $e) {
    // 					$output .= $e->getMessage() . PHP_EOL;
    // 				}

    // 				break;
    			
    // 			case "DEBUG":
    // 				$output .= $array->debug_print() . PHP_EOL; 
    // 				break;
    // 		}

    // 		$row++;
    // 	}

    // 	// Writing to the output.txt file. This also creates it if it doesn't already exist.
    // 	$file = fopen("output.txt", "w") or die("Could not open file.");
    // 	fwrite($file, $output);
    // }
?>