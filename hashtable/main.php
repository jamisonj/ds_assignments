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

	echo 'String hash table:' . PHP_EOL;

	echo $hashtable->debug_print();

	echo PHP_EOL . 'String lookups:' . PHP_EOL;

	echo $hashtable->get('indian meal moth');
	echo $hashtable->get('orb-weaving spiders (banded garden spider)');

	$hashtable->remove('indian meal moth');
	$hashtable->remove('pseudoscorpions');
	$hashtable->remove('armyworms/cutworms');

	echo $hashtable->debug_print();

	// print_r($hashtable);

	echo "</pre>";
?>