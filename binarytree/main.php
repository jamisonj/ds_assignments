<?php
	include "binarytree.php";

	$tree = new BinaryTree();
	$tree->set('c', 'C');

	echo '<pre>';
	echo 'Initial Tree:' . PHP_EOL;
	echo $tree->debug_print() . PHP_EOL;

	$tree->set('h', 'H');
	$tree->set('a', 'A');
	$tree->set('d', 'D');
	$tree->set('e', 'E');
	$tree->set('e', 'E');

	// echo $tree->debug_print() . PHP_EOL;
	echo '</pre>';

?>