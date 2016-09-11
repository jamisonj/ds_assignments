<?php
    include 'arrays_class.php';

    $array = new myArray();
    $array->add('Frank');
    $array->add('Joe');
    $array->add('Will');
    $array->add('Pete');
	$array->add('Doug');

	try {
		$array->set(4, 'Vanilla');
	}
	
	catch (Exception $e) {
		echo $e;
	}

	try {
		$stuff = $array->get(4);
		echo $stuff;
	}

	catch (Exception $e) {
		echo $e;
	}
	
	try {
		$array->delete(2);
	}

	catch (Exception $e) {
		echo $e;
	}
	
	// $array->insert(3, 'Hi there!');
	// $array->insert(0, 'Test');
	// $array->insert(8, 'Test2');
?>