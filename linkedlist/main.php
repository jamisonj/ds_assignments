<?php
    include 'linkedlist_class.php';

    // Set the starting row number, the file to read, and the initial $output string.
    $row = 1;
    $handle = fopen('data.csv','r');
    $output = '';

    phpinfo();

    echo '<pre>';

    if ($handle !== FALSE) {
    	while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

    		// Output string for each row: The $row and $data values are added to $output string.
    		$output .= $row . ':' . $data[0] . ',' . $data[1] . ',' . $data[2] . PHP_EOL;

    		switch ($data[0]) {
    			case 'CREATE':
    				$list = new LinkedList();
    				break;
    			
    			case 'ADD':
    			 	try {
    			 		$list->add($data[1]);
    			 	}

    			 	catch (Exception $e) {
    					$output .= $e->getMessage() . PHP_EOL;
    				}

    				break;
    			
    			case 'INSERT':
    				try {
    					$list->insert($data[1], $data[2]);
    				}

    				catch (Exception $e) {
    					$output .= $e->getMessage() . PHP_EOL;
    				}

    				break;
    				
    			case 'SET':
    				try {
    					$list->set($data[1], $data[2]);
    				}

    				catch (Exception $e) {
    					$output .= $e->getMessage() . PHP_EOL;
    				}

    				break;

    			case 'GET':
    				try {
    					$get = $list->get($data[1]);
    					$output .= $get . PHP_EOL;
    				}

    				catch (Exception $e) {
    					$output .= $e->getMessage() . PHP_EOL;
    				}

    				break;

    			case 'DELETE':
    				try {
    					$list->delete($data[1]);
    				}

    				catch (Exception $e) {
    					$output .= $e->getMessage() . PHP_EOL;
    				}

    				break;

    			case 'SWAP':
    				try {
    					$list->swap($data[1], $data[2]);
    				}

    				catch (Exception $e) {
    					$output .= $e->getMessage() . PHP_EOL;
    				}

    				break;
    			
    			case "DEBUG":
    				$output .= $list->debug_print() . PHP_EOL; 
    				break;
    		}

    		$row++;
    	}

    	echo $output;
    }

    echo '</pre>';

	// Writing to the output.txt file. This also creates it if it doesn't already exist.
	$file = fopen("output.txt", "w") or die("Could not open file.");
	fwrite($file, $output);
?>