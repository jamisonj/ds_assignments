<?php
    include 'arrays_class.php';

 //    $row = 1;
	// if (($handle = fopen("test.csv", "r")) !== FALSE) {
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


    $array = new myArray();
    $array->add('Frank');
    $array->add('Joe');
    $array->add('Will');
    $array->add('Pete');
	$array->add('Doug');
	$array->add('Janet');
	$array->add('Steven');
	$array->add('Ryan');
	$array->add('Edwin');
	$array->add('Marko');
	$array->add('Valerie');
	$array->insert(4, 'Brubaker');
	$array->delete(0);
	$array->delete(0);
	$array->delete(0);
	$array->delete(0);
	$array->delete(0);
		$array->delete(0);
			$array->delete(0);
				$array->delete(0);
				
	// $array->swap(14,10);
	
	// $array->insert(3, 'Hi there!');
	// $array->insert(0, 'Test');
	// $array->insert(8, 'Test2');
?>