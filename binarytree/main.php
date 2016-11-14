<?php
	include "binarytree.php";

	$tree = new BinaryTree();
	$tree->set('c', 'C');

	echo '<pre>';
	// echo 'Initial Tree:' . PHP_EOL;
	// echo $tree->debug_print() . PHP_EOL;

	$tree->set('h', 'H');
	$tree->set('a', 'A');
	$tree->set('d', 'D');
	$tree->set('e', 'E');
	$tree->set('e', 'E');
	$tree->set('q', 'Q');
	$tree->set('i', 'I');
	$tree->set('t', 'T');


	// echo $tree->get('f');

	// echo $tree->debug_print() . PHP_EOL;

	// $tree->walk_bfs($tree);
	// $tree->walk_bfs($tree->root);

	// foreach ($tree->walk_bfs() as $item) {
	// 	echo $item;
	// }

	echo $tree->walk_bfs();
	echo '</pre>';

?>