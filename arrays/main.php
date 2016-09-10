<?php
    include 'arrays_class.php';

    $array = new myArray(5);
    $array->add(1);
    $array->add(2);
    $array->add(3);
    $array->add(4);
	$array->add(5);
	$array->insert(3, 'Hi there!');
	$array->insert(0, 'Test');
	$array->insert(8, 'Test2');
?>