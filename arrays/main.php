<?php
    include 'arrays_class.php';

    $row = 1;
    $handle = fopen('data.csv','r');
    $output = '';

    if ($handle !== FALSE) {
    	while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
    		
    		$num = count($data);
    		$output .= $row . ':' . $data[0] . ',' . $data[1] . ',' . $data[2] . PHP_EOL;
    		
    		switch ($data[0]) {
    			case 'CREATE':
    				$array = new myArray();
    				break;
    			
    			case 'ADD':
    			 	$array->add($data[1]);
    			 	break;
    			
    			case 'INSERT':
    				try {
    					$array->insert($data[1], $data[2]);
    				}

    				catch (Exception $e) {
    					$output .= $e->getMessage() . PHP_EOL;
    				}

    				break;
    				
    			case 'SET':
    				try {
    					$array->set($data[1], $data[2]);
    				}

    				catch (Exception $e) {
    					$output .= $e->getMessage() . PHP_EOL;
    				}

    				break;

    			case 'GET':
    				try {
    					$get = $array->get($data[1]);
    					$output .= $get . PHP_EOL;
    				}

    				catch (Exception $e) {
    					$output .= $e->getMessage() . PHP_EOL;
    				}

    				break;

    			case 'DELETE':
    				try {
    					$array->delete($data[1]);
    				}

    				catch (Exception $e) {
    					$output .= $e->getMessage() . PHP_EOL;
    				}

    				break;

    			case 'SWAP':
    				try {
    					$array->swap($data[1], $data[2]);
    				}

    				catch (Exception $e) {
    					$output .= $e->getMessage() . PHP_EOL;
    				}

    				break;
    			
    			case "DEBUG":
    				$output .= $array->debug_print() . PHP_EOL; 
    				break;
    		}

    		$row++;
    	}

    	// echo '<p>' . $output . '</p>';
    	$file = fopen("output.txt", "w") or die("Could not open file.");
    	fwrite($file, $output);
    }
?>