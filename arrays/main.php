<?php
    include 'arrays_class.php';

    $row = 1;
    $handle = fopen('C:/Dev/byu_data_structures/assignments/arrays/data.csv','r');
    $output = '';

    if ($handle !== FALSE) {
    	while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
    		$num = count($data);
    		// echo '<p>' . $row . ':' . $data[0] . ', ' . $data[1] . ', ' . $data[2] .' </p>';

    		$output .= $row . ':' . $data[0] . ',' . $data[1] . ',' . $data[2] . PHP_EOL;

    		// TODO: Put entire thing in Try-Catch.
    		
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

    		// for ($c = 0; $c < $num; $c++) {
    		// 	echo $data[$c] . '<br>';
    		// }

    	}

    	// echo '<p>' . $output . '</p>';
    	$file = fopen("output.txt", "w") or die("Could not open file.");
    	fwrite($file, $output);
    }

    // 	fclose($handle);
    // }

	// if ($handle !== FALSE) {
	//     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	//         $num = count($data);
	//         echo "<p> $num fields in line $row: <br /></p>\n";
	//         $row++;
	//         for ($c=0; $c < $num; $c++) {
	//             echo $data[$c] . "<br />\n";
	//         }
	//     }
	//     fclose($handle);
	// }

 //    $array->debug_print();
 //    $array->add('Frank');
 //    $array->add('Joe');
 //    $array->add('Will');
 //    $array->add('Pete');
	// $array->add('Doug');
	// $array->add('Janet');
	// $array->add('Steven');
	// $array->add('Ryan');
	// $array->add('Edwin');
	// $array->add('Marko');
	// $array->add('Valerie');
	// $array->debug_print();
	// $array->insert(4, 'Brubaker');
	// $array->delete(0);
	// $array->delete(0);
	// $array->delete(0);
	// $array->delete(0);
	// $array->delete(0);
	// 	$array->delete(0);
	// 		$array->delete(0);
	// 			$array->delete(0);

	// $array->swap(14,10);
	
	// $array->insert(3, 'Hi there!');
	// $array->insert(0, 'Test');
	// $array->insert(8, 'Test2');
?>