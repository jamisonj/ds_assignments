<?php 
	include "hashtable.php";

	echo "<pre>";

	$hashtable = new StringHashTable();

	$filename = "strings.txt";
	$contents = file($filename);

	foreach($contents as $line) {
	    // echo $hashtable->get_hash(strtolower($line)) . PHP_EOL;
	    $hashtable->set(strtolower($line), $line);
	}

	echo $hashtable->debug_print();

	// print_r($hashtable);

	echo "</pre>";
?>