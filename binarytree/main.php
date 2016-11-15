<?php
	include "binarytree.php";

	$tree = new BinaryTree();
	$tree->set('c', 'C');

	echo '<pre>';
	// echo 'Initial Tree:' . PHP_EOL;
	// echo $tree->debug_print() . PHP_EOL;

	$tree->set('h', 'H');
	$tree->set('a', 'A');
	$tree->set('b', 'B');
	$tree->set('e', 'E');
	$tree->set('j', 'J');
	$tree->set('d', 'D');
	$tree->set('f', 'F');
	$tree->set('i', 'I');
	$tree->set('k', 'K');
	$tree->set('g', 'G');

	echo 'Initial tree: ' . PHP_EOL;
	echo $tree->debug_print() . PHP_EOL;

	echo 'Lookups: ' . PHP_EOL;
	echo $tree->get('f') . PHP_EOL;
	echo $tree->get('b') . PHP_EOL;
	echo $tree->get('i') . PHP_EOL;

	echo PHP_EOL;

	echo 'BFS: ' . PHP_EOL;
	echo $tree->walk_bfs() . PHP_EOL;

	echo 'DFS preorder:' . PHP_EOL;
	echo $tree->walk_dfs_preorder($tree->root) . PHP_EOL;

	echo 'DFS inorder:' . PHP_EOL;
	echo $tree->walk_dfs_inorder($tree->root) . PHP_EOL;

	echo 'DFS postorder:' . PHP_EOL;
	echo $tree->walk_dfs_postorder($tree->root) . PHP_EOL;

	echo 'Remove b:' . PHP_EOL;
	$tree->remove('b');
	echo $tree->debug_print() . PHP_EOL;

	echo 'Remove f:' . PHP_EOL;
	$tree->remove('f');
	echo $tree->debug_print() . PHP_EOL;

	echo 'Remove h:' . PHP_EOL;
	$tree->remove('h');
	echo $tree->debug_print() . PHP_EOL;

	echo '</pre>';

?>